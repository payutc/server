<?php
/***************************************************************************
 *                              quick_sale.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Wednesday, Aug 19, 2009
 *   Copyright        : (C) 2005 UTT Net Group
 *   Licence		     : GNU GPL
 *   Email            : ung@utt.fr
 *   Version		     : 7.0
 *
 *
 ***************************************************************************/

 
 /***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU General Public License as
 *   published by the Free Software Foundation; either version 2 of the
 *   License, or (at your option) any later version.
 *
 *   ---------------------------------------------------
 *
 *   http://www.gnu.org/copyleft/gpl.html
 *
 ***************************************************************************/

 
 /***************************************************************************
 *
 *   Log de modification
 *
 *   -----------------------------------------------------------------------
 *
 *   Nom			Date 			Commentaire
 *
 *
 *
 *
 *
 ***************************************************************************/
 
//Obligatoire
$idPage = 160;
$needSBUY=false;
$needFADMIN=true;
$needBADMIN=false;

include_once('header.inc.php');


// S'il y a un get de l'id fundation le SADMIN et le SBUY sont sérialisés dans la session
if (isset($_GET['id_fundation']) && isset($_SESSION['buckutt']['SADMIN']) && isset($_SESSION['buckutt']['FADMIN'][$_GET['id_fundation']])) {

  // On stock l'id de la fundation
  $id_fundation = $_GET['id_fundation'];

  // On délinéarise les objets SADMIN et FADMIN correspondant à l'organisme stockés.
  $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
  $FADMIN = unserialize($_SESSION['buckutt']['FADMIN'][$id_fundation]);

  // Header de l'IHM
?>
<div class="colomn1">
<?php 

  // Ajout, edition ou suppression d'une categorie
  if (!empty($_POST)) {
    // On tranforme les nom pour qu'il n'y est pas de soucis d'encodage
    $name_object = htmlentities(utf8_decode($_POST['name_object']));
    $name_sale = htmlentities(utf8_decode($_POST['name_sale']));
    // On test le stock
    if (isset($_POST['is_stock']) && $_POST['is_stock'] == 1 && isset($_POST['stock']) && !empty($_POST['stock'])) {
      $stock = $_POST['stock'];
    // Si pas de stock alors $stock = -1
    } elseif ($_POST['is_stock'] == 0) {
      $stock  = '-1';
    }
    // On transforme le prix
    $price = $_POST['credit'] * 100 ;
    // On transforme la date donnée en timestamp
    foreach (array($_POST['date_start'], $_POST['date_end']) as $i => $date) {
      //TODO : Verifier la tronche de la date !!
      $date_details1 = explode(" ", $date);
      $date_details11 = explode("/", $date_details1[0]);
      $date_details12 = explode(":", $date_details1[1]);
      $date_timestamp[$i] = mktime($date_details12[0], $date_details12[1], 00, $date_details11[1], $date_details11[0], $date_details11[2]);
      trace($date_timestamp[$i]);
      trace(date('d/m/y H:i', $date_timestamp[$i]));
    }
    // On test si tous les post sont remplis
    if (isset($_POST['name_object']) && !empty($_POST['name_object']) && isset($_POST['categorie']) && !empty($_POST['categorie']) && isset($_POST['isunique']) && isset($stock) && isset($_POST['group']) && !empty($_POST['group']) && isset($price) && !empty($price) && isset($_POST['point']) && !empty($_POST['point']) && isset($date_timestamp[0]) && !empty($date_timestamp[0]) && isset($date_timestamp[1]) && !empty($date_timestamp[1])) {
      // On test l'ajout
      $new_object = $FADMIN->addObject($name_object, $_POST['isunique'], $stock, $_POST['categorie'], '1', '0');
      if(!empty($new_object) && $new_object==true) {
        $new_price = $FADMIN->addPrice($_POST['group'], $new_object, $price);
        if (!empty($new_price) && $new_price==true) {
          $test_point = $FADMIN->addObjectToPoint($new_object, $_POST['point']);
          if (!empty($test_point) && $test_point==true) {
            $new_sale = $FADMIN->addVente($date_timestamp[0], $date_timestamp[1], $new_object, $name_sale);
            if(!empty($new_sale) && $new_sale==true) {
              $page->msgInfo('Objet mise en vente avec succ&egrave;s !');
            } else { $page->msgError('Erreur : la mise en vente n\'a pas pu avoir lieu à cause de la vente...'); }
          } else { $page->msgError('Erreur : la mise en vente n\'a pas pu avoir lieu à cause du point de vente...'); }
        } else { $page->msgError('Erreur : la mise en vente n\'a pas pu avoir lieu à cause du prix...'); }
      } else { $page->msgError('Erreur : la mise en vente n\'a pas pu avoir lieu à cause de l\'objet...'); }
    } else { $page->msgError('Attention : il faut remplir tous les champs.'); }
  }

    $page->moduleHeader('Mise en vente rapide', 'FFCC00');


  echo '<form method="post" action="quick_sale.php?id_fundation='.$id_fundation.'" >';
?>
		<script type="text/javascript">
		function stockYes(){
			document.getElementById("tr_stock").style.display = "";
		} 
		function stockNo(){
			document.getElementById("tr_stock").style.display = "none";
			document.getElementById('submit').disabled = false;
		}

		function isValidInt(d) {
			var intRegEx = /^(\d+)$/;
			return intRegEx.test(d);
		}
		function verifint(verint, id){
		    if(isValidInt(verint)) {
				document.getElementById('int'+id).style.color = '';
				document.getElementById('priorite').style.color = '';
		    	document.getElementById('submit').disabled = false;
		    } else {
				document.getElementById('int'+id).style.color = 'red';
				document.getElementById('priorite').style.color = 'red';
		    	document.getElementById('submit').disabled = true;
		    }
		}
		function isValidInt(d) {
			var intRegEx = /^(\d+)$/;
			return intRegEx.test(d);
		}
			function verifPrice(verprice){
			    if(isValidPrice(verprice)) {
					document.getElementById('tr_credit').style.color = '';
			    	document.getElementById('credit').style.color = '';
					document.getElementById('submit').disabled = false;
			    } else {
					document.getElementById('tr_credit').style.color = 'red';
			    	document.getElementById('credit').style.color = 'red';
					document.getElementById('submit').disabled = true;
			    }
			}
			function isValidPrice(d) {
				var intRegEx = /^\d+([\.]\d{1,2})?$/;
				return intRegEx.test(d);
			}
			function isDate(sDate){
				var dateRegEx = sDate.match(/^(?:0?([1-9]|[12]\d|3[01]))\/(?:0?([1-9]|1[0-2]))\/((?:19|[2-9]\d)[0-9]{2})$/);
				if(!dateRegEx) return false;
				var iDay = dateRegEx[1];
				var iMonth = dateRegEx[2];
				var iYear = dateRegEx[3];
				var arDayPerMonth = [31,(isLeapYear(iYear))?29:28,31,30,31,30,31,31,30,31,30,31];
				if(!arDayPerMonth[iMonth-1]) return false;
				return (iDay <= arDayPerMonth[iMonth-1] && iDay > 0);
			}
			function isHour(sHour){
				var hourRegEx = /^(?:0?[0-9]|1\d|2[0-3]):(?:0?[0-9]|[0-4]\d|5[0-9])$/.test(sHour);
				return hourRegEx;
			}
			function isLeapYear(iYear){
				return ((iYear%4==0 && iYear%100!=0) || iYear%400==0);
			}		
			function isDateHour(sDateHour, id){
				var sSeparator = ' ';
				var arDateHour = sDateHour.split(sSeparator);
				var ok
				if(!arDateHour[0])
					ok = false;
				else {
					if(!isDate(arDateHour[0]))
						ok = false;
					else {
						if (arDateHour[1]=="") {
							document.getElementById('inputDate'+id).value += '00:00';
							ok = true;
						} else if (!arDateHour[1]) {
							document.getElementById('inputDate'+id).value += ' 00:00';
							ok = true;
						} else {
							if(!isHour(arDateHour[1]))
								ok = false;
							else
								ok = true;
						}
					}
				}
				if (ok) {
					document.getElementById('date'+id).style.color = '';
					document.getElementById('inputDate'+id).style.color = '';
					document.getElementById('submit').disabled = false;
				} else {
					document.getElementById('date'+id).style.color = 'red';
					document.getElementById('inputDate'+id).style.color = 'red';
					document.getElementById('submit').disabled = true;
				}
			}		
		</script>
		<table width="100%">
			<tr>
				<td>Nom de l'objet :</td>
				<td><input type="text" name="name_object" id="name_object" maxlength="40" size="40" value="" /></td>
			</tr>
			<tr>
				<td>Max. un par personne ?</td>
				<td><input id="isunique_yes" type="radio" name="isunique" value="1" /> Oui <small><em>(ex : une prévente R2D)</em></small>
				<input id="isunique_no" type="radio" name="isunique" value="0" checked="checked" /> Non <small><sem>(ex : un coca)</sem></small>
				</td>
			</tr>
			<tr>
				<td>Connais-tu le stock ?</td>
				<td><input id="stock_yes" type="radio" name="is_stock" value="1" onclick="stockYes();" checked="checked" /> Oui
				<input id="stock_no" type="radio" name="is_stock" value="0" onclick="stockNo();" /> Non</td>
			</tr>
			<tr id="tr_stock">
				<td id="int1">Stock :</td>
				<td><input type="text" name="stock" id="stock" onBlur="verifint(this.value, 1);" maxlength="10" size="10" value="" /></td>
		    </tr>
			<tr>
				<td><a href="categorie.php?id_fundation=<?php echo $id_fundation; ?>" title="Ajouter une catégorie">Catégorie :</a></td>		
				<td><select name="categorie" id="categorie">
<?php
  if ($allCategorieCSV = $FADMIN->getAllCategories()) {
    foreach (str_getcsv($allCategorieCSV, ',') as $categorie) {
	  echo '<option value ="'.$categorie[0].'">'.$categorie[1].'</option>';
      }
    } 			
    echo '</select></td>';
?>
			</tr>
			<tr>
				<td>Image :</td>
				<td><input type="file" name="image" id="image" maxlength="29" size="29" value="" /></td>
			</tr>
			<tr>
				<td><?php if($SADMIN->isGroupEditor($id_fundation) == 1) { echo '<a href="group.php?id_fundation='.$id_fundation.'" title="Ajouter un groupe">Groupe par défaut :</a>'; } else { echo 'Groupe par défaut :'; } ?></td>
				<td>
<?php
  if ($allGroupsCSV = $FADMIN->getAllGroups()) {
    echo '<select name="group" id="group">';
    foreach (str_getcsv($allGroupsCSV, ',') as $group) {
      echo '<option value ="'.$group[0].'">'.$group[1].'</option>';
    }
    echo '</select>';
  }
?>
				</td>
			</tr>
			<tr id="tr_credit">
				<td>Prix pour ce groupe :</td>
				<td><input type="text" name="credit" id="credit" onBlur="verifPrice(this.value);" maxlength="30" size="30" value="" /> <small>(ex: 10 ou 0.50)</small></td>
			</tr>
			<tr>
				<td>Point par défaut :</td>
				<td>
<?php
  if ($allPointsCSV = $FADMIN->getAllPoints()) {
    echo '<select name="point" id="point">';
    foreach (str_getcsv($allPointsCSV, ',') as $point) {
      echo '<option value ="'.$point[0].'">'.$point[1].'</option>';
    }
    echo '</select>';
  }
?>
				</td>
			</tr>
			<tr id="date1">
				<td>Début de la vente :</td>
				<td><input id="inputDate1" type="text" name="date_start" id="date_start"
					onBlur="isDateHour(this.value, 1);" maxlength="16" size="16"
					value="" /> <small>(JJ/MM/AAAA ou JJ/MM/AAAA HH:MM)</small>
				</td>
			</tr>
			<tr id="date2">
				<td>Fin de la vente :</td>
				<td><input id="inputDate2" type="text" name="date_end" id="date_end"
					onBlur="isDateHour(this.value, 2);" maxlength="16" size="16"
					value="" /> <small>(JJ/MM/AAAA ou JJ/MM/AAAA HH:MM)</small>
				</td>
			</tr>
			<tr>
				<td>Nom de la vente : <small><em>(optionnel)</em></small></td>
				<td><input type="text" name="name_sale" id="name_sale" maxlength="40" size="40" value="" /></td>
			</tr>
        	<tr>
            	<td colspan="2" align="right">
            		<input type="submit" id="submit" name="add_quick_sale" value="Mettre en vente" />
 	           </td>
    	    </tr>
		</table>
	</form>
<?php
  $page->modulefooter();
?>
	</div>
	<div class="colomn2">
<?php  include_once ('navigation.inc.php'); ?>
	</div>
<?php 
  $page->footer();

  // On linéarise les objets SADMIN et SBUY pour les concerver de page en page.
  $_SESSION['buckutt']['SADMIN'] = serialize($SADMIN);
  $_SESSION['buckutt']['FADMIN'][$id_fundation] = serialize($FADMIN);
} else {
  header('Location: index.php');
}
?>
