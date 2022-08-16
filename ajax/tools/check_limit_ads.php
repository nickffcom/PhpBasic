<?php
// require_once 'core/config.php';
require_once 'mycurl.php';
require_once 'model.php';
require_once 'msg.php';

$proxy=isset($_POST['proxy'])?$_POST['proxy']:'';  // cái này là chỉ share
$tmproxy=isset($_POST['tmproxy'])?$_POST['tmproxy']:'';
$tokenvia=isset($_POST['tokenvia'])?trim($_POST['tokenvia']):exit();
$type=isset($_POST['type'])?$_POST['type']:exit();


// check có record với cái bảng chức năng tương ứng ko , sau đó nếu có check tiếp time > time_hethan thì cho cút
// $data = $db->where('type_id', $typeid)->where('user_mua',$me['uid'])->getOne('chuc_nang');
// if(isset($data)){
//     $timehientai=time();
//     if(($timehientai - $data['time_hethan'])<0){
//          $haha = $timehientai -$data['time_hethan'];
//     }else{
//         echo Message(false,"Chưa mua chức năng này=> mua di ck iuuu");
//     }
    
// }else{
//     echo Message(false,"Chưa mua chức năng này=> mua di ck iuuu");
// }

// //$timeso=mktime($month);
// $db->insert('chuc_nang', array(
//     'type_id' =>$typeid,
//     'time_mua' =>$check,
//     'user_mua' => 3,
//     'time_hethan' => $month,
// ));

// SELECT * from chuc_nang WHERE type_id=37 and user_mua=$me['uid];

// return;  


require 'config_proxy.php';
$curlVia= new mycurl($kqproxy,$user_pwd);
$haha=$db->insert('history_tool', array(
    'user' => $me['username'],
    'time_su_dung'=>time(), 
    'description' =>':D',
    'chuc_nang'=>'Quản Lý Ads Meta'
));
if(strpos($tokenvia,'EAAG')!==false||strpos($tokenvia,'EAAB')!==false){
  
}
else if(strpos($tokenvia,'c_user')!==false){
    $curlVia->setCookies($tokenvia);
    $tokenvia = GetTokenAds($curlVia);
    if(IsNullOrEmpty($tokenvia)){

        // $kq=$curlVia->get("https://www.facebook.com/ads/manager/accounts");
        // preg_match('/act=([0-9]{7,})/',$kq,$idnek);
        // if(!$idnek){
        //     echo Message(false,"Cookies die cmnr");
        //     $curlVia->Close();
        // }
        // $idtkc=$idnek[1];
        // $kq=$curlVia->get("https://www.facebook.com/adsmanager/manage/campaigns?act=$idtkc&nav_entry_point=lep_233&nav_source=unknown");
        // if(preg_match('/accessToken=\"(.*?)\"/',$kq,$haha)){

        //     $tokenvia=$haha[1];

        // }else{
            echo Message(false,"Lấy token via thất bại/Cookies die/ Vào dính xác thực 2 yếu tố",'','','');
            $curlVia->Close();
            return;
        
     
    }

}else{
    echo Message(false,'Định dạng Sai');
    $curlVia->Close();
    exit();
}  
 // cái này hay nè cellspacing="0"
