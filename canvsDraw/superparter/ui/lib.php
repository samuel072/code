<?php
require_once(dirname(__FILE__).'/Curl.class.php');

function register($phone)
{
    $url="http://61.183.149.170:19090/services/AppWebService?register";	
	$url="http://61.183.149.170:19090/index_service/register.htm";
	//$url="http://localhost/superparter/ui/test.php";
	$postdata=array(
	    'phone'=>$phone+1,
		'password'=>md5(substr($phone,strlen($phone)-6)),
		'nickName'=>'',
		'phoneCode'=>'',
		'invitation_code'=>'193480301788',
		'reg_type'=>4,
	);
	//var_dump($postdata);
	//echo "<br>";
	$ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
	//echo $ret_str."<br>";
	$ret=json_decode($ret_str,true);
	return $ret;
}

?>