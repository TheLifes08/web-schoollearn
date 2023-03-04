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

$descr = "Schoollearn.ru - образовательный интернет-ресурс, с помощью которого вы можете развивать свой интеллект и получать новые знания. На этой сайте собранны материалы по различным предметам с удобной и эффективной системой обучения.";
$keyWords = "school, learn, schoollearn, обучение, школа, скул, лерн, скуллерн";
$href_main = "";
$header_type = 1;
$include_links = array(
	array("styles/style_main.css", "stylesheet", "text/css"),
	array("img/icon.ico", "shortcut icon", "image/x-icon")
);
$include_scripts = array("jquery-3.1.0.min.js", "jQueryRotate.js", "main_script.js");

require_once $href_main."include/db.php";
$title = "Главная$title_postfix";

include($href_main."include/head.php");
include($href_main."include/header.php");

?>

<!------------------------- ГЛАВНЫЙ БЛОК ------------------------->

<section>	
	<div class="section_block_image" style="height: 364px;">
			<img id="start_main_image"src="img/start.png" />
	</div>
	
	<div class="section_block_main" style=" padding: 30px;">
		<article>
			<h1 class="header_main">Что это за сайт?</h1>
			<p class="text_main"><span style="color: #59B559;">SchoolLearn.ru</span> - образовательный интернет-ресурс для школьников. Здесь вы можете получать знания в качестве дополнительного образования, расширяя свой кругозор. На этой сайте собранны материалы по различным предметам, такие как математика, физика, информатика, с удобной системой обучения. После изучения какой-либо темы к ней прилагается практическая часть, на которой вам предстоит закрепить полученные знания. За изучение тем и выполнение заданий вам будут даваться очки знаний. Чем больше у вас очков знаний - тем больше ваш уровень. Ты можешь сравнить себя с другими: открой рейтинговую таблицу, и ты сможешь увидеть количество очков знаний у других людей, а также увидеть себя относительно их. В процессе обучение ты также сможешь получать достижения - они даются за определенные действия, совершаемые тобою. На сайте есть форум - там ты можешь обменяться знаниями с другими людьми. Еще на сайте время от времени проводятся олимпиады, так что следи за нами. Надеемся, этот сайт поможет вам с учёбой.</p>
			<p class="text_main" style="margin-top: 20px; font-size: 16pt;">И помни: <span style="color: black;"><i>"Чему бы ты ни учился, ты учишься для себя."</i></span><i> - Петроний Арбитр</i></p>
		</article>
	</div>
	
	<div class="section_block_main" style=" padding: 30px;">
		<article>
			<div class="center"><div class="flex">
				<div class="inline_block" style="margin-right: 30px;">
					<div class="prem_header_text">1. Учись</div>
					<div><img src="img/brain.png" style="margin-bottom: 10px;"/></div>
					<p class="text_main" style="text-align: center;">Курсы предметов с удобной системой обучения</p>
				</div>
				<div class="inline_block" style="margin-right: 30px;">
					<div class="prem_header_text">2. Практикуйся</div>
					<div><img src="img/mission.png" style="margin-bottom: 10px;"/></div>
					<p class="text_main" style="text-align: center;">После каждой темы закрепляй свои знания с помощью практики</p>
				</div>
				<div class="inline_block">
					<div class="prem_header_text">3. Обсуждай</div>
					<div><img src="img/social.png" style="margin-bottom: 10px;"/></div>
					<p class="text_main" style="text-align: center;">Общайся и обменивайся знаниями с другими людьми на нашем форуме</p>
				</div>
			</div></div>
		</article>
	</div>
	
	<div class="section_block_main" style=" padding: 30px;">
	<article>
		<h1 class="header_main">Помогите в развитии веб-сайта - Пройдите опрос</h1>
		<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSd09PDPmQf67gcjjldzecZ8Juwq-6t3jNB5iHiOKaI_UKvBPQ/viewform?embedded=true" width="700" height="520" frameborder="0" marginheight="0" marginwidth="0">Загрузка...</iframe>
		</article>
	</div>
	
	<?php 
	
	if(!isset($_SESSION['logged_user']))
		echo '<div class="section_block_main" style=" padding: 30px;">
			<article>
				<h1 class="header_main">Не терпится начать?</h1>
				<p class="text_main">Тогда первым делом вам следует <span class="kek_reg_daun"><a class="kek_reg" href="/php/reg/">Зарегистрироваться</a>.</p>
			</article>
		</div>';
	?>
	
</section>

<!--------------------- КОНЕЦ ГЛАВНОГО БЛОКА --------------------->

<?php include($href_main."include/footer.php"); ?>
