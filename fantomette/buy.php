<?php
/***************************************************************************
 *                                  buy.php
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
$idPage = 167;
$needSBUY=true;
$needFADMIN=false;
$needBADMIN=false;

include_once('header.inc.php');

//Si le SADMIN et le SBUY sont sérialisés dans la session
if (isset($_SESSION['buckutt']['SADMIN']) && isset($_SESSION['buckutt']['SBUY'])) {
  // On délinéarise les objets SADMIN et SBUY stockés.
  $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
  $SBUY = unserialize($_SESSION['buckutt']['SBUY']);

  // Header de l'IHM
?>
<div class="colomn1">
<?php	
  // Achat d'un produit
  if (isset($_POST['price']) && !empty($_POST['price']) && isset($_POST['credit']) && !empty($_POST['credit'])) {
    // Essai d'achat
    $test = $SBUY->buy($_POST['price'],$_POST['credit']);
    if(!empty($test) && $test==true) {
      $page->msgInfo('Produit achet&eacute; avec succ&egrave;s !');
    } else {
      $page->msgError('Erreur : l\'achat n\'a pas pu avoir lieu...');
    }
  }

  // Recapitulatif des produits en vente
  $page->moduleHeader('Produits disponibles');
  $j='0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau

  if ($myPropositions = $SBUY->getMyPropositions()) {
    echo '<table width="100%">
      <tr>
        <th>Image</th>
        <th>Produit</th>
        <th>Fin<br />des ventes</th>
        <th>Stock</th>
        <th>Organisme</th>
        <th>Prix</th>
        <th></th>
      </tr>';
    foreach (str_getcsv($myPropositions, ',') as $myProposition) {
      /* DESCRIPTION DE $myProposition
       * 0 = Le nom de l'objet
       * 1 = L'identifiant de la Categorie
       * 2 = L'identifiant de l'image associée
       * 3 = S'il est unique ou non
       * 4 = Le nombre en stock
       * 5 = Le nom de l'organisme
       * 6 = La date de fin de vente
       * 7 = Le prix
       * 8 = L'identifiant du prix
       */
      $name_object = $myProposition[0];
      $id_image = $myProposition[2];
      $stock = $myProposition[4];
      $name_fundation = $myProposition[5];
      // Cf. function credit_format de header.inc.php
      $credit = credit_format($myProposition[7]);
      $id_price = $myProposition[8];
      if ($myProposition[6]) {
        $date_end = date('d/m/y H:i', $myProposition[6]);
      } else { $date_end = ''; }

      echo '<tr class="'.((++$j%2)?'pair':'impair').'"><td style="text-align: center;">';
      // Affichage de l'image
      include ('image.inc');
      echo '</td>
        <td>'.$name_object.'</td>
	    <td>'.$date_end.'</td>
	    <td>';
      // Cas où le stock n'est pas annoncé
      if($stock==-1) echo 'Inconnu';
      // Cas où le stock est annoncé
      else echo $stock;
      echo'</td>
        <td>'.$name_fundation.'</td>
        <td>'.$credit.'</td>
        <td><form style="display:inline;" method="post" action="buy.php">
     	<script type="text/javascript">
		  function confirmSubmit()
		  {
			  var agree=confirm("Tu t\'apprêtes à acheter ceci : '.$name_object.' à '.$credit.' €.");
			  if (agree)
				  return true ;
			  else
				  return false ;
		  }
		  </script>
          <input type="hidden" name="price" id="price" value="'.$id_price.'" />
          <input type="hidden" name="credit" id="credit" value="'.$myProposition[7].'" />
          <input class="buy" type="submit" onClick="return confirmSubmit()" name="now" value="" title="Acheter" />
        </form></td></tr>';
    }
    echo '</table>';
  } else {
    echo "Il n'y a rien que tu puisses acheter. Essaie de recharger ton compte d'abord.";
  }
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
  $_SESSION['buckutt']['SBUY'] = serialize($SBUY);

} else {
  header('Location: index2.php');
}
?>
