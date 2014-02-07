<?php

define('CACHE_OFF', 1);

/* $url = isset($_SESSION['coming_soon_access']) || in_array($_SERVER['SERVER_NAME'],array("myochtrup24.de" ,"mygronau24.de", "myheek24.de", "myahaus24.de", "mystadtlohn24.de","myvreden24.de", "mygescher24.de") ) || in_array($_SERVER['SERVER_NAME'], array(
  "www.myochtrup24.de" ,"www.mygronau24.de", "www.myheek24.de", "www.myahaus24.de", "www.mystadtlohn24.de","www.myvreden24.de", "www.mygescher24.de")  )  ? $_REQUEST['q'] : 'coming_soon'; */

$url = $_REQUEST['q'];
$fburl = _U . $_SERVER['REQUEST_URI'];
$url = $url == "" ? 'index' : $url;
if ($url == 'card')
    $url = 'members';
if ($url == 'home')
    $url = 'index';
if ($url == 'city_websites')
    $url = 'partner_websites';
if ($url == 'classifieds_nationwide') {
    $url = 'classifieds';
    $_GET['nationwide'] = 1;
}
if ($url == 'company') {
    $url = 'company_nationwide';
    $_GET['city_search'] = 1;
}
if ($url == 'index')
    $url = 'home_new';

$partner_content_urls = array(
    'environment_and_transport' => array('cat_id' => 3038, 'related_cat_id' => '3042', 'related_url' => 'cruise_reports', 'text_id' => '3053', 'image_id' => 'environment_transport'),
    'money_and_finances' => array('cat_id' => 3039, 'related_cat_id' => '3048', 'related_url' => 'law_and_judgments', 'text_id' => '3054', 'image_id' => 'money_finance'),
    'safety_and_traffic' => array('cat_id' => 3040, 'related_cat_id' => '3039', 'related_url' => 'money_and_finances', 'text_id' => '3055', 'image_id' => 'safety_traffic'),
    'vehicle_models' => array('cat_id' => 3041, 'related_cat_id' => '3040', 'related_url' => 'safety_and_traffic', 'text_id' => '3056', 'image_id' => 'vehicle_models'),
    'cruise_reports' => array('cat_id' => 3042, 'related_cat_id' => '3041', 'related_url' => 'vehicle_models', 'text_id' => '3057', 'image_id' => 'cruise_reports'),
    'family_and_home' => array('cat_id' => 3043, 'related_cat_id' => '3045', 'related_url' => 'eating_drinking', 'text_id' => '3058', 'image_id' => 'family_home'),
    'job_and_career' => array('cat_id' => 3044, 'related_cat_id' => '3046', 'related_url' => 'construction_and_housing', 'text_id' => '3059', 'image_id' => 'job_career'),
    'eating_drinking' => array('cat_id' => 3045, 'related_cat_id' => '3049', 'related_url' => 'health_and_nutrition', 'text_id' => '3060', 'image_id' => 'eating_drinking'),
    'construction_and_housing' => array('cat_id' => 3046, 'related_cat_id' => '3051', 'related_url' => 'holiday_and_travel', 'text_id' => '3061', 'image_id' => 'construction_housing'),
    'home_and_furnishing' => array('cat_id' => 3047, 'related_cat_id' => '3043', 'related_url' => 'family_and_home', 'text_id' => '3062', 'image_id' => 'home_furnishing'),
    'law_and_judgments' => array('cat_id' => 3048, 'related_cat_id' => '3050', 'related_url' => 'economy', 'text_id' => '3063', 'image_id' => 'law_judgments'),
    'health_and_nutrition' => array('cat_id' => 3049, 'related_cat_id' => '3047', 'related_url' => 'home_and_furnishing', 'text_id' => '3064', 'image_id' => 'health_nutrition'),
    'economy' => array('cat_id' => 3050, 'related_cat_id' => '3038', 'related_url' => 'environment_and_transport', 'text_id' => '3065', 'image_id' => 'economy_economy'),
    'holiday_and_travel' => array('cat_id' => 3051, 'related_cat_id' => '3052', 'related_url' => 'multimedia', 'text_id' => '3066', 'image_id' => 'holiday_travel'),
    'multimedia' => array('cat_id' => 3052, 'related_cat_id' => '3044', 'related_url' => 'job_and_career', 'text_id' => '3067', 'image_id' => 'multimedia_multimedia')
);


