<?php

$href_main = "../../../";

require_once $href_main."include/db.php";

echo check_task($_POST["SUBJECT"], $_POST["SECTION"], $_POST["RAZDEL_NUM"], $_POST["TASK"], $_POST["ANWSER"]);

?>