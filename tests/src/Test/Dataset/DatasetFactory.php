<?php

namespace Test\Dataset;

class DatasetFactory
{
    public static function computeDataset($args)
    {
        $a = array();
        foreach($args as $arg) {
            if (!is_array($arg)) {
                include 'seed/'.$arg.'.php';
            }
            else {
                $data = $arg;
            }
            $a = static::array_add($a, $data);
        }
        //print_r($a);
        $ds = new ArrayDataset($a);
        return $ds;
    }
    
    protected static function array_add($a1, $a2)
    {
        foreach($a2 as $key=>$value) {
            if (array_key_exists($key, $a1)) {
                foreach($value as $v) {
                    $a1[$key][] = $v;
                }
            }
            else {
                $a1[$key] = $value;
            }
        }
        return $a1;
    }
}


