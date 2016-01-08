<?php
require_once(dirname(__FILE__).'/../lib/LuckDrawAPI.php');

// save user info 
$phone = $_REQUEST['cell_number'];
$userName = $_REQUEST['cell_name'];
$address = $_REQUEST['addAddress'];
$drawName = $_REQUEST['drawName'];
$result = LuckDrawAPI::saveInfo($userName, $phone, $address, $drawName);

if($result['is_success'] == 1){
  $userId = $result['userId'];
  require_once(dirname(__FILE__).'/ui/success.php');
}


?>