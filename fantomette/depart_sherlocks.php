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
if ( isset ($_SESSION['buckutt']['SADMIN']) && isset ($_SESSION['buckutt']['SBUY']))
{
    // On délinéarise les objets SADMIN et SBUY stockés.
    $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
    $SBUY = unserialize($_SESSION['buckutt']['SBUY']);

    // Header de l'IHM

?>
<div class="colomn1">
    <?php
    
    $page->moduleHeader('Recharger en ligne');
    
    $maxcredit = $SBUY->getMaxCredit();
    $credit = $SBUY->getCredit();
    
    
    if ( isset ($_GET['qteman']))
    {
        $_GET['qteman'] = str_replace(',', '.', $_GET['qteman']); //la , est mal gérée, donc, transformée en .
		
		if (is_numeric($_GET['qteman']))
        {
            $_GET['qteman'] = intval($_GET['qteman']*100);
    
            if ($_GET['qteman'] <= ($maxcredit-$credit))
            {
                echo "<p>Actuellement, tu as un crédit de ".credit_format($credit)." sur ton compte.</p>
    <p>Tu souhaites effectuer un rechargement de ".credit_format($_GET['qteman']).".</p>
    <p>Ton solde sera donc de ".credit_format($credit+$_GET['qteman']).".</p><p><a href='reload.php'>Retour</a></p>";
	
                $table = str_getcsv($SBUY->transactionEncode($_GET['qteman']), ',');
                echo base64_decode($table[0][1]);
				
            } else
            {
                echo "<p>Le montant demandé dépasse le maximum autorisé.</p><p><a href='reload.php'>Retour</a></p>";
            }
        } else
        {
            echo "<p>Ecris un nombre....</p><p><a href='reload.php'>Retour</a></p>";
        }
    } elseif ( isset ($_GET['qte']))
    {
        if (($_GET['qte'] == 500) or ($_GET['qte'] == 1000) or ($_GET['qte'] == 2000) or ($_GET['qte'] == 3000) or ($_GET['qte'] == 4000) or ($_GET['qte'] == 5000))
        {
            $table = str_getcsv($SBUY->transactionEncode($_GET['qte']), ',');
            echo "<p>Actuellement, tu as un crédit de ".credit_format($credit)." sur ton compte.</p>
    <p>Tu souhaites effectuer un rechargement de ".credit_format($_GET['qte']).".</p><p>
    Ton solde sera donc de ".credit_format($credit+$_GET['qte']).".</p><p><a href='reload.php'>Retour</a></p>";
            echo base64_decode($table[0][1]);
        } else
        {
            echo "<p>Montant invalide, petit rigolo :) !</p><p><a href='reload.php'>Retour</a><p>";
        }
    } else
    {
        echo "<p>Hum, rien à voir ici !</p><p><a href='reload.php'>Retour</a><p>";
    }
    
    ?>
    <?php
    $page->modulefooter();
    ?>
    <?php
    $page->msgInfo("Pour le rechargement par carte bancaire, tu seras redirigé vers le site sécurisé de notre partenaire financier, la LCL.");
    ?>
</div>
<div class="colomn2">
    <?php
    include_once ('navigation.inc.php');
    ?>
</div>
<?php
$page->footer();

// On linéarise les objets SADMIN et SBUY pour les concerver de page en page.
//$_SESSION['buckutt']['SADMIN'] = serialize($SADMIN);
//$_SESSION['buckutt']['SBUY'] = serialize($SBUY);

}
else
{
    header('Location: index2.php');
}
?>
