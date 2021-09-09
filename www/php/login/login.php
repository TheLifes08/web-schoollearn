<?php
////////////////////////////////////////////////////////////////////////////
///  PHP-Движок KEnginePHP v 1.0 (by Rodion Kolovanov)                   ///
///                                                                      ///
///  Файл login.php - авторизация.                                       ///
///                                                                      ///
////////////////////////////////////////////////////////////////////////////

$href_main = "../../";

require_once $href_main."include/db.php";

$error = checkValidLogin($_POST["email"], $_POST["pass"]);

echo $error;

?>