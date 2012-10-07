<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 't_recharge_rec' table.
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
class RechargeTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.RechargeTableMap';

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
        $this->setName('t_recharge_rec');
        $this->setPhpName('Recharge');
        $this->setClassname('Payutc\\Recharge');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('REC_ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('RTY_ID', 'RtyId', 'TINYINT', 't_recharge_type_rty', 'RTY_ID', true, 3, null);
        $this->addForeignKey('USR_ID_BUYER', 'UsrIdBuyer', 'INTEGER', 'ts_user_usr', 'USR_ID', true, null, null);
        $this->addForeignKey('USR_ID_OPERATOR', 'UsrIdOperator', 'INTEGER', 'ts_user_usr', 'USR_ID', true, null, null);
        $this->addForeignKey('POI_ID', 'PoiId', 'INTEGER', 't_point_poi', 'POI_ID', true, null, null);
        $this->addColumn('REC_DATE', 'Date', 'TIMESTAMP', true, null, null);
        $this->addColumn('REC_CREDIT', 'Credit', 'SMALLINT', true, 5, null);
        $this->addColumn('REC_TRACE', 'Trace', 'VARCHAR', false, 250, null);
        $this->addColumn('REC_REMOVED', 'Removed', 'BOOLEAN', true, 1, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Point', 'Payutc\\Point', RelationMap::MANY_TO_ONE, array('poi_id' => 'poi_id', ), null, 'CASCADE');
        $this->addRelation('RechargeType', 'Payutc\\RechargeType', RelationMap::MANY_TO_ONE, array('rty_id' => 'rty_id', ), null, 'CASCADE');
        $this->addRelation('UserRelatedByUsrIdBuyer', 'Payutc\\User', RelationMap::MANY_TO_ONE, array('usr_id_buyer' => 'usr_id', ), null, 'CASCADE');
        $this->addRelation('UserRelatedByUsrIdOperator', 'Payutc\\User', RelationMap::MANY_TO_ONE, array('usr_id_operator' => 'usr_id', ), null, 'CASCADE');
    } // buildRelations()

} // RechargeTableMap
