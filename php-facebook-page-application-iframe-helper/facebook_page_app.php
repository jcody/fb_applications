<?php


class Facebook_page_app{
	private $app_secret, $signed_request, $is_user_fan, $is_user_admin, $data;
	public function __construct($app_secret){	
		$this->app_secret = $app_secret;
		$this->data = $this->setUp();
	}
	private function setUp(){
		return isset($_POST['signed_request'])?	$this->parse_signed_request($_POST['signed_request'],$this->app_secret): null;
	}
	function getPageData(){
		return $this->data;
	}
	private function parse_signed_request($signed_request, $secret) {
	  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
	
	  // decode the data
	  $sig = $this->base64_url_decode($encoded_sig);
	  $data = json_decode($this->base64_url_decode($payload), true);
	
	  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
		error_log('Unknown algorithm. Expected HMAC-SHA256');
		return null;
	  }
	
	  // check sig
	  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
	  if ($sig !== $expected_sig) {
		error_log('Bad Signed JSON signature!');
		return null;
	  }
	
	  return $data;
	}
	
	private function base64_url_decode($input) {
	  return base64_decode(strtr($input, '-_', '+/'));
	}	
	
	function isUserFan(){
		if($this->data){
		return $this->data['page']['liked'] == 1;
		}else{
			return false;	
		}
	}
	
	function isUserAdmin(){
		if($this->data){
		return $this->data['page']['admin'] == 1;
		}else{
			return false;	
		}
	}
	
	function getPageId(){
		if($this->data){
			return 	$this->data['page']['id'];
		}
	}
	
	function getAppDataQS(){
			if($this->data){
			return $this->data['app_data']? $this->data['app_data']:null;	
			}
	}
	function encodeAppData($params){ // accepts an array or querystring
		$app_data = "";
		if($params){
		if(is_array($params) && count($params) > 0){
			foreach($params as $k=>$v){
				$app_data.=$k."=".$v."|";	
			}
			$app_data = substr($app_data,0,-1);
		}else{ // user may have entered as querystring style
			$qs = explode("&", $params);
			foreach($qs as $k=>$v){
				list($key, $value) = explode("=", $v);
				$app_data.=	$key."=".$value."|";
			}
			$app_data = substr($app_data,0,-1);
		}
	}//end params
		return urlencode($app_data);
	}
	
	function decodeAppData(){
		if($this->data){
		$d = isset($this->data['app_data'])? $this->data['app_data']: null;	
		$params = array();
		if($d){
			$items = explode("|",urldecode($d));
			foreach($items as $k=>$v){
				list($key,$value) =  explode("=",$v);
				$params[$key] = $value;	
			}
			$items = null;
		}
		
		return $params;
		}
	}
	
}

?>