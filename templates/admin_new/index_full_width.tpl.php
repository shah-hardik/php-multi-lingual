<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php print tpl::$_website_title ?></title>
        <script type='text/javascript' src='<?php print _MEDIA_URL ?>js/jquery-ui-1.8.15.custom/js/jquery-1.6.2.min.js'></script>
        <link href="<?php print _MEDIA_URL ?>css/stylesheet.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/glowtabs.css" />
        <style type="text/css">
            .headerrt{width:80%;}
            .wel_user {width:73%}
            #header1 {margin: 0;width: 100%;}
            .header_top{width:100%;padding-right:0px;}
            .headermid {width:98%;}
            .header_bottom{width:100%;}
            .header-nav{width:99%;}
            .footer_top,.footer_btm{width:98%;background-image: none;}
            #footer{background-color: white;width:99%;margin-left:7px;}
            .f_title{width:100%;}
            .f_top_bg{width:98%;}
            .footer_btm_link{width:98%;}
            body{margin:0px;padding:0px;}
            .grt {background-color: #FFFFEC;border: 1px solid #006633;border-radius: 5px 5px 5px 5px;color: green;
                  float: left;font-weight: bolder;padding: 10px;text-align: center;width: 96%;}
            .er {background-color: #FFFFEC;border: 1px solid #B50000;border-radius: 5px 5px 5px 5px;color: #B50000;
                 float: left;font-weight: bold;padding: 10px;text-align: left;}
            #msg_c{display:none;position:fixed;left:40%;top:0%;background-color:#ffff99;border:1px solid #ffff99; /* #ffff99 */
                   border-radius:0px 0px 15px 15px;color: #D3601B; /*  */padding: 10px 30px;font-weight: bold;text-align: center;}
        </style>
    </head>

    <body>
        <table width="100%">
            <tr>
                <td align="center" >
                    <div style="width:100%">
                        <?php $this->load_header(); ?>
                        <div style="width: 99%;background-color: white;clear:both">
                            <?php
                            if (is_file(_PATH . "templates/" . _WEBSITE_THEME . "/" . _REQUEST_PAGE . ".tpl.php")) {
                                include(_PATH . "templates/" . _WEBSITE_THEME . "/" . _REQUEST_PAGE . ".tpl.php");
                            } else {
                                include(_PATH . "templates/" . _WEBSITE_THEME . "/404.tpl.php");
                            }
                            ?>
                        </div>
                        <?php print $this->load_footer(); ?>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>