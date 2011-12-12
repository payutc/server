<?php
/***************************************************************************
 *                                history_recharge.php
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
$needFADMIN = false;
$needBADMIN = false;

include_once ('header.inc.php');

//Si le SADMIN est sérialisé dans la session
if ( isset ($_SESSION['buckutt']['SADMIN']))
{
    // On délinéarise l'objet SADMIN stocké.
    $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);

    $date_start[$title] = mktime()-($_SESSION['buckutt']['historique'][$title]+1)*30*3600*24;
    $date_end[$title] = mktime()-$_SESSION['buckutt']['historique'][$title]*30*3600*24;
	
	//on vérifie si il y a des get pour les dates
	if (isset($_GET['date_start']) AND isset($_GET['date_end'])) {
		
		//split de chaque
		list($jour, $mois, $annee) = split('[/.-]', $_GET['date_start']);
		list($jour2, $mois2, $annee2) = split('[/.-]', $_GET['date_end']);
		
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
        id: 'dateperso', 
        is: function(s) { 
            return false; 
        }, 
        format: function(s) {
			 
			hit = s.match(/(\d{1,2})\/(\d{1,2})\/(\d{2}) (\d{1,2}):(\d{1,2})/);
			if (hit) 
				return hit[3] + hit[2] + hit[1] + hit[4] + hit[5];
			else
				return s;
        }, 
        type: 'numeric' 
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
			0: { 
               sorter:'dateperso' 
            }, 
            5: { 
               sorter:'euros' 
            }, 
        } 
    });
    });    
</script>
<div class="colomn1">
    <?php
    setlocale(LC_ALL, "fr_FR");
    0
    ?>
    <a name="rechargements"></a>
    <?php
    $page->moduleHeader('Mes achats');
    $histoPurchasesCSV = $SADMIN->getHistoriqueAchats($start, $end);
    if ( empty($histoPurchasesCSV))
    {
        echo '<p>Tu n\'as pas effectué d\'achats ce mois-ci.</p>';
    } else
    {
    ?>
    <form method="GET" action="" style="text-align:center;">
        <p>
            De : <input type="text" id="datepicker" name="date_start" value="<?php echo date('d/m/Y', $start) ?>" style="width: 100px;" /> à <input type="text" id="datepicker2" name = "date_end" value="<?php echo date('d/m/Y', $end) ?>" style="width: 100px;" /> <input type="submit" />
        </p>
    </form>
    <table id="myTable" width="100%" class="tablesorter">
        <thead>
	    <tr>
	        <th>Date</th>
	        <th>Produit</th>
	        <th>Vendeur</th>
	        <th>Lieu</th>
	        <th>Organisme</th>
	        <th>Prix</th>
	    </tr>
        </thead>
        <tbody>
        <?php
        $histoPurchases = (str_getcsv($histoPurchasesCSV, ','));
        $j = '0';
        foreach ($histoPurchases as $i=>$histoPurchase)
        {
            echo '<tr class="odd">
        <td>'.date('d/m/y H:i', $histoPurchase[0]).'</td>
        <td>'.$histoPurchase[1].'</td>
        <td>'.$histoPurchase[2].' '.$histoPurchase[3].'</td>
        <td>'.$histoPurchase[4].'</td>
        <td>'.$histoPurchase[5].'</td>';
      	echo '<td>'.credit_format($histoPurchase[6]).'</td>'
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
