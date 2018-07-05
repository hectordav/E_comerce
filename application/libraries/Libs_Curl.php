<?php
/**
 * CodeIgniter Curl Class
 *
 * simple curl to remote server call
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category      	Libraries
 * @author        	Ano Van
 */
class Libs_Curl {
	function __construct(){
	
	}
	public static function sendGetSSL($url, $params){
		if(is_array($params)){
			$strUrl = $url.http_build_query($params,'','&');
		}else{
			$strUrl = $url.$params;
		}
		$crl = curl_init();
		
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($crl, CURLOPT_HTTPGET,true);		
		curl_setopt($crl, CURLOPT_URL, $strUrl);
		curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);
		$reply = curl_exec($crl);
		if ($reply === false) {	
		   print_r('Curl error: ' . curl_error($crl));
		}
		curl_close($crl); 
		
		return $reply;
	}
        
	public static function simpleGet($url, $params)
	{
		if (is_array($params)) {
			$strUrl = $url . http_build_query($params, '', '&');
		} else {
			$strUrl = $url . $params;
		}
		//var_dump($strUrl);
		$crl = curl_init();
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($crl, CURLOPT_HTTPGET,true);
		curl_setopt($crl, CURLOPT_URL, $strUrl);
		curl_setopt($crl, CURLOPT_TIMEOUT, 10);
		$reply = curl_exec($crl);
		if ($reply === false) {
			print_r('Curl error: ' . curl_error($crl));
		}
		curl_close($crl);
		return $reply;
	}
	public static function simplePost($url, $params){
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_POST, count($params));
		curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($params,'','&'));
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,30); //timeout in seconds
                curl_setopt($ch, CURLOPT_TIMEOUT, 3600); //timeout in seconds
		$result = curl_exec($ch);
		if ($result === false) {	
		   print_r('Curl error: ' . curl_error($ch));
		}
		curl_close($ch);
		
		return $result;
	}
        
        public static function simplePut($url, $params){
		$ch = curl_init();
		if (is_array($params)){
                    $params = http_build_query($params, NULL, '&');
		}
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); 
		curl_setopt($ch,CURLOPT_POSTFIELDS, $params);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PUT'));
		$result = curl_exec($ch);
		if ($result === false) {	
		   print_r('Curl error: ' . curl_error($ch));
		}
		curl_close($ch);
		
		return $result;
        }
        
}