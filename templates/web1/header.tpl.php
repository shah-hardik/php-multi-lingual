<?php
include_once _PATH . 'lib/class.city_soap_abstract.php';
$city_soap = new city_soap_abstract();
$city_website_name = $city_soap->GetCityWebsiteName(CITY_ID);

$picture_array = array('picture_landing', 'view_user_picture');
$ecard_array = array('ecard_landing', 'view_user_ecard');
$wallpaper_array = array('wallpaper_landing', 'view_user_wallpaper');
$classified_array = array('classifieds', 'event_landing', 'classifieds_information', 'car_classified_landing');
$entertainment_array = array("mobile_prepaid_providers", "tv_programm", "music_news", 'jokes', 'sayings', 'quotes', 'horoscope', 'cinema_movies', 'cooking_recipe', 'news', 'tipps_and_advices', 'video_news', 'online_games');

//$t_code = isset($_GET['c']) ? '858585' : '858585';

__autoload('city_classes/common');
$objcommon = new common();
$bannerarray_raw = $objcommon->headerbanner();
$bannerarray[] = $bannerarray_raw[rand(0, count($bannerarray_raw) - 1)];
//d($bannerarray);
$count = count($bannerarray);
//d($bannerarray);
for ($r = 0; $r < $count; $r++) {
    if ($bannerarray[$r]['cms_media_type'] == 'static') {
        $bannerarray[$r]['cms_media'] = _MEDIA_BASE_URL . "upload/city_sponser_images/" . $bannerarray[$r]['cms_media'];
    }
    $image_url .= "'" . $bannerarray[$r]['cms_media'] . "',";
    $link .= "'" . $bannerarray[$r]['cms_link'] . "',";
}
$image_url = substr($image_url, 0, -1);
$link = substr($link, 0, -1);
//d($image_url);
$left_or_right = mt_rand(0, 1);
$image_src = _PATH . "media/city/images/city_people/";
$image_direction = $left_or_right ? "left/" : "right/";
$image_margin = $left_or_right ? "margin-left:-103px" : "margin-left:999px";
$images_in_dir = array_diff(scandir($image_src . $image_direction), array(".", "..", "Thumbs.db"));

