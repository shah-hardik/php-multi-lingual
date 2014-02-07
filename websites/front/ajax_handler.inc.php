<?php

$_db = db::__d();
if (isset($_REQUEST['dash']) && $_REQUEST['dash'] == "No") {
    $dash1 = "";
    $dash2 = "";
} else {
    //$dash1 = "----------------------";
    $dash1 = "";
    $dash2 = "";
    //$dash2 = "---";
}

//19-04-2010
//For mail Spam
if (isset($_REQUEST['op']) && $_REQUEST['op'] == "sendtofriend") {
    $from_email = $_REQUEST['from_email'];
    $to_email = $_REQUEST['to_email'];
    $message = $_REQUEST['message'];
    $classified_id = $_REQUEST['classified_id'];
    $objEmail = new mailer();
    $objEmail->AddUser($to_email);         // Mail To
    $objEmail->SetFrom($from_email);        //Mail From
    // Mail Content / Body Part
    if ($_REQUEST['classified_type'] == 'general') {
        $message = "Adlino Classified";
        $link = "<a href='" . _U . "general_classified_details?gen_classified_id=" . $classified_id . "' >Click Here</a>";
    }
    if ($_REQUEST['classified_type'] == 'car') {
        $message = "Adlino Car Classified";
        $link = "<a href='" . _U . "classified_details?car_classified=" . $classified_id . "' >Click Here</a>";
    }
    $content = "Hi,<br><br>" . $message . "<br><br>Please " . $link . " to check this classified<br><br>" .
            "Thanks!<br><br>" .
            "Adlino Team <br>";
    $objEmail->SetHtml();
    $objEmail->SetSubject($message);
    $objEmail->SetContent($content);
    $objEmail->Send();
}

if (isset($_REQUEST['op']) && $_REQUEST['op'] == "sendproduct_friend") {

    $from_email = $_REQUEST['from_email'];
    $to_email = $_REQUEST['to_email'];

    //$to_email="tarste.tester@gmail.com";
    $message = $_REQUEST['message'];
    $classified_id = $_REQUEST['classified_id'];
    $objEmail = new mailer();
    $objEmail->AddUser($to_email);         // Mail To
    $objEmail->SetFrom($from_email);        //Mail From
    // Mail Content / Body Part
    if ($_REQUEST['classified_type'] == 'product') {
        $message = "Adlino Product";
        $link = "<a href='" . _U . "my_shop_details?shop_id=" . $classified_id . "' >Click Here</a>";
    }
    if ($_REQUEST['classified_type'] == 'car') {
        $message = "Adlino Car Classified";
        $link = "<a href='" . _U . "classified_details?car_classified=" . $classified_id . "' >Click Here</a>";
    }
    if ($_REQUEST['classified_type'] == 'shopping') {
        $message = "Adlino Shop";
        $link = "<a href='" . _U . "my_shop_details?shop_id=" . $classified_id . "' >Click Here</a>";
    }
    $content = "Hi,<br><br>" . $message . "<br><br>Please " . $link . " to check this classified<br><br>" .
            "Thanks!<br><br>" .
            "Adlino Team <br>";
    $objEmail->SetHtml();
    $objEmail->SetSubject($message);
    $objEmail->SetContent($content);
    $objEmail->Send();
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "mail_details" && isset($_REQUEST['user_id'])) {
    require_once "soapclient.inc.php";
    $makespam = $soap->MakeItSpam($_SESSION['user_id'], $_REQUEST['user_id'], $_REQUEST['flag']);

    if ($_REQUEST['flag'] == 0) {
        print "&nbsp;&nbsp;<label style='color:green'>Marked as Not Spam</label>";
    } else {
        print "&nbsp;&nbsp;<label style='color:red'>Marked as spam</label>";
    }
}


//get size for add_order page
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_order" && isset($_REQUEST['size_type'])) {
    require_once "soapclient.inc.php";
    $size_list = $soap->GetSizeOfOrderType($_REQUEST['size_type']);
    print "<option value='0'>" . $dash1 . " " . tpl::$_vars['lang_ref'][1007] . " " . $dash2 . "</option>";
    if (count($size_list) != 0) {

        foreach ($size_list as $sizes_list) {
            if ($sizes_list['size_type'] == "video") {
                $option = $sizes_list['size'];
            } else {
                $option = $sizes_list['size_width'] . "X" . $sizes_list['size_height'];
            }
            print "<option value='" . $option . "'>" . $option . "</option>";
        }
    }

    $db = db::__d();
    $query = "SELECT `cost` FROM `ecard_wallpaper_size_mgmt` WHERE `size_type` = 'wallpaper' group by `size_type`";
    $res = $db->query($query);
    $cost_info = $db->format_data($res);

    print ";" . $cost_info[0]['cost'];
}

//get country list from continent
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "edit_profile" && isset($_REQUEST['continent_id'])) {
    require_once "soapclient.inc.php";
    $countries_list = unserialize($soap->GetCountries($_REQUEST['continent_id']));
    print "<option value='0'>" . $dash1 . tpl::$_vars['lang_ref'][464] . $dash2 . "</option>";
    if (count($countries_list) != 0) {
        foreach ($countries_list as $country_list) {
            $country_name = "";
            if ($country_list[$_SESSION['lid'] . '_c_name'] == "") {
                $country_name = $country_list['c_name'];
            } else {
                $country_name = $country_list[$_SESSION['lid'] . '_c_name'];
            }
            print "<option value='" . $country_list['c_id'] . "'>" . $country_name . "</option>";
        }
    }
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "edit_profile" && isset($_REQUEST['cb_id'])) {
    require_once "soapclient.inc.php";
    $language_id = $_SESSION['lid'];
    $carModelArray = unserialize($soap->GetLangDataFromTable("car_model", "cm_name", $language_id, "cb_id,cm_id", " cb_id='" . $_REQUEST['cb_id'] . "'", "ORDER BY cm_name"));
    print "<option value='0'>" . $dash1 . tpl::$_vars['lang_ref'][579] . $dash2 . "</option>";
    if (count($carModelArray) != 0) {
        foreach ($carModelArray as $carModel) {
            print "<option value='" . $carModel['cm_id'] . "'>" . $carModel['cm_name_l'] . "</option>";
        }
    }
}
//get state list from country
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "edit_profile" && isset($_REQUEST['country_id'])) {
    require_once "soapclient.inc.php";
    $states_list = $soap->GetStates($_REQUEST['country_id']);
    print "<option value='0'>" . $dash1 . tpl::$_vars['lang_ref'][1474] . $dash2 . "</option>";
    if (count($states_list) != 0) {
        foreach ($states_list as $state_list) {
            print "<option value='" . $state_list['s_id'] . "'>" . $state_list['s_name'] . "</option>";
        }
    }
}
//get provinces list from country and state
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "edit_profile" && isset($_REQUEST['state_id'])) {
    require_once "soapclient.inc.php";
    $provinces_list = $soap->GetProvinces($_REQUEST['state_id']);
    print "<option value='0'>" . $dash1 . tpl::$_vars['lang_ref'][1475] . $dash2 . "</option>";
    if (count($provinces_list) != 0) {
        foreach ($provinces_list as $province_list) {
            print "<option value='" . $province_list['p_id'] . "'>" . $province_list['p_name'] . "</option>";
        }
    }
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "edit_profile" && isset($_REQUEST['provinces_id'])) {
    require_once "soapclient.inc.php";
    $cities_list = $soap->GetCities($_REQUEST['provinces_id']);
    print "<option value='0'>" . $dash1 . tpl::$_vars['lang_ref'][1476] . $dash2 . "</option>";
    if (count($cities_list) != 0) {
        foreach ($cities_list as $city_list) {
            print "<option value='" . $city_list['ci_id'] . "'>" . $city_list['ci_name'] . "</option>";
        }
    }
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "edit_profile" && isset($_REQUEST['city_id'])) {
    require_once "soapclient.inc.php";
    $neis_list = $soap->GetNeighborhoods($_REQUEST['city_id']);
    print "<option value='0'>" . $dash1 . tpl::$_vars['lang_ref'][4051] . $dash2 . "</option>";
    if (count($neis_list) != 0) {
        foreach ($neis_list as $nei_list) {
            print "<option value='" . $nei_list['nei_id'] . "'>" . $nei_list['nei_name'] . "</option>";
        }
    }
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_company" && isset($_REQUEST['cat_id'])) {
    require_once "soapclient.inc.php";
    $cat_name_language_field = ($_SESSION['lid'] == 1) ? "cat_name" : $_SESSION['lid'] . "_cat_name";
    $SubCategoriesArray = unserialize($soap->GetSubCategories($_REQUEST['cat_id'], $_SESSION['lid']));
    print "<option value='0'>" . tpl::$_vars['lang_ref'][128] . "</option>";
    if (count($SubCategoriesArray) != 0) {
        foreach ($SubCategoriesArray as $SubCategories) {
            print "<option value='" . $SubCategories['cat_id'] . "'>" . $SubCategories['cat_name_l'] . "</option>";
        }
    }
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_keyword" && isset($_REQUEST['keyword_name'])) {
    require_once "soapclient.inc.php";
    $language_id = 1;
    //get keywords for sub category
    $SubCatKeywordArray = unserialize($soap->GetKeywordsForSubCatgory($_REQUEST['keyword_name'], $language_id, $_SESSION['company_id']));
    //get company keywords if any exists
    //if any exists then
    //$CompanyKeywords=$soap->GetCompanyKeywords($_SESSION['company_id'],$_SESSION['lid'],$_REQUEST['subcat_id']);
    $CompanyKeywords = unserialize($soap->GetCompanyKeywords($_SESSION['company_id'], $language_id, false));
    /* print_r($CompanyKeywords);
      exit; */
    $CompanyKeywordsArray = array();
    $CompanyKeywordsArray = $soap->GetCompanyKeywordsIds($_SESSION['company_id'], $language_id);
    if (!empty($SubCatKeywordArray)) {



        print '<table width="100%" border="0" cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td valign="top" width="15%"><span class="star">*</span>' . tpl::$_vars['lang_ref'][1438] . ':</td>
					<td>
				<div class="weiss">
  			   		<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        $i = 0;
        //get specific language field name	
        //$keyword_field_name=($_SESSION['lid'] == 1) ? 'keyword' : $_SESSION['lid'].'_keyword';	
        $keyword_field_name = 'keyword';
        foreach ($SubCatKeywordArray as $SubCatKeyword) {
            //d($SubCatKeyword); 		
            if (array_key_exists($keyword_field_name, $SubCatKeyword)) {
                $lang_keyword_field_name = $keyword_field_name;
            } else {
                $lang_keyword_field_name = "keyword";
            }
            switch ($SubCatKeyword['keyword_type']) {
                case 'br':
                    $keyword_type_name = tpl::$_vars['lang_ref'][845];
                    break;
                case 's':
                    $keyword_type_name = tpl::$_vars['lang_ref'][3356];
                    break;
                case 'sn':
                    $keyword_type_name = tpl::$_vars['lang_ref'][3350];
                    break;
                case 'p':
                    $keyword_type_name = tpl::$_vars['lang_ref'][3351];
                    break;
                case 'g':
                    $keyword_type_name = tpl::$_vars['lang_ref'][3574];
                    break;
            }
            $row_css_class = ($i % 2 == 0) ? 'blau' : '';

            print '<tr class="' . $row_css_class . '">
						  <td align="center" class="mitTrenner">';
            if (count($CompanyKeywords) > 1) {
                if (in_array($SubCatKeyword['id'], $CompanyKeywordsArray)) {
                    print '<input type="checkbox" checked="checked" disabled="disabled"" name="ck[' . $i . ']" value="' . $SubCatKeyword['id'] . '"/>';
                } else {
                    print '<input type="checkbox" name="ck[' . $i . ']" value="' . $SubCatKeyword['id'] . '"/>';
                }
            } else {
                print '<input type="checkbox"" name="ck[' . $i . ']" value="' . $SubCatKeyword['id'] . '"/>';
            }
            print '</td>
       					  <td width="100%" class="generellmittel mitTrenner">
						        ' . (_e($SubCatKeyword['keyword']) ? $SubCatKeyword['keyword'] : $SubCatKeyword['keyword']) . '
						        (' . $keyword_type_name . ') 
        			      </td>
     					</tr>';
            $i++;
        }

        print '</table>
				</div>';
        print '<div style="padding-top:10px;">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tr>
							
							<td valign="top">	
							</td>
							<td align="right">
								<input type="submit" style="margin-right:25px" class="bl_inputbutton" name="add_keyword" value="' . tpl::$_vars['lang_ref'][8] . '"/>
							</td>
						</tr>
						
					</table>
				 </div>
				 </td>
				 </tr>
				 ';
        /*  if(count($CompanyKeywords) > 1 && 0){
          print '<tr>
          <td valign="top" width="15%"></td>
          <td>
          <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tr>
          <td width="530">&nbsp;</td>
          <td align="left" width="80" style="padding:2px;">'.tpl::$_vars['lang_ref'][518].'</td>
          <td align="left" width="100" style="padding:2px;">'.tpl::$_vars['lang_ref'][519].'</td>
          <td align="left" width="100" style="padding:2px;">'.tpl::$_vars['lang_ref'][520].'</td>
          <td align="left" width="100" style="padding:2px;">'.tpl::$_vars['lang_ref'][521].'</td>
          <td width="46">'.tpl::$_vars['lang_ref'][12].'</td>
          </tr>
          </table>
          </td>
          </tr>
          <tr>
          <td valign="top" width="18%"><span class="star">*</span>'.tpl::$_vars['lang_ref'][527].':</td>
          <td>
          <div>
          <table width="100%" cellspacing="0" cellpadding="0" border="0">';
          $j=0;
          //$keyword_field_name=($_SESSION['lid'] == 1) ? 'keyword' : $_SESSION['lid'].'_keyword';
          $keyword_field_name='keyword'
          foreach($CompanyKeywords as $CompanyKeyword){
          $row_css_class=($j%2 == 0) ? 'blau' :'';
          if(array_key_exists($keyword_field_name, $CompanyKeyword)) {
          $lang_keyword_field_name=$keyword_field_name;
          }else{
          $lang_keyword_field_name="keyword";
          }
          print '<tr class="'.$row_css_class.'">
          <td width="315" class="generellmittel mitTrenner">
          '.(_e($CompanyKeyword['ckud_translated_word']) ? $CompanyKeyword['ckud_translated_word'] : $CompanyKeyword['keyword_l']).'
          <input type="hidden" id="company_type['.$j.'].zztext" value="'.(_e($CompanyKeyword['ckud_translated_word']) ? $CompanyKeyword['ckud_translated_word'] : $CompanyKeyword['keyword_l']).'"/>
          </td>
          <td align="left" width="80" class="mitTrenner">';
          if($CompanyKeyword['service'] == 1){
          print '<input type="checkbox" value="1" checked="checked" name="ccc['.$CompanyKeyword['ccc_id'].'][service]" id="company_type['.$j.'].service" />';
          }else{
          print '<input type="checkbox" value="1" name="ccc['.$CompanyKeyword['ccc_id'].'][service]" id="company_type['.$j.'].service" />';
          }
          print '</td>
          <td align="left" width="100" class="mitTrenner">';
          if($CompanyKeyword['wholesale'] == 1){
          print '<input type="checkbox" value="1" checked="checked" name="ccc['.$CompanyKeyword['ccc_id'].'][wholesale]" id="company_type['.$j.'].wholesale" />';
          }else{
          print '<input type="checkbox" value="1" name="ccc['.$CompanyKeyword['ccc_id'].'][wholesale]" id="company_type['.$j.'].wholesale" />';
          }
          print '</td>
          <td align="left" width="100" class="mitTrenner">';
          if($CompanyKeyword['distributors'] == 1){
          print '<input type="checkbox"  value="1" checked="checked" name="ccc['.$CompanyKeyword['ccc_id'].'][distributors]" id="company_type['.$j.'].distributors" />';
          }else{
          print '<input type="checkbox"  value="1" name="ccc['.$CompanyKeyword['ccc_id'].'][distributors]" id="company_type['.$j.'].distributors" />';
          }
          print '</td>
          <td align="left" width="100" class="mitTrenner">';
          if($CompanyKeyword['manufacture'] == 1){
          print '<input type="checkbox"  value="1" checked="checked" name="ccc['.$CompanyKeyword['ccc_id'].'][manufacture]" id="company_type['.$j.'].manufacture" />';
          }else{
          print '<input type="checkbox"  value="1" name="ccc['.$CompanyKeyword['ccc_id'].'][manufacture]" id="company_type['.$j.'].manufacture" />';
          }
          print'</td>
          <td width="50" class="mitTrenner">
          <input type="image" name="remove_ccc" src="'._MEDIA_URL.'/images/tonne.gif" onclick="return remove_ccc('.$CompanyKeyword['ccc_id'].')">
          </td>
          </tr>';
          $j++;
          }
          print '</table>
          </div>
          </td>
          </tr>
          <tr>
          <td colspan="2" align="right">
          <input type="hidden" name="ccc_id" id="remove_ccc_id" value="">
          <input type="submit" style="float:right" class="bl_inputbutton" name="add_company_keyword" value="'.tpl::$_vars['lang_ref'][340].'" onclick="return CheckCompanyType('.count($CompanyKeywords).');" />
          </td>
          </tr>';
          } */
    } else {
        print '<div class="er">' . tpl::$_vars['lang_ref'][529] . '.</div>';
    }
}


