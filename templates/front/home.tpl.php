
<div id="bottom_area">
    <!--bottom area start-->

    <div class="bottom">
        <!--bottom start-->
        <div class="top_grad">
        </div>
        <div class="bottom_main">
            <!--bottom main start-->
            <?php include _PATH . 'templates/front/header_company_search.tpl.php'; ?>


            <div class="banner" style="height: 299px;">
                <!--banner area start-->

                <?php /* ?><div class="banner_left">
                  <!--banner left area start-->
                  <div class="banner_thumb">
                  <!--banner thumb start-->
                  <?php if(count($random_comapny_vocuhers) > 0):
                  foreach($random_comapny_vocuhers as $key=>$company_vocuher):
                  if($key == 0)
                  $css_class = "thumbbg_h";
                  else
                  $css_class = "thumbbg";
                  ?>
                  <div id="small_image" class="<?php print $css_class;?>">
                  <!--thumbbg area start-->
                  <div class="thumb1">
                  <!--thumb 1 start-->
                  <img style="cursor: pointer;" onclick="javascript:CompanyVoucherSlideshow('<?php print $company_vocuher['cv_c_id'];?>','<?php print $company_vocuher['cvi_image'];?>')" src="<?php print _MEDIA_BASE_URL?>upload/company_vouchers/<?php print $company_vocuher['cv_c_id']?>/<?php print "62x43_".$company_vocuher['cvi_image'];?>" border="0" /></a>

                  <!--thumb 1 end-->
                  </div>
                  <div class="thumb_txh">
                  <!--thumb tx start-->
                  <?php print $company_vocuher['cv_name'];?>
                  <!--thumb tx end-->
                  </div>
                  <!--thumbbg area end-->
                  </div>
                  <?php  endforeach;endif;?>

                  <!--banner thumb end-->
                  </div>
                  <div class="banner_add">
                  <!--banner add start-->
                  <img id="banner_add_image" src="<?php print _MEDIA_BASE_URL?>upload/company_vouchers/<?php print $random_comapny_vocuhers[0]['cv_c_id']?>/<?php print "400x280_".$random_comapny_vocuhers[0]['cvi_image'];?>" width="400" height="280" />
                  <!--banner add end-->
                  </div>
                  <!--banner left area end-->
                  </div><?php */ ?>

                <div class="banner_left">
                    <!--banner left area start-->
                    <div class="banner_thumb">
                        <!--banner thumb start-->
                        <?php
                        if (count($random_comapny_vocuhers) > 0): $vi = 0;
                            foreach ($random_comapny_vocuhers as $key => $company_vocuher):
                                if ($key == 0)
                                    $css_class = "thumbbg_h";
                                else
                                    $css_class = "thumbbg";
                                $_voucher_slideshow[] = $company_vocuher['cv_c_id'];
                                $_voucher_seo_url[] = "'" . _companySeoLink(array('company_id' => $company_vocuher['cv_c_id']), false) . "'";
                                ?>
                                <div id="small_image" class="small_left_voucher <?php print $css_class; ?> ieVoucherThumbHeight">
                                    <!--thumbbg area start-->
                                    <div class="thumb1">
                                        <!--thumb 1 start-->
                                        <img style="cursor: pointer;" id="cv__<?php print $company_vocuher['cv_c_id']; ?>" width="62" height="43" onclick="javascript:CompanyVoucherSlideshow(this.id,true,<?php print $vi ?>)" src="<?php print _MEDIA_BASE_URL ?>upload/company_vouchers/<?php print $company_vocuher['cv_c_id']; ?>/62x43_<?php print $company_vocuher['cvi_image']; ?>" border="0" />

                                        <!--thumb 1 end-->
                                    </div>
                                    <div class="thumb_txh">
                                        <!--thumb tx start-->
                                        <?php print $company_vocuher['cv_name']; ?><br/>
                                        <?php print $company_vocuher['cv_name_1']; ?>
                                        <!--thumb tx end-->
                                    </div>
                                    <!--thumbbg area end-->
                                </div>
                                <?php
                                $vi++;
                            endforeach;
                        endif;
                        ?>

                        <!--banner thumb end-->
                    </div>
                    <div class="banner_add">
                        <!--banner add start-->
                        <a href="<?php print _U ?>company_information/<?php print _companySeoLink(array('company_id' => $random_comapny_vocuhers[0]['cv_c_id']), false) ?>?task=voucher"> <img style="border:0px none" id="banner_add_image" src="<?php print _MEDIA_BASE_URL ?>upload/company_vouchers/<?php print $random_comapny_vocuhers[0]['cv_c_id']; ?>/400x280_<?php print $random_comapny_vocuhers[0]['cvi_image']; ?>" width="400" height="280" /></a>
                        <!--banner add end-->
                    </div>
                    <!--banner left area end-->
                </div>        

                <div class="bl_rt_grad_1">
                </div>

                <?php include 'home_your_location.tpl.php'; ?>
            </div>

            <?php include 'adlinoMostCities.tpl.php'; ?>
            <?php include 'adlinoCatalogBanner.tpl.php'; ?>

            <?php /* cutted from here */ ?>

            <div class="bottom_left">
                <?php include 'home_latest_media.tpl.php'; ?>
            </div>
            <div class="bottom_right" style="float:right;width:300px">
                <?php include 'home_latest_comps.tpl.php'; ?>
            </div>

            <?php include 'adlinoCityPicsSlider.tpl.php'; ?>


            <?php /* cutted from here */ ?>


            <div class="bottom_left">

                <!--[if lte IE 6]>
                <style type="text/css">
                .ieAdHeight{
                    height:267px !important;
                }
                .ieAdHeight2{
                    height:267px !important;
                }
                .ieAdHeight3{
                    height:267px !important;
                }
                .ieCatHeight{
                    height:256px !important;
                }
                .ieVoucherThumbHeight{
                    height:58px !important;
                }
                
                .bl_snd_bg{
                    height:29px !important;
                }
                #footer,.footer_top{
                    width:1000px !important;
                }
                .footer_btm_link{
                    width:978px;
                }
                .ieCPLI {
                    background-image: url("<?php print _MEDIA_URL ?>images/country_images_slider_single_box.jpg");
                    border: 0 none !important;
                    height: 98px !important;
                    margin: 0 10px;
                    padding-top: 6px;
                    text-align: center;
                    width: 131px !important;
                }
                .f_top_rt{
                    width:4px;
                }
                </style>
                <![endif]-->

                <style type="text/css">
                    .newsleft {

                        padding:0 0 0 0;
                        margin:0px;
                        display:inline;


                    }
                    .newsright  {

                        margin:0px;
                        padding:0 0 0 0;
                        display:inline;
                    }
                    .added_padding_right{
                        padding-right: 4px;
                        width:215px;
                        <!--[if IE 6]>
                        padding-right: 0px;
                        width:215px;
                        margin:0px;
                        padding-right: 8px;
                        <![endif]-->
                    }
                    .added_padding_left{
                        padding-left: 4px;
                        width:215px;
                        <!--[if IE 6]>
                        padding-left: 0px;
                        width:215px;
                        margin:0px;
                        padding-left: 8px;
                        <![endif]-->
                    }
                    .adlino_width{
                        width:215px;
                        <!--[if IE 6]>
                        padding-left: 0px;
                        width:215px;
                        margin:0px;
                        <![endif]-->
                    }
                    .bx_inner {
                        padding:0 0 0 4px;
                        <!--[if IE 6]>
                        padding:0 0 0 4px;
                        <![endif]-->
                    }
                    .adlino_head{
                        width:199px;
                    }
                    .link_area {
                        width:952wpx;
                        <!--[if IE 6]>
                        width:961px;
                        <![endif]-->
                    }
                    .adlino_padding_top{
                        padding-top:13px;
                    }
                    .adlino_height{
                        height:255px;
                    }


                </style>
                <!--bottom left area start-->





                <div class="news_con" style="width: 675px;">
                    <!--top news con start-->
                    <div class="newsleft added_padding_right" >
                        <!--news left start-->
                        <div class="inn_box adlino_width">
                            <!--left title start-->
                            <div class="bl_snd_left">
                            </div>
                            <div class="bl_snd_bg adlino_head" >
                                <!--video title start-->
                                <h1><a href="#"><?php print tpl::$_vars['lang_ref'][198]; ?></a></h1>
                                <!--video title end-->
                            </div>
                            <div class="bl_snd_right">
                            </div>
                            <!--left title end-->
                        </div>
                        <div class="title_btm_grad" style="background: none; height: 9px;">
                        </div>

                        <div class="bx_inner adlino_width" >
                            <!--video con start-->
                            <div class="box_mid adlino_width" >
                                <!--box mid start-->
                                <div class="box_con adlino_head" >
                                    <!--video start-->
                                    <?php
                                    if (count($star_search_data) > 0) {
                                        $i = 0;
                                        foreach ($star_search_data as $star_search) {
                                            $style = '';
                                            if ($i % 2 == 0) {
                                                $css_class = "video_lt";
                                                $style = "style='padding-right:0px;'";
                                            } else {
                                                $css_class = "video_rt";
                                            }
                                            $search_text = str_replace(" ", "+", $star_search['ss_name']);
                                            ?>

                                            <div class="<?php print $css_class; ?>" <?php print $style; ?>>
                                                <!--video lt start-->
                                                <div class="video_img" style="background: none; padding-bottom: 5px;">
                                                    <!--video img start-->
                                                    <a href="<?php print _U ?>picture_landing?title_description=<?php print $search_text; ?>"><img src="<?php print _MEDIA_BASE_URL; ?>upload/star_search_images/<?php print $star_search['ss_image']; ?>" class="img_border_class" border="0" alt="" /></a><br />
                                                    <!--video img end-->
                                                </div>
                                                <div class="v_con_link" style="text-align: center; width: 99px;">
                                                    <!--video con link start-->
                                                    <a href="<?php print _U ?>picture_landing?title_description=<?php print $search_text; ?>"><?php print $star_search['ss_name']; ?></a>
                                                    <!--video con link end-->
                                                </div>
                                                <!--video lt end-->
                                            </div>

                                            <!--video end-->
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </div>


                                <!--box mid end-->
                            </div>
                            <!--video con end-->
                        </div>
                        <!--news left end-->
                    </div>
                    <div class="news_mid adlino_width" >
                        <!--news mid start-->
                        <div class="inn_box adlino_width" >
                            <!--left title start-->
                            <div class="bl_snd_left">
                            </div>
                            <div class="bl_snd_bg adlino_head" >
                                <!--video title start-->
                                <h1><a href="#"><?php print tpl::$_vars['lang_ref'][1415]; ?></a></h1>
                                <!--video title end-->
                            </div>
                            <div class="bl_snd_right">
                            </div>
                            <!--left title end-->
                        </div>
                        <div class="title_btm_grad" style="background: none; height: 9px;">
                        </div>
                        <div class="bx_inner">
                            <!--video con start-->
                            <div class="box_mid">
                                <!--box mid start-->
                                <div class="box_con1">
                                    <!--video start-->
                                    <?php
                                    if (count($tuning_car) > 0):
                                        $tc_search_q = str_replace(" ", "+", $tuning_car[0]['tc_name']);
                                        ?>
                                        <div class="l_img_grad" style="background: none;">
                                            <!--l img grad start-->
                                            <a href="<?php print _U ?>wallpaper_landing?title_description=<?php print $tc_search_q; ?>"><img src="<?php print _MEDIA_BASE_URL; ?>upload/tuning_car_images/<?php print $tuning_car[0]['tc_image']; ?>" border="0" /></a><br />
                                            <!--l img grad end-->
                                        </div>
                                    <?php endif; ?>
                                    <!--video end-->
                                </div>
                                <div class="inn_link_new">
                                    <!--inner link start-->
                                    <ul>
                                        <?php
                                        if (count($tuning_car_links) > 0):
                                            foreach ($tuning_car_links as $tuning_car_link):
                                                $tuning_link_search_q = str_replace(" ", "+", $tuning_car_link['tc_name']);
                                                ?>
                                                <li><a href="<?php print _U ?>wallpaper_landing?title_description=<?php print $tuning_link_search_q; ?>"><?php print $tuning_car_link['tc_name']; ?></a></li>
                                            <?php endforeach;
                                        endif; ?>
                                    </ul>
                                    <!--inner link end-->
                                </div>
                                <!--box mid end-->
                            </div>

                            <!--video con end-->
                        </div>
                        <!--news mid end-->
                    </div>
                    <div class="newsright added_padding_left">
                        <!--news right start-->
                        <div class="inn_box adlino_width" >
                            <!--left title start-->
                            <div class="bl_snd_left">
                            </div>
                            <div class="bl_snd_bg adlino_head">
                                <!--video title start-->
                                <h1><a href="#"><?php print tpl::$_vars['lang_ref'][1036]; ?></a></h1>
                                <!--video title end-->
                            </div>
                            <div class="bl_snd_right">
                            </div>
                            <!--left title end-->
                        </div>
                        <div class="title_btm_grad" style="background: none; height: 9px;">
                        </div>
                        <div class="bx_inner">
                            <!--video con start-->
                            <div class="box_mid">
                                <!--box mid start-->
                                <div class="box_con1">
                                    <!--video start-->
                                    <?php
                                    if (count($movie_wallpaper) > 0):
                                        $mv_search_q = str_replace(" ", "+", $movie_wallpaper[0]['mv_name']);
                                        ?>
                                        <div class="l_img_grad" style="background: none;">
                                            <!--l img grad start-->
                                            <a href="<?php print _U ?>wallpaper_landing?title_description=<?php print $mv_search_q; ?>"><img src="<?php print _MEDIA_BASE_URL; ?>upload/movie_wallpapers/<?php print $movie_wallpaper[0]['mv_image']; ?>" border="0" /></a><br />
                                            <!--l img grad end-->
                                        </div>
                                    <?php endif; ?>
                                    <!--video end-->
                                </div>
                                <div class="inn_link_new">
                                    <!--inner link start-->
                                    <ul>
                                        <?php
                                        if (count($movie_wallpaper_links) > 0):
                                            foreach ($movie_wallpaper_links as $movie_wallpaper_link):
                                                $movie_wallpaper_search_q = str_replace(" ", "+", $movie_wallpaper_link['mv_name']);
                                                ?>
                                                <li><a href="<?php print _U ?>wallpaper_landing?title_description=<?php print $movie_wallpaper_search_q; ?>"><?php print $movie_wallpaper_link['mv_name']; ?></a></li>
                                            <?php endforeach;
                                        endif; ?>
                                    </ul>
                                    <!--inner link end-->
                                </div>
                                <!--box mid end-->
                            </div>
                            <!--video con end-->
                        </div>
                        <!--news right end-->
                    </div>
                    <!--top news con end-->
                </div>
                <div class="news_con toppad" style="width: 675px;height:295px">
                    <!--top news con start-->
                    <div class="newsleft added_padding_right" >
                        <!--news left start-->
                        <div class="inn_box adlino_width" >
                            <!--left title start-->
                            <div class="bl_snd_left">
                            </div>
                            <div class="bl_snd_bg adlino_head">
                                <!--video title start-->
                                <h1><a href="#"><?php print tpl::$_vars['lang_ref'][1038]; ?></a></h1>
                                <!--video title end-->
                            </div>
                            <div class="bl_snd_right">
                            </div>
                            <!--left title end-->
                        </div>
                        <div class="title_btm_grad" style="background: none; height: 9px;">
                        </div>
                        <div class="bx_inner">
                            <!--video con start-->
                            <div class="box_mid">
                                <!--box mid start-->
                                <div class="box_con1">
                                    <!--video start-->
                                    <?php if (count($video_film_trailer) > 0): ?>
                                        <div class="l_img_grad" style="background: none;">
                                            <!--l img grad start-->
                                            <a href="<?php print _U ?>view_user_video?video_id=<?php print $video_film_trailer[0]['vs_video_id']; ?>"><img src="<?php print _MEDIA_BASE_URL; ?>upload/video_search/<?php print $video_film_trailer[0]['vs_image']; ?>" border="0" /></a><br />
                                            <!--l img grad end-->
                                        </div>
                                    <?php endif; ?>
                                    <!--video end-->
                                </div>
                                <div class="inn_link_new">
                                    <!--inner link start-->
                                    <ul>
                                        <?php
                                        if (count($video_search_film_trailer_links) > 0):
                                            foreach ($video_search_film_trailer_links as $video_search_film_trailer_link):
                                                ?>
                                                <li><a href="<?php print _U ?>view_user_video?video_id=<?php print $video_search_film_trailer_link['vs_video_id']; ?>"><?php print $video_search_film_trailer_link['vs_name']; ?></a></li>
                                            <?php endforeach;
                                        endif; ?>
                                    </ul>
                                    <!--inner link end-->
                                </div>
                                <!--box mid end-->
                            </div>
                            <!--video con end-->
                        </div>
                        <!--news left end-->
                    </div>
                    <div class="news_mid adlino_width">
                        <!--news mid start-->
                        <div class="inn_box adlino_width" >
                            <!--left title start-->
                            <div class="bl_snd_left">
                            </div>
                            <div class="bl_snd_bg adlino_head" >
                                <!--video title start-->
                                <h1><a href="#"><?php print tpl::$_vars['lang_ref'][1040]; ?></a></h1>
                                <!--video title end-->
                            </div>
                            <div class="bl_snd_right">
                            </div>
                            <!--left title end-->
                        </div>
                        <div class="title_btm_grad" style="background: none; height: 9px;">
                        </div>
                        <div class="bx_inner">
                            <!--video con start-->
                            <div class="box_mid">
                                <!--box mid start-->
                                <div class="box_con1">
                                    <!--video start-->
                                    <?php if (count($video_music_video) > 0): ?>
                                        <div class="l_img_grad" style="background: none;">
                                            <!--l img grad start-->
                                            <a href="<?php print _U ?>view_user_video?video_id=<?php print $video_music_video[0]['vs_video_id']; ?>"><img src="<?php print _MEDIA_BASE_URL; ?>upload/video_search/<?php print $video_music_video[0]['vs_image']; ?>" border="0" /></a><br />
                                            <!--l img grad end-->
                                        </div>
                                    <?php endif; ?>
                                    <!--video end-->
                                </div>
                                <div class="inn_link_new">
                                    <!--inner link start-->
                                    <ul>
                                        <?php
                                        if (count($video_search_music_video_links) > 0):
                                            foreach ($video_search_music_video_links as $video_search_music_video_link):
                                                ?>
                                                <li><a href="<?php print _U ?>view_user_video?video_id=<?php print $video_search_music_video_link['vs_video_id']; ?>"><?php print $video_search_music_video_link['vs_name']; ?></a></li>
                                            <?php endforeach;
                                        endif; ?>
                                    </ul>
                                    <!--inner link end-->
                                </div>
                                <!--box mid end-->
                            </div>

                            <!--video con end-->
                        </div>
                        <!--news mid end-->
                    </div>
                    <div class="newsright added_padding_left" >
                        <!--news right start-->
                        <div class="inn_box adlino_width" >
                            <!--left title start-->
                            <div class="bl_snd_left">
                            </div>
                            <div class="bl_snd_bg adlino_head" >
                                <!--video title start-->
                                <h1><a href="#"><?php print tpl::$_vars['lang_ref'][1042]; ?></a></h1>
                                <!--video title end-->
                            </div>
                            <div class="bl_snd_right">
                            </div>
                            <!--left title end-->
                        </div>
                        <div class="title_btm_grad" style="background: none; height: 9px;">
                        </div>
                        <div class="bx_inner">
                            <!--video con start-->
                            <div class="box_mid">
                                <!--box mid start-->
                                <div class="box_con1">
                                    <!--video start-->
                                    <?php if (count($video_game_trailer) > 0): ?>
                                        <div class="l_img_grad" style="background: none;">
                                            <!--l img grad start-->
                                            <a href="<?php print _U ?>view_user_video?video_id=<?php print $video_game_trailer[0]['vs_video_id']; ?>"><img src="<?php print _MEDIA_BASE_URL; ?>upload/video_search/<?php print $video_game_trailer[0]['vs_image']; ?>" border="0" /></a><br />
                                            <!--l img grad end-->
                                        </div>
                                    <?php endif; ?>
                                    <!--video end-->
                                </div>
                                <div class="inn_link_new">
                                    <!--inner link start-->
                                    <ul>
                                        <?php
                                        if (count($video_search_game_trailer_links) > 0):
                                            foreach ($video_search_game_trailer_links as $video_search_game_trailer_link):
                                                ?>
                                                <li><a href="<?php print _U ?>view_user_video?video_id=<?php print $video_search_game_trailer_link['vs_video_id']; ?>"><?php print $video_search_game_trailer_link['vs_name']; ?></a></li>
                                            <?php endforeach;
                                        endif; ?>
                                    </ul>
                                    <!--inner link end-->
                                </div>
                                <!--box mid end-->
                            </div>

                            <!--video con end-->
                        </div>
                        <!--news right end-->
                    </div>
                    <!--top news con end-->
                </div>

                <div class="news_con">
                    <!--news con start-->
                    <div class="bl_snd_title">
                        <!--left title start-->
                        <!--<div class="bl_snd_left">
                    </div>-->
                        <div class="bl_snd_bg" style="width:651px; padding-left:8px">
                            <!--video title start-->
                            <h1><a href="#"><?php print tpl::$_vars['lang_ref'][1043]; ?> - <?php print tpl::$_vars['lang_ref'][1044]; ?></a></h1>
                            <!--video title end-->
                        </div>
                        <!-- <div class="bl_snd_right">
                         </div>-->
                        <!--left title end-->
                    </div>
                    <div class="bl_snd_grad" style="background: none; height: 9px;">
                    </div>
                    <!--news con end-->
                </div>

                <div class="news_con" style="height:255px">
                    <!--news con start-->
                    <?php
                    $first_section_search_q = str_replace(" ", "+", $first_section_data[0]['link_url']);
                    ?>
                    <div style="width:210px;height:202px;float:left">
                        <div class="a_web_img">
                            <!--a web img start-->
                            <a href="<?php print _U . "picture_landing?title_description=" . $first_section_search_q; ?>"><img border="0" src="<?php print _MEDIA_BASE_URL ?>upload/top_term_images/<?php print $first_section_data[0]['link_image'] ?>" alt="" /></a><br />
                            <!--a web img end-->
                        </div>
                        <h2><a href="<?php print _U . "picture_landing?title_description=" . $first_section_search_q; ?>"><?php print $first_section_data[0]['link_name'] ?></a></h2>
                        <div class="n_img_con"><a href="<?php print _U . "picture_landing?title_description=" . $first_section_search_q; ?>" style="font-weight:normal;">
                                <?php //print wordwrap(truncate_content_title($first_section_data[2]['link_desc'],50),"15","<br/>",true); ?>
                                <?php print $first_section_data[0]['link_desc']; ?>
                            </a></div>                            

                    </div>
                    <div class="web_right" style="width:400px">
                        <div class="lt_btm_con" style="width: 120px;">
                            <!--lt btm con start-->
                            <h2><?php print tpl::$_vars['lang_ref'][1999]; ?></h2>
                            <div class="search_link">
                                <?php if (count($image_search_data) > 0) { ?>
                                    <!--search link start-->
                                    <ul>
                                        <?php
                                        foreach ($image_search_data as $image_search):
                                            $search_q = str_replace(" ", "+", $image_search['link_url']);
                                            ?>
                                            <li><a href="<?php print _U . "picture_landing?title_description=" . $search_q; ?>"><?php print $image_search['link_name']; ?></a></li>
                                        <?php endforeach;
                                    } ?>
                                </ul>
                                <!--search link end-->
                            </div>
                            <!--lt btm con end-->
                        </div>
                        <div class="lt_btm_con" style="width: 120px;">
                            <!--lt btm con start-->
                            <h2><?php print tpl::$_vars['lang_ref'][2117]; ?></h2>
                            <div class="search_link">
                                <?php if (count($video_search_data) > 0) { ?>
                                    <!--search link start-->
                                    <ul>
                                        <?php
                                        foreach ($video_search_data as $video_search):
                                            $search_q = str_replace(" ", "+", $video_search['link_url']);
                                            ?>
                                            <li><a href="<?php print _U . "video_landing?title_description=" . $search_q; ?>"><?php print $video_search['link_name']; ?></a></li>
                                        <?php endforeach;
                                    } ?>
                                </ul>
                                <!--search link end-->
                            </div>
                            <!--lt btm con end-->
                        </div>
                        <div class="rt_btm_con" style="width: 119px;">
                            <!--lt btm con start-->
                            <h2><?php print tpl::$_vars['lang_ref'][2116]; ?></h2>
                            <div class="search_link">
                                <?php if (count($popular_topic_data) > 0) { ?>
                                    <!--search link start-->
                                    <ul>
                                        <?php
                                        foreach ($popular_topic_data as $popular_topic):
                                            $search_q = str_replace(" ", "+", $popular_topic['link_url']);
                                            ?>
                                            <li><a href="<?php print _U . "wallpaper_landing?title_description=" . $search_q; ?>"><?php print $popular_topic['link_name']; ?></a></li>
                                        <?php endforeach;
                                    } ?>
                                </ul>
                                <!--search link end-->
                            </div>
                            <!--lt btm con end-->
                        </div>
                        <!--web right area end-->
                    </div>
                    <!--news con end-->
                </div>
                <div class="news_con">
                    <!--news con start-->
                    <div class="bl_snd_title">
                        <!--left title start-->

                        <div class="bl_snd_bg"  style="width:651px; padding-left:8px">
                            <!--video title start-->
                            <h1><a href="#"><?php print tpl::$_vars['lang_ref'][1045]; ?></a></h1>
                            <!--video title end-->
                        </div>

                        <!--left title end-->
                    </div>
                    <div class="bl_snd_grad">
                    </div>
                    <!--news con end-->
                </div>
                <div class="news_con">
                    <!--news con start-->
                    <div class="a_web_img">
                        <!--a web img start-->
                        <img src="<?php print _MEDIA_URL; ?>images/pidini_img.gif" alt="" /><br />
                        <!--a web img end-->
                    </div>
                    <div class="pidini_right">
                        <!--web right area start-->
                        <h2><a href="#"><?php print tpl::$_vars['lang_ref'][2967]; ?></a></h2>
                        <div class="n_img_con" style="width:480px;">
                            <!--pidini con start-->
                            <?php print tpl::$_vars['lang_ref'][2968]; ?>
                            <!--pidini con end-->
                        </div>
                        <div class="n_img_con" style="width:490px;">
                            <!--pidini search start-->
                            <div class="inn_link_p toppad">
                                <!--pidini link start-->
                                <ul>
                                    <li><a href="<?php print _U ?>company?filter=voucher"><?php print tpl::$_vars['lang_ref'][2969]; ?></a></li>
                                    <li><a href="<?php print _U ?>shopping_landing"><?php print tpl::$_vars['lang_ref'][2970]; ?></a></li>
                                </ul>
                                <!--pidini link end-->
                            </div>
                            <div class="search_title toppad">
                                <!--search title start-->
                                <?php print tpl::$_vars['lang_ref'][2971]; ?><br />
                                <div class="float_left"><input type="text" class="input1" size="28" id="shop_search" /></div><div class="search_pad"><input onclick="window.location='<?php print _U ?>my_shop_landing?title_description='+$('#shop_search').val()" name="input" type="button" class="search_button" value="<?php print tpl::$_vars['lang_ref'][183]; ?>" /></div>
                                <!--search title end-->
                            </div>
                            <!--pidini search end-->
                        </div>
                        <!--web right area end-->
                    </div>
                    <!--news con end-->
                </div>
                <div class="news_con toppad">
                    <!--news con start-->
                    <div class="bl_snd_title">
                        <!--left title start-->

                        <div class="bl_snd_bg"  style="width:651px; padding-left:8px">
                            <!--video title start-->
                            <h1><?php print tpl::$_vars['lang_ref'][1416]; ?></h1>
                            <!--video title end-->
                        </div>

                        <!--left title end-->
                    </div>
                    <div class="bl_snd_grad">
                    </div>
                    <!--news con end-->
                </div>

                <div class="news_con">
                    <!--news con start-->
                    <div class="float_left">
                        <div class="view_area">
                            <!--view area start-->
                            <div class="view_img">
                                <!--img area start-->
                                <img style="border:1px solid #E2E2E2" src="<?php print _MEDIA_UPLOAD_URL; ?>/upload/footer_selling_tips/<?php print $footer_tips_data[0]['ft_image'] ?>" /><br />
                                <!--img area end-->
                            </div>
                            <div class="view_con">
                                <!--view con start-->
                                <h2><a href="<?php print $footer_tips_data[0]['ft_link'] ?>" target="blank"><?php print $footer_tips_data[0]['ft_title'] ?></a></h2>
                                <!--view con end-->
                            </div>
                            <div class="v_img_con" style="width:240px;"><?php print $footer_tips_data[0]['ft_desc'] ?></div>
                            <!--view area end-->
                        </div>
                        <div class="view_area">
                            <!--view area start-->
                            <div class="view_img">
                                <!--img area start-->
                                <img style="border:1px solid #E2E2E2" src="<?php print _MEDIA_UPLOAD_URL; ?>/upload/footer_selling_tips/<?php print $footer_tips_data[1]['ft_image'] ?>" /><br />
                                <!--img area end-->
                            </div>
                            <div class="view_con">
                                <!--view con start-->
                                <h2><a href="<?php print $footer_tips_data[1]['ft_link'] ?>" target="blank"><?php print $footer_tips_data[1]['ft_title'] ?></a><br />
                                </h2>
                                <!--view con end-->
                            </div>
                            <div class="v_img_con" style="width:240px;"><?php print $footer_tips_data[1]['ft_desc'] ?></div>
                            <!--view area end-->
                        </div>
                    </div>
                    <div class="view1 padtop">
                        <div class="view_area">
                            <!--view area start-->
                            <div class="view_img">
                                <!--img area start-->
                                <img style="border:1px solid #E2E2E2" src="<?php print _MEDIA_UPLOAD_URL; ?>/upload/footer_selling_tips/<?php print $footer_tips_data[2]['ft_image'] ?>" /><br />
                                <!--img area end-->
                            </div>
                            <div class="view_con">
                                <!--view con start-->
                                <h2><a href="<?php print $footer_tips_data[2]['ft_link'] ?>" target="blank"><?php print $footer_tips_data[2]['ft_title'] ?></a></h2>
                                <!--view con end-->
                            </div>
                            <div class="v_img_con" style="width:240px;"><?php print $footer_tips_data[2]['ft_desc'] ?></div>
                            <!--view area end-->
                        </div>
                        <div class="view_area">
                            <!--view area start-->
                            <div class="view_img">
                                <!--img area start-->
                                <img style="border:1px solid #E2E2E2" src="<?php print _MEDIA_UPLOAD_URL; ?>/upload/footer_selling_tips/<?php print $footer_tips_data[3]['ft_image'] ?>" /><br />
                                <!--img area end-->
                            </div>
                            <div class="view_con">
                                <!--view con start-->
                                <h2><a href="<?php print $footer_tips_data[3]['ft_link'] ?>" target="blank"><?php print $footer_tips_data[3]['ft_title'] ?></a></h2>
                                <!--view con end-->
                            </div>
                            <div class="v_img_con" style="width:240px;"><?php print $footer_tips_data[3]['ft_desc'] ?></div>
                            <!--view area end-->
                        </div>
                    </div>
                    <?php /* ?><div class="view1 padtop">
                      <div class="view_area">
                      <!--view area start-->
                      <div class="view_img">
                      <!--img area start-->
                      <img src="<?php print _MEDIA_UPLOAD_URL;?>/upload/footer_selling_tips/<?php print $footer_tips_data[4]['ft_image']?>" /><br />
                      <!--img area end-->
                      </div>
                      <div class="view_con">
                      <!--view con start-->
                      <h2><a href="<?php print $footer_tips_data[4]['ft_link']?>"><?php print $footer_tips_data[4]['ft_title']?></a></h2>
                      <!--view con end-->
                      </div>
                      <div class="v_img_con" style="width:240px;"><a href="<?php print $footer_tips_data[4]['ft_link']?>"><?php print $footer_tips_data[4]['ft_desc']?></a></div>
                      <!--view area end-->
                      </div>
                      <div class="view_area">
                      <!--view area start-->
                      <div class="view_img">
                      <!--img area start-->
                      <img src="<?php print _MEDIA_UPLOAD_URL;?>/upload/footer_selling_tips/<?php print $footer_tips_data[5]['ft_image']?>" /><br />
                      <!--img area end-->
                      </div>
                      <div class="view_con">
                      <!--view con start-->
                      <h2><a href="<?php print $footer_tips_data[5]['ft_link']?>"><?php print $footer_tips_data[5]['ft_title']?></a></h2>
                      <!--view con end-->
                      </div>
                      <div class="v_img_con" style="width:240px;"><a href="<?php print $footer_tips_data[5]['ft_link']?>"><?php print $footer_tips_data[5]['ft_desc']?></a></div>
                      <!--view area end-->
                      </div>
                      </div> */ ?>
                    <!--news con end-->
                </div>

                <!--bottom left area end-->
            </div>
            <div class="bottom_right" style="width:301px;">
                <!--bottom right area start-->

                <div class="right_title" style="width:300px; padding-top: 0px;">
                    <!--right title start-->
                    <div class="bl_snd_left">
                    </div>
                    <div class="bl_snd_bg" style="width:284px;">
                        <!--video title start-->
                        <h1><a href="#"><?php print tpl::$_vars['lang_ref'][806]; ?></a></h1>
                        <!--video title end-->
                    </div>
                    <div class="bl_snd_right">
                    </div>
                    <!--right title end-->
                </div>
                <div class="bl_rt_grad_1">
                </div>
                <div class="add_area adlino_height ieAdHeight" style="width:300px;padding:9px 0px 0px 0px;">
                    <!--right area add start-->
                    <?php print $soap->Display_banner(1); ?>
                </div>
                <div class="right_title adlino_padding_top" style="width:300px;padding-top:18px">
                    <!--right title start-->
                    <div class="bl_snd_left">
                    </div>
                    <div class="bl_snd_bg" style="width:284px;">
                        <!--video title start-->
                        <h1><a href="#"><?php print tpl::$_vars['lang_ref'][806]; ?></a></h1>
                        <!--video title end-->
                    </div>
                    <div class="bl_snd_right">
                    </div>
                    <!--right title end-->
                </div>
                <div class="bl_rt_grad_1">
                </div>
                <div class="add_area adlino_height ieAdHeight2" style="width:300px;padding:9px 0px 0px 0px;">
                    <?php echo $soap->Display_banner(2); ?>
                </div>
                <div class="right_title" style="width:300px; padding-top: 0px;margin-top:-1px">
                    <!--right title start-->
                    <div class="bl_snd_left	">
                    </div>
                    <div class="bl_snd_bg" style="width:284px;">
                        <!--video title start-->
                        <h1><a href="#"><?php print tpl::$_vars['lang_ref'][806]; ?></a></h1>
                        <!--video title end-->
                    </div>
                    <div class="bl_snd_right">
                    </div>
                    <!--right title end-->
                </div>
                <div class="bl_rt_grad_1">
                </div>
                <div class="add_area adlino_height ieAdHeight3" style="width:300px;padding:9px 0px 0px 0px;">
                    <?php echo $soap->Display_banner(3); ?>
                </div>
                <!--right area add end-->
            </div>
            <div class="right_title" style="width:300px; float:right;">
                <!--right title start-->
                <div class="bl_snd_left">
                </div>
                <div class="bl_snd_bg" style="width:284px;">
                    <!--video title start-->
                    <h1><a href="#"><?php print tpl::$_vars['lang_ref'][806]; ?></a></h1>
                    <!--video title end-->
                </div>
                <div class="bl_snd_right">
                </div>
                <!--right title end-->
            </div>
            <div class="bl_rt_grad_1">
            </div>
            <div class="right_area ieAdHeight" style="width:300px; float:right; padding:9px 0px 0px 0px;">
                <!--right area con start-->
                <?php print $soap->Display_banner(1); ?>
                <?php /* ?> <div class="bdr_btm">
                  <!--border btm start-->
                  <div class="rt_imgbdr">
                  <img src="<?php print _MEDIA_URL;?>images/window].jpg" /><br />
                  </div>
                  <div class="d_area l_pad">
                  <!--img right link start-->
                  <h2><a href="#">Windows Live Messenger</a></h2>
                  <div class="d_link"><a href="#">All contacts always in sight </a></div>
                  <!--img right link end-->
                  </div>
                  <!--border btm start-->
                  </div>
                  <div class="bdr_btm">
                  <!--border btm start-->
                  <div class="rt_imgbdr">
                  <img src="<?php print _MEDIA_URL;?>images/w_mail.jpg" /><br />
                  </div>
                  <div class="d_area l_pad">
                  <!--img right link start-->
                  <h2><a href="#">Windows Live Mail</a></h2>
                  <div class="d_link"><a href="#">All e-mails in one place</a></div>
                  <!--img right link end-->
                  </div>
                  <!--border btm start-->
                  </div>
                  <div class="bdr_btm">
                  <!--border btm start-->
                  <div class="rt_imgbdr">
                  <img src="<?php print _MEDIA_URL;?>images/w_pgallary.jpg" /><br />
                  </div>
                  <div class="d_area l_pad">
                  <!--img right link start-->
                  <h2><a href="#">Windows Live Photo Gallery</a></h2>
                  <div class="d_link"><a href="#">Edit and Organize Photos</a></div>
                  <!--img right link end-->
                  </div>
                  <!--border btm start-->
                  </div>
                  <div class="bdr_btm">
                  <!--border btm start-->
                  <div class="rt_imgbdr">
                  <img src="<?php print _MEDIA_URL;?>images/i_explorer.jpg" /><br />
                  </div>
                  <div class="d_area l_pad">
                  <!--img right link start-->
                  <h2><a href="#">Internet Explorer 8</a></h2>
                  <div class="d_link"><a href="#">Internet Explore 8 optimized for MSN</a></div>
                  <!--img right link end-->
                  </div>
                  <!--border btm start-->
                  </div>
                  <div class="bdr_btm">
                  <!--border btm start-->
                  <div class="rt_imgbdr" style="background:none;">
                  <img src="<?php print _MEDIA_URL;?>images/soft.jpg" /><br />
                  </div>
                  <div class="d_area l_pad">
                  <!--img right link start-->
                  <h2><a href="#">Software Downloads</a></h2>
                  <div class="d_link"><a href="#">Free software download and games</a></div>
                  <!--img right link end-->
                  </div>
                  <!--border btm start-->
                  </div><?php */ ?>
                <!--right area con end-->

                <!--bottom right area end-->
            </div>
        </div>

        <!--bottom end-->
    </div>
    <!--bottom area end-->
</div>
<script language="JavaScript" type="text/javascript">
    /*<![CDATA[*/
    var timer;
<?php if (count($_voucher_slideshow)): ?>
        var voucher_slideshow = [<?php print implode(",", $_voucher_slideshow) ?>];
        var voucher_seo_url = [<?php print implode(",", $_voucher_seo_url) ?>];
        $(document).ready(function(){
            timer = setTimeout(rotateCityVoucher,'2000');
        });
                                            
                                            
<?php endif; ?>
    var voucher_slidershow_index = 0;

    function rotateCityVoucher(){
        voucher_slidershow_index++;
        voucher_slidershow_index = voucher_slidershow_index == voucher_slideshow.length ? 0 : voucher_slidershow_index;

        CompanyVoucherSlideshow('cv__'+voucher_slideshow[voucher_slidershow_index],false,voucher_slidershow_index);
        timer = setTimeout(rotateCityVoucher,'5000');
    }

    function CompanyVoucherSlideshow(src,clearFlag,vi){
        //  if(clearFlag) {
        //      clearTimeout()
        //  }
        $("#banner_add_image").attr("src",$("#"+src).attr('src').replace("62x43","400x280"));
        $("#banner_add_image").parent().attr("href","<?php print _U ?>company_information"+voucher_seo_url[vi]+"?task=voucher");
        $(".small_left_voucher").removeClass("thumbbg_h").addClass("thumbbg");
        $("#"+src).parent().parent().addClass("thumbbg_h").removeClass("thumbbg");
  
        //  if(clearFlag) {
        //       timer = setTimeout(rotateCityVoucher,'5000');
        //  }

    }

    /*]]>*/
</script>

<?php if ($_GET['action'] == "logout" and !isset($_SESSION['liframe']) and isset($_COOKIE['website'])) {
    $_SESSION['liframe'] = "iframe"; ?>
    <iframe src ="http://www.<?php print $_COOKIE['website']; ?>/setsession?action=logout" width="0px" height="0px"></iframe>
    <iframe src ="http://<?php print $_COOKIE['website']; ?>/setsession?action=logout" width="0px" height="0px"></iframe>
<?php } ?>