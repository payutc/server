<?php
/***************************************************************************
 *                             navigation.inc.php
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
$page->moduleheader('Navigation', '', '', 'architectural4', 'summer'); //00BDF4   D5FFD5
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#accordion").accordion();
    });
</script>
<div id="accordion">
    <li class="liens">
        <h3><span class="icon"><span></span></span><span class="text">Mon Compte</span><span class="clear"></span></h3>
        <ul>
            <li>
                <a href="index.php">Tableau de bord</a>
            </li>
            <li>
                <a href="reload.php">Recharger en ligne</a>
            </li>
            <li>
                <a href="histo_purchase.php">Historique des achats</a>
            </li>
            <li>
                <a href="histo_recharge.php">Historique des recharges</a>
            </li>
            <li>
                <a href="changepin.php">Changer mon code PIN</a>
            </li>
            <li>
                <a href="blockme.php">Bloquer mon compte</a>
            </li>
            <li>
                <a href="logout.php">Me déconnecter</a>
            </li>
        </ul>
    </li>
    	
		
    <?php
    if ($SADMIN->isAdminBuckutt() == 1)
    {
    ?>
    <li class="souvenirs">
        <h3><span class="icon"><span></span></span><span class="text">Administration</span><span class="clear"></span></h3>
        <ul>
            <?php
            if ($SADMIN->isRespFundations() == 1)
            {
            ?>
            <li>
                <a href="fundation.php">Gérer les organismes</a>
            </li>
            <?php
            }
            if ($SADMIN->isBloqueur() == 1)
            {
            ?>
            <li>
                <a href="block_deblock.php">Bloquer / Débloquer un compte</a>
            </li>
            <?php
            }
            if ($SADMIN->isDroitAdmin() == 1)
            {
            ?>
            <li>
                <a href="droit.php">Voir les droits</a>
            </li>
            <li>
                <a href="link_user_droit.php">Répartir les droits</a>
            </li>
            <?php
            }
            if ($SADMIN->isPointAdmin() == 1)
            {
            ?>
            <li>
                <a href="point.php">Gérer les points</a>
            </li>
            <?php
            }
            if ($SADMIN->isBuckuttTrezo() == 1)
            {
            ?>
            <li>
                <a href="b_treso.php">Trésorerie</a>
            </li>
            <?php
            }
            ?>
        </ul>
    </li>

<?php
}

$allFundations = $SADMIN->hasDroitsInFundations();
if ($allFundations != 409)
{
    foreach (str_getcsv($allFundations, ',') as $fundation)
    {
    	?>
		<li class="ung">
    	<h3><span class="icon"><span></span></span><span class="text"><?php echo $fundation[1] ?></span><span class="clear"></span></h3>	
		
        <ul>
            <?php
			
            if ($SADMIN->isVenteAdmin($fundation[0]) == 1)
            {
            ?>
            <li>
            	<a href="quick_sale.php?id_fundation=<?php echo $fundation[0]; ?>"><strong>Vente rapide</strong></a>
        	</li>
	        <li>
	            <a href="categorie.php?id_fundation=<?php echo $fundation[0]; ?>">Gérer les catégories</a>
	        </li>			
	        <li>
	            <a href="categorie.php?id_fundation=<?php echo $fundation[0]; ?>">Gérer les catégories</a>
	        </li>
	        <li>
	            <a href="object.php?id_fundation=<?php echo $fundation[0]; ?>">Gérer les objets</a>
	        </li>		
	        <li>
	            <a href="point_constraint.php?id_fundation=<?php echo $fundation[0]; ?>">Répartition des objets</a>
	        </li>		
			<?php
			}
			
            if ($SADMIN->isGroupEditor($fundation[0]) == 1)
            {
            ?>
	        <li>
	            <a href="group.php?id_fundation=<?php echo $fundation[0]; ?>">Gérer les groupes</a>
	        </li>	
	        <li>
	            <a href="link_user_group.php?id_fundation=<?php echo $fundation[0]; ?>">Répartition des utilisateurs</a>
	        </li>
			<?php
			}
			
			if ($SADMIN->isFundTrezo($fundation[0]) == 1)
            {
            ?>
	        <li>
	            <a href="fund_trezo.php?id_fundation=<?php echo $fundation[0]; ?>">Trésorerie</a>
	        </li>
			<?php
			}
			
			?>
		</ul>

</li>
		<?php
	}
}
?>
</div>

</li>






<?php
 if (false) {
 if ($isAdminVente == 1)
    ?>
    <ul>
        <li>
            <a href="price.php?id_fundation=<?php echo $fundation[0]; ?>">Gérer les prix</a>
        </li>
    </ul>
    <ul>
        <li>
            <a href="sell.php?id_fundation=<?php echo $fundation[0]; ?>">Gérer les ventes</a>
        </li>
    </ul>
    <?php
    //if($SADMIN->isFundTrezo($fundation[0]) == 1) {
    ?>
    <ul>
        <li>
            <a href="treso.php?id_fundation=<?php echo $fundation[0]; ?>">Trésorerie</a>
        </li>
    </ul>
    <?php
}
	
    ?>





<?php
$page->modulefooter();
?>
