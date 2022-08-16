<?php
// require_once 'xulyproxy.php';
// require_once 'mycurl.php';
// require_once 'model.php';
// require_once 'msg.php';

// $uid=isset($_POST['uid'])?trim($_POST['uid']):'';
// $proxy=isset($_POST['proxy'])?$_POST['proxy']:'';
// $cookies=isset($_POST['cookies'])?$_POST['cookies']:'';
// // $tokennick=isset($_POST['tokennick'])?$_POST['tokennick']:exit;
// // $idtkqc=$_POST('idtkqc');
// // $thenek=isset($_POST['tokennick'])?$_POST['tokennick']:exit;
// // $arrthe=str_split($thenek);
// // $zip=$_POST('zip');
// // $country_code=$_POST('country_code');

// // $nameCard=$arrthe[0];
// // $numberCard=$arrthe[0];
// // $thanghethan=$arrthe[1];;
// // $namhethan=$arrthe[2];
// // $csv=$arrthe[3];
// $idtkqc="";//479366460573641//

// $token="";
// $urlcheck="https://graph.facebook.com/v2.11/me?fields=name,friends,email,gender,birthday&access_token=".$token;



// // nếu kháng thẳng thì vào link này https://www.facebook.com/checkpoint/1501092823525282/1078188343026520/?next=%2Faccountquality%2F

// $curlVia=new mycurl();   // idtkqc k phải nha , cái gì ấy  , tkqc ặc share qua là 4439814849430253
// $url="https://www.facebook.com/checkpoint/1501092823525282/$idtkqc/";  //479366460573641
// $url="https://www.facebook.com/checkpoint/1501092823525282/479366460573641/";
// $urlnayne="https://www.facebook.com/checkpoint/1501092823525282/4439814849430253/?next=/accountquality/"; // check xem ,nếu chưa hcqc/chưa share thì k dc
// $kq=$curlVia->get($url);
// if(strlen($kq)<5){
//     echo Message(false,'Chưa share tkqc thành công=>K vào link xmdt đc','','','');
//     $curlVia->Close();
//     return;
// }


// /// trường hợp kháng thẳng đây nè "
// // trong cái  check hcqc api/graph nó có trả về decision_id":"462680728629974"}},"
// // và  restriction_type: "PREHARM"  status: "VANILLA_RESTRICTED"  __typename: "PreHarmAdvertisingRestrictionAdditionalParameters"
// $decision_id='';
// $url="https://www.facebook.com/accountquality/ufac/?decision_id=462680728629974";
// $data=array(
//     'session_id'=>'229848ec0256c53b', // uid nick
//     '__user'=>$uid,
//     '__a'=>'1',
//     '__dyn'=>'7xeUmBz8aolJ28S2q3mbwyyVuCEnxG2q12wAxiFEdpE6C4UKewPGi4FoixWE-16xq7UWdwJz-4fwAwgUgwqoqyoyazoO4o461mCwOxa7FEhwywCxq2u3K6UG1lKFpod8S3bg-3tpUdoK7UC4F87y78jxiUa8522m3K7EC11xnzoO9ws82Bz84aVpUuyUd88EeAUpK7oaUlDwFg942B12ewi8doa88Ea8mwnHxJUpx2364kUy26U8U-7EjwjovCxeq4qxS0D8d8-dwKwHxa3u3ubxu3ydCgqw-z8c8-5aDBwEBwKG13y85i4oKqbDyo-2-qaUK2e1GwtU2VK',
//     '__csr'=>'',
//     '__req'=>'p',
//     '__hs'=>'19018.BP:DEFAULT.2.0.0.0.',
//     'dpr'=>'1',
//     '__ccg'=>'EXCELLENT',
//     '__rev'=>'1004979745',
//     '__s'=>'0sjwi7:yopaz6:9o9ckv',
//     '__hsi'=>'7057391120671519702-0',
//     '__comet_req'=>'1',
//     'fb_dtsg'=>$fbdtsg,
//     'jazoest'=>'21921',
//     'lsd'=>'GuHROPTXSydXjBr0mCfo0t',
//     '__spin_r'=>'1004969033',
//     '__spin_b'=>'trunk',
//     '__spin_t'=>'1643036794',

