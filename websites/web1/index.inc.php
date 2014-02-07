<?php

//require_once "city_soap_client.inc.php";
$_db = $db = db::__d();
__autoload('city_classes/common');
__autoload('city_classes/news');
__autoload('city_classes/company');
__autoload('city_classes/ourcity');

$objnews = new news();
$objcompany = new company();
$objourcity = new ourcity();
$objcommon = new common();


$city_launchinfo = $objourcity->city_launchimage_info(CITY_ID);
$city_details = $objourcity->city_details_info(CITY_ID);
$base_city_lat = $city_details[0]['lat'];
$base_city_lng = $city_details[0]['lng'];
$geoAddress = $city_details[0]['ci_name'];


$country_id = isset($city_details[0]['c_id']) ? $city_details[0]['c_id'] : 0;


$recent_addedmember = $objourcity->city_newmember(CITY_ID, " LIMIT 6 ");
$recent_videos = $recent_pictures = $recent_wallpapers = $recent_ecards = array();

$query = "SELECT city_user.user_id FROM city_user  
						LEFT JOIN user_all ON city_user.user_id = user_all.user_id 
						WHERE city_user.city_id=" . CITY_ID . " AND user_all.user_type='individual'";
$user_ids = implode(",", array_keys($db->format_data($db->query($query), 'user_id')));

/* if($user_ids != '') {
  #videos
  $recent_videos     = $objcompany->FetchDataWithCustomQuery("SELECT * FROM city_user_videos WHERE cuv_user_id IN ($user_ids) and cuv_active = '1' ORDER BY RAND() DESC LIMIT 5");
  #Pictures
  $recent_pictures   = $objcompany->FetchDataWithCustomQuery("SELECT * FROM city_user_pictures WHERE cup_user_id IN ($user_ids) and cup_active = '1' ORDER BY RAND() DESC LIMIT 5");
  #wallpaper
  $recent_wallpapers = $objcompany->FetchDataWithCustomQuery("SELECT * FROM city_user_wallpaper WHERE cuw_user_id IN ($user_ids) and cuw_active = '1' ORDER BY RAND() DESC LIMIT 5");
  #Ecard
  $recent_ecards 	   = $objcompany->FetchDataWithCustomQuery("SELECT * FROM city_user_ecards WHERE cuec_user_id IN ($user_ids) and cuec_active = '1' ORDER BY RAND() DESC LIMIT 5");

  }
 */
if ($user_ids != '' || 1) {

    #videos
    $recent_videos = $objcompany->FetchDataWithCustomQuery("SELECT * FROM city_user_videos WHERE   cuv_active = '1' ORDER BY RAND() DESC LIMIT 5");
    #Pictures
    $recent_pictures = $objcompany->FetchDataWithCustomQuery("SELECT * FROM city_user_pictures WHERE   cup_active = '1' ORDER BY RAND() DESC LIMIT 5");
    #wallpaper
    $recent_wallpapers = $objcompany->FetchDataWithCustomQuery("SELECT * FROM city_user_wallpaper WHERE  cuw_active = '1' ORDER BY RAND() DESC LIMIT 5");
    #Ecard
    $recent_ecards = $objcompany->FetchDataWithCustomQuery("SELECT * FROM city_user_ecards WHERE  cuec_active = '1' ORDER BY RAND() DESC LIMIT 5");
}



#lottery
if (!isset($_SESSION['cache']['lottery']) || CAHCE_OFF) {
    $res = $db->query("SELECT * FROM lottery where location_id  = {$country_id}");
    $_SESSION['cache']['lottery'] = $db->format_data($res);
}
$lottery_data = $_SESSION['cache']['lottery'];

//get time for country
if ($country_id != '') {
    $query_country = $db->query("select sunset_time, sunrise_time, date from sun_set_rise_time where country_id = " . $country_id . " and date >='" . date('Y-m-d') . "' order by date limit 1");
    $country_time = $db->format_data($query_country);
}
//get weather 
$fetch_query = "select * from weather where date ='" . date('Y-m-d') . "' and city_id='" . CITY_ID . "'";
$data_tmp = $db->query($fetch_query);
$weather_lists = $db->format_data($data_tmp);
//date_default_timezone_set('UTC');
$country_gmt_temp = $db->query("select gmt_time from country where c_id = " . $country_id);
$country_gmt = $db->format_data($country_gmt_temp);

