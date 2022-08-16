<?php
// require_once 'mycurl.php';
// require_once 'text.php';
// function AddMail($cc,$hotmail,$passhotmail){
//     $uid=$cc->getUid();
//     $fbdtsg=$cc->getFbdtsg();
//     $quicktoken="";
//     $data=array(
//         'cquick_token' => $quicktoken,
//         'cquick' => 'jsc_c_j',
//         'jazoestr' => '',
//         'fb_dtsg' => $fbdtsg,
//         'next' => '',
//         'contactpoint' =>$hotmail,
//         '__user' =>$uid,
//         '__a' => '1',
//         '__dyn' =>'7xeUmBwjbg7ebwKheC1swgE98nwgU6C7UW3q327E2vzobohws83rx60Vo2Vwb-q1ew8y11wbG782Cwn-2y1Qw5MKdwl8G1uz82CwBgK7o884y0i23S0H8bE2swdq1iwmE2ewnE2Lw6OyES',
//         '__csr' => '',
//         '__req' => '8',
//         '__hs' => '7xeUmBwjbg7ebwKheC1swgE98nwgU6C7UW3q327E2vzobohws83rx60Vo2Vwb-q1ew8y11wbG782Cwn-2y1Qw5MKdwl8G1uz82CwBgK7o884y0i23S0H8bE2swdq1iwmE2ewnE2Lw6OyES',
//         'dpr' => '1',
//         '__ccg' => 'GOOD',
//         '__rev' =>'',
//         '__s' => '39b6o3:hktza7:2sbwmu',
//         '__hsi' => '6989234526458712864-0',
//         'lsd' =>'',
//         '__spin_r' => '',
//         '__spin_b' => '',
//         '__spin_t' => ''
      
//     );
//     $url = "https://www.facebook.com/add_contactpoint/dialog/submit/";
//     $ketqua=$cc->post($url,$data);
//     return $ketqua;
//     if(preg_match('/redirectPageTo(.*?true)/',$ketqua)){

//     }else{

//     }

// }
// function LostPhone($cc){
//     $uid=$cc->getUid();
//     $fbdtsg=$cc->getFbdtsg();

//     $quicktoken="";
//     $dataPostnek=array(
//         'cquick_token' => $quicktoken,
//         'ctarget' => 'https://www.facebook.com',
//         'cquick' =>'jsc_c_j',
//         'jazoestr' => '21102',
//         'fb_dtsg' => $fbdtsg,
//         'confirm' => '1',
//         '__user' =>$uid,
//         '__a' => '1',
//         '__dyn' =>'7xeUmBwjbg7ebwKheC1swgE98nwgU6C7UW3q327E2vzobohw5cx60Vo2Vwb-q1ew8y11wbG782Cwn-2y1Qw5MKdwl8G1uz82CwBgK7o884y0i23S0H8bE2swdq1iwmE2ewnE2Lw6OyES',
//         '__csr' => '',
//         '__req' => '7',
//         '__hs' => '18846.PHASED:DEFAULT.2.0.0.0',
//         'dpr' => '1',
//         '__ccg' => 'GOOD',
//         '__rev' =>'',
//         '__s' => 'cpnmcf:j8d6ir:5ws7jh',
//         '__hsi' => '6993627479380004316-0',
//         '__comet_req' => '0',
//         'lsd' =>'',
//         '__spin_r' => '',
//         '__spin_b' => '',
//         '__spin_t' => ''
      
//     );

//     $url="https://www.facebook.com/ajax/settings/mobile/lost_phone.php";
    
//     $referer='https://www.facebook.com/settings?tab=mobile&cquick=jsc_c_j&cquick_token='.$quicktoken.'&ctarget=https://www.facebook.com';
//     $ketqua=$cc->post($url,$dataPostnek);

// }
// function DeleteSdt($cc,$sdt){
//     $url = "https://www.facebook.com/ajax/account_mirror/remove.php";
//     $uid=$cc->getUid();
//     $fbdtsg=$cc->getFbdtg();
//     // $data = "type=phone&phone=%2B" + $sdt + "&src=main_site&__user=" + $uid + "&__a=1&__dyn=7AgNe-4amaUmgDxyHqAyqomzEdoK2a8F4Wodo9ES2N6wAxu13wFw_x-ewPG9zokK7HzE4q3yczobohxi2i6osz8nwvoiyEqx60xUnwho2VwgE7Oq7ooxu1ZgC11x-9w9278-U26yUS4F8eu7Uynxfwzxmfz88U2UG1dxi7EWUS2G3i1uzbxi48y2i17CzEmgK7ohzE4y8w9Cu5E5WEeE4a4Hy8ky8aU-Uqw8y4UeoaE761iwKwHxa1owyxu16waiaxiaw4qxa7o-3qazo8U6m2u1jg&__csr=&__req=w&__hs=18949.BP%3ADEFAULT.2.0.0.0.&dpr=1&__ccg=GOOD&__rev=1004746932&__s=wxcwax%3Alkxqp6%3A51vba8&__hsi=7031735906739484805-0&__comet_req=0&fb_dtsg="+$fbdtsg+"&jazoest="+"211002"+ "&lsd=2ysxLfK0vfAOAwa1gwAd11&__spin_r=1004746932&__spin_b=trunk&__spin_t=1637199994&confirmed=1";

