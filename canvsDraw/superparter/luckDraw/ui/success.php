<?php
// 分享的代码
require_once(dirname(__FILE__).'/../../lib/lib.php');
$hongbao_url='http://wx.hhr360.com/superparter/luckDraw/ui/index.php';
$imgUrl='http://wx.hhr360.com/superparter/images/share_left.jpg';
require_once (dirname(__FILE__).'/../../lib/jssdk.php');
$jssdk = new JSSDK("wx2cb9e95c3605cabb","a66790ca61660bd3647acbe460b0c372");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>提交成功</title>
    <meta name=“viewport” content=“width=device-width; initial-scale=1.0”>
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <link href="/superparter/css/drawStyle.css" rel="stylesheet">
    <link href="/superparter/css/new.css" rel="stylesheet">
    <script src="/superparter/jquery/jquery-1.11.0.js"></script>
    <script src="/superparter/jquery/index.js"></script>
    <script src="/superparter/jquery/jquery.eraser.js"></script>
    <style>
        .againBtn{}
    </style>
</head>
<body>
    <div class="app-wrapper">
        <div class="app-content">
            <div class="app-txt">
                <img src="/superparter/images/addsuccess.png" class="app-txtimg"/>
            </div>
            <?php if($result['drawTimes'] == 1) { ?>
            <a class="onceBtn" id="onceBtn"><img src="/superparter/images/failBtn.png"/></a>
            <?php } ?>
			      <a href="http://hhr360.com/app" class="loadBtn scesBt" id="download">下载超级合伙人APP</a>
        </div>
    </div>
   
    <!--再抽一次--> 
    <div class="againLoty"></div>
   <script type="text/javascript">
		    var p1=document.getElementById('download')
        p1.style.fontSize=(document.body.clientWidth*0.05)+"px";
   </script> 
   <script type="text/javascript">
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：htttp://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] 
  });
  wx.ready(function () {
    // 在这里调用 API
    wx.onMenuShareTimeline({
        title: "注册超级合伙人联盟，赢取ipad大奖！",
        desc: "注册超级合伙人联盟，赢取ipad大奖！",
        link:"<?php echo $hongbao_url;?>",
        imgUrl: "<?php echo $imgUrl;?>", // 分享图标

        success:function(){
          // 用户确认分享执行的回调函数
          /**
           * 跳转到一个action  增加一次抽奖机会 然后跳转到抽奖的页面
           */
            $.post("/superparter/luckDraw/addTimes.php", {userId: "<?php echo $userId; ?>"},  function(data) {
                if(data.status == 1){ // 增加一次机会成功  并调转到抽奖页面
                   location.href="/superparter/luckDraw/todraw.php?userId=<?php echo $userId; ?>";
                }

            },
            "json");
          
        },

        cancel:function(){

        }

    });
    // 获取“分享给朋友”按钮点击状态及自定义分享内容接口
    wx.onMenuShareAppMessage({
        desc: "注册超级合伙人联盟，赢取ipad大奖！", // 分享描述
        link:"<?php echo $hongbao_url;?>",
        imgUrl: "<?php echo $imgUrl;?>", // 分享图标
        type: 'link', // 分享类型,music、video或link，不填默认为link

        success:function(){
          // 用户确认分享执行的回调函数
            $.post("/superparter/luckDraw/addTimes.php", {userId: "<?php echo $userId; ?>"},  function(data) {
                if(data.status == 1){ // 增加一次机会成功  并调转到抽奖页面
                    location.href="/superparter/luckDraw/todraw.php?userId=<?php echo $userId; ?>";
                }

            },
            "json");
        },

        cancel:function(){
          
        }
    });
  });
</script> 
</body>
</html>
<script>
    var once=document.getElementById('onceBtn')
    once.style.width=(document.body.clientWidth*0.8)+"px";
    once.style.left=(document.body.clientWidth*0.1)+"px";

    $(function(){
        $("#onceBtn").bind("click",function(){
            $(".againLoty").show();
        })
    });
</script>
