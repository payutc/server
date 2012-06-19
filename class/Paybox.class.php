<?php 
/**
    BuckUTT - Buckutt est un système de paiement avec porte-monnaie électronique.
    Copyright (C) 2011 BuckUTT <buckutt@utt.fr>

	This file is part of BuckUTT
	
    BuckUTT is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    BuckUTT is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


class Paybox {

    private $User;
    private $db;
    private $path_bin = "/usr/share/buckutt/modulev3.cgi";
    private $logfile = "/var/log/log_paybox_brut.txt";
    
    public function __construct(&$User) {
        $this->db = Db_buckutt::getInstance();
        $this->User = &$User;
    }

    
    /**
     * Lance paybox et retourne la page à renvoyer au client pour le rediriger vers le serveur de paybox
     * @param string $amount (en centimes)
     * @param string $callback_url  : Url de retour après paybox (typiquement l'adresse de casper)
     * @param int $mobile[optional] 1 Si on doit afficher paybox sur mobile
     * @return string 
     */
    public function execute($amount, $callback_url, $mobile=0) {
			$PBX = "";
			// MODE D'UTILISATION DE PAYBOX
			$PBX .= "PBX_MODE=4";
			// IDENTIFICATION (ICI MODE DEVELLOPEUR)
			$PBX .= " PBX_SITE=1999888";
      $PBX .= " PBX_RANG=82";
      $PBX .= " PBX_IDENTIFIANT=110532808";
      //gestion de la page de connection : paramétrage "invisible"
      $PBX .= " PBX_WAIT=0";
      $PBX .= " PBX_TXT=";
      $PBX .= " PBX_BOUTPI=nul";
      $PBX .= " PBX_BKGD=white";
      //informations paiement (appel)
      $PBX .= " PBX_TOTAL=$amount"; // MONTANT (test avec 10€)
      $PBX .= " PBX_DEVISE=978"; //EURO
      $PBX .= " PBX_CMD=".base64_encode($this->User->getId().";".time()); // REFERENCE DE LA COMMANDE
      $PBX .= " PBX_PORTEUR=".$this->User->getMail(); // mail du client
      //informations nécessaires aux traitements (réponse)
      $PBX .= " PBX_RETOUR=auto:A\;amount:M\;ident:R\;trans:T\;erreur:E\;sign:K";
      $PBX .= " PBX_REPONDRE_A=https://assos.utc.fr/buckutt/paybox_retour.php";
      $PBX .= " PBX_EFFECTUE=$callback_url?paybox=effectue";
      $PBX .= " PBX_REFUSE=$callback_url?paybox=refuse";
      $PBX .= " PBX_ANNULE=$callback_url?paybox=annule";
      $PBX .= " PBX_ERREUR=$callback_url?paybox=erreur";
      // Url du serveur paybox si différente de celle par défaut (pour mode dev ou pour mobile)
      if($mobile==1) { $pbx_url="https://tpeweb.paybox.com/cgi/ChoixPaiementMobile.cgi"; } else { $pbx_url="https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi"; }
      $PBX .= " PBX_PAYBOX=$pbx_url";
			$PBX .= " PBX_BACKUP1=$pbx_url";
			$PBX .= " PBX_BACKUP2=$pbx_url";
			// PROXY
			$PBX .= " PBX_PROXY=proxyweb.utc.fr:3128";
			return shell_exec($this->path_bin." $PBX");
	  }
}
