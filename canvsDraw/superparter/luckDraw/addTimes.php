<?php
require_once(dirname(__FILE__).'/../lib/LuckDrawAPI.php');

$userId = $_REQUEST['userId'];

$result = LuckDrawAPI::addTimes($userId);
$arr = array("status"=>$result['is_success'], "message"=>$result['message']);
echo json_encode($arr);
