<?php



/**
 * This class defines the structure of the 't_fundation_fun' table.
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
class TFundationFunTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TFundationFunTableMap';

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
        $this->setName('t_fundation_fun');
        $this->setPhpName('TFundationFun');
        $this->setClassname('TFundationFun');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('FUN_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('FUN_NAME', 'Name', 'VARCHAR', true, 40, null);
        $this->addColumn('FUN_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TGroupGrp', 'TGroupGrp', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'TGroupGrps');
        $this->addRelation('TObjectObj', 'TObjectObj', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'TObjectObjs');
        $this->addRelation('TPeriodPer', 'TPeriodPer', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'TPeriodPers');
        $this->addRelation('TPlagePla', 'TPlagePla', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'TPlagePlas');
        $this->addRelation('TPurchasePur', 'TPurchasePur', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'TPurchasePurs');
        $this->addRelation('TjUsrRigJur', 'TjUsrRigJur', RelationMap::ONE_TO_MANY, array('fun_id' => 'fun_id', ), null, 'CASCADE', 'TjUsrRigJurs');
    } // buildRelations()

} // TFundationFunTableMap
