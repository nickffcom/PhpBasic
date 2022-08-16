<?php
// require_once 'config_tools.php';
error_reporting(0);
require_once 'xulyproxy.php';
require_once 'mycurl.php';
require_once 'model.php';
require_once 'msg.php';
$tokenvia=isset($_POST['tokenvia'])?trim($_POST['tokenvia']):exit;
$tokenclone=isset($_POST['tokenclone'])?trim($_POST['tokenclone']):'';
$uid=isset($_POST['uid'])?trim($_POST['uid']):null;
$proxy=isset($_POST['proxy'])?$_POST['proxy']:'';
$shareluon=isset($_POST['shareluon'])?$_POST['shareluon']:'';  // cái này là chỉ share
$outtkqc=isset($_POST['outtkqc'])?$_POST['outtkqc']:'';
$cookies=isset($_POST['cookies'])?$_POST['cookies']:'';
$guid=isset($_POST['guid'])?$_POST['guid']:exit;
$role=isset($_POST['role'])?$_POST['role']:'281423141961500';
$tmproxy=isset($_POST['tmproxy'])?$_POST['tmproxy']:'';



///////////////////////////////
require 'config_proxy.php';
$curlVia= new mycurl($kqproxy,$user_pwd);
$haha=$db->insert('history_tool', array(
    'user' => $me['username'],
    'time_su_dung'=>time(), 
    'description' =>':D',
    'chuc_nang'=>'Share Clone To Via'
));
///////////////////////////////////

if(strpos($tokenvia,'EAAG')!==false||strpos($tokenvia,'EAAB')){

}
else if(strpos($tokenvia,'c_user')!==false){
    $curlVia->setCookies($tokenvia);
    $tokenvia = GetTokenAds($curlVia);
    if(IsNullOrEmpty($tokenvia)){
        echo Message(false,"Lấy token Via Nhận Fail =Kiểm tra lại đi ck",'','','');
        $curlVia->Close();
        return;
    }
}

$curlClone= new mycurl($kqproxy,$user_pwd);     
// return;
// $curlClone= new mycurl();
if(strpos($tokenclone,'EAAG')!==false){


}else{
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
          $curlVia->Close();
          $curlClone->Close();
          return;
       }
   
   }
       $tokenclone = GetTokenAds($curlClone);
       if(IsNullOrEmpty($tokenclone)){
           echo Message(false,"Lấy Token Fail->Cookies Die",'','','');
           $curlVia->Close();
           $curlClone->Close();
           return;
       }    
   
}

