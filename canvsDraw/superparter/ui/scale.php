<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="../css/default.css" type="text/css" media="all" />
<title>�����ϻ��� �������</title>
<script type="text/javascript" src="../jquery/jquery-1.11.0.js"></script> 
<script type="text/javascript"> 
$(function() { 

var r = document.body.offsetWidth / 640; 
$(document.body).css("-webkit-transform","scale(" + r + ")"); 
}); 
$(window).resize(function() { 
//confirm(document.body.offsetWidth);
var r = document.body.offsetWidth / 640; 
$(document.body).css("-webkit-transform","scale(" + r + ")"); 

});

</script> 
</head>

<body>
<div class="main-body">
  <img src="../images/hongbao_part1.png" style=""></img>
<!--img src="../images/hongbao_form.png" style="width:100%;"></img-->

<!--div id="maindiv">
<form name="formLogin" action="down.php" method="post">
<div>
<img id="mobile_icon" class="mobile_icon" src="../images/phone_icon.png" style=""></img>
<div id="cell-div">
  <input id="cell-number" name="cell-number" type="text" value="�����ֻ���" 
  onfocus="javascript:if(this.value=='�����ֻ���')this.value='';" 
  onblur="if(this.value==''){this.value='�����ֻ���'}" />
  <img class="mobile_icon_line" src="../images/mobile_num_line_07.png" style="float:left;margin-top:1%;width:100%"></img>
</div>
</div>
<a href="#" onclick="formLogin.submit();"><img class="get_hongbao" src="../images/qianbao_lingqu.png" style=""></img></a>

</form>
</div-->
<img src="../images/hongbao_part3.png" style=""></img>

</div>
<script type="text/javascript">
    var p=document.getElementById('cell-number')
    p.style.fontSize=(document.body.clientWidth*0.07)+"px";
	var p2=document.getElementById('mobile_icon')
    p2.style.width=(document.body.clientWidth*0.07)+"px";
	//confirm(document.body.clientWidth*0.07);
</script>
</body>