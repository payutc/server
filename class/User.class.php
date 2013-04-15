<?php 
/**
    BuckUTT - Buckutt est un système de paiement avec porte-monnaie électronique.
    Copyright (C) 2011 BuckUTT <buckutt@utt.fr>

	This file is part of BuckUTT
	
    BuckUTT is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    BuckUTT is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * User.class
 * 
 * Classe gérant les utilisateurs.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

//TODO tester dans chaque méthode si state = 1, sinon on poutre

use \Payutc\Exception\UserIsBlockedException;
use \Payutc\Exception\MessageUpdateFailedException;
use \Payutc\Exception\UserUnknown;
use \Payutc\Exception\GingerFailure;
use \Payutc\Bom\Blocked;
use \Payutc\Config;
use \Payutc\Bom\MsgPerso;
use \Payutc\Db;

/**
 * classe user
 */
class User {

	protected $idUser;
	protected $lastname;
	protected $firstname;
	protected $nickname;
	protected $mail;
	protected $credit;
	protected $idPhoto;
	protected $usr_fail_auth;
	protected $max_fail_auth = 3; // Nombre max de mauvaises authentifications successives
	protected $db;
	protected $adult;
	protected $msg_perso; // petit message imprimé en bas du ticket
    
	protected $gingerUser; // Résultat de ginger

	/**
	* Constructeur
	* 
	* @param string $username Login of the User object to init
	* @param int $checkBlocked True if a blocked user should throw an exception
	*/
	public function __construct($username, $checkBlocked = true) {
		$this->db = Db_buckutt::getInstance();
	
		//Récupération de l'id buckutt
        $userQuery = $this->db->query("SELECT usr_id, usr_fail_auth, usr_blocked, usr_firstname, usr_lastname, usr_nickname, usr_adult, usr_msg_perso, usr_mail, usr_credit, img_id FROM ts_user_usr WHERE usr_nickname = '%s'", array($username));
		if ($this->db->affectedRows() != 1) {
			throw new UserUnknown();
		}
		$don = $this->db->fetchArray($userQuery);
        
        $this->usr_fail_auth = $don['usr_fail_auth'];
		//si utilisateur bloqué
		if ($don['usr_blocked'] == 1 && $checkBlocked == 1) {
            throw new UserBlocked();
		}
        		
		//si on arrive jusque là, on peut charger le mec
		$this->lastname = $don['usr_lastname'];
		$this->firstname = $don['usr_firstname'];
		$this->nickname = $don['usr_nickname'];
		$this->mail = $don['usr_mail'];
		$this->credit = $don['usr_credit'];
		$this->idPhoto = $don['img_id'];
		$this->adult = $don['usr_adult'];
		$this->msg_perso = $this->getMsgPerso($this->idUser);
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
		return $this->lastname;
	}

	/**
	* Retourne $firstname.
	* 
	* @return string $firstname
	*/
	public function getFirstname() {
		return $this->firstname;
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
		return $this->mail;
	}

	/**
	* Retourne $credit.
	* On fait une requête dans la BDD à chaque accès au crédit par sécurité.
	* 
	* @return int $credit
	*/
	public function getCredit() {
        $creditQuery = $this->db->query("SELECT usr_credit FROM ts_user_usr WHERE usr_id = %u", array($this->idUser));
        
		$this->credit = $this->db->result($creditQuery, 0);
        
		if ($this->db->affectedRows() == 1) {
		    return $this->credit;
		} else {
		    throw new UserUnknown();
		}
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
    * returns "ok" if succeeded, else, returns the error message from MsgPerso::setMsgPerso
    * @param String $newMsgPerso
    * @return String $status
    */
    public function setMsgPerso($msgPerso, $funID) {
        try {
            MsgPerso::setMsgPerso($msgPerso, $this->idUser, $funID);
            return "ok";
        } catch (MessageUpdateFailedException $e) {
            return $e->getMessage();
        }
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
		$qb = DB::createQueryBuilder();
		$qb->update('ts_user_usr', 'usr')
			->set('usr_fail_auth', $qb->expr()->literal(0))
			->set('usr_blocked', $qb->expr()->literal(1))
			->where('usr_id = :usr_id')
			->setParameters(array(
				'usr_id' => $this->idUser
			));
		$affectedRows = $qb->execute();
		if ($affectedRows == 1)
			return 1;
		else
			return 400;
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
		$don = $this->db->fetchArray($this->db->query("SELECT usr_fail_auth, usr_blocked FROM ts_user_usr WHERE usr_id = '%u';", Array($this->idUser)));
		return (bool)$don['usr_blocked'];
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
            "credit" => $this->credit);
	}
	
	/** 
	*
	*	Retourne si l'utilisateur est majeur
	*
	* @return int $adult
	*/
	public function isAdult() {
        try {
            $this->initGinger();
        }
        catch (Exception $ex) {
            throw new GingerFailure($ex);
        }
        
        return $this->gingerUser->is_adulte;
	}
    
    /** 
	*
	*	Retourne si l'utilisateur est cotisant BDE
	*
	* @return int $adult
	*/
	public function isCotisant() {
        try {
            $this->initGinger();
        }
        catch (Exception $ex) {
            throw new GingerFailure($ex);
        }
        
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
	* Initialiser ginger avec un moyen d'identification (login ou uid).
    * Attention à bien catch l'ApiException
	*
	* @return void
	*/
    private function initGinger(){
        if(empty($this->gingerUser)){
            $ginger_key = Config::get('ginger_key');
            $ginger_url = Config::get('ginger_url');
            if(!empty($ginger_key)){
                // Initialiser ginger, éventuellement avec une URL perso
                if(!empty($ginger_url)){
                    $ginger = new \Ginger\Client\GingerClient(Config::get('ginger_key'), Config::get('ginger_url'));
                }
                else {
                    $ginger = new \Ginger\Client\GingerClient(Config::get('ginger_key'));
                }
                
                // Récupérer le user dans ginger
                $this->gingerUser = $ginger->getUser($this->nickname);
            }
            else {
                // Génération d'un faux user
                $this->gingerUser = new StdClass;
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
        // Récupération du login via le CAS
		//$login = Cas::authenticate($ticket, $service);
        $login = "puyouart";
		if ($login < 0) {
			throw new CasFailure("Impossible de valider le ticket CAS fourni");
		}
        
        // Création de l'objet user
		$user = new User($login, 0, 0);
        
        return $user;
    }
    
    public static function getUserFromBadge($badge) {
		$ginger = new Ginger($_CONFIG['ginger_key']);
		try {
			$gingerUser = $ginger->getCard($badge_id);
		}
		catch (Exception $ex) {
            throw new GingerFailure($ex);
		}
        
        if(!$gingerUser->login) {
            throw new UserUnknown();
        }

        $user = new User($gingerUser->login, 0, 0);

        // On a déjà un résultat de ginger récent, donc autant le garder
        $user->setGingerUser($gingerUser);
            
        return $user;
    }
}
