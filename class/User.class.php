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

require_once 'class/Group.class.php';
require_once 'class/Image.class.php';
require_once 'class/ComplexData.class.php';
require_once 'class/Log.class.php';
require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';

/**
 * classe user
 */
class User {

	protected $idUser;
	protected $state = 401;
	protected $groups;
	protected $roles;
	protected $lastname;
	protected $firstname;
	protected $nickname;
	protected $mail;
	protected $credit;
	protected $ip;
	protected $logWithPass = 0; //1 si le user s'est connecté avec mot de passe
	protected $idPhoto;
	protected $usr_fail_auth;
	protected $max_fail_auth = 3; // Nombre max de mauvaises authentifications successives
	protected $droits = Array();
	protected $db;
	
	/**
	* Constructeur
	* 
	* @param string $data
	* @param int $meanOfLogin
	* @param string $pass
	* @param string $ip[optional]
	* @param int $noPass[optional] 1 si connexion sans mot de passe (badgeage simple au foyer)
	* @return int $state
	*/
	public function __construct($data, $meanOfLogin, $pass,  $ip = 0, $noPass = 0) {
		$this->db = Db_buckutt::getInstance();
		
		//Test si on utilise le mean of login IDCarte et si oui ba on suprime le dernier chiffre
		//On fait ça parce qu'on ne sait pas le calculer 
		if ($meanOfLogin == 4){
			$data=substr($data, 0, -1);
		}

		//Récupération de l'id buckutt
		$this->idUser = $this->db->result($this->db->query("SELECT usr_id FROM tj_usr_mol_jum WHERE jum_data='%s' AND mol_id='%u';", Array($data, $meanOfLogin)),0);
		if ($this->db->affectedRows() == 1) {
			$this->state = 1;
		} else {
			$this->state = 405;
			return $this->state;
		}
		
		$don = $this->db->fetchArray($this->db->query("SELECT usr_fail_auth, usr_blocked FROM ts_user_usr WHERE usr_id = '%u';", Array($this->idUser)));
		if ($this->db->affectedRows() == 1) {
			$this->usr_fail_auth = $don['usr_fail_auth'];
			//si utilisateur bloqué
			if ($don['usr_blocked'] == 1) {
				$this->state = 403;
				return $this->state;
			}
		} else {
			$this->state = 405;
			return $this->state;
		}		
		
		//si mec loggué avec mot de passe
		if($noPass == 0) {
			//si le mot de passe est faux, on sort
			if ($this->checkPass($pass) != 1)
				return $this->state;
		}
		
	
		//si on arrive jusque là, on peut charger le mec
		$this->Ip = $ip;
		$don = $this->db->fetchArray($this->db->query("SELECT usr_firstname, usr_lastname, usr_nickname, usr_mail, usr_credit, img_id FROM ts_user_usr WHERE usr_id = '%u';", Array($this->idUser)));		
		$this->lastname = $don['usr_lastname'];
		$this->firstname = $don['usr_firstname'];
		$this->nickname = $don['usr_nickname'];
		$this->mail = $don['usr_mail'];
		$this->credit = $don['usr_credit'];
		$this->idPhoto = $don['img_id'];
			
		$this->loadRights();
	}

	/**
	* Vérifie si le mot de passe est correct
	* 
	* @param String $pass
	* @return int $state
	*/
	public function checkPass($pass) {
		//Vérification du couple id/pass
		if ($this->db->numRows($this->db->query("SELECT usr_id FROM ts_user_usr WHERE usr_id='%u' AND usr_pwd='%s'", array($this->idUser, md5($pass)))) == 1) {
			$this->logWithPass = 1;
			//Si le usr_fail_auth n'est pas à 0, on le met à 0		
			//if ($this->usr_fail_auth < 0)
				$this->db->query("UPDATE ts_user_usr SET usr_fail_auth=0 WHERE usr_id='%u'", array($this->idUser));
			$this->state = 1;
		}
		//sinon, on incrémente le usr_fail_auth
		else {
			if ($this->usr_fail_auth < $this->max_fail_auth) {
				$this->db->query("UPDATE ts_user_usr SET usr_fail_auth=usr_fail_auth+1 WHERE usr_id='%u'", array($this->idUser));
				$this->state = 406;
			} else {
				$this->db->query("UPDATE ts_user_usr SET usr_fail_auth=0, usr_blocked='1' WHERE usr_id='%u'", array($this->idUser));
				$this->state = 403;
			}
		}
		return $this->state;
	}
	
