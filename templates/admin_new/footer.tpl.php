<div id="footer">
      <!--footer area start-->
      <div class="footer_top">
        <!--footer top area start-->
        <div class="f_title">
          <!--footer title start-->
          <div class="f_top_lt">
            <!--footer left curve-->
          </div>
          <div class="f_top_bg">
            <!--footer top title start-->
            <div class="footer_nav">
              <!--footer nav start-->
              <ul>
                <li>
                    <?php if(in_array($_SESSION['adlino_user_type'],array(4,5))):?>
                    <a href="<?php print _U?>city_administrator_terms?p=1" target="blank">
                        <?php print tpl::$_vars['lang_ref'][2759]; ?>
                    </a>
                    <?php endif;?>
                </li>
              </ul>
              <!--footer nav end-->
            </div>
            <div class="footer_top_right">
              <!--footer top link start-->
              <a href="#">Top</a>
              <!--footer top link end-->
            </div>
            <!--footer top title end-->
          </div>
          <div class="f_top_rt"> </div>

          <!--footer title end-->
        </div>
         <?php if($_SESSION['adlino_user_type'] != 4){ ?>
        <div class="footer_btm_link">
          <!--copyright area start-->
          Copyright &copy; 2009-2012 Adlino, All Rights Reserved. <a href="#">About Us</a> | <a href="#">Terms</a> | <a href="#">Jobs @ Adlino</a> | <a href="#">Adlino Services</a> | <a href="#">Adlino Classifieds</a> | <a href="#">on your home page</a> <br />
          Note: On this page we collect personal information. For further details please read our Privacy Policy and Terms of Use</div><?php } ?>
        <!--copyright area end-->
        <div class="footer_btm_curve"> </div>
        <!--footer top area end-->
      </div>
      <div class="footer_btm">
        <!--footer bottom curve-->
      </div>
      <!--footer area end-->
    </div>