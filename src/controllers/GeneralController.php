<?php

class GeneralController {
	
	public static function main() {
		include(Routes::MODELS . "Config.php");
		include(Routes::MODELS . "Db.php");
		include(Routes::UTILS . "ModelHelper.php");
		include(Routes::MODELS . "User.php");
		
		
	}
}

?>