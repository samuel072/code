<?php
require_once(dirname(__FILE__).'/Curl.class.php');
require_once(dirname(__FILE__).'/SuperAPI.class.php');
class LuckDrawAPI{
  public static $g_host="http://localhost:8080/wxapi/";
  //public static $g_host="http://123.57.204.123:9090/wxapi/";
  //public static $g_host="http://hhr360.com/wxapi/";

  //发送验证码短信
  public static function sendCode($phone){
    $ret=array('is_success'=>0,'message'=>'');
    if(!$phone){
      $ret['message']="手机号码不能为空";
      return $re;
    }

    $url = self::$g_host."sendCode.htm";

    $postdata = array(
      "phone"=>$phone,
      "sign"=>SuperAPI::sign()
    );

    $ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
    $ret=json_decode($ret_str,true);
    return $ret;
  }

  // 注册
  public static function register($phone, $invitationCode, $code){
    $ret=array('is_success'=>0,'message'=>'');
    if(!$phone){
      $ret['message']="手机号码不能为空";
      return $re;
    }

    if(!$code){
      $ret['message']="注册码不能为空";
      return $re;
    }

    $url = self::$g_host."register.htm";
    $postdata = array(
      "phone"=>$phone,
      "invitationCode"=>$invitationCode,
      "code"=>$code,
      "reg_type"=>4,
      "sign"=>SuperAPI::sign()
    );
    $ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
    $ret=json_decode($ret_str,true);
    return $ret;
  }

/**
 *  登陆 
 */
  public static function login($phone, $password){
    $ret=array('is_success'=>0,'message'=>'');
    if(!$phone){
      $ret['message']="手机号码不能为空";
      return $re;
    }

    if(!$password){
      $ret['message']="登陆密码不能为空";
      return $re;
    }

    $password = md5($password);
    $url = self::$g_host."login.htm";
    $postdata = array(
      "phone"=>$phone,
      "password"=>$password,
      "sign"=>SuperAPI::sign()
    );

    $ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
    $ret=json_decode($ret_str,true);
    return $ret; 
  }

// 减少一次机会
  public static function minus($userId, $prizeId) {
    $ret=array('is_success'=>0,'message'=>'');
    if(!$userId){
      $ret['message']="用户不存在";
      return $re;
    }

    if(!$prizeId){
      $ret['message']="奖品不存在";
      return $re;
    }

    $url = self::$g_host."minus.htm";
    $postdata = array(
      "userId"=>$userId,
      "prizeId"=>$prizeId,
      "sign"=>SuperAPI::sign()
    );

    $ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
    $ret=json_decode($ret_str, true);
    return $ret; 

  }

// 添加一次机会
  public static function addTimes($userId) {
    $ret=array('is_success'=>0,'message'=>'');
    if(!$userId){
      $ret['message']="用户不存在";
      return $re;
    }

    $url = self::$g_host."addTimes.htm";
    $postdata = array(
      "userId"=>$userId,
      "sign"=>SuperAPI::sign()
    );

    $ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
    $ret=json_decode($ret_str, true);
    return $ret; 
  }

// 抽奖后 分享调转到抽奖页
  public static function todraw($userId) {
    $ret=array('is_success'=>0,'message'=>'');
    if(!$userId){
      $ret['message']="用户不存在";
      return $re;
    }

    $url = self::$g_host."todraw.htm";
    $postdata = array(
      "userId"=>$userId,
      "sign"=>SuperAPI::sign()
    );

    $ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
    $ret=json_decode($ret_str, true);
    return $ret; 
  }

// 保存中奖信息
  public static function saveInfo($userName, $phone, $address, $drawName) {
    $ret = array('is_success'=>0, 'message'=>'');
    if(!$userName){
      $ret['message']="用户名称不能为空";
	  return $ret;
    }
	if(!$phone){
      $ret['message']="电话不能为空";
	  return $ret;
    }
	if(!$address){
      $ret['message']="地址不能为空";
	  return $ret;
    }
	
	$url = self::$g_host."saveInfo.htm";
	$postdata=array(
	  "userName"=>$userName,
	  "phone"=>$phone,
	  "address"=>$address,
          "drawName"=>$drawName,
	  "sign"=>SuperAPI::sign()
	);
	
	$ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
    $ret=json_decode($ret_str, true);
    return $ret;
  }

  // 查询该用户的中奖信息
  public static function drawInfo($userId) {
   	$ret = array('is_success'=>0, 'message'=>'');
    if(!$userId){
      $ret['message']="用户不能为空";
      return $ret;
    }

    $url = self::$g_host."drawInfo.htm";
    $postdata=array(
      "userId"=>$userId,
      "sign"=>SuperAPI::sign()
    );
  
    $ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
    $ret=json_decode($ret_str, true);
    return $ret;
  }
  
  // 查询所有中奖用户的信息
  public static function getDrawInfo() {
  	$ret = array('is_success'=>0, 'message'=>'');
  	$url = self::$g_host."getDrawInfo.htm";
    $postdata=array(
      "sign"=>SuperAPI::sign()
    );
  
    $ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
    $ret=json_decode($ret_str, true);
    return $ret;
  }
  
}
?>
