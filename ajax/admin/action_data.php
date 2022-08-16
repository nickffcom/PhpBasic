<?php 
$t = s($_POST['t']);

if ($t == 'upload_backup') {
	$files = $_FILES['files'];
	if (empty(array_filter($files['name']))) {
		d([
			'status' => 0,
			'message' => 'Vui lòng tải lên ít nhất 1 File ( .html )'
		]);
	}
	$total = count($files['name']);
	$success = 0;
	$error = 0;
	foreach ($files['name'] as $k => $x) {
		if (
			preg_match('/[0-9]+/', basename($x)) && 
			strpos($files['type'][$k], 'html', 0) !== false && 
			$files['error'][$k] == 0) 
		{
			$tmp = $files['tmp_name'][$k];
			@move_uploaded_file($tmp, 'files/service/backup_folder/' . basename($x));
			$success++;
		} else {
			$error++;
		}
	}
	d([
		'status' => 1,
		'message' => "Upload thành công $success/$total Backup",
		'count' => array(
			'total' => $total,
			'success' => $success,
			'error' => $error
		)
	]);
}

if ($t != 'add') {
	$id = s($_POST['id']);
	if (empty($id) || !is_numeric($id)) {
		exit();
	}
	$info = $db->where('id', $id)->getOne('data_service');
	if (empty($info)) {
		d([
			'status' => 0,
			'message' => 'Dữ liệu không tồn tại'
		]);
	}
}

if ($t == 'add') {

	$type_id = s($_POST['type_id']);
	if (empty($type_id) || !is_numeric($type_id)) {
		d([
			'status' => 0,
			'message' => 'Vui lòng phân loại trước khi thêm'
		]);
	}

	$d = $db->where('id', $type_id)->getOne('service');

	if (empty($d)) {
		d([
			'status' => 0,
			'message' => 'Dữ liệu không tồn tại'
		]);
	}

	$data = trim($_POST['data']);
	if (empty($data)) {
		d([
			'status' => 0,
			'message' => 'Vui lòng nhập dữ liệu cần thêm'
		]);
	}
	$data = explode("\n", $data);
	$data = array_map('trim', $data);

	$success = 0;
	$error = 0;

	foreach ($data as $exp) {
		if ($d['type'] == 'via' || $d['type'] == 'clone') {
			list($user_id, $password, $email, $password_email, $twofa) = explode('|', $exp);
			/*$check = cURL("https://graph.facebook.com/$user_id?access_token=$tokenx&method=get");
			$check = json_decode($check, true);
			if (!empty($check['id'])) {*/
				$ins_data = array(
					'user_id' => $user_id,
					'password' => $password,
					'email' => $email,
					'password_email' => $password_email,
					'2fa' => $twofa,
					'type_id' => $type_id,
					'status' => 1,
					'time' => time()
				);
			// }
		}
		if ($d['type'] == 'bm') {
			list($bm_id, $bm_link) = explode('|', $exp);
			$ins_data = array(
				'bm_id' => $bm_id,
				'bm_link' => $bm_link,
				'type_id' => $type_id,
				'status' => 1,
				'time' => time()
			);
		}
		if (!empty($ins_data)) {
			if ($db->insert('data_service', $ins_data)) {
				$success++;
			} else {
				$error++;
			}
		} else {
			$error++;
		}
	}

	d([
		'status' => 1,
		'count' => array(
			'success' => $success,
			'error' => $error
		)
	]);
}

if ($t == 'info') {
	d($info);
}

if ($t == 'update') {
	$params = $_POST;
	unset($params['t']);
	unset($params['id']);
	$db->where('id', $id)->update('data_service', $params);
	d([
		'status' => 1,
		'message' => 'Cập nhật thành công'
	]);
}

if ($t == 'delete') {
	$db->where('id', $id)->delete('data_service');
	d([
		'status' => 1,
		'message' => 'Xóa thành công'
	]);
}
?>