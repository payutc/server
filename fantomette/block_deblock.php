<?php
/***************************************************************************
 *                               block_deblock.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Sunday, Mar 14, 2009
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
$needSBUY=false;
$needFADMIN=false;
$needBADMIN=true;

include_once('header.inc.php');


// S'il y a un get de l'id fundation le SADMIN et le BADMIN sont sérialisés dans la session
if (isset($_SESSION['buckutt']['SADMIN']) && isset($_SESSION['buckutt']['BADMIN'])) {

  // On délinéarise les objets SADMIN et BADMIN correspondant à l'organisme stockés.
  $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
  $BADMIN = unserialize($_SESSION['buckutt']['BADMIN']);

  // Header de l'IHM
?>

<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>

<script type="text/javascript">

var data = "Core Selectors Attributes Traversing Manipulation CSS Events Effects Ajax Utilities".split(" ");
$("#example").autocomplete(data);


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
  if (!empty($_POST)) {
  	// On verifie si on est en debloquage
    if (isset($_POST['id']) && isset($_POST['deblock'])) {
      // On test le deblocage
	  $test = $BADMIN->deblockUser($_POST['id']);
      if(!empty($test) && $test==true) {
        $page->msgInfo('Utilisateur d&eacute;bloqu&eacute; avec succ&egrave;s !');
      } else {
        $page->msgError('Erreur : la suppression n\'a pas pu avoir lieu...');
      }
    } else {
      // On test si tous les post sont remplis en mode blocage
      if (isset($_POST['userId']) && !empty($_POST['userId']) && isset($_POST['block'])) {
          // On test le blocage
          $test = $BADMIN->blockUser($_POST['userId']);
          if(!empty($test) && $test==true) {
            $page->msgInfo('Utilisateur bloqu&eacute; avec succ&egrave;s !');
          } else { $page->msgError('Erreur : le blocaget n\'a pas pu avoir lieu...'); }
          
      } else { $page->msgError('Attention : il faut remplir tous les champs. Surtout quand il n\'y en a qu\'un ;-)'); }
    }
  }

$page->moduleHeader('Bloquer un utilisateur', 'FFCC00');


  echo '<form method="post" action="block_deblock.php" style="position:relative;" >';
?>
		<table width="100%">
			<label>Utilisateur
			<input size="30" id="userName" name="userName" onkeyup="lookup(this.value);" type="text" /></label>
			<input size="30" id="userId" name="userId" type="text" />
			<div class="suggestionsBox" id="suggestions" style="display: none;">
			<img src="images/upArrow.png" style="position: relative; top: -12px; left: 30px" alt="upArrow" />
			<div class="suggestionList" id="autoSuggestionsList">
			</div></div>
			
			<input type="submit" id="submit" name="block" value="Bloquer" />

		</table>
	</form>
<?php
  $page->modulefooter();

  $page->moduleHeader('Utilisateurs bloqu&eacute;s');
  $j='0'; // Compteur utilisé pour l'alternance des couleurs des lignes du tableau
	
	$allUsers = $BADMIN->getAllBlockedUsers();
  if ($allUsers != 400) {
    echo '<table width="100%">
      <tr>
        <th>Nom</th>
        <th width="20px"></th>
      </tr>';
    foreach (str_getcsv($allUsers, ',') as $user) {
      /* DESCRIPTION DE $point
       * 0 = Identifiant de $point
       * 1 = Nom de $point
       */
      echo '<tr class="'.((++$j%2)?'pair':'impair').'">
          <td>'.$user[1].' '.$user[2].'</td>';
      // Formulaire de deblocage d'un mec  
      echo '<td><form style="display:inline;" method="post" action="block_deblock.php">
          <input type="hidden" name="id" value="'.$user[0].'" />
          <input class="delete" type="submit" name="deblock" title="Bloquer" value="" />
        </form></td>
      </tr>';
    }
  } else {
    echo "Personne de bloqu&eacute;.";
  }

  echo '</table>';
  $page->modulefooter();
?>
	</div>
	<div class="colomn2">
<?php  include_once ('navigation.inc.php'); ?>
	</div>
<?php 
  $page->footer();
} else {
  header('Location: index.php');
}
?>
