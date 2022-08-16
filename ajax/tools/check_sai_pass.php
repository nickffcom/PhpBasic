<?php
require_once 'xulyproxy.php';
require_once 'mycurl.php';
require_once 'model.php';
require_once 'msg.php';

$uid=isset($_POST['uid'])?trim($_POST['uid']):exit;
$proxy=isset($_POST['proxy'])?$_POST['proxy']:'';  // cái này là chỉ share
$pass=isset($_POST['pass'])?$_POST['pass']:'';
$key2fa=isset($_POST['pass'])?$_POST['key2fa']:'';
$tmproxy=isset($_POST['tmproxy'])?$_POST['tmproxy']:'';
// $minproxy=isset($_POST['minproxy'])?$_POST['minproxy']:'';

if(empty($pass)||empty($key2fa)){
    echo Message(false,"Thiếu Pass / Key 2Fa",'','','');
    return;
}


require 'config_proxy.php';
$cc= new mycurl($kqproxy,$user_pwd);
$haha=$db->insert('history_tool', array(
    'user' => $me['username'],
    'time_su_dung'=>time(), 
    'description' =>':D',
    'chuc_nang'=>'Check Sai Pass Via 2FA'
));
// $kq = Login2FA($curlClone,$uid,$pass,$key2fa);

////////////////////////
$ketqua=$cc->get('https://m.facebook.com/');
    
//  $ketqua;
if (preg_match('/name="lsd" value="(.*?)"/', $ketqua, $lsd)) {

    //  $lsd[1];
    if (!isset($lsd[1])) {
        echo Message(false, "Vui lòng chạy lại ặc này", '', '', '');
        $cc->Close();
        return "";
    }
    preg_match('/name=\"m_ts\" value=\"(\\d+)\"/', $ketqua, $m_ts);
    preg_match('/name=\"li\" value=\"(.*?)\"/', $ketqua, $li);


    $data=array(
    'lsd'=>$lsd[1],
    'jazoest'=>21312,
    'm_ts'=>$m_ts[1],
    'li'=>$li[1],
    'try_number'=>'0',
    'unrecognized_tries'=>'0',
    'email'=>$uid,
    'pass'=>$pass,
    'login'=>'Log+In',
);
    $url="https://mbasic.facebook.com/login/";

    $ketqua=$cc->post($url, $data, true);  // login with uid pass
   
    preg_match('/name=\"fb_dtsg\" value=\"(.*?)\"/', $ketqua, $fbdtsg);
    if (!isset($fbdtsg)) {
        echo Message(false, "Lỗi Request vui lòng chạy lại", '', '', '');
        $cc->Close();
        return ;
    } elseif (preg_match('/submit[Submit Code]/', $ketqua)) {
        echo Message(true, "Đúng pass > Ngon lành", '', '', '');
        $cc->Close();
    } else {
        echo Message(false, "Sai pass 100%", '', '', '');
        $curlClone->Close();
        return ("");
    }
}else{
    echo Message(false, "Lỗi =>>Vui lòng chạy lại ặc này", '', '', '');
    $cc->Close();
}


?>