<?php
require_once(dirname(__FILE__).'/../lib/LuckDrawAPI.php');
//  获取抽奖人的信息
$userId = $_REQUEST['userId'];

$result = LuckDrawAPI::drawInfo($userId);

$arr = array("status"=>$result['is_success'], "drawNum"=>$result['drawNum'], "prizeId"=>$result['prizeId']);

echo json_encode($arr);
?>