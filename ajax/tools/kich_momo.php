<?php
// require_once 'config_tools.php';
// require_once 'xulyproxy.php';
// require_once 'mycurl.php';
// require_once 'model.php';
// require_once 'msg.php';
// // $tokenvia=isset($_POST['tokenvia'])?trim($_POST['tokenvia']):exit;
// // $idbm=isset($_POST['idbm'])?trim($_POST['idbm']):'';
// // $tokenclone=isset($_POST['tokenclone'])?trim($_POST['tokenclone']):'';
// //của clone
// $uid=isset($_POST['uid'])?trim($_POST['uid']):null;
// $proxy=isset($_POST['proxy'])?$_POST['proxy']:'';  // cái này là chỉ share
// $cookies=isset($_POST['cookies'])?$_POST['cookies']:'';
// $tmproxy=isset($_POST['tmproxy'])?$_POST['tmproxy']:'';
// $minproxy=isset($_POST['minproxy'])?$_POST['minproxy']:'';
// $curlClone= new mycurl();

// if(strlen($tmproxy>10)){
//     $kqproxy= getCurrentTmproxy($tmproxy);
  
// }else if(strlen($minproxy)>10){
//     if($_POST['typeminproxy']==6){  // v6
//      $kqproxy=getCurrentV6MinProxy($curlClone,$minproxy);

//     }else{  // v4
//         $kqproxy=getCurrentV4MinProxy($curlClone,$minproxy);

//     }
// }else{
//     echo Message(false,"Cấu hình proxy như cc =>>Chỉnh lại đi <3",'','','');
//     $curlClone->Close();
//     return;
// }
// if(strpos($kqproxy,':')!==false){
//     $curlClone->setProxy($kqproxy);
// }else{
//     echo Message(false,"Lỗi Get IP Proxy:".$kqproxy,'','','');
//     $curlClone->Close();
//     return;
// }
// ////////////////////////

//     if(!empty($cookies)){

//             $curlClone->setCookies($cookies);
    
//     }else if(!empty($uid)||isset($_POST['pass'])||isset($_POST['key2fa']) ){
//         // $uid=$_POST['uid'];
//         $pass=$_POST['pass'];
//         $key2fa=$_POST['key2fa'];
//         $kqlogin =Login2FA($curlClone,$uid,$pass,$key2fa);
//         if(preg_match('/c_user/',$kqlogin)){
            
//         }else{
//             echo  Message(false,"Login uid|pass|2fa fail=>".$kqlogin,'','','');
//             return;
//         }
    
//     }

// $tokenclone =GetTokenAds($curlClone);
// if(IsNullOrEmpty($tokenclone)){
//            echo Message(false,"Lấy Token Fail->Cookies Die",'','','');
//            $curlClone->Close();
//             return;
// }else{
//     $idtkqc=getIdAds($id,$tokenclone);
//     if(isset($idtkqc)){
            
//     }else{
//         $haha = $curlClone->get("https://www.facebook.com/ads/manager/accounts");
//         preg_match('/campaigns/.act=([0-9]{5,})/',$haha,$bun);
//         if(isset($bun[1])){
//             $idtkqc=$bun[1];
//         }else{
//             echo  Message(false,"Ko lấy được id tkqc",'','','');
//         }

//     }

//     $kq =ChangeInfoAdsCk($curlClone,$idtkqc);
//     if(preg_match('/title\":\"MoMo Wallet\",/',$kq)||preg_match('/momo_wallet_checkout_api_vn/',$kq)||strpos($kq,'momo')){
        
//         echo  Message(true, "Kích Momo Success",$idtkqc,'',$curlClone->getCookies());
//         $curlClone->Close();
//         return;
      
//     }else if(preg_match('/is_personal\":false/',$kq)){
//         echo Message(false,"Kích Momo thất bại =<<<");
//         $curlClone->Close();
//         return "Kích Failed";
//     }else if(preg_match('/summary\":\"(.*?)\"/',$kq,$match)){
//         echo Message(false,"Fail: Lỗi nè:".$match[1],'','','');
//         $curlClone->Close();
//         return ;
//     }else{
//         echo Message(false,"Fail: Lỗi nè:".$match[1],'','','');
//         $curlClone->Close();
//         return;
//     }

// }    
   



?>