<?php
////////////////////////////////////////////////////////////////////////////
///  PHP-Движок KEnginePHP v 1.0 (by Rodion Kolovanov)                   ///
///                                                                      ///
///  В начале каждой страницы объявить несколько переменных:             ///
///  $title - Название страницы                                          ///
///  $descr - Описание страницы                                          ///
///  $keywords - Ключевые слова (для поисковиков)                        ///
///  $charset - Кодировка страницы (Если не задано, по умолчанию UTF-8)  ///
///  $href_main - Путь к корню от данного файла                          ///
///  $head_text - Текст, вставляемый в head                              ///
///  $header_type - Тип шапки (Если не задано, по умолчанию 1)           /// 
///   (1 - стандартная шапка, 2 - особая шапка)                          ///
///  $include_links - массив подключаемых ссылок на файлы                ///
///  Пишется следующим образом:                                          ///
///  $include_links = array(                                             ///
///  	array("href1", "rel1", "type1"),                                 ///
///  	array("href2", "rel2", "type2"), ...                             ///
///  );                                                                  ///
///  $include_scripts - массив подключаемых скриптов                     ///
///  Пишется следующим образом:                                          ///
///  $include_scripts = array("скрипт1", "скрипт2", ...);                ///                                           ///  
///                                                                      ///
////////////////////////////////////////////////////////////////////////////

$href_main = "../../";
$header_type = 1;
$include_links = array(
	array("styles/style_main.css", "stylesheet", "text/css"),
	array("img/icon.ico", "shortcut icon", "image/x-icon")
);
$include_scripts = array("jquery-3.1.0.min.js", "jQueryRotate.js", "main_script.js");

require_once $href_main."include/db.php";
$title = "Рейтинговая таблица$title_postfix";

include($href_main."include/head.php");
include($href_main."include/header.php");

$usrsi = R::getAll('SELECT id, user_id, exp FROM usersinfo ORDER BY exp DESC');

?>

<!------------------------- ГЛАВНЫЙ БЛОК ------------------------->

<section>
	<div class='rtable_header'>
		<h1>Рейтинговая таблица</h1>
	</div>
	
	<div>
		<table class='table_r_block'>
		
		<thead>
			<tr style="border-top: 0px; border-bottom: 2px solid #d8d8d8;">
				<th class="rtable_th_1" style="color: black;">#</th>
				<th style="width: 83%; padding-bottom: 10px; padding-top: 10px;">Пользователь</th>
				<th class="rtable_th_3" style="color: black;">Очки знаний</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
			$i = 1;
			foreach($usrsi as $usri){
				$user = R::load('users', $usri['user_id']);
				if($user['confirmed']){
				echo "<tr class='rtable_usr' ";
				if($i % 2 == 1)
					echo "style='background-color: #f9f9f9;' ";
				echo ">
					<th class='rtable_th_1'>$i.</th>
					<th class='rtable_th_2'><a href='../index.php?user_id=".$usri['user_id']."'>".getNameSurnameUser($user)."</a></th>
					<th class='rtable_th_3'>".$usri['exp']."</th>
				</tr>";
				$i++;
				}
			}
		?>
		</tbody>
		
		</table>
	</div>

</section>

<!--------------------- КОНЕЦ ГЛАВНОГО БЛОКА --------------------->

<?php include($href_main."include/footer.php"); ?>