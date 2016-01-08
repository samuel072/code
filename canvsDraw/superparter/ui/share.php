<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  
    <div class="lbox_close wxapi_form">
      <h3 id="menu-share">Share</h3>
      <span class="desc">åˆ†äº«åˆ°æœ‹å‹åœˆ</span>
      <br><button class="btn btn_primary" id="onMenuShareTimeline">onMenuShareTimeline</button>
      <br><span class="desc">åˆ†äº«ç»™æœ‹å‹</span>
      <br><button class="btn btn_primary" id="onMenuShareAppMessage">onMenuShareAppMessage</button>
      <br><span class="desc">åˆ†äº«åˆ°QQ</span>
      <br><button class="btn btn_primary" id="onMenuShareQQ">onMenuShareQQ</button>
      <br><span class="desc">åˆ†äº«åˆ°å¾®åš</span>
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
        // ×¢Òâ£ºÕâÀïĞèÒª½«»ñÈ¡µ½µÄtoken»º´æÆğÀ´£¨»òĞ´µ½Êı¾İ¿âÖĞ£©
        // ²»ÄÜÆµ·±µÄ·ÃÎÊhttps://api.weixin.qq.com/cgi-bin/token£¬Ã¿ÈÕÓĞ´ÎÊıÏŞÖÆ
        // Í¨¹ı´Ë½Ó¿Ú·µ»ØµÄtokenµÄÓĞĞ§ÆÚÄ¿Ç°Îª2Ğ¡Ê±¡£ÁîÅÆÊ§Ğ§ºó£¬JS-SDKÒ²¾Í²»ÄÜÓÃÁË¡£
        // Òò´Ë£¬ÕâÀï½«tokenÖµ»º´æ1Ğ¡Ê±£¬±È2Ğ¡Ê±Ğ¡¡£»º´æÊ§Ğ§ºó£¬ÔÙ´Ó½Ó¿Ú»ñÈ¡ĞÂµÄtoken£¬ÕâÑù
        // ¾Í¿ÉÒÔ±ÜÃâtokenÊ§Ğ§¡£
        // S()ÊÇThinkPhpµÄ»º´æº¯Êı£¬Èç¹ûÊ¹ÓÃµÄÊÇ²»ThinkPhp¿ò¼Ü£¬¿ÉÒÔÊ¹ÓÃÄãµÄ»º´æº¯Êı£¬»òÊ¹ÓÃÊı¾İ¿âÀ´±£´æ¡£
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
        // ×¢Òâ£ºÕâÀïĞèÒª½«»ñÈ¡µ½µÄticket»º´æÆğÀ´£¨»òĞ´µ½Êı¾İ¿âÖĞ£©
        // ticketºÍtokenÒ»Ñù£¬²»ÄÜÆµ·±µÄ·ÃÎÊ½Ó¿ÚÀ´»ñÈ¡£¬ÔÚÃ¿´Î»ñÈ¡ºó£¬ÎÒÃÇ°ÑËü±£´æÆğÀ´¡£
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
// Î¢ĞÅÅäÖÃ
wx.config({
    debug: false, 
    appId: "wx2cb9e95c3605cabb", 
    timestamp: '<?php echo $timestamp;?>', 
    nonceStr: '<?php echo $wxnonceStr;?>', 
    signature: '<?php echo $wxSha1;?>',
    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] // ¹¦ÄÜÁĞ±í£¬ÎÒÃÇÒªÊ¹ÓÃJS-SDKµÄÊ²Ã´¹¦ÄÜ
});
// configĞÅÏ¢ÑéÖ¤ºó»áÖ´ĞĞready·½·¨£¬ËùÓĞ½Ó¿Úµ÷ÓÃ¶¼±ØĞëÔÚconfig½Ó¿Ú»ñµÃ½á¹ûÖ®ºó£¬configÊÇÒ»¸ö¿Í»§¶ËµÄÒì²½²Ù×÷£¬ËùÒÔÈç¹ûĞèÒªÔÚ Ò³Ãæ¼ÓÔØÊ±¾Íµ÷ÓÃÏà¹Ø½Ó¿Ú£¬ÔòĞë°ÑÏà¹Ø½Ó¿Ú·ÅÔÚreadyº¯ÊıÖĞµ÷ÓÃÀ´È·±£ÕıÈ·Ö´ĞĞ¡£¶ÔÓÚÓÃ»§´¥·¢Ê±²Åµ÷ÓÃµÄ½Ó¿Ú£¬Ôò¿ÉÒÔÖ±½Óµ÷ÓÃ£¬²»ĞèÒª·ÅÔÚready º¯ÊıÖĞ¡£
wx.ready(function(){
    // è·å–â€œåˆ†äº«åˆ°æœ‹å‹åœˆâ€æŒ‰é’®ç‚¹å‡»çŠ¶æ€åŠè‡ªå®šä¹‰åˆ†äº«å†…å®¹æ¥å£
    wx.onMenuShareTimeline({
        title: 'åˆ†äº«æ ‡é¢˜', // åˆ†äº«æ ‡é¢˜
        link:"http://gotiku.sinaapp.com/superpartner/ui/hongbao.php",
        imgUrl: "http://gotiku.sinaapp.com/superpartner/images/hongbao_part1.png" // åˆ†äº«å›¾æ ‡
    });
    // è·å–â€œåˆ†äº«ç»™æœ‹å‹â€æŒ‰é’®ç‚¹å‡»çŠ¶æ€åŠè‡ªå®šä¹‰åˆ†äº«å†…å®¹æ¥å£
    wx.onMenuShareAppMessage({
        title: 'åˆ†äº«æ ‡é¢˜', // åˆ†äº«æ ‡é¢˜
        desc: "åˆ†äº«æè¿°", // åˆ†äº«æè¿°
        link:"http://gotiku.sinaapp.com/superpartner/ui/hongbao.php",
        imgUrl: "http://gotiku.sinaapp.com/superpartner/images/hongbao_part1.png", // åˆ†äº«å›¾æ ‡
        type: 'link', // åˆ†äº«ç±»å‹,musicã€videoæˆ–linkï¼Œä¸å¡«é»˜è®¤ä¸ºlink
    });
});
</script>
<script src="../jquery/demo.js"> </script>
</body>
</html>