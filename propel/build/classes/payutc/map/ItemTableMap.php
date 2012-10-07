<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


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
 * @package    propel.generator.payutc.map
 */
class ItemTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.ItemTableMap';

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
        $this->setPhpName('Item');
        $this->setClassname('Payutc\\Item');
        $this->setPackage('payutc');
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
        $this->addRelation('Fundation', 'Payutc\\Fundation', RelationMap::MANY_TO_ONE, array('fun_id' => 'fun_id', ), null, 'CASCADE');
        $this->addRelation('Image', 'Payutc\\Image', RelationMap::MANY_TO_ONE, array('img_id' => 'img_id', ), null, null);
        $this->addRelation('Price', 'Payutc\\Price', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id', ), null, 'CASCADE', 'Prices');
        $this->addRelation('Purchase', 'Payutc\\Purchase', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id', ), null, 'CASCADE', 'Purchases');
        $this->addRelation('Sale', 'Payutc\\Sale', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id', ), null, 'CASCADE', 'Sales');
        $this->addRelation('JObjPoi', 'Payutc\\JObjPoi', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id', ), null, 'CASCADE', 'JObjPois');
        $this->addRelation('JObjectLinkRelatedByIdChild', 'Payutc\\JObjectLink', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id_child', ), null, 'CASCADE', 'JObjectLinksRelatedByIdChild');
        $this->addRelation('JObjectLinkRelatedByIdParent', 'Payutc\\JObjectLink', RelationMap::ONE_TO_MANY, array('obj_id' => 'obj_id_parent', ), null, 'CASCADE', 'JObjectLinksRelatedByIdParent');
        $this->addRelation('Point', 'Payutc\\Point', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Points');
    } // buildRelations()

} // ItemTableMap
