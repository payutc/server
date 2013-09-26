<?php 
/**
*    payutc
*    Copyright (C) 2013 payutc <payutc@assos.utc.fr>
*
*    This file is part of payutc
*    
*    payutc is free software: you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    payutc is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace Payutc\Bom;

use \Payutc\Exception\UserIsBlockedException;
use \Payutc\Exception\UserNotFound;
use \Payutc\Exception\GingerFailure;
use \Payutc\Exception\UpdateFailed;
use \Payutc\Exception\LoginError;
use \Payutc\Bom\Blocked;
use \Payutc\Bom\MsgPerso;
use \Payutc\Log;
use \Payutc\Config;
use \Payutc\Db\Dbal;
use \Cas;
use \Ginger\Client\GingerClient;

/**
* User
* 
* Object holding a generic User
*/
class User {

    protected $idUser;
    protected $nickname;
    protected $selfBlocked;
    protected $db;    
    protected $gingerUser = null;

    /**
    * Constructeur
    * 
    * @param string $username Login of the User object to init
    */
    public function __construct($username, $gingerUser = null) {
        Log::debug("User: __construct($username, ".print_r($gingerUser, true).")");
        
        $query = Dbal::createQueryBuilder()
            ->select('usr_id', 'usr_blocked')
            ->from('ts_user_usr', 'usr')
            ->where('usr.usr_nickname = :usr_nickname')
            ->setParameter('usr_nickname', $username)
            ->execute();

        // Check that the user exists
        if ($query->rowCount() != 1) {
            Log::debug("User: User not found for login $username");
            $ex = new UserNotFound();
            $ex->login = $username;
            throw $ex;
        }
                
        // Load data from Ginger
        $this->nickname = $username;
        if($this->gingerUser == null){
            try {
                // Récupérer le user dans ginger
                $ginger = $this->getNewGinger();
                $this->gingerUser = $ginger->getUser($this->nickname);
            }
            catch (\Exception $ex) {
                Log::error("User: Ginger exception: ".$ex->getMessage());
                throw new GingerFailure($ex);
            }    
        }
        Log::debug("User: data from Ginger: ".print_r($this->gingerUser, true));
        if($this->gingerUser == null){
            Log::error("Empty gingerUser");
            throw new GingerFailure("Ginger user is empty");
        }
                
        // Get remaining data from the database
        $don = $query->fetch();
        Log::debug("User: data from database: ".print_r($don, true));
        
        $this->idUser = $don['usr_id'];
        $this->selfBlocked = $don['usr_blocked'];
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
        return $this->gingerUser->mail;
    }

    /**
    * Retourne $credit.
    * On fait une requête dans la BDD à chaque accès au crédit par sécurité.
    * 
    * @return int $credit
    */
    public function getCredit() {
        Log::debug("User($this->idUser): getCredit()");
        
        $query = Dbal::createQueryBuilder()
            ->select('usr_credit')
            ->from('ts_user_usr', 'usr')
            ->where('usr.usr_id = :usr_id')
            ->setParameter('usr_id', $this->getId())
            ->execute();

        // Check that the user exists
        if ($query->rowCount() != 1) {
            Log::debug("User: User not found for id $this->idUser");
            throw new UserNotFound();
        }

        // Get data from the database
        $don = $query->fetch();
        return $don['usr_credit'];
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
    * Fonction pour se bloquer soi même (en cas de perte/vol par exemple)
    * 
    * @param int $blocage 1 to block the User
    * @return int $valid
    */
    public function setSelfBlock($blocage) {
        Log::debug("User($this->idUser): blockMe($blocage)");
        
        $qb = Dbal::createQueryBuilder();
        $qb->update('ts_user_usr', 'usr')
            ->set('usr_blocked', $qb->expr()->literal($blocage))
            ->where('usr_id = :usr_id')
            ->setParameter('usr_id', $this->idUser);
        
        $affectedRows = $qb->execute();
        if ($affectedRows != 1){
            Log::debug("User($this->idUser): no lines updated");
            throw new UpdateFailed("Impossible de changer l'état du blocage");
        }
        
        $this->selfBlocked = $blocage;
    }
    
    /**
    * Self-blocked ?
    * 
    * @return isBlocked ?
    */
    public function isBlockedMe() {
        return ($this->selfBlocked == 1);
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
            throw new UserIsBlockedException("L'utilisateur s'est auto bloqué.");
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
            "credit" => $this->getCredit()
        );
    }

