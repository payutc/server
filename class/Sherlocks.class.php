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


class Sherlocks {

    private $Buyer;
    private $db;
    private $pathdebut;
    private $pathfile;
    private $path_bin_req;
    private $path_bin_res;
    private $logfile;
    
    public function __construct(&$Buyer) {
        $this->db = Db_buckutt::getInstance();
        $this->Buyer = &$Buyer;
        // c'est là qu'on change si on change le directory du sherlocks
        $this->pathdebut = "/var/www/subversion/serveur/sherlocks/";
        $this->pathfile = "pathfile=/etc/sherlocks/pathfile";
        $this->path_bin_req = "/usr/bin/request";
        $this->path_bin_res = "/usr/bin/response";
        $this->logfile = "/var/log/log_sherlocks_brut.txt";
    }

    
    /**
     *
     * @param string $post
     * @return
     */
    public function ClientDecode($msg) {
        $post = "message=".base64_decode($msg);
        $result = exec($this->path_bin_res." ".$this->pathfile." ".$post);
        
        $tableau = explode("!", $result);
        
        $code = $tableau[1];
        $error = $tableau[2];
        $merchant_id = $tableau[3];
        $merchant_country = $tableau[4];
        $amount = $tableau[5];
        $transaction_id = $tableau[6];
        $payment_means = $tableau[7];
        $transmission_date = $tableau[8];
        $payment_time = $tableau[9];
        $payment_date = $tableau[10];
        $response_code = $tableau[11];
        $payment_certificate = $tableau[12];
        $authorisation_id = $tableau[13];
        $currency_code = $tableau[14];
        $card_number = $tableau[15];
        $cvv_flag = $tableau[16];
        $cvv_response_code = $tableau[17];
        $bank_response_code = $tableau[18];
        $complementary_code = $tableau[19];
        $complementary_info = $tableau[20];
        $return_context = $tableau[21];
        $caddie = $tableau[22];
        $receipt_complement = $tableau[23];
        $merchant_language = $tableau[24];
        $language = $tableau[25];
        $customer_id = $tableau[26];
        $order_id = $tableau[27];
        $customer_email = $tableau[28];
        $customer_ip_address = $tableau[29];
        $capture_day = $tableau[30];
        $capture_mode = $tableau[31];
        $data = $tableau[32];
        if (($code == "") && ($error == "")) {
            $state = 466;
            $trace = "Probleme de conf du serveur ".$this->path_bin_res." avec ".$post;
            //$this->log->info($trace);
            
        } else if ($code != 0) {
            $state = 467;
            $trace = "Erreur sherlocks ... numero : ".$error." avec ".$post;
            //$this->log->info($trace);
            
        } else {
            $state = 1;
            $trace = "reussite du decodage !".$result;
            //$this->log->info($trace);
            if ($this->db->numRows($this->db->query("SELECT she_id FROM t_sherlocks_she WHERE usr_id = '%u' AND she_step  = '3' AND she_parent_id  = '%u' AND  she_state  = '1' AND she_amount = '%u'", array($this->Buyer->getId(), $order_id, $amount))) == 1) {
                $state = 1;
            } else {
                $state = 468;
            }
            if ($response_code == "00") {
                $state = 1;
            } else {
                $state = 469;
            }
        }
        return array($state, $amount);   
    }
    
