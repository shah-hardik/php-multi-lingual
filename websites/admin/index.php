<?php

$bm_start = microtime();

# @todo : implement all the use cases for config file's physical existance

# Get Physical Path of config file ( set in .htaccess )
define('_PATH',$_SERVER['adlino_path']);

global $_user_msg;             

include _PATH."config.inc.php";
include _PATH."websites/"._WEBSITE_NAME."/config.inc.php";
#unset autologin session so not occur any problem
 # for update_lang (for reflection) no access check, no authentication needed.
if($url == "update_lang" )
{ 
 $url = "update_lang"; 
}
else if($url == "fckeditor" )
{ 
 $url = "fckeditor"; 
}                                                    
else
{  # else go for  authentication & access  check  
$url =_authenticate_url($url);
$url = _do_access_check($url);
}


define('_REQUEST_PAGE',$url);	

# define lagn_id condstant for default language or any other requested
define('_REQUEST_LANG_ID',dc_find_current_language());
#storing currentlystorwed lagnauge in session
$_SESSION['lid']=_REQUEST_LANG_ID;

# define page_id condstant for default language or any other requested
define('_REQUEST_PAGE_ID',dc_find_current_page(_REQUEST_PAGE));

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
						"18"=>"fr_FR.utf8",
						"19"=>"nl_NL.utf8",
						);
    //get locale string for currnent language
	#d($locale_srting);
	//print $_SESSION['lid'];
	$locale=$locale_string[$_SESSION['lid']];
	//set locale
	setlocale(LC_ALL,"$locale");

$ctrl->load();

$tpl->load();

$bm_end = microtime();
//print $bm_end-$bm_start;
?>