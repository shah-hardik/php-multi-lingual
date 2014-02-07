<?php

class tpl {

    public static $_website_title = 'Adlino';
    public static $_meta_description_content = '';
    public static $_meta_keywords_content = '';
    public static $_meta_og_image = '';
    public static $_meta_og_title = '';
    public static $_meta_og_desc = '';
    public $_website_template = 'admin_default';
    public static $_display = array('header' => true,
        'footer' => true,
        'supplements' => true,
        'only_tpl' => FALSE);
    public static $_request_content = 'Welcome to adlino';
    public static $_vars = array('main_tpl'=>'index.tpl.php');
    public static $partner_content_category;
    public static $partner_content_ds;

    public function __construct() {
        
    }

    public function load() {
        
        if (is_file(_PATH . "websites/" . _WEBSITE_NAME . "/" . _REQUEST_PAGE . ".inc.php")) {
            include(_PATH . "websites/" . _WEBSITE_NAME . "/" . _REQUEST_PAGE . ".inc.php");
        } else {
            include(_PATH . "websites/" . _WEBSITE_NAME . "/404.inc.php");
        }

        # modified to include tpl.php file content only.
        if (TRUE === tpl::$_display['only_tpl']) {
            if (is_file(_PATH . "templates/" . _WEBSITE_THEME . "/" . _REQUEST_PAGE . ".tpl.php")) {
                include(_PATH . "templates/" . _WEBSITE_THEME . "/" . _REQUEST_PAGE . ".tpl.php");
            } else {
                include(_PATH . "templates/" . _WEBSITE_THEME . "/404.tpl.php");
            }
        } else {
            include(_PATH . "templates/" . _WEBSITE_THEME . "/" . tpl::$_vars['main_tpl']);
        }


        /* Commented by vipul on 27 )OCT 2009 */

        //include(_PATH."websites/"._WEBSITE_NAME."/"._REQUEST_PAGE.".inc.php");
        //include(_PATH."templates/"._WEBSITE_THEME."/index.tpl.php");
    }

    public function load_request() {
        //print tpl::$_request_content;

        _include_if(_PATH . "templates/" . _WEBSITE_THEME . "/" . _REQUEST_PAGE . ".tpl.php");
    }

    #for loading Language data   
    # Added by Dipali As Part of Translation schema on 09/09/09
    /* public function load_lang_data()
      {
      #call for header langauge support combo dispaly
      //global	$_avail_lang;
      //$avail_languages=dc_get_langugages_header();

      } */

    public function load_header() {
        if (tpl::$_display['header'])
            include(_PATH . "templates/" . _WEBSITE_THEME . "/" . "header.tpl.php");
    }

    public function load_footer() {
        if (tpl::$_display['footer'])
            _include_if(_PATH . "templates/" . _WEBSITE_THEME . "/" . "footer.tpl.php");
    }

    public function load_supplements() {
        if (tpl::$_display['supplements'])
            _include_if(_PATH . "templates/" . _WEBSITE_THEME . "/" . "supplements.tpl.php");
    }

    public function over_ride_default_media() {
        _include_if(_PATH . "templates/" . _WEBSITE_THEME . "/over_ride/" . _REQUEST_PAGE . "_over_ride.tpl.php");
    }

    public function load_global_media() {
        include(_PATH . "media/global_style.css");
    }

}

?>