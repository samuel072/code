<?php
/***************************************************************************
 *
 * Copyright (c) 2014 iyunxiao.joyschool.cn, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file 
 * @author cuijianwei(cui.jw@163.com)
 * @date 2015/08/05
 * @version $Revision: 1.0
 * @brief
 *
 **/
require_once(dirname(__FILE__).'/Curl.class.php');
class SuperAPI { 
    //渠道标识
    private static $channel_code = "C04";
	//接口密码
	private static $api_key = "Bm/zUjuyDy5qFgBD";
	//DES加密秘钥
	private static $key="sZaxdMTB";
    public static function toStr($bytes) {  
        $str = '';  
        foreach($bytes as $ch) {
            $str .= chr($ch);  
        }  
		return $str;  
    }
	//加密参考方法：
	public static function sign($sign_str="")
	{
		if($sign_str=="")
		    $sign_str=self::$channel_code.md5(self::$api_key).date("Y-m-dH:i:s").chr(3).chr(3).chr(3);
		//$sign_str='C04d893dd244935ae9e535787f7ee0d69e72015-08-0508:37:13';
		return urlencode(self::do_mencrypt($sign_str,self::$key));
	}
	//php中有一个扩展可以支持DES的加密算法，是：extension=php_mcrypt.dll
	//在配置文件中将这个扩展打开还不能够在windows环境下使用需要将PHP文件夹下的 libmcrypt.dll 拷贝到系统的 system32 目录下
    //$input - stuff to decrypt
    //$key - the secret key to use
    public static function do_mencrypt($input, $key)
    {
		$iv_arr = array(0x12, 0x34, 0x56, 0x78, 0x90, 0xab, 0xcd, 0xef);
		$iv = self::toStr($iv_arr);
        $td = mcrypt_module_open('des', '', 'cbc', '');
        //$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $encrypted_data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return trim(chop(base64_encode($encrypted_data)));
    }

