<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 't_point_poi' table.
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
class PointTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.PointTableMap';

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
        $this->setName('t_point_poi');
        $this->setPhpName('Point');
        $this->setClassname('Payutc\\Point');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('POI_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('POI_NAME', 'Name', 'VARCHAR', true, 40, null);
        $this->addColumn('POI_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Plage', 'Payutc\\Plage', RelationMap::ONE_TO_MANY, array('poi_id' => 'poi_id', ), null, 'CASCADE', 'Plages');
        $this->addRelation('Purchase', 'Payutc\\Purchase', RelationMap::ONE_TO_MANY, array('poi_id' => 'poi_id', ), null, 'CASCADE', 'Purchases');
        $this->addRelation('Recharge', 'Payutc\\Recharge', RelationMap::ONE_TO_MANY, array('poi_id' => 'poi_id', ), null, 'CASCADE', 'Recharges');
        $this->addRelation('JObjPoi', 'Payutc\\JObjPoi', RelationMap::ONE_TO_MANY, array('poi_id' => 'poi_id', ), null, 'CASCADE', 'JObjPois');
        $this->addRelation('JUsrRig', 'Payutc\\JUsrRig', RelationMap::ONE_TO_MANY, array('poi_id' => 'poi_id', ), null, 'CASCADE', 'JUsrRigs');
        $this->addRelation('Item', 'Payutc\\Item', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Items');
        $this->addRelation('JurPeriod', 'Payutc\\Period', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'JurPeriods');
        $this->addRelation('User', 'Payutc\\User', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Users');
        $this->addRelation('Right', 'Payutc\\Right', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Rights');
        $this->addRelation('Fundation', 'Payutc\\Fundation', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Fundations');
    } // buildRelations()

} // PointTableMap
