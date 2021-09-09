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
$title = "Физика$title_postfix";

include($href_main."include/head.php");
include($href_main."include/header.php");

///////////////////////////////
/// ПЕРЕМЕННЫЕ ДЛЯ ПРЕДМЕТА ///
///////////////////////////////

$subject = "phys";

?>

<!------------------------- ГЛАВНЫЙ БЛОК ------------------------->

<section>

<div class="big_section_subject">
	<div class="big_section_subject_title">
		<span>МЕХАНИКА</span>
	</div>
	<div class="big_section_subject_body">
		<div class="flex">

		<a href="<?=$href_main?>content/phys/section/index.php?subject=phys&section=1" class="a_normal"><div class="section_subject">
			<div class="section_subject_img">
				<img src="<?=$href_main?>img/phys/1.png" />
			</div>
			<div class="section_subject_title">
				<span class="center">КИНЕМАТИКА</span>
			</div>
		</div></a>
		
		<a href="<?=$href_main?>content/phys/section/index.php?subject=phys&section=2" class="a_normal"><div class="section_subject">
			<div class="section_subject_img">
				<img src="<?=$href_main?>img/phys/2.png" />
			</div>
			<div class="section_subject_title">
				<span class="center">ДИНАМИКА</span>
			</div>
		</div></a>
		
		<a href="<?=$href_main?>content/phys/section/index.php?subject=phys&section=3" class="a_normal"><div class="section_subject">
			<div class="section_subject_img">
				<img src="<?=$href_main?>img/phys/3.png" />
			</div>
			<div class="section_subject_title">
				<span class="center">СТАТИКА</span>
			</div>
		</div></a>
		</div>
		
	</div>
</div>

<div class="big_section_subject">
	<div class="big_section_subject_title">
		<span>МОЛЕКУЛЯРНАЯ ФИЗИКА И ТЕРМОДИНАМИКА</span>
	</div>
	<div class="big_section_subject_body">
		<div class="flex">

		<a href="<?=$href_main?>content/phys/section/index.php?subject=phys&section=8" class="a_normal"><div class="section_subject">
			<div class="section_subject_img">
				<img src="<?=$href_main?>img/phys/4.png" />
			</div>
			<div class="section_subject_title">
				<span class="center">ОСНОВНЫЕ ПОЛОЖЕНИЯ МКТ</span>
			</div>
		</div></a>
		
		<a href="<?=$href_main?>content/phys/section/index.php?subject=phys&section=9" class="a_normal"><div class="section_subject">
			<div class="section_subject_img">
				<img src="<?=$href_main?>img/phys/5.png" />
			</div>
			<div class="section_subject_title">
				<span class="center">ТЕРМОДИНАМИКА</span>
			</div>
		</div></a>
	
		</div>
	</div>
</div>

</section>

<!--------------------- КОНЕЦ ГЛАВНОГО БЛОКА --------------------->

<?php include($href_main."include/footer.php"); ?>