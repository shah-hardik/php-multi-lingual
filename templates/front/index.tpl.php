<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" /> 
        <meta name="description" content="<?php print "Adlino - " . tpl::$_meta_description_content ?>" /> 
        <meta name="keywords" content="<?php print "Adlino - " . tpl::$_meta_keywords_content ?>" />
        <title><?php print "Adlino - " . tpl::$_website_title ?></title>
        <script language="javascript" type="text/javascript">
            var media_url="<?php print _MEDIA_URL ?>";	
        </script>

        <?php if (tpl::$_meta_og_image): ?>
            <meta property="og:image" content="<?php print tpl::$_meta_og_image ?>" />
        <?php endif; ?>
        <?php if (tpl::$_meta_og_title): ?>
            <meta property="og:title" content="<?php print tpl::$_meta_og_title ?>" />
        <?php endif; ?>
        <?php if (tpl::$_meta_og_desc): ?>
            <meta property="og:description" content="<?php print tpl::$_meta_og_desc ?>" />
        <?php endif; ?>

        <?php if (in_array($_REQUEST['q'], array('company_information'))) : ?>
            <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>        
        <?php endif; ?>

        <link href="<?php print _MEDIA_URL ?>css/stylesheet.css" rel="stylesheet" type="text/css" />

        <link href="<?php print _MEDIA_URL ?>css/style_overwrite.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/glowtabs.css" />

<!--<script type='text/javascript' src='<?php print _MEDIA_URL ?>js/jquery.js'></script>-->
<!--        <script type='text/javascript' src='<?php print _MEDIA_URL ?>js/jquery-ui-1.8.15.custom/js/jquery-1.6.2.min.js'></script>-->
        <script type='text/javascript' src='<?php print _MEDIA_URL ?>js/jquery-ui-1.8.15.custom/js/jquery-1.7.1.min.js'></script>
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>js/jquery-ui-1.8.15.custom/css/redmond/jquery-ui-1.8.16.custom.css" />
        <script type='text/javascript' src='<?php print _MEDIA_URL ?>js/jquery-ui-1.8.15.custom/js/jquery-ui-1.8.15.custom.min.js'></script>

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.price_format.1.3.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>js/general.js"></script>
        <?php /*
          <script type='text/javascript' src='<?php print _MEDIA_URL ?>js/jquery.autocomplete.js'></script>
          <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.autocomplete.css" />
         */ ?>

        <link href="<?php print _MEDIA_BASE_URL; ?>css/thickbox.css" rel="stylesheet" type="text/css" media="all" />
        <script>var tb_pathToImage = "<?= _MEDIA_BASE_URL; ?>/images/loadingAnimation.gif";</script>
        <script type="text/javascript" src="<? print _MEDIA_BASE_URL; ?>js/thickbox.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL; ?>js/jscolor/jscolor.js"></script>

        <!--[if lte IE 6]>
        <style type="text/css">
            .bl_snd_bg{
                height:29px !important;
            }
            .iewel_user{
                height:47px !important
            }
            .header_top{
                padding-top:0px;
            }
        </style>
        <![endif]-->
        <style type="text/css">
<?php $this->load_global_media(); ?>
        </style>
        <?php $this->over_ride_default_media(); ?>		
        <?php //_include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_js_terms.php"); ?>
    </head>
    <body>
        <?php if (in_array($_REQUEST['q'], array('private_member_wall'))): ?>  
            <?php include 'index_front_wall.tpl.php'; ?>
        <?php elseif (in_array($_REQUEST['q'], array('view_user_videos'))): ?>  
            <?php include 'index_front_wall_video.tpl.php'; ?>
        <?php else: ?>
            <?php include 'index_front_basic.tpl.php'; ?>
        <?php endif; ?>
        <?php if (isset($_GET['print'])): ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    print();
                    window.close();
                });
            </script>
        <?php endif; ?>

        <?php if (!isset($_SESSION['iframe']) and isset($_SESSION['user_id']) and $_SESSION['user_role'] == "individual") {
            $_SESSION['iframe'] = "iframe"; ?>
            <iframe src ="http://www.<?php print $_SESSION['website']; ?>/setsession?id=<?php print $_SESSION['user_id'] ?>" width="0px" height="0px"></iframe>
            <iframe src ="http://<?php print $_SESSION['website']; ?>/setsession?id=<?php print $_SESSION['user_id'] ?>" width="0px" height="0px"></iframe>
        <?php } ?>
        <?php include 'widgets/widget_bottom_window.php'; ?>
    </body>
</html>
