<?php

namespace Payutc\Service;

use \Payutc\Config;
use \Payutc\Bom\Purchase;
use \Payutc\Bom\User;
use \Payutc\Bom\Reversement;
use \Payutc\Bom\Fundation;
use \Payutc\Exception\InvalidData;
use \Payutc\Exception\PayutcException;
use \Payutc\Exception\TransactionNotFound;

/**
 * TRESO.php
 *
 * Ce service permet la gestion par les tresoriers
 *
 */

class TRESO extends \ServiceBase {

     /*
        Retourne une série de montant important.
        Si fun_id == null (=> Administrateur)
            * Soldes des comptes
            * Montant théorique sur le compte bancaire
            * Montant encaissé par les assos non reversé
            ...
        Sinon retourne des détails pour la fundation donné
            * Montant total encaissé depuis toujours
            * Montant a reverser par payutc
            * Date du dernier reversement
     */
     public function getDetails($fun_id = null) {
        $this->checkRight(true, true, true, $fun_id);
        if($fun_id == null) {
            $fundations = array();
            foreach(Fundation::getAll() as $fun) {
                $fundation = array();
                $fundation['id'] = $fun->getId();
                $fundation['name'] = $fun->getName();
                $fundation['amount_total'] = Purchase::getRevenue($fun->getId());
                $fundation['reversement_total'] = Reversement::getTotal($fun->getId());
                $fundation['reversement_wait'] = Reversement::getLast($fun->getId(), 'W');
                $fundation['reversement_last'] = Reversement::getLast($fun->getId());
                $fundations[] = $fundation;
            }
            return array(
                "amount_total" => Purchase::getRevenue(), // Montant total encaissé par les fundations
                "account_total" => User::getSumCredit(),  // Montant total présent sur les comptes
                "reversement_total" => Reversement::getTotal(), // Montant total reversé
                "reversement_wait" => Reversement::getWait(), // Montant total en attente
                "reversements" => Reversement::getAll(), // Tout les reversements
                "fundations" => $fundations
                );
        } else {
            return array(
                "amount_total" => Purchase::getRevenue($fun_id),        // Montant total encaissé par la fundation
                "reversement_total" => Reversement::getTotal($fun_id),  // Montant total déjà reversé
                "reversement_wait" => Reversement::getLast($fun_id, 'W'),           // Montant total en attente
                "reversement_last" => Reversement::getLast($fun_id),    // Date et montant du dernier reversement
                "reversements" => Reversement::getAll($fun_id)
                );
        }
     }

     public function getExport($fun_id, $start=null, $end=null){
          $this->checkRight(true, true, true, $fun_id);
          return Purchase::getDetails($fun_id, $start, $end);
     }

     public function askReversement($fun_id) {
        $this->checkRight(true, true, true, $fun_id);
        $rev = new Reversement($fun_id, $this->user()->getId());
        return $rev->insert();
     }

     public function getReversement($rev_id, $fun_id=null) {
        $this->checkRight(true, true, true, $fun_id);
        return Reversement::getById($rev_id, $fun_id);
     }

     public function makeReversement($rev_id, $taux, $frais) {
        $this->checkRight(true, true, true, null);
        $rev = Reversement::getById($rev_id);
        $rev->taux = $taux;
        $rev->frais = $frais;
        $rev->step = 'V';
        $rev->update($this->user()->getId());
     }

 }