$sign = substr($country_gmt[0]['gmt_time'], 0, 1);
$time = substr($country_gmt[0]['gmt_time'], 1, 5);

if ($sign = "+") {
    $mk = strtotime(date('G:i')) + strtotime($time);
} else {
    $mk = strtotime(date('G:i')) - strtotime($time);
}

$data = date("G", $mk);
$curr_hour = $data;
if ($curr_hour > 8 && $curr_hour <= 12) {
    $big_temp = "morning_temp";
    $big_img = "morning_img";
} elseif ($curr_hour > 12 && $curr_hour <= 18) {
    $big_temp = "noon_temp";
    $big_img = "noon_img";
} elseif ($curr_hour > 18 && $curr_hour <= 24) {
    $big_temp = "evening_temp";
    $big_img = "evening_img";
} else {
    $big_temp = "night_temp";
    $big_img = "night_img";
}



#company
$latest_companies = array();
/* if(!isset($_SESSION['cache']['latest_companies']) || CAHCE_OFF ) {
  $latest_companies = $db->format_data($db->query("SELECT c.company_name,c.id,c.street_name,c.pincode,ci.ci_name FROM companies c LEFT JOIN cities ci ON c.city=ci.ci_id WHERE c.city = ". CITY_ID ." ORDER BY user_registered DESC LIMIT 5"));
  $_SESSION['cache']['latest_companies'] = $latest_companies;
  }
  $latest_companies = $_SESSION['cache']['latest_companies'] = array();
 */

//echo "SELECT c.company_name,c.id,c.street_name,c.pincode,ci.ci_name FROM companies c LEFT JOIN cities ci ON c.city=ci.ci_id WHERE c.status = 'Active' AND c.city = ". CITY_ID ." ORDER BY user_registered DESC LIMIT 5";exit;
// c.status = 'Active'  is commented for performance
$latest_companies = $db->format_data($db->query("SELECT k.keyword,c.unique_id,c.company_name,c.id,c.street_name,c.pincode,ci.ci_name FROM companies c LEFT JOIN cities ci ON c.city=ci.ci_id LEFT JOIN company_category_keywords cck on ( cck.company_user_id = c.id AND main_keyword = '1' ) LEFT JOIN keywords k on k.id = cck.ccc_ck_id WHERE  c.status != 'Inactive' AND c.city = " . CITY_ID . " ORDER BY user_registered DESC LIMIT 5"));

#Company Keywords
$comp_cat_list = $objcompany->getcategoryforcomplist_1($_SESSION['lid']);

#cinema Movie
$res = $db->query("SELECT * FROM `firma` WHERE location_id  = '" . CITY_ID . "'");
$firmadata = $db->format_data($res);

