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

switch($_GET['page']){
    case 'login': include("pages/login.php"); break;
    case 'logout': $core->userLogout(); break;
    case 'dashboard': include("pages/dashboard.php"); break;
    case 'register': include("pages/register.php"); break;
    case 'subjects': include("pages/subjects.php"); break;
    case 'attendance': include("pages/attendance.php"); break;
    case 'view-subject': include("pages/view-subject.php"); break;
    case 'register-attendance': include("pages/register-attendance.php"); break;
    case 'manage-students': include("pages/manage-students.php"); break;
    case 'view-lecture': include("pages/view-lecture.php"); break;
    case 'search-student': include("pages/search-student.php"); break;
    case 'logs': include("pages/logs.php"); break;
    default: include("pages/dashboard.php"); break;
}

?>