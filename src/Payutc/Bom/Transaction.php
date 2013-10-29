<?php 
/**
*    payutc
*    Copyright (C) 2013 payutc <payutc@assos.utc.fr>
*
*    This file is part of payutc
*    
*    payutc is free software: you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    payutc is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace Payutc\Bom;

use \Payutc\Log;
use \Payutc\Bom\User;
use \Payutc\Db\Dbal;
use \Payutc\Exception\NotEnoughMoney;
use \Payutc\Exception\TransactionAborted;
use \Payutc\Exception\TransactionNotFound;
use \Payutc\Exception\TransactionAlreadyValidated;

class Transaction {
    protected $id;
    protected $date;
    protected $validatedDate;
    protected $buyerId;
    protected $sellerId;
    protected $appId;
    protected $funId;
    protected $purchases;
    protected $status;
    protected $callbackUrl;
    protected $returnUrl;
    protected $token;
    
    // --- Simple getters
    
    public function getId(){
        return $this->id;
    }
    
    public function getDate(){
        return $this->date;
    }
    
    public function getValidatedDate(){
        return $this->validatedDate;
    }
    
    public function getBuyerId(){
        return $this->buyerId;
    }
    
    public function getSellerId(){
        return $this->sellerId;
    }
    
    public function getFunId(){
        return $this->funId;
    }
    
    public function getPurchases(){
        return $this->purchases;
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function getCallbackUrl(){
        return $this->callbackUrl;
    }
    
    public function getReturnUrl(){
        return $this->returnUrl;
    }
    
    public function getToken(){
        // TODO
    }
    
    public function setEmail(){
        // TODO + throw exception if invalid
    }
    
    // --- Helpers
    
    public function getMontantTotal(){
        $total = 0;
        foreach($this->purchases as $purchase){
            $total += $purchase['pur_price'];
        }
        return $total;
    }

    public function validate(){
        if($this->status == 'V'){
            throw new TransactionAlreadyValidated();
        }
        
        if($this->status == 'A'){
            throw new TransactionAborted();
        }

        $conn = Dbal::conn();
        $conn->beginTransaction();

        try {
            // Set the status to validated
            $now = new \DateTime();
            $rows = $conn->update('t_transaction_tra',
                array('tra_status' => 'V',
                    'tra_validated' => $now),
                array('tra_id' => $this->id),
                array("string", "datetime", "integer")
            );

            // Check that the transaction exists (this should never happen as object is instanciated)
            if ($rows == 0) {
                Log::error("Transaction: Transaction $idTrans not found when validating");
                throw new TransactionNotFound("La transaction $idTrans n'existe pas");
            }
            
            // Remove stock for each product
            foreach($this->purchases as $purchase){
                Product::decStockById($purchase['obj_id'], $purchase['pur_qte']);
            }
            
            // Remove money from user
            if($this->buyerId != null){
                $total = $this->getMontantTotal();
                $buyer = User::getById($this->buyerId);
                
                if($total > User::getCreditById($this->buyerId)){
                    throw new NotEnougMoney();
                }

                User::decCreditById($this->buyerId, $this->getMontantTotal());
            }
            else {
                // TODO Check that payline payment equals transaction total amount
            }
            
            $conn->commit();
        }
        catch (\Exception $e) {
            $conn->rollback();
            throw $e;
        }
        
        // Updated the BOM
        $this->validatedDate = $now;
        $this->status = 'V';
        
        // Send callback if any
        // TODO
    }
    
    // --- Generators
    
    static public function getById($idTrans){
        Log::debug("Transaction: getById($idTrans)");    
        
        $query = Dbal::createQueryBuilder()
            ->select('tra.tra_id', 'tra.tra_date', 'tra.tra_validated', 'tra.usr_id_buyer', 'tra.usr_id_seller', 'tra.app_id',
                'tra.tra_status', 'tra.tra_callback_url', 'tra.tra_return_url', 'tra.tra_token',
                'tra.fun_id', 'pur.pur_id', 'pur.obj_id', 'pur.pur_qte', 'pur.pur_unit_price',
                'pur.pur_price', 'pur.pur_removed')
            ->from('t_transaction_tra', 'tra')
            ->innerJoin('tra', 't_purchase_pur', 'pur', 'pur.tra_id = tra.tra_id')
            ->where('tra.tra_id = :tra_id')
            ->setParameter('tra_id', $idTrans)
            ->execute();

        // Check that the transaction exists
        if ($query->rowCount() == 0) {
            Log::warn("Transaction: Transaction $idTrans not found");
            throw new TransactionNotFound("La transaction $idTrans n'existe pas");
        }
                        
        // Get remaining data from the database
        $don = $query->fetch();
        
        $transaction = new Transaction();
        $transaction->id = $don['tra_id'];
        $transaction->date = $don['tra_date'];
        $transaction->validatedDate = $don['tra_validated'];
        $transaction->buyerId = $don['usr_id_buyer'];
        $transaction->sellerId = $don['usr_id_seller'];
        $transaction->appId = $don['app_id'];
        $transaction->funId = $don['fun_id'];
        $transaction->status = $don['tra_status'];
        $transaction->callbackUrl = $don['tra_callback_url'];
        $transaction->returnUrl = $don['tra_return_url'];
        $transaction->token = $don['tra_token'];
        $transaction->purchases = array();
        do {
            $transaction->purchases[] = array(
                'pur_id' => $don['pur_id'],
                'obj_id' => $don['obj_id'],
                'pur_qte' => $don['pur_qte'],
                'pur_unit_price' => $don['pur_unit_price'],
                'pur_price' => $don['pur_price'],
                'pur_removed' => $don['pur_removed']
            );            
        } while($don = $query->fetch());
        
        return $transaction;
    }
    
    static public function create($buyerId, $sellerId, $appId, $funId, $items, $callbackUrl = null, $returnUrl = null){
        $conn = Dbal::conn();        
        // TODO check que les articles existent et que leurs prix sont ok (cf poss3)            
        
        try {
            $conn->beginTransaction();

            // Insert the transaction
            $conn->insert('t_transaction_tra', array(
                'tra_date' => new \DateTime(),
                'usr_id_buyer' => $buyerId,
                'usr_id_seller' => $sellerId,
                'app_id' => $appId,
                'fun_id' => $funId,
                'tra_status' => 'W',
                'tra_callback_url' => $callbackUrl,
                'tra_return_url' => $returnUrl
            ), array("datetime", "integer", "integer", "integer", "integer", "string", "string", "string", "string"));
            
            $transactionId = $conn->lastInsertId();

            // Build the purchases (transaction ID is required here)
            foreach ($items as $itm) {
                $conn->insert('t_purchase_pur', array(
                    'tra_id' => $transactionId,
                    'obj_id' => $itm['id'],
                    'pur_qte' => $itm['qte'],
                    'pur_price' => $itm['price'] * $itm['qte'],
                    'pur_unit_price' => $itm['price'],
                ), array("integer", "integer", "integer", "integer", "integer"));                
            }

            $conn->commit();
        }
        catch (\Exception $e) {
            $conn->rollback();
            throw $e;
        }
        
        return self::getById($transactionId);
    }
    
    static public function createAndValidate($buyerId, $sellerId, $appId, $funId, $items, $callbackUrl = null, $returnUrl = null){
        $conn = Dbal::conn();
        
        try {
            // This is the only real transaction, all other nested transactions are virtual
            // See http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/transactions.html
            $conn->beginTransaction();
            
            $transaction = self::create($buyerId, $sellerId, $appId, $funId, $items, $callbackUrl, $returnUrl);
            $transaction->validate();
            
            $conn->commit();
        }
        catch (\Exception $e){
            $conn->rollback();
            throw $e;
        }
        
        return $transaction;
    }
}