if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_as_friend" && isset($_REQUEST['user_id'])) {
    require_once "soapclient.inc.php";

    $already_exsits = $soap->friend_already_exsits($_REQUEST['friend_id'], $_REQUEST['user_id']);
    //print_r(count($already_exsits));
    if (count($already_exsits) == 0) {
        $already_exsits = $soap->add_as_friend($_REQUEST['friend_id'], $_REQUEST['user_id']);
        //increment activity point of city user
        $soap->ManageCityUserActivityPoint($_SESSION['user_id']);
        $objEmail = new mailer();

        $mail_subject = "Friend Request";

        $friend_info = $soap->send_to_friend_request($_REQUEST['friend_id']);
        $sender_info = $soap->sender_user_info($_REQUEST['user_id']);
        //print_r($sender_info);
        $mail_subject = "Friend request from " . $sender_info[0]['user_name'];
        $mail_contents = "Hello " . $friend_info[0]['user_name'] . ",<br/>";
        $mail_contents .= "Please accept my friend request";

        $objEmail->AddUser($friend_info[0]['user_email']);         // Mail To
        $objEmail->SetFrom($sender_info[0]['user_email']);        //Mail From
        // Mail Content / Body Part
        $content = $mail_contents;

        $objEmail->SetHtml();
        $objEmail->SetSubject($mail_subject);
        $objEmail->SetContent($content);
        $objEmail->Send();
        print tpl::$_vars['lang_ref'][2093];
    } else {
        print tpl::$_vars['lang_ref'][2094];
    }
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_abuse_job" && isset($_REQUEST['user_id'])) {

    $db = db::__d();
    $FieldArray = array("job_id" => $_REQUEST['job_id'],
        "user_id" => $_REQUEST['user_id'],
        "date" => date('y-m-d'),
        "job_type" => $_REQUEST['job_type']
    );
    $db->insert_query("job_abuse", $FieldArray);


    print tpl::$_vars['lang_ref'][2571];
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_favourite_job" && isset($_REQUEST['user_id'])) {

    $db = db::__d();
    $FieldArray = array("job_id" => $_REQUEST['job_id'],
        "user_id" => $_REQUEST['user_id'],
        "date" => date('y-m-d'),
        "job_type" => $_REQUEST['job_id']
    );
    $db->insert_query("job_favourite", $FieldArray);


    print tpl::$_vars['lang_ref'][2572];
    //print tpl::$_vars['lang_ref'][2448].".";
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "accept_friend_request" && isset($_REQUEST['user_id'])) {


    $objEmail = new mailer();

    $mail_subject = "Friend Request";

    $db = db::__d();

    $query = "select * from city_user cu LEFT JOIN user_all ua on ua.user_id = cu.user_id where ua.user_id =" . $_REQUEST['friend_id'];
    $res = $db->query($query);
    $friend_info = $db->format_data($res);

    $query = "select * from city_user cu LEFT JOIN user_all ua on ua.user_id = cu.user_id where ua.user_id =" . $_REQUEST['user_id'];
    $res = $db->query($query);
    $sender_info = $db->format_data($res);


    if ($_REQUEST['accept_term'] == '1') {
        $resutl = $soap->accept_user_request($_REQUEST['user_id'], $_REQUEST['friend_id']);


        $db = db::__d();
        $query = "select * from friend_list where user_id=" . $_REQUEST['friend_id'] . " AND friend_user_id=" . $_REQUEST['user_id'];
        $res = $db->query($query);
        $result = $db->format_data($res);
        $update_query = "UPDATE friend_list SET accept_status = 'y' where fl_id = " . $result[0]['fl_id'];
        $db->query($update_query);

        $insert_query = "INSERT INTO friend_list (user_id,friend_user_id,accept_status,accepted_id) VALUES('" . $_REQUEST['user_id'] . "','" . $_REQUEST['friend_id'] . "','y','" . $result[0]['fl_id'] . "')";
        $insert_res = $db->query($insert_query);

        print_r($resutl);


        $mail_subject = "Friend request Accept from " . $sender_info[0]['first_name'] . " " . $sender_info[0]['last_name'];
        $mail_contents = "Hello " . $friend_info[0]['first_name'] . " " . $friend_info[0]['last_name'] . ",<br/>";
        $mail_contents.= "Accept your request";

        $objEmail->AddUser($friend_info[0]['user_email']);         // Mail To
        $objEmail->SetFrom($sender_info[0]['user_email']);        //Mail From

        $content = $mail_contents;

        $objEmail->SetHtml();
        $objEmail->SetSubject($mail_subject);
        $objEmail->SetContent($content);
        $objEmail->Send();
        print tpl::$_vars['lang_ref'][2176];
    }
    if ($_REQUEST['accept_term'] == '2') {

        $db = db::__d();
        $query = "DELETE FROM friend_list WHERE user_id=" . $_REQUEST['friend_id'] . " AND friend_user_id=" . $_REQUEST['user_id'];
        $res = $db->query($query);
        $return_resu = $db->format_data($res);


        //print_r($return_resu);
        $mail_subject = "Friend request Reject from " . $sender_info[0]['first_name'] . " " . $sender_info[0]['last_name'];
        $mail_contents = "Hello " . $friend_info[0]['first_name'] . " " . $friend_info[0]['last_name'] . ",<br/>";
        $mail_contents .= "Reject your request";

        $objEmail->AddUser($friend_info[0]['user_email']);         // Mail To
        $objEmail->SetFrom($sender_info[0]['user_email']);        //Mail From
        // Mail Content / Body Part
        $content = $mail_contents;

        $objEmail->SetHtml();
        $objEmail->SetSubject($mail_subject);
        $objEmail->SetContent($content);
        $objEmail->Send();
        print tpl::$_vars['lang_ref'][2177];
    }
}



if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_abuse" && isset($_REQUEST['user_id'])) {

    require_once "soapclient.inc.php";
    $soap->add_abuse($_REQUEST['classified_id'], $_REQUEST['user_id'], $_REQUEST['classified_type']);

    print "Classified report to abuse.";
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_favourite" && isset($_REQUEST['user_id'])) {

    require_once "soapclient.inc.php";
    $soap->add_favourite($_REQUEST['classified_id'], $_REQUEST['user_id'], $_REQUEST['classified_type']);

    print tpl::$_vars['lang_ref'][2448];
}


