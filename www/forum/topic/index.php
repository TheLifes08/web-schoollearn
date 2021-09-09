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
$include_scripts = array("jquery-3.1.0.min.js", "jQueryRotate.js", "main_script.js", "topic_scripts.js");

require_once $href_main."include/db.php";

$topic = getTopic($_GET['topic_id']);
$title = "$topic->name$title_postfix";

include($href_main."include/head.php");
include($href_main."include/header.php");

///////////////////////////
/// Переменные для темы ///
///////////////////////////

$main_mess = getMainMess($topic->id);
$author = R::load('users', $topic->author_id);

$topic->views = $topic->views + 1;
$close = $topic->close;

R::store($topic);

?>

<!------------------------- ГЛАВНЫЙ БЛОК ------------------------->

<section>
<section class="section_block" style="margin-bottom: 0px; border: 1px solid #d8d8d8;">
	<div id="topic_main_block">
		<div id="topic_main_block_name">
			<h1><?php echo $topic->name; echo " ";
				if($topic->close == 1)
					echo "<span style='color: #CD5A48;'>(Тема закрыта)</span>";
			?></h1>
			<div id="topic_main_block_name_inf">Тема создана: 
			<?php 
				echo "$topic->date, пользователем ".getNameSurnameUser($author);
			?></div>
		</div>
		<div id="topic_main_block_messau">
			<div id="topic_main_author_st">
				<?php printUserHtml($author, " пишет: ");  ?>
			</div>
			<div id="topic_main_block_mess">
				<?php echo $main_mess->text; ?>
			</div>
		</div>
		<?php
			if(!$close)
				echo '<div id="topic_main_block_panel_anw_butt"><div class="cur_pointer">Ответить</div></div>';
		?>
		<div id="topic_main_block_panel">
			<div id="topic_main_block_panel_info">
				<span>Просмотров: <?php echo $topic->views; ?>, </span>
				<span>Сообщений в теме: <?php echo $topic->anwsers; ?></span>
			</div>
		</div>
	</div>
	<div id="topic_anwser_block">
		<div class="topic_anwser_block_header"><span>Ответить: </span></div>
		<?php
			if(isset($_SESSION['logged_user']))
				echo
					'<div id="topic_anwser_block_ta_div"><textarea id="topic_anwser_block_ta"></textarea></div>
					<div id="topic_anwser_block_butt"><div class="cur_pointer">Отправить сообщение</div></div>';
			else
				echo '<div class="non_auth">Вы должны <a href="'.$href_main.'php/login/">авторизоваться</a>, чтобы ответить.</div>';
		?>
	</div>
	<div id="topic_anwser_block2">
		<div class="topic_anwser_block_header"><span>Ответить: </span></div>
		<?php
			if(isset($_SESSION['logged_user']))
				echo
					'<div id="selected_mess"></div>
					<div id="topic_anwser_block_ta_div"><textarea id="topic_anwser_block_ta2"></textarea></div>
					<div id="topic_anwser_block_butt2"><div class="cur_pointer">Отправить сообщение</div></div>';
			else
				echo '<div class="non_auth">Вы должны <a href="'.$href_main.'php/login/">авторизоваться</a>, чтобы ответить.</div>';
		?>
	</div>
</section>

<section class="section_block" style="margin-top: 5px;">
	<div id="topic_anwsers_block">
		<div id="topic_anwsers_block_header"><h1>Ответы</h1></div>
		<div id="topic_anwsers_block_body">
		<?php
			print_html_anwsers($topic->id);
		?>
		</div>
	</div>
</section>
</section>

<!--------------------- КОНЕЦ ГЛАВНОГО БЛОКА --------------------->

<?php include($href_main."include/footer.php"); ?>