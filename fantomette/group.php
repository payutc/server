<?php
/***************************************************************************
 *                                 group.php
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
$needSBUY=false;
$needFADMIN=true;
$needBADMIN=false;

include_once('header.inc.php');


// S'il y a un get de l'id fundation le SADMIN et le SBUY sont sérialisés dans la session
if (isset($_GET['id_fundation']) && isset($_SESSION['buckutt']['SADMIN']) && isset($_SESSION['buckutt']['FADMIN'])) {

  // On stock l'id de la fundation
  $id_fundation = $_GET['id_fundation'];

  // On délinéarise les objets SADMIN et FADMIN correspondant à l'organisme stockés.
  $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
  $FADMIN = unserialize($_SESSION['buckutt']['FADMIN']);
  //On charge la fondation
  if ($FADMIN->setIdFundation($id_fundation) != 1)
  	header('location: index.php');
  
  // Header de l'IHM
?>
<div class="colomn1">
<?php 
  $edit = false;
  // Ajout, edition ou suppression d'un produit
  if (!empty($_POST)) {
    // On verifie si on est en suprresion
    if (isset($_POST['id']) && isset($_POST['delete'])) {
      $test = $FADMIN->deleteGroup($_POST['id']);
      if(!empty($test) && $test==true) {
        $page->msgInfo('Groupe supprim&eacute; avec succ&egrave;s !');
      } else {
        $page->msgError('Erreur : la suppression n\'a pas pu avoir lieu...');
      }
    } else {
      // On test si tous les post sont remplis
      if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['alone']) && isset($_POST['public'])) {
      		
        $name = htmlentities(utf8_decode($_POST['name']));
        // On verifie si on est en ajout ou en edition (s'il y a id_object existant)
        if (isset($_POST['id'])) {
          // On test l'edition
          if (isset($_POST['edit_group'])) {			
            $test_name = $FADMIN->editGroupName($_POST['id'], $name);
            $test_alone = $FADMIN->editGroupAlone($_POST['id'], $_POST['alone']);
            $test_public = $FADMIN->editGroupPublic($_POST['id'], $_POST['public']);
            if(!empty($test_name) && $test_name==true && !empty($test_alone) && $test_alone==true && !empty($test_public) && $test_public==true) {
              $page->msgInfo('Groupe édit&eacute; avec succ&egrave;s !');
            } else { $page->msgError('Erreur : l\'édition n\'a pas pu avoir lieu...'); }
          } else { $edit = true; }
        } else {
          // On test l'ajout
          $test = $FADMIN->addGroup($name, $_POST['alone'], $_POST['public']);
          if(!empty($test) && $test==true) {
            $page->msgInfo('Groupe ajout&eacute; avec succ&egrave;s !');
          } else {
            $page->msgError('Erreur : l\'ajout n\'a pas pu avoir lieu...');
          }
        }
      } else { $page->msgError('Attention : il faut remplir tous les champs. Surtout quand il n\'y en a qu\'un ;)'); }
    }
  }
    
  // On affiche ajouter ou editer
  if ($edit){
    $page->moduleHeader('Editer un groupe', 'FFCC00');
  } else {
    $page->moduleHeader('Ajouter un groupe', 'FFCC00');
  }

  echo '<form method="post" action="group.php?id_fundation='.$id_fundation.'" >';
?>
		<table width="100%">
			<tr>
				<td>Nom du groupe :</td>
				<td><input type="text" name="name" id="name" maxlength="47" size="47" value="<?php if($edit) {echo $_POST['name']; }?>" /></td>
			</tr>
			<tr><td colspan="2">Un utilisateur peut-il s'inscrire lui-même à ce groupe ?</td>
			<tr>
				<td colspan="2"><input id="alone_yes" type="radio" name="alone" value="1"
				<?php if ($edit && $_POST['alone'] == "1") echo 'checked="checked"'; ?> /> Oui
				<input id="alone_no" type="radio" name="alone" value="0"
				<?php if (!$edit || $edit && $_POST['alone'] == "0") echo 'checked="checked"'; ?> /> Non
				</td>
			</tr>
 			<tr><td colspan="2">Ce groupe doit-il être accessible ailleurs que dans votre organisme ?</td>
			<tr>
				<td colspan="2"><input id="public_yes" type="radio" name="public" value="1"
				<?php if ($edit && $_POST['public'] == "1") echo 'checked="checked"'; ?> /> Oui
				<input id="public_no" type="radio" name="public" value="0"
				<?php if (!$edit || $edit && $_POST['public'] == "0") echo 'checked="checked"'; ?> /> Non
				</td>
			</tr>
			<tr><td colspan="2"><small><em>Pour ne pas remplir la liste des groupes de tous les organismes inutilements,</em></small></td></tr>
			<tr><td colspan="2"><small><em>utiliser la réponse Oui avec parcimonie.</em></small></td></tr>
        	<tr>
            	<td colspan="2" align="right">
            		<input type="<?php if($edit){ 
            	    	echo 'hidden" name="id" value="'.$_POST['id'].'" />
            	    	<input type="button" onClick="location.href=group.php?id_fundation=<?php echo $id_fundation ?>" name="stop_edit" value="Stopper l\'édition" />
            	    	<input type="submit" name="edit_group" value="Editer ce';
            	    } else { echo 'submit" name="add_group" value="Ajouter un'; } ?> groupe" />
 	           </td>
    	    </tr>
		</table>
	</form>
<?php
  $page->modulefooter();

  $page->moduleHeader('Mes Groupes');
  $j='0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau

  if ($allFundationGroups = $FADMIN->getAllFundationGroups()) {
    echo '<table width="100%">
      <tr>
        <th>Nom du groupe</th>
        <th>Ouvert ?</th>
        <th>Publique ?</th>
        <th width="20px"></th>
        <th width="20px"></th>
      </tr>';
    foreach (str_getcsv($allFundationGroups, ',') as $group) {
      /* DESCRIPTION DE $categorie
       * 0 = Identifiant du groupe
       * 1 = Nom du groupe
       * 2 = Si un utilisateur peut rejoindre lui même le groupe
       * 3 = Si le groupe est publique
       */
      echo '<tr class="'.((++$j%2)?'pair':'impair').'">
          <td>'.$group[1].'</td>
          <td>';
      // Cas où le groupe est ouvert
      if($group[2]==1) echo 'Oui';
      // Cas où le groupe n'est pas ouvert
      elseif($group[2]==0) echo 'Non';
      echo '</td>
          <td>';
      // Cas où le groupe est publique
      if($group[3]==1) echo 'Oui';
      // Cas où le groupe n'est pas publique
      elseif($group[3]==0) echo 'Non';
      echo '</td>';
      
      // Formulaire d'édition d'un groupe
      echo '<td><form style="display:inline;" method="post" action="group.php?id_fundation='.$id_fundation.'">
              <input type="hidden" name="id" value="'.$group[0].'" />
              <input type="hidden" name="name" value="'.$group[1].'" />
              <input type="hidden" name="alone" value="'.$group[2].'" />
              <input type="hidden" name="public" value="'.$group[3].'" />
          <input class="edit" type="submit" name="edit" title="Editer" value="" />
        </form></td>';
        // Formulaire de suppression d'un groupe  
      echo '<td><form style="display:inline;" method="post" action="group.php?id_fundation='.$id_fundation.'">
          <input type="hidden" name="id" value="'.$group[0].'" />
          <input class="delete" type="submit" name="delete" title="Supprimer" value="" />
        </form></td>
      </tr>';
    }
  } else {
    echo "Tu n'as enregistré aucun groupe.";
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
  //$_SESSION['buckutt']['SADMIN'] = serialize($SADMIN);
  //$_SESSION['buckutt']['FADMIN'][$id_fundation] = serialize($FADMIN);
} else {
  header('Location: index.php');
}
?>
