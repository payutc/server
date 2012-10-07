<?php



/**
 * This class defines the structure of the 'ts_mean_of_login_mol' table.
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
class TsMeanOfLoginMolTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TsMeanOfLoginMolTableMap';

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
        $this->setName('ts_mean_of_login_mol');
        $this->setPhpName('TsMeanOfLoginMol');
        $this->setClassname('TsMeanOfLoginMol');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('MOL_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('MOL_NAME', 'Name', 'VARCHAR', true, 40, null);
        $this->addColumn('MOL_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TjUsrMolJum', 'TjUsrMolJum', RelationMap::ONE_TO_MANY, array('mol_id' => 'mol_id', ), null, 'CASCADE', 'TjUsrMolJums');
        $this->addRelation('TsCallbackCal', 'TsCallbackCal', RelationMap::ONE_TO_MANY, array('mol_id' => 'mol_id', ), null, 'CASCADE', 'TsCallbackCals');
    } // buildRelations()

} // TsMeanOfLoginMolTableMap
