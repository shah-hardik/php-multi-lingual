<?php
global $_pageid;
$_pageid = 23;
_include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_" . $_pageid . ".php");
_include_if(_PATH . "lang/" . _REQUEST_LANG_ID . "_general_terms.php");
global $_l;
$COUNTRY_ID = '6';

__autoload('city_classes/common');
$objcmn = new common();

//d($count_user_inbox);
//require_once _PATH."websites/city/city_soap_client.inc.php";
//$new_soap = new city_soap_abstract();

$db = db::__d();
$footerLinkdArray1 = dc_display_dtt_data_to_front($db, "theme_footer_content", "tfc_title", $_SESSION['lid'], "tfc_id, tfc_url", " tfc_country_id='" . $COUNTRY_ID . "' AND tfc_parent ='3' ", "ORDER BY tfc_id");
$footerLinkdArray2 = dc_display_dtt_data_to_front($db, "theme_footer_content", "tfc_title", $_SESSION['lid'], "tfc_id, tfc_url", " tfc_country_id='" . $COUNTRY_ID . "' AND tfc_parent ='4' ", "ORDER BY tfc_id");
//$footerLinkdArray1=unserialize($new_soap->GetLangDataFromTable1("theme_footer_content","tfc_title",$_SESSION['lid'],"tfc_id, tfc_url"," tfc_country_id='".$COUNTRY_ID."' AND tfc_parent ='3' ","ORDER BY tfc_id"));
//d($footerLinkdArray); exit;
//$footerLinkdArray2=unserialize($new_soap->GetLangDataFromTable1("theme_footer_content","tfc_title",$_SESSION['lid'],"tfc_id, tfc_url"," tfc_country_id='".$COUNTRY_ID."' AND tfc_parent ='4' ","ORDER BY tfc_id"));
?>

<?php if (!in_array($_REQUEST['q'], array('code'))&& 0): ?>
    <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="pur_bg">&nbsp;&nbsp;<?php print tpl::$_vars['lang_ref'][806]; ?></td>
                </tr>
                <tr>
                    <td style="height:8px;"></td>
                </tr>
                
                <tr>
                    <td valign="top" align="center" class="ad_border_footer gray-nbg" style="background-color:#F9F9F9"><!-- Use CITY_ID instead of 11 --> 
                        <?php echo $B_978x145 = html_entity_decode($objcmn->Display_city_banner_by_City_Id(CITY_ID, "B_978x145")); ?>
                        <?php //echo html_entity_decode($new_soap->Display_city_banner_by_City_Id(11,"B_978x145")); ?></td>
                </tr>
            </table></td>
    </tr>
