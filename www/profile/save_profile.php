<?php
////////////////////////////////////////////////////////////////////////////
///  PHP-ƒвижок KEnginePHP v 1.0 (by Rodion Kolovanov)                   ///
///                                                                      ///
///  Файл save_profile.php - сохр. проф.                                 ///
///                                                                      ///
////////////////////////////////////////////////////////////////////////////

$href_main = "../";

require_once $href_main."include/db.php";

echo save_profile($_POST['NAME'], $_POST['SURNAME'], $_POST['DATE'], $_POST['BIO'], $_POST['SCHOOL']);

?>