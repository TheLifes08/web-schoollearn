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

$href_main = "../../../";
$header_type = 1;
$include_links = array(
	array("styles/style_main.css", "stylesheet", "text/css"),
	array("img/icon.ico", "shortcut icon", "image/x-icon")
);
$include_scripts = array("jquery-3.1.0.min.js", "jQueryRotate.js", "main_script.js", "subject_tasks_script.js");

require_once $href_main."include/db.php";
require_once $href_main."include/content.php";

$section = $_GET['section'];
$sections = array(
"Кинематика",
"Основы динамики",
"Силы в природе",
"Элементы статики",
"Законы сохранения",
"Механические колебания",
"Волны",
"Молекулярно-кинетическая теория",
"Термодинамика"
);

$section_name = $sections[$section-1];

$title = "$section_name - Физика$title_postfix";

include($href_main."include/head.php");
include($href_main."include/header.php");

///////////////////////////////
/// ПЕРЕМЕННЫЕ ДЛЯ ПРЕДМЕТА ///
///////////////////////////////

$subject = $_GET['subject'];

?>

<!------------------------- ГЛАВНЫЙ БЛОК ------------------------->

<section>

<div class="section_subject_header"><?=$section_name?> - Физика</div>

<div class="flex">
	
	<div class="left_panel_tasks_subject">
		<ul>
			<?php print_tasks_list($section, $subject); ?>
		</ul>
	</div>
	
	<div class="tasks_subject_main_body">
		<div class="tasks_subject_main_body_razd">
			<?php print_tasks_list_upper($subject, $section, 1); ?>
		</div>
		<div class="loading_task">
			<div class="cssload-circle">
			<div class="cssload-up">
				<div class="cssload-innera"></div>
			</div>
			<div class="cssload-down">
				<div class="cssload-innerb"></div>
			</div>
			</div>
			<div class="loading_text_task">Загрузка...</div>
		</div>
		<div class="tasks_subject_main_body_content">
			<?php print_subject_task($subject, $section, 1); ?>
		</div>
	</div>

</div>

</section>

<!--------------------- КОНЕЦ ГЛАВНОГО БЛОКА --------------------->

<?php include($href_main."include/footer.php"); ?>