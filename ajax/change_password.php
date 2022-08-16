<?php 
$password = s($_POST['password']);
$new_password = s($_POST['new_password']);
$confirm_password = s($_POST['confirm_password']);
if ($password != $me->password) {
	d([
		'status' => 0,
		'message' => 'Mật khẩu cũ không chính xác'
	]);
}
if (strlen($new_password) < 6) {
	d([
		'status' => 0,
		'message' => 'Mật khẩu mới phải trên 6 ký tự'
	]);
}
if ($new_password == $password) {
	d([
		'status' => 0,
		'message' => 'Mật khẩu mới không được giống mật khẩu cũ'
	]);
}
if ($new_password != $confirm_password) {
	d([
		'status' => 0,
		'message' => 'Mật khẩu mới nhập lại không khớp'
	]);
}
if ($new_password == $me->username) {
	d([
		'status' => 0,
		'message' => 'Mật khẩu mới không được giống tài khoản'
	]);
}
$update = $db->where('uid', $me->uid)->update('users', array(
	'password' => $new_password
));
if ($update) {
	d([
		'status' => 1,
		'message' => 'Đổi mật khẩu thành công'
	]);
}
?>