<?php
////////////////////////////////////////////////////////////////////////////
///  PHP-Движок KEnginePHP v 1.0 (by Rodion Kolovanov)                   ///
///                                                                      ///
///  Файл sl_functions.php - Здесь храняться основные функции движка     /// 
///  KEnginePHP                                                          ///  
///                                                                      ///
///  Функции:                                                            ///
///  После добавятся                                                     ///
///                                                                      ///
////////////////////////////////////////////////////////////////////////////

function print_html_pages($pages_num, $str_num, $class1, $class2){
	if($pages_num <= 7){
		for($j = 1; $j <= $pages_num; $j++){
			if($j == $str_num)
				echo "<a class='$class2'>$j </a>";
			else
				if($j == 1)
					echo "<a class='$class1' href='/forum/index.php'>$j </a>";
				else 
					echo "<a class='$class1' href='/forum/index.php?page=$j'>$j </a>";
		}
	} else {
		if($str_num < 5){
			for($k = 1; $k <= 5; $k++)
				if($k == $str_num)
					echo "<a class='$class2'>$k </a>";
				else
					echo "<a class='$class1' href='/forum/index.php?page=$k'>$k </a>";
								
					echo "<a class='$class1' href='/forum/index.php?page=6'>6 </a>
						<span>... </span>
						<a class='$class1' href='/forum/index.php?page=$pages_num'>$pages_num</a>";
		} else if($str_num > $pages_num-4){
			echo "
				<a class='$class1' href='/forum/index.php'>1 </a>
				<span>... </span>
				<a class='$class1' href='/forum/index.php?page=".($pages_num-5)."'>".($pages_num-5)." </a>";
			for($l = ($pages_num-4); $l <= $pages_num; $l++)
				if($l == $str_num)
					echo "<a class='$class2'>$l </a>";
				else
					echo "<a class='$class1' href='/forum/index.php?page=$l'>$l </a>";
		} else {
			echo "
				<a class='$class1' href='/forum/index.php'>1 </a>
				<span>... </span>
				<a class='$class1' href='/forum/index.php?page=".($str_num-2)."'>".($str_num-2)." </a>
				<a class='$class1' href='/forum/index.php?page=".($str_num-1)."'>".($str_num-1)." </a>
				<a class='$class2'>".$str_num." </a>
				<a class='$class1' href='/forum/index.php?page=".($str_num+1)."'>".($str_num+1)." </a>
				<a class='$class1' href='/forum/index.php?page=".($str_num+2)."'>".($str_num+2)." </a>
				<span>... </span>
				<a class='$class1' href='/forum/index.php?page=$pages_num'>$pages_num</a>
				";
		}
	}
}

function print_html_topics($topics_num, $str_num, $type, $is_search, $search){
	$last_topic_id = $topics_num - (10 * ($str_num - 1));
	if(!isset($is_search))
		$is_search = false;
	
	if(0){ //$is_search
		
	} else {
		if($type == 1)
			$ids = R::GetCol('SELECT id FROM forum ORDER BY views');
		else if($type == 2)
			$ids = R::GetCol('SELECT id FROM forum ORDER BY anwsers');
		else if($type == 3)
			$ids = R::GetCol('SELECT id FROM forum');
		else if($type == 4)
			$ids = R::GetCol('SELECT id FROM forum ORDER BY date DESC');
	}
	
	if(isset($ids)){
	for($i = $last_topic_id-1; $i > ($last_topic_id-11); $i--){
		if($i < 0)
			continue;
		
		if($ids[$i] <= 0)
			break;
		
		$topc = R::load('forum', $ids[$i]);
		$author = R::load('users', $topc['author_id']);
		$lst_usr = R::load('users', $topc['last_post_user_id']);
		$topic_href = "/forum/topic/index.php?topic_id=".$ids[$i];
					
		$topc_name = $topc["name"];
		
		if($topc->close)
			$tpc_cls = "class='topic_right_c'>Тема закрыта";
		else
			$tpc_cls = "class='topic_right_o'>Тема открыта";
					
		echo '<a class="topic_a" href="'.$topic_href.'"><div class="forum_topic_article">
			<div class="topic_left">
			<div class="article_topic">'.$topc_name.'</div>
			<div class="article_info">
			<span>Последнее сообщение: '.$topc["last_update"].', '.$lst_usr["name"].' '.$lst_usr["surname"].'</span>
			<span style="float: right; margin-right: 15px;">Автор: '.$author["name"].' '.$author["surname"].'</span></div></div>			
			<div class="topic_right">
			<div class="topic_right_views">Просмотры: '.$topc["views"].'</div>
			<div class="topic_right_comments">Ответы: '.$topc["anwsers"].'</div>
			<div '.$tpc_cls.'</div></div></div></a>';
	}}
	echo '<div class="border_up"></div>';
}

