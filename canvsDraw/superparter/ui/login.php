<?php
//session_start();
require_once(dirname(__FILE__).'/../lib/lib.php');
$phone="15888888888";
check_weixin_info();
//$_SESSION['is_success']=1;
$state='';
if(isset($_REQUEST['state']))
	$state=$_REQUEST['state'];
//echo $state;
$action='';
if(isset($_REQUEST['action']))
	$action=$_REQUEST['action'];

if($action=='release')
{
	$ret=SuperAPI::appBindWeixinCode($_SESSION['phone'],$_SESSION['phone'],$_SESSION['weixin_info']['openid'],2);
	unset($_SESSION['is_success']);
	unset($_SESSION['phone']);
	unset($_SESSION['invitation_code']);
	unset($_SESSION['user_id']);
	
	if($state=='')
	    echo "<script>location.href='login.php'</script>";
    else
        echo "<script>location.href='login.php?state=".$state."'</script>";		
	exit;
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
		//echo "<script>location.href='login.php?state=".$_REQUEST['state']."'</script>";
	}
}


//echo $_SESSION['weixin_info']['nickname'];
//echo $_SESSION['weixin_info']['openid'];
if(!isset($_SESSION['is_success']) && $action=='band')
{
if(isset($_REQUEST['phone'])||isset($_REQUEST['password']))
{
	//echo $_REQUEST['phone'];
	$phone=$_REQUEST['phone'];
	$password=$_REQUEST['password'];
	//$ret=SuperAPI::login($phone,$password);
	$ret=SuperAPI::appBindWeixinCode($phone,$password,$_SESSION['weixin_info']['openid'],1);
	//var_dump($ret);
	if($ret['is_success']==1)
	{
		//绑定成功
		$ret=SuperAPI::index('',$_SESSION['weixin_info']['openid']);
		if($ret['is_success']==1)
		{
			foreach($ret['user'] as $k=>$v)
				$_SESSION[$k]=$v;
			if($state=='')
				echo "<script>location.href='info.php'</script>";
			else
				echo "<script>location.href='".$_REQUEST['state']."'</script>";
			exit;
		}
		else
		{
			unset($_SESSION['is_success']);
			echo "<script>alert('绑定成功，登录失败：".$ret_login['message']."')</script>";
		}
	    /*
		$ret_login=SuperAPI::weixinlogin($_SESSION['weixin_info']['openid']);
		if($ret_login['is_success']==1)
		{
			foreach($ret_login as $k=>$v)
				$_SESSION[$k]=$v;
		
			if($state=='')
				echo "<script>location.href='info.php'</script>";
			else
				echo "<script>location.href='".$_REQUEST['state']."'</script>";
			exit;
		}
		else
		{
			//unset($_SESSION['is_success']);
			echo "<script>alert('绑定成功，登录失败：".$ret_login['message']."')</script>";
		}*/
	}
	else
	{
		//绑定失败
		unset($_SESSION['is_success']);
		echo "<script>alert('绑定失败：".$ret['message']."')</script>";
	}
}
}


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/hongbao.css" type="text/css" media="all" />
<title>绑定超级合伙人</title>
</head>

<body>
<div class="login-maindiv">
<div class="login-head">
<div id="show_mesage" name="show_mesage"  style="float:left;color:#909090;font-size:30px;" autocomplete="off">
微信:<?php echo $_SESSION['weixin_info']['nickname'];?>
</div>
<a href="info.php" id="show_mesage_register" name="show_mesage_register"  style="float:right;color:#dc9c9d;font-size:25px;text-decoration:none;" autocomplete="off">
个人信息</a>
</div>
<form name="formLogin" action="login.php?action=band&state=<?php echo $state;?>" method="post">

<?php
    echo '<input id="openid" name="openid" type="text" value="'.$_SESSION['weixin_info']['openid'].'" style="display:none;" />';
	
if($_SESSION['is_success']==1)
{
	echo '<input id="phone" name="phone" class="login-phone" type="number" value="" style="display:none;"  />';
	echo '<input id="password" name="password" class="login-passwd" type="password" value="" style="display:none;"  />';
    echo '<div id="login_info" name="login_info"  style="margin-top:10%;margin-bottom:10%;width:100%; text-align:center;float:left;color:#dc9c9d;font-size:25px;display:block;" autocomplete="off">
已绑定成功！</div>';
    echo '<div id="release_band" name="release_band" class="big_btn" onClick="release(\''.$state.'\')">解除绑定</div>';

}
else
{
	echo '<img id="login-middle" class="login-middle" src="../images/login-middle.png"></img>';
	echo '<input id="phone" name="phone" class="login-phone" type="number" value=""  />';
	echo '<input id="password" name="password" class="login-passwd" type="password" value=""  />';	
    echo '<div id="login_info" name="login_info"  style="margin-top:20%;width:100%; text-align:center;float:left;color:#dc9c9d;font-size:25px;display:none;" autocomplete="off">
已绑定成功！</div>
<img id="login_submit" onclick="if(checkMobile()) formLogin.submit(); else alert(\'手机号输入错误,请重新输入！\')"  class="login-submit" src="../images/login-bnt_submig.png"></img>
';
}
?>
</form>
</div>
<script type="text/javascript">	
	
    var p1=document.getElementById('show_mesage');
    p1.style.fontSize=(document.body.clientWidth*0.05)+"px";
	var p2=document.getElementById('show_mesage_register');
    p2.style.fontSize=(document.body.clientWidth*0.04)+"px";
	
    var p3=document.getElementById('phone');
    p3.style.fontSize=(document.body.clientWidth*0.07)+"px";
    p3.style.left=(document.body.clientWidth*0.25)+"px";
	p3.style.top=(document.body.clientWidth*0.35)+"px";

    var p4=document.getElementById('password');
    p4.style.fontSize=(document.body.clientWidth*0.07)+"px";
    p4.style.left=(document.body.clientWidth*0.25)+"px";
	p4.style.top=(document.body.clientWidth*0.50)+"px";	

    //var p5=document.getElementById('reset_register');
    //p5.style.fontSize=(document.body.clientWidth*0.04)+"px";
    var p6=document.getElementById('login_info');
    p6.style.fontSize=(document.body.clientWidth*0.05)+"px";	
	
	var p7=document.getElementById('release_band')
    p7.style.fontSize=(document.body.clientWidth*0.05)+"px";
	//confirm(p7.style.fontSize);
	
function release(state)
{
	if(state=="")
		self.location='login.php?action=release';
	else 
	    self.location='login.php?action=release&state='+state; 
}	
	
function checkMobile()
{
	var str = document.getElementById('phone').value;
    var is_correct = !!str.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
	if(is_correct==false)
	{
		document.getElementById('phone').value="";
	}
	return is_correct;
}
function reset_register()
{
	document.getElementById('phone').value="";
	document.getElementById('password').value="";
	document.getElementById('login_info').style.display="none";
	document.getElementById('login_submit').style.display="block";
}
</script>
</body>
