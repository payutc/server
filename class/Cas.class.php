<?php


class Cas {
	public static function authenticate($ticket, $service, $cas_url) {
		global $_CONFIG;
		$url_validate = $cas_url."serviceValidate?service=".$service."&ticket=".$ticket;
		$data = file_get_contents($url_validate);
		if(empty($data)) return -1;
		
		$parsed = new xmlToArrayParser($data);
		if(isset($parsed->array['cas:serviceResponse']['cas:authenticationSuccess']['cas:user'])) 
			return $parsed->array['cas:serviceResponse']['cas:authenticationSuccess']['cas:user']; 
		else
			return -1;
	}
}
