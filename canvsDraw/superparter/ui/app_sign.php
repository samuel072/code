<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name=“viewport” content=“width=device-width; initial-scale=1.0”>
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta content="超级合伙人,超级合伙人联盟,MOM" name=keywords />
    <title>超级合伙人-报名</title>
	<link rel="stylesheet" href="../css/app_sign.css" type="text/css" media="all" />
	<script type="text/javascript" src="../jquery/jquery-1.11.0.js"></script>
</head>
<body>
    <div class="app-wrapper">
        <div class="app-content">
            <div class="app-txt">
                <img src="../images/signBackground.jpg" class="app-txtimg"/>
            </div>
            <form name="saveGame" onsubmit="return submit_act()" action="saveGame.php" method="post">
				<input type="hidden" name="inviteCode" value="<?php echo $_REQUEST['invitation_code']; ?>"/>
                <div id="aapbtn" class="aapbtn">
                    <p id="telphone" class="telphone"><span>手机号：</span><input type="text" id="cell-number" name="cell-number" class="number" autocomplete="off"/></p>
                    <p id="code" class="code"><span>验证码：</span><input id="regcode" type="text" name="regcode" class="password" autocomplete="off"/><i></i><input type="button" id="hqcode" value="获取验证码" onclick="getCode()"></p>
                    <input class="tj" type="submit" value="提交"/>
                </div>
            </form>
        </div>
    </div>
	
    <script type="text/javascript">
        var p1=document.getElementById('aapbtn');
        p1.style.top=(document.body.clientWidth*0.8)+"px";

        var p2back=document.getElementById('telphone');
        p2back.style.fontSize=(document.body.clientWidth*0.04)+"px";
        p2back.style.top=(document.body.clientWidth*0.84)+"px";

        var p3back=document.getElementById('code');
        p3back.style.fontSize=(document.body.clientWidth*0.04)+"px";
        p3back.style.top=(document.body.clientWidth*0.84)+"px";

        /* var p4back=document.getElementById('hqcode');
         p4back.style.fontSize=(document.body.clientWidth*0.03)+"px"; */
    </script>
	
	<script type="text/javascript">
		function checkMobile(){
			var str = document.getElementById('cell-number').value;
			var is_correct = !!str.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
			if(is_correct==false)
			{
				document.getElementById('cell-number').value="";
			}
			return is_correct;
		}
		var phone_code="";
		function submit_act(){
			if(checkMobile()==false){
				alert('手机号输入错误,请重新输入！');
				return false;
			}
		
			if(document.getElementById('regcode').value=="")
			{
				 alert('请输入验证码！');
				 return false;
			}
			saveGame.submit(); 
  			return true;
			
		}
	        
		function httpGet(theUrl){
			var xmlHttp = null;
			xmlHttp = new XMLHttpRequest();
			xmlHttp.open( "GET", theUrl, false );
			xmlHttp.send( null );
			return xmlHttp.responseText;
		}
		function setTime(){
			var step = 59;
			$('#hqcode').val('重新发送60');
			var _res = setInterval(function()
			{   
				$("#hqcode").attr("disabled", true);//设置disabled属性
				$('#hqcode').val('重新发送'+step);
				step-=1;
				if(step <= 0){
				$("#hqcode").removeAttr("disabled"); //移除disabled属性
				$('#hqcode').val('获取验证码');
				clearInterval(_res);//清除setInterval
				}
			},1000);
		}
		
		// 获取验证码
		function getCode(){
			setTime();
			var str = document.getElementById('cell-number').value;
			var res=httpGet("./sendCode.php?phone="+str);
			var json = eval('(' + res + ')');
			if(json.is_success==0)
			{
				alert(json.message);
				return;
			}
			phone_code=json.phone_code;
		}
	</script>
</body>
</html>
