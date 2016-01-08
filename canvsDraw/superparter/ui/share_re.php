<?php
// 分享的代码
require_once(dirname(__FILE__).'/../lib/lib.php');
//check_login_status();
// $ret = SuperAPI::queryRegisterActivity();
// if($ret['is_success'] != 1){
  // require_once(dirname(__FILE__).'/hongbao_over.php');
  // exit;
  // return;
// }
// $invitation_nickName=$_SESSION['weixin_info']['nickname']
$hongbao_url='http://wx.hhr360.com/superparter/ui/registration.php?phone='.$_SESSION['phone'].'&invitation_code='.$_SESSION['invitation_code'];
$imgUrl='http://wx.hhr360.com/superparter/images/registration_01.jpg';
require_once "../lib/jssdk.php";
$jssdk = new JSSDK("wx2cb9e95c3605cabb","a66790ca61660bd3647acbe460b0c372");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name=“viewport” content=“width=device-width; initial-scale=1.0”>
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <meta content="超级合伙人,超级合伙人联盟,MOM" name=keywords />
    <script src="../jquery/jquery-1.11.0.js"></script>
    <link rel="stylesheet" href="../css/app_success.css" type="text/css" media="all"/>
    <title>超级合伙人-报名成功</title>
</head>
<body>
    <div class="app-wrapper">
        <div class="yinying"></div>
        <div class="jiantou"><img src="../images/jiantou.png"></div>
        <div class="app-content">
            <div class="app-txt">
                <?php echo $message; ?>
            </div>
            <div id="aapbtn" class="aapbtn">
                <p id="btntxt">先生/女士，你已成功报名，比赛详细信息已短信发送至您的手机,请注意查收！</p>
                <p id="btntxt1">“邀请好友参赛可赢取大奖！”</p>
            </div>
            <div class="appa" id="appa">
                <div class="appa_btn">
                     <a href="#" id="friend">邀请好友参会</a>
                    <a href="http://www.ih5.cn/idea/zP4VEDT" id="indx">返回首页</a>
                    <input type="hidden" value="0" class="number">
                </div>
                <p><img src="../images/footer.png"></p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var p1=document.getElementById('aapbtn');
        p1.style.top=(document.body.clientWidth*0.2)+"px";

        var p2=document.getElementById('appa');
        p2.style.top=(document.body.clientWidth*0.8)+"px";

        var p3=document.getElementById('btntxt1');
        var p4=document.getElementById('btntxt');
        p3.style.fontSize=(document.body.clientWidth*0.04)+"px";
        p4.style.fontSize=(document.body.clientWidth*0.04)+"px";

        var p5=document.getElementById('friend');
        var p6=document.getElementById('indx');
        p5.style.fontSize=(document.body.clientWidth*0.04)+"px";
        p6.style.fontSize=(document.body.clientWidth*0.04)+"px";

        $(".jiantou").hide();
        $(".yinying").hide();
        $(document).ready(function(){
            $("#friend").bind("click",function(){
                if($(".number").val()==0) {
                    $(".jiantou").show();
                    $(".yinying").show();
                    $(".number").val(1);
                }else if($(".number").val()==1){
                    $(".jiantou").hide();
                    $(".yinying").hide();
                    $(".number").val(0);
                }
            });
        });
    </script>
   <script type="text/javascript">
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：h/ttp://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
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
        title: "一段百万富翁的变身之旅即将开始，Are You Ready?", // 分享标题
        desc: "一段百万富翁的变身之旅即将开始，Are You Ready?",
        link:"<?php echo $hongbao_url;?>",
        imgUrl: "<?php echo $imgUrl;?>" // 分享图标
    });
    // 获取“分享给朋友”按钮点击状态及自定义分享内容接口
    wx.onMenuShareAppMessage({
        title: "一段百万富翁的变身之旅即将开始，Are You Ready?", // 分享标题
        desc: "一段百万富翁的变身之旅即将开始，Are You Ready?", // 分享描述
        link:"<?php echo $hongbao_url;?>",
        imgUrl: "<?php echo $imgUrl;?>", // 分享图标
        type: 'link', // 分享类型,music、video或link，不填默认为link
    });
  });
</script>	
</body>
</html>
