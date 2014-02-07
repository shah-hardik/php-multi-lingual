<?php

#moderator access allowed to  pages  in followign array
#including translation moderator
$_moderator_access = array('home/translation_moderator_home', 'translation/add_classified_cat_translation', 'translation/add_translation', 'translation/add_cat_translation', 'translation/add_keywords_translation', 'admin_dashboard', 'login', 'get_image', 'get_country_flag_image', 'translation/add_user_keyword_translation', 'translation/user_define_translation', 'translation/add_company_translation', 'translation/add_mails_translation',
    'translation/add_new_classified_category', 'users/edit_my_detail', 'translation/add_cg_cat_translation', 'translation/ajax_handler', 'banner/page_wise_banner_request', 'banner/city_wise_banner_request', 'banner/ajax_banner_handler', 'banner/ajax_handler', "users/ajax_handler", 'sublogin', 'translation/adlino_info_website_menu', 'translation/add_continent_translation', 'translation/add_country_translation', 'translation/add_car_data',
    'translation/add_car_model_translation', 'translation/add_car_brand_translation', 'translation/add_invite_friend_game_terms_of_use_translation', 'translation/add_disclaimer_translation', 'translation/add_termsandcondition_translation_commercial', 'translation/add_aboutadlino_translation', 'translation/add_imprint_translation', 'translation/add_termsandcondition_translation_private', 'translation/add_invite_mails_draft_translation',
    'translation/add_event_banner_text_translation', 'translation/add_ecard_cat_translation', 'translation/add_event_cat_translation', 'translation/add_shop_banner_text_translation', 'translation/add_shop_cat_translation', 'translation/add_wallpaper_cat_translation', 'translation/add_picture_cat_translation', 'translation/add_video_cat_translation', 'translation/add_translation_adlino_info');

#logo moderator access allowed to  pages  in following array
$_adlinobiz_logo_moderator_access = array('home/adlinobiz_logo_moderator_home', 'adlinobiz_categories/list_logo_category', 'adlinobiz_categories/lists_adlbizsubcategory', 'adlinobiz_categories/ajax_subcategory', 'adlinobiz_categories/ajax_category', 'adlinobiz_translataion/add_logo_cat_translation', 'adlinobiz_moderate/logos', 'adlinobiz_moderate/ajax_upload', 'sublogin');

#webcard moderator access allowed to  pages  in following array
$_adlinobiz_webcard_moderator_access = array('home/adlinobiz_webcard_moderator_home', 'adlinobiz_categories/list_webcard_category', 'adlinobiz_categories/lists_adlbizwebcardsubcategory', 'adlinobiz_categories/ajax_subcategory', 'adlinobiz_categories/ajax_category', 'adlinobiz_translataion/add_webcard_cat_translation', 'adlinobiz_moderate/webcards', 'adlinobiz_moderate/ajax_upload', 'sublogin');

#voucher moderator access allowed to  pages  in following array
$_adlinobiz_voucher_moderator_access = array('home/adlinobiz_voucher_moderator_home', 'adlinobiz_categories/list_voucher_category', 'adlinobiz_categories/lists_adlbizvouchersubcategory', 'adlinobiz_categories/ajax_subcategory', 'adlinobiz_categories/ajax_category', 'adlinobiz_translataion/add_voucher_cat_translation', 'adlinobiz_moderate/vouchers', 'adlinobiz_moderate/ajax_upload', 'sublogin');

#banner moderator access allowed to  pages  in following array
$_adlinobiz_banner_moderator_access = array('home/adlinobiz_banner_moderator_home', 'adlinobiz_categories/list_banner_category', 'adlinobiz_categories/lists_adlbizbannersubcategory', 'adlinobiz_categories/lists_adlbizbannersubcategory', 'adlinobiz_categories/ajax_subcategory', 'adlinobiz_categories/ajax_category', 'adlinobiz_translataion/add_banner_cat_translation', 'adlinobiz_moderate/banners', 'adlinobiz_moderate/ajax_upload', 'sublogin');

#flyer moderator access allowed to  pages  in following array
$_adlinobiz_flyer_moderator_access = array('home/adlinobiz_flyer_moderator_home', 'adlinobiz_categories/list_flyers_category', 'adlinobiz_categories/ajax_subcategory', 'adlinobiz_categories/ajax_category', 'adlinobiz_categories/lists_adlbizflyersubcategory', 'adlinobiz_translataion/add_flyer_cat_translation', 'adlinobiz_moderate/flyers', 'adlinobiz_moderate/ajax_upload', 'sublogin');


