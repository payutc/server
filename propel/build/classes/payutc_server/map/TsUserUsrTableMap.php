<?php



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
 * @package    propel.generator.payutc_server.map
 */
class TsUserUsrTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc_server.map.TsUserUsrTableMap';

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
        $this->setPhpName('TsUserUsr');
        $this->setClassname('TsUserUsr');
        $this->setPackage('payutc_server');
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
        $this->addRelation('TsImageImg', 'TsImageImg', RelationMap::MANY_TO_ONE, array('img_id' => 'img_id', ), null, 'CASCADE');
        $this->addRelation('TPayboxPay', 'TPayboxPay', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id', ), null, null, 'TPayboxPays');
        $this->addRelation('TPurchasePurRelatedByUsrIdBuyer', 'TPurchasePur', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_buyer', ), null, 'CASCADE', 'TPurchasePursRelatedByUsrIdBuyer');
        $this->addRelation('TPurchasePurRelatedByUsrIdSeller', 'TPurchasePur', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_seller', ), null, 'CASCADE', 'TPurchasePursRelatedByUsrIdSeller');
        $this->addRelation('TRechargeRecRelatedByUsrIdBuyer', 'TRechargeRec', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_buyer', ), null, 'CASCADE', 'TRechargeRecsRelatedByUsrIdBuyer');
        $this->addRelation('TRechargeRecRelatedByUsrIdOperator', 'TRechargeRec', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_operator', ), null, 'CASCADE', 'TRechargeRecsRelatedByUsrIdOperator');
        $this->addRelation('TSherlocksShe', 'TSherlocksShe', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id', ), null, 'CASCADE', 'TSherlocksShes');
        $this->addRelation('TVirementVirRelatedByUsrIdTo', 'TVirementVir', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_to', ), null, 'CASCADE', 'TVirementVirsRelatedByUsrIdTo');
        $this->addRelation('TVirementVirRelatedByUsrIdFrom', 'TVirementVir', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id_from', ), null, 'CASCADE', 'TVirementVirsRelatedByUsrIdFrom');
        $this->addRelation('TjUsrGrpJug', 'TjUsrGrpJug', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id', ), null, 'CASCADE', 'TjUsrGrpJugs');
        $this->addRelation('TjUsrMolJum', 'TjUsrMolJum', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id', ), null, 'CASCADE', 'TjUsrMolJums');
        $this->addRelation('TjUsrRigJur', 'TjUsrRigJur', RelationMap::ONE_TO_MANY, array('usr_id' => 'usr_id', ), null, 'CASCADE', 'TjUsrRigJurs');
    } // buildRelations()

} // TsUserUsrTableMap
