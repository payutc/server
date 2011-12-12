<?php
/***************************************************************************
 *                                  object.php
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
  // Ajout, edition ou suppression d'un produit
  if (!empty($_POST)) {
    // On verifie si on est en suprresion
    if (isset($_POST['id']) && isset($_POST['delete'])) {
      // On test la suppression
      $test = $FADMIN->deleteObject($_POST['id']);
      if(!empty($test) && $test==true) {
        $page->msgInfo('Produit supprim&eacute; avec succ&egrave;s !');
      } else {
        $page->msgError('Erreur : la suppression n\'a pas pu avoir lieu...');
      }
    } else {
      if (isset($_POST['is_stock']) && $_POST['is_stock'] == 1 && isset($_POST['stock'])) {
        $stock = $_POST['stock'];
      // Si pas de stock alors $stock = -1
      } elseif ($_POST['is_stock'] == 0) {
        $stock  = -1;
      }
      // On test si tous les post sont remplis
      if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['categorie']) && !empty($_POST['categorie']) && isset($_POST['isunique']) && isset($stock)) {
        $name = htmlentities(utf8_decode($_POST['name']));
        if (isset($_POST['id'])) {
          // On test l'edition
          if (isset($_POST['edit_object'])) {
            $test_name = $FADMIN->editObjectName($_POST['id'], $name);
            $test_isunique = $FADMIN->editObjectIsUnique($_POST['id'], $_POST['isunique']);
            $test_stock = $FADMIN->editObjectStock($_POST['id'], $stock);
            $test_categorie = $FADMIN->editObjectCategorie($_POST['id'], $_POST['categorie']);
            if(!empty($test_name) && $test_name==true && !empty($test_isunique) && $test_isunique==true && !empty($test_stock) && $test_stock==true && !empty($test_categorie) && $test_categorie==true) {
              $addOK = true;
              $page->msgInfo('Objet édit&eacute; avec succ&egrave;s !');
            } else { $page->msgError('Erreur : l\'édition n\'a pas pu avoir lieu...'); }
          } else { $edit = true; }
        } else {
          //TODO Gerer les images !

          // On test l'ajout
          $test = $FADMIN->addObject($name, $_POST['isunique'], $stock, $_POST['categorie'], '1', '0');
          if(!empty($test) && $test==true) {
            $page->msgInfo('Produit ajout&eacute; avec succ&egrave;s !');
          } else {
            $page->msgError('Erreur : l\'ajout n\'a pas pu avoir lieu...');
          }
        }
      } else { $page->msgError('Attention : il faut remplir tous les champs...'); }
    }
  }

  // On affiche ajouter ou editer
  if ($edit){
    $page->moduleHeader('Editer un objet', 'FFCC00');
  } else {
    $page->moduleHeader('Ajouter un objet', 'FFCC00');
  }

  echo '<form method="post" action="object.php?id_fundation='.$id_fundation.'" enctype="multipart/form-data">';
  // On grise les stock si unique est a oui
?>
		<script type="text/javascript">
		function stockYes(){
			document.getElementById("tr_stock").style.display = "";
		} 
		function stockNo(){
			document.getElementById("tr_stock").style.display = "none";
			document.getElementById('submit').disabled = false;
		}
		
		function verifint(verint, id){
		    if(isValidInt(verint)) {
				document.getElementById('int'+id).style.color = '';
		    	document.getElementById('stock').style.color = '';
				document.getElementById('submit').disabled = false;
		    } else {
				document.getElementById('int'+id).style.color = 'red';
		    	document.getElementById('stock').style.color = 'red';
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
				<td><input type="text" name="name" id="name" maxlength="45" size="48"
					value="<?php if($edit) echo $_POST['name'] ?>" /></td>
			</tr>
			<tr>
				<td>Maximum un / personne ?</td>
				<td><input id="isunique_yes" type="radio" name="isunique" value="1"
				<?php if ($edit && $_POST['isunique'] == "1") echo 'checked="checked"'; ?> /> Oui <small><em>(ex : une prévente R2D)</em></small>
				<input id="isunique_no" type="radio" name="isunique" value="0"
				<?php if (!$edit || $edit && $_POST['isunique'] == "0") echo 'checked="checked"'; ?> /> Non <small><sem>(ex : un coca)</sem></small>
				</td>
			</tr>
			<tr>
				<td>Connais-tu le stock ?</td>
				<td><input id="stock_yes" type="radio" name="is_stock" value="1" onclick="stockYes();"
				<?php if (!$edit || $edit && $_POST['is_stock'] == "1") echo 'checked="checked"'; ?> /> Oui
				<input id="stock_no" type="radio" name="is_stock" value="0" onclick="stockNo();"
				<?php if ($edit && $_POST['is_stock'] == "0") echo 'checked="checked"'; ?> /> Non</td>
			</tr>
			<tr id="tr_stock" <?php if ($edit && $_POST['is_stock'] == "0") echo 'style="display: none;"'; ?>>
				<td id="int1">Stock :</td>
				<td><input type="text" name="stock" id="stock" onBlur="verifint(this.value, 1);" maxlength="10" size="10" value="
					<?php if($edit) {
		  			  if ($_POST['is_stock'] == "1" && $_POST['stock']) {
					    echo $_POST['stock'];
					  }
					  echo '"';
					} else echo '"';
					?> /></td>
		    </tr>
			<tr>
				<td><a href="categorie.php?id_fundation=<?php echo $id_fundation; ?>" title="Ajouter une catégorie">Catégorie :</a></td>		
				<td><select name="categorie" id="categorie">
<?php
  if ($allCategorieCSV = $FADMIN->getAllCategories()) {
    foreach (str_getcsv($allCategorieCSV, ',') as $categorie) {
	  echo '<option value="'.$categorie[0].'"';
      // On check quel valeur a été posté et on la met en selected
      if ($edit && $_POST['categorie'] == $categorie[0]) echo ' selected="selected"';
        echo '>'.$categorie[1].'</option>';
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
				<td colspan="2" align="right">
            		<input type="<?php if($edit){ 
            	    	echo 'hidden" name="id" value="'.$_POST['id'].'" />
            	    	<input type="button" onClick="location.href=\'\'" name="stop_edit" value="Stopper l\'édition" />
            	    	<input type="submit" id="submit" name="edit_object" value="Editer cet';
            	    } else { echo 'submit" id="submit" name="add_object" value="Ajouter un'; } ?> objet" />
		        </td>
		    </tr>
		</table>
	</form>
<?php  $page->modulefooter();
  $page->moduleHeader('Mes objets');
  $j='0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau

  if ($fundationObjects = $FADMIN->getAllObjects()) {
    echo '<table width="100%">
      <tr>
        <th>Image</th>
        <th>Produit</th>
        <th>1 max.</th>
        <th>Stock</th>
        <th>Catégorie</th>
        <th width="20px"></th>
        <th width="20px"></th>
      </tr>';
    foreach (str_getcsv($fundationObjects, ',') as $fundationObject) {
      /* DESCRIPTION DE $fundationObject
       * 0 = L'identifiant de l'object
       * 1 = Le nom de l'objet
       * 2 = L'identifiant de la Categorie
       * 3 = Le nom de la Catégorie
       * 3 = S'il est unique ou non
       * 4 = Le nombre en stock
       * 5 = L'identifiant de l'image associée
       * 8 = S'il s'agit d'une promotion
       */
      $id_object = $fundationObject[0];
      $name_object = $fundationObject[1];
      $id_category = $fundationObject[2];
      $name_category = $fundationObject[3];
      $isunique = $fundationObject[4];
      $stock = $fundationObject[5];
      $id_image = $fundationObject[6]; 

      echo '<tr class="'.((++$j%2)?'pair':'impair').'">
        <td style="text-align: center;">';
      // Affichage de l'image
      include ('image.inc');
      echo '</td>
        <td>'.$name_object.'</td>
        <td>';
      // Cas où objet unique
      if($isunique==1) echo 'Oui';
      // Cas où objet pas unique
      elseif($isunique==0) echo 'Non';
      echo '</td>
      <td>';
      if($stock!=-1) echo $stock;
      echo '</td>
        <td>'.$name_category.'</td>';
      // Formulaire d'édition d'un objet  
      echo '<td><form style="display:inline;" method="post" action="object.php?id_fundation='.$id_fundation.'">
          <input type="hidden" name="id" value="'.$id_object.'" />
          <input type="hidden" name="name" value="'.$name_object.'" />
          <input type="hidden" name="isunique" value="'.$isunique.'" />';
      // On vérifie s'il y a du stock ou non pour faciliter l'édition
      if ($stock == -1) { $is_stock = 0; } else { $is_stock = 1; }
      echo '<input type="hidden" name="is_stock" value="'.$is_stock.'" />
          <input type="hidden" name="stock" value="'.$stock.'" />
          <input type="hidden" name="categorie" value="'.$id_category.'" />
          <input class="edit" type="submit" name="edit" title="Editer" value="" />
        </form></td>';
      // Formulaire de suppression d'un objet  
      echo '<td><form style="display:inline;" method="post" action="object.php?id_fundation='.$id_fundation.'">
          <input type="hidden" name="id" value="'.$id_object.'" />
          <input class="delete" type="submit" name="delete" title="Supprimer" value="" />
        </form></td>
      </tr>';
    }
  } else {
    echo "Tu n'as enregistré aucun objet.";
  }
  echo '</table>';
  $page->modulefooter();
?>
	</div>
	<div class="colomn2">
<?php include_once ('navigation.inc.php'); ?>
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
