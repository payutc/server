<?php



/**
 * This class defines the structure of the 't_point_poi' table.
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
class TPointPoiTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TPointPoiTableMap';

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
        $this->setName('t_point_poi');
        $this->setPhpName('TPointPoi');
        $this->setClassname('TPointPoi');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('POI_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('POI_NAME', 'Name', 'VARCHAR', true, 40, null);
        $this->addColumn('POI_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TPlagePla', 'TPlagePla', RelationMap::ONE_TO_MANY, array('poi_id' => 'poi_id', ), null, 'CASCADE', 'TPlagePlas');
        $this->addRelation('TPurchasePur', 'TPurchasePur', RelationMap::ONE_TO_MANY, array('poi_id' => 'poi_id', ), null, 'CASCADE', 'TPurchasePurs');
        $this->addRelation('TRechargeRec', 'TRechargeRec', RelationMap::ONE_TO_MANY, array('poi_id' => 'poi_id', ), null, 'CASCADE', 'TRechargeRecs');
        $this->addRelation('TjObjPoiJop', 'TjObjPoiJop', RelationMap::ONE_TO_MANY, array('poi_id' => 'poi_id', ), null, 'CASCADE', 'TjObjPoiJops');
        $this->addRelation('TjUsrRigJur', 'TjUsrRigJur', RelationMap::ONE_TO_MANY, array('poi_id' => 'poi_id', ), null, 'CASCADE', 'TjUsrRigJurs');
    } // buildRelations()

} // TPointPoiTableMap
