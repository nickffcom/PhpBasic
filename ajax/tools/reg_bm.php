<?php
// require_once 'config_tools.php';
// error_reporting(0);
require_once 'xulyproxy.php';
require_once 'mycurl.php';
require_once 'model.php';
require_once 'msg.php';
require_once 'text.php';
// $tokenvia=isset($_POST['tokenvia'])?trim($_POST['tokenvia']):exit;
// $idbm=isset($_POST['idbm'])?trim($_POST['idbm']):'';
// $tokenclone=isset($_POST['tokenclone'])?trim($_POST['tokenclone']):'';
//của clone
$uid=isset($_POST['uid'])?trim($_POST['uid']):null;
$proxy=isset($_POST['proxy'])?$_POST['proxy']:null;  // cái này là chỉ share
$cookies=isset($_POST['cookies'])?$_POST['cookies']:null;
$tmproxy=isset($_POST['tmproxy'])?$_POST['tmproxy']:'';
// $hotmail=isset($_POST['minproxy'])?$_POST['minproxy']:'';
$tiente=isset($_POST['tiente'])?$_POST['tiente']:'';
$muigio=isset($_POST['muigio'])?$_POST['muigio']:'';
$guid=isset($_POST['guid'])?$_POST['guid']:null;

// echo Message(false,"Tính năng này is comming soon");
// return;
require 'config_proxy.php';
$curlClone= new mycurl($kqproxy,$user_pwd);

