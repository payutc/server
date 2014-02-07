<?php 

namespace Payutc\Service;
use \Payutc\Exception\InvalidData;

/**
 * BLOCKED.services.php
 * 
 * Ce service permet de blocker des utilisateurs par les administrateurs d'une fundations (ayant les droits ALL ou BLOCKED)
 *
 */
class BLOCKED extends \ServiceBase {
	 
    public function __construct() {
        parent::__construct();
    }

    /** 
     * Retourne tous les utilisateurs bloqué au sein d'une fundations
     */
    public function getAll($fun_id, $usr_id=NULL) {
        // On verifie que l'application et l'user actuellement connectés ont bien les droits nécessaires
        $this->checkRight(true, true, true, $fun_id);
        return \Payutc\Bom\Blocked::getAll($fun_id, $usr_id);
    }

    /**
     * Block un user
     */
    public function block($usr_id, $fun_id, $raison, $date_fin=NULL, $date_debut=NULL) {
        $this->checkRight(true, true, true, $fun_id);

        if ($date_fin != NULL) {
            $date_fin = \DateTime::createFromFormat("Y-m-d H:i:s", $date_fin);
            if ($date_fin == False) {
                throw new InvalidData("Format de date de début incorrect");
            }
        }

        if ($date_debut != NULL) {
            $date_debut = \DateTime::createFromFormat("Y-m-d H:i:s", $date_debut);
            if ($date_debut == False) {
                throw new InvalidData("Format de date de fin incorrect");
            }
        }
        
        return \Payutc\Bom\Blocked::block($usr_id, $fun_id, $raison, $date_fin, $date_debut);
    }
     
     /**
      * Modifie le blocage d'un user
      */
    public function edit($blo_id, $fun_id, $raison=NULL, $date_fin=NULL) {
        $this->checkRight(true, true, true, $fun_id);

        if ($date_fin != NULL) {
            $date_fin = \DateTime::createFromFormat("Y-m-d H:i:s", $date_fin);
            if ($date_fin == False) {
                throw new InvalidData("Format de date de fin incorrect");
            }
        }
        
        return \Payutc\Bom\Blocked::edit($blo_id, $fun_id, $raison, $date_fin);
    }

    /**
     * Termine un blocage
     */
    public function remove($blo_id, $fun_id) {
        $this->checkRight(true, true, true, $fun_id);
        return \Payutc\Bom\Blocked::edit($blo_id, $fun_id, NULL, new \DateTime());
    }
    
}
