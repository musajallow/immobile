<?php

require_once 'core/app.php';
require_once 'core/base_controller.php';

// Defined constants for file paths
// This way file paths can be changed in one place
// Directory separator = \

define("DS", DIRECTORY_SEPARATOR);
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH.DS.'public'.DS);
define("CONTROLLER_PATH", PRIVATE_PATH.DS.'controllers'.DS);
define("MODEL_PATH", PRIVATE_PATH.DS.'models'.DS);
define("VIEW_PATH", PRIVATE_PATH.DS.'views'.DS);
define("INC_PATH", PRIVATE_PATH.DS.'inc'.DS);
define("CORE_PATH", PRIVATE_PATH.DS.'core'.DS);

// admin

define("ADMIN_PATH", PROJECT_PATH.DS.'admin');
define("ADMIN_CONTROLLER", ADMIN_PATH.DS.'controllers'.DS);
define("ADMIN_MODEL", ADMIN_PATH.DS.'models'.DS);
define("ADMIN_VIEW", ADMIN_PATH.DS.'views'.DS);
define("ADMIN_DEFAULT", 'adminpanel');

