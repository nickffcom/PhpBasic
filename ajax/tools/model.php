<?php
//   require'mycurl.php';

 function Login2FA($cc,$uid,$pass,$twofa){
    
    $ketqua=$cc->get('https://m.facebook.com/');
    
    //  $ketqua;
    if (preg_match('/name="lsd" value="(.*?)"/', $ketqua, $lsd)) {

        //  $lsd[1];
            if(!isset($lsd[1])){
                return "Lỗi nặng rồi ịt ẹ ày";
                
            }
            preg_match('/name=\"m_ts\" value=\"(\\d+)\"/',$ketqua,$m_ts);
            preg_match('/name=\"li\" value=\"(.*?)\"/',$ketqua,$li);


            $data=array(
                'lsd'=>$lsd[1],
                'jazoest'=>21312,
                'm_ts'=>$m_ts[1],
                'li'=>$li[1],
                'try_number'=>'0',
                'unrecognized_tries'=>'0',
                'email'=>$uid,
                'pass'=>$pass,
                'login'=>'Log+In',
            );
            $url="https://mbasic.facebook.com/login/";    

            $ketqua=$cc->post($url,$data,true);  // login with uid pass
            // $ketqua;
            preg_match('/name=\"fb_dtsg\" value=\"(.*?)\"/',$ketqua,$fbdtsg);
            preg_match('/name=\"nh\" value=\"(.*?)\"/',$ketqua,$nh);
            preg_match('/name=\"jazoest\" value=\"(\\d+)\"/',$ketqua,$jazoest);
            if(!isset($fbdtsg)){
                return ("Lỗi request cmnr");
                
            }else if(!preg_match('/submit[Submit Code]/',$ketqua)){
                return ("Sai pass 90%");
                
            }
            // submit code
            //  $fbdtsg[1];
            $codenek = $cc->getcode2fa($twofa);
            if(!preg_match('/[0-9]{6}/',$codenek)){
                return "Key 2FA sai hoặc web lấy mã sai";
            }
            $urlnew="https://mbasic.facebook.com/login/checkpoint/";
            $data=array(
                'fb_dtsg'=>$fbdtsg[1],
                'jazoest'=>'2980',
                'checkpoint_data'=>'',
                'approvals_code'=>$codenek,
                'codes_submitted'=>'0',
                'submit[Submit Code]'=>'Submit Code',
                'nh'=>$nh[1],
            );

            $ketqua=$cc->post($urlnew,$data,true);// submit code cho fb
            //  $ketqua;
            preg_match('/name=\"fb_dtsg\" value=\"(.*?)\"/',$ketqua,$fbdtsg);
            if(!isset($fbdtsg)||empty($fbdtsg)){
                return ("Submit Code Failed => Cút");
            
            }

            $data=array(
                'fb_dtsg'=>$fbdtsg[1],
                'jazoest'=>$jazoest[1],
                'checkpoint_data'=>'',
                'name_action_selected'=>'save_device',
                'submit[Continue]'=>'Continue',
                'nh'=>$nh[1],
                'fb_dtsg'=>$fbdtsg[1],
                'jazoest'=>$jazoest[1]
            );
            // chuẩn bị ấn Continues sau khi submit code
            $ketqua=$cc->post("https://mbasic.facebook.com/login/checkpoint/?ref=dbl",$data);
            
            preg_match('/xs=(.*[^\\s])/',$ketqua,$xs);
            // GhiFile("ket qua xs $uid",$ketqua."|".$xs[1]);
            // preg_match('/name=\"fb_dtsg\" value=\"(.*?)\"/',$ketqua,$fbdtsg);
            $getcktemp=$cc->getCookies();
            if(strpos($getcktemp,'c_user')&& !strpos($getcktemp,'checkpoint=%')){
                return "Get Success Full".$getcktemp;

            }else if(strlen($xs[1])<15){
                //submit[Continue]
                $data=array(
                    'fb_dtsg'=>$fbdtsg[1],
                    'jazoest'=>$jazoest[1],
                    'checkpoint_data'=>'',
                    'submit[Continue]'=>'Continue',
                    'nh'=>$nh[1],
                    // 'fb_dtsg'=>$fbdtsg[1],
                    // 'jazoest'=>$jazoest[1]
                );
                $ketqua=$cc->post($urlnew,$data);
                //  $ketqua;
                //submit[Continue]
                $data=array(
                    'fb_dtsg'=>$fbdtsg[1],
                    'jazoest'=>$jazoest[1],
                    'checkpoint_data'=>'',
                    'submit[This was me]'=>'This was me',
                    'nh'=>$nh[1],
                    // 'fb_dtsg'=>$fbdtsg[1],
                    // 'jazoest'=>$jazoest[1]
                );
                $ketqua=$cc->post($urlnew,$data);
                //  $ketqua;
                $data=array(
                    'fb_dtsg'=>$fbdtsg[1],
                    'jazoest'=>$jazoest[1],
                    'checkpoint_data'=>'',
                    'name_action_selected'=>'save_device',
                    'submit[Continue]'=>'Continue',
                    'nh'=>$nh[1],
                    // 'fb_dtsg'=>$fbdtsg[1],
                    // 'jazoest'=>$jazoest[1]
                );
                $ketqua=$cc->post($urlnew,$data);
                //  $ketqua;

                $getcktemp=$cc->getCookies();
                $bl =strpos($getcktemp,'checkpoint=%');
                if(strpos($getcktemp,'c_user')&& $bl==false)
                {
                        //  "Get Success Full".$getcktemp;
                        return "Get Success Full". $getcktemp;
                }else{
                    //  $getcktemp . "Nhu cuk";
                    return "Login ặc Fail: Ăc die/ Sai Key 2FA,Lỗi k Xác định...Thử lại sau";
                }

            }else{
                //  $getcktemp;
                return $getcktemp." Login k xác định/Lỗi Khác";
            }

    }else{
        return "Lỗi Get Data =>> Vui lòng chạy lại";
    }
    
     
}
function OutTkqc($cc,$idtkqc,$uidmuonxoa,$token){
    $url="https://graph.facebook.com/v11.0/act_".$idtkqc."/users?uid=".$uidmuonxoa."&access_token=".$token."&format=json&method=delete";
    $kq=$cc->get($url);
    return $kq;
    
}
 function GetTokenAds($cc)
 {
    //  $kq=$cc->get("https://business.facebook.com/content_management");
    //  preg_match('/(EAAG.*?)\"/', $kq, $match);


    $kq=$cc->get("https://www.facebook.com/ads/manager/accounts");
    // GhiFile("CheckToken",$kq);
    preg_match('/act=([0-9]{7,})/',$kq,$idnek);
    $idtkc=$idnek[1];
    $kq=$cc->get("https://www.facebook.com/adsmanager/manage/campaigns?act=$idtkc&nav_entry_point=lep_233&nav_source=unknown");
    preg_match('/accessToken=\"(.*?)\"/',$kq,$haha);


    
     return $haha[1];
 }
   