if (array_key_exists($url, $partner_content_urls)) {
    tpl::$partner_content_category = $partner_content_urls[$url];
    tpl::$partner_content_ds = $partner_content_urls;
    $url = 'partner_content';
}
$_GET['vcid'] = '6'; // default video channel
if (strpos($url, '/')) {
    $url_meta_data = explode("/", $url);

    $_REQUEST['q'] = $url = $url_meta_data[0];
    switch ($url) {
        case 'cinema_movies':
            $_REQUEST['mv_id'] = end($url_meta_data);
            $url = $url_meta_data[2] == 'images' ? 'cinema_movies_single_images' :  'cinema_movies_single';
            break;
        case 'play_online_games':
            $_REQUEST['gid'] = end($url_meta_data);
            $url = 'play_online_games';
            break;
        case 'get_downloads':
            $_REQUEST['gid'] = end($url_meta_data);
            $url = 'get_downloads';
            break;
        case 'gallery_story':
            
            $_REQUEST['id'] = end($url_meta_data);
            $url = 'gallery_story';
            break;
        case 'acteur_information':
            $_REQUEST['ac_id'] = end($url_meta_data);
            $url = 'acteur_information';
            break;
        case 'catalogs':
            $_REQUEST['cid'] = end($url_meta_data);
            $url = 'company_catalogs';
            break;
        case 'branches':
            $_REQUEST['cid'] = end($url_meta_data);
            $url = 'branches';
            break;
        case 'company_information':
            $cid = explode("-", $url_meta_data[1]);
            $_GET['company_id'] = count($cid) > 1 ? intval($cid[1]) : $cid[0];
            break;
        case 'company':
        case 'company_nationwide':
            if ($url_meta_data[1] == 'k') {
                $_GET['keyword_id'] = $url_meta_data[2] ? $url_meta_data[2] : 0;
            }
            break;
        case 'news':
            $_GET['nid'] = $url_meta_data[3];
            break;
        case 'video_channel':
            $_GET['vcid'] = $url_meta_data[1];
            $url = 'wavetv';
            break;
        case 'newsbycategory':
            $_GET['category'] = $url_meta_data[2];
            $_REQUEST['q'] = $url = 'news';
            break;
        case 'video_news_category':
            $_REQUEST['q'] = $url = 'video_news';
            $_GET['vn_cat_id'] = end($url_meta_data);
            ;
            break;
        case 'video_news':
            $size_of_url = count($url_meta_data);
            $_GET['vnid'] = $url_meta_data[$size_of_url - 1];

            $_GET['vncat'] = $url_meta_data[1];
            switch ($_GET['vncat']) {
                case 'Ausland';
                    tpl::$partner_content_category = $partner_content_urls['health_and_nutrition'];
                    break;
                case 'Auto';
                    tpl::$partner_content_category = $partner_content_urls['vehicle_models'];
                    break;
                case 'Bemerkenswert';
                    tpl::$partner_content_category = $partner_content_urls['construction_and_housing'];
                    break;
                case 'Inland';
                    tpl::$partner_content_category = $partner_content_urls['family_and_home'];
                    break;
                case 'Kultur';
                    tpl::$partner_content_category = $partner_content_urls['job_and_career'];
                    break;
                case 'Sport';
                    tpl::$partner_content_category = $partner_content_urls['home_and_furnishing'];
                    break;
                case 'Unterhaltung';
                    tpl::$partner_content_category = $partner_content_urls['health_and_nutrition'];
                    break;
            }
            break;
        case 'cooking_recipes':
            $_GET['id'] = $url_meta_data[3];
            $_GET['cat'] = $url_meta_data[4];
            break;
    }


//		if($url_meta_data[0] == 'video_news'){
//			$_GET['vnid'] = $url_meta_data[3];
//			$_GET['vncat'] = $url_meta_data[1];
//			switch($_GET['vncat']) {
//				case 'Ausland';
//					tpl::$partner_content_category = $partner_content_urls['health_and_nutrition'];
//				break;
//				case 'Auto';
//					tpl::$partner_content_category = $partner_content_urls['vehicle_models'];
//				break;
//				case 'Bemerkenswert';
//					tpl::$partner_content_category = $partner_content_urls['construction_and_housing'];
//				break;
//				case 'Inland';
//					tpl::$partner_content_category = $partner_content_urls['family_and_home'];
//				break;
//				case 'Kultur';
//					tpl::$partner_content_category = $partner_content_urls['job_and_career'];
//				break;
//				case 'Sport';
//					tpl::$partner_content_category = $partner_content_urls['home_and_furnishing'];
//				break;
//				case 'Unterhaltung';
//					tpl::$partner_content_category = $partner_content_urls['health_and_nutrition'];
//				break;
//			}
//
//			$url = 'video_news';
//		}
//		elseif($url_meta_data[0] == 'cooking_recipes'){
//			$_GET['id'] = $url_meta_data[3];
//			$_GET['cat'] = $url_meta_data[4];
//			$url = 'cooking_recipes';
//		}
}
if (FALSE !== strpos($url, 'ourcity')) {
    if (count(explode("_", $url)) > 2) {
        $url = 'ourcity';
    }
}



