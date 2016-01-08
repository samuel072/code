<?php
require_once(dirname(__FILE__).'/lib.php');
$phone="15888888888";
if(isset($_REQUEST['cell-number']))
{
	$phone=$_REQUEST['cell-number'];
}
$ret=register($phone);
//var_dump($ret);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/hongbao.css" type="text/css" media="all" />
<title>关于我们</title>
</head>

<body>
<img src="../images/about.png" style="width:100%;"></img>
<a href="tel:15888888888">一键拨打号码</a>
</body>



