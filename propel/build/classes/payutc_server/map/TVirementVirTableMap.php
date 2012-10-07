<?php



/**
 * This class defines the structure of the 't_virement_vir' table.
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
class TVirementVirTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TVirementVirTableMap';

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
        $this->setName('t_virement_vir');
        $this->setPhpName('TVirementVir');
        $this->setClassname('TVirementVir');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('VIR_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('VIR_DATE', 'Date', 'TIMESTAMP', true, null, null);
        $this->addColumn('VIR_AMOUNT', 'Amount', 'INTEGER', true, 5, null);
        $this->addForeignKey('USR_ID_FROM', 'UsrIdFrom', 'INTEGER', 'ts_user_usr', 'USR_ID', true, null, null);
        $this->addForeignKey('USR_ID_TO', 'UsrIdTo', 'INTEGER', 'ts_user_usr', 'USR_ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TsUserUsrRelatedByUsrIdTo', 'TsUserUsr', RelationMap::MANY_TO_ONE, array('usr_id_to' => 'usr_id', ), null, 'CASCADE');
        $this->addRelation('TsUserUsrRelatedByUsrIdFrom', 'TsUserUsr', RelationMap::MANY_TO_ONE, array('usr_id_from' => 'usr_id', ), null, 'CASCADE');
    } // buildRelations()

} // TVirementVirTableMap
