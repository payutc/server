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
use \Payutc\Exception\CannotReload;
use \Payutc\Exception\TransferException;
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
    * Fonction pour récupérer l'historique de l'utilisateur
    *
    * @return array
    */
    public function getHistorique() {
        $conn = Dbal::conn();
        $query = $conn->executeQuery(
            'SELECT 
                pur.pur_date AS date, 
                pur.pur_price AS amount, 
                "PURCHASE" AS type,
                obj.obj_name AS name,
                fun.fun_name AS fun,
                NULL AS firstname,
                NULL AS lastname
            FROM
                t_purchase_pur pur
            INNER JOIN t_object_obj obj ON pur.obj_id = obj.obj_id
            INNER JOIN t_fundation_fun fun ON pur.fun_id = fun.fun_id
            WHERE 
                pur.usr_id_buyer = ?
            UNION ALL
            SELECT 
                rec.rec_date AS date,
                rec.rec_credit AS amount,
                "RECHARGE" AS type,
                NULL AS name,
                NULL AS fun,
                NULL AS firstname,
                NULL AS lastname
            FROM 
                t_recharge_rec rec
            WHERE 
                rec.usr_id_buyer = ?
            UNION ALL
            SELECT
                virin.vir_date AS date,
                virin.vir_amount AS amount,
                "VIRIN" AS type,
                virin.vir_message AS name,
                NULL AS fun,
                usrfrom.usr_firstname AS firstname,
                usrfrom.usr_lastname AS lastname
            FROM 
                t_virement_vir virin
            INNER JOIN ts_user_usr usrfrom ON virin.usr_id_from = usrfrom.usr_id
            WHERE 
                virin.usr_id_to = ?
            UNION ALL
            SELECT
                virout.vir_date AS date,
                virout.vir_amount AS amount,
                "VIROUT" AS type, 
                virout.vir_message AS name,
                NULL AS fun,
                usrto.usr_firstname AS firstname,
                usrto.usr_lastname AS lastname
            FROM
                t_virement_vir virout
            INNER JOIN ts_user_usr usrto ON virout.usr_id_to = usrto.usr_id
            WHERE 
                virout.usr_id_from = ?
            ORDER BY  `date` DESC',
            array($this->getId(), $this->getId(), $this->getId(), $this->getId()),
            array("integer", "integer", "integer", "integer")
        );
    return $query->fetchAll();
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
    *   Vérifie qu'un utilisateur peut recharger
    *
    * @throws CannotReload
    */
    public function checkReload($amount = null) {
        if($amount === null){
            $amount = Config::get('rechargement_min', 1000);
        }
        
        if($amount < Config::get('rechargement_min', 1000)) {
            throw new CannotReload("Le montant du rechargement est inférieur au minimum autorisé");
        }
        
        if(($this->getCredit() + $amount) > Config::get('credit_max')){
            throw new CannotReload("Le rechargement ferait dépasser le plafond maximum");
        }
        
        if(!$this->isCotisant()){
            throw new CannotReload("Il faut être cotisant pour pouvoir recharger");
        }
    }

    /**
     * VIREMENT
     * 
     * @param int $amount montant du virement en centimes
     * @param int $userID Id de la personne a qui l'on vire de l'argent.
     * @param string $message 
     * @return int $error (1 c'est que tout va bien sinon faut aller voir le code d'erreur)
     */
    public function transfer($amount, $userID, $message="") {
        $message = htmlspecialchars($message);
        if($amount < 0) {
            Log::warn("TRANSFERT: Montant négatif par l'userID ".$this->getId()." vers l'user ".$userID);
            throw new TransferException("Tu ne peux pas faire un virement négatif (bien essayé)");
        } else if($amount == 0) {
            throw new TransferException("Pas de montant saisi");
        } else if($this->getCredit() < $amount) {
            throw new TransferException("Tu n'as pas assez d'argent pour réaliser ce virement");
        } else if($this->getId() == $userID) {
            throw new TransferException("Se virer de l'argent à soi même n'a aucun sens...");
        } else {
            if(!User::userExistById($userID)) {
                throw new TransferException("Pas de destinataire choisi");
            } else {
                $conn = Dbal::conn();
                $conn->beginTransaction();
                try {
                    User::incCreditById($userID, $amount);
                    $this->decCredit($amount);
                    $conn->insert('t_virement_vir',
                        array(
                            "vir_date" => new \DateTime(),
                            "vir_amount" => $amount,
                            "usr_id_from" => $this->getId(),
                            "usr_id_to" => $userID,
                            "vir_message" => $message),
                        array("datetime", "integer", "integer", "integer", "string")
                    );
                    $conn->commit();
                } catch (\Exception $e) {
                    $conn->rollback();
                    Log::error("Error during transaction for transfer (from ".$this->getId()." to $userID amount: $amount): ".$e->getMessage());
                    throw new TransferException("Une erreur inconnue s'est produite pendant le virement");
                }
            }
        }
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
                throw new UserNotFound("Utilisateur non trouvé dans Ginger");
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
