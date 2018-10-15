<?php
ob_start();
require_once '../app/inc/autoloader.inc.php';

session_start();
/*
$_SESSION['token'] = md5(uniqid(mt_rand(), true));
*/

// includerar init.php som 'startar' sidan

require_once '../app/init.php';


 //instansierar varukorgen så att den är tillgänglig över hela sidan
 if (!isset($_SESSION['cart'])) {
 	$_SESSION['cart'] = new SessionCart();
 }


// include header
include '../app/views/header.php';

// Instatiates a new app, i.e the whole page
$app = new App;

// include footer
include '../app/views/footer.php';





