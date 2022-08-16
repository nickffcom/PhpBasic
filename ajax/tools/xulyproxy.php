<?php
// require_once 'mycurl.php';
// function getCurrentV6MinProxy($cc, $key)
// {
//     $url="https://dash.minproxy.vn/api/rotating/v1/proxy/get-current-proxy?api_key=".$key;
//     $kq=$cc->get($url);
   
//     if (preg_match('/code\":1/', $kq)) {
//         $kq=json_decode($kq);
//         $nextRQ=(int)$kq->{'data'}->{'base_next_request'};
//         $proxy =$kq->{'data'}->{'http_proxy'};
//         return $proxy;

//     }else if(preg_match('/code\":2/', $kq)) {
//         $kq=json_decode($kq);
//         $msg=$kq->{'message'};
//         return $msg;
      
//     }else{
//         return "Lấy Proxy với key thất bại =>>Vui lòng kiểm tra lại";
//     }

// }
// function getNewV6MinProxy($cc, $key)
// {
//     $url="https://dash.minproxy.vn/api/rotating/v1/proxy/get-new-proxy?api_key=".$key;
//     $kq=$cc->get($url);
//     if (preg_match('/that bai/', $kq)) {
//         $kq=json_decode($kq);
//         $nextRQ=(int)$kq->{'data'}->{'next_request'};
//         return "Cần .$nextRQ"." s nữa mới đổi đc IP";
//     } else if(preg_match('/thanh cong/',$kq)) {
//         $kq=json_decode($kq);
//         return "Lấy Proxy mới thành công"+$kq->{'data'}->{'http_proxy'};
//     }else{
//         return "Lấy ProxyV6 Mới Fail =>>Vui lòng kiểm tra lại";
//     }

// }

// function getCurrentV4MinProxy($cc, $key)
// {
//     $url="https://dash.minproxy.vn/api/rotating/v1/proxy_v4/get-current-proxy?api_key=".$key;
//     $kq=$cc->get($url);
   
//     if (preg_match('/code\":1/', $kq)) {
//         $kq=json_decode($kq);
//         $proxy =$kq->{'data'}->{'http_proxy_ipv4'};
//         return $proxy;

//     }else if(preg_match('/code\":2/', $kq)) {
//         $kq=json_decode($kq);
//         $msg=$kq->{'message'};
//         return $msg;
      
//     }else{
//         return "Lấy Proxy V4 với key thất bại =>>Vui lòng kiểm tra lại";
//     }
   

// }
// function getNewV4MinProxy($cc, $key)
// {
//     $url="https://dash.minproxy.vn/api/rotating/v1/proxy_v4/get-new-proxy?api_key=".$key;
//     $kq=$cc->get($url);
//     if (preg_match('/that bai/', $kq)) {
//         $kq=json_decode($kq);
//         $nextRQ=(int)$kq->{'data'}->{'next_request'};
//         return "Cần .$nextRQ"." s nữa mới đổi đc IP";
//     } else if(preg_match('/thanh cong/',$kq)) {
//         $kq=json_decode($kq);
//         return "Lấy Proxy mới thành công"+$kq->{'data'}->{'http_proxy_ipv4'};
//     }else{
//         return "Lấy ProxyV6 Mới Fail =>>Vui lòng kiểm tra lại";
//     }


// }
function getCurrentTmproxy($key){
    $url="https://tmproxy.com/api/proxy/get-current-proxy";
    $data = array(
        "api_key" => $key,
    );
    $data=json_encode($data);
    $ch=curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    // curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type:application/json',
        )
    );
    
    $result = curl_exec($ch);
    curl_close($ch);
    if(preg_match('/code\":0/',$result)){
        $result=json_decode($result);
        $proxy=$result->{'data'}->{'https'};
        return $proxy;

    }else if(preg_match('/message/',$result)){
        $result=json_decode($result);
        $msg=$result->{'message'};
        return $msg;
    }else{
        return "Lấy Ip TmProxy Lỗi";
    }


}

