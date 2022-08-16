<?php 
$t = s($_POST['t']);

if ($t != 'add') {
	$id = s($_POST['id']);
	if (empty($id) || !is_numeric($id)) {
		exit();
	}
	$info = $db->where('id', $id)->getOne('notify');
	if (empty($info)) {
		exit();
	}
}

if ($t == 'add') {
	$content = $_POST['content'];
	if (empty(trim($content))) {
		d([
			'status' => 0,
			'message' => 'Vui lòng nhập thông báo!'
		]);
	}
	$db->insert('notify', array(
		'content' => $content,
		'time' => time()
	));
	d([
		'status' => 1,
		'message' => 'Thêm thông báo thành công'
	]);
}

if ($t == 'info') {
	d($info);
}

if ($t == 'update') {
	$params = $_POST;
	unset($params['t']);
	unset($params['id']);
	$db->where('id', $id)->update('notify', $params);
	d([
		'status' => 1,
		'message' => 'Cập nhật thông báo thành công'
	]);
}

if ($t == 'delete') {
	$db->where('id', $id)->delete('notify');
	d([
		'status' => 1,
		'message' => 'Xóa thông báo thành công'
	]);
}

?>