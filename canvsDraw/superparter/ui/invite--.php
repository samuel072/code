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
<title>�����н�</title>
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
   * ע�⣺
   * 1. ���е�JS�ӿ�ֻ���ڹ��ںŰ󶨵������µ��ã����ںſ�������Ҫ�ȵ�¼΢�Ź���ƽ̨���롰���ں����á��ġ��������á�����д��JS�ӿڰ�ȫ��������
   * 2. ��������� Android ���ܷ����Զ������ݣ��뵽�����������µİ����ǰ�װ��Android �Զ������ӿ��������� 6.0.2.58 �汾�����ϡ�
   * 3. �������⼰���� JS-SDK �ĵ���ַ��http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * ������������������ĵ�����¼5-�������󼰽���취�����������δ�ܽ����ͨ����������������
   * �����ַ��weixin-open@qq.com
   * �ʼ����⣺��΢��JS-SDK��������������
   * �ʼ�����˵�����ü��������������������ڣ��������������������ĳ������ɸ��Ͻ���ͼƬ��΢���Ŷӻᾡ�촦����ķ�����
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
