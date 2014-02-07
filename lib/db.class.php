<?php



/**
 * Singleton Pattern
 */
class db { 

    private static $db;
    public static $_link_chatdb = false;
    public static $_link_nearCitydb = false;
    public static $_link_wallpostdb = false;
    public static $_link_commentdb = false;
    public static $_link_playlistdb = false;
    public static $_link_messagedb = false;
    public static $_link_maildb = false;
    public static $_link_guestbookdb = false;
    public $_link;

    public function __construct($dbhost="", $dbuname="", $db_password="", $db_name="") {
        if ($dbhost != "") {

            $this->_link = mysql_connect($dbhost, $dbuname, $db_password) or trigger_error(mysql_error(), 1024);
            mysql_select_db($db_name) or trigger_error(mysql_error(), 1024);
        } else {
            $this->_link = mysql_connect(DB_HOST, DB_UNAME, DB_PASSWORD) or trigger_error(mysql_error(), 1024);
            mysql_select_db(DB_NAME) or trigger_error(mysql_error(), 1024);
        }
        mysql_query("SET NAMES 'utf8'");
        // mysql_query("SET CHARACTER_SET_RESULTS=utf8");
    }

    public static function __d($explicit=0) {
        if ($explicit == 1) {
            self::$db = new db(C_DB_HOST, C_DB_UNAME, C_DB_PASSWORD, C_DB_NAME);
        } else if (!isset($db)) {
            self::$db = new db();
        }
        return self::$db;
    }

    public function query_remote($query,$link) {
//		echo ($query) . "<br /><br />";
        if ($res = mysql_query($query,$link))
            return $res;
        else {
            d(mysql_error());
            back_trace();
            d($query);
            exit;
        }
    }
    public function query($query) {
//		echo ($query) . "<br /><br />";
        if ($res = mysql_query($query))
            return $res;
        else {
            d(mysql_error());
            back_trace();
            d($query);
            exit;
        }
    }

#special query

    public function specialquery($query) {
        if ($res = mysql_query($query))
            return $res;
        else {
            //d(mysql_error());
            //back_trace();
            //d($query);
            return "error";
            exit;
        }
    }

    public function format_data($result, $field=NULL, $second_field=NULL, $third_field=NULL) {
        $data_array = array();
        if ($result) {
            while ($array = mysql_fetch_assoc($result)) {
                $t = array();
                foreach ($array as $field_name => $value) {
                    //$t[$field_name] = utf8_encode($value);				
                    $t[$field_name] = ($value);
                }
                if (isset($field)) {  
                    if (isset($second_field)) {
                        if (isset($third_field)) {
                            $data_array[$t[$field]][$t[$second_field]][$t[$third_field]] = $t;
                        } else {
                            $data_array[$t[$field]][$t[$second_field]] = $t;
                        }
                    } else {
                        $data_array[$t[$field]][] = $t;
                    }
                } else {
                    $data_array[] = $t;
                }
            }
        }
        return $data_array;
    }

    

    
    
    function get_record_count_simple_query($query, $debug =false) {

        $stmt = mysql_query($query);

        if ($debug == true) {
            echo $query;
        }
        if ($stmt == false) {
            echo mysql_errno() . ": " . mysql_error() . "<br>";
            die();
        }
        return mysql_num_rows($stmt);
    }

