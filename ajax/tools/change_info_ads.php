<?php

require_once 'xulyproxy.php';
require_once 'mycurl.php';
require_once 'model.php';
require_once 'msg.php';

$uid=isset($_POST['uid'])?trim($_POST['uid']):'';
$proxy=isset($_POST['proxy'])?$_POST['proxy']:'';
$tmproxy=isset($_POST['tmproxy'])?$_POST['tmproxy']:'';
$cookies=isset($_POST['cookies'])?$_POST['cookies']:'';
$tenmuondoi=isset($_POST['tenmuondoi'])?$_POST['tenmuondoi']:'';
$muigio=isset($_POST['muigio'])?$_POST['muigio']:'';
$tiente=isset($_POST['tiente'])?$_POST['tiente']:'';
$country=isset($_POST['country'])?$_POST['country']:'';
$type=isset($_POST['country'])?$_POST['country']:exit();



require 'config_proxy.php';
$curlVia= new mycurl($kqproxy,$user_pwd);
$haha=$db->insert('history_tool', array(
    'user' => $me['username'],
    'time_su_dung'=>time(), 
    'description' =>':D',
    'chuc_nang'=>'Change Info Ads'
));

/////
if(strpos($cookies,'c_user')!==false){
    $curlVia->setCookies($cookies);

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

   
   
}else{
    echo Message(false,"Ko biết chạy đường nào luôn !!!",'','','');
    $curlVia->Close();
    return;
}
$tokenvia = GetTokenAds($curlVia);
if(IsNullOrEmpty($tokenvia)){
        echo Message(false,"Lấy token via nhận thất bại/Cookie die",'','','');
        $curlVia->Close();
        return;
}
$idtkqc=getIdAds($curlVia,$tokenvia);
if(IsNullOrEmpty($idtkqc)){
    echo Message(false,"Fb chặn token nick này rồi",'','',$curlVia->getCookies());
    $curlVia->Close();
    return;

    $haha = $curlVia->get("https://www.facebook.com/ads/manager/accounts");
    preg_match('/ads.manage.campaigns..act=([0-9]{5,})/',$haha,$bun);
    if(isset($bun[1])){
        $idtkqc=$bun[1];
    }else{
        echo  Message(false,"Ko lấy được id tkqc",'','','');
        $curlVia->Close();
        return;
    }

}
switch ($type){
    case "1":  // api change 1 :D
        $kqchange=ChangeInfoAdsCk($curlVia,$idtkqc,$tiente,$muigio );
        // $kqchange=ChangeInfoAdsToken($curlVia,$idtkqc,$tokenvia,$muigio,$tiente);  // cái này là api dễ nhất , khó ăn lắm
        // $test=CreateTKQCNew($curlVia,$idtkqc,$tiente,$muigio );
        // $xem=CheckFullAds($curlVia,$tokenvia);
        if(preg_match('/success/',$kqchange)){
            if(strpos($tenmuondoi,'undefined')===false){
                $tenmuondoi="Share By Ads69";
                $kqrename=ReNameAds($curlVia,$idads,$token,$tenmuondoi);
                if(preg_match('/success/',$kq)){
                    echo Message(true,"Change + Đổi Tên Ok",$idads,$tenmuondoi,$curlVia->getCookies());
                    $curlVia->Close();
                    return "";
                }else{
                    echo Message(true,"OK nhưng chưa đổi đc tên",$idads,"Đổi tên=>Fail",$curlVia->getCookies());
                    $curlVia->Close();
                    return ;
                }
            }
            echo Message(true,"Change Info Ads Success ",$idads,$idads,$curlVia->getCookies());
            $curlVia->Close();
            return "Success";
        }else if(preg_match('/account_id/',$kqchange)){
            echo Message(false,"Facebook Chặn Đổi ở nick này",'','',$curlVia->getCookies());
            $curlVia->Close();
        }else{
            echo Message(false,"Failed:".$kq,'','',$curlVia->getCookies());
            $curlVia->Close();
            return "Failed: ".$kq;
        }

        break;

    case "2":  // api 2 
        // $variable="{\"input\":{\"billable_account_payment_legacy_account_id\":\"319212319943053\",\"timezone\":\"Asia/Bangkok\",\"currency\":\"USD\",\"tax\":{\"business_address\":{\"city\":\"\",\"country_code\":\"US\",\"state\":\"ADS.CENTER\",\"street1\":\"ADS.CENTER 79\",\"street2\":\"ADS.CENTER 7979\",\"zip\":\"79799\"},\"business_name\":\"MF\",\"is_personal_use\":false},\"client_mutation_id\":\"3\"}}";
        // $url="https://graph.facebook.com/graphql?method=post&pretty=false&format=json&doc_id=4119854918068296&server_timestamps=true&variables=$variable&access_token=".$tokennick;
        // $kq=$curlVia->get($url);

        break;

    default:
      exit("Thằng loz này nha =>> tha đi");    
}





?>