<?php



/**
 * This class defines the structure of the 't_oldusr_osr' table.
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
class TOldusrOsrTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TOldusrOsrTableMap';

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
        $this->setName('t_oldusr_osr');
        $this->setPhpName('TOldusrOsr');
        $this->setClassname('TOldusrOsr');
        $this->setPackage('payutc_server');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('OSR_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('OSR_LOGIN', 'Login', 'VARCHAR', false, 255, null);
        $this->addColumn('OSR_CREDIT', 'Credit', 'FLOAT', false, null, null);
        $this->addColumn('OSR_DATE', 'Date', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // TOldusrOsrTableMap