<?php endif; ?>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td class="footer" colspan="3"><table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="padltrt" nowrap="nowrap"><a href="<?php print _U?>help" class="flink"><?php print tpl::$_vars['lang_ref'][1106]; ?><!--About Us--></a></td>
                            <td class="padltrt"><a href="<?php print _U?>c_info_membership" class="flink"><?php print tpl::$_vars['lang_ref'][1107]; ?><!--Companies--></a></td>
                            <td class="padltrt"><a href="<?php print _U?>contact_us" class="flink"><?php print tpl::$_vars['lang_ref'][1108]; ?><!--View--></a></td>
                            <td class="padltrt"><a href="<?php print _U?>imprint" class="flink"><?php print tpl::$_vars['lang_ref'][1109]; ?><!--Events--></a></td>
                            <td class="padltrt"><a href="<?php print _U?>user_agreement" class="flink"><?php print tpl::$_vars['lang_ref'][1123]; ?><!--Videos--></a></td>
                            <td class="padltrt"><a href="<?php print _U?>privacy_policy" class="flink"><?php print tpl::$_vars['lang_ref'][630]; ?><!--Members--></a></td>
                            <td class="padltrt"><a href="<?php print _U?>disclaimer" class="flink"><?php print tpl::$_vars['lang_ref'][1111]; ?><!--Shop--></a></td>
                        </tr>
                    </table></td>
            </tr>
            <tr>
                <td colspan="3" style="height:15px;"></td>
            </tr>
            <tr>
                <td colspan="3" class="footer-bg"><table  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td colspan="2"  width="700"  style="" >
                                <div style="height:185px;width:700px">&nbsp;</div>
                                <div class="grn_footer" >
                                    <table width="100%"  cellspacing="0" cellpadding="0" class="footercontent">
                                        <tr>
                                            <td width="220" valign="top" class="bdr_right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td colspan="2" class="foot_title"><?php print tpl::$_vars['lang_ref'][1126]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="f_link"><ul>
                                                                <? for($i=0;$i<count($footerLinkdArray1);$i++) {
                                                                    if($i%5 == 0 && $i != 0)
                                                                    echo '</ul></td><td class="f_link"><ul>';
                                                                ?>
                                                                <li><a href="<?php print $footerLinkdArray1[$i]['tfc_url']; ?>"><?php print $footerLinkdArray1[$i]['tfc_title_l']; ?></a></li>
                                                                <? } ?>
                                                            </ul></td>
                                                    </tr>
                                                </table></td>
                                            <td width="214" valign="top" class="bdr_right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td colspan="2" class="foot_title"><?php print tpl::$_vars['lang_ref'][1120]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="f_link"><ul>
                                                                <? for($i=0;$i<count($footerLinkdArray2);$i++) {
                                                                    if($i%5 == 0 && $i != 0)
                                                                    echo '</ul></td><td class="f_link"><ul>';
                                                                ?>
                                                                <li><a href="<?php print $footerLinkdArray2[$i]['tfc_url']; ?>"><?php print $footerLinkdArray2[$i]['tfc_title_l']; ?></a></li>
                                                                <? } ?>
                                                            </ul></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                            <td valign="top" class="footer-btmbg"><table  border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                        <td width="4%">&nbsp;</td>
                                        <td  class="foot_title"><?php print tpl::$_vars['lang_ref'][1121]; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="4%">&nbsp;</td>
                                        <td height="33"  class="ns_tx" valign="bottom" width="95%"><?php print tpl::$_vars['lang_ref'][796]; ?>.</td>
                                    </tr>
                                    <tr>
                                        <td width="4%">&nbsp;</td>
                                        <td height="33" ><div id="error_msg" style="width:250px;"></div>
                                            <form name="footer_form" id="footer_form" method="post" onsubmit="javascript:return validate('footer_form','news_letter_email');" >
                                                <input name="news_letter_email" id="news_letter_email" type="text" size="25" style="height:16px;"/>
                                                <input style="width:89px" name="input2" type="button" class="s_but" value="<?php print tpl::$_vars['lang_ref'][1127]; ?>" onclick="javascript:return validate('footer_form','news_letter_email');" />
                                            </form>
                                            <div id="bl_img_ftr_cnt" style="margin-top:30px;margin-left:109px"> <img src="<?php print _MEDIA_URL ?>images/balls_city.png"  alt="AdLino" title="AdLino" style="position:absolute;" id="bl_img_ftr"/>&nbsp;</div></td>
                                    </tr>
                                    <!-- <tr>
                                        <td width="5">&nbsp;</td>
                                        <td  align="right"></td>
                                      </tr>-->
                                </table></td>
                        </tr>
                    </table></td>
            </tr>
            <tr>
                <td class="footer-btmbg footer_bootom" style="padding-top:23px" ><?php print tpl::$_vars['lang_ref'][1128]; ?> &copy; 2009 <?php print tpl::$_vars['lang_ref'][1137]; ?>, <?php print tpl::$_vars['lang_ref'][1129]; ?>. <br />
                    <?php print substr(tpl::$_vars['lang_ref'][1135], 0, 167) . "<br/>" . substr(tpl::$_vars['lang_ref'][1135], 167); ?>. </td>
                <td valign="top" class="footer-btmbg footer_bootom"></td>
                <td class="footer_btm_rt footer_bootom" valign="top"></td>
            </tr>
        </table></td>
</tr>
</table>
</td>
</tr>
</table>
<script type="text/javascript">
    /*$(document).ready(function() {
                var cur_top = $("#bl_img_ftr").css("top");
                $("#bl_img_ftr").css("top",parseInt(cur_top)+50+"px");
        });*/
</script> 
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
                data:"page=newletter&email_id="+address+"&site=<?php print $_SERVER['SERVER_NAME']; ?>",
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