#Websitetemplate moderator access allowed to  pages  in following array
$_adlinobiz_websitetemplate_moderator_access = array('home/adlinobiz_websitetemplate_moderator_home', 'adlinobiz_categories/list_websitetemplate_category', 'adlinobiz_categories/list_websitetemplate_category', 'adlinobiz_categories/lists_adlbizwtsubcategory', 'adlinobiz_categories/ajax_subcategory', 'adlinobiz_categories/ajax_category', 'adlinobiz_translataion/add_wt_cat_translation', 'adlinobiz_moderate/wts', 'adlinobiz_moderate/ajax_upload', 'sublogin');

#video moderator access allowed to  pages  in following array
$_adlinobiz_video_moderator_access = array('home/adlinobiz_video_moderator_home', 'adlinobiz_categories/list_videos_category', 'adlinobiz_categories/lists_adlbizvideosubcategory', 'adlinobiz_categories/ajax_subcategory', 'adlinobiz_categories/ajax_category', 'adlinobiz_translataion/add_video_cat_translation', 'adlinobiz_moderate/videos', 'adlinobiz_moderate/ajax_upload', 'sublogin');


#translation admin  access allowed to  pages  in followign array
$_tr_admin_access = array("translation/add_cat_menu_card_translation", 'translation/add_new_classified_category', 'translation/add_classified_cat_translation', 'translation/add_translation', 'translation/add_cat_translation', 'translation/add_keywords_translation', 'admin_dashboard', 'login', 'get_image', 'translation/add_company_translation', 'translation/add_mails_translation', 'users/edit_my_detail', 'translation/add_cg_cat_translation', 'translation/add_classified_cat_translation', 'translation/ajax_handler', 'translation/_m', 'sublogin');

#country admin access allowed to  pages  in followign array
//Edit and comment by Vipul on 9 oct 2009
//$_country_admin_cannot_access=array("geographical/list_continents","geographical/add_continent","geographical/edit_continent","country/add_country","country/list_country");
$_country_admin_access = array('moderate/moderate_dashboard', "geographical/add_cooking", "geographical/list_footer_tipps", "geographical/crop_image_daily_film_tip", "geographical/daily_film_tip", "geographical/list_streets", "lottery/add_lottery_number", "home/country_admin_home", "geographical/ajax_handler", 'get_country_flag_image', "geographical/ajax_brands", "geographical/list_states", "geographical/add_state", "geographical/edit_state", "geographical/add_provinces", "geographical/list_provinces", "geographical/edit_provinces", "geographical/add_city", "geographical/list_cities", "geographical/edit_city", "geographical/add_neighborhood", "geographical/list_neighborhoods", "geographical/edit_neighborhood", "geographical/add_country_brands", "geographical/add_company", "geographical/list_companies", "geographical/edit_company", 'termsandcondition/add_termsandcondition_translation', 'category/city_gallery_list_category', 'category/lists_category', 'category/lists_subcategory', 'banner/requestcode', 'banner/page_wise_banner_request', 'banner/city_wise_banner_request', 'banner/ajax_banner_handler', 'banner/ajax_handler', 'order/list_order', 'order/order_detail', 'geographical/list_top_search_terms', 'geographical/add_top_search_term', 'geographical/manage_star_search', 'geographical/manage_tuning_cars', 'geographical/manage_movie_wallpaper', 'geographical/manage_video_search', 'footer_content', 'translation/add_country_translation', "users/ajax_handler", 'sublogin', 'category/list_category_user_jocks', 'category/list_category_user_quotes', 'category/list_category_user_saying', 'extra/jocks', 'extra/saying', 'extra/qna', 'geographical/sunrise', 'geographical/edit_sunrise', 'extra/jocks_edit', 'extra/saying_edit', 'extra/qna_edit', 'geographical/add_jocks', 'geographical/jocks_edit', 'geographical/server', 'geographical/add_horoscope_details', 'geographical/list_horoscope_details', 'geographical/manage_horoscope_signs', 'geographical/qna', 'geographical/qna_edit', 'geographical/add_cinema_movie', 'geographical/edit_cinema_movie', 'geographical/list_cinema_movies', 'geographical/edit_horoscope', 'geographical/manage_theme', 'geographical/manage_horoscope_details', 'country_administrator_terms', 'users/edit_my_detail', 'geographical/list_news', 'help_videos');

