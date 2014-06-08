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

class Task {
    public static function addNotification($message, $user) {
        Dbal::conn()->insert('t_task_tas',
            array('tas_message' => $message,
                  'tas_user' => $user->getId(),
                  'tas_type' => 'notification',
                  'tas_created_at' => new \DateTime('now')),
            array('string', 'integer', 'string', 'datetime'));
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
        $conn = Dbal::conn();
        $conn->beginTransaction();
        
        $qb = $conn->createQueryBuilder()
            ->select('tas_id', 'tas_message', 'tas_user', 'tas_type')
            ->from('t_task_tas', 't')
            ->orderBy('tas_id', 'ASC')
            ->setMaxResults(1);
        $query = $qb->execute();
        
        if ($query->rowCount() == 0) {
            return false;
        }

        try {
            $data = $query->fetch();
            if ($data['tas_type'] == 'notification') {
                Notification::send($data['tas_user'], $data['tas_message']);
            } else {
                throw new NotImplement("Task type : " . $data['tas_type']);
            }
        } catch (\Exception $e) {
            $qdelete = $conn->createQueryBuilder()
                ->delete('t_task_tas')
                 ->where('tas_id = :id')
                 ->setParameter('id', $data['tas_id'])
                 ->execute();
            $conn->commit();
            throw $e;
        }

        $qdelete = $conn->createQueryBuilder()
            ->delete('t_task_tas')
             ->where('tas_id = :id')
             ->setParameter('id', $data['tas_id'])
             ->execute();
        $conn->commit();
        return true;
    }
}