function SendKetBan($cc,$uid,$token,$guid){
    $url="https://graph.facebook.com/graphql";

    $variable="{\"0\":{\"source\":\"friend_browser\",\"people_you_may_know_location\":\"friends_center\",\"friend_requestee_ids\":[\"".
        $uid.
        "\"],\"client_mutation_id\":\"".
        $guid.
        "\",\"actor_id\":\"".
        $uid.
        "\"}}";
    $data=array(
        'doc_id'=>'1577255185642828',
        'locale'=>'vi_VN',
        'pretty'=>'false',
        'format'=>'save_device',
        'variables'=>$variable,
        'fb_api_req_friendly_name'=>'FriendRequestSendCoreMutation',
        'fb_api_caller_class'=>'graphservice',
        'fb_api_analytics_tags'=>"[\"GraphServices\"]",
        'access_token'=>$token
    );
    // $cc->setHeader($headernek);
    $kq=$cc->post($url,$data);
    //  $kq;
    return $kq;
    // if(preg_match('/friend_request_send/',$kq)){
    //     return "OK";
    // }else{
        
    //     return "False ".$kq;
    // }

}
function AcceptKetBan($cc,$uid,$token){
    $url="https://graph.facebook.com/graphql?method=post&locale=vi_VN&pretty=false&format=json&fb_api_req_friendly_name=CometReshareStoryCreateMutation&fb_api_caller_class=RelayModern&doc_id=4048767518583552&server_timestamps=true&variables={%22input%22:{%22friend_requester_id%22:%22".$uid ."%22,%22source%22:%22/profile.php%22,%22actor_id%22:%22%22,%22client_mutation_id%22:%222%22},%22scale%22:1.5,%22refresh_num%22:0}&access_token=".$token;
    $headernek= array('accept-language:en-US,en;q=0.9',
            'accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'OAuth:'.$token
        );
    
    $cc->setHeader($headernek);
    $kq=$cc->get($url);
    //  $kq;
    return $kq;
    //"{"error":{"code":1,"message":"Please reduce the amount of data you're asking for, then retry your request"}}"
    // if(preg_match('/ARE_FRIENDS/',$kq)){
    //     return "OK";
    // }else if(preg_match('/friend_request_accept\":null/',$kq,$match))
    // {
    //     return "Chưa gửi kết bạn / Có lỗi";
    // }else{
    //     return "Chấp Nhận Kb Lỗi=>>Cút";
    // }
    // "{"data":{"friend_request_accept":{"friend_requester":{"id":"100049537040954","friendship_status":"ARE_FRIENDS","profile_action":{"__typename":"ProfileActionFriendRequest","__isProfileAction":"ProfileActionFriendRequest","icon_image":{"height":24,"scale":1.5,"uri":"https:\/\/static.xx.fbcdn.net\/rsrc.php\/v3\/ye\/r\/c9BbXR9AzI1.png","width":24},"id":"cHJvZmlsZV9hY3Rpb24xMDAwNDk1MzcwNDA5NTQ6MTo6","title":{"text":"B\u1ea1n b\u00e8"},"is_active":true}},"viewer":{"side_feed":{"nodes":[{"__typename":"PagesSideFeedUnit","is_collapsed":false,"page_panel":{"page_id":"103155168334620","icon":"https:\/\/scontent.fsgn2-5.fna.fbcdn.net\/v\/t1.6435-1\/cp0\/p50x50\/129598792_103158691667601_7309522692575319030_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=dbb9e7&_nc_ohc=EdsDwgbqUaoAX-te4Ik&_nc_ht=scontent.fsgn2-5.fna&oh=00_AT8Tn992RO-3nDRgRWbZ21OIE9FAJ0oy6hVmZ1G-QBuu1g&oe=61F3012C","should_use_bizweb":false,"max_notice_count":20,"name":"Shopvugamer .com  B\u00e1n \u1eb6c Free Fire Gi\u00e1 R\u1ebb \/ C\u00f3 thu mua \u1eb7c, n\u1ea1p k"


}
function getIdAds($cc,$token){ // lấy id Ads đầu tiên
    $url="https://graph.facebook.com/v10.0/me/adaccounts?fields=account_id,account_status&access_token=".$token;
    $kq=$cc->get($url);
    if(strpos($kq,'id')!==false){
        $kq=json_decode($kq);
        $data=$kq->{'data'};
        $idads=null;
        foreach($data as $item){
            $idads=$item->{'account_id'};
        }
        return $idads;
        // preg_match_all('/account_id\": \"([0-9]{4,})/',$kq,$match);
        // $count = count($match); 
        // return $match[$count-1][$count-1];

    }else{
        return null;
    }
    preg_match('/act_([0-9]{7,})\"/',$kq,$match);
    return $match[1];

}
function ShareTkqc($cc,$idtkqc,$uidshare,$token,$role){ // share tkqc clone sang via
    // $url="https://graph.facebook.com/v10.0/me/adaccounts?fields=account_id,account_status&access_token=".$token;
    // $kq=$cc->get($url);
    //  $kq;
    // if(preg_match('/act_([0-9]{7,})\"/',$kq,$match)){
      //role admin  281423141961500    nhà qc trên tkqc 461336843905730
        $urlshare="https://graph.facebook.com/v10.0/act_".$idtkqc."/users?_reqName=adaccount%2Fusers&access_token=".$token."&method=post";
        $data=array(
            '_reqName'=>'adaccount/users',
            '_reqSrc'=>'AdsPermissionDialogController',
            'account_id'=>$idtkqc,
            'locale'=>'en_GB',
            'uid'=>$uidshare,
            'suppress_http_code'=>'1',
            'method'=>'post',
            '_sessionID'=>'',
            'pretty'=>'0',
            'role'=>$role
        );
        $kq=$cc->post($urlshare,$data);
     //    $kq;
        return $kq;
        // if(preg_match('/success\":true"/',$kq)){
        //     return "Share tkqc:".$idshare." thành công";
        // }else{
        //     preg_match('/error_user_msg\":\"(.*?)\"/',$kq,$loinek);
        //     return "Share Failed: ".$loinek[1];
        // }
    // }else{
    //     return "Lỗi/Ko tìm thấy id tkqc: ".$kq;
    // }
    // "{"error":{"message":"This user can\u2019t be added as an admin of this ad account. This may be because you lack permissions or the user you selected may not be authorized. Try managing people and ad accounts in Business Manager instead.","type":"FacebookApiException","code":2702,"error_subcode":2016121,"is_transient":false,"error_user_title":"Can't add admin","error_user_msg":"This user can't be added as an admin of this ad account. This may be because you lack permissions, or the user you've selected may not be authorised.Try managing people and ad accounts in Business Manager instead.","error_user_title_html":{"__html":"Can&#039;t add admin"},"error_user_msg_html":{"__html":"This user can't be added as an admin of this ad account. This may be because you lack permissions, or the user you've selected may not be authorised.\u003Cbr \/>\u003Ca target='_blank' href=\"https:\/\/www.facebook.com\/business\/help\/325571851329683?id=2190812977867143 \">Try managing people and ad accounts in Business Manager instead"
        

}
function RegPage2($cc,$uid,$token,$tenReg,$guid){
    //  
    
    // $variable="%7B%22input%22:%7B%22publish%22:true,%22name%22:%22".$tenReg."%22,%22ref%22:%22pages_tab_launch_point%22,%22client_mutation_id%22:%22$guid%22,%22category%22:%22187133811318958%22,%22actor_id%22:%22$uid%22%7D%7D";
    // $haha=array(
    //     'doc_id'=>'951633108271817',
    //     'method'=>'post',
    //     'locale'=>'vi_VN',
    //     'pretty'=>'false',
    //     'format'=>'json',
    //     'variables'=>$variable,
    //     'access_token'=>$token,
    // );  
    // $bun=http_build_query($haha);
    // $haha = http_build_query($haha);
     $url="https://graph.facebook.com/graphql?doc_id=951633108271817&method=post&locale=vi_VN&pretty=false&format=json&variables=%7B%22input%22:%7B%22publish%22:true,%22name%22:%22".$tenReg."%22,%22ref%22:%22pages_tab_launch_point%22,%22client_mutation_id%22:%22$guid%22,%22category%22:%22187133811318958%22,%22actor_id%22:%22$uid%22%7D%7D&access_token=".$token;
    // $url="https://graph.facebook.com/graphql";
    $kq=$cc->get($url);
    // $kq=$cc->post($url,$haha);
    return $kq;
}
function RegPageKhac($cc,$token,$tenReg){
    $uid=$cc->getUid();
    //                                                      
    $variable="{\"input\":{\"categories\":[\"180164648685982\"],\"description\":\"\",\"name\":\"$tenReg\",\"publish\":true,\"ref\":\"unknown\",\"actor_id\":\"$uid\",\"client_mutation_id\":\"1\"}}";
    $url="https://graph.facebook.com/graphql?method=post&locale=vi_VN&pretty=false&format=json&fb_api_req_friendly_name=CometPageCreateMutation&fb_api_caller_class=RelayModern&doc_id=6015849741773814&server_timestamps=true&variables=$variable&access_token=".$token;
    $kq=$cc->get($url);
    return $kq;
    // $kq;
    // {"data":{"page_create":{"error_message":null,"page_name_error":null,"page":{"id":"100894215803238","url":"https:\/\/www.facebook.com\/Smart-Via-Tool-100894215803238\/"}}},"extensions":{"server_metadata":{"request_start_time_ms":1640101401185,"time_at_flush_ms":1640101407717},"is_final":true}}
    // preg_match('/id\":\"(.*?)\"/',$kq,$match);
    // return $match[1];
}
function RegBm($cc,$token,$email,$fname,$flast){
   
    // $url="https://business.facebook.com/business/create_account/?brand_name=Smart%20Via%20Tool%200&first_name=BM&last_name=Smart%20Via%20Tool&email=SmartViaTool0@hotmail.com&timezone_id=1&business_category=OTHER";
    $url="https://business.facebook.com/business/create_account/?brand_name=$flast&first_name=$fname&last_name=$flast&email=$email&timezone_id=1&business_category=OTHER";
    // cái brand_name giống như tên page đã reg ấy, à éo phải nó là tên BM , còn first name kia là ng sở hữu bm tên gì 
    // nó k trả vè gì , nhưng lấy id bm có id bm mới là đc
    $data=array(
        'fb_dtsg'=>$cc->getFbdtsg(),
        'jazoest'=>'22043',
        'lsd'=>'',
    
    );
    $kq=$cc->post($url,$data);
    return $kq;
    

}
function RegBm2($cc,$email,$fname,$lastname){
    $url="https://business.facebook.com/api/graphql/";
    $uid=$cc->getUid();
    $nameBM="Eden".rand(10000,2526234);
    $nameBM="Renekon VLK";
    $variable="{\"input\":{\"client_mutation_id\":\"9\",\"actor_id\":\"$uid\",\"business_name\":\"$nameBM\",\"user_first_name\":\"$fname\",\"user_last_name\":\"$lastname\",\"user_email\":\"$email\",\"creation_source\":\"FBS_BUSINESS_CREATION_FLOW\"}}";
    $data=array(
        'av'=>$uid,
        '__usid'=>'6-Tr3medjewynbl:Pr3med6i6cv1t:0-Ar3medjkivwew-RV=6:F=',
        '__user'=>$uid,
        '__a'=>'1',
        '__dyn'=>'7xeUmBwjbgmwn8K2WnFwn84a2i5U4e1FxebzEdF989Euxa0z8S2S4o14Ue8hwem0nCq1ewcG0KEswaq1xwEwgolzU1vrzo5-1uw_wsU9k2C2218wnE6a1uwZx214wlE-7E28xe3C2G1NwkEbEaU6K2a1uwPwuUvwbW1Kxe6odEGdw46w',
        '__req'=>'t',
        '__hs'=>'18966.BP:bizweb_pkg.2.1.0.0.',
        'dpr'=>'1.5',
        '__ccg'=>'EXCELLENT',
        '__rev'=>'1004812171',
        '__s'=>'wu7sek:i433ej:6cuaqq',
        '__hsi'=>'7038036852110241143-0',
        '__comet_req'=>'0',
        'fb_dtsg'=>$cc->getFbdtsg(),
        'jazoest'=>'22080',
        'lsd'=>'TYSXdzjudDeRQW-AxPr0-o',
        '__spin_r'=>'1004812171',
        '__spin_b'=>'trunk',
        '__spin_t'=>'1638670650',
        '__jssesw'=>'1',
        'fb_api_caller_class'=>'RelayModern',
        'fb_api_req_friendly_name'=>'useBusinessCreationMutationMutation',
        'variables'=>$variable,
        'server_timestamps'=>'true',
        'doc_id'=>'5402509349824310',
    );
    $kq=$cc->post($url,$data);
    return $kq;
    // {"data":{"bizkit_create_business":{"id":"252992780246864"}},"extensions":{"is_final":true}}
    // trả về thế là ok 
}
function AddQTVBm($cc,$idbm,$token,$toEmail){ // gui loi moi BM dên email
    $url="https://graph.facebook.com/v12.0/".$idbm."/business_users?method=post&email=".$toEmail."&role=ADMIN&access_token=".$token;
    $kq=$cc->get($url);
    return $kq;
     
    // neu ket qua dung , no se tra ve {"id":"301073951936548"} la id cua bm do

}
function LayLinkMoi($cc,$token,$idbm){
    $url="https://graph.facebook.com/v11.0/$idbm/pending_users?access_token=".$token;
    $kq=$cc->get($url);
    // data trả vè
    // {"data":[{"id":"301073951936548","role":"ADMIN","email":"smart_via_tool_0smartviatool0\u0040hotmail.com","invite_link":"https:\/\/fb.me\/1Jgz7GZcb4Vh0C5","status":"PENDING"}],"paging":{"cursors":{"before":"QVFIUklBT040TDRxalV5ZAEJ3R0phSU1Ia3FDTmRfWFk5OGJ3Y2VvQkplY1hMRU40UGlMX2o0WGNER0hMVEUwM05qdUF0MGc4aUViSjVkWGJPSi12R0hiU3VR","after":"QVFIUklBT040TDRxalV5ZAEJ3R0phSU1Ia3FDTmRfWFk5OGJ3Y2VvQkplY1hMRU40UGlMX2o0WGNER0hMVEUwM05qdUF0MGc4aUViSjVkWGJPSi12R0hiU3VR"}}}
 
    return $kq;
    // phải check xem nó có chữ data ko ,có là lỗi token request nhều qus thô
}