function get_forum_str_num(){
	if(isset($_GET['page']))
		return $_GET['page'];
	else	
		return 1;
}

function get_forum_topics_num(){	
	return count(R::GetCol('SELECT id FROM forum'));
}

function get_forum_pages_num($topics_num){
	if($topics_num % 10 == 0)
		return $topics_num / 10;
	else
		return ((integer)($topics_num / 10) + 1);
}

function connectDB($db_host, $db_name, $db_user, $db_pass){
	R::setup("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
}

function findUser($email){
	return R::findOne('users', 'email = ?', array($email));
}

function findUserIdByEmail($email){
	$user = R::findOne('users', 'email = ?', array($email));
	return $user->id;
}

function getUser($id){
	return R::load('users', $id);
}

function getTopic($id){
	return R::load('forum', $id);
}

function getMessIds($id){
	return R::GetCol("SELECT id FROM forump WHERE topic = $id ORDER BY date");
}

function getMainMess($topic_id){
	$mess_id = R::getCell('SELECT id FROM forump WHERE topic = '.$topic_id);
	return R::load('forump', $mess_id);
}

function getUserInfo($user_id){
	return R::findOne('usersinfo', 'user_id = ?', array($user_id));
}

function multiplyMD5Hash($str, $kol){
	$result = $str;
	
	for($i = 1; $i <= $kol; $i++){
		$result = md5($result);
	}
	
	return $result;
}

function checkValidLogin($email, $pass){
	$user = findUser($email);
	$pass = multiplyMD5Hash($pass, 2);	
	
	if(!$user)
		$error = "kek";
	else if($pass != ($user->password))
		$error = "kek";
	else if($user->confirmed == 0)
		$error = "kek2";
	else {
		$error = "ok";
		$_SESSION['logged_user'] = $user;
	}
	
	return $error;
}

function generateConfirmID($length = 8){
	$chars = 'abcdefghijklmnopqrstwxyzABCDEFGHIJKLMNOPQRSTWXYZ1234567890';
	$numChars = strlen($chars);
	$string = "";
		
	for ($i = 0; $i < $length; $i++)
		$string .= substr($chars, rand(1, $numChars) - 1, 1);
	return $string;
}

function checkValidReg($email, $pass, $name, $surname){
	if(R::count('users', 'email = ?', array($email)) > 0)
		$error = "error2";
	else {
		$confirmID = generateConfirmID(20);
		
		while(R::count('users', 'activation_id = ?', array($confirmID)) > 0){
			$confirmID = generateConfirmID(20);
		}
		$error = "ok";
		
		$user = R::dispense('users');
		$user->email = $email;
		$user->password = multiplyMD5Hash($pass, 2);
		$user->name = $name;
		$user->surname = $surname;
		$user->reg_date = date("Y-m-d");
		$user->confirmed = 0;
		$user->activation_id = $confirmID;
		
		R::store($user);
		
		$user_info = R::dispense('usersinfo');
		$user_info->user_id = findUserIdByEmail($email);
		
		R::store($user_info);
			
		mail("$email", "Регистрация SchoolLearn", "Для продолжение регистрации перейдите по этой ссылке: http://schoolearn.s06.wh1.su/php/reg/confirm/index.php?account_id=".$confirmID);
	} 
	return $error;
}

function createTopic($topic_name, $topic_message){
	if(!isset($_SESSION["logged_user"]->id))
		$error = "error1";
	else if(R::count('forum', 'name = ?', array($topic_name)) > 0)
		$error = "error2";
	else {
		$new_topic = R::dispense('forum');
		$new_message = R::dispense('forump');
	
		$date_now = date("Y-m-d H:i:s");
		$user_id_now = $_SESSION["logged_user"]->id;
	
		$new_topic["date"] = $date_now;
		$new_topic->name = $topic_name;
		$new_topic->author_id = $user_id_now;
		$new_topic->last_post_user_id = $user_id_now;
		$new_topic->last_update = $date_now;
	
		R::store($new_topic);
		$arr = R::getCol('SELECT id FROM forum ORDER BY id DESC LIMIT 1');
		$new_message->topic = $arr[0];
		$new_message["date"] = $date_now;
		$new_message->text = $topic_message;
		$new_message->author_id = $user_id_now;
	
		R::store($new_message);
	}
	
	return $error;
}

function printUserHtml($user, $str){
	echo '<div id="topic_main_block_author">
			<div class="inline_block"><img src="/img/test_profile_logo.png" /></div>
			<div id="topic_main_block_author_name" style="color: #428bca; margin-top: 6px; font-size: 12pt;"><a class="a_blue" href="/profile/index.php?user_id='.$user->id.'">'.getNameSurnameUser($user).'</a><span style="color: black;">'.$str.'</span></div>
		</div>';
}

function getUserHtml($user, $str, $date){
	if(isset($date))
		return '<div id="topic_main_block_author">
			<div class="inline_block"><img src="/img/test_profile_logo.png" /></div>
			<div id="topic_main_block_author_name">
				<div style="color: #428bca;"><a class="a_blue" href="/profile/index.php?user_id='.$user->id.'">'.getNameSurnameUser($user).'</a>'.$str.'</div>
				<div style="font-size: 12px; color: #3C3C3C;">'.$date.'</div>
			</div>
		</div>';
	else
		return '<div id="topic_main_block_author">
			<div class="inline_block"><img src="/img/test_profile_logo.png" /></div>
			<div id="topic_main_block_author_name">
				<div style="color: #428bca; margin-top:3px; font-size: 14pt;"><a class="a_blue" href="/profile/index.php?user_id='.$user->id.'">'.getNameSurnameUser($user).'</a>'.$str.'</div>
			</div>
		</div>';
}

function print_html_anwsers($topic_id){
	$ids = getMessIds($topic_id);
	$checking = true;
	
	foreach($ids as $id){
		if($id == $ids[0])
			continue;
		
		$checking = false;
		$anwser = R::load('forump', $id);
		$author = R::load('users', $anwser->author_id);
		
		echo "<div><div class='topic_main_block_messauc' name='blocl_mess_anw".$id."'>
				<div class='topic_main_author_stc'>
					".getUserHtml($author, '', date_convert($anwser->date))."
				</div>
				<div name='anw".$id."' class='topic_main_block_messc'>
					".$anwser->text."
				</div>
				</div>
				<div class='topic_main_block_ans'><button class='topic_main_block_ans_butt' onclick='setAnwserId(".$id."); showAnwserDiv2();'>Ответить</button></div>
			</div>";
	}
	
	if($checking)
		echo '<div class="poka_net_otv">На данный момент ответов пока нет</div>';
}

function getNameSurnameUser($user){
	return "$user->name $user->surname";
}

function sendAnwser($text, $topic_id, $user_id){
	$anwser = R::dispense('forump');
	
	$anwser->topic = $topic_id;
	$anwser["date"] = date("Y-m-d H:i:s");
	$anwser->text = $text;
	$anwser->author_id = $user_id;
	
	R::store($anwser);
	
	$topic = getTopic($topic_id);
	$topic->anwsers++;
	
	R::store($topic);
	
	return "";
}

function date_convert($date){
	$y = (int)($date[0].$date[1].$date[2].$date[3]);
	$m = (int)($date[5].$date[6]);
	$d = (int)($date[8].$date[9]);
	$h = (int)($date[11].$date[12]);
	$min = (int)($date[14].$date[15]);
	$s = (int)($date[17].$date[18]);
	$mon = "";
	$result = $d;
	
	switch($m){
		case 1: $mon = " Января "; break;
		case 2: $mon = " Февраля "; break;
		case 3: $mon = " Марта "; break;
		case 4: $mon = "Апреля "; break;
		case 5: $mon = " Мая "; break;
		case 6: $mon = " Июня ";break;
		case 7: $mon = " Июля ";break;
		case 8: $mon = " Августа ";break;
		case 9: $mon = " Сентября ";break;
		case 10: $mon = " Октября ";break;
		case 11: $mon = " Ноября ";break;
		case 12: $mon = " Декабря ";break;
	}
	
	$result = $result." ".$mon.$y.", в ".$h.":".$min.":".$s;
	
	return $result;
}

function date_profile_convert($date){
	$y = (int)($date[0].$date[1].$date[2].$date[3]);
	$m = (int)($date[5].$date[6]);
	$d = (int)($date[8].$date[9]);
	
	switch($m){
		case 1: $mon = " Января "; break;
		case 2: $mon = " Февраля "; break;
		case 3: $mon = " Марта "; break;
		case 4: $mon = " Апреля "; break;
		case 5: $mon = " Мая "; break;
		case 6: $mon = " Июня ";break;
		case 7: $mon = " Июля ";break;
		case 8: $mon = " Августа ";break;
		case 9: $mon = " Сентября ";break;
		case 10: $mon = " Октября ";break;
		case 11: $mon = " Ноября ";break;
		case 12: $mon = " Декабря ";break;
	}
	
	$result = $d." ".$mon.$y;
	
	return $result;
}

function getDay($date){
	return (int)($date[8].$date[9]);
}

function getMonth($date){
	return (int)($date[5].$date[6]);
}

function getYear(){
	return (int)($date[0].$date[1].$date[2].$date[3]);
}

function save_profile(){
	if(isset($_SESSION["logged_user"]->id)){
		$id = $_SESSION["logged_user"]->id;
		$user = R::load('users', $id);
		$info_id = R::getCell("SELECT id FROM usersinfo WHERE user_id=$id");
		$user_info = R::load('usersinfo', $info_id);
	
		$user->name = $_POST['NAME'];
		$user->surname = $_POST['SURNAME'];
		$user_info->birthday = $_POST['DATE'];
		$user_info->bio = $_POST['BIO'];
		$user_info->school = $_POST['SCHOOL'];
	
		R::store($user);
		R::store($user_info);
		$error = "";
	} else
		$error = "error1";
	
	return $error;
}

function print_tasks_list($section, $subject){
	$tasks = R::getAssoc("SELECT id, theory_id, task_title, title_num, is_base FROM theory WHERE section='$section' AND subject='$subject'");
	foreach($tasks as $task){
		if($task['is_base'])
			echo "<li style='border-top: 1px solid #D8D8D8; border-bottom: 3px solid #65CD65;'><button style='min-height: 48px; font-weight: bold; text-align: left;' class='butt_full' onclick='underline_buttns(this); showContentTasks(\"".$subject."\",".$section.", ".$task['theory_id'].");'>".$task['title_num']." ".$task['task_title']."</button></li>";
		else
			echo "<li><button class='butt_full' style='min-height: 48px; text-align: left;' onclick='underline_buttns(this); showContentTasks(\"".$subject."\",".$section.", ".$task['theory_id'].");'>".$task['title_num']." ".$task['task_title']."</button></li>";
	}
}

function print_subject_task($subject, $section, $task_num){
	$tasks = R::getAssoc("SELECT id, theory_id, task_text, task_title FROM theory WHERE section='$section' AND subject='$subject'");
	$i = 1;
	foreach($tasks as $task){
		if($i == $task_num){
			echo "<h2 style='margin-bottom: 10px;'>".$task['task_title']."</h2><div>".$task['task_text']."</div>";
			break;
		} else
			$i++;
	}
}

function get_subject_task($subject, $section, $task_num){
	$tasks = R::getAssoc("SELECT id, theory_id, task_text, task_title FROM theory WHERE section='$section' AND subject='$subject'");
	$i = 1;
	foreach($tasks as $task){
		if($i == $task_num){
			return "<h2 style='margin-bottom: 10px;'>".$task['task_title']."</h2><div>".$task['task_text']."</div>";
			break;
		} else
			$i++;
	}
}

function print_tasks_list_upper($subject, $section, $task_num){
	$tasks = R::getCol("SELECT id FROM tasks WHERE task_section='$section' AND task_subject='$subject' AND task_section_num='$task_num'");
	echo '<div class="tasks_subject_main_body_razd_butt"><button onclick="change_content(\''.$subject.'\', '.$section.', '.$task_num.')">?</button></div>';
	$num = sizeof($tasks);
	for($i = 1; $i <= $num; $i++){
		echo '<div class="tasks_subject_main_body_razd_butt"><button onclick="change_content(\''.$subject.'\', '.$section.', '.$task_num.', '.$i.')">'.$i.'</button></div>';
	}
}

function get_tasks_list_upper($subject, $section, $task_num){
	$tasks = R::getCol("SELECT id FROM tasks WHERE task_section='$section' AND task_subject='$subject' AND task_section_num='$task_num'");
	$text = '<div class="tasks_subject_main_body_razd_butt"><button onclick="change_content(\''.$subject.'\', '.$section.', '.$task_num.')">?</button></div>';
	$num = sizeof($tasks);
	for($i = 1; $i <= $num; $i++){
		$text = $text.'<div class="tasks_subject_main_body_razd_butt"><button onclick="change_content(\''.$subject.'\', '.$section.', '.$task_num.', '.$i.')">'.$i.'</button></div>';
	}
	
	return $text;
}

function print_my_topic($topic, $id){
	$topic_href = "/forum/topic/index.php?topic_id=$id";
	$author = R::load('users', $_SESSION['logged_user']->id);
	$lst_usr = R::load('users', $topic['last_post_user_id']);
	$dop = "";
	
	if($topic['close']){
		$tpc_cls = "class='topic_right_c'>Тема закрыта";
		$dop = "margin-bottom: 40px;";
	} else
		$tpc_cls = "class='topic_right_o'>Тема открыта";
	
	echo '<a class="topic_a" href="'.$topic_href.'"><div class="forum_topic_article" style="'.$dop.' border: 1px solid #AFAFAF;">
			<div class="topic_left">
			<div class="article_topic">'.$topic['name'].'</div>
			<div class="article_info">
			<span>Последнее сообщение: '.$topic["last_update"].', '.$lst_usr["name"].' '.$lst_usr["surname"].'</span>
			<span style="float: right; margin-right: 15px;">Автор: '.$author["name"].' '.$author["surname"].'</span></div></div>			
			<div class="topic_right">
			<div class="topic_right_views">Просмотры: '.$topic["views"].'</div>
			<div class="topic_right_comments">Ответы: '.$topic["anwsers"].'</div>
			<div '.$tpc_cls.'</div>';
	echo '</div></div></a>';
	if(!($topic['close']))	
		echo '<button class="butt_close_topic" onclick="close_topic('.$id.')">Х Закрыть тему</button>';
}

function print_my_topics($id){
	$mytopics = R::getAssoc("SELECT date, close, name, author_id, last_post_user_id, last_update, views, anwsers FROM forum WHERE author_id=$id ORDER BY close");
	$ids = R::GetCol("SELECT id FROM forum WHERE author_id=$id");
	$i = 0;
	
	foreach($mytopics as $topic){
		print_my_topic($topic, $ids[$i]);
		$i++;
	}
	
	if($i <= 0)
		echo '<div style="margin-left: 10px;">На данный момент у вас нет созданных тем.</div>';
}

function get_full_task($subject, $section, $task_num, $task){
	$query = "SELECT * FROM tasks WHERE task_section='$section' AND task_subject='$subject' AND task_section_num='$task_num' AND task_number='$task'";
    $tsk = R::getRow($query);
	$anws = R::getRow("SELECT * FROM anwsers WHERE user_id='".$_SESSION['logged_user']->id."' AND task_id='".$tsk['id']."'");
	echo "<div class='task_text_div'>".$tsk['task_text']."</div>";
	echo "<div class='task_anwsers_div'>".$tsk['task_anwsers']."</div>";
	echo "<div class='task_mess_done' style='display: none;'></div>";
	
	if(!isset($anws))
		echo "<div class='task_button_div'><button onclick='send_anwser(\"$subject\", $section, $task_num, $task, ".$tsk['anwser_type'].");'>Ответить</button></div>";
	else
		echo "<div class='task_mess_done'>Правильный ответ.</div>";
}

function check_task($subject, $section, $task_num, $task, $anwser){
	if(!isset($_SESSION['logged_user']))
		return "error1";
	
	if(!isset($anwser))
		return "error2";
	
	$query = "SELECT * FROM tasks WHERE task_section='$section' AND task_subject='$subject' AND task_section_num='$task_num' AND task_number='$task'";
	$tsk = R::getRow($query);
	$anws_chk = R::getRow("SELECT * FROM anwsers WHERE user_id='".$_SESSION['logged_user']->id."' AND task_id='".$tsk['id']."'");
	
	if($anwser == $tsk["right_anwser"] && !isset($anws_chk)){
		$anws = R::dispense('anwsers');
		$anws->user_id = $_SESSION['logged_user']->id;
		$anws->task_id = $tsk['id'];
		R::store($anws);
		
		$u_id = R::getCell("SELECT id FROM usersinfo WHERE user_id='".$_SESSION['logged_user']->id."'");
		$usr = R::load('usersinfo', $u_id);
		
		$usr['exp'] += $tsk['expr'];
		
		while($usr->lvl < ((float)$usr->exp / 100.0))
			$usr->lvl++;
		
		R::store($usr);
		
		return "success";
	} else {
		return "bad";
	}
}

function print_stats_subject($subj){
	$tsks = R::getAssoc("SELECT id FROM tasks WHERE task_subject='".$subj."'");
	$i = 0;
	$id = $_SESSION['logged_user']->id;
	
	foreach($tsks as $tsk){
		$kek = R::getRow("SELECT * FROM anwsers WHERE user_id='".$id."' AND task_id='".$tsk['id']."'");
		if(isset($kek))
			$i++;
	}
	
	$all = count($tsks);
	$pr = $i / $all * 100;
	
	echo '<div>
		<span style="margin-left: 75px;">'.(integer)$pr.'%</span>
		<div class="progress_bar_s"><div class="prbar_s_gr" style="width: '.$pr.'%;"></div></div>
	</div>';
	echo "<div class='kolvo_zadan'>Выполнено: ".$i." / ".$all."</div>";
}

function getPlace($id){
	$usrs = R::getAssoc('SELECT id, user_id FROM usersinfo ORDER BY exp DESC');
	$i = 1;
	
	foreach($usrs as $usr){
		if($usr == $id)
			break;
		else
			$i++;
	}
	
	return $i;
}

function close_topic($id){
	$topic = R::load('forum', $id);
	$topic->close = 1;
	R::store($topic);
}

function get_done_tasks_info($id){
	
}

?>