// );
// $kq=$curlVia->post($url,$data);
// preg_match('/\"enrollment_id\":(\\d+)},/',$kq,$match);
// preg_match('/{\"enrollment_id\":\"(\\d+)\"},/',$kq,$matchtwo);

// if(strlen($kq)>3){
//     "Thất bại vì cái này ko trả về kq gì cả";
// }
  
// // kết thúc kháng thẳng 



// // gặp cái này thi mới ấn tiếp tục nè UFACCometAppQueryRelayPreloader hoặc là vào được bước tiếp tục
// $url="https://www.facebook.com/api/graphql/";  // bước này là ấn tiếp tục để nó ra cái màn hình catpcha nè
// $uid=$curlVia->getUid();
// $fbdtsg=$curlVia->getFbdtsg();
// if(!isset($fbdtsg)){
//     echo Message(false,"Cookies/Nick Die",'','','');
//     return;
// }
// $variable="{\"input\":{\"client_mutation_id\":\"1\",\"actor_id\":\"$uid\",\"action\":\"PROCEED\",\"enrollment_id\":\"$idtkqc\"},\"scale\":1}";
// $data=array(
//     'av'=>$uid, // uid nick
//     '__user'=>'',
//     '__a'=>'',
//     '__dyn'=>'7xeUmwlE7ibwKBWo2vwAxu13w8CewSwMwNw9G2S0im3y4o0B-q1ew65xO0FE2awt81sbzo5-0Boy1PwBgao6C0Mo5W3S1lwlEjxG1Pxi4UaEW0D888cobEaU2eU5O0HUvw4JwJwSyES1Mw9m0Lo',
//     '__csr'=>'gKJIwm89AyJ5xaQ78S5ohGdz8K2yu1JxS1fxq0Co6C0Go984a05wU03sixy',
//     '__req'=>'c',
//     '__hs'=>'19016.HYP:comet_pkg.2.1.0.2.',
//     'dpr'=>'1',
//     '__ccg'=>'UNKNOWN',
//     '__rev'=>'1004969033',
//     '__s'=>'l1mqpa:y0acvw:dytctz',
//     '__hsi'=>'7056789296511792090-0',
//     '__comet_req'=>'1',
//     'fb_dtsg'=>$fbdtsg,
//     'jazoest'=>'21921',
//     'lsd'=>'GuHROPTXSydXjBr0mCfo0t',
//     '__spin_r'=>'1004969033',
//     '__spin_b'=>'trunk',
//     '__spin_t'=>'1643036794',
//     'fb_api_caller_class'=>'RelayModern',
//     'fb_api_req_friendly_name'=>'useUFACSubmitActionMutation',
//     'variables'=>$variable,
//     'server_timestamps'=>'true',
//     'doc_id'=>'4758656487536655',

// );
// $kq=$curlVia->post($url,$data); // post để nó hện ra cái catpcha
// // trả về
// $persist_data="";
// if(strpos($kq,$idtkqc)!==false && strpos($kq,'UFACBotCaptchaState')){
//     $kq=json_decode($kq);
//     $persist_data=$kq->{'data'}->{'ufac_client_submit_action'}->{'ufac_client'}->{'state'}->{'captcha_persist_data'};
//     if(!isset($persist_data)){
//         echo Message(false,"Lỗi khi lấy catpcha",'','','');
//         $curlVia->Close();
//         return;
//     }
// }else{
//     echo Message(false,"Lỗi khi lấy catpcha",'','','');
//     $curlVia->Close();
//     return;
// }
// // sau đó get để kiếm site-key
// $url="https://www.fbsbx.com/captcha/recaptcha/iframe/?referer=https%3A%2F%2Fwww.facebook.com%2Fcheckpoint%2F1501092823525282%2F$idtkqc%2F&locale=vi_VN&__cci=FQAREhIA.ARYaTnEgqiBVRg9QYlLntYAdQj38AptEqkPM7UhZyY3D7saZ";
// $kq=$curlVia->get($url);
// $sitekey="";
// if(preg_match('/data-sitekey=\"(.*?)\"/',$kq,$key)){
//     $sitekey=$key[1];
// }else{
//     echo Message(false,'Lấy Catpcha thất bại','','','');
//     return;
// }

