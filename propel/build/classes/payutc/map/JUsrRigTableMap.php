<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'tj_usr_rig_jur' table.
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
class JUsrRigTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.JUsrRigTableMap';

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
        $this->setName('tj_usr_rig_jur');
        $this->setPhpName('JUsrRig');
        $this->setClassname('Payutc\\JUsrRig');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        $this->setIsCrossRef(true);
        // columns
        $this->addColumn('JUR_ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignPrimaryKey('USR_ID', 'UsrId', 'INTEGER' , 'ts_user_usr', 'USR_ID', true, null, null);
        $this->addForeignPrimaryKey('RIG_ID', 'RigId', 'INTEGER' , 'ts_right_rig', 'RIG_ID', true, null, null);
        $this->addForeignKey('PER_ID', 'PerId', 'INTEGER', 't_period_per', 'PER_ID', false, null, null);
        $this->addForeignKey('FUN_ID', 'FunId', 'INTEGER', 't_fundation_fun', 'FUN_ID', false, null, null);
        $this->addForeignKey('POI_ID', 'PoiId', 'INTEGER', 't_point_poi', 'POI_ID', false, null, null);
        $this->addColumn('JUR_REMOVED', 'Removed', 'TINYINT', true, 3, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('JurPeriod', 'Payutc\\Period', RelationMap::MANY_TO_ONE, array('per_id' => 'per_id', ), null, 'CASCADE');
        $this->addRelation('User', 'Payutc\\User', RelationMap::MANY_TO_ONE, array('usr_id' => 'usr_id', ), null, 'CASCADE');
        $this->addRelation('Right', 'Payutc\\Right', RelationMap::MANY_TO_ONE, array('rig_id' => 'rig_id', ), null, 'CASCADE');
        $this->addRelation('Fundation', 'Payutc\\Fundation', RelationMap::MANY_TO_ONE, array('fun_id' => 'fun_id', ), null, 'CASCADE');
        $this->addRelation('Point', 'Payutc\\Point', RelationMap::MANY_TO_ONE, array('poi_id' => 'poi_id', ), null, 'CASCADE');
    } // buildRelations()

} // JUsrRigTableMap
