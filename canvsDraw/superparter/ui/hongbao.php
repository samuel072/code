<?php
require_once(dirname(__FILE__).'/../lib/lib.php');
$ret = SuperAPI::queryRegisterActivity();
//echo json_encode($ret);
if($ret['is_success'] != 1){
  require_once(dirname(__FILE__).'/../ui/hongbao_over.php');
  return;
}

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
<img src="../images/hongbao_part1.png" style="width:100%;"></img>
<!--img src="../images/hongbao_form.png" style="width:100%;"></img-->
<div id="show_mesage" name="show_mesage"  style="position: absolute;left: 35.1%;top: 209px;color:#f72c2f" autocomplete="off">恭喜您获得了由<?php echo $invitation_nickName;?><br>分享给您的现金红包</div>
<div id="maindiv">
<form name="formLogin" action="down.php" method="post">
<div>
<img id="mobile_icon" class="mobile_icon" src="../images/phone_icon.png" style=""></img>
<div id="cell-div">
  <input id="invitation_code" name="invitation_code" type="text" value="<?php echo $invitation_code;?>" style="display:none;">
  <input id="cell-number" name="cell-number" type="text" value="" 
  onfocus="mobile_onfocus()" 
  onblur="mobile_onblur()" />
  <div id="cell-number-back" name="cell-number-back" type="text" value="点击输入手机号" style="position:absolute;z-index: -1;"><td>点击输入手机号</td></div>
  <img class="mobile_icon_line" src="../images/mobile_num_line_07.png" style="float:left;margin-top:1%;width:100%;height:2px;"></img>
  <div id="regcode-div" style="margin-top:5%;">
	<input type="text" id="regcode" style="width:50%;float: left;vertical-align: middle;background:rgba(248,241,230,0);padding:0;border-top:0;border-left:0;border-right:0;border-bottom:1px solid #b3b3b3;border-radius: 0;"/>
	<input type="button" id="endtime" style="width:50%;vertical-align: middle;padding:0px;" class="timer-valid" value="获取验证码" onclick="try_get_regcode()">
  </div>
</div>
</div>
<img onclick="hongbao_submit()" class="get_hongbao" src="../images/qianbao_lingqu.png" style=""></img>

</form>
</div>
<div class="footer">
<img src="../images/hongbao_part0500.png" style="width:100%;"></img>
 </div>
<script type="text/javascript">

    var p1=document.getElementById('show_mesage');
    p1.style.fontSize=(document.body.clientWidth*0.03)+"px";
	//p1.style.left=(document.body.clientWidth*0.345)+"px";
	p1.style.top=(document.body.clientWidth*0.22)+"px";
	
    var p2=document.getElementById('cell-number');
    p2.style.fontSize=(document.body.clientWidth*0.07)+"px";
	
    var p2back=document.getElementById('cell-number-back');
    p2back.style.fontSize=(document.body.clientWidth*0.07)+"px";
	p2back.style.left=(document.body.clientWidth*0.278)+"px";
	p2back.style.top=(document.body.clientWidth*0.84)+"px";

	var p3=document.getElementById('mobile_icon');
    p3.style.width=(document.body.clientWidth*0.07)+"px";
	
	var p4=document.getElementById('regcode');
	p4.style.fontSize=(document.body.clientWidth*0.05)+"px";
    //p4.style.width=(document.body.clientWidth*0.07)+"px";
	
	var p5=document.getElementById('endtime');
	p5.style.fontSize=(document.body.clientWidth*0.05)+"px";
	//p5.style.margin=(document.body.clientWidth*0.01)+"px";
    //p5.style.width=(document.body.clientWidth*0.07)+"px";
	//confirm(document.body.clientWidth*0.07);
	
var phone_code="";
function mobile_onfocus()
{
	document.getElementById('cell-number-back').style.display="none";
	document.getElementById('cell-number').focus();
}
function mobile_onblur()
{
	if(document.getElementById('cell-number').value=="")
	    document.getElementById('cell-number-back').style.display="block";	
	else
		document.getElementById('cell-number-back').style.display="none";
}
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
function hongbao_submit()
{
	if(checkMobile()==false)
    {
		 alert('手机号输入错误,请重新输入！');
		 return ;
	}
    if(phone_code=="")
    {
		 alert('请获取验证码！');
		 return ;
	}
    if(document.getElementById('regcode').value=="")
    {
		 alert('请输入验证码！');
		 return ;
	}
    if(phone_code!= document.getElementById('regcode').value)
    {
		 alert('验证码错误,请重新输入！');
		 return ;
	}
    formLogin.submit(); 
}
mobile_onblur();
var i = 0;
function remainTime(){
	var nodeTime = document.getElementById('endtime'); 
	if(i==0){
		nodeTime.className = 'timer-valid'; 
		nodeTime.removeAttribute("disabled");  
		nodeTime.value="验证码";
		return;
	}
	nodeTime.value=i--;
	setTimeout("remainTime()",1000);
}
function time()
{
	i=60;
	remainTime();
}
function httpGet(theUrl){
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false );
    xmlHttp.send( null );
    return xmlHttp.responseText;
}
function try_get_regcode()
{
	if(i==0)
	{
		var str = document.getElementById('cell-number').value;
		var is_correct = !!str.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
		if(is_correct==false)
		{
			alert("手机号输入错误！");
			return;
		}
		
		var res=httpGet("./regPhoneCode.php?phone="+str);
	    var json = eval('(' + res + ')');
		if(json.is_success==0)
		{
			alert(json.message);
			return;
		}
		phone_code=json.phone_code;
		
		var nodeTime = document.getElementById('endtime'); 
		nodeTime.className = 'timer-invalid'; 
		nodeTime.setAttribute("disabled", "disabled");
		time();
	}
}

</script>
</body>
