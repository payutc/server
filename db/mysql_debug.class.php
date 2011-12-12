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


class mysql_debug {
	private $connexion;
	
	private $xdebug;
	private $debug;
	private $previous_debug;
	private $debug_result;
	
	private $key;
	
	private $last_query;
	
	function mysql_debug () {

	}


	function connect ($db) {
		$this->debug=array();
		$this->debug_result=array();
		$this->key=sha1($db->pass);
		if (!$this->connexion = mysql_connect($db->host,$db->user, $db->pass)) {
			$this->error();
			
			exit;
		}
		
		if (!$result = mysql_select_db($db->base, $this->connexion)) {
			$this->error();
			exit;
		}
		
		
		if (function_exists("xdebug_get_function_stack")) {
			$this->xdebug=true;
		} else {
			$this->xdebug=false;	
		}
		//debug connexion
		mysql_query("SET SESSION query_cache_type = OFF",$this->connexion);
		//      mysql_query("SET NAMES 'utf8'", $this->connexion);
		//      mysql_query("SET CHARACTER SET utf8", $this->connexion);
		return ($result);

	}

	/**
			Execute une requete
			debug == 1 => on affiche la requete

		*/
	function query($query, $debug = 0) {
		if ($debug) {
			echo $this->colorSyntax($query);
		}
		
		$error=false;
		//Deactivate the cache for all the request
		
		$nocache_query=str_ireplace("SELECT ","SELECT SQL_NO_CACHE ",$query);
		$time_before=microtime(true);		
		if (!$result = mysql_query($nocache_query, $this->connexion)) {
			$error=true;
		}
		$exec_time=microtime(true)-$time_before;
		
		$query_key=sha1($this->key.$query);
		$this->debug_result[$query_key]=$result;
		
		$this->debugLog($query,$error,$exec_time);
		return ($result);
	}

