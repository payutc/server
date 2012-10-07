<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'tj_usr_grp_jug' table.
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
class JUsrGrpTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.JUsrGrpTableMap';

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
        $this->setName('tj_usr_grp_jug');
        $this->setPhpName('JUsrGrp');
        $this->setClassname('Payutc\\JUsrGrp');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        $this->setIsCrossRef(true);
        // columns
        $this->addColumn('JUG_ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignPrimaryKey('USR_ID', 'UsrId', 'INTEGER' , 'ts_user_usr', 'USR_ID', true, null, null);
        $this->addForeignPrimaryKey('GRP_ID', 'GrpId', 'INTEGER' , 't_group_grp', 'GRP_ID', true, null, null);
        $this->addForeignKey('PER_ID', 'PerId', 'INTEGER', 't_period_per', 'PER_ID', true, null, null);
        $this->addColumn('JUG_REMOVED', 'Removed', 'TINYINT', true, 3, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Period', 'Payutc\\Period', RelationMap::MANY_TO_ONE, array('per_id' => 'per_id', ), null, 'CASCADE');
        $this->addRelation('User', 'Payutc\\User', RelationMap::MANY_TO_ONE, array('usr_id' => 'usr_id', ), null, 'CASCADE');
        $this->addRelation('Group', 'Payutc\\Group', RelationMap::MANY_TO_ONE, array('grp_id' => 'grp_id', ), null, 'CASCADE');
    } // buildRelations()

} // JUsrGrpTableMap