#State admin access allowed to pages in following array
//Edit and comment by Vipul on 9 oc t 2009
//$_state_admin_cannot_access=array("geographical/list_continents","geographical/add_continent","geographical/edit_continent","country/list_country","country/add_country","country/edit_country","geographical/add_state");
$_state_admin_access = array("home/state_admin_home", "geographical/ajax_handler", "geographical/add_provinces", "geographical/list_provinces", "geographical/edit_provinces", "geographical/add_city", "geographical/list_cities", "geographical/edit_city", "geographical/add_neighborhood", "geographical/list_neighborhoods", "geographical/edit_neighborhood", "geographical/add_company", "geographical/list_companies", "geographical/edit_company", 'users/edit_my_detail', 'order/list_order', 'order/order_detail', "users/ajax_handler", 'sublogin');

#Provinces admin access allowed to pages in followring array.
//Edit and comment by vipul on 9 oct 2009
//$_provinces_admin_cannot_access=array("geographical/list_continents","geographical/add_continent","geographical/edit_continent","country/list_country","country/add_country","country/edit_country","geographical/list_states","geographical/add_state","geographical/edit_state","geographical/add_provinces");
$_provinces_admin_access = array("home/provinces_home", "geographical/ajax_handler", "geographical/list_cities", "geographical/add_city", "geographical/edit_city", "geographical/add_neighborhood", "geographical/list_neighborhoods", "geographical/edit_neighborhood", "geographical/add_company", "geographical/list_companies", "geographical/edit_company", 'users/edit_my_detail', "users/ajax_handler", "moderators/list_city_moderator", 'sublogin');


#City admin access allowed to pages in following array.
$_city_admin_access = array("moderate/win_games", "banner/main_sponsor_banner_retail", "geographical/edit_company_invoice", "geographical/call-center_settings", "geographical/list_companies_cm_call_history", "geographical/invite_mail_cm", "geographical/invite_mail_adlino", "geographical/support_call_back_list", "geographical/support_conversation", "geographical/banner_start_paket_cm", "geographical/banner_start_paket", "geographical/commercial_user_website_theme_submenu", "geographical/commercial_user_edit_new", "geographical/commercial_user_edit", "geographical/commercial_user_website_theme_menu", 'moderate/view_video', 'moderate/company_pictures', 'moderate/private_wallpaper', "help_videos_view", "ourcity/authorities_images", "moderate/private_ecard", "geographical/popup_edit_zip_codes", "geographical/popup_edit_mobile_codes", "geographical/popup_edit_phone_codes", "home/city_moderator_home", "ourcity/city_start", "ourcity/city_mall", "ourcity/authorities", "ourcity/city_gallery", "geographical/list_neighborhoods", "geographical/add_neighborhood", "geographical/edit_neighborhood", "geographical/ajax_handler", "geographical/add_company", "geographical/list_companies", "geographical/edit_company", "ourcity/company_add_keyword", "ourcity/ajax_handler", "moderate/moderate_dashboard", "moderate/videos_list", "moderate/all_videos_list", 'users/edit_my_detail', "geographical/add_company_cm", "geographical/ajax_zipcode", "geographical/ajax_phonecode", "geographical/edit_company_cm", "moderate/private_video", "moderate/edit_private_video", "moderate/ajax_image_upload", "moderate/private_picture", "moderate/edit_private_picture", 'user/ajax_users', 'order/list_order', 'order/order_detail', 'order/order_download', 'banner/city_wise_banner_request', 'banner/ajax_banner_handler', "users/ajax_handler", 'geographical/city_website_template', 'sublogin', 'geographical/weather', 'geographical/list_subcategory_keyword', 'geographical/list_private_users', 'geographical/edit_private_users', 'geographical/commercial_user_website', 'geographical/commercial_user_website_manage', 'geographical/moderator_earning', 'geographical/link', 'geographical/ajax_amount_add', 'geographical/commercial_user_website_menu_manage', 'geographical/add_new_commercial_user', 'city_administrator_terms', 'geographical/edit_company_discount', 'geographical/edit_company_user_website', 'sponsor_banner', 'sponsor_banner_retail');