$random_image_index = mt_rand(2, count($images_in_dir));
$image_src = _MEDIA_URL . "images/city_people/{$image_direction}/" . $images_in_dir[$random_image_index];
?>
<script language="javascript">
    
    function doLoadRatingBar(key){
        $(".likeBar").hide();
        $("#wall-load").show();

        $.ajax({
            type:"POST",
            url:"<?php print _LIKE_SERVER ?>doComment.php",
            data:{getBar:1,key:key},
            success:function(remoteContent){
                var responseObj = $.parseJSON(remoteContent);

                // its not an no operation
                if(responseObj.noop == undefined){
                    manipulateBar({likeBar:'cinemaSingleLikeBar',disLikeBar:'cinemaSingleDisLikeBar',likeCount:responseObj[0].likes,disLikeCount:responseObj[0].dislikes});
                }

                $(".likeBar").show();
                $("#cinema-wall-load").hide();

            }
        });
    }
    
    function manipulateBar(obj){
        var total = parseInt(obj.likeCount) + parseInt(obj.disLikeCount);
        likeWidth = ( ( parseInt(obj.likeCount) / total ) * 100 ) * 2.5;
        disLikeWidth = 250 - likeWidth;
        
        

        likeWidth = isNaN(likeWidth) ? 125 : likeWidth;
        disLikeWidth = isNaN(disLikeWidth) ? 125 : disLikeWidth;

        $("#"+obj.likeBar).css("width",likeWidth );
        $("#"+obj.disLikeBar).css("width",disLikeWidth )

        //_singleContentPage.ratingStack['st_'+_singleContentPage._args.key] = {likesCount:obj.likeCount,disLikeCount:obj.disLikeCount}
    }
    function doLikeMovie(_like,id){
        var login_user_id=$("#login_user_id").val();
        if(login_user_id == ''){
            var msg = tpl_js_2829;
            msg = tpl_js_2829.replace('{link_start}','<a href="javascript:;" style="cursor:pointer;text-decoration:underline" onclick="doLogin()">');
            msg = msg.replace('{link_end}','</a>');
            $("#fav_video_action").show();
            $("#fav_video_action").html('<div class="er" style="width:638px;margin-top:10px;">'+msg+'</div>').css("margin-top","10px");
            return;
        }
        $(".likeBar").hide();
        $("#cinema-wall-load").show();

        $.ajax({
            type:"POST",
            url:"<?php print _LIKE_SERVER ?>doComment.php",
            data:{like:_like,key:id,user_id:'<?php print $_SESSION['user_id'] ?>'},
            success:function(remoteContent){
                var responseObj = $.parseJSON(remoteContent);

                // its not an no operation
                if(responseObj.noop == undefined){
                    manipulateBar({likeBar:'cinemaSingleLikeBar',disLikeBar:'cinemaSingleDisLikeBar',likeCount:responseObj[0].likes,disLikeCount:responseObj[0].dislikes});
                }

                $(".likeBar").show();
                $("#cinema-wall-load").hide();
            }
        });
    }
    
    
    function doLogin(){
        $( "#loginPop" ).dialog('open');
    }
    fromCityWall = false;
    $(document).ready(function() {
        // InitialiseBannerAdRotator();
        setTimeout(updateTime,60000);
        $('#js-news').ticker({titleText:''});         
        $( "#loginPop" ).dialog({
            modal: true,
            autoOpen: false,
            title : '<?php print tpl::$_vars['lang_ref'][40] ?>',
            width:400,
            height:250
           
        });
                                                
        $("#btnLoginpp").click(function(){
            if($("#emailpp").val() == ''){
                $("#messagepp").html("<?php print tpl::$_vars['lang_ref'][1472] ?>");
                $("#emailpp").focus();
                return;
            }
            if($("#passwordpp").val() == ''){
                $("#messagepp").html("<?php print tpl::$_vars['lang_ref'][1495] ?>");
                $("#passwordpp").focus();
                return;
            }
                                                
            $("#msg_c").html("<?php print tpl::$_vars['lang_ref'][1259] ?>......").show();
            _ls = false;
            $.ajax({
                type:"POST",
                url:"<?php print _U ?>ajax_handler&doLogin=1",
                data:"uname="+$("#emailpp").val()+"&upass="+$("#passwordpp").val(),
                success:function(responseVal){
                    $("#msg_c").hide();
                    if(responseVal == 1){
                        
                        $("#messagepp").html("<?php print tpl::$_vars['lang_ref'][3779] ?>").show();
                        $( "#loginPop" ).dialog('close');
                        if(fromCityWall == false){
                            location.href=  location.href.replace("?doLogout=1","");
                        }
                        else{
                            
                            $("#messagepp").html("");
                            showBottomWindow("Logged in successfully");
                        }
                    }
                    else {
                        _ls = false;
                        $("#messagepp").html("<?php print tpl::$_vars['lang_ref'][1772] ?>").show();
                    }
                }
            });
        });        
        
  
    });

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
    <!--
    //User defined variables - change these variables to alter the behaviour of the script
    var ImageFolder = ""; //Folder name containing the images


    var ImageFileNames = new Array(<?php print $image_url; ?>); //List of images to use
    var ImageURLs = new Array(<?php print $link; ?>); //List of hyperlinks associated with the list of images

    var DefaultURL = '<?php print $bannerarray[0]['cms_media']; ?>'; //Default hyperlink for the Banner Ad
    var DisplayInterval = 5; //Number of seconds to wait before the next image is displayed
    var TargetFrame = ""; //Name of the frame to open the hyperlink into

    //Internal variables (do not change these unless you know what you are doing)
    var IsValidBrowser = false;

    var BannerAdCode = 0;
    var BannerAdImages = new Array(NumberOfImages);
    var DisplayInterval = DisplayInterval * 1000;
    var NumberOfImages = ImageFileNames.length;

    //A dd a trailing forward slash to the ImageFolder variable if it does not already have one
    if (ImageFolder.substr(ImageFolder.length - 1, ImageFolder.length) != "/" && ImageFolder != "") { 
        ImageFolder += "/";
    }

    if (TargetFrame == '') {
        var FramesObject = null;
    } else {
        var FramesObject = eval('parent.' + TargetFrame);
    }

    //Function runs when this page has been loaded and does the following:
    //1. Determine the browser name and version
    // (since the script will only work on Netscape 3+ and Internet Explorer 4+).
    //2. Start the timer object that will periodically change the image displayed
    // by the Banner Ad.
    //3. Preload the images used by the Banner Ad rotator script
    function InitialiseBannerAdRotator() {
        //Determine the browser name and version
        //The script will only work on Netscape 3+ and Internet Explorer 4+
        var BrowserType = navigator.appName;
        var BrowserVersion = parseInt(navigator.appVersion);
	
        if (BrowserType == "Netscape" && (BrowserVersion >= 3)) {
            IsValidBrowser = true;
        }
        if (BrowserType == "Microsoft Internet Explorer" && (BrowserVersion >= 4)) {
            IsValidBrowser = true;
        }
        if (IsValidBrowser) {
            TimerObject = setTimeout("ChangeImage()", DisplayInterval);
            BannerAdCode = 0;
            for (i = 0; i < NumberOfImages; i++) {
                BannerAdImages[i] = new Image();
                BannerAdImages[i].src = ' ' + ImageFolder + ImageFileNames[i];
            }
        }
    }

    //Function to change the src of the Banner Ad image
    function ChangeImage() {
        if (IsValidBrowser) {
            BannerAdCode = BannerAdCode + 1;
            if (BannerAdCode == NumberOfImages) {
                BannerAdCode = 0;
            }
            window.document.bannerad.src = BannerAdImages[BannerAdCode].src;
            TimerObject = setTimeout("ChangeImage()", DisplayInterval);
        }
    }

    //Function to redirect the browser window/frame to a new location,
    //depending on which image is currently being displayed by the Banner Ad.
    //If Banner Ad is being displayed on an old browser then the DefaultURL is displayed
    function ChangePage() {
        if (IsValidBrowser) {
            if (TargetFrame != '' && (FramesObject)) {
                FramesObject.location.href = ImageURLs[BannerAdCode];
            } else {
                window.open(ImageURLs[BannerAdCode],'mywin'+BannerAdCode);
            }
        } else if (!IsValidBrowser) {}
    }

    // --></script>