function GetIdBm($cc,$token){
    $url="https://graph.facebook.com/v12.0/me?fields=businesses{id}&access_token=".$token;
    // nó truyền uid vào chỗ uid kia ,met that
    // ket qua tra ve nhu sau
    // {"businesses":{"data":[{"id":"301073871936556"}],"paging":{"cursors":{"before":"QVFIUnpRNWZAfMjVoZAXR4ZAzJTV1JxVnlYUE01TVJKVTEyU2RSN0FBblFRWDdobXd4czUxRUhnLXhwTDV1ZAFZAGbmxidjB0ZA0FEX1QtZAUZAua3pfcktrblJKUzdR","after":"QVFIUnpRNWZAfMjVoZAXR4ZAzJTV1JxVnlYUE01TVJKVTEyU2RSN0FBblFRWDdobXd4czUxRUhnLXhwTDV1ZAFZAGbmxidjB0ZA0FEX1QtZAUZAua3pfcktrblJKUzdR"}}},"id":"100049537040954"}
    $kq=$cc->get($url);
    $kq=json_decode($kq);
    $id="Không lấy được Id Bm";
    $haha=$kq->{'businesses'}->{'data'};
    $count=count($haha)-1;
    $hazzz=$haha[$count];
    $id=$hazzz->{'id'};
    return $id;
    // if($count>=2){
    //     $id=$haha[2];
    //     return $id;
    // }else if($count>=1){
    //     $id=$haha[1];
    //     return $id;
    // }
    // "{
    //     "businesses": {
    //        "data": [
    //           {
    //              "id": "346181763537315"
    //           },
    //           {
    //              "id": "301073871936556"
    //           }
    //        ],
    //        "paging": {
    //           "cursors": {
    //              "before": "QVFIUkNOa2FOZAXpJTmRRQ19xS0c0a3lvcDFMVDdvN1BwelpjREtoMHZAobGhxYTlTUmNjWmg2Y3RrZA2hoR25fQTMxUGpLSVJIYmJjOUlGZA2RicEhTdXkwdF9B",
    //              "after": "QVFIUnpRNWZAfMjVoZAXR4ZAzJTV1JxVnlYUE01TVJKVTEyU2RSN0FBblFRWDdobXd4czUxRUhnLXhwTDV1ZAFZAGbmxidjB0ZA0FEX1QtZAUZAua3pfcktrblJKUzdR"
    //           }
    //        }
    //     },
    //     "id": "100049537040954"
    //  }"

}
function RegPage($cc,$tenpage,$token){
    $headernek= array('accept-language' => "en-US,en;q=0.9",
    'accept' => "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*;q=0.8,application/signed-exchange;v=b3;q=0.9",
    'X-FB-Connection-Type'=>'unknown',
    'X-FB-Net-HNI'=>'45204',
    'OAuth'=>$token,
);
    $uid="100005087827549";
    $guid="8ec085c4-60cf-11ec-9e17-30d16b41236e";
    $client="00000000-0000-0000-0000-000000000000";
    $variable="{\"input\":{\"session_id\":\"$uid$guid\",\"page_name\":\"$tenpage\",\"client_mutation_id\":\"$client\",\"actor_id\":\"$uid\"}}";
    $data=array(
        'doc_id'=>'2504124279678666',
        'method'=>'post',
        'locale'=>'en_GB',
        'pretty'=>'false',
        'format'=>'json',
        'variables'=>$variable,
        'fb_api_req_friendly_name'=>'CreatePageCreationDraftEntryMutation',
        'fb_api_caller_class'=>'graphservice',
        'fb_api_analytics_tags'=>'%5B%22GraphServices%22%2C%22nav_attribution_id%3D%7B%5C%220%5C%22%3A%7B%5C%22bookmark_id%5C%22%3A%5C%22250100865708545%5C%22%2C%5C%22session%5C%22%3A%5C%2298244%5C%22%2C%5C%22subsession%5C%22%3A1%2C%5C%22timestamp%5C%22%3A%5C%221609941048.280%5C%22%2C%5C%22tap_point%5C%22%3A%5C%22tap_bookmark%5C%22%2C%5C%22most_recent_tap_point%5C%22%3A%5C%22tap_bookmark%5C%22%2C%5C%22bookmark_type_name%5C%22%3A%5C%22Application%5C%22%2C%5C%22fallback%5C%22%3Afalse%2C%5C%22badging%5C%22%3A%7B%5C%22badge_count%5C%22%3A0%2C%5C%22badge_type%5C%22%3A%5C%22num%5C%22%7D%2C%5C%22extras%5C%22%3A%7B%5C%22surface_type%5C%22%3A%5C%22plazaSurface%5C%22%7D%7D%2C%5C%221%5C%22%3A%7B%5C%22bookmark_id%5C%22%3A%5C%22281710865595635%5C%22%2C%5C%22session%5C%22%3A%5C%2239956%5C%22%2C%5C%22subsession%5C%22%3A1%2C%5C%22timestamp%5C%22%3A%5C%221609941045.69%5C%22%2C%5C%22tap_point%5C%22%3A%5C%22tap_top_jewel_bar%5C%22%2C%5C%22most_recent_tap_point%5C%22%3A%5C%22tap_top_jewel_bar%5C%22%2C%5C%22bookmark_type_name%5C%22%3Anull%2C%5C%22fallback%5C%22%3Afalse%2C%5C%22badging%5C%22%3A%7B%5C%22badge_count%5C%22%3A0%2C%5C%22badge_type%5C%22%3A%5C%22num%5C%22%7D%7D%7D%22%2C%22visitation_id%3D250100865708545%3A98244%3A1%3A1609941048.280%7C281710865595635%3A39956%3A1%3A1609941045.69%22%5D',
        'server_timestamps'=>'true'
    );
    $url= "https://graph.facebook.com/graphql";
    // $cc->setHeader($headernek);
    // $kq =$cc->post($url,$data);
    $data=http_build_query($data);
    // $kq;
    $variable="{\"input\":{\"categories\":[\"2201\"]}}";
    $data=array(
        'doc_id'=>'2519475768139256',
        'method'=>'post',
        'locale'=>'en_GB',
        'pretty'=>'false',
        'format'=>'json',
        'variables'=>$variable,
        'fb_api_req_friendly_name'=>'PageAddressWebsiteCheck',
        'fb_api_caller_class'=>'graphservice',
        'fb_api_analytics_tags'=>'%5B%22GraphServices%22%5D',
        'server_timestamps'=>'true'
    );
    // $kq =$cc->post($url,$data);
    $data=http_build_query($data);
    //  $kq;
    // tiếp tục
    $variable="{\"input\":{\"session_id\":\"$uid$client\",\"client_mutation_id\":\"$client\",\"categories\":[\"2201\"],\"actor_id\":\"$uid\"}}";
    $data=array(
        'doc_id'=>'2506455862771172',
        'method'=>'post',
        'locale'=>'en_GB',
        'pretty'=>'false',
        'format'=>'json',
        'variables'=>$variable,
        'fb_api_req_friendly_name'=>'PageCreationNewPage',
        'fb_api_caller_class'=>'graphservice',
        'fb_api_analytics_tags'=>'%5B%22GraphServices%22%2C%22nav_attribution_id%3D%7B%5C%220%5C%22%3A%7B%5C%22bookmark_id%5C%22%3A%5C%22250100865708545%5C%22%2C%5C%22session%5C%22%3A%5C%2298244%5C%22%2C%5C%22subsession%5C%22%3A1%2C%5C%22timestamp%5C%22%3A%5C%221609941048.280%5C%22%2C%5C%22tap_point%5C%22%3A%5C%22tap_bookmark%5C%22%2C%5C%22most_recent_tap_point%5C%22%3A%5C%22tap_bookmark%5C%22%2C%5C%22bookmark_type_name%5C%22%3A%5C%22Application%5C%22%2C%5C%22fallback%5C%22%3Afalse%2C%5C%22badging%5C%22%3A%7B%5C%22badge_count%5C%22%3A0%2C%5C%22badge_type%5C%22%3A%5C%22num%5C%22%7D%2C%5C%22extras%5C%22%3A%7B%5C%22surface_type%5C%22%3A%5C%22plazaSurface%5C%22%7D%7D%2C%5C%221%5C%22%3A%7B%5C%22bookmark_id%5C%22%3A%5C%22281710865595635%5C%22%2C%5C%22session%5C%22%3A%5C%2239956%5C%22%2C%5C%22subsession%5C%22%3A1%2C%5C%22timestamp%5C%22%3A%5C%221609941045.69%5C%22%2C%5C%22tap_point%5C%22%3A%5C%22tap_top_jewel_bar%5C%22%2C%5C%22most_recent_tap_point%5C%22%3A%5C%22tap_top_jewel_bar%5C%22%2C%5C%22bookmark_type_name%5C%22%3Anull%2C%5C%22fallback%5C%22%3Afalse%2C%5C%22badging%5C%22%3A%7B%5C%22badge_count%5C%22%3A0%2C%5C%22badge_type%5C%22%3A%5C%22num%5C%22%7D%7D%7D%22%2C%22visitation_id%3D250100865708545%3A98244%3A1%3A1609941048.280%7C281710865595635%3A39956%3A1%3A1609941045.69%22%5D',
        'server_timestamps'=>'true'
    );
    // $kq =$cc->post($url,$data);
    //  $kq;
    $data=http_build_query($data);
     // cuối cùng
     $variable="{\"input\":{\"publish\":true,\"name\":\"$tenpage\",\"ref\":\"pages_tab_launch_point\",\"client_mutation_id\":\"$client\",\"categories\":[\"2201\"],\"actor_id\":\"100005087827549\"}}";
     $data=array(
         'doc_id'=>'951633108271817',
         'method'=>'post',
         'locale'=>'en_GB',
         'pretty'=>'false',
         'format'=>'json',
         'variables'=>$variable,
         'fb_api_req_friendly_name'=>'PageCreationNewPage',
         'fb_api_caller_class'=>'graphservice',
         'fb_api_analytics_tags'=>'%5B%22GraphServices%22%2C%22nav_attribution_id%3D%7B%5C%220%5C%22%3A%7B%5C%22bookmark_id%5C%22%3A%5C%22250100865708545%5C%22%2C%5C%22session%5C%22%3A%5C%2298244%5C%22%2C%5C%22subsession%5C%22%3A1%2C%5C%22timestamp%5C%22%3A%5C%221609941048.280%5C%22%2C%5C%22tap_point%5C%22%3A%5C%22tap_bookmark%5C%22%2C%5C%22most_recent_tap_point%5C%22%3A%5C%22tap_bookmark%5C%22%2C%5C%22bookmark_type_name%5C%22%3A%5C%22Application%5C%22%2C%5C%22fallback%5C%22%3Afalse%2C%5C%22badging%5C%22%3A%7B%5C%22badge_count%5C%22%3A0%2C%5C%22badge_type%5C%22%3A%5C%22num%5C%22%7D%2C%5C%22extras%5C%22%3A%7B%5C%22surface_type%5C%22%3A%5C%22plazaSurface%5C%22%7D%7D%2C%5C%221%5C%22%3A%7B%5C%22bookmark_id%5C%22%3A%5C%22281710865595635%5C%22%2C%5C%22session%5C%22%3A%5C%2239956%5C%22%2C%5C%22subsession%5C%22%3A1%2C%5C%22timestamp%5C%22%3A%5C%221609941045.69%5C%22%2C%5C%22tap_point%5C%22%3A%5C%22tap_top_jewel_bar%5C%22%2C%5C%22most_recent_tap_point%5C%22%3A%5C%22tap_top_jewel_bar%5C%22%2C%5C%22bookmark_type_name%5C%22%3Anull%2C%5C%22fallback%5C%22%3Afalse%2C%5C%22badging%5C%22%3A%7B%5C%22badge_count%5C%22%3A0%2C%5C%22badge_type%5C%22%3A%5C%22num%5C%22%7D%7D%7D%22%2C%22visitation_id%3D250100865708545%3A98244%3A1%3A1609941048.280%7C281710865595635%3A39956%3A1%3A1609941045.69%22%5D',
         'server_timestamps'=>'true'
     );
    //  $kq =$cc->post($url,$data);
    //   $kq;
    $data=http_build_query($data);
    //  if(preg_match('/page_create/',$kq,$match)){
    //          "Reg Page Success";
    //  }else{
    //       "Reg Failed:";
    //  }

}
function CheckInfoUsingCookies($cc)
{   
     $uid=$cc->getUid();
     $urlcheck = "https://www.facebook.com/".$uid."/about?section=contact-info";
    $kq=$cc->get($urlcheck);
    //  $kq;
    
    preg_match('/displayable_count\":([0-9]{1,}),\"name/',$kq,$banbe);
    preg_match('/inline_style\":\"BOLD(.*?)ranges\":...\"color_ranges\":...\"text\":\"(.{2,5} |[0-9]{1,})/',$kq,$bb);
    preg_match('/text\":\"(.{2,30})\".,\"field_type\":\"birthday/',$kq,$ngaysinh);
    $ngaysinh[1]=str_replace('th\u00e1ng','',$ngaysinh[1]);
    preg_match('/ranges\":...\"color_ranges\":...\"text\":\"([0-9]{1,2}[0-9]{1,})\"/',$kq,$namsinh);
    $info="Bạn: ".$banbe[1]." ".$bb[2]." Birthday:".$ngaysinh[1]." ".$namsinh[1];


    $urlnamtao="https://www.facebook.com/your_information/?tab=your_information&title=personal_info_grouping";
    $kq=$cc->get($urlnamtao);
    //  $kq;
    preg_match('/metadata\":\"(.*?)([0-9]{4})\",\"icon_name\":\"friends-chrome/',$kq,$namtao);
    $thongtin=$info." Năm tạo:".$namtao[2];
    return $thongtin;

}
function CheckFullAds($cc,$token,$trave=false){
    
    $dkmdungcopyurlcuataohuhuhu = "https://graph.facebook.com/v11.0/me/adaccounts?fields=business,account_status,id,currency,amount_spent,balance,name,timezone_name,min_billing_threshold,adtrust_dsl,spend_cap,account_id,active_asl_schedule&summary=total_count&access_token=".$token;
    $kq=$cc->get($dkmdungcopyurlcuataohuhuhu);
    // $myfile = fopen("file.txt", "w");
    // fwrite($myfile, $kq);
    // $myfile = fopen("fileEncode.txt", "w");
    // fwrite($myfile, $kq);

    $text='';
    if($trave){
        if(preg_match('/data/',$kq)){
            if(preg_match('/id/',$kq)){
                $kq=json_decode($kq);
                $haha=$kq->{'data'};
        
                foreach($haha as $info){
                    $id=$info->{'account_id'};
                    $stt=$info->{'account_status'};
                    if($stt==1){
                        $stt="Live Ads";
                    }else if($stt==2){
                        $stt="Die rồi";
                    }
                    
                    $currency=$info->{'currency'};
                    $amount_spent=$info->{'amount_spent'};
                    $balance=$info->{'balance'};
                    // $timezone_name=$info->{'timezone_name'};
                    $amount=$info->{'min_billing_threshold'}->{'amount'};
                    $adtrust_dsl=$info->{'adtrust_dsl'};
                    if($stt==1){
                        $adtrust_dsl="NoLimit";
                    }else if($stt<0){
                        $adtrust_dsl="Nolimit";
                    }
                    
                    // $text = $text ."Id: ".$id . ": Limit ".$adtrust_dsl. " ". $stt . " " . $currency . " Tiêu: " .$amount_spent ." Số Dư: " .$balance . " " . " Ngưỡng: " .$amount . " " . "\n";
                    $text = $text."Limit ".$adtrust_dsl." ".$currency. " ". $stt .  " Tiêu: " .$amount_spent ." Số Dư: " .$balance . " " . " Ngưỡng: " .$amount . " Id: ".$id . "\n";
                 
                }
                return $text;
            }else{
                return "error:Ặc Oke nhưng => bị fb chặn token";
            }
        }else{
            return "error:Lỗi->>"+$kq;
        }
      
    
    }else{
        return $kq;
    }
  

}

