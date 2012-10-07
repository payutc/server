<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


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
 * @package    propel.generator.payutc.map
 */
class PlageTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.PlageTableMap';

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
        $this->setPhpName('Plage');
        $this->setClassname('Payutc\\Plage');
        $this->setPackage('payutc');
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
        $this->addRelation('Point', 'Payutc\\Point', RelationMap::MANY_TO_ONE, array('poi_id' => 'poi_id', ), null, 'CASCADE');
        $this->addRelation('Fundation', 'Payutc\\Fundation', RelationMap::MANY_TO_ONE, array('fun_id' => 'fun_id', ), null, 'CASCADE');
    } // buildRelations()

} // PlageTableMap
