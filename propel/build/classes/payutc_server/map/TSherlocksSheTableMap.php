<?php



/**
 * This class defines the structure of the 't_sherlocks_she' table.
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
class TSherlocksSheTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TSherlocksSheTableMap';

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
        $this->setName('t_sherlocks_she');
        $this->setPhpName('TSherlocksShe');
        $this->setClassname('TSherlocksShe');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('SHE_ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('USR_ID', 'UsrId', 'INTEGER', 'ts_user_usr', 'USR_ID', true, 10, null);
        $this->addColumn('SHE_STEP', 'Step', 'BOOLEAN', true, 1, null);
        $this->addColumn('SHE_AMOUNT', 'Amount', 'INTEGER', true, 5, null);
        $this->addColumn('SHE_DATE', 'Date', 'TIMESTAMP', true, null, null);
        $this->addColumn('SHE_PARENT_ID', 'ParentId', 'INTEGER', false, null, null);
        $this->addColumn('SHE_STATE', 'State', 'INTEGER', true, 5, null);
        $this->addColumn('SHE_TRACE', 'Trace', 'LONGVARCHAR', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TsUserUsr', 'TsUserUsr', RelationMap::MANY_TO_ONE, array('usr_id' => 'usr_id', ), null, 'CASCADE');
    } // buildRelations()

} // TSherlocksSheTableMap
