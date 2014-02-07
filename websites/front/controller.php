<?php

// Log for page by dipak
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
if ($browser != 'Other') {
    $page_impression = new page_impression();
    $page_impression->log_impression($hostname, _REQUEST_PAGE, $ip_address, $os, $browser, $browser_version, $_SESSION['user_screen']);
}
global $_pageid;
switch (_REQUEST_PAGE) {

    case 'invite_friend':
        /**
         * Template Region Settigns
         */
        ctrl::$_page['pageid'] = '8';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);

        break;

    case 'job_send_to_friend':
        /**
         * Template Region Settigns
         */
        ctrl::$_page['pageid'] = '38';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);

        break;
    case 'crop_my_news_image':
    case 'crop_image':
    case 'crop_image_pu':
    case 'crop_my_cp_image':
        /**
         * Template Region Settigns
         */
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);

        break;

    case 'front':
        /**
         * Template Region Settigns
         */
        tpl::$_display = array('header' => true,
            'footer' => true,
            'supplements' => false);
        tpl::$_website_title = 'Adlino Dev';
        //echo _PATH."templates/"._WEBSITE_THEME."/over_ride/"._REQUEST_PAGE."nnnnnnnnnnnnn<br/>";

        break;
    case "login":
        ctrl::$_page['pageid'] = '8';
        tpl::$_website_title = 'Login';
        break;
    case "reset_password":
        ctrl::$_page['pageid'] = '8';
        tpl::$_website_title = 'Reset Password';
        break;


    case "webcatalog":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 250;
        break;
    case "edit_profile":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Edit Profile';
        break;

    case "my_data":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 807;
        break;
    case "online_support":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 3409;
        break;
    case "my_entry":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 509;
        break;
    case "add_keyword":
        ctrl::$_page['pageid'] = '21';
        tpl::$_website_title = 649;
        break;
    case "my_shop_setting":
        ctrl::$_page['pageid'] = '12';
        break;
    case "my_business_hours":
        ctrl::$_page['pageid'] = '12';
        tpl::$_website_title = 1349;
        break;
    case "my_order":
        tpl::$_website_title = 1843;
        break;


    case "list_company_keywords":
        ctrl::$_page['pageid'] = '21';
        tpl::$_website_title = 'Company Keyword';
        break;
    case "add_video":
        ctrl::$_page['pageid'] = '21';
        tpl::$_website_title = 632;
        break;
    case "edit_private_member":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Edit Private Member';
        break;
    case "add_description":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Add Description';
        break;
    case "add_keyword":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 649;
        break;
    case "my_vouchers":
        tpl::$_website_title = 530;
        break;
    case "my_contact_persons":
        tpl::$_website_title = 3419;
        break;

    case "change_password":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 647;
        break;
    case "change_emailid":
        ctrl::$_page['pageid'] = '1';
        tpl::$_website_title = 516;
        break;
    case "translate_keyword":
        ctrl::$_page['pageid'] = '21';
        tpl::$_website_title = 550;
        break;
    case "add_myshop_category":
        ctrl::$_page['pageid'] = '16';
        break;
    case "step2_commercial_customer":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Commercial Step2';
        break;
    case "step1":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Registration Step1';
        break;
    case "step3":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Registration Step3';
        break;
    case "my_voucher":
        ctrl::$_page['pageid'] = '21';
        tpl::$_website_title = 'My Voucher';
        break;
    case "user_login_info":
        ctrl::$_page['pageid'] = '21';
        tpl::$_website_title = 'User Login Info';
        break;
    case "my_banners":
        ctrl::$_page['pageid'] = '21';
        tpl::$_website_title = 541;
        break;
    case "step4":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Registration Step4';
        break;
    case "step2_individuals":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Step2 Individual';
        break;
    case "classified/general_classified_step2":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'General Classified Step2';
        break;
    case "classified/display_classified":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Display Classified';
        break;
    case "add_general_classified":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 883;
        break;
    case "add_car_classified":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 1084;
        break;
    case "my_voucher":
        ctrl::$_page['pageid'] = '62';
        tpl::$_website_title = 'My Voucher';
        break;
    case "home":
        ctrl::$_page['pageid'] = '19';
        tpl::$_website_title = 41;
        break;
    case "company":
        ctrl::$_page['pageid'] = '20';
        tpl::$_website_title = 'Company';
        break;
    case "classifieds":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Classified';
        break;
    case "landing":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 866;
        break;
    case "web_search":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 195;
        break;

    case "car_landing":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 887;
        break;
    case "event_landing":
        tpl::$_website_title = 244;
        break;
    case "ajax_handler":
        ctrl::$_page['pageid'] = '21';
        break;
    case "ajax_add_website":
        ctrl::$_page['pageid'] = '16';
        break;
    case "translate_description":
        ctrl::$_page['pageid'] = '21';
        tpl::$_website_title = 554;
        break;
    case "add_language":
        tpl::$_website_title = 207;
        break;

    case "private_member_profile":
        ctrl::$_page['pageid'] = '12';
        tpl::$_website_title = 'Private Member Profile';
        break;
    case "my_content":
        ctrl::$_page['pageid'] = '12';
        tpl::$_website_title = 'My Video';
        break;
    case "add_myshop_category":
        ctrl::$_page['pageid'] = '62';
        tpl::$_website_title = 'Myshop Category';
        break;
    case "add_voucher":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Voucher';
        break;
    case "classified_send_to_friend":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        ctrl::$_page['pageid'] = '12';
        break;
    case "invite_friend_game":
        ctrl::$_page['pageid'] = '26';
        tpl::$_website_title = 'Adlino Invite Friend Game : Win Exciting Prices';
        break;
    case "invite_game_termsandcondition":
    case "private_user_termsandcondition":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;

