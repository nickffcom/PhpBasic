<?php
// require 'mycurl.php';
// require_once 'config_tools.php';
// require_once 'xulyproxy.php';

// function getNameUid($cc,$uid){
//     $url="https://www.facebook.com/api/graphql/";
//    $haha="node($uid){name}";
//    $data=array(
//     'q'=>$haha,
// );
//   $kq=$cc->post($url,$data);
//   // echo $kq;
//   if(preg_match('/name\":\"(.*?)\"/',$kq,$match)){
//       return $match[1];
//   }else if(empty($kq)){
//     return "Chặn Quét";
//   }else{
//     return "Lỗi / Uid sai or die";
//   }
  
// }
// function getFollowUid($cc,$uid){
//     $url="https://www.facebook.com/api/graphql/";
//    $haha="node($uid){subscribers{count}}";
//    $data=array(
//     'q'=>$haha,
// );
//   $kq=$cc->post($url,$data);
//   // echo $kq;
//   if(preg_match('/count\":(.*?)}/',$kq,$match)){
//       return $match[1];
//   }else{
//     return "Lỗi / Uid Sai or Die";
//   }
//   // "{"100009530117768":{"subscribers":{"count":0}}}"
// }
// function getFriendUid($cc,$uid){
//     $url="https://www.facebook.com/api/graphql/";
//     $haha="node($uid){friends{count}}";
//     $data=array(
//         'q'=>$haha,
//     );
//     $kq=$cc->post($url,$data);
//     // echo $kq;
//     if(preg_match('/count\":(.*?)}/',$kq,$match)){
//         // if(strpos($match[1],'0')){
//         //     return "Bạn Bè bị ẩn <3";
//         // }
//         return $match[1];
//     }else{
//         return "Lỗi Sever / Uid không chính xác";
//     }
//     // "{"error":{"code":1675001,"api_error_code":null,"summary":"Query Syntax Error","description":"Syntax error.","description_raw":"Syntax error.","is_silent":true,"is_transient":false,"requires_reauth":false,"allow_user_retry":false,"debug_info":"Unexpected \"}\" at character 37: Expected end of string, saw }","query_path":null,"fbtrace_id":"EVxOZ/m2Rr8","www_request_id":"Aw3SLGv9dn0EXo1uoD4uZBQ","sentry_block_user_info":null,"help_center_id":null}}"
//     //"{"100009530117768":{"friends":{"count":0}}}"

// }

// function getCreateUid($cc,$uid){
//     $url="https://www.facebook.com/api/graphql/";
//    $haha="node($uid){created_time}";
//    $data=array(
//     'q'=>$haha,
// );
//   $kq=$cc->post($url,$data);
//   // echo $kq;
//   if(preg_match('/created_time\":(.*?)}/',$kq,$match)){
//       $time= $match[1];
//     //  $date=strtotime($time);
//     $bun= date('d-m-Y',$time);
//     return $bun;
//       // return $kq;
//   }else{
//     return "Lỗi Sever / Uid không chính xác";
//   }
//   // "{"100009530117768":{"created_time":1433852102}}"

// }

// // $cc= new mycurl();
// //   // echo $_POST;
  
// // $uid=(isset($_POST['uid']))?$_POST['uid']:'';
// // $headerhihi = array(
// // 'accept-language:en-US,en;q=0.9',
// // 'accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*;q=0.8,application/signed-exchange;v=b3;q=0.9',
// // 'Content-Type:text/html; charset=utf-8',

// // );
// // $cc->setHeader($headerhihi);
// // // $vv = $cc->get("https://proxyfb.com/api/ListResource.php?username=nickffcom&password=noname2d");
// // // echo $vv;
// // if(empty($uid)){
// //   echo "Ko thấy UID";
// //   return;
// // }
// // $name=getNameUid($cc,$uid);
// // if(strpos($name,"Uid")){
// //   echo $name;
// //   return;
// // }
// // $fl=getFollowUid($cc,$uid);
// // $bb=getFriendUid($cc,$uid);
// // $year=getCreateUid($cc,$uid);
// // $kq="$name- $fl - $bb  - $year";
// // echo $kq;
?>