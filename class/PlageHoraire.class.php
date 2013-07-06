<?php 

/**
 * PlageHoraire.class
 * 
 * Classe gérant les plages horaires
 * @author payutc <payutc@assos.utc.fr>
 * @version 2.0
 * @package buckutt
 */

use \Payutc\Db\DbBuckutt;

class PlageHoraire {

    protected $user;
	protected $id;
	protected $time_start;
	protected $time_end;
	protected $poi_id;
	protected $fun_id;
	protected $name;
	protected $db;
	protected $result;

    /**
     * Constructeur.
     * 
     * @param User $user
     * @param int $id
	 * @param int $time_start
	 * @param int $time_end
	 * @param int $poi_id
	 * @param int $fun_id
	 * @param string $name
	 * @return void
     */
    public function __construct(&$user, $id, $time_start, $time_end, $poi_id, $fun_id, $name)
    {
        $this->db = DbBuckutt::getInstance();
        $this->user = $user;
        $this->id = $id;
        $this->time_start = $time_start;
        $this->time_end = $time_end;
        $this->poi_id = $poi_id;
        $this->fun_id = $fun_id;
        $this->name = $name;
    }

    /**
    * Rappatrie l'objet uniquement à partir de son ID.
    */
    public function get_object() {
        $res = $this->db->query("SELECT pla.pla_id, pla.fun_id, poi.poi_id, poi.poi_name, pla.pla_start, pla.pla_end, pla.pla_name
FROM t_plage_pla pla, t_point_poi poi
WHERE poi.poi_id = pla.poi_id AND pla.pla_id = '%u' ORDER BY pla.pla_start;", Array($this->id));
        if ($this->db->affectedRows() >= 1) {
            $don = $this->db->fetchArray($res);
            $this->time_start = $don['pla_start'];
            $this->time_end = $don['pla_end'];
            $this->poi_id = $don['poi_id'];
            $this->fun_id = $don['fun_id'];
            $this->name = $don['pla_name'];  
        }
    }
	
    /**
    * Insertion 
    *
    * @return void		
    */
    public function insert() {
        if($this->time_start > $this->time_end)
            return array("error"=>400, "error_msg"=>"L'heure de début ne peut pas être supérieur à l'heure de fin.");
        $right = new CheckRight($this->user->getId(), $this->poi_id, $this->fun_id);
        if(!$right->check("ADMIN"))
            return array("error"=>400, "error_msg"=>"Vous n'avez pas le droit ADMIN sur cette fundation.");
        if(!$right->check("POI-FUNDATION"))
            return array("error"=>400, "error_msg"=>"La fundation n'a pas le droit d'utiliser ce POI.");
        else {
            // VERIFICATION QUE LA PLAGE N'ENTRE PAS EN COLISION
            $plages = array();
            $res = $this->db->query("SELECT pla.pla_id, poi.poi_id, poi.poi_name, pla.pla_start, pla.pla_end, pla.pla_name
    FROM t_plage_pla pla, t_point_poi poi
    WHERE poi.poi_id = pla.poi_id AND pla.fun_id = '%u' AND pla.poi_id = '%u' AND pla.pla_start < '%u' AND pla.pla_end > '%u' ORDER BY pla.pla_start;", 
    Array($this->fun_id, $this->poi_id, $this->time_end, $this->time_start));
        if ($this->db->affectedRows() >= 1) {
            return array("error"=>400, "error_msg"=>"Vous ne pouvez pas créer cette plage horaire, elle croise une autre plage sur le même point de vente.");
        }

            // INSERTION
            $this->db->query(
                  "INSERT INTO  `payutc`.`t_plage_pla` (
`pla_id` ,
`fun_id` ,
`poi_id` ,
`pla_start` ,
`pla_end` ,
`pla_name`
)
VALUES (
NULL ,  '%u',  '%u',  '%u', '%u',  '%s'
);", 
                  array($this->fun_id, $this->poi_id, $this->time_start, $this->time_end, $this->name));
            return array("success"=>"ok");
        }
    }

    /**
    * Suppression
    *
    * @return void      
    */
    public function rm() {
        $this->get_object();
        $right = new CheckRight($this->user->getId(), $this->poi_id, $this->fun_id);
        if(!$right->check("ADMIN"))
            return array("error"=>400, "error_msg"=>"Vous n'avez pas le droit ADMIN sur cette fundation.");
        $this->db->query(
                  "DELETE FROM t_plage_pla WHERE pla_id = '%u';",array($this->id));

        return array("success"=>"ok");
    }

    /**
    * Obtenir les plages horaires d'une fundation
    */
    public function get_all_fundation($fun_id) {
        // TODO : Faut il protéger cette function ? (Pour l'instant tout le monde peut demander)
        $plages = array();
        $res = $this->db->query("SELECT pla.pla_id, poi.poi_id, poi.poi_name, pla.pla_start, pla.pla_end, pla.pla_name
FROM t_plage_pla pla, t_point_poi poi
WHERE poi.poi_id = pla.poi_id AND pla.fun_id = '%u' ORDER BY pla.pla_start;", Array($fun_id));
        while ($don = $this->db->fetchArray($res)) {
            $plages[]=array(
                "id"=>$don['pla_id'], 
                "poi_id"=>$don['poi_id'],
                "poi_name"=>$don['poi_name'],   
                "start"=>$don['pla_start'], 
                "end"=>$don['pla_end'], 
                "name"=>$don['pla_name']);
        }
        return array("success"=>$plages);
    }

}
?>