	/**
	* Retourne $state.
	* 
	* @return int $state
	*/
	public function getState() {
		return $this->state;
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
		$this->credit = $this->db->result($this->db->query("SELECT usr_credit FROM ts_user_usr WHERE usr_id = %u",array($this->idUser)),0);
		if ($this->db->affectedRows() == 1)
			return $this->credit;
		else
			return 400;
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
	* Retourne $ip.
	* 
	* @return string $ip
	*/
	public function getIp() {
		return $this->ip;
	}
	
	/**
	* Retourne $droits.
	* 
	* @return array $droits
	*/
	public function getDroits() {
		return $this->droits;
	}	
	
	/**
	* Retourne $groups.
	* 
	* @return array $groups
	*/
	public function getGroups() {
		return $this->groups;
	}
	
	/**
	* Change l'image
	* 
	* @param int $img_id
	* @return int $state
	*/
	public function setIdPhoto($img_id) {
		$this->db->query("UPDATE ts_user_usr SET img_id = '%u' WHERE usr_id ='%u'", array($img_id, $this->idUser));
		if ($this->db->affectedRows() == 1) {
			$this->idPhoto = $img_id;
			return 1;
		} else
			return 400;
	}
	
	/**
	* Change le pin
	* 
	* @param String $oldKey
	* @param String $newKey
	* @return int $state
	*/
	public function setPass($oldKey, $newKey) {
		$this->db->query("UPDATE ts_user_usr SET usr_pwd = '%s' WHERE usr_pwd = '%s' AND usr_id ='%u'", array(md5($newKey), md5($oldKey), $this->idUser));
		if ($this->db->affectedRows() == 1) {
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
		$this->db->query("UPDATE ts_user_usr SET usr_fail_auth=0, usr_blocked='1' WHERE usr_id='%u'", array($this->idUser));
		if ($this->db->affectedRows() == 1)
			return 1;
		else
			return 400;
	}
	
	/**
	* Fonction pour se debloquer
	* 
	* @return int $valid
	*/
	public function deblock() {
		$this->db->query("UPDATE ts_user_usr SET usr_fail_auth=0, usr_blocked='0' WHERE usr_id='%u'", array($this->idUser));
		if ($this->db->affectedRows() == 1)
			return 1;
		else
			return 400;
	}	
	
	/**
	* Retourne un array avec l'identité du user et son appartenance ou non au BDE (Attention : grp_id = 1 et non BDE)
	* 
	* @return array $identity
	*/
	public function getIdentity() {
		if($this->db->numRows($this->db->query("SELECT jug.grp_id As grp_id FROM tj_usr_grp_jug jug, t_period_per per WHERE jug.usr_id = '%u' AND jug.grp_id = '1' AND per.per_id = jug.per_id AND jug.jug_removed = '0' AND per.per_date_start <= NOW() AND per.per_date_end >= NOW();",array($this->idUser))) > 0) {
			$ajout = "BDE ";
		} else{
			$ajout= "/!\ pas BDE /!\ ";
		}
		return array($this->idUser, $this->getFirstname(), $this->getLastname(), ($ajout.$this->getNickname()), $this->getIdPhoto(), $this->credit);
	}
	
	/**
	* Charge les droits du user
	* 
	* @return int $state
	*/	
	public function loadRights() {
		//on charge ses droits
		$res = $this->db->query("SELECT rig.rig_id As rig_id, rig.rig_name As rig_name, rig.rig_admin As rig_admin, jur.fun_id As fun_id, jur.poi_id As poi_id, fun_name FROM ts_right_rig rig, t_period_per per, tj_usr_rig_jur jur LEFT JOIN t_fundation_fun fun ON fun.fun_id = jur.fun_id WHERE jur.usr_id = '%u' AND rig.rig_id = jur.rig_id AND per.per_id = jur.per_id AND jur.jur_removed = '0' AND rig.rig_removed = '0' AND per.per_date_start <= NOW() AND per.per_date_end >= NOW()",array($this->idUser));
		if ($this->db->affectedRows() >= 1) {
			$i = 0;
			while ($don = $this->db->fetchArray($res)) {
				$this->droits[$i]['rig_id'] = $don['rig_id'];
				$this->droits[$i]['rig_name'] = $don['rig_name'];
				$this->droits[$i]['fun_id'] = $don['fun_id'];
				$this->droits[$i]['fun_name'] = $don['fun_name'];
				$this->droits[$i]['poi_id'] = $don['poi_id'];
				$this->droits[$i]['rig_admin'] = $don['rig_admin'];
				$i++;
			}
			return 1;
		} else {
			return 400;
		}
	}
	
	//TODO valider la suppression du retour du $txt... si besoin, le passer dansune nouvelle méthode qui utilise getGroups
	/**
	* Charge les groupes et donne dans un array la liste des groupes auquel le user appartient
	* 
	* @return int $state
	*/
	public function loadGroups() {
		//on charge ses groupes
		//$txt = new ComplexData(array());
		$res = $this->db->query("SELECT grp.grp_id As grp_id FROM tj_usr_grp_jug jug, t_group_grp grp, t_period_per per WHERE jug.usr_id = '%u' AND grp.grp_id = jug.grp_id AND per.per_id = jug.per_id AND jug.jug_removed = '0' AND grp.grp_removed = '0' AND per.per_date_start <= NOW() AND per.per_date_end >= NOW();",array($this->idUser));
		if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$this->groups[$don['grp_id']] = new Group($don['grp_id']);
				//$txt->addLine(array($don['grp_id']));
			}
			return 1;
		} else {
			return 400;
		}
		//return $txt->getData();0
	}
	
