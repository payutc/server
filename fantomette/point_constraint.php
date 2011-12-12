<?php
/***************************************************************************
 *                           point_constraint.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Sateday, Fev 27, 2010
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
  // Ajout, edition ou suppression d'un lien
  if (!empty($_POST)) {
  	// On verifie si on est en suprresion
    if (isset($_POST['object']) && isset($_POST['point']) && isset($_POST['delete'])) {
      // On test la suppression
      $test = $FADMIN->deleteObjectFromPoint($_POST['object'], $_POST['point']);
      if(!empty($test) && $test==true) {
        $page->msgInfo('Objet supprim&eacute;e du point avec succ&egrave;s !');
      } else {
        $page->msgError('Erreur : la suppression n\'a pas pu avoir lieu...');
      }
    } else {
      // On test si tous les post sont remplis
      if (isset($_POST['object']) && !empty($_POST['object']) && isset($_POST['point']) && !empty($_POST['point'])) {
        // On test l'ajout
        $test = $FADMIN->addObjectToPoint($_POST['object'], $_POST['point']);
        if(!empty($test) && $test==true) {
          $page->msgInfo('Object ajout&eacute;e au point avec succ&egrave;s !');
        } else { $page->msgError('Erreur : l\'ajout n\'a pas pu avoir lieu...'); }
      } else { $page->msgError('Attention : il faut remplir tous les champs.'); }
    }
  }

  $page->moduleHeader('Ajouter un objet à un point de vente', 'FFCC00');

  echo '<form method="post" action="point_constraint.php?id_fundation='.$id_fundation.'" >';
?>
		<table width="100%">
			<tr>
				<td><a href="object.php?id_fundation=<?php echo $id_fundation; ?>" title="Ajouter un objet">Objet :</td>		
				<td>
<?php
  if ($allObjectsCSV = $FADMIN->getAllObjects()) {
    echo '<select name="object" id="object">';
    foreach (str_getcsv($allObjectsCSV, ',') as $object) {
      echo '<option value ="'.$object[0].'">'.$object[1].'</option>';
    }
    echo '</select>';
  } 			
?>
				</td>
			</tr>
			<tr>
				<td>Point de vente :</td>		
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
		    <tr>
				<td colspan="2" align="right">
            		<input type="submit" id="submit" name="add_link" value="Ajouter" />
		        </td>
		    </tr>
		</table>
	</form>
<?php
  $page->modulefooter();

  
  if ($allPointsCSV = $FADMIN->getAllPoints()) {
  	foreach ($allPoints = str_getcsv($allPointsCSV, ',') as $p => $point) {
  	  // Gestion des ancres
  	  $Points = $allPoints;
  	  unset($Points[$p]);
      echo '<p style="text-align:center;margin-bottom:5px;margin-top:0px;">';
      foreach ($Points as $point1) {
        echo '| <a href="#'.$point1[0].'">'.$point1[1].'</a> | ';
      }
      echo '</p>
      <a name="'.$point[0].'"></a>';

      $page->moduleHeader("Les objets au point de vente $point[1]");
      $j='0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau
      if ($allObjectsByPoint = $FADMIN->getAllObjectsByPoint($point[0])) {
        echo '<table width="100%">
          <tr>
            <th>Object</th>
            <th width="20px"></th>
          </tr>';
        foreach (str_getcsv($allObjectsByPoint, ',') as $object) {
          /* DESCRIPTION DE $obecj
           * 0 = Identifiant de l'object
           * 1 = Nom de l'object
           */
          echo '<tr class="'.((++$j%2)?'pair':'impair').'">
              <td>'.$object[1].'</td>';
          // Formulaire de suppression d'un object de ce point de vente
          echo '<td><form style="display:inline;" method="post" action="point_constraint.php?id_fundation='.$id_fundation.'">
              <input type="hidden" name="object" value="'.$object[0].'" />
              <input type="hidden" name="point" value="'.$point[0].'" />
              <input class="delete" type="submit" name="delete" title="Supprimer" value="" />
            </form></td>
          </tr>';
        }
      } else {
        echo "Tu n'as enregistré aucun objet à ce point de vente.";
      }

      echo '</table>';
      $page->modulefooter();
  	}
  }
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
