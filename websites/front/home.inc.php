<?php
$_db = db::__d();
error_reporting(E_ALL && ~E_NOTICE);
require_once "soapclient.inc.php";
$movie_wallpaper_links = $tuning_car_links = $video_search_film_trailer_links = $video_search_music_video_links = $video_search_game_trailer_links = array() ;
/*........................Get Recent Videos........................................*/
$recent_videos=$soap->FetchFrontDataWithCustomQuery("SELECT * FROM city_user_videos WHERE cuv_release='0' AND cuv_active='1' ORDER BY cuv_upload_date DESC LIMIT 5");
#d($recent_videos);
/*........................Get Recent Pictures........................................*/
$recent_pictures=$soap->FetchFrontDataWithCustomQuery("SELECT * FROM city_user_pictures WHERE cup_release='0' AND cup_active='1' ORDER BY cup_upload_datetime DESC LIMIT 5");
#d($recent_pictures);
/*........................Get Recent Ecards........................................*/
$recent_ecards=$soap->FetchFrontDataWithCustomQuery("SELECT * FROM city_user_ecards WHERE cuec_release='0' AND cuec_active='1' ORDER BY cuec_upload_datetime DESC LIMIT 5");
#d($recent_ecards);
//get first section data
$first_section_data = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM top_search_terms WHERE type='first_section' ORDER BY RAND() LIMIT 1");


//get Image search data
$image_search_data = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM top_search_terms WHERE type='image_serach' ORDER BY RAND() LIMIT 12");
//get Video search data
$video_search_data = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM top_search_terms WHERE type='video_search' ORDER BY RAND() LIMIT 12");
//get Popular topic data
$popular_topic_data = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM top_search_terms WHERE type='popular_topic' ORDER BY RAND() LIMIT 12");
//get all company vouchers by language specific
if($_SESSION['lid'] == 1)
    $lid = 2;
else
    $lid = $_SESSION['lid'];

### ORIGINAL CODE	
//$res = $_db->query("SELECT * FROM voucher_cards_users vcu JOIN voucher_cards_design vcd ON vcu.vcu_vcd_id = vcd.vcd_id  WHERE vcu.status = 1 GROUP BY vcu_vcd_id ORDER BY RAND() LIMIT 5");
//$random_comapny_vocuhers = $_db->format_data($res);	
//$voucher_directory = _PATH."media/upload/company_vouchers";
//chdir($voucher_directory);
//$cwd1=getcwd();
//$files1 = scandir($cwd1);
//$arr = array('gif','jpg','png'); 
//for($i=0;$i<count($files1);$i++)
//{	
//	if(in_array(substr($files1[$i],-3,3),$arr) && $files1[$i] != '.' && $files1[$i] != '..')
//	$comapny_vocuhers[]=$files1[$i];
//}

//$new_comapny_vocuhers = array_rand($comapny_vocuhers,5);
//
//foreach($new_comapny_vocuhers as $value)
//{
//	$random_comapny_vocuhers[]['vcu_image']=$comapny_vocuhers[$value];
//}

$_city_where = CITY_ID == '-1' ? '' : " AND cm.city = '".CITY_ID."' ";
//$company_vocuhers_query = "SELECT * FROM company_vouchers cv LEFT JOIN company_vouchers_images cvi ON cv.cv_id=cvi.cvi_cv_id WHERE cv.cv_l_id=$lid AND cvi_moderate=1 ORDER BY RAND() LIMIT 5";
$company_vocuhers_query = "SELECT * FROM company_vouchers cv LEFT JOIN companies cm on cm.id = cv.cv_c_id LEFT JOIN company_vouchers_images cvi ON cv.cv_id=cvi.cvi_cv_id WHERE status = 'active' and  cvi.cvi_active = '1' {$_city_where} ORDER BY RAND() LIMIT 5";
#d($company_vocuhers_query);
$random_comapny_vocuhers = $soap->FetchFrontDataWithCustomQuery($company_vocuhers_query);

if (count($random_comapny_vocuhers) < 4) {
    $limit = 5 - count($random_comapny_vocuhers);
    $company_vocuhers_query = "SELECT * FROM company_vouchers cv LEFT JOIN company_vouchers_images cvi ON cv.cv_id=cvi.cvi_cv_id LEFT JOIN companies c on cv.cv_c_id = c.id WHERE c.status = 'Active' and cvi_publish=1 AND cvi_active = '1' ORDER BY RAND() LIMIT $limit";
    $_random_comapny_vocuhers = q($company_vocuhers_query);
    $random_comapny_vocuhers = array_merge($random_comapny_vocuhers, $_random_comapny_vocuhers);
}

