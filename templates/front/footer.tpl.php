<?php
global $_pageid;
$_pageid = 23;
_include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_" . $_pageid . ".php");
_include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_general_terms.php");
global $_l;

//d($count_user_inbox);
require_once _PATH . "websites/front/soapclient.inc.php";
$new_soap = new soap_abstract();

$footerLinkdArray1 = unserialize($new_soap->GetLangDataFromTable("theme_footer_content", "tfc_title", $_SESSION['lid'], "tfc_id, tfc_url", " tfc_country_id='" . COUNTRY_ID . "' AND tfc_parent ='1' ", "ORDER BY tfc_id"));
//d($footerLinkdArray); exit;
$footerLinkdArray2 = unserialize($new_soap->GetLangDataFromTable("theme_footer_content", "tfc_title", $_SESSION['lid'], "tfc_id, tfc_url", " tfc_country_id='" . COUNTRY_ID . "' AND tfc_parent ='2' ", "ORDER BY tfc_id"));
?>
<style>
    .link_area {
        width:957px;
    }

</style>
<div id="footer">
    <!--footer area start-->
    <div class="footer_top" style="padding:10px">

        <?php if ($_REQUEST['q'] != 'online_support' && 0): ?>
            <!--footer top area start-->
            <div class="bl_bg_title">
                <!--bl snd title start-->
                <div class="bl_snd_left"> </div>
                <div class="bl_snd_bg" style="width:962px;">
                    <!--bl snd title start-->
                    <h1><?php print tpl::$_vars['lang_ref'][806]; ?></h1>
                    <!--bl snd title end-->
                </div>
                <div class="bl_snd_right"> </div>
                <!--bl snd title end-->
            </div>
            <div class="sv_link toppad" style="padding-bottom:11px; padding-top:8px;" >
                <!--sv link start-->
                <?php echo $new_soap->Display_banner(112); ?>
                <!--sv link end-->
            </div>
        <?php endif; ?>

        <div class="f_title" style="width:980px;">
            <!--footer title start-->
            <div class="f_top_lt">
                <!--footer left curve-->
            </div>
            <div class="f_top_bg">
                <!--footer top title start-->
                <div class="footer_nav">
                    <script type="text/javascript">
                        function openPopupWindow(url)
                        {
                            s=window.open(url,'enlarged_view','toolbar=no,resizable=yes,scrollbars=yes,left=100,top=100,width=800px,height=750px');
                            s.focus();
                            return false;
                        }
                    </script>
                    <!--footer nav start-->
                    <ul>
                        <li><a href="about_adlino"><?php print tpl::$_vars['lang_ref'][1106]; ?></a></li>
            <!--            <li><a href="help"><?php print tpl::$_vars['lang_ref'][1107]; ?></a></li>-->
                        <li><a href="contact_us"><?php print tpl::$_vars['lang_ref'][1108]; ?></a></li>
                        <li><a href="imprint"><?php print tpl::$_vars['lang_ref'][1109]; ?></a></li>
                        <li><a href="user_agreement"><?php print tpl::$_vars['lang_ref'][1123]; ?></a></li>
                        <li><a href="privacy_policy"><?php print tpl::$_vars['lang_ref'][630]; ?></a></li>
                        <li><a href="disclaimer"><?php print tpl::$_vars['lang_ref'][1111]; ?></a></li>
                    </ul>
                    <!--footer nav end-->
                </div>
                <div class="footer_top_right">
                    <!--footer top link start-->
                    <a href="#"><?php print tpl::$_vars['lang_ref'][1179]; ?></a>
                    <!--footer top link end-->
                </div>
                <!--footer top title end-->
            </div>
            <div class="f_top_rt"> </div>
            <!--footer title end-->
        </div>
        <div class="footer_bl">
            <!--footer bl start-->
            <div class="link_area">
                <!--link area start-->
                <div class="footer_left">
                    <!--footer left start-->
                    <h1><?php print tpl::$_vars['lang_ref'][1126]; ?></h1>
                    <div class="f_link">
                        <!--f link start-->
                        <ul>
                            <?
                            for ($i = 0; $i < count($footerLinkdArray1); $i++) {
                                if ($i % 5 == 0 && $i != 0)
                                    echo "</ul><ul>";
                                ?>
                                <li><a href="<?php print $footerLinkdArray1[$i]['tfc_url']; ?>"><?php print $footerLinkdArray1[$i]['tfc_title_l']; ?></a></li>
                            <? } ?>
                        </ul>
                        <!--f link end-->
                    </div>
                    <!--footer left end-->
                </div>
                <div class="footer_left" style="width:385px;">
                    <!--footer left start-->
                    <h1><?php print tpl::$_vars['lang_ref'][1120]; ?></h1>
                    <div class="f_link">
                        <!--f link start-->
                        <ul style="width:125px">
                            <?
                            for ($i = 0; $i < count($footerLinkdArray2); $i++) {
                                if ($i % 5 == 0 && $i != 0)
                                    echo "</ul style='width:125px'><ul>";
                                ?>
                                <li><a href="<?php print $footerLinkdArray2[$i]['tfc_url']; ?>" target="_blank"><?php print $footerLinkdArray2[$i]['tfc_title_l']; ?></a></li>
                            <? } ?>
                        </ul>
                        <!--f link end-->
                    </div>
                    <!--footer left end-->
                </div>
                <div class="footer_left" style="width:225px; border:none;">
                    <!--footer left start-->
                    <h1><?php print tpl::$_vars['lang_ref'][1121]; ?></h1>
                    <div class="ln_con1">
                        <!--f link start-->
                        <?php print tpl::$_vars['lang_ref'][796]; ?>. <br />
                        <div id="error_msg" style="height:15px; width:250px;"></div>
                        <form name="footer_form" id="footer_form" method="post" onsubmit="javascript:return validate('footer_form','news_letter_email');" >
                            <?php print tpl::$_vars['lang_ref'][1472]; ?><br />
                            <input name="news_letter_email" id="news_letter_email" type="text" class="profile_input" style="width:240px" />
                            <input style="margin-top:3px;margin-left:115px;"type="button" class="orBt" value="<?php print tpl::$_vars['lang_ref'][1127]; ?>" onclick="javascript:return validate('footer_form','news_letter_email');"/>
                            <!--f link end-->
                        </form>
                    </div>
                    <!--footer left end-->
                </div>
                <!--link area end-->
            </div>
            <!--footer bl end-->
        </div>
        <div class="footer_btm_link">
            <!--copyright area start-->
            <?php print tpl::$_vars['lang_ref'][1128]; ?> &copy; 2012 <?php print tpl::$_vars['lang_ref'][1137]; ?>, <?php print tpl::$_vars['lang_ref'][1129]; ?>. <br />
            <?php print tpl::$_vars['lang_ref'][1135]; ?>. </div>
        <!--copyright area end-->
        <div class="footer_btm_curve"> </div>
        <!--footer top area end-->
    </div>
    <!--  <div class="footer_btm">-->
    <!--footer bottom curve-->
    <!--    </div>-->
    <!--footer area end-->
    <!--  <div id="sh_bottom_left">&nbsp;</div> -->
