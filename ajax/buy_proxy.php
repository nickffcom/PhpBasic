<?php
require_once 'tools/mycurl.php';
$type = isset($_POST['type'])?$_POST['type']:exit();
$v6tinh = isset($_POST['v6tinh'])?$_POST['v6tinh']:exit();
$v6dong = isset($_POST['v6dong'])?$_POST['v6dong']:exit();
$timev6tinh = isset($_POST['timev6tinh'])?$_POST['timev6tinh']:exit();
$timev6dong = isset($_POST['timev6dong'])?$_POST['timev6dong']:exit();
if (empty($type)||empty($timev6tinh)) {
	 exit();
}

// $type="2";
// $v6tinh="VN";
// $v6dong="VN";
// $timev6dong="3";
// $timev6tinh="3";

$price=0;
$nameProxy="";
$changeip=1;
$typeProxy="TM v4";

$spam=60*60*24;
$time = time();
$timehethan=$time+$spam;
switch ($type){
	case  2: // key 4k
		$price=4000;
		$nameProxy="TM 4k";
		break;
	case 17://key 8k
		$price=8000;
		$nameProxy="TM 8k";
		break;
	case 3:  // key 15k
		$price=15000;
		$nameProxy="TM 15k";
		break;
	case 9:  //v6 tĩnh 
		$changeip=0;
		$typeProxy="v6";
		if($timev6tinh==3){
			$nameProxy="V6 tĩnh 3 ngày";
			$timehethan =$time + (3*$spam);
			$price=1000;
		}else if($timev6tinh==7){
			$nameProxy="V6 tĩnh 7 ngày";
			$timehethan =$time+ (7*$spam);
			$price=1700;
		}else if($timev6tinh==31){
			$nameProxy="V6 tĩnh 1 tháng";
			$timehethan =$time+ (31*$spam);
			$price=4000;
		}else if($timev6tinh==62){
			$nameProxy="V6 tĩnh 2 tháng";
			$timehethan =$time+ (62*$spam);
			$price=8000;
		}else{
			exit();
		}
		break;
	case 10:  // v6 động 
		$typeProxy="V6 Chelsea";
		if($timev6dong==3){
			$nameProxy="V6 động 3 ngày";
			$timehethan =$time+ (3*$spam);
			$price=1200;
		}else if($timev6dong==7){
			$nameProxy="V6 động 7 ngày";
			$timehethan =$time+ (7*$spam);
			$price=2000;
		}else if($timev6dong==31){
			$nameProxy="V6 động 1 tháng";
			$timehethan =$time+ (31*$spam);
			$price=5000;
		}else if($timev6dong==62){
			$nameProxy="V6 động 2 tháng";
			$timehethan =$time+ (62*$spam);
			$price=10000;
        }else{
			exit();
		}
		break;
	default:
		exit('');
}

$total_money = $price ;

if (!(($me->money - $total_money) >= 0)) {

 exit('Bạn không đủ ' . number_format($total_money) . ' VNĐ để thực hiện giao dịch!');

}
// if(($me->money - $total_money)>=0){
	
// }else{
// 	return "Bạn éo đủ tiền ";
// }

$cc=new mycurl();
$apikey="9c307c98-3928-4527-b6cd-1901cfdb9148";
$ip="Mua lỗi ib admin";
$user_pwd="Lỗi ib admin";
  // v4 hay v6