// // xu ly catpcha sau khi co sitekey
//  $url="https://api.anycaptcha.com/createTask";
//  $clientKey=$_POST["keycatpcha"];
//  $data=array(
//      'clientKey'=>$clientKey,
//      'task'=>array(
//          'type'=>'RecaptchaV2TaskProxyless',
//          'websiteURL'=>"https://www.facebook.com/checkpoint/1501092823525282/$idtkqc/",
//          'websiteKey'=>$sitekey,
//          'isInvisible'=>'true',
//     ),
//  );
//  $kq=$curlVia->PostJson($url,$data);
//  $taskid="";
//  if(strpos($kq,'taskId')!==false){
//     $kq=json_decode($kq);
//     $taskid=$kq->{'taskId'};
//  }else if(preg_match('/errorCode":(.*?)/',$kq,$loi)){
//      echo Message(false,'Lỗi Catpcha:'.$loi[1],'','','');
//      $curlVia->Close();
//      return;
//  }
// // get task result;
// $url="https://api.anycaptcha.com/getTaskResult";
// $data=array(
//     'clientKey'=>$clientKey,
//     'taskId'=>$taskid
// );
// $kq=$curlVia->PostJson($url,$data);
// $temp="errorCode";
// $dem=0;
// $reponsive="";
// while(strpos($kq,$temp)!==false){
//     sleep(5);
//     $dem++;
//     $kq=$curlVia->PostJson($url,$data);
//     if(strpos($kq,'ready')){
//         $kq=json_decode($kq);
//         $reponsive=$kq->{'solution'}->{'gRecaptchaResponse'};

//     }else if(strpos($kq,'errorDescription')){
//         $curlVia->Close();
//         echo Message(false,"Lỗi Giải Catcha =>Out");
//         return ;
//     }else if($dem==8){
//         $curlVia->Close();
//         echo Message(false,"Quá time đợi Catchap=>Chạy lại đi ck iu");
//         return ;
//     }
// }
// // đoạn post đi catpcha sau khi đã giải đc catpcha
// $url="https://www.facebook.com/api/graphql/";
// $variable="{\"input\":{\"client_mutation_id\":\"1\",\"actor_id\":\"$uid\",\"action\":\"SUBMIT_BOT_CAPTCHA_RESPONSE\",\"bot_captcha_persist_data\":\"$persist_data\",\"bot_captcha_response\":\"$reponsive\",\"enrollment_id\":\"$idtkqc\"},\"scale\":1}";
// $data=array(
//     'av'=>$uid, // uid nick
//     '__user'=>'',
//     '__a'=>'',
//     '__dyn'=>'7xeUmwlE7ibwKBWo2vwAxu13w8CewSwMwNw9G2S7o11Ue8hw2nVE4W0om782Cw8G1Qw5MKdwnU2ly87e2l0Fwqo31wnEfo5m1mxe6E7e58jwGzE2swwwNwKwHw8Xwn82Lx-0iS2S3qazo720Bo2Zw',
//     '__csr'=>'gKJIwm89AylhoiJ1Odxh16EScACwEDwp8y7o4-5E2pwqo2FwAwgE0IK0aTw0dNa68',
//     '__req'=>'6',
//     '__hs'=>'19016.HYP:comet_pkg.2.1.0.2.',
//     'dpr'=>'1',
//     '__ccg'=>'MODERATE',
//     '__rev'=>'1004969238',
//     '__s'=>'524nqx:6drox3:4iu289',
//     '__hsi'=>'7056806271952134123-0',
//     '__comet_req'=>'1',
//     'fb_dtsg'=>$fbdtsg,
//     'jazoest'=>'21921',
//     'lsd'=>'2qn12ZNcNS3E0a6_92qdfj',
//     '__spin_r'=>'1004969238',
//     '__spin_b'=>'trunk',
//     '__spin_t'=>'1643040746',
//     'fb_api_caller_class'=>'RelayModern',
//     'fb_api_req_friendly_name'=>'useUFACSubmitActionMutation',
//     'variables'=>'',
//     'server_timestamps'=>'true',
//     'doc_id'=>'4758656487536655',
// );
// $kq=$curlVia->post($url,$data);
// if(strpos($kq,'ADD_NEW_SECURITY_PHONE')!==false){   // ok đến bước nhập sdt , cái này cũng dùng để check nó có ra sdt ko khi vào link mặc định



