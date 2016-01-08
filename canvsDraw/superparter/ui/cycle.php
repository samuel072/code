<?php
session_start();
require_once(dirname(__FILE__).'/../lib/lib.php');
check_login_status();

$ret=SuperAPI::index($_SESSION['user_id']);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../css/hongbao.css" type="text/css" media="all" />
<title>个人信息</title>
</head>

<body>
<div id="circle" class="circle ">

</div>
<script type="text/javascript">
    var p1=document.getElementById('circle');
    p1.style.width=(document.body.clientWidth*0.3)+"px";
	p1.style.height=(document.body.clientWidth*0.3)+"px";
	p1.style.borderWidth=(document.body.clientWidth*0.05)+"px";
	
</script>
</body>