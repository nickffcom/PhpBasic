<?php 
$typeVaild = array('bm', 'via', 'clone','proxy');

$typeFormat = array(
	'bm' => 'id|link',
	'via' => 'uid|password|email|password_email|2fa',
	'clone' => 'uid|password|email|password_email|2fa'
);

$typeUpdate = array(
	'bm' => 'bm_id|bm_link',
	'via' => 'user_id|password|email|password_email|2fa',
	'clone' => 'user_id|password|email|password_email|2fa'
);
?>