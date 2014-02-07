<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" /> 
        <title><?php print tpl::$_website_title ?></title>
        <?php /* in each .inc page, we can set below two template variable.  */ ?>
        <meta name="description" content="<?php print tpl::$_meta_description_content ?>" /> 
        <meta name="keywords" content="<?php print tpl::$_meta_keywords_content ?>" />
        <link rel="shortcut icon" href="<?php print _MEDIA_URL ?>images/24icon.jpg" type="image/x-icon" />
        <meta name="language" content="de" />
        <!--[if lte IE 6]>
            <style type="text/css">
                .ieTips{
                    padding-top:11px !important;
                }.ragestr{width:110px !imporant;}
                .yl_mid_bg{width:206px !important}
                .ieTopShadow{
                     background-position-y:-666px !important;
                }
                .ragestr{
                    width:110px !important;
                }
                #ticker-controls{
                    width:70px !important;
                }
                .small_left_voucher{height:58px !important}
                #ticker{width:900px !important}
            </style>
        <![endif]-->
        <?php if (tpl::$_meta_og_image): ?>
            <meta property="og:image" content="<?php print tpl::$_meta_og_image ?>" />
        <?php endif; ?>
        <?php if (tpl::$_meta_og_title): ?>
            <meta property="og:title" content="<?php print tpl::$_meta_og_title ?>" />
        <?php endif; ?>
        <?php if (tpl::$_meta_og_desc): ?>
            <meta property="og:description" content="<?php print tpl::$_meta_og_desc ?>" />
        <?php endif; ?>

        <script language="javascript" type="text/javascript">
            var media_url="<?php print _MEDIA_URL ?>";	
        </script>

        <link href="<?php print _MEDIA_URL ?>css/stylesheet.css" rel="stylesheet" type="text/css" />
        <link href="<?php print _MEDIA_URL ?>css/glowtabs.css" rel="stylesheet" type="text/css" />

        <!--[if lt IE 7]>
                <style type="text/css">
            img{behavior: url(iepngfix.htc)}
            .city_header_register_menu_item {behavior: url(iepngfix.htc)}
            .city_side_bar_menu_item {behavior: url(iepngfix.htc)}
             </style>
        <![endif]-->
        <style type="text/css">
            .feedback_bar{
                position:fixed;
                cursor: pointer;
                display:none;
            }

            #bottomWindow{
                padding:10px;
                height:40px;
                width:200px;
                background-color: #DADADA;
                z-index:9999999;
                position:fixed;
                bottom:10px;
                right:10px;
                border:1px solid #AAA;
                border-radius:5px;
                display:none;
            }
            #bottomWindow{
                background-image: -moz-linear-gradient(center bottom , #FFD000 15%, #FFDD00 58%, #FFE600 79%);
                background-position: 0 0;
                border: 1px solid #E0BC00;
                border-radius: 2px 2px 2px 2px !important;
                box-shadow: 0 2px 5px #AAAAAA;
                height: 40px;
                padding: 14px;
                font-family: verdana;
                text-align:left;
            }

            .singleLike {
                background-position: -2px -320px;
                cursor: pointer;
            }
            .singleLike:hover {
                background-position: -67px -320px;
                cursor: pointer;
            }
            .singleDisLike:hover {
                background-position: -99px -320px;
                cursor: pointer;
            }
            .singleDisLike {
                background-position: -34px -320px;
                cursor: pointer;
            }

            <?php $this->load_global_media(); ?>
        </style>
        <?php $this->over_ride_default_media(); ?>	

        <?php if (in_array($_REQUEST['q'], array('company_information', 'home', ''))) : ?>
            <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>        
        <?php endif; ?>
        <?php _include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_js_terms.php"); ?>	
        <script type='text/javascript' src='<?php print _MEDIA_URL ?>js/jquery-ui-1.8.16.custom/js/jquery-1.6.2.min.js'></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js"></script>
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>js/jquery-ui-1.8.16.custom/css/redmond/jquery-ui-1.8.16.custom.css" />

        <script>var tb_pathToImage = "<?= _MEDIA_BASE_URL; ?>images/loadingAnimation.gif";</script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>js/general.js"></script>
        <link href="<? print _MEDIA_BASE_URL; ?>css/thickbox.css" rel="stylesheet" type="text/css" media="all" />
        <script>var tb_pathToImage = "<?= _MEDIA_BASE_URL; ?>/images/loadingAnimation.gif";</script>

        <script type="text/javascript" src="<? print _MEDIA_BASE_URL; ?>js/thickbox.js"></script>
        <!--<link href="<?php print _MEDIA_URL ?>css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<? print _MEDIA_BASE_URL; ?>city/js/jquery.autocomplete.js"></script> -->
        <script type="text/javascript" src="<?php print _MEDIA_BASE_URL ?>js/jcarousellite_1.0.1.min.js"></script>
        <style type="text/css">
            ._waitCon {
                position:fixed;width:100%;display:none;
            }
            ._waitText {
                padding:0.5em;background-color:#FFFDCF;font-family:verdana;
            }
            .ieHeight{
                font-size:1px;line-height:0;
            }


        </style>
        <script type="text/javascript">
            var ca = '<?php print tpl::$_vars['lang_ref'][1260] ?>';
            function facebook_share(url) {
                window.open("http://www.facebook.com/sharer.php?u="+encodeURIComponent(url));
            }

            function _s() {
                $("#_wait").toggle();
            }
            
            $(document).ready(function(){
                
                /*$("#main-nav > li > a ").each(function(i,e){
                    $(this).hover(function(){
                        alert("hi");
                        $(this).next().show();
                    },function(){
                    });
                }); */
                
                if($.browser.msie){
                    $("#hmpgIcon").show();
                }
                $("._get_weather_data").each(function(){
                    var wid = $(this).attr("id");
                    var cid = $(this).attr("id").split("_")[1];
                    var tpl = $(this).attr("id").split("_")[2];
                    $(this).html('<?php print tpl::$_vars['lang_ref'][1259] ?>&nbsp;<img src="<?php print _MEDIA_URL ?>images/w_ajax-loader.gif" />');
                    var _data = {};
                    _data.cid=cid;_data.tpl=tpl;
                    $.ajax({
                        type:"POST",
                        url:"<?php print _U ?>weather_google_cron",
                        data:_data,
                        success:function(responseVal){
                            $("#"+wid).html(responseVal);
                        }
                    });  
                    
<?php if ($_SESSION['cache']['GetCityWebsiteName'][0]['ci_win_game'] != 0): ?>
                                                                                                    
                var fb_height = $("#feedback_bar").height();
                var win_height = $(window).height();
                var middle_point = (win_height-fb_height) / 2;
                $("#feedback_bar").css('top',middle_point+'px').show();

                                                                                                                        
                $( "#feedback_banner" ).dialog({
                    modal:true,autoOpen: false,height:540,width:900,title:'<?php print tpl::$_vars['lang_ref'][$_SESSION['cache']['GetCityWebsiteName'][0]['ci_win_game']] ?>'
                });

                $( "#feedback_bar" ).click(function() {
                    $( "#feedback_banner" ).dialog( "open" );
                    return false;
                });                        
<?php endif; ?>
                   
        });
        $("td.pur_bg").each(function(){
            try{
                var _content = $(this).html();
                $(this).empty();
                $(this).append('<div class="grn_main"><div class="grn_bx">&nbsp;</div><div class="grn_cnt">'+_content+'</div></div>');
            }catch(e){}
        });
        var moColor = '#D4E5FA';
               
        $("._mo").hover(
        function(){
            $(this).css({'background-image':'url(<?php print _MEDIA_URL ?>images/company_box_hover.jpg)','background-repeat':'repeat-x'});
            $(this).prev().css({'background-image':'url(<?php print _MEDIA_URL ?>images/company_box_hover.jpg)','background-repeat':'repeat-x'});
        },
        function(){
            $(this).css('background-image','none');
            $(this).prev().css('background-image','none');
        }

    );
        $("._mos, .ltside ul li").hover(
        function(){
            $(this).css({'background-image':'url(<?php print _MEDIA_URL ?>images/company_box_hover.jpg)','background-repeat':'repeat-x'});
        },
        function(){
            $(this).css('background-image','none');
        }
    );
               
    });
    function setHome(){
        document.body.style.behavior='url(#default#homepage)';
        document.body.setHomePage('<?php print _U ?>');
    }
    
    function showBottomWindow(msg){
        $("#bottomWindow").html(msg).fadeToggle();
        setTimeout(hideBottomWindow,3000);
    }
    
    function hideBottomWindow(){
        $("#bottomWindow").html('').fadeToggle();
    }
    
    var _uid=0;
