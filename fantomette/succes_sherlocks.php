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
//$idPage = 167;
$needSBUY = true;
$needFADMIN = false;
$needBADMIN = false;

include_once ('header.inc.php');

//Si le SADMIN et le SBUY sont sérialisés dans la session
if (isset($_SESSION['buckutt']['SADMIN']) && isset($_SESSION['buckutt']['SBUY'])) {
    // On délinéarise les objets SADMIN et SBUY stockés.
    $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
    $SBUY = unserialize($_SESSION['buckutt']['SBUY']);
    
    // Header de l'IHM
    
?>
<div class="colomn1">
    <?php
    
    $page->moduleHeader('Recharger en ligne');

$table = str_getcsv($SBUY->transactionClientDecode(base64_encode($_POST['DATA'])), ',');
if($table[0][0] == 1){
	echo "bien recharge de ".(($table[0][1])/100)." euros";
} else{
	echo "erreur ".$table[0][0];
}

?>
    <?php
    $page->modulefooter();
    ?>
</div>
<div class="colomn2">
    <?php include_once ('navigation.inc.php'); ?>
</div>
<?php 
$page->footer();

// On linéarise les objets SADMIN et SBUY pour les concerver de page en page.
//$_SESSION['buckutt']['SADMIN'] = serialize($SADMIN);
//$_SESSION['buckutt']['SBUY'] = serialize($SBUY);

} else {
    header('Location: index2.php');
}
?>
