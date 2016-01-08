<?php
require_once(dirname(__FILE__).'/../lib/LuckDrawAPI.php');

$phone=$_REQUEST['phone'];
$ret = LuckDrawAPI::sendCode($phone);
echo json_encode($ret);
?>