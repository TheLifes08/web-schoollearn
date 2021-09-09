<?php
////////////////////////////////////////////////////////////////////////////
///  PHP-Движок KEnginePHP v 1.0 (by Rodion Kolovanov)                   ///
///                                                                      ///
///  Файл create.php - создание темы.                                    ///
///                                                                      ///
////////////////////////////////////////////////////////////////////////////

$href_main = "../../../";

require_once $href_main."include/db.php";
	
$error = createTopic($_POST["topic_name"], $_POST["topic_desc"]);
	
echo $error;

?>