define('_URL', $url);



define('_REQUEST_PAGE', $url);
define('MEDIA_BASE_URL', 'http://i.naribas.de');
define('MEDIA_BASE_URL_VIDEO_NEWS', 'http://i.naribas.de');
//define('MEDIA_BASE_URL', 'http://i.naribas.de');
define('_MEDIA_UPLOAD_URL', 'http://i.naribas.de');
//define('_MEDIA_UPLOAD_URL', 'http://i.naribas.de'); 

define('ADMIN_EMAIL', 'info@adlino.de');

$city_soap = new soap_manage_city_class();
$city_website_name = $city_soap->GetCityWebsiteName(CITY_ID);
tpl::$_website_title = $city_website_name[0]['ci_website_name'];


//$url = _e($_REQUEST['q'],'index');
tpl::$_vars['gmap_key'] = 'ABQIAAAAJYZWuFa5EbKWSJs8pZMP0xS26JUe3xgukHE_RFj-7UXaH3FxzhRdqFYCQPErenIrwmHo6GIfwALhEw';
date_default_timezone_set('Europe/Berlin');

tpl::$_vars['share']['twitter_start'] = '<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-lang="de">';
tpl::$_vars['share']['twitter_end'] = '</a>';

tpl::$_vars['share']['stud_start'] = '<a href="http://www.meinvz.net/Link/Share/?url=' . _U . $_SERVER['REQUEST_URI'] . '">';
tpl::$_vars['share']['stud_end'] = '</a>';


tpl::$_vars['share']['xing_start'] = '<a href="https://www.xing.com/app/user?op=share;' . _U . $_SERVER['REQUEST_URI'] . '">';
tpl::$_vars['share']['xing_end'] = '</a>';

tpl::$_vars['share']['fb_start'] = "<a href='javascript:facebook_share(\"" . _U . substr($_SERVER['REQUEST_URI'], 1) . "\",\"\",\"\",\"\")'>";
tpl::$_vars['share']['fb_end'] = '</a>';

// 
tpl::$_vars['share']['content_3'] = "
    " . tpl::$_vars['share']['twitter_start'] . "<div class='_custIcons ' style='background-position: -72px -696px'>&nbsp;</div> " . tpl::$_vars['share']['twitter_end'] . "
    " . tpl::$_vars['share']['fb_start'] . "<div class='_custIcons ' style='background-position: -39px -696px'>&nbsp;</div>  " . tpl::$_vars['share']['fb_end'] . " 
    " . tpl::$_vars['share']['stud_start'] . "<div class='_custIcons ' style='background-position: -6px -696px'>&nbsp;</div>" . tpl::$_vars['share']['stud_end'] . "
";

tpl::$_vars['share']['content_4'] = tpl::$_vars['share']['xing_start'] . "<div class='_custIcons ' style='background-position: -105px -696px;margin-right:0px'>&nbsp;</div>" . tpl::$_vars['share']['xing_end'];
tpl::$_vars['share']['content_4'] .= tpl::$_vars['share']['content_3'];
$url = _U;
tpl::$_vars['share']['fb_comment'] = <<<FB
         <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) {return;}
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>

                    <div class="fb-comments" data-href="{$fburl}" data-num-posts="1" data-width="554"></div> 
FB;

if (isset($_REQUEST['doLogout'])) {
    session_destroy();
    unset($_SESSION);
}
?>