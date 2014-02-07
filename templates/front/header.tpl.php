<?php
/* if(!isset($_SESSION['user_id']) && $_SESSION['th'] != $_COOKIE['theme_color'] && isset($_GET['th'])){
  setcookie("theme_color",$_SESSION['th']);
  $loc = "REF:".$_SERVER['HTTP_REFERER'];

  header("location:".$loc);
  exit;
  } */
global $_pageid;

$_pageid = 22;
_include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_" . $_pageid . ".php");
_include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_general_terms.php");
global $_l;

$soap = new soap_abstract();
//	echo $_SERVER['QUERY_STRING'];
$count_user_inbox = unserialize($soap->count_user_inboxmail($_SESSION['user_id']));
//d($count_user_inbox);
$userid = $_SESSION['user_id'];
$table_details = unserialize($soap->table_details($userid));
//d($table_details);
if ($table_details[0]['user_type'] == 'individual') {
$table_name = 'city_user';
} else {
$table_name = 'companies ';
}
$company_id = $_SESSION['company_id'];
$private_user_info = unserialize($soap->private_user_detail($company_id, $table_name));
if (isset($_SESSION['lid']))
$l_id = $_SESSION['lid'];
else
$l_id = DEFAULT_LANG;
$_SESSION['country_name'] = $country_name = getCountryName($l_id, 6);

$_theme = array(
'sky_blue' => array('general_color' => '#0C97DC', 'border_color' => '#8284AC', 'footer_font_color' => '#8284AC', 'light_color' => '#E7E7FF', 'glowtab_left' => '1.jpg', 'glowtab' => '1-1.jpg', 'btn_colr' => '#178DC7', 'btn_image' => '3', 'btn_shadow' => '#116A96'),
 'orange' => array('general_color' => '#DC7817', 'border_color' => '#8284AC', 'footer_font_color' => 'white', 'light_color' => '#FEE2BA', 'glowtab_left' => '2.jpg', 'glowtab' => '2-1.jpg', 'btn_colr' => '#C56D19', 'btn_image' => '2', 'btn_shadow' => '#A15912'),
 'green' => array('general_color' => '#3EA839', 'border_color' => '#8284AC', 'footer_font_color' => '#8284AC', 'light_color' => '#BDFFBD', 'glowtab_left' => '3.jpg', 'glowtab' => '3-1.jpg', 'btn_colr' => '#288F23', 'btn_image' => '4', 'btn_shadow' => '#1C7617'),
 'red' => array('general_color' => '#D22D27', 'border_color' => '#8284AC', 'footer_font_color' => '#8284AC', 'light_color' => '#FFD1D1', 'glowtab_left' => '5.jpg', 'glowtab' => '5-1.jpg', 'btn_colr' => '#B82822', 'btn_image' => '6', 'btn_shadow' => '#9B231E'),
 'blue' => array('general_color' => '#2916D3', 'border_color' => '#8284AC', 'footer_font_color' => '#8284AC', 'light_color' => '#FFD1D1', 'glowtab_left' => '4.jpg', 'glowtab' => '4-1.jpg', 'btn_colr' => '#2916D3', 'btn_image' => '5', 'btn_shadow' => '#2719A9'),
 'maroon' => array('general_color' => '#A32743', 'border_color' => '#8284AC', 'footer_font_color' => '#8284AC', 'light_color' => '#FFC5C5', 'glowtab_left' => '32.jpg', 'glowtab' => '32-1.jpg', 'btn_colr' => '#A52C47', 'btn_image' => '7', 'btn_shadow' => '#7E1930'),
 'dark_orange' => array('general_color' => '#8b4513', 'border_color' => '#8284AC', 'footer_font_color' => '#8284AC', 'light_color' => '#FFD1D1', 'glowtab_left' => '33.jpg', 'glowtab' => '33-1.jpg', 'btn_colr' => '#824316', 'btn_image' => '8', 'btn_shadow' => '#6F3913'),
 'dark_pink' => array('general_color' => '#8b008b', 'border_color' => '#8284AC', 'footer_font_color' => '#8284AC', 'light_color' => '#FFC5C5', 'glowtab_left' => '34.jpg', 'glowtab' => '34-1.jpg', 'btn_colr' => '#750175', 'btn_image' => '9', 'btn_shadow' => '#660666'),
 'normal_blue' => array('general_color' => '#424181', 'border_color' => '#8284AC', 'footer_font_color' => '#8284AC', 'light_color' => '#D7D7FF', 'glowtab_left' => '35.jpg', 'glowtab' => '35-1.jpg', 'btn_colr' => '#464584', 'btn_image' => '10', 'btn_shadow' => '#333266')
);
$db = db::__d();
//code to add theme_color in users table

