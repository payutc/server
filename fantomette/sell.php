<?php
/***************************************************************************
 *                                   sell.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Tuesday, Jan 29, 2010
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
  $edit = false;
  // Ajout, edition ou suppression d'une vente
  if (!empty($_POST)) {
  	// On verifie si on est en suprresion
    if (isset($_POST['id']) && isset($_POST['delete'])) {
      // On test la suppression
      $test = $FADMIN->deleteVente($_POST['id']);
      if(!empty($test) && $test==true) {
        $page->msgInfo('Vente supprim&eacute; avec succ&egrave;s !');
      } else {
        $page->msgError('Erreur : la suppression n\'a pas pu avoir lieu...');
      }
    } else {
      // On test si tous les post sont remplis
      if (isset($_POST['date_start']) && !empty($_POST['date_start']) && isset($_POST['date_end']) && !empty($_POST['date_end']) && isset($_POST['object']) && !empty($_POST['object'])) {
        $name = htmlentities(utf8_decode($_POST['name']));
        // On verifie si on est en ajout ou en edition (s'il y a id existant)
        if (isset($_POST['id'])) {
          // On test l'edition
          if (isset($_POST['edit_vente'])) {
            // On transforme la date donnée en timestamp
            foreach (array($_POST['date_start'], $_POST['date_end']) as $i => $date) {
              //TODO : Verifier la tronche de la date !!
              $date_details1 = explode(" ", $date);
              $date_details11 = explode("/", $date_details1[0]);
              $date_details12 = explode(":", $date_details1[1]);
              $date_timestamp[$i] = mktime($date_details12[0], $date_details12[1], 00, $date_details11[1], $date_details11[0], $date_details11[2]);
            }
            $test_date_start = $FADMIN->editVenteDateStart($_POST['id'],$date_timestamp[0]);
            $test_date_end = $FADMIN->editVenteDateEnd($_POST['id'], $date_timestamp[1]);
            $test_name = $FADMIN->editVenteName($_POST['id'], $name);
            if(!empty($test_date_start) && $test_date_start==true && !empty($test_date_end) && $test_date_end==true && !empty($test_name) && $test_name==true) {
              $page->msgInfo('Vente édit&eacute;e avec succ&egrave;s !');
            } else { $page->msgError('Erreur : l\'édition n\'a pas pu avoir lieu...'); }
          } else { $edit = true; }
        } else {
          // On transforme la date donnée en timestamp
          foreach (array($_POST['date_start'], $_POST['date_end']) as $i => $date) {
            //TODO : Verifier la tronche de la date !!
            $date_details1 = explode(" ", $date);
            $date_details11 = explode("/", $date_details1[0]);
            $date_details12 = explode(":", $date_details1[1]);
            $date_timestamp[$i] = mktime($date_details12[0], $date_details12[1], 00, $date_details11[1], $date_details11[0], $date_details11[2]);
          }
          // On test l'ajout
          $test = $FADMIN->addVente($date_timestamp[0], $date_timestamp[1], $_POST['object'], $name);
          if(!empty($test) && $test==true) {
            $page->msgInfo('Vente ajout&eacute; avec succ&egrave;s !');
          } else {
            $page->msgError('Erreur : l\'ajout n\'a pas pu avoir lieu...');
          }
        }
      } else { $page->msgError('Attention : il faut remplir tous les champs.'); }
    }
  }

  // On affiche ajouter ou editer
  if ($edit){
    $page->moduleHeader('Editer une vente', 'FFCC00');
  } else {
    $page->moduleHeader('Ajouter une vente', 'FFCC00');
  }

  echo '<form method="post" action="sell.php?id_fundation='.$id_fundation.'" >';
?>
		<table width="100%">
			<tr>
				<td><a href="price.php?id_fundation=<?php echo $id_fundation; ?>" title="Ajouter un prix">Objet à vendre :</a></td>		
				<td>
<?php
  // On check quel valeur a été posté et on l'affiche
  if ($edit) {
    echo $_POST['name_object'];
  } else {
    if ($allObjectsByPriceCSV = $FADMIN->getAllObjectByPrice()) {
      echo '<select name="object" id="object">';
      foreach (str_getcsv($allObjectsByPriceCSV, ',') as $object) {
	    echo '<option value ="'.$object[0].'">'.$object[1].'</option>';
      }
      echo '</select> <em><small>Si le produit n\'est pas dans cette liste : il faut lui donner au moins un prix.</small></em>';
    }
  }
?>
				</td>
			</tr>
			<script type="text/javascript">
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
			<tr id="date1">
				<td>Date de début des ventes :</td>
				<td><input id="inputDate1" type="text" name="date_start" id="date_start"
					onBlur="isDateHour(this.value, 1);" maxlength="16" size="16"
					value="<?php if($edit) echo date('d/m/Y H:i', $_POST['date_start']) ?>" /> <small>(JJ/MM/AAAA ou JJ/MM/AAAA HH:MM)</small>
				</td>
			</tr>
			<tr id="date2">
				<td>Date de fin des ventes :</td>
				<td><input id="inputDate2" type="text" name="date_end" id="date_end"
					onBlur="isDateHour(this.value, 2);" maxlength="16" size="16"
					value="<?php if($edit) echo date('d/m/Y H:i', $_POST['date_end']) ?>" /> <small>(JJ/MM/AAAA ou JJ/MM/AAAA HH:MM)</small>
				</td>
			</tr>
			<tr>
				<td>Nom : <small><em>(optionnel)</em></small></td>
				<td><input type="text" name="name" id="name" maxlength="45" size="48" value="<?php if($edit) {echo $_POST['name']; }?>" /></td>
			</tr>
		    <tr>
				<td colspan="2" align="right">
            		<input type="<?php if($edit){ 
            	    	echo 'hidden" name="id" value="'.$_POST['id'].'" />
            	    	<input type="hidden" name="object" value="'.$_POST['object'].'" />
			            <input type="hidden" name="name_object" value="'.$_POST['name_object'].'" />
            	    	<input type="button" onClick="location.href=\'\'" name="stop_edit" value="Stopper l\'édition" />
            	    	<input type="submit" id="submit" name="edit_vente" value="Editer cette';
            	    } else { echo 'submit" id="submit" name="add_vente" value="Ajouter une'; } ?> vente" />
		        </td>
		    </tr>
		</table>
	</form>
<?php
  $page->modulefooter();

  $page->moduleHeader('Mes Ventes en cours');
  $j='0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau

  if ($Ventes = $FADMIN->getVentes()) {
    echo '<table width="100%">
      <tr>
        <th>Produit</th>
        <th>Début</th>
        <th>Fin</th>
        <th>Nom</th>
        <th width="20px"></th>
        <th width="20px"></th>
      </tr>';
    foreach (str_getcsv($Ventes, ',') as $vente) {
      /* DESCRIPTION DE $vente
       * 0 = Identifiant de la vente
       * 1 = Date de début de vente
       * 2 = Date de fin de vente
       * 3 = Identifiant de l'objet en vente
       * 4 = Nom de l'objet en vente
       * 5 = Nom de la vente
       */
      echo '<tr class="'.((++$j%2)?'pair':'impair').'">
          <td>'.$vente[4].'</td>
          <td>'.date('d/m/y H:i', $vente[1]).'</td>
          <td>'.date('d/m/y H:i', $vente[2]).'</td>
          <td>'.$vente[5].'</td>';
      // Formulaire d'édition d'une vente
      echo '<td><form style="display:inline;" method="post" action="sell.php?id_fundation='.$id_fundation.'">
            <input type="hidden" name="id" value="'.$vente[0].'" />
            <input type="hidden" name="date_start" value="'.$vente[1].'" />
            <input type="hidden" name="date_end" value="'.$vente[2].'" />
            <input type="hidden" name="object" value="'.$vente[3].'" />
            <input type="hidden" name="name_object" value="'.$vente[4].'" />
            <input type="hidden" name="name" value="'.$vente[5].'" />
            <input class="edit" type="submit" name="edit" title="Editer" value="" />
          </form></td>';
      // Formulaire de suppression d'une vente  
      echo '<td><form style="display:inline;" method="post" action="sell.php?id_fundation='.$id_fundation.'">
          <input type="hidden" name="id" value="'.$vente[0].'" />
          <input class="delete" type="submit" name="delete" title="Supprimer" value="" />
        </form></td>
      </tr>';
    }
  } else {
    echo "Tu n'as enregistré aucune vente.";
  }

  echo '</table>';
  $page->modulefooter();
  
  $page->moduleHeader('Toutes Mes Ventes');
  $j='0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau

  if ($allVentes = $FADMIN->getAllVentes()) {
    echo '<table width="100%">
      <tr>
        <th>Produit</th>
        <th>Début</th>
        <th>Fin</th>
        <th>Nom</th>
        <th width="20px"></th>
        <th width="20px"></th>
      </tr>';
    foreach (str_getcsv($allVentes, ',') as $vente) {
      /* DESCRIPTION DE $vente
       * 0 = Identifiant de la vente
       * 1 = Date de début de vente
       * 2 = Date de fin de vente
       * 3 = Identifiant de l'objet en vente
       * 4 = Nom de l'objet en vente
       * 5 = Nom de la vente
       */
      echo '<tr class="'.((++$j%2)?'pair':'impair').'">
          <td>'.$vente[4].'</td>
          <td>'.date('d/m/y H:i', $vente[1]).'</td>
          <td>'.date('d/m/y H:i', $vente[2]).'</td>
          <td>'.$vente[5].'</td>';
      // Formulaire d'édition d'une vente
      echo '<td><form style="display:inline;" method="post" action="sell.php?id_fundation='.$id_fundation.'">
            <input type="hidden" name="id" value="'.$vente[0].'" />
            <input type="hidden" name="date_start" value="'.$vente[1].'" />
            <input type="hidden" name="date_end" value="'.$vente[2].'" />
            <input type="hidden" name="object" value="'.$vente[3].'" />
            <input type="hidden" name="name_object" value="'.$vente[4].'" />
            <input type="hidden" name="name" value="'.$vente[5].'" />
            <input class="edit" type="submit" name="edit" title="Editer" value="" />
          </form></td>';
      // Formulaire de suppression d'une vente  
      echo '<td><form style="display:inline;" method="post" action="sell.php?id_fundation='.$id_fundation.'">
          <input type="hidden" name="id" value="'.$vente[0].'" />
          <input class="delete" type="submit" name="delete" title="Supprimer" value="" />
        </form></td>
      </tr>';
    }
  } else {
    echo "Tu n'as enregistré aucune vente.";
  }

  echo '</table>';
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