if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_favourite_shop" && isset($_REQUEST['user_id'])) {

    //require_once "soapclient.inc.php";
    //$soap->add_favourite($_REQUEST['classified_id'],$_REQUEST['user_id'],$_REQUEST['classified_type']);

    $db = db::__d();

    $query = "SELECT * FROM myshop_favourite WHERE myshop_id = '" . $_REQUEST['classified_id'] . "' AND user_id = '" . $_REQUEST['user_id'] . "'";
    $res = $db->query($query);
    $shop_dtl = $db->format_data($res);

    if (empty($shop_dtl)) {
        $FieldArray = array("myshop_id" => $_REQUEST['classified_id'],
            "user_id" => $_REQUEST['user_id'],
            "date" => date('y-m-d'),
            "shop_type" => $_REQUEST['classified_type']
        );
        $db->insert_query("myshop_favourite", $FieldArray);
        $abuse_id = mysql_insert_id();
    }
    print '';
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "remove_favourite_shop" && isset($_REQUEST['user_id'])) {

    $db = db::__d();
    $res = $db->delete_query("myshop_favourite", " myshop_id = '" . $_REQUEST['classified_id'] . "' AND user_id = '" . $_REQUEST['user_id'] . "'");
    print tpl::$_vars['lang_ref'][3255];
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "remove_favourite_car" && isset($_REQUEST['user_id'])) {

    $db = db::__d();
    $res = $db->delete_query("classified_favourite", " classified_id = '" . $_REQUEST['classified_id'] . "' AND user_id = '" . $_REQUEST['user_id'] . "'");
    print "Car Remove from favourite successfully";
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "accept_friend" && isset($_REQUEST['user_id'])) {
    require_once "soapclient.inc.php";

    $objEmail = new mailer();

    $mail_subject = "Friend Request";

    $friend_info = $soap->send_to_friend_request($_REQUEST['friend_id']);
    $sender_info = $soap->sender_user_info($_REQUEST['user_id']);

    if ($_REQUEST['accept_term'] == '1') {
        $resutl = $soap->accept_user_request($_REQUEST['user_id'], $_REQUEST['friend_id']);
        print_r($resutl);
        $mail_subject = "Friend request Accept from " . $sender_info[0]['first_name'] . " " . $sender_info[0]['last_name'];
        $mail_contents = "Hello " . $friend_info[0]['first_name'] . " " . $friend_info[0]['last_name'] . ",<br/>";
        $mail_contents .= "Accept your request";

        $objEmail->AddUser($friend_info[0]['user_email']);         // Mail To
        $objEmail->SetFrom($sender_info[0]['user_email']);        //Mail From

        $content = $mail_contents;

        $objEmail->SetHtml();
        $objEmail->SetSubject($mail_subject);
        $objEmail->SetContent($content);
        $objEmail->Send();
        print tpl::$_vars['lang_ref'][2176];
    }
    if ($_REQUEST['accept_term'] == '2') {
        $return_resu = $soap->reject_user_request($_REQUEST['user_id'], $_REQUEST['friend_id']);
        //print_r($return_resu);
        $mail_subject = "Friend request Reject from " . $sender_info[0]['first_name'] . " " . $sender_info[0]['last_name'];
        $mail_contents = "Hello " . $friend_info[0]['first_name'] . " " . $friend_info[0]['last_name'] . ",<br/>";
        $mail_contents .= "Reject your request";

        $objEmail->AddUser($friend_info[0]['user_email']);         // Mail To
        $objEmail->SetFrom($sender_info[0]['user_email']);        //Mail From
        // Mail Content / Body Part
        $content = $mail_contents;

        $objEmail->SetHtml();
        $objEmail->SetSubject($mail_subject);
        $objEmail->SetContent($content);
        $objEmail->Send();
        print tpl::$_vars['lang_ref'][2177];
    }
}

