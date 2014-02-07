<?php

global $_pageid;

switch (_REQUEST_PAGE) {
    case 'login':
        /**
         * Template Region Settigns
         */
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        ctrl::$_page['pageid'] = '45';


        break;
    case 'geographical/refresh':
        /**
         * Template Region Settigns
         */
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        ctrl::$_page['pageid'] = '6';


        break;
    case 'autogenerate_user':
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;

    case "header";
        $_pageid = "41";
        break;
    case "admin_dashboard";
        ctrl::$_page['pageid'] = '40';
        $_pageid = "40";
        break;
    
    case "users/add_user":

        ctrl::$_page['pageid'] = '1';
        break;
    case "users/list_users":

        ctrl::$_page['pageid'] = '1';
        break;
    case "users/add_moderator_general":

        ctrl::$_page['pageid'] = '1';
        break;

    case "users/add_moderator_country":

        ctrl::$_page['pageid'] = '1';
        break;


    case "users/edit_city_moderator":

        ctrl::$_page['pageid'] = '1';
        break;
    case "users/list_moderator_general":

        ctrl::$_page['pageid'] = '1';
        break;

    case "geographical/list_private_users":

        ctrl::$_page['pageid'] = '1';
        break;
    case "geographical/edit_private_users":

        ctrl::$_page['pageid'] = '1';
        break;
    case "geographical/manage_horoscope_signs":
        ctrl::$_page['pageid'] = '30';
        break;
    case "geographical/edit_horoscope_details":
        ctrl::$_page['pageid'] = '30';
        break;
    case "geographical/edit_horoscope":
        ctrl::$_page['pageid'] = '30';
        break;
    case "geographical/manage_horoscope_details":
        ctrl::$_page['pageid'] = '30';
        break;
    case "users/edit_user":

        ctrl::$_page['pageid'] = '1';
        break;
    case "users/edit_moderator_general":

        ctrl::$_page['pageid'] = '1';
        break;

    case "lottery/add_lottery_number":
        ctrl::$_page['pageid'] = '10';
        //ctrl::$_page['pageid'] = '28';
        break;

    case "users/edit_my_detail":

        ctrl::$_page['pageid'] = '1';
        break;

    case "geographical/admin_info_website":
        ctrl::$_page['pageid'] = '39';
        break;

    case "geographical/admin_info_edit":
        ctrl::$_page['pageid'] = '40';
        break;

    case "geographical/qna":
        ctrl::$_page['pageid'] = '42';
        tpl::$_website_title = 'Question and Answer Management';

        break;

    case "geographical/qna_edit":
        ctrl::$_page['pageid'] = '42';
        tpl::$_website_title = 'Question and Answer Management';

        break;

    case "voucher_cards/voucher_types":
        ctrl::$_page['pageid'] = '51';
        tpl::$_website_title = 'Voucher Cards Type Management';

        break;

    case "voucher_cards/voucher_types_costs":
        ctrl::$_page['pageid'] = '52';
        tpl::$_website_title = 'Voucher Cost Management';

        break;

    case "geographical/manage_feeds_url":
        ctrl::$_page['pageid'] = '63';
        tpl::$_website_title = 'News Feeds URL Management';

        break;


    case "translation/add_language":
        ctrl::$_page['pageid'] = '2';
        $pageid = "1";
        break;

    case "newscategory/lists_news_category":
        ctrl::$_page['pageid'] = '62';
        tpl::$_website_title = 'News Category Management';
        break;

    case "translation/list_language":
        ctrl::$_page['pageid'] = '2';
        $pageid = "1";
        break;
    case "translation/edit_language":
        ctrl::$_page['pageid'] = '2';
        $pageid = "2";
        break;

    case "category/lists_category":
        ctrl::$_page['pageid'] = '4';
        break;
    case "classifiedcategory/lists_classified_category":

        ctrl::$_page['pageid'] = '4';
        break;
    case "classifiedcategory/lists_classified_subcategory":

        ctrl::$_page['pageid'] = '4';
        break;
    case "classifiedcategory/lists_shop_category":

        ctrl::$_page['pageid'] = '4';
        break;
    case "classifiedcategory/lists_shop_subcategory":

        ctrl::$_page['pageid'] = '4';
        break;
    case "category/lists_subcategory":

        ctrl::$_page['pageid'] = '4';
        break;

    case "keyword/lists_keyword":
        ctrl::$_page['pageid'] = '5';
        $_pageid = "5";
        break;

    case "geographical/list_continents":
        ctrl::$_page['pageid'] = '9';
        $_pageid = "9";
        break;
    case "geographical/add_continent":
        ctrl::$_page['pageid'] = '9';
        $_pageid = "9";
        break;
    case "geographical/edit_continent":
        ctrl::$_page['pageid'] = '9';
        $_pageid = "9";
        break;
    case "footer_content":
        ctrl::$_page['pageid'] = '9';
        $_pageid = "1";
        break;
    case "country/add_country":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "country/list_country":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "country/edit_country":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "country/edit_country":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "firma/add_firma":
        ctrl::$_page['pageid'] = '1';
        $_pageid = "1";
        break;
    case "geographical/edit_cinema_movie":
        ctrl::$_page['pageid'] = '1';
        $_pageid = "1";
        break;

    case "geographical/add_cinema_movie":
        ctrl::$_page['pageid'] = '1';
        $_pageid = "1";
        break;

    /* 	case "firma/list_cinema_movies":
      ctrl::$_page['pageid'] = '1';
      $_pageid="29";
      break; */

    case "geographical/add_state":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "geographical/list_states":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "geographical/edit_state":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;


    case "geographical/edit_provinces":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "geographical/add_provinces":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "geographical/list_provinces":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;


    case "geographical/add_city":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "geographical/list_cities":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "geographical/edit_city":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;


    case "geographical/add_neighborhood":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "geographical/list_neighborhoods":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "geographical/edit_neighborhood":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;


    case "geographical/add_company":

        $_pageid = "6";
        break;
    case "geographical/upload_companies":

        $_pageid = "6";
        break;
    case "geographical/add_company_cm":

        $_pageid = "6";
        break;
    case "geographical/list_companies":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "geographical/edit_company":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;
    case "geographical/edit_company_cm":
        ctrl::$_page['pageid'] = '6';
        $_pageid = "6";
        break;

    case "translation/add_translation":

        ctrl::$_page['pageid'] = '7';
        break;
    case "translation/add_translation_adlino_info":

        ctrl::$_page['pageid'] = '7';
        break;

    case "translation/add_cat_translation":

        ctrl::$_page['pageid'] = '7';
        break;
    case "translation/add_company_translation":

        ctrl::$_page['pageid'] = '7';
        break;
    case "translation/add_keywords_translation":

        ctrl::$_page['pageid'] = '7';
        break;
    case "translation/user_define_translation":

        ctrl::$_page['pageid'] = '7';
        break;
    case "translation/add_mails_translation":

        ctrl::$_page['pageid'] = '7';
        break;

    case "order/list_order":

        ctrl::$_page['pageid'] = '11';
        break;
    case "home/city_moderator_home":

        ctrl::$_page['pageid'] = '11';
        break;
    case "ourcity/authorities":

        ctrl::$_page['pageid'] = '11';
        break;
    case "ourcity/city_start":

        ctrl::$_page['pageid'] = '11';
        break;
    case "ourcity/city_mall":

        ctrl::$_page['pageid'] = '11';
        break;
    case "ourcity/city_gallery":

        ctrl::$_page['pageid'] = '11';
        break;
    case "website/list_website":

        ctrl::$_page['pageid'] = '11';
        break;
    case "home/admin_dashboard":

        ctrl::$_page['pageid'] = '9';
        break;

    case "home/country_admin_home":

        ctrl::$_page['pageid'] = '9';
        break;
    case "home/state_admin_home":

        ctrl::$_page['pageid'] = '9';
        break;
    case "home/provinces_home":

        ctrl::$_page['pageid'] = '9';
        break;
    case "home/translation_moderator_home":

        ctrl::$_page['pageid'] = '9';
        break;
    case "webpage/edit_webpage":

        ctrl::$_page['pageid'] = '11';
        break;
    case "website/add_website":

        ctrl::$_page['pageid'] = '11';
        break;
    case "website/edit_website":

        ctrl::$_page['pageid'] = '11';
        break;
    case "webpage/add_webpage":

        ctrl::$_page['pageid'] = '11';
        break;
    case "translationterm/list_wtm":

        ctrl::$_page['pageid'] = '11';
        break;
    case "translationterm/add_wtm":

        ctrl::$_page['pageid'] = '11';
        break;
    case "translationterm/edit_wtm":

        ctrl::$_page['pageid'] = '11';
        break;

    case "mails/add_mails":

        //$_pageid="51";
        ctrl::$_page['pageid'] = '9';
        break;
    case "mails/edit_mails":

        //$_pageid="51";
        ctrl::$_page['pageid'] = '9';
        break;
    case "mails/list_mails":

        //$_pageid="51";
        ctrl::$_page['pageid'] = '9';
        break;

    case "moderate/moderate_dashboard":

        ctrl::$_page['pageid'] = '14';
        break;
    case "moderate/view_classifieds":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        //$_pageid="51";
        ctrl::$_page['pageid'] = '14';
        break;
    case "moderate/view_events":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        //$_pageid="51";
        ctrl::$_page['pageid'] = '14';
        break;
    case "moderate/all_vouchers_list":
    case "moderate/vouchers_list":

        //$_pageid="51";
        ctrl::$_page['pageid'] = '14';
        break;
    case "moderate/videos_list":
    case "moderate/all_videos_list":

        //$_pageid="51";
        ctrl::$_page['pageid'] = '14';
        break;
    case "moderate/ajax_image_upload":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        ctrl::$_page['pageid'] = '14';
        break;
    case "moderate/edit_private_video":

        //$_pageid="51";
        ctrl::$_page['pageid'] = '14';
        break;
    case "moderate/private_picture":

        //$_pageid="51";
        ctrl::$_page['pageid'] = '14';
        break;
    case "moderate/edit_private_picture":

        //$_pageid="51";
        ctrl::$_page['pageid'] = '14';
        break;
    case "moderate/edit_private_ecard":

        //$_pageid="51";
        ctrl::$_page['pageid'] = '14';
        break;
    case "moderate/edit_private_wallpaper":

        //$_pageid="51";
        ctrl::$_page['pageid'] = '14';
        break;

    case "translation/add_classified_cat_translation":

        ctrl::$_page['pageid'] = '18';
        break;
    /* ..................End Here............. */

    case "classifiedcategory/lists_classified_category":

        ctrl::$_page['pageid'] = '55';
        break;
    case "classifiedcategory/lists_classified_subcategory":

        ctrl::$_page['pageid'] = '55';

    case "translation/add_user_keyword_translation":
        ctrl::$_page['pageid'] = '52';
        $_pageid = "52";
        break;
    case "geographical/add_company_for_front":

        $_pageid = "23";
        break;
    case "translation/add_new_classified_category":
        $_pageid = "18";
        ctrl::$_page['pageid'] = "18";
        break;
    case "termsandcondition/add_termsandcondition_translation":
        $_pageid = "7";
        ctrl::$_page['pageid'] = "7";
        break;
    case "termsandcondition/add_termandcondition":
        $_pageid = "7";
        ctrl::$_page['pageid'] = "7";
        break;
    case "category/list_category_user_video":
        $_pageid = "4";
        ctrl::$_page['pageid'] = "4";
        break;
    case "category/list_category_user_picture":
        $_pageid = "4";
        ctrl::$_page['pageid'] = "4";
        break;
    case "geographical/popup_edit_phone_codes";
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "geographical/popup_edit_mobile_codes";
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "geographical/popup_edit_zip_codes";
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "classifiedcategory/edit_shop_subcategory":
        ctrl::$_page['pageid'] = "14";
        break;
    case "translation/add_shop_cat_translation":
    case "translation/add_shop_banner_text_translation":
        ctrl::$_page['pageid'] = "14";
        break;
    case "geographical/manage_star_search":
    case "geographical/list_top_search_terms":
    case "geographical/add_top_search_term":
    case "geographical/manage_tuning_cars":
    case "geographical/manage_movie_wallpaper":
    case "geographical/manage_video_search":
        ctrl::$_page['pageid'] = "1";
        break;
    case "geographical/add_domain":
    case "geographical/edit_domain":
        ctrl::$_page['pageid'] = "1";
        break;
    case "geographical/add_horoscope_category":
    case "geographical/edit_horoscope_category":

        ctrl::$_page['pageid'] = "6";
        break;

    /*
     * START HERE 20100403
     */
    case "moderate/list_events":

        ctrl::$_page['pageid'] = '6';
        break;
    case "moderate/list_classifieds":

        ctrl::$_page['pageid'] = '6';
        break;
    case "geographical/add_jocks":
        ctrl::$_page['pageid'] = '6';
        break;
    case "moderate/crop_image":
        ctrl::$_page['pageid'] = '14';
        break;
    case "moderate/crop_ecard":
        ctrl::$_page['pageid'] = '14';
        break;

    default:
        $_pageid = "18";
        ctrl::$_page['pageid'] = "18";
        break;

    case "geographical/list_subcategory_keyword":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        //$_pageid="51";
        ctrl::$_page['pageid'] = '14';
        break;
    case "geographical/commercial_user_website":
        ctrl::$_page['pageid'] = '6';
        break;
    case "geographical/commercial_user_website_manage":
        ctrl::$_page['pageid'] = '6';
        break;
    case "geographical/commercial_user_website_menu_manage":
        ctrl::$_page['pageid'] = '6';
        break;



    case 'moderate/report_abuse':

        ctrl::$_page['pageid'] = 16;
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case "geographical/manage_theme":
        ctrl::$_page['pageid'] = '33';
        break;
    case "account/manage_fees":
        ctrl::$_page['pageid'] = '37';
        break;
    case "account/manage_fees_type":
        ctrl::$_page['pageid'] = '38';
        break;
    case "geographical/sample_templates":
        ctrl::$_page['pageid'] = '6';
        break;
    case "geographical/moderator_earning":
        ctrl::$_page['pageid'] = '36';
        break;
    case "geographical/link":
        ctrl::$_page['pageid'] = '6';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;

    case "city_administrator_terms";
        ctrl::$_page['pageid'] = '47';
        break;
    case "country_administrator_terms";
        ctrl::$_page['pageid'] = '47';
        break;

    case "moderate/car_classified_details":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        ctrl::$_page['pageid'] = '50';
        break;

    case 'geographical/commercial_user_edit_new':
        ctrl::$_page['pageid'] = '6';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;

    case 'geographical/weather_image_upload':
        ctrl::$_page['pageid'] = '6';

        break;
    case 'geographical/weather_image_edit':
        ctrl::$_page['pageid'] = '6';

        break;
    case 'geographical/weather_image_cities':
        ctrl::$_page['pageid'] = '6';

        break;
    case 'geographical/list_news':
        ctrl::$_page['pageid'] = '55';

        break;

    case 'voucher_cards/voucher_cards_elements_settings':
        ctrl::$_page['pageid'] = '14';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case 'voucher_cards/voucher_cards_elements_settings_advance':
        ctrl::$_page['pageid'] = '14';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;

    case 'voucher_cards/voucher_cards_elements_edit':
        ctrl::$_page['pageid'] = '14';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;

    case 'voucher_cards/voucher_cards_manage':
    case 'voucher_cards/voucher_cards_manage_new':
        ctrl::$_page['pageid'] = '14';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case 'voucher_cards/voucher_cards_picture_library':
        ctrl::$_page['pageid'] = '14';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;

    case 'geographical/admin_info_google_chart':
        ctrl::$_page['pageid'] = '6';
        tpl::$_display = array('only_tpl' => true);
        break;
    case 'geographical/city_user_import':
        ctrl::$_page['pageid'] = '6';

        break;
    case 'geographical/city_user_import_json':
        ctrl::$_page['pageid'] = '6';

        break;
    case 'geographical/city_user_adhoster_add':
        ctrl::$_page['pageid'] = '6';

        break;
    case 'geographical/list_news':
    case 'geographical/tips_and_advice':
        ctrl::$_page['pageid'] = '55';
        break;
    case 'cityjump/cityjump_website_menus':
    case 'cityjump/cityjump_website_submenus':
    case 'cityjump/ajax_cityjump_menu':
    case 'cityjump/cityjump_edit':
        include _PATH . "websites/admin/cityjump/cityjump.config.inc.php";
        break;

    case 'geographical/rss2html':
        ctrl::$_page['pageid'] = '6';
        tpl::$_display = array('only_tpl' => true);
        break;

    case 'geographical/edit_company_discount':
        ctrl::$_page['pageid'] = '6';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;

    case 'geographical/edit_company_user_website':
        ctrl::$_page['pageid'] = '6';
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
    case 'geographical/adlino_card_import':
        ctrl::$_page['pageid'] = '6';

        break;
    case 'geographical/city_website_google_chart':
        ctrl::$_page['pageid'] = '6';
        tpl::$_display = array('only_tpl' => true);
        break;

    case 'sponsor_banner':
        ctrl::$_page['pageid'] = '1';


        break;
    case 'sponsor_banner_retail':
        ctrl::$_page['pageid'] = '1';

        break;
    case 'moderate/view_shop':
    case 'geographical/edit_movie_add_content';
    case "help_videos_view":
        tpl::$_display = array('header' => false,
            'footer' => false,
            'supplements' => false);
        break;
}
_include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_" . ctrl::$_page['pageid'] . ".php");
_include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_general_terms.php");
global $_l;
tpl::$_vars['lang_ref'] = &$_l;

if (isset($_GET['print'])) {
    tpl::$_display = array('header' => false,
        'footer' => false,
        'supplements' => false);
}
?>