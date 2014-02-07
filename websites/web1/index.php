<?php
$bm_start = microtime();

# @todo : implement all the use cases for config file's physical existance
# Get Physical Path of config file ( set in .htaccess )
define('_PATH', $_SERVER['adlino_path']);

include _PATH . "config.inc.php";
include _PATH . "websites/" . _WEBSITE_NAME . "/config.inc.php";

//call a function to authenticate url
/* if($url == "update_lang" )
  {
  $url = "update_lang";
  }else
  {  # else go for  authentication & access  check
  $url =_authenticate_url_city($url);
  } */

define('_REQUEST_PAGE', $url);

# define lagn_id condstant for default language or any other requested
define('_REQUEST_LANG_ID', dc_find_current_language());
#storing currentlystorwed lagnauge in session
$_SESSION['lid'] = _REQUEST_LANG_ID;

$locale_string = array(
    "1" => "en_US.utf8",
    "2" => "en_US.utf8",
    "3" => "pl_PL.utf8",
    "4" => "es_ES.utf8",
    "5" => "de_DE.utf8",
    "6" => "tr_TR.utf8",
    "14" => "da_DK.utf8",
    "16" => "it_IT.utf8",
    "17" => "el_GR.utf8",
    "18" => "fr_FR.utf8",
    "19" => "nl_NL.utf8",
);

$locale = $locale_string[$_SESSION['lid']];
setlocale(LC_ALL, "$locale");

$ctrl->load();
$tpl->load();

//now log the page impression
$hostname = preg_replace("/www./", "", $_SERVER['HTTP_HOST']);
$ip_address = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
//Find user browser
if (preg_match('|MSIE ([0-9].[0-9]{1,2})|', $useragent, $matched)) {
    $browser_version = $matched[1];
    $browser = 'IE';
} elseif (preg_match('|Opera ([0-9].[0-9]{1,2})|', $useragent, $matched)) {
    $browser_version = $matched[1];
    $browser = 'Opera';
} elseif (preg_match('|Firefox/([0-9\.]+)|', $useragent, $matched)) {
    $browser_version = $matched[1];
    $browser = 'Firefox';
} else if (preg_match("|Chrome/([0-9\.]+)|", $useragent, $matched)) {
    $browser_version = $matched[1];
    $browser = 'Chrome';
} elseif (preg_match('|Safari/([0-9\.]+)|', $useragent, $matched)) {
    $browser_version = $matched[1];
    $browser = 'Safari';
} else {
    // browser not recognized!
    $browser_version = 0;
    $browser = 'Other';
}

// Find user OS
if (strstr($useragent, 'Win')) {
    $os = 'Win';
} else if (strstr($useragent, 'Mac')) {
    $os = 'Mac';
} else if (strstr($useragent, 'Linux')) {
    $os = 'Linux';
} else if (strstr($useragent, 'Unix')) {
    $os = 'Unix';
} else {
    $os = 'Other';
}


if (!isset($_SESSION['user_screen_width']) || !isset($_SESSION['user_screen_height'])) {
    ?>
    <script language="javascript"> 
        $.ajax({
            type:"POST",
            url:"<?php print _U ?>ajax_handler",
            data:"page=add_width_height&width="+screen.width+"&height="+screen.height,
            success:function(responsestr){
    	
            }
        });

    </script>     
    <?php
}

if (isset($_SERVER['REDIRECT_URL'])) {
    $page_url = $_SERVER['HTTP_HOST'] . $_SERVER['REDIRECT_URL'];
    $destination_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
} else {
    $page_url = $_SERVER['HTTP_HOST'] . '/index';
    $destination_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

//$url = "http://api.hostip.info/country.php?ip=59.165.21.5";
//$url = "http://api.hostip.info/country.php?ip=".$ip_address;
//$curl = curl_init();    
//curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($curl, CURLOPT_HEADER, false);
//$str = curl_exec($curl);


if ($str == '' || strtoupper($str) == 'XX')
    $str = 'Other';

$page_impression = new page_impression();
$checkArr = array(".ico", ".png", ".gif", ".jpg");

if (!in_array(substr($page_url, -4), $checkArr) && $browser != "Other") {
    $page_impression->log_impression($hostname, $page_id = 0, $ip_address, $os, $browser, $browser_version, $_SESSION['user_screen'], $page_url, $destination_url, $str = "");
}
// End by Log


$bm_end = microtime();
//print $bm_end-$bm_start;
?>