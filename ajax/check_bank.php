<?php
$t = s($_GET['t']);

$reg = '/(.*?) nap tien/i'; // (?:\s|.+)

if ($t == 'vietcombank') {
	$files = 'files/log_vietcombank_1.txt';
	$data = cURL('https://sieulike.me/api/utilities/vietcombank', array(
		'vcb_headers' => $settings->vietcombank_data,
		'file_name' => '5067_vietcombank'
	));
	$data = json_decode($data, true);
	if (empty($data['data'])) {
		exit($data['message']);
	}
	$arr_id = array();
	$fp = fopen($files, 'a+');
	while ($log = fgets($fp)) {
	    $exp_log = explode('|', $log);
	    $arr_id[] = $exp_log[0];
	}
	foreach ($data['data'] as $x) {
		if (!in_array($x['SoThamChieu'], array_map('trim', $arr_id)) && $x['SoTienGhiCo'] == '+') {
			if (preg_match($reg, mb_strtolower($x['MoTa']), $match)) {
				$username = $match[1];
				$username = str_replace('.', ' ', $username);
	    		$username = explode(' ', $username);
	    		$username = trim(end($username));
				$info = $db->where('username', $username)->getOne('users');
				if (!empty($info['uid'])) {
					$uid = $info['uid'];
					$money = $x['SoTienGhiNo'];
					$money = str_replace(',', '', $money);
					$money = trim($money);
					fwrite($fp, implode('|', $x) . "\n");
					if (is_numeric($money) && $money > 0) {
						$update = "UPDATE users SET money = money + $money WHERE uid = " . $uid;
						if ($conn->query($update)) {
							$db->insert('history', array(
								'action_id' => $x['SoThamChieu'],
								'content' => 'Nạp tiền qua Vietcombank',
								'total_money' => $money,
								'type' => 'payment',
								'time' => time(),
								'uid' => $uid 
							));
						}
					}
				}
			}
		}
	}
	fclose($fp);
}

if ($t == 'momo') {
	$files = 'files/log_momo_1.txt';
	$data = cURL('https://sieulike.me/api/utilities/momo', array(
		'email' => 'cuboy99x@gmail.com',
		'password' => 'nqdiencuboy99'
	));
	$data = json_decode($data, true);
	if (empty($data['data'])) {
		exit($data['message']);
	}
	$arr_id = array();
	$fp = fopen($files, 'a+');
	while ($log = fgets($fp)) {
	    $exp_log = explode('|', $log);
	    $arr_id[] = $exp_log[0];
	}
	foreach ($data['data'] as $x) {
		if (!in_array($x['tranId'], array_map('trim', $arr_id))) {
			if (preg_match($reg, mb_strtolower($x['comment']), $match)) {
				$username = $match[1];
				$username = explode(' ', $username);
				$username = trim(end($username));
				$info = $db->where('username', $username)->getOne('users');
				if (!empty($info['uid'])) {
					$uid = $info['uid'];
					$money = $x['amount'];
					fwrite($fp, implode('|', $x) . '|' . date('H:i:s - d/m/Y', time()) . "\n");
					if (is_numeric($money) && $money > 0) {
						$update = "UPDATE users SET money = money + $money WHERE uid = " . $uid;
						if ($conn->query($update)) {
							$db->insert('history', array(
								'action_id' => $x['tranId'],
								'content' => 'Nạp tiền qua Momo',
								'total_money' => $money,
								'type' => 'payment',
								'time' => time(),
								'uid' => $uid 
							));
						}
					}
				}
			}
		}
	}
	fclose($fp);
}
?>