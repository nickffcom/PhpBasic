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
$tokennick=isset($_POST['tokennick'])?$_POST['tokennick']:'';

$type=isset($_POST['type'])?$_POST['type']:1;


// echo Message(false,"Tính năng này is comming soon");
// return;
require 'config_proxy.php';
$curlVia= new mycurl($kqproxy,$user_pwd);

$haha=$db->insert('history_tool', array(
    'user' => $me['username'],
    'time_su_dung'=>time(), 
    'description' =>':D',
    'chuc_nang'=>'Mới chạy thử Add thẻ + Set Camp'
));
////////
$tokenvia="";
if(strpos($tokennick,'c_user')!==false){
  $curlVia->setCookies($cookies);
  $tokenvia = GetTokenAds($curlVia);
  if(IsNullOrEmpty($tokenvia)){
        echo Message(false,"Lấy token via nhận thất bại/Cookie die",'','','');
        $curlVia->Close();
        return;
  }

}else if(strpos($tokennick,'EAAB')!==false){

}else{
  echo Message(false,"Ko biết chạy đường nào luôn !!!",'','','');
  $curlVia->Close();
  return;
}


switch ($type){
  case 1:  // check fulll ads campaing

    $url="https://graph.facebook.com/v9.0/me/adaccounts?fields=funding_source_details,light_campaigns,account_status,adspaymentcycle,id,currency,amount_spent,balance,name,timezone_name,adtrust_dsl,disable_reason,min_billing_threshold&summary=total_count&access_token=$tokennick&limit=500";
    $kq=$curlVia->get($url);
    if(preg_match('/currency/',$kq)){
      $kq=json_decode($kq);
      $data=$kq->{'data'};
      $arr=array(
      );
      foreach($data as $key=> $item){
         $the=$item->{'funding_source_details'}->{'display_string'};
         if(!isset($the)){
           $the="Chưa có";
         }
         $camp= count($item->{'light_campaigns'}->{'data'});
         if(!isset($camp)){
           $camp="0";
         }else{
           $camp= "Có ".$camp." Ads";
         }
     
         $status=$item->{'account_status'};
         if($status==1){
           $status="Live";
         }else{
           $status="Die/Bất thường";
         }
         $nguong=$item->{'adspaymentcycle'}->{'data'}[0]->{'threshold_amount'};
         if(!isset($nguong)){
           $nguong="K Có";
         }
         $idads=$item->{'id'};
         if(isset($idads)){
           $idads=str_replace('act_','',$idads);
         }
         $currency=$item->{'currency'};
         $tieu=(string)$item->{'amount_spent'}." ".$currency;
         $sodu=(string)$item->{'balance'}." ".$currency;
         $nameads=$item->{'name'};
         $limit=(string)$item->{'adtrust_dsl'};
         if($limit==-1||$limit==1){
           $limit="No-Limit";
         }
         $text=(string)$idads."|".(string)$nameads."|".(string)$limit."|".(string)$tieu."|".(string)$sodu."|".(string)$nguong."|".(string)$the."|".(string)$camp."|".(string)$status;
         $arraynew=array(
           $idads=>$text
         );
        //  array_push($arr,$text);
         $arr+=$arr+$arraynew;
      }
        echo json_encode($arr);
        $curlVia->Close();
  
    }else if(strpos($kq,'data')){
      $loi="Token Bị Fb Chặn";
      $arraynew=array(
        "Dieeee"=>(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi,
        "Dieeeexxxx"=>(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi
      );
      echo json_encode($arraynew);
      $curlVia->Close();
    }else{
      $loi="Token Die/Ko chính Xác";
      $arraynew=array(
        "Dieeee"=>(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi,
        "Dieeeexxx"=>(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi
      );
      echo json_encode($arraynew);
      
    }
    break;
  case 2:  // lên camp 

    $idtkqc=isset($_POST['idtkqc'])?$_POST['idtkqc']:null;
    $target=isset($_POST['target'])?$_POST['target']:'';
    // $appid="119211728144504";
    // $idtkqc="231819119143032";
    // $tokennick="EAABsbCS1iHgBAD0MQWV0ZC8zimW1yX846yNcSs4dWOugIr2xdmb6WZBLZB4frw5c3JMvKY8ENAaBJhj8qe2RoSZAYAbcJ6UZAHc59Ley8OONzZCkcI5pTVG8pSlGaCLybYRbhbA3DX5nxM1w5mHAHcCKTO2RdauizaZA6X6rycAfzVIAZB5wigZCB";
    // $cookies="datr=Da3qYVYmF620VtNRPTZI667A; sb=F63qYTPiRWa2FCETkf863c_v; locale=vi_VN; c_user=100060764839552; cppo=1; wd=1920x581; spin=r.1004963215_b.trunk_t.1642772297_s.1_v.2_; usida=eyJ2ZXIiOjEsImlkIjoiQXI2MmN4Z2M0c3EwayIsInRpbWUiOjE2NDI3NzQ1MTZ9; xs=13%3AN8_3NqAkMWIvOA%3A2%3A1642769734%3A-1%3A743%3A%3AAcWL_wQa5E6IevoZFsN9PITDoOtmRTDqTHlFToHtrQ; fr=0gttLnY60WZ6E1PWE.AWUxYg8pO2rdrozW4Vu1B7zovho.Bh6sD0.x-.AAA.0.0.Bh6sD0.AWWiR3TweDE; presence=C%7B%22t3%22%3A%5B%5D%2C%22utc3%22%3A1642774795305%2C%22v%22%3A1%7D";
    
    $appid="";
    /////////////////////
    $url="https://www.facebook.com/adsmanager/manage/accounts?act=$idtkqc&nav_entry_point=lep_233&nav_source=unknown";
    $kq=$curlVia->get($url);
    if(preg_match('/addraft_([0-9]{5,})/',$kq,$id)){
      $id_draf=$id[1];
      preg_match('/app_id":"([0-9]{5,})/',$kq,$id);
      $appid=$id[1];

    }else{
      echo Message(false,"Cookies die hay sao ấy",'','','');
      $curlVia->Close();
      return;
      
    }

    $url="https://graph.facebook.com/v10.0/act_$idtkqc?fields=current_addrafts,agencies&access_token=$tokenvia";
    $kq=$curlVia->get($url);
    if(strpos($kq,'id')!==false){
        $kq=json_decode($kq);
        $temp=$kq->{'current_addrafts'}->{'data'}->{0}->{'id'};
        $xx=$kq->{'current_addrafts'}->{'data'}[0]->{'id'};
        if(isset($kq->{'current_addrafts'}->{'data'}[0]->{'id'})){
            $id_draf=$kq->{'current_addrafts'}->{'data'}[0]->{'id'};
        
        }else{
            echo Message(false,"Lỗi này liên hệ admin để đc giải thích",'','',''); /// ko lấy đc id bản nháp khi get = token ấy
            $curlVia->Close();
            return;
        }
    }



      /// hoặc regex chuỗi này "id" : "23849096762130638"
      $url="https://www.facebook.com/adsmanager/loadtsv/";
      

      $tsv=$target;
      $fbdtsg=$curlVia->getFbdtsg();
      if(!isset($fbdtsg)){
            echo Message(false,"Cookies nick die/Check lại",'','',''); /// ko lấy đc id bản nháp khi get = token ấy
          return;
      }
      $data=array(
          'account_id'=>$idtkqc,
          'app_id'=>$appid,
          'draft_id'=>$id_draf,
          'image_mapping'=>'',
          'video_mapping'=>'',
          'import_session_token'=>'f1af9d200df3928',
          'tsv'=>$tsv,
          '__usid'=>'5-Tqtz7pp19qzrwn:Pqtz7pn3oc32c:3-Aqtz7ppmt2g9y-RV=5:F=',
          '__user'=>$curlVia->getUid(),
          '__a'=>'1',
          '__dyn'=>'7AgSXghLzaxd2um5rgydg9omoiyoK6FVpkjFGGx6UmwCwgE99oWFGCxiEjCyJz9FGwwxmm4V9AUC37GiidBCBXxWE-bxa2vxi4EOeAy8K26ULypLBzogwCzUOESegGbwgEmiyoyazoO4oJ1S5FQ6bz8ix2q9hUhCCxaezWK4oWubg9p44889EScxyu6UGq13yHGmmUTxJe9LgbdkGypVRg8RpoiyXzp8KUV2UCcBAyU6O78jCh9XBAzECi9lpubwIAzEOi3Kdx12410zVubUmxSfwgEnxaFo551WcgsxN6Kh7ByUObwAAyFosDwOADggK7onwFDCG4UJ164AbxRoCiexqUyfxd0RyUSWDzUlwBx6i1iyXxJyAfDy8b9azAUy7rKfyoCfzE-eAwEwAz8iCxeq4qz8gwSwDwZAwLzUS7ogUuyEiwAgCnjxK9K8yUnwUzpUqwGzXyKcCxyU-5aCCyrgKEGm2uHQfwPybyUDxa58SEhyVEKvDDAm22eCyKqifxe4E',
          '__csr'=>'',
          '__req'=>'11',
          '__hs'=>'18778.EXP3:ads_manager_pkg.2.0.0.0',
          'dpr'=>'1.5',
          '__ccg'=>'UNKNOWN',
          '__rev'=>'1003879698',
          '__s'=>'mf4vay:loamft:2zrqvg',
          '__hsi'=>'6968465876213633534',
          '__comet_req'=>'0',
          'fb_dtsg'=>$fbdtsg,
          'jazoest'=>'22637',
          'lsd'=>'DakMnDMWWOKDurhlQHxNeN',
          '__spin_r'=>'1003879698',
          '__spin_b'=>'trunk',
          '__spin_t'=>'1622472395',
          '__jssesw'=>'1',
      );
      $kq=$curlVia->post($url,$data);
    //   for (;;);{"__ar":1,"payload":{"async_session_id":"456440655942625"},"hsrp":{"hblp":{"consistency":{"rev":1004957698}}},"lid":"7055290421866255436"}
      if(preg_match('/async_session_id\":\"([0-9]{5,})/',$kq)){
      // 
    //  "for (;;);{"__ar":1,"payload":{"async_session_id":"480725416777965"},"hsrp":{"hblp":{"consistency":{"rev":1004963282}}},"lid":"7055665218099207280"}"
      }else{
        echo Message(false,"Up Load File Target Lỗi =>Check lại đi ",'','','');
        $curlVia->Close();
        return;
      }
      sleep(6); // đoạn này cần while để chờ nè

      $url="https://graph.facebook.com/v10.0/$id_draf/addraft_fragments?access_token=$tokenvia";
      $kq=$curlVia->get($url);
      $fragments="[";
      if(preg_match('/([0-9]{5,})/',$kq)){
        $kq=json_decode($kq);
        $listID=$kq->{'data'};
        foreach ($listID as $item){
            $id =$item->{'id'};
            $fragments=$fragments."\"$id\",";
        }
        $fragments=$fragments."]";
        //  ["","","",]
        $fragments=str_replace(',]',']',$fragments);
      }else{
        echo Message(false,"Lỗi :Kiểm tra lại Target =>Nên up thủ công = tay 1 lần xem target ổn không đã",'','','');
        $curlVia->Close();
        return;
      }
    $url="https://graph.facebook.com/v10.0/$id_draf/publish?_app=ADS_MANAGER&_reqName=object%3Adraft_id%2Fpublish&access_token=$tokenvia&method=post&qpl_active_flow_ids=270216423&qpl_active_flow_instance_ids=270216423_fbebf8e33fbd68&__cppo=1";
    $data=array(
        '__activeScenarioIDs'=>'["f342f91e9e71d44_1622351412970.01"]',
        '__activeScenarios'=>'["review_and_publish"]',
        '_app'=>'ADS_MANAGER',
        '_index'=>'53',
        '_reqName'=>'object:draft_id/publish',
        '_reqSrc'=>'AdsDraftPublishDataManager',
        '_sessionID'=>'6b93ef8f39886c21',
        'append'=>'false',
        'fragments'=>$fragments,
        'ignore_errors'=>'true',
        'include_fragment_statuses'=>'true',
        'include_headers'=>'false',
        'locale'=>'en_US',
        'method'=>'post',
        'pretty'=>'0',
        'qpl_active_flow_ids'=>'270216423',
        'qpl_active_flow_instance_ids'=>'270216423_fbebf8e33fbd68',
        'suppress_http_code'=>'1',
        'xref'=>'f15dc6af5fd615c',
    );
    $kq=$curlVia->post($url,$data);
    if(preg_match('/status/',$kq)){
        $kq=json_decode($kq);
        $haha=$kq->{'publish_status'}->{'fragment_statuses'}[0]->{'status'};
        if(strpos($haha,'IN_PROGRESS')){
            echo Message(true,"Lên camp success->>Đang xét duyệt",'','','');
            $curlVia->Close();
        }else{
            echo Message(true,"Lên camp:$haha",'','','');
            $curlVia->Close();
        }
    }else{
        echo Message(false,"Lên camp thất bại=>Kiểm tra lại chính xác chưa",'','','');
        $curlVia->Close();
    }

    break;

  case 3: // add thẻ
    
    break;
  default:
    break;
}
$curlVia->Close();

// if(strpos($type,'5')===false){
  
//     // cách lấy token đây  window.__accessToken=\"(EAA.*?)\"
//     //

// }else{
//   $url="https://graph.facebook.com/v9.0/me/adaccounts?fields=funding_source_details,light_campaigns,account_status,adspaymentcycle,id,currency,amount_spent,balance,name,timezone_name,adtrust_dsl,disable_reason,min_billing_threshold&summary=total_count&access_token=$tokennick&limit=500";
//   $kq=$curlVia->get($url);
//   if(preg_match('/currency/',$kq)){
//     $kq=json_decode($kq);
//     $data=$kq->{'data'};
//     $arr=array();
//     foreach($data as $key=> $item){
//        $the=$item->{'funding_source_details'}->{'display_string'};
//        if(!isset($the)){
//          $the="Chưa có";
//        }
//        $camp= count($item->{'light_campaigns'}->{'data'});
//        if(!isset($camp)){
//          $camp="0";
//        }else{
//          $camp= "Có ".$camp." Ads";
//        }
   
//        $status=$item->{'account_status'};
//        if($status==1){
//          $status="Live";
//        }else{
//          $status="Die/Bất thường";
//        }
//        $nguong=$item->{'adspaymentcycle'}->{'data'}[0]->{'threshold_amount'};
//        if(!isset($nguong)){
//          $nguong="K Có";
//        }
//        $idads=$item->{'id'};
//        if(isset($idads)){
//          $idads=str_replace('act_','',$idads);
//        }
//        $currency=$item->{'currency'};
//        $tieu=(string)$item->{'amount_spent'}." ".$currency;
//        $sodu=(string)$item->{'balance'}." ".$currency;
//        $nameads=$item->{'name'};
//        $limit=(string)$item->{'adtrust_dsl'};
//        if($limit==-1||$limit==1){
//          $limit="No-Limit";
//        }
//        $text=(string)$idads."|".(string)$nameads."|".(string)$limit."|".(string)$tieu."|".(string)$sodu."|".(string)$nguong."|".(string)$the."|".(string)$camp."|".(string)$status;
//        $arraynew=array(
//          $idads=>$text
//        );
//       //  array_push($arr,$text);
//        $arr+=$arr+$arraynew;
//     }
//       echo json_encode($arr);
//       $curlVia->Close();

//   }else if(strpos($kq,'data')){
//     $loi="Token Bị Fb Chặn";
//     $arraynew=array(
//       "Dieeee"=>(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi,
//       "Dieeeexxxx"=>(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi
//     );
//     echo json_encode($arraynew);
//     $curlVia->Close();
//   }else{
//     $loi="Token Die/Ko chính Xác";
//     $arraynew=array(
//       "Dieeee"=>(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi,
//       "Dieeeexxx"=>(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi."|".(string)$loi
//     );
//     echo json_encode($arraynew);
//     $curlVia->Close();
//   }
// }

// $url="https://graph.facebook.com/v11.0/$object_id?_app=ADS_MANAGER&_reqName=object:addraft_fragment&access_token=$tokennick&method=post&__cppo=1";
// $data=array(
//   '__activeScenarioIDs'=>'[]',
//   '__activeScenarios'=>'[]',
//   '_app'=>'ADS_MANAGER',
//   '_reqName'=>'object:addraft_fragment',
//   '_reqSrc'=>'AdsDraftFragmentDataManager',
//   '_sessionID'=>'6b93ef8f39886c21',
//   'account_id'=>$idtkqc,
//   'action'=>'add',
//   'ad_draft_id'=>$id_draf, // 23849096762130638
//   'ad_object_id'=>$object_id,
//   'ad_object_type'=>'ad_set',
//   'draft_version'=>'1',
//   'fragment_version'=>'3',
//   'qpl_active_flow_ids'=>'270216423',
//   'qpl_active_flow_instance_ids'=>'270216423_fbebf8e33fbd68',
//   'suppress_http_code'=>'1',
//   'xref'=>'f15dc6af5fd615c',
// );

?>