<?php 
/*
* Code by DTT ( https://www.facebook.com/207DTT.MMO1 )
* Create date : 28/9/2020
*/
error_reporting(0);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
session_regenerate_id(true);

date_default_timezone_set('Asia/Ho_Chi_Minh');
require 'data.php';
require 'libs/mysqli_class/vendor/autoload.php';
// $db_name = 'sql_ads69_net';
// $conn = new mysqli('localhost', 'sql_ads69_net', 'R8846yz2j5rrChbP', $db_name);  // db

$db_name = 'shopvuga_web';
// $conn = new mysqli('localhost:3307', 'root', '', $db_name); db xam app
$conn = new mysqli('localhost', 'root', 'root', $db_name);  // db mam pro

if (!$conn->select_db($db_name) || $conn->connect_errno) {
	exit('Error connect to Database...');
}
$db = new MysqliDb($conn);
if (!$db->ping()) {
	$db->connect();
}

$is_log = false;
$is_admin = false;
//echo $_SESSION['uid'];
//run
if (!empty($_SESSION['uid'])&&is_numeric($_SESSION['uid'])) {  // đây
	$me = $db->where('uid', $_SESSION['uid'])->getOne('users');
	if (!empty($me)) {
		$is_log = true;
	}
	$me = (object) $me;
	if ($me->is_admin == 1) {
		$is_admin = true;
	}
	if($me->money>30000){
		$useTool=true;
	}
}else{
	// echo "K thấy session";
	// return;
}

// Đây là trang Config.php
require 'functions.php';
 // đó  , giờ out cả session ngay cả request 1 luôn
if ($is_log) {
	$services = getServices();
}

$settings = $db->getOne('settings');

unset($settings['id']);

$tokenx = trim($settings['token_check']);
$tokenx = explode("\n", $tokenx);
$tokenx = $tokenx[array_rand($tokenx)];

$settings = (object) $settings;

$site_name = 'ads69.net';

$header_title = 'Ads69.net - Hệ thống bán BM, Via & Clone VN uy tính';

$logo_text = '<i class="fab fa-facebook-square"></i> ADS69';

$domain = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
// $domain="http://localhost/code69";
// $baotri = false;
?>