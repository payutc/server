<?php 

/**
 * CheckRight.class
 * 
 * Classe gérant les plages horaires
 * @author payutc <payutc@assos.utc.fr>
 * @version 2.0
 * @package buckutt
 */

use \Payutc\Db\DbBuckutt;

class CheckRight {

    protected $user_id;
    protected $poi_id;
	protected $fun_id;
	protected $db;

    /**
     * Constructeur.
     * 
     * @param int $user_id
	 * @param int $poi_id
	 * @param int $fun_id
	 * @param string $right
	 * @return void
     */
    public function __construct($user_id, $poi_id, &$fun_id)
    {
        $this->db = DbBuckutt::getInstance();
        $this->user_id = $user_id;
        $this->poi_id = $poi_id;
        if($fun_id == NULL) {
			$res = $this->db->query("SELECT tj1.fun_id FROM tj_usr_rig_jur tj1, tj_usr_rig_jur tj2 WHERE 
			tj1.fun_id = tj2.fun_id
			AND tj1.rig_id = '%u' 
			AND tj1.usr_id = '%u'
			AND tj2.rig_id = '%u'
			AND tj2.poi_id = '%u'", array(5, $user_id, 7, $poi_id));
			if ($this->db->affectedRows() >= 0) {
				$don = $this->db->fetchArray($res);
				$fun_id = $don['fun_id'];
			}

		}
		$this->fun_id = $fun_id;

    }

    public function check($right) {
    	// CONSTANTE POUR LES DROITS, A METTRE AILLEURS...
		$right_admin = array(1, 2);
		$right_fundation = array(2, 4, 5, 6);
		$right_fundation_name = array("ADMIN", "GESARTICLE", "VENDRE", "TRESO");
		$right_name_to_id = array("ADMIN"=>2, "GESARTICLE"=>6, "VENDRE"=>5, "TRESO"=>4, "POI-FUNDATION"=>7);
		$right_id_to_name = array(2=>"ADMIN", 6=>"GESARTICLE", 5=>"VENDRE", 4=>"TRESO", 7=>"POI-FUNDATION");

		$right_user_fundation = array(2, 4, 5, 6);
		$right_poi_fundation = array(7);


		$right_id = $right_name_to_id[$right];
		if(in_array($right_id, $right_user_fundation))
			$res = $this->db->query("SELECT jur_id
						FROM tj_usr_rig_jur
						WHERE usr_id = '%u' AND rig_id = '%u' AND fun_id = '%u';", array($this->user_id, $right_id, $this->fun_id));
		else if(in_array($right_id, $right_poi_fundation))
			$res = $this->db->query("SELECT jur_id
						FROM tj_usr_rig_jur
						WHERE poi_id = '%u' AND rig_id = '%u' AND fun_id = '%u';", array($this->poi_id, $right_id, $this->fun_id));
		if ($this->db->affectedRows() == 0) {
	        return False;
	    }	

    	return True;
    }
}
?>