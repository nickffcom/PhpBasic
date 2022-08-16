<?php

require_once 'xulyproxy.php';
require_once 'mycurl.php';
require_once 'model.php';
require_once 'msg.php';

$uid=isset($_POST['uid'])?trim($_POST['uid']):'';
$proxy=isset($_POST['proxy'])?$_POST['proxy']:'';
$tmproxy=isset($_POST['tmproxy'])?$_POST['tmproxy']:'';
$cookies=isset($_POST['cookies'])?$_POST['cookies']:'';
$tokenvia=isset($_POST['tokennick'])?$_POST['tokennick']:exit;


// echo Message(false,"Chức năng này sắp tới sẽ ra mắt");
// return;


require 'config_proxy.php';
$curlVia= new mycurl($kqproxy,$user_pwd);
$haha=$db->insert('history_tool', array(
    'user' => $me['username'],
    'time_su_dung'=>time(), 
    'description' =>':D',
    'chuc_nang'=>'Add thẻ sắp tới mới chạy được'
));
// cách lấy token đây  window.__accessToken=\"(EAA.*?)\"
if(strpos($tokenvia,'EAA')!==false){
  
}
else if(strpos($tokenvia,'c_user')!==false){
    $curlVia->setCookies($tokenvia);
    $tokenvia = GetTokenAds($curlVia);
    if(IsNullOrEmpty($tokenvia)){
        echo Message(false,"Lấy token via thất bại/Cookies die",'','','');
        $curlVia->Close();
        return;
    }

}else{
    echo Message(false,'Định dạng Sai');
    $curlVia->Close();
    exit();
}  

$idtkqc=isset($_POST['idtkqc'])?$_POST['idtkqc']:exit();
$thenek=isset($_POST['thenek'])?$_POST['thenek']:exit;
$arrthe=explode('|',$thenek);
if(count($arrthe)<4){
    exit("Sai định dạng");
}
$nameCard=$arrthe[0];
$numberCard=$arrthe[0];
$thanghethan=$arrthe[1];;
$namhethan=$arrthe[2];
$csv=$arrthe[3];
$zip=isset($arrthe[4])?$arrthe[4]:'';
$country_code=isset($arrthe[5])?$arrthe[5]:'';

$url="https://graph.secure.facebook.com/ajax/payment/token_proxy.php?tpe=%2Fv5.0%2Fact_$idtkqc%2Fcredit_cards";
$temp="{\"zip\":\"$zip\",\"country_code\":\"$country_code\"}";
$data=array(
    'auth_mode'=>'auth',
    'billing_address'=>$temp,
    'card_holder_name'=>$nameCard,
    'creditCardNumber'=>$numberCard,
    'csc'=>$csv,
    'expiry_month'=>$thanghethan,
    'expiry_year'=>$namhethan,
    'locale'=>'en_GB',
    'payment_type'=>'ads_invoice',
    'access_token'=>$tokenvia,
);
$kq=$curlVia->post($url,$data);
if(preg_match('/error_user_title\": \"(.*?)\"/',$kq,$loinek)){
    echo Message(false,"Fb Nói Lỗi: ".$loinek[1],'','','');
    
}else{
    preg_match('/message\": \"(.*?)\"/',$kq,$loinek);
  echo Message(true,"Tự check:".$loinek[1]."|".$kq);
}
$curlVia->Close();
return;
// {
//     "error": {
//        "message": "Credit card is in use in too many accounts.",
//        "type": "FacebookApiException",
//        "code": 5227,
//        "error_data": {
          
//        },
//        "error_subcode": 2078073,
//        "is_transient": false,
//        "error_user_title": "Unable to add card",
//        "error_user_msg": "Your card is associated with too many ad accounts. Please select a different payment method and try again.",
//        "error_user_title_html": {
//           "__html": "Unable to add card"
//        },
//        "error_user_msg_html": {
//           "__html": "Your card is associated with too many ad accounts. Please select a different payment method and try again."
//        },
//        "fbtrace_id": "ALOyubLl80UDVXM6fdJ-NYV"
//     }
//  }

// "{
//     "error": {
//        "message": "An unknown error occurred",
//        "type": "FacebookApiException",
//        "code": 1,
//        "error_subcode": 2078011,
//        "is_transient": false,
//        "error_user_title": "Something went wrong",
//        "error_user_msg": "We're having trouble with completing your request. Please try again.",
//        "fbtrace_id": "AgYZWciNG0Wgig1C1Bj6-w3"
//     },
//     "__fb_trace_id__": "AG+jgRh6Z7w",
//     "__www_request_id__": "AgYZWciNG0Wgig1C1Bj6-w3"
//  }"




?>