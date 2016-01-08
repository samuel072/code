<?php
require_once(dirname(__FILE__).'/../lib/lib.php');
require_once(dirname(__FILE__).'/../lib/LuckDrawAPI.php');
require_once(dirname(__FILE__).'/draw.php');
/*
  抽奖注册
 */ 
// 默认的邀请码
$invitationCode = "13718202649";
//$invitationCode = "419213401112";
$phone = $_REQUEST['cell_number'];
$code = $_REQUEST['regcode'];

$result = SuperAPI::isRegister($phone);
if($result['is_success'] == 1) {  // 已经被注册过了, 
  $message = "该账号已经注册";
  require_once(dirname(__FILE__)."/ui/index.php");  // 返回注册页面
}else { // 没有被注册过
  // 正式注册
  $ret = LuckDrawAPI::register($phone, $invitationCode, $code);
  if($ret['is_success'] == 1){ // 注册成功
    $message = "恭喜您,注册成功";
    $userId = $ret['user_id'];
    $isNew = $ret['is_new'];
    if($isNew == 0) { // 新用户
        // 发钱
        $inCome = SuperAPI::appRegisterIncome($phone);
        $money = $inCome['money'];
        $drawList = array(
                        "imageUrl"=>'/superparter/images/sa_hb.png',
                        "rid"=>'4');
        require_once(dirname(__FILE__).'/ui/draw_m.php');
    }else {
        $drawList = draw();
        require_once(dirname(__FILE__).'/ui/draw.php');// 抽奖页面
    }
  }else {
    $message = $ret['message'];
    require_once(dirname(__FILE__)."/ui/index.php");  // 返回注册页面
  }
} 
