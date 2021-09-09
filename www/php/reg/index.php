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
$include_scripts = array("jquery-3.1.0.min.js", "reg_script.js", "main_script.js");

require_once $href_main."include/db.php";
$title = "Регистрация$title_postfix";

include($href_main."include/head.php");
include($href_main."include/header.php");

?>

<!------------------------- ГЛАВНЫЙ БЛОК ------------------------->

<section class="section_block_reg">

<div id="reg_content">
	<span class="center">
		<span id="reg_text">
			<span class="center"><h1 id="h1_reg_text">Регистрация</h1></span>
		</span>
	</span>
	
	<span class="center">
	<div name="reg_form" id="reg_form"> 
		<input type="text" name="reg_name" class="input_form_reg" placeholder="Имя"/>
		<input type="text" name="reg_surname" class="input_form_reg" placeholder="Фамилия"/>
		<input type="text" name="reg_email" class="input_form_reg" placeholder="Email"/>
		<input type="password" name="reg_pass" class="input_form_reg" placeholder="Пароль"/>
		<input type="password" name="reg_repass" class="input_form_reg" placeholder="Повторите пароль"/>
		<a href="#"><input type="button" name="done" id="input_form_reg_button" value="Зарегистрироваться" /></a>
	</div>
	</span>
</div>

<span class="center">
	<div style="display: none;" id="reg_message"></div>
</span>

</section>

<!--------------------- КОНЕЦ ГЛАВНОГО БЛОКА --------------------->

<?php include($href_main."include/footer.php"); ?>