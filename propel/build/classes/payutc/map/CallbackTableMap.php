<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'ts_callback_cal' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.payutc.map
 */
class CallbackTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.CallbackTableMap';

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
        $this->setName('ts_callback_cal');
        $this->setPhpName('Callback');
        $this->setClassname('Payutc\\Callback');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('CAL_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('PRO_ID', 'ProId', 'INTEGER', true, null, null);
        $this->addColumn('CAL_REQUEST', 'Request', 'VARCHAR', true, 250, null);
        $this->addForeignKey('MOL_ID', 'MolId', 'INTEGER', 'ts_mean_of_login_mol', 'MOL_ID', true, null, null);
        $this->addColumn('CAL_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('MeanOfLogin', 'Payutc\\MeanOfLogin', RelationMap::MANY_TO_ONE, array('mol_id' => 'mol_id', ), null, 'CASCADE');
    } // buildRelations()

} // CallbackTableMap
