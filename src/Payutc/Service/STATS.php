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

namespace Payutc\Service;

/**
 * STATS.class
 * 
 * Classe permettant de gérer des statistiques (fait à l'arrache à sécuriser et/ou anonymiser)
 * @author BuckUTT <buckutt@utt.fr>, payutc <payutc@assos.utc.fr>
 * @version 3.0
 * @package buckutt
 */



class STATS {
	
	protected $db;
	
	/**
	 * Constructeur.
	 */   
	public function __construct() {
		$this->db = Db_buckutt::getInstance();
	}


	/**
	* Récuperer les fundations (ne nécessite pas de droit)
	* 
	* @return array $fundations
	*/
	public function get_fundations() {
		$fundations = array();
		$res = $this->db->query("SELECT fun_id, fun_name FROM t_fundation_fun WHERE fun_removed = '0';");
        while ($don = $this->db->fetchArray($res)) {
            $fundations[]=array(
            	"id"=>$don['fun_id'], 
            	"name"=>$don['fun_name']);
        }
        return array("success"=>$fundations);
	}

	/**
	* Retourne les articles
	* 
	* @return array $articles
	*/
	public function get_articles() {
		// OBTENIR QUE LES ARTICLES DES FONDATIONS SUR LES QUELS J'AI LES DROITS
		$articles = array();
		$res = $this->db->query("SELECT o.obj_id, obj_name, fun_id, p.pri_credit
FROM t_object_obj o
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id 
WHERE 
obj_type = 'product'", array());
        while ($don = $this->db->fetchArray($res)) {
            $articles[]=array(
            	"id"=>$don['obj_id'], 
            	"name"=>$don['obj_name'],
            	"fundation_id"=>$don['fun_id'],
            	"price"=>$don['pri_credit']);
        }
        return array("success"=>$articles);
	}

	/**
	* Récuperer les fundations (ne nécessite pas de droit)
	* 
	* @return array $fundations
	*/
	public function get_transactions() {
		$transactions = array();
		$res = $this->db->query("SELECT obj_id, usr_id_buyer, pur_date FROM t_purchase_pur WHERE pur_removed = '0';");
        while ($don = $this->db->fetchArray($res)) {
            $transactions[]=array(
            	"obj_id"=>$don['obj_id'], 
            	"usr_id_buyer"=>$don['usr_id_buyer'],
            	"pur_date"=>$don['pur_date']);
        }
        return array("success"=>$transactions);
	}

	/**
	* Récuperer les utilisateurs
	* 
	* @return array $users
	*/
	public function get_users() {
		$users = array();
		$res = $this->db->query("SELECT usr_id, usr_lastname, usr_firstname FROM ts_user_usr;");
        while ($don = $this->db->fetchArray($res)) {
            $users[]=array(
            	"user_id"=>$don['usr_id'], 
            	"usr_lastname"=>$don['usr_lastname'],
            	"usr_firstname"=>$don['usr_firstname']);
        }
        return array("success"=>$users);
	}


	/** 
	* Stats de base sur le nombre de personne et la sommde d'argent sur leur compte
	*
	* @return array $data
	*/
	public function stat_argent() {
		$res = $this->db->query("SELECT COUNT( * ) , SUM( usr_credit ) FROM  `ts_user_usr`;");
        $don = $this->db->fetchArray($res);
        return array("success"=>$don);
	}

}