//    case "commercial_user_termsandcondition":
//        tpl::$_display = array('header' => false,
//            'footer' => false,
//            'supplements' => false);
//        break;

    case "view_company_voucher":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;

    case "view_company_banner":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;


    case "view_company_video":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;


    case "upload_banner_images":
        ctrl::$_page['pageid'] = '16';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "forgot_password":
        ctrl::$_page['pageid'] = '8';
        tpl::$_website_title = 'Forgot Password';
        break;
    case "company_information":
        ctrl::$_page['pageid'] = '8';
        tpl::$_website_title = 'Company Information';
        break;
    case "upload_video":
        ctrl::$_page['pageid'] = '1';
        tpl::$_website_title = 'Upload Video';
        break;
    case "private_member_send_to_friend":
        ctrl::$_page['pageid'] = '12';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "ajax_member_send_to_friend":
        ctrl::$_page['pageid'] = '12';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "private_member_report_user":
        ctrl::$_page['pageid'] = '12';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "ajax_member_user_report":
        ctrl::$_page['pageid'] = '12';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "private_member_subscribe":
        ctrl::$_page['pageid'] = '12';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "ajax_member_subscribe":
        ctrl::$_page['pageid'] = '12';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "private_member_block_user":
        ctrl::$_page['pageid'] = '12';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "private_user_search":
        ctrl::$_page['pageid'] = '12';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "ajax_member_block_user":
        ctrl::$_page['pageid'] = '12';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "general_classified_details":
        ctrl::$_page['pageid'] = '12';
        tpl::$_website_title = 'General Classified Details';
        break;


    case "job_details":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Job Details';
        break;

    case "upload_picture":
        ctrl::$_page['pageid'] = '1';
        tpl::$_website_title = 'Upload Picture';
        break;
    case "subscribe_content":
        ctrl::$_page['pageid'] = '1';
        tpl::$_website_title = 'Subscribe Content';
        break;

    case "upload_wallpaper":
        ctrl::$_page['pageid'] = '1';
        tpl::$_website_title = 'Upload Wallpaper';
        break;
    case "edit_user_picture":
        tpl::$_website_title = 'Edit Picture';
    case "edit_upload_video":
        tpl::$_website_title = 'Edit Video';
    case "edit_user_ecard":
        tpl::$_website_title = 'Edit Ecard';
    case "edit_user_wallpaper":
        ctrl::$_page['pageid'] = '1';
        tpl::$_website_title = 'Edit Wallpaper';
        break;
        ctrl::$_page['pageid'] = '1';
        break;
    case "upload_ecard":
        ctrl::$_page['pageid'] = '1';
        tpl::$_website_title = 'Upload Ecard';
        break;
    /* For My shop Section */
    case "my_shop_add":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'My Shop Add';
        break;
    case "my_shop_details":
        ctrl::$_page['pageid'] = '12';
        tpl::$_website_title = 'My Shop Details';
        break;
    case "my_shop_landing":
        ctrl::$_page['pageid'] = '12';
        break;
    case "relavant_keyword":
        ctrl::$_page['pageid'] = '12';
        tpl::$_website_title = 'Relavant Keyword';
        break;
    case "my_car_classified":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 763;
        break;
    case "my_event_landing":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 2238;
        break;
    case "add_event":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 2237;
        break;

    case "my_shop":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 1369;
        break;
    case "private_member_upload":
        ctrl::$_page['pageid'] = '12';
        tpl::$_website_title = 'Private Member Upload';
        break;

    case "car_classified_step_3":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Car Classified Step3';
        break;


    case "mail_create":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Mail Create';
        break;
    case "mail_details":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Mail Details';
        break;
    case "mail_inbox":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = '1551';
        break;
    case "mail_outbox":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 1552;
        break;

    case "my_video":
        tpl::$_website_title = 632;
        break;
    case "my_picture":
        tpl::$_website_title = 633;
        break;
    case "my_ecard":
        tpl::$_website_title = 635;
        break;
    case "my_wallpaper":
        tpl::$_website_title = 634;
        break;

    case "my_favourite_general_classified":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 866;
        break;