if (isset($_REQUEST['page']) && $_REQUEST['page_type'] == "video_comment") {
    require_once "soapclient.inc.php";

    $video_id = $_REQUEST['video_id'];
    //set extra_vars for pagging
    $extra_vars = "&video_id=" . $video_id;
    if (isset($_GET['page'])) {
        $extra_vars.="&page=" . $_GET['page'];
    }


    //get videos related comments section start

    $comment_pagging = new pagging($_REQUEST['rpp']);
    //get comment query
    $comment_query = "SELECT cuvc.*,DATE_FORMAT(cuvc.cuvc_added_date,'%d.%m.%Y') AS added_date,cu.user_name,cu.user_id,cup.image FROM city_user_videos_comments cuvc LEFT JOIN user_all ua ON ua.user_id=cuvc.cuvc_u_id LEFT JOIN city_user cu ON cu.user_id=ua.user_id LEFT JOIN city_user_photo cup ON cup.user_id = cu.user_id WHERE cuvc.cuvc_v_id = " . $_REQUEST['video_id'] . " AND cuvc.cuvc_status='1'";

    $db = db::__d();
    $obj_pagging = $comment_pagging;
    $current_page = $_REQUEST['page'];
    $obj_pagging->CurrentPage = $current_page;
    $pagging_array = $obj_pagging->nfoArray();

    $limit = "  limit " . $pagging_array["MYSQL_LIMIT1"] . "," . $pagging_array["MYSQL_LIMIT2"];
    $res = $db->query($comment_query . $limit);
    $list_array = $db->format_data($res);

    if (count($exp_array) > 0) {
        foreach ($list_array as $key => $value) {
            foreach ($exp_array as $field_name) {
                $list_array[$key][$field_name] = explode("\r\n", $list_array[$key][$field_name]);
            }
        }
    }

    $video_comment_arrray = $list_array;

    #print $comment_query;
    //$video_comment_arrray = $soap->GetVideosComments($comment_query,$comment_pagging,$_REQUEST['pagging_number']);
    $total_video_comments = $soap->get_total_rows($comment_query);
    $comment_pagging->TotalResults = $total_video_comments;
    $responser_str = '';
    $responser_str.= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
     <div class="sr_bx toppad">
          <!--pagging area start-->
          <div class="page-lt"></div>
          <div class="page-mid" style="width:638px;">
            <!--page mid start-->
            <div class="show">' . $comment_pagging->customize_showing() . '</div>
            <div class="pagging" >' . $comment_pagging->customize_page_number('disabled', 'current', '', $extra_vars) . '</div>
            <div class="record">View per page </div>
            <div class="sr_bx" style="padding:3px 0px 0px 5px;">
              <select name="select2" id="select2" onchange="javascript:limitbox(this.value);">';
    for ($i = 1; $i <= 5; $i++) {
        $j = $i * 10;
        if ($_REQUEST['rpp'] == $j) {
            $responser_str.='<option selected="selected" value="' . $j . '">' . $j . '</option>';
        } else {
            $responser_str.='<option value="' . $j . '">' . $j . '</option>';
        }
    }
    $responser_str.='</select>
            </div>
            <!--page mid end-->
          </div>
          <div class="page-rt"></div>
          <!--pagging area end-->
        </div>
        </td></tr>
        <tr><td>&nbsp;</td></tr>';
    $i = 0;
    foreach ($video_comment_arrray as $video_comment_list) {
        $css_class = ($i % 2 == 0) ? "altbg" : "nbg";
        $responser_str.='<tr><td class="' . $css_class . '" valign="top"><table align="center" width="100%" cellpadding="5" cellspacing="0" border="0"><tr>';

        if (file_exists(_PATH . "media/upload/user_images/" . $video_comment_list['image']) && $video_comment_list['image'] != '') {
            $responser_str.='<td><a target="_blank" href="' . _COMPANY_URL . 'private_member_profile?user_id=' . $video_comment_list['user_id'] . '"><img src="' . _MEDIA_BASE_URL . 'upload/user_images/' . $video_comment_list['image'] . '" class="midimg_bdr" width="60" height="60"></a></td>';
        } else {
            $responser_str.='<td><a target="_blank" href="' . _COMPANY_URL . 'private_member_profile?user_id=' . $video_comment_list['user_id'] . '"><img src="' . getNoimage($_SESSION['lid'], 60, 60, "image_boy") . '"   class="midimg_bdr" ></a></td>';
        }


        $responser_str.='<td width="10%">'; //tpl::$_vars['lang_ref'][1278] :: added by
        if ($video_comment_list['user_id'] == $_SESSION['user_id']) {
            $responser_str.='<a href="' . _U . 'pirvate_member_profile" class="member_name"><b>' . $video_comment_list['user_name'] . '</b></a>';
        } else {
            $responser_str.='<a href="' . _U . 'pirvate_member_profile?user_id=' . $video_comment_list['user_id'] . '" class="member_name">' . $video_comment_list['user_name'] . '</a>';
        }
        $responser_str.='<br />' . tpl::$_vars['lang_ref'][1277] . ':&nbsp;' . $video_comment_list['added_date'];
        $responser_str.='</td>';

        $responser_str.='<td width="80%">' . nl2br($video_comment_list['cuvc_text']) . '</td>';

        if ($_SESSION['user_id'] == $video_comment_list['cuvc_u_id']) {
            $responser_str.='
                        <td width="4%">
                            <a href="#" onclick="javascript:VideoCommentDelete(' . $video_comment_list['cuvc_id'] . ',' . $_REQUEST['video_id'] . ');return false;">' . tpl::$_vars['lang_ref'][12] . '</a>
                        </td>
                    ';
        }

        $responser_str.='</tr></table></td>
        </tr>';
        $i++;
    }


    print $responser_str;
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_video_comment") {
    require_once "soapclient.inc.php";

    $video_id = $_REQUEST['video_id'];
    //set extra_vars for pagging
    $extra_vars = "&video_id=" . $video_id;
    if (isset($_GET['page'])) {
        $extra_vars.="&page=" . $_GET['page'];
    }


    $comment_add_flag = false;
    $insert_video_comment_array = array(
        "cuvc_v_id" => $_REQUEST['video_id'],
        "cuvc_u_id" => $_REQUEST['commenter_id'],
        "cuvc_text" => htmlspecialchars($_REQUEST['comment_text']),
        "cuvc_added_date" => date("Y-m-d h:i:s"),
        "cuvc_status" => 1
    );
    $comment_add_flag = $soap->AddVideoComment($insert_video_comment_array);
    //increment activity point of city user
    $soap->ManageCityUserActivityPoint($_SESSION['user_id']);
    //get videos related comments section start
    $comment_pagging = new pagging($_REQUEST['rpp']);
    //get comment query
    $comment_query = "SELECT cuvc.*,DATE_FORMAT(cuvc.cuvc_added_date,'%d.%m.%Y') AS added_date,cu.user_name,cu.user_id,cup.image FROM city_user_videos_comments cuvc LEFT JOIN user_all ua ON ua.user_id=cuvc.cuvc_u_id LEFT JOIN city_user cu ON cu.user_id=ua.user_id LEFT JOIN city_user_photo cup ON cup.user_id = cu.user_id WHERE cuvc.cuvc_v_id = " . $_REQUEST['video_id'] . " AND cuvc.cuvc_status='1'";

    $db = db::__d();
    $obj_pagging = $comment_pagging;
    $current_page = $_REQUEST['pagging_number'];
    $obj_pagging->CurrentPage = $current_page;
    $pagging_array = $obj_pagging->nfoArray();

    $limit = "  limit " . $pagging_array["MYSQL_LIMIT1"] . "," . $pagging_array["MYSQL_LIMIT2"];
    $res = $db->query($comment_query . $limit);
    $list_array = $db->format_data($res);

    if (count($exp_array) > 0) {
        foreach ($list_array as $key => $value) {
            foreach ($exp_array as $field_name) {
                $list_array[$key][$field_name] = explode("\r\n", $list_array[$key][$field_name]);
            }
        }
    }

    $video_comment_arrray = $list_array;  #print $comment_query;
    //$video_comment_arrray = $soap->GetVideosComments($comment_query,$comment_pagging,$_REQUEST['pagging_number']);

    $total_video_comments = $soap->get_total_rows($comment_query);
    $comment_pagging->TotalResults = $total_video_comments;
    $responser_str = '';
    $responser_str.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
     <div class="sr_bx toppad">
          <!--pagging area start-->
          <div class="page-lt"></div>
          <div class="page-mid" style="width:638px;">
            <!--page mid start-->
            <div class="show">' . $comment_pagging->customize_showing() . '</div>
            <div class="pagging">' . $comment_pagging->customize_page_number('disabled', 'current', '', $extra_vars) . '</div>
            <div class="record">View per page </div>
            <div class="sr_bx" style="padding:3px 0px 0px 5px;">
              <select name="select2" id="select2" onchange="javascript:limitbox(this.value);">';
    for ($i = 1; $i <= 5; $i++) {
        $j = $i * 10;
        if ($_REQUEST['rpp'] == $j) {
            $responser_str.='<option selected="selected" value="' . $j . '">' . $j . '</option>';
        } else {
            $responser_str.='<option value="' . $j . '">' . $j . '</option>';
        }
    }
    $responser_str.='</select>
            </div>
            <!--page mid end-->
          </div>
          <div class="page-rt"></div>
          <!--pagging area end-->
        </div>
        </td></tr>
        <tr><td>&nbsp;</td></tr>';
    $i = 0;
    foreach ($video_comment_arrray as $video_comment_list) {
        $css_class = ($i % 2 == 0) ? "altbg" : "nbg";
        $responser_str.='<tr><td class="' . $css_class . '" valign="top"><table align="center" width="100%" cellpadding="5" cellspacing="0" border="0"><tr>';

        if (file_exists(_PATH . "media/upload/user_images/" . $video_comment_list['image']) && $video_comment_list['image'] != '') {
            $responser_str.='<td><a target="_blank" href="' . _COMPANY_URL . 'private_member_profile?user_id=' . $video_comment_list['user_id'] . '"><img src="' . _MEDIA_BASE_URL . 'upload/user_images/' . $video_comment_list['image'] . '" class="midimg_bdr" width="60" height="60"></a></td>';
        } else {
            $responser_str.='<td><a target="_blank" href="' . _COMPANY_URL . 'private_member_profile?user_id=' . $video_comment_list['user_id'] . '"><img src="' . getNoimage($_SESSION['lid'], 60, 60, "image_boy") . '"   class="midimg_bdr" ></a></td>';
        }


        $responser_str.='<td width="10%">'; //tpl::$_vars['lang_ref'][1278] :: added by
        if ($video_comment_list['user_id'] == $_SESSION['user_id']) {
            $responser_str.='<a href="' . _U . 'pirvate_member_profile" class="member_name"><b>' . $video_comment_list['user_name'] . '</b></a>';
        } else {
            $responser_str.='<a href="' . _U . 'pirvate_member_profile?user_id=' . $video_comment_list['user_id'] . '" class="member_name">' . $video_comment_list['user_name'] . '</a>';
        }
        $responser_str.='<br />' . tpl::$_vars['lang_ref'][1277] . ':&nbsp;' . $video_comment_list['added_date'];
        $responser_str.='</td>';

        $responser_str.='<td width="80%">' . nl2br($video_comment_list['cuvc_text']) . '</td>';

        if ($_SESSION['user_id'] == $video_comment_list['cuvc_u_id']) {
            $responser_str.='
                        <td width="4%">
                            <a href="#" onclick="javascript:VideoCommentDelete(' . $video_comment_list['cuvc_id'] . ',' . $_REQUEST['video_id'] . ');return false;">' . tpl::$_vars['lang_ref'][12] . '</a>
                        </td>
                    ';
        }

        $responser_str.='</tr></table></td>
        </tr>';
        $i++;
    }


    print $responser_str;
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "delete_video_comment") {
    require_once "soapclient.inc.php";
    $comment_add_flag = $soap->DeleteVideoComment($_REQUEST['comment_id'], $_REQUEST['video_id']);
    //get videos related comments section start
    $comment_pagging = new pagging($_REQUEST['rpp']);
    //get comment query
    $comment_query = "SELECT cuvc.*,DATE_FORMAT(cuvc.cuvc_added_date,'%d.%m.%Y') AS added_date,cu.user_name,cu.user_id,cup.image FROM city_user_videos_comments cuvc LEFT JOIN user_all ua ON ua.user_id=cuvc.cuvc_u_id LEFT JOIN city_user cu ON cu.user_id=ua.user_id LEFT JOIN city_user_photo cup ON cup.user_id = cu.user_id WHERE cuvc.cuvc_v_id = " . $_REQUEST['video_id'] . " AND cuvc.cuvc_status='1'";

    $db = db::__d();
    $obj_pagging = $comment_pagging;
    $current_page = $_REQUEST['pagging_number'];
    $obj_pagging->CurrentPage = $current_page;
    $pagging_array = $obj_pagging->nfoArray();

    $limit = "  limit " . $pagging_array["MYSQL_LIMIT1"] . "," . $pagging_array["MYSQL_LIMIT2"];
    $res = $db->query($comment_query . $limit);
    $list_array = $db->format_data($res);

    if (count($exp_array) > 0) {
        foreach ($list_array as $key => $value) {
            foreach ($exp_array as $field_name) {
                $list_array[$key][$field_name] = explode("\r\n", $list_array[$key][$field_name]);
            }
        }
    }

    $video_comment_arrray = $list_array;  #print $comment_query;
    //$video_comment_arrray = $soap->GetVideosComments($comment_query,$comment_pagging,$_REQUEST['pagging_number']);
    $total_video_comments = $soap->get_total_rows($comment_query);
    $comment_pagging->TotalResults = $total_video_comments;
    $responser_str = '';
    $responser_str.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
     <div class="sr_bx toppad">
          <!--pagging area start-->
          <div class="page-lt"></div>
          <div class="page-mid" style="width:638px;">
            <!--page mid start-->
            <div class="show">' . $comment_pagging->customize_showing() . '</div>
            <div class="pagging">' . $comment_pagging->customize_page_number('disabled', 'current', '', $extra_vars) . '</div>
            <div class="record">View per page </div>
            <div class="sr_bx" style="padding:3px 0px 0px 5px;">
              <select name="select2" id="select2" onchange="javascript:limitbox(this.value);">';
    for ($i = 1; $i <= 5; $i++) {
        $j = $i * 10;
        if ($_REQUEST['rpp'] == $j) {
            $responser_str.='<option selected="selected" value="' . $j . '">' . $j . '</option>';
        } else {
            $responser_str.='<option value="' . $j . '">' . $j . '</option>';
        }
    }
    $responser_str.='</select>
            </div>
            <!--page mid end-->
          </div>
          <div class="page-rt"></div>
          <!--pagging area end-->
        </div>
        </td></tr>
        <tr><td>&nbsp;</td></tr>';
    $i = 0;
    foreach ($video_comment_arrray as $video_comment_list) {
        $css_class = ($i % 2 == 0) ? "altbg" : "nbg";
        $responser_str.='<tr><td class="' . $css_class . '" valign="top"><table align="center" width="100%" cellpadding="5" cellspacing="0" border="0"><tr>';

        if (file_exists(_PATH . "media/upload/user_images/" . $video_comment_list['image']) && $video_comment_list['image'] != '') {
            $responser_str.='<td><a target="_blank" href="' . _COMPANY_URL . 'private_member_profile?user_id=' . $video_comment_list['user_id'] . '"><img src="' . _MEDIA_BASE_URL . 'upload/user_images/' . $video_comment_list['image'] . '" class="midimg_bdr" width="60" height="60"></a></td>';
        } else {
            $responser_str.='<td><a target="_blank" href="' . _COMPANY_URL . 'private_member_profile?user_id=' . $video_comment_list['user_id'] . '"><img src="' . getNoimage($_SESSION['lid'], 60, 60, "image_boy") . '"   class="midimg_bdr" ></a></td>';
        }


        $responser_str.='<td width="10%">'; //tpl::$_vars['lang_ref'][1278] :: added by
        if ($video_comment_list['user_id'] == $_SESSION['user_id']) {
            $responser_str.='<a href="' . _U . 'pirvate_member_profile" class="member_name"><b>' . $video_comment_list['user_name'] . '</b></a>';
        } else {
            $responser_str.='<a href="' . _U . 'pirvate_member_profile?user_id=' . $video_comment_list['user_id'] . '" class="member_name">' . $video_comment_list['user_name'] . '</a>';
        }
        $responser_str.='<br />' . tpl::$_vars['lang_ref'][1277] . ':&nbsp;' . $video_comment_list['added_date'];
        $responser_str.='</td>';

        $responser_str.='<td width="80%">' . nl2br($video_comment_list['cuvc_text']) . '</td>';

        if ($_SESSION['user_id'] == $video_comment_list['cuvc_u_id']) {
            $responser_str.='
                        <td width="4%">
                            <a href="#" onclick="javascript:VideoCommentDelete(' . $video_comment_list['cuvc_id'] . ',' . $_REQUEST['video_id'] . ');return false;">' . tpl::$_vars['lang_ref'][12] . '</a>
                        </td>
                    ';
        }

        $responser_str.='</tr></table></td>
        </tr>';
        $i++;
    }


    print $responser_str;
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "share_video") {
    require_once "soapclient.inc.php";
    $share_obj_mail = new mailer();
    //$share_video_mail_subject=$_REQUEST['from']." want to share video of adlino";
    $mail_subject_array = array("from_name" => $_REQUEST['from'], "content_type" => tpl::$_vars['lang_ref'][755]);
    $share_video_mail = GetLanguageSpecificMailSubject(4, $_SESSION['lid'], $mail_subject_array);
    $mail_sent_to_array = explode(";", $_REQUEST['to']);
    $mail_subscribe_list = '';
    foreach ($mail_sent_to_array as $mail_sent_list) {
        if (!empty($mail_sent_list)) {
            $share_obj_mail->AddUser($mail_sent_list);
        }
    }
    $mail_content_value = array("from_name" => $_REQUEST['from'], "content_type" => tpl::$_vars['lang_ref'][755], "url" => _U . "view_user_video?video_id=" . $_REQUEST['video_id']);
    //$share_video_mail_content = $soap->GetLanguageSpecificMailBody(4,$_SESSION['lid'],$mail_content_value);
    //$share_video_mail_content="Hi,<br/>".$_REQUEST['from']." want to share video of adlino.so please view it by click on below link.<br><br><a href='"._U."view_user_video?video_id=".$_REQUEST['video_id']."'>"._U."view_user_video?video_id=".$_REQUEST['video_id']."<a><br><br>Thanks,<br>Adlino Team.";
    $share_obj_mail->SetFrom($_REQUEST['from']);        //Mail From
    $share_obj_mail->SetHtml();
    $share_obj_mail->SetSubject($share_video_mail[0]);
    $share_obj_mail->SetContent($share_video_mail[1]);
    $a = $share_obj_mail->Send();
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "fav_og") {
    $_db = db::__d();
    $movie_id = mysql_real_escape_string($_REQUEST['movie_id']);
    $data = q("select * from city_user_og_favourite where cumf_mv_id= '{$movie_id}' and cumf_u_id = '{$_SESSION['user_id']}' ");
    if (empty($data)) {
        $_db->insert_query("city_user_og_favourite", array("cumf_mv_id" => $movie_id, "cumf_u_id" => $_SESSION['user_id']));
    }
    print tpl::$_vars['lang_ref'][4175] . "";
    die;
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "fav_og_remove") {
    $_db = db::__d();
    $movie_id = mysql_real_escape_string($_REQUEST['movie_id']);
    $_db->delete_query("city_user_og_favourite", " cumf_mv_id = '{$movie_id}' AND cumf_u_id = '{$_SESSION['user_id']}'");
    print tpl::$_vars['lang_ref'][4176] . "";
    $aid = mysql_real_escape_string($_REQUEST['aid']);
    if ($aid != '') {
        $_db->query("delete from city_user_album_entries where cuae_cua_id = '{$aid}' and cuae_cid = '{$movie_id}' ");
    } else {
        $query = "delete from city_user_album_entries where  cuae_user_id = '{$_SESSION['user_id']}' and cuae_content_type = 'og' and cuae_cid = '{$movie_id}' ";
        $_db->query($query);
    }

    die;
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "fav_movie") {
    $_db = db::__d();
    $movie_id = mysql_real_escape_string($_REQUEST['movie_id']);
    $data = q("select * from city_user_movies_favourite where cumf_mv_id= '{$movie_id}' and cumf_u_id = '{$_SESSION['user_id']}' ");
    if (empty($data)) {
        $_db->insert_query("city_user_movies_favourite", array("cumf_mv_id" => $movie_id, "cumf_u_id" => $_SESSION['user_id']));
    }
    print tpl::$_vars['lang_ref'][4171] . "";
    die;
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "fav_movie_remove") {
    $_db = db::__d();
    $movie_id = mysql_real_escape_string($_REQUEST['movie_id']);
    $aid = mysql_real_escape_string($_REQUEST['aid']);

    if ($aid != '') {
        $_db->query("delete from city_user_album_entries where cuae_cua_id = '{$aid}' and cuae_cid = '{$movie_id}' ");
    } else {
        $query = "delete from city_user_album_entries where  cuae_user_id = '{$_SESSION['user_id']}' and cuae_content_type = 'cm' and cuae_cid = '{$movie_id}' ";
        $_db->query($query);
    }

    $_db->delete_query("city_user_movies_favourite", " cumf_mv_id = '{$movie_id}' AND cumf_u_id = '{$_SESSION['user_id']}'");
    print tpl::$_vars['lang_ref'][4172] . "";
    die;
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "fav_musicnews_remove") {
    $_db = db::__d();
    $movie_id = mysql_real_escape_string($_REQUEST['movie_id']);
    $aid = mysql_real_escape_string($_REQUEST['aid']);
    
    if ($aid != '') {
        $_db->query("delete from city_user_album_entries where cuae_cua_id = '{$aid}' and cuae_cid = '{$movie_id}' ");
    } else {
        $query = "delete from city_user_album_entries where  cuae_user_id = '{$_SESSION['user_id']}' and cuae_content_type = 'musicnews' and cuae_cid = '{$movie_id}' ";
        $_db->query($query);
    }

    $_db->delete_query("favorite_content", " fc_content_id = '{$movie_id}_musicnews' AND fc_user_id = '{$_SESSION['user_id']}'");
    print tpl::$_vars['lang_ref'][4172] . "";
    die;
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "fav_video_remove") {

    $_db = db::__d();

    $cid = mysql_real_escape_string($_REQUEST['video_id']);
    $uid = q("select * from city_user_videos where cuv_id = '{$cid}' ");

    $aid = mysql_real_escape_string($_REQUEST['aid']);
    if ($aid != '') {
        $_db->query("delete from city_user_album_entries where cuae_cua_id = '{$aid}' and cuae_cid = '{$cid}' ");
    } else {
        $query = "delete from city_user_album_entries where  cuae_user_id = '{$_SESSION['user_id']}' and cuae_content_type = 'v' and cuae_cid = '{$cid}' ";
        $_db->query($query);
    }

//    if ($uid[0]['cuv_user_id'] == $_SESSION['user_id']) {
//        print tpl::$_vars['lang_ref'][1266];
//        die;
//    }

    require_once "soapclient.inc.php";

    $query = "select cufv_id from city_user_favourite_video where cufv_v_id = '{$_REQUEST['video_id']}' AND cufv_u_id = '{$_REQUEST['user_id']}' ";
    $fav_id = q($query);
    if (!empty($fav_id))
        $soap->DeleteFavouriteVideo($fav_id[0]['cufv_id']);
    print tpl::$_vars['lang_ref'][2077];
    die;
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "fav_video") {


    $cid = mysql_real_escape_string($_REQUEST['video_id']);
    $uid = q("select * from city_user_videos where cuv_id = '{$cid}' ");
    if ($uid[0]['cuv_user_id'] == $_SESSION['user_id']) {
        print "E!" . tpl::$_vars['lang_ref'][1266];
        die;
    }

    require_once "soapclient.inc.php";
    $fav_flag = $soap->addtofavouritevideo($_REQUEST['video_id'], $_REQUEST['user_id']);
    if ($fav_flag) {
        //increment activity point of city user
        $soap->ManageCityUserActivityPoint($_SESSION['user_id']);
        print tpl::$_vars['lang_ref'][1279];
    } else {
        print tpl::$_vars['lang_ref'][1280];
    }
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "rate_video") {
    //require_once "soapclient.inc.php";

    $video_id = $_REQUEST['video_id'];
    $user_id = $_REQUEST['user_id'];
    $rate = $_REQUEST['rate'];

    $db = db::__d();

    $IsRatingExists = $db->get_record_count_simple_query("SELECT * FROM city_user_video_rating WHERE user_id=$user_id AND cuv_id=$video_id");
    if ($IsRatingExists == 0) {
        $ratinginsertdata = array(
            "cuv_id" => $video_id,
            "user_id" => $user_id,
            "user_rate" => $rate,
            "rate_date" => date("Y-m-d h:i:s")
        );
        $db->insert_query("city_user_video_rating", $ratinginsertdata);

        $VideoRatingData = $db->select_query("city_user_videos", "*", "cuv_id=$video_id");
        $video_rate = $VideoRatingData[0]['cuv_rate'];
        $ratedby = $VideoRatingData[0]['cuv_ratedby'];
        $value = $rateby == 0 ? 0 : number_format(round($video_rate / $ratedby, 1), 1, '.', '');

        $video_rate = $value + $rate;
        $ratedby = $ratedby + 1;
        $new_rate = number_format(round($video_rate / $ratedby, 1), 1, '.', '');


        //$rates    = @explode(",",$new_rate);
        $sql = "UPDATE city_user_videos SET cuv_rate = " . $new_rate . ", cuv_ratedby=cuv_ratedby+1 WHERE cuv_id = " . $video_id;
        $db->query($sql);

        $db->query("UPDATE city_user SET activity_point=activity_point+1 WHERE user_id=$user_id");
        print tpl::$_vars['lang_ref'][1281];
    } else {
        print tpl::$_vars['lang_ref'][1282];
    }
}

