<?php
require_once(dirname(__FILE__).'/../lib/LuckDrawAPI.php');

$userId = $_REQUEST['userId'];
$prizeId = $_REQUEST['prizeId'];

$result = LuckDrawAPI::minus($userId, $prizeId);
$arr = array("status"=>$result['is_success'], "drawNum"=>$result['drawNum']);
echo json_encode($arr);
?>