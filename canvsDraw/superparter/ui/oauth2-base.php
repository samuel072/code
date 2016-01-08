<?php
session_start();
require_once(dirname(__FILE__).'/../lib/lib.php');
$jssdk = new JSSDK("wx2cb9e95c3605cabb","a66790ca61660bd3647acbe460b0c372");
$res = $jssdk->getUserInfoByCode($_REQUEST['code']);
echo $res;
?>