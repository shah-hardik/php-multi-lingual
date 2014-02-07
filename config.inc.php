<?php

session_start();
#Uncomment below line of code to suppress notice/wranings
error_reporting(E_ALL ^ E_NOTICE);
# autoload : 

function __autoload($class_name) {
    if (file_exists(_PATH . 'lib/' . $class_name . '.class.php')) {
        include_once(_PATH . 'lib/' . $class_name . '.class.php');
    }
}

# GET website name                                                              
define('_WEBSITE_NAME', $_SERVER['application_website']);

#GET default theme
define('_WEBSITE_THEME', $_SERVER['application_default_theme']);
#GET Media Path.
define('_MEDIA_BASE_URL', 'http://i.application.com/');
define('_COMMENT_SERVER', 'http://fileserver05.com/');
define('_CONTENT_SERVER', 'http://fileserver05.com/');
define('_MEDIA_URL', 'http://i.naribas.de/' . _WEBSITE_THEME . "/");


define('_', _PATH . "/templates/" . _WEBSITE_THEME . "/");
define('_WIDGET_SERVER', 'http://fileserver01.com/widgets/');
define('_CONTENT_ECARD_SERVER', 'http://fileserver03.com/');
define('_CONTENT_WALLPAPER_SERVER', 'http://fileserver04.com/');
define('_CONTENT_PICTURE_SERVER', 'http://fileserver02.com/');
define('_CONTENT_VIDEO_SERVER', 'http://fileserver01.com/');
define('_CHAT_SERVER', 'http://fileserver03.com/');
define('_CLASSIFIEDS_IMAGE_SERVER', 'http://fileserver12.com/');

#FFMPEG path
define('FFMPEG_PATH', 'ffmpeg');

#SET Site URL
$host = $_SERVER['HTTP_HOST'];
define('_U', 'http://' . $host . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1));


#Invocke Controller,Template Object.
$ctrl = new ctrl();
$tpl = new tpl();


#call for header langauge support globla language file

$url = _e($_REQUEST['q'], 'login');
$paramurl = persist_get_params_start($_GET);

?>