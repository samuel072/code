<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>登录抽奖</title>
    <meta name=“viewport” content=“width=device-width; initial-scale=1.0”>
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link href="/superparter/css/drawStyle.css" rel="stylesheet">
    <script src="/superparter/jquery/jquery-1.11.0.js"></script>
    <script src="/superparter/jquery/index.js"></script>
    <style type="text/css">
        .login{width:100% !important;}
        .mess{border: 0px; color: #999; margin-bottom: 0px;  margin-top: -10px;}
        .messnum{background: rgba(0,0,0,0); border: 0; color: #D64040;  padding: 10px 0; font-size: 10px;}
    </style>
</head>
<body>
	<div class="app-wrapper" id="wrapper">
        <div class="app-content">
            <div class="app-img">
                <img src="/superparter/images/loginBg1.png" class="app-txtimg"/>
            </div>
           <form name="saveGame" onsubmit="return submit_act();" action="/superparter/luckDraw/login.php" method="post">
                <div id="aapBtn" class="aapBtn">
                    <p id="telphone" class="telphone">
						<span>帐号：</span>
						<input type="text" id="admin-number" name="cell_number" class="admin-number" autocomplete="off"/>
					</p>
                    <p id="code" class="code">
						<span>密码：</span>
						<input id="admin-regcode" type="password" name="password" class="admin-password" autocomplete="off"/>
					</p>
                    <p id="message" class="telphone mess">
                        <input type="text" value="<?php echo $message; ?>" class="messnum" autocomplete="off"/>
                    </p>
                    <p class="log"><input class="login" type="submit" value="登录"/></p>
                    <p id="lastTxt"><a href="/superparter/luckDraw/ui/index.php">没有账号？立即注册></a></p>
                </div>
            </form>
        </div>
    </div>
</body>

	<script type="text/javascript">

        function checkMobile() {
            var str = document.getElementById('admin-number').value;
            var is_correct = !!str.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
            if(is_correct==false)
            {
                document.getElementById('admin-number').value="";
            }
            return is_correct;

        }

        function submit_act(){
            if(checkMobile()==false){
                $("#message").find("input").val("手机号输入错误,请重新输入");
                return false;
            }
        
            if(document.getElementById('admin-regcode').value=="")
            {   
                $("#message").find("input").val("请输入密码");
                return false;
            }
            saveGame.submit(); 
            return true;
        }


    </script>
</body>
</html>
