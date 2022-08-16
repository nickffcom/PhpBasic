<?php 
$username = s($_POST['username']);
$money = s($_POST['money']);
$action = s($_POST['action']);
if (empty($username)) {
	exit();
}
$info = $db->where('username', $username)->getOne('users');
if (empty($info)) {
	d([
		'status' => 0,
		'message' => 'Tài khoản không tồn tại'
	]);
}
if (empty($money)) {
	d([
		'status' => 0,
		'message' => 'Số tiền không hợp lệ, ít nhất là 1 VNĐ'
	]);
}
switch ($action) {
	case 'plus':
		$text = "Cộng ". number_format($money) ." VNĐ vào tài khoản $username thành công !";
		$sql = "UPDATE users SET money = money + $money WHERE uid = " . $info['uid'];
		break;

	case 'minus':
		$text = "Trừ ". number_format($money) ." VNĐ vào tài khoản $username thành công !";
		$sql = "UPDATE users SET money = money - $money WHERE uid = " . $info['uid'];
		break;
	
	default:
		exit();
		break;
}
if ($conn->query($sql)) {

	if ($action == 'plus') {
		$db->insert('history', array(
			'content' => 'Nạp tiền vào tài khoản',
			'total_money' => $money,
			'type' => 'payment',
			'time' => time(),
			'uid' => $info['uid']
		));
	}

	d([
		'status' => 1,
		'message' => $text
	]);
}
?>