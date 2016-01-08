<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx2cb9e95c3605cabb","a66790ca61660bd3647acbe460b0c372");
$signPackage = $jssdk->GetSignPackage();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/hongbao.css" type="text/css" media="all" />
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="../jquery/demo.js"> </script>
<title>邀请有奖</title>
</head>

<body>
<img src="../images/invite_part1.png" style="width:100%;"></img>
<!--img src="../images/invite_part2.png" style="width:100%;"></img-->

<div id="maindiv">
  <img id="onMenuShareAppMessage" class="get_hongbao" src="../images/weixin_bt.png" style="margin-top:0%;width:50%"></img>
  <img id="onMenuShareTimeline" class="get_hongbao" src="../images/share_bt.png" style="margin-top:0%;width:50%"></img>
  
  <a href="http://www.hhr360.com/app"><img class="get_hongbao" src="../images/down_bt.png" style="margin-top:0%;"></img></a>
</div>
<img src="../images/hongbao_part3.png" style="width:100%;"></img>
<script type="text/javascript">
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
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

</script>
</body>
