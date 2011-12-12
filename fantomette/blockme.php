<?php 
/***************************************************************************
 *                               blockme.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Friday, Sept 18, 2009
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
$idPage = 166;
$needSBUY=false;
$needFADMIN=false;
$needBADMIN=false;

include_once('header.inc.php'); 

//Si le SADMIN est sérialisé dans la session
if (isset($_SESSION['buckutt']['SADMIN'])) {
  // On délinéarise l'objet SADMIN stocké.
  $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
  if (isset($_POST) && $_POST) {
    $state = $SADMIN->blockMe($_POST['pin']); 
  } else {
    $state = 0;
  }

//si le mec bloque son compte, on supprime sa session buckutt  
if ($state == 1) {
	unset($_SESSION['buckutt']);
}

?>
<div class="colomn1">
    <div>
        <div class="colomn11">
<?php  $page->moduleheader('Pourquoi ?', '', 'FFFFFF', 'architectural6'); ?>
            <p><strong>Perte ou vol de carte</strong></p>
            <p><strong>Vol ou suspicion de vol de ton code PIN</strong></p>
<?php  $page->modulefooter(); ?>
        </div>
        <div class="colomn12">
<?php  $page->moduleheader('Un problème ?', '', 'FFFFFF', 'architectural7'); ?>
            <p><strong>Envoie un mail à <a href='mailto:buckutt@utt.fr'>buckutt@utt.fr</a></strong></p>
            <p><strong>Passe au BDE rapidement</strong></p>
<?php  $page->modulefooter(); ?>
        </div>
    </div>
    <div class="clear"></div>
<?php  $page->moduleHeader('Bloquer mon compte !', 'FF0000'); ?>
    <h3 class="attention">ATTENTION !!!
        <br />
        Tu ne pourras pas débloquer ton compte tout seul
    </h3>
    <form method="post" action="blockme.php">
        <table width="100%">
<?php  if ($state == 441) { ?>
			<tr>
                <td colspan="2" align="center">
                    <div class="errormsg">
                        Code PIN incorrect.
                    </div>
                </td>
			</tr>
<?php  } elseif ($state == 1) { ?>
			<tr>
                <td colspan="2" align="center">
                    <div class="validmsg">
                        Compte bloqué.
                    </div>
                </td>
			</tr>
<?php  } ?>
            <tr>
                <td align="right">
                    Code PIN :
                </td>
                <td style="width:48%;">
                    <input type="password" name="pin" id="pin" maxlength="4" size="4" value="" />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="blockme" value="Bloquer mon compte !" />
                </td>
            </tr>
        </table>
    </form>
    <p style="text-align:justify;">
        Par soucis de sécurité ton seul recours, sera de passer au BDE pour le débloquer.
    </p>
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
