<?php
// USNTime API
// GitHub: https://github.com/sirasjad/usntime
// E-post: admin@siratech.no

session_start(); ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require($_SERVER['DOCUMENT_ROOT'].'/core.php');
require($_SERVER['DOCUMENT_ROOT'].'/sql.class.php');
require($_SERVER['DOCUMENT_ROOT'].'/api.class.php');

$core = new USN;
$core->getCommands();
$core->validUrl();

?>
