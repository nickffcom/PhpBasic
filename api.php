<?php 
/*
* Code by DTT ( https://www.facebook.com/207DTT.MMO1 )
* Create date : 28/9/2020
*/
    require 'core/config.php'; // NÓ NHẢY VÀO ĐÂY , THÌ Ở CORE ĐÃ CÓ SESSION START RỒI  hình như nãy sửa ở đây
 // đây là trang API.PHP
// session_start();
$path = s($_GET['path']);

if (empty($path)) {
	exit();
}

if (strpos($path, 'check_bank', 0) !== false) {
    include "ajax/check_bank.php";
    exit();
}

if (in_array($path, array('login', 'register'))) {
    if ($is_log) {
        exit();
    }
} else {
    if (!$is_log) {
    }
}

if (strpos($path, 'admin', 0) !== false && !$is_admin) {
	exit();
}
if(strpos($path,'tools')!==false){
    //  $files="ajax/$path.php"; //  NÓ NHẢY VÔ ĐÂY NÈ BÁC
    exit();
}else{
    $files = "ajax/$path.php";
}



if (file_exists($files)) {
	require $files;
}

exit();
?>