//get a latest companies
$latest_companies = $soap->FetchFrontDataWithCustomQuery("SELECT k.keyword,c.unique_id,c.company_name,c.image,c.id,c.street_name,c.pincode,co.co_name,cn.c_name,s.s_name,p.p_name,ci.ci_name,nei.nei_name FROM companies c LEFT JOIN continent co ON c.continent=co.co_id LEFT JOIN country cn ON c.country=cn.c_id LEFT JOIN states s ON c.state=s.s_id LEFT JOIN provinces p ON c.province=p.p_id LEFT JOIN cities ci ON c.city=ci.ci_id LEFT JOIN company_category_keywords cck on ( cck.company_user_id = c.id AND main_keyword = '1' ) LEFT JOIN keywords k on k.id = cck.ccc_ck_id	LEFT JOIN neighborhoods nei ON c.neighborhood=nei.nei_id WHERE c.status = 'Active' ORDER BY user_registered DESC LIMIT 20");
#d($latest_companies);
//get data for star search section
$star_search_data = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM home_page_star_serach ORDER BY RAND() LIMIT 4");
#d($star_search_data);
//get a tuning car data
$tuning_car=$soap->FetchFrontDataWithCustomQuery("SELECT * FROM home_page_tuning_cars ORDER BY RAND() LIMIT 1");
if(count($tuning_car) > 0){
    //get other five tuning cars link expect above one
    $tuning_car_links = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM home_page_tuning_cars WHERE tc_id != ".$tuning_car[0]['tc_id']." ORDER BY RAND() LIMIT 5");
}
#d($tuning_car);
#d($tuning_car_links);
/*Get A Movie Wallpaper Data*/
$movie_wallpaper = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM home_page_movie_wallpapers ORDER BY RAND() LIMIT 1");
if(count($movie_wallpaper) > 0){
    //get other five movie link expect above one
    $movie_wallpaper_links = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM home_page_movie_wallpapers WHERE mv_id != ".$movie_wallpaper[0]['mv_id']." ORDER BY RAND() LIMIT 5");
}
#d($movie_wallpaper_links);
/*Get a Video film taliors*/
$video_film_trailer = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM home_page_video_search WHERE vs_type='film_trailers' ORDER BY RAND() LIMIT 1");
if(count($video_film_trailer) > 0){
    //get other five movie link expect above one
    $video_search_film_trailer_links = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM home_page_video_search WHERE vs_id != ".$video_film_trailer[0]['vs_id']." AND vs_type='film_trailers' ORDER BY RAND() LIMIT 5");
}
/*Get a Video music Videos*/
$video_music_video = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM home_page_video_search WHERE vs_type='music_videos' ORDER BY RAND() LIMIT 1");
if(count($video_music_video) > 0){
    //get other five movie link expect above one
    $video_search_music_video_links = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM home_page_video_search WHERE vs_id != ".$video_music_video[0]['vs_id']." AND vs_type='music_videos' ORDER BY RAND() LIMIT 5");
}
/*Get a Video music Videos*/
$video_game_trailer = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM home_page_video_search WHERE vs_type='game_trailers' ORDER BY RAND() LIMIT 1");
if(count($video_game_trailer) > 0){
    //get other five movie link expect above one
    $video_search_game_trailer_links = $soap->FetchFrontDataWithCustomQuery("SELECT * FROM home_page_video_search WHERE vs_id != ".$video_game_trailer[0]['vs_id']." AND vs_type='game_trailers' ORDER BY RAND() LIMIT 5");
}
$country_id = $_SERVER['country_id'];
$query = "SELECT * FROM footer_tips  where ft_country = {$country_id} order by RAND() LIMIT 0,6";
$footer_tips_data = $_db->format_data($_db->query($query));

tpl::$_meta_description_content = tpl::$_vars['lang_ref'][3516] ;
tpl::$_meta_keywords_content  = tpl::$_vars['lang_ref'][3517] . ", " . $_SESSION['COUNTRY_NAME'] . ", " ; 
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][3517] . " " . $_SESSION['COUNTRY_NAME'] . ", " ; 

tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][859] . " " . $_SESSION['COUNTRY_NAME'] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][242] . " " . $_SESSION['COUNTRY_NAME'] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][196] . " " . $_SESSION['COUNTRY_NAME'] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][197] . " " . $_SESSION['COUNTRY_NAME'] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][198] . " " . $_SESSION['COUNTRY_NAME'] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][200] . " " . $_SESSION['COUNTRY_NAME'] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][758] . " " . $_SESSION['COUNTRY_NAME'] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][887] . " " . $_SESSION['COUNTRY_NAME'] . ", " ;


tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][859] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][242] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][196] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][197] . ", " ; 
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][198] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][200] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][758] . ", " ;
tpl::$_meta_keywords_content .= tpl::$_vars['lang_ref'][887] ;

tpl::$_website_title =  tpl::$_vars['lang_ref'][3526] . " " . $_SESSION['COUNTRY_NAME'] ;


?>