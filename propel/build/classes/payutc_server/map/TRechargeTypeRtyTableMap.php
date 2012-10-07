<?php



/**
 * This class defines the structure of the 't_recharge_type_rty' table.
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
class TRechargeTypeRtyTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TRechargeTypeRtyTableMap';

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
        $this->setName('t_recharge_type_rty');
        $this->setPhpName('TRechargeTypeRty');
        $this->setClassname('TRechargeTypeRty');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('RTY_ID', 'RtyId', 'TINYINT', true, 3, null);
        $this->addColumn('RTY_NAME', 'Name', 'VARCHAR', true, 40, null);
        $this->addColumn('RTY_TYPE', 'Type', 'CHAR', false, null, null);
        $this->addColumn('RTY_REMOVED', 'Removed', 'TINYINT', true, null, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TRechargeRec', 'TRechargeRec', RelationMap::ONE_TO_MANY, array('rty_id' => 'rty_id', ), null, 'CASCADE', 'TRechargeRecs');
    } // buildRelations()

} // TRechargeTypeRtyTableMap
