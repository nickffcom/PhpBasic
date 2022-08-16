<?php 
$t = s($_POST['t']);

if ($t != 'add') {
	$id = s($_POST['id']);
	if (empty($id) || !is_numeric($id)) {
		exit();
	}
	$data = $db->where('id', $id)->getOne('service');
	if (empty($data)) {
		d([
			'status' => 0,
			'message' => 'Dịch vụ không tồn tại'
		]);
	}
}

if ($t == 'info') {
	d($data);
}

if ($t == 'update') {
	$params = $_POST;
	unset($params['t']);
	unset($params['id']);
	$db->where('id', $id)->update('service', $params);
	d([
		'status' => 1,
		'message' => 'Cập nhật thành công'
	]);
}

if ($t == 'add') {
	$name = s($_POST['name']);
	$description = s($_POST['description']);
	$price = s($_POST['price']);
	$type = s($_POST['type']);
	if (!in_array($type, $typeVaild)) {
		exit();
	}
	$db->insert('service', array(
		'name' => $name,
		'description' => $description,
		'price' => $price,
		'type' => $type,
		'time' => time()
	));
	d([
		'status' => 1,
		'message' => 'Thêm thành công'
	]);
}

if ($t == 'delete') {
	$db->where('id', $id)->delete('service');
	d([
		'status' => 1,
		'message' => 'Xóa dịch vụ thành công'
	]);
}
?>