<?php



/**
 * This class defines the structure of the 'tj_usr_rig_jur' table.
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
class TjUsrRigJurTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TjUsrRigJurTableMap';

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
        $this->setName('tj_usr_rig_jur');
        $this->setPhpName('TjUsrRigJur');
        $this->setClassname('TjUsrRigJur');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('JUR_ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('USR_ID', 'UsrId', 'INTEGER', 'ts_user_usr', 'USR_ID', false, null, null);
        $this->addForeignKey('RIG_ID', 'RigId', 'INTEGER', 'ts_right_rig', 'RIG_ID', true, null, null);
        $this->addForeignKey('PER_ID', 'PerId', 'INTEGER', 't_period_per', 'PER_ID', false, null, null);
        $this->addForeignKey('FUN_ID', 'FunId', 'INTEGER', 't_fundation_fun', 'FUN_ID', false, null, null);
        $this->addForeignKey('POI_ID', 'PoiId', 'INTEGER', 't_point_poi', 'POI_ID', false, null, null);
        $this->addColumn('JUR_REMOVED', 'Removed', 'TINYINT', true, 3, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TPeriodPer', 'TPeriodPer', RelationMap::MANY_TO_ONE, array('per_id' => 'per_id', ), null, 'CASCADE');
        $this->addRelation('TsUserUsr', 'TsUserUsr', RelationMap::MANY_TO_ONE, array('usr_id' => 'usr_id', ), null, 'CASCADE');
        $this->addRelation('TsRightRig', 'TsRightRig', RelationMap::MANY_TO_ONE, array('rig_id' => 'rig_id', ), null, 'CASCADE');
        $this->addRelation('TFundationFun', 'TFundationFun', RelationMap::MANY_TO_ONE, array('fun_id' => 'fun_id', ), null, 'CASCADE');
        $this->addRelation('TPointPoi', 'TPointPoi', RelationMap::MANY_TO_ONE, array('poi_id' => 'poi_id', ), null, 'CASCADE');
    } // buildRelations()

} // TjUsrRigJurTableMap
