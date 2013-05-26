<?php 

namespace Payutc\Service;

/**
 * STATS.php
 * 
 * Ce service permet la gestion des différentes statistiques
 * Les specs pour les futurs dévellopements de cette classe sont
 * disponible à l'adresse suivante: 
 *  https://docs.google.com/document/d/1Ir7hQsLljQ-lg5eywr8MN8x-IMZbEe7a9Pv7uOAb1Mg/edit?usp=sharing
 *
 */
class STATS extends \ServiceBase {

    /** 
     * Retourne le nombre de vente d'un objet (ou dans une catégorie donné)
     * 
     */
    public function getNbSell($obj_id, $fun_id, $start=null, $end=null, $tick=null) {
        // Il suffit de vérifier que l'application à les droits sur la fundation donné
        $this->checkRight(false, true, true, $fun_id);
        return \Payutc\Bom\Purchase::getNbSell($obj_id, $fun_id, $start, $end, $tick);
    }
    
}
