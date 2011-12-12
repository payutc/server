<?php 
/**
    BuckUTT - Buckutt est un système de paiement avec porte-monnaie électronique.
    Copyright (C) 2011 BuckUTT <buckutt@utt.fr>

	This file is part of BuckUTT
	
    BuckUTT is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    BuckUTT is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


class ComplexData {

    private $array_data;
    
    public final function __construct($data = 'void') {
        if ($data != 'void' && is_array($data)) {
            $this->array_data = $data;
        }
    }
    
    public function getData() {
        return $this->array_data;
    }
    /**
     * pour ajouter des trucs à la fin d'une ligne genre
     * $a1 = array("coca","60cts");
     * $a4 = array("foyer","cotiz bde");
     *  => array("coca","60cts","foyer","cotiz bde");
     * @param object $data
     * @return
     */
    public function addData($data) {
        $this->array_data = array_merge($this->array_data, $data);
    }
    
    /**
     * ajouter un array à la fin
     * @param object $data
     * @return
     */
    public function addLine($data) {
        $this->array_data[count($this->array_data)] = $data;
    }

    
    /**
     * ça prends en argument un array d'array genre
     * array( array("coca","60cts") , array("fanta","60cts") )
     * et donne
     * "coca","60cts";"fanta","60cts";
     * si ya un truc dedans qui n'est pas un array ça le mets dans une ligne seul
     * si y a rien ca renvoi false
     * @param object $tb
     * @return string $csvcomplet
     */
    public function csvArrays() {
        $txt = '';
	if (!empty($this->array_data)) {
        	if (is_array($this->array_data[0])) {
	            foreach ($this->array_data as $value) {
        	        $txt .= $this->csvLine($value);
	            }
	        } else {
        	    $txt = $this->csvLine($this->array_data);
		}
	        return utf8_encode($txt);
	} else { return false; }
    }
    
    /**
     * on donne un array d'une ligne
     * on recupere une ligne de csv
     * @param object $line
     * @return string $csvLine
     */
    public function csvLine($line) {
        return  utf8_encode('"'.implode('","', $line).'";'."\n");
    }
    
}

?>
