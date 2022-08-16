<?php
// require_once '../../core/config.php';  
// require_once 'config_tools.php';


require_once 'xulyproxy.php';
require_once 'mycurl.php';
require_once 'model.php';
require_once 'msg.php';


// đó 2 request, thì request 1 có session , 2 ko có vẫn k có
$uid=isset($_POST['uid'])?trim($_POST['uid']):'';
$proxy=isset($_POST['proxy'])?$_POST['proxy']:'';
$cookies=isset($_POST['cookies'])?$_POST['cookies']:'';
$checklimit=isset($_POST['checklimit'])?trim($_POST['checklimit']):'';
$checknamtao=isset($_POST['checknamtao'])?trim($_POST['checknamtao']):'';
$checkHcqc=isset($_POST['checkhcqc'])?$_POST['checkhcqc']:'';
$tmproxy=isset($_POST['tmproxy'])?$_POST['tmproxy']:'';

$tokenvia="";
require 'config_proxy.php';
$curlVia= new mycurl($kqproxy,$user_pwd);

$haha=$db->insert('history_tool', array(
    'user' => $me['username'],
    'time_su_dung'=>time(), 
    'description' =>':D',
    'chuc_nang'=>'Check Info Via'
));
///////////////////////////////////

 if(strpos($cookies,'c_user')!==false){
    $curlVia->setCookies($cookies);
    $tokenvia = GetTokenAds($curlVia);


}else if(!empty($uid)||isset($_POST['pass'])||isset($_POST['key2fa']) ){
    // $uid=$_POST['uid'];
    $pass=$_POST['pass'];
    $key2fa=$_POST['key2fa'];
    $kqlogin =Login2FA($curlVia,$uid,$pass,$key2fa);
    if(preg_match('/c_user/',$kqlogin)){
        
    }else{
       echo  Message(false,"Login uid|pass|2fa fail=>".$kqlogin,'','','');
       $curlVia->Close();
       return;
    }

    $tokenvia = GetTokenAds($curlVia);
   
}else{
    echo Message(false,"Ko biết chạy đường nào luôn !!!",'','','');
    $curlVia->Close();
}

$kqlimit='<3';
$kqhcqc='<3';
$kqnamtao='<3';
if(IsNullOrEmpty($tokenvia)){
    echo Message(false,"Lấy token via nhận thất bại",'','','');
    $curlVia->Close();
    return;
}
if(strlen($checklimit)>2){
    $kqlimit=CheckFullAds($curlVia,$tokenvia,true);
    if(strpos($kqlimit,'Limit')===false){
        // echo Message(false,$kqlimit,'','','');
        // $curlVia->Close();
        // return;
    }
}
if(strlen($checknamtao)>2){
    $kqnamtao=CheckInfoUsingCookies($curlVia);
}
if(strlen($checkHcqc)>2){
    $kqhcqc=CheckHcqc($curlVia);
}

echo Message(true,"Ads69.Net",$kqlimit,$kqnamtao,$kqhcqc);
$curlVia->Close();


// echo CheckFullAds($curlVia,$tokenvia);

?>