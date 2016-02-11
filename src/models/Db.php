<?php

class Db extends mysqli{
	private static $instance = false;
	
	public static function singleton(){
		if (self::$instance == false) {
			self::$instance = new parent(Config::host, Config::username, Config::pass, Config::dbname);
		}
		return self::$instance;
	}
	
}

?>