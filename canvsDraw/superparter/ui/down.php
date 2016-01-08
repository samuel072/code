<?php
session_start();
require_once(dirname(__FILE__).'/../lib/lib.php');
$phone="15810128531";
if(isset($_REQUEST['cell-number']))
{
	$phone=$_REQUEST['cell-number'];
}
$invitation_code='867947492918';
if(isset($_REQUEST['invitation_code']))
	$invitation_code = $_REQUEST['invitation_code'];

$ret=SuperAPI::fastRegister($phone,$invitation_code);

if(true)
{
	$password=substr($phone,strlen($phone)-6);
	$ret_login=SuperAPI::login($phone,$password);
	//var_dump($ret_login);
	if($ret_login['is_success']==1)
	{
		foreach($ret_login as $k=>$v)
		    $_SESSION[$k]=$v;
		$_SESSION['time']=time();
		$_SESSION['phone']=$phone;
		$_SESSION['password']=$password;
	}
	else
	{
		unset($_SESSION['is_success']);
		unset($_SESSION['phone']);
		unset($_SESSION['password']);
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/hongbao.css" type="text/css" media="all" />
<title>超级合伙人 尊享红包</title>
</head>

<body>
<img src="../images/down_part1.png" style="width:100%;"></img>
<div id="show_title" name="show_title"  style="position: absolute;left:35.1%;top: 211px;color:#f72c2f" autocomplete="off">
<?php
    if($ret['is_success']==1)
	{
		echo '恭喜您注册成功！';
	}
	else
	{
		echo '您已是注册会员！';
	}
		
?>
</div>

<div id="show_mesage" name="show_mesage"  style="position: absolute;left: 35.1%;top: 209px;color:#f72c2f" autocomplete="off">
<?php
    if($ret['is_success']==1)
	{
		echo '下载app登录即可领取哦！';
	}
	else
	{
		echo '下载app登录即可取哦！';
	}
		
?>
</div>
<div id="show_money" name="show_money"  style="position: absolute;left: 44%;top: 211px;color:black" autocomplete="off">￥<span>
<?php
    if($ret['is_success']==1)
	{
		$result = SuperAPI::appRegisterIncome($phone);
		if($result['is_success'] == 1){ 
			echo $result['money'];		
		}else{
			echo "领取红包失败！~<br/>";
			echo $result['message'];
		}
	}
?>
</span></div>
<!--div id="show_mesage" name="show_mesage"  style="position: absolute;left: 395px;top: 209px;color:#f72c2f" autocomplete="off">
￥70现金红包已存入您<br><?php echo $phone;?>账户中<br><?php echo $ret['message'];?></div-->
<!--img src="../images/hongbao_form.png" style="width:100%;"></img-->

<div id="maindiv">
  <a href="http://www.hhr360.com/app"><img class="get_hongbao" src="../images/down_button.png" style="margin-top:0%;"></img></a>
  <a href="invite.php"><img class="get_hongbao" src="../images/share_button.png" style="margin-top:5%;"></img></a>
</div>
<div class="footer">
<img src="../images/hongbao_part0500.png" style="width:100%;"></img>
 </div>

<script type="text/javascript">
    var p0=document.getElementById('show_title')
    p0.style.fontSize=(document.body.clientWidth*0.04)+"px";
	//p0.style.left=(document.body.clientWidth*0.345)+"px";
	p0.style.top=(document.body.clientWidth*0.18)+"px";
	
	var p1=document.getElementById('show_mesage')
    p1.style.fontSize=(document.body.clientWidth*0.025)+"px";
	//p1.style.left=(document.body.clientWidth*0.355)+"px";
	p1.style.top=(document.body.clientWidth*0.24)+"px";
	
    //var p2=document.getElementById('cell-number')
    //p2.style.fontSize=(document.body.clientWidth*0.07)+"px";
	//var p3=document.getElementById('mobile_icon')
    //p3.style.width=(document.body.clientWidth*0.07)+"px";
	//confirm(document.body.clientWidth*0.07);
	
	var p6=document.getElementById('show_money');
    p6.style.fontSize=(document.body.clientWidth*0.05)+"px";
    p6.style.top=(document.body.clientWidth*0.41)+"px";
</script>

</body>