    //***************8
    /*
     *   select_query 
     *   Desc: Retrieve data from the database. 
     *   Parms: 
     *   $table - comma separated list of table names. 
     *   $fields - comma separated list of field names or "*". 
     *   $where - SQL Where clause (e.g. "where id=2"). 
     *   $groupBy - SQL Group clause (e.g. "group by name"). 
     *   $orderBy - SQL Order clause (e.g. "order by name"). 
     *   $show_debug - If true then print SQL query. 
     *   Returns: 
     *   2d array of rows and columns on success. 
     *   Error String on failure. 
     */
    function select_query($table, $fields, $where="", $limit="", $show_debug=false, $groupBy="", $orderBy="") {

        // Return the data requested by the fields, table and where. 
        // Return the data in a 2 dimensional array. 
        $values = array();
        $field_array = split(", ?", $fields);

        $max_fields = ($fields == "*") ? 20 : count($field_array);

        if (!empty($where)) {
            $where = "where $where";
        }
        if ($limit != "") {
            $limit = "limit " . $limit;
        }

        $query = "select $fields from $table $where $groupBy $orderBy $limit";

        if ($show_debug == true)
            echo "query=$query<br>\n";

        $stmt = mysql_query($query);

        if ($stmt == false) {

            echo mysql_errno() . ": " . mysql_error() . "<br>";
            echo "<Br>your query is: " . $query;
            die();
        }

        while ($fields = mysql_fetch_assoc($stmt)) {
            $values[] = $fields;
        }

        @mysql_free_result($stmt);
        //@mysql_close($db); 

        return $values;
    }

    /*
     *   select one 
     *   Desc: Retrieve data from the database. 
     *   Parms: 
     *   $table - table names. 
     *   $fields - comma separated list of field names or "*". 
     *   $where - SQL Where clause (e.g. "where id=2"). 
     *   $groupBy - SQL Group clause (e.g. "group by name"). 
     *   $orderBy - SQL Order clause (e.g. "order by name"). 
     *   $show_debug - If true then print SQL query. 
     *   Returns: 
     *   1d array of rows and columns on success. 
     *   Error String on failure. 
     */

    function select_one($table, $fields, $where="", $show_debug=false, $groupBy="", $orderBy="") {

        // Return the data requested by the fields, table and where. 
        // Return the data in a 2 dimensional array. 
        $values = array();
        $field_array = split(", ?", $fields);

        $max_fields = ($fields == "*") ? 20 : count($field_array);

        if (!empty($where)) {
            $where = "where $where";
        }

        $query = "select $fields from $table $where $groupBy $orderBy";
        if ($show_debug == true)
            echo "query=$query<br>\n";

        $stmt = mysql_query($query);

        if ($stmt == false) {

            echo mysql_errno() . ": " . mysql_error() . "<br>";
            echo "<Br>your query is: " . $query;
            die();
        }

        $values = mysql_fetch_assoc($stmt);


        @mysql_free_result($stmt);
        @mysql_close($db);

        return $values;
    }

    function simple_query($query, $show_debug=false) {


        if ($show_debug == true)
            echo "query=$query<br>\n";

        $stmt = mysql_query($query);

        if ($stmt == false) {
            echo mysql_errno() . ": " . mysql_error() . "<br>";
            echo "<Br>your query is: " . $query;
            die();
        }

        //echo mysql_num_rows($stmt);
        /* if(mysql_num_rows($stmt)==1)
          {
          $values = mysql_fetch_assoc ($stmt);
          }
          else if(mysql_num_rows($stmt)!=0)
          {
          while ($fields = mysql_fetch_assoc ($stmt))
          {
          $values[] = $fields;
          }
          }
          else
          {
          $values = array();
          return $values;
          } */
        while ($fields = mysql_fetch_assoc($stmt)) {
            $values[] = $fields;
        }

        @mysql_free_result($stmt);
        //	@mysql_close($db); 

        return $values;
    }

    /*
     * insert_query 
     * Desc: Insert data into the database. 
     * Parms: 
     *   $tableName - database table name. 
     *   $values - associative array of field names and corresponding values. 
     *   $debug - If true then return SQL query without executing. 
     * Returns: 
     *   Nothing on success. 
     *   Error String on failure. 
     */

    function insert_query($tableName, $values, $debug=false) {
        /* Insert the $values into the database. 
         * e.g. 
         * $values = array ("name"=>"kris","email"=>"karn@nucleus.com"); 
         * InsertQuery ("employee", $values); 
         */
        return $this->InsertUpdateQuery($tableName, $values, "", $debug);
    }

    /*     * ***************************************************** */

    /*
     * update_query 
     * Desc: Update data in the database. 
     * Parms: 
     *   $tableName - database table name. 
     *   $values - associative array of field names and corresponding values. 
     *   $where - SQL Where clause to specify which row(s) to update. 
     *   $debug - If true then return SQL query without executing. 
     * Returns: 
     *   Nothing on success. 
     *   Error String on failure. 
     */

