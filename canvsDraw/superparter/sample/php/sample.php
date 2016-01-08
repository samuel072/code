<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx2cb9e95c3605cabb","a66790ca61660bd3647acbe460b0c372");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
    <div class="lbox_close wxapi_form">
      <h3 id="menu-share">Share</h3>
      <span class="desc">分享到朋友圈</span>
      <br><button class="btn btn_primary" id="onMenuShareTimeline">onMenuShareTimeline</button>
      <br><span class="desc">分享给朋友</span>
      <br><button class="btn btn_primary" id="onMenuShareAppMessage">onMenuShareAppMessage</button>
      <br><span class="desc">分享到QQ</span>
      <br><button class="btn btn_primary" id="onMenuShareQQ">onMenuShareQQ</button>
      <br><span class="desc">分享到微博</span>
      <br><button class="btn btn_primary" id="onMenuShareWeibo">onMenuShareWeibo</button>
	  </div>  
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
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
  wx.ready(function () {
	wx.checkJsApi({
      jsApiList: [
        'onMenuShareTimeline',
        'onMenuShareAppMessage'
      ],
      success: function (res) {
        alert(JSON.stringify(res));
      }
    });
    // 在这里调用 API
    wx.onMenuShareTimeline({
        title: '分享标题', // 分享标题
        link:"http://gotiku.sinaapp.com/superpartner/ui/hongbao.php",
        imgUrl: "http://gotiku.sinaapp.com/superpartner/images/hongbao_part1.png" // 分享图标
    });
    // 获取“分享给朋友”按钮点击状态及自定义分享内容接口
    wx.onMenuShareAppMessage({
        title: '分享标题', // 分享标题
        desc: "分享描述", // 分享描述
        link:"http://gotiku.sinaapp.com/superpartner/ui/hongbao.php",
        imgUrl: "http://gotiku.sinaapp.com/superpartner/images/hongbao_part1.png", // 分享图标
        type: 'link', // 分享类型,music、video或link，不填默认为link
    });
  });
</script>
  <script src="demo.js"> </script>
</html>