function getNewTmproxy($cc,$key){

    $urlContent="https://tmproxy.com/api/proxy/current-time";
    $result=$cc->get($urlContent);
    // $ch=curl_init($urlContent);
    // $result = curl_exec($ch);
    // curl_close($ch);
    if(strlen($result)>4){
        $arg = "abccd9f3bf38f38414cb87e36f76c8e4";
        $num2=(int)$result;
        $num3=(int)($num2/60)+$num2;
        $text="$arg$key$num3";
        $text=md5($text);
                $data = array(
                "api_key" => $key,
                "sign"=> $text,
                            );
        $data=json_encode($data);
        $url="https://tmproxy.com/api/proxy/get-new-proxy";
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        // curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
                'Content-Type:application/json',
            )
        );
    
        $result = curl_exec($ch);
        curl_close($ch);                       
        if(preg_match('/code\":0/',$result)){
            $result=json_decode($result);
            $proxy=$result->{'data'}->{'https'};
            return $proxy;

        }else if(preg_match('/message/',$result)){
            $result=json_decode($result);
            $msg=$result->{'message'};
            return "Lỗi:".$msg;
        }else{
            return "Lấy Ip Mới TmProxy Lỗi";
        }



    }else{
       return "Lỗi =>>Làm lại đi ck iuuu";
    }
  


}

// Get price proxy   static
// {
//     "message": "SUCCESS",
//     "data": [
//       {
//         "_id": "6081b7c0692b9057c5c477ce",
//         "price": 1000,
//         "period": 3,
//         "id": "6081b7c0692b9057c5c477ce"
//       },
//       {
//         "_id": "6081b7e0692b9057c5c477cf",
//         "price": 1700,
//         "period": 7,
//         "id": "6081b7e0692b9057c5c477cf"
//       },
//       {
//         "_id": "6081b7f9692b9057c5c477d0",
//         "price": 4000,
//         "period": 31,
//         "id": "6081b7f9692b9057c5c477d0"
//       },
//       {
//         "_id": "60938f9cf267e4581de15f9b",
//         "price": 8000,
//         "period": 62,
//         "id": "60938f9cf267e4581de15f9b"
//       }
//     ]
//   }

// price roatating proxy
// "message": "SUCCESS",
// "data": [
//   {
//     "_id": "6080ec4ad964dd3e5f75e978",
//     "price": 1200,
//     "period": 3,
//     "id": "6080ec4ad964dd3e5f75e978"
//   },
//   {
//     "_id": "6080ec69d964dd3e5f75e97a",
//     "price": 2000,
//     "period": 7,
//     "id": "6080ec69d964dd3e5f75e97a"
//   },
//   {
//     "_id": "6080ec52d964dd3e5f75e979",
//     "price": 5000,
//     "period": 31,
//     "id": "6080ec52d964dd3e5f75e979"
//   },
//   {
//     "_id": "60938fa8f267e4581de15f9c",
//     "price": 10000,
//     "period": 62,
//     "id": "60938fa8f267e4581de15f9c"
//   }
// ]
// } 

// list country 
// {
//     "message": "SUCCESS",
//     "data": [
//       {
//         "name": "Germany",
//         "code": "DE"
//       },
//       {
//         "name": "Finland",
//         "code": "FI"
//       },
//       {
//         "name": "Viet Nam",
//         "code": "VN"
//       },
//       {
//         "name": "Japan",
//         "code": "JP"
//       },
//       {
//         "name": "France",
//         "code": "FR"
//       },
//       {
//         "name": "United Kingdom",
//         "code": "GB"
//       },
//       {
//         "name": "Canada",
//         "code": "CA"
//       },
//       {
//         "name": "Australia",
//         "code": "AU"
//       },
//       {
//         "name": "Singapore",
//         "code": "SG"
//       },
//       {
//         "name": "United States",
//         "code": "US"
//       }
//     ]
//   }
function DoiIpV6ThuCong($cc,$apikey,$host,$port){

    $url="https://api.proxyv6.net/api/reset-ip-manual?api_key=$apikey";
    $data=array(
        'host'=>$host,
        'port'=>$port,
    );
    $kq=$cc->PostJson($url,$data);
    if (strpos($kq, 'SUCCESS')) {
        return "Đang đổi IP ->";
    }else{
        return "Đổi Ip thất bại";
    }
}

