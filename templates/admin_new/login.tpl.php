<style>
/*bottom area*/
#bottom_area{background:url(../images/mainbg.png) repeat-y; padding:0px 4px 0px 4px;width:992px; float:left;}
.top_grad{/*background:url(../images/top-grad.gif) no-repeat;*/ width:992px; height:50px; float:left; background:none}
.bottom_main{padding:0px 7px 0px 7px;float:left;}
.bottom{/*background:url(../images/bottom_grad.gif) repeat-x;*/ width:992px; float:left; background:none;}

body{margin:0px; padding:0px; font-family:Tahoma; font-size:11px; background:#C2C1C1;}
.bl_bg_title{ width:200px; padding: 16px 325px 16px 20px; background:#FFFFFF;  margin-left:200px;}
</style>

<div align="left">
  <!--header area start-->
    <div>
      <!--logo area start-->
      <a href="#"><img src="<?php print _MEDIA_URL ?>images/logo.jpg" border="0" title="Adlino Deuschland" alt="Adlino Deuschland" /></a><br />
      <!--logo area end-->
    </div>
  <!--header area end-->
</div>
<div style="height:10px"></div>
<div class="bottom-mid-area">
  <!--bottom mid area start-->
  <form name="adlino_login"  id="adlino_login" method="post">
    <div class="login-left">
      <!--bottom left area start-->
      <div class="adlino-media">
        <!--adlino media start-->
        <div class="login-left-curve"> </div>
        <div class="login-bg">
          <!--login acc start-->
          <?php print tpl::$_vars['lang_ref'][2739]; ?>
          <!--login acc end-->
        </div>
        <div class="login-right-curve"> </div>
        <!--adlino media end-->
      </div>
      <div class="media-login">
        <!--media login start-->
        <div class="media-inner">
          <!--media inner start-->
          <div class="media-img"> </div>
          <div class="address-area">
		  	<?php if($error != '' ): ?>
				<div class="er" style="width:263px;"> <?php print $error; ?></div>
			<?php endif;?>
            <!--address area start-->
            <div class="address-name">
              <!--address name start-->
              <?php print tpl::$_vars['lang_ref'][30]; ?>
              <!--address name end-->
            </div>
            <div class="address-name">
              <!--address name start-->
              <input name="adlino_username" id="adlino_username" type="text" class="login-input <?php print _e($_t['adlino_username']['error_class'])?>" style="width:286px; height:19px;" value="<?php print _e($_t['adlino_username']['value']);?>" />
              <!--address name end-->
            </div>
            <div class="password-name">
              <!--address name start-->
              <?php print tpl::$_vars['lang_ref'][5]; ?>
              <!--address name end-->
            </div>
            <div class="address-name">
              <!--address name start-->
              <input name="adlino_password" type="password"  style="width:286px; height:19px;" class="login-input <?php print _e($_t['adlino_password']['error_class'])?>" value="<?php print _e($_t['adlino_password']['value']);?>" />
              <!--address name end-->
            </div><div class="login-btn">
              <!--login btn start-->
              
              <!--login btn end-->
            </div>
            <div class="float-left1">
              <div class="keep" align="right">
              <input class="inputbutton" type="submit" border="0" alt="" name="adlino_login_btn" value="<?php print tpl::$_vars['lang_ref'][40]?>"  /><br />
                <!--keep text start-->
                <!--<input name="adlino_keep_signed" type="checkbox" value="Keep me signed-in" class="radio" />-->
                <!--keep text end-->
              </div>
              <!--<div class="keep1">Keep me signed-in</div>-->
				 
              
            </div>
            
            <!--address area end-->
          </div>
          
          <!--media inner end-->
        </div>
        <!--media login end-->
      </div>
      <div class="media-bottom"> </div>
      <!--bottom left area end-->
    </div>
  </form>
  <!--bottom mid area end-->
</div>
<script type="text/javascript" >
	$(document).ready(function(){
		$("#adlino_username").focus();
	});
</script>

<iframe style="display:none" height="0" width="0" src="http://www.adlino.de/sm?off=1" ></iframe>
<iframe style="display:none" height="0" width="0" src="http://adlino.de/sm?off=1" ></iframe>