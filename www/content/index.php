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

$href_main = "../";
$header_type = 1;
$include_links = array(
	array("styles/style_main.css", "stylesheet", "text/css"),
	array("img/icon.ico", "shortcut icon", "image/x-icon")
);
$include_scripts = array("jquery-3.1.0.min.js", "jQueryRotate.js", "main_script.js");

require_once $href_main."include/db.php";
$title = "Обучение$title_postfix";

include($href_main."include/head.php");
include($href_main."include/header.php");

?>

<!------------------------- ГЛАВНЫЙ БЛОК ------------------------->

<section>

	<section class="section_block">
		<div id="learning_choose_body_h">
			Предметы
		</div>
		<div id="learning_choose_body_list">
			<a class="a_normal" href="<?=$href_main?>content/phys/"><div class="learning_choose_body_list_pr">
				<div class="learning_choose_body_list_pr_img">
					<img src="../img/phys_icon.png" />
				</div>
				<div class="learning_choose_body_list_pr_r">
					<div>Физика</div>
				</div>
				<div class="learning_choose_body_list_pr_l">
					<?php print_stats_subject("phys"); ?>
				</div>
			</div></a>
			<!--<a class="a_normal" href="<?=$href_main?>content/math/"><div class="learning_choose_body_list_pr">
				<div class="learning_choose_body_list_pr_img">
					<img src="../img/math_icon.png" />
				</div>
				<div class="learning_choose_body_list_pr_r">
					<div>Математика</div>
				</div>
				<div class="learning_choose_body_list_pr_l">
				
				</div>
			</div></a>
			<a class="a_normal" href="<?=$href_main?>content/it/"><div class="learning_choose_body_list_pr">
				<div class="learning_choose_body_list_pr_img">
					<img src="../img/it_icon.png" />
				</div>
				<div class="learning_choose_body_list_pr_r">
					<div>Информатика</div>
				</div>
				<div class="learning_choose_body_list_pr_l">
				
				</div>
			</div></a>
			<a class="a_normal" href="<?=$href_main?>content/rus/"><div class="learning_choose_body_list_pr">
				<div class="learning_choose_body_list_pr_img">
					<img src="../img/rus_icon.png" />
				</div>
				<div class="learning_choose_body_list_pr_r">
					<div>Русский язык</div>
				</div>
				<div class="learning_choose_body_list_pr_l">
				
				</div>
			</div></a>-->
		</div>
	</section>
</section>

<!--------------------- КОНЕЦ ГЛАВНОГО БЛОКА --------------------->

<?php include($href_main."include/footer.php"); ?>