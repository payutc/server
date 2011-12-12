<?php 
/***************************************************************************
 *                                history.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Wednesday, Aug 5, 2009
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
$idPage = 165;
$needSBUY = false;
$needFADMIN=false;
$needBADMIN=false;

include_once ('header.inc.php');

//Si le SADMIN est sérialisé dans la session
if (isset($_SESSION['buckutt']['SADMIN'])) {
  // On délinéarise l'objet SADMIN stocké.
  $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
  
  // On stock le mois en cours s'il n'existe pas dans la session
  if (!isset($_SESSION['buckutt']['historique']) || empty($_SESSION['buckutt']['historique'])) {
    $_SESSION['buckutt']['historique']['buy'] = $_SESSION['buckutt']['historique']['reload'] = $_SESSION['buckutt']['historique']['sale'] = $_SESSION['buckutt']['historique']['connexion'] = 0;
  }

  $titles = Array ('buy', 'reload', 'sale', 'connexion');
  //$isSeller = $SADMIN->isSeller();
  $isSeller = 0;

  foreach ($titles as $title) {
    if (isset($_POST[$title]) && ! empty($_POST[$title])) {
      switch ($_POST[$title]) {
        case 1:
       	  $_SESSION['buckutt']['historique'][$title] = 0;
       	  break;
        case 2:
          $_SESSION['buckutt']['historique'][$title] = ($_SESSION['buckutt']['historique'][$title] - 1);
          break;
        case 3:
          $_SESSION['buckutt']['historique'][$title] = ($_SESSION['buckutt']['historique'][$title] + 1);
          break;
        default:
          $_SESSION['buckutt']['historique'][$title] = 0;
      }
    }

    $date_start[$title] = mktime() - ($_SESSION['buckutt']['historique'][$title] + 1) * 30 * 3600 * 24;
    $date_end[$title] = mktime() - $_SESSION['buckutt']['historique'][$title] * 30 * 3600 * 24;
  }
?>
<div class="colomn1">
<?php 
  setlocale (LC_ALL, "fr_FR");
  $page->moduleHeader('Mes achats de '.ucfirst(strftime('%B %Y', $date_end['buy'])));
  $histoAchatsCSV = $SADMIN->getHistoriqueAchats($date_start['buy'], $date_end['buy']);
  if ( empty($histoAchatsCSV)) {
    echo '<p>Tu n\'as rien acheté ce mois-ci.';
  } else {
?>
    <table width="100%">
    <tr>
        <th>Date</th>
        <th>Produit</th>
        <th>Vendeur</th>
        <th>Lieu</th>
        <th>Organisme</th>
        <th>Prix</th>
    </tr>
<?php 
    $histoAchats = (str_getcsv($histoAchatsCSV, ','));
    $j = '0';
    foreach ($histoAchats as $i=>$histoAchat) {
      echo '<tr class="'.((++$j % 2) ? 'pair' : 'impair').'">
        <td>'.date('d/m/y  H:i', $histoAchat[0]).'</td>
        <td>'.$histoAchat[1].'</td>
        <td>'.$histoAchat[2].' '.$histoAchat[3].'</td>
        <td>'.$histoAchat[5].'</td>
        <td>'.$histoAchat[6].'</td>';
      // Cf. function credit_format de header.inc.php
      echo '<td>'.credit_format($histoAchat[4]).'</td>'
?>
    </tr>
<?php    } ?>
</table>
<?php  } ?>
<div style="text-align:center;margin-top:5px;float:left;">
    <form style="display:inline;" method="post" action="history.php#achats">
        <input type="hidden" name="buy" id="next" value="3" />
		<input type="submit" name="next" value="&lt; <? echo ucfirst(strftime('%b %y', $date_start['buy'])) ?>" />
    </form>
</div>
<div style="text-align:center;margin-top:5px;float:right;">
<?php if ($_SESSION['buckutt']['historique']['buy'] > 0) { ?>
    <form style="display:inline;" method="post" action="history.php#achats">
        <input type="hidden" name="buy" id="previous" value="2" />
		<input type="submit" name="previous" value="<? echo ucfirst(strftime('%b %y', ($date_end['buy'] + 30 * 3600 * 24))); ?> &gt;" />
    </form>
<?php }
if ($_SESSION['buckutt']['historique']['buy'] > 1) { ?>
    <form style="display:inline;" method="post" action="history.php#achats">
        <input type="hidden" name="buy" id="now" value="1" />
		<input type="submit" name="now" value="<?php echo ucfirst(strftime('%b %y')); ?> &gt;&gt;" />
    </form>
<?php } ?>
</div>
<?php
  $page->modulefooter(); 
?>

<a name="rechargements"></a>
<?php 
  $page->moduleHeader('Mes rechargements de '.ucfirst(strftime('%B %Y', $date_end['reload'])));
  $histoRechargesCSV = $SADMIN->getHistoriqueRecharge($date_start['reload'], $date_end['reload']);
  if ( empty($histoRechargesCSV)) {
    echo '<p>Tu n\'as pas rechargé ce mois-ci.</p>';
  } else {
?>
<table width="100%">
	<tr>
    	<th>Date</th>
    	<th>Montant</th>
    	<th>Type</th>
    	<th>Lieu</th>
    	<th>Opérateur</th>
	</tr>
<?php 
    $histoRecharges = (str_getcsv($histoRechargesCSV, ','));
    $j = '0';
    foreach ($histoRecharges as $i=>$histoRecharge) {
      echo '<tr class="'.((++$j % 2) ? 'pair' : 'impair').'">
        <td>'.date('d/m/y  H:i', $histoRecharge[0]).'</td>';
      // Cf. function credit_format de header.inc.php
      echo '<td>'.credit_format($histoRecharge[2]).'</td>
        <td>'.$histoRecharge[1].'</td>
        <td>'.$histoRecharge[5].'</td>
        <td>'.$histoRecharge[3].' '.$histoRecharge[4].'</td>'
?>
	</tr>
<?php    } ?>
</table>
<?php  } ?>
<div style="text-align:center;margin-top:5px;float:left;">
    <form style="display:inline;" method="post" action="history.php#rechargements">
        <input type="hidden" name="reload" id="next" value="3" />
		<input type="submit" name="next" value="&lt; <? echo ucfirst(strftime('%b %y', $date_start['reload'])) ?>" />
    </form>
</div>
<div style="text-align:center;margin-top:5px;float:right;">
<?php if ($_SESSION['buckutt']['historique']['reload'] > 0) { ?>
    <form style="display:inline;" method="post" action="history.php#rechargements">
        <input type="hidden" name="reload" id="previous" value="2" />
		<input type="submit" name="previous" value="<? echo ucfirst(strftime('%b %y', ($date_end['reload'] + 30 * 3600 * 24))); ?> &gt;" />
    </form>
<?php }
if ($_SESSION['buckutt']['historique']['reload'] > 1) { ?>
    <form style="display:inline;" method="post" action="history.php#rechargements">
        <input type="hidden" name="reload" id="now" value="1" />
		<input type="submit" name="now" value="<?php echo ucfirst(strftime('%b %y')); ?> &gt;&gt;" />
    </form>
<?php } ?>
</div>
<?php 
  $page->modulefooter();
 
// Données trop sensibles !!
  if ($isSeller) {
?>
<p style="text-align:center;margin-bottom:5px;margin-top:0px;">
    | <a href="#achats">Mes achats</a> | 
    | <a href="#rechargements">Mes Rechargements</a> | 
    | <a href="#connexions">Mes Connexions</a> |
</p>
<a name="ventes"></a>
<?php
  $page->moduleHeader('Mes ventes de '.ucfirst(strftime('%B %Y', $date_end['sale'])));
  $histoVentesCSV = $SADMIN->getHistoriqueVentes($date_start['sale'], $date_end['sale']);
  if ( empty($histoVentesCSV)) {
    echo '<p>Tu n\'as rien vendu ce mois-ci.';
  } else {
?>
    <table width="100%">
    <tr>
        <th>Date</th>
        <th>Produit</th>
        <th>Acheteur</th>
        <th>Lieu</th>
        <th>Organisme</th>
        <th>Prix</th>
    </tr>
<?php 
    $histoVentes = (str_getcsv($histoVentesCSV, ','));
    $j = '0';
    foreach ($histoVentes as $i=>$histoVente) {
      echo '<tr class="'.((++$j % 2) ? 'pair' : 'impair').'">
        <td>'.date('d/m/y  H:i', $histoVente[0]).'</td>
        <td>'.$histoVente[1].'</td>
        <td>'.$histoVente[2].' '.$histoVente[3].'</td>
        <td>'.$histoVente[5].'</td>
        <td>'.$histoVente[6].'</td>';
      // Cf. function credit_format de header.inc.php
      echo '<td>'.credit_format($histoVente[4]).'</td>'
?>
    </tr>
<?php    } ?>
</table>
<?php  } ?>
<div style="text-align:center;margin-top:5px;float:left;">
    <form style="display:inline;" method="post" action="history.php#ventes">
        <input type="hidden" name="sale" id="next" value="3" />
		<input type="submit" name="next" value="&lt; <? echo ucfirst(strftime('%b %y', $date_start['sale'])) ?>" />
    </form>
</div>
<div style="text-align:center;margin-top:5px;float:right;">
<?php if ($_SESSION['buckutt']['historique']['sale'] > 0) { ?>
    <form style="display:inline;" method="post" action="history.php#ventes">
        <input type="hidden" name="sale" id="previous" value="2" />
		<input type="submit" name="previous" value="<? echo ucfirst(strftime('%b %y', ($date_end['sale'] + 30 * 3600 * 24))); ?> &gt;" />
    </form>
<?php }
if ($_SESSION['buckutt']['historique']['sale'] > 1) { ?>
    <form style="display:inline;" method="post" action="history.php#ventes">
        <input type="hidden" name="sale" id="now" value="1" />
		<input type="submit" name="now" value="<?php echo ucfirst(strftime('%b %y')); ?> &gt;&gt;" />
    </form>
<?php } ?>
</div>
<?php
  $page->modulefooter(); 
  }
  /*echo '<p style="text-align:center;margin-bottom:5px;margin-top:0px;">
    | <a href="#achats">Mes achats</a> | 
    | <a href="#rechargements">Mes Rechargements</a> | ';
  if ($isSeller) { echo '| <a href="#ventes">Mes ventes</a> |'; }; ?>
</p>
<a name="connexions"></a>
<?php  $page->moduleHeader('Mes connexions'); ?>
<table>
    <tr>
        <th>
            Title
        </th>
    </tr>
<?php 
  $j = '0';
  for ($i = 0; $i < 5; $i++) {
?>
    <tr class="<?=((++$j%2)?'pair':'impair')?>">
        <td>ma celulle</td>
    </tr>
<?php  } ?>
</table>
<?php  $page->modulefooter(); */?>
</div>
<div class="colomn2">
<?php  include_once ('navigation.inc.php'); ?>
</div>
<?php
  $page->footer();

  // On linéarise une partie de l'objet SADMIN pour la concervé de page en page.
  $_SESSION['buckutt']['SADMIN'] = serialize($SADMIN);
}
else {
  header('Location: index.php');
}
?>
