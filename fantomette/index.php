<?php
/***************************************************************************
 *                               index.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Monday, Aug 3, 2009
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

$needSBUY = true;
$needFADMIN = true;
$needBADMIN = true;


include_once ('header.inc.php');

//Si le SADMIN est sérialisé dans la session
if ( isset ($_SESSION['buckutt']['SADMIN']) && isset ($_SESSION['buckutt']['SBUY']))
{
    // On délinéarise les objets SADMIN et SBUY stocké.
    $SADMIN = unserialize($_SESSION['buckutt']['SADMIN']);
    $SBUY = unserialize($_SESSION['buckutt']['SBUY']);
    include_once ('dashboard.inc.php');

    // On linéarise les objets SADMIN et SBUY pour les conserver de page en page.
    $_SESSION['buckutt']['SADMIN'] = serialize($SADMIN);
    $_SESSION['buckutt']['SBUY'] = serialize($SBUY);

} else
{
    $state = '';
    if ( isset ($_POST['pin']))
    {
        if (! empty($_POST['pin']) && $_POST['pin'] != 0)
        {
            $SADMIN = new nusoap_client($wsdlSADMIN, true);
            $SBUY = new nusoap_client($wsdlSBUY, true);
            $loginSADMIN = $SADMIN->login($session->login, 1, $_POST['pin'], $_SERVER["REMOTE_ADDR"]);
			//écite de tenter si le mec a pas le bon mdp (et donc, que +1 en fail_auth)
			if($loginSADMIN == 1)
	            $loginSBUY = $SBUY->login($session->login, 1, $_POST['pin'], $_SERVER["REMOTE_ADDR"]);
            if ($loginSADMIN == 1 && $loginSBUY == 1)
            {
                // On verifie s'il est administrateur de fundation
				$allFundations = $SADMIN->hasDroitsInFundations();
                if ($allFundations != 409)
                {
                    $FADMIN = new nusoap_client($wsdlFADMIN, true);
					$FADMIN->login($session->login, 1, $_POST['pin'], $_SERVER["REMOTE_ADDR"]);
                }
				
                // On verifie s'il est admin de buckutt
				$isAdminBuckutt = $SADMIN->isAdminBuckutt();
                if ($isAdminBuckutt == 1)
                {
					$BADMIN = new nusoap_client($wsdlBADMIN, true);
                    $BADMIN->login($session->login, 1, $_POST['pin'], $_SERVER["REMOTE_ADDR"]);
                }
				
                include_once ('dashboard.inc.php');
				
                // On linéarise les objets pour les conserver de page en page.
                $_SESSION['buckutt']['SADMIN'] = serialize($SADMIN);
                $_SESSION['buckutt']['SBUY'] = serialize($SBUY);
                if ($allFundations != 409)
                {
                    $_SESSION['buckutt']['FADMIN'] = serialize($FADMIN);
                }
                if ($isAdminBuckutt == 1)
                {
                    $_SESSION['buckutt']['BADMIN'] = serialize($BADMIN);
                }
            } elseif ($loginSADMIN == 403 || $loginSBUY == 403)
            {
                $state = 'blocked';
                include_once ('login.inc.php');
            } else
            {
                $state = 'bad';
                include_once ('login.inc.php');
            }
        } else
        {
            $state = 'empty';
            include_once ('login.inc.php');
        }
    } else
    {
        $state = 'start';
        include_once ('login.inc.php');
    }
}
$page->footer();
?>