if (isset($_SESSION['user_id']) && ($_SESSION['th'] != $_SESSION['theme_color'])) {
$_SESSION['th'] = $_SESSION['theme_color'];
}
if (isset($_GET['th']) && $_GET['th'] != '' && isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {

$db->query("update user_all set theme_color ='" . $_GET['th'] . "' where user_id = " . $_SESSION['user_id']);
$_SESSION['th'] = $_GET['th'];
$_SESSION['theme_color'] = $_GET['th'];
}

# override default theme if there is get variable

$_SESSION['th'] = isset($_GET['th']) ? $_GET['th'] : $_SESSION['th'];

# prevent bad entries via GET variable.

$_SESSION['th'] = in_array($_SESSION['th'], array('sky_blue', 'blue', 'orange', 'green', 'red', 'maroon', 'dark_orange', 'dark_pink', 'normal_blue')) ? $_SESSION['th'] : 'red';
$_SESSION['th_gn_color'] = $_theme[$_SESSION['th']]['general_color'];

$_db = db::__d();
$credit_query = sprintf(" select count(fucm_id) as total_bought_credit from flyer_user_credit_master where fucm_user_id  = '%d' ", $_SESSION['user_id']);
$_credit_query_data = $_db->format_data($_db->query($credit_query));
$_SESSION['total_bought_credit'] = $_credit_query_data[0]['total_bought_credit'];


/* Get parent id of company category. for my_menu_category menus... only for hotelier 1612 as parent cat id */
$comp_id = $_SESSION['company_id'] ? $_SESSION['company_id'] : 0;
$query = "select cat.parent_id from company_category cc LEFT JOIN category cat on cat.cat_id = cc.category_id WHERE cc.c_id = '{$comp_id}' ";
$comp_cat_parent_id_data = $_db->format_data($_db->query($query));
$_SESSION['category_parent_id'] = isset($comp_cat_parent_id_data[0]['parent_id']) ? $comp_cat_parent_id_data[0]['parent_id'] : 0;
if ($_SESSION['compnay_id'] == '59443')
$_SESSION['category_parent_id'] = 1612;
?>

<script type="text/javascript">
    var _theme_genearl_color = '<?php print $_theme[$_SESSION['th']]['general_color']; ?>';
</script>
<style type="text/css" >

    #msg_c{
        display:none;
        position:fixed;
        left:40%;
        top:0%;
        background-color:#ffff99;
        border:1px solid #ffff99; /* #ffff99 */
        border-radius:0px 0px 15px 15px;
        color: #D3601B; /*  */
        padding: 10px 30px;
        font-weight: bold;
        text-align: center;
    }

    #main-nav li{background:none;border-right:1px solid #ffffff;}
    #main-nav li a:hover{background:none;color:<?php print $_theme[$_SESSION['th']]['footer_font_color']; ?>}
    #main-nav ul li a{background:none;}

    .bl_inputbutton_login , .bl_inputbutton , .inputbutton {
        -moz-border-radius:4px 4px 4px 4px;
        background-attachment:scroll;
        background-color:<?php print $_theme[$_SESSION['th']]['btn_colr']; ?>;
        background-image:url("<?php print _MEDIA_URL ?>images/btn_<?php print $_theme[$_SESSION['th']]['btn_image']; ?>.jpg");
        background-position:0 0;
        background-repeat:repeat-x;
        border:1px solid <?php print $_theme[$_SESSION['th']]['btn_colr']; ?>;
        color:#FFFFFF;
        font-family:Tahoma;
        font-size:11px;
        font-weight:bold;
        margin:0 5px 0 0;
        padding:5px 10px;
        text-shadow:0 1px 0 <?php print $_theme[$_SESSION['th']]['btn_shadow']; ?>;
    }
    /*.bl_inputbutton_login  {background-color:<?php print $_theme[$_SESSION['th']]['general_color']; ?>;color:#FFFFFF;cursor:pointer;font-size:13px;font-weight:bold;height:44px;padding:7px 1px 0 6px;}*/
    .bl_inputbutton:hover, .bl_inputbutton:hover, .bl_inputbutton:focus, .bl_inputbutton:focus , .bl_inputbutton_login:hover, .bl_inputbutton_login:focus{
        background-position:0 -8px;
        cursor:pointer;
    }
    p#vtip {
        background-color: <?php print $_theme[$_SESSION['th']]['general_color']; ?> !important;
        border : 1px solid <?php print $_theme[$_SESSION['th']]['general_color']; ?> !important;
    }
    .aiBG {
        background-color: #ffff99;
        border-radius:5px;
        padding:10px 10px;
        font-family: verdana;
    }
    .arrowlistmenu .menuheader {background:url("<?php print _MEDIA_URL ?>images/<?php print $_SESSION['th']; ?>_h.gif") no-repeat scroll left center transparent;color:#FFFFFF;cursor:pointer;font-size:13px;font-weight:bold;height:29px;margin:0;padding:0;width:204px;}
    .arrowlistmenu .openheader {background:url("<?php print _MEDIA_URL ?>images/<?php print $_SESSION['th']; ?>.gif") no-repeat scroll left center transparent;color:#FFFFFF;font-size:13px;font-weight:bold;height:29px;width:204px;}




    .e_title_grad{background:none}
    .e_top_curve{background:none}

    .headermid{width:1000px;}
    .header-nav{width:1000px;background:none;padding:0px;height:60px;}
    #main-nav{background:none;}
    .main-nav{background:none;}
    #bottom_area{padding:0px;width:1000px;background:none;background-color:white}
    .top_grad{background:none;}
    .bottom{background:none;}

    /*.contact_tradder{float:left; width:301px; background-color:#E7E7E7; border:1px solid  #D2D2D2}*/
    .contact_tradder{float:left; width:301px; background-color:white; border:1px solid  #D2D2D2;border-radius: 5px;} /* #EDEDED*/

    .footer_top{padding:11px;background:none;background-color:white;}
    .footer_btm{background:none;background-color:white}
    .f_top_lt{float:left;background:none;background-color:<?php print $_theme[$_SESSION['th']]['general_color']; ?>;  width:8px; height:52;}
    .f_top_bg{ float:left; background:none;background-color:<?php print $_theme[$_SESSION['th']]['general_color']; ?>; width:962;height:52;}
    .f_top_rt{float:left;background:none;background-color:<?php print $_theme[$_SESSION['th']]['general_color']; ?>; width:8px;height:52;}
    .f_title{border-bottom:1px solid <?php print $_theme[$_SESSION['th']]['border_color']; ?>}
    .footer_btm_link{background-image:none;border-top:1px solid <?php print $_theme[$_SESSION['th']]['border_color']; ?>}

    #main-nav li {background:none;border-right:1px solid #ffffff;height:47px}
    #main-nav li li{background:none;border-right:1px solid #ffffff;height:35px}

    .main-nav li a.active{background:none;}

    .bltitle_grad{background:none !important}
    .bl_mid,.bl_right,.bl_left{background:none;background-color:<?php print $_theme[$_SESSION['th']]['general_color']; ?>}
    .bl_snd_left,.bl_snd_bg,.bl_snd_right{background:none;background-color:<?php print $_theme[$_SESSION['th']]['general_color']; ?>}

    .bl_mid,.bl_right{background-color: white;color:black}
    .bl_snd_bg,.bl_snd_right{background-color: white;;}
    
    
    
    /* new design ends */
    
    .nav {background:none;background-color:#ffffff; }
    .pms_left_img_grad{background:none;}
    .footer_bl {background-color:<?php print $_theme[$_SESSION['th']]['general_color']; ?>}
    .footer_btm_link{background-color:<?php print $_theme[$_SESSION['th']]['general_color']; ?>;color:<?php print $_theme[$_SESSION['th']]['footer_color']; ?>}
    /* .left_title{background-color:<?php print $_theme[$_SESSION['th']]['general_color']; ?>;} */
    .l_lt_btmcurve,.l_btm_line,.l_rt_btmcurve,.l_lt_topcurve,.l_top_line,.l_rt_topcurve{background:none}
    .e_top_curve,.e_btm_curve{background:none}
    a {text-decoration:none}
</style>
<?php include('new_design_header.tpl.php');?>
<div id="header1">
    <!--header area start-->
    <div class="header_top">
        <?php if(!$_SESSION['user_id']):?>
        <a href="<?php print _U ?>login">
            <img src="<?php print _MEDIA_URL?>images/login.gif" style="position:relative;top:3px;border:0px none"/> &nbsp;
        </a>
        |  
        <?php endif; ?>
        <span id="tr_time" style="color:black;font-size:12px;font-family:Helvetica,Helvetica,sans-serif">
            <?php print strftime("%A, %d. %B %Y - %H:%M"); ?>
        </span>
    </div>
    <div id="sh_top_left">&nbsp;</div>
    <div id="sh_top_right">&nbsp;</div>
    

    <div class="header_bottom">
        <!--header bottom start-->
        <!--<div class="headerleft"> </div>-->
        <div class="headermid" style="width:1000px">
            <!--header mid start-->
            <div class="logo">
                <?php
                global $url;
                $classified_array = array("add_event_step_2_commercial", 'add_general_classified', 'add_car_classified', 'classifieds', 'landing', 'car_landing', 'add_event', 'event_landing', 'my_event_classified', 'event_details', 'my_event_landing', 'job_landing', "my_job_ads", 'my_job_classified', 'edit_general_job', 'classified_details', 'adlino_card', "invite_commercial_user");
//	$event_array = array('add_event','event_landing');
                $home_array = array('home', 'login','login', "city_websites");
                $video_array = array('upload_video', 'video_landing', 'my_video', 'my_content');
                $picture_array = array("upload_picture", "picture_landing", "my_picture", "edit_user_picture");
                $city_picture_array = array("city_picture_landing", "my_city_picture");
                if(_e($_GET['type'])){
                if($_GET['type'] == "video")
                array_push($video_array, "my_favourite", "playlist");
                elseif($_GET['type'] == "picture" || $_GET['type'] == "ecard" || $_GET['type'] == "wallpaper")
                array_push($picture_array, "my_favourite", "my_playlist");
                elseif($_GET['type']=="city_picture" || tpl::$_vars['vup_city']==1){
                array_push($city_picture_array, "my_city_picture");
                }
                }
                if(tpl::$_vars['vup_city']==1){
                array_push($city_picture_array, "view_user_picture");
                }
                else {
                array_push($picture_array, "view_user_picture");
                }

                $ecard_array = array("upload_ecard", "my_ecard", "ecard_landing", "edit_user_ecard", "view_user_ecard", "my_favourite", "playlist");
                $wallpaper_array = array("upload_wallpaper", "my_wallpaper", "wallpaper_landing", "edit_user_wallpaper", "view_user_wallpaper", "my_favourite", "playlist");
                $websearch_array = array("web_search");
                $shopping_array = array('add_new_egentis_product', "egentis_landing", 'my_favourite_shop_products', 'supplier_shop_landing', 'my_shop_landing', 'shopping_landing', 'add_new_product', 'my_shop_add', 'myshop_step_2_commercial', 'myshop_step_2_private', 'myshop_step_3', 'myshop_step_4', 'my_shop_details');
                ?>
                <!--logo area start-->
                <?php // if(in_array($url,$home_array)): ?>
                <?php /* ?><div style="position:absolute">
                  <span style="font-family:arial black;font-size:37pt;color:black">
                  Ad
                  </span>
                  <span style="font-family:arial black;font-size:37pt;color:#F44703">
                  lino
                  </span>
                  </div> */ ?>
                <div class="logo-img">
                    <a href="<?php print _U ?>home"><img  src="<?php print _MEDIA_URL ?>images/logo.jpg" border="0" alt="Adlino Deutschland" /> </a><br />
                    <?php /* <img src="<?php print _MEDIA_URL?>images/logo.gif" border="0" alt="Adlino Deutschland" /> */ ?>
                </div>
                <div class="slogan">
                    <!--logo tx start -->

                    <?php echo $country_name; ?>
                    <!--logo tx end-->
                </div>
                <?php // else :
                ?>
                <?php /* 		<table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                  <td>
                  <div class="logobg">
                  <!--logobg start-->

                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                  <td><img src="<?php print _MEDIA_URL?>images/logotop.gif" /></td>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                  <td colspan="2" valign="top">
                  <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                  <td><img src="<?php print _MEDIA_URL?>images/logobtm.gif" /></td>
                  <td class="logotx" valign="top">
                  <?php if(in_array($url,$classified_array)) {
                  print tpl::$_vars['lang_ref'][196];
                  }
                  if(in_array($url,$event_array)) {
                  print tpl::$_vars['lang_ref'][244];//tpl::$_vars['lang_ref'][196];
                  }
                  if(in_array($url,$home_array)) {
                  print tpl::$_vars['lang_ref'][194];
                  }
                  if(in_array($url,$websearch_array)) {
                  print tpl::$_vars['lang_ref'][195];
                  }
                  ?>
                  </td>
                  </tr>
                  </table>
                  </td>
                  </tr>
                  </table>

                  <!--logobg end-->
                  </div>
                  </td>
                  <td class="logoright"></td>
                  </tr>
                  </table>
                  <div class="logoslg"><?php print tpl::$_vars['lang_ref'][1178];?></div>
                  <?php endif; ?> */ ?>
                <!--logo area start-->

            </div>
            <div class="headerrt">
                <!--header rt start-->
                <div class="topnav">
                    <!--topnav start-->

                    <div class="nav">
                        <!--nav area start-->
                        <ul>
                            <?php if(isset($_SESSION['user_id'])){ ?>
                            <li><a href="<?php print _U ?>login?action=logout"><?php print tpl::$_vars['lang_ref'][399]; ?></a></li>
                            <?php }else{ ?>
                            <li><a href="<?php print _U ?>login"><?php print tpl::$_vars['lang_ref'][40]; ?></a></li>
                            <li><a href="<?php print _U ?>step1"><?php print tpl::$_vars['lang_ref'][36]; ?></a></li>
                            <?php } ?>
                            <?php /* ?><li><a href="#"><?php print tpl::$_vars['lang_ref'][185];?></a></li> */ ?>

                            <?php if(isset($_SESSION['user_id'])){ ?>
                            <li><a href="contact_us"><?php print tpl::$_vars['lang_ref'][186]; ?></a></li>
                            <?php } else { ?>
                            <li style="border:none"><a href="contact_us"><?php print tpl::$_vars['lang_ref'][186]; ?></a></li>
                            <?php } ?>
                            <?php if(isset($_SESSION['user_id'])) { ?>
                            <?php if($_SESSION['user_role'] == 'individual') { ?>
                            <li><a href="<?php _U; ?>private_member_profile"><?php print tpl::$_vars['lang_ref'][864]; ?></a></li>
                            <?php }else{ ?>
                            <li><a href="<?php _U; ?>my_data"><?php print tpl::$_vars['lang_ref'][864]; ?></a></li>
                            <?php } ?>
                            <?php } ?>
                            <?php if(isset($_SESSION['user_id'])) { ?>
                            <li style="border:none;"><a href="<?php print _U; ?>mail_inbox"><?php print tpl::$_vars['lang_ref'][871]; ?> (<?php print $count_user_inbox[0]['count']; ?>) </a></li>
                            <?php } ?>
                        </ul>
                        <!--nav area right-->
                    </div>
                    <div class="navright"> </div>
                    <!--topnav end-->
                </div>
                <style>
                    .theme_selection_adlino{
                        float:left;
                        margin-right:0px;
                        margin-left:175px;
                        width:180px;

                        /*//margin-right:0px;
                        //margin-left:26px;
                        //width:180px;
                        //margin-right:0px;
                        //width:180px;*/


                    }
                </style>
                <div class="flag-area" style="height:10px; display:inline; width:330px; float:right;padding-top:5px; margin:0px">
                    <?php /*
                    <div id="theme_selection" class="theme_selection_adlino">
                        <div id="sky_blue" title="sky blue" style="width:15px;height:15px;background-color:rgb(12,151,220);float:left;margin-right:5px;cursor:pointer" onclick="javascript:theme_c(this.id)" >&nbsp;</div>
                        <div id="orange" title="orange" style="width:15px;height:15px;background-color:rgb(220,120,23);float:left;margin-right:5px;cursor:pointer" onclick="javascript:theme_c(this.id)" >&nbsp;</div>
                        <div id="green" title="green" style="width:15px;height:15px;background-color:rgb(62,168,57);float:left;margin-right:5px;cursor:pointer" onclick="javascript:theme_c(this.id)" >&nbsp;</div>
                        <div id="blue" title="blue" style="width:15px;height:15px;background-color:rgb(41,22,211);float:left;margin-right:5px;cursor:pointer" onclick="javascript:theme_c(this.id)">&nbsp;</div>
                        <div id="red" title="red" style="width:15px;height:15px;background-color:rgb(210,45,39);float:left;margin-right:5px;cursor:pointer" onclick="javascript:theme_c(this.id)">&nbsp;</div>
                        <div id="maroon" title="maroon" style="width:15px;height:15px;background-color:rgb(163,39,67);float:left;margin-right:5px;cursor:pointer" onclick="javascript:theme_c(this.id)">&nbsp;</div>
                        <div id="dark_orange" title="dark orange" style="width:15px;height:15px;background-color:#8b4513;float:left;margin-right:5px;cursor:pointer" onclick="javascript:theme_c(this.id)">&nbsp;</div>
                        <div id="dark_pink" title="dark pink" style="width:15px;height:15px;background-color:#8b008b;float:left;margin-right:5px;cursor:pointer" onclick="javascript:theme_c(this.id)">&nbsp;</div>
                        <div id="normal_blue" title="normal blue" style="width:15px;height:15px;background-color:#424181;float:left;margin-right:5px;cursor:pointer" onclick="javascript:theme_c(this.id)">&nbsp;</div>
                    </div>
                     * */?>
                     
                    <style>
                        .lnd {
                            color:#7A7A7A;
                            float:left;
                            font-family:Tahoma;
                            font-size:11px;
                            padding:0 15px 0 25px;

                        }
                        .meta{
                            width:110px;

                        }
                    </style>
                    <div style="float:right; display:inline; white-space:nowrap; width:40px">
                        <?php
#Common function for get language flages strip
//_get_lang_flag_belt1();
                        ?>
                    </div>

                </div>
                <!--header rt end-->
            </div>
            <div class="wel_user ieWel_user" style="height:27px" >
                <!--wel user start-->
                <?php
                if(isset($_SESSION['company_id'])){
                if($_SESSION['user_role'] == "individual"){
                ?>
                <?php print tpl::$_vars['lang_ref'][626]; ?>&nbsp;<span class="user"><?php print truncate_content_title($private_user_info[0]['user_name'], "10"); ?></span>
                <?php }elseif($_SESSION['user_role'] == "commercial_cutomers"){ ?>
                <?php print tpl::$_vars['lang_ref'][626]; ?>&nbsp;<span class="user"><?php print truncate_content_title($private_user_info[0]['first_name'], "10").'&nbsp;'.truncate_content_title($private_user_info[0]['last_name'], "10"); ?></span>
                <?php } ?>
                <?php }else{ ?>
                &nbsp;
                <?php } ?>
                <!--wel user end-->
            </div>
            <div class="headerrt">
                <!--header nav start-->
                <div class="main-navigation">
                    <!--main navigation start-->

                    <style>
                        .glowingtabs a
                        {
                            float:left;
                            background:url(<?php print _MEDIA_URL ?>images/header_tabs/<?php print $_theme[$_SESSION['th']]['glowtab_left']; ?>) no-repeat left top;
                            margin:0;
                            margin-right: 5px; /*spacing between each tab*/
                            padding:0 0 0 10px;
                            text-decoration:none;
                            line-height:19px;
                            background-position:0 -82px;
                        }

                        .glowingtabs a span
                        {
                            float:left;
                            display:block;
                            background:url(<?php print _MEDIA_URL ?>images/header_tabs/<?php print $_theme[$_SESSION['th']]['glowtab']; ?>) no-repeat right top;
                            padding: 5px 8px 3px 0px;
                            font-weight:bold;
                            font-size:13px;
                            color:#000;
                            line-height:25px;
                            font-family:Arial, Helvetica, sans-serif;
                        }

                        /* Commented Backslash Hack hides rule from IE5-Mac \*/
                        .glowingtabs a span
                        {
                            float:none;
                            background-position:100% -82px;
                        }
                        /* End IE5-Mac hack */

                        .glowingtabs a:hover span {
                            color:#ffffff;
                            border-bottom:#191b3e solid 0px;
                        }

                        .glowingtabs a.current{ /*Selected Tab style*/
                            border-bottom:#191b3e solid 0px;
                            background-position:0 0px; /*Shift background image up to start of 2nd tab image*/
                        }

                        .glowingtabs a.current span{
                            border-bottom:#696db2 solid 0px; /*Selected Tab style*/
                            background-position:100% 0px; /*Shift background image up to start of 2nd tab image*/
                            color:#ffffff;
                        }

                        .glowingtabs a:hover{ /*onMouseover style*/
                            border-bottom:#696db2 solid 0px;
                            background-position:0% 0px; /*Shift background image up to start of 2nd tab image*/
                        }

                        .glowingtabs a:hover span{
                            border-bottom:#696db2 solid 0px;/*onMouseover style*/
                            background-position:100% 0px; /*Shift background image up to start of 2nd tab image*/
                        }
                    </style>

                    <div id="ddtabs2" class="glowingtabs">
                        <ul>
                            <li><a href="<?php print _U ?>home" rel="gc1" <?php if(in_array($url, $home_array)) { ?> class="current" <?php } ?>><span><?php print tpl::$_vars['lang_ref'][41]; ?></span></a></li>

                            <!-- Commnted by arste_012 :: order by client on 30-06-2010  -->
                            <!--<li><a href="<?php //print _U             ?>web_search" rel="gc2" <?php //if(in_array($url,$websearch_array)) {              ?> class="current" <?php //}              ?>><span><?php //print tpl::$_vars['lang_ref'][195];             ?></span></a></li>-->


                            <li><a href="<?php print _U ?>landing" rel="gc3" <?php if(in_array($url, $classified_array)) { ?> class="current" <?php } ?>><span><?php print tpl::$_vars['lang_ref'][866]; ?></span></a></li>
                            <?php /* 				  <li><a href="<?php print _U?>event_landing" rel="gc3" <?php if(in_array($url,$event_array)) { ?> class="current" <?php  } ?>><span><?php print tpl::$_vars['lang_ref'][244];?></span></a></li>	 */ ?>
                            <li><a href="<?php print _U ?>shopping_landing" rel="gc4" <?php if(in_array($url, $shopping_array)) { ?> class="current" <?php } ?>><span><?php print tpl::$_vars['lang_ref'][199]; ?></span></a></li>

                            <?php
                            if(isset($_GET['type'])){$strUrl = "my_".$_GET['type'];
                            if(in_array($strUrl, $video_array)){$vclass = "current";
                            }}elseif(in_array($url, $video_array)){$vclass = "current";
                            }else{$vclass = "";
                            }
                            ?>
                            <li><a href="<?php print _U ?>video_landing" rel="gc4"  class="<?php print $vclass; ?>" ><span><?php print tpl::$_vars['lang_ref'][197]; ?></span></a></li>

                            <?php
                            if(isset($_GET['type'])){$strUrl = "my_".$_GET['type'];
                            if(in_array($strUrl, $picture_array)){$pclass = "current";
                            }}elseif(in_array($url, $picture_array)){$pclass = "current";
                            }else{$pclass = "";
                            }
                            ?>
                            <li><a href="<?php print _U ?>picture_landing" rel="gc4"  class="<?php print $pclass; ?>"><span><?php print tpl::$_vars['lang_ref'][198]; ?></span></a></li>

                            <?php
                            if(isset($_GET['type'])){$strUrl = "my_".$_GET['type'];
                            if(in_array($strUrl, $city_picture_array)){$pclass = "current";
                            }}elseif(in_array($url, $city_picture_array)){$pclass = "current";
                            }else{$pclass = "";
                            }
                            ?>
                            <li><a href="<?php print _U ?>city_picture_landing" rel="gc4"  class="<?php print $pclass; ?>"><span><?php print tpl::$_vars['lang_ref'][3072]; ?></span></a></li>

                            <?php
                            if(isset($_GET['type'])){$strUrl = "my_".$_GET['type'];
                            if(in_array($strUrl, $ecard_array)){$eclass = "current";
                            }}elseif(in_array($url, $ecard_array)){$eclass = "current";
                            }else{$eclass = "";
                            }
                            ?>
                            <li><a href="<?php print _U ?>ecard_landing" rel="gc4"  class="<?php print $eclass; ?>" ><span><?php print tpl::$_vars['lang_ref'][903]; ?></span></a></li>

                            <?php
                            if(isset($_GET['type'])){$strUrl = "my_".$_GET['type'];
                            if(in_array($strUrl, $wallpaper_array)){$wclass = "current";
                            }}elseif(in_array($url, $wallpaper_array)){$wclass = "current";
                            }else{$wclass = "";
                            }
                            ?>
                            <li><a href="<?php print _U ?>wallpaper_landing" rel="gc4"  class="<?php print $wclass; ?>" ><span><?php print tpl::$_vars['lang_ref'][904]; ?></span></a></li>

                            <?php /*   <li><a href="#" rel="gc4"><span><?php print tpl::$_vars['lang_ref'][200];?></span></a></li>
                              <li><a href="#" rel="gc4" style="margin:0px;"><span><?php print tpl::$_vars['lang_ref'][201];?></span></a></li> */ ?>
                        </ul>
                    </div>
                    <!--main navigation end-->
                </div>
                <!--header nav end-->
            </div>
            <!--header mid end-->
        </div>
        <!--<div class="headerright"> </div>-->
        <!--header bottom end-->
    </div>
    <div class="header-nav">
        <!--header nav start-->
        <div class="main-nav">
            <!--main nav start-->
            <?php $home_header_main_array = array("company_catalogs",'catalogs',"cruise_reports", "home", "city_websites", "reset_password", "forgot_password", "login", "step1", "step2_commercial_customer", "company_information", "step2_individuals", 'step3', 'step4', 'branches', 'company', 'webcatalog', 'adlino_card', "invite_commercial_user") ?>

            <?php if(in_array($_REQUEST['q'], $home_header_main_array) || $_REQUEST['q'] == '') { ?>
            <ul id="main-nav">
                <li style="background:none;"><a href="<?php print _U; ?>home"><?php print tpl::$_vars['lang_ref'][175]; ?></a></li>
                <li style="background:none;"><a href="<?php print _U; ?>catalogs"><?php print tpl::$_vars['lang_ref'][3805]; ?></a></li>
                <li ><a <?php if($url == 'company' && $_REQUEST['filter'] == "service24") { ?> class="active"<?php } ?> href="<?php print _U ?>company?filter=service24"><?php print tpl::$_vars['lang_ref'][506]; ?></a></li>
                <li><a <?php if($url == 'company' && $_REQUEST['filter'] == "voucher") { ?> class="active"<?php } ?> href="<?php print _U ?>company?filter=voucher"><?php print tpl::$_vars['lang_ref'][375]; ?></a></li>
                <li><a <?php if($url == 'webcatalog' ) { ?> class="active"<?php } ?> href="<?php print _U ?>webcatalog"><?php print tpl::$_vars['lang_ref'][250]; ?></a></li>
                <li><a <?php if($url == 'city_websites' ) { ?> class="active"<?php } ?> href="<?php print _U ?>city_websites"><?php print tpl::$_vars['lang_ref'][3008]; ?></a></li>
            </ul>
            <?php } ?>
            <?php if(isset($_GET['user_id']) && $_REQUEST['q'] == "private_member_profile"){ ?>
            <?php $member_header_maindiv_array = array("edit_private_member", "edit_profile", "my_data", "translate_description", "translate_keyword", "add_language", "my_entry", "add_keyword", "my_vouchers", "my_banners", "change_password", "change_emailid", "friend_request_details", "mail_create", "mail_outbox", "mail_inbox", "mail_details", "my_keywords", "my_order", "add_order", 'my_order_details'); ?>
            <?php }else{ ?>
            <?php $member_header_maindiv_array = array("book_online_ad_space_step1","book_online_ad_space_step2","book_online_ad_space_step3",'my_branches_biz_hours', "my_branches_edit_info", 'my_news', "my_branches", "create_catalogs", "create_catalogs_thumb", 'private_adlino_card_main', 'user_login_info', 'private_adlino_card', 'my_flyers', "my_menu_additives", 'my_menu_card_settings', "my_dishes", 'my_menu_card', "my_menu_category", "my_trust_report", "my_contact_persons", "online_support", "book_ad_space_2", "win_games", "booked_print_ad_spaces", "my_print_banners", "book_ad_space", "print_credit_details", 'buy_first_print_credits', 'buy_print_credits', "my_commercial_pictures", "edit_private_member", "my_business_hours", "private_member_profile", "edit_profile", "my_data", "translate_description", "translate_keyword", "add_language", "my_entry", "add_keyword", "my_vouchers", "my_banners", "change_password", "change_emailid", "friend_request_details", "mail_create", "mail_outbox", "mail_inbox", "mail_details", "subscribe_content", "my_keywords", 'user_search', "my_order", "add_order", 'my_order_details', 'last_visitors', 'my_friends', 'user_search', 'invite_friend_game', 'cost_price_list', 'cost_details'); ?>
            <?php } ?>
            <?php if(in_array($_REQUEST['q'], $member_header_maindiv_array)) { ?>
            <?php if($_SESSION['user_role'] == 'individual') { ?>
            <ul id="main-nav">
                    <!--<li><a href="<?php _U; ?>home"><?php print tpl::$_vars['lang_ref'][175]; ?></a></li>-->
                    <!--<li><a href="<?php _U; ?>private_member_profile"><?php print tpl::$_vars['lang_ref'][864]; ?></a></li>-->
                <li>
                    <a href="#"  style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][804]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>my_video"><?php print tpl::$_vars['lang_ref'][632]; ?></a></li>
                        <li><a href="<?php print _U ?>my_picture"><?php print tpl::$_vars['lang_ref'][633]; ?></a></li>
                        <li><a href="<?php print _U ?>my_city_picture"><?php print tpl::$_vars['lang_ref'][3078]; ?></a></li>
                        <li><a href="<?php print _U ?>my_ecard"><?php print tpl::$_vars['lang_ref'][635]; ?></a></li>
                        <li><a href="<?php print _U ?>my_wallpaper"><?php print tpl::$_vars['lang_ref'][634]; ?></a></li>
                        <?php /* 	<li><a href="#"><?php print tpl::$_vars['lang_ref'][636];?></a></li> */ ?>
                    </ul>
                </li>
                <li>
                    <a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][865]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>playlist?type=video"><?php print tpl::$_vars['lang_ref'][197]; ?></a></li>
                        <li><a href="<?php print _U ?>playlist?type=picture"><?php print tpl::$_vars['lang_ref'][198]; ?></a></li>
                        <li><a href="<?php print _U ?>playlist?type=city_picture"><?php print tpl::$_vars['lang_ref'][3072]; ?></a></li>
                        <li><a href="<?php print _U ?>playlist?type=ecard"><?php print tpl::$_vars['lang_ref'][903]; ?></a></li>
                        <li><a href="<?php print _U ?>playlist?type=wallpaper"><?php print tpl::$_vars['lang_ref'][904]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][805]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>my_favourite?type=video"><?php print tpl::$_vars['lang_ref'][197]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=picture"><?php print tpl::$_vars['lang_ref'][198]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=city_picture"><?php print tpl::$_vars['lang_ref'][3072]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=ecard"><?php print tpl::$_vars['lang_ref'][903]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=wallpaper"><?php print tpl::$_vars['lang_ref'][904]; ?></a></li>
                        <?php /* ?><li><a href="<?php print _U?>my_favourite?type=job"><?php print tpl::$_vars['lang_ref'][675];?></a></li> <?php */ ?>
                    </ul>
                </li>
                <?php /* ?><li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][534];?></a></li> <?php */ ?>
                <li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][866]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>my_general_classified"><?php print tpl::$_vars['lang_ref'][867]; ?></a></li>
                        <li><a href="<?php _U; ?>my_car_classified" ><?php print tpl::$_vars['lang_ref'][763]; ?></a></li>
                        <li><a href="#"><?php print tpl::$_vars['lang_ref'][1079]; ?></a></li>
                        <li><a href="#"><?php print tpl::$_vars['lang_ref'][798]; ?></a></li>
                    </ul>
                </li>

                <li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][1426]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>subscribe_content?type=video"><?php print tpl::$_vars['lang_ref'][197]; ?></a></li>
                        <li><a href="<?php print _U ?>subscribe_content?type=picture"><?php print tpl::$_vars['lang_ref'][198]; ?></a></li>
                        <li><a href="<?php print _U ?>subscribe_content?type=ecard"><?php print tpl::$_vars['lang_ref'][903]; ?></a></li>
                        <li><a href="<?php print _U ?>subscribe_content?type=wallpaper"><?php print tpl::$_vars['lang_ref'][904]; ?></a></li>
                        <?php /* 	<li><a href="#"><?php print tpl::$_vars['lang_ref'][1427];?></a></li>	 */ ?>
                    </ul>
                </li>
                <li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][638]; ?></a></a>
                    <ul>
                        <li><a href="<?php print _U ?>scanfile"><?php print tpl::$_vars['lang_ref'][1418]; ?></a></li>
                        <li><a href="<?php print _U ?>my_home_page"><?php print tpl::$_vars['lang_ref'][1419]; ?></a></li>
                        <li><a href="<?php print _U ?>my_guestbook"><?php print tpl::$_vars['lang_ref'][1420] ?></a></li>
                        <li><a href="#"><?php print tpl::$_vars['lang_ref'][1421]; ?></a></li>
                        <li><a href="#"><?php print tpl::$_vars['lang_ref'][1422]; ?></a></li>

                    </ul>
                </li>
        <!--<li><a href="<?php print _U; ?>mail_inbox"><?php print tpl::$_vars['lang_ref'][871]; ?>(<?php print $count_user_inbox[0]['count']; ?>)</a></li>-->
        <li id="support" style="float:right;"><a href="<?php _U; ?>private_member_upload"><!--<img src="<?php print _MEDIA_URL ?>images/arrow.gif" align="left" border="0" class="armrg" />--><b><?php print strtoupper(tpl::$_vars['lang_ref'][808]); ?></b></a></li>
            </ul>
            <?php }elseif($_SESSION['user_role'] == 'commercial_cutomers') { ?>
            <ul id="main-nav">
                
                <!-- li><a href="<?php _U; ?>home"><?php print tpl::$_vars['lang_ref'][175]; ?></a></li -->
                <li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][627]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>my_data" ><?php print tpl::$_vars['lang_ref'][807]; ?></a></li>
                        <li><a href="<?php _U; ?>change_password" ><?php print tpl::$_vars['lang_ref'][647]; ?></a></li>
                        <li><a href="<?php _U; ?>change_emailid"><?php print tpl::$_vars['lang_ref'][516]; ?></a></li>
                        <?php /*                                       <li><a href="<?php _U;?>my_vouchers"><?php print tpl::$_vars['lang_ref'][530];?></a></li>  */ ?>

                    </ul>
                </li>
                <li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][648]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>my_entry" ><?php print tpl::$_vars['lang_ref'][509]; ?></a></li>
                        <li><a href="<?php _U; ?>add_keyword"><?php print tpl::$_vars['lang_ref'][649]; ?></a></li>
                        <li><a href="<?php _U; ?>my_vouchers"><?php print tpl::$_vars['lang_ref'][530]; ?></a></li>
                        <li><a href="<?php _U; ?>my_banners"><?php print tpl::$_vars['lang_ref'][541]; ?></a></li>
                        <li><a href="<?php _U; ?>add_video"><?php print tpl::$_vars['lang_ref'][632]; ?></a></li>
                        <li><a href="<?php _U; ?>my_commercial_pictures"><?php print tpl::$_vars['lang_ref'][633]; ?></a></li>
                        <li><a href="<?php _U; ?>my_business_hours"><?php print tpl::$_vars['lang_ref'][1349]; ?></a></li>
                        <li><a href="<?php _U; ?>my_order"><?php print tpl::$_vars['lang_ref'][1843]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][3370]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>print_credit_details" ><?php print tpl::$_vars['lang_ref'][3359]; ?></a></li>
                        <li><a href="<?php _U; ?>my_print_banners"><?php print tpl::$_vars['lang_ref'][3372]; ?></a></li>
                        <li><a href="<?php _U; ?>my_flyers"><?php print tpl::$_vars['lang_ref'][3724]; ?></a></li>
                        <li><a href="<?php _U; ?>win_games"><?php print tpl::$_vars['lang_ref'][3334]; ?></a></li>
                        <li><a href="<?php _U; ?>booked_print_ad_spaces"><?php print tpl::$_vars['lang_ref'][3371]; ?></a></li>
                        <li><a href="<?php _U; ?>book_ad_space"><?php print tpl::$_vars['lang_ref'][3312]; ?></a></li>
                        <li><a href="<?php _U; ?>buy_print_credits"><?php print tpl::$_vars['lang_ref'][3336]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#" class="sub" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][866]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>my_general_classified"><?php print tpl::$_vars['lang_ref'][867]; ?></a></li>
                        <li><a href="<?php _U; ?>my_car_classified" ><?php print tpl::$_vars['lang_ref'][763]; ?></a></li>
                        <li><a href="#"><?php print tpl::$_vars['lang_ref'][1079]; ?></a></li>
                        <li><a href="<?php _U; ?>my_job_ads"><?php print tpl::$_vars['lang_ref'][798]; ?></a></li>
                        <li><a href="<?php _U; ?>my_event_classified"><?php print tpl::$_vars['lang_ref'][2238]; ?></a></li>
                        <li><a href="<?php _U; ?>my_contact_persons"><?php print tpl::$_vars['lang_ref'][3419]; ?></a></li>
                        <?php /* ?><li><a href="<?php _U;?>my_news"><?php print tpl::$_vars['lang_ref'][3082];?></a></li>
                          <li><a href="<?php _U;?>adlino_card"><?php print tpl::$_vars['lang_ref'][2878];?></a></li> */ ?>
                    </ul>
                </li>
                <?php /* ?><li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][72];?></a>
                  <ul>
                  <li><a href="#"><?php print tpl::$_vars['lang_ref'][659];?></a></li>
                  <li><a href="#"><?php print tpl::$_vars['lang_ref'][189];?></a></li>
                  </ul>
                  </li>
                  <li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][663];?></a>
                  <ul>
                  <li><a href="#"><?php print tpl::$_vars['lang_ref'][663];?></a></li>
                  <li><a href="#"><?php print tpl::$_vars['lang_ref'][665];?></a></li>
                  <li><a href="#"><?php print tpl::$_vars['lang_ref'][667];?></a></li>
                  </ul>
                  </li> */ ?>
                <li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][873]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>translate_keyword"><?php print tpl::$_vars['lang_ref'][550]; ?></a></li>
                        <li><a href="<?php _U; ?>translate_description"><?php print tpl::$_vars['lang_ref'][554]; ?></a></li>
                        <li><a href="<?php _U; ?>add_language"><?php print tpl::$_vars['lang_ref'][207]; ?></a></li>
                    </ul>
                </li>
                <li><a href="<?php print _U; ?>my_products" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][248]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>my_products"><?php print tpl::$_vars['lang_ref'][1369]; ?></a></li>
                        <!--  <li><a href="#"><?php print tpl::$_vars['lang_ref'][1370]; ?></a></li> -->
                        <li><a href="<?php _U; ?>my_shop_category"><?php print tpl::$_vars['lang_ref'][1371]; ?></a></li>
                        <li><a href="<?php _U; ?>my_shop_setting"><?php print tpl::$_vars['lang_ref'][1372]; ?></a></li>
                    </ul>
                </li>
                <li><a href="<?php print _U; ?>add_order" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][1839]; ?></a></li>
                <?php if($_SESSION['category_parent_id'] == 1612 && 0): ?>
                <li style="border-right:0px none"><a href="<?php print _U; ?>my_menu_card" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][3593]; ?></a>
                    <ul>
                        <li><a href="<?php print _U; ?>my_menu_category"><?php print tpl::$_vars['lang_ref'][3596]; ?></a></li>
                        <li><a href="<?php print _U; ?>my_dishes"><?php print tpl::$_vars['lang_ref'][3598]; ?></a></li>
                        <li><a href="<?php print _U; ?>my_menu_card"><?php print tpl::$_vars['lang_ref'][3594]; ?></a></li>
                        <li><a href="<?php print _U; ?>my_menu_additives"><?php print tpl::$_vars['lang_ref'][3652]; ?></a></li>
                        <li><a href="<?php print _U; ?>my_menu_card_settings"><?php print tpl::$_vars['lang_ref'][3608]; ?></a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
            <?php } ?>

            <?php } ?>
            <?php if(isset($_GET['user_id']) && $_REQUEST['q'] == "private_member_profile"){ ?>
            <?php $video_header_maindiv_array = array('add_video', 'upload_video', 'private_member_upload', 'view_user_video', 'video_landing', 'my_video', 'my_favourite', 'playlist', 'private_member_profile') ?>
            <?php }else{ ?>
            <?php $video_header_maindiv_array = array('add_video', 'upload_video', 'private_member_upload', 'view_user_video', 'video_landing', 'my_video', 'my_favourite', 'playlist', 'my_city_picture', 'my_picture', 'my_ecard', 'my_wallpaper', 'edit_upload_video', 'edit_user_picture', 'edit_user_ecard', 'edit_user_wallpaper') ?>
            <?php } ?>
            <?php if(in_array($_REQUEST['q'], $video_header_maindiv_array)) { ?>
            <?php if($_SESSION['user_role'] == 'individual') { ?>
            <ul id="main-nav">
                <li><a href="#" ><?php print tpl::$_vars['lang_ref'][874]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1685]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1688]; ?></a></li>
                        <li><a href="<?php print _U ?>city_picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][3074]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1693]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1811]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][875]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1687]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1690]; ?></a></li>
                        <li><a href="<?php print _U ?>city_picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][3073]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1696]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1697]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][876]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1812]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1813]; ?></a></li>
                        <li><a href="<?php print _U ?>city_picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][3075]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1814]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1815]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][882]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][877]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][878]; ?></a></li>
                        <li><a href="<?php print _U ?>city_picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][3076]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][879]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][1701]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][881]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1816]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1817]; ?></a></li>
                        <li><a href="<?php print _U ?>city_picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][3077]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1818]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1819]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][804]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>my_video"><?php print tpl::$_vars['lang_ref'][632]; ?></a></li>
                        <li><a href="<?php print _U ?>my_picture"><?php print tpl::$_vars['lang_ref'][633]; ?></a></li>
                        <li><a href="<?php print _U ?>my_city_picture"><?php print tpl::$_vars['lang_ref'][3078]; ?></a></li>
                        <li><a href="<?php print _U ?>my_ecard"><?php print tpl::$_vars['lang_ref'][635]; ?></a></li>
                        <li><a href="<?php print _U ?>my_wallpaper"><?php print tpl::$_vars['lang_ref'][634]; ?></a></li>
                        <?php /* 	<li><a href="#"><?php print tpl::$_vars['lang_ref'][636];?></a></li>	 */ ?>

                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][805]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>my_favourite?type=video"><?php print tpl::$_vars['lang_ref'][197]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=picture"><?php print tpl::$_vars['lang_ref'][198]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=city_picture"><?php print tpl::$_vars['lang_ref'][3072]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=ecard"><?php print tpl::$_vars['lang_ref'][903]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=wallpaper"><?php print tpl::$_vars['lang_ref'][904]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#" style="padding:0 20px;"><?php print tpl::$_vars['lang_ref'][865]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>playlist?type=video"><?php print tpl::$_vars['lang_ref'][197]; ?></a></li>
                        <li><a href="<?php print _U ?>playlist?type=picture"><?php print tpl::$_vars['lang_ref'][198]; ?></a></li><li><a href="<?php print _U ?>playlist?type=city_picture"><?php print tpl::$_vars['lang_ref'][3072]; ?></a></li>
                        <li><a href="<?php print _U ?>playlist?type=ecard"><?php print tpl::$_vars['lang_ref'][903]; ?></a></li>
                        <li><a href="<?php print _U ?>playlist?type=wallpaper"><?php print tpl::$_vars['lang_ref'][904]; ?></a></li>
                    </ul>
                </li>

                                                <!--<li><a href="<?php print _U ?>video_landing?filter=fv"><?php print tpl::$_vars['lang_ref'][805]; ?></a>-->
                                                <li id="support" style="float:right;"><a href="<?php _U; ?>private_member_upload"><!--<img src="<?php print _MEDIA_URL ?>images/arrow.gif" align="left" border="0" class="armrg" />--><b><?php print strtoupper(tpl::$_vars['lang_ref'][808]); ?></b></a></li>

            </ul>
            <?php }else{ ?>
            <ul id="main-nav">
                    <!--<li><a href="<?php _U; ?>home"><?php print tpl::$_vars['lang_ref'][175]; ?></a></li>-->
                <li><a href="#" ><?php print tpl::$_vars['lang_ref'][874]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1685]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1688]; ?></a></li>
                        <li><a href="<?php print _U ?>city_picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][3074]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1693]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1811]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][875]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1687]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1690]; ?></a></li>
                        <li><a href="<?php print _U ?>city_picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][3073]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1696]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1697]; ?></a></li>
                    </ul>
                </li>
                <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][876]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1812]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1813]; ?></a></li>
                        <li><a href="<?php print _U ?>city_picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][3075]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1814]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1815]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][882]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][877]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][878]; ?></a></li>
                        <li><a href="<?php print _U ?>city_picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][3076]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][879]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][1701]; ?></a></li>
                    </ul>
                </li>
                <li><a href="<?php print _U ?>video_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][881]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1816]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1817]; ?></a></li>
                        <li><a href="<?php print _U ?>city_picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][3077]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1818]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1819]; ?></a></li>
                    </ul>
                </li>
                <li id="support" style="float:right;"><a href="<?php _U; ?>private_member_upload"><!--<img src="<?php print _MEDIA_URL ?>images/arrow.gif" align="left" border="0" class="armrg" />--><b><?php print strtoupper(tpl::$_vars['lang_ref'][808]); ?></b></a></li>
            </ul>
            <?php } ?>
            <?php } ?>
            <?php $picture_header_maindiv_array = array('picture_landing', 'city_picture_landing', 'upload_picture', 'view_user_picture'); ?>
            <?php if(in_array($_REQUEST['q'], $picture_header_maindiv_array)){ ?>
            <?php if($_SESSION['user_role'] == 'individual') { ?>
            <ul id="main-nav">
                    <!--<li><a href="<?php _U; ?>home"><?php print tpl::$_vars['lang_ref'][175]; ?></a></li>-->
                <li><a href="#" ><?php print tpl::$_vars['lang_ref'][874]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1685]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1688]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][3074]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1693]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1811]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][875]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1687]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1690]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][3073]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1696]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1697]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][876]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1812]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1813]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][3075]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1814]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1815]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][882]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][877]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][878]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][3076]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][879]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][1701]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][881]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1816]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1817]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][3077]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1818]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1819]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][804]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>my_video"><?php print tpl::$_vars['lang_ref'][632]; ?></a></li>
                        <li><a href="<?php print _U ?>my_picture"><?php print tpl::$_vars['lang_ref'][633]; ?></a></li><li><a href="<?php print _U ?>my_city_picture"><?php print tpl::$_vars['lang_ref'][3078]; ?></a></li>
                        <li><a href="<?php print _U ?>my_ecard"><?php print tpl::$_vars['lang_ref'][635]; ?></a></li>
                        <li><a href="<?php print _U ?>my_wallpaper"><?php print tpl::$_vars['lang_ref'][634]; ?></a></li>
                        <?php /* 	<li><a href="#"><?php print tpl::$_vars['lang_ref'][636];?></a></li>	 */ ?>

                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][805]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>my_favourite?type=video"><?php print tpl::$_vars['lang_ref'][197]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=picture"><?php print tpl::$_vars['lang_ref'][198]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=city_picture"><?php print tpl::$_vars['lang_ref'][3072]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=ecard"><?php print tpl::$_vars['lang_ref'][903]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=wallpaper"><?php print tpl::$_vars['lang_ref'][904]; ?></a></li>
                    </ul>
                </li>
                <!--<li><a href="<?php print _U ?>video_landing?filter=fv"><?php print tpl::$_vars['lang_ref'][805]; ?></a>-->
                <li id="support" style="float:right;"><a href="<?php _U; ?>private_member_upload"><!--<img src="<?php print _MEDIA_URL ?>images/arrow.gif" align="left" border="0" class="armrg" />--><b><?php print strtoupper(tpl::$_vars['lang_ref'][808]); ?></b></a></li>

            </ul>
            <?php }else{ ?>
            <ul id="main-nav">
                    <!--<li><a href="<?php _U; ?>home"><?php print tpl::$_vars['lang_ref'][175]; ?></a></li>-->
                <li><a href="#" ><?php print tpl::$_vars['lang_ref'][874]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1685]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1688]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][3074]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1693]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1811]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][875]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1687]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1690]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][3073]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1696]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1697]; ?></a></li>
                    </ul>
                </li>
                <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][876]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1812]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1813]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][3075]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1814]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1815]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][882]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][877]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][878]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][3076]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][879]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][1701]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][881]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1816]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1817]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][3077]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1818]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1819]; ?></a></li>
                    </ul>
                </li>
                <li id="support" style="float:right;"><a href="<?php _U; ?>private_member_upload"><!--<img src="<?php print _MEDIA_URL ?>images/arrow.gif" align="left" border="0" class="armrg" />--><b><?php print strtoupper(tpl::$_vars['lang_ref'][808]); ?></b></a></li>
            </ul>
            <?php } ?>
            <?php } ?>
            <?php $ecard_header_maindiv_array = array('upload_ecard', 'view_user_ecard', 'ecard_landing'); ?>
            <?php if(in_array($_REQUEST['q'], $ecard_header_maindiv_array)){ ?>
            <?php if($_SESSION['user_role'] == 'individual') { ?>
            <ul id="main-nav">
                    <!--<li><a href="<?php _U; ?>home"><?php print tpl::$_vars['lang_ref'][175]; ?></a></li>-->
                <li><a href="#" ><?php print tpl::$_vars['lang_ref'][874]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1685]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1688]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][3074]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1693]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1811]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][875]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1687]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1690]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][3073]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1696]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1697]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][876]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1812]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1813]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][3075]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1814]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1815]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][882]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][877]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][878]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][3076]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][879]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][1701]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][881]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1816]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1817]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][3077]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1818]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1819]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][804]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>my_video"><?php print tpl::$_vars['lang_ref'][632]; ?></a></li>
                        <li><a href="<?php print _U ?>my_picture"><?php print tpl::$_vars['lang_ref'][633]; ?></a></li><li><a href="<?php print _U ?>my_city_picture"><?php print tpl::$_vars['lang_ref'][3078]; ?></a></li>
                        <li><a href="<?php print _U ?>my_ecard"><?php print tpl::$_vars['lang_ref'][635]; ?></a></li>
                        <li><a href="<?php print _U ?>my_wallpaper"><?php print tpl::$_vars['lang_ref'][634]; ?></a></li>
                        <?php /* 	<li><a href="#"><?php print tpl::$_vars['lang_ref'][636];?></a></li>	 */ ?>

                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][805]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>my_favourite?type=video"><?php print tpl::$_vars['lang_ref'][197]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=picture"><?php print tpl::$_vars['lang_ref'][198]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=city_picture"><?php print tpl::$_vars['lang_ref'][3072]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=ecard"><?php print tpl::$_vars['lang_ref'][903]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=wallpaper"><?php print tpl::$_vars['lang_ref'][904]; ?></a></li>
                    </ul>
                </li>
                <!--<li><a href="<?php print _U ?>video_landing?filter=fv"><?php print tpl::$_vars['lang_ref'][805]; ?></a>-->
                <li id="support" style="float:right;"><a href="<?php _U; ?>private_member_upload"><!--<img src="<?php print _MEDIA_URL ?>images/arrow.gif" align="left" border="0" class="armrg" />--><b><?php print strtoupper(tpl::$_vars['lang_ref'][808]); ?></b></a></li>

            </ul>
            <?php }else{ ?>
            <ul id="main-nav">
                    <!--<li><a href="<?php _U; ?>home"><?php print tpl::$_vars['lang_ref'][175]; ?></a></li>-->
                <li><a href="#" ><?php print tpl::$_vars['lang_ref'][874]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1685]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1688]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][3074]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1693]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1811]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][875]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1687]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1690]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][3073]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1696]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1697]; ?></a></li>
                    </ul>
                </li>
                <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][876]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1812]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1813]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][3075]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1814]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1815]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][882]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][877]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][878]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][3076]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][879]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][1701]; ?></a></li>
                    </ul>
                </li>
                <li><a href="<?php print _U ?>video_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][881]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1816]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1817]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][3077]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1818]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1819]; ?></a></li>
                    </ul>
                </li>
                <li id="support" style="float:right;"><a href="<?php _U; ?>private_member_upload"><!--<img src="<?php print _MEDIA_URL ?>images/arrow.gif" align="left" border="0" class="armrg" />--><b><?php print strtoupper(tpl::$_vars['lang_ref'][808]); ?></b></a></li>
            </ul>
            <?php } ?>
            <?php } ?>
            <?php $wallpaper_header_maindiv_array = array('upload_wallpaper', 'view_user_wallpaper', 'wallpaper_landing'); ?>
            <?php if(in_array($_REQUEST['q'], $wallpaper_header_maindiv_array)){ ?>
            <?php if($_SESSION['user_role'] == 'individual') { ?>
            <ul id="main-nav">
                    <!--<li><a href="<?php _U; ?>home"><?php print tpl::$_vars['lang_ref'][175]; ?></a></li>-->
                <li><a href="#" ><?php print tpl::$_vars['lang_ref'][874]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1685]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1688]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][3074]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1693]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1811]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][875]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1687]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1690]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][3073]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1696]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1697]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][876]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1812]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1813]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][3075]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1814]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1815]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][882]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][877]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][878]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][3076]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][879]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][1701]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][881]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1816]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1817]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][3077]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1818]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1819]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][804]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>my_video"><?php print tpl::$_vars['lang_ref'][632]; ?></a></li>
                        <li><a href="<?php print _U ?>my_picture"><?php print tpl::$_vars['lang_ref'][633]; ?></a></li><li><a href="<?php print _U ?>my_city_picture"><?php print tpl::$_vars['lang_ref'][3078]; ?></a></li>
                        <li><a href="<?php print _U ?>my_ecard"><?php print tpl::$_vars['lang_ref'][635]; ?></a></li>
                        <li><a href="<?php print _U ?>my_wallpaper"><?php print tpl::$_vars['lang_ref'][634]; ?></a></li>
                        <?php /* 	<li><a href="#"><?php print tpl::$_vars['lang_ref'][636];?></a></li>	 */ ?>

                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][805]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>my_favourite?type=video"><?php print tpl::$_vars['lang_ref'][197]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=picture"><?php print tpl::$_vars['lang_ref'][198]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=city_picture"><?php print tpl::$_vars['lang_ref'][3072]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=ecard"><?php print tpl::$_vars['lang_ref'][903]; ?></a></li>
                        <li><a href="<?php print _U ?>my_favourite?type=wallpaper"><?php print tpl::$_vars['lang_ref'][904]; ?></a></li>
                    </ul>
                </li>
                <!--<li><a href="<?php print _U ?>video_landing?filter=fv"><?php print tpl::$_vars['lang_ref'][805]; ?></a>-->
                <li id="support" style="float:right;"><a href="<?php _U; ?>private_member_upload"><!--<img src="<?php print _MEDIA_URL ?>images/arrow.gif" align="left" border="0" class="armrg" />--><b><?php print strtoupper(tpl::$_vars['lang_ref'][808]); ?></b></a></li>

            </ul>
            <?php }else{ ?>
            <ul id="main-nav">
                    <!--<li><a href="<?php _U; ?>home"><?php print tpl::$_vars['lang_ref'][175]; ?></a></li>-->
                <li><a href="#" ><?php print tpl::$_vars['lang_ref'][874]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1685]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1688]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][3074]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1693]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][1811]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][875]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1687]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1690]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][3073]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1696]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][1697]; ?></a></li>
                    </ul>
                </li>
                <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][876]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1812]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1813]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][3075]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1814]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][1815]; ?></a></li>
                    </ul>
                </li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][882]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][877]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][878]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][3076]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][879]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=nv"><?php print tpl::$_vars['lang_ref'][1701]; ?></a></li>
                    </ul>
                </li>
                <li><a href="<?php print _U ?>video_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][881]; ?></a>
                    <ul>
                        <li><a href="<?php print _U ?>video_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1816]; ?></a></li>
                        <li><a href="<?php print _U ?>picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1817]; ?></a></li><li><a href="<?php print _U ?>city_picture_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][3077]; ?></a></li>
                        <li><a href="<?php print _U ?>ecard_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1818]; ?></a></li>
                        <li><a href="<?php print _U ?>wallpaper_landing?filter=rd"><?php print tpl::$_vars['lang_ref'][1819]; ?></a></li>
                    </ul>
                </li>
                <li id="support" style="float:right;"><a href="<?php _U; ?>private_member_upload"><!--<img src="<?php print _MEDIA_URL ?>images/arrow.gif" align="left" border="0" class="armrg" />--><b><?php print strtoupper(tpl::$_vars['lang_ref'][808]); ?></b></a></li>
            </ul>
            <?php } ?>
            <?php } ?>
            <?php $shopping_header_maindiv_array = array('add_new_egentis_product', "egentis_landing", "my_egentis_setting", 'my_egentis_category', "my_egentis_products", 'my_favourite_shop_products', 'supplier_shop_landing', 'shopping_landing', 'my_shop_category', 'my_products', 'my_shop_add', 'myshop_step_2_commercial', 'myshop_step_2_private', 'myshop_step_3', 'myshop_step_4', 'my_shop_details', 'add_new_product', 'my_shop_setting', 'my_shop_landing'); ?>
            <?php if(in_array($_REQUEST['q'], $shopping_header_maindiv_array) ) { ?>
            <ul id="main-nav">
                    <!-- li style="background:none;" <?php if($url == 'shopping_landing') { ?> class="active" <?php } ?>><a href="<?php _U; ?>add_new_product"><?php print tpl::$_vars['lang_ref'][1175]; ?></a></li -->
                <?php if(isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'commercial_cutomers' ): ?>
                <li><a href="<?php _U; ?>/shopping_landing"><?php print tpl::$_vars['lang_ref'][860]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>/my_products"><?php print tpl::$_vars['lang_ref'][1369]; ?></a></li>
                        <li><a href="<?php _U; ?>add_new_product"><?php print tpl::$_vars['lang_ref'][1799]; ?></a></li>
                    </ul>
                </li>
                <!--  <li><a href="#"><?php print tpl::$_vars['lang_ref'][1370]; ?></a>
                        <ul>
                                <li><a href="#"><?php print tpl::$_vars['lang_ref'][1370]; ?></a></li>
                                <li><a href="#"><?php print tpl::$_vars['lang_ref'][1801]; ?></a></li>
                                <li><a href="#"><?php print tpl::$_vars['lang_ref'][1802]; ?></a></li>
                        </ul>
                </li>-->
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][248]; ?></a>
                    <ul>
                        <li><a href="<?php print _U; ?>my_shop_category"><?php print tpl::$_vars['lang_ref'][1371]; ?></a></li>
                        <li><a href="<?php print _U; ?>my_shop_setting"><?php print tpl::$_vars['lang_ref'][1372]; ?></a></li>
                    </ul>
                </li>
                <li><a href="<?php _U; ?>egentis_landing"><?php print tpl::$_vars['lang_ref'][3716]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>add_new_egentis_product"><?php print tpl::$_vars['lang_ref'][3717]; ?></a></li>
                        <li><a href="<?php _U; ?>my_egentis_products"><?php print tpl::$_vars['lang_ref'][3710]; ?></a></li>
                        <li><a href="<?php _U; ?>my_egentis_category"><?php print tpl::$_vars['lang_ref'][3711]; ?></a></li>
                        <li><a href="<?php _U; ?>my_egentis_setting"><?php print tpl::$_vars['lang_ref'][3712]; ?></a></li>
                    </ul>
                </li>
                <?php endif; ?>
                <li>
                    <a href="top_offers"><?php print tpl::$_vars['lang_ref'][2359]; ?></a>
                </li>
                
            </ul>
            <?php } ?>
            <?php $shop_setting_maindiv_array = array('my_shop_setting1'); ?>
            <?php if(in_array($_REQUEST['q'], $shop_setting_maindiv_array)){ ?>
            <ul id="main-nav">
                <li><a href="<?php _U; ?>my_products"><?php print tpl::$_vars['lang_ref'][1369]; ?></a></li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][1370]; ?></a></li>
                <li><a href="<?php _U; ?>my_shop_category"><?php print tpl::$_vars['lang_ref'][1371]; ?></a></li>
                <li><a href="<?php _U; ?>my_shop_setting"><?php print tpl::$_vars['lang_ref'][1372]; ?></a></li>
                <li id="support" style="float:right;"><a href="<?php _U; ?>add_new_product"><!--<img src="<?php print _MEDIA_URL ?>images/arrow.gif" align="left" border="0" class="armrg" />--><b><?php print tpl::$_vars['lang_ref'][1375]; ?></b></a></li>

            </ul>
            <?php } ?>
            <?php $classified_header_maindiv_array = array("my_improvement_suggestions", "my_trust_report_reviews", "add_event_step_2_commercial", 'landing', 'classifieds', 'display_classified', 'edit_car_classified', 'add_general_classified', 'add_car_classified', 'general_classified_
		_private', 'general_classified_step_2_commercial', 'general_classified_step_3', 'car_classified_step_3', 'classified_details', 'general_classified_details', 'car_landing', 'classified_step_4', 'my_general_classified', 'edit_general_classified', 'my_favourite_general_classified', 'my_favourite_car_classified', 'general_classified_landing', 'my_shop', 'my_car_classified', 'event_landing', 'add_event', 'general_event_step_2_private', 'general_event_step_2_commercial', 'add_event_step_3', 'add_event_step_4', 'my_event_classified', 'event_details', 'my_event_landing', 'job_landing', 'job_details', 'job_landing', 'add_job_step_1', 'add_job_step_2_private', 'add_job_step_3', 'job_step_4', "my_job_ads", 'my_job_classified', 'add_job_step_2_commercial', 'edit_general_job', 'edit_my_shop', 'my_favourite_job_classified', 'my_favourite_event_classified'); ?>
            <?php if(in_array($_REQUEST['q'], $classified_header_maindiv_array)){ ?>
            <?php if(isset($_SESSION['user_id'])) { ?>
            <ul id="main-nav">
                <li style="background:none;" <?php if($url == 'add_general_classified') { ?> class="active" <?php } ?>><a href="<?php _U; ?>landing" ><?php print tpl::$_vars['lang_ref'][196]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>my_general_classified"><?php print tpl::$_vars['lang_ref'][867]; ?></a></li>
                        <li><a href="<?php _U; ?>add_general_classified"><?php print tpl::$_vars['lang_ref'][883]; ?></a></li>
                    </ul>
                </li>
                <li <?php if($url == 'add_car_classified') { ?> class="active" <?php } ?>><a href="<?php _U; ?>car_landing" ><?php print tpl::$_vars['lang_ref'][887]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>my_car_classified"><?php print tpl::$_vars['lang_ref'][763]; ?></a></li>
                        <li><a href="<?php _U; ?>add_car_classified"><?php print tpl::$_vars['lang_ref'][1084]; ?></a></li>
<!--<li><a href="<?php //_U;             ?>my_favourite_car_classified"><?php //print tpl::$_vars['lang_ref'][2764];             ?></a></li>-->
                    </ul>
                </li>
                <!--<li><a href="#"><?php //print tpl::$_vars['lang_ref'][888];             ?></a>
                        <ul>
                                <li><a href="#"><?php //print tpl::$_vars['lang_ref'][1079];             ?></a></li>
                                <li><a href="#"><?php //print tpl::$_vars['lang_ref'][885];             ?></a></li>
                        </ul>
                </li>-->
                <li <?php if($url == 'display_classified') { ?> class="active" <?php } ?>><a href="<?php _U; ?>job_landing"><?php print tpl::$_vars['lang_ref'][758]; ?></a>
                    <ul>
                        <li><a href="my_job_ads"><?php print tpl::$_vars['lang_ref'][798]; ?></a></li>
                        <li><a href="add_job_step_1"><?php print tpl::$_vars['lang_ref'][886]; ?></a></li>
                    </ul>
                </li>
                <!-- li><a href="<?php _U; ?>my_shop_landing">Shop</a>
                        <ul>
                                <li><a href="<?php _U; ?>my_shop">My shop</a></li>
                                <li><a href="<?php _U; ?>my_shop_add">Create Shop</a></li>
                        </ul>
                </li -->
                <li  <?php if($url == 'add_event') { ?> class="active" <?php } ?>><a href="<?php _U; ?>event_landing" ><?php print tpl::$_vars['lang_ref'][244]; ?></a>
                    <ul>
                            <!--<li><a href="<?php _U; ?>event_landing"><?php print tpl::$_vars['lang_ref'][2238]; ?><?php // print tpl::$_vars['lang_ref'][867];             ?></a></li>-->
                        <li><a href="<?php _U; ?>my_event_classified"><?php print tpl::$_vars['lang_ref'][2911]; ?></a></li>
                        <li><a href="<?php _U; ?>add_event"><?php print tpl::$_vars['lang_ref'][2237]; ?><?php // print tpl::$_vars['lang_ref'][883];             ?></a></li>
                    </ul>
                </li>

                <li><a href="#"><?php print tpl::$_vars['lang_ref'][1177]; ?></a>
                    <ul>
                        <li><a href="<?php _U; ?>my_favourite_general_classified"><?php print tpl::$_vars['lang_ref'][196]; ?></a></li><!--866-->
                        <li><a href="<?php _U; ?>my_favourite_car_classified"><?php print tpl::$_vars['lang_ref'][887]; ?></a></li>
                        <li><a href="<?php _U; ?>my_favourite_job_classified"><?php print tpl::$_vars['lang_ref'][758]; ?></a></li>
                        <li><a href="<?php _U; ?>my_favourite_event_classified"><?php print tpl::$_vars['lang_ref'][244]; ?></a></li><!--my_favourite_event_classified-->
                    </ul>
                </li>

            </ul>
            <?php }else{ ?>
            <ul id="main-nav">
                <li style="background:none;" <?php if($url == 'landing' ) { ?> class="active" <?php } ?>><a href="<?php _U; ?>landing" ><?php print tpl::$_vars['lang_ref'][196]; ?></a></li>
                <li <?php if($url == 'car_landing') { ?> class="active" <?php } ?>><a href="<?php _U; ?>car_landing" ><?php print tpl::$_vars['lang_ref'][887]; ?></a></li>
                <!--<li><a href="#"><?php print tpl::$_vars['lang_ref'][888]; ?></a></li>-->
                <li <?php if($url == 'display_classified') { ?> class="active" <?php } ?>><a href="job_landing"><?php print tpl::$_vars['lang_ref'][758]; ?></a></li>
                <li <?php if($url == 'add_event') { ?> class="active" <?php } ?>><a href="<?php _U; ?>event_landing"><?php print tpl::$_vars['lang_ref'][244]; ?></a></li>
                <li id="support" style="float:right;"><a href="<?php _U; ?>add_general_classified"><!--<img src="<?php print _MEDIA_URL ?>images/arrow.gif" align="left" border="0" class="armrg" />--><b><?php print tpl::$_vars['lang_ref'][883]; ?></b></a></li>

            </ul>
            <?php } ?>
            <?php } ?>

            <?php $my_home_page_maindiv_array = array('my_home_page', 'scanfile', 'my_guestbook'); ?>
            <?php if(in_array($_REQUEST['q'], $my_home_page_maindiv_array)) { ?>
            <ul id="main-nav">
                <li><a href="<?php print _U; ?>scanfile"><?php print tpl::$_vars['lang_ref'][1418]; ?></a></li>
                <li><a href="<?php print _U; ?>my_home_page"><?php print tpl::$_vars['lang_ref'][1419]; ?></a></li>
                <li><a href="<?php print _U; ?>my_guestbook"><?php print tpl::$_vars['lang_ref'][1420]; ?></a></li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][1421]; ?></a></li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][1422]; ?></a></li>
            </ul>
            <?php } ?>
            <?php /* 		<?php $event_header_maindiv_array = array('event_landing','add_event','general_event_step_2_private','general_event_step_2_commercial','add_event_step_3','add_event_step_4'); ?>
              <?php if(in_array($_REQUEST['q'],$event_header_maindiv_array)){ ?>
              <?php if(isset($_SESSION['user_id'])) { ?>
              <ul id="main-nav">
              <li style="background:none;" <?php if($url == 'add_event') { ?> class="active" <?php } ?>><a href="<?php _U;?>event_landing" ><?php print tpl::$_vars['lang_ref'][244];?></a>
              <ul>
              <li><a href="<?php _U;?>event_landing"><?php print tpl::$_vars['lang_ref'][2238];?><?php // print tpl::$_vars['lang_ref'][867];?></a></li>
              <li><a href="<?php _U;?>add_event"><?php print tpl::$_vars['lang_ref'][2237];?><?php // print tpl::$_vars['lang_ref'][883];?></a></li>
              </ul>
              </li>
              </ul>
              <?php }else{ ?>
              <ul id="main-nav">
              <li style="background:none;" <?php if($url == 'event_landing' ) { ?> class="active" <?php } ?>><a href="<?php _U;?>event_landing" ><?php print tpl::$_vars['lang_ref'][1182];?></a></li>
              </ul>
              <?php }?>
              <?php } ?>

             */ ?>
            <?php if(in_array($_REQUEST['q'], $websearch_array)) { ?>
            <ul id="main-nav">
                <li style="background:none;"><a href="#"><?php print tpl::$_vars['lang_ref'][175]; ?></a></li>
                <li class="active"><a href="#"><?php print tpl::$_vars['lang_ref'][188]; ?></a></li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][189]; ?></a></li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][530]; ?></a></li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][191]; ?></a></li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][192]; ?></a></li>
                <li><a href="#"><?php print tpl::$_vars['lang_ref'][193]; ?></a></li>
            </ul>
            <? } ?>
        </div>
        <!--header nav end-->
        <?php if($_REQUEST['q'] != 'online_support' && 0): ?>
        <div>
            <script type="text/javascript" src="http://www.adhoster.de/Banner/MultipleBar.ashx?adid=2003" ></script>
        </div>
        <?php endif; ?>

    </div>

    
    <?php if($_SESSION['user_id'] && $_SESSION['user_role'] == 'commercial_cutomers'): ?>
    <div style="background-color:white;clear:both;height:80px;padding-top:12px;display:none" id="book_ad_space1"  >
        <img src="<?php print getNoimage($_SESSION['lid'], 967, 80, 'no-image_ni_banner'); ?>" style="cursor:pointer;" onclick="javascript:location.href='<?php print _U ?>book_ad_space'" />
    </div>
    <div style="background-color:white;clear:both;height:80px;padding-top:12px;display:none" id="book_ad_space2" >
        <img src="<?php print getNoimage($_SESSION['lid'], 967, 80, 'no-image_ni_banner2'); ?>" style="cursor:pointer;" onclick="javascript:location.href='<?php print _U ?>buy_first_print_credits'" />
    </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION['user_id'])): ?>
    <div style="background-color:white;clear:both;height:80px;padding-top:12px;display:none" id="book_ad_space1"  >
        <img src="<?php print getNoimage($_SESSION['lid'], 967, 80, 'Adlino-Info_Banner-01'); ?>" style="cursor:pointer;" onclick="javascript:location.href='<?php print _U ?>step2_commercial_customer'" />
    </div>
    <div style="background-color:white;clear:both;height:80px;padding-top:12px;display:none" id="book_ad_space2" >
        <img src="<?php print getNoimage($_SESSION['lid'], 967, 80, 'Adlino-Info_Banner-02'); ?>" style="cursor:pointer;" onclick="javascript:location.href='<?php print _U ?>step2_individuals'" />
    </div>
    <div style="background-color:white;clear:both;height:80px;padding-top:12px;display:none" id="book_ad_space3"  >
        <img src="<?php print getNoimage($_SESSION['lid'], 967, 80, 'Adlino-Info_Banner-03'); ?>" style="cursor:pointer;" onclick="javascript:location.href='<?php print _U ?>step2_commercial_customer'" />
    </div>
    <div style="background-color:white;clear:both;height:80px;padding-top:12px;display:none" id="book_ad_space4" >
        <img src="<?php print getNoimage($_SESSION['lid'], 967, 80, 'Adlino-Info_Banner-04'); ?>" style="cursor:pointer;" onclick="javascript:location.href='<?php print _U ?>step2_individuals'" />
    </div>
    <?php endif; ?>
    
