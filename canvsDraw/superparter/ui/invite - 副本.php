<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx2cb9e95c3605cabb","a66790ca61660bd3647acbe460b0c372");
$signPackage = $jssdk->GetSignPackage();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="../css/hongbao.css" type="text/css" media="all" />
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="../jquery/demo.js"> </script>
<title>�����н�</title>
</head>

<body>
<img src="../images/invite_part1.png" style="width:100%;"></img>
<!--img src="../images/invite_part2.png" style="width:100%;"></img-->

<div id="maindiv">
  <a href="http://www.hhr360.com/app"><img class="get_hongbao" src="../images/weixin_bt.png" style="margin-top:0%;width:50%"></img></a>
  <a href="http://www.hhr360.com/app"><img class="get_hongbao" src="../images/share_bt.png" style="margin-top:0%;width:50%"></img></a>
  
  <a href="http://www.hhr360.com/app"><img class="get_hongbao" src="../images/down_bt.png" style="margin-top:0%;"></img></a>
</div>
<img src="../images/hongbao_part3.png" style="width:100%;"></img>
<script type="text/javascript">
wx.config({
    debug: true, // ��������ģʽ,���õ�����api�ķ���ֵ���ڿͻ���alert��������Ҫ�鿴����Ĳ�����������pc�˴򿪣�������Ϣ��ͨ��log���������pc��ʱ�Ż��ӡ��
    appId: '', // ������ںŵ�Ψһ��ʶ
    timestamp: , // �������ǩ����ʱ���
    nonceStr: '', // �������ǩ���������
    signature: '',// ���ǩ��������¼1
    jsApiList: [] // �����Ҫʹ�õ�JS�ӿ��б�����JS�ӿ��б����¼2
});
wx.ready(function(){

    // config��Ϣ��֤���ִ��ready���������нӿڵ��ö�������config�ӿڻ�ý��֮��config��һ���ͻ��˵��첽���������������Ҫ��ҳ�����ʱ�͵�����ؽӿڣ��������ؽӿڷ���ready�����е�����ȷ����ȷִ�С������û�����ʱ�ŵ��õĽӿڣ������ֱ�ӵ��ã�����Ҫ����ready�����С�
});
wx.error(function(res){

    // config��Ϣ��֤ʧ�ܻ�ִ��error��������ǩ�����ڵ�����֤ʧ�ܣ����������Ϣ���Դ�config��debugģʽ�鿴��Ҳ�����ڷ��ص�res�����в鿴������SPA�������������ǩ����

});
wx.checkJsApi({
    jsApiList: ['chooseImage'], // ��Ҫ����JS�ӿ��б�����JS�ӿ��б����¼2,
    success: function(res) {
        // �Լ�ֵ�Ե���ʽ���أ����õ�apiֵtrue��������Ϊfalse
        // �磺{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
    }
});

wx.onMenuShareTimeline({
    title: '', // �������
    link: '', // ��������
    imgUrl: '', // ����ͼ��
    success: function () { 
        // �û�ȷ�Ϸ����ִ�еĻص�����
    },
    cancel: function () { 
        // �û�ȡ�������ִ�еĻص�����
    }
});


</script>
</body>