function ChangeInfoAdsToken($cc,$idtkqc,$token,$muigio,$tiente){
    // timezone id - múi giờ +7 là 140
    // timezone_id":140,"timezone_name":"Asia\/Ho_Chi_Minh","timezone_offset_hours_utc":7,"users":{"da
    //  Asia/Ho_Chi_Minh  cái này chuẩn nè
    // hình như muốn đổi country thì k đc  country_code= VN
    
    // https://developers.facebook.com/docs/marketing-api/currencies
    $muigio=(int)$muigio;
    if($muigio==0   &&strlen($tiente)>1){
        $url="https://graph.facebook.com/v11.0/act_".$idtkqc."?currency=".$tiente."&access_token=".$token;
    }else if(strpos($tiente,'0')!==false  &&strlen($muigio)>1){
        $url="https://graph.facebook.com/v11.0/act_".$idtkqc."?timezone_id=".$muigio."&access_token=".$token;
    }else{
        $url="https://graph.facebook.com/v11.0/act_".$idtkqc."?currency=".$tiente."&timezone_id=".$muigio."&access_token=".$token;
    }

    // $url="https://graph.facebook.com/v11.0/act_".$idtkqc."?currency=".$tiente."&timezone_id=".$muigio."&access_token=".$token;
    $kq=$cc->get($url);
    return $kq;
    // "{
//    "account_id": "235170584425436",
//    "id": "act_235170584425436"
// }"
    // if(preg_match('/success/',$kq)){
    //     return "Success";
    // }else{
    //     return "Failed: ".$kq;
    // }
   
}
function ChangeInfoAdsCk($cc,$idtkqc,$tiente=null,$muigio=null){ // cái này dùng để kích momo
    $url="https://www.facebook.com/api/graphql/";
    // $refer = "https://www.facebook.com/ads/manager/account_settings/account_billing/?act=".$idtkqc."&pid=p2&page=account_settings&tab=account_billing_settings";
    $uid=$cc->getUid();
    $fbdtsg=$cc->getFbdtsg();
    $countrycode="VN";
    // if(isset($tiente)||isset($muigio)){
        $temp=array(
            140=>'ASIA/HO_CHI_MINH' ,
            132=>'ASIA/BANGKOK',
            128=>'ASIA/SINGAPORE',
            95=>'ASIA/KUALA_LUMPUR',
            94=>'AMERICA/MEXICO_CITY',
            77=>'ASIA/TOKYO',
            74=>'EUROPE/ROME',
            58=>'EUROPE/LONDON',
            47=>'EUROPE/BERLIN',
            8=>'ASIA/DUBAI',
            6=>'AMERICA/CHICAGO',
            2=>'AMERICA/DENVER',
            7=>'AMERICA/NEW_YORK',
            57=>'EUROPE/PARIS',
            134=>'EUROPE/ISTANBUL',
            135=>'AMERICA/PORT_OF_SPAIN',
            116=>'EUROPE/MOSCOW',
            110=>'EUROPE/LISBON',
            55=>'EUROPE/MADRID',
            62=>'ASIA/HONG_KONG',
            66=>'ASIA/JAKARTA',
            79=>'_ASIA/SEOUL',
            98=>'EUROPE/AMSTERDAM',
            102=>'AMERICA/PANAMA',
        );
        $muigio=(int)$muigio;
        if($muigio==0   &&strlen($tiente)>1){
            $variable="{\"input\":{\"billable_account_payment_legacy_account_id\":\"$idtkqc\",\"currency\":\"$tiente\",\"logging_data\":{\"logging_counter\":11,\"logging_id\":\"2801534104\"},\"tax\":{\"business_address\":{\"city\":\"\",\"country_code\":\"$countrycode\",\"state\":\"\",\"street1\":\"\",\"street2\":\"\",\"zip\":\"\"},\"business_name\":\"\",\"is_personal_use\":false,\"tax_id\":\"\",\"eu_vat_tax_country\":\"$countrycode\"},\"timezone\":null,\"actor_id\":\"$uid\",\"client_mutation_id\":\"2\"}}";
        }else{

            if(strpos($tiente,'0')!==false  &&strlen($muigio)>1){
                $variable="{\"input\":{\"billable_account_payment_legacy_account_id\":\"$idtkqc\",\"currency\":null,\"logging_data\":{\"logging_counter\":22,\"logging_id\":\"2801534104\"},\"tax\":{\"business_address\":{\"city\":\"\",\"country_code\":\"$countrycode\",\"state\":\"\",\"street1\":\"\",\"street2\":\"\",\"zip\":\"\"},\"business_name\":\"\",\"is_personal_use\":false,\"tax_id\":\"\",\"eu_vat_tax_country\":\"\"},\"timezone\":\"Asia/Tokyo\",\"actor_id\":\"$uid\",\"client_mutation_id\":\"4\"}}";
             }else{
                 $variable="{\"input\":{\"billable_account_payment_legacy_account_id\":\"".$idtkqc."\",\"currency\":\"$tiente\",\"logging_data\":{\"logging_counter\":39,\"logging_id\":\"3753885442\"},\"tax\":{\"business_address\":{\"city\":\"\",\"country_code\":\"$countrycode\",\"state\":\"\",\"street1\":\"\",\"street2\":\"\",\"zip\":\"\"},\"business_name\":\"\",\"is_personal_use\":false},\"timezone\":$muigio,\"actor_id\":\"".$uid."\",\"client_mutation_id\":\"6\"}}";
             }

        }
    


   
    $data=array(
        'av'=>$uid,
        '__usid'=>'6-Tr5mqdy1pfcdmd:Pr5mqhb5ggso9:0-Ar5mqdy17pkrsd-RV=6:F=',
        '__user'=>$uid,
        '__a'=>'1',
        '__dyn'=>'7xeUmBz8aolJ28S2q3m9U8EJ4WqwOwCwgEpyA4WCG6UmCyEgwNxK4UKQ9wPGiidBxa7GzUK3G4Wxa6US2SfUgS4Ugwxxicx21FxG9y8Gdz8hwt8aEcEixWq4omyU9EmwwCwXxKaCwTxqWBBwLjzu33hoC4U8RVodoKUryoiAwu8sgiCgOUa8lwWxecAwXx-8g425udz8C2S12xu7o6-cwgHAhUuyUaoG2a3Fe8x2Utwgum2B0AgK7lzEW2e2i3mbxOfwkE5WUrorx2awCx5e8wxK2efxW4U4S7VEjCx6220D98bU-dwKwHxa3u225EK5Ue8Sp1G2G4UOcwzzUkGdxSaBwKG3qcy85i4oKqbDVUOEbVEHyU',
        '__csr'=>'',
        '__req'=>'1',
        '__hs'=>'19005.BP:ads_campaign_manager_pkg.2.0.0.0.',
        'dpr'=>'1',
        '__ccg'=>'EXCELLENT',
        '__rev'=>'1004935891',
        '__s'=>'mc6oon:30n8sl:rogzco',
        '__hsi'=>'7052532078134974994-0',
        '__comet_req'=>'0',
        'fb_dtsg'=>$fbdtsg,
        'jazoest'=>'21949',
        'lsd'=>'DkDElTyEch7qmzZWub6zXq',
        '__spin_r'=>'1004892060',
        '__spin_b'=>'trunk',
        '__spin_t'=>'1004892060',
        '__spin_b'=>'1640096861',
        'fb_api_caller_class'=>'RelayModern',
        'fb_api_req_friendly_name'=>'BillingAccountInformationUtilsUpdateAccountMutation',
        'variables'=>$variable,
        'server_timestamps'=>'true',
        'doc_id'=>'4699960830024588',

    );
    $kq=$cc->post($url,$data);
     return $kq;
    //  "{"data":{"billable_account_update":null},"errors":[{"message":"A server error field_exception occured. Check server logs for details.","severity":"CRITICAL","code":1675030,"api_error_code":-1,"summary":"Query error","description":"Error performing query.","description_raw":"Error performing query.","is_silent":false,"is_transient":false,"requires_reauth":false,"allow_user_retry":false,"debug_info":null,"query_path":null,"fbtrace_id":"GgLyEI9gHUT","www_request_id":"AUMu0fE4JjGc-VGwS8sLWpu","path":["billable_account_update"]}],"extensions":{"is_final":true}}"
    // if(preg_match('/title\":\"MoMo Wallet\",/',$kq)||preg_match('/momo_wallet_checkout_api_vn/',$kq)||strpos($kq,'momo')){
    //     return "Kích Momo Success";
      
    // }else if(preg_match('/is_personal\":false/',$kq)){
    //     return "Kích Failed";
    // }else if(preg_match('/summary\":\"(.*?)\"/',$kq,$match)){
    //     return "Lỗi nè:".$match[1];
    // }else{
    //     return "K Xác Định";
    // }
}
function CreateTKQCNew($cc,$idtkqc,$tiente,$muigio){
    $url="https://www.facebook.com/api/graphql/";
    // $refer = "https://www.facebook.com/ads/manager/account_settings/account_billing/?act=".$idtkqc."&pid=p2&page=account_settings&tab=account_billing_settings";
    $uid=$cc->getUid();
    $fbdtsg=$cc->getFbdtsg();

    // $variable="{\"input\":{\"current_payment_legacy_account_id\":\"$idtkqc\",\"logging_data\":{\"logging_counter\":17,\"logging_id\":\"331642291\"},\"new_country_code\":\"VN\",\"new_currency_code\":\"EUR\",\"new_tax\":{\"business_address\":{\"city\":\"\",\"country_code\":\"VN\",\"state\":\"\",\"street1\":\"\",\"street2\":\"\",\"zip\":\"\"},\"business_name\":\"\",\"is_personal_use\":false},\"new_timezone\":\"America/Denver\",\"actor_id\":\"$uid\",\"client_mutation_id\":\"2\"}}";

    // preg_match('/countryCode:"(.*?)\"/',$kq,$country);
    $variable="{\"input\":{\"current_payment_legacy_account_id\":\"$idtkqc\",\"logging_data\":{\"logging_counter\":17,\"logging_id\":\"331642291\"},\"new_country_code\":\"VN\",\"new_currency_code\":\"EUR\",\"new_tax\":{\"business_address\":{\"city\":\"\",\"country_code\":\"VN\",\"state\":\"\",\"street1\":\"\",\"street2\":\"\",\"zip\":\"\"},\"business_name\":\"\",\"is_personal_use\":false},\"new_timezone\":\"America/Denver\",\"actor_id\":\"$uid\",\"client_mutation_id\":\"2\"}}";
    $muigio=(int)$muigio;
    if($muigio==0   &&strlen($tiente)>1){
          
    }else if(strpos($tiente,'0')!==false  &&strlen($muigio)>1){
           
    }

   
    $data=array(
        'av'=>$uid,
        '__usid'=>'6-Tr5lvbqc8ga1w:Pr5lvbc1d5zmbm:0-Ar5lvbqkf3qsp-RV=6:F=',
        '__user'=>$uid,
        '__a'=>'1',
        '__dyn'=>'7xeUmBz8aolJ28S2q3m9U8EJ4Wqxu6E9E4a6oF1eFGxK5FEG48corxebJ2ocWAAzpoixWE-bwWxeEixKdwJz-4dxe484e486C6EC8yEScx611wOwGwOxa7FEhwywCxq22q3K6UGq3u5HGmm2ZedUcd5yojwznBwRyXxK9xai1UxO4VAcK2y5oeEjx63K2y11xnzoO9ws8nxS1Lz84aVpUuyUd88EeAUy4bxS11Voak2h2UtggzE8U98doK78-3K5E5WUrorx2awCx5e8wxK2efxW4U4S7VEjCx6220D98bU-dwKwHxa1LyUnwUzpA6EfEO32fxiFVotyFobGwSz8y1kx6bCyVUCcG2-qaUK2e0UE7e',
        '__csr'=>'',
        '__req'=>'1',
        '__hs'=>'19004.BP:ads_campaign_manager_pkg.2.0.0.0.',
        'dpr'=>'1',
        '__ccg'=>'MODERATE',
        '__rev'=>'1004933245',
        '__s'=>'7vmjll:zaufrz:8uazlo',
        '__hsi'=>'7052358596931492477-0',
        '__comet_req'=>'0',
        'fb_dtsg'=>$fbdtsg,
        'jazoest'=>'21949',
        'lsd'=>'l--EAtowp90MLjAwNxPuQN',
        '__spin_r'=>'1004892060',
        '__spin_b'=>'trunk',
        '__spin_t'=>'1004892060',
        '__spin_b'=>'1640096861',
        'fb_api_caller_class'=>'RelayModern',
        'fb_api_req_friendly_name'=>'BillingAccountInformationUtilsCreateAccountMutation',
        'variables'=>$variable,
        'server_timestamps'=>'true',
        'doc_id'=>'4649659218451741',

    );
    $kq=$cc->post($url,$data);
    return $kq;
    // {"data":{"new_billable_account_from_old":{"new_account":{"__typename":"AdAccount","__isBillableAccount":"AdAccount","agency_client_declaration":null,"billable_account_tax_info":{"__typename":"AdAccountBusinessInfo","business_name":"","is_personal":false,"second_tax_id":null,"second_tax_id_type_enum":null,"tax_exempt":false,"tax_id":"","tax_id_type_enum":"NONE","intl_address":{"building":"","city":"","postal_code":"","region":"","street":"","single_line_full_address":""},"can_update_tax_country":true,"business_country_code":"VN","predicated_business_country_code":"VN"},"can_create_new_billable_account_from_old":true,"can_update_currency_timezone":false,"currency":"EUR","timezone_info":{"timezone":"America/Denver"},"billing_payment_account":{"__typename":"AdsPaymentAccountRawDoNotUse","payment_legacy_account_id":"299766065534150","billing_payment_method_options":[{"__typename":"AdAccountNewCreditCardOption","credential_type":"CREDIT_CARD","card_types":["VISA","MASTERCARD","AMERICANEXPRESS"],"id":null},{"__typename":"AdAccountNewPaypalOption","credential_type":"PAYPAL_BA","id":null},{"__typename":"AdAccountNewTokenOption","credential_type":"FB_TOKEN","id":null}],"id":"299766065534150"},"billing_flags":["MISSING_PAYMENT_METHOD"],"id":"23849556095920220"}}},"extensions":{"is_final":true}}

}
function PheduyetBM($cc,$idtkqc,$idbm){
      // chấp nhận share idtkc vào bm
    //   $url="https://www.facebook.com/ajax/ads/manage/adaccountownership.php";
      $url="https://www.facebook.com/api/graphql/";
      $uid=$cc->getUid();
      $url="https://m.facebook.com/composer/ocelot/async_loader/?publisher=feed";
      $kq=$cc->get($url);
      $cookiestam=$cc->getCookies();
      $kq=str_replace("\\","",$kq);
      preg_match('/name=\"fb_dtsg\" value=\"(.*?)\"/',$kq,$haha);
      $fbdtsg=$haha[1];
    //   GhiFile('publisher',$kq);
    // //   preg_match('/expire\\":([0-9]{5,})/',$kq,$temp);
      preg_match('/dtsg_ag\":{\"token\":\"(.*?)\"/',$kq,$match);
      if(strlen($fbdtsg)<5){
          return "Cookies die mất rồi";
      }
  
    $url="https://www.facebook.com/ads/manager/agency_permission_requests_getter/?ad_account_id=".$idtkqc;
    $data=array(
        '__user'=>$uid,
        '__a'=>'1',
        '__dyn'=>'7xeUmBz8aolJ28S2q3m9U8EJ4Wqxu6E9E4a6oF1eFGxK5FEG48corxebJ2ocWAAzpoixWE-bwWxeEixKdwJz-4dxe488o8ogwqoqyoyazoO4o463a2G3a4EuCx62a2q5E89EeUryFEdUmKFpobQUTwMQm9xe2dum3mbK6UC4F87y744FAcK2y5oeEjx63K2y11xnzoO9ws8nxS1Lz84aVpUuyUd88EeAUy4bxS11DwFg94bxR12ewzwAwRyUszUeUmwnHxJxK48G2q4kUy26U8U-7EjwjovCxeq4o882sAwLzUS2W2K4E6-bxu3ydCgqw-z8c8-5aDBxSaBwKG3qcy85i4oKqbDyoOEbVEHyU8U3ywsU',
        '__csr'=>'',
        '__req'=>'h',
        '__hs'=>'19004.BP:ads_campaign_manager_pkg.2.0.0.0.',
        'dpr'=>'1',
        '__ccg'=>'EXCELLENT',
        '__rev'=>'1004933012',
        '__s'=>'z3spcq:zaufrz:l2qz6t',
        '__hsi'=>'7052238804959457775-0',
        '__comet_req'=>'0',
        'fb_dtsg'=>$fbdtsg,
        'jazoest'=>'22083',
        'lsd'=>'Z2jegk3Ry7ugriGhkTTyYR',
        '__spin_r'=>'1004932968',
        '__spin_b'=>'trunk',
        '__spin_t'=>'1641972634',

    );

    $kq=$cc->post($url,$data);
    preg_match('/ad_market_id=([0-9]{6,})/',$kq,$marketid);
    $fbdtsg=$match[1];

    $url="https://www.facebook.com/adaccount/agency/accept_reject_dialog/?ad_market_id=".$marketid[1]."&agency_id=".$idbm."&fb_dtsg_ag=".$fbdtsg."&__user=".$uid."&__a=1&__dyn=7xeUmBz8aolJ28S2q3m9U8EJ4Wqxu6E9E4a6oF1eFGxK5FEG48corxebJ2ocWAAzpoixWE-bwWxeEixKdwJz-4dxe488o8ogwqoqyoyazoO4o463a2G3a4EuCx62a2q5E89EeUryFEdUmKFpobQUTwMQm9xe2dum3mbK6UC4F87y744FAcK2y5oeEjx63K2y11xnzoO9ws8nxS1Lz84aVpUuyUd88EeAUy4bxS11DwFg94bxR12ewzwAwRyUszUeUmwnHxJxK48G2q4kUy26U8U-7EjwjovCxeq4o882sAwLzUS2W2K4E6-bxu3ydCgqw-z8c8-5aDBxSaBwKG3qcy85i4oKqbDyoOEbVEHyU8U3ywsU&__csr=&__req=j&__hs=19004.BP%3Aads_campaign_manager_pkg.2.0.0.0.&dpr=1&__ccg=EXCELLENT&__rev=1004933158&__s=9g78r1%3A3wrnv2%3Ae82n7c&__hsi=7052324231679413450-0&__comet_req=0&jazoest=24798&__spin_r=1004933158&__spin_b=trunk&__spin_t=1641997190";
    $cc->setCookies($cookiestam);
    $kq=$cc->get($url);
    preg_match('/ext=([0-9]{4,})/',$kq,$haizz);
    $ext=$haizz[1];
    preg_match('/hash=(.*?)\\"/',$kq,$haizz);
    $hash=$haizz[1];
    $hash=str_replace("\\","",$hash);
    $url="https://www.facebook.com/adaccount/agency/request/accept_reject/?ad_market_id=".$marketid[1]."&agency_id=".$idbm."&operation=0&ext=".$ext."&hash=".$hash."&fb_dtsg_ag=".$fbdtsg."&__user=".$uid."&__a=1&__dyn=7xeUmBz8aolJ28S2q3m9U8EJ4Wqxu6E9E4a6oF1eFGxK5FEG48corxebJ2ocWAAzpoixWE-bwWxeEixKdwJz-4dxe488o8ogwqoqyoyazoO4o463a2G3a4EuCx62a2q5E89EeUryFEdUmKFpobQUTwMQm9xe2dum3mbK6UC4F87y744FAcK2y5oeEjx63K2y11xnzoO9ws8nxS1Lz84aVpUuyUd88EeAUy4bxS11DwFg94bxR12ewzwAwRyUszUeUmwnHxJxK48G2q4kUy26U8U-7EjwjovCxeq4o882sAwLzUS2W2K4E6-bxu3ydCgqw-z8c8-5aDBxSaBwKG3qcy85i4oKqbDyoOEbVEHyU8U3ywsU&__csr=&__req=o&__hs=19004.BP%3Aads_campaign_manager_pkg.2.0.0.0.&dpr=1&__ccg=GOOD&__rev=1004933245&__s=fu68df%3Azaufrz%3Ahyg1er&__hsi=7052328754096893658-0&__comet_req=0&jazoest=24813&__spin_r=1004933245&__spin_b=trunk&__spin_t=1641998243";
    // $kq=$cc->post('https://www.facebook.com/adaccount/agency/request/accept_reject/',$data);
    $kq=$cc->get($url);
    return $kq;

}
function TaoTKQCBM($cc,$bmid,$tiente,$muigio,$token,$namemuondat){
    $url="https://graph.facebook.com/v12.0/$bmid/adaccount?access_token=".$token;
    $haha="647337082965242";
    $data=array(
        'name'=>$namemuondat,
        'currency'=>$tiente,
        'timezone_id'=>$muigio,
        'end_advertiser'=>$haha,
        'media_agency'=>'NONE',
        'partner'=>'NONE',
    );
    $kq=$cc->post($url,$data);
    return $kq;
    if(preg_match('/act/',$kq)){
        "reg thành công";
    }else{
        // bắt message nó đi
    }
}
function LoiMoiAcceptTkqc($cc,$bmid,$idtkqc,$token){
    $url="https://graph.facebook.com/v11.0/".$bmid."/client_ad_accounts?access_token=".$token;
    $data=array(
        '_reqName'=>'object:brand/client_ad_accounts',
        '_reqSrc'=>'AdAccountActions.brands',
        'access_type'=>'AGENCY',
        'adaccount_id'=>'act_'.$idtkqc,
        'locale'=>'en_GB',
        'method'=>'post',
        'permitted_roles'=>'[]',
        'permitted_tasks'=>'["ADVERTISE","ANALYZE","DRAFT","MANAGE"]',
        'pretty'=>'0',
        'suppress_http_code'=>'1',
        'xref'=>'fde3193a3f6654',


    );
    $kq=$cc->post($url,$data);
    return $kq;
    // if(preg_match('/access_status/',$kq)){

    // }else if(preg_match('/message(.*?)$/',$kq)){

    // }else{

    // }
    // check message đi , có đó


}
function Yeucauthemtkqcbm($cc,$token,$idtkqc,$bmid){


    $url="https://graph.facebook.com/v11.0/".$bmid."/owned_ad_accounts";
    $data=array(
        'access_token'=>$token,
        'adaccount_id'=>'act_'.$idtkqc

    );
    $kq=$cc->post($url,$data);
    return $kq;
    if(strpos($kq,'error')!==false && preg_match('/message\": \"(.*?)\"/',$kq,$loinek)){
        if(preg_match('/accepted/',$kq)){
            return "Ok";
        }else{
            return "Lỗi:"+$loinek[1];
        }
        
    }else if(preg_match('/access_status/',$kq)){
        preg_match('/access_status\":(.*?)\"/',$kq,$stt);
    }else if(strpos($kq,'CONFIRMED')!==false){
        return "Rồi";
    }else{
        return " K xác định";
    }
    //  $kq;

}
function ReNameAds($cc,$idtkqc,$token,$tenmuondoi){
    if(!empty($tenmuondoi)){
        $thoigian=date("d/m/Y/s");
        $url="https://graph.facebook.com/v11.0/act_".$idtkqc."?name=".$tenmuondoi." ".$thoigian."&access_token=".$token;
        $kq=$cc->get($url);
        return $kq;
        // if(preg_match('/success/',$kq)){
        //     return "Đổi tên Success <3";
        // }else{
        //     return "Đổi tên Failed: ".$kq;
        // }
    }
}
function CheckHcqc($cc){
    $uid=$cc->getUid();
    $url="https://www.facebook.com/accountquality/" . $uid . "/?source=link";
   
    $fbdtsg=$cc->getFbdtsg();
    // $jazoest=$cc->getJazoest();
    $variable="{\"assetOwnerId\":\"$uid\",\"startTime\":1633478400,\"locationPageID\":null}";
    $data=array(
        'av'=>$uid,
        'session_id'=>'5ad7054dcceac55f',
        '__user'=>$uid,
        '__a'=>'1',
        '__dyn'=>'7xeUmBz8aolJ28S1syU8EKnFG5UqwCwgE98nCwRCwqojyUW3eF8iBxa7GzU4q5EvzES2SfUg-2i13x21FxG9xedz8hwgo5qq3a4EuCx62a2q5E9UeUryE5mWBBwQzocEiwTgfUK2C0A8swEK2y1gwwAwXxV28465udz8C1MwamcwgHBDxWbwQwywWjxCUtwHxmu2C2l0Fx6ewi8doa88Ea8mwnHx-6ogyE9EiK8wio-7EjwjovCxeq4qxS0D8d8-dwKwHxa3u3ubxu3ydCgqw-z8c8-5azoa9obGwSz8y1kx6bCyVUCfwLCyKbwzwqE7u',
        '__csr'=>'',
        '__req'=>'1',
        '__hs'=>'18936.BP:DEFAULT.2.0.0.0.',
        'dpr'=>'1',
        '__ccg'=>'EXCELLENT',
        '__rev'=>'1004890123',
        '__s'=>'ybejrm:6u6w8n:527ehh',
        '__hsi'=>'7043687279784414268-0',
        '__comet_req'=>'0',
        'fb_dtsg'=>$fbdtsg,
        'jazoest'=>'21968',
        'lsd'=>'qb1NLxAghlNRW4MM0ySLjg',
        '__spin_r'=>'1004890103',
        '__spin_b'=>'"trunk"',
        '__spin_t'=>'1639986243',
        'fb_api_caller_class'=>'RelayModern',
        'fb_api_req_friendly_name'=>'AccountQualityHubAssetOwnerViewQuery',
        'variables'=>$variable,
        'server_timestamps'=>'true',
        'doc_id'=>'4328688837186150',
    );
    $kq=$cc->post("https://www.facebook.com/api/graphql/",$data);
    //  $kq;
    $check=$uid."advertising_restriction_info\":{\"is_restricted\":true";
    if(!strpos($kq,$uid)){
        return "Lỗi Request=> Thất bại";
    }
    if(strpos($kq,$check)){
        preg_match('/restriction_date\":\"(.*?)\",/',$kq,$match);
        return "Bị HCQC ngày: ".$match[1];
    }else if(strpos($kq,'NOT_RESTRICTED')){
        return "Bẩm báo đại vương : Live Ads";
    }else if(strpos($kq,'APPEAL_PENDING')){
        return "Đang Review Ads......";
    }else if(strpos($kq,'APPEAL_REJECTED_NO_RETRY')){
        return "Ckia buồn cùng sốp : Cấm QC vĩnh viễn..";
    }else if(strpos($kq,'APPEAL_ACCEPTED')){
        return "Tiền về =>> Có tích xanh...";
    }
    else if(strpos($kq,'AuthenticityVerificationRestrictionProviderAdditionalParameters')){
        return "Hạn chế quảng cáo dạng mới :=>>";
    }
    else{
        if(strpos($kq,'is_restricted\":true')){
            return "HCQC 100%";
        }else{
            return "Không xác định :(";
        }
    }
}

