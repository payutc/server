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

use \Payutc\Db\DbBuckutt;

/**
 * Image.class
 *
 * Classe gérant les images.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */


class Image
{
	private $id;
    private $path;
	private $state;
	protected $db;

	/**
	* Constructeur
	*
	* @param string img_path
	* @return boolean $state
	*/
	public function __construct($path='', $img_id=0)
	{
		$this->db = DbBuckutt::getInstance();

		if ($img_id == 0) {
			$this->db->query("INSERT INTO ts_image_img (img_path) VALUES('%s')", array($path));
			if ($this->db->affectedRows() == 1) {
				$this->id = $this->db->insertId();
				$this->path = $path;
				$this->state = 1;
			} else {
				$this->state = 400;
			}
		} else {
			$this->id = $img_id;
			$don = $this->db->fetchArray($this->db->query("SELECT img_path FROM ts_image_img WHERE img_id = '%u';", Array($this->id)));
			if ($this->db->affectedRows() == 1) {
                $this->path = $don['img_path'];
				$this->state = 1;
			}
			else {
				$this->state = 400;
			}
		}
	}

	/**
	* Retourne $state
	*
	* @return string $state
	*/
	public function getState()
	{
		return $this->state;
	}

	/**
	* Retourne $id.
	*
	* @return int $id
	*/
	public function getId()
	{
		return $this->id;
	}

	/**
	* Retourne $path.
	*
	* @return int $path
	*/
	public function getPath()
	{
		return $this->path;
	}

    /**
    * Supprime l'image
    */
    public static function remove($img_id)
    {
        // TODO Supprimer le contenu de l'image aussi ? (Enfin à discuter)
        DbBuckutt::getInstance()->query("UPDATE ts_image_img SET img_removed = '1' WHERE img_id = '%u'", array($img_id));
    }


}
?>