# portal moderator access  
$_portal_moderator_access = array('translation/add_acteurs', "geographical/edit_movie", 'users/list_facebook_links', 'crop_image', 'geographical/list_subcategory_keyword', "geographical/ajax_handler", 'ajax_handler', 'home/portal_moderator_home', 'users/edit_my_detail', 'geographical/add_company', 'geographical/list_companies');
$_support_moderator_access = array("geographical/invite_mail_cm", "geographical/support_call_back_list", "geographical/support_conversation", 'geographical/list_subcategory_keyword', "geographical/ajax_handler", 'ajax_handler', 'home/support_moderator_home', 'users/edit_my_detail', 'geographical/add_company', 'geographical/list_companies');

# textworker have same rights as portal moderator
$_textworker_access = $_portal_moderator_access;

$_public_access = array('login', 'test');
#define page array for soap access 
$_soap_access = array("soapserver", "citysoapserver", "soap/media/soapserver", "adlinobizserver", "geographical/rss2html", "geographical/manage_feeds_url", "scriptlets/ip2geo", "content_partner/zoomin");
$time_zone = date_default_timezone_set('Europe/Berlin');
$_login_urls = array('login');
#message fr loggedin user
$_user_msg = "";

# append extra rights..
$_db = db::__d();

$query = " select aur_url from admin_user_rights where aur_au_id = '{$_SESSION['adlino_user_id']}'";
$rights_data = $_db->format_data($_db->query($query));
if (count($rights_data) > 0) {
    $_soap_access = array_merge($_soap_access, explode(",", $rights_data[0]['aur_url']));
}

global $BannerSizeArray;

global $PrintBannerSizeArray;
$PrintBannerSizeArray = array(
    "1" => array("w" => "800", "h" => "460"),
    "2" => array("w" => "2600", "h" => "560"),
);


if ($url == 'moderate/company_video')
    $url = 'moderate/all_videos_list';

if ($url == 'moderate/list_events') {
    tpl::$_vars['admin']['ctype'] = 'event';
    $url = 'moderate/list_classifieds';
}
if ($url == 'moderate/list_shop') {
    tpl::$_vars['admin']['ctype'] = 'product';
    $url = 'moderate/list_classifieds';
}

if ($url == 'geographical/edit_broadcast_content')
    $url = 'geographical/edit_tv_content';

if ($url == 'geographical/list_cinema_movies') {
    $url = 'geographical/login';
}
if ($url == 'geographical/list_singles') {
    $url = 'geographical/list_cinema_movies';
}

if ($url == 'geographical/add_cinema_movie') {
    $url = 'login';
}
if ($url == 'geographical/add_single') {
    $url = 'geographical/add_cinema_movie';
}


if ($url == 'geographical/edit_series_content')
    $url = 'geographical/edit_tv_content';

global $BannerSizeArray;
//$BannerSizeArray = array(
//    "1" => array("w" => "768", "h" => "90"),
//    "2" => array("w" => "300", "h" => "250"),
//    //"3"=>array("w"=>"120","h"=>"600"),
//    "4" => array("w" => "160", "h" => "600"),
//    "5" => array("w" => "468", "h" => "60"),
//    //"6"=>array("w"=>"120","h"=>"60"),
//    "8" => array("w" => "1280", "h" => "768"),
//    "7" => array("w" => "200", "h" => "115"),
//    "8" => array("w" => "1010", "h" => "85"),
//    "9" => array("w" => "208", "h" => "175"),
//    "10" => array("w" => "216", "h" => "175"),
//    "11" => array("w" => "208", "h" => "185"),
//    "12" => array("w" => "550", "h" => "90"),
//);
$BannerSizeArray = array(
    "1" => array("w" => "728", "h" => "90"),
    "2" => array("w" => "300", "h" => "250"),
    "4" => array("w" => "200", "h" => "600"),
    "5" => array("w" => "468", "h" => "60"),
    "8" => array("w" => "1280", "h" => "768"),
    "7" => array("w" => "200", "h" => "115"),
    "8" => array("w" => "967", "h" => "100"),
    "9" => array("w" => "200", "h" => "400")
);
define('_MEDIA_UPLOAD_URL', "http://i.naribas.de");
//define('_MEDIA_UPLOAD_URL', "http://i.naribas.de");


if ($_SESSION['adlino_user_type'] == 4 && $_SESSION['adlino_terms_accepted'] == 0 && !in_array($url, array('login'))) {
    $url = "city_administrator_terms";
}


if ($_SESSION['adlino_user_type'] == 3 && $_SESSION['adlino_terms_accepted'] == 0 && !in_array($url, array('login'))) {
    $url = "country_administrator_terms";
}
?>