    /** 
    *
    *    Retourne si l'utilisateur est majeur
    *
    * @return int $adult
    */
    public function isAdult() {        
        return $this->gingerUser->is_adulte;
    }

    /** 
    *
    *    Retourne si l'utilisateur est cotisant BDE
    *
    * @return int $adult
    */
    public function isCotisant() {
        return $this->gingerUser->is_cotisant;
    }

    /**
    * Returns the last purchases from the user (to allow the seller to cancel them)
    *
    * @return array $return
    */
    public function getLastPurchases() {
        return Purchase::getPurchasesForUser($this->getId(), 60*15);
    }
    
    /**
    * Initialiser ginger, éventuellement avec une URL perso
    *
    * @return array $ginger Instance de ginger
    */
    protected static function getNewGinger(){
        // Check that we have a Ginger key
        $ginger_key = Config::get('ginger_key');
        if(empty($ginger_key)){
            Log::error("User: Ginger key cannot be empty");
            throw new GingerFailure("La configuration de Ginger est incorrecte");
        }
    
        $ginger_url = Config::get('ginger_url');
        if(!empty($ginger_url)){
            return new GingerClient(Config::get('ginger_key'), Config::get('ginger_url'));
        }
        else {
            return new GingerClient(Config::get('ginger_key'));
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
        $qb = Dbal::createQueryBuilder();
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
            Log::warn("User: getUserFromCas($ticket, $service): CAS returned -1");
            throw new LoginError("Impossible de valider le ticket CAS fourni", -1);
        }
    
        return new User($login);
    }

    public static function getUserFromBadge($badge) {
        Log::debug("User: getUserFromBadge($badge)");
    
        $ginger = self::getNewGinger();
        try {
            $gingerUser = $ginger->getCard($badge);
        }
        catch (\Exception $ex) {
            if($ex->getCode() == 404){
                Log::warn("User: badge $badge not found in Ginger");
                throw new UserNotFound();
            }
            Log::error("User: Ginger exception ".$ex->getCode().": ".$ex->getMessage());
            throw new GingerFailure($ex);
        }
    
        if(!$gingerUser->login) {
            throw new UserNotFound();
        }

        return new User($gingerUser->login, $gingerUser);
    }

    public static function createAndGetNewUser($login) {
        Log::debug("User: createAndGetNewUser($login)");

        // Get the user from ginger
        $ginger = self::getNewGinger();
        try {
            $gingerUser = $ginger->getUser($login);
        }
        catch (\Exception $ex) {
            Log::error("User: Ginger exception ".$ex->getCode().": ".$ex->getMessage());
            if($ex->getCode() == 404){
                throw new UserNotFound();
            }
            throw new GingerFailure($ex);
        }
    
        // Add the user to payutc
        Dbal::conn()->insert('ts_user_usr', array(
            'usr_firstname' => $gingerUser->prenom,
            'usr_lastname' => $gingerUser->nom,
            'usr_nickname' => $gingerUser->login,
            'usr_mail' => $gingerUser->mail,
            'usr_adult' => ($gingerUser->is_adulte) ? 1 : 0
            )
        );
    
        // Return a User object
        return new User($gingerUser->login, $gingerUser);
    }
    
    public static function userExistById($id) {
        $qb = Dbal::createQueryBuilder();
        $q = $qb->select('count(*) as count')
                ->from('ts_user_usr', 'usr')
                ->where('usr_id = :id')
                ->setParameter('id', $id);
        $res = $q->execute()->fetch();
        return 0 != $res['count'];
    }
}
