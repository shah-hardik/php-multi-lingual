<?php
global $_user_msg, $url;
$url = _do_access_check($url);
?>

<div id="header1">
    <!--header area start-->
    <div class="header_top">
        <!--header top start-->
        <?php //print date("l d F Y");  ?>
        <?php print strftime("%A, %d %B %Y", strtotime(date('Y-m-d', time()))); ?>
        <!--header top end-->
    </div>
    <div class="header_bottom">
        <!--header bottom start-->
        <div class="headerleft"> </div>
        <div class="headermid">
            <!--header mid start-->
            <div class="logo">
                <!--logo area start-->
                <?php if ($_SESSION['adlino_user_type'] != 4) { ?>
                    <a href="#"><img src="<?php print _MEDIA_URL ?>images/logo.gif" border="0" title="Adlino Deuschland" alt="Adlino Deuschland" /></a><br />
                    <?php
                } else {

                    if (isset($_SESSION['lid']))
                        $l_id = $_SESSION['lid'];
                    else
                        $l_id = DEFAULT_LANG;
                    $country_name = getCountryName($l_id, 6);
                    ?>
                    <a href="#"><img src="<?php print _MEDIA_URL ?>images/logo_4.gif" border="0" title="Adlino Deuschland" alt="Adlino Deuschland" /></a><br />
                    <div style="float:left; color:#000000;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:bold;padding:0 0 0 75px;text-align:right;width:50px;"><?php echo $country_name; ?></div>
                <?php } ?>

                <!--logo area end-->
            </div>
            <div class="headerrt">
                <!--header rt start-->
                <div class="topnav">
                    <!--topnav start-->
                    <div class="navleft"> </div>
                    <div class="nav">
                        <!--nav area start-->
                        <ul>
                            <li><a href="<?php print _U ?>login" rel="gc4" style="margin:0px;"><?php print tpl::$_vars['lang_ref'][399]; ?></a></li>
                        </ul>
                        <!--nav area right-->
                    </div>
                    <div class="navright"> </div>
                    <!--topnav end-->
                </div>
                <div class="flag-area">
                    <!--flag area start-->
                    <?php
