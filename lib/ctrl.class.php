<?php

class ctrl {
	public static $_page=array();
	
	public function __construct(){
	}

	public function load(){
		include(_PATH."websites/"._WEBSITE_NAME."/"."controller.php");
	}
}
?>