//    case "my_general_classified":
//        ctrl::$_page['pageid'] = '16';
//        tpl::$_website_title = 981;
//        break;
    case "classified_step_4":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Classified Step4';
        break;


    case "my_friends":
        ctrl::$_page['pageid'] = '12';
        tpl::$_website_title = 'My Friends';
        break;
    case "myshop_step_2_private":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Myshop Step2 Private';
        break;
    case "myshop_step_2_commercial":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Myshop Step2 Commercial';
        break;
    case "myshop_step_3":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Myshop Step3';
        break;

    case "myshop_step_4":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Myshop Step4';
        break;


    case "picture_landing":
        ctrl::$_page['pageid'] = '12';
        tpl::$_website_title = 198;
        break;

    case "playlist":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'My Playlist';
        break;
    case "view_user_ecard":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'View Ecard';
        break;
    case "view_user_picture":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'View Picture';
        break;
    case "view_user_wallpaper":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'View Wallpaper';
        break;
    case "view_user_video":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'View Video';
        break;
    case "friend_request_details":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Friend Request';
        break;
    case "last_visitors":
        ctrl::$_page['pageid'] = '16';
        break;
    case 'report_abuse':
        ctrl::$_page['pageid'] = 16;
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case 'step1':
        $_pageid = 3;
        tpl::$_website_title = 'Registration Step1';
    case 'index':
        $_pageid = 4;
    case 'step4':
        $_pageid = 5;
        tpl::$_website_title = 'Registration Step4';

    case "shopping_buy_now":
        ctrl::$_page['pageid'] = '12';
        break;
    case "payment_settings":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 'Payment Info';
        break;
    case "my_shopping_details":
        ctrl::$_page['pageid'] = '12';
        tpl::$_website_title = 'Shopping Details';
        break;

    /* added on 17-04-2010 */
    case "private_member_profile":
        ctrl::$_page['pageid'] = '12';
        tpl::$_website_title = 45;
        break;
    case 'shopping_landing':
        tpl::$_website_title = 199;
        break;
    case 'video_landing':
        tpl::$_website_title = 197;
        break;
    case 'ecard_landing':
        tpl::$_website_title = 903;
        break;
    case 'wallpaper_landing':
        tpl::$_website_title = 904;
        break;
    case 'my_products':
        tpl::$_website_title = 1369;
        break;
    case 'add_new_product':
        tpl::$_website_title = 1799;
        break;
    case 'my_shop_category':
        tpl::$_website_title = 1371;
        break;
    case 'my_shop_setting':
        tpl::$_website_title = 1372;
        break;
    case 'top_offers':
        tpl::$_website_title = 2359;
        break;

    case 'cost_details':
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 1866;
        break;
    case 'cost_price_list':
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 1867;
        break;
    case 'my_website':
        ctrl::$_page['pageid'] = '6';
        tpl::$_website_title = 189;
        break;

    case "job_landing":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 866;
        break;

    case "commercials_home_page":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 866;
        break;

    case "my_job_ads":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 798;
        break;

    case "edit_general_job":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 866;
        break;
    case 'private_video':
        ctrl::$_page['pageid'] = '32';
        tpl::$_website_title = 866;
        break;
    case "my_website_privacy_policy":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 866;
        break;

    case "voucher_cards":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 866;
        break;
    case "voucher_cards_designs":
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 866;
        break;

    case "voucher_cards_elements_settings":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 866;
        break;
    case "voucher_cards_elements_settings_advance":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 866;
        break;


    case "voucher_cards_elements_edit":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        ctrl::$_page['pageid'] = '16';
        tpl::$_website_title = 866;
        break;

    case "adlino_card":
        ctrl::$_page['pageid'] = '1';
        tpl::$_website_title = 2878;
        break;
    case "private_adlino_card_main":
        ctrl::$_page['pageid'] = '1';
        tpl::$_website_title = 2878;
        break;
    case "private_adlino_card":
        ctrl::$_page['pageid'] = '1';
        tpl::$_website_title = 2878;
        break;
    case "my_adlino_card":
        ctrl::$_page['pageid'] = '1';
        tpl::$_website_title = 2878;
        break;
    case "add_job_step_1":
        ctrl::$_page['pageid'] = '31';
        tpl::$_website_title = 883;
        break;
    case "my_commercial_pictures":
        tpl::$_website_title = 633;
        break;



    case "upload_video_backend_simul":
    case "upload_picture_backend_simul":
    case "upload_ecard_backend_simul":
    case "upload_wallpapers_backend_simul":
        ctrl::$_page['pageid'] = '54';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false); 
        break;
    case "step1_help":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    default:
        ctrl::$_page['pageid'] = '16';
}
_include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_" . ctrl::$_page['pageid'] . ".php");
_include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_general_terms.php");
global $_l;
tpl::$_vars['lang_ref'] = &$_l;
tpl::$_website_title = tpl::$_vars['lang_ref'][tpl::$_website_title];

if (isset($_GET['print'])) {
    tpl::$_display = array('header' => false,
        'footer' => false,
        'supplements' => false);
}
global $secTerm, $canAllTerm, $canTerm;
$secTerm = tpl::$_vars['lang_ref'][3834];
$canAllTerm = tpl::$_vars['lang_ref'][3835];
$canTerm = tpl::$_vars['lang_ref'][3836];
?>