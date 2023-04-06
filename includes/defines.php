<?php
$sort_path = $_SERVER['SCRIPT_NAME'];
$sort_path = str_replace('index.php', '', $sort_path);
$sort_path = str_replace('sitemap.php', '', $sort_path);
$sort_path = str_replace('Index.php', '', $sort_path);
define('URL_ROOT', "https://" . $_SERVER['HTTP_HOST'] . $sort_path);

define('URL_BASIC', "https://" . $_SERVER['HTTP_HOST']);

define('URL_ROOT_REDUCE', $sort_path);

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
$path = $_SERVER['SCRIPT_FILENAME'];
$path = str_replace('index.php', '', $path);
$path = str_replace('/', DS, $path);
$path = str_replace('\\', DS, $path);
define('PATH_BASE', $path);
define('VERSION', '?v=3.7');

//print_r($_SERVER);
define('USE_CACHE', 0);
define('USE_BENMARCH', 0);
define('USE_MEMCACHE', 0);
define('WRITE_LOG_MYSQL', 0);
define('TEMPLATE', 'default');
define('COMPRESS_JS',0);// nén js
define('COMPRESS_CSS',0);// nén css
//define('COMPRESS_ASSETS', 0);// nén js,css
define('CACHE_ASSETS', 1000); // thời gian cache JS,CSS, được sử dụng khi nén js,css