    //$input - stuff to decrypt
    //$key - the secret key to use
    public static function do_mdecrypt($input, $key)
    {
        $iv_arr = array(0x12, 0x34, 0x56, 0x78, 0x90, 0xab, 0xcd, 0xef);
		$iv = self::toStr($iv_arr);
        $input = trim(chop(base64_decode($input)));
        $td = mcrypt_module_open('des', '', 'cbc', '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $decrypted_data = mdecrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return trim(chop($decrypted_data));
    }

	public static $g_host="http://localhost:8080/index_service/";
	//public static $g_host="http://123.57.204.123:9090/index_service/";
	//public static $g_host="http://hhr360.com/index_service/";
	public static $g_index_map=array(
        'id'=>'会员ID',
        'user_name'=>'会员名称',
        'phone'=>'手机号',
        'card_number'=>'卡号',
		'is_marriage'=>'是否已婚',
		'max_degree'=>'最高学历',
		'position_name'=>'职位',
        'is_check_card'=>'是否验证',
        'user_avatar'=>'头像',
        'account_name'=>'账户名称',
		'nick_name'=>'昵称',
		'live_address'=>'地址',
		'live_address'=>'地址',
        'email'=>'email',
		'gender'=>'性别',
		'salary'=>'薪资',
		'daily_income'=>'日增收益',
		'introduction'=>'介绍',
		'business_type'=>'业务类型',
        'firstly_partner_num'=>'下级合伙人数',
        'charges_return_coefficient'=>'返还系数A项',
        'extend_person_new'=>'今日新增',
        'hhr_level'=>'等级',
        'secondary_partner_num'=>'下级合伙人数(间接)',
        'total_income'=>'总收益',
        'interest_return_coefficient'=>'返还系数B项',
        'monthly_income'=>'本月收益',
	);
	public static function is_mobile($phone)
	{
	//	return preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|18[0-9]{9}$/",$phone);
                return preg_match("/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/", $phone);
	}
	public static function register($phone,$invitation_code="",$password="",$nickName="",$phoneCode="")
	{
		//define return body
		$ret=array('is_success'=>0,'message'=>'');
		if(!self::is_mobile($phone)){
			$ret['message']="手机号错误";
			return $ret;
		}
		if($invitation_code==""){
			$ret['message']="邀请码不能为空";
			return $ret;			
		}
		if($password==""){
			$password=substr($phone,strlen($phone)-6);			
		}		
		$url=self::$g_host."register.htm";
		$postdata=array(
			'phone'=>$phone,
			'password'=>md5($password),
			'nickName'=>$nickName,
			'phoneCode'=>$phoneCode,
			'invitation_code'=>$invitation_code,
			'reg_type'=>4,
			'sign'=>self::sign(),
		);
		//var_dump($postdata);
		$ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
		$ret=json_decode($ret_str,true);
		return $ret;
	}
	public static function fastRegister($phone,$invitation_code="")
	{
		//define return body
		$ret=array('is_success'=>0,'message'=>'');
		if(!self::is_mobile($phone)){
			$ret['message']="手机号错误";
			return $ret;
		}
		if($invitation_code==""){
			$ret['message']="邀请码不能为空";
			return $ret;			
		}
		if($password==""){
			$password=substr($phone,strlen($phone)-6);			
		}		
		$url=self::$g_host."fastRegister.htm";
		$postdata=array(
			'phone'=>$phone,
			'invitation_code'=>$invitation_code,
			'reg_type'=>4,
			'sign'=>self::sign(),
		);
		//var_dump($postdata);
		$ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
		$ret=json_decode($ret_str,true);
		return $ret;
	}
	public static function login($phone,$password)
	{
		$ret=array('is_success'=>0,'message'=>'');
		if(!self::is_mobile($phone)){
			$ret['message']="手机号错误";
			return $ret;
		}
		if($password==""){
			$ret['message']="密码不能为空";
			return $ret;			
		}		
		$url=self::$g_host."login.htm";
		$postdata=array(
			'phone'=>$phone,
			'password'=>md5($password),
			'sign'=>self::sign(),
		);
		$ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
		$ret=json_decode($ret_str,true);
		return $ret;
	}
	public static function weixinlogin($weixin_code)
	{
		$ret=array('is_success'=>0,'message'=>'');
		$phone="13567896789";
		$password="896789";
		if(!self::is_mobile($phone)){
			$ret['message']="手机号错误";
			return $ret;
		}
		if($password==""){
			$ret['message']="密码不能为空";
			return $ret;			
		}		
		$url=self::$g_host."login.htm";
		$postdata=array(
			'phone'=>$phone,
			'password'=>md5($password),
			'sign'=>self::sign(),
		);
		$ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
		$ret=json_decode($ret_str,true);
		return $ret;
	}
	public static function index($user_id="",$weixin_code="")
	{
		$ret=array('is_success'=>0,'message'=>'');
		if($user_id=="" && $weixin_code==""){
			$ret['message']="user_id和openid不能同时为空";
			return $ret;			
		}			
		$url=self::$g_host."index.htm";
		if($user_id!="")
		{
			$postdata=array(
				'user_id'=>$user_id,
				'sign'=>self::sign(),
			);
		}
		else
		{
			$postdata=array(
				'weixin_code'=>$weixin_code,
				'sign'=>self::sign(),
			);			
		}
		$ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
		$ret=json_decode($ret_str,true);
		return $ret;
	}
	// app绑定微信号
	public static function appBindWeixinCode($phone,$password,$weixinCode="",$type=1)
	{
		//$weixin_code="o7-Pdjk1JAG0pnz4jsxBqg9WNq1I";
		$ret=array('is_success'=>0,'message'=>'');
		if(!self::is_mobile($phone)){
			$ret['message']="手机号错误";
			return $ret;
		}
		if($password==""){
			$ret['message']="密码不能为空";
			return $ret;			
		}	
		if($weixinCode==""){
			$ret['message']="weixin_code不能为空";
			return $ret;			
		}		
		$url=self::$g_host."appBindWeixinCode.htm";
		$postdata=array(
			'phone'=>$phone,
			'password'=>md5($password),
			'weixinCode'=>$weixinCode,
			'type'=>$type,
			'sign'=>self::sign(),
		);
		//echo self::sign();
		$ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
		$ret=json_decode($ret_str,true);
		return $ret;
	}
	// 发送短信验证码
	public static function regPhoneCode($phone)
	{
		$ret=array('is_success'=>0,'message'=>'');
		if(!self::is_mobile($phone)){
			$ret['message']="手机号错误";
			return $ret;
		}		
		$url=self::$g_host."regPhoneCode.htm";
		$postdata=array(
			'phone'=>$phone,
			'sign'=>self::sign(),
		);
		$ret_str = Curl::mycurl($url, $postdata,NULL,NULL);
		$ret=json_decode($ret_str,true);
		return $ret;
	}	
    
	// 确认活动是否开启
    public static function queryRegisterActivity(){
        $url = self::$g_host."queryRegisterActivity.htm";
        $postdata=array(
            'sign'=>self::sign(),
        );

        $ret_str = Curl::mycurl($url, $postdata, NULL, NULL); 
        $ret = json_decode($ret_str, true);
        return $ret;
    }
	// 发钱
	public static function appRegisterIncome($phone){
		$url = self::$g_host."appRegisterIncome.htm";
		$postdata=array(
			'phone'=>$phone,
            'sign'=>self::sign(),
        );
		$ret_str = Curl::mycurl($url, $postdata, NULL, NULL); 
        $ret = json_decode($ret_str, true);
        return $ret;
	}
	
	//　检测用户是否已经注册过
	public static function isRegister($phone)
	{
		$url = self::$g_host."isRegister.htm";
		$postdata = array(
			'phone'=>$phone,
			'sign'=>self::sign()
		);
		$ret_str = Curl::mycurl($url, $postdata, NULL, NULL); 
        $ret = json_decode($ret_str, true);
        return $ret;
	}
	
	public static function isRegistration($phone, $gameId)
	{
		$url = self::$g_host."isRegistration.htm";
		$postdata = array(
			'phone'=>$phone,
			'gameId'=>$gameId,
			'sign'=>self::sign()
		);
		$ret_str = Curl::mycurl($url, $postdata, NULL, NULL); 
        $ret = json_decode($ret_str, true);
        return $ret;
	}
	
	public static function saveGame($phone, $gameId)
	{
		$url = self::$g_host."saveGame.htm";
		$postdata = array(
			'phone'=>$phone,
			'gameId'=>$gameId,
			'competition_num'=>2,
			'sign'=>self::sign()
		);
		$ret_str = Curl::mycurl($url, $postdata, NULL, NULL); 
        $ret = json_decode($ret_str, true);
        return $ret;
	}
	
	public static function sendCode($phone)
	{
		$url = self::$g_host."sendCode.htm";
		$postdata = array(
			'phone'=>$phone,
			'sign'=>self::sign()
		);
		$ret_str = Curl::mycurl($url, $postdata, NULL, NULL); 
        $ret = json_decode($ret_str, true);
        return $ret;
	}
}
?>