switch($type){
	case 9:  // mua proxy v6 tĩnh
		$url="https://api.proxyv6.net/api/buy-proxy?api_key=$apikey&proxy_type=1";
		$data=array(
			'count'=>'1',
			'period'=>$timev6tinh,
			'country'=>$v6tinh,
		);
		$kq=$cc->PostJson($url,$data);
		if(strpos($kq,'SUCCESS')){
			$kq=json_decode($kq);
			$length=count($kq->{'data'})-1;
			$host=$kq->{'data'}[$length]->{'host'};
			$port=$kq->{'data'}[$length]->{'port'};
			$ip=$host.":".$port;
			// $proxyID=$kq->{'data'}[$length]->{'_id'};
			$user=$kq->{'data'}[$length]->{'username'};
			$pwd=$kq->{'data'}[$length]->{'password'};

			$user_pwd=$user.":".$pwd;
			if(!isset($host)){
				$cc->Close();
				exit("Lỗi nặng vui lòng inbox admin nhé");
			}
	
		}else{
			$kq=json_decode($kq);
			exit($kq->{'message'});
		}
		 break;
	case 10: // mua proxy v6 động
		$url="https://api.proxyv6.net/api/buy-proxy?api_key=$apikey&proxy_type=2";
		$data=array(
			'count'=>'1',
			'period'=>$timev6dong,
			'country'=>$v6dong,
		);
		$kq=$cc->PostJson($url,$data);
		if(strpos($kq,'SUCCESS')){
			$kq=json_decode($kq);
			$length=count($kq->{'data'})-1;

			$host=$kq->{'data'}[$length]->{'host'};
			$port=$kq->{'data'}[$length]->{'port'};
			$ip=$host.":".$port;
			// $proxyID=$kq->{'data'}[$length]->{'_id'};
			$user=$kq->{'data'}[$length]->{'username'};
			$pwd=$kq->{'data'}[$length]->{'password'};

			$user_pwd=$user.":".$pwd;
			if(!isset($host)){
				$cc->Close();
				exit("Lỗi nặng vui lòng inbox admin nhé");
			}
			// xử lý database lưu  ip vs proxy id đó đi
			
	
		}else{
			$kq=json_decode($kq);
			exit($kq->{'message'});
		}
		break;
	case 2||3||17:
		$ip=BuyTmProxy($cc,'nickffcom','noname2d',$type);
		$user_pwd="không có";
		break;
	default: 
		exit();
}

// $ref_code = md5(rand(0, 999999) . time() . microtime() . base64_encode(time()) . base64_encode(microtime()) . rand(0, 999999));

// $db->insert('order_service', array(
// 		'ref_id' => $ip,
// 		'code' => $ref_code,
// 		'price' => $price,
// 		'time' => $times,
// 		'uid' => $me->uid
// ));
$usernek=$me->uid;
$haha=$db->insert('proxy', array(
		'name' => $nameProxy,
		'ip' => $ip,
		'price'=>$price,
		'user_pwd' => $user_pwd,
		'type' => $typeProxy,
		'changeip' => $changeip,
		'time'=>$time,
		'time_out'=>$timehethan, // 1 là change ip . 0 là  không cho
		'uid' => $usernek,
));
if(!$haha){
	$cc->Close();
	exit("ERR CODE 69: IB mã lỗi này cho admin");

}
// $sql = "INSERT INTO proxy(name,ip,price,user_pwd,type,changeip,time,time_out,uid)
// VALUES ('$nameProxy','$ip',$price,'$user_pwd','$typeProxy',$changeip,$time,$timehethan,$uid)";
// $insert=$conn->query($sql);
// if($insert===false){
// 	exit("Mua Proxy thất bại =>Vui lòng ib admin gấp");
// }


$haha=$db->insert('history', array(
	'content' => "Mua  1 proxy .$nameProxy",
	'total_money' => $total_money,
	'type' => 'service',
	'time' => $time,
	'uid' => $usernek
));
$minus_money = "UPDATE users SET money = money - $total_money WHERE uid = " . $me->uid;
if ($conn->query($minus_money)) {
	$cc->Close();
    exit("OK Mua Proxy Success -> Vào Tool / Lịch sử mua proxy để xem nha ck iuu");
	

}

