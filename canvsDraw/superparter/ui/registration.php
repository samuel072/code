<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name=“viewport” content=“width=device-width; initial-scale=1.0”>
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta content="超级合伙人,超级合伙人联盟,MOM" name=keywords />
    <title>超级合伙人-报名</title>
	<link rel="stylesheet" href="../css/app_sign.css" type="text/css" media="all" />
	<script src="../jquery/jquery-1.11.0.js"></script>
	<style type="text/css">
		body{background:#E9484E;}
		.app-txt{position:relative; width:332px; margin: 0 auto; z-index:10;}
		a {width:100px; height:24px;}
		
		.reg_left_bt{position: absolute; border-radius: 12px; left:42px; bottom:16px;}
		.reg_right_bt{position: absolute; border-radius: 12px; left:178px; bottom:16px; }
	</style>
</head>
<body>
            <div class="app-txt">
				<img src="../images/registration.jpg" class="app-txtimg"/>
				<a class="reg_left_bt" href="javascript:void(0);"></a>
				<a class="reg_right_bt"href="javascript:void(0);"></a>
            </div>
			

	
	<script type="text/javascript">
		<?php
			$phone = $_REQUEST['phone'];
			$inviteCode = $_REQUEST['invitation_code'];
			$invitation_nickName = $_REQUEST['invitation_nickName'];
		?>
		var phone = "<?php echo $phone; ?>";
		var inviteCode = "<?php echo $inviteCode; ?>";
		var userName = "<?php echo $invitation_nickName; ?>";
		$(".reg_left_bt").click(function(){
			location.href="./invitePage.php?phone="+phone+"&invitation_code="+inviteCode+"&invitation_nickName="+userName;
		});
		$(".reg_right_bt").click(function(){
			location.href="./invitePage.php?phone="+phone+"&invitation_code="+inviteCode+"&invitation_nickName="+userName;
		});
	</script>
</body>
</html>