function buyProxyMMO($cc,$apikey,$country,$timemua,$type){
    $url="https://api.proxyv6.net/api/buy-proxy?api_key=$apikey&proxy_type=$type";
    $data=array(
        'count'=>'1',
        'period'=>$timemua,
        'country'=>$country,
    );
    $kq=$cc->PostJson($url,$data);
    if(strpos($kq,'SUCCESS')){
        $kq=json_decode($kq);
        $ip=$kq->{'data'}->{'ip'};
        $proxyID=$kq->{'data'}->{'id'};
        $host=$kq->{'data'}->{'host'};
        $port=$kq->{'data'}->{'port'};


        // xử lý database lưu  ip vs proxy id đó đi
        return $ip;

    }else{
        $kq=json_decode($kq);
        return $kq->{'message'};
    }
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
        // {"code":0,"message":"","data":{"token":"eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbiI6ImZkNzNiYzRiLTJhNDctNGMwOS04NWVhLTQyYTQxY2Y3MjEwZiIsImV4cCI6MTY0Mzc2Njk2NCwiaWF0IjoxNjQzNzIzNzY0LCJpc3MiOiJ0bS1wcm94eS5jb20iLCJuYmYiOjE2NDM3MjM3NjR9.lIUfZbudNckqSKwL-PuQ81vPqhYsXRVMn2IBvnR0zw24S0Gd01OnLDEOLH6ycOhwRaD5kvMwwaqvzremx0ZWuHpjFEM3lCkmnrhOoa3V00hARtjST1PdSBRWJULJnu_VXd3tejXM7_avZ4fyNTtDRGKzw-F82k8627bLDf7sVJcScFQMpr3rsj1F5Xaiq62CSvpCnEzioOVlTG3kut62xjOQhUqGCAO9MEhAXuznpIeK-exHPfmFqXJq1Zdo7fC_mDEyJpFsUS1amFYOFLgULZpy0rVCtz3brWFDwxvGULU_csS0Z0fhhAUIxK-3Wk-4uTyQNrhdPp7nOWKAa8e6lp_w_8B4CNAglGVWDjr2axhAAk4LZ4A1q5ruLA4ve5Osi-9IZ6XfOp6i152GfV-_hgAZ-y-oiD1SxojWLn0Q6wo8N7DxT0rhPiNZJR2_fgU1UqjP9zvnDchCAZreE7MMKHsAB3K4u-_RYpk_cJU1u4ZxZhjuGWg3RSko-JKm9dVnj9HdgXfOt47mHth3kyyxHhuTa8u9byOEjONyQZc8B-3dqgChAX1UMaP2tOnVTeM3MIAq1e2oWh2qypIebHS6Y9vcAHY2zJd1yJmzXNEklg51LmMNpA_Un7raMIbS-OrWzBlmAaNkpxNc8b2OQJlaklypsyFLnNygrmQnfG_01HM"}}
        $url="https://tmproxy.com/api/order/buy";
        $auth = "Authorization:$token";
        // id 2 là gói 4k , 
        // id 17 là gói 8k
        // id 3 là gói 15k
        $data=array(
            'day'=>'1',
            'id'=>$typeProxy,
            'quantity'=>'1',
        );
        $kq=$cc->PostJson($url,$data,$auth);
        $kq=json_decode($kq);
        if(strpos($kq,'code":0,')!==false){
            $cc->Close();
            $url="https://tmproxy.com/api/proxy/list";
            $data=array();
            $kq=$cc->PostJson($url,$data,$auth);
            if(strpos($kq,'list_api')){
                $length=count($kq->{'data'}->{'list_api'})-1;
                $temp=array_pop($kq->{'data'}->{'list_api'});
                $kq=json_decode($kq);
                $keytmproymoinhat=$kq->{'data'}->{'list_api'}[$length]->{'api'}->{'api_key'};
                // {"code":0,"message":"","data":{"list_api":[{"api":{"id":178063,"expired_at":"09:54:27 09/01/2022","plan":"Đổi IP","price_per_day":4000,"timeout":1800,"base_next_request":240,"note":"API","api_key":"5384a67fca030dc5c450b6a7ee4dfbb5","max_ip_per_day":0,"ip_used_today":0,"id_location":1},"proxy":{"ip_allow":"","location_name":"","socks5":"","https":"","timeout":0,"next_request":0,"expired_at":""},"is_can_get_access_ip":false,"is_expired":true},{"api":{"id":192671,"expired_at":"21:41:28 02/02/2022","plan":"Đổi IP","price_per_day":4000,"timeout":1800,"base_next_request":240,"note":"API","api_key":"651c141e69a127f1e333aa5554802e59","max_ip_per_day":0,"ip_used_today":0,"id_location":1},"proxy":{"ip_allow":"","location_name":"","socks5":"","https":"","timeout":0,"next_request":0,"expired_at":""},"is_can_get_access_ip":false,"is_expired":false}],"max_api":50,"current_count":2}}

            }else{
                $cc->Close();
                return "Mua Key TM Proxy Bị Lỗi";
            }
        }
        if(strlen($kq->{'message'})>10){
            
            return "Mua Key TM Proxy thất bại->Vui lòng inbox admin";
        }

    }else{
        $cc->Close();
        exit("Bị Chặn -> Vui lòng ib admin để biết thêm chi tiết");
    }
}
?>