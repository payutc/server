<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 't_fundation_fun' table.
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
class FundationTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.FundationTableMap';

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
        $this->setName('t_fundation_fun');
        $this->setPhpName('Fundation');
        $this->setClassname('Payutc\\Fundation');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('FUN_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('FUN_NAME', 'Name', 'VARCHAR', true, 40, null);
        $this->addColumn('FUN_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Group', 'Payutc\\Group', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'Groups');
        $this->addRelation('Item', 'Payutc\\Item', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'Items');
        $this->addRelation('Period', 'Payutc\\Period', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'Periods');
        $this->addRelation('Plage', 'Payutc\\Plage', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'Plages');
        $this->addRelation('Purchase', 'Payutc\\Purchase', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'Purchases');
        $this->addRelation('JUsrRig', 'Payutc\\JUsrRig', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'JUsrRigs');
        $this->addRelation('JurPeriod', 'Payutc\\Period', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'JurPeriods');
        $this->addRelation('User', 'Payutc\\User', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Users');
        $this->addRelation('Right', 'Payutc\\Right', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Rights');
        $this->addRelation('Point', 'Payutc\\Point', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Points');
    } // buildRelations()

} // FundationTableMap
