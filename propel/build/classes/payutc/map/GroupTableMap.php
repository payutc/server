<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 't_group_grp' table.
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
class GroupTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.GroupTableMap';

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
        $this->setName('t_group_grp');
        $this->setPhpName('Group');
        $this->setClassname('Payutc\\Group');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('GRP_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('GRP_NAME', 'Name', 'VARCHAR', true, 40, null);
        $this->addColumn('GRP_OPEN', 'Open', 'BOOLEAN', true, 1, false);
        $this->addColumn('GRP_PUBLIC', 'Public', 'BOOLEAN', true, 1, false);
        $this->addForeignKey('FUN_ID', 'FunId', 'INTEGER', 't_fundation_fun', 'FUN_ID', true, null, null);
        $this->addColumn('GRP_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Fundation', 'Payutc\\Fundation', RelationMap::MANY_TO_ONE, array('fun_id' => 'fun_id', ), null, 'CASCADE');
        $this->addRelation('Price', 'Payutc\\Price', RelationMap::ONE_TO_MANY, array('grp_id' => 'grp_id', ), null, 'CASCADE', 'Prices');
        $this->addRelation('JUsrGrp', 'Payutc\\JUsrGrp', RelationMap::ONE_TO_MANY, array('grp_id' => 'grp_id', ), null, 'CASCADE', 'JUsrGrps');
        $this->addRelation('Period', 'Payutc\\Period', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Periods');
        $this->addRelation('User', 'Payutc\\User', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Users');
    } // buildRelations()

} // GroupTableMap
