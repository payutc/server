<?php
/***************************************************************************
 *                                 droit.php
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
$needFADMIN=false;
$needBADMIN=true;

include_once('header.inc.php');


// S'il y a un get de l'id fundation le SADMIN et le SBUY sont sérialisés dans la session
if (isset($_SESSION['buckutt']['SADMIN']) && isset($_SESSION['buckutt']['BADMIN'])) {

  // On délinéarise les objets SADMIN et FADMIN correspondant à l'organisme stockés.
  $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
  $BADMIN = unserialize($_SESSION['buckutt']['BADMIN']);

  // Header de l'IHM
?>
<div class="colomn1">
<?php
  $page->moduleHeader('Les droits');
  $j='0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau

  if ($allDroits = $BADMIN->getAllRights()) {
    echo '<table width="100%">
      <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Admin</th>
      </tr>';
    foreach (str_getcsv($allDroits, ',') as $droit) {
      /* DESCRIPTION DE $droit
       * 0 = Identifiant du droit
       * 1 = Nom du droit
       * 2 = Description du droit
       * 3 = Si c'est un droit d'administrateur
       */
      echo '<tr class="'.((++$j%2)?'pair':'impair').'">
          <td>'.$droit[0].'</td>
          <td>'.$droit[1].'</td>
		  <td>';
      // Cas où c'est un droit admin
      if($droit[2]==1) echo 'Oui';
      // Cas où ce n'est pas un droit admin
      elseif($droit[2]==0) echo 'Non';
      // Formulaire d'édition d'une categorie
      echo '</tr>';
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

} else {
  header('Location: index.php');
}
?>
