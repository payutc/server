<?php
/***************************************************************************
 *                               categorie.php
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
  $edit = false;
  // Ajout, edition ou suppression d'une categorie
  if (!empty($_POST)) {
  	// On verifie si on est en suprresion
    if (isset($_POST['id']) && isset($_POST['delete'])) {
      // On test la suppression
      $test = $FADMIN->deleteCategorie($_POST['id']);
      if(!empty($test) && $test==true) {
        $page->msgInfo('Catégorie supprim&eacute;e avec succ&egrave;s !');
      } else {
        $page->msgError('Erreur : la suppression n\'a pas pu avoir lieu...');
      }
    } else {
      // On test si tous les post sont remplis
      if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['priorite']) && !empty($_POST['priorite'])) {
        // On verifie si la propriété est bien un entier
        if (ctype_digit($_POST['priorite'])) {
          $name = htmlentities(utf8_decode($_POST['name']));
          // On verifie si on est en ajout ou en edition (s'il y a id_object existant)
          if (isset($_POST['id'])) {
            // On test l'edition
            if (isset($_POST['edit_categorie'])) {
              $test_name = $FADMIN->editCategorieName($_POST['id'], $name);
              $test_priorite = $FADMIN->editCategoriePriorite($_POST['id'], $_POST['priorite']);
              if(!empty($test_name) && $test_name==true && !empty($test_priorite) && $test_priorite==true) {
                $page->msgInfo('Catégorie édit&eacute;e avec succ&egrave;s !');
              } else { $page->msgError('Erreur : l\'édition n\'a pas pu avoir lieu...'); }
            } else { $edit = true; }
          } else {
            // On test l'ajout
            $test = $FADMIN->addCategorie($name, $_POST['priorite']);
            if(!empty($test) && $test==true) {
              $page->msgInfo('Catégorie ajout&eacute;e avec succ&egrave;s !');
            } else { $page->msgError('Erreur : l\'ajout n\'a pas pu avoir lieu...'); }
          }
        } else { $page->msgError('Attention : la propriété doit être un entier.'); }
      } else { $page->msgError('Attention : il faut remplir tous les champs.'); }
    }
  }

  // On affiche ajouter ou editer
  if ($edit){
    $page->moduleHeader('Editer une catégorie', 'FFCC00');
  } else {
    $page->moduleHeader('Ajouter une catégorie', 'FFCC00');
  }

  echo '<form method="post" action="categorie.php?id_fundation='.$id_fundation.'" >';
?>
		<script type="text/javascript">
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
		</script>
		<table width="100%">
			<tr>
				<td>Nom :</td>
				<td><input type="text" name="name" id="name" maxlength="50" size="50" value="<?php if($edit) {echo $_POST['name']; }?>" /></td>
			</tr>
			<tr id="int1">
				<td>Priorité :</td>
				<td>
					<input type="text" name="priorite" id="priorite" onBlur="verifint(this.value, 1);" maxlength="5" size="5" value="<?php if($edit) {echo $_POST['priorite'];} else {echo "50";}?>" />
					<small><em>(La priorité la plus petite apparaîtra en première page)</em></small>
				</td>
			</tr>
        	<tr>
            	<td colspan="2" align="right">
            		<input type="<?php if($edit){ 
            	    	echo 'hidden" name="id" value="'.$_POST['id'].'" />
            	    	<input type="button" onClick="location.href=\'\'" name="stop_edit" value="Stopper l\'édition" />
            	    	<input type="submit" id="submit" name="edit_categorie" value="Editer cette';
            	    } else { echo 'submit" id="submit" name="add_categorie" value="Ajouter une'; } ?> catégorie" />
 	           </td>
    	    </tr>
		</table>
	</form>
<?php
  $page->modulefooter();

  $page->moduleHeader('Mes catégories');
  $j='0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau

  if ($allCategories = $FADMIN->getAllCategories()) {
    echo '<table width="100%">
      <tr>
        <th>Nom</th>
        <th>Priorité</th>
        <th width="20px"></th>
        <th width="20px"></th>
      </tr>';
    foreach (str_getcsv($allCategories, ',') as $categorie) {
      /* DESCRIPTION DE $categorie
       * 0 = Identifiant de la catérogie
       * 1 = Nom de la catégorie
       * 2 = Priorité de la catégorie
       */
      echo '<tr class="'.((++$j%2)?'pair':'impair').'">
          <td>'.$categorie[1].'</td>
          <td>'.$categorie[2].'</td>';
      if ($categorie[1] != 'Sans catégorie') {
      	// Formulaire d'édition d'une categorie
        echo '<td><form style="display:inline;" method="post" action="categorie.php?id_fundation='.$id_fundation.'">
              <input type="hidden" name="id" value="'.$categorie[0].'" />
              <input type="hidden" name="name" value="'.$categorie[1].'" />
              <input type="hidden" name="priorite" value="'.$categorie[2].'" />
              <input class="edit" type="submit" name="edit" title="Editer" value="" />
            </form></td>';
        // Formulaire de suppression d'une categorie  
        echo '<td><form style="display:inline;" method="post" action="categorie.php?id_fundation='.$id_fundation.'">
            <input type="hidden" name="id" value="'.$categorie[0].'" />
            <input class="delete" type="submit" name="delete" title="Supprimer" value="" />
          </form></td>
        </tr>';
      }
    }
  } else {
    echo "Tu n'as enregistré aucune catégorie.";
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
