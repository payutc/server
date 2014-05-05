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
use \Payutc\Log;
use \Payutc\Db\Dbal;

class MsgPerso
{
    
    /**
     * Returns user's personnal message in a fundation
     * The priority order is : (usr_id, fun_id), (usr_id, NULL), (NULL, fun_id), (NULL, NULL)
     * If every of these tuples fails to return a message, "http://payutc.github.io" is returned
     */
	public static function getMsgPerso($usr_id=NULL, $fun_id=NULL)
    {
        $qb = Dbal::createQueryBuilder();

        $qb->select('m.msg_perso')
           ->from('t_message_msg', 'm');
            $qb->where('m.usr_id = :usr_id OR m.usr_id IS NULL');
            $qb->andWhere('m.fun_id = :fun_id OR m.fun_id IS NULL');
        
        $qb->addOrderBy('m.usr_id', 'DESC')
           ->addOrderBy('m.fun_id', 'DESC')
           ->setParameters(array(
           'fun_id' => $fun_id,
           'usr_id' => $usr_id
        ));

        $res = $qb->execute();
        
        $don = $res->fetch();
        
        if($don != false) { 
            return $don['msg_perso'];
        } else {
            return "http://payutc.github.io";            
        }
    }
    
    /**
     * Sets user's personnal message
     * There's three different behaviours : 
     * (usr_id, fun_id)   sets an user's personnal message in a specific fundation
     * (usr_id, NULL)    sets an user's defaul personnal message
     * (NULL, fun_id)    sets an fundation's default message
     * 
     * raises an exception if the update failed
     */
    public static function setMsgPerso($msgPerso, $usr_id=NULL, $fun_id=NULL)
    {

        if (!mb_check_encoding($msgPerso, 'UTF-8')) {
            throw new MessageUpdateFailedException("Le message doit être encodé en UTF-8");
        }

        if (strlen($msgPerso) > 255){
            throw new MessageUpdateFailedException("Message trop long (255 caractères max)");
        }

        $qb = Dbal::createQueryBuilder();

        //We check if the fundation exists
        if ($fun_id) {
            $qb->select('f.fun_id')
               ->from('t_fundation_fun', 'f')
               ->where('f.fun_id = :id')
               ->getFirstResult();
               
            $qb->setParameters(array("id" => $fun_id));

            $res = $qb->execute();

            if ($res->rowCount() == 0) {
                throw new MessageUpdateFailedException("Fundation non existante");
            }
        }
        
        $args = array();

        if ($fun_id) {
            $args["fun_id"] = $fun_id;
        }

        if ($usr_id) {
            $args["usr_id"] = $usr_id;
        }

        //We check if a message is already set for the tuple ($usr_id, $fun_id)
        $qb->select('m.msg_perso')
           ->from('t_message_msg', 'm');
        if ($usr_id && !$fun_id) {
            $qb->where('m.usr_id = :usr_id');
            $qb->andWhere('m.fun_id IS NULL');
        } else if (!$usr_id && $fun_id) {
            $qb->where('m.fun_id = :fun_id');
            $qb->andWhere('m.usr_id IS NULL');
        } else if ($usr_id && $fun_id) {
            $qb->where('m.usr_id = :usr_id');
            $qb->andWhere('m.fun_id = :fun_id');
        }
        
        $qb->setParameters($args);

        $res = $qb->execute()->fetch();

        $has_message = false;
        if($res != false) { 
            $has_message = true;
        }

        $args["msg_perso"] = mysql_real_escape_string(htmlspecialchars($msgPerso));

        if ($has_message) {

            //If the message is the same than the old one, there’s no need to update
            if ($msgPerso == $res["msg_perso"]) {
                return;
            }
            
            $qb->update('t_message_msg', 'm')
            ->set('m.msg_perso', ':msg_perso');
            if ($usr_id && !$fun_id) {
                $qb->where('m.usr_id = :usr_id');
                $qb->andWhere('m.fun_id IS NULL');
            } else if (!$usr_id && $fun_id) {
                $qb->where('m.fun_id = :fun_id');
                $qb->andWhere('m.usr_id IS NULL');
            } else if ($usr_id && $fun_id) {
                $qb->where('m.usr_id = :usr_id');
                $qb->andWhere('m.fun_id = :fun_id');
            }
            $qb->setParameters($args);
            $nb = $qb->execute();

            if ($nb != 1) {
                throw new MessageUpdateFailedException("Erreur dans la requête SQL de mise à jour du message");
            }
        } else {
            $nb = Dbal::conn()->insert('t_message_msg', $args);

            if ($nb != 1) {
                throw new MessageUpdateFailedException("Erreur dans la requête SQL d’insertion du message");
            }
        }
    }
}
