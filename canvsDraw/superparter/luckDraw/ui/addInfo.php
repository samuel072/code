<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>信息提交</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">

    <link href="/superparter/css/drawStyle.css" rel="stylesheet">
    <script src="/superparter/jquery/jquery-1.11.0.js"></script>
    <script src="/superparter/jquery/index.js"></script>
    <script src="/superparter/jquery/jquery.eraser.js"></script>
</head>
<body>
<div class="app-wrapper">
    <div class="app-content">
        <div class="app-txt">
            <img src="/superparter/images/address.png" class="app-txtimg"/>
        </div>
        <form name="saveGame" onsubmit="return submit_act();"  action="/superparter/luckDraw/saveInfo.php" method="post">
            <input type="hidden" name="drawName" value="<?php echo $drawName; ?> " />
            <div id="aresbtn" class="aresbtn">
                <p id="name" class="ares name"><span>姓名：</span><input type="text" id="cell-name" name="cell_name" class="name" autocomplete="off"/></p>
                <p id="telphone" class="ares telphone"><span>电话：</span><input type="text" id="cell-number" name="cell_number" class="number" autocomplete="off"/></p>
                <p id="address" class="ares address"><span>收货地址：</span><input id="addAddress" type="text" name="addAddress" class="addAddress" autocomplete="off"/></p>
                <input class="report" type="submit" value="点击提交"/>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    
    function submit_act(){
        var userName = document.getElementById("cell-name").value;
        var phone = document.getElementById("cell-number").value;
        var address = document.getElementById("addAddress").value;

        if ("" == userName || null == userName) {
            alert("请填写您的姓名");
            return false;
        }

        if ("" == phone || null == phone) {
            alert("请填写您的手机号码");
            return false;
        }else {
            var is_correct = !!phone.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
            if(is_correct==false)
            {
                document.getElementById('cell-number').value="";
                alert("请输入正确的手机号");
            }
            return is_correct;
        }

        if ("" == address || null == address) {
            alert("请填写您的地址");
            return false;
        }
        saveGame.submit(); 
        return true;
    }
</script>
</body>
</html>
