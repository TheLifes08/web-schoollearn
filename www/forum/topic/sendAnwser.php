<?php
////////////////////////////////////////////////////////////////////////////
///  PHP-Движок KEnginePHP v 1.0 (by Rodion Kolovanov)                   ///
///                                                                      ///
///  Файл sendAnwser.oho - отправка ответа.                              ///
///                                                                      ///
////////////////////////////////////////////////////////////////////////////

$href_main = "../../";

require_once $href_main."include/db.php";

$error = sendAnwser($_POST["anwser"], $_POST["topic"],$_SESSION['logged_user']->id);

echo $error;

?>