#Common function for get language flages strip
# Do not display lang banner for city moderator
                    if (_find_user_type() != 4 && _find_user_type() != 17)
                        _get_lang_flag_belt1();
                    ?>
                    <!--flag area end-->
                </div>
                <!--header rt end-->
            </div>
            <div class="wel_user">
                <!--wel user start-->
                <span class="user">

                    <? if ($_SESSION['adlino_user_type'] == '2' || $_SESSION['adlino_user_type'] == '4' || $_SESSION['adlino_user_type'] == '6' || $_SESSION['adlino_user_type'] == '7') { ?>
                        <a href="<? print _U . "users/edit_my_detail"; ?>">
                        <? } ?>
                        <?php print tpl::$_vars['lang_ref'][626]; ?> 
                        <?php print _e($_SESSION['adlino_user_first_name']) . " " . _e($_SESSION['adlino_user_last_name']) ?></a> !</span><br />
                <?php ?>
                <span class="admin-name">
                    <?php // _e($_user_msg); ?>
                </span>
                <?php if (isset($_SESSION['admin_user_id']) && $_SESSION['admin_user_id'] != '' && isset($_SESSION['adlino_user_type']) && $_SESSION['adlino_user_type'] != 5) { ?>
                    &nbsp;&nbsp; <a href="<? print _U . "sublogin?admin_user_id=" . $_SESSION['admin_user_id']; ?>"><?php print tpl::$_vars['lang_ref'][2515]; ?></a>
                <?php } ?>

                <!--wel user end-->
            </div>
            <div class="headerrt">
                <!--header nav start-->
                <div class="main-navigation">
                    <!--main navigation start-->

                    <!--main navigation end-->
                </div>
                <!--header nav end-->
            </div>
            <!--header mid end-->
        </div>
        <div class="headerright"> </div>
        <!--header bottom end-->
    </div>
    <div class="header-nav">
        <!--header nav start-->
        <div class="main-nav">
            <!--main nav start-->
            <ul>
                <li style="background:none;"><?php print breadcrumb_home(1); ?></li>

                <?php
                $menu_translation = '<li><a href="' . _U . 'translation/add_translation">' . tpl::$_vars['lang_ref'][396] . '</a></li>';
                $menu_admin = '<li><a href="' . _U . 'adhoster/add_sizes">' . tpl::$_vars['lang_ref'][99319] . 'Adhoster</a></li>';
                $menu_admin .= '<li><a href="' . _U . 'users/list_moderator_general">' . tpl::$_vars['lang_ref'][319] . '</a></li>';
                // $menu_developer='<li><a href="'._U.'website/list_website">'.tpl::$_vars['lang_ref'][321].'</a></li>';
                $menu_admin_1 = '<li><a href=';
                $menu_admin_2 = '>Geographical Area</a></li>';
                $menu_moderate = "<li><a href='" . _U . "moderate/moderate_dashboard'>" . tpl::$_vars['lang_ref'][314] . "</a></li>";
                $my_data = "<li><a href='" . _U . "users/edit_my_detail'>" . tpl::$_vars['lang_ref'][807] . "</a></li>";
                $menu_extra = "<li><a href='" . _U . "extra/invite_mail_draft'>Extra</a></li>";

                $menu_logos = "<li><a href='" . _U . "adlinobiz_categories/list_logo_category'>" . tpl::$_vars['lang_ref'][987] . "</a></li>";
                $menu_logos.="<li><a href='" . _U . "adlinobiz_translataion/add_logo_cat_translation'>" . tpl::$_vars['lang_ref'][396] . "</a></li>";
                $menu_logos.="<li><a href='" . _U . "adlinobiz_moderate/logos'>" . tpl::$_vars['lang_ref'][1911] . "</a></li>";

                $menu_webcard = "<li><a href='" . _U . "adlinobiz_categories/list_webcard_category'>" . tpl::$_vars['lang_ref'][987] . "</a></li>";
                $menu_webcard.="<li><a href='" . _U . "adlinobiz_translataion/add_webcard_cat_translation'>" . tpl::$_vars['lang_ref'][396] . "</a></li>";
                $menu_webcard.="<li><a href='" . _U . "adlinobiz_moderate/webcards'>" . tpl::$_vars['lang_ref'][1912] . "</a></li>";

                $menu_voucher.="<li><a href='" . _U . "adlinobiz_categories/list_voucher_category'>" . tpl::$_vars['lang_ref'][987] . "</a></li>";
                $menu_voucher.="<li><a href='" . _U . "adlinobiz_translataion/add_voucher_cat_translation'>" . tpl::$_vars['lang_ref'][396] . "</a></li>";
                $menu_voucher.="<li><a href='" . _U . "adlinobiz_moderate/vouchers'>" . tpl::$_vars['lang_ref'][862] . "</a></li>";

                $menu_banner = "<li><a href='" . _U . "adlinobiz_categories/list_banner_category'>" . tpl::$_vars['lang_ref'][987] . "</a></li>";
                $menu_banner.="<li><a href='" . _U . "adlinobiz_translataion/add_banner_cat_translation'>" . tpl::$_vars['lang_ref'][396] . "</a></li>";
                $menu_banner.="<li><a href='" . _U . "adlinobiz_moderate/banners'>" . tpl::$_vars['lang_ref'][756] . "</a></li>";

                $menu_flyer = "<li><a href='" . _U . "adlinobiz_categories/list_flyers_category'>" . tpl::$_vars['lang_ref'][987] . "</a></li>";
                $menu_flyer.="<li><a href='" . _U . "adlinobiz_translataion/add_flyer_cat_translation'>" . tpl::$_vars['lang_ref'][396] . "</a></li>";
                $menu_flyer.="<li><a href='" . _U . "adlinobiz_moderate/flyers'>" . tpl::$_vars['lang_ref'][1913] . "</a></li>";

                $menu_websitetemplates = "<li><a href='" . _U . "adlinobiz_categories/list_websitetemplate_category'>" . tpl::$_vars['lang_ref'][987] . "</a></li>";
                $menu_websitetemplates.="<li><a href='" . _U . "adlinobiz_translataion/add_wt_cat_translation'>" . tpl::$_vars['lang_ref'][396] . "</a></li>";
                $menu_websitetemplates.="<li><a href='" . _U . "adlinobiz_moderate/wts'>" . tpl::$_vars['lang_ref'][987] . "</a></li>";

                $menu_video = "<li><a href='" . _U . "adlinobiz_categories/list_videos_category'>" . tpl::$_vars['lang_ref'][987] . "</a></li>";
                $menu_video.="<li><a href='" . _U . "adlinobiz_translataion/add_video_cat_translation'>" . tpl::$_vars['lang_ref'][396] . "</a></li>";
                $menu_video.="<li><a href='" . _U . "adlinobiz_moderate/videos'>" . tpl::$_vars['lang_ref'][197] . "</a></li>";

                $costs_extra = "<li><a href='" . _U . "geographical/cost_management'>" . tpl::$_vars['lang_ref'][2419] . "</a></li>";
                $weather = "<li><a href='" . _U . "geographical/weather'>" . tpl::$_vars['lang_ref'][2453] . "</a></li>";
                $earning = "<li><a href='" . _U . "geographical/moderator_earning'>" . tpl::$_vars['lang_ref'][2697] . "</a></li>";
                $accounting = "<li><a href='" . _U . "account/manage_fees'>" . tpl::$_vars['lang_ref'][2703] . "</a></li>";


                //$website = "<li><a href='"._U."geographical/weather'>".tpl::$_vars['lang_ref'][2453 ]."</a></li>";
                #$menu_translation_1."".$menu_translation_2
                /*  Roles with id
                  1 Translation Admin
                  2 Translation Moderator
                  3 Country Admin
                  4 City Moderator
                  5 Super Admin
                  6 State Admin
                  7 Provinces Admin
                  8 developer */


                switch ($utype = _find_user_type()) {
                    case 1: #Translation Admin
                        echo $menu_translation;
                        echo $my_data;
                        break;
                    case 2: #Translation Moderator
                        echo $menu_translation;
                        echo $my_data;
                        break;
                    case 3: #Country Admin			
                        echo $menu_admin_1 . '"' . _U . 'geographical/list_states	"' . $menu_admin_2;
                        echo "<li><a href='" . _U . "moderate/moderate_dashboard'>" . tpl::$_vars['lang_ref'][314] . "</a></li>";
                        echo $my_data;
                        break;
                    case 4: #City Moderator 
                        //echo $menu_translation;
                        //echo $menu_admin_1.'"'._U.'geographical/list_neighborhoods"'.$menu_admin_2;
                        //echo $menu_admin_1;
                        echo "<li><a href='" . _U . "geographical/list_companies'>" . tpl::$_vars['lang_ref'][242] . "</a></li>";
                        //echo "<li><a href='"._U."geographical/list_private_users'>".tpl::$_vars['lang_ref'][247]."</a></li>";
                        /* echo "<li><a href='#'>".tpl::$_vars['lang_ref'][460]."</a></li>";
                          echo "<li><a href='#'>".tpl::$_vars['lang_ref'][471]."</a></li>";
                          echo "<li><a href='#'>".tpl::$_vars['lang_ref'][472]."</a></li>";
                          echo "<li><a href='#'>".tpl::$_vars['lang_ref'][473]."</a></li>"; */
                        echo $menu_moderate;
                        echo $my_data;
                        //echo $weather;
                        echo $earning;
                        echo "<li><a href='" . _U . "sponsor_banner'>" . tpl::$_vars['lang_ref'][2919] . "</a></li>";
                        //get website url for city Moderator.
                        $db = db::__d();
                        $res = $db->query("select ci_website,ci_website_adhoster from cities where ci_id = " . $_SESSION['adlino_user_city_id']);
                        $website = $db->format_data($res);
                        if ($website[0]['ci_website'] != '') {

                            $text = explode(".", $website[0]['ci_website_adhoster']);
                            if ($text[0] == "http://www" || $text[0] == "www" || $text[0] == "WWW" || $text[0] == "HTTP://WWW")
                                echo "<li><a href='" . $text[1] . "." . $text[2] . "' target='_blank'>" . tpl::$_vars['lang_ref'][72] . "</a></li>";
                            else
                                echo "<li><a href='http://" . $text[0] . "." . $text[1] . "' target='_blank'>" . tpl::$_vars['lang_ref'][72] . "</a></li>";
                        }
                        else {
                            echo "<li><a href='#'>" . tpl::$_vars['lang_ref'][72] . "</a></li>";
                        }


                        break;
                    case 5: #Super Admin 
                        echo $menu_translation;
                        echo $menu_admin;
                        echo $menu_developer;
                        echo $menu_moderate;
                        echo $menu_extra;
                        echo $costs_extra;
                        echo $accounting;
                        break;
                    case 6:#State Admin			
                        echo $menu_admin_1 . '"' . _U . 'geographical/list_provinces"' . $menu_admin_2;
                        echo $my_data;
                        break;
                    case 7:#Provinces Admin	
                        echo $menu_admin_1 . '"' . _U . 'geographical/list_cities"' . $menu_admin_2;
                        echo $my_data;
                        break;
                    case 8:#developer 			
                        echo $menu_developer;
                        echo $my_data;
                        break;

                    case 9:#adlinobiz logo moderator
                        echo $menu_logos;

                        break;
                    case 10:#adlinobiz webcard moderator
                        echo $menu_webcard;

                        break;

                    case 11:#adlinobiz voucher moderator
                        echo $menu_voucher;

                        break;


                    case 12:#adlinobiz banner moderator
                        echo $menu_banner;

                        break;

                    case 13:#adlinobiz flyer moderator
                        echo $menu_flyer;

                        break;

                    case 14:#adlinobiz Websitetemplate moderator
                        echo $menu_websitetemplates;

                        break;

                    case 15:#adlinobiz Video moderator
                        echo $menu_video;

                        break;

                    case 16: # portal moderator
                    case 18: # textworker

                        echo $my_data;


                        break;
                    case 17: # portal moderator
                        echo $my_data . "<li><a href='" . _U . "geographical/support_call_back_list'>" . tpl::$_vars['lang_ref'][3495] . "</a></li>";
                        break;


                    default:
                        echo "Sorry , Not a valid User";
                        break;
                }
                ?>
            </ul>
            <!--main nav end-->
        </div>
        <!--header nav end-->
    </div>
    <!--header area end-->
</div>
