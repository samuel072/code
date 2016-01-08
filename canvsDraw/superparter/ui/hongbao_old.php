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
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="../css/hongbao.css" type="text/css" media="all" />
<title>超级合伙人 尊享红包</title>
</head>

<body>
<img src="../images/hongbao_part1.png" style="width:100%;"></img>
<!--img src="../images/hongbao_form.png" style="width:100%;"></img-->
<div id="show_mesage" name="show_mesage"  style="position: absolute;left: 395px;top: 209px;color:#f72c2f" autocomplete="off">恭喜您获得了由<?php echo $invitation_nickName;?><br>分享给您的现金红包</div>
<div id="maindiv">
<form name="formLogin" action="down.php" method="post">
<div>
<img id="mobile_icon" class="mobile_icon" src="../images/phone_icon.png" style=""></img>
<div id="cell-div">
  <input id="invitation_code" name="invitation_code" type="text" value="<?php echo $invitation_code;?>" style="display:none;">
  <input id="cell-number" name="cell-number" type="text" value="输入手机号" 
  onfocus="javascript:if(this.value=='输入手机号')this.value='';" 
  onblur="if(this.value==''){this.value='输入手机号'}" />
  <img class="mobile_icon_line" src="../images/mobile_num_line_07.png" style="float:left;margin-top:1%;width:100%"></img>
</div>
</div>
<img onclick="if(checkMobile()) formLogin.submit()" class="get_hongbao" src="../images/qianbao_lingqu.png" style=""></img>

</form>
</div>
<img src="../images/hongbao_part3.png" style="width:100%;"></img>
  
<script type="text/javascript">
    var p1=document.getElementById('show_mesage');
    p1.style.fontSize=(document.body.clientWidth*0.03)+"px";
	p1.style.left=(document.body.clientWidth*0.345)+"px";
	p1.style.top=(document.body.clientWidth*0.22)+"px";
	
    var p2=document.getElementById('cell-number');
    p2.style.fontSize=(document.body.clientWidth*0.07)+"px";

	var p3=document.getElementById('mobile_icon');
    p3.style.width=(document.body.clientWidth*0.07)+"px";
	//confirm(document.body.clientWidth*0.07);

function checkMobile()
{
	var str = document.getElementById('cell-number').value;
    var is_correct = !!str.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
	if(is_correct==false)
	{
		document.getElementById('cell-number').value="";
		document.getElementById('cell-number-back').style.display="block";
	}
	return is_correct;
}

</script>
</body>
