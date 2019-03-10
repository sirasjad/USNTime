<?php
// USNTime - Utviklet av Sirajuddin Asjad
// GitHub: https://github.com/sirasjad/usntime
// E-post: admin@siratech.no

session_start(); ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require($_SERVER['DOCUMENT_ROOT'].'core.php');
require($_SERVER['DOCUMENT_ROOT'].'sql.class.php');
require($_SERVER['DOCUMENT_ROOT'].'user.class.php');

$core = new USN;
$core->validPage();
$core->checkSession();

switch($_GET['side']){
    case 'login': include("pages/login.php"); break;
    case 'dashboard': include("pages/dashboard.php"); break;
    default: include("pages/dashboard.php"); break;
}

?>