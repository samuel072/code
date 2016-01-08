<?php
session_start();
require_once(dirname(__FILE__).'/../lib/lib.php');
check_login_status();
//$_SESSION['user_id']=4639;
$ret=SuperAPI::index('',$_SESSION['weixin_info']['openid']);
//var_dump($ret['user']);
if($ret['is_success']==0)
{
	echo "<script>alert('用户信息获取失败：".$ret_login['message']."')</script>";
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/hongbao.css" type="text/css" media="all" />
<title>个人信息</title>
</head>

<body style="background-color: white;background-image: none !important">

<?php
echo '<div class="info-user">';
if($ret['user']['user_avatar']=="")
	echo '<img src="../images/user_avatar.png" class="info-user-avatar"></img>';
else
	echo '<img src="'.$ret['user']['user_avatar'].'" class="info-user-avatar"></img>';

echo '<div id="info-user-name" class="info-user-name">'.$ret['user']['nick_name'].'</div>';
echo '<div id="info-user-phone" class="info-user-phone"><a href="tel:'.$ret['user']['phone'].'" style="text-decoration:none;color:#444444;">'.$ret['user']['phone'].'</a></div>';
echo '<div id="info-user-level" class="info-user-level">';

$tol=1*($ret['stat']['firstly_partner_num']+$ret['stat']['secondary_partner_num']);

if($tol>500)
{
	echo '<img src="../images/home_page_sun.png" class="info-user-star"></img>';
}
else if($tol>200)
{
	echo '<img src="../images/home_page_moon.png" class="info-user-star"></img>';
}
else
{
	$num=1;
	if($tol>100)
		$num=5;
	else if($tol>50)
		$num=4;
	else if($tol>10)
		$num=3;
	else if($tol>5)
		$num=2;
	for($i=0;$i<$num;$i++)
	{
		echo '<img src="../images/home_page_star.png" class="info-user-star"></img>';
	}
}
echo '</div></div>';


//
$k="日收益(元)";
echo '<div class="info-stat">';
echo '<div id="circle" class="circle"><div id="daily_income"><div id="daily_income_key" style="color:grey;">日收益(元)</div><div id="daily_income_value" >'.number_format($ret['stat']['daily_income']).'</div></div></div>';



$data=array(
"总收益"=>array(number_format($ret['stat']['total_income']),"#449cef",""),
"月收益"=>array(number_format($ret['stat']['monthly_income']),"#36CA76",""),
"合伙人"=>array($ret['stat']['firstly_partner_num']+$ret['stat']['secondary_partner_num'],"#FD574F","人"),
);

echo '<table id="info-stat-table" class="info-user-income">';
foreach($data as $k=>$v)
{
	echo '<tr style="margin-top:10px;">';
	echo '<td style="width:15%;text-align:right;"><div class="circle-small" style="background:'.$v[1].'"></td>';
	echo '<td style="width:40%;color:grey">'.$k.'</td>';
	echo '<td style="width:45%">'.$v[0].$v[2].'</td>';
	echo '</tr>';
}
echo '</table>';

echo '</div>';
?>






<!--img src="../images/register.png" style="width:100%;"></img-->
<form id="info-maindv" class="info-maindv" style="text-align:left;margin-left:0%;margin-top:5%;display:none;">
<?php
    foreach($ret['user'] as $k=>$v)
	{
		echo '<label>'.SuperAPI::$g_index_map[$k].'</label>'.$v.'<br>';
	}
    foreach($ret['stat'] as $k=>$v)
	{
		if($k=="daily_income")
			continue;
		//	echo '<div id="circle" class="circle"><div id="daily_income">'.SuperAPI::$g_index_map[$k].'<br>'.$v.'</div></div>';
		//else
		echo '<label>'.SuperAPI::$g_index_map[$k].'</label>'.$v.'<br>';
	}
?>
</form>
<script type="text/javascript">
    var p1=document.getElementById('circle');
    p1.style.width=(document.body.clientWidth*0.3)+"px";
	p1.style.height=(document.body.clientWidth*0.3)+"px";
	p1.style.borderWidth=(document.body.clientWidth*0.05)+"px";
	p1.style.fontSize=(document.body.clientWidth*0.05)+"px";
	
	var p3=document.getElementById('daily_income');
	p3.style.marginTop=(document.body.clientWidth*0.08)+"px";
	p3=document.getElementById('daily_income_key');
	p3.style.fontSize=(document.body.clientWidth*0.04)+"px";
	p3=document.getElementById('daily_income_value');
	p3.style.fontSize=(document.body.clientWidth*0.07)+"px";
	
    var p2=document.getElementById('info-maindv');
    p2.style.fontSize=(document.body.clientWidth*0.04)+"px";
	
	
	var p="";
	
	p=document.getElementById('info-user-name');
	p.style.fontSize=(document.body.clientWidth*0.05)+"px";
	p=document.getElementById('info-user-phone');
	p.style.fontSize=(document.body.clientWidth*0.05)+"px";
	p=document.getElementById('info-stat-table');
	p.style.fontSize=(document.body.clientWidth*0.05)+"px";

</script>
</body>