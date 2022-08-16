<?php 
$id = s($_POST['id']);
$type = s($_POST['type']);
$quantity = s($_POST['quantity']);
if (empty($id)) {
	exit();
}
$data = $db->where('id', $id)->getOne('service');

if (empty($data)) {
	d([
		'status' => 0,
		'message' => 'Dịch vụ không hợp lệ'
	]);
}

if ($quantity < 1) {
	d([
		'status' => 0,
		'message' => 'Mua ít nhất 1 ' . mb_strtoupper($data['type'])
	]);
}

$get_service = $db->where('type_id', $id)->where('status', 1)->orderBy('RAND()')->get('data_service', $quantity, array('id'));

if ($quantity > count($get_service)) {
	d([
		'status' => 0,
		'message' => 'Không đủ số lượng ' . mb_strtoupper($data['type']) . ' bạn mua, vui lòng thử chọn số lượng thấp hơn!'
	]);
}

$price = $data['price'];

$total_money = ($price * $quantity);

if (!(($me->money - $total_money) >= 0)) {
	d([
		'status' => 0,
		'message' => 'Bạn không đủ ' . number_format($total_money) . ' VNĐ để thực hiện giao dịch!'
	]);
}

$ref_code = md5(rand(0, 999999) . time() . microtime() . base64_encode(time()) . base64_encode(microtime()) . rand(0, 999999));

$times = time();

foreach ($get_service as $add) {
	$haha=$db->insert('order_service', array(
		'ref_id' => $add['id'],
		'code' => $ref_code,
		'price' => $price,
		'time' => $times,
		'uid' => $me->uid
	));
	$haha=$db->where('id', $add['id'])->update('data_service', array(
		'status' => 0
	));
}


$haha=$db->insert('history', array(
	'content' => "Mua " . number_format($quantity) . " {$data['name']}",
	'total_money' => $total_money,
	'type' => 'service',
	'time' => $times,
	'uid' => $me->uid
));

$minus_money = "UPDATE users SET money = money - $total_money WHERE uid = " . $me->uid;

if ($conn->query($minus_money)) {
	$result = array(
		'status' => 1,
		'message' => 'Thanh toán thành công',
		'move_location' => '/order?type='. $data['type'] .'&id=' . $id
	);
	d($result);
}

?>