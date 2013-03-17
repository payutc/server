<?php 

require_once 'services/POSS2.service.php';

class PossException extends Exception {
	public $err_code;
	
	public function __construct($err_code, $err_msg)
	{
		parent::__construct($err_msg);
		$this->err_code = $err_code;
	}
}

class POSS2WithExceptions extends POSS2
{
	private $poss = null;
	
	public function __construct()
	{
		$this->poss = new POSS2();
	}
	
	public function wrapcall($name, $arguments)
	{
		$r = call_user_func_array(array($this->poss, $name), $arguments);
		if (is_array($r) and array_key_exists("error", $r)) {
			$error = $r["error"];
			$error_msg = $r["error_msg"];
			throw new PossException($error, $error_msg);
		}
		else {
			return $r["success"];
		}
	}
	
	protected function getRemoteIp()
	{
		return $this->wrapcall('getRemoteIp', func_get_args());
	}

	/**
	 * Retourne l'url du CAS
	 * @return array $url
	 */
	public function getCasUrl()
	{
		return $this->wrapcall('getCasUrl', func_get_args());
	}

	/**
	 * Charge le Seller sans mot de passe.
	 * 
	 * @param String $ticket
	 * @param String $service
	 * @param int poi_id
	 * @param int fun_id
	 * @return array $state
	*/
	public function loadPos($ticket, $service, $poi_id, $fun_id = null)
	{
		return $this->wrapcall('loadPos', func_get_args());
	}
	

	/**
	* Deconnexion
	*
	* @return array $state
	*/
	public function logout()
	{
		return $this->wrapcall('logout', func_get_args());
	}

	/**
	 * Check si le user est loggué
	 * 
	 * @return bool $state
	 */
	public function isLoadedSeller()
	{
		return $this->wrapcall('isLoadedSeller', func_get_args());
	}
	
	/**
	* Récupérer les infos sur le Seller
	* 
	* @return array $csv
	*/
	public function getSellerIdentity()
	{
		return $this->wrapcall('getSellerIdentity', func_get_args());
	}
	
	/**
	 * Récupérer un cvs avec les produits disponibles
	 * 
	 * @return array $csv
	 */
	public function getArticles()
	{
		return $this->wrapcall('getArticles', func_get_args());
	}
	

	/**
	 * Obtenir les infos d'un buyer 
	 *
	 * @param String $badge_id
	 * @return array $state
	 */
	public function getBuyerInfo($badge_id)
	{
		return $this->wrapcall('getBuyerInfo', func_get_args());
	}

	/** Annulation d'un achat
	 * 1. Récupére l'achat
	 * 2. Vérifie que le vendeur est le bon, ainsi que la vente à été réalisé il y'a moins de X temps
	 * 3. Annule la vente et recrédite
	 * @param int $purchase_id
	 * @return array $state
	 */
	public function cancel($purchase_id)
	{
		return $this->wrapcall('cancel', func_get_args());
	}


	/**
	 * Transaction complète,
	 * 		1. load le buyer
	 * 		2. multiselect
	 * 		3. endTransaction
	 * @param String $badge_id
	 * @param String $obj_ids
	 * @return array $state
	 */
	public function transaction($badge_id, $obj_ids)
	{
		return $this->wrapcall('transaction', func_get_args());
	}
	
	/**
	 * Récupérer les infos sur une image.
	 * 
	 * @param int $img_id
	 * @param int $outw Largeur de l'image
	 * @param int $outh Hauteur de l'image
	 * @return array $csv
	 */
	public function getImage64($img_id, $outw = 0, $outh = 0)
	{
		return $this->wrapcall('getImage64', func_get_args());
	}
}

