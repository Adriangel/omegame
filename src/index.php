<?php
define("ROOT", __DIR__ . "\\");

include(ROOT . "controllers\GeneralController.php");
include(ROOT . "controllers\Routes.php");
GeneralController::main();
?>