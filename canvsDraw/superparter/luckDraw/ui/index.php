<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>注册抽奖</title>
    <meta name=“viewport” content=“width=device-width; initial-scale=1.0”>
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link href="/superparter/css/drawStyle.css" rel="stylesheet"></link>
	<script type="text/javascript" src="/superparter/jquery/jquery-1.11.0.js"></script>
    <script src="/superparter/jquery/index.js"></script>
	<style type="text/css">
        .mess{border: 0px; color: #999; margin-bottom: 0px;  margin-top: -10px;}
        .messnum{background: rgba(0,0,0,0); border: 0; color: #D64040;  padding: 10px 0; font-size: 10px;}
        /*body{background: url('/superparter/images/choujiang.png') no-repeat 10px 0; background-size: 100%;}*/
        /*.app-txt{background: url('/superparter/images/choujiang.png')no-repeat; background-size: 100%; background-color: #0082CD}*/
    </style>
</head>
<body>
    <div class="app-wrapper" id="wrapper">
        <div class="app-content">
            <div class="app-img">
                <img src="/superparter/images/choujiang1.png" class="app-txtimg"/>
            </div>
            <form name="saveGame" onsubmit="return submit_act()" action="/superparter/luckDraw/register.php" method="post">
                <div id="aapBtn" class="aapBtn">
                    <p id="telphone" class="telphone"><span>手机号：</span><input type="text" id="number" name="cell_number" class="number" autocomplete="off" /></p>
                    <p id="code" class="code"><span>验证码：</span><input id="regcode" type="text" name="regcode" class="password" autocomplete="off"/><input type="button" id="hqcode" onclick="getCode();" value="获取验证码" ></p>
                    <p id="message" class="telphone mess">
                        <input type="text" value="<?php echo $message; ?>" class="messnum" autocomplete="off"/>
                    </p>
                    <p class="reg"><input class="register"  type="submit" value="注册"/></p>
                    <p id="lastTxt"><a href="/superparter/luckDraw/ui/login.php">已有账号？立即登录></a></p>
                </div>
            </form>
        </div>
    </div> 
	<script type="text/javascript">

        function checkMobile() {
            var str = document.getElementById('number').value;
            var is_correct = !!str.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
            if(is_correct==false)
            {
                document.getElementById('number').value="";
            }
            return is_correct;

        }

        function submit_act(){
            if(checkMobile()==false){
                $("#message").find("input").val("手机号输入错误,请重新输入");
                return false;
            }
        
            if(document.getElementById('regcode').value=="")
            {
                $("#message").find("input").val("请输入验证码！");
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
            var str = document.getElementById('number').value;
            if(str == null || str == ""){
                $("#message").find("input").val("请输入手机号码");
                return;
            }
            setTime();
            
            var res=httpGet("/superparter/luckDraw/sendCode.php?phone="+str);
            var json = eval('(' + res + ')');
            if(json.is_success==0)
            {   
                $("#message").find("input").val(json.message);
                return;
            }
        }
    </script>
</body>
</html>
