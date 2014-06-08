<?php

/**
 * Task.class
 * 
 * Gestion des tâches à effectuer hors des requêtes web
 * Table: t_task_tas
 */

namespace Payutc\Bom;
use \Payutc\Db\Dbal;
use \Payutc\Exception\NotImplemented;
use \Httpful\Request;

class Blocked {
    public static function addNotification($message, $user) {
        Dbal::conn()->insert('t_task_tas',
            array('tas_message' => $message,
                  'tas_user' => $user->getId(),
                  'tas_type' => 'notification'),
            array('string', 'integer', 'string'));
    }
    
    /**
     * Exécute la plus vieille requête présente dans la table puis la supprime
     * Cette méthode ne doit pas être appelée plusieurs fois simultanement au 
     *  risque de traiter plusieurs fois une une tâche
     * renvoie une exception en cas de problème
     * true si une tâche à été traitée
     * false il n'y a plus de tâches à traiter
     */
    public static function doOne() {
        $qb = Dbal::conn()->createQueryBuilder()
            ->select('tas_id', 'tas_message', 'tas_user', 'tas_type')
            ->from('t_task_tas', 't')
            ->orderBy('tas_id', 'ACS')
            ->setMaxResults(1);
        $query = $qb->execute();
        
        if ($query->rowCount() == 0) {
            return false;
        }

        $data = $query->fetch();
        if ($data['tas_type'] == 'notification') {
            Notification::send($data['tas_user'], $data['tas_message']);
            return true;
        } else {
            throw new NotImplement("Task type : " . $data['tas_type']);
        }
    }
}