#cinema Movie
$res = $db->query("SELECT *,newsfeeds_url.provider FROM `news` 
								LEFT JOIN newsfeeds_url ON news.feed_id=newsfeeds_url.feed_id 
								where public='1' AND full_desc != '' AND location_id = '" . COUNTRY_ID . "' order by pubDate  desc , news_id desc LIMIT 0,3");
$newsdata = $db->format_data($res);

//define('NEWS_IMG_PATH','http://adlino.de/video_download_s/rss2html/news_images/');
define('NEWS_IMG_PATH', _MEDIA_BASE_URL . '/upload/news_image/');

$Banner_728x90 = html_entity_decode($objourcity->Display_city_banner_by_City_Id(CITY_ID, "Banner_728x90"));
$M_160x600 = html_entity_decode($objourcity->Display_city_banner_by_City_Id(CITY_ID, "M_160x600"));
$M_468x60 = html_entity_decode($objourcity->Display_city_banner_by_City_Id(CITY_ID, "M_468x60"));
$M_150x90_9 = html_entity_decode($objourcity->Display_city_banner_by_City_Id(CITY_ID, "M_150x90_9"));


//retail advertisement
$objcommon = new common();
$retail_add = $objcommon->get_retail_add(CITY_ID, '205x175');
$retail_add_216 = $objcommon->get_retail_add(CITY_ID, '216x140');

$company_vocuhers_query = "SELECT * FROM company_vouchers cv LEFT JOIN company_vouchers_images cvi ON cv.cv_id=cvi.cvi_cv_id LEFT JOIN companies c on cv.cv_c_id = c.id WHERE c.status = 'Active' AND  cvi.cvi_active = '1'  AND c.city = " . CITY_ID . " ORDER BY RAND()   LIMIT 4";
$random_comapny_vocuhers = $db->format_data($db->query($company_vocuhers_query));


if (count($random_comapny_vocuhers) < 4) {

    $limit = 4 - count($random_comapny_vocuhers);
    $company_vocuhers_query = "SELECT * FROM company_vouchers cv LEFT JOIN company_vouchers_images cvi ON cv.cv_id=cvi.cvi_cv_id LEFT JOIN companies c on cv.cv_c_id = c.id WHERE c.status = 'Active' and cvi_publish=1 AND cvi_active = '1' ORDER BY RAND() LIMIT $limit";
    $_random_comapny_vocuhers = $db->format_data($db->query($company_vocuhers_query));
    $random_comapny_vocuhers = array_merge($random_comapny_vocuhers, $_random_comapny_vocuhers);
}


$query = "select * from tips_advice where active = 1 order by RAND() Limit 0,4";
$res = $db->query($query);
$tips = $db->format_data($res);

$query = "select * from video_report where active = 1 and vr_category = '3026' order by RAND() Limit 0,1";
$res = $db->query($query);
$video_report = $db->format_data($res);

$query = "select * from video_report where active = 1 and vr_category = '3027' order by RAND() Limit 0,1";
$res = $db->query($query);
$temp = $db->format_data($res);
$video_report[1] = $temp[0];

$query = "select * from video_report where active = 1 and active = 1 and vr_category = '3028' order by RAND() Limit 0,1";
$res = $db->query($query);
$temp = $db->format_data($res);
$video_report[2] = $temp[0];


$query = "select * from video_report where active = 1 and vr_category = '3051' order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_holiday = $temp[0];


$query = "select * from video_report where active = 1 and  vr_category = '3047' order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_home = $temp[0];


$query = "select * from video_report where active = 1 and  vr_category = '3048' order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_law = $temp[0];

$query = "select * from video_report where active = 1 and  vr_category = '3043' order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_family_home = $temp[0];


$query = "select * from video_report where active = 1 and  vr_category = '3046' order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_construction = $temp[0];


$query = "select * from video_report where active = 1 and  vr_category = '3052' order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_multimedia = $temp[0];


$query = "select * from video_report where active = 1 and  vr_category = '3040' order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_safety = $temp[0];


$query = "select * from video_report where  active = 1 and vr_category = '3041' order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_vehicle = $temp[0];


$query = "select * from video_report where active = 1 and  vr_category = '3042' order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_cruise = $temp[0];


$query = "select * from video_report where active = 1 and  vr_category = '3050' order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_economy = $temp[0];
$vr_economy1 = $temp[1];
$vr_economy2 = $temp[2];
$vr_economy3 = $temp[3];

$query = "select * from video_report where   vr_category = '3049' AND active=1 order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_health = $temp[0];
$vr_health1 = $temp[1];
$vr_health2 = $temp[2];
$vr_health3 = $temp[3];


$query = "select * from video_report where  vr_category = '3040' AND active=1 order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_cars[0] = $temp[0];

$query = "select * from video_report where  vr_category = '3041' AND active=1 order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_cars[1] = $temp[0];

$query = "select * from video_report where  vr_category = '3042' AND active=1 order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_cars[2] = $temp[0];

$query = "select * from video_report where  vr_category = '3038' AND active=1 order by vr_added_date , RAND() desc Limit 0,5";
$res = $db->query($query);
$temp = $db->format_data($res);
$vr_cars[3] = $temp[0];
shuffle($vr_cars);
$vr_cars_url = array(
    3038 => 'environment_and_transport',
    3040 => 'safety_and_traffic',
    3041 => 'vehicle_models',
    3042 => 'cruise_reports'
);

$query = " SELECT train_travel,train_tickets,train_plane ,env_zone ,courses_real ,interest_rate ,currency_convert  from country_moderators JOIN admin_users ON cm_user_id = au_id WHERE cm_country_id = 6";
$misc_data = $db->format_data($db->query($query));

$zoomin_bottom_videos = array();

$query = " select * from content_partner_snacktv WHERE cpz_category = 'Ausland' ORDER BY cpz_date DESC   LIMIT 0,10";
$data = $db->format_data($db->query($query));
$zoomin_bottom_videos[0] = $data[array_rand($data, 1)];

$query = " select * from content_partner_snacktv WHERE cpz_category = 'Bemerkenswert' ORDER BY cpz_date DESC   LIMIT 0,10";
$data = $db->format_data($db->query($query));
$zoomin_bottom_videos[1] = $data[array_rand($data, 1)];

$query = " select * from content_partner_snacktv WHERE cpz_category = 'Unterhaltung' ORDER BY cpz_date DESC   LIMIT 0,10";
$data = $db->format_data($db->query($query));
$zoomin_bottom_videos[2] = $data[array_rand($data, 1)];

//d($zoomin_bottom_videos);

$country_id = $_SERVER['country_id'];
$query = "SELECT * FROM footer_tips  where ft_country = {$country_id} order by RAND() LIMIT 0,6";
$footer_tips_data = $_db->format_data($_db->query($query));

include 'company_opt.inc.php';

$menu_card_companies_count = $_db->format_data($_db->query("select count(cm_id) as tCount from companies_metadata left join companies on id = cm_c_id  left join cities on ci_id = city  WHERE agree_menu_card = '1' AND ci_id = " . CITY_ID));
$menu_card_companies_count = $menu_card_companies_count[0]['tCount'];
$sponsor_logos = q("select image from companies left join city_win_game_sponsors on cwgs_c_id = id where cwgs_ci_id = '" . CITY_ID . "' order by RAND()");



// Channel
$channel_data = $_db->format_data($_db->query("select * from video_channels order by rand()"), 'vc_id');

// online games
$online_games_random = q(" select * from online_games order by RAND() limit 0,3");

//d(showCountryBanners());
//exit;
//d($_SESSION,'');
tpl::$_meta_description_content = tpl::$_vars['lang_ref'][3516];
tpl::$_meta_keywords_content = tpl::$_vars['lang_ref'][3517] . ", " . $_SESSION['cache']['GetCityWebsiteName'][0]['ci_name'] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][3517] . " " . $_SESSION['cache']['GetCityWebsiteName'][0]['ci_name'] . ", ";

tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][859] . " " . $_SESSION['cache']['GetCityWebsiteName'][0]['ci_name'] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][242] . " " . $_SESSION['cache']['GetCityWebsiteName'][0]['ci_name'] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][196] . " " . $_SESSION['cache']['GetCityWebsiteName'][0]['ci_name'] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][197] . " " . $_SESSION['cache']['GetCityWebsiteName'][0]['ci_name'] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][198] . " " . $_SESSION['cache']['GetCityWebsiteName'][0]['ci_name'] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][200] . " " . $_SESSION['cache']['GetCityWebsiteName'][0]['ci_name'] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][758] . " " . $_SESSION['cache']['GetCityWebsiteName'][0]['ci_name'] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][887] . " " . $_SESSION['cache']['GetCityWebsiteName'][0]['ci_name'] . ", ";


tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][859] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][242] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][196] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][197] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][198] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][200] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][758] . ", ";
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][887];

//d($_SESSION);
tpl::$_website_title = $_SESSION['cache']['GetCityWebsiteName'][0]['ci_website_adhoster'] . " - " . tpl::$_vars['lang_ref'][3525] . " " . $_SESSION['cache']['GetCityWebsiteName'][0]['ci_name'];


?>
