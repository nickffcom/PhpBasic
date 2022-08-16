<?php
// require_once 'config_tools.php';
error_reporting(0);
require_once 'xulyproxy.php';
require_once 'mycurl.php';
require_once 'model.php';
require_once 'msg.php';

$tokenvia=isset($_POST['tokenvia'])?trim($_POST['tokenvia']):exit; // token nick cầm BM
$idbm=isset($_POST['idbm'])?trim($_POST['idbm']):exit();  // Id bm
$uid=isset($_POST['uid'])?trim($_POST['uid']):null;
$proxy=isset($_POST['proxy'])?$_POST['proxy']:'';  
$tmproxy=isset($_POST['tmproxy'])?$_POST['tmproxy']:'';
$cookies=isset($_POST['cookies'])?$_POST['cookies']:'';


// Config Proxy

require 'config_proxy.php';
$curlClone= new mycurl($kqproxy,$user_pwd);

// ///////////////// end Config Proxy
$haha=$db->insert('history_tool', array(
    'user' => $me['username'],
    'time_su_dung'=>time(), 
    'description' =>':D',
    'chuc_nang'=>'Share TKQC Clone Vào BM'
));
if(strpos($tokenvia,'EAAB')!==false||strpos($tokenvia,'EAAG')!==false){
  

}else{
    exit();
}

if(!empty($cookies)){
    $curlClone->setCookies($cookies);
    
}else if(!empty($uid)||isset($_POST['pass'])||isset($_POST['key2fa']) ){
        // $uid=$_POST['uid'];
        $pass=$_POST['pass'];
        $key2fa=$_POST['key2fa'];
        $kqlogin =Login2FA($curlClone,$uid,$pass,$key2fa);
        if(preg_match('/c_user/',$kqlogin)){
            
        }else{
            echo  Message(false,"Login uid|pass|2fa fail=>".$kqlogin,'','','');
            $curlClone->Close();
            return;
        }
    
}

$tokenclone = GetTokenAds($curlClone);
if(IsNullOrEmpty($tokenclone)){
           echo Message(false,"Lấy Token Fail->Cookies Die",'','','');
           return;
}    
   


$idads="";
$idads=getIdAds($curlClone,$tokenclone);
if(IsNullOrEmpty($idads)){
    // echo Message(false,"Token bị chặn hay sao đó",'','','');
    // $curlVia->Close();
    // return;
    
        $haha = $curlClone->get("https://www.facebook.com/ads/manager/accounts");
        preg_match('/ads.manage.campaigns..act=([0-9]{5,})/',$haha,$bun);
        if(isset($bun[1])){
            $idads=$bun[1];
        }else{
            echo  Message(false,"Ko lấy được id tkqc",'','','');
            $curlVia->Close();
            return;
        }
    
    
}

$curlViaChinh = new mycurl($kqproxy,$user_pwd);
$guiloimoi=LoiMoiAcceptTkqc($curlViaChinh,$idbm,$idads,$tokenvia);   // tao lời mời vào tkqc của 
if(strpos($guiloimoi,'error')!==false && preg_match('/message\": \"(.*?)\"/',$guiloimoi,$loinek)){
    if(preg_match('/accepted/',$guiloimoi)){
         "Ok";
    }else{
        echo Message(false,"Lỗi:"+$loinek[1],'',$idads,'');
        $curlViaChinh->Close();
        $curlClone->Close();
        return ;
    }
    
}else if(preg_match('/access_status/',$guiloimoi)){
    preg_match('/access_status\":(.*?)\"/',$kq,$stt);

}else if(strpos($guiloimoi,'has already')!==false){

}else if(strpos($guiloimoi,'has access to the object')!==false||strpos($guiloimoi,'CONFIRMED')!==false){
    echo Message(true,"TKQC này đã ADD thành công từ trước rồi <3",$idads,'Không đổi',$curlClone->getCookies());
    $curlClone->Close();
    $curlViaChinh->Close();
    return;

}else if(preg_match('/message\":\"(.*?),/',$guiloimoi,$haizz)){

    echo Message(false,"Lỗi mời thêm tkqc:".$haizz[1],$tokenclone,$idads,$curlClone->getCookies());
    $curlClone->Close();
    $curlViaChinh->Close();
    return;

}else{
    echo Message(false,"Gừi lời mời thêm tkqc k xác định",$tokenclone,$idads,$curlClone->getCookies());
    $curlClone->Close();
    $curlViaChinh->Close();
    return;
}
//////////////////////
$chapnhan=PheduyetBM($curlClone,$idads,$idbm);
if(preg_match('/errorDescription\":\"(.*?)\"/',$chapnhan,$loi)||strpos($chapnhan,'error')!==false){

    echo Message(false,"Lỗi chấp nhận lời mời:".$loi[1]."Or nick bị HCQC",$curlClone->getCookies());
    $curlViaChinh->Close();
    $curlClone->Close();
    return "";
}else if(strpos($chapnhan,'reloadPage')!==false){
    echo Message(true,"Thành công =>> Ngọt lước Ads69.Net",$idads,'Không đổi tên',$curlClone->getCookies());
    $curlViaChinh->Close();
    $curlClone->Close();
}else if(strpos($chapnhan,'is_final')!==false){
    echo Message(false,"K xác định @@ Check coi share ok chưa !!",$curlClone->getCookies());
    $curlViaChinh->Close();
    $curlClone->Close();
}else if(preg_match('/message\":\"(.*?),/',$chapnhan,$loi)){
    echo Message(false,"Clone chấp nhận lời mời BM Fail: ".$loi[1],$curlClone->getCookies());
    $curlViaChinh->Close();
    $curlClone->Close();
}
else{
    echo Message(false,"Chấp nhận lời mời bị cc gì r ấy @@!!",$curlClone->getCookies());
    $curlViaChinh->Close();
    $curlClone->Close();
}
?>