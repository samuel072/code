<?php
require_once(dirname(__FILE__).'/../lib/lib.php');
$phone = $_REQUEST['cell-number'];
$invitation_code = $_REQUEST['invitation_code'];
$invitation_nickName = $_REQUEST['invitation_nickName'];

if(!$phone){ // 没有电话号码{ 
  require_once('./app_sign.php');
}else{ // 有电话号码
	// 检查是否注册过
	$re = SuperAPI::isRegister($phone);
	if($re['is_success'] == 1){ // 已经被注册过
		// 检测是否报名
		$isFalg = SuperAPI::isRegistration($phone, '771');
		$_SESSION['phone'] = $isFalg['phone'];
		$_SESSION['invitation_code'] = $isFalg['invite_code'];
		if($isFalg['is_success'] == 1){ // 没有参加
			echo $message;
			require_once("./app_sign.php");
		}else{ // 已经报名啦
			$message = "已经报名啦";
			echo $message;
			require_once("./share_re.php");
		}
	}else{
		require_once("./app_sign.php");
	}
}