if (isset($_REQUEST['op']) && $_REQUEST['op'] == "check") {

    $field_name = $_REQUEST['field_name'];
    $value = $_REQUEST['value'];
    $dbtable = $_REQUEST['dbtable'];
    require_once "soapclient.inc.php";
    $check_field_exist = $soap->CheckDataExistorNot($field_name, $dbtable, $value);
    if ($check_field_exist == '0') {
        echo "Error";
    }
}

/*
 * Need to make new function to check the city_user.user_name and private_user_theme. 
 */
/* if(isset($_REQUEST['op']) && $_REQUEST['op'] == "checksitename"){

  $db = db::__d();
  $value = $_REQUEST['value'];
  $query = "SELECT c.id FROM city_user c WHERE c.user_name LIKE '$value' UNION SELECT pv.id FROM private_user_theme pv WHERE pv.website_name LIKE '$value'";
  $db->get_record_count_simple_query($query);
  if($db->get_record_count_simple_query($query) > '0')
  {
  echo "Error";
  }
  } */

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "rate_picture") {
    require_once "soapclient.inc.php";
    //$flag_rate=$soap->ApplyUsersPictureRatings($_REQUEST['picture_id'],$_REQUEST['user_id'],$_REQUEST['rate']);

    $picture_id = $_REQUEST['picture_id'];
    $user_id = $_REQUEST['user_id'];
    $rate = $_REQUEST['rate'];


    $db = db::__d();
    $IsRatingExists = $db->get_record_count_simple_query("SELECT * FROM city_user_picture_rating WHERE user_id=$user_id AND cup_id=$picture_id");
    if ($IsRatingExists == 0) {
        $ratinginsertdata = array(
            "cup_id" => $picture_id,
            "user_id" => $user_id,
            "user_rate" => $rate,
            "rate_date" => date("Y-m-d h:i:s")
        );
        $db->insert_query("city_user_picture_rating", $ratinginsertdata);
        $PictureRatingData = $db->select_query("city_user_pictures", "*", "cup_id=$picture_id");
        $picture_rate = $PictureRatingData[0]['cup_rate'];
        $ratedby = $PictureRatingData[0]['cup_ratedby'];
        $value = round($picture_rate * $ratedby, 1);
        $picture_rate = $value + $rate;
        $ratedby = $ratedby + 1;
        $new_rate = round($picture_rate / $ratedby, 1);

        $pos = strpos($new_rate, ",");
        if ($pos != "") {
            $rates = explode(",", $new_rate);
            $new_rate = $rates[0];
        }

        $sql = "UPDATE city_user_pictures SET cup_rate = " . $new_rate . ", cup_ratedby=cup_ratedby+1 WHERE cup_id = " . $picture_id;
        $db->query($sql);

        $db->query("UPDATE city_user SET activity_point=activity_point+1 WHERE user_id=$user_id");

        $flag_rate = true;
    } else {
        $flag_rate = false;
    }

    if ($flag_rate) {
        //increment activity point of city user
        $soap->ManageCityUserActivityPoint($_SESSION['user_id']);
        print tpl::$_vars['lang_ref'][1281];
    } else {
        print tpl::$_vars['lang_ref'][1283];
    }
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "share_picture") {
    require_once "soapclient.inc.php";
    $share_obj_mail = new mailer();
    //$share_picture_mail_subject=$_REQUEST['from']." want to share picture of adlino";
    $mail_subject_array = array("from_name" => $_REQUEST['from'], "content_type" => tpl::$_vars['lang_ref'][892]);
    $share_picture_mail_subject = GetLanguageSpecificMailSubject(4, $_SESSION['lid'], $mail_subject_array);
    $mail_sent_to_array = explode(";", $_REQUEST['to']);
    $mail_subscribe_list = '';
    foreach ($mail_sent_to_array as $mail_sent_list) {
        if (!empty($mail_sent_list)) {
            $share_obj_mail->AddUser($mail_sent_list);
        }
    }
    $mail_content_value = array("from_name" => $_REQUEST['from'], "content_type" => tpl::$_vars['lang_ref'][892], "url" => _U . "view_user_picture?picture_id=" . $_REQUEST['picture_id']);
    //$share_picture_mail_content = $soap->GetLanguageSpecificMailBody(4,$_SESSION['lid'],$mail_content_value);
    //$share_picture_mail_content="Hi,<br/>".$_REQUEST['from']." want to share picture of adlino.so please view it by click on below link.<br><br><a href='"._U."view_user_picture?picture_id=".$_REQUEST['picture_id']."'>"._U."view_user_picture?picture_id=".$_REQUEST['picture_id']."<a><br><br>Thanks,<br>Adlino Team.";
    $share_obj_mail->SetFrom($_REQUEST['from']);        //Mail From
    $share_obj_mail->SetHtml();
    $share_obj_mail->SetSubject($share_picture_mail_subject[0]);
    $share_obj_mail->SetContent($share_picture_mail_subject[1]);
    $a = $share_obj_mail->Send();
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "fav_picture") {

    $cid = mysql_real_escape_string($_REQUEST['picture_id']);
    $uid = q("select * from city_user_pictures where cup_id = '{$cid}' ");
    if ($uid[0]['cup_user_id'] == $_SESSION['user_id']) {
        print "E!" . tpl::$_vars['lang_ref'][1270];
        die;
    }

    require_once "soapclient.inc.php";
    $fav_flag = $soap->addtofavouritepicture($_REQUEST['picture_id'], $_REQUEST['user_id']);
    if ($fav_flag) {
        //increment activity point of city user
        $soap->ManageCityUserActivityPoint($_SESSION['user_id']);
        print tpl::$_vars['lang_ref'][1284];
    } else {
        print tpl::$_vars['lang_ref'][2078];
    }
    $aid = mysql_real_escape_string($_REQUEST['aid']);
    if ($aid != '') {
        $_db->query("delete from city_user_album_entries where cuae_cua_id = '{$aid}' and cuae_cid = '{$cid}' ");
    } else {
        $query = "delete from city_user_album_entries where  cuae_user_id = '{$_SESSION['user_id']}' and cuae_content_type = 'p' and cuae_cid = '{$cid}' ";
        $_db->query($query);
    }
    die;
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "rate_ecard") {
    require_once "soapclient.inc.php";
    //$flag_rate=$soap->ApplyUsersEcardRatings($_REQUEST['ecard_id'],$_REQUEST['user_id'],$_REQUEST['rate']);

    $ecard_id = $_REQUEST['ecard_id'];
    $user_id = $_REQUEST['user_id'];
    $rate = $_REQUEST['rate'];

    $db = db::__d();
    $IsRatingExists = $db->get_record_count_simple_query("SELECT * FROM city_user_ecard_rating WHERE user_id=$user_id AND cuec_id=$ecard_id");
    if ($IsRatingExists == 0) {
        $ratinginsertdata = array(
            "cuec_id" => $ecard_id,
            "user_id" => $user_id,
            "user_rate" => $rate,
            "rate_date" => date("Y-m-d h:i:s")
        );
        $db->insert_query("city_user_ecard_rating", $ratinginsertdata);
        $EcardRatingData = $db->select_query("city_user_ecards", "*", "cuec_id=$ecard_id");
        $ecard_rate = $EcardRatingData[0]['cuec_rate'];
        $ratedby = $EcardRatingData[0]['cuec_ratedby'];
        $value = round($ecard_rate * $ratedby, 1);
        $ecard_rate = $value + $rate;
        $ratedby = $ratedby + 1;
        $new_rate = round($ecard_rate / $ratedby, 1);
        $pos = strpos($new_rate, ",");
        if ($pos != "") {
            $rates = explode(",", $new_rate);
            $new_rate = $rates[0];
        }
        $sql = "UPDATE city_user_ecards SET cuec_rate = " . $new_rate . ", cuec_ratedby=cuec_ratedby+1 WHERE cuec_id = " . $ecard_id;
        $db->query($sql);

        $db->query("UPDATE city_user SET activity_point=activity_point+1 WHERE user_id=$user_id");

        print tpl::$_vars['lang_ref'][1281];
    } else {
        print tpl::$_vars['lang_ref'][1286];
    }
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "share_ecard") {
    require_once "soapclient.inc.php";
    $share_obj_mail = new mailer();
    $mail_subject_array = array("from_name" => $_REQUEST['from'], "content_type" => tpl::$_vars['lang_ref'][903]);
    $share_ecard_mail_subject = GetLanguageSpecificMailSubject(4, $_SESSION['lid'], $mail_subject_array);
    //$share_ecard_mail_subject=$_REQUEST['from']." want to share Ecard of adlino";
    $mail_sent_to_array = explode(";", $_REQUEST['to']);
    $mail_subscribe_list = '';
    foreach ($mail_sent_to_array as $mail_sent_list) {
        if (!empty($mail_sent_list)) {
            $share_obj_mail->AddUser($mail_sent_list);
        }
    }
    //$share_ecard_mail_content="Hi,<br/>".$_REQUEST['from']." want to share ecard of adlino.so please view it by click on below link.<br><br><a href='"._U."view_user_ecard?ecard_id=".$_REQUEST['ecard_id']."'>"._U."view_user_ecard?ecard_id=".$_REQUEST['ecard_id']."<a><br><br>Thanks,<br>Adlino Team.";
    $mail_content_value = array("from_name" => $_REQUEST['from'], "content_type" => tpl::$_vars['lang_ref'][903], "url" => _U . "view_user_ecard?ecard_id=" . $_REQUEST['ecard_id']);
    //   $share_ecard_mail_content = $soap->GetLanguageSpecificMailBody(4,$_SESSION['lid'],$mail_content_value);
    $share_obj_mail->SetFrom($_REQUEST['from']);        //Mail From
    $share_obj_mail->SetHtml();
    $share_obj_mail->SetSubject($share_ecard_mail_subject[0]);
    $share_obj_mail->SetContent($share_ecard_mail_subject[1]);
    $a = $share_obj_mail->Send();
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "fav_ecard") {

    $cid = mysql_real_escape_string($_REQUEST['ecard_id']);
    $uid = q("select * from city_user_ecards where cuec_id = '{$cid}' ");
    if ($uid[0]['cuec_user_id'] == $_SESSION['user_id']) {
        print "E!" . tpl::$_vars['lang_ref'][1273];
        die;
    }

    require_once "soapclient.inc.php";
    $fav_flag = $soap->addtofavouriteecard($_REQUEST['ecard_id'], $_REQUEST['user_id']);
    if ($fav_flag) {
        //increment activity point of city user
        $soap->ManageCityUserActivityPoint($_SESSION['user_id']);
        print tpl::$_vars['lang_ref'][1287];
    } else {
        print tpl::$_vars['lang_ref'][2076];
    }
    $aid = mysql_real_escape_string($_REQUEST['aid']);

    if ($aid != '') {
        $_db->query("delete from city_user_album_entries where cuae_cua_id = '{$aid}' and cuae_cid = '{$cid}' ");
    } else {
        $query = "delete from city_user_album_entries where  cuae_user_id = '{$_SESSION['user_id']}' and cuae_content_type = 'ec' and cuae_cid = '{$cid}' ";
        $_db->query($query);
    }
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'share_wallpaper') {
    require_once "soapclient.inc.php";
    $share_obj_mail = new mailer();
    $mail_subject_array = array("from_name" => $_REQUEST['from'], "content_type" => tpl::$_vars['lang_ref'][904]);

    $share_wallpaper_mail_subject = GetLanguageSpecificMailSubject(4, $_SESSION['lid'], $mail_subject_array);
    //$share_wallpaper_mail_subject=$_REQUEST['from']." want to share Wallpaper of adlino";
    $mail_sent_to_array = explode(";", $_REQUEST['to']);
    $mail_subscribe_list = '';
    foreach ($mail_sent_to_array as $mail_sent_list) {
        if (!empty($mail_sent_list)) {
            $share_obj_mail->AddUser($mail_sent_list);
        }
    }
    //$share_wallpaper_mail_content="Hi,<br/>".$_REQUEST['from']." want to share wallpaper of adlino.so please view it by click on below link.<br><br><a href='"._U."view_user_wallpaper?wallpaper_id=".$_REQUEST['wallpaper_id']."'>"._U."view_user_wallpaper?wallpaper_id=".$_REQUEST['wallpaper_id']."<a><br><br>Thanks,<br>Adlino Team.";
    $mail_content_value = array("from_name" => $_REQUEST['from'], "content_type" => tpl::$_vars['lang_ref'][904], "url" => _U . "view_user_wallpaper?wallpaper_id=" . $_REQUEST['wallpaper_id']);
    //    $share_wallpaper_mail_content = GetLanguageSpecificMailBody(4,$_SESSION['lid'],$mail_content_value);
    $share_obj_mail->SetFrom($_REQUEST['from']);        //Mail From
    $share_obj_mail->SetHtml();
    $share_obj_mail->SetSubject($share_wallpaper_mail_subject[0]);
    $share_obj_mail->SetContent($share_wallpaper_mail_subject[1]);
    $a = $share_obj_mail->Send();
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "fav_wallpaper") {

    $cid = mysql_real_escape_string($_REQUEST['wallpaper_id']);

    $uid = q("select * from city_user_wallpaper where cuw_id = '{$cid}' ");
    if ($uid[0]['cuw_user_id'] == $_SESSION['user_id']) {
        print "E!" . tpl::$_vars['lang_ref'][1274];
        die;
    }


    require_once "soapclient.inc.php";
    $fav_flag = $soap->addtofavouritewallpaper($_REQUEST['wallpaper_id'], $_REQUEST['user_id']);
    if ($fav_flag) {
        //increment activity point of city user
        $soap->ManageCityUserActivityPoint($_SESSION['user_id']);
        print tpl::$_vars['lang_ref'][1289];
    } else {
        print tpl::$_vars['lang_ref'][2075];
    }
    $aid = mysql_real_escape_string($_REQUEST['aid']);
    if ($aid != '') {
        $_db->query("delete from city_user_album_entries where cuae_cua_id = '{$aid}' and cuae_cid = '{$cid}' ");
    } else {
        $query = "delete from city_user_album_entries where  cuae_user_id = '{$_SESSION['user_id']}' and cuae_content_type = 'w' and cuae_cid = '{$cid}' ";
        $_db->query($query);
    }
    die;
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "rate_wallpaper") {
    require_once "soapclient.inc.php";
    //$flag_rate=$soap->ApplyUsersWallpaperRatings($_REQUEST['wallpaper_id'],$_REQUEST['user_id'],$_REQUEST['rate']);

    $wallpaper_id = $_REQUEST['wallpaper_id'];
    $user_id = $_REQUEST['user_id'];
    $rate = $_REQUEST['rate'];


    $db = db::__d();
    $IsRatingExists = $db->get_record_count_simple_query("SELECT * FROM city_user_wallpaper_rating WHERE user_id=$user_id AND cuw_id=$wallpaper_id");
    if ($IsRatingExists == 0) {
        $ratinginsertdata = array(
            "cuw_id" => $wallpaper_id,
            "user_id" => $user_id,
            "user_rate" => $rate,
            "rate_date" => date("Y-m-d h:i:s")
        );
        $db->insert_query("city_user_wallpaper_rating", $ratinginsertdata);
        $PictureRatingData = $db->select_query("city_user_wallpaper", "*", "cuw_id=$wallpaper_id");
        $picture_rate = $PictureRatingData[0]['cuw_rate'];
        $ratedby = $PictureRatingData[0]['cuw_ratedby'];
        $value = round($picture_rate * $ratedby, 1);
        $picture_rate = $value + $rate;
        $ratedby = $ratedby + 1;
        $new_rate = round($picture_rate / $ratedby, 1);
        $pos = strpos($new_rate, ",");
        if ($pos != "") {
            $rates = explode(",", $new_rate);
            $new_rate = $rates[0];
        }
        $sql = "UPDATE city_user_wallpaper SET cuw_rate = " . $new_rate . ", cuw_ratedby=cuw_ratedby+1 WHERE cuw_id = " . $wallpaper_id;
        $db->query($sql);
        $db->query("UPDATE city_user SET activity_point=activity_point+1 WHERE user_id=$user_id");
        print tpl::$_vars['lang_ref'][1281];
    } else {
        print tpl::$_vars['lang_ref'][1291];
    }
}


