<?php 
/***************************************************************************
 *                            link_user_droit.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Sunday, Mar 7, 2010
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
$needSBUY = false;
$needFADMIN = false;
$needBADMIN = true;

include_once ('header.inc.php');


// S'il y a un get de l'id fundation le SADMIN et le SBUY sont sérialisés dans la session
if (isset($_SESSION['buckutt']['SADMIN']) && isset($_SESSION['buckutt']['BADMIN'])) {

    // On délinéarise les objets SADMIN et BADMIN correspondant à l'organisme stockés.
    $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
    $BADMIN = unserialize($_SESSION['buckutt']['BADMIN']);
    
    // Header de l'IHM
    
?>




<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>

<script type="text/javascript">

function lookup(inputString) {
    if(inputString.length == 0) {
        // Hide the suggestion box.
        $('#suggestions').hide();
    } else {
        $.GET("rpc/user.php", {queryString: ""+inputString+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // lookup

function fill(thisValue) {
	var elem = thisValue.split('!!!');
	id = elem[0];
	firstname = elem[1];
	lastname = elem[2];


	
    $('#userName').val(firstname + ' ' + lastname);
	$('#userId').val(id);
   	$('#suggestions').hide();
}

</script>
<style type="text/css">

.suggestionsBox {
    position: absolute;
    left: 30px;
    margin:-10px 50px 0;
    width: 200px;
    background-color: #212427;
    border: 2px solid #000;
    color: #fff;
}

.suggestionList {
    margin: 0px;
    padding: 0px;
}

.suggestionList li {
    margin: 0px 0px 3px 0px;
    padding: 3px;
    cursor: pointer;
}

.suggestionList li:hover {
    background-color: #659CD8;
}
</style>

<div class="colomn1">
    <?php 
    $edit = false;
	
    // Ajout, edition ou suppression d'un lien
    if (! empty($_GET)) {
        // On verifie si on est en suprresion
        if (isset($_GET['id']) && isset($_GET['droit']) && isset($_GET['delete'])) {
            // On test la suppression
            $test = $BADMIN->deleteUserFromRight($_GET['droit'], $_GET['id']);
            if (! empty($test) && $test == true) {
                $page->msgInfo('Droit supprimé de l\'utilisateur supprim&eacute;e avec succ&egrave;s !');
            } else {
                $page->msgError('Erreur : la suppression n\'a pas pu avoir lieu...');
            }
			
        } else {
            // On test si tous les GET sont remplis
            if (isset($_GET['droit']) && ! empty($_GET['droit']) && isset($_GET['userId']) && ! empty($_GET['userId']) && isset($_GET['date_start']) && ! empty($_GET['date_start']) && isset($_GET['date_end']) && ! empty($_GET['date_end'])) {
                // On verifie si on est en ajout ou en edition (s'il y a id_object existant)
                    // On transforme la date donnée en timestamp
                    foreach (array($_GET['date_start'], $_GET['date_end']) as $i=>$date) {
                        //TODO : Verifier la tronche de la date !!
                        $date_details1 = explode(" ", $date);
                        $date_details11 = explode("/", $date_details1[0]);
                        $date_details12 = explode(":", $date_details1[1]);
                        $date_timestamp[$i] = mktime($date_details12[0], $date_details12[1], 00, $date_details11[1], $date_details11[0], $date_details11[2]);
                    }
                    // On test l'ajout
					
					if(!is_numeric($_GET['point'])){
						$_GET['point'] = 0;
					}
					if(!is_numeric($_GET['fundation'])){
						$_GET['fundation'] = 0;
					}
                    $test = $BADMIN->addUserToRight($_GET['droit'], $_GET['userId'], $date_timestamp[0], $date_timestamp[1], $_GET['point'], $_GET['fundation']);
                    if (! empty($test) && $test == true) {
                        $page->msgInfo('Droit ajouté à l\'utilisateur ajout&eacute;e avec succ&egrave;s !');
                    } else {
                        $page->msgError('Erreur : l\'ajout n\'a pas pu avoir lieu...');
                    }
            } else {
                $page->msgError('Attention : il faut remplir tous les champs.');
            }
        }
    }
    
    // On affiche ajouter ou editer
    if ($edit) {
        $page->moduleHeader('Editer un droit d\'un utilisateur', 'FFCC00');
    } else {
        $page->moduleHeader('Ajouter un droit à un utilisateur', 'FFCC00');
    }
    
    echo '<form method="GET" action="link_user_droit.php" style="position:relative;" >';
    ?>
    <table width="100%">
        <tr>
            <td>
                Utilisateur :
            </td>
            <td>
                <?php 
                // On check quel valeur a été GETé et on l'affiche
                if ($edit) {
                    echo $_GET['name_user'].'
                      <input type="hidden" name="user" value="'.$_GET['user'].'" />';
                    ;
                } else {
                	?>
						<input size="30" id="userName" name="userName" onkeyup="lookup(this.value);" type="text" />
						<input size="30" id="userId" name="userId" type="text" />
						<div class="suggestionsBox" id="suggestions" style="display: none;">
						      <img src="images/upArrow.png" style="position: relative; top: -12px; left: 30px" alt="upArrow" />
						      <div class="suggestionList" id="autoSuggestionsList">
						</div>
						<?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <a href="droit.php" title="Ajouter un droit">Droit :</a>
            </td>
            <td>
                <?php 
                // On check quel valeur a été GETé et on l'affiche
                if ($edit) {
                    echo $_GET['name_droit'].'
                     <input type="hidden" name="droit" value="'.$_GET['droit'].'" />';
                     
                } else {
                    if ($allDroitsCSV = $BADMIN->getAllRightsAdminLight()) {
                        echo '<select name="droit" id="droit">';
                        foreach (str_getcsv($allDroitsCSV, ',') as $droit) {
                            echo '<option value ="'.$droit[0].'">'.$droit[1].'</option>';
                        }
                        echo '</select>';
                    }
                }
                ?>
            </td>
        </tr>
        <script type="text/javascript">
            function isDate(sDate){
                var dateRegEx = sDate.match(/^(?:0?([1-9]|[12]\d|3[01]))\/(?:0?([1-9]|1[0-2]))\/((?:19|[2-9]\d)[0-9]{2})$/);
                if (!dateRegEx) 
                    return false;
                var iDay = dateRegEx[1];
                var iMonth = dateRegEx[2];
                var iYear = dateRegEx[3];
                var arDayPerMonth = [31, (isLeapYear(iYear)) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                if (!arDayPerMonth[iMonth - 1]) 
                    return false;
                return (iDay <= arDayPerMonth[iMonth - 1] && iDay > 0);
            }
            
            function isHour(sHour){
                var hourRegEx = /^(?:0?[0-9]|1\d|2[0-3]):(?:0?[0-9]|[0-4]\d|5[0-9])$/.test(sHour);
                return hourRegEx;
            }
            
            function isLeapYear(iYear){
                return ((iYear % 4 == 0 && iYear % 100 != 0) || iYear % 400 == 0);
            }
            
            function isDateHour(sDateHour, id){
                var sSeparator = ' ';
                var arDateHour = sDateHour.split(sSeparator);
                var ok
                if (!arDateHour[0]) 
                    ok = false;
                else {
                    if (!isDate(arDateHour[0])) 
                        ok = false;
                    else {
                        if (arDateHour[1] == "") {
                            document.getElementById('inputDate' + id).value += '00:00';
                            ok = true;
                        }
                        else 
                            if (!arDateHour[1]) {
                                document.getElementById('inputDate' + id).value += ' 00:00';
                                ok = true;
                            }
                            else {
                                if (!isHour(arDateHour[1])) 
                                    ok = false;
                                else 
                                    ok = true;
                            }
                    }
                }
                if (ok) {
                    document.getElementById('date' + id).style.color = '';
                    document.getElementById('inputDate' + id).style.color = '';
                    document.getElementById('submit').disabled = false;
                }
                else {
                    document.getElementById('date' + id).style.color = 'red';
                    document.getElementById('inputDate' + id).style.color = 'red';
                    document.getElementById('submit').disabled = true;
                }
            }
        </script>
        <tr id="date1">
            <td>
                Date de début GETMODE :
            </td>
            <td>
                <input id="inputDate1" type="text" name="date_start" id="date_start" onBlur="isDateHour(this.value, 1);" maxlength="16" size="16" value="<?php if($edit) echo date('d/m/Y H:i', $_GET['date_start']) ?>" />
                <small>
                    (JJ/MM/AAAA ou JJ/MM/AAAA HH:MM)
                </small>
            </td>
        </tr>
        <tr id="date2">
            <td>
                Date de fin :
            </td>
            <td>
                <input id="inputDate2" type="text" name="date_end" id="date_end" onBlur="isDateHour(this.value, 2);" maxlength="16" size="16" value="<?php if($edit) echo date('d/m/Y H:i', $_GET['date_end']) ?>" />
                <small>
                    (JJ/MM/AAAA ou JJ/MM/AAAA HH:MM)
                </small>
            </td>
        </tr>
        <tr id="point">
        <td>
            Point :
        </td>
		<td>
        <?php if ($allPointsCSV = $BADMIN->getAllPoints()) {
        echo '
        <select name="point" id="point">
            ';
			if($edit && $_GET['point'] == $point[0]) echo " SELECTED";
				
			
			echo '<option value ="0">Aucun</option>';
            foreach (str_getcsv($allPointsCSV, ',') as $point) {
            	$concat = "";
            	if($edit && $_GET['point'] == $point[0]) $concat=" SELECTED";
            echo '<option value ="'.$point[0].'"'.$concat.'>'.$point[1].'</option>';
            }
            echo '
        </select>';
        } ?>
        </td>
    </tr>
	<tr id="fundation">
        <td>
            Fondation :
        </td>
		<td>
        <?php if ($allPointsCSV = $BADMIN->getAllFundations()) {
        echo '
        <select name="fundation" id="fundation">
            ';
			if($edit && $_GET['fundation'] == $fundation[0]) echo " SELECTED";
				
			
			echo '<option value ="0">Aucune</option>';
            foreach (str_getcsv($allPointsCSV, ',') as $fundation) {
            	$concat = "";
            	if($edit && $_GET['fundation'] == $fundation[0]) $concat=" SELECTED";
            echo '<option value ="'.$fundation[0].'"'.$concat.'>'.$fundation[1].'</option>';
            }
            echo '
        </select>';
        } ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="right">
            <input type="<?php if($edit){ 
 echo 'hidden" name="id" value="'.$_GET['id'].'" /><input type="button" onClick="location.href=\'\'" name="stop_edit" value="Stopper l\'édition" /><input type="submit" id="submit" name="edit_link" value="Editer';
}  else {  echo 'submit" id="submit" name="add_link" value="Ajouter'; } ?>
" />
        </td>
    </tr>
    </table>
</form>
<?php 
$page->modulefooter();

$allDroitsCSV = $BADMIN->getAllRightsAdminLight();
if ($allDroitsCSV != 400) {
    foreach ($allDroits = str_getcsv($allDroitsCSV, ',') as $d=>$droit) {      
        $page->moduleHeader("Les utilisateurs ayant le droit $droit[1]");
        $j = '0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau
        if ($allUsersFromDroit = $BADMIN->getAllUsersFromRight($droit[0])) {
            echo '<table width="100%">
          <tr>
            <th>Utilisateur</th>
            <th>Date de début</th>
            <th>Date de fin</th>
			<th>Point</th>
			<th>Fundation</th>
            <th width="20px"></th>
          </tr>';
            foreach (str_getcsv($allUsersFromDroit, ',') as $user) {
                /* DESCRIPTION DE $user
                 * 0 = Identifiant du lien
                 * 1 = Identifiant de l'utilisateur
                 * 2 = Prénom de l'utilisateur
                 * 3 = Nom de l'utilisateur
                 * 4 = Date de début
                 * 5 = Date de fin
                 * 6 = Point id
                 * 7 = Point name
                 * 8 = Fundation id
                 * 9 = Fundation name
                 */
                echo '<tr class="'.((++$j % 2) ? 'pair' : 'impair').'">
              <td>'.$user[2].' '.$user[3].'</td>
              <td>'.date('d/m/y H:i', $user[4]).'</td>
              <td>'.date('d/m/y H:i', $user[5]).'</td>
			  <td>'.$user[7].'</td>
			  <td>'.$user[9].'</td>';
                // Formulaire de suppression d'un utilisateur ayant ce droit
                echo '<td><form style="display:inline;" method="GET" action="link_user_droit.php">
              <input type="hidden" name="id" value="'.$user[0].'" />
              <input type="hidden" name="droit" value="'.$droit[0].'" />
              <input class="delete" type="submit" name="delete" title="Supprimer" value="" />
            </form></td>
          </tr>';
            }
        } else {
            echo "Tu n'as enregistré aucun utilisateur ayant ce droit.";
        }
        
        echo '</table>';
        $page->modulefooter();
    }
}
?>
</div>
<div class="colomn2">
    <?php include_once ('navigation.inc.php'); ?>
</div>
<?php 
$page->footer();

// On linéarise les objets SADMIN et BADMIN pour les concerver de page en page.
//$_SESSION['buckutt']['SADMIN'] = serialize($SADMIN);
//$_SESSION['buckutt']['BADMIN'] = serialize($BADMIN);
} else {
    header('Location: index.php');
}
?>