<link href="<?php print _MEDIA_URL ?>js/jquery_news_ticker/styles/ticker-style.css" rel="stylesheet" type="text/css" />
<script src="<?php print _MEDIA_URL ?>js/jquery_news_ticker/includes/jquery.ticker.js" type="text/javascript"></script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr >
        <td style="background-color:white;"> 

            <table width="1024" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr><td>
                        <img src="<?php print $image_src ?>" alt="" title="" style="display:none;position:absolute;margin-top:80px;<?php print $image_margin ?>" id="cityPeople"  />
                    </td></tr>
                <tr>
                    <?php #d($city_website_name);  ?> 
                    <td width="512" valign="top" class="padlogo logo" style="background-color:white;padding-bottom:0px">
                        <div style="cursor:pointer;" onclick="window.location = '<?php print _U ?>home'">
                            <img src="<?php print _MEDIA_URL ?>images/city_bg.jpg" />
                        </div> 
                    </td>
                    <td width="488" valign="top" style="background-color:white;">
                        <div style="float:right; width:468px; height:60px;  padding-top:18px; " align="right"> 
                            <?php if ($bannerarray[0]['cms_media'] != ''): ?>
                                <a target="_blank" href="<?php print $bannerarray[0]['cms_link'] ?>">
                                    <img src="<?php print $bannerarray[0]['cms_media']; ?>" border="0" hspace="0" name="bannerad" width="468" height="60">
                                </a> 
                            <?php endif; ?>
                        </div>
                        <div style="float:right;">
                            <table border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="lv-clr" height="30"><?php //print strftime("%A, %d. %B %Y",strtotime(date('Y-m-d',time())));                            ?></td>
                                </tr>
                                <tr>
                                    <td height="20">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td height="32" class="user_bg" valign="bottom" align="right">&nbsp;</td>
                                </tr>
                            </table>
                        </div>

                    </td>
                </tr>
            </table>




        </td>

    </tr>
    <tr>
        <td>
            <div style="font-weight:bold;font-size: 22px;padding-top:4px;clear:both;background-color: #111;width:1024px;height:26px;margin-left:18px;margin-bottom:3px;font-family: Arial Black">  
                <div style="float:left">
                    <span style="color:white;margin-left:20px;"><?php print $city_website_name['0']['ci_website_name']; ?>.enjoy.us</span><span style="color:#38B4F2;">.com</span>
                </div>
                <div style="margin-top:3px;float:right;margin-right: 10px;font-size:12px;color:white;font-family: tahoma" id="tr_time">
                    <?php print strftime("%A, %d. %B %Y - %H:%M"); ?>
                </div>
            </div>

            <table border="0" cellpadding="0" cellspacing="0" align="center" width="1024"><tr><td><div id="menu-strip">
                            <div id="inner-menu-style2">
                                <div class="ragestr" style="width:81px;"><a style="padding-left:0px;padding-right:0px;margin-left:-19px" href="<?php print _U; ?>members"><img src="<?php print _MEDIA_URL ?>images/register-icon.png" border="0"  alt="AdLino" title="AdLino" class="left-flot123"/> &nbsp;<?php print tpl::$_vars['lang_ref'][251]; ?></a></div>
                                <div class="mainmenu">
                                    <ul id="main-nav">
                                        <li><a  href="<?php print _U ?>home" ><b><?php print tpl::$_vars['lang_ref'][41]; ?></b><!--[if gte IE 7]><!--></a><!--<![endif]--> 
                                          <!--[if lte IE 6]><table><tr><td><![endif]--> 

                                            <!--[if lte IE 6]></td></tr></table></a><![endif]--> 
                                        </li>
                                        <li><a  href="<?php print _U ?>company"  ><b><?php print tpl::$_vars['lang_ref'][242]; ?></b><!--[if gte IE 7]><!--></a><!--<![endif]-->
                                          <!--[if lte IE 6]><table><tr><td><![endif]--> 
                                            <ul>
                                                <li><a href="<?php print _U; ?>company"><?php print tpl::$_vars['lang_ref'][3220]; ?></a></li>
                                                <li><a href="<?php print _U; ?>company_nationwide"><?php print tpl::$_vars['lang_ref'][3741]; ?></a></li>
                                                <li><a href="<?php print _U; ?>company?filter=voucher"><?php print tpl::$_vars['lang_ref'][375]; ?></a></li>
                                                <li><a href="<?php print _U; ?>company_nationwide?filter=voucher"><?php print tpl::$_vars['lang_ref'][3769]; ?></a></li>
                                                <li><a href="<?php print _U; ?>company?filter=service24"><?php print tpl::$_vars['lang_ref'][506]; ?></a></li>
                                                <li> <a href="<?php print _U; ?>company?filter=adlino_card_partners" ><?php print tpl::$_vars['lang_ref'][3025]; ?></a></li>
                                                <li class="lastbrdr"> <a href="<?php print _U; ?>webcatalog"><?php print tpl::$_vars['lang_ref'][250]; ?></a></li>
                                            </ul>
                                            <!--[if lte IE 6]></td></tr></table></a><![endif]--> 
                                        </li>
                                        <li><a class="sub" href="<?php print _U ?>classifieds" ><b><?php print tpl::$_vars['lang_ref'][866]; ?></b><!--[if gte IE 7]><!--></a><!--<![endif]--> 
                                          <!--[if lte IE 6]><table><tr><td><![endif]-->
                                            <ul>
                                                <li><a href="<?php print _U; ?>classifieds"><?php print tpl::$_vars['lang_ref'][196]; ?></a></li>
                                                <li><a href="<?php print _U; ?>car_classified_landing"><?php print tpl::$_vars['lang_ref'][887]; ?></a></li>
                                                <?php /* ?><li> <a href="<?php print _U;?>" ><?php print tpl::$_vars['lang_ref'][888];?></a></li> */ ?>
                                                <li> <a href="<?php print _U; ?>jobs"><?php print tpl::$_vars['lang_ref'][758]; ?></a></li>
                                                <li class="lastbrdr"> <a href="<?php print _U; ?>event_landing"><?php print tpl::$_vars['lang_ref'][244]; ?></a></li>
                                            </ul>
                                            <!--[if lte IE 6]></td></tr></table></a><![endif]--> 
                                        </li>
                                        <li><a class="sub" href="<?php print _U ?>video_landing" ><b><?php print tpl::$_vars['lang_ref'][197]; ?></b><!--[if gte IE 7]><!--></a><!--<![endif]--> 
                                          <!--[if lte IE 6]><table><tr><td><![endif]-->
                                            <ul>
                                                <li><a href="<?php print _U; ?>video_landing"><?php print tpl::$_vars['lang_ref'][882]; ?></a></li>
                                                <li><a href="<?php print _U; ?>video_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][874]; ?></a></li>
                                                <li><a href="<?php print _U; ?>video_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][875]; ?></a></li>
                                                <li class="lastbrdr"><a href="<?php print _U; ?>video_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][876]; ?></a></li>
                                            </ul>
                                            <!--[if lte IE 6]></td></tr></table></a><![endif]--> 
                                        </li>
                                        <li><a class="sub" href="<?php print _U ?>picture_landing" ><b><?php print tpl::$_vars['lang_ref'][198]; ?></b><!--[if gte IE 7]><!--></a><!--<![endif]--> 
                                          <!--[if lte IE 6]><table><tr><td><![endif]-->
                                            <ul>
                                                <li><a href="<?php print _U; ?>picture_landing"><?php print tpl::$_vars['lang_ref'][882]; ?></a></li>
                                                <li><a href="<?php print _U; ?>picture_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][874]; ?></a></li>
                                                <li> <a href="<?php print _U; ?>picture_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][875]; ?></a></li>
                                                <li class="lastbrdr"> <a href="<?php print _U; ?>picture_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][876]; ?></a></li>
                                            </ul>
                                            <!--[if lte IE 6]></td></tr></table></a><![endif]--> 
                                        </li>
                                        <li><a href="<?php print _U ?>ecard_landing"  ><b><?php print tpl::$_vars['lang_ref'][903]; ?></b><!--[if gte IE 7]><!--></a><!--<![endif]--> 
                                          <!--[if lte IE 6]><table><tr><td><![endif]-->
                                            <ul>
                                                <li><a href="<?php print _U; ?>ecard_landing"><?php print tpl::$_vars['lang_ref'][882]; ?></a></li>
                                                <li><a href="<?php print _U; ?>ecard_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][874]; ?></a></li>
                                                <li> <a href="<?php print _U; ?>ecard_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][875]; ?></a></li>
                                                <li class="lastbrdr"> <a href="<?php print _U; ?>ecard_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][876]; ?></a></li>
                                            </ul>
                                            <!--[if lte IE 6]></td></tr></table></a><![endif]--> 
                                        </li>
                                        <li><a href="<?php print _U ?>wallpaper_landing"  ><b><?php print tpl::$_vars['lang_ref'][904]; ?></b><!--[if gte IE 7]><!--></a><!--<![endif]--> 
                                          <!--[if lte IE 6]><table><tr><td><![endif]-->
                                            <ul>
                                                <li><a href="<?php print _U; ?>wallpaper_landing"><?php print tpl::$_vars['lang_ref'][882]; ?></a></li>
                                                <li><a href="<?php print _U; ?>wallpaper_landing?filter=tr"><?php print tpl::$_vars['lang_ref'][874]; ?></a></li>
                                                <li> <a href="<?php print _U; ?>wallpaper_landing?filter=mv"><?php print tpl::$_vars['lang_ref'][875]; ?></a></li>
                                                <li class="lastbrdr"> <a href="<?php print _U; ?>wallpaper_landing?filter=ft"><?php print tpl::$_vars['lang_ref'][876]; ?></a></li>
                                            </ul>
                                            <!--[if lte IE 6]></td></tr></table></a><![endif]--> 
                                        </li>
                                        <li><a  href="<?php print _U ?>shop_products" ><b><?php print tpl::$_vars['lang_ref'][199]; ?></b><!--[if gte IE 7]><!--></a><!--<![endif]--> 
                                          <!--[if lte IE 6]><table><tr><td><![endif]--> 
                                            <ul>
                                                <li><a href="<?php print _U; ?>catalogs"><?php print tpl::$_vars['lang_ref'][3805]; ?></a></li>
                                            </ul>
                                            <!--[if lte IE 6]></td></tr></table></a><![endif]--> 
                                        </li>
                                        <li><a href="<?php print _U ?>ourcity"  ><b><?php print tpl::$_vars['lang_ref'][249]; ?></b><!--[if gte IE 7]><!--></a><!--<![endif]--> 
                                          <!--[if lte IE 6]><table><tr><td><![endif]-->
                                            <ul>
                                                <li><a href="<?php print _U; ?>ourcity"><?php print tpl::$_vars['lang_ref'][2502]; ?></a></li>
                                                <li><a href="<?php print _U; ?>city_picture_landing"><?php print tpl::$_vars['lang_ref'][347]; ?></a></li>
                                                <li><a href="<?php print _U; ?>company?keyword_id=3595"><?php print tpl::$_vars['lang_ref'][348]; ?></a></li>
                                                <li><a href="<?php print _U; ?>company?keyword_id=6549"><?php print tpl::$_vars['lang_ref'][349]; ?></a></li>
                                                <li class="lastbrdr"><a href="<?php print _U; ?>ourcity_authorities"><?php print tpl::$_vars['lang_ref'][487]; ?></a></li>
                                            </ul>
                                            <!--[if lte IE 6]></td></tr></table></a><![endif]--> 
                                        </li>
                                        <li><a href="<?php print _U ?>jokes"  ><b><?php print tpl::$_vars['lang_ref'][2503]; ?></b><!--[if gte IE 7]><!--></a><!--<![endif]--> 
                                          <!--[if lte IE 6]><table><tr><td><![endif]-->
                                            <ul>
                                                <li><a href="<?php print _U ?>jokes" ><?php print tpl::$_vars['lang_ref'][2498]; ?></a></li>
                                                <li><a href="<?php print _U ?>sayings" rel="gc1" ><?php print tpl::$_vars['lang_ref'][2499]; ?></a></li>
                                                <li><a href="<?php print _U; ?>questions_and_answers" ><?php print tpl::$_vars['lang_ref'][2504]; ?></a></li>
                                                <li><a href="<?php print _U; ?>horoscope" ><?php print tpl::$_vars['lang_ref'][2500]; ?></a></li>
                                                <li class=""><a href="<?php print _U; ?>cinema_movies" ><?php print tpl::$_vars['lang_ref'][2501]; ?></a></li>
                                                <li class=""><a href="<?php print _U; ?>cooking_recipes" ><?php print tpl::$_vars['lang_ref'][3101]; ?></a></li>
                                                <li class=""><a href="<?php print _U; ?>news" ><?php print tpl::$_vars['lang_ref'][200]; ?></a></li>
                                                <li class=""><a href="<?php print _U; ?>tipps_and_advices" ><?php print tpl::$_vars['lang_ref'][2999]; ?></a></li>
                                                <li class=""><a href="<?php print _U; ?>online_games" ><?php print tpl::$_vars['lang_ref'][3794]; ?></a></li>
                                                <li class=""><a href="<?php print _U; ?>video_news" ><?php print tpl::$_vars['lang_ref'][3136]; ?></a></li>
                                                <li class=""><a href="<?php print _U; ?>music_news" ><?php print tpl::$_vars['lang_ref'][3976]; ?></a></li>
                                                <li ><a href="<?php print _U; ?>tv_programm" ><?php print tpl::$_vars['lang_ref'][3962]; ?></a></li>
                                                <li class="lastbrdr"><a href="<?php print _U; ?>mobile_prepaid_providers" ><?php print tpl::$_vars['lang_ref'][4025]; ?></a></li>

                                            </ul>
                                            <!--[if lte IE 6]></td></tr></table></a><![endif]--> 
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--End menu-strip-->

                        <?php ?>
                        <div id="menu-strip3" style="display:none">

                            <?php /*
                              <div id="inner-menu-style3" class="headernav">
                              echo str_replace('<script type="text/javascript" ', '<script type="text/javascript"  ', html_entity_decode($city_soap->Display_city_banner_by_City_Id(CITY_ID, "D_1000x26")));
                              <!--<script type="text/javascript" src="http://www.adhoster.de/Banner/MultipleBar.ashx?adid=2003"></script>-->
                              </div>
                             * */ ?> 

                            <div style="display:none" id="loginPop" >
                                <div id="messagepp"  style="color:red;font-size:13px;font-family:Helvetica,Helvetica,sans-serif;" ></div>
                                <table  border="0" cellpadding="0" cellspacing="0"  > 
                                    <tr>
                                        <td>
                                            <table  border="0" cellpadding="0" cellspacing="5"  width="333" id="loginBlockpp" > 
                                                <tr>
                                                    <td>
                                                        <?php print tpl::$_vars['lang_ref'][30]; ?>:
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text"   id="emailpp" style="width:345px" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php print tpl::$_vars['lang_ref'][5]; ?>:
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="password"   id="passwordpp" style="width:345px"/>
                                                    </td>
                                                </tr>

                                            </table>
                                            <table  border="0" cellpadding="0" cellspacing="5" id="forgetPasspp" style="display:none"  > 
                                                <tr>
                                                    <td>
                                                        <?php print tpl::$_vars['lang_ref'][30]; ?>:
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text"   id="emailPasspp" style="width:345px" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table  border="0" cellpadding="0" cellspacing="0" width="100%"> 
                                                <tr>
                                                    <td  align="left" style="padding-left:5px;padding-bottom:5px" valign="top">
                                                        <a href="javascript:;" onclick="$('#btnLoginpp').hide();$('#btnPasspp').show();$('#forgetPasspp').show();$('#loginBlockpp').hide();$(this).hide();$(this).next().show();"><?php print tpl::$_vars['lang_ref'][33] ?></a> 
                                                        <a style="display:none" href="javascript:;" onclick="$('#btnLoginpp').show();$('#btnPasspp').hide();$('#forgetPasspp').hide();$('#loginBlockpp').show();$(this).hide();$(this).prev().show()"><?php print tpl::$_vars['lang_ref'][40] ?></a> <br />
                                                        <a href="<?php print _U ?>step1"><?php print tpl::$_vars['lang_ref'][36] ?></a> <br />
                                                    </td>
                                                    <td  align="right" valign="top">
                                                        <input type="button"  id="btnPasspp" value="<?php print tpl::$_vars['lang_ref'][340]; ?>"  class="s_but" style="margin-right:6px;margin-top:3px;display:none"/>
                                                        <input type="button"  id="btnLoginpp" value="<?php print tpl::$_vars['lang_ref'][40]; ?>"  class="s_but" style="margin-right:6px;margin-top:3px"/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>


                                </table>

                            </div>
                        </div>
                        <div style="clear:both;padding-top:10px">
                            <div id="ticker-wrapper" class="no-js" >
                                <ul id="js-news" class="js-hidden">
                                    <?php for ($i = 3784; $i < 3794; $i++): ?>
                                        <?php if (strpos(tpl::$_vars['lang_ref'][$i], "about_adlino_") === false): ?>
                                            <li class="news-item"><a href="javascript:;"><?php print tpl::$_vars['lang_ref'][$i] ?></a></li>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                        </div>

                    </td></tr></table></td>
    </tr>
    <tr >
        <td valign="top"><table width="1009" border="0" align="center" cellpadding="0" cellspacing="0" class="main_midle_tr">
