<?php
# @todo : implement all the use cases for config file's physical existance

# Get Physical Path of config file ( set in .htaccess )
define('_PATH',$_SERVER['adlino_path']);
include _PATH."config.inc.php";
include _PATH."websites/"._WEBSITE_NAME."/config.inc.php";

if(($_GET['q'] != 'login' && $_GET['q'] != 'my_data') && (empty($_SESSION['user_id'])))
{
	//echo "ttt"; exit;
	//include(_PATH."templates/"._WEBSITE_THEME."/simpleCache.php");
}
//call a function to authenticate url

$url=_authenticate_url_front($url);    
define('_REQUEST_PAGE',$url);
	# define lagn_id condstant for default language or any other requested
	define('_REQUEST_LANG_ID',dc_find_current_language());
	#storing currentlystorwed lagnauge in session
	$_SESSION['lid']=_REQUEST_LANG_ID;	
	//prepaer array for locale variable

    	$locale_string=array(
						"1"=>"en_US.utf8",
						"2"=>"en_US.utf8",
						"3"=>"pl_PL.utf8",
						"4"=>"es_ES.utf8",
						"5"=>"de_DE.utf8",
						"6"=>"tr_TR.utf8",
						"14"=>"da_DK.utf8",                  
						"16"=>"it_IT.utf8",
						"17"=>"el_GR.utf8",                     
						"19"=>"nl_NL.utf8",
						);



   /*	$locale_string=array(
						"1"=>"en_US.utf8",
						"2"=>"en_US.utf8",
						"3"=>"pl_PL.urt8",
						"4"=>"CRI",
						"5"=>"de_DE.utf8",
						"6"=>"TUR",
						"14"=>"SPB",
						"16"=>"ITA",
						"17"=>"GRC",
						"18"=>"FRA",
						"19"=>"NLD",
						);
    */
	//get locale string for currnent language	
	#d($locale_srting);			
	//print $_SESSION['lid'];	
	$locale=$locale_string[$_SESSION['lid']];
	//set locale
	
	setlocale(LC_ALL,"$locale");

$ctrl->load();
$tpl->load();

?>