switch($type){

    case 1:
        echo CheckFullAds($curlVia,$tokenvia);
        break;
    case 2: // share tkqc cá nhân sang nick khác
        $tkqc=isset($_POST['tkqc'])?$_POST['tkqc']:exit();
        $outtkqc=isset($_POST['outtkqc'])?$_POST['outtkqc']:null;
        $uidnhan=isset($_POST['uidnhan'])?$_POST['uidnhan']:exit();
        $role=isset($_POST['role'])?$_POST['role']:null;
        $arr=json_decode($tkqc);
        if(count($arr)==0||$arr==false){
            echo Message(false,'ID TKQC ĐÂU ???','','','');
            break;
        }
        if(count($arr)>5){
            echo Message(false,'Số Ặc Chạy Tối Đa Của Bạn là 5','','','');
            break;
        }
        $kq=array(
            'data'=>array(),
        );
        foreach($arr as $key => $item){
            sleep(1);
            $haha=count($item);
            if($haha<1){
                echo Message(false,'Kiểm tra lại định dạng =>> Sai','','','');
                exit();
            }
            $index=isset($item->{'vitri'})?$item->{'vitri'}:exit();
            $idtkqc=isset($item->{'idads'})?$item->{'idads'}:exit();
           
            $text="";
            $status=true;
            $kqshare=ShareTkqc($curlVia,$idtkqc,$uidnhan,$tokenvia,$role);
            // "{"success":true}"
            if(preg_match('/success":true/',$kqshare)){
               
                if(strlen($outtkqc)>3){
                    $kqout =OutTkqc($curlVia,$idads,$uidnhan,$tokenvia);
                    if(strpos($kqout,'success')){
                        $text="Share Success=>Đã Out";
                        // echo Message(true,"Share tkqc:thành công",$idads,'Đã Out',$curlClone->getCookies());
                    }else{
                        // echo Message(true,"Share tkqc:thành công",$idads,'Out Fail:'.$kqout,$curlClone->getCookies());
                        $text="Share Success=>Out TKQC Fail".$kqout;
                    }
                   
                }else{
                    $text="Share Success >3 ";
                }
    
            }else if(preg_match('/error_user_msg\":\"(.*?)\"/',$kqshare,$loinek)){

              
                $text="Share Fail:".$loinek[1];
                $status=false;
                // "To add someone to your ads account, please enter the email address associated with a Facebook account. Otherwise, you can enter the name of a friend."
            }else if(  preg_match('/message\":\"(.*?),"/',$kqshare,$loinek)){
                $text="Share Fail:".$loinek[1];
                $tam = array(
                    'index'=>$index,
                    'idtkqc'=>$idtkqc,
                    'stt'=>$text,
                    'status'=>$status
                );
            }else{
                $text=$kqshare;
                $tam = array(
                    'index'=>$index,
                    'idtkqc'=>$idtkqc,
                    'stt'=>$kqshare,
                    'status'=>$status
                );
            }
           
            $kq['data'][$key]=$tam;
            
        }
        echo json_encode($kq);
        break;
    case 3:  // share tkqc cá nhân vào bm

        
        $idbm=isset($_POST['bmnhan'])?trim($_POST['bmnhan']):exit();
        $tkqc=isset($_POST['tkqc'])?$_POST['tkqc']:exit();
        $dong=isset($_POST['dong'])?$_POST['dong']:exit();
        $text="";
        $status=true;

        $arr=json_decode($tkqc);
        if(count($arr)==0||$arr==false){
            echo Message(false,'ID TKQC ĐÂU ???','','','');
            break;
        }
        if(count($arr)>5){
            echo Message(false,'Số Ặc Chạy Tối Đa Của Bạn là 5','','','');
            break;
        }
        $kq=array(
            'data'=>array(),
        );
        foreach($arr as $key => $item){
            
            $haha=count($item);
            if($haha<1){
                echo Message(false,'Kiểm tra lại định dạng =>> Sai','','','');
                exit();
            }
            $index=isset($item->{'vitri'})?$item->{'vitri'}:exit();
            $idtkqc=isset($item->{'idads'})?$item->{'idads'}:exit();
            if(strpos($dong,'1')!==false){
                $url="https://graph.facebook.com/v12.0/$idbm/owned_ad_accounts?access_token=$tokenvia&__cppo=1";
                $data=array(
                    '_reqName'=>'object:brand/owned_ad_accounts',
                    '_reqSrc'=>'AdAccountActions.brands',
                    'access_type'=>'OWNER',
                    'adaccount_id'=>'act_'.$idtkqc,
                    'locale'=>'en_US',
                    'method'=>'post',
                    'pretty'=>'0',
                    'suppress_http_code'=>'1',
                    'xref'=>'f14ec30345bc6e',
                );
                $result=$curlVia->post($url,$data);
                if(preg_match('/error_user_msg\":\"(.*?)\"/',$result,$loinek)){
                    $status=false;
                    preg_match('/message\":\"(.*?)\"/',$result,$tinnhan);
                    $text="Lỗi:".$loinek."-".$tinnhan[1];
                }else if( preg_match('/message\":\"(.*?)\"/',$result,$tinnhan)){
                    $text="Fail =>> ".$tinnhan[1];
                    $status=false;
                }else{
                    $text="Không xác định tự kiểm tra nhaaa ck".$result;
                }
                $tam = array(
                    'index'=>$index,
                    'idtkqc'=>$idtkqc,
                    'stt'=>$text,
                    'status'=>$status
                );
                $kq['data'][$key]=$tam;


            }else{
                $result=LoiMoiAcceptTkqc($curlVia,$idbm,$idtkqc,$tokenvia);
                    // "{"success":true}"
                if(strpos($result,'error')!==false){
                    preg_match('/message\": \"(.*?)\"/',$result,$loinek);
                    $text="Share Thất Bại:".$loinek[1];
                    $status=false;
                }else if(strpos($result,'CONFIRMED')||strpos($result,'has access to the object')||strpos($result,'accepted') ||strpos($result,'this agency')){
                    $text="Thêm TKQC -> BM Success";
                }else{
                    $text="Thêm ko xác định:".$result;
                    $status=false;
                }
                    $tam = array(
                        'index'=>$index,
                        'idtkqc'=>$idtkqc,
                        'stt'=>$text,
                        'status'=>$status
                    );
                    $kq['data'][$key]=$tam;
            }
           
            
        }
        echo json_encode($kq);
       
        break;

    case 4: // share pixel

        $idbm=isset($_POST['idbm'])?$_POST['idbm']:exit();
        $idpixel=isset($_POST['idpixel'])?$_POST['idpixel']:exit();
        $tkqc=isset($_POST['tkqc'])?$_POST['tkqc']:exit();
        $text="";
        $status=true;
        $arr=json_decode($tkqc);
        if(count($arr)==0||$arr==false){
            echo Message(false,'ID TKQC ĐÂU ???','','','');
            break;
        }
        if(count($arr)>5){
            echo Message(false,'Số Ặc Chạy Tối Đa Của Bạn là 5','','','');
            break;
        }
        $kq=array(
            'data'=>array(),
        );
        foreach($arr as $key => $item){
            sleep(1);
            $haha=count($item);
            if($haha<1){
                echo Message(false,'Kiểm tra lại định dạng =>> Sai','','','');
                exit();
            }
            $index=isset($item->{'vitri'})?$item->{'vitri'}:exit();
            $idtkqc=isset($item->{'idads'})?$item->{'idads'}:exit();
          $url="https://graph.facebook.com/v8.0/$idpixel/shared_accounts";
          $data=array(
              'account_id'=>$idtkqc,
              'access_token'=>$tokenvia,
              'business'=>$idbm
          );
          $kq=$curlVia->post($url,$data);
          if(strpos($kq,'error')!==false){
            preg_match('/message\": \"(.*?)\"/',$kq,$loinek);
            $text="Share Pixel Thất Bại:".$loinek[1];
            $status=false;
          }else if(strpos($kq,'success')!==false||strpos($kq,'CONFIRMED')||strpos($kq,'has access to the object')||strpos($kq,'accepted')){
            $text="Share Pixel vào $idtkqc success";
          }else{
              $text="Share Pixel k xác định:".$kq;
              $status=false;
          }
            $tam = array(
                'index'=>$index,
                'idtkqc'=>$idtkqc,
                'stt'=>$text,
                'status'=>$status
            );
            // array_push($kq,$tex);
            $kq['data'][$key]=$tam;
            
        }
        echo json_encode($kq);
        break;
    case 5: // gửi lời mời kết bạn đến UID
        $uidketban=(isset($_POST["uidketban"]))?$_POST['uidketban']:exit();
        $guid=$_POST['guid'];
        $kq=SendKetBan($curlVia,$uidketban,$tokenvia,$guid);
        if(preg_match('/friend_request_send/',$kq)){
            echo Message(true,'Gửi lời mời kết bạn thành công');
            return "OK";
        }else if(preg_match('/message\":\"(.*?)\"/',$kq,$loinek)){
            echo Message(true,'Gửi lời mời kb Lỗi'.$loinek[1]);
            return;
        }else{
            echo Message(true,'Gửi lời mời kb lỗi k xác định'.$kq);
            return;
        }
    case 6: // get link qtv bm
        // $idbm=(isset($_POST['idbm']))?$_POST['idbm']:exit();
        // $arr=explode('|',$idbm);
        // $text="";
        // $status=false;
        // if(count($arr)==0||$arr==false){
        //     echo Message(false,'ID BM đâu ???','','','');
        //     break;
        // }
        // if(count($arr)>5){
        //     echo Message(false,'Số luồng chạy một lúc của bạn là 5','','','');
        //     break;
        // }
        // $kq=array(
        //     'data'=>array(),
        // );
        // foreach($arr as $key => $item){
        //     sleep(1);
        //     $temp=explode(':',$item);
        //     $index=$temp[0];
        //     $idtkqc=$temp[1];
            
        //     require_once 'text.php';  
        //     $randomEmailmoi=generateRandomString(3,6)."@gmail.com";
        //     $kq=AddQTVBm($curlVia,$idtkqc,$tokenvia,$randomEmailmoi);
        //     if( preg_match('([0-9]{5,})',$kqqtv,$idmoi)){
        //         $kq=LayLinkMoi($curlVia,$tokenvia,$idtkqc);
        //         $text="Ko lấy đc Link BM";
        //         if(strpos($kq,'email')){
        //             $kq=json_decode($kq);
        //             $data=$kq->{'data'};
        //             foreach($data as $item){
        //                 $idloimoi=$item->{'id'};
        //                 if(strpos($idmoi[1],$idloimoi)){
        //                     $tinhtrang=$item->{'status'};
        //                     $link=$item->{'invite_link'};
        //                     $text=$link."-".$tinhtrang;
        //                 }
        
        //             }
        //            $status=true;

        //         }else{
        //             $text="Lấy Link BM Fail:";
        //         }
        //     }else{
        //         $text="Thêm qtv để lấy link lỗi:";
        //         break;
        //     };
        //     $tam = array(
        //         'index'=>$index,
        //         'idtkqc'=>$idtkqc,
        //         'stt'=>$text,
        //         'status'=>$status
        //     );
        //     $kq['data'][$key]=$tam;
            
        // }
        // echo json_encode($kq);
        break;
    case 7: // change Info Ads
      
        $muigio=isset($_POST['muigio'])?$_POST['muigio']:null;
        $tiente=isset($_POST['tiente'])?$_POST['tiente']:null;
        $tkqc=isset($_POST['tkqc'])?$_POST['tkqc']:exit();
        $text="";
        $status=false;
        $arr=json_decode($tkqc);
        if(count($arr)==0||$arr==false){
            echo Message(false,'ID TKQC ĐÂU ???','','','');
            break;
        }
        if(count($arr)>5){
            echo Message(false,'Số Ặc Chạy Tối Đa Của Bạn là 5','','','');
            break;
        }
        $kq=array(
            'data'=>array(),
        );
        $thamchieu=array(
            '140'=>'Asia/Ho_Chi_Minh',
            '132'=>'Asia/Bangkok',
            '128'=>'Asia/Singapore',
            '95'=>'Asia/Kuala_Lumpur',
            '94'=>'America/Mexico_City',
            '77'=>'Asia/Tokyo',
            '74'=>'Europe/Rome',
            '58'=>'Europe/London',
            '47'=>'Europe/Berlin',
            '8'=>'Asia/Dubai',
            '6'=>'America/Chicago',
            '2'=>'America/Denver',
            '7'=>'America/New_York',
            '57'=>'Europe/Paris',
            '134'=>'Europe/Istanbul',
            '135'=>'America/Port_of_Spain',
            '116'=>'Europe/Moscow',
            '110'=>'Europe/Lisbon',
            '94'=>'America/Mexico_City',
            '55'=>'Europe/Madrid',
            '62'=>'Asia/Hong_Kong',
            '66'=>'Asia/Jakarta',
            '79'=>'Asia/Seoul',
            '98'=>'Europe/Amsterdam',
            '102'=>'America/Panama',
            
        );
        $muigio=$thamchieu[$muigio];

        foreach($arr as $key => $item){
           
            $haha=count($item);
            if($haha<1){
                echo Message(false,'Kiểm tra lại định dạng =>> Sai','','','');
                exit();
            }
            $index=isset($item->{'vitri'})?$item->{'vitri'}:exit();
            $idtkqc=isset($item->{'idads'})?$item->{'idads'}:exit();
        
            $variable="{\"input\":{\"billable_account_payment_legacy_account_id\":\"$idtkqc\",\"timezone\":\"$muigio\",\"currency\":\"$tiente\",\"tax\":{\"business_address\":{\"city\":\"\",\"country_code\":\"US\",\"state\":\"ADS.CENTER\",\"street1\":\"ADS.CENTER 79\",\"street2\":\"ADS.CENTER 7979\",\"zip\":\"79799\"},\"business_name\":\"Ads69\",\"is_personal_use\":false},\"client_mutation_id\":\"3\"}}";
            // $url="https://graph.facebook.com/graphql?method=post&pretty=false&format=json&doc_id=4119854918068296&server_timestamps=true&variables=$variable&access_token=".$tokenvia;
            // $kq=$curlVia->get($url);
            $url="https://graph.facebook.com/graphql";
            $data=array(
                'method'=>'post',
                'pretty'=>'false',
                'format'=>'json',
                'doc_id'=>'4119854918068296',
                'server_timestamps'=>'true',
                'variables'=>$variable,
                'access_token'=>$tokenvia
            );
            $result=$curlVia->post($url,$data);
            if(preg_match('/billable_account_update\":null/',$result)){
                preg_match('/description\":\"(.*?)\"/',$result,$loinek);
                $text="Đổi Fail: ".$loinek[1]." Kiểm tra IP/Nguồn Nick ......";
               
            }else if(preg_match('/billable_account_update\":true/',$result)){
                preg_match('/description\":\"(.*?)\"/',$result,$loinek);
                $status=true;
                $text="Hình như đổi OK".$loinek[1];
            }else{
                preg_match('/message\":\"(.*?)\"/',$result,$loinek);
                $text="Ko xác định".$loinek[1];

            }

            $tam = array(
                'index'=>$index,
                'idtkqc'=>$idtkqc,
                'stt'=>$text,
                'status'=>$status
            );
            $kq['data'][$key]=$tam;
            
        }
        echo json_encode($kq);
        break;
    case 8: // kích trả trước
        if(strpos($_POST['tokenvia'],'c_user')!==false){
            
        }else{
            exit();
        }
        $tkqc=isset($_POST['tkqc'])?$_POST['tkqc']:exit();
        $text="";
        $status=false;

        $fbdtsg=$curlVia->getFbdtsg();
        $uid=$curlVia->getUid();
        if(IsNullOrEmpty($fbdtsg)||IsNullOrEmpty($uid)){
            echo Message(false,"Cookies die hay sao ấy,check lại đi");
            break;
        }

        $arr=json_decode($tkqc);
        if(count($arr)==0||$arr==false){
            echo Message(false,'ID TKQC ĐÂU ???','','','');
            break;
        }
        if(count($arr)>5){
            echo Message(false,'Số Ặc Chạy Tối Đa Của Bạn là 5','','','');
            break;
        }
        $kq=array(
            'data'=>array(),
        );
       

        foreach ($arr as $key => $item) {
            $haha=count($item);
            if ($haha<1) {
                echo Message(false, 'Kiểm tra lại định dạng =>> Sai', '', '', '');
                exit();
            }
        
            $index=isset($item->{'vitri'})?$item->{'vitri'}:exit();
            $idtkqc=isset($item->{'idads'})?$item->{'idads'}:exit();
            $url="https://business.secure.facebook.com/ajax/payment/token_proxy.php?tpe=/api/graphql/";
           
            $variable="{\"input\":{\"client_mutation_id\":\"3\",\"actor_id\":\"$uid\",\"logging_data\":{\"logging_counter\":21,\"logging_id\":\"\"},\"payment_account_id\":\"$idtkqc\"}}";
            $data=array(
                'av'=>$uid,
                'payment_dev_cycle'=>'prod',
                '__user'=>$uid,
                '__a'=>'1',
                '__dyn'=>'',
                '__req'=>'1g',
                '__beoa'=>'0',
                '__pc'=>'PHASED:powereditor_pkg',
                'dpr'=>'1.5',
                '__ccg'=>'EXCELLENT',
                '__rev'=>'1002523221',
                '__s'=>'',
                '__hsi'=>'6',
                '__comet_req'=>'0',
                'fb_dtsg'=>$fbdtsg,
                'jazoest'=>'22058',
                '__spin_r'=>'1002523221',
                '__spin_b'=>'trunk',
                '__spin_t'=>'',
                'fb_api_caller_class'=>'RelayModern',
                'fb_api_req_friendly_name'=>'BillingPrepayUtilsCreateStoredBalanceMutation',
                'variables'=>$variable,
                'server_timestamps'=>'true',
                'doc_id'=>'3138742652811181'
    
    
            );
            $result=$curlVia->post($url,$data);
            if(preg_match('/create_stored_balance_for_ad_account":null/',$result)){
                preg_match('/summary\":\"(.*?)\"/',$result,$loinek);
                $text="Kick Thất bại:".$loinek[1];
            }else if(  preg_match('/message\":\"(.*?)\"/',$result,$loinek)){
                $text="Fail Hay sao ấy:".$loinek[1];
            }else{
                $text="Tự kiểm tra nha ck iuu".$result;
            }
            $tam = array(
                'index'=>$index,
                'idtkqc'=>$idtkqc,
                'stt'=>$text,
                'status'=>$status
            );
            $kq['data'][$key]=$tam;

        }
        echo json_encode($kq);
        break;    
    default:
      $curlVia->Close();
      exit();
}
$curlVia->Close();
?>