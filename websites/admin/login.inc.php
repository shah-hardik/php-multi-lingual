<?php

$error = '';
$greetings = '';
$validation_result = true;
$_t = array();

//session_destroy();
//$error = isset($_SESSION['wanted_url']) ? 'Authentication Required. Please login below' : '';


if (isset($_POST['adlino_login_btn'])) {
    $validation_result = true;
    $inputs = array(
        'adlino_username' => array('blank', 'email', 'element' => 'Email Address', "blank_message" => tpl::$_vars['lang_ref'][1472]),
        'adlino_password' => array('blank', 'element' => 'Password', "blank_message" => tpl::$_vars['lang_ref'][1495]),
    );
    $_t = _vf($inputs, $validation_result, $error);

    if ($validation_result) {
        $db = db::__d();

        $query = sprintf("SELECT au.au_id,au.au_code, au.au_first_name, au_email,au.au_last_name, ur.ur_role_id, au.au_terms_accept
FROM " . DB_NAME . ".admin_users AS au JOIN " . DB_NAME . ".user_roles AS ur ON ( ur.ur_user_id = au.au_id ) WHERE au.au_email = '%s'
AND au.au_password = '%s'", es($_POST['adlino_username']), md5(es($_POST['adlino_password'])));


        $res = $db->query($query);
        $no_of_rows = mysql_num_rows($res);
        if ($no_of_rows == 0) {
            $_t['adlino_username']['error_class'] = 'ier';
            $_t['adlino_password']['error_class'] = 'ier';
            $error .= tpl::$_vars['lang_ref'][1772];
        } else {
            $data = $db->format_data($res);
            $_SESSION['adlino_user_id'] = $data[0]['au_id'];
            $_SESSION['adlino_user_code'] = $data[0]['au_code'];
            $_SESSION['adlino_user_email'] = $data[0]['au_email'];
            #get user role
            #$urarr=get_user_role($data[0]['au_id'],$db);
            $urarr = $data[0]['ur_role_id'];

            if ($urarr) {
                $_SESSION['adlino_user_type'] = $urarr;
                $_SESSION['adlino_terms_accepted'] = $data[0]['au_terms_accept'];
                #checks for language moderator and language availability
                if (!check_user_moderator_access()) {
                    $_t['adlino_username']['error_class'] = 'ier';
                    $_t['adlino_password']['error_class'] = 'ier';
                    $error .= 'No Langauge Assigned.Login Failed';
                } else if ($data[0]['ur_role_id'] == "3") {
                    // GET USER INFORMATION IN SESSION VARIABLE FOR LOGIN
                    $res = $db->query("SELECT * FROM country_moderators WHERE cm_user_id = '" . $data[0]['au_id'] . "' ");
                    $cm_cid = $db->format_data($res);

                    $_SESSION['adlino_user_country_id'] = $cm_cid[0]['cm_country_id'];
                    $_SESSION['adlino_user_first_name'] = $data[0]['au_first_name'];
                    $_SESSION['adlino_user_last_name'] = $data[0]['au_last_name'];

                    if (!isset($_SESSION['adlino_user_country_id']) && $_SESSION['adlino_user_country_id'] == '') {
                        $error .="No Country associated with this moderator";
                    } else {
                        global $makeurl;

                        //$redirect_url = isset($makeurl) ? $makeurl : 'admin_dashboard';
                        $redirect_url = 'home/' . homepage_by_userrole($data[0]['ur_role_id']);
                        //echo $makeurl;
                        header("Location:" . _U . $redirect_url);
                        exit;
                    }
                } else if ($data[0]['ur_role_id'] == "4") {
                    $res = $db->query("SELECT * FROM city_moderator WHERE cim_user_id = '" . $data[0]['au_id'] . "' ");
                    $cm_cid = $db->format_data($res);
                    $_SESSION['adlino_user_city_id'] = $cm_cid[0]['cm_ci_id'];
                    $_SESSION['adlino_user_first_name'] = $data[0]['au_first_name'];
                    $_SESSION['adlino_user_last_name'] = $data[0]['au_last_name'];

                    if (!isset($_SESSION['adlino_user_city_id']) && $_SESSION['adlino_user_city_id'] == '') {
                        $error .="No city associated with this moderator";
                    } else {
                        global $makeurl;

                        //$redirect_url = isset($makeurl) ? $makeurl : 'admin_dashboard';
                        $redirect_url = 'home/' . homepage_by_userrole($data[0]['ur_role_id']);
                        //echo $makeurl;
                        header("Location:" . _U . $redirect_url);
                        exit;
                    }
                } else {
                    if ($data[0]['ur_role_id'] == "3") {
                        $countryarr = $db->query('SELECT c_name,c_id
								FROM country AS c
								JOIN country_moderators AS cm ON c.c_id=cm.cm_country_id
								WHERE cm.cm_user_id = ' . $_SESSION['adlino_user_id']);
                        $country_ary = $db->format_data($countryarr);
                        $_SESSION['adlino_user_country_id'] = $country_ary[0]['c_id'];
                    }
                    if ($data[0]['ur_role_id'] == "6") {
                        $statearr = $db->query('SELECT s_name,s_id
								FROM states  AS s
								JOIN states_moderators AS sm ON s.s_id=sm.sm_s_id
								WHERE sm.s_user_id = ' . $_SESSION['adlino_user_id']);
                        $state_ary = $db->format_data($statearr);
                        $_SESSION['adlino_user_state_id'] = $state_ary[0]['s_id'];
                    }
                    if ($data[0]['ur_role_id'] == "7") {
                        $provincesarr = $db->query('SELECT p_name,p_id
								FROM provinces AS p
								JOIN provinces_moderators AS pm ON p.p_id=pm.pm_p_id
								WHERE pm.p_user_id = ' . $_SESSION['adlino_user_id']);
                        $provinces_ary = $db->format_data($provincesarr);
                        $_SESSION['adlino_user_province_id'] = $provinces_ary[0]['p_id'];
                    }
                    if ($data[0]['ur_role_id'] == "16") {
                        $_db = db::__d();
                        $query = sprintf("select * from portal_moderators where pm_user_id = %d ", mysql_real_escape_string($_SESSION['adlino_user_id']));
                        $portal_moderator_data = $_db->format_data($_db->query($query));
                        $_SESSION['portal_moderator_data'] = $portal_moderator_data[0];
                    }
                    if ($data[0]['ur_role_id'] == "17") {
                        $_db = db::__d();
                        $query = sprintf("select * from support_moderators where sm_user_id = %d ", mysql_real_escape_string($_SESSION['adlino_user_id']));
                        $portal_moderator_data = $_db->format_data($_db->query($query));
                        $_SESSION['support_moderator_data'] = $portal_moderator_data[0];
                    }

                    $_SESSION['adlino_user_type'] = $data[0]['ur_role_id'];
                    $_SESSION['adlino_user_first_name'] = $data[0]['au_first_name'];
                    $_SESSION['adlino_user_last_name'] = $data[0]['au_last_name'];

                    global $makeurl;

                    $redirect_url = 'home/' . homepage_by_userrole($data[0]['ur_role_id']);
                    header("Location:" . _U . $redirect_url);
                    exit;
                }
            }
        }
    }
}
?>