	/**
	 * Retourne si le user fait partie d'un groupe.
	 * 
	 * @return int $state 
	 * @param int $grp_id
	 */
	public function isInGroup($grp_id) {
		if (array_key_exists($grp_id, $this->groups))
			return 1;
		else
			return 0;
	}
	
	/**
	* on donne le droit (string genre "seller") avec eventuellement ce qui s'applique (id_fundation & id_point) et ça nous donne si le mec a le droit (1) ou pas (2) ou encore si on s'est planté dans le droit (452)
	* 
	* @param string $rig_name
	* @param int $fun_id[optional]
	* @param int $poi_id[optional]
	* @return int $state
	*/
	public function hasDroit($rig_name, $fun_id = 0, $poi_id = 0) {
		$return = 0;
		foreach ($this->droits as $key => $value) {
			
			if(in_array($rig_name, $value))
			{
				if (($fun_id != 0) && ($poi_id != 0)) {
					if ($value[fun_id] == $fun_id AND $value[poi_id] == $poi_id)
						$return = 1;
				} elseif ($fun_id != 0) {
					if ($value[fun_id] == $fun_id)
						$return = 1;
				} elseif ($poi_id != 0) {
					if ($value[poi_id] == $poi_id)
						$return = 1;
				} else {
					$return = 1;
				}
			}
		}
		return $return;
	}
	
	/**
	 * Retourne si le user est seller
	 * 
	 * @param int $poi_id
	 * @return int $state
	 */
	public function isSeller($poi_id = 0) {
		return $this->hasDroit("seller", 0, $poi_id);
	}
	
	/**
	* Retourne si oui ou non l'user est admin d'une partie de buckutt
	* 
	* @return int $state
	*/
	public function isAdminBuckutt() {
		if ($this->isBloqueur() == 1 || $this->isDroitAdmin() == 1 || $this->isBuckuttTrezo() == 1 || $this->isPointAdmin() == 1 || $this->isRespFundations() == 1)
			return 1;
		else
			return 456;
	}
	
	/**
	 * Retourne si le user est bloqueur
	 * 
	 * @return int $state
	 */
	public function isBloqueur() {
		if ($this->hasDroit("bloqueur",0,0) == 1)
			return 1;
		else
			return 454;
	}
	
	/**
	 * Retourne si le user est droit_admin
	 * 
	 * @return int $state
	 */
	public function isDroitAdmin() {
		if ($this->hasDroit("droit_admin",0,0) == 1)
			return 1;
		else
			return 454;
	}

	/**
	 * Retourne si le user est buckutt_trezo
	 * 
	 * @return int $state
	 */
	public function isBuckuttTrezo() {
		if ($this->hasDroit("buckutt_trezo",0,0) == 1)
			return 1;
		else
			return 454;
	}	
	
	/**
	 * Retourne si le user est point_admin
	 * 
	 * @return int $state
	 */
	public function isPointAdmin() {
		if ($this->hasDroit("point_admin",0,0) == 1)
			return 1;
		else
			return 454;
	}

	/**
	 * Retourne si le user est resp_fundations
	 * 
	 * @return int $state
	 */
	public function isRespFundations() {
		if ($this->hasDroit("resp_fundations",0,0) == 1)
			return 1;
		else
			return 454;
	}	
	
		/**
	 * Retourne si le user est vente_admin
	 * 
	 * @param int $fun_id
	 * @return int $state
	 */
	public function isVenteAdmin($fun_id) {
		if ($this->hasDroit("vente_admin", $fun_id, 0) == 1)
			return 1;
		else
			return 454;
	}	
	
	/**
	 * Retourne si le user est group_editor
	 * 
	 * @param int $fun_id
	 * @return int $state
	 */
	public function isGroupEditor($fun_id) {
		if ($this->hasDroit("group_editor", $fun_id, 0) == 1)
			return 1;
		else
			return 454;
	}	
	
	/**
	 * Retourne si le user est fund_trezo
	 * 
	 * @param int $fun_id
	 * @return int $state
	 */
	public function isFundTrezo($fun_id) {
		if ($this->hasDroit("fund_trezo", $fun_id, 0) == 1)
			return 1;
		else
			return 454;
	}
}
?>