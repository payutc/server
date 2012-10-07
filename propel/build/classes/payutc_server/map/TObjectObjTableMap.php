<?php



/**
 * This class defines the structure of the 't_object_obj' table.
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
class TObjectObjTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TObjectObjTableMap';

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
        $this->setName('t_object_obj');
        $this->setPhpName('TObjectObj');
        $this->setClassname('TObjectObj');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('OBJ_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('OBJ_NAME', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('OBJ_TYPE', 'Type', 'CHAR', true, null, null);
        $this->addColumn('OBJ_STOCK', 'Stock', 'INTEGER', false, null, null);
        $this->addColumn('OBJ_SINGLE', 'Single', 'BOOLEAN', true, 1, null);
        $this->addColumn('OBJ_TVA', 'Tva', 'INTEGER', true, 4, null);
        $this->addColumn('OBJ_ALCOOL', 'Alcool', 'INTEGER', true, 1, null);
        $this->addForeignKey('IMG_ID', 'ImgId', 'INTEGER', 'ts_image_img', 'IMG_ID', false, null, null);
        $this->addForeignKey('FUN_ID', 'FunId', 'INTEGER', 't_fundation_fun', 'FUN_ID', true, null, null);
        $this->addColumn('OBJ_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TFundationFun', 'TFundationFun', RelationMap::MANY_TO_ONE, array('fun_id' => 'fun_id', ), null, 'CASCADE');
        $this->addRelation('TsImageImg', 'TsImageImg', RelationMap::MANY_TO_ONE, array('img_id' => 'img_id', ), null, null);
        $this->addRelation('TPricePri', 'TPricePri', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id', ), null, 'CASCADE', 'TPricePris');
        $this->addRelation('TPurchasePur', 'TPurchasePur', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id', ), null, 'CASCADE', 'TPurchasePurs');
        $this->addRelation('TSaleSal', 'TSaleSal', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id', ), null, 'CASCADE', 'TSaleSals');
        $this->addRelation('TjObjPoiJop', 'TjObjPoiJop', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id', ), null, 'CASCADE', 'TjObjPoiJops');
        $this->addRelation('TjObjectLinkOliRelatedByObjIdChild', 'TjObjectLinkOli', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id_child', ), null, 'CASCADE', 'TjObjectLinkOlisRelatedByObjIdChild');
        $this->addRelation('TjObjectLinkOliRelatedByObjIdParent', 'TjObjectLinkOli', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id_parent', ), null, 'CASCADE', 'TjObjectLinkOlisRelatedByObjIdParent');
    } // buildRelations()

} // TObjectObjTableMap
