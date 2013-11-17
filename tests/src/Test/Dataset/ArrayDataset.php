<?php

namespace Test\Dataset;


use \PHPUnit_Extensions_Database_DataSet_AbstractDataSet;
use \PHPUnit_Extensions_Database_DataSet_DefaultTableMetaData;
use \PHPUnit_Extensions_Database_DataSet_DefaultTable;
use \PHPUnit_Extensions_Database_DataSet_DefaultTableIterator;
use \InvalidArgumentException;


class ArrayDataset extends PHPUnit_Extensions_Database_DataSet_AbstractDataSet
{
    /**
     * @var array
     */
    protected $tables = array();

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data AS $tableName => $rows) {
            $columns = array();
            foreach($rows as $row) {
                foreach($row as $key=>$val) {
                    $columns[$key] = 1;
                }
            }
            $columns = array_keys($columns);

            $metaData = new PHPUnit_Extensions_Database_DataSet_DefaultTableMetaData($tableName, $columns);
            $table = new PHPUnit_Extensions_Database_DataSet_DefaultTable($metaData);

            foreach ($rows AS $row) {
                $table->addRow($row);
            }
            $this->tables[$tableName] = $table;
        }
    }

    protected function createIterator($reverse = FALSE)
    {
        return new PHPUnit_Extensions_Database_DataSet_DefaultTableIterator($this->tables, $reverse);
    }

    public function getTable($tableName)
    {
        if (!isset($this->tables[$tableName])) {
            throw new InvalidArgumentException("$tableName is not a table in the current database.");
        }

        return $this->tables[$tableName];
    }
}
