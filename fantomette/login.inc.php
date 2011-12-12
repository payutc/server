<?php
/***************************************************************************
 *                              login.inc.php
 *                            -------------------
 *   Directory		 : www-etu/buckutt
 *   Begin            : Tuesday, Aug 4, 2009
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
?>
<div style='width:100%;margin:auto;'>
    <?php
	$SADMIN = new nusoap_client($wsdlSADMIN, true);
	$isCotisant = $SADMIN->isInGroup($session->login, 1, $_SERVER["REMOTE_ADDR"], 1);
	
	if($isCotisant == 0) {
        $page->msgInfo("ATTENTION, tu n'es pas adherent au BDE, tu ne pourras donc pas profiter des services du BDE au foyer et à ZeShop. <br /><br />Pour plus d'informations, passe au BDE ou envoie un mail à bde@utt.fr.");
	}
    
    $page->moduleheader('Buckutt', 'E2E9EE', 'FFFFFF', 'architectural', 'auth');
    ?>
    <img src="images/buckutt.png" style="float:left; width: 125px;margin:5px;"/>
    <div style="text-align:justify;margin:10px;">
        <p>
            BuckUTT est le système de paiement utilisé pour régler tes achats au foyer, au BDE ou en soirée. Il te suffit de recharger ta carte étu ici, avec ta carte bancaire, ou en passant dans la journée au BDE.
        </p>
        <p>
            Sur cette interface, tu peux également suivre tes derniers achats et rechargements. 
        </p>
        <p>
            Pour commencer, connecte toi avec ton code PIN qui t'a été envoyé par mail (si tu l'a oublié, pas de panique, tu peux en regénérer un nouveau avec le lien présent sous le formulaire).
        </p>
    </div>
    <div style="float:right; text-align:justify;">
    </div>
    <div style='width:60%;margin:auto;'>
        <?php
        if ($state == "blocked")
        {
            $page->msgError("ATTENTION !<br />Ton compte est bloqué.<br />Passe au BDE ou envoie un mail à buckutt@utt.fr");
        } elseif ($state == "bad")
        {
            $page->msgError("ATTENTION !<br />Code PIN incorrect.");
        } elseif ($state == "empty")
        {
            $page->msgError("ATTENTION !<br />Il faut quand même rentrer un code PIN.");
        }
        ?>
    </div>
    <div style='text-align:center;width:60%;border:3px double black; margin:auto;padding: 0px 10px 10px;'>
        <p>
            Tu es connecté en tant que : 
            <?php
            echo $session->login;
            ?>
        </p>
        <form method="post" action="index.php">
            <p>
                <span>Ton code PIN BuckUTT :</span>
                <input type="password" name="pin" id="pin" size="4" maxlength="4" value="" />
            </p>
            <p>
                <input type="submit" name="signIn" value="Connexion" />
            </p>
        </form>
        <?php
        if ($state == "bad" || $state == "blocked" || $state == "empty")
        {
        ?>
        <?php
        }
        ?>
    </div>
    <ul class="auth-menu" style='margin-top:15px;text-align:center;'>
        <li>
            <?php
            if ( isset ($_GET['forgot']))
            {
                echo $session->email;
                $client = new SoapClient("http://10.10.10.1:8080/SADMIN.class.php?wsdl");
				//$client = new SoapClient("http://buckutt.dyndns.org/server/SADMIN.class.php?wsdl");
                $erreur = $client->resetKey($session->login, $session->email);
                if ($erreur == 0)
                {
                    echo "<p>Ton nouveau code PIN t'a été envoyé par mail <br />(et tu as été au passage déconnecté du site pour des questions de sécurité)</p>";
                    session_destroy();
                } else
                {
                    echo "<p>Impossible d'envoyer le mail !<br />Envoie un mail à buckutt@utt.fr<br />code d'erreur $erreur</p>";
                }
            } else
            {
            ?>
            <a class="forgotten_pass" href="index.php?forgot=1"><span class="icon"></span><span class="text">J'ai perdu mon code PIN ! :S </span></a>
            <?php
            }
            ?>
        </li>
    </ul>
    <?
    $page->modulefooter();
    ?>
    <?php
    $page->msgInfo("Comme ton code de carte bleue, ton code PIN BuckUTT est personnel. Ne le donne à personne ! <br /><br />
    Pour des questions de sécurité, au bout de 3 tentatives ratées, ton compte sera bloqué. Tu devras alors passer au BDE pour le faire débloquer.");
    ?>
</div>
