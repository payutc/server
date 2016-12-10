<?php



namespace Payutc\Service;
use \Payutc\Db\Dbal;
use \Payutc\Config;
use \Payutc\Log;
use \Payutc\Bom\Transaction;
use \Payutc\Exception\TransferException;

/**
 * RELOAD.php
 *
 * Ce service expose les méthodes pour permettre d'effectuer le rechargement d'un compte utilisateur.
 *
 */
class RELOADPAPERCUT extends \ServiceBase {

    public function getSoldePaperCut() {
        try {
            $this->checkRight(true, false, false, null);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $confSQLReload = Config::get('papercut_mysql');
        $DB = new \Payutc\DB($confSQLReload['sql_host'], $confSQLReload['sql_user'], $confSQLReload['sql_pass'], $confSQLReload['sql_db']);
        $amounts = $DB->queryFirst("SELECT
                                SUM(amount) amount,
                                SUM(CASE WHEN fetched_by_papercut = 0 THEN amount ELSE NULL  END) waiting
                            FROM reloads
                            WHERE user_mail = :user_mail", ['user_mail' => $this->user()->getNickname()]);
        $amounts['amount'] = $amounts['amount']/100;
        $amounts['waiting'] = $amounts['waiting']/100;
        return json_encode($amounts);
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
            throw new TransferException("Mauvais montant entré");
        else
            $amount *= 1;

        $user = $this->user();

        if (!$user->isCotisant()) {
            throw new TransferException("Les non cotisants ne peuvent pas utiliser la fonction reloadPapercut.");
        } else if ($amount < 0) {
            Log::warn("TRANSFERT: Montant négatif par l'userID ".$user->getId()." vers PaperCut ");
            throw new TransferException("Tu ne peux pas faire un virement négatif (bien essayé)");
        } else if ($amount == 0) {
            throw new TransferException("Pas de montant saisi");
        } else if ($user->getCredit() < $amount) {
            throw new TransferException("Tu n'as pas assez d'argent pour réaliser ce virement");
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
                $tra_date = $transaction->getDate();

                $confSQLReload = Config::get('papercut_mysql');
                $DB = new \Payutc\DB($confSQLReload['sql_host'], $confSQLReload['sql_user'], $confSQLReload['sql_pass'], $confSQLReload['sql_db']);
                $id = $DB->query("INSERT INTO reloads (tra_id, user_mail, amount, tra_date) VALUES (:tra_id, :user_mail, :amount, :tra_date)", [
                        'tra_id' => $tra_id,
                        'user_mail' => $user->getNickname(),
                        'amount' => $amount,
                        'tra_date' => $tra_date
                    ]);
                // $id
                $conn->commit();

                return $amount;
            } catch (\Exception $e) {
                $conn->rollback();
                Log::error("Error during transaction for papercut transfer (".$user->getId()." amount: $amount): ".$e->getMessage());
                throw new TransferException("Une erreur inconnue s'est produite pendant le virement".$e->getMessage());
                return $e.getMessage();
            }

        }
    }

 }
