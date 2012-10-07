<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 't_period_per' table.
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
class PeriodTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.PeriodTableMap';

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
        $this->setName('t_period_per');
        $this->setPhpName('Period');
        $this->setClassname('Payutc\\Period');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('PER_ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('FUN_ID', 'FunId', 'INTEGER', 't_fundation_fun', 'FUN_ID', true, null, null);
        $this->addColumn('PER_NAME', 'Name', 'LONGVARCHAR', false, null, null);
        $this->addColumn('PER_DATE_START', 'DateStart', 'TIMESTAMP', true, null, null);
        $this->addColumn('PER_DATE_END', 'DateEnd', 'TIMESTAMP', true, null, null);
        $this->addColumn('PER_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Fundation', 'Payutc\\Fundation', RelationMap::MANY_TO_ONE, array('fun_id' => 'fun_id', ), null, 'CASCADE');
        $this->addRelation('Price', 'Payutc\\Price', RelationMap::ONE_TO_MANY, array('per_id' => 'per_id', ), null, 'CASCADE', 'Prices');
        $this->addRelation('Sale', 'Payutc\\Sale', RelationMap::ONE_TO_MANY, array('per_id' => 'per_id', ), null, 'CASCADE', 'Sales');
        $this->addRelation('JUsrGrp', 'Payutc\\JUsrGrp', RelationMap::ONE_TO_MANY, array('per_id' => 'per_id', ), null, 'CASCADE', 'JUsrGrps');
        $this->addRelation('JUsrRig', 'Payutc\\JUsrRig', RelationMap::ONE_TO_MANY, array('per_id' => 'per_id', ), null, 'CASCADE', 'JUsrRigs');
        $this->addRelation('User', 'Payutc\\User', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Users');
        $this->addRelation('Group', 'Payutc\\Group', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Groups');
        $this->addRelation('User', 'Payutc\\User', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Users');
        $this->addRelation('Right', 'Payutc\\Right', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Rights');
        $this->addRelation('Fundation', 'Payutc\\Fundation', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Fundations');
        $this->addRelation('Point', 'Payutc\\Point', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Points');
    } // buildRelations()

} // PeriodTableMap
