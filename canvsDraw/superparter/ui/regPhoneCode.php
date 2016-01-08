<?php
session_start();
require_once(dirname(__FILE__).'/../lib/lib.php');
$phone="";
if(isset($_REQUEST['phone']))
{
	$phone=$_REQUEST['phone'];
}
$ret=SuperAPI::regPhoneCode($phone);
echo json_encode($ret);
?>