//     $data = "type=phone&phone="+$sdt+"&src=main_site&__user=" + $uid + "&__a=1&__dyn=7AgNe-4amaUmgDxyHqAyqomzEdoK2a8F4Wodo9ES2N6wAxu13wFw_x-ewPG9zokK7HzE4q3yczobohxi2i6osz8nwvoiyEqx60xUnwho2VwgE7Oq7ooxu1ZgC11x-9w9278-U26yUS4F8eu7Uynxfwzxmfz88U2UG1dxi7EWUS2G3i1uzbxi48y2i17CzEmgK7ohzE4y8w9Cu5E5WEeE4a4Hy8ky8aU-Uqw8y4UeoaE761iwKwHxa1owyxu16waiaxiaw4qxa7o-3qazo8U6m2u1jg&__csr=&__req=w&__hs=18949.BP%3ADEFAULT.2.0.0.0.&dpr=1&__ccg=GOOD&__rev=1004746932&__s=wxcwax%3Alkxqp6%3A51vba8&__hsi=7031735906739484805-0&__comet_req=0&fb_dtsg="+$fbdtsg+"&jazoest="+"211002"+ "&lsd=2ysxLfK0vfAOAwa1gwAd11&__spin_r=1004746932&__spin_b=trunk&__spin_t=1637199994&confirmed=1";
//     $ketqua=$cc->post($url,$data);

// }
// function DeleteSdt2($cc,$sdt){
//     $url="https://www.facebook.com/ajax/settings/mobile/delete_phone.php";
//     $uid=$cc->getUid();
//     $fbdtsg=$cc->getFbdtg();
//     $data=array(
//         'phone_number' => '%2B84'.$sdt,
//         'profile_id' => $uid,
//         'shared' => 'false',
//         '__user' =>$uid,
//         '__a' =>'1',
//         '__dyn' => 'dyn=7xu5Fo4OQ1PyUbAjFwn84a2i5U4e1Fx-ewSwMxW0DUS2S4o720SUhwem0Ko2_CwjE28wgo2WxO0FE5-2G1Qw5MKdwl8G1uz82CwOxS2218w4wwZwaO2W0D83mwkE5G0zE5W0HU1IEGdw',
//         '__csr' => '',
//         '__req' =>'2',
//         '__beoa' => '0',
//         '__pc' => 'PHASED%3ADEFAULT',
//         '__hs' => '18759.PHASED%3ADEFAULT.2.0',
//         '__bhv'=>'2',
//         'dpr'=>'1.5',
//         '__ccg'=>'EXCELLENT',
//         '__rev'=>'1003775433',
//         '__s'=>'7bknsk%3Afjfups%3Abuiqi2',
//         '__hsi'=>'6961296131904911978-0',
//         '__comet_req'=>'0',
//         'cquick'=>'jsc_c_c',
//         'cquick_token'=>'AQ6cATYkAGFQkAEGLaA',
//         'ctarget'=>'https%3A%2F%2Fwww.facebook.com',
//         'fb_dtsg'=>$fbdtsg,
//         'jazoest'=>'22836',
//         'lsd'=>'BZQEenGrlEsqCabZRxGEG2',
//         '__spin_r'=>'1003775433',
//         '__spin_b'=>'trunk',
//         '__spin_t'=>'1620803036'
      
//     );
// }
// function GetSdt($cc){
//    $url="https://mbasic.facebook.com/settings/sms/?refid=70";
//    $kq=$cc->get($url);
//     preg_match('/(href=\"/settings/sms/.remove.*?)\"/',$kq,$match);
    
//     if(count($match)>1){
//         $listsdt=array();
//         for ($i =1; $i < count($match); $i++) {
//             preg_match('/phone_number=(.*?&amp)/',$match[$i],$temp);
//             if(isset($temp[1])){
//                 $listsdt[]=$temp[1];
//             }

//         }
       
//        return $listsdt;
//     }else{
//         if(strpos($kq,'notifications.php"')){
//            return " Không còn Sdt";
//         }else{
//            return " Cookies die / Checkpoint";
//         }
//     }
// }
// function CheckEmail($cc,$token,$hotmail){
//     $url="https://graph.facebook.com/me?fields=id,name,friends,address,email,birthday&access_token=".$token;
//     $kq=$cc->get($url);
//     if(preg_match('/data/',$kq)){
//         $kq=json_decode($kq);
//         $listemail = $kq->{'email'};
//         if(count($listemail)>1){

