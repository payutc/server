<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'ts_right_rig' table.
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
class RightTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.RightTableMap';

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
        $this->setName('ts_right_rig');
        $this->setPhpName('Right');
        $this->setClassname('Payutc\\Right');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('RIG_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('RIG_NAME', 'Name', 'VARCHAR', true, 40, null);
        $this->addColumn('RIG_DESCRIPTION', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addColumn('RIG_ADMIN', 'Admin', 'BOOLEAN', true, 1, false);
        $this->addColumn('RIG_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('JUsrRig', 'Payutc\\JUsrRig', RelationMap::ONE_TO_MANY, array('rig_id' => 'rig_id', ), null, 'CASCADE', 'JUsrRigs');
        $this->addRelation('JurPeriod', 'Payutc\\Period', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'JurPeriods');
        $this->addRelation('User', 'Payutc\\User', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Users');
        $this->addRelation('Fundation', 'Payutc\\Fundation', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Fundations');
        $this->addRelation('Point', 'Payutc\\Point', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Points');
    } // buildRelations()

} // RightTableMap