// bắt đầu chia đôi chức năng ở đây
///////
///////
/////////////.
if(strpos($tokenvia,'EAAG')!==false||strpos($tokenvia,'EAAB')!==false){  // token via nhận sau đó get uid để share như bình thường thôi
         $uidvianhan="";
        if(!empty($curlVia->getUid()) ){
            $uidvianhan=$curlVia->getUid();
       
        }else{
            $url="https://graph.facebook.com/v10.0/me?fields=id&access_token=".$tokenvia;
            $kq=$curlVia->get($url);
            // echo $kq;
            if (preg_match('/([0-9]{7,})\"/', $kq, $match)) {
                $uidvianhan=$match[1];
            }else if(strpos($kq,"data")!==false){
                echo Message(false,"Token Via nhận bị chặn =>Out",'','',$curlClone->getCookies());
                $curlVia->Close();
                $curlClone->Close();
                return "";
            }else{
                preg_match('/message":(.*?),/',$kq,$match);
                echo Message(false,"Token Lỗi / Die ".$match[1],'','','');
                $curlVia->Close();
                $curlClone->Close();
                return "Token Lỗi / Die";
            }

        }
        $idads= getIdAds($curlClone,$tokenclone); // lấy id Ads đầu tiên của clone
        if (IsNullOrEmpty($idads)) {
                echo Message(false, "Token bị FB chặn hay sao ấy ",'','', '');
                $curlClone->Close();
                $curlVia->Close();
                return;
        }

        $kqsendkb=SendKetBan($curlClone,$uidvianhan,$tokenclone,$guid);
        if(preg_match('/friend_request_send/',$kqsendkb)){
            // echo Message(false,$kqsendkb,'','','');
            $kqsendkb="Send Kb=>Ok";
            // $curlVia->Close();
            // $curlClone->Close();
           
        }else {
            // echo Message(true,"Kết bạn thành công >> Chạy xong",'','','');
            $kqsendkb="Send Kb=>Fail";
        }
        $kqaccept=AcceptKetBan($curlVia,$uid,$tokenvia);
        // "{"error":{"code":1,"message":"Please reduce the amount of data you're asking for, then retry your request"}}"
        if(preg_match('/ARE_FRIENDS/',$kqaccept))
        {
            $kqaccept="Accept Ok";
        }else if(preg_match('/friend_request_accept\":null/',$kq,$match))
        {   $kqaccept="Chưa gửi lời mời kb";
            // echo Message(false,"Chưa gửi kết bạn / Có lỗi","","","");
            // return "";
        }else{
            // echo Message(false,"Chấp Nhận Kb Lỗi 0 Xác định=>>Cút","","","");
            $kqaccept="Accept Fail";
            
        }

       
        $kqshare=ShareTkqc($curlClone,$idads,$uidvianhan,$tokenclone,$role);
        if(preg_match('/success\":true"/',$kqshare)){
          
            if(strlen($outtkqc)>3){
                $kqout =OutTkqc($curlClone,$idads,$uidvianhan,$tokenclone);
                if(strpos($kqout,'success')){
                    echo Message(true,"Share tkqc:thành công",$idads,'Đã Out',$curlClone->getCookies());
                }else{
                    echo Message(true,"Share tkqc:thành công",$idads,'Out Fail:'.$kqout,$curlClone->getCookies());
                }
                $curlClone->Close();
                $curlVia->Close();
                return;
            }
            echo Message(true,"Share tkqc:thành công",$idads,'Không Out Khi Share Xong',$curlClone->getCookies());
            $curlClone->Close();
            $curlVia->Close();
            return ;
        }else{
            preg_match('/error_user_msg\":\"(.*?)\"/',$kqshare,$loinek);
            echo Message(false,"Share Failed: ".$loinek[1],$kqsendkb,$kqaccept,$curlClone->getCookies());
            $curlClone->Close();
            $curlVia->Close();
            return ;
        }



}
else if(strpos($tokenvia,'100')!==false&&strpos($shareluon,"true")===false){  //  điền zô uid nhưng k chọn share luôn  , là kết bạn để If sau share luôn mà k cần kb
    // nếu điền uid thôi và ko điền cookies và  ko tích chỉ share thì   =>>> chỉ kết bạn xong out
    //token via bây giờ chỉ là uid  cần kết bạn thôi 
    preg_match("/(100[0-9]{4,})/",$tokenvia,$uidtokenvianek);
    $kqsendkb=SendKetBan($curlClone,$uidtokenvianek[1],$tokenclone,$guid);
    if(preg_match('/friend_request_send/',$kqsendkb)){
        
        echo Message(true,"Kết bạn thành công >> Chạy xong",'','',$curlClone->getCookies());
        $curlVia->Close();
        $curlClone->Close();
        return;
    }else {
        echo Message(false,$kqsendkb,'','',$curlClone->getCookies());
        $curlVia->Close();
        $curlClone->Close();
        return ;
    }

}else if(strpos($shareluon,'true')!==false&&strpos($tokenvia,'100')!==false){  
    

        $idads= getIdAds($curlClone,$tokenclone); // lấy id Ads đầu tiên
        if (IsNullOrEmpty($idads)) {
                echo Message(false, "Token nick share bị fb chặn ", 'Ko lấy dc Ads_id', '',$curlClone->getCookies());
                return;
        }
        $kqshare=ShareTkqc($curlClone,$idads,$tokenvia,$tokenclone,$role);
        // "{"success":true}"
        if(preg_match('/success":true/',$kqshare)){
           
             if(strlen($outtkqc)>3){
                $kqout =OutTkqc($curlClone,$idads,$uidvianhan,$tokenclone);
                if(strpos($kqout,'success')){
                    echo Message(true,"Share tkqc:thành công",$idads,'Đã Out',$curlClone->getCookies());
                }else{
                    echo Message(true,"Share tkqc:thành công",$idads,'Out Fail:'.$kqout,$curlClone->getCookies());
                }
                $curlClone->Close();
                $curlVia->Close();
                return;
            }
            $curlClone->Close();
            $curlVia->Close();
            echo Message(true,"Share tkqc:thành công",$idads,'Không Out Khi Share Xong',$curlClone->getCookies());
            return ;
        }else{
            preg_match('/error_user_msg\":\"(.*?)\"/',$kqshare,$loinek);
            echo Message(false,"Share Failed: ".$loinek[1],'','','');
            $curlClone->Close();
            $curlVia->Close();
            return ;
            // "To add someone to your ads account, please enter the email address associated with a Facebook account. Otherwise, you can enter the name of a friend."
        }

}else{
    echo Message(false,'Không biết chạy kiểu gì luôn @@','','');
}

?>