// }
// // ở mbasic muốn check thì  cứ +84  là ra nhé
// // nếu mà khi vô trang www . có cái này resend_code_button_label là có nghĩa ặc đã  bị bị gửi code 1 lần trc đó mà k đc 


//   // viết trước cái get sdt  và get code bên chothuesimcode.
//   $apiChothuesimcode=$_POST['chothuesimcode'];
//   $url="https://chothuesimcode.com/api?act=number&apik=$apiChothuesimcode&appId=1001";
//   $kq=$curlVia->get($url);
//   $sdt="";
//   $idwait="";
//   if(preg_match('/Number":"([0-9]{4,})/',$kq,$kqsdt)){
//     $sdt=$kqsdt[1];
//     preg_match('/Id":"([0-9]{3,})/',$kq,$kqsdt);
//     $idwait=$kqsdt[1];
//   }
//   // sạu đó nàm jk tự biết nhé
//   //  sau đó đoạn get code
//   $url="https://chothuesimcode.com/api?act=code&apik=$apiChothuesimcode&id=$idwait";
//   $kq=$curlVia->get($url);
//   $code="";
//   if(strpos($kq,'ResponseCode')){
//       $temp=0;
//       while(true){
//         sleep(5);
//         $temp++;
//         if($temp==7){
//             echo Message(false,"Hết time đợi Code Chothuesimcode",'','','');
//             $curlVia->Close();
//             return;
//         }else if(preg_match('/code":"([0-9]{4,})/',$kq,$kqsdt)){
//             $code=$kqsdt[1];
//         }
//       }

//   }else{
//       echo Message(false,"Lấy SDT =>Fail",'','','');
//       $curlVia->Close();
//       return;
//   }


