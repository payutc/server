<?php 
/**
*	payutc
*	Copyright (C) 2013 payutc <payutc@assos.utc.fr>
*
*	This file is part of payutc
*	
*	payutc is free software: you can redistribute it and/or modify
*	it under the terms of the GNU General Public License as published by
*	the Free Software Foundation, either version 3 of the License, or
*	(at your option) any later version.
*
*	payutc is distributed in the hope that it will be useful,
*	but WITHOUT ANY WARRANTY; without even the implied warranty of
*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*	GNU General Public License for more details.
*
*	You should have received a copy of the GNU General Public License
*	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace Payutc\Bom;

use \Payutc\Exception\UserIsBlockedException;
use \Payutc\Exception\MessageUpdateFailedException;
use \Payutc\Exception\UserNotFound;
use \Payutc\Exception\GingerFailure;
use \Payutc\Bom\Blocked;
use \Payutc\Config;
use \Payutc\Bom\MsgPerso;
use \Payutc\Db;
use \Db_buckutt;
use \Ginger\Client\GingerClient;
use \Cas;
use \Payutc\Log;

/**
 * User
 * 
 * Object holding a generic User
 */
class User {

	protected $idUser;
	protected $nickname;
	protected $idPhoto;
    protected $selfBlocked;
	protected $db;    
	protected $gingerUser = null;

	/**
	* Constructeur
	* 
	* @param string $username Login of the User object to init
	*/
	public function __construct($username, $gingerUser = null) {
        Log::debug("User: __construct($username, $gingerUser)");
        
		$this->db = Db_buckutt::getInstance();
        
        $query = Db::createQueryBuilder()
            ->select('usr_id', 'usr_blocked', 'img_id')
            ->from('ts_user_usr', 'usr')
            ->where('usr.usr_nickname = :usr_nickname')
            ->setParameter('usr_nickname', $username)
            ->execute();

		// Check that the user exists
		if ($query->rowCount() != 1) {
            Log::debug("User: User not found for login $username");
			throw new UserNotFound();
		}
                
        // Load data from Ginger
        $this->nickname = $username;
        if($this->gingerUser == null){
            try {
                $this->initGinger();
            }
            catch (Exception $ex) {
                throw new GingerFailure($ex);
            }    
        }
        Log::debug("User: data from Ginger: ".print_r($this->gingerUser, true));
                
        // Get remaining data from the database
		$don = $query->fetch();
        Log::debug("User: data from database: ".print_r($don, true));
        
        $this->idUser = $don['usr_id'];
        $this->selfBlocked = $don['usr_blocked'];
		$this->idPhoto = $don['img_id'];
	}

	/**
	* Retourne $idUser.
	* 
	* @return int $idUser
	*/
	public function getId() {
		return $this->idUser;
	}

	/**
	* Retourne $lastname.
	* 
	* @return string $lastname
	*/
	public function getLastname() {
		return $this->gingerUser->nom;
	}

	/**
	* Retourne $firstname.
	* 
	* @return string $firstname
	*/
	public function getFirstname() {
		return $this->gingerUser->prenom;
	}
	/**
	* Retourne $nickname.
	* 
	* @return string $nickname
	*/
	public function getNickname() {
		return $this->nickname;
	}

	/**
	* Retourne $mail.
	* 
	* @return string $mail
	*/
	public function getMail() {
		return $this->gingerUser->email;
	}

	/**
	* Retourne $credit.
	* On fait une requête dans la BDD à chaque accès au crédit par sécurité.
	* 
	* @return int $credit
	*/
	public function getCredit() {
        Log::debug("User($this->idUser): getCredit()");
        
        $query = Db::createQueryBuilder()
            ->select('usr_credit')
            ->from('ts_user_usr', 'usr')
            ->where('usr.usr_id = :usr_id')
            ->setParameter('usr_id', $this->getId())
            ->execute();

		// Check that the user exists
		if ($query->rowCount() != 1) {
            Log::debug("User: User not found for login $username");
			throw new UserNotFound();
		}

        // Get data from the database
		$don = $query->fetch();
        return $don['usr_credit'];
	}
	
	/**
	* Retourne $photo
	* 	
	* @return int $idImg
	*/
	public function getIdPhoto() {
		return $this->idPhoto;
	}