<?php if ($_SESSION['user_id']): ?>
        _uid = '<?php print $_SESSION['user_id'] ?>';
<?php endif; ?>
    
        </script>
    </head>
    <body >


        <?php if ($_SESSION['cache']['GetCityWebsiteName'][0]['ci_win_game'] != 0): ?>
            <?php
            $banner = $_SESSION['cache']['GetCityWebsiteName'][0]['ci_win_game'] == '3761' ? 'city_game-banner-01' : 'city_game-banner-02';
            ?>
            <div class="feedback_bar" id="feedback_bar">
                <img src="<?php print _MEDIA_URL ?>images/City_Games_Banners_145_x_35.png" />
            </div>

            <div style="display:none" id="feedback_banner">
                <div style="width:860px;height:300px;background-image: url(<?php print getNoimage($_SESSION['lid'], 860, 300, $banner); ?>);margin-top:10px;background-repeat: no-repeat">
                    <input style="margin-left:625px;margin-top:205px;font-family:tahoma;font-size:18px !important"  type="button" class="s_but" value="<?php print tpl::$_vars['lang_ref'][3763]; ?>" onclick="location.href='<?php print _U ?>private_user_register'" />
                </div>
                <?php if (!empty($sponsor_logos)): ?>        
                    <div style="margin-top:10px" >
                        <?php print tpl::$_vars['lang_ref']['1025']; ?>
                    </div>
                    <?php $i = 0;
                    foreach ($sponsor_logos as $each_image):$i++ ?>
                        <div style="margin-top:15px;width:200px;<?php if ($i % 4 != 0): ?>margin-right:20px<?php endif; ?>;float:left">
                            <img src="<?php print _MEDIA_BASE_URL ?>upload/company_images/original_<?php print $each_image['image'] ?>" style="border:1px solid #DADADA" />
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        <?php endif; ?>

        <center>

            <div class="_waitCon" id="_wait" style="display:none" ><span class="_waitText"  ><?php print tpl::$_vars['lang_ref'][1259]; ?></span></div>
            <div id="main" style="margin-top:10px;margin-bottom: 30px;">
                <div class="tr_time" style="font-family: tahoma;font-size:12px;text-align: right;width:1060px;margin:0px auto;">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td align="left">

                            </td>
                            <td align="right">
                                <?php if ($_SESSION['cache']['city_details_info'][0]['fb_check']): ?>
                                    <a href="<?php print $_SESSION['cache']['city_details_info'][0]['fb_url'] ?>"><img style="position:relative;top:5px;margin-right:4px;border:0px none;" src="<?php print _MEDIA_URL ?>images/facebook_button.gif" /></a>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <?php
                                    $home_url = $_SESSION['user_name'] ? 'private_member_profile' : 'my_data';
                                    ?>
                                    <span style="width:400px;">
                                        <span style="color:maroon;">
                                            <a href="http://www.adlino.de/<?php print $home_url ?>" target="_blank">
                                                <?php print tpl::$_vars['lang_ref'][626]; ?> 
                                                <?php print $_SESSION['first_name'] ?> <?php print $_SESSION['last_name'] ?></a>
                                        </span> 
                                        [ <a href="<?php print _U ?>?doLogout=1"><?php print tpl::$_vars['lang_ref'][399] ?></a> ] | 
                                    </span>
                                <?php else : ?>
                                    <a id="doLogin" onclick="doLogin()" style="cursor:pointer"><img style="position:relative;top:5px;margin-right:4px;" src="<?php print _MEDIA_URL ?>images/login.gif" title="<?php print tpl::$_vars['lang_ref'][40]; ?>" /></a> 
                                <?php endif; ?>

                                <span>
                                    <span style="cursor:pointer;display:none;width:20px" id="hmpgIcon" ><img onclick="setHome();" style="position:relative;top:3px;margin-right:4px;" src="<?php print _MEDIA_URL ?>images/mhp_home_icon.gif" title="<?php print tpl::$_vars['lang_ref'][3781] ?>" /> </span>
                                    <span id="tr_time2" style="display:none"><?php print strftime("%A, %d. %B %Y - %H:%M"); ?></span>
                                </span>
                            </td>
                        </tr>
                    </table>

                </div>

                <table cellpadding="0" cellspacing="0" border="0" width="1080" style="border-top:0px solid black;border-bottom:0px solid black;" >
                    <tr>
                        <td colspan="3" style="">
                            <div class="ieTopShadow" style="width:500px;height:11px;background-image: url(<?php print _MEDIA_URL ?>images/images.png);background-repeat: no-repeat;background-position: -12px -672px;">&nbsp;</div>
                        </td>
                    </tr>
                    <?php if (tpl::$_display['header']): ?>
                        <tr>
                            <td valign="bottom" width="10" style="border-left: 0px solid black;" >
                                <div style="margin-bottom:0px;width:10px;height:600px;background-image: url(<?php print _MEDIA_URL ?>images/images.png);background-repeat: no-repeat;background-position: -1060px 1px;">&nbsp;</div>
                            </td>
                            <td class="main_midle_tr">
                            <?php endif; ?>
                            <?php $this->load_header(); ?>

                            <div id="bottom-area">
                                <!--bottom area start-->
                                <div id="middle_content">
                                    <!--btm top area start-->

                                    <?php
                                    if (_REQUEST_PAGE == "index") {
                                        include(_PATH . "templates/" . _WEBSITE_THEME . "/login.tpl.php");
                                    } else if (!is_file(_PATH . "templates/" . _WEBSITE_THEME . "/" . _REQUEST_PAGE . ".tpl.php")) {
                                        include(_PATH . "templates/" . _WEBSITE_THEME . "/404.tpl.php");
                                    } else {
                                        include(_PATH . "templates/" . _WEBSITE_THEME . "/" . _REQUEST_PAGE . ".tpl.php");
                                    }
                                    ?>

                                    <!--btm top area end-->
                                </div>
                                <div class="btm-btm"> </div>
                                <!--bottom area end-->
                            </div>
                            <!--main-page area end-->
                            <?php print $this->load_footer(); ?>
                            <!--main area end-->
                            <?php if (tpl::$_display['footer']): ?>
                            </td>
                            <td valign="bottom" width="10" style="border-right: 0px solid black;background-image: url(<?php print _MEDIA_URL ?>images/images.png);background-repeat: no-repeat;background-position: -1034px 1px;">

                            </td>
                        </tr></table>    
                <?php endif; ?>
            </div>
            <div id="bottomWindow">
                New Message window
            </div>
        </center>
    </body>
</html>
