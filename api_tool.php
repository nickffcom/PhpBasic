<?php 

// Đây là File API
error_reporting(0);
require_once 'core/config_tool.php';


$path = isset($_GET['path'])?$_GET['path']:exit();
$files="ajax/tools/$path.php"; //  NÓ NHẢY VÔ ĐÂY NÈ BÁC

if (file_exists($files)) {
	require $files;
}else{

}


?>