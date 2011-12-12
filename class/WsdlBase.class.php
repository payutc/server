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
 * WsdlBase.class
 * 
 * Classe comprenant des méthodes utiles à l'ensemble des WSDL.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/Image.class.php';
require_once 'class/Point.class.php';
require_once 'class/ComplexData.class.php';

class WsdlBase {
	
	protected $db;
	
	/**
	 * Constructeur.
	 */   
	public function __construct() {
		$this->db = Db_buckutt::getInstance();
	}
	
	/**
	* Récupérer les informations sur une erreur à partir de son id.
	*
	* @param int $id
	* @return String $csv
	*/
	public function getErrorDetail($id) {
		if (is_array($don = $this->db->fetchArray($this->db->query("SELECT err_code, err_name, err_description FROM ts_error_err WHERE err_code = '%u';", Array($id))))) {
			$txt = new ComplexData(array($don['err_code'],$don['err_name'],$don['err_description']));
			return $txt->csvArrays();
		} else {
			return "430";
		}
	}
	
	/**
	 * Récupérer les infos sur une image.
	 * 
	 * @param int $img_id
	 * @return String $csv
	 */
	public function getImage($img_id) {
		$image = new Image($img_id);
		$txt = new ComplexData($image->getDetailsImage());
		return $txt->csvArrays();
	}
	
    /**
     * Renvoyer la liste des points.
     * 
     * @return String $csv
     */
    public function getAllPoints() {
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT poi_id, poi_name FROM t_point_poi WHERE poi_removed = '0' ORDER BY poi_name ASC;");
		if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$txt->addLine(array($don['poi_id'], $don['poi_name']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
    }
	
	/**
	 * Récupérer le nom d'un point.
	 * 
	 * @param int $poi_id
	 * @return String $name
	 */
	public function getPointName($poi_id) {
		$Point = new Point($poi_id);
		if($Point->getState() == 1) {
			return $Point->getName();
		} else
			return $state;
	}
	
	/**
	 * Renvoie la liste des user pour un autocomplete.
	 * 
	 * @param String $queryString
	 * @return String $txt
	 */
	public function getRpcUser($queryString) {
		
		$res = $this->db->query("SELECT usr_id, usr_firstname, usr_lastname FROM ts_user_usr WHERE (UPPER(usr_firstname) LIKE '%s%%' OR UPPER(usr_lastname) LIKE '%s%%') ORDER BY usr_lastname ASC;", Array(strtoupper($queryString), strtoupper($queryString)));
		$txt = '';
		if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$user_info = "'".$don['usr_id']."!!!".$don['usr_firstname']."!!!".$don['usr_lastname']."'";
				$txt .= '<li onclick="fill('.$user_info.')">'.$don['usr_firstname'].' '.$don['usr_lastname'].'</li>'; 
			}
			
		}
		return $txt;
	}
	
    /**
     * retourne la liste de toutes les périodes
     * 
     * @return String $periodes
     */
    public function getAllPeriod() {
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT per_id, per_name FROM t_period_per WHERE per_name != '' AND per_removed = '0'", Array());
        while ($don = $this->db->fetchArray($res)) {
            $txt->addLine(array($don['per_id'], $don['per_name']));
        }
        return $txt->csvArrays();
    }
}
?>
