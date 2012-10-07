<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 't_sale_sal' table.
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
class SaleTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.SaleTableMap';

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
        $this->setName('t_sale_sal');
        $this->setPhpName('Sale');
        $this->setClassname('Payutc\\Sale');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('SAL_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('SAL_NAME', 'Name', 'VARCHAR', false, 100, null);
        $this->addForeignKey('PER_ID', 'PerId', 'INTEGER', 't_period_per', 'PER_ID', true, null, null);
        $this->addForeignKey('OBJ_ID', 'ObjId', 'INTEGER', 't_object_obj', 'OBJ_ID', true, null, null);
        $this->addColumn('SAL_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Item', 'Payutc\\Item', RelationMap::MANY_TO_ONE, array('obj_id' => 'obj_id', ), null, 'CASCADE');
        $this->addRelation('Period', 'Payutc\\Period', RelationMap::MANY_TO_ONE, array('per_id' => 'per_id', ), null, 'CASCADE');
    } // buildRelations()

} // SaleTableMap
