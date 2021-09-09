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
$include_scripts = array("jquery-3.1.0.min.js", "jQueryRotate.js", "main_script.js", "profile_scripts.js");

require_once $href_main."include/db.php";

if(isset($_GET['user_id'])){
	$user = getUser($_GET['user_id']);
	$user_info = getUserInfo($user->id);
	$title = "Профиль - ".getNameSurnameUser($user)." $title_postfix";
} else if(isset($_SESSION['logged_user'])){
	$user = getUser($_SESSION['logged_user']->id);
	$user_info = getUserInfo($user->id);
	$title = "Профиль - ".getNameSurnameUser($user)." $title_postfix";
	$yes = true;
} else {
	header("Location: http://".$_SERVER['HTTP_HOST']."/");
}

include($href_main."include/head.php");
include($href_main."include/header.php");

?>

<!------------------------- ГЛАВНЫЙ БЛОК ------------------------->

<section>
	<section class="section_block">
		<div class="profile_header">
			<div class="profile_header_img"><img class="profile_logo_pic" src="<?php echo $href_main.'img/test_profile_logo.png'; ?>" /></div>
			<div class="profile_header_name">
				<div><?=getNameSurnameUser($user)?></div>
				<div class="profile_header_name_text">Зарегистрирован <?=date_profile_convert($user->reg_date)?></div>
			</div>
			<div class="profile_header_level">
				<div class="flex">
				<div class="lvl_info">
					<div>Очков знаний: <?=$user_info->exp?></div>
					<div>Место: <?php echo getPlace($user['id']); ?></div>
					<div><span class="a_hrhrhr"><a style="color: #428bca;" href="/profile/scoretable/">Рейтинговая таблица</a><span></div>
				</div>
				<div class="lvl_block">
					<div class="lvl"><?=$user_info->lvl?></div>
					<div>УРОВЕНЬ</div>
				</div>
				</div>
			</div>
		</div>
		
		<div class="flex">
			<div class="profile_nav">
				<nav>
				<ul>
					<li name="li1" class="profile_nav_li" style="border-top: 3px solid #6c6;"><button class="butt_full" onclick="showContentProfile(1);">Профиль</button></li>
					<li name="li2" class="profile_nav_li"><button style="background-color: #F4F4F4;" class="butt_full" onclick="showContentProfile(2);">Достижения</button></li>
					<li name="li4" class="profile_nav_li"><button style="background-color: #F4F4F4;" class="butt_full" onclick="showContentProfile(4);">Задания</button></li>
					<?php
					if(($_SESSION['logged_user']->id == $_GET['user_id']) || $yes)
						echo '<li name="li3" class="profile_nav_li" style="border-bottom: 1px solid #D8D8D8;" onclick="showContentProfile(3);"><button style="background-color: #F4F4F4;" class="butt_full">Изменение профиля</button></li>';
					?>
				</ul>
				</nav>
			</div>
		
			<div class="profile_main_block">
				<div class="zag_inform_profile">О себе</div>
				<textarea class="textarea_inform_profile"><?php 
				if(($user_info->bio) != "")
					echo $user_info->bio;
				else
					echo "Этот пользователь пока ничего не написал о себе.";
				?></textarea>
				<?php 
				if($user_info->birthday != "0000-00-00")
					echo '<div class="zag_inform_profile">Дата рождения</div><div class="prof_info_line">'.date_profile_convert($user_info->birthday).'</div>';
				
				if($user_info->school != "")
				 echo '<div class="zag_inform_profile">Школа</div><div class="prof_info_line">'.$user_info->school.'</div>';
				?>
			</div>
			<div class="profile_main_block2">
				<div class="zag_inform_profile">Достижения</div>
			</div>
			<div class="profile_main_block4">
				<div class="zag_inform_profile">Выполненные задания</div>
				<?php echo get_done_tasks_info($user->id);?>
			</div>
			<div class="profile_main_block3">
				<div class="zag_inform_profile" style="border-bottom: 1px solid #d8d8d8; margin-bottom: 15px;">Редактирование профиля</div>
				
				<div>
					<label for="edit_profile_name">Имя </label>
					<input name="edit_profile_name" class="input_edit_profile" value="<?=$user->name?>"/>
				</div>
				<div>
					<label for="edit_profile_surname">Фамилия </label>
					<input name="edit_profile_surname" class="input_edit_profile" value="<?=$user->surname?>"/>
				</div>
				<div>
					<div>Дата рождения</div>
					<select class="select_day_edit_profile">
						<?php 
							$day = getDay($user_info->birthday);
							for($i = 1; $i <= 31; $i++){
								if($day == $i)
									echo "<option name='$i' selected>$i</option>";
								else
									echo "<option name='$i'>$i</option>";
							}
						?>
					</select>
					<select class="select_month_edit_profile">
						<?php
							$month = getMonth($user_info->birthday);
							$month_arr = array("","Января","Февраля","Марта","Апреля",
							"Мая","Июня","Июля","Августа","Сентября","Октября","Ноября","Декабря");
							for($i = 1; $i <= 12; $i++){
								if($month == $i)
									echo "<option name='$i' selected>$month_arr[$i]</option>";
								else
									echo "<option name='$i'>$month_arr[$i]</option>";
							}
							?>
					</select>
					<select class="select_year_edit_profile">
						<?php 
							$year = getYear($user_info->birthday);
							for($i = 2018; $i >= 1900; $i--){
								if($year == $i)
									echo "<option name='$i' selected>$i</option>";
								else
									echo "<option name='$i'>$i</option>";
							}
						?>
					</select>
				</div>
				<div>
					<label for="edit_profile_about">О себе </label>
					<textarea name="edit_profile_about" class="edit_profile_bio"><?=$user_info->bio?></textarea>
				</div>
				<div>
					<label for="edit_profile_school">Школа </label>
					<input name="edit_profile_school" class="input_edit_profile" value="<?=$user_info->school?>"/>
				</div>
				<div>
					<button id="save_butt_edit_profile" onclick="save_profile();">Сохранить</button>
				</div>
			</div>
		</div>
	</section>
</section>

<!--------------------- КОНЕЦ ГЛАВНОГО БЛОКА --------------------->

<?php include($href_main."include/footer.php"); ?>