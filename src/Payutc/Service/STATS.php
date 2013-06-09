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
    public function getRank($fun_id, $obj_id=null, $semestre="P13", $top=20, $sort_by="nbBuy") {
        // Le client et l'user doivent avoir les droits stats !
        $this->checkRight(true, true, true, $fun_id);
        
        // Conversion de la période
        // TODO: A l'avenir une table devrait nous permettre de lier les semestres a des plages de dates
        switch($semestre) {
            case "A12":
                $start = "2012-08-01 00:00";
                $end = "2013-02-01 00:00";
                break;
            case "P13":
                $start = "2013-02-01 00:00";
                $end = "2013-08-01 00:00";
                break;
            default:
                throw new \Payutc\Exception\PayutcException("Période non reconnu !");
                break;
        }

        return \Payutc\Bom\Purchase::getRank($fun_id, $obj_id, $start, $end, $top, $sort_by);
    }

   
}
