<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'ts_error_err' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.payutc.map
 */
class ErrorTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.ErrorTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('ts_error_err');
        $this->setPhpName('Error');
        $this->setClassname('Payutc\\Error');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('ERR_CODE', 'Code', 'INTEGER', true, 5, null);
        $this->addColumn('ERR_NAME', 'Name', 'VARCHAR', true, 40, null);
        $this->addColumn('ERR_DESCRIPTION', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addColumn('ERR_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // ErrorTableMap