    /**
     *
     * @param string $post
     * @return
     */
    public function decode($msg) {
        $post = "message=".base64_decode($msg);
        
        $this->db->query("INSERT INTO t_sherlocks_she (usr_id, she_step, she_amount, she_date, she_parent_id, she_state, she_trace) VALUES ('0', '2', '0', NOW(), NULL, '1', '%s');", array($post));
        
        $result = exec($this->path_bin_res." ".$this->pathfile." ".$post);
        
        $tableau = explode("!", $result);
        
        $code = $tableau[1];
        $error = $tableau[2];
        $merchant_id = $tableau[3];
        $merchant_country = $tableau[4];
        $amount = $tableau[5];
        $transaction_id = $tableau[6];
        $payment_means = $tableau[7];
        $transmission_date = $tableau[8];
        $payment_time = $tableau[9];
        $payment_date = $tableau[10];
        $response_code = $tableau[11];
        $payment_certificate = $tableau[12];
        $authorisation_id = $tableau[13];
        $currency_code = $tableau[14];
        $card_number = $tableau[15];
        $cvv_flag = $tableau[16];
        $cvv_response_code = $tableau[17];
        $bank_response_code = $tableau[18];
        $complementary_code = $tableau[19];
        $complementary_info = $tableau[20];
        $return_context = $tableau[21];
        $caddie = $tableau[22];
        $receipt_complement = $tableau[23];
        $merchant_language = $tableau[24];
        $language = $tableau[25];
        $customer_id = $tableau[26];
        $order_id = $tableau[27];
        $customer_email = $tableau[28];
        $customer_ip_address = $tableau[29];
        $capture_day = $tableau[30];
        $capture_mode = $tableau[31];
        $data = $tableau[32];
        
        $fp = fopen($this->logfile, "a");
        
        if (($code == "") && ($error == "")) {
            $state = 466;
            $trace = "Probleme de conf du serveur ".$this->path_bin_res." avec ".$post." et pathfile ".$this->pathfile;
            $this->db->query("INSERT INTO t_sherlocks_she (usr_id, she_step, she_amount, she_date, she_parent_id, she_state, she_trace) VALUES ('0', '3', '0', NOW(), '0', '%u', '%s');", array($state, $trace));
            
            fwrite($fp, "erreur appel response\n");
            fwrite($fp, "executable response non trouve $this->path_bin_res\n");
        } else if ($code != 0) {
            $state = 467;
            $trace = "Erreur sherlocks ... numero : ".$error." avec ".$post;
            $this->db->query("INSERT INTO t_sherlocks_she (id_usr_iduser, she_step, she_amount, she_date, she_parent_id, she_state, she_trace) VALUES ('0', '3', '0', NOW(), '0', '%u', '%s');", array($state, $trace));
            
            fwrite($fp, " API call error.\n");
            fwrite($fp, "Error message :  $error\n");
        } else {
            
            $trace = "reussite du decodage sherlocks !".$result;
            if ($response_code == "00") {
            	$state = 1;
            	$trace .= "reussite du rechargement CB !";
                $this->db->query("INSERT INTO t_sherlocks_she (usr_id, she_step, she_amount, she_date, she_parent_id, she_state, she_trace) VALUES ('%u', '3', '%u', NOW(), '%u', '%u', '%s');", array($customer_id, $amount, $order_id, $state, $trace));
                
                fwrite($fp, "merchant_id : $merchant_id\n");
                fwrite($fp, "merchant_country : $merchant_country\n");
                fwrite($fp, "amount : $amount\n");
                fwrite($fp, "transaction_id : $transaction_id\n");
                fwrite($fp, "transmission_date: $transmission_date\n");
                fwrite($fp, "payment_means: $payment_means\n");
                fwrite($fp, "payment_time : $payment_time\n");
                fwrite($fp, "payment_date : $payment_date\n");
                fwrite($fp, "response_code : $response_code\n");
                fwrite($fp, "payment_certificate : $payment_certificate\n");
                fwrite($fp, "authorisation_id : $authorisation_id\n");
                fwrite($fp, "currency_code : $currency_code\n");
                fwrite($fp, "card_number : $card_number\n");
                fwrite($fp, "cvv_flag: $cvv_flag\n");
                fwrite($fp, "cvv_response_code: $cvv_response_code\n");
                fwrite($fp, "bank_response_code: $bank_response_code\n");
                fwrite($fp, "complementary_code: $complementary_code\n");
                fwrite($fp, "complementary_info: $complementary_info\n");
                fwrite($fp, "return_context: $return_context\n");
                fwrite($fp, "caddie : $caddie\n");
                fwrite($fp, "receipt_complement: $receipt_complement\n");
                fwrite($fp, "merchant_language: $merchant_language\n");
                fwrite($fp, "language: $language\n");
                fwrite($fp, "customer_id: $customer_id\n");
                fwrite($fp, "order_id: $order_id\n");
                fwrite($fp, "customer_email: $customer_email\n");
                fwrite($fp, "customer_ip_address: $customer_ip_address\n");
                fwrite($fp, "capture_day: $capture_day\n");
                fwrite($fp, "capture_mode: $capture_mode\n");
                fwrite($fp, "data: $data\n");
                fwrite($fp, "-------------------------------------------\n");
                fwrite($fp, "-------------------------------------------\n");
            } else{
            	$state = 467;
            	$trace .= "ECHEC rechargement !";
            	$this->db->query("INSERT INTO t_sherlocks_she (usr_id, she_step, she_amount, she_date, she_parent_id, she_state, she_trace) VALUES ('%u', '3', '%u', NOW(), '%u', '%u', '%s');", array($customer_id, $amount, $order_id, $state, $trace));
            }
        }
        fclose($fp);
        
        return array($state, $amount, $customer_id);
    }

    
    /**
     *
     * @param int $amount
     * @return
     */
    public function encode($amount) {
        $trace = "encode depuis sherlocks";
        $state = 1;
        $id = $this->db->insertId($this->db->query("INSERT INTO t_sherlocks_she (usr_id, she_step, she_amount, she_date, she_parent_id, she_state, she_trace) VALUES ('%u', '0', '%u', NOW(), NULL, '%u', '%s');", array($this->Buyer->getId(), $amount, $state, $trace)));
        
        $parm = "merchant_id=044838667200019 ";
        $parm .= " merchant_country=fr";
        $parm .= " amount=".$amount;
        $parm .= " order_id=".$id;
        $parm .= " customer_id=".$this->Buyer->getId();
        $parm .= " currency_code=978";
        
        $result = exec($this->path_bin_req." ".$this->pathfile." ".$parm);
        
        $tableau = explode("!", "$result");
        $code = $tableau[1];
        $error = $tableau[2];
        $message = $tableau[3];
        
        if (($code == "") && ($error == "")) {
            $state = 466;
            $trace = "Probleme de conf du serveur ".$this->path_bin_res." avec ".$parm." et pathfile ".$this->pathfile;
            $message = $trace;
            $this->db->query("INSERT INTO t_sherlocks_she (usr_id, she_step, she_amount, she_date, she_parent_id, she_state, she_trace) VALUES ('%u', '1', '%u', NOW(), '%u', '%u', '%s');", array($this->Buyer->getId(), $amount, $id, $state, $trace));
            
        } else if ($code != 0) {
            $state = 467;
            $trace = "Erreur sherlocks ... numero : ".$error;
            $message = $trace;
            $this->db->query("INSERT INTO t_sherlocks_she (usr_id, she_step, she_amount, she_date, she_parent_id, she_state, she_trace) VALUES ('%u', '1', '%u', NOW(), '%u', '%u', '%s');", array($this->Buyer->getId(), $amount, $id, $state, $trace));
            
        } else {
            $trace = "bien generé, go : ".$message;
            $state = 1;
            $this->db->query("INSERT INTO t_sherlocks_she (usr_id, she_step, she_amount, she_date, she_parent_id, she_state, she_trace) VALUES ('%u', '1', '%u', NOW(), '%u', '%u', '%s');", array($this->Buyer->getId(), $amount, $id, $state, $trace));  
        }
        $message = base64_encode($message);
        return array($state, $message);
    }
}

?>
