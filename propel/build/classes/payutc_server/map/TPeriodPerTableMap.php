<?php



/**
 * This class defines the structure of the 't_period_per' table.
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
class TPeriodPerTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TPeriodPerTableMap';

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
        $this->setName('t_period_per');
        $this->setPhpName('TPeriodPer');
        $this->setClassname('TPeriodPer');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('PER_ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('FUN_ID', 'FunId', 'INTEGER', 't_fundation_fun', 'FUN_ID', true, null, null);
        $this->addColumn('PER_NAME', 'Name', 'LONGVARCHAR', false, null, null);
        $this->addColumn('PER_DATE_START', 'DateStart', 'TIMESTAMP', true, null, null);
        $this->addColumn('PER_DATE_END', 'DateEnd', 'TIMESTAMP', true, null, null);
        $this->addColumn('PER_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TFundationFun', 'TFundationFun', RelationMap::MANY_TO_ONE, array('fun_id' => 'fun_id', ), null, 'CASCADE');
        $this->addRelation('TPricePri', 'TPricePri', RelationMap::ONE_TO_MANY, array('per_id' => 'per_id', ), null, 'CASCADE', 'TPricePris');
        $this->addRelation('TSaleSal', 'TSaleSal', RelationMap::ONE_TO_MANY, array('per_id' => 'per_id', ), null, 'CASCADE', 'TSaleSals');
        $this->addRelation('TjUsrGrpJug', 'TjUsrGrpJug', RelationMap::ONE_TO_MANY, array('per_id' => 'per_id', ), null, 'CASCADE', 'TjUsrGrpJugs');
        $this->addRelation('TjUsrRigJur', 'TjUsrRigJur', RelationMap::ONE_TO_MANY, array('per_id' => 'per_id', ), null, 'CASCADE', 'TjUsrRigJurs');
    } // buildRelations()

} // TPeriodPerTableMap
