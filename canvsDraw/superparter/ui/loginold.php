<?php
require_once(dirname(__FILE__).'/../lib/lib.php');
$phone="15888888888";
if(isset($_REQUEST['phone'])||isset($_REQUEST['password']))
{
	$phone=$_REQUEST['phone'];
	$password=$_REQUEST['password'];
	echo $phone."_".$password."<br>";
	$ret=SuperAPI::login($phone,$password);
	
	if($ret['is_success']==1)
	{
		foreach($ret as $k=>$v)
		    $_SESSION[$k]=$v;
		$_SESSION['time']=time();
		$_SESSION['phone']=$phone;
		$_SESSION['password']=$password;
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/hongbao.css" type="text/css" media="all" />
<title>登录超级合伙人</title>
</head>

<body>
<div class="login-maindiv">
<div class="login-head">
<div id="show_mesage" name="show_mesage"  style="float:left;color:#909090;font-size:30px;" autocomplete="off">
用户登录
</div>
<a href="register.php" id="show_mesage_register" name="show_mesage_register"  style="float:right;color:#dc9c9d;font-size:25px;text-decoration:none;" autocomplete="off">
注册</a>
</div>
<form name="formLogin" action="login.php" method="post">
<img id="login-middle" class="login-middle" src="../images/login-middle.png"></img>
<?php
if($_SESSION['is_success']==1)
{
	echo '<input id="phone" name="phone" class="login-phone" type="number" value="'.$_SESSION['phone'].'"  />';
	echo '<input id="password" name="password" class="login-passwd" type="password" value="'.$_SESSION['password'].'"  />';
}
else
{
	echo '<input id="phone" name="phone" class="login-phone" type="number" value=""  />';
	echo '<input id="password" name="password" class="login-passwd" type="password" value=""  />';	
}
?>
<div id="reset_register" name="reset_register"  onclick="reset_register" style="float:left;color:#dc9c9d;font-size:25px;text-decoration:none;" autocomplete="off">
点我重置</div>
<img  onclick="if(checkMobile()) formLogin.submit(); else alert('手机号输入错误,请重新输入！')"  class="login-submit" src="../images/login-bnt_submig.png"></img>
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
	p3.style.top=(document.body.clientWidth*0.36)+"px";

    var p4=document.getElementById('password');
    p4.style.fontSize=(document.body.clientWidth*0.07)+"px";
    p4.style.left=(document.body.clientWidth*0.25)+"px";
	p4.style.top=(document.body.clientWidth*0.51)+"px";	
	
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
	document.getElementById('phone').value="";
}
</script>
</body>
