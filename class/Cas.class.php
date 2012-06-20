<?

require_once 'class/xmlToArrayParser.class.php';
require_once 'config.inc.php';

class Cas {

	public static function authenticate($ticket,$service) {
		global $_CONFIG;
		$url_validate = $_CONFIG['cas_url']."serviceValidate?service=".$service."&ticket=".$ticket;
		$get_reponse = fopen($url_validate, "r");
		$data=''; 
		while(!feof($get_reponse)) 
			$data.=fread($get_reponse,100); 
		fclose($handle);
		$parsed = new xmlToArrayParser($data);
		if(isset($parsed->array['cas:serviceResponse']['cas:authenticationSuccess']['cas:user'])) 
			$login = $parsed->array['cas:serviceResponse']['cas:authenticationSuccess']['cas:user']; 
		else
			$login = -1;
		return $login;
	}
	
	public static function getURl() {
		global $_CONFIG;
		return $_CONFIG['cas_url'];
	}
	
}
