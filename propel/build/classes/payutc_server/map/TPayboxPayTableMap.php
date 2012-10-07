<?php



/**
 * This class defines the structure of the 't_paybox_pay' table.
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
class TPayboxPayTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TPayboxPayTableMap';

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
        $this->setName('t_paybox_pay');
        $this->setPhpName('TPayboxPay');
        $this->setClassname('TPayboxPay');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('PAY_ID', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('USR_ID', 'UsrId', 'INTEGER', 'ts_user_usr', 'USR_ID', true, null, null);
        $this->addColumn('PAY_STEP', 'Step', 'CHAR', true, null, null);
        $this->addColumn('PAY_AMOUNT', 'Amount', 'INTEGER', true, 5, null);
        $this->addColumn('PAY_DATE_CREATE', 'DateCreate', 'TIMESTAMP', true, null, null);
        $this->addColumn('PAY_DATE_RETOUR', 'DateRetour', 'TIMESTAMP', false, null, null);
        $this->addColumn('PAY_AUTO', 'Auto', 'VARCHAR', false, 20, null);
        $this->addColumn('PAY_TRANS', 'Trans', 'VARCHAR', false, 20, null);
        $this->addColumn('PAY_CALLBACK_URL', 'CallbackUrl', 'VARCHAR', true, 255, null);
        $this->addColumn('PAY_MOBILE', 'Mobile', 'BOOLEAN', true, 1, false);
        $this->addColumn('PAY_ERROR', 'Error', 'VARCHAR', false, 5, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TsUserUsr', 'TsUserUsr', RelationMap::MANY_TO_ONE, array('usr_id' => 'usr_id', ), null, null);
    } // buildRelations()

} // TPayboxPayTableMap
