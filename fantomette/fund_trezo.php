<?php
/***************************************************************************
 *                            fund_trezo.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Sunday, Fev 21, 2010
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

	//on vérifie si il y a des get pour les dates
	if (isset($_POST['date_start']) AND isset($_POST['date_end'])) {
		
		//split de chaque
		list($jour, $mois, $annee) = split('[/.-]', $_POST['date_start']);
		list($jour2, $mois2, $annee2) = split('[/.-]', $_POST['date_end']);
		
		if(is_numeric($jour) AND is_numeric($mois) AND is_numeric($annee) AND is_numeric($jour2) AND is_numeric($mois2) AND is_numeric($annee2)) {
			$start = mktime(0,0,0,$mois,$jour,$annee);
			$end = mktime(0,0,0,$mois2,$jour2,$annee2);
		} else {
			$start = time() - (60*60*24*7);
			$end = time();		
		}
	} else {
		$start = time() - (60*60*24*7);
		$end = time();		
	}
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
    $(function(){
        $('#datepicker').datepicker({
            defaultDate: '<?php echo date('d/m/Y', $start) ?>',
            dateFormat: 'dd/mm/yy',
            autoSize: true
        });
        $('#datepicker2').datepicker({
            defaultDate: '<?php echo date('d/m/Y', $end) ?>',
            dateFormat: 'dd/mm/yy',
            autoSize: true
        });
});


	$.tablesorter.addParser({ 
        id: 'euros', 
        is: function(s) { 
            return false; 
        }, 
        format: function(s) { 
			hit = s.match(/(\d{1,})\,(\d{1,2})/);
			if (hit) 
				return hit[1] + hit[2];
			else
				return s;
        }, 
        type: 'numeric' 
    }); 
	
    $(document).ready(function(){
        $('#myTable').tablesorter({ 
        // pass the headers argument and assing a object 
        sortList: [[0,1]],
		headers: {
            2: { 
               sorter:'euros' 
            }, 
        } 
    });
    });  
</script>
<div class="colomn1">
    <?php
    setlocale(LC_ALL, "fr_FR");
    ?>
    <?php
    $page->moduleHeader('Tréso BuckUTT');
	
	?>
	
	<form method="POST" action="fund_trezo.php?id_fundation=<?php echo $id_fundation ?>" style="text-align:center;">
		<p>
		De : <input type="text" id="datepicker" name="date_start" value="<?php echo date('d/m/Y', $start) ?>" style="width: 100px;" /> à <input type="text" id="datepicker2" name = "date_end" value="<?php echo date('d/m/Y', $end) ?>" style="width: 100px;" /> <input type="submit" />
		</p>
	</form>
	<?php
    $csvPurchased = $FADMIN->getPurchasedObjects($start, $end, $id_fundation);
    if ($csvRecharges == 400)
    {
        echo '<p>Pas de ventes sur cette période.</p>';
    } else
    {
    ?>

	<p>
		Total sur la période : <?php echo credit_format($FADMIN->getTotal($start, $end, $id_fundation)) ?>
	</p>

    <table id="myTable" width="100%" class="tablesorter">
        <thead>
            <tr>
                <th>
                    Quantité
                </th>
				<th>
                    Produit
                </th>
                <th>
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
        <?php
        $histoPurchases = (str_getcsv($csvPurchased, ','));
        $j = '0';
        foreach ($histoPurchases as $i=>$histoPurchase)
        {
			echo '<tr class="odd">
                    <td>'.$histoPurchase[0].'</td>';
            // Cf. function credit_format de header.inc.php
			echo '<td>'.$histoPurchase[1].'</td>';
            echo '<td>'.credit_format($histoPurchase[2]).'</td>';
        ?>
        </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
    <?php
    }
    ?>


	
    <?php
    $page->modulefooter();
    ?>
</div>
<div class="colomn2">
    <?php
    include_once ('navigation.inc.php');
    ?>
</div>
<?php
$page->footer();

// On linéarise une partie de l'objet SADMIN pour la concervé de page en page.
//$_SESSION['buckutt']['SADMIN'] = serialize($SADMIN);
}
else
{
    header('Location: index.php');
}
?>