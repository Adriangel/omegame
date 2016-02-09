<?php
namespace Models;

class Db extends mysqli{
	public static $instance = false;
	
	public static function instance(){
		if (__CLASS__::$instance == false) {
			__CLASS__::$instance = new parent(Config::host, Config::username, Config::pass, Config::dbname);
		}
		return __CLASS__::$instance;
	}
	
}

?>