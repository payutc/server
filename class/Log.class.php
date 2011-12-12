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

/**
 * Log.class
 * 
 * Classe gérant les logs.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';

//TODO le truc sql quon a trouvé avec raoul
class Log
{
    public static $instance;

    /**
     * @param String $message
     * @param int $gravity
     * @param object $db
     * @return int $state
     */
    public function write($message, $gravity=2, $db=0)
    {
        if ($db == 0)
		{
			$db = Db_buckutt::getInstance();
		}
		
		$db->query("INSERT INTO ts_log_log (log_date, log_gravity, log_message) VALUES(NOW(), '%u', '%s');", Array($gravity, $message));
		if ($db->affectedRows() == 1)
			return 1;
		else
			return 0;
    }
}
?>