<?php

namespace Payutc\Log;

class ContextProcessor
{
    public function __invoke(array $record)
    {
        $user = isset($_SESSION['ServiceBase']['user']) ? $_SESSION['ServiceBase']['user'] : null;
        $application = isset($_SESSION['ServiceBase']['application']) ? $_SESSION['ServiceBase']['application'] : null;
        
        $record['extra']['user'] = $user;
        $record['extra']['application'] = $application;
        $record['extra']['session_id'] = session_id();
        
        return $record;
    }
}


