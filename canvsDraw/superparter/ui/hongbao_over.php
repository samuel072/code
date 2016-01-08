<?php
$invitation_code='193480301788';
if(isset($_REQUEST['invitation_code']))
	$invitation_code = $_REQUEST['invitation_code'];

$invitation_phone='15888888888';
if(isset($_REQUEST['invitation_phone']))
	$invitation_phone = $_REQUEST['invitation_phone'];

$invitation_nickName='Super';
if(isset($_REQUEST['invitation_nickName']))
	$invitation_nickName = $_REQUEST['invitation_nickName'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/hongbao.css" type="text/css" media="all" />
<title>超级合伙人 尊享红包</title>
</head>

<body>
<img src="../images/hongbao_part001.jpg" style="width:100%;"></img>
<!--img src="../images/hongbao_form.png" style="width:100%;"></img-->
<!--<div id="show_mesage" name="show_mesage"  style="position: absolute;left: 35.1%;top: 209px;color:#f72c2f;color:white;" >这期的红包已被抢光了哦~</div>-->
<script type="text/javascript">

    var p1=document.getElementById('show_mesage');
    p1.style.fontSize=(document.body.clientWidth*0.03)+"px";
	//p1.style.left=(document.body.clientWidth*0.345)+"px";
	p1.style.top=(document.body.clientWidth*0.22)+"px";
</script>
</body>
