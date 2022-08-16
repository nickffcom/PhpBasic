<?php
$user_pwd=null;
if(strlen($tmproxy>10)){
    $kqproxy= getCurrentTmproxy($tmproxy);
  
}else if(intval($proxy)>0){
    	$proxy=$_POST['proxy'];
		if(!is_numeric($proxy)){
			exit();
		};
		$proxy=$db->where('proxy.id',$proxy)->where('proxy.uid',$me['uid'])->getOne('proxy');
		if(!isset($proxy)){
			exit();
		}
		$ip=$proxy['ip'];
        $typeproxy=$proxy['type'];
		if(strpos($typeproxy,'TM')!==false){
            $kqproxy= getCurrentTmproxy($tmproxy);
        }else{
            // CÒN LẠI LÀ IP V6 chELSEA
            $user_pwd=$proxy['user_pwd'];
            $kqproxy=$ip;
        }

}else{
    // echo Message(false,"Cấu hình proxy như cc =>>Chỉnh lại đi ck iuuu <3".$proxy,'','','');
     echo Message(false,"Cấu hình proxy như cc =>>".$proxy,'','','');
    exit();
}

if(strpos($kqproxy,':')!==false){

}else{
    echo Message(false, "Lỗi Get IP Proxy:".$kqproxy, '', '', '');
    exit();
}
?>