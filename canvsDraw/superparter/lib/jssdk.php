<?php
class JSSDK {
  private $appId="wx2cb9e95c3605cabb";
  private $appSecret="a66790ca61660bd3647acbe460b0c372";

  public function __construct($appId, $appSecret) {
    $this->appId = $appId;
    $this->appSecret = $appSecret;
  }
  public function getUserInfo()
  {
	  $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appId;
	  $url.= "&redirect_uri=http%3A%2F%2F101.200.234.73%2Fsuperpartner%2Fui%2index.php&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
      echo $url."<br>";
	  $res=$this->httpGet($url);
      //$res = $this->get_redirect_url($url);
	  //$res=Curl::mycurl($url);
	  echo $res."cui";
  }
  public function getUserInfoByCode($code)
  {
	  $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appId."&secret=".$this->appSecret."&code=".$code."&grant_type=authorization_code";
	  //echo $url."<br>";
	  //echo $this->httpGet($url)."<br>";
      $res = json_decode($this->httpGet($url),true);
	  //foreach($res as $k=>$v)
	  //{
	  //  echo $k.":".$v."<br>";
	  //}
	  $openid=$res['openid'];
	  
	  $accessToken = $this->getAccessToken();
	  
	  $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$accessToken&openid=$openid";
	  //echo $url;
      return json_decode($this->httpGet($url),true);
  }
  public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    //$data = json_decode(file_get_contents("jsapi_ticket.json"));
    //if ($data->expire_time < time()) {
      $accessToken = $this->getAccessToken();
      // 如果是企业号用以下 URL 获取 ticket
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode($this->httpGet($url));
      $ticket = $res->ticket;
    /*  if ($ticket) {
        $data->expire_time = time() + 7000;
        $data->jsapi_ticket = $ticket;
        $fp = fopen("jsapi_ticket.json", "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
      }
    } else {
      $ticket = $data->jsapi_ticket;
    }*/

    return $ticket;
  }

  private function getAccessToken() {
    // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
    //$data = json_decode(file_get_contents("access_token.json"));
    //if ($data->expire_time < time()) {
      // 如果是企业号用以下URL获取access_token
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
      $res = json_decode($this->httpGet($url));
      $access_token = $res->access_token;
      /*if ($access_token) {
        $data->expire_time = time() + 7000;
        $data->access_token = $access_token;
        $fp = fopen("access_token.json", "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
      }
    } else {
      $access_token = $data->access_token;
    }*/
    return $access_token;
  }

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);
    //curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
	//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
    $res = curl_exec($curl);
	curl_close($curl);
    return $res;
  }
  private function httpGetJump($url)
  {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 500);
	curl_setopt($ch, CURLOPT_TIMEOUT, 500);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 获取转向后的内容 
	$data = curl_exec($ch);
	$Headers = curl_getinfo($ch); 
	echo "DATA:";
	var_dump($data);
	echo "<br>";
	curl_close($ch);
	if ($data != $Headers){ 
	    echo $Headers["url"]."<br>";
	    return $Headers["url"]; 
	}else{
	    return false;
	}
  }
  private  function get_redirect_url($url, $referer='', $timeout = 500) {
   $redirect_url = false;
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_HEADER, TRUE);
   curl_setopt($ch, CURLOPT_NOBODY, TRUE);//不返回请求体内容
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);//允许请求的链接跳转
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
   if ($referer) {
     curl_setopt($ch, CURLOPT_REFERER, $referer);//设置referer
   }
   $content = curl_exec($ch);
   if(!curl_errno($ch)) {
     $res = curl_getinfo($ch);//获取最终请求的url地址
	 print_r($res);
	 $redirect_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);//获取最终请求的url地址
   }
   return $redirect_url;
}
function get_url($url,$cookie=false)  
{  
$url = parse_url($url);  
$query = $url[path]."?".$url[query];  
echo "Query:".$query;  
$fp = fsockopen( $url[host], $url[port]?$url[port]:80 , $errno, $errstr, 30);  
if (!$fp) {  
return false;  
} else {  
$request = "GET $query HTTP/1.1\r\n";  
$request .= "Host: $url[host]\r\n";  
$request .= "Connection: Close\r\n";  
if($cookie) $request.="Cookie:   $cookie\n";  
$request.="\r\n";  
fwrite($fp,$request);  
while(!feof($fp)) {  
$result .= @fgets($fp, 1024);  
}  
fclose($fp);  
return $result;  
}  
}  
//获取url的html部分，去掉header  
function GetUrlHTML($url,$cookie=false)  
{  
$rowdata = get_url($url,$cookie);  
if($rowdata)  
{  
$body= stristr($rowdata,"\r\n\r\n");  
$body=substr($body,4,strlen($body));  
return $body;  
}  
    return false;  
}  
}