if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_genaral_classified" && isset($_REQUEST['classfied_category_id'])) {
    require_once "soapclient.inc.php";
    $classified_subcategories = unserialize($soap->classified_subcategory($_REQUEST['classfied_category_id'], $_SESSION['lid']));
    print "<option value='0'>" . tpl::$_vars['lang_ref'][128] . "</option>";
    if (count($classified_subcategories) != 0) {
        foreach ($classified_subcategories as $classified_SubCategories) {
            print "<option value='" . $classified_SubCategories['ccsl_id'] . "'>" . $classified_SubCategories['name_l'] . "</option>";
        }
    }
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "add_genaral_job" && isset($_REQUEST['job_category_id'])) {
    $db = db::__d();
    $job_subcategories = dc_display_dtt_data_to_front(&$db, 'job_category_sub_level', 'name', $_SESSION['lid'], 'jcsl_id', " jcsl_parent= '" . $_REQUEST['job_category_id'] . "' AND level='0' ", " ORDER BY name");


    print "<option value='0'>Select SubCategory</option>";
    if (count($job_subcategories) != 0) {
        foreach ($job_subcategories as $job_subcategory) {
            print "<option value='" . $job_subcategory['jcsl_id'] . "'>" . $job_subcategory['name_l'] . "</option>";
        }
    }
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'delete_functionality') {
    require_once "soapclient.inc.php";
    $delete_value = $soap->general_delete_query($_REQUEST['table_name'], $_REQUEST['condition']);
    print tpl::$_vars['lang_ref'][2023];
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'buy_shopping') {
    require_once "soapclient.inc.php";
    //is this buying process for this product is in progress
    //if in progress then give them alert message
    /* $Relative_Checking = $soap->FetchFrontDataWithCustomQuery("SELECT bpd_status FROM buyed_products_detail WHERE bpd_p_id=".$_REQUEST['shop_id']." AND bpd_buyer_id=".$_SESSION['user_id']);
      if($Relative_Checking[0]['bpd_status'] == 0){
      print "Buying Process for this Product is in Progress";
      }else{ */
    //get required shop information from shop id
    $shop_data = $soap->FetchFrontDataWithCustomQuery("SELECT ms_title,ms_creator_id FROM my_shop WHERE ms_id=" . $_REQUEST['shop_id']);
    //get seller info
    $seller_data = $soap->FetchFrontDataWithCustomQuery("SELECT c.id,c.first_name,c.last_name,ua.user_email FROM companies c LEFT JOIN user_all ua ON c.user_id=ua.user_id WHERE c.user_id=" . $shop_data[0]['ms_creator_id']);
    //get a byuer info
    $buyer_data = $soap->FetchFrontDataWithCustomQuery("SELECT cu.id,cu.user_name,ua.user_email FROM city_user cu LEFT JOIN user_all ua ON cu.user_id=ua.user_id WHERE cu.user_id=" . $_SESSION['user_id']);
    //sent an internal mail and external mail to buyer
    //set subject for mail
    $buyer_msg_subject = "Buying A Product Step 1";
    //set message for mail
    $buyer_msg_text = "Hi " . $buyer_data[0]['user_name'] . ",<br><br>You had wished to buy " . $shop_data[0]['ms_title'] . " Product.<br>We will give you Bank information of seller soon.<br><br>Thanks<br>Adlino Team";
    //sent an internal mail
    $soap->insert_mail($shop_data[0]['ms_creator_id'], $_SESSION['user_id'], $buyer_msg_subject, $buyer_msg_text);
    //sent an external mail 
    $buying_obj = new mailer();
    $buying_obj->AddUser($buyer_data[0]['user_email']);
    $buying_obj->SetFrom($seller_data[0]['user_email']);        //Mail From
    $buying_obj->SetHtml();
    $buying_obj->SetSubject($buyer_msg_subject);
    $buying_obj->SetContent($buyer_msg_text);
    $buying_obj->Send();
    //sent an internal and external mail to seller
    //set subject for mail
    $seller_msg_subject = "Buying A Product Step 1";
    //set message for mail
    $seller_msg_text = "Hi " . $seller_data[0]['first_name'] . " " . $seller_data[0]['last_name'] . ",<br><br>" . $buyer_data[0]['user_name'] . " had wished to buy your product.Please Submit Your Bank Information if you had not provided.<br><br>Thanks<br>Adlino Team";
    //sent an internal mail
    $soap->insert_mail($shop_data[0]['ms_creator_id'], $shop_data[0]['ms_creator_id'], $seller_msg_subject, $seller_msg_text);
    $selling_obj = new mailer();
    $selling_obj->AddUser($seller_data[0]['user_email']);
    $selling_obj->SetFrom($seller_data[0]['user_email']);        //Mail From
    $selling_obj->SetHtml();
    $selling_obj->SetSubject($seller_msg_subject);
    $selling_obj->SetContent($seller_msg_text);
    $selling_obj->Send();
    //insert buying product informaition
    $product_details = array("bpd_p_id" => $_REQUEST['shop_id'], "bpd_buyer_id" => $_SESSION['user_id'], "bpd_created_date" => date("Y-m-d h:i:s"), "bpd_status" => '0');
    $soap->InsertDataDbTable($product_details, "buyed_products_detail");
    print "Your Buying Request has been accepted Successfully.Please Check your mail for further Process";
    //}
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'my_voucher' && $_REQUEST['cat_id'] != "") {
    require_once "soapclient.inc.php";
    $cat_name = $_REQUEST['name'];

    $update_voucher_array = array(
        "cv_name" => $cat_name
    );

    $delete_value = $soap->InsertUpdateCompanyVoucherData($update_voucher_array, $_REQUEST['cat_id']);
    print $_REQUEST['name'];
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'my_banners' && $_REQUEST['cat_id'] != "") {
    require_once "soapclient.inc.php";
    $cat_name = $_REQUEST['name'];

    $update_banner_array = array(
        "banner_name" => $cat_name
    );

    $delete_value = $soap->InsertUpdateCompanyBannerData($update_banner_array, $_REQUEST['cat_id']);
    print $_REQUEST['name'];
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'my_print_banners' && $_REQUEST['cat_id'] != "") {
    $cat_name = mysql_real_escape_string($_REQUEST['name']);
    $_db = db::__d();
    $update_banner_array = array("fupb_name" => $cat_name);

    $_db->update_query('flyer_user_print_banner', $update_banner_array, " fupb_id=" . mysql_real_escape_string($_REQUEST['cat_id']));
    print $_REQUEST['name'];
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'add_video' && $_REQUEST['cat_id'] != "") {
    require_once "soapclient.inc.php";
    $cat_name = $_REQUEST['name'];
    $update_voucher_array = array(
        "vi_title" => $cat_name
    );
    $delete_value = $soap->update_video_stat($update_voucher_array, $_REQUEST['cat_id']);
    print $_REQUEST['name'];
}
if (isset($_REQUEST["getcaptchavalue"]) && $_REQUEST["getcaptchavalue"] == 1) {
    if (isset($_REQUEST['captcha_text']) && $_REQUEST['captcha_text'] != "") {
        if ($_REQUEST['captcha_text'] == $_SESSION['security_code'])
            echo "true";
        else
            echo "false";
    }
    else {
        echo "false";
    }
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == "event_add_abuse" && isset($_REQUEST['user_id'])) {

    require_once "soapclient.inc.php";
    $soap->event_add_abuse($_REQUEST['event_id'], $_REQUEST['user_id']);

    print tpl::$_vars['lang_ref'][2316];
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == "event_add_favourite" && isset($_REQUEST['user_id'])) {

    //require_once "soapclient.inc.php";
    //$soap->event_add_favourite($_REQUEST['event_id'],$_REQUEST['user_id']);

    $db = db::__d();
    $FieldArray = array("event_id" => $_REQUEST['event_id'],
        "user_id" => $_REQUEST['user_id'],
        "date" => date('y-m-d')
    );

    $db->insert_query("event_favourite", $FieldArray);

    print tpl::$_vars['lang_ref'][2317];
}

