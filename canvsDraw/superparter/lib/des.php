<?php
/**
 * 
 * DES FOR .NET版本
 * @author Administrator
 *
 */
 require_once(dirname(__FILE__).'/SuperAPI.class.php');
 echo SuperAPI::sign()."<br>";
class DES_NET{
    var $key;
    var $iv; //偏移量
     
    function DES_NET( $key, $iv=0 ) {
    //key长度8例如:1234abcd
        $this->key = $key;
        if( $iv == 0 ) {
            $this->iv = $key; //默认以$key 作为 iv
        } else {
            $this->iv = $iv; //mcrypt_create_iv ( mcrypt_get_block_size (MCRYPT_DES, MCRYPT_MODE_CBC), MCRYPT_DEV_RANDOM );
        }
    }
     
    function encrypt($str) {
    //加密，返回大写十六进制字符串
        $size = mcrypt_get_block_size ( MCRYPT_DES, MCRYPT_MODE_CBC );
        $str = $this->pkcs5Pad ( $str, $size );
        return strtoupper( bin2hex( mcrypt_cbc(MCRYPT_DES, $this->key, $str, MCRYPT_ENCRYPT, $this->iv ) ) );
    }
     
    function decrypt($str) {
    //解密
        $strBin = $this->hex2bin( strtolower( $str ) );
        $str = mcrypt_cbc( MCRYPT_DES, $this->key, $strBin, MCRYPT_DECRYPT, $this->iv );
        $str = $this->pkcs5Unpad( $str );
        return $str;
    }
     
    function hex2bin($hexData) {
        $binData = "";
        for($i = 0; $i < strlen ( $hexData ); $i += 2) {
            $binData .= chr ( hexdec ( substr ( $hexData, $i, 2 ) ) );
        }
        return $binData;
    }
 
    function pkcs5Pad($text, $blocksize) {
        $pad = $blocksize - (strlen ( $text ) % $blocksize);
        return $text . str_repeat ( chr ( $pad ), $pad );
    }
     
    function pkcs5Unpad($text) {
        $pad = ord ( $text {strlen ( $text ) - 1} );
        if ($pad > strlen ( $text ))
            return false;
        if (strspn ( $text, chr ( $pad ), strlen ( $text ) - $pad ) != $pad)
            return false;
        return substr ( $text, 0, - 1 * $pad );
    }
     
}
/**
 * 
 * DES JAVA版本
 * @author Administrator
 *
 */
class DES_JAVA{
	var $key;	
	function DES_JAVA( $key ){
		$this->key = $key;
	}
	
	function encrypt($encrypt) {
		$encrypt = $this->pkcs5_pad($encrypt);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_DES, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$passcrypt = mcrypt_encrypt(MCRYPT_DES, $this->key, $encrypt, MCRYPT_MODE_ECB, $iv);
		return strtoupper( bin2hex($passcrypt) );
	}
	
	function decrypt($decrypt) {
		// $decoded = base64_decode($decrypt);
		$decoded = pack("H*", $decrypt);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_DES, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$decrypted = mcrypt_decrypt(MCRYPT_DES, $this->key, $decoded, MCRYPT_MODE_ECB, $iv);
		return $this->pkcs5_unpad($decrypted);
	}
	
	function pkcs5_unpad($text){
		$pad = ord($text{strlen($text)-1});
		
		if ($pad > strlen($text)) return $text;
		if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return $text;
		return substr($text, 0, -1 * $pad);
	}
	
