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
 
    /**
     * Retourne le montant des ventes sur une période
     *
     * fun_id => Obligatoire
     * app_id => Pour récupérer les recettes d'une application seulement
     * $start => date de départ de la recherche, format mysql, si null pas de limite
     * $end => date de fin de la recherche, format mysql, si null pas de limite
     **/
    public function getRevenue($fun_id, $app_id=null, $start=null, $end=null, $tick=null) {
        $this->checkRight(false, true, true, $fun_id);

        return \Payutc\Bom\Purchase::getRevenue($fun_id, $app_id, $start, $end, $tick);
    }

    /**
     * Retourne le classement des ventes pour un objet sur une période
     *
     * $fun_id => Obligatoire, permet de vérifier les droits, l'obj_id doit correspondre.
     * $obj_id =>
     *      null (defaut) => Classement pour toutes les ventes de la fundation
     *      categorie => classement pour tous les produits de la categorie
     *      objet => Classement pour l'objet concerné
     * $semestre => "P13" 
     * $top => (Récupére uniquement les X premiers) (par défaut 20)
     * $by => "nbBuy" | "totalPrice"
     */
    public function getRank($fun_id, $obj_id=null, $semestre="A13", $top=20, $sort_by="nbBuy") {
        // Le client et l'user doivent avoir les droits stats !
        $this->checkRight(true, true, true, $fun_id);
        
        preg_match("/[AP]\d{2}/", $semestre, $output);
        if(count($output) != 1) {
            throw new \Payutc\Exception\PayutcException("Période non reconnu !");
        }

        $year = intval($output[0][1] . $output[0][2]);

        if($output[0][0] == 'A') {
            $start = "20" . $year . "-08-01 00:00";
            $end = "20" . $year . "-02-01 00:00";
        } else {
            $start = "20" . $year . "-02-01 00:00";
            $end = "20" . ($year+1) . "-08-01 00:00";
        }

        return \Payutc\Bom\Purchase::getRank($fun_id, $obj_id, $start, $end, $top, $sort_by);
    }

   
}
