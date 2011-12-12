<?php
/***************************************************************************
 *                             dashboard.inc.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Tuesday, Aug 6, 2009
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
// Cf. function credit_format de header.inc.php
$credit = credit_format($SBUY->getCredit());
?>

<!-- jquery pour le datePicker -->
<meta charset="UTF-8" />
<link type="text/css" href="css/flick/jquery-ui-1.8.4.custom.css" rel="stylesheet" />
<link type="text/css" href="table-sorter/style.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js">
</script>
<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js">
</script>
<script type="text/javascript" src="js/tablesorter.js">
</script>
<script type="text/javascript" src="js/jquery.tablesorter.pager.js">
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#purchaseTable').tablesorter();
		$('#rechargeTable').tablesorter();
    });    
</script>

<div class="colomn1">
    <?php
    // L'idée était de mettre en avant un produit particulier mais faute de  temps ça sera aléatoire
    
    //if ($myPropositionsCSV = $SBUY->getMyPropositions()) {
    //echo '<div>
    //      <div class="colomn11"> -->';
    /*
     $page->moduleheader('Vitrine', '', 'FFFFFF', 'architectural6');
     $myPropositions = str_getcsv($myPropositionsCSV, ',');
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
    /*
     // On prend un nombre aléatoire dans les propositions
     $nbProposition = rand(0, count($myPropositions) - 1);
     echo '<div style="float:left">';
     // Variable nécessaire à l'affichage de l'image
     $id_image =  $myPropositions[$nbProposition][2];
     $id_price = $myPropositions[$nbProposition][8];
     $name_object = $myPropositions[$nbProposition][0];
     $price = credit_format($myPropositions[$nbProposition][7]);
     // Affichage de l'image
     include ('image.inc');
     echo '</div>
     <div style="float:left; margin-left:5px;">
     <h1>'.$name_object.'</h1>
     <h1>à '.$price.'</h1>
     <h1 style="margin-bottom:0;"><a href="buy.php" title="En savoir plus">En savoir plus ?</a></h1>
     </div>';
     $page->modulefooter();
     echo '</div>
     <div class="colomn12">';
     */
    //}
    /*
     $page->moduleheader('Solde', '', 'FFFFFF', 'architectural7');
     echo '<h2 style="text-align:center;"><a href="reload.php" title="Recharger mon compte">Recharger avec ma Carte Bancaire</a></h2>';
     echo  '<h1>Tu as '.$credit.' sur ton compte.</h1>';
     $page->modulefooter();
     */
    if ($myPropositionsCSV)
    {
    ?>
    <!--        </div>
    </div>
    <div class="clear">
    </div> -->
    <?php
    }
    $today = time();
    $fiveDayBefore = time()-(5*24*60*60);
    
    /*$page->moduleHeader('Tableau de bord', 'FFCC00');
     
     // On prend un nombre aléatoire dans les propositions
     if ($myPropositionsCSV) {
     $nbProposition = rand(0, count($myPropositions) - 1);
     echo '<div style="float:left">';
     // Variable nécessaire à l'affichage de l'image
     $id_image = $myPropositions[$nbProposition][2];
     $id_price = $myPropositions[$nbProposition][8];
     $name_object = $myPropositions[$nbProposition][0];
     $price = credit_format($myPropositions[$nbProposition][7]);
     // Affichage de l'image
     include ('image.inc');
     echo '</div>
     <div style="float:left; margin-left:5px;">
     <h1>'.$name_object.'</h1>
     <h1>à '.$price.'</h1>
     <h1 style="margin-bottom:0;"><a href="buy.php" title="En savoir plus">En savoir plus ?</a></h1>
     </div>';
     }
     $page->modulefooter();
     */
    
    $page->moduleheader('Mon solde', '', 'FFFFFF', 'architectural7');
    
    echo '<a href="reload.php" title="Recharger mon compte" style="border:none;"><img src="images/paiment.jpg" style="width: 180px; float: right;border:none;" /></a>';
    echo '<h1 style="text-align: center;padding:15px">Tu as '.$credit.' sur ton compte.</h1>';
    
    
    echo '<h2 style="text-align:center;margin-top:30px;"><a href="reload.php" title="Recharger mon compte">Recharger mon compte</a></h2>';
    
    $page->modulefooter();
    
    $today = time();
    $fiveDayBefore = time()-(5*24*60*60);
    
    $page->moduleHeader('Tableau de bord', 'FFCC00');
    ?>
    <h3 style="margin-bottom:5px; text-align: center;">Mes achats des 5 derniers jours</h3>
    <?php
    $histoAchatsCSV = $SADMIN->getHistoriqueAchats($fiveDayBefore, $today);
    if ($histoAchatsCSV == 400)
    {
        echo '<p>Tu n\'as rien acheté depuis 5 jours.</p>';
    } else
    {
        $histoAchats = (str_getcsv($histoAchatsCSV, ','));
        // On vérifie que la conversion du CVS en tableau n'a pas posée d'erreur
        if ($histoAchats == 400)
        {
            echo '<div class="errormsg">Un problème est survenu. Contacte buckutt@utt.fr pour une réparation rapide !</div>';
        } else
        {
    
    ?>
   <table id="purchaseTable" width="100%" class="tablesorter" style="margin:0px;">
        <thead>
    <tr>
        <th>
            Date
        </th>
        <th>
            Produit
        </th>
        <th>
            Lieu
        </th>
        <th>
            Prix
        </th>
    </tr>
	</thead>
	<tbody>
    <?php
    $j = '0';
    foreach ($histoAchats as $histoAchat)
    {
        echo '<tr class="odd">
              <td>'.date('d/m/y  H:i', $histoAchat[0]).'</td>
              <td>'.$histoAchat[1].'</td>
              <td>'.$histoAchat[4].'</td>
              <td>'.credit_format($histoAchat[6]).'</td>'
    ?>
    </tr>
    <?php
    } 
    }
    echo '</tbody></table>';
    }
    ?>
    <p style="text-align: right; text-transform: uppercase; font-weight: bold; font-size: 0.8em;">
        <a href="histo_purchase.php">Voir tout l'historique de mes achats</a>
    </p>
    <h3 style="margin-bottom:5px; text-align: center;">Mes rechargements des 5 derniers jours</h3>
    <?php
    $histoRechargesCSV = $SADMIN->getHistoriqueRecharge($fiveDayBefore, $today);
	
    if ($histoRechargesCSV == 400)
    {
        echo '<p>Tu n\'as pas rechargé depuis 5 jours.</p>';
    } else
    {
        $histoRecharges = (str_getcsv($histoRechargesCSV, ','));
        // On vérifie que la conversion du CVS en tableau n'a pas posée d'erreur
        if ($histoRecharges == 400)
        {
            echo '<div class="errormsg">Un problème est survenu. Contacte buckutt@utt.fr pour une réparation rapide !</div>';
        } else
        {
    
    ?>
   <table id="rechargeTable" width="100%" class="tablesorter" style="margin:0px;">
        <thead>
    <tr>
        <th>
            Date
        </th>
        <th>
            Montant
        </th>
        <th>
            Type
        </th>
        <th>
            Lieu
        </th>
    </tr>
	</thead>
	<tbody>
		 <?php
    $j = '0';
    foreach ($histoRecharges as $histoRecharge)
    {
        echo '<tr class="odd">
                <td>'.date('d/m/y  H:i', $histoRecharge[0]).'</td>
                <td>'.number_format($histoRecharge[5]/100, 2, ',', ' ').'</td>
                <td>'.$histoRecharge[1].'</td>
                <td>'.$histoRecharge[4].'</td>'
    ?>
</tr>
<?php
} 
}
echo '</tbody></table>';
}
?>
<p style="text-align: right; text-transform: uppercase; font-weight: bold; font-size: 0.8em;">
    <a href="histo_recharge.php">Voir tout l'historique de mes recharges</a>
</p>
<?php
$page->modulefooter();
?>
</div>
<div class="colomn2">
    <?php
    include_once ('navigation.inc.php');
    ?>
</div>