	function pkcs5_pad($text){
		$len = strlen($text);
		$mod = $len % 8;
		$pad = 8 - $mod;
		return $text.str_repeat(chr($pad),$pad);
	}
	
}
    function toStr($bytes) {  
        $str = '';  
        foreach($bytes as $ch) {  
		   //if($ch<0)
			//   $ch+=256;
		   //echo $ch.";";
            $str .= chr($ch);  
        }  
   
           return $str;  
    } 
	
    function do_mencrypt($input, $key, $algorithm, $mode)
    {

        //$input = str_replace("\n", "", $input);
        //$input = str_replace("\t", "", $input);
        //$input = str_replace("\r", "", $input);
        $iv_arr = array(0x12, 0x34, 0x56, 0x78, 0x90, 0xab, 0xcd, 0xef);
		$iv = toStr($iv_arr);
        //$key = substr(md5($key), 0, 24);
        //$td = mcrypt_module_open('tripledes', '', 'ecb', '');
		//$td = mcrypt_module_open(MCRYPT_DES, '',MCRYPT_MODE_ECB, '');
		$td = mcrypt_module_open($algorithm, '',$mode, '');
        //$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		//echo "iv".$iv."<br>";
        mcrypt_generic_init($td, $key, $iv);
        $encrypted_data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return trim(chop(base64_encode($encrypted_data)));
    }
	function do_mdecrypt($input, $key, $algorithm, $mode)
    {
        $input = str_replace("\n", "", $input);
        $input = str_replace("\t", "", $input);
        $input = str_replace("\r", "", $input);

        $input = trim(chop(base64_decode($input)));
        //$td = mcrypt_module_open('tripledes', '', 'ecb', '');
		$td = mcrypt_module_open($algorithm, '',$mode, '');
        //$key = substr(md5($key), 0, 24);
        //$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		$iv_arr = array(0x12, 0x34, 0x56, 0x78, 0x90, 0xab, 0xcd, 0xef);
		$iv = toStr($iv_arr);
        mcrypt_generic_init($td, $key, $iv);
        $decrypted_data = mdecrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return trim(chop($decrypted_data));
    }
	

// 使用方式
//5oGgzXL8b8fwwfrWslzWMTI1Wz/xfW7N3tYIX0T1hNc1CLk2JT/uPPKaAN1s2aBH22mm2tmH8Kk=
$channel_code = "C04";
$api_key = "Afdk9mbMLX4LvH+p";
$string=$channel_code.md5($api_key).'2015-08-08 08:08:08'.chr(3).chr(3).chr(3);
//$string="Ci".$channel_code.md5($api_key).date("Y-m-dH:i:s").chr(3);
//$string = "C04d893dd244935ae9e535787f7ee0d69e72015-08-0508:37:13".chr(3).chr(3).chr(3);
$modes=mcrypt_list_modes(); 
$algorithms=mcrypt_list_algorithms();

$DES_KEY = array(21, -99, 1, -110, 82, -32, -45, -128 );
$DES_KEY = array(0x12, 0x34, 0x56, 0x78, 0x90, 0xab, 0xcd, 0xef);
//$key = toStr($DES_KEY);
$key="Y/QfklKH";
//echo strlen($key)."<br>";
//$encoder=new DES_JAVA($key);
//echo base64_encode($encoder->encrypt($string))."<br>";
/*foreach($modes as $mode)
{
	foreach($algorithms as $algorithm)
	{
		if($algorithm=="arcfour" ||$algorithm=="enigma" ||$algorithm=="wake" )
			continue;
		echo $mode.":".$algorithm.": ".do_mencrypt($string,$key, $algorithm,$mode)."<br>";
	}
}
*/
echo strlen($string).":".$string."<br>";
$en_str=do_mencrypt($string,$key,"des","cbc");
echo $en_str."<br>";
echo SuperAPI::sign($string)."<br>";
$en_str='GVDxHY5QtkQ9wPjpFfSIJ5NZo0NwrBEcdjlxYNDudzE08Tl6OFFK+M4gB/v6mB7IQtGy9W3jNqwrRQv3eNWbRw==';
$de_str=do_mdecrypt($en_str,$key,"des","cbc");

echo strlen($de_str).":".$de_str."<br>";
echo ord($de_str[53+8]);
echo ord($de_str[54+8]);
echo ord($de_str[55+8]);
?>