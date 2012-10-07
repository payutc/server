<?php



/**
 * This class defines the structure of the 'tj_usr_mol_jum' table.
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
class TjUsrMolJumTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TjUsrMolJumTableMap';

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
        $this->setName('tj_usr_mol_jum');
        $this->setPhpName('TjUsrMolJum');
        $this->setClassname('TjUsrMolJum');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('USR_ID', 'UsrId', 'INTEGER' , 'ts_user_usr', 'USR_ID', true, null, null);
        $this->addForeignPrimaryKey('MOL_ID', 'MolId', 'INTEGER' , 'ts_mean_of_login_mol', 'MOL_ID', true, null, null);
        $this->addPrimaryKey('JUM_DATA', 'Data', 'VARCHAR', true, 200, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TsUserUsr', 'TsUserUsr', RelationMap::MANY_TO_ONE, array('usr_id' => 'usr_id', ), null, 'CASCADE');
        $this->addRelation('TsMeanOfLoginMol', 'TsMeanOfLoginMol', RelationMap::MANY_TO_ONE, array('mol_id' => 'mol_id', ), null, 'CASCADE');
    } // buildRelations()

} // TjUsrMolJumTableMap