$haha=$db->insert('history_tool', array(
    'user' => $me['username'],
    'time_su_dung'=>time(), 
    'description' =>':D',
    'chuc_nang'=>'Reg BM :D'
));
///////////////////////////////////
//////////////////////
    if(!empty($cookies)){

        $curlClone->setCookies($cookies);
        
    }else if(!empty($uid)||isset($_POST['pass'])||isset($_POST['key2fa']) ){
            // $uid=$_POST['uid'];
            $pass=$_POST['pass'];
            $key2fa=$_POST['key2fa'];
            $kqlogin =Login2FA($curlClone,$uid,$pass,$key2fa);
            if(preg_match('/c_user/',$kqlogin)){
                
            }else{
                echo  Message(false,"Login uid|pass|2fa fail=>".$kqlogin,'','','');
                $curlClone->Close();
                return;
            }
        
    }

    $tokenclone =GetTokenAds($curlClone);
    if(IsNullOrEmpty($tokenclone)){
            echo Message(false,"Lấy Token Fail->Cookies Die",'','','');
            $curlClone->Close();
            return;
    }
    $rd=rand(1000,100000);    
    $namereg="HALA%20TK%20".$rd;
    $kqregpage =RegPage2($curlClone,$curlClone->getUid(),$tokenclone,$namereg,$guid);
    // // "{"data":{"page_create":{"page":{"id":"104343615483190"},"error_message":null}},"extensions":{"is_final":true}}"
    $hotmail=generateRandomString(3,8)."@gmail.com";
    $fisrtname=RandomName();
    $lastname=RandomName();
    $kq=RegBm2($curlClone,$hotmail,$fisrtname,$lastname);
      // {"data":{"bizkit_create_business":{"id":"252992780246864"}},"extensions":{"is_final":true}}
    if(preg_match('/\"id\":\"([0-9]{4,})\"/',$kq,$bm1)){
        // "{"data":{"bizkit_create_business":{"id":"972156250396805"}},"extensions":{"is_final":true}}"
    }else{
        if(preg_match('/summary\":\"(.*?)\"/',$kq,$loi)){
            echo Message(false,"Reg BM Fail Lỗi:".$loi[1],'','',$curlClone->getCookies());
        }else{
            echo Message(false,"Reg BM thất bại <<<=",'','',$curlClone->getCookies());
        }
        $curlClone->Close();
        return;
    }
    $idbmlan1=$bm1[1];
    // $idbmlan1="972156250396805";
    // $urltemp="https://graph.facebook.com/v11.0/$idbmlan1?access_token=$tokenclone&_reqName=object:brand&_reqSrc=BrandResourceRequests.brands&date_format=U&fields=[%22allow_page_management_in_www%22,%22created_time%22,%22sharing_eligibility_status%22]&locale=vi_VN&method=get&pretty=0&suppress_http_code=1&xref=f3c7b839ecc71d4";
    // $kq=$cc->get($urltemp);
    //trả về
    // {"allow_page_management_in_www":true,"created_time":1642142280,"sharing_eligibility_status":"disabled_due_to_trust_tier","id":"252992780246864"}
    $ketquataotkqc1="Không tạo TKQC";
    $agencybm1="false";
  
    if(strlen($tiente)==3){
        // $urltemp="https://graph.facebook.com/v7.0/$idbmlan1/adaccount?access_token=".$tokenclone;
        $tentkqc="Ads69 Vipro ".rand(15532,326420);
        $muigio=(int)$muigio;
        $kq=TaoTKQCBM($curlClone,$idbmlan1,$tiente,$muigio,$tokenclone,$tentkqc);
        // $kq=TaoTKQCBM($curlClone,$idbmlan2,$tiente,$muigio,$tokenclone,$tentkqc);
        if(preg_match('/act_/',$kq)){
            $ketquataotkqc1="TKQC Success";
        }else{
            $ketquataotkqc1="Tạo FAIL TKQC";
        };
    }else{
        $ketquataotkqc1="Không Tạo TKQC";
    }


    $linkmoilan1="K lấy đc link mời";
    // $url="https://graph.facebook.com/v3.0/$idbmlan1/business_users?access_token=".$tokenclone"?email=$;
    // $kq=$cc->get($url);
    // //  {"id":"252992886913520"
    $randomEmailmoi=generateRandomString(3,6)."@gmail.com";
    $kqqtv=AddQTVBm($curlClone,$idbmlan1,$tokenclone,$randomEmailmoi);    
    preg_match('([0-9]{5,})',$kqqtv,$idmoi);
    // "{
    //     "id": "972171773728586"
    //  }"
   
    // {"data":[{"id":"252992886913520","role":"ADMIN","email":"16409554goodluck63958006\u0040gmail.com","invite_link":"https:\/\/fb.me\/1HUlFycyd0DB9T1","status":"PENDING"}],"paging":{"cursors":{"before":"QVFIUkNsY1c5TTZAoc08ybW9zTnhGM2x6RWRPYlZANUEJtLXJoN1NPYUhlUlhTVS1DbUNseWsyZAmNkNWhtQ0ttcTdfOUd1UzQwX21obHViN0pmYTN1UXZAfZA1FvT3l6RTY3dEF3R005c2FKY0pzbXFyRkExRi10MjRBSTM5aGJJb1d1OHA4","after":"QVFIUkNsY1c5TTZAoc08ybW9zTnhGM2x6RWRPYlZANUEJtLXJoN1NPYUhlUlhTVS1DbUNseWsyZAmNkNWhtQ0ttcTdfOUd1UzQwX21obHViN0pmYTN1UXZAfZA1FvT3l6RTY3dEF3R005c2FKY0pzbXFyRkExRi10MjRBSTM5aGJJb1d1OHA4"}}}
    $kq=LayLinkMoi($curlClone,$tokenclone,$idbmlan1);
    // "{
    //     "data": [
    //        {
    //           "id": "972171773728586",
    //           "role": "ADMIN",
    //           "email": "csz2\u0040gmail.com",
    //           "invite_link": "https://fb.me/2aRGrBLnnLqyMNN",
    //           "status": "PENDING"
    //        }
    //     ],
    //     "paging": {
    //        "cursors": {
    //           "before": "QVFIUlZAlMkp4Qlo5ZAVFEcnAtblVKTVlfV3FOb3hXRERKS0dWOGpXZAlY4OUJxRUZAhaGVaN1Y0ZAzJzbGc4VGtDcXJGTThGRzItODR0RVBMUjZACdVBKQ29IRGR3",
    //           "after": "QVFIUlZAlMkp4Qlo5ZAVFEcnAtblVKTVlfV3FOb3hXRERKS0dWOGpXZAlY4OUJxRUZAhaGVaN1Y0ZAzJzbGc4VGtDcXJGTThGRzItODR0RVBMUjZACdVBKQ29IRGR3"
    //        }
    //     }
    //  }"
    // $idmoi="972171773728586";
    if(strpos($kq,'id')!==false){
        $kq=json_decode($kq);
        $temp=$kq->{'data'};
        $idtcantim=$idmoi[0];
        foreach($temp as $item){
            $id=$item->{'id'};
            if(strpos($id,$idmoi[0])!==false){
                $linkmoilan1=$item->{'invite_link'};
            }
        }
    }else{
        $linkmoilan1="Lấy Link lần 1 Fail";
    }
  
    // $url="https://graph.facebook.com/graphql?method=post&access_token=$tokenclone&variables={\"businessID\":\"$idbmlan1\",\"program\":\"CONVERSION_DATA\"}&doc_id=3781416171970251";
    // $kq=$curlClone->get($url);
    // if(strpos($kq,'marketing_program')){
    //     $agencybm1="AgenCy";
    // }else{
    //     $agencybm1=$kq;
    // }

 /////////////////////////////////////////////////////////////////
    /// reg lần 2
    $agencybm2="false";
    $idbmlan2="";
    $hotmail=generateRandomString(3,6)."@gmail.com";
    $fisrtname=RandomName();
    $lastname=RandomName();
    $kq=RegBm2($curlClone,$hotmail,$fisrtname,$lastname);
    if(preg_match('/\"id\":\"(.*?)\"/',$kq,$bm2)){

    }else{
        echo Message(false,"Reg BM lần 2 =>> Fail:$kq",$idbmlan1."|".$linkmoilan1."|".$ketquataotkqc1,'Reg Fail =>Fb chặn',$curlClone->getCookies());
        $curlClone->Close();
        return;
    }

    $idbmlan2=$bm2[1];
    // $urltemp="https://graph.facebook.com/v11.0/$idbmlan2?access_token=$tokenclone&_reqName=object:brand&_reqSrc=BrandResourceRequests.brands&date_format=U&fields=[%22allow_page_management_in_www%22,%22created_time%22,%22sharing_eligibility_status%22]&locale=vi_VN&method=get&pretty=0&suppress_http_code=1&xref=f3c7b839ecc71d4";
    // $kq=$cc->get($urltemp);
      //trả về
    // {"allow_page_management_in_www":true,"created_time":1642142280,"sharing_eligibility_status":"disabled_due_to_trust_tier","id":"252992780246864"}
    $ketquataotkqc2="";
    $linkmoilan2="";
    if(strlen($tiente)==3){
        // $urltemp="https://graph.facebook.com/v7.0/$idbmlan2/adaccount?access_token=".$tokenclone;
        $tentkqc="Ads69 TOOL ".rand(15532,326420);
        // $muigio=(int)$muigio;
        $kq=TaoTKQCBM($curlClone,$idbmlan2,$tiente,$muigio,$tokenclone,$tentkqc);
        if(preg_match('/act_/',$kq)){
            $ketquataotkqc2="Tạo TKQC Success";
        }else{
            $ketquataotkqc2="Tạo FAIL TKQC";
        };
    }else{
        $ketquataotkqc2="Không Tạo TKQC";
    }
    $randomEmailmoi=generateRandomString(3,7)."@gmail.com";
    $kqqtv=AddQTVBm($curlClone,$idbmlan2,$tokenclone,$randomEmailmoi);    
    preg_match('([0-9]{5,})',$kqqtv,$idmoi);
    $kq=LayLinkMoi($curlClone,$tokenclone,$idbmlan2);
    if(strpos($kq,'id')!==false){
        $kq=json_decode($kq);
        $temp=$kq->{'data'};
        foreach($temp as $item){
            $id=$item->{'id'};
            if(strpos($id,$idmoi[0])!==false){
                $linkmoilan2=$item->{'invite_link'};
            }
        }
    }else{
        $linkmoilan2="Lấy Link lần 1 Fail";
    }
  //   veri mail bm ở đây
  $url="https://graph.facebook.com/graphql?method=post&access_token=$tokenclone&variables={\"businessID\":\"$idbmlan2\",\"program\":\"CONVERSION_DATA\"}&doc_id=3781416171970251";
  $kq=$curlClone->get($url);
  if(strpos($kq,'marketing_program')){
        $agencybm2="AgenCy";
    }else{
        $agencybm2=$kq;
    }

    //////////////////////////// kết quả cuối cùng
    $bm1="".$idbmlan1."-".$linkmoilan1."-".$ketquataotkqc1;
    $bm2="".$idbmlan2."-".$linkmoilan2."-".$ketquataotkqc2;
    echo Message(true,"Reg BM Succes ck iuuu",$bm1,$bm2,$curlClone->getCookies());

    $curlClone->Close();
    return;


?>