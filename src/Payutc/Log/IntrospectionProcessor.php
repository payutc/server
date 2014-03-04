<?php

namespace Payutc\Log;

/**
 * Injects line/file:class/function where the log message came from
 *
 * Warning: This only works if the handler processes the logs directly.
 * If you put the processor on a handler that is behind a FingersCrossedHandler
 * for example, the processor will only be called once the trigger level is reached,
 * and all the log records will have the same file/line/.. data from the call that
 * triggered the FingersCrossedHandler.
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
class IntrospectionProcessor
{
    private $level;

    public function __construct($level = Logger::DEBUG)
    {
        $this->level = $level;
    }

    /**
     * @param  array $record
     * @return array
     */
    public function __invoke(array $record)
    {
        // return if the level is not high enough
        if ($record['level'] < $this->level) {
            return $record;
        }

        $trace = debug_backtrace();

        // skip first since it's always the current method
        array_shift($trace);
        // the call_user_func call is also skipped
        array_shift($trace);
        
        /**
         * BEGIN changes
         * @author Thomas Recouvreux
         */
        $i = 0;
        while (isset($trace[$i]['class']) && (false !== strpos($trace[$i]['class'], 'Monolog\\')
                || false !== strpos($trace[$i]['class'], 'Payutc\\Log'))) {
            $i++;
        }
        /**
         * END changes
         */

        // we should have the call source now
        $record['extra'] = array_merge(
            $record['extra'],
            array(
                'file'      => isset($trace[$i-1]['file']) ? $trace[$i-1]['file'] : null,
                'line'      => isset($trace[$i-1]['line']) ? $trace[$i-1]['line'] : null,
                'class'     => isset($trace[$i]['class']) ? $trace[$i]['class'] : null,
                'function'  => isset($trace[$i]['function']) ? $trace[$i]['function'] : null,
                'args'      => isset($trace[$i]['args']) ? $trace[$i]['args'] : null,
            )
        );

        return $record;
    }
}
