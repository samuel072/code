<?php
// 分享后的action
// 增加一次抽奖机会

require_once(dirname(__FILE__).'/../lib/LuckDrawAPI.php');

/*验证是否是有资格添加机会*/
$ret = LuckDrawAPI::isIncrease($userId);
// Increase times
LuckDrawAPI::Increase();