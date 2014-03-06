<?php

namespace Payutc\Log;

class JsonFormatter extends \Monolog\Formatter\NormalizerFormatter
{

    protected $pretty_print = false;

    /**
     * @param string $format     The format of the message
     * @param string $dateFormat The format of the timestamp: one supported by DateTime::format
     */
    public function __construct($pretty_print = false, $dateFormat = null)
    {
        parent::__construct($dateFormat);
        $this->pretty_print = $pretty_print;
    }
    
    public function format(array $record)
    {
        $vars = parent::format($record);
        $options = 0;
        if (version_compare(PHP_VERSION, '5.4.0', '>=') and $this->pretty_print) {
            $options |= JSON_PRETTY_PRINT;
        }
        return json_encode($vars, $options) . PHP_EOL;
    }
    
    public function formatBatch(array $records)
    {
        $message = '';
        foreach ($records as $record) {
            $message .= $this->format($record);
        }

        return $message;
    }

}

