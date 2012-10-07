<?php



/**
 * This class defines the structure of the 't_price_pri' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.payutc_server.map
 */
class TPricePriTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TPricePriTableMap';

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
        $this->setName('t_price_pri');
        $this->setPhpName('TPricePri');
        $this->setClassname('TPricePri');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('PRI_ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('OBJ_ID', 'ObjId', 'INTEGER', 't_object_obj', 'OBJ_ID', true, null, null);
        $this->addForeignKey('GRP_ID', 'GrpId', 'INTEGER', 't_group_grp', 'GRP_ID', false, null, null);
        $this->addForeignKey('PER_ID', 'PerId', 'INTEGER', 't_period_per', 'PER_ID', false, null, null);
        $this->addColumn('PRI_CREDIT', 'Credit', 'SMALLINT', true, 8, null);
        $this->addColumn('PRI_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TPeriodPer', 'TPeriodPer', RelationMap::MANY_TO_ONE, array('per_id' => 'per_id', ), null, 'CASCADE');
        $this->addRelation('TObjectObj', 'TObjectObj', RelationMap::MANY_TO_ONE, array('obj_id' => 'obj_id', ), null, 'CASCADE');
        $this->addRelation('TGroupGrp', 'TGroupGrp', RelationMap::MANY_TO_ONE, array('grp_id' => 'grp_id', ), null, 'CASCADE');
    } // buildRelations()

} // TPricePriTableMap
