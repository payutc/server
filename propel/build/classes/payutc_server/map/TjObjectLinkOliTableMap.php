<?php



/**
 * This class defines the structure of the 'tj_object_link_oli' table.
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
class TjObjectLinkOliTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TjObjectLinkOliTableMap';

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
        $this->setName('tj_object_link_oli');
        $this->setPhpName('TjObjectLinkOli');
        $this->setClassname('TjObjectLinkOli');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('OLI_ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('OBJ_ID_PARENT', 'ObjIdParent', 'INTEGER', 't_object_obj', 'OBJ_ID', true, null, null);
        $this->addForeignKey('OBJ_ID_CHILD', 'ObjIdChild', 'INTEGER', 't_object_obj', 'OBJ_ID', true, null, null);
        $this->addColumn('OLI_STEP', 'Step', 'INTEGER', true, 3, null);
        $this->addColumn('OLI_REMOVED', 'Removed', 'TINYINT', true, 3, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TObjectObjRelatedByObjIdChild', 'TObjectObj', RelationMap::MANY_TO_ONE, array('obj_id_child' => 'obj_id', ), null, 'CASCADE');
        $this->addRelation('TObjectObjRelatedByObjIdParent', 'TObjectObj', RelationMap::MANY_TO_ONE, array('obj_id_parent' => 'obj_id', ), null, 'CASCADE');
    } // buildRelations()

} // TjObjectLinkOliTableMap
