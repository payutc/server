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
    $max = ($SBUY->getMaxCredit() - $SBUY->getCredit());
?>
<p>Choisis le montant à recharger : </p>
<p style="text-align: justify;margin-top:-5px;">
<?php
    if ($max >= 5)
        echo '<a href="depart_sherlocks.php?qte=500"><img src="images/5Euro.png" style="border: medium none ;" /></a>';
    if ($max >= 10)
       echo '<a href="depart_sherlocks.php?qte=1000"><img src="images/10Euro.png" style="border: medium none ;" /></a>';
    if ($max >= 20)
        echo '<a href="depart_sherlocks.php?qte=2000"><img src="images/20Euro.png" style="border: medium none ;" /></a>';
    if ($max >= 50)
        echo '<a href="depart_sherlocks.php?qte=5000"><img src="images/50Euro.png" style="border: medium none ;" /></a>';
?>    
</p>

<p> <form method="GET" action="depart_sherlocks.php" style="text-align:center;">
<label>Autre montant (max <?php echo credit_format($max) ?>) : <br /><input type="text" name="qteman" value="10"/></label>
<input type="submit" value="Recharger !" />
</form></p>

 <?php $page->modulefooter(); ?>
 
<?php
$page->msgInfo("Le montant de chaque compte est plafonné à 100 €.<br /><br />
Pour le rechargement par carte bancaire, tu seras redirigé vers le site sécurisé de notre partenaire financier, la LCL.");
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
    header('Location: index.php');
}
?>