function  IsNullOrEmpty($question)
{
    return (!isset($question) || @trim($question)==='');
}
function GhiFile($tenfile,$noidung){
    $myfile = fopen("$tenfile.txt", "w");
    fwrite($myfile, $noidung);
    fclose($myfile);
}
// $cc = new mycurl();
// $cc->setCookies("sb=Ok5BYf0GZHZGYo4bRGtltmZA; datr=fXNMYWeHH2fp6O9PsVoyaZXT; _fbp=fb.1.1633357167830.1005713205; c_user=100009530117768; dpr=1.100000023841858; presence=EDvF3EtimeF1641019824EuserFA21B09530117768A2EstateFDutF0CEchF_7bCC; usida=eyJ2ZXIiOjEsImlkIjoiQXI1MHRsYzFlenA4ODEiLCJ0aW1lIjoxNjQxMDIzMTg0fQ%3D%3D; cppo=1; xs=9%3A8wScfVyGZ730zQ%3A2%3A1639711483%3A-1%3A6304%3A%3AAcW3lnJ1CHguJQPzJXPWw8OzjQw3EbBiuJeIKfmEqdZV; fr=0xovDyx9NOwzkFfd2.AWXinFAZ_dtGZ9F56lrVyoiw3j8.Bh0AbQ.qP.AAA.0.0.Bh0AbQ.AWXe8-68VRA; spin=r.1004900152_b.trunk_t.1641023294_s.1_v.2_; wd=1705x430");
// $cc->setCookies("datr=CinQYe3nXcaASqbznZh-fz9a; sb=CinQYdFX7YBFAhdpe21Qwn1c; m_pixel_ratio=1; locale=en_GB; fr=03nyTLgnoPPaLhDky.AWXsoVcIHu0wLGn55k994BAAXJ0.Bh0CkK.k6.AAA.0.0.Bh0CkU.AWWYb65sAPo; c_user=100035410980805; xs=29%3Af7aWcincEtvbyw%3A2%3A1641031958%3A-1%3A6309; presence=EDvF3EtimeF1641031982EuserFA21B35410980805A2EstateFDutF0CEchF_7bCC; spin=r.1004900166_b.trunk_t.1641032067_s.1_v.2_; wd=1920x565");
// $ahah= PheduyetBM($cc,'893163431223121','301073871936556');
// $token="EAAGNO4a7r2wBACz7BuTqF81uBcFab2GuTbU7FJtjDkNdh1SuOchbtlZBKbv0s3Kcyr8EU3EMCn2I0hrOjClvSq5UGcNTPqZCzdhrrZBJC34xPly7lZBkWaEL7VzTUflL2OsjLi7xWEZB4zZCOXhaagJZCPkLRnNL7HuasNb2iUJ47ap6NNDGnaRZCYUiBh715goZD";
// $kq=Yeucauthemtkqcbm($cc,$token,'893163431223121','301073871936556');
// $cc->setCookies("datr=ddLBYbScO9LziEV74mgkNBEB;sb=ddLBYQyxSh_X_57fRnX_HFsI;m_pixel_ratio=1;locale=en_GB;fr=0yMIWWvz8TBkPeGYe.AWUAqII0ymkWzV1Dkr38iFRmIbI.BhwdJ1._2.AAA.0.0.BhwdKA.AWWMG8kZjgc;c_user=100049537040954;xs=11%3AS1kL8TkPs-CnbA%3A2%3A1640092290%3A-1%3A6378;spin=r.1004892011_b.trunk_t.1640092601_s.1_v.2_;usida=eyJ2ZXIiOjEsImlkIjoiQXI0aDNuOTFrb2VuMmciLCJ0aW1lIjoxNjQwMTA0Njk5fQ%3D%3D;");
//  $hihi=Login2FA($cc,'100012715843416',"noname2d","2MKUMIBRKMUJ5LDTCMUR6SSFRYLXDPOA");
//  $hihi=Login2FA($cc,'100049537040954',"soc4hn4","F2WPDPWUH33FGCULUCJGZXBF3ZGMDV6S");
//  $kk=$cc->getCookies();
// ChangeInfoAdsCk($cc,"590560048708278");
// $id=getIdAds($cc);
// $pp = $cc->CheckProxy('123.16.47.39:3128');
// $khok=CheckInfoUsingCookies($cc);
// $token=GetTokenAds($cc);
// $cc->LayFbdtsg();
// $hihi=RegBm($cc,$token,"cuboy99x@gmail.com","Blue","Smile");
// $bb=GetIdBm($cc,$token);
// $cc=LayLinkMoi($cc,$token,'2136127799858892');
// $hcqc=CheckHcqc($cc);
// $vv=ChangeInfoAds($cc,$id,$token,"VND", )
// $token="EAAGNO4a7r2wBAI6BR5HrkFmcZA4uwozbucQSTu07knJh0bNIGXtZB20AQcFPcG15gpFZA3ULb4s4PdFYZBuHDoOTZAxkRp4w06tutScJzB9Ufb64QSmLGSeW3VS30BH4oQw8g6mgANdqL9DNJUZAcCrt6cypXePJdvyMECjNP8hm5OEJ9LxQFZBpglrqWaLia8ZD";
//  $vv=CheckFullAds($cc,$token);
// // $tem=AcceptKetBan($cc,"100009530117768",$haha);
// $kk=ShareTkqc($cc,"100009530117768",$haha,"281423141961500");
// RegPage($cc,"Hài vc","Đây là token");
$vv="";
?>