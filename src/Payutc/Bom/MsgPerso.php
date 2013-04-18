<?php

/**
 * MsgPerso.class
 * 
 * Personnal messages' manager
 * Table: t_message_msg
 */

namespace Payutc\Bom;
use \Db_buckutt;

class MsgPerso
{
    protected $db;

    public function __construct()
    {
        $this->db = Db_buckutt::getInstance();        
    }
    
    /**
     * Returns user's personnal message in a fundation
     * The priority order is : (usrId, funId), (usrId, NULL), (NULL, funId), (NULL, NULL)
     * If every of this tuple fails to return a message, "http://payutc.github.io" is returned
     */
	public static function getMsgPerso($usrId=NULL, $funId=NULL)
    {
        $db = Db_buckutt::getInstance();
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
}