<?php



/**
 * This class defines the structure of the 't_plage_pla' table.
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
class TPlagePlaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TPlagePlaTableMap';

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
        $this->setName('t_plage_pla');
        $this->setPhpName('TPlagePla');
        $this->setClassname('TPlagePla');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('PLA_ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('FUN_ID', 'FunId', 'INTEGER', 't_fundation_fun', 'FUN_ID', true, null, null);
        $this->addForeignKey('POI_ID', 'PoiId', 'INTEGER', 't_point_poi', 'POI_ID', true, null, null);
        $this->addColumn('PLA_START', 'Start', 'INTEGER', true, 4, null);
        $this->addColumn('PLA_END', 'End', 'INTEGER', true, 4, null);
        $this->addColumn('PLA_NAME', 'Name', 'VARCHAR', true, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TPointPoi', 'TPointPoi', RelationMap::MANY_TO_ONE, array('poi_id' => 'poi_id', ), null, 'CASCADE');
        $this->addRelation('TFundationFun', 'TFundationFun', RelationMap::MANY_TO_ONE, array('fun_id' => 'fun_id', ), null, 'CASCADE');
    } // buildRelations()

} // TPlagePlaTableMap
