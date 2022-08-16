<?php
  
class mycurl
{
    
    public $headers;
   
    // public $user_agent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36";
    // public $user_agent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36";
    public $user_agent="Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.120 Safari/537.36";
    public $location_cookie_file;
    public $proxy;
    protected $luutruck;
    protected $fb_dtsg='';
    protected $pwd=null;
    public function __construct($proxy=null,$pwd=null,$UA=null)
    {
        if($proxy){
            $this->proxy=$proxy;
            $this->pwd=$pwd;
        }
        $this->ResetHeader();
        $this->SetFileCookie();
        if($UA){
            $this->user_agent=$UA;
        }
      
    }
    
    public function SetFileCookie()
    {

             $rd ="/".strval(rand(10000,1000000)).".txt";
            $this->location_cookie_file = dirname(__FILE__).$rd;
    }

    public function get($url)
    {
        $ketqua="";
        try{
            $process = curl_init($url);
            curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
            curl_setopt($process, CURLOPT_TCP_KEEPALIVE, 1);
            curl_setopt($process, CURLOPT_COOKIEFILE,$this->location_cookie_file);
            curl_setopt($process, CURLOPT_COOKIEJAR,$this->location_cookie_file);
            curl_setopt($process, CURLOPT_COOKIE, $this->luutruck);
            curl_setopt($process, CURLOPT_TIMEOUT, 80);
            curl_setopt($process, CURLOPT_PROXY,$this->proxy);
            if(isset($this->pwd)){
                curl_setopt($process, CURLOPT_PROXYUSERPWD, $this->pwd); 
            }
            // curl_setopt($process, CURLOPT_PROXY,"103.79.142.142:49114");
            // curl_setopt($process, CURLOPT_PROXYUSERPWD,"user49114:fNabV0XQaX");
            curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($process,CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
            $ketqua = curl_exec($process);
        
            if(curl_error($process)){
                $ketqua=curl_errno($process);
                $notice = array(
                    "status" => false,
                    "message" => "Lỗi Sever Như Connect,Proxy die,Máy Chủ Quá tải...".$ketqua,
                    "data" => array(
                        "mot" => '',
                        "hai" => '',
                        "ba" => ''
                    )
                );
                $this->Close();
                exit(json_encode($notice));
            }
            // echo $ketqua;
            // $this->LuuCookies(curl_getinfo($process, CURLINFO_COOKIELIST));
            curl_close($process);
        }catch(Exception $e){
           $ketqua=$e;
        }
       
        return $ketqua;
    }

    public function post($url, $data)
    {
        $ketqa="";
        try{
            $process = curl_init($url);
            curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
            // curl_setopt($process, CURLOPT_COOKIEJAR, $this->location_cookie_file);
            curl_setopt($process, CURLOPT_COOKIEFILE, $this->location_cookie_file);  
            curl_setopt($process, CURLOPT_COOKIE, $this->luutruck);
            curl_setopt($process, CURLOPT_TIMEOUT, 80);
            curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($process,CURLOPT_SSL_VERIFYHOST, FALSE);
            // $data=http_build_query($data);
            curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($process, CURLOPT_TCP_KEEPALIVE, 1);	
            curl_setopt($process, CURLOPT_POST,true);
            curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($process, CURLOPT_PROXY,$this->proxy);
            if(isset($this->pwd)){
                  curl_setopt($process, CURLOPT_PROXYUSERPWD, $this->pwd); 
            }
            $ketqa = curl_exec($process);
            if(curl_error($process)){
                $ketqua=curl_errno($process);
                $notice = array(
                    "status" => false,
                    "message" => "Lỗi:".$ketqua,
                    "data" => array(
                        "mot" => '',
                        "hai" => '',
                        "ba" => ''
                    )
                );
                $this->Close();
                exit(json_encode($notice));
            }
            //$haiz=curl_getinfo($process);
            $this->LuuCookies(curl_getinfo($process, CURLINFO_COOKIELIST));
            curl_close($process);
            
            }catch(Exception $e){
                $ketqa=$e;
            }
        
        return $ketqa;
    }

    public function LuuCookies($result){
     //  $temp=implode("",$result);  
       $haiz='';
       foreach ($result as $line)
        {
            preg_match('/[0-9]\s+(.*?)\s+(.*?)$/',$line,$match);
            if(isset($match)){
                $haiz=$haiz.$match[1]."=".$match[2].";";
            }
        }
        if(!empty($haiz)){
            $this->luutruck=$haiz;
        }
        

    }
    public function PostJson($url,$data,$header=null){
        try{
            $arr=array(
                'Content-Type:application/json',
            );
            if(isset($header)){
                array_push($arr,$header);
            }
            $ch=curl_init($url);
            curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
            // curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_HTTPHEADER,
            //     array(
            //         'Content-Type:application/json',
            //     )
            // );
            curl_setopt($ch, CURLOPT_HTTPHEADER,$arr);
            $result = curl_exec($ch);
       
            return $result;

        }catch(Exception $e){

        }
     
    }
    public function setCookies($ck){
        $this->luutruck=$ck;
    }
    public function getCookies(){
        return $this->luutruck;
    }
    public function setHeader($headernek){
        $this->headers=$headernek;
    }
    public function getUid(){
        preg_match("/(1000[0-9]{4,})/",$this->luutruck,$match);
        return $match[1];
    }
    function getFbdtsg(){
        if(strlen($this->fb_dtsg)>2){
            return $this->fb_dtsg;
        }else{
            $url="https://m.facebook.com/composer/ocelot/async_loader/?publisher=feed";
            $kq=$this->get($url);
            // echo $kq;
            $kq=str_replace("\\","",$kq);
            preg_match('/name=\"fb_dtsg\" value=\"(.*?)\"/',$kq,$match);
            $this->fb_dtsg=$match[1];
            return $match[1];
        }
       
    }

    function LayFbdtsg(){
        $url="https://m.facebook.com/composer/ocelot/async_loader/?publisher=feed";
        $kq=$this->get($url);
        // echo $kq;
        $kq=str_replace("\\","",$kq);
        preg_match('/name=\"fb_dtsg\" value=\"(.*?)\"/',$kq,$match);
        $this->fb_dtsg=$match[1];
        return $match[1];
        
    }
    function setFbdtsg($fb){
        $this->fb_dtsg=$fb;
    }
    public function ResetHeader(){
        $this->headers = array('accept-language:en-US,en;q=0.9',
        'accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'sec-fetch-dest:document',
        'sec-fetch-mode:navigate',
        'sec-fetch-site:none',
        'sec-fetch-user:?1',
        'upgrade-insecure-requests:1',
        // 'Content-type:application/x-javascript; charset=utf-8'
        
    );
    }
    public function CheckProxy($proxynek)
    {
        $this->proxy=$proxynek;
        $kq=$this->get("http://icanhazip.com");
        $this->proxy=false;
        return $kq;
        
    }
    public function getcode2fa($two2fa){
       $two2fa = preg_replace('/\s+/', '', $two2fa);

       $urlget="http://thanhson.name.vn/2fa.php?F=".$two2fa;
       $ch = curl_init($urlget);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

       $kq= curl_exec($ch);
       curl_close($ch);
       return $kq;
    }
    public function setProxy($proxynek){
        $this->proxy=$proxynek;
    }

    public function Close(){
        $status =unlink($this->location_cookie_file);
    }

   

}

?>