    /**
    * Retourne $msgPerso
    * 
    * @param  int $usrId 
    * @param  int $funId
    * @return String $msgPerso
    */
	public function getMsgPerso($funId=NULL) {
        return MsgPerso::getMsgPerso($this->idUser, $funId);
    }
    
    /**
    * Setter for user's personnal message
    * @throws MessageUpdateFailedException if an error occurs
    * @param String $newMsgPerso
    * @return String $status
    */
    public function setMsgPerso($msgPerso, $funID) {
        MsgPerso::setMsgPerso($msgPerso, $this->idUser, $funID);
    }
	
	/**
	* Change l'image
	* 
	* @param int $img_id
	* @return int $state
	*/
	public function setIdPhoto($img_id) {
		$qb = DB::createQueryBuilder();
		$qb->update('ts_user_usr', 'usr')
			->set('img_id', ':img_id')
			->where('usr_id = :usr_id')
			->setParameters(array(
				'img_id' => $img_id,
				'usr_id' => $this->idUser
			));
		
		$affectedRows = $qb->execute();
		if ($affectedRows == 1) {
			$this->idPhoto = $img_id;
			return 1;
		} else
			return 400;
	}

	/**
	* Fonction pour se bloquer soi même (en cas de perte/vol par exemple)
	* 
	* @return int $valid
	*/
	public function blockMe() {
        Log::debug("User($this->idUser): blockMe()");
        
		$qb = Db::createQueryBuilder();
		$qb->update('ts_user_usr', 'usr')
			->set('usr_blocked', $qb->expr()->literal(1))
			->where('usr_id = :usr_id')
			->setParameter('usr_id', $this->idUser);
        
		$affectedRows = $qb->execute();
		if ($affectedRows != 1){
		    Log::debug("User($this->idUser): blockMe() failed");
            throw new UpdateFailed("Le blocage a échoué");
		}
	}
	
	/**
	* Fonction pour se debloquer
	* 
	* @return int $valid
	*/
	public function deblockMe() {
		$this->db->query("UPDATE ts_user_usr SET usr_fail_auth=0, usr_blocked='0' WHERE usr_id='%u'", array($this->idUser));
		if ($this->db->affectedRows() == 1)
			return 1;
		else
			return 400;
	}
	
	/**
	 * Self-blocked ?
	 * 
	 * @return isBlocked ?
	 */
	public function isBlockedMe() {
		return $this->selfBlocked;
	}
	
	/**
	* Bloqué sur une fondation ?
	* 
	* @paramter $fundation id optionnel d'une fondation
	* 
	* @return bool $isBlocked
	*/
	public function isBlockedFun($fundation = null) {
		return Blocked::userIsBlocked($this->idUser, $fundation);
	}
	
	/**
	 * Bloqué quelquepart ?
	 */
	public function isBlocked($fundation = null) {
		return $this->isBlockedMe() or $this->isBlockedFun($fundation);
	}
	
	/**
	 * Self-blocked ? Si oui lance une exception.
	 * 
	 * @throw Exception
	 */
	public function checkNotBlockedMe() {
		if ($this->isBlockedMe()) {
			throw new GingerFailure("L'utilisateur s'est auto bloqué.");
		}
	}
	
	/**
	 * Bloqué sur une fondation ? Si oui lance une exception.
	 * 
	 * @parameter $fundation
	 * 
	 * @throw Exception
	 */
	public function checkNotBlockedFun($fundation = NULL) {
		Blocked::checkUsrNotBlocked($this->idUser, $fundation);
	}
	
	/**
	 * Bloqué qqpart ? Si oui lance une exception.
	 * 
	 * @throw Exception
	 * 
	 * @parameter $fundation
	 */
	public function checkNotBlocked($fundation = null)
	{
		$this->checkNotBlockedMe();
		$this->checkNotBlockedFun($fundation);
	}
	
	
	/**
	* Retourne un array avec l'identité du user et son appartenance ou non au BDE (Attention : grp_id = 1 et non BDE)
	* 
	* @return array $identity
	*/
	public function getIdentity() {
		return array(
		    "id" => $this->idUser,
            "firstname" => $this->getFirstname(),
            "lastname" => $this->getLastname(),
            "nickname" => $this->getNickname(),
            "photo" => $this->getIdPhoto(),
            "credit" => $this->getCredit());
	}
	
	/** 
	*
	*	Retourne si l'utilisateur est majeur
	*
	* @return int $adult
	*/
	public function isAdult() {        
        return $this->gingerUser->is_adulte;
	}
    
