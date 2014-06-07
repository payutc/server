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

use \Payutc\Exception\FundationNotFound;
use \Payutc\Log;
use \Payutc\Db\Dbal;

/**
* Fundation
* 
* Object holding a fundation
*/
class Fundation {

    protected $id;
    protected $name;

    // --- Simple getters
    
    public function getId(){
        return $this->id;
    }
    
    public function getName(){
        return $this->name;
    }
    
    // --- Generators
    
    static protected function getQbBase(){
        return Dbal::createQueryBuilder()
            ->select('fun.fun_id', 'fun.fun_name')
            ->from('t_fundation_fun', 'fun')
            ->where('fun.fun_removed = 0');
    }
    
    static public function getById($funId){
        Log::debug("Fundation: getById($funId)");

        $qb = self::getQbBase()
            ->where('fun.fun_id = :fun_id')
            ->setParameter('fun_id', $funId);
        return self::getByQb($qb);
    }
       
    static protected function getByQb($qb){
        Log::debug("Fundation: getByQb(...)");
        
        $query = $qb->execute();

        // Check that the transaction exists
        if ($query->rowCount() == 0) {
            Log::warn("Fundation not found");
            throw new FundationNotFound("La fundation n'existe pas");
        }
                        
        // Get remaining data from the database
        $don = $query->fetch();
        
        $fundation = new Fundation();
        $fundation->id = $don['fun_id'];
        $fundation->name = $don['fun_name'];
        
        return $fundation;
    }
    
    public static function getAll() {
        $qb = self::getQbBase();
        $query = $qb->execute();
        $result = array();
        while($don = $query->fetch()) {
            $fundation = new Fundation();
            $fundation->id = $don['fun_id'];
            $fundation->name = $don['fun_name'];
            $result[] = $fundation;          
        };
        return $result;
    }
}
