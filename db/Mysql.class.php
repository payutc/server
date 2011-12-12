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

/******************* page.class ***************************************
 Définition d'une page
 
 Changement effacement de l'afichage des ereurs !
 **********************************************************************/
 
class Mysql {
    private $connexion;

    
    function Mysql() {
    
    }
    
    function connect($db) {
        if (!$this->connexion = mysql_connect($db->host, $db->user, $db->pass)) {
            $this->error();
            exit;
        }
        if (!$result = mysql_select_db($db->base, $this->connexion)) {
            $this->error();
            exit;
        }
        //      mysql_query("SET NAMES 'utf8'", $this->connexion);
        //      mysql_query("SET CHARACTER SET utf8", $this->connexion);
        return ($result);
        
    }
    
    /**
     Execute une requete
     debug == 1 => on affiche la requete
     
     */
    function query($query, $debugorarg, $debug = 0) {
    	$debugorarg = array_map(addslashes, $debugorarg);
        if (is_array($debugorarg)) {
            //TODO : virer le ou 1
            if ($debug || 1) {
                $this->trace(vsprintf($query, $debugorarg));
            }
            //$var = fopen('/home/www-etu/losmysql','a');
            //fwrite($var,$query);
            
            //TODO commenter ça... car bug... à suivre car important niveau sécu
            //array_walk_recursive($debugorarg, 'mysql_escape_string');
            if (!$result = mysql_query(vsprintf($query, $debugorarg), $this->connexion)) {
                $this->error();
            }
            return ($result);
        } else {
            //TODO: virer le ou 1
            if ($debugorarg || 1) {
                $this->trace($query);
            }
            //$var = fopen('/home/www-etu/losmysql','a');
            //fwrite($var,$query);
            if (!$result = mysql_query($query, $this->connexion)) {
                $this->error();
            }
            return ($result);
        }

        
    }

    
    function fetchQueryToString($query, $debugorarg, $debug = 0) {
        if (is_array($debugorarg)) {
            //TODO : virer le ou 1
            if ($debug || 1) {
                $this->trace(vsprintf($query, $debugorarg));
            }
            //$var = fopen('/home/www-etu/losmysql','a');
            //fwrite($var,$query);
            if (!$result = mysql_query(vsprintf($query, $debugorarg), $this->connexion)) {
                $this->error();
            }
            $retour = "";
            while ($don = $this->fetchArray($result, MYSQL_NUM)) {
                $init = 1;
                foreach ($don as $key=>$d) {
                    $retour .= ($init ? '' : ',')."'".$d."'";
                    $init = 0;
                }
                $retour .= ";\n";
            }

            
            return ($retour);
        } else {
            //TODO: virer le ou 1
            if ($debugorarg || 1) {
                $this->trace($query);
            }
            //$var = fopen('/home/www-etu/losmysql','a');
            //fwrite($var,$query);
            if (!$result = mysql_query($query, $this->connexion)) {
                $this->error();
            }
            $retour = "";
            while ($don = $this->fetchArray($result, MYSQL_NUM)) {
                $init = 1;
                foreach ($don as $key=>$d) {
                    $retour .= ($init ? '' : ',')."'".$d."'";
                    $init = 0;
                }
                $retour .= ";\n";
            }

            
            return ($retour);
        }

        
    }
    
    //Retourne un champ de résultat
    function result($result, $column) {
        $result = mysql_result($result, $column);
        return $result;
    }
    
    //Retourne l'id du dernier INSERT
    function insertId() {
        $result = mysql_insert_id();
        return $result;
    }
    
    //Retourne  le nombre de lignes d'un SELECT
    function numRows($result) {
        if ($result) {
            $result = mysql_num_rows($result);
            return $result;
        } else {
            return 0;
        }
    }
    
    //décompose un resultSet dans un tableau
    function fetchArray($result, $type = '') {
        if ($type != '') {
            $result = mysql_fetch_array($result, $type);
        } else {
            $result = mysql_fetch_array($result);
        }
        return $result;
    }
    
    //Retourne le nombre de lignes affectées lors de la dernière requête INSERT, UPDATE, REPLACE ou DELETE
    function affectedRows() {
        $result = mysql_affected_rows($this->connexion);
        return $result;
    }
    
    //retourne une chaîne protégée pour passage à mysql
    function escapeString($str) {
        $result = mysql_escape_string($str);
        return $result;
    }
    
    //Ferme une connexion
    function close() {
        $result = mysql_close($this->connexion);
        return $result;
    }
    
    function trace($requette) {
        global $_SERVER;
        echo '<div style="background-color:#EEE;-moz-border-radius: 8px;border:2px black solid;" ><h3 style="background-color:#00DDDD;color:white;border:solid 1px black">Requette Mysql </h3><p style="">'.$requette.'</p></div>';
        
        $txt = "\n___________MYSQL______________\n".$requette;
        //file_put_contents("/media/gros/share/trace.log",file_get_contents("/media/gros/share/trace.log").$txt);
    }
    //Affiche l'erreur sql
    function error() {
        global $_SERVER;
        echo '<div style="background-color:#DDD;font-weight:bold;-moz-border-radius: 8px;border:2px black solid;width:350px" onclick="this.style.display = \'none\';"><h1 style="background-color:#DD0000;color:white;border:solid 1px black">Erreur Mysql (n°'.mysql_errno().')</h1><p style="">'.mysql_error().'</p></div>';
        $text = "\n ___________ERREUR____________________\nErreur n ".mysql_errno()." - ".date('r')." - ".$_SERVER["PHP_SELF"]."\n".mysql_error()."\n";
        //$txt = "\n___________MYSQL______________\n".$requette;
        //	file_put_contents("/media/gros/share/trace.log",file_get_contents("/media/gros/share/trace.log").$text);
        
    }
}

?>
