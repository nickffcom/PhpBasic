<?php

header("content-type:application/json");
function Message($status, $message, $ads_id = '', $ads_name = '', $cookie)
{
    $notice = array(
        "status" => $status,
        "message" => $message,
        "data" => array(
            "ads_id" => $ads_id,
            "ads_name" => $ads_name,
            "cookie" => $cookie
        )
    );
    return json_encode($notice);
}

// $bm_id = $_POST['bm_id'];  // BM ID
// $bm_token = $_POST['bm_token']; //BM Token EAAG
// $cookie = $_POST['cookie']; // Cookie
// $proxyOptional = $_POST['proxyOptional']; // Mã Proxy
// $uid = $_POST['uid']; // UID Clone
// $_2fa = $_POST['_2fa']; // 2FA Clone
// echo Message(true, 'Thành Công', $ads_id = '', $ads_name = '', $cookie); // Trả Về Mã Thành Công Để Set Thành Công
//echo Message(true, 'Không Thành Công', $ads_id = '', $ads_name = '', $cookie); // Trả Về Mã Không Thành Công Để Set Lỗi
?>