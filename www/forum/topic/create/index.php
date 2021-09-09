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
$include_scripts = array("jquery-3.1.0.min.js", "jQueryRotate.js", "main_script.js", "create_topic.js");

require_once $href_main."include/db.php";
$title = "Создание темы$title_postfix";

include($href_main."include/head.php");
include($href_main."include/header.php");

?>

<!------------------------- ГЛАВНЫЙ БЛОК ------------------------->

<section>
<section class="section_block">
<div id="create_topic_main">
	<div id="create_topic_header">
		<h1>Создать тему</h1>
	</div>
	
	<input type="text" name="topic_name" id="topic_name_input" placeholder="Название темы"/><br/>
	
	<textarea id="topic_desc_input" name="topic_desc" rows="10" placeholder="Сообщение"></textarea>
	
	<input id="topic_butt_input" name="create_topic_butt" type="button" value="Создать тему"/>
	
	<div style="display: none;" id="create_topic_message"></div>
</div>
</section>

<section style="height: 1px; width: 100%; margin: 0;">
</section>
</section>

<!--------------------- КОНЕЦ ГЛАВНОГО БЛОКА --------------------->

<?php include($href_main."include/footer.php"); ?>