    /** 
	*
	*	Retourne si l'utilisateur est cotisant BDE
	*
	* @return int $adult
	*/
	public function isCotisant() {
        return $this->gingerUser->is_cotisant;
	}

	/**
	* REtourner les derniers achats pour eventuel annulation
	*
	* @return array $return
	*/
	public function getLastPurchase() {
		$res = $this->db->query("SELECT pur_id, obj_id, pur_price FROM t_purchase_pur WHERE UNIX_TIMESTAMP(pur_date) > (UNIX_TIMESTAMP(NOW()) - 900) AND usr_id_buyer = %u AND pur_removed = 0", array($this->idUser));
		$pur = array();
		while ($don = Db_buckutt::getInstance()->fetchArray($res)) { $pur[$don['pur_id']] = $don;}
		return $pur;
	}

	/**
	* Initialiser ginger, éventuellement avec une URL perso
	*
	* @return array $ginger Instance de ginger
	*/
    protected function getNewGinger(){
        $ginger_url = Config::get('ginger_url');
        if(!empty($ginger_url)){
            return new GingerClient(Config::get('ginger_key'), Config::get('ginger_url'));
        }
        else {
            return new GingerClient(Config::get('ginger_key'));
        }
    }
    
    /**
	* Initialiser ginger avec un moyen d'identification (login ou uid).
    * Attention à bien catch l'ApiException
	*
	* @return void
	*/
    private function initGinger(){
        if(empty($this->gingerUser)){
            $ginger_key = Config::get('ginger_key');
            if(!empty($ginger_key)){
                // Récupérer le user dans ginger
                $ginger = $this->getNewGinger();
                $this->gingerUser = $ginger->getUser($this->nickname);
            }
            else {
                // Génération d'un faux user
                $this->gingerUser = new \StdClass;
                $this->gingerUser->login = $this->nickname;
                $this->gingerUser->prenom = "Test";
                $this->gingerUser->nom = "User";
                $this->gingerUser->mail = "payutc-test@assos.utc.fr";
                $this->gingerUser->badge_uid = "123456AB";
                $this->gingerUser->is_cotisant = true;
                $this->gingerUser->is_adulte = true;
            }
        }
    }
    
    /**
	* Permet de set directement le ginger user de ce user si on l'a déjà,
    * par exemple si on l'a identifié avec un badge (et donc une requête ginger)
    *
	* @return void
	*/
    public function setGingerUser($gingerData){
        $this->gingerUser = $gingerData;
    }
    
    protected static function _baseUpdateQueryById($usr_id) {
		$qb = Db::createQueryBuilder();
		$qb->update('ts_user_usr', 'usr')
			->where('usr_id = :usr_id')
			->setParameter('usr_id', $usr_id);
		return $qb;
	}
    
    public static function incCreditById($usr_id, $val) {
		$qb = static::_baseUpdateQueryById($usr_id);
		$qb->set('usr_credit', 'usr_credit + :val')
			->setParameter('val', $val);
		$qb->execute();
	}
	
	public static function decCreditById($usr_id, $val) {
		$qb = static::_baseUpdateQueryById($usr_id);
		$qb->set('usr_credit', 'usr_credit - :val')
			->setParameter('val', $val);
		$qb->execute();
	}
	
	public function incCredit($val) {
		$this::incCreditById($this->getId(), $val);
		$this->credit += $val;
	}
	
	public function decCredit($val) {
		$this::decCreditById($this->getId(), $val);
		$this->credit -= $val;
	}

    public static function getUserFromCas($ticket, $service) {
        Log::debug("User: getUserFromCas($ticket, $service)");
        
		$login = Cas::authenticate($ticket, $service);
        if ($login === -1) {
            Log::warning("User: CAS returned -1");
			throw new LoginError("Impossible de valider le ticket CAS fourni", -1);
		}
        
        return new User($login);
    }
    
    public static function getUserFromBadge($badge) {
        Log::debug("User: getUserFromBadge($badge)");
        
		$ginger = $this->getNewGinger();
		try {
			$gingerUser = $ginger->getCard($badge_id);
		}
		catch (\Exception $ex) {
            Log::error("User: Ginger exception: ".$ex->getMessage());
            throw new GingerFailure($ex);
		}
        
        if(!$gingerUser->login) {
            throw new UserNotFound();
        }

        return new User($gingerUser->login, $gingerUser);
    }
}