function BuyTmProxy($cc,$tk,$mk,$typeProxy){
    $url="https://tmproxy.com/api/user/login";
    $data=array(
        'username'=>$tk,
        'password'=>$mk,
    );
    $kq=$cc->PostJson($url,$data);
    if(strpos($kq,"code\":0")!==false){
        $kq=json_decode($kq);
        $token=$kq->{'data'}->{'token'};
		if(strlen($token)<10){
			exit("False,ib admin");
		}
        // {"code":0,"message":"","data":{"token":"eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbiI6ImZkNzNiYzRiLTJhNDctNGMwOS04NWVhLTQyYTQxY2Y3MjEwZiIsImV4cCI6MTY0Mzc2Njk2NCwiaWF0IjoxNjQzNzIzNzY0LCJpc3MiOiJ0bS1wcm94eS5jb20iLCJuYmYiOjE2NDM3MjM3NjR9.lIUfZbudNckqSKwL-PuQ81vPqhYsXRVMn2IBvnR0zw24S0Gd01OnLDEOLH6ycOhwRaD5kvMwwaqvzremx0ZWuHpjFEM3lCkmnrhOoa3V00hARtjST1PdSBRWJULJnu_VXd3tejXM7_avZ4fyNTtDRGKzw-F82k8627bLDf7sVJcScFQMpr3rsj1F5Xaiq62CSvpCnEzioOVlTG3kut62xjOQhUqGCAO9MEhAXuznpIeK-exHPfmFqXJq1Zdo7fC_mDEyJpFsUS1amFYOFLgULZpy0rVCtz3brWFDwxvGULU_csS0Z0fhhAUIxK-3Wk-4uTyQNrhdPp7nOWKAa8e6lp_w_8B4CNAglGVWDjr2axhAAk4LZ4A1q5ruLA4ve5Osi-9IZ6XfOp6i152GfV-_hgAZ-y-oiD1SxojWLn0Q6wo8N7DxT0rhPiNZJR2_fgU1UqjP9zvnDchCAZreE7MMKHsAB3K4u-_RYpk_cJU1u4ZxZhjuGWg3RSko-JKm9dVnj9HdgXfOt47mHth3kyyxHhuTa8u9byOEjONyQZc8B-3dqgChAX1UMaP2tOnVTeM3MIAq1e2oWh2qypIebHS6Y9vcAHY2zJd1yJmzXNEklg51LmMNpA_Un7raMIbS-OrWzBlmAaNkpxNc8b2OQJlaklypsyFLnNygrmQnfG_01HM"}}
        $url="https://tmproxy.com/api/order/buy";
        $auth = "Authorization:$token";
        // id 2 là gói 4k , 
        // id 17 là gói 8k
        // id 3 là gói 15k
        $data=array(
            'day'=>1,
            'id'=>(int)$typeProxy,
            'quantity'=>1,
        );
        $kq=$cc->PostJson($url,$data,$auth);
		// $kq="code\":0,";
        if(strpos($kq,'code":0,')!==false){
            $cc->Close();
            $url="https://tmproxy.com/api/proxy/list";
            $data=array(
				''=>''
			);
			$haha=json_encode($data);
            $kq=$cc->PostJson($url,$data,$auth);
            if(strpos($kq,'list_api')){
                // $length=count($kq->{'data'}->{'list_api'})-1;
                // $temp=array_pop($kq->{'data'}->{'list_api'});
                $kq=json_decode($kq);
				$length=$kq->{'data'}->{'current_count'}-1;
                $keytmproymoinhat=$kq->{'data'}->{'list_api'}[$length]->{'api'}->{'api_key'};
				if(!isset($keytmproymoinhat)){
					exit("Lỗi Mua Key => Vui lòng nt admin gấp");
				}
                // {"code":0,"message":"","data":{"list_api":[{"api":{"id":178063,"expired_at":"09:54:27 09/01/2022","plan":"Đổi IP","price_per_day":4000,"timeout":1800,"base_next_request":240,"note":"API","api_key":"5384a67fca030dc5c450b6a7ee4dfbb5","max_ip_per_day":0,"ip_used_today":0,"id_location":1},"proxy":{"ip_allow":"","location_name":"","socks5":"","https":"","timeout":0,"next_request":0,"expired_at":""},"is_can_get_access_ip":false,"is_expired":true},{"api":{"id":192671,"expired_at":"21:41:28 02/02/2022","plan":"Đổi IP","price_per_day":4000,"timeout":1800,"base_next_request":240,"note":"API","api_key":"651c141e69a127f1e333aa5554802e59","max_ip_per_day":0,"ip_used_today":0,"id_location":1},"proxy":{"ip_allow":"","location_name":"","socks5":"","https":"","timeout":0,"next_request":0,"expired_at":""},"is_can_get_access_ip":false,"is_expired":false}],"max_api":50,"current_count":2}}
				return $keytmproymoinhat;
            }else{
                $cc->Close();
                exit("Mua Key TM Proxy Bị Lỗi");
            }
        }else{
			$kq=json_decode($kq);
            if (strlen($kq->{'message'})>10) {
				$cc->Close();
                exit("Mua Key TM Proxy thất bại->Vui lòng inbox admin:".$kq->{'message'});
            }else{
				$cc->Close();
				exit("Mua Key TM Proxy thất bại->Vui lòng inbox admin nhá");
			}
        }

    }else{
        $cc->Close();
        exit("Bị Chặn -> Vui lòng ib admin để biết thêm chi tiết");
    }
}
///



?>