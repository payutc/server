<?php



namespace Payutc\Service;
use \Payutc\Db\Dbal;
use \Payutc\Config;
use \Payutc\Log;
use \Payutc\Bom\Transaction;

/**
 * RELOAD.php
 *
 * Ce service expose les méthodes pour permettre d'effectuer le rechargement d'un compte utilisateur.
 *
 */
class RELOADPAPERCUT extends \ServiceBase {

    public function getSoldePaperCut() {
        try {
            $this->checkRight(true, true, true, $fun_id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return 20;
    }

    /**
    * Fonction pour recharger un client.
    *
    * @param int $amount (en centimes)
    * @return int $amount en centimes
    */
    public function reload_papercut($amount) {
        // On a une appli qui a les droits ?

        $confPaperCut = Config::get('papercut');

        $fun_id = $confPaperCut['fun_id']; // PaperCut
        $article_id = $confPaperCut['obj_id']; // article

        try {
            $this->checkRight(true, true, true, $fun_id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        // On a un user ?
        if (!$this->user()) {
            throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur !");
        }


        // Verification de la possiblité de recharger
        if (!is_numeric($amount))
            throw new \Payutc\Exception\TransferException("Mauvais montant entré");
        else
            $amount *= 1;

        $user = $this->user();

        if (!$user->isCotisant()) {
            throw new \Payutc\Exception\TransferException("Les non cotisants ne peuvent pas utiliser la fonction reloadPapercut.");
        } else if ($amount < 0) {
            Log::warn("TRANSFERT: Montant négatif par l'userID ".$user->getId()." vers PaperCut ");
            throw new \Payutc\Exception\TransferException("Tu ne peux pas faire un virement négatif (bien essayé)");
        } else if ($amount == 0) {
            throw new \Payutc\Exception\TransferException("Pas de montant saisi");
        } else if ($user->getCredit() < $amount) {
            throw new \Payutc\Exception\TransferException("Tu n'as pas assez d'argent pour réaliser ce virement");
        } else {
            $conn = Dbal::conn();
            $conn->beginTransaction();
            try {

                $transaction = Transaction::createAndValidate(
                    $user, // Buyer
                    $user, // Seller
                    1, // appId
                    $fun_id, // funId
                    [[$article_id, $amount, null]] // objects
                );


                $c = $user->getCredit();
                $tra_id = $transaction->getId();

                $conn->commit();
                return $amount;
            } catch (\Exception $e) {
                $conn->rollback();
                Log::error("Error during transaction for transfer (from ".$this->getId()." to $userID amount: $amount): ".$e->getMessage());
                throw new TransferException("Une erreur inconnue s'est produite pendant le virement");
                return $e.getMessage();
            }

        }
    }

 }
