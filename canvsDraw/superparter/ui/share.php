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

<?php
function wx_get_token() {
    $token = S('access_token');
    if (!$token) {
        $res = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx2cb9e95c3605cabb&secret=a66790ca61660bd3647acbe460b0c372');
        $res = json_decode($res, true);
        $token = $res['access_token'];
		$token = 'dt9jj6DWZg4ahUro9IbQiDfqZX7u38TSYTLdeSIWaaYSJyuyz2a-FS9FBQK3z0ehovhktcAOMqybsob72N506PAXL0jx-9dcqgXTw9a6hOQ';
        // ע�⣺������Ҫ����ȡ����token������������д�����ݿ��У�
        // ����Ƶ���ķ���https://api.weixin.qq.com/cgi-bin/token��ÿ���д�������
        // ͨ���˽ӿڷ��ص�token����Ч��ĿǰΪ2Сʱ������ʧЧ��JS-SDKҲ�Ͳ������ˡ�
        // ��ˣ����ｫtokenֵ����1Сʱ����2СʱС������ʧЧ���ٴӽӿڻ�ȡ�µ�token������
        // �Ϳ��Ա���tokenʧЧ��
        // S()��ThinkPhp�Ļ��溯�������ʹ�õ��ǲ�ThinkPhp��ܣ�����ʹ����Ļ��溯������ʹ�����ݿ������档
        S('access_token', $token, 3600);
    }
    return $token;
}
function wx_get_jsapi_ticket(){
    $ticket = "";
    do{
        //$ticket = S('wx_ticket');
        //if (!empty($ticket)) {
        //    break;
        //}
        //$token = S('access_token');
        //if (empty($token)){
        //    wx_get_token();
        //}
		$token = '-JORMouoY866CPfdE3g-wsjZmMnGpoUWIvkuY5J5wJFRZWF5AUpE62n6MM0rn0nTaInedql1Njg2DK7OT6KEHquAq5z7b32AGvjNb71WNQ0';
        //$token = S('access_token');
        if (empty($token)) {
            logErr("get access token error.");
            break;
        }
        $url2 = sprintf("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi",
            $token);
		echo $url2;
        $res = file_get_contents($url2);
        $res = json_decode($res, true);
        $ticket = $res['ticket'];
        // ע�⣺������Ҫ����ȡ����ticket������������д�����ݿ��У�
        // ticket��tokenһ��������Ƶ���ķ��ʽӿ�����ȡ����ÿ�λ�ȡ�����ǰ�������������
        //S('wx_ticket', $ticket, 3600);
    }while(0);
    return $ticket;
}
            $timestamp = time();
            $wxnonceStr = "superpartner";
            //$wxticket = wx_get_jsapi_ticket();
			$wxticket = "bxLdikRXVbTPdHSM05e5uwjLVoiRZTqof1he-mlIBC1otq0M7PNL3CwaQgg_p4z2Sm98iQrai3ln1bm-1SEPRA";
			//echo $wxticket;
            $wxOri = sprintf("jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s",
                $wxticket, $wxnonceStr, $timestamp,
                'http://gotiku.sinaapp.com/superpartner/ui/share.php'
                );
           $wxSha1 = sha1($wxOri);
?>

<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
// ΢������
wx.config({
    debug: false, 
    appId: "wx2cb9e95c3605cabb", 
    timestamp: '<?php echo $timestamp;?>', 
    nonceStr: '<?php echo $wxnonceStr;?>', 
    signature: '<?php echo $wxSha1;?>',
    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] // �����б�����Ҫʹ��JS-SDK��ʲô����
});
// config��Ϣ��֤���ִ��ready���������нӿڵ��ö�������config�ӿڻ�ý��֮��config��һ���ͻ��˵��첽���������������Ҫ�� ҳ�����ʱ�͵�����ؽӿڣ��������ؽӿڷ���ready�����е�����ȷ����ȷִ�С������û�����ʱ�ŵ��õĽӿڣ������ֱ�ӵ��ã�����Ҫ����ready �����С�
wx.ready(function(){
    // 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
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
<script src="../jquery/demo.js"> </script>
</body>
</html>