/*
 * new added on 07-04-2010
 */
if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'edit_profile' && $_REQUEST['keyterm'] != "") {
    require_once "soapclient.inc.php";
    $keyterm = $_REQUEST['keyterm'];
    $brands = $_REQUEST['brands'] ? "1" : "0";
    $relavent_keyword_arr = unserialize($soap->GetAutocompleteKeywords($keyterm, _REQUEST_LANG_ID, $brands));
    #d($relavent_keyword_arr);
    foreach ($relavent_keyword_arr as $key => $value) {
        $newArray[] = stripslashes($value[0]['keyword_l']);
    }
    print implode(",", $newArray);
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'edit_profile' && $_REQUEST['keyterm_brands'] != "") {
    require_once "soapclient.inc.php";
    $keyterm = $_REQUEST['keyterm_brands'];

    $relavent_keyword_arr = unserialize($soap->GetAutocompleteKeywords($keyterm, _REQUEST_LANG_ID));
    #d($relavent_keyword_arr);
    foreach ($relavent_keyword_arr as $key => $value) {
        $newArray[] = stripslashes($value[0]['keyword_l']);
    }
    print implode(",", $newArray);
}

if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'classified_autocomplete' && $_REQUEST['keyterm'] != "") {

    $db = db::__d();
    $keyterm = $_REQUEST['keyterm'];

    $relavent_keyword_arr = GetAutocompleteKeywordsCommon('classifieds', 'classified_title', $keyterm, _REQUEST_LANG_ID);
    foreach ($relavent_keyword_arr as $key => $value) {
        $newArray[] = $value['keyword_l'];
    }
    print implode(",", $newArray);
}
if (isset($_REQUEST['op']) && $_REQUEST['op'] == 'getSamplepage' && isset($_REQUEST['id'])) {
    $db = db::__d();
    $res = $db->query("SELECT * FROM company_cms_sample_pages WHERE id = " . $_REQUEST['id']);
    $data = $db->format_data($res);
    print $data[0]['page_title'];
    print "CONTENT" . $data[0]['page_content'];
}
if (isset($_REQUEST['op']) && $_REQUEST['op'] == 'change_commercial_page_element_content') {
    $db = db::__d();
    $id = $_REQUEST['id'];
    $content = $_REQUEST['content'];

    $update_array = array(
        "content" => $content
    );
    $db->update_query("co_theme_up_elements_content", $update_array, " id='" . $id . "' ");
    print $content;
}


if (isset($_REQUEST['op']) && $_REQUEST['op'] == 'arrange_voucher_elements') {
    //$header_footer_elements = array(2,3,5,9,15,19);

    $db = db::__d();
    $id = explode(",", $_REQUEST['id']);
    $top = explode(",", $_REQUEST['top']);
    $left = explode(",", $_REQUEST['left']);
    $width = explode(",", $_REQUEST['width']);
    $height = explode(",", $_REQUEST['height']);
    $zIndex = explode(",", $_REQUEST['zIndex']);

    for ($i = 0; $i < count($id); $i++) {
        $qry = $db->query("SELECT vce_element_type FROM voucher_cards_elements WHERE vce_id=" . $id[$i] . " LIMIT 1");
        $element = $db->format_data($qry);

        if ($element[0]['vce_element_type'] == 'files') {
            $zIndex[$i] = 1;
        }

        $query = "UPDATE voucher_cards_elements SET 
								vce_element_top		= '$top[$i]',	
								vce_element_left	= '$left[$i]',
								vce_element_width 	= '$width[$i]',	
								vce_element_height	= '$height[$i]',
								vce_element_zIndex 	= '$zIndex[$i]'
								WHERE vce_id = " . $id[$i];
        $db->query($query);
    }
}

if ($_REQUEST['page'] == 'newletter') {
    $db = db::__d();
    $query = "SELECT news_id FROM newsletter WHERE email_id = '" . $_REQUEST['email_id'] . "'";
    $res = $db->query($query);
    $email_info = $db->format_data($res);

    if (empty($email_info)) {
        $query = "INSERT INTO newsletter (email_id,site_name,IP_address) VALUE ('" . $_REQUEST['email_id'] . "','" . $_REQUEST['site'] . "','" . $_SERVER['REMOTE_ADDR'] . "')";
        $res = $db->query($query);
        print "Subscribed Successfully.";
    } else {
        print "exist";
    }
}

