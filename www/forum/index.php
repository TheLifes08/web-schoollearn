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
$include_scripts = array("jquery-3.1.0.min.js", "jQueryRotate.js", "main_script.js", "topic_scripts.js");

require_once $href_main."include/db.php";
$title = "Форум$title_postfix";

include($href_main."include/head.php");
include($href_main."include/header.php");

/////////////////////////////////////////////
///     ПЕРЕМЕННЫЕ ДЛЯ ФОРУМА             ///
/////////////////////////////////////////////


?>

<!------------------------- ГЛАВНЫЙ БЛОК ------------------------->

<section id="forum_content">

	<section class="section_block_main" style="margin-bottom: 10px;">
	<div class="flex">
		<div id="forum_header">
			<div class="forum_header_l">
				<div class="flex">
					<div class="inline_block"><input class="input_forum_search" placeholder="Поиск" /></div>
					<div class="search_butt" onclick="search();"><img class="search_icon" src="<?=$href_main?>img/search.svg"></div>
					<div class="select_form_search"><select class="select_form_search_main" onchange="change_sorting();">
						<option value="1">По просмотрам</option>
						<option value="2">По ответам</option>
						<option value="3">Самые новые</option>
						<option value="4">Самые старые</option>
					</select></div>
				</div>
			</div>
			<div class="forum_header_r">
				<div class="inline_block"><a href="/profile/mytopics/"><div id="my_topics_button"><span style="border-bottom: 1px dotted #222;">Мои темы<span></div></a></div>
				<div class="inline_block"><a href="/forum/topic/create/"><div id="add_topic_button">+ Создать тему</div></a></div>
			</div>
		</div>
	</div>
	</section>
	
	<section class="section_block" style="margin-top: 10px;">
		<div id="forum_body">
			<div id="forum_body_header">
				Темы
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
			<div id="forum_body_topics">
			</div>
			
			<span class="center"><div id="forum_body_str">
				<div style="margin-bottom: 4px; color: black; font-size: 12pt;">Страница </div>
				<div id="forum_body_str_nums">
				</div>
			</div></span>
		</div>
	</section>

</section>

<!--------------------- КОНЕЦ ГЛАВНОГО БЛОКА --------------------->

<?php include($href_main."include/footer.php"); ?>
