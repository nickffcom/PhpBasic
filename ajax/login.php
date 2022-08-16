<?php 
//require './core/config.php';
// config của file nayuf đâu
// session_start(); // kh dc thì tchiuj rối ác haha=( )
$username = s($_POST['username']);
$password = s($_POST['password']);
if (empty($username) || empty($password)) {
	d([
		'status' => 0,
		'message' => 'Vui lòng nhập tài khoản và mật khẩu'
	]);
}
$info = $db->where('username', $username)->where('password', $password)->getOne('users', array('uid'));
if (empty($info)) {
	d([
		'status' => 0,
		'message' => 'Tên đăng nhập hoặc mật khẩu không đúng'
	]);
}
if (!empty($info['uid'])) {
	$tk=base64url_encode($username);
	$mk=base64url_encode($password);
	$_SESSION['uid'] = $info['uid']; // dạ đây anh
	d([
		'status' => 1,
		'message' => 'Đăng nhập thành công',
		'edenhazard'=>$tk,
		'chelsea_fc'=>$mk,
	]);
}
function base64url_encode($plainText) {
	$base64 = base64_encode($plainText);
	$base64url = strtr($base64, '+/=', '-_,');
	return $base64url;
	}
?>