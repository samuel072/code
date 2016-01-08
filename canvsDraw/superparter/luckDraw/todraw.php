<?php
require_once(dirname(__FILE__).'/../lib/LuckDrawAPI.php');
require_once(dirname(__FILE__).'/draw.php');
$userId = $_REQUEST['userId'];

$result = LuckDrawAPI::todraw($userId);
if($result['is_success'] == 1){
  $drawNum = $result['draw_num'];
  if($drawNum > 0 && $drawNum < 3){
    $drawList = draw();
    require_once(dirname(__FILE__).'/ui/draw.php');
  }else {
    $message = "你已经没有抽奖机会了";
    require_once(dirname(__FILE__).'/ui/index.php');
  }
}else {
  $message = $result['message'];
  require_once(dirname(__FILE__).'/ui/index.php');
}
