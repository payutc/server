<?php
/***************************************************************************
 *                            link_user_group.php
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

  // Header de l'IHM
?>


<script type="text/javascript">

function lookup(inputString) {
    if(inputString.length == 0) {
        // Hide the suggestion box.
        $('#suggestions').hide();
    } else {
        $.post("rpc/user.php", {queryString: ""+inputString+""}, function(data){
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
  if (!empty($_POST)) {
  	// On verifie si on est en suprresion
    if (isset($_POST['id']) && isset($_POST['group']) && isset($_POST['delete'])) {
      // On test la suppression
      $test = $FADMIN->deleteUserFromGroup($_POST['group'], $_POST['id']);
      if(!empty($test) && $test==true) {
        $page->msgInfo('Utilisateur supprim&eacute;e du groupe avec succ&egrave;s !');
      } else {
        $page->msgError('Erreur : la suppression n\'a pas pu avoir lieu...');
      }
    } else {
      // On test si tous les post sont remplis
      if (isset($_POST['group']) && !empty($_POST['group']) && isset($_POST['userId']) && !empty($_POST['userId']) && (isset($_POST['date_start']) && !empty($_POST['date_start']) && isset($_POST['date_end']) && !empty($_POST['date_end']) || (isset($_POST['periode']) && !empty($_POST['periode'])))) {
        // On verifie si on est en ajout ou en edition (s'il y a id_object existant)
        if (isset($_POST['id'])) {
          // On test l'edition
          if (isset($_POST['edit_link'])) {
            // On transforme la date donnée en timestamp
            foreach (array($_POST['date_start'], $_POST['date_end']) as $i => $date) {
              //TODO : Verifier la tronche de la date !!
              $date_details1 = explode(" ", $date);
              $date_details11 = explode("/", $date_details1[0]);
              $date_details12 = explode(":", $date_details1[1]);
              $date_timestamp[$i] = mktime($date_details12[0], $date_details12[1], 00, $date_details11[1], $date_details11[0], $date_details11[2]);
            }
            $test_date_start = $FADMIN->editLinkUserInGroupDateStart($_POST['id'],$date_timestamp[0]);
            $test_date_end = $FADMIN->editLinkUserInGroupDateEnd($_POST['id'], $date_timestamp[1]);
            if(!empty($test_date_start) && $test_date_start==true && !empty($test_date_end) && $test_date_end==true) {
              $page->msgInfo('Lien édit&eacute; avec succ&egrave;s !');
            } else { $page->msgError('Erreur : l\'édition n\'a pas pu avoir lieu...'); }
          } else { $edit = true; }
        } else {
          // On transforme la date donnée en timestamp
          foreach (array($_POST['date_start'], $_POST['date_end']) as $i => $date) {
            //TODO : Verifier la tronche de la date !!
            $date_details1 = explode(" ", $date);
            $date_details11 = explode("/", $date_details1[0]);
            $date_details12 = explode(":", $date_details1[1]);
            $date_timestamp[$i] = mktime($date_details12[0], $date_details12[1], 00, $date_details11[1], $date_details11[0], $date_details11[2]);
          }
          // On test l'ajout
          $test = $FADMIN->addUserToGroup($_POST['group'], $_POST['user'], $date_timestamp[0], $date_timestamp[1]);
          if(!empty($test) && $test==true) {
            $page->msgInfo('Utilisateur ajout&eacute;e au groupe avec succ&egrave;s !');
          } else { $page->msgError('Erreur : l\'ajout n\'a pas pu avoir lieu...'); }
        }
      } else { $page->msgError('Attention : il faut remplir tous les champs.'); }
    }
  }

  // On affiche ajouter ou editer
  if ($edit){
    $page->moduleHeader('Editer un utilisateur dans un groupe', 'FFCC00');
  } else {
    $page->moduleHeader('Ajouter un utilisateur dans un groupe', 'FFCC00');
  }

  echo '<form method="post" action="link_user_group.php?id_fundation='.$id_fundation.'" style="position:relative;" >';
?>
		<table width="100%">
			<tr>
            <td>
                Utilisateur :
            </td>
            <td>
                <?php 
                // On check quel valeur a été posté et on l'affiche
                if ($edit) {
                    echo $_POST['name_user'].'
                      <input type="hidden" name="user" value="'.$_POST['user'].'" />';
                    ;
                } else {
                	?>
						<input size="30" id="userName" name="userName" onkeyup="lookup(this.value);" type="text" />
						<input size="30" id="userId" name="userId" type="hidden" />
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
				<td><a href="group.php?id_fundation=<?php echo $id_fundation; ?>" title="Ajouter un groupe">Groupe :</a></td>		
				<td>
<?php
  // On check quel valeur a été posté et on l'affiche
  if ($edit) {
    echo $_POST['name_group'].'
     <input type="hidden" name="group" value="'.$_POST['group'].'" />';
    
  } else {
    if ($allFundationGroupsCSV = $FADMIN->getAllFundationGroups()) {
      echo '<select name="group" id="group">';
      foreach (str_getcsv($allFundationGroupsCSV, ',') as $group) {
	    echo '<option value ="'.$group[0].'">'.$group[1].'</option>';
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
				if(!dateRegEx) return false;
				var iDay = dateRegEx[1];
				var iMonth = dateRegEx[2];
				var iYear = dateRegEx[3];
				var arDayPerMonth = [31,(isLeapYear(iYear))?29:28,31,30,31,30,31,31,30,31,30,31];
				if(!arDayPerMonth[iMonth-1]) return false;
				return (iDay <= arDayPerMonth[iMonth-1] && iDay > 0);
			}
			function isHour(sHour){
				var hourRegEx = /^(?:0?[0-9]|1\d|2[0-3]):(?:0?[0-9]|[0-4]\d|5[0-9])$/.test(sHour);
				return hourRegEx;
			}
			function isLeapYear(iYear){
				return ((iYear%4==0 && iYear%100!=0) || iYear%400==0);
			}		
			function isDateHour(sDateHour, id){
				var sSeparator = ' ';
				var arDateHour = sDateHour.split(sSeparator);
				var ok
				if(!arDateHour[0])
					ok = false;
				else {
					if(!isDate(arDateHour[0]))
						ok = false;
					else {
						if (arDateHour[1]=="") {
							document.getElementById('inputDate'+id).value += '00:00';
							ok = true;
						} else if (!arDateHour[1]) {
							document.getElementById('inputDate'+id).value += ' 00:00';
							ok = true;
						} else {
							if(!isHour(arDateHour[1]))
								ok = false;
							else
								ok = true;
						}
					}
				}
				if (ok) {
					document.getElementById('date'+id).style.color = '';
					document.getElementById('inputDate'+id).style.color = '';
					document.getElementById('submit').disabled = false;
				} else {
					document.getElementById('date'+id).style.color = 'red';
					document.getElementById('inputDate'+id).style.color = 'red';
					document.getElementById('submit').disabled = true;
				}
			}
			</script>
			
			<tr>
				<td></td>	
				<td>DATES</td>	
			</tr>			
			<tr id="date1">
				<td>Date de début :</td>
				<td><input id="inputDate1" type="text" name="date_start" id="date_start"
					onBlur="isDateHour(this.value, 1);" maxlength="16" size="16"
					value="<?php if($edit) echo date('d/m/Y H:i', $_POST['date_start']) ?>" /> <small>(JJ/MM/AAAA ou JJ/MM/AAAA HH:MM)</small>
				</td>
			</tr>
			<tr id="date2">
				<td>Date de fin :</td>
				<td><input id="inputDate2" type="text" name="date_end" id="date_end"
					onBlur="isDateHour(this.value, 2);" maxlength="16" size="16"
					value="<?php if($edit) echo date('d/m/Y H:i', $_POST['date_end']) ?>" /> <small>(JJ/MM/AAAA ou JJ/MM/AAAA HH:MM)</small>
				</td>
			</tr>


			<tr>
				<td></td>	
				<td>OU</td>	
			</tr>


			<tr>
				<td>Période</td>		
				<td>			
			<?php
			  // On check quel valeur a été posté et on l'affiche
			    if ($allPeriodCSV = $FADMIN->getAllPeriod()) {
			      echo '<select name="periode" id="periode">';
				  	echo '<option value =""></option>';
			      foreach (str_getcsv($allPeriodCSV, ',') as $period) {
				    echo '<option value ="'.$period[0].'"';
					
					if ($edit AND ($_POST['id_period'] == $period[0]))
						echo 'selected = "selected"';
					echo '>'.$period[1].'</option>';
			      }
			      echo '</select>';
			    }

			
			?>
				</td>
			</tr>			
			    
			<tr>
				<td colspan="2" align="right">
            		<input type="<?php if($edit){ 
            	    	echo 'hidden" name="id" value="'.$_POST['id'].'" />
            	    	<input type="button" onClick="location.href=\'\'" name="stop_edit" value="Stopper l\'édition" />
            	    	<input type="submit" id="submit" name="edit_link" value="Editer';
            	    } else { echo 'submit" id="submit" name="add_link" value="Ajouter'; } ?>" />
		        </td>
		    </tr>	
				
		</table>
	</form>
<?php
  $page->modulefooter();

  
  if ($allFundationGroupsCSV = $FADMIN->getAllFundationGroupsLight()) {
  	foreach ($allFundationGroups = str_getcsv($allFundationGroupsCSV, ',') as $g => $group) {
  	  // Gestion des ancres
  	  $Groups = $allFundationGroups;
  	  unset($Groups[$g]);
      echo '<p style="text-align:center;margin-bottom:5px;margin-top:0px;">';
      foreach ($Groups as $group1) {
        echo '| <a href="#'.$group1[0].'">'.$group1[1].'</a> | ';
      }
      echo '</p>
      <a name="'.$group[0].'"></a>';

      $page->moduleHeader("Les utilisateurs du groupe $group[1]");
      $j='0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau
      if ($allUsersFromGroup = $FADMIN->getAllUsersFromGroup($group[0])) {
        echo '<table width="100%">
          <tr>
            <th>Utilisateur</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th width="20px"></th>
            <th width="20px"></th>
          </tr>';
        foreach (str_getcsv($allUsersFromGroup, ',') as $user) {
          /* DESCRIPTION DE $user
           * 0 = Identifiant du lien
           * 1 = Identifiant de l'utilisateur
           * 2 = Prénom de l'utilisateur
           * 3 = Nom de l'utilisateur
           * 4 = Date de début
           * 5 = Date de fin
           */
          echo '<tr class="'.((++$j%2)?'pair':'impair').'">
              <td>'.$user[2].' '.$user[3].'</td>
              <td>'.date('d/m/y H:i', $user[4]).'</td>
              <td>'.date('d/m/y H:i', $user[5]).'</td>';
          // Formulaire d'édition des dates d'un utilisateur dans un groupe
          echo '<td><form style="display:inline;" method="post" action="link_user_group.php?id_fundation='.$id_fundation.'">
              <input type="hidden" name="id" value="'.$user[0].'" />
              <input type="hidden" name="user" value="'.$user[1].'" />
              <input type="hidden" name="name_user" value="'.$user[2].' '.$user[3].'" />
              <input type="hidden" name="group" value="'.$group[0].'" />
              <input type="hidden" name="name_group" value="'.$group[1].'" />
              <input type="hidden" name="date_start" value="'.$user[4].'" />
              <input type="hidden" name="date_end" value="'.$user[5].'" />
              <input class="edit" type="submit" name="edit" title="Editer" value="" />
            </form></td>';
          // Formulaire de suppression d'un utilisateur de ce groupe  
          echo '<td><form style="display:inline;" method="post" action="link_user_group.php?id_fundation='.$id_fundation.'">
              <input type="hidden" name="id" value="'.$user[0].'" />
              <input type="hidden" name="group" value="'.$group[0].'" />
              <input class="delete" type="submit" name="delete" title="Supprimer" value="" />
            </form></td>
          </tr>';
        }
      } else {
        echo "Tu n'as enregistré aucun utilisateur dans ce groupe.";
      }

      echo '</table>';
      $page->modulefooter();
  	}
  }
?>
	</div>
	<div class="colomn2">
<?php  include_once ('navigation.inc.php'); ?>
	</div>
<?php 
  $page->footer();

  // On linéarise les objets SADMIN et SBUY pour les concerver de page en page.
  //$_SESSION['buckutt']['SADMIN'] = serialize($SADMIN);
  //$_SESSION['buckutt']['FADMIN'][$id_fundation] = serialize($FADMIN);
} else {
  header('Location: index.php');
}
?>
