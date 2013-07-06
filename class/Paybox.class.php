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

use \Payutc\Db\DbBuckutt;
use \Payutc\Log;
use \Payutc\Config;

class Paybox {

    private $User;
    private $db;
    
    public function __construct(&$User) {
        $this->db = DbBuckutt::getInstance();
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
      $pay_id = $this->db->insertId(
              $this->db->query(
                  "INSERT INTO  `t_paybox_pay` (
`pay_id` ,
`usr_id` ,
`pay_step` ,
`pay_amount` ,
`pay_date_create` ,
`pay_date_retour` ,
`pay_auto` ,
`pay_trans` ,
`pay_callback_url` ,
`pay_mobile` ,
`pay_error`
)
VALUES (
NULL ,  '%u',  'W',  '%u', NOW( ) , NULL , NULL , NULL ,  '%s',  '%u', NULL
);", array($this->User->getId(), $amount, $callback_url, $mobile)));

      $PBX = "";
      // MODE D'UTILISATION DE PAYBOX
      $PBX .= "PBX_MODE=4";
      // IDENTIFICATION
      $PBX .= " PBX_SITE=".Config::get('PBX_SITE');
      $PBX .= " PBX_RANG=".Config::get('PBX_RANG');
      $PBX .= " PBX_IDENTIFIANT=".Config::get('PBX_IDENTIFIANT');
      //gestion de la page de connection : paramétrage "invisible"
      $PBX .= " PBX_WAIT=0";
      $PBX .= " PBX_TXT=";
      $PBX .= " PBX_BOUTPI=nul";
      $PBX .= " PBX_BKGD=white";
      //informations paiement (appel)
      $PBX .= " PBX_TOTAL=$amount"; // MONTANT
      $PBX .= " PBX_DEVISE=978"; //EURO
      $PBX .= " PBX_CMD=".base64_encode($pay_id.";".time()); // REFERENCE DE LA COMMANDE
      $PBX .= " PBX_PORTEUR=".$this->User->getMail(); // mail du client
      //informations nécessaires aux traitements (réponse)
      $PBX .= " PBX_RETOUR=auto:A\;amount:M\;ident:R\;trans:T\;erreur:E\;sign:K";
      $PBX .= " PBX_REPONDRE_A=".Config::get('http_server_url')."/payboxretour.php";
      $PBX .= " PBX_EFFECTUE=$callback_url?paybox=effectue";
      $PBX .= " PBX_REFUSE=$callback_url?paybox=refuse";
      $PBX .= " PBX_ANNULE=$callback_url?paybox=annule";
      $PBX .= " PBX_ERREUR=$callback_url?paybox=erreur";
      // Url du serveur paybox si différente de celle par défaut (pour mode dev ou pour mobile)
      if($mobile==1) { 
        $pbx_url = Config::get('PBX_MOBILE_URL'); 
      } else { 
        $pbx_url = Config::get('PBX_URL');
      }
      $PBX .= " PBX_PAYBOX=$pbx_url";
	  $PBX .= " PBX_BACKUP1=$pbx_url";
	  $PBX .= " PBX_BACKUP2=$pbx_url";
	  // PROXY
      $proxy = Config::get('proxy');
      if(!empty($proxy))
			 $PBX .= " PBX_PROXY=".$proxy;
			return shell_exec(Config::get('PBX_EXE')." $PBX");
	  }

    /**
     * Fonction appelé sur l'url de callback de paybox
     * @return
     */
    static public function PBXretour() {
      global $_SERVER;
      global $_GET;

      $pos = strrpos( $_SERVER["REQUEST_URI"], '?' );     // cherche dernier separateur
      $data = substr( $_SERVER["REQUEST_URI"], $pos+1 ); 

      // Verification de la signature (1 = BON)
      $CheckSig = Paybox::PbxVerSign( $data, Config::get('PBX_PUBPEM') );

      $amount = !empty($_GET['amount']) ? intval($_GET['amount']) : 0;
      $ref = base64_decode($_GET['ident']);
      $ref_pos = strrpos( $ref, ';' );
      $ref = substr($ref,0,$ref_pos);

      $auto= !empty($_GET['auto']) ? $_GET['auto'] : '';
      $trans=$_GET['trans'];
      $erreur=$_GET['erreur'];
      $db = DbBuckutt::getInstance();

      if($auto == 'XXXXXX' && Config::get('PBX_SITE') != '1999888') {
        Log::warn("PAYBOX : Reception d'une autorisation de test, alors que PBX_SITE n'est pas celui de test ! \n".print_r($_GET, true),10);
      } else if($CheckSig!=1) {
        Log::warn("PAYBOX : La signature est fausse ! \n".print_r($_GET, true),10);
      } else {
        $paybox_row = $db->fetchArray($db->query("SELECT usr_id, pay_amount, pay_step FROM t_paybox_pay WHERE pay_id = '%u'", array($ref)));
        if ($db->affectedRows() != 1) {
          Log::warn("PAYBOX : L'identifiant n'est pas présent dans la table t_paybox_pay \n".print_r($_GET, true));
      } else if ($paybox_row['pay_step'] == 'V') {
          Log::warn("PAYBOX : Ce rechargement n'est pas en attente ! (Tentative de double rechargement ?) \n".print_r($_GET, true));
      } else if($erreur != '00000') {
          Log::error("PAYBOX : Paybox a retourné une erreur ! \n".print_r($_GET, true));
          $db->query("UPDATE t_paybox_pay SET pay_step = 'A', pay_date_retour = NOW(), pay_auto = '%s', pay_trans = '%s', pay_error = '%s' WHERE pay_id = '%u';", Array($auto,$trans,$erreur,$ref));
        } else {
          if($amount != $paybox_row['pay_amount']) {
            Log::warn("PAYBOX : Paybox renvoit un montant de : $amount, mais le rechargement initial était de : ".$paybox_row['pay_amount']." \n".print_r($_GET, true));
            // Du coup on incrémente le compte de la valeur renvoyé par paybox, et on log un rechargement de cette valeur...
            // Pour le bien prions que ce log n'apparaitra jamais... DE toute façon si se log apparait, ce n'est pas une perte d'argent pour nous,
            // Vu qu'on recharge bien le montant indiqué par paybox. Par contre si ce log apparait il est possible que l'user ait rechargé moins que la valeur minimum d'un rechargement ou plus que la valeur max...
          }
          $db->query("UPDATE t_paybox_pay SET pay_step = 'V', pay_date_retour = NOW(), pay_auto = '%s', pay_trans = '%s', pay_error = '%s' WHERE pay_id = '%u';", Array($auto,$trans,$erreur,$ref));
          $db->query("UPDATE ts_user_usr SET usr_credit = (usr_credit + '%u') WHERE usr_id = '%u';", Array($amount, $paybox_row['usr_id']));
          $db->query(("INSERT INTO t_recharge_rec (rty_id, usr_id_buyer, usr_id_operator, poi_id, rec_date, rec_credit, rec_trace) VALUES ('%u', '%u', '%u', '%u', NOW(), '%u', '%s')"), array(3, $paybox_row['usr_id'], $paybox_row['usr_id'], 1, $amount, $ref));
        }
      }
    }

    static private function LoadKey( $keyfile, $pub=true, $pass='' ) {         // chargement de la clé (publique par défaut)

        $fp = $filedata = $key = FALSE;                         // initialisation variables
        $fsize =  filesize( $keyfile );                         // taille du fichier
        if( !$fsize ) return FALSE;                             // si erreur on quitte de suite
        $fp = fopen( $keyfile, 'r' );                           // ouverture fichier
        if( !$fp ) return FALSE;                                // si erreur ouverture on quitte
        $filedata = fread( $fp, $fsize );                       // lecture contenu fichier
        fclose( $fp );                                          // fermeture fichier
        if( !$filedata ) return FALSE;                          // si erreur lecture, on quitte
        if( $pub )
            $key = openssl_pkey_get_public( $filedata );        // recuperation de la cle publique
        else                                                    // ou recuperation de la cle privee
            $key = openssl_pkey_get_private( array( $filedata, $pass ));
        return $key;                                            // renvoi cle ( ou erreur )
    }

    // comme precise la documentation Paybox, la signature doit être
    // obligatoirement en dernière position pour que cela fonctionne

    static private function GetSignedData( $qrystr, &$data, &$sig ) {          // renvoi les donnes signees et la signature

        $pos = strrpos( $qrystr, '&' );                         // cherche dernier separateur
        $data = substr( $qrystr, 0, $pos );                     // et voila les donnees signees
        $pos= strpos( $qrystr, '=', $pos ) + 1;                 // cherche debut valeur signature
        $sig = substr( $qrystr, $pos );                         // et voila la signature
        $sig = base64_decode( urldecode( $sig ));               // decodage signature
    }

    // $querystring = chaine entière retournée par Paybox lors du retour au site (méthode GET)
    // $keyfile = chemin d'accès complet au fichier de la clé publique Paybox

    static private function PbxVerSign( $qrystr, $keyfile ) {                  // verification signature Paybox

        $key = Paybox::LoadKey( $keyfile );                             // chargement de la cle
        if( !$key ) return -1;                                  // si erreur chargement cle
        //  penser à openssl_error_string() pour diagnostic openssl si erreur
        Paybox::GetSignedData( $qrystr, $data, $sig );                  // separation et recuperation signature et donnees
        return openssl_verify( $data, $sig, $key );             // verification : 1 si valide, 0 si invalide, -1 si erreur
    }

}
