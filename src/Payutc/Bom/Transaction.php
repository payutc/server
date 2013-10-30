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
use \Payutc\Utils;
use \Payutc\Bom\User;
use \Payutc\Db\Dbal;
use \Payutc\Exception\InvalidData;
use \Payutc\Exception\PossException;
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
    protected $email;
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
        if(empty($this->token)){
            $this->token = Utils::getRandomString(32);
        
            Dbal::conn()->update('t_transaction_tra',
                array('tra_token' => $this->token),
                array('tra_id' => $this->id),
                array("string", "integer")
            );
        }
        
        return $this->token;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    // --- Helpers

    public function setEmail($email){
        if(!Utils::validateEmail($email)){
            throw new InvalidData("L'adresse email est incorrecte.");
        }
        
        $this->email = $email;
        
        Dbal::conn()->update('t_transaction_tra',
            array('tra_email' => $this->email),
            array('tra_id' => $this->id),
            array("string", "integer")
        );
    }
    
    public function getMontantTotal(){
        $total = 0;
        foreach($this->purchases as $purchase){
            $total += $purchase['pur_price'];
        }
        return $total;
    }
    
    public function abort(){
        if($this->status == 'V'){
            throw new TransactionAlreadyValidated();
        }
        
        if($this->status == 'A'){
            throw new TransactionAborted();
        }
        
        $conn->update('t_transaction_tra',
            array('tra_status' => 'A'),
            array('tra_id' => $this->id),
            array("string", "integer")
        );
        
        // TODO Callback if any
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
                    throw new NotEnoughMoney();
                }

                User::decCreditById($this->buyerId, $this->getMontantTotal());
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
        
        // TODO Callback if any
    }
    
    // --- Generators
    
    static protected function getQbBase(){
        return Dbal::createQueryBuilder()
            ->select('tra.tra_id', 'tra.tra_date', 'tra.tra_validated', 'tra.usr_id_buyer', 'tra.usr_id_seller',
                'tra.tra_email', 'tra.app_id',
                'tra.tra_status', 'tra.tra_callback_url', 'tra.tra_return_url', 'tra.tra_token',
                'tra.fun_id', 'pur.pur_id', 'pur.obj_id', 'pur.pur_qte', 'pur.pur_unit_price',
                'pur.pur_price', 'pur.pur_removed')
            ->from('t_transaction_tra', 'tra')
            ->innerJoin('tra', 't_purchase_pur', 'pur', 'pur.tra_id = tra.tra_id');
    }
    
    static public function getById($idTrans){
        Log::debug("Transaction: getById($idTrans)");

        $qb = self::getQbBase()
            ->where('tra.tra_id = :tra_id')
            ->setParameter('tra_id', $idTrans);
        return self::getByQb($qb);
    }
    
    static public function getByToken($token){
        Log::debug("Transaction: getByToken($token)");

        $qb = self::getQbBase()
            ->where('tra.tra_token = :tra_token')
            ->setParameter('tra_token', $token);
        return self::getByQb($qb);
    }
       
    static protected function getByQb($qb){
        Log::debug("Transaction: getByQb(...)");
        
        $query = $qb->execute();

        // Check that the transaction exists
        if ($query->rowCount() == 0) {
            Log::warn("Transaction: Transaction not found");
            throw new TransactionNotFound("La transaction n'existe pas");
        }
                        
        // Get remaining data from the database
        $don = $query->fetch();
        
        $transaction = new Transaction();
        $transaction->id = $don['tra_id'];
        $transaction->date = $don['tra_date'];
        $transaction->validatedDate = $don['tra_validated'];
        $transaction->buyerId = $don['usr_id_buyer'];
        $transaction->sellerId = $don['usr_id_seller'];
        $transaction->email = $don['tra_email'];
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
    
    static public function create($buyer, $seller, $appId, $funId, $objects, $callbackUrl = null, $returnUrl = null){
        $conn = Dbal::conn();
        
        // Create a list of all the IDs we want to buy
        $objectsIds = array();
        foreach($objects as $object){
            $objectsIds[] = $object[0];
        }
        
        // Get all the corresponding products
        $products = Product::getAll(array('itm_ids' => array_unique($objectsIds), 'fun_ids' => array($funId)));
        
        // Index the products by their ID
        $items = array();
        foreach($products as $item) {
            $items[$item['id']] = $item;
        }
        
        try {
            $conn->beginTransaction();
            
            $buyerId = $buyer ? $buyer->getId() : null;
            $sellerId = $seller ? $seller->getId() : null;

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

            // Go through all the products we are buying
            foreach($objects as $object){
                // If the product does not exist, fail
                if(!isset($items[$object[0]])){
                    Log::warn("Transaction::create(...) : ${object[0]} is unavailable");
                    throw new PossException("L'article ${object[0]} n'est pas disponible à la vente.");
                }
                
                // The product that we are buying
                $product = $items[$object[0]];
            
                // If alcohol and our buyer is <18, then fail
                if ($product['alcool'] > 0 && $buyer->isAdult() == 0) {
                    Log::warn("transaction($badge_id, $obj_ids) : Under-18 users can't buy alcohol");
                    throw new PossException($buyer->getNickname()." est mineur il ne peut pas acheter d'alcool !");
                }
                
                // If there is no quantity for this product, fail
                if(count($object) != 2 || empty($object[1])){
                    Log::warn("transaction($fun_id, $badge_id, $obj_ids) : Null quantity for article $object[0]");
                    throw new PossException("La quantité pour l'article est $object[0] nulle.");
                }
            
                // Add the product to the transaction
                $conn->insert('t_purchase_pur', array(
                    'tra_id' => $transactionId,
                    'obj_id' => $product['id'],
                    'pur_qte' => $object[1],
                    'pur_price' => $product['price'] * $object[1],
                    'pur_unit_price' => $product['price'],
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
    
    static public function createAndValidate($buyer, $seller, $appId, $funId, $items, $callbackUrl = null, $returnUrl = null){
        $conn = Dbal::conn();
        
        try {
            // This is the only real transaction, all other nested transactions are virtual
            // See http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/transactions.html
            $conn->beginTransaction();
            
            $transaction = self::create($buyer, $seller, $appId, $funId, $items, $callbackUrl, $returnUrl);
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
