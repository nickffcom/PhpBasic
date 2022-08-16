<?php
// require_once 'model_change.php';
// error_reporting(0);
// $uid=isset($_POST['uid'])?trim($_POST['uid']):'';
// $proxy=isset($_POST['proxy'])?$_POST['proxy']:'';
// $passmail=$_POST['passmail'];
// $hotmail=$_POST['hotmail'];

// $curlVia=new mycurl();
// $kqproxy="Lỗi";
// $tokenvia=null;
// if(strpos($cookies,'c_user')!==false){
//     $curlVia->setCookies($cookies);
//     $tokenvia = GetTokenAds($curlVia);
// }else if(!empty($uid)||isset($_POST['pass'])||isset($_POST['key2fa']) ){
//     // $uid=$_POST['uid'];
//     $pass=$_POST['pass'];
//     $key2fa=$_POST['key2fa'];
//     $kqlogin =Login2FA($curlVia,$uid,$pass,$key2fa);
//     if(preg_match('/c_user/',$kqlogin)){
        
//     }else{
//        echo  Message(false,"Login uid|pass|2fa fail=>".$kqlogin,'','','');
//        $curlVia->Close();
//        return;
//     }

//     $tokenvia = GetTokenAds($curlVia);
   
// }else{
//     echo Message(false,"Ko biết chạy đường nào luôn !!!",'','','');
//     $curlVia->Close();
// }


// if(IsNullOrEmpty($tokenvia)){
//     echo Message(false,"Lấy token via nhận thất bại/Cookies Die",'','','');
//     $curlVia->Close();
//     return;
// }
// $kqaddmail =AddMail($curlVia,$hotmail,$passmail);
// if(preg_match('/redirectPageTo(.*?true)/',$ketqua)){


// }else{
//     echo Message(false,"Add mail thất bại =>>Out",'','',$curlVia->getCookies());
//     $curlVia->Close();
//     return;
// }

?>