//   /// đây là đoạn điền sdt zô cho fb
// //   0848148170
// $url="https://www.facebook.com/api/graphql/";
// $variable="{\"input\":{\"client_mutation_id\":\"1\",\"actor_id\":\"$uid\",\"action\":\"SET_CONTACT_POINT\",\"contactpoint\":\"$sdt\",\"country_code\":\"VN\",\"enrollment_id\":\"$idtkqc\"},\"scale\":1}";
// $data=array(
//     'av'=>$uid, // uid nick
//     '__user'=>'',
//     '__a'=>'',
//     '__dyn'=>'7xeUmwlE7ibwKBWo2vwAxu13w8CewSwMwNw9G2S0im3y4o0B-q1ew65xO0FE2awt81sbzo5-0Boy1PwBgao6C0Mo5W3S1lwlEjxG1Pxi4UaEW0D888cobEaU2eU5O0HUvw4JwJwSyES1Mw9m0Lo',
//     '__csr'=>'gSBqCVUi9HCG5efxe8AzU-2mexq4E524oG4ErwZyU550gE4a0wUjw9K053E03shw82',
//     '__req'=>'9',
//     '__hs'=>'19017.HYP:comet_pkg.2.1.0.2.',
//     'dpr'=>'1',
//     '__ccg'=>'MODERATE',
//     '__rev'=>'1004971568',
//     '__s'=>'kngz9j:lif7j9:x5t5z1',
//     '__hsi'=>'7056806271952134123-0',
//     '__comet_req'=>'1',
//     'fb_dtsg'=>$fbdtsg,
//     'jazoest'=>'21921',
//     'lsd'=>'Q1l0PYk87w0kLuX3N8E2tr',
//     '__spin_r'=>'1004971568',
//     '__spin_b'=>'trunk',
//     '__spin_t'=>'1643082476',
//     'fb_api_caller_class'=>'RelayModern',
//     'fb_api_req_friendly_name'=>'useUFACSubmitActionMutation',
//     'variables'=>'',
//     'server_timestamps'=>'true',
//     'doc_id'=>'4758656487536655',   

// );
// $kq=$curlVia->post($url,$data);
// ///////////////////
// if(strpos($kq,'resend_code_button_label')!==false || strpos($kq,'UFACSubmitCode')!==false){ // submit code sau khi đã điền sdt vào
//     $url="https://www.facebook.com/api/graphql/";
//     $variable="{\"input\":{\"client_mutation_id\":\"1\",\"actor_id\":\"$uid\",\"action\":\"SUBMIT_CODE\",\"code\":\"$code\",\"enrollment_id\":\"$idtkqc\"},\"scale\":1}";
//     $data=array(
//         'av'=>$uid, // uid nick
//         '__user'=>'',
//         '__a'=>'',
//         '__dyn'=>'7xeUmwlE7ibwKBWo2vwAxu13w8CewSwMwNw9G2S0im3y4o0B-q1ew65xO0FE2awt81sbzo5-0Boy1PwBgao6C0Mo5W3S1lwlEjxG1Pxi4UaEW0D888cobEaU2eU5O0HUvw4JwJwSyES1Mw9m0Lo',
//         '__csr'=>'gSBqCVUi9ACG5efxe8AzU-2mexq4E524oG4ErwZwnE4a12w8e4U2rw1gW00T4o20w',
//         '__req'=>'9',
//         '__hs'=>'19017.HYP:comet_pkg.2.1.0.2.',
//         'dpr'=>'1',
//         '__ccg'=>'GOOD',
//         '__rev'=>'1004971568',
//         '__s'=>'a0olph:y0ypi3:6kdhdw',
//         '__hsi'=>'7056986780595693382-0',
//         '__comet_req'=>'1',
//         'fb_dtsg'=>$fbdtsg,
//         'jazoest'=>'21921',
//         'lsd'=>'8FC5HM5iAiOc7MaUnQRrJs',
//         '__spin_r'=>'1004971568',
//         '__spin_b'=>'trunk',
//         '__spin_t'=>'1643082476',
//         'fb_api_caller_class'=>'RelayModern',
//         'fb_api_req_friendly_name'=>'useUFACSubmitActionMutation',
//         'variables'=>'',
//         'server_timestamps'=>'true',
//         'doc_id'=>'4758656487536655',   
    
//     );
//     $kq=$curlVia->post($url,$data);
//     if(strpos($kq,'UFACImageUploadChallengeState')!==false){   // đây cũng là cách để check ra cái up ảnh lun k

//         // upload file with mbasic.
//         $url="";

//     }else{
//         echo Message(false,"Điền Code Vào Fail=>Out:".$code,'','','');
//         $curlVia->Close();
//         return;
//     }

// }else{
//     echo Message(false,"Mua phải sdt dởm:".$sdt,'','','');
//     $curlVia->Close();
//     return;
// }
?>