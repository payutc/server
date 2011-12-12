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
 * SBUY.class
 * 
 * Classe pour le WSDL utilisé sur les clients type site étu
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/Buy.class.php';
require_once 'class/Buyer.class.php';
require_once 'class/Sherlocks.class.php';

class SBUY extends Buy {
	
	/**
	 * Connecter le user.
	 * 
	 * @param String $data
	 * @param String $passwd
	 * @param int $meanOfLogin
	 * @param String $ip
	 * @return int $state
	 */
    public function login($data, $meanOfLogin, $pass, $ip) {
    	
    	$this->Point = new Point(1);
		
		return parent::loadBuyer($data, $meanOfLogin, $pass, $ip);
    }
	
	/**
	 * Recharger un buyer.
	 * 
	 * @param int $amount
	 * @param int $rty_id
	 * @param String $trace
	 * @return int $state
	 */
	public function reload($amount, $rty_id, $trace) {
		if (isset($this->Buyer)) {
			$trace .= " via SBUY";
			return parent::reload($amount, $rty_id, $trace, $this->Buyer->getId());
		}
		else
			return 409;
	}
	
	/**
	 * Acheter ou sélectionner un objet.
	 * 
	 * @param int $obj_id
	 * @param int $obj_credit
	 * @param String $trace
	 * @return int $state
	 */
	public function select($obj_id, $obj_credit, $trace) {		
		if (isset($this->Buyer)) {
			$trace .= " via SBUY";
			return parent::select($obj_id, $obj_credit, $trace, $this->Buyer->getId());
		}
		else
			return 409;
	}
	
    /**
     * Renvoi le crédit du user.
     * 
     * @return int $credit
     */
    public function getCredit() {
        return $this->Buyer->getCredit();
    }	
	
    /**
     *
     * @param int $amount
     * @return String $csv
     */
     
    public function transactionEncode($amount) {
        $sh = new Sherlocks($this->Buyer);
        $txt = new ComplexData($sh->encode($amount));
        return $txt->csvArrays();
    }
    
    /**
     *
     * @param String $post
     * @return int $state
     */
     
    public function transactionDecode($post) {
        $sh = new Sherlocks($this->Buyer); //attention this->buyer pas instancié - voir pour le mettre en statique
        $rtn = $sh->decode($post);
        if ($rtn[0] == 1) {
            //$this->log->log(__FILE__.' : '.__LINE__.' rtn reload sherlocks '.$rtn[1].' '.$rtn[2], Zend_Log::WARN);
            $trace = "via sherlocks ".$rtn[0];
			$this->db->query("UPDATE ts_user_usr SET usr_credit = (usr_credit + '%u') WHERE usr_id = '%u';", Array($rtn[1], $rtn[2]));
            if ($this->db->affectedRows() == 1) {
                $trace .= " via BUYsherlocks";			
				$this->db->query(("INSERT INTO t_recharge_rec (rty_id, usr_id_buyer, usr_id_operator, poi_id, rec_date, rec_credit, rec_trace) VALUES ('%u', '%u', '%u', '%u', NOW(), '%u', '%s')"), array(3, $rtn[2], $rtn[2], 1, $rtn[1], $trace));
                $Buyer = new Buyer($rtn[2], 3, '', '', 1);
				//mail
                $subject = 'Rechargement Buckutt';
                $message = 'Bonjour '.$Buyer->getFirstname().' '.$Buyer->getLastname().',<br>
<br>
Tu viens d&#39;effectuer un rechargement sur ton porte-monnaie électronique BuckUTT.<br>
<br>
Ton numéro de rechargement est le '.$this->db->insertId().'<br>

<br>

<div style="width: 640px; font-family: Arial,Helvetica,sans-serif; font-size: 11px;">--------------------------------------------------------------------------------------------<br>
<b>Montant rechargé : </b>'.($rtn[1] / 100).' euros<br>
--------------------------------------------------------------------------------------------<br><br>
<b>Informations complémentaires : </b><br>
Pour plus d&#39;informations : <a href="http://etu.utt.fr/buckutt">http://etu.utt.fr/buckutt</a><br>
Pour toute question : <a href="mailto:buckutt@utt.fr" target="_blank">buckutt@utt.fr</a><br>
<br>
<b>Mentions légales :</b><br>
Facture établie par : Association BDE UTT - 12, rue Marie Curie - 10000 - TROYES - FRANCE, à l&#39;attention de : '.$Buyer->getLastname().' '.$Buyer->getFirstname().' .<br>';

                $headers = 'From: buckutt@utt.fr'."\r\n".'Reply-To: buckutt@utt.fr'."\r\n".'Content-Type: text/html; charset=windows-1252'.'X-Mailer: PHP/'.phpversion();
                
                $err = mail($Buyer->getMail(), $subject, $message, $headers);
                /*
				if ($err) {
                	$this->log->log(__FILE__.' : '.__LINE__.' mail reload sherlocks bien reussi denvoie mail, contenu prevu '.$Buyer->getMail().$message, Zend_Log::WARN);
                   
                } else {
                   $this->log->log(__FILE__.' : '.__LINE__.' /!\ mail reload sherlocks echec denvoie mail, contenu prevu '.$Buyer->getMail().$message, Zend_Log::WARN);
                }
                */
                return 1;
            } else {
                return 405;
            }
            //$this->log->log(__FILE__.' : '.__LINE__.' rtn reload sherlocks '.$tmp, Zend_Log::WARN);
            return $tmp;
        } else {
            return $rtn[0];
        }
    }
    
    /**
     *
     * @param String $post
     * @return String $state
     */
     
    public function transactionClientDecode($post) {
        $sh = new Sherlocks($this->Buyer);
        $txt = new ComplexData($sh->ClientDecode($post));
        return $txt->csvArrays();
    }
    


}

/*SOAP-ISATION PAR CLASSE*/
$name_class = 'SBUY';
require ('inc/wsdl.inc.php');

?>
