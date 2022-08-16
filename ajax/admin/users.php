<?php 
$t = s($_POST['t']);

$uid = s($_POST['uid']);
if (empty($uid) || !is_numeric($uid)) {
	exit();
}

$info = $db->where('uid', $uid)->getOne('users');

if (empty($info)) {
	d([
		'status' => 0,
		'message' => 'Thành viên không tồn tại'
	]);
}

if ($uid == $me->uid) {
	d([
		'status' => 0,
		'message' => 'Không thể thao tác tài khoản của bản thân!'
	]);
}

if ($t == 'info') {
	d($info);
}

if ($t == 'update') {
	$params = $_POST;
	unset($params['t']);
	unset($params['uid']);
	$db->where('uid', $uid)->update('users', $params);
	d([
		'status' => 1,
		'message' => 'Cập nhật thành viên thành công'
	]);
}

if ($t == 'delete') {
	$db->where('uid', $uid)->delete('users');
	d([
		'status' => 1,
		'message' => 'Xóa thành công'
	]);
}
?>