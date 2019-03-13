<?php
// USNTime - Utviklet av Sirajuddin Asjad
// GitHub: https://github.com/sirasjad/usntime
// E-post: admin@siratech.no

session_start(); ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require($_SERVER['DOCUMENT_ROOT'].'/inc/core.php');
require($_SERVER['DOCUMENT_ROOT'].'/inc/sql.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/inc/user.class.php');

$core = new USN;
$core->validPage();
$core->loginState();
$core->setId();

switch($_GET['page']){
    case 'login': include("pages/login.php"); break;
    case 'logout': $core->userLogout(); break;
    case 'dashboard': include("pages/dashboard.php"); break;
    default: include("pages/dashboard.php"); break;
}

?>