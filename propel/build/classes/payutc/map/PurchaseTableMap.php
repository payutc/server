<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 't_purchase_pur' table.
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
class PurchaseTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.PurchaseTableMap';

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
        $this->setName('t_purchase_pur');
        $this->setPhpName('Purchase');
        $this->setClassname('Payutc\\Purchase');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('PUR_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('PUR_DATE', 'Date', 'TIMESTAMP', true, null, null);
        $this->addColumn('PUR_TYPE', 'Type', 'CHAR', true, null, 'product');
        $this->addForeignKey('OBJ_ID', 'ObjId', 'INTEGER', 't_object_obj', 'OBJ_ID', true, null, null);
        $this->addColumn('PUR_PRICE', 'Price', 'INTEGER', true, 8, null);
        $this->addForeignKey('USR_ID_BUYER', 'UsrIdBuyer', 'INTEGER', 'ts_user_usr', 'USR_ID', true, null, null);
        $this->addForeignKey('USR_ID_SELLER', 'UsrIdSeller', 'INTEGER', 'ts_user_usr', 'USR_ID', true, null, null);
        $this->addForeignKey('POI_ID', 'PoiId', 'INTEGER', 't_point_poi', 'POI_ID', true, null, null);
        $this->addForeignKey('FUN_ID', 'FunId', 'INTEGER', 't_fundation_fun', 'FUN_ID', true, null, null);
        $this->addColumn('PUR_IP', 'Ip', 'VARCHAR', true, 15, null);
        $this->addColumn('PUR_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Item', 'Payutc\\Item', RelationMap::MANY_TO_ONE, array('obj_id' => 'obj_id', ), null, 'CASCADE');
        $this->addRelation('UserRelatedByUsrIdBuyer', 'Payutc\\User', RelationMap::MANY_TO_ONE, array('usr_id_buyer' => 'usr_id', ), null, 'CASCADE');
        $this->addRelation('UserRelatedByUsrIdSeller', 'Payutc\\User', RelationMap::MANY_TO_ONE, array('usr_id_seller' => 'usr_id', ), null, 'CASCADE');
        $this->addRelation('Point', 'Payutc\\Point', RelationMap::MANY_TO_ONE, array('poi_id' => 'poi_id', ), null, 'CASCADE');
        $this->addRelation('Fundation', 'Payutc\\Fundation', RelationMap::MANY_TO_ONE, array('fun_id' => 'fun_id', ), null, 'CASCADE');
    } // buildRelations()

} // PurchaseTableMap
