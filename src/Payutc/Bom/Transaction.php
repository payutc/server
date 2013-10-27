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
use \Payutc\Db\Dbal;
use \Payutc\Exception\TransactionNotFound;

class Transaction {
    protected $id;
    protected $date;
    protected $buyerId;
    protected $sellerId;
    protected $appId;
    protected $funId;
    protected $purchases;
    
    public function getPurchases(){
        return $this->purchases;
    }
    
    public function getMontantTotal(){
        $total = 0;
        foreach($this->purchases as $purchase){
            $total += $purchase['pur_price'];
        }
        return $total;
    }
    
    static public function getById($idTrans){
        Log::debug("Transaction: getById($idTrans)");    
        
        $query = Dbal::createQueryBuilder()
            ->select('tra.tra_id', 'tra.tra_date', 'tra.usr_id_buyer', 'tra.usr_id_seller', 'tra.poi_id', 
                'tra.fun_id', 'pur.pur_id', 'pur.obj_id', 'pur.pur_qte', 'pur.pur_unit_price',
                'pur.pur_price', 'pur.pur_removed')
            ->from('t_transaction_tra', 'tra')
            ->innerJoin('tra', 't_purchase_pur', 'pur', 'pur.tra_id = tra.tra_id')
            ->where('tra.tra_id = :tra_id')
            ->setParameter('tra_id', $idTrans)
            ->execute();

        // Check that the transaction exists
        if ($query->rowCount() == 0) {
            Log::debug("Transaction: Transaction $idTrans not found");
            throw new TransactionNotFound("La transaction $idTrans n'existe pas");
        }
                        
        // Get remaining data from the database
        $don = $query->fetch();
        
        $transaction = new Transaction();
        $transaction->id = $don['tra_id'];
        $transaction->date = $don['tra_date'];
        $transaction->buyerId = $don['usr_id_buyer'];
        $transaction->sellerId = $don['usr_id_seller'];
        $transaction->appId = $don['fun_id'];
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
    
    
}