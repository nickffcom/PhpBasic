<?php

$uid=$me['uid'];
$his = $db->join('users', '(users.uid = proxy.uid)', 'INNER')->orderBy('proxy.time', 'DESC');

// $lists = $his->get('proxy', 7, array(
//     'proxy.id,proxy.name,proxy.time_out,proxy.time',
// ));
$sql="SELECT * FROM proxy WHERE proxy.uid='$uid' ORDER BY proxy.time DESC LIMIT 70";
$lists = $db->rawQuery($sql);
// if(empty($lists)){
//     exit("K có");
// }
// $lists = $db->rawQuery("SELECT * FROM proxy WHERE proxy.uid='$me->uid'ORDER BY proxy.time DESC");

date_default_timezone_set('Asia/Ho_Chi_Minh');

$time=time();
$temp=array();
foreach($lists as $key =>$item){
    $timemua=$item['time'];
    $timeout=$item['time_out'];
    $checktime=$time-$timeout;
    if($checktime < 0){
        // $kkk=date('H:i d/m',$timemua);
       
        $thoigian=date('H:i d/m',$timeout);
        $lists[$key]['time_out']=$thoigian;
        // $length=count($temp)+1;
        // $temp[$length]=$lists[$key];  
    }else{
        // $lists[$key]['time_out']="Hết Hạn";
        unset($lists[$key]);
    }
}
$soluong=0;
$type=isset($_POST['type'])?$_POST['type']:exit();
switch($type){
    case 1:  // share clone to via
        $soluong=2;
        break;
    case 2:  // share clone to bm
        $soluong=2;
        break;
    case 3: // reg bm
        $soluong=2;
        break;
    case 4: // set camp
        $soluong=3;
        break;
    case 5: // check sai pass
        $soluong=3;
        break;
    case 6: // check info via
        $soluong=3;
        break;
    case 7: // change info ads
        $soluong=3;
        break;                            
    default:
        break;    
}
$money=$me['money'];
if (($money-500)>= 0) {
    if (($money-200000)>= 0) {
        $soluong=5;
    }else if (($money-100000)>= 0) {
        $soluong=4;
    }else if (($money-70000)>= 0) {
        $soluong=3;
    }else{
        $soluong=2; 
    }

    $notice = array(
        "data" => array(
            "proxy" => $lists,
            'so_luong'=>$soluong,
            'status'=>true,
            'msg'=>"Ae xài từ từ thôi băng thông có giới hạn"
        )
    );
    $notice=json_encode($notice);
}else{
    $notice = array(
        "data" => array(
            "proxy" => $lists,
            'so_luong'=>$soluong,
            'status'=>false,
            'msg'=>"Bạn phải có số dư lớn hơn 30k mới được sử dụng"
        )
    );
    $notice=json_encode($notice);

}

echo $notice;
?>