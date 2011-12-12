<?php 
/***************************************************************************
 *                               changepin.php
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
$idPage = 156;
$needSBUY=false;
$needFADMIN=false;
$needBADMIN=false;

include_once('header.inc.php');

//Si le SADMIN est sérialisé dans la session
if (isset($_SESSION['buckutt']['SADMIN'])) {
  // On délinéarise l'objet SADMIN stocké.
  $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
  if (isset($_POST) && $_POST) {
  	$state = $SADMIN->changeKeySecure($_POST['pin'], $_POST['newPin1'],  $_POST['newPin2']);
  } else {
    $state = 0;
  }
?>

<div class="colomn1">
<?php  $page->moduleHeader('Changer mon code PIN', 'FF0000'); ?>
	<h3>Le nouveau code PIN doit contenir 4 chiffres, ni plus ni moins.</h3>
    <form method="post" action="changepin.php">
        <table>
            <tr>
                <td align="right">Ancien code PIN :</td>
                <td><input type="password" name="pin" id="pin" maxlength="4" size="4" value="" /></td>
<?php  if ($state == -1) { ?>
                <td>
                    <div class="errormsg">Il faut remplir tous les champs.</div>
                </td>
<?php  } elseif ($state == -5) { ?>
                <td>
                    <div class="errormsg">Code PIN incorrect.</div>
                </td>
<?php  } elseif ($state == 1) { ?>
                <td>
                    <div class="validmsg">Code PIN changé avec succès.</div>
                </td>
<?php  } else { echo "<td></td>"; } ?>
            </tr>
            <tr>
                <td align="right">Nouveau code PIN :</td>
                <td><input type="password" name="newPin1" id="newPin1"  maxlength="4" size="4" value="" /></td>
<?php  if ($state == -2) { ?>
                <td>
                    <div class="errormsg">Ces codes PIN sont différents !</div>
                </td>
<?php  } elseif ($state == -3) { ?>
                <td>
                    <div class="errormsg">Ces codes PIN ne sont pas conformes.</div>
                </td>
<?php  } elseif ($state == -4) { ?>
                <td>
                	<div class="errormsg">Code PIN trop simple.</div>
                </td>
<?php  } else { echo "<td></td>"; } ?>
            </tr>
            <tr>
                <td>Resaisir le nouveau code PIN :</td>
                <td><input type="password" name="newPin2" id="newPin2"  maxlength="4" size="4" value="" /></td>
                <td><input type="submit" name="change" value="Changer" /></td>
            </tr>
        </table>
    </form>
	<p>Pour des raisons de sécurité, ton nouveau code PIN ne peut pas être un quadruplé (ex: 0000, 1111, etc),
	 1234 ou 4321. Evite de mettre ta date de naisssance ou quoi que ce soit de trop évident.</p>
<?php  $page->modulefooter(); ?>
</div>
<div class="colomn2">
<?php  include_once ('navigation.inc.php'); ?>
</div>
<?php 
  $page->footer();

  // On linéarise une partie de l'objet SADMIN pour la concervé de page en page.
  //$_SESSION['buckutt']['SADMIN'] = serialize($SADMIN);
} else {
    header('Location: index.php');
}
?>
