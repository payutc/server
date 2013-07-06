<?php

/**
 * MsgPerso.class
 * 
 * Personnal messages' manager
 * Table: t_message_msg
 */

namespace Payutc\Bom;

use \Payutc\Exception\MessageUpdateFailedException;
use \Payutc\Db\DbBuckutt;

class MsgPerso
{
    protected $db;

    public function __construct()
    {
        $this->db = DbBuckutt::getInstance();        
    }
    
    /**
     * Returns user's personnal message in a fundation
     * The priority order is : (usrId, funId), (usrId, NULL), (NULL, funId), (NULL, NULL)
     * If every of these tuples fails to return a message, "http://payutc.github.io" is returned
     */
	public static function getMsgPerso($usrId=NULL, $funId=NULL)
    {
        $db = DbBuckutt::getInstance();
        $param = array($usrId, $funId);
        $req = "SELECT `msg_perso` FROM `t_message_msg` WHERE
                (`usr_id` = '%u' OR `usr_id` IS NULL)
                AND 
                (`fun_id` = '%u' OR `fun_id` IS NULL)
                ORDER BY `usr_id` DESC , `fun_id` DESC LIMIT 0 , 1";

        $res = $db->query($req, $param);
		if ($db->affectedRows() == 1) {
            return $db->result($res);;
	    } else {
            return "http://payutc.github.io";
        }
    }
    
    /**
     * Sets user's personnal message
     * There's four different behaviours : 
     * (usrId, funId)   sets an user's personnal message in a specific fundation
     * (usrId, NULL)    sets an user's defaul personnal message
     * (NULL, funId)    sets an fundation's default message
     * (NULL, NULL)     sets a global "personnal" message
     * 
     * raises an exception if the update failed
     */
    public function setMsgPerso($msgPerso, $usrId = NULL, $funId = NULL)
    {
        $db = DbBuckutt::getInstance();
        if (mb_check_encoding($msgPerso, 'UTF-8')) {
            if (strlen($msgPerso) < 255){
                if (($usrId != NULL) && ($funId != NULL)) {
                    $db->query("INSERT INTO t_message_msg (usr_id, fun_id, msg_perso) VALUES ('%u', '%u', '%s') ON DUPLICATE KEY UPDATE msg_perso='%s'", Array($usrId, $funId, $msgPerso, $msgPerso));
                    if($db->affectedRows() != 1 AND $db->affectedRows() != 2) {
                        throw new MessageUpdateFailedException("Erreur dans l'exécution de la requête");
                    }
                } else if ($usrId != NULL) {
                    $db->query("INSERT INTO t_message_msg (usr_id, fun_id, msg_perso) VALUES ('%u', NULL, '%s') ON DUPLICATE KEY UPDATE msg_perso='%s'", Array($usrId, $msgPerso, $msgPerso));
                    if($db->affectedRows() != 1 AND $db->affectedRows() != 2) {
                        throw new MessageUpdateFailedException("Erreur dans l'exécution de la requête");
                    }
                }
            } else {
                throw new MessageUpdateFailedException("Message trop long (255 caractères max)");
            }
        } else {
            throw new MessageUpdateFailedException("Le message doit être encodé en UTF-8");
        }
    }
}