//         }else{

//         }
//     }else{
//         return "Thất bại";
//     }

// }
// function Sdt($cc){

// }
// function GetCodeImap($hotmail,$passmail){
//     $mail = imap_open('{outlook.office365.com:143}',$hotmail,$passmail);
//     $headers = imap_headers ($mail);
//     $last = imap_num_msg ($mail);
//     $header = imap_header ($mail,$last); 
//     // lấy phần nội dung cho cùng một thông báo 
//     $body = imap_body ($mail,$last);
//     // $imap_close($mail);
// }

// function GetCodeImapKhac($cc,$hotmail,$passmail){
//     $url="http://fbvip.org/api/ordercode.php?apiKey=5fbe973ea64a371800be734369a9fdf6&type=1&user=$hotmail&pass=$passmail";
//     $ketqua=$cc->get($url);
//     // "{"success":1,"id":93952,"message":"Order lấy code thành công, code được trả tại http://fbvip.org/api/getcode.php?apiKey=5fbe973ea64a371800be734369a9fdf6&id=93952"}"
//     preg_match('/id":([0-9]{3,})/',$ketqua,$match);
//     if(!isset($match)){
//         return "Sever đọc mail bị lỗi ,thử lại sau";
//     }
//     $id=$match[1];
//     $url="http://fbvip.org/api/getcode.php?apiKey=5fbe973ea64a371800be734369a9fdf6&id=$id";
//     // "http://fbvip.org/api/getcode.php?apiKey=5fbe973ea64a371800be734369a9fdf6&id=94262"
    
//     for ($i = 0; $i < 10; $i++){
//         $getcode=$cc->get($url);
//         if (preg_match('/code":"([0-9]{3,})/',$getcode,$match)) {
//             // "{"success":1,"code":"","sender":"\"Facebook\" <notification@facebookmail.com>","time":1635376649000,"content":"","message":"Không nhận được code"}"
//             // lấy code thành công
//             // preg_match('/(confirmcontact.*?)\r/',$getcode,$ba);
//             // preg_match('/(confirmcontact.*?)\\r/',$getcode,$ba);
//             $getcode=str_replace('\r','999',$getcode);
//             // https://www.facebook.com/
         
//             // preg_match('/(https://www.facebook.com/confirmcontact.*?999)/',$getcode,$hai);
//             preg_match('/(confirmcontact.*?)999/',$getcode,$link);
//             $kq="https://www.facebook.com/".$link[1];
//             return $kq;
//         }else if(strpos($getcode,'error:1')){
//             return "Lỗi đăng nhập Hotmail";
//         }
//         sleep(6);
//     }
//     return "Qua time doi code mail=>Out";
// }

// function ChangePassReview($cc,$passold,$passrd){
//      $uid=$cc->getUid();
//      $fbdtsg=$cc->getFbdtsg();
//      $jazoest = "22070";
//      $variable = "{\"input\":{\"confirm_password\":\"".$passrd."\",\"new_password\":\"".$passrd."\",\"old_password\":\"".$passold."\",\"actor_id\":\"".$uid."\",\"client_mutation_id\":\"1\"}}";
 
