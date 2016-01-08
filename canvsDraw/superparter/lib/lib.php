<?php
session_start();
date_default_timezone_set("Asia/Shanghai");
$va = explode('/',$_SERVER["PHP_SELF"]);
$filename = end($va);
$appId="wx2cb9e95c3605cabb";
$appSecret="a66790ca61660bd3647acbe460b0c372";
$weixin_band_url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appId;
$weixin_band_url.= "&redirect_uri=http%3A%2F%2Fwx.hhr360.com%2Fsuperparter%2Fui%2Findex.php&response_type=code&scope=snsapi_base&state=".$filename."#wechat_redirect";
require_once(dirname(__FILE__).'/Curl.class.php');
require_once(dirname(__FILE__).'/SuperAPI.class.php');
require_once(dirname(__FILE__).'/jssdk.php');
function is_login_status()
{
	//var_dump($_SESSION);
	if(!isset($_SESSION['phone'])|| $_SESSION['phone']==null || !SuperAPI::is_mobile($_SESSION['phone']) ||
	   !isset($_SESSION['invitation_code'])|| $_SESSION['invitation_code']==null )
	{
		unset($_SESSION['is_success']);
	    return false;
	}
	$_SESSION['is_success']=1;
	return true;
}

function check_login_status()
{
	//var_dump($_SESSION);
	global $weixin_band_url;
	if(!isset($_SESSION['phone'])|| $_SESSION['phone']==null || !SuperAPI::is_mobile($_SESSION['phone']) ||
	   !isset($_SESSION['invitation_code'])|| $_SESSION['invitation_code']==null )
	{
	    //echo "<script>location.href='login.php'</script>";
		echo "<script>location.href='".$weixin_band_url."'</script>";
            exit;
	}
	return true;
}

//
function is_weixin_info()
{
	global $weixin_band_url;
	if(!isset($_SESSION['weixin_info'])||!isset($_SESSION['weixin_info']['nickname'])||!isset($_SESSION['weixin_info']['openid']))
	{
	    return false;
	}
	return true;
}

//用户信息，分享红包页面进入收首先check是否已经获取微信信息，如果没有，则需要进行跳转获取
function check_weixin_info()
{
	global $weixin_band_url;
	if(!isset($_SESSION['weixin_info'])||!isset($_SESSION['weixin_info']['nickname'])||!isset($_SESSION['weixin_info']['openid']))
	{
	    echo "<script>location.href='".$weixin_band_url."'</script>";
            exit;
	}
	return true;
}
function register($phone)
{
    $url="http://61.183.149.170:19090/services/AppWebService?register";	
	$url="http://61.183.149.170:19090/index_service/register.htm";
	//$url="http://localhost/superparter/ui/test.php";
	$postdata=array(
		'phone'=>$phone+1,
		'password'=>md5(substr($phone,strlen($phone)-6)),
		'nickName'=>'',
		'phoneCode'=>'',
		'invitation_code'=>'193480301788',
		'reg_type'=>4,
	);
	//var_dump($postdata);
	//echo "<br>";
	$ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
	//echo $ret_str."<br>";
	$ret=json_decode($ret_str,true);
	return $ret;
}
?>
