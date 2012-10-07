<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'ts_user_usr' table.
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
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.UserTableMap';

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
        $this->setName('ts_user_usr');
        $this->setPhpName('User');
        $this->setClassname('Payutc\\User');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('USR_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('USR_PWD', 'Pwd', 'VARCHAR', false, 100, null);
        $this->addColumn('USR_FIRSTNAME', 'Firstname', 'VARCHAR', false, 40, null);
        $this->addColumn('USR_LASTNAME', 'Lastname', 'VARCHAR', false, 40, null);
        $this->addColumn('USR_NICKNAME', 'Nickname', 'VARCHAR', false, 200, null);
        $this->addColumn('USR_ADULT', 'Adult', 'INTEGER', false, 1, null);
        $this->addColumn('USR_MAIL', 'Mail', 'VARCHAR', false, 200, null);
        $this->addColumn('USR_CREDIT', 'Credit', 'SMALLINT', true, 5, 0);
        $this->addForeignKey('IMG_ID', 'ImgId', 'INTEGER', 'ts_image_img', 'IMG_ID', false, null, null);
        $this->addColumn('USR_TEMPORARY', 'Temporary', 'BOOLEAN', true, 1, false);
        $this->addColumn('USR_FAIL_AUTH', 'FailAuth', 'BOOLEAN', true, 1, false);
        $this->addColumn('USR_BLOCKED', 'Blocked', 'BOOLEAN', true, 1, false);
        $this->addColumn('USR_MSG_PERSO', 'MsgPerso', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Image', 'Payutc\\Image', RelationMap::MANY_TO_ONE, array('img_id' => 'img_id', ), null, 'CASCADE');
        $this->addRelation('Paybox', 'Payutc\\Paybox', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id', ), null, null, 'Payboxs');
        $this->addRelation('PurchaseRelatedByUsrIdBuyer', 'Payutc\\Purchase', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_buyer', ), null, 'CASCADE', 'PurchasesRelatedByUsrIdBuyer');
        $this->addRelation('PurchaseRelatedByUsrIdSeller', 'Payutc\\Purchase', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_seller', ), null, 'CASCADE', 'PurchasesRelatedByUsrIdSeller');
        $this->addRelation('RechargeRelatedByUsrIdBuyer', 'Payutc\\Recharge', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_buyer', ), null, 'CASCADE', 'RechargesRelatedByUsrIdBuyer');
        $this->addRelation('RechargeRelatedByUsrIdOperator', 'Payutc\\Recharge', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_operator', ), null, 'CASCADE', 'RechargesRelatedByUsrIdOperator');
        $this->addRelation('Sherlocks', 'Payutc\\Sherlocks', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id', ), null, 'CASCADE', 'Sherlockss');
        $this->addRelation('VirementRelatedByUsrIdTo', 'Payutc\\Virement', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_to', ), null, 'CASCADE', 'VirementsRelatedByUsrIdTo');
        $this->addRelation('VirementRelatedByUsrIdFrom', 'Payutc\\Virement', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_from', ), null, 'CASCADE', 'VirementsRelatedByUsrIdFrom');
        $this->addRelation('JUsrGrp', 'Payutc\\JUsrGrp', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id', ), null, 'CASCADE', 'JUsrGrps');
        $this->addRelation('JUsrMol', 'Payutc\\JUsrMol', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id', ), null, 'CASCADE', 'JUsrMols');
        $this->addRelation('JUsrRig', 'Payutc\\JUsrRig', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id', ), null, 'CASCADE', 'JUsrRigs');
        $this->addRelation('Period', 'Payutc\\Period', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Periods');
        $this->addRelation('Group', 'Payutc\\Group', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Groups');
        $this->addRelation('MeanOfLogin', 'Payutc\\MeanOfLogin', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'MeanOfLogins');
        $this->addRelation('JurPeriod', 'Payutc\\Period', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'JurPeriods');
        $this->addRelation('Right', 'Payutc\\Right', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Rights');
        $this->addRelation('Fundation', 'Payutc\\Fundation', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Fundations');
        $this->addRelation('Point', 'Payutc\\Point', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Points');
    } // buildRelations()

} // UserTableMap