if ($_REQUEST['page'] == 'change_color_scheme') {
    $db = db::__d();
    $query = "SELECT * FROM private_user_theme_sceme WHERE puts_id  = '" . $_REQUEST['scheme_id'] . "'";
    $res = $db->query($query);
    $scheme_info = $db->format_data($res);

    print $scheme_info[0]['background_color'] . "*" . $scheme_info[0]['top_bar_background_color'] . "*" . $scheme_info[0]['content_background'] . "*" . $scheme_info[0]['title_color'] . "*" . $scheme_info[0]['menu_color'] . "*" . $scheme_info[0]['mouse_hover_color'];
}
if (isset($_REQUEST['op']) && $_REQUEST['op'] == 'validate_adlino_card') {
    //$header_footer_elements = array(2,3,5,9,15,19);
    //tpl::$_vars['lang_ref'][2894] = 'd';
    $db = db::__d();
    $card_number = mysql_real_escape_string($_REQUEST['card_number']);

    if ($card_number == '') {
        print tpl::$_vars['lang_ref'][2894];
        exit;
    }
    /*
      $record = $db->get_record_count_simple_query("SELECT * FROM adlino_card WHERE ac_number = '".$card_number."'");
      if($record == 1)
      {
      $res = $db->query("SELECT * FROM adlino_card WHERE ac_number = '".$card_number."'");
      $card_data = $db->format_data($res);
      if($card_data[0]['ac_status'] == '1')
      {
      $message = 'Card already validated.';
      }
      else
      {
      $field_array = array(
      'ac_private_user'=>$_SESSION['user_id'],
      'ac_private_added'=>date("Y-m-d H:i:s"),
      'ac_status'=>1
      );
      $db->update_query("adlino_card",$field_array,"  ac_number = '".$card_number."'");
      $message = tpl::$_vars['lang_ref'][2893];
      $message = 'Card valiedated successfully.'.tpl::$_vars['lang_ref'][2893];
      }
      }
      else
      {
      $message = 'please enter valid card number.'.tpl::$_vars['lang_ref'][2894];
      }
     */

    $query = " select acb_id from adlino_card_bulk where acb_end >= $card_number AND acb_start <= $card_number ";

    $res = $db->query($query);
    if (mysql_num_rows($res) > 0) {
        $userid = $_SESSION['user_id'];
        $query = " select ac_number from adlino_card where ac_private_user = $userid or ac_number = $card_number";
        $res = $db->query($query);
        $ip = $_SERVER['REMOTE_ADDR'];
        if (mysql_num_rows($res) <= 0) {
            $time = date("Y-m-d H:i:s");
            $query = " insert into adlino_card ( ac_number, ac_private_user, ac_status, ac_private_added, ac_ip ) values ( '$card_number', $userid, 1, '$time', '$ip')";
            $db->query($query);
            $message = 'success';
        } else {
            $message = tpl::$_vars['lang_ref'][2894];
        }
    } else {
        $message = tpl::$_vars['lang_ref'][2894];
    }
    print $message;
}
/* autocomplete for streets */

if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'getStreets' && $_REQUEST['keyterm'] != "") {

    $keyterm = mysql_real_escape_string($_REQUEST['keyterm']);
    $_db = db::__d();
    $query = "SELECT strt_name from streets where strt_name like '{$keyterm}%' limit 0,100";
    $streets = $_db->format_data($_db->query($query));
    $newArray = array();
    if (count($streets) > 0) {
        foreach ($streets as $key => $value) {
            $newArray[] = array('id' => $value['strt_name'], 'label' => $value['strt_name'], 'value' => $value['strt_name']);
        }
    }
    print json_encode($newArray);
    die;
}
$_REQUEST['keyterm'] = $_REQUEST['term'];
/* autocomplete for keywords */
if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'getKeywords' && $_REQUEST['keyterm'] != "") {

    $keyterm = strtolower(trim(strtolower(mysql_real_escape_string($_REQUEST['keyterm']))));
    $_db = db::__d();

    $type = '';
    if (isset($_REQUEST['type'])) {
        $type = mysql_real_escape_string($_REQUEST['type']);
        $type = " AND keyword_type = '{$type}' ";
    }

    $where = '';
    if (isset($_REQUEST['plural'])) {
        $where = " OR LOWER({$_SESSION['lid']}_keyword_plural) like '{$keyterm}%' ";
    }

    $query = "SELECT * from keywords where LOWER({$_SESSION['lid']}_keyword) like '{$keyterm}%' {$where}  {$type}";
    $streets = $_db->format_data($_db->query($query));

    $newArray = array();
    if (count($streets) > 0) {
        foreach ($streets as $key => $value) {
            $newArray[] = array("label" => $value[$_SESSION['lid'] . '_keyword'], "value" => $value[$_SESSION['lid'] . '_keyword']);
        }
    }
    print json_encode($newArray);
}

/**
 * autocomplete for city name
 */
if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'flyer_search' && $_REQUEST['keyterm'] != "") {

    $keyterm = mysql_real_escape_string($_REQUEST['keyterm']);
    $_db = db::__d();
    $query = "SELECT ci_name from cities where ci_name like '{$keyterm}%'";
    $cities = $_db->format_data($_db->query($query));

    $newArray = array();
    if (count($cities) > 0) {
        foreach ($cities as $key => $value) {
            $newArray[] = $value['ci_name'];
        }
    }
    print implode(",", $newArray) . "#ADLINO#" . $keyterm;
}
if (isset($_REQUEST['omc_header_search_brands'])) {
    $term = mysql_real_escape_string($_REQUEST['term']);
    $_db = db::__d();
    $lid = $_SESSION['lid'];

    $sing = tpl::$_vars['lang_ref'][3348];
    $plural = tpl::$_vars['lang_ref'][3349];

    $query = "select {$lid}_keyword as k,{$lid}_keyword as kv , id from keywords where {$lid}_keyword LIKE '%{$term}%' AND ( keyword_type = 'br' )";
    $singular_data = $_db->format_data($_db->query($query));

    $result = array();
    if (count($singular_data)) {
        foreach ($singular_data as $each_data) {
            $text = str_replace($term, "" . $term . "", $each_data['k']);
            $result[$each_data['id'] . "A"] = array('id' => 'SK_' . $each_data['id'], 'label' => $text, 'value' => $each_data['kv']);
        }
    }


    ksort($result);
    print json_encode(array_values($result));
}
if (isset($_REQUEST['omc_header_search'])) {
    $term = mysql_real_escape_string($_REQUEST['term']);
    $_db = db::__d();
    $lid = $_SESSION['lid'];

    $sing = tpl::$_vars['lang_ref'][3348];
    $plural = tpl::$_vars['lang_ref'][3349];

    $query = "select concat({$lid}_keyword, ' ({$sing})') as k,{$lid}_keyword as kv , id from keywords where {$lid}_keyword LIKE '%{$term}%' AND ( keyword_type != 'mk' AND keyword_type != 'br' )";
    $singular_data = $_db->format_data($_db->query($query));

    $query = "select concat({$lid}_keyword_plural, ' ({$plural})') as k,{$lid}_keyword_plural as kv ,id from keywords where {$lid}_keyword_plural LIKE '%{$term}%' AND ( keyword_type != 'mk' AND keyword_type != 'br' )";
    $plural_data = $_db->format_data($_db->query($query));

    $result = array();
    if (count($singular_data)) {
        foreach ($singular_data as $each_data) {
            $text = str_replace($term, "" . $term . "", $each_data['k']);
            $result[$each_data['id'] . "A"] = array('id' => 'SK_' . $each_data['id'], 'label' => $text, 'value' => $each_data['kv']);
        }
    }

    if (count($plural_data)) {
        foreach ($plural_data as $each_data) {
            $text = str_replace($term, "" . $term . "", $each_data['k']);
            $result[$each_data['id'] . "B"] = array('id' => 'PK_' . $each_data['id'], 'label' => $text, 'value' => $each_data['kv']);
        }
    }
    ksort($result);
    print json_encode(array_values($result));
}
if (isset($_REQUEST['omc'])) {
    $term = mysql_real_escape_string($_REQUEST['term']);
    $_db = db::__d();
    $lid = $_SESSION['lid'];

    $sing = tpl::$_vars['lang_ref'][3348];
    $plural = tpl::$_vars['lang_ref'][3349];

    $query = "select concat({$lid}_keyword, ' ({$sing})') as k,{$lid}_keyword as kv , id from keywords where {$lid}_keyword LIKE '%{$term}%' AND keyword_type = 'mk'";
    $singular_data = $_db->format_data($_db->query($query));

    $query = "select concat({$lid}_keyword_plural, ' ({$plural})') as k,{$lid}_keyword_plural as kv ,id from keywords where {$lid}_keyword_plural LIKE '%{$term}%' AND keyword_type = 'mk'";
    $plural_data = $_db->format_data($_db->query($query));

    $result = array();
    if (count($singular_data)) {
        foreach ($singular_data as $each_data) {
            $text = str_replace($term, "" . $term . "", $each_data['k']);
            $result[$each_data['id'] . "A"] = array('id' => 'SK_' . $each_data['id'], 'label' => $text, 'value' => $each_data['kv']);
        }
    }

    if (count($plural_data)) {
        foreach ($plural_data as $each_data) {
            $text = str_replace($term, "" . $term . "", $each_data['k']);
            $result[$each_data['id'] . "B"] = array('id' => 'PK_' . $each_data['id'], 'label' => $text, 'value' => $each_data['kv']);
        }
    }
    ksort($result);
    print json_encode(array_values($result));
}
if (isset($_REQUEST['altCat'])) {
    $term = mysql_real_escape_string($_REQUEST['term']);
    $_db = db::__d();
    $lid = $_SESSION['lid'];
    $query = "select cat_name as cname,cat_id from category_select_fields where cat_name LIKE '%{$term}%' AND parent_id = '28'";
    $singular_data = $_db->format_data($_db->query($query));


    $result = array();
    if (count($singular_data)) {
        foreach ($singular_data as $each_data) {
            $text = str_replace($term, "" . $term . "", $each_data['cname']);
            $result[] = array('id' => $each_data['cat_id'], 'label' => $text, 'value' => $text);
        }
    }

    print json_encode($result);
}

if (isset($_REQUEST['getMenuCardTemplates'])) {
    $cat_id = mysql_real_escape_string($_REQUEST['getMenuCardTemplates']);
    $_db = db::__d();
    $opt_data = $_db->format_data($_db->query("select ct_id,ct_name from category_templates where ct_style_id = '{$cat_id}' ORDER BY ct_name ASC"));
    $return = 'No Data';
    if (count($opt_data)) {
        $return = '';
        foreach ($opt_data as $each_data) {
            $return .= "<option value='{$each_data['ct_id']}'>{$each_data['ct_name']}</option>";
        }
    }
    print $return;
    die;
}

if (isset($_REQUEST['select_city_home'])) {
    $city = mysql_real_escape_string($_REQUEST['cid']);
    $data = q("select * from cities where ci_id = '{$city}' ");
    if (!empty($data)) {
        $_SESSION['front_city'] = $city;
        die("1");
    }
    die("0");
}
if (isset($_REQUEST['city_change_location'])) {
    $city_name = mysql_real_escape_string($_REQUEST['term']);

    $city_data = q("select ci.ci_name,ci.ci_id,p.p_name from cities ci left join provinces p on p.p_id = ci.p_id where ci_name LIKE '{$city_name}%' ");

    $return = array();
    if (!empty($city_data)) {
        foreach ($city_data as $each_data) {
            $name = $each_data['ci_name'] . " ( " . $each_data['p_name'] . " ) ";
            $return[] = array('id' => $each_data['ci_id'], 'label' => $name, 'value' => $name);
        }
    }
    print json_encode($return);
    die();
}

exit;
?>