<?php
ob_start();
require_once '../app/inc/autoloader.inc.php';

session_start();

// include init.php to initiate page

require_once '../app/init.php';

// include header
include '../app/views/header.php';

// Instatiates a new app, i.e the whole page
$app = new Admin_app;

// include footer
//include '../app/views/footer.php';