</div>
<script type="text/javascript" >
    
    function theme_c(id)
    {
        new_location = location.href;
        if(new_location.match(/(th=[0-9a-zA-Z_-]*)/ig)){
            new_location = new_location.replace(/(th=[0-9a-zA-Z_-]*)/ig, '');
            var append = location.search != ''  ? 'th='+id : '?th='+id;
        }
        else{
            var append = location.search != ''  ? '&th='+id : '?th='+id;
        }
        location.href = new_location + append;
    }
    function updateTime(){
        $.ajax({
            type:"GET",
            url:"<?php print _U ?>time.php",
            success:function(responseVal){
                $("#tr_time").html(responseVal);
                setTimeout(updateTime,60000);
            }
        });
    }
    var bbanner = 2;
    function rotateBookBanner() {
    
        if(bbanner==2) {
            $("#book_ad_space1").show();
            $("#book_ad_space2").hide();
            bbanner = 1;
        }else {
            $("#book_ad_space2").show();
            $("#book_ad_space1").hide();
            bbanner = 2;
        }
        setTimeout(rotateBookBanner,5000);
    }
    function rotateBookBannerLO() {
        
        switch(bbanner) {
            case 1:
                $("#book_ad_space1").show();
                $("#book_ad_space2").hide();
                $("#book_ad_space3").hide();
                $("#book_ad_space4").hide();
                bbanner = 2;
                break;
            case 2:
                $("#book_ad_space1").hide();
                $("#book_ad_space2").show();
                $("#book_ad_space3").hide();
                $("#book_ad_space4").hide();
                bbanner = 3;
                break;
            case 3:
                $("#book_ad_space1").hide();
                $("#book_ad_space2").hide();
                $("#book_ad_space3").show();
                $("#book_ad_space4").hide();
                bbanner = 4;
                break;
            case 4:
                $("#book_ad_space1").hide();
                $("#book_ad_space2").hide();
                $("#book_ad_space3").hide();
                $("#book_ad_space4").show();
                bbanner = 1;
                break;

        }
        setTimeout(rotateBookBannerLO,5000);
    }
    $(document).ready(function(){
        setTimeout(updateTime,60000);

<?php if($_SESSION['user_id'] && $_SESSION['user_role'] == 'commercial_cutomers' ): ?>
<?php if($_SESSION['total_bought_credit'] > 1): ?>
        $("#book_ad_space1").show();
<?php else: ?>
        $("#book_ad_space2").show();
        bbanner = 1;
        setTimeout(rotateBookBanner,5000);
<?php endif; ?>
<?php endif; ?>

<?php if(!isset($_SESSION['user_id'])): ?>
        $("#book_ad_space1").show();
        bbanner = 2;
        setTimeout(rotateBookBannerLO,5000);
<?php endif; ?>

    });
</script>
