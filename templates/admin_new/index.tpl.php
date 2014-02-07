<?php if (in_array($_REQUEST['q'], array("geographical/tv_programm_standard", 'geographical/tv_programm'))): ?> 
    <?php include 'index_full_width.tpl.php'; ?>
<?php else: ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title><?php print tpl::$_website_title ?></title>
            <?php if (in_array($_REQUEST['q'], array('geographical/list_cities'))) : ?>
                <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>        
            <?php endif; ?>


            <?php if (!isset($_GET['a_ajax'])): ?>
                <link href="<?php print _MEDIA_URL ?>css/stylesheet.css" rel="stylesheet" type="text/css" />
                <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/glowtabs.css" />


                <?php if ($_REQUEST['q'] == 'geographical/admin_info_edit'): ?>
                    <script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery-1.2.2.pack.js"></script> 
                <?php else: ?>
                    <script type='text/javascript' src='<?php print _MEDIA_URL ?>js/jquery-ui-1.8.15.custom/js/jquery-1.6.2.min.js'></script>
                <?php endif; ?>
                <script type="text/javascript" src="<?php print _MEDIA_URL ?>js/category_mgmt.js"></script>
                <script type="text/javascript" src="<?php print _MEDIA_URL ?>js/ddaccordion.js"></script>
                <script type="text/javascript" src="<?php print _MEDIA_URL ?>js/adlbiz_cat_mgmt.js"></script>


                <script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.tablednd_0_5.js"></script>

                <!--AUTOCOMPLETE FUNCTIONA START -->
                <script type='text/javascript' src='<?php print _MEDIA_URL ?>js/jquery.autocomplete.js'></script>
                <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.autocomplete.css" />
                <!--AUTOCOMPLETE FUNCTIONA END -->


                <link href="<?php print _MEDIA_URL ?>css/inettuts.css" rel="stylesheet" type="text/css" />


                <!--[if lt IE 7]>
                        <style type="text/css">
                          img, div,table,td { behavior: url("css/iepngfix.htc") }
                         </style>
                <![endif]-->

                <style type="text/css">
                    .orBt{
                        /*        margin-right:11px;*/
                        margin-top:5px;
                        cursor:pointer;
                        padding:3px 9px;
                        color:white;
                        background: rgb(239,127,29);
                        border:0px none;
                        font-weight: bold;
                        border-radius:2px;
                        width:131px;
                    }
                    <?php $this->load_global_media(); ?>

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

                </style>
                <?php _include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_js_terms.php"); ?>
                <?php if (isset($_SESSION['adlino_user_type']) && $_SESSION['adlino_user_type'] == 4) { ?>
                    <style>
                        .vio-title-bg {
                            background:none #D8D9E9;
                            height:30px;
                            width:618px;
                        }
                        .vio-title-lt {
                            background:none #D8D9E9;
                            height:41px;
                            width:6px;
                        }
                        .vio-title-rt {
                            background:none #D8D9E9;
                            height:41px;
                            width:4px;
                        }
                        .shop-lt-curve {
                            background:none #4A4A4A;
                            height:37px;
                            width:6px;
                        }
                        .shop-bg {
                            background:none #4A4A4A;
                            height:40px;
                            padding:7px 0 0;
                            width:171px;
                        }
                        .shop-rt-curve {
                            background:none #4A4A4A;
                            height:37px;
                            width:6px;
                        }
                        .arrowlistmenu .menuheader {
                            background:none #FFF;
                            color:#41403F;
                            cursor:pointer;
                            font-size:13px;
                            font-weight:bold;
                            height:34px;
                            margin:0;
                            padding:0 0 0 0;
                            width:200px;
                        }
                        .shop-btm-lt {
                            background:none #D1D1D1;
                            height:5px;
                            width:1px;
                        }
                        .shop-btm-bg {
                            background:none #D1D1D1;
                            height:5px;
                            width:173px;
                        }
                        .shop-btm-rt {
                            background:none #D1D1D1;
                            height:5px;
                            width:1px;
                        }
                        .arrowlistmenu  {
                            padding-left:0px;
                            padding-top:0;
                            text-align:left;
                            width:200px;
                        }

                        .shop-link {
                            border-left:none;
                            border-right:none;
                        }

                        .accordbg {
                            background:none #FFFEFF;
                            padding:0 2px;
                        }
                        .p_top_line {
                            background:url("../images/p_top_ln.gif") repeat-x scroll 0 0 transparent;
                        }
                        .inputbutton, .bl_inputbutton {
                            -moz-border-radius-bottomleft:4px;
                            -moz-border-radius-bottomright:4px;
                            -moz-border-radius-topleft:4px;
                            -moz-border-radius-topright:4px;
                            background:#464584 url(http://i.adlino.de/admin_new/images/btn_10.jpg) repeat-x scroll 0 0;
                            border:1px solid #464584;
                            color:#FFFFFF;
                            font-family:Tahoma;
                            font-size:11px;
                            font-weight:bold;
                            margin:0 5px 0 0;
                            padding:5px 10px;
                            text-shadow:0 1px 0 #333266;
                        }
                        .top_grad {
                            background:none;
                            float:left;
                            height:11px;
                            width:992px;
                        }
                        .header-nav {
                            background:none #262D6D;
                            float:left;
                            padding:0 4px;
                            width:992px;
                        }
                        .gridbg, .pvdrs_title_bg {
                            background:none #363D8A;
                            border-bottom:1px solid #4D558E;
                            color:#FFFFFF;
                            font-size:10pt;
                            font-weight:bold;
                            height:31px;
                            padding:0 0 0 5px;
                            text-align:left;

                        }
                        .main-nav {
                            background:none #262D6D;
                            height:47px;
                        }
                        .main-nav li {
                            background:none #262D6D;
                            float:left;
                            height:47px;
                            margin:0;
                        }
                        .main-nav a:hover{text-decoration:none;color:#ffd200;font-size:10pt;font-weight:bold;background:none #13184D;padding:12px 24px 0px 24px; margin:0px 0px 0px 2px;}

                        .main-nav .active a{text-decoration:none;color:#ffd200;font-size:10pt;font-weight:bold;none #13184D;padding:12px 24px 0px 24px;margin:0px 0px 0px 2px;}

                        .bl_snd_bg {
                            background:none #53568C;
                            float:left;
                            height:22px;
                            padding:7px 0 0;
                            text-align:left;
                        }
                        .bl_snd_left {
                            background:none #53568C;
                            float:left;
                            height:29px;
                            width:8px;
                        }
                        .bl_snd_right {
                            background:none #53568C;
                            float:left;
                            height:29px;
                            width:8px;
                        }
                        .bltitle_grad {
                            background:none;
                            float:left;
                            height:14px;
                            width:978px;
                        }
                        .f_top_lt {
                            background:none #212972;
                            float:left;
                            height:52px;
                            width:8px;
                        }
                        .f_top_bg {
                            background:none #212972;
                            float:left;
                            height:52px;
                            width:962px;
                        }
                        .f_top_rt {
                            background:none #212972;
                            float:left;
                            height:52px;
                            width:8px;
                        }
                        .l_lt_topcurve {
                            background:none #F4F5FF;
                            float:left;
                            height:12px;
                            width:12px;
                        }
                        .l_top_line {
                            background:none #F4F5FF;
                            float:left;
                            height:12px;
                        }
                        .l_rt_topcurve {
                            background:none #F4F5FF;
                            float:left;
                            height:12px;
                            width:12px;
                        }
                        .l_lt_btmcurve {
                            background:none #F4F5FF;
                            float:left;
                            height:12px;
                            width:12px;
                        }
                        .l_btm_line {
                            background:none #F4F5FF;
                            float:left;
                            height:12px;
                        }
                        .l_rt_btmcurve {
                            background:none #F4F5FF;
                            float:left;
                            height:12px;
                            width:12px;
                        }
                        .e_mid_bg {
                            background-color:#F4F5FF;
                            border-left:1px solid #F4F5FF;
                            border-right:1px solid #F4F5FF;
                            padding:0 18px;
                            width:721px;
                        }
                        .gallery-page-mid {
                            background:none #F8F8F8;
                            height:28px;
                            padding:2px 0 0;
                        }
                        .gallery-page-lt {
                            background:none #F8F8F8;
                            height:30px;
                            width:9px;
                        }
                        .gallery-page-rt {
                            background:none #F8F8F8;
                            height:30px;
                            width:10px;
                        }
                        .inputbutton_2 {
                            background:none #454EA1;
                            border:medium none;
                            color:#FFFFFF;
                            cursor:pointer;
                            font-size:12px;
                            font-weight:bold;
                            height:21px;
                            padding:2px;
                            text-align:center;
                            width:125px;
                        }
                        .yl_btm_rt {

                            height:6px;
                            width:6px;
                        }
                        .yl_btm_lt {

                            height:6px;
                            width:6px;
                        }

                    </style>
                <?php } ?>
            <?php endif; ?>
        </head>
        <body>
            <center>	
                <div id="main">
                    <!--main area start-->
                    <?php $this->load_header(); ?>

                    <div id="bottom_area">
                        <!--bottom area start-->

                        <div class="bottom">
                            <!--bottom start-->
                            <div class="top_grad"> </div>
                            <div class="bottom_main">
                                <!--bottom main start-->
                                <?php if (isset($_SESSION['autologin'])) { ?>
                                    <div>
                                    <?php } else { ?>
                                        <div class="bl_bg_title">
                                        <?php } ?>			

                                        <!--bottom left area start-->
                                        <?php /* ?><div class="bl_bg_title">
                                          <!--bl snd title start-->
                                          <div class="bl_snd_left"> </div>

                                          <div class="bl_snd_bg" style="width:962px;">
                                          <!--bl snd title start-->
                                          <h1>Super Admin</h1>
                                          <!--bl snd title end-->
                                          </div>
                                          <div class="bl_snd_right"> </div>
                                          <!--bl snd title end-->
                                          </div><?php */ ?>
                                        <?php
                                        if (is_file(_PATH . "templates/" . _WEBSITE_THEME . "/" . _REQUEST_PAGE . ".tpl.php")) {
                                            include(_PATH . "templates/" . _WEBSITE_THEME . "/" . _REQUEST_PAGE . ".tpl.php");
                                        } else {
                                            include(_PATH . "templates/" . _WEBSITE_THEME . "/404.tpl.php");
                                        }
                                        ?>
                                        <!--bottom left area end-->
                                    </div>
                                    <!--bottom main end-->
                                </div>
                                <!--bottom end-->
                            </div>

                            <!--bottom area end-->
                        </div>

                        <!-- Middle part End -->
                        <?php print $this->load_footer(); ?>
                        <!--main area end-->
                    </div>
                    <div id="msg_c" >Data Saved</div>
            </center>
            <style type="text/css">
                .grid_bdr tr:nth-child(even) td:not(.gridbg,.pvdrs_title_bg){ 
                    border-bottom:1px solid #BCC1E9;
                }
                .grid_bdr tr:nth-child(odd) td:not(.gridbg,.pvdrs_title_bg){
                    background: none repeat scroll 0 0 #F8F8F8
                }
            </style>
        </body>
    </html>
<?php endif; ?>