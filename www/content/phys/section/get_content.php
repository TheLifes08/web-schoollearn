<?php

$href_main = "../../../";

require_once $href_main."include/db.php";

$md = $_POST['MODE'];

if($md == 1)
	echo get_subject_task($_POST["SUBJECT"], $_POST["SECTION"], $_POST["RAZDEL_NUM"]);
else if($md == 2)
	echo get_tasks_list_upper($_POST["SUBJECT"], $_POST["SECTION"], $_POST["RAZDEL_NUM"]);
else if($md == 3)
	echo get_full_task($_POST["SUBJECT"], $_POST["SECTION"], $_POST["RAZDEL_NUM"], $_POST["TASK"]);

?>