<?php
$sort_path = $_SERVER['SCRIPT_NAME'];
//	$sort_path = str_replace('/index.php','', $sort_path);
$sort_path = (preg_replace('/\/[a-zA-Z0-9\_]+\.php/i', '', $sort_path));

// lấy folder administrator
$pos = strripos($sort_path, '/');
$folder_admin = substr($sort_path, ($pos + 1));


define('URL_ROOT', "https://" . $_SERVER['HTTP_HOST'] . str_replace($folder_admin, '', $sort_path));
define('URL_ROOT_REDUCE', str_replace($folder_admin, '', $sort_path));
define('URL_ROOT_ADMIN', str_replace('/', '', $sort_path) . '/');

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
$path = $_SERVER['SCRIPT_FILENAME'];
$path = str_replace('index.php', '', $path);
$path = str_replace('index2.php', '', $path);
$path = str_replace('/', DS, $path);
$path = str_replace('\\', DS, $path);
$path = str_replace(DS . $folder_admin . DS, DS, $path);

define('PATH_BASE', $path);
define('IS_REWRITE', 1);
define('WRITE_LOG_MYSQL', 0);
define('USE_MEMCACHE', 0);

//$positions = array ('left' => 'Bên trái','right' => 'Bên phải', 'top' => 'Bên trên','pos1' => 'Dưới menu', 'pos2' =>'Phía trên nội dung', 'pos3'=>'Phía dưới nội dung','pos4' =>'Trên footer','out_left'=>'Trượt trái','out_right' => 'Trượt phải');
$positions = array(
    'left' => 'Bên trái (left)',
    'right' => 'Bên phải (right)',
    'bottom' => 'Bên dưới (bottom)',
    'top' => 'Bên dưới header (top)',
    'pos2' => 'dưới vị trí top (pos2)',
    'pos_contents_top' => 'trên nội dung (pos_contents_top)',
    'pos_contents_bottom' => 'dưới nội dung (pos_contents_bottom)',
);
?>