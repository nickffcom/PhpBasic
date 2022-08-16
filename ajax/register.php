<?php 
$username = s($_POST['username']);
$password = s($_POST['password']);
$confirm_password = s($_POST['confirm_password']);
if (empty($username) || empty($password) || empty($confirm_password)) {
	d([
		'status' => 0,
		'message' => 'Vui lòng nhập đầy đủ thông tin'
	]);
}

if (strlen($username) < 6) {
	d([
		'status' => 0,
		'message' => 'Tài khoản và mật khẩu phải trên 6 ký tự'
	]);
}

if (!preg_match('/^[A-Za-z0-9_\.]+$/', $username)) {
	d([
		'status' => 0,
		'message' => 'Tài khoản không sử dụng ký tự đặc biệt'
	]);
}

if ($password !== $confirm_password) {
	d([
		'status' => 0,
		'message' => 'Mật khẩu không khớp'
	]);
}

$is_exists = $db->where('username', $username)->getValue('users', 'count(*)');

if ($is_exists > 0) {
	d([
		'status' => 0,
		'message' => 'Tên đăng nhập đã tồn tại.'
	]);
}

$ins = $db->insert('users', array(
	'username' => $username,
	'password' => $password,
	'money' => 0,
	'is_admin' => 0,
	'create_time' => strtotime('now')
));


if ($ins) {
	$_SESSION['uid'] = $ins;
	d([
		'status' => 1,
		'message' => 'Đăng ký thành công'
	]);
}

?>