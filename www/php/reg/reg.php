<?php
////////////////////////////////////////////////////////////////////////////
///  PHP-Движок KEnginePHP v 1.0 (by Rodion Kolovanov)                   ///
///                                                                      ///
///  Файл reg.php - регистрация.                                         ///
///                                                                      ///
////////////////////////////////////////////////////////////////////////////

$href_main = "../../";

require_once $href_main."include/db.php";
	
$error = checkValidReg($_POST["email"], $_POST["pass"], $_POST["name"], $_POST["surname"]);

echo $error;

?>