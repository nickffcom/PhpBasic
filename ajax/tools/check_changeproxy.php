<?php
// require_once 'config_tools.php';
require_once 'xulyproxy.php';
require_once 'mycurl.php';
require_once 'msg.php';

$tmproxy=isset($_POST['tmproxy'])?$_POST['tmproxy']:'';
// $minproxy=isset($_POST['minproxy'])?$_POST['minproxy']:'';
$type=isset($_POST['type'])?$_POST['type']:exit();

$proxy=isset($_POST['proxy'])?$_POST['proxy']:null;
if($type==1){  // check proxy
   
    $kqproxy="Lỗi";
    if(strlen($tmproxy)>10){
        $kqproxy= getCurrentTmproxy($tmproxy);
        echo "TmProxy :".$kqproxy;
      
    }else if(is_numeric($proxy)){
        $proxy=$db->where('proxy.id',$proxy)->where('proxy.uid',$me['uid'])->getOne('proxy');
		if(!isset($proxy)){
			exit("ng ae à");
		}
		$ip=$proxy['ip'];
        $typeproxy=$proxy['type'];
		if(strpos($typeproxy,'TM')!==false){
            $kqproxy= getCurrentTmproxy($ip);
           
            exit($kqproxy);
        }else{
            // CÒN LẠI LÀ IP V6 chELSEA
            $user_pwd=$proxy['user_pwd'];
            $time=time();
            if($time>$proxy['time_out']){
                echo "IP V6 Này hết hạn rồi bà ơiii";
                return;
            }
            $curlVia=new mycurl($ip,$user_pwd);
            $kq=$curlVia->get("https://ip.proxyv6.net/");
            echo "IP V6 Là:$kq";
            $curlVia->Close();
            
            
        }

    }else{
        echo "Cấu hình proxy như cc =>>Chỉnh lại đi ck iuuuu <3";
        return;
    }

}else if($type==2){  // get new proxy
    $curlVia=new mycurl();
    if(strlen($tmproxy)>10){
        $kqproxy= getNewTmproxy($curlVia,$tmproxy);
        echo $kqproxy;
        $curlVia->Close();
    }else if(is_numeric($proxy)){
        $proxy=$db->where('proxy.id',$proxy)->getOne('proxy');
		if(!isset($proxy)){
			exit();
		}
		$ip=$proxy['ip'];
        $typeproxy=$proxy['type'];
		if(strpos($typeproxy,'TM')!==false){
            $kqproxy= getNewTmproxy($curlVia,$ip);
            $curlVia->Close();
            exit($kqproxy);
        }else{
            // CÒN LẠI LÀ IP V6 chELSEA
            $user_pwd=$proxy['user_pwd'];
            // ở đây check ip v6 đi
            $curlVia->Close();
            exit('V6 Động chưa viết code @@,xài v6 tĩnh đi ck iuu');
        }

    }
    else{
        echo "Cấu hình proxy như cc =>>Chỉnh lại đi ck iuuu";
        return;
    }

}
?> 