    function update_query($tableName, $values, $where="", $debug=false) {

        /* Update the $values in the database. 
         * e.g. 
         * $values = array ("name"=>"kris","email"=>"karn@nucleus.com"); 
         * $where = "WHERE id='1'"; 
         * UpdateQuery ("employee", $values, $where); 
         */
        if (empty($where))
            $where = " ";

        return $this->InsertUpdateQuery($tableName, $values, $where, $debug);
    }

    /*     * ***************************************************** */

    function InsertUpdateQuery($tableName, $fieldValues, $type="", $debug=false) {

        $i = 0;
        $fields = "";
        $values = "";
        $updateList = "";
        $error = '';
        while (list ($key, $val) = each($fieldValues)) {
            //$val = mysql_real_escape_string($val);
            if ($i > 0) {
                $fields .= ", ";
                $values .= ", ";
                $updateList .= ", ";
            }

            $fields .= $key;

            // If you do not want to add quotes 
            // around the field then specify 
            // /*NO_QUOTES*/ when passing in the value. 
            // For update statements like 
            // "update poll set total_votes=total_votes+1", 
            // you do not want 
            // the value field to have quotes around it. 
            if (strstr($val, "/*NO_QUOTES*/")) {
                $val = str_replace("/*NO_QUOTES*/", "", $val);
                $updateList .= "$key=$val";
                $values .= $val;
            } else {
                $updateList .= "$key='$val'";
                $values .= "'$val'";
            }
            $i++;
        }

        if (empty($type)) {
            $query = "insert into $tableName ($fields) values ($values)";
        } else {
            $type = " where " . $type;
            $query = "update $tableName set $updateList $type";
        }
        /* print $query;
          exit; */
        if ($debug) {
            //@mysql_close($db); 
            return $query;
        }

        //$query =  mysql_real_escape_string($query);
        $stmt = mysql_query($query);


        if ($stmt == false) {
            echo mysql_errno() . ": " . mysql_error() . "<br>";
            echo "<Br>your query is: " . $query;
            die();
        }
        @mysql_free_result($stmt);
        //@mysql_close($db); 

        return $error;
    }

    /*
     *  delete_query 
     *  Desc: Delete data from the database. 
     *  Parms: 
     *  $tableName - database table name. 
     *  $where - SQL Where clause to specify which row(s) to delete. 
     *  $debug - If true then return SQL query without executing. 
     *  Returns: 
     *  Nothing on success. 
     *  Error String on failure. 
     */

    function delete_query($tableName, $where="", $debug=false) {

        $error = '';
        // Delete a row from the specified table. 
        if (!empty($where)) {
            $where = "where $where";
        }

        $query = "delete from $tableName $where";
        if ($debug) {
            //@mysql_close($db); 
            echo $query;
        }
        $stmt = mysql_query($query);
        if (!$stmt) {
            echo mysql_errno() . ": " . mysql_error() . "<br>";
            echo "<Br>your query is: " . $query;
            die();
        }

        @mysql_free_result($stmt);
        //@mysql_close($db); 

        return $error;
    }

    function simple_delete_query($query, $debug=false) {
        $stmt = mysql_query($query, $this->db_linkid);
        if (!$stmt) {
            echo mysql_errno() . ": " . mysql_error() . "<br>";
            echo "<Br>your query is: " . $query;
            die();
        }

        @mysql_free_result($stmt);
        //@mysql_close($db); 

        return $error;
    }

    function simple_update_query($query, $debug=false) {
        $stmt = mysql_query($query, $this->db_linkid);
        if (!$stmt) {
            echo mysql_errno() . ": " . mysql_error() . "<br>";
            echo "<Br>your query is: " . $query;
            die();
        }

        @mysql_free_result($stmt);
        //@mysql_close($db); 

        return $error;
    }

    /*     * ************************Newely Added Functions Ends Here ***************************** */
}

?>