<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'tj_obj_poi_jop' table.
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
class JObjPoiTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.JObjPoiTableMap';

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
        $this->setName('tj_obj_poi_jop');
        $this->setPhpName('JObjPoi');
        $this->setClassname('Payutc\\JObjPoi');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('OBJ_ID', 'ObjId', 'INTEGER' , 't_object_obj', 'OBJ_ID', true, null, null);
        $this->addColumn('JOP_PRIORITY', 'JopPriority', 'INTEGER', true, null, 100);
        $this->addForeignPrimaryKey('POI_ID', 'PoiId', 'INTEGER' , 't_point_poi', 'POI_ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Point', 'Payutc\\Point', RelationMap::MANY_TO_ONE, array('poi_id' => 'poi_id', ), null, 'CASCADE');
        $this->addRelation('Item', 'Payutc\\Item', RelationMap::MANY_TO_ONE, array('obj_id' => 'obj_id', ), null, 'CASCADE');
    } // buildRelations()

} // JObjPoiTableMap
