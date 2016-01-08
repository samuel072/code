<?php
session_start();
require_once(dirname(__FILE__).'/../lib/lib.php');

//没有获取用户微信信息，则先获取用户微信信息
if(!is_weixin_info())
{
	$jssdk = new JSSDK("wx2cb9e95c3605cabb","a66790ca61660bd3647acbe460b0c372");
	$res = $jssdk->getUserInfoByCode($_REQUEST['code']);
	$_SESSION['weixin_info']=$res;
}
if(!is_login_status())
{
	$ret=SuperAPI::index('',$_SESSION['weixin_info']['openid']);
	if($ret['is_success']==1)
	{
		foreach($ret['user'] as $k=>$v)
		    $_SESSION[$k]=$v;
		echo "<script>location.href='".$_REQUEST['state']."'</script>";
        exit;
	}
	else
	{
		unset($_SESSION['is_success']);
		//echo "Need to band weixin";
		echo "<script>location.href='login.php?state=".$_REQUEST['state']."'</script>";
		exit;
	}
}
//echo "<script>location.href='".$_REQUEST['state']."'</script>";
require_once($_REQUEST['state']);
exit;	
?>