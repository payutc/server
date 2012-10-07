<?php



/**
 * This class defines the structure of the 'ts_right_rig' table.
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
class TsRightRigTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TsRightRigTableMap';

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
        $this->setName('ts_right_rig');
        $this->setPhpName('TsRightRig');
        $this->setClassname('TsRightRig');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('RIG_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('RIG_NAME', 'Name', 'VARCHAR', true, 40, null);
        $this->addColumn('RIG_DESCRIPTION', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addColumn('RIG_ADMIN', 'Admin', 'BOOLEAN', true, 1, false);
        $this->addColumn('RIG_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TjUsrRigJur', 'TjUsrRigJur', RelationMap::ONE_TO_MANY, array('rig_id' => 'rig_id', ), null, 'CASCADE', 'TjUsrRigJurs');
    } // buildRelations()

} // TsRightRigTableMap