//     // kết qả thể này là nhập sai mk cũ
//     $data=array(
//         'av' => $uid,
//         '__user' => $uid,
//         '__a' => '1',
//         '__dyn' =>'7AzHJ16U9ob8ng5K8G6EjBWo2nDwAxu13wsoKbmbwSwAyU8EW3K1uwJyEiwsobo6u3y4o2Gwfi0LVEtwMw65xOfwwwto88422y11xmfz81sbzoaEd82ly87e2l2Utwwwi831wiEjwZxy3O1mzXxG1Pxi4UaEW4UmwkUtxGm2SUnxq5olwUwgpoTxmu3W3y2616DBx_y88E3mwyBwJCwLyESE2KwwwOg2cw',
//         '__csr' => 'gV5scgJ94tgXvexJiiRrrTYDtrcDhaFOPs8lEAJtiXGqACDBQp6AmDQB9XjhTqmp6VrAgKVeRQbumrWLDLKmli2F9iy9VpFFDUzyGBy9WGQfDgGm56FVrgG4UHyoGi26miqucxx5V9GwBDz8gK9AxuUO2XGFbKmA68vwzDxu0xqxK4of8cUOi5EhUaoSewDwLjy8-6ogyrxeu8yEqxi2-m1dxK3y213Fo8ECfyK9xmA58bUpwJBwkAGgW6EhGu18wZwUxe5pfwMy8dpo4vwVyEixG1hyojwg8jAxS6U3hwXwl80QOcg3zyqCw1KB0tE0PBw_w6hw2iE3qU7K07z808EU29xrw2f80mVw4Bw20E5Mw88eU8Esw4dw6Wwt8b8q4Uy0LEtw1dG035q3i06MUc81UE660Uk2wo9gOyk02CUU',
//         '__req' =>'1b',
//         '__hs' =>'18976.HYP%3Acomet_pkg.2.1.0.2.',
//         'dpr' => '1',
//         '__ccg' =>'GOOD',
//         '__rev' => '1004871300',
//         '__s' => 'dh1wog:ryr8rf:iwtozx',
//         '__hsi' => '7041944903394819075-0',
//         '__comet_req' => '1',
//         'fb_dtsg' =>$fbdtsg,
//         'jazoest' =>$jazoest,
//         'lsd' => '8Yf8df_dQzaIzHXxhwE3vM',
//         '__spin_r' => '1004871300-0',
//         '__spin_b' =>'trunk',
//         '__spin_t' => '1639580564',
//         'fb_api_caller_class' => 'RelayModern',
//         'fb_api_req_friendly_name' => 'PrivacyCheckupPasswordChangeMutation',
//         'variables'=>$variable,
//         'server_timestamps'=>'true',
//         'doc_id'=>'2770764399614982',
      
//     );
//     //{ "data":{ "password_change":null},"errors":[{ "message":"A server error field_exception occured. Check server logs for details.","severity":"CRITICAL","code":1604002,"api_error_code":null,"summary":"M\u1eadt kh\u1ea9u c\u0169 kh\u00f4ng \u0111\u00fang","description":"B\u1ea1n \u0111\u00e3 nh\u1eadp sai m\u1eadt kh\u1ea9u c\u0169.","description_raw":"B\u1ea1n \u0111\u00e3 nh\u1eadp sai m\u1eadt kh\u1ea9u c\u0169.","is_silent":false,"is_transient":false,"requires_reauth":false,"allow_user_retry":false,"debug_info":null,"query_path":null,"fbtrace_id":"B/PAcPB7mul","www_request_id":"AckUCrg1ztuAkSu9_bZLfeB","path":["password_change"]}],"extensions":{ "is_final":true} }
//     // ketqua = httpRequest.Post("https://www.facebook.com/api/graphql/", data, type).ToString();
//     $kq=$cc->post('https://www.facebook.com/api/graphql/',$data);
//     if(strpos($kq,'password_change\":null')!==false){
//         return "Đổi Pass Fail:";
//     }else if(strpos($kq,'is_final\":true')!==false){
//         return $passold;
//     }
//     // if (ketqua.Contains("password_change\":null"))
//     // {
//     //     row.Cells["colSTT"].Value = "Đổi Pass Failed =>> Out";
//     //     updateMau(row, 2);
//     // }
//     // else if(ketqua.Contains("is_final\":true"))
//     // {
//     //     row.Cells["colSTT"].Value = "Đổi pass thành công =>>";

//     // }
// }
// $curlVia=new mycurl();
// // peakeroupedigopr@outlook.com|mPZsFI91

// // GetCodeImapKhac($cc,"peakeroupedigopr@outlook.com","mPZsFI91");
// $uid="";
// $pass="";
// $key2fa="";
// $kqlogin =Login2FA($curlVia,$uid,$pass,$key2fa);
//     if(preg_match('/c_user/',$kqlogin)){
        
//     }else{
//        echo  Message(false,"Login uid|pass|2fa fail=>".$kqlogin,'','','');
//        $curlVia->Close();
//        return;
//     }

//   $tokenvia = GetTokenAds($curlVia);
//   $kq = $curlVia->get("https://mbasic.facebook.com/");
//   $email="";
//   $passmail="";
//   $kq=AddMail($curlVia,$email,$passmail);
//   if(preg_match('/redirectPageTo(.*?true)/',$ketqua)){

//     }else{

//     }
//     $link= GetCodeImapKhac($curlVia,$email,$passmail);
//     if(strpos($link,'confirm')){
//         $curlVia->get($link);
//     }else{
//         "Lấy Code Hotmail Fail:"+$link;
//     }
//     $passrd=RandomPassWord();
//     $changepass=ChangePassReview($curlVia,$pass,$passrd);
//     $kqgetsdt=GetSdt($curlVia);
//     if(is_array($kqgetsdt)){
//         for ($i = 0; $i < count($kqgetsdt); $i++) {
//             $sdt=$kqgetsdt[$i];
//             DeleteSdt2($curlVia,$sdt);
//             DeleteSdt($curlVia,$sdt);
           
//         }
        
//     }else{

//     }

    

?>