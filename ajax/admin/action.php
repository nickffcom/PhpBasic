<?php 
$t = s($_POST['t']);

if ($t == 'settings') {
	$params = $_POST;
	unset($params['t']);
	$db->update('settings', $params);
	d([
		'status' => 1,
		'message' => 'Lưu cài đặt thành công'
	]);
}

if ($t == 'delete_history') {
	$id = s($_POST['id']);
	if (empty($id) || !is_numeric($id)) {
		exit();
	}
	$db->where('id', $id)->delete('history');
	d([
		'status' => 1,
		'message' => 'Xóa lịch sử thành công'
	]);
}
?>