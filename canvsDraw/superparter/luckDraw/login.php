<?php
// 登陆页面
require_once(dirname(__FILE__).'/../lib/LuckDrawAPI.php');
require_once(dirname(__FILE__).'/draw.php');
$phone = $_REQUEST['cell_number'];
$password = $_REQUEST['password'];

$ret = LuckDrawAPI::login($phone, $password);

 if($ret['is_success'] == 1) {  // 登陆成功
   if($ret['draw_num'] > 0 && $ret['draw_num'] < 3){ // 可以抽奖
      $userId = $ret['user_id'];
      $drawList = draw();
      require_once(dirname(__FILE__).'/ui/draw.php'); // 抽奖页面
   
  }else {  // 没有分享机会
     // "您一共已经用掉2次抽奖机会了";
      //require_once(dirname(__FILE__).'/ui/draw.php'); //  分享页面 但是没有抽奖机会
      $message = "您已经没有机会抽奖了";
      require_once(dirname(__FILE__).'/ui/login.php'); // 登陆页面
  }
  

}else {  // 登陆失败
  $message = $ret['message'];
  // echo "$message";
 require_once(dirname(__FILE__).'/ui/login.php'); // 登陆页面
}
