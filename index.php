<?php

session_start();

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

define('DB_HOST', 'localhost');
define('DB_PASSWORD', 'pwd');
define('DB_UNAME', 'root');
define('DB_NAME', 'dbname');


# path is defined in .htacess # Path value is physical location root directory
define('_PATH', $_SERVER['application_path']);

# Website will be decided from here out of all multiple websites
$url_append_path = 'websites/front_prod/';
# default website is admin
$_SERVER['application_website'] = 'front_prod';
#default Theme
$_SERVER['application_default_theme'] = 'front_prod';

$_SERVER['country_id'] = 6;

$website_url = @ereg_replace("((https?)://)?(www.)?", "", $_SERVER['SERVER_NAME']);
_resolveApp();


define('LOCALE',  application::Locale);

include($url_append_path . 'index.php');

mysql_close(db::__d()->_link);

?>
