<?php
/***************************************************************************
 *                                  price.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Wednesday, Feb 10, 2010
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
  // Ajout, edition ou suppression d'un prix
  if (!empty($_POST)) {
  	// On verifie si on est en suprresion
    if (isset($_POST['id']) && isset($_POST['delete'])) {
      // On test la suppression
      $test = $FADMIN->deletePrice($_POST['id']);
      if(!empty($test) && $test==true) {
        $page->msgInfo('Prix supprim&eacute;e avec succ&egrave;s !');
      } else {
        $page->msgError('Erreur : la suppression n\'a pas pu avoir lieu...');
      }
    } else {
      // On test si tous les post sont remplis
      if (isset($_POST['object']) && !empty($_POST['object']) && isset($_POST['group']) && !empty($_POST['group']) && isset($_POST['credit']) && !empty($_POST['credit'])) {
        // On verifie si on est en ajout ou en edition (s'il y a id_object existant)
        if (isset($_POST['id'])) {
          // On test l'edition
          if (isset($_POST['edit_price'])) {
            // On transforme le prix
            $price = $_POST['credit'] * 100 ;
            $test_credit = $FADMIN->editPriceCredit($_POST['id'], $price);
            if(!empty($test_credit) && $test_credit==true) {
              $page->msgInfo('Prix édit&eacute; avec succ&egrave;s !');
            } else { $page->msgError('Erreur : l\'édition n\'a pas pu avoir lieu...'); }
          } else { $edit = true; }
        } else {
          // On transforme le prix
          $price = $_POST['credit'] * 100 ;
          // On test l'ajout
          $test = $FADMIN->addPrice($_POST['group'],$_POST['object'], $price);
          if(!empty($test) && $test==true) {
            $page->msgInfo('Prix ajout&eacute; avec succ&egrave;s !');
          } else {
            $page->msgError('Erreur : l\'ajout n\'a pas pu avoir lieu...');
          }
        }
      } else { $page->msgError('Attention : il faut remplir tous les champs. Surtout quand il n\'y en a qu\'un ;)'); }
    }
  }

  // On affiche ajouter ou editer
  if ($edit){
    $page->moduleHeader('Editer un prix', 'FFCC00');
  } else {
    $page->moduleHeader('Ajouter un prix', 'FFCC00');
  }

  echo '<form method="post" action="price.php?id_fundation='.$id_fundation.'" >';
?>
			<script type="text/javascript">
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
			</script>
		<table width="100%">
			<tr>
				<td><a href="object.php?id_fundation=<?php echo $id_fundation; ?>" title="Ajouter un objet">Objet :</a></td>		
				<td>
<?php
  // On check quel valeur a été posté et on l'affiche
  if ($edit) {
    echo $_POST['name_object'];
  } else {
    if ($allObjectCSV = $FADMIN->getAllObjects()) {
      echo '<select name="object" id="object">';
      foreach (str_getcsv($allObjectCSV, ',') as $object) {
	    echo '<option value ="'.$object[0].'">'.$object[1].'</option>';
      }
      echo '</select>';
    } 			
  }
?>
				</td>
			</tr>
			<tr>
				<td><?php if($SADMIN->isGroupEditor($id_fundation) == 1) { echo '<a href="group.php?id_fundation='.$id_fundation.'" title="Ajouter un groupe">Groupe par défaut :</a>'; } else { echo 'Groupe :'; } ?></td>
				<td>
<?php
  // On check quel valeur a été posté et on l'affiche
  if ($edit) {
    echo $_POST['name_group'];
  } else {
    if ($allGroupsCSV = $FADMIN->getAllGroups()) {
      echo '<select name="group" id="group">';
      foreach (str_getcsv($allGroupsCSV, ',') as $group) {
	    echo '<option value ="'.$group[0].'">'.$group[1].'</option>';
      }
      echo '</select>';
    }
  }
?>
				</td>
			</tr>
			<tr id="tr_credit">
				<td>Prix :</td>
				<td><input type="text" name="credit" id="credit" onBlur="verifPrice(this.value);" maxlength="34" size="34" value="<?php if($edit) {echo $_POST['credit']; }?>" /> <small>(ex: 10 ou 0.50)</small></td>
			</tr>
        	<tr>
            	<td colspan="2" align="right">
            		<input type="<?php if($edit){ 
            	    	echo 'hidden" name="id" value="'.$_POST['id'].'" />
                        <input type="hidden" name="object" value="'.$_POST['object'].'" />
                        <input type="hidden" name="name_object" value="'.$_POST['name_object'].'" />
                        <input type="hidden" name="group" value="'.$_POST['group'].'" />
                        <input type="hidden" name="name_group" value="'.$_POST['name_group'].'" />
            	    	<input type="button" onClick="location.href=\'\'" name="stop_edit" value="Stopper l\'édition" />
            	    	<input type="submit" id="submit" name="edit_price" value="Editer ce';
            	    } else { echo 'submit" id="submit" name="add_price" value="Ajouter un'; } ?> prix" />
 	           </td>
    	    </tr>
		</table>
	</form>
<?php
  $page->modulefooter();

  $page->moduleHeader('Mes prix');
  $j='0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau

  if ($allPrices = $FADMIN->getAllPrice()) {
    echo '<table width="100%">
      <tr>
        <th>Objet</th>
        <th>Groupe</th>
        <th>Crédit</th>
        <th width="20px"></th>
        <th width="20px"></th>
      </tr>';
    foreach (str_getcsv($allPrices, ',') as $price) {
      /* DESCRIPTION DE $prix
       * 0 = Identifiant du prix
       * 1 = L'identifiant de l'objet
       * 2 = L'identifiant du groupe       
       * 3 = Le nom du l'objet
       * 4 = Le nom de groupe
       * 5 = Crédit
       */
      echo '<tr class="'.((++$j%2)?'pair':'impair').'">
        <td>'.$price[3].'</td>
        <td>'.$price[4].'</td>
      	<td>'.credit_format($price[5]).'</td>';
      	// Formulaire d'édition d'un prix
        echo '<td><form style="display:inline;" method="post" action="price.php?id_fundation='.$id_fundation.'">
            <input type="hidden" name="id" value="'.$price[0].'" />
            <input type="hidden" name="object" value="'.$price[1].'" />
            <input type="hidden" name="name_object" value="'.$price[3].'" />
            <input type="hidden" name="group" value="'.$price[2].'" />
            <input type="hidden" name="name_group" value="'.$price[4].'" />
            <input type="hidden" name="credit" value="'.credit_format($price[5]).'" />
           <input class="edit" type="submit" name="edit" title="Editer" value="" />
          </form></td>';
        // Formulaire de suppression d'un prix
        echo '<td><form style="display:inline;" method="post" action="price.php?id_fundation='.$id_fundation.'">
            <input type="hidden" name="id" value="'.$price[0].'" />
            <input class="delete" type="submit" name="delete" title="Supprimer" value="" />
          </form></td>
        </tr>';
    }
  } else {
    echo "Tu n'as enregistré aucun prix.";
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
