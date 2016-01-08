<?php
/***************************************************************************
 *
 * Copyright (c) 2014 iyunxiao.joyschool.cn, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file 
 * @author cuijianwei(cuijianwei@mail.joyschool.cn)
 * @date 2014/08/23
 * @version $Revision: 1.0
 * @brief
 *
 **/

class Curl { 
	public static function mycurl($url, $postdata=NULL,$cookie=NULL,$getdata=NULL){
		$cl = curl_init();
		$ispost = false;
		$user_agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; .NET CLR 1.1.4322)";
		$user_agent = "Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_2 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8H7 Safari/6533.18.5";
		if(!empty($getdata)){
            $url.="?";
            $index=0;
			foreach($getdata as $key=>$value)
            {
                if($index>0)
                    $url.="&";
                $url.=$key."=".$value;
                $index+=1;
            }
		}
        
		if(!empty($postdata)){
			$ispost = true;
		}
        if(!empty($postdata))
        {
		    $curl_opts = array(
                CURLOPT_URL => $url,
                CURLOPT_CONNECTTIMEOUT => intval(1000),
                CURLOPT_TIMEOUT => intval(1000),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_POST => $ispost,
                CURLOPT_POSTFIELDS => $postdata,
                CURLOPT_USERAGENT=> $user_agent,
		    );
        }
        else
        {
            $curl_opts = array(
                CURLOPT_URL => $url,
                CURLOPT_CONNECTTIMEOUT => intval(1000),
                CURLOPT_TIMEOUT => intval(1000),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_USERAGENT=> $user_agent,
            );
        }
        if($cookie!=NULL)
            curl_setopt($cl, CURLOPT_COOKIE,$cookie);
		curl_setopt_array($cl, $curl_opts);
		$output = curl_exec($cl);
		$curlErrno = curl_errno($cl);
		$curlErrmsg = curl_error($cl);
		curl_close($cl);
		return $output;
	}
}
/* vim: set expandtab ts=4 sw=4 sts=4 tw=100 */
?>