</div>

<script>
		
    var sresponsestr = '<?php print tpl::$_vars['lang_ref'][2885]; ?>';
    var eresponsestr = '<?php print tpl::$_vars['lang_ref'][2886]; ?>';

    function validate(form_id,email) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var address = document.forms[form_id].elements[email].value;
        if(reg.test(address) == false) {
            document.getElementById('error_msg').innerHTML = "<?php print tpl::$_vars['lang_ref'][1205]; ?>";
            document.getElementById(email).focus();
            document.getElementById(email).className = "ier";
            document.getElementById('error_msg').className = "er";
		 
            //alert('Invalid Email Address');
            return false;
        }
        else
        {
            $.ajax({
                type:"POST",
                url:"ajax_handler",
                data:"page=newletter&email_id="+address+"&site=adlino.de",
                success:function(responsestr){
				
                    if(responsestr == "exist")
                    {
                        document.getElementById('error_msg').innerHTML = eresponsestr;
                    }
                    else
                    {
                        document.getElementById('error_msg').innerHTML = sresponsestr;
                    }
                    document.getElementById(email).value = '';
                    document.getElementById('error_msg').className = "grt";
                    //alert(responsestr);	
                    //$("#add_friend").html(responsestr);
                }
            });
        }
    }
</script>


<!--[if lte IE 6]>
<style type="text/css">
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