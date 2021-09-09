<!-------------------------------------->
<!----- Шапка сайта Schoollearn.ru ----->
<!-----    (by Rodion Kolovanov)   ----->
<!-------------------------------------->

<?php
	if(!isset($header_type))
		$header_type = 1;
	
	if($header_type == 1){
		echo '
			<body>
			<header>
			<div class="fix">
			<div id="header_content">

			<div id="header_logo">
				<div class="center"><a href="'.$href_main.'" title="Перейти на главную страницу"> <img id="header_logo_img" alt="SchoolLearn" src="'.$href_main.'img/sl_logo.png"></a></div>
			</div>
	
			<nav id="header_nav">
				<ul>
					<li><a class="change_color_a" href="'.$href_main.'content/">Обучение</a></li>
					<li><a class="change_color_a" href="'.$href_main.'content/olymp/">Олимпиады</a></li>
					<li style="margin-right: 0px;"><a class="change_color_a" href="'.$href_main.'forum/">Форум</a></li>
				</ul>
			</nav>
	
			<div id="header_user">
			';
		if(!isset($_SESSION['logged_user']))
			echo '<div id="header_user_reglog">
					<a href="'.$href_main.'php/login/"><div class="text_button">Вход</div></a>
					<a href="'.$href_main.'php/reg/"><div class="text_button">Регистрация</div></a>
				</div>';
		else
			echo '<div id="header_user_logged">
					<img class="img_profile_header_up" src="'.$href_main.'img/test_profile_logo.png">
					<div id="header_user_logged_name">
					'.$_SESSION['logged_user']->name." ".$_SESSION['logged_user']->surname.'</div>
					<div class="slide_menu_profile">
						<div class="cur_pointer"><img id="arr_img_profile" src="'.$href_main.'img/profile_arr.png" style="margin-top: 20px; margin-left: 10px; border: 1px solid #404244; border-radius: 4px; padding: 2px;"></div>
					</div>
					</div><ul class="slide_menu_profile_ul" style="display: none;">
						<a href="'.$href_main.'profile/"><li>Профиль</li></a>
						<a href="'.$href_main.'profile/mytopics/"><li>Мои темы</li></a>
						<a href="'.$href_main.'profile/scoretable/"><li>Мой рейтинг</li></a>
						<a href="'.$href_main.'php/login/exit.php" style="border-top: 1px solid #272727;"><li>Выход</li></a>
					</ul></div>';
		echo '</div></div></header><div id="wrapper">';
	} else if($header_type == 2){
		echo '<body>
				<header>
				<div class="fix">
				<div class="center">

				<div id="header_logo_center">
					<a href="'.$href_main.'" title="Перейти на главную страницу"> <img id="header_logo_img" alt="SchoolLearn" src="'.$href_main.'img/sl_logo.png" /></a>
				</div>
				
				</div></div></header><div id="wrapper">';
	}
?>