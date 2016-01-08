<?php
// 获取中奖人的名单
require_once '../config.php';
require_once (filePath("lib/LuckDrawAPI.php"));

$result = LuckDrawAPI::getDrawInfo();

if($result['is_success'] == 1) {
	$ret = $result['drawList'];
	require_once (filePath("luckDraw/ui/getDrawInfo.php"));
}else {
	echo $result['message'];
}



