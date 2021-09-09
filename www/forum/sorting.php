<?php
////////////////////////////////////////////////////////////////////////////
///  PHP-ƒвижок KEnginePHP v 1.0 (by Rodion Kolovanov)                   ///
///                                                                      ///
///  Файл soring.php - вывод тем сортир.                                 ///
///                                                                      ///
////////////////////////////////////////////////////////////////////////////

$href_main = "../";

require_once $href_main."include/db.php";

if(isset($_POST['TYPE']))
	$type = $_POST['TYPE'];
else
	$type = 1;

if(isset($_POST['SEARCH'])){
	$search = $_POST['SEARCH'];
	$is_search = true;
} else {
	$is_search = false;
	$search = "";
}

$str_num = get_forum_str_num();
$topics_num = get_forum_topics_num();

echo print_html_topics($topics_num, $str_num, $type, $is_search, $search);

?>