	//Retourne un champ de résultat
	function result($result, $column) {
		$key=$this->getKey($result);
		$time_before=microtime(true);
		$result = mysql_result($result,$column);
		$time=microtime(true)-$time_before;
		$this->updateLog($key, $time);
		//this is mainly used to read one field 
		// so we can use the debugLog here too
		//$this->debugLog();
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
			$key=$this->getKey($result);
			$time_before=microtime(true);
			$result = mysql_num_rows($result);
			$time=microtime(true)-$time_before;
			$this->updateLog($key, $time);
			return $result;
		} else {
			return 0;
		}
	}

	//décompose un resultSet dans un tableau
	function fetchArray($result,$type='') {
		if ($result) {
			if($type != ''){
				$key=$this->getKey($result);
				$time_before=microtime(true);
				$result = mysql_fetch_array($result,$type);
				$time=microtime(true)-$time_before;
				$this->updateLog($key, $time);
			}else{
				$key=$this->getKey($result);
				$time_before=microtime(true);
				$result = mysql_fetch_array($result);
				$time=microtime(true)-$time_before;
				$this->updateLog($key, $time);
			}
			if (!$result) {
				//we read the last result so we can launch the debug process
				//$this->debugLog();	
			}
		}
		
		return $result;
	}

	//retourne le nombre de lignes affectées par un UPDATE ou un DELETE
	function affectedRows() {
		$result = mysql_affected_rows($this->connexion);
		return $result;
	}

	//retourne une chaîne protégée pour passage à mysql
	function escapeString($str){
		$result = mysql_escape_string($str);
		return $result;
	}

	//Ferme une connexion
	function close() {
		$this->debugShow();
		$result = mysql_close($this->connexion);
		return $result;
	}

	function debugLog($query,$error,$exec_time) {
		$query_key=sha1($this->key.$query);
			
		if ($error) {
			$error_no=mysql_errno($this->connexion);	
			$error_txt=mysql_error($this->connexion);
		}
		if ($result = mysql_query("SHOW STATUS", $this->connexion)) {
			while ($row=mysql_fetch_array($result)) {
				if ($row[0]=="Last_query_cost") {
					if (isset($this->debug[$query_key])) {
						$this->debug[$query_key]["query"]=$query;
						$this->debug[$query_key]["nb_exec"]++;
						$this->debug[$query_key]["last_exec_cost"]=$row[1];
						$this->debug[$query_key]["cumul_exec_cost"]+=$row[1];
					} else {
						$this->debug[$query_key]=array();
						$this->debug[$query_key]["query"]=$query;
						$this->debug[$query_key]["nb_exec"]=1;
						$this->debug[$query_key]["last_exec_cost"]=$row[1];
						$this->debug[$query_key]["cumul_exec_cost"]=$row[1];
					}
				}
			}
		}
		if (!isset($this->debug[$query_key]["exec_time"])) {
			$this->debug[$query_key]["exec_time"]=$exec_time;
		} else {
			$this->debug[$query_key]["exec_time"]+=$exec_time;
		}
		if ($this->xdebug) {
			$this->debug[$query_key]["stack"]=xdebug_get_function_stack();
		}
		
		if ($error) {
			$this->debug[$query_key]["error"]["in_error"]=true;
			$this->debug[$query_key]["error"]["error_no"]=$error_no;
			$this->debug[$query_key]["error"]["error_txt"]=$error_txt;
		} else {
			$this->debug[$query_key]["error"]["in_error"]=false;
		}
		$this->previous_debug=$this->debug;
	}
	
	
	function getKey($result) {
		//echo "<pre>";
		//print_r($result);
		//print_r($this->debug_result);
		foreach (array_keys($this->debug_result) as $temp_key) {
			if ($this->debug_result[$temp_key]==$result) {
				return $temp_key;
				
			}
		}
		//echo "</pre>";
		//exit();
		return false;
	}
	
	function updateLog($key, $time) {
		if ($key) {
			if (!isset($this->debug[$key]["fetch"])) {
				$this->debug[$key]["fetch"]["nb"]=1;
				$this->debug[$key]["fetch"]["time"]=$time;
			} else {
				$this->debug[$key]["fetch"]["nb"]++;
				$this->debug[$key]["fetch"]["time"]+=$time;
			}
		}
	}

	//Affiche l'erreur sql
	function error() {
		global $_SERVER;
		echo '<div style="background-color:#DDD;font-weight:bold;-moz-border-radius: 8px;border:2px black solid;width:350px" onclick="this.style.display = \'none\';"><h1 style="background-color:#DD0000;color:white;border:solid 1px black">Erreur Mysql (n°'.mysql_errno().')</h1><p style="">'.mysql_error().'</p></div>';
		/*$file = fopen("sql.log","a",1);
		$text="\n Erreur n ".mysql_errno()." - ".date('r')." - ".$_SERVER["PHP_SELF"]."\n".mysql_error()."\n";
		fwrite($file, $text);
		fclose($file);*/
	}
	
	function debugShow() {
		global $core;
		
		
		$weight=array();
		$time=array();
		$total_time=array();
		$error=array();
		$has_error=false;
		$cumul_weight=0;
		$cumul_time=0;
		$cumul_total_time=0;
		foreach (array_keys($this->debug) as $key) {
			if (!isset($this->debug[$key]["fetch"])) {
				$this->debug[$key]["fetch"]["nb"]=0;
				$this->debug[$key]["fetch"]["time"]=0;
			}
			
			$error[$key] = $this->debug[$key]["error"]["in_error"];
			$has_error=$has_error or $this->debug[$key]["error"]["in_error"];
			if ($this->debug[$key]["cumul_exec_cost"]>1) {
				$weight[$key] = floor(log10(abs($this->debug[$key]["cumul_exec_cost"])));
			} else {
				$weight[$key] = 0;
			}
			$cumul_weight+=$this->debug[$key]["cumul_exec_cost"];
			$time[$key] = $this->debug[$key]["exec_time"];
			$cumul_time+=$this->debug[$key]["exec_time"];
			$time_total[$key] = $this->debug[$key]["exec_time"]+$this->debug[$key]["fetch"]["time"];
			if ($time_total[$key]*10000>1) {
				$weight[$key] = $weight[$key]+floor(log10($time_total[$key]*1000));	
			} 
			$cumul_total_time+=$this->debug[$key]["exec_time"]+$this->debug[$key]["fetch"]["time"];
			
		}
		if ($has_error) {
			$aff = "<div id='mysql_debug'>";
		} else {
			$aff = "<div style='display: none;' id='mysql_debug'>";
		}
		
		$aff.="<div class=centrage><b>Complexité total</b> : ".round($cumul_weight,2)
			." <b>Temps total</b> : ".round($cumul_total_time*1000)."ms"
			." <b>Requêtes temps</b> : ".round($cumul_time*1000)."ms</div>";
			
		if ($cumul_weight==0) {
			$cumul_weight=1;
		}
		if ($cumul_time==0) {
			$cumul_time=1;
		}
		if ($cumul_total_time==0) {
			$cumul_total_time=1;
		}
		array_multisort($error,SORT_DESC,SORT_NUMERIC,
					$weight,SORT_DESC,SORT_NUMERIC,
					$time_total,SORT_DESC,SORT_NUMERIC,
					$time,SORT_DESC,SORT_NUMERIC,
					$this->debug);
		
		$aff.= "<table style='background-color:white;border:1px dashed #cccccc' align=center>";
		$aff.= "<tr>";
		$aff.= "<th style='border:1px dashed #cccccc'>Statistiques</th>";
		$aff.= "<th style='border:1px dashed #cccccc'>Requête</th>";
		$aff.= "</tr>";
		foreach (array_keys($this->debug) as $key) {
			if ($this->debug[$key]["error"]["in_error"]) {
				$style="background-color:red;";
				$error_msg="<br><br>Mysql Error (".$this->debug[$key]["error"]["error_no"].") :";
				$error_msg.=$this->debug[$key]["error"]["error_txt"];
			} else {
				$style="";
				$error_msg="";
			}
			$this->debug[$key]["exec_total_time"]=$this->debug[$key]["exec_time"]+$this->debug[$key]["fetch"]["time"];
			$aff.="<tr>";
			$aff.="<td style='".$style."border:1px dashed #cccccc'>";
			$aff.="<table>";
			$aff.="<tr>";
			$aff.="<th align=left colspan=3>Complexité :</td>";
			$aff.="</tr><tr>";
			$aff.="<td width=100px>&nbsp;</td>";
			$aff.="<td>".round($this->debug[$key]["cumul_exec_cost"])."</td>";
			$aff.="<td>".round($this->debug[$key]["cumul_exec_cost"]*100/$cumul_weight)."%</td>";
			$aff.="</tr><tr>";
			$aff.="<th align=left colspan=3>Exécution requêtes + données :</td>";
			$aff.="</tr><tr>";
			$aff.="<td>&nbsp;</td>";
			$aff.="<td>".round($this->debug[$key]["exec_total_time"]*1000,2)."ms</td>";
			$aff.="<td>".round($this->debug[$key]["exec_total_time"]*100/$cumul_total_time)."%</td>";
			$aff.="</tr><tr>";
			$aff.="<th align=left colspan=3>Exécution requêtes :</td>";
			$aff.="</tr><tr>";
			$aff.="<td>&nbsp;</td>";
			$aff.="<td>".round($this->debug[$key]["exec_time"]*1000,2)."ms</td>";
			$aff.="<td>".round($this->debug[$key]["exec_time"]*100/$cumul_time)."%</td>";
			$aff.="</tr><tr>";
			$aff.="<th align=left colspan=3>Récupération données :</td>";
			$aff.="</tr><tr>";
			$aff.="<td>&nbsp;</td>";
			$aff.="<td colspan=2>".round($this->debug[$key]["fetch"]["time"]*1000,2)."ms</td>";
			$aff.="</tr><tr>";
			$aff.="<th align=left colspan=3>Nb données récupérés :</td>";
			$aff.="</tr><tr>";
			$aff.="<td>&nbsp;</td>";
			$aff.="<td colspan=2>".$this->debug[$key]["fetch"]["nb"]."</td>";
			$aff.="</tr><tr>";
			$aff.="<th align=left colspan=3>Nb exécution :</td>";
			$aff.="</tr><tr>";
			$aff.="<td>&nbsp;</td>";
			$aff.="<td colspan=2>".$this->debug[$key]["nb_exec"]."</td>";
			$aff.="</tr>";
			$aff.="</table></td>";
			$aff.="<td style='".$style."border:1px dashed #cccccc'>".$this->colorSyntax($this->debug[$key]["query"]);
			
			if ($this->xdebug) {
				$temp=$this->debug[$key]["stack"];
				$i=count($temp)-3;
				if (isset($temp[$i-1]["class"]) && isset($temp[$i-1]["function"])) {
					$aff.="<br><br>".$temp[$i-1]["class"]."->".$temp[$i-1]["function"]."";
				} else if ($temp[$i-1]["function"]) {
					$aff.="<br><br>".$temp[$i-1]["function"]."";
				}
				$path=realpath(dirname(__FILE__)."/../../../");
				$file=$temp[$i]["file"];
				$file=str_replace($path,".",$file);
				$aff.="<br />".$file;
				$aff.=" (line ".$temp[$i]["line"].")";
			}
			$aff.=$error_msg;
			if (preg_match("/^SELECT/i",$this->debug[$key]["query"])) {
				$aff.="<br><br><div style='border:solid 3px #DDDDDD;' id='explain_".$key."'><a onclick=\"AJAX.getAndUpdate('".$core->makeUrl("include/ajax/mysql_debug.php?explain=".$key)."','explain_".$key."')\">";
				$aff.="Get advanced information</a>";
				$aff.="</div>";
			}
			$aff.="</td>";
			$aff.="</tr>";
		}
		$aff.= "</table>";
		$aff.="</div>";
		$aff.="<a onclick=\"display(gE('mysql_debug'))\">Afficher requêtes</a>";
		echo $aff;
	}
	
	function colorSyntax ($aff) {
		$pattern = '/\'([^\']*)\'/i';
		$replacement = '<span style="color:green;">\'$1\'</span>';
		$aff=preg_replace($pattern, $replacement, $aff);
		
		$format_keywords=array("DESCRIBE ","INSERT ","SET ","FROM ","WHERE ","UPDATE ","DELETE ","DROP ","SELECT ","GROUP BY ","ORDER BY ","LIMIT ","LEFT JOIN","INNER JOIN","JOIN ");
		foreach ($format_keywords as $keyword) {
			$color_version[]="<br><span style='color:blue;font-weight:bold;'>".$keyword."</span>";
		}
		$keywords=$format_keywords;
		$color_keywords = array("AND ","OR ", " ON ");
		foreach ($color_keywords as $keyword) {
			$color_version[]="<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='color:blue;'>".$keyword."</span>";
			$keywords[]=$keyword;
		}
		$keywords[]=" AS ";
		$color_version[]=" <span style='color:blue;'>AS</span> ";
		$keywords[]="LIKE";
		$color_version[]="<span style='color:blue;'>LIKE</span>";
		$keywords[]="COUNT";
		$color_version[]="<span style='color:blue;'>COUNT</span>";
		$keywords[]="MAX";
		$color_version[]="<span style='color:blue;'>MAX</span>";
		$keywords[]="MIN";
		$color_version[]="<span style='color:blue;'>MIN</span>";
		$keywords[]="PASSWORD";
		$color_version[]="<span style='color:blue;'>PASSWORD</span>";
		$keywords[]="*";
		$color_version[]="<span style='color:blue;'>*</span>";
		$keywords[]=",";
		$color_version[]=",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$aff=str_ireplace($keywords,$color_version,$aff);
		
		return $aff;
	}
	
	function explain($key) {
		if (isset($this->previous_debug[$key])) {
			//Ok la requête est valide
			$firstline=true;
			$query=$this->previous_debug[$key]["query"];
			if ($result = mysql_query("EXPLAIN EXTENDED ".$query, $this->connexion)) {
				echo "<table align=center cellspacing=0>";
				echo "<tr>";
				echo "<th style='border:#CCCCCC 1px solid'><a onmouseover=\"activateToolTips(this,'<div>The SELECT identifier. This is the sequential number of the SELECT within the query.</div>')\">id</a></th>";
				echo "<th style='border:#CCCCCC 1px solid'><a onmouseover=\"activateToolTips(this,'<div>The type of SELECT</div>')\">select_type</a></th>";
				echo "<th style='border:#CCCCCC 1px solid'><a onmouseover=\"activateToolTips(this,'<div>The table to which the row of output refers.</div>')\">table</a></th>";
				echo "<th style='border:#CCCCCC 1px solid'><a onmouseover=\"activateToolTips(this,'<div>The join type.</div>')\">type</a></th>";
				echo "<th style='border:#CCCCCC 1px solid'><a onmouseover=\"activateToolTips(this,'<div> The possible_keys column indicates which indexes MySQL can choose from use to find the rows in this table. Note that this column is totally independent of the order of the tables as displayed in the output from EXPLAIN. That means that some of the keys in possible_keys might not be usable in practice with the generated table order."
					."<br><br>If this column is NULL, there are no relevant indexes. In this case, you may be able to improve the performance of your query by examining the WHERE clause to check whether it refers to some column or columns that would be suitable for indexing. If so, create an appropriate index and check the query with EXPLAIN again."
					."<br><br>To see what indexes a table has, use SHOW INDEX FROM tbl_name. </div>')\">possible_keys</a></th>";
				echo "<th style='border:#CCCCCC 1px solid'><a onmouseover=\"activateToolTips(this,'<div> The key column indicates the key (index) that MySQL actually decided to use. If MySQL decides to use one of the possible_keys indexes to look up rows, that index is listed as the key value."
					."<br><br>It is possible that key will name an index that is not present in the possible_keys value. This can happen if none of the possible_keys indexes are suitable for looking up rows, but all the columns selected by the query are columns of some other index. That is, the named index covers the selected columns, so although it is not used to determine which rows to retrieve, an index scan is more efficient than a data row scan."
					."<br><br>For InnoDB, a secondary index might cover the selected columns even if the query also selects the primary key because InnoDB stores the primary key value with each secondary index. If key is NULL, MySQL found no index to use for executing the query more efficiently.</div>')\">key</a></th>";
				echo "<th style='border:#CCCCCC 1px solid'><a onmouseover=\"activateToolTips(this,'<div>The key_len column indicates the length of the key that MySQL decided to use. The length is NULL if the key column says NULL. Note that the value of key_len enables you to determine how many parts of a multiple-part key MySQL actually uses.</div>')\">key_len</a></th>";
				echo "<th style='border:#CCCCCC 1px solid'><a onmouseover=\"activateToolTips(this,'<div>The ref column shows which columns or constants are compared to the index named in the key column to select rows from the table.</div>')\">ref</a></th>";
				echo "<th style='border:#CCCCCC 1px solid'><a onmouseover=\"activateToolTips(this,'<div>The rows column indicates the number of rows MySQL believes it must examine to execute the query.</div>')\">rows</a></th>";
				echo "<th style='border:#CCCCCC 1px solid'><a onmouseover=\"activateToolTips(this,'<div>This column contains additional information about how MySQL resolves the query. The following list explains the values that can appear in this column. If you want to make your queries as fast as possible, you should look out for Extra values of Using filesort and Using temporary.</div>')\">Extra</a></th>";
				echo "</tr>";
				while ($row=mysql_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td style='border:#CCCCCC 1px solid'>".$row['id']."</td>";
					echo "<td style='border:#CCCCCC 1px solid'>";
					switch ($row['select_type']) {
						case "SIMPLE" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>Simple SELECT (not using UNION or subqueries)</div>')\">";
							break;
						case "PRIMARY" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>Outermost SELECT</div>')\">";
							break;
						case "UNION" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>Second or later SELECT statement in a UNION</div>')\">";
							break;
						case "DEPENDENT UNION" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>Second or later SELECT statement in a UNION, dependent on outer query</div>')\">";
							break;
						case "UNION RESULT" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>Result of a UNION.</div>')\">";
							break;
						case "SUBQUERY" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>First SELECT in subquery</div>')\">";
							break;
						case "DEPENDENT SUBQUERY" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>First SELECT in subquery, dependent on outer query</div>')\">";
							break;
						case "DERIVED" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>Derived table SELECT (subquery in FROM clause)</div>')\">";
							break;
						case "UNCACHEABLE SUBQUERY" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>A subquery for which the result cannot be cached and must be re-evaluated for each row of the outer query</div>')\">";
							break;
						default :
							echo "<a>";
							break;
						
					}
					echo $row['select_type']."</a>";
					echo "</td>";
					echo "<td style='border:#CCCCCC 1px solid'>".$row['table']."</td>";
					echo "<td style='border:#CCCCCC 1px solid'>";
					switch ($row['type']) {
						case "system" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>The table has only one row (= system table). This is a special case of the const join type.</div>')\">";
							break;
						case "const" :
							echo "<a onmouseover=\"activateToolTips(this,'<div> The table has at most one matching row, which is read at the start of the query. Because there is only one row, values from the column in this row can be regarded as constants by the rest of the optimizer. const tables are very fast because they are read only once."
								."<br><br>const is used when you compare all parts of a PRIMARY KEY or UNIQUE index to constant values.</div>')\">";
							break;
						case "eq_ref" :
							echo "<a onmouseover=\"activateToolTips(this,'<div> One row is read from this table for each combination of rows from the previous tables. Other than the system and const  types, this is the best possible join type. It is used when all parts of an index are used by the join and the index is a PRIMARY KEY or UNIQUE index."
								."<br><br>eq_ref can be used for indexed columns that are compared using the = operator. The comparison value can be a constant or an expression that uses columns from tables that are read before this table.</div>')\">";
							break;
						case "ref" :
							echo "<a onmouseover=\"activateToolTips(this,'<div> All rows with matching index values are read from this table for each combination of rows from the previous tables. ref is used if the join uses only a leftmost prefix of the key or if the key is not a PRIMARY KEY or UNIQUE index (in other words, if the join cannot select a single row based on the key value). If the key that is used matches only a few rows, this is a good join type."
								."<br><br>ref can be used for indexed columns that are compared using the = or <=> operator.</div>')\">";
							break;
						case "ref_or_null" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>This join type is like ref, but with the addition that MySQL does an extra search for rows that contain NULL values. This join type optimization is used most often in resolving subqueries.</div>')\">";
							break;
						case "index_merge" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>This join type indicates that the Index Merge optimization is used. In this case, the key column in the output row contains a list of indexes used, and key_len  contains a list of the longest key parts for the indexes used. </div>')\">";
							break;
						case "unique_subquery" :
							echo "<a onmouseover=\"activateToolTips(this,'<div> This type replaces ref for some IN subqueries of the following form:"
								."<br><br>value IN (SELECT primary_key FROM single_table WHERE some_expr)"
								."<br><br>unique_subquery is just an index lookup function that replaces the subquery completely for better efficiency. </div>')\">";
							break;
						case "index_subquery" :
							echo "<a onmouseover=\"activateToolTips(this,'<div> This join type is similar to unique_subquery. It replaces IN subqueries, but it works for non-unique indexes in subqueries of the following form:"
								."<br><br>value IN (SELECT key_column FROM single_table WHERE some_expr)</div>')\">";
							break;
						case "range" :
							echo "<a onmouseover=\"activateToolTips(this,'<div> Only rows that are in a given range are retrieved, using an index to select the rows. The key  column in the output row indicates which index is used. The key_len contains the longest key part that was used. The ref column is NULL for this type."
								."<br><br>range can be used when a key column is compared to a constant using any of the =, <>, >, >=, <, <=, IS NULL, <=>, BETWEEN, or IN operators</div>')\">";
							break;
						case "index" :
							echo "<a onmouseover=\"activateToolTips(this,'<div> This join type is the same as ALL, except that only the index tree is scanned. This usually is faster than ALL because the index file usually is smaller than the data file."
								."<br><br>MySQL can use this join type when the query uses only columns that are part of a single index. </div>')\">";
							break;
						case "ALL" :
							echo "<a onmouseover=\"activateToolTips(this,'<div>A full table scan is done for each combination of rows from the previous tables. This is normally not good if the table is the first table not marked const, and usually very bad in all other cases. Normally, you can avoid ALL by adding indexes that allow row retrieval from the table based on constant values or column values from earlier tables.</div>')\">";
							break;
						default :
							echo "<a>";
							break;
					}
					
					echo $row['type']."</a></td>";
					echo "<td style='border:#CCCCCC 1px solid'>".$row['possible_keys']."</td>";
					echo "<td style='border:#CCCCCC 1px solid'>".$row['key']."</td>";
					echo "<td style='border:#CCCCCC 1px solid'>".$row['key_len']."</td>";
					echo "<td style='border:#CCCCCC 1px solid'>".$row['ref']."</td>";
					echo "<td style='border:#CCCCCC 1px solid'>".$row['rows']."</td>";
					$extra_exlanation=array(
						"Distinct"=>
							"MySQL is looking for distinct values, so it stops searching for more rows for the current row combination after it has found the first matching row."
						,"Not exists"=>
							"MySQL was able to do a LEFT JOIN  optimization on the query and does not examine more rows in this table for the previous row combination after it finds one row that matches the LEFT JOIN criteria. Here is an example of the type of query that can be optimized this way:"
							."<br><br>SELECT * FROM t1 LEFT JOIN t2 ON t1.id=t2.id"
							."<br>  WHERE t2.id IS NULL;"		
  							."<br><br>Assume that t2.id is defined as NOT NULL. In this case, MySQL scans t1 and looks up the rows in t2 using the values of t1.id. If MySQL finds a matching row in t2, it knows that t2.id can never be NULL, and does not scan through the rest of the rows in t2 that have the same id value. In other words, for each row in t1, MySQL needs to do only a single lookup in t2, regardless of how many rows actually match in t2. "
						,"range checked for each record"=>
							"MySQL found no good index to use, but found that some of indexes might be used after column values from preceding tables are known. For each row combination in the preceding tables, MySQL checks whether it is possible to use a range or index_merge access method to retrieve rows. This is not very fast, but is faster than performing a join with no index at all."
						,"Using filesort"=>
							"MySQL must do an extra pass to find out how to retrieve the rows in sorted order. The sort is done by going through all rows according to the join type and storing the sort key and pointer to the row for all rows that match the WHERE clause. The keys then are sorted and the rows are retrieved in sorted order."
						,"Using index"=>
							"The column information is retrieved from the table using only information in the index tree without having to do an additional seek to read the actual row. This strategy can be used when the query uses only columns that are part of a single index."
						,"Using temporary"=>
							"To resolve the query, MySQL needs to create a temporary table to hold the result. This typically happens if the query contains GROUP BY and ORDER BY clauses that list columns differently."
						,"Using where"=>
							"A WHERE clause is used to restrict which rows to match against the next table or send to the client. Unless you specifically intend to fetch or examine all rows from the table, you may have something wrong in your query if the Extra  value is not Using where and the table join type is ALL or index."
						,"Using sort_union"=>
							"This indicate how index scans are merged for the index_merge join type."
						,"Using union"=>
							"This indicate how index scans are merged for the index_merge join type."
						,"Using intersect"=>
							"This indicate how index scans are merged for the index_merge join type."
						,"Using index for group-by"=>
							"Similar to the Using index way of accessing a table, Using index for group-by indicates that MySQL found an index that can be used to retrieve all columns of a GROUP BY or DISTINCT query without any extra disk access to the actual table. Additionally, the index is used in the most efficient way so that for each group, only a few index entries are read."
						,"Using where with pushed condition"=>
							"This item applies to NDB Cluster  tables only. It means that MySQL Cluster is using condition pushdown to improve the efficiency of a direct comparison (=) between a non-indexed column and a constant. In such cases, the condition is “pushed down” to the cluster's data nodes where it is evaluated in all partitions simultaneously. This eliminates the need to send non-matching rows over the network, and can speed up such queries by a factor of 5 to 10 times over cases where condition pushdown could be but is not used."
						);
					
					foreach (array_keys($extra_exlanation) as $key) {
						$extra_exlanation[$key]="<a onmouseover=\"activateToolTips(this,'".$extra_exlanation[$key]."'>".$key."</a>";
					}
					$row['extra']=str_ireplace(array_keys($extra_exlanation),$extra_exlanation,$row['extra']);
					echo "<td style='border:#CCCCCC 1px solid'>".$row['extra']."</td>";
					echo "</tr>";
				}
				
				echo "</table>";
				echo "<br><br>";
				
				if ($result = mysql_query("SHOW WARNINGS", $this->connexion)) {
					echo "<pre style='font-size:12px'>";
					echo "<b>Query executed by MySQL :</b><br>";
					while ($row=mysql_fetch_assoc($result)) {
						echo $this->colorSyntax($row['Message']);						
					}
					echo "</pre>";
				}
			}
		} else {
			echo "<i>".htmlentities($key,ENT_QUOTES,"UTF-8")." Not found ??</i>";	
		}
		
	}
	
}

?>
