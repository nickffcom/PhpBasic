<?php 

error_reporting(0);
require 'libs/mysqli_class/vendor/autoload.php';
// $db_name = 'sql_ads69_net';
// $conn = new mysqli('localhost', 'sql_ads69_net', 'R8846yz2j5rrChbP', $db_name);

$db_name = 'shopvuga_web';
// $conn = new mysqli('localhost:3307', 'root', '', $db_name); // xamp app
$conn = new mysqli('localhost', 'root', 'root', $db_name);  // db mam pro

if (!$conn->select_db($db_name) || $conn->connect_errno) {
	exit('Error connect to Database...');
}
$db = new MysqliDb($conn);
if (!$db->ping()) {
	$db->connect();
}
$tk=isset($_POST['edenhazard'])?$_POST['edenhazard']:exit("Ĩ ẹ nó");
$mk=isset($_POST['chelsea_fc'])?$_POST['chelsea_fc']:exit("Đbrr");
$tk=base64url_decode($tk);
$mk=base64url_decode($mk);
$info = $db->where('username', $tk)->where('password', $mk)->getOne('users', array('uid'));
if (empty($info)) {
    exit();
}
$me = $db->where('uid', $info['uid'])->getOne('users');
if (empty($me)) {
    exit();
}


function base64url_decode($plainText) {
    $base64url = strtr($plainText, '-_,', '+/=');
    $base64 = base64_decode($base64url);
    return $base64;
    }

?>