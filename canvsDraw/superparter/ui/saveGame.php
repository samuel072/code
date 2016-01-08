<?php
require_once(dirname(__FILE__).'/../lib/lib.php');
$phone = "15810128531";
if(isset($_REQUEST['cell-number'])){
	$phone = $_REQUEST['cell-number'];
}
$invitation_code='365854319437';
if(isset($_REQUEST['inviteCode'])){
	$invitation_code = $_REQUEST['inviteCode'];
}
// 是否已经注册过
$re = SuperAPI::isRegister($phone);
if($re['is_success'] == 1){ // 已经被注册过
	// 检测是否报名
	$isFalg = SuperAPI::isRegistration($phone, '771');
	$_SESSION['phone'] = $isFalg['phone'];
	$_SESSION['invitation_code'] = $isFalg['invite_code'];
	if($isFalg['is_success'] == 1){ // 没有参加
		//调用报名的接口
		$ss = SuperAPI::saveGame($phone, '771');
		if($ss['is_success'] == 1){
			$message = "报名成功";
			require_once("./share_re.php");
		}else {
			require_once("./app_sign.php");
		}
	}else{ // 已经报名啦
		$message = "已经报名啦";
		require_once("./share_re.php");
	}
}else if($re['is_success'] == 2){ // 没有被注册过
	$ret=SuperAPI::fastRegister($phone,$invitation_code);
	if($ret['is_success'] == 1){ // 注册成功
		$_SESSION['phone'] = $ret['phone'];
		$_SESSION['invitation_code'] = $ret['invite_code'];
		// 发钱
		//$result = SuperAPI::appRegisterIncome($phone);
		// 报名
		//调用报名的接口
		$ss = SuperAPI::saveGame($phone, '771');
		if($ss['is_success'] == 1){
			$message = "报名成功";
			require_once("./share_re.php");
		}else {
			require_once("./app_sign.php");
		}
		$message="报名成功";
		require_once("./share_re.php");
	}else{ // 出现异常 等等
		echo "出现异常啦!  但是我也不知道是恩么回事";
		require_once("./app_sign.php");
	}
}else{
	echo "注册失败!";
	require_once("./app_sign.php");
}
?>
