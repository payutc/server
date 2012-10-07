<?php


/**
 * Base class that represents a row from the 'ts_user_usr' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTsUserUsr extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TsUserUsrPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TsUserUsrPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the usr_id field.
     * @var        int
     */
    protected $usr_id;

    /**
     * The value for the usr_pwd field.
     * @var        string
     */
    protected $usr_pwd;

    /**
     * The value for the usr_firstname field.
     * @var        string
     */
    protected $usr_firstname;

    /**
     * The value for the usr_lastname field.
     * @var        string
     */
    protected $usr_lastname;

    /**
     * The value for the usr_nickname field.
     * @var        string
     */
    protected $usr_nickname;

    /**
     * The value for the usr_adult field.
     * @var        int
     */
    protected $usr_adult;

    /**
     * The value for the usr_mail field.
     * @var        string
     */
    protected $usr_mail;

    /**
     * The value for the usr_credit field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $usr_credit;

    /**
     * The value for the img_id field.
     * @var        int
     */
    protected $img_id;

    /**
     * The value for the usr_temporary field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $usr_temporary;

    /**
     * The value for the usr_fail_auth field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $usr_fail_auth;

    /**
     * The value for the usr_blocked field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $usr_blocked;

    /**
     * The value for the usr_msg_perso field.
     * @var        string
     */
    protected $usr_msg_perso;

    /**
     * @var        TsImageImg
     */
    protected $aTsImageImg;

    /**
     * @var        PropelObjectCollection|TPayboxPay[] Collection to store aggregation of TPayboxPay objects.
     */
    protected $collTPayboxPays;
    protected $collTPayboxPaysPartial;

    /**
     * @var        PropelObjectCollection|TPurchasePur[] Collection to store aggregation of TPurchasePur objects.
     */
    protected $collTPurchasePursRelatedByUsrIdBuyer;
    protected $collTPurchasePursRelatedByUsrIdBuyerPartial;

    /**
     * @var        PropelObjectCollection|TPurchasePur[] Collection to store aggregation of TPurchasePur objects.
     */
    protected $collTPurchasePursRelatedByUsrIdSeller;
    protected $collTPurchasePursRelatedByUsrIdSellerPartial;

    /**
     * @var        PropelObjectCollection|TRechargeRec[] Collection to store aggregation of TRechargeRec objects.
     */
    protected $collTRechargeRecsRelatedByUsrIdBuyer;
    protected $collTRechargeRecsRelatedByUsrIdBuyerPartial;

    /**
     * @var        PropelObjectCollection|TRechargeRec[] Collection to store aggregation of TRechargeRec objects.
     */
    protected $collTRechargeRecsRelatedByUsrIdOperator;
    protected $collTRechargeRecsRelatedByUsrIdOperatorPartial;

    /**
     * @var        PropelObjectCollection|TSherlocksShe[] Collection to store aggregation of TSherlocksShe objects.
     */
    protected $collTSherlocksShes;
    protected $collTSherlocksShesPartial;

    /**
     * @var        PropelObjectCollection|TVirementVir[] Collection to store aggregation of TVirementVir objects.
     */
    protected $collTVirementVirsRelatedByUsrIdTo;
    protected $collTVirementVirsRelatedByUsrIdToPartial;

    /**
     * @var        PropelObjectCollection|TVirementVir[] Collection to store aggregation of TVirementVir objects.
     */
    protected $collTVirementVirsRelatedByUsrIdFrom;
    protected $collTVirementVirsRelatedByUsrIdFromPartial;

    /**
     * @var        PropelObjectCollection|TjUsrGrpJug[] Collection to store aggregation of TjUsrGrpJug objects.
     */
    protected $collTjUsrGrpJugs;
    protected $collTjUsrGrpJugsPartial;

    /**
     * @var        PropelObjectCollection|TjUsrMolJum[] Collection to store aggregation of TjUsrMolJum objects.
     */
    protected $collTjUsrMolJums;
    protected $collTjUsrMolJumsPartial;

    /**
     * @var        PropelObjectCollection|TjUsrRigJur[] Collection to store aggregation of TjUsrRigJur objects.
     */
    protected $collTjUsrRigJurs;
    protected $collTjUsrRigJursPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tPayboxPaysScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tPurchasePursRelatedByUsrIdBuyerScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tPurchasePursRelatedByUsrIdSellerScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tRechargeRecsRelatedByUsrIdBuyerScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tRechargeRecsRelatedByUsrIdOperatorScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tSherlocksShesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tVirementVirsRelatedByUsrIdToScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tVirementVirsRelatedByUsrIdFromScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tjUsrGrpJugsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tjUsrMolJumsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tjUsrRigJursScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->usr_credit = 0;
        $this->usr_temporary = false;
        $this->usr_fail_auth = false;
        $this->usr_blocked = false;
    }

    /**
     * Initializes internal state of BaseTsUserUsr object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [usr_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->usr_id;
    }

    /**
     * Get the [usr_pwd] column value.
     *
     * @return string
     */
    public function getPwd()
    {
        return $this->usr_pwd;
    }

    /**
     * Get the [usr_firstname] column value.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->usr_firstname;
    }

    /**
     * Get the [usr_lastname] column value.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->usr_lastname;
    }

    /**
     * Get the [usr_nickname] column value.
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->usr_nickname;
    }

    /**
     * Get the [usr_adult] column value.
     *
     * @return int
     */
    public function getAdult()
    {
        return $this->usr_adult;
    }

    /**
     * Get the [usr_mail] column value.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->usr_mail;
    }

    /**
     * Get the [usr_credit] column value.
     *
     * @return int
     */
    public function getCredit()
    {
        return $this->usr_credit;
    }

    /**
     * Get the [img_id] column value.
     *
     * @return int
     */
    public function getImgId()
    {
        return $this->img_id;
    }

    /**
     * Get the [usr_temporary] column value.
     *
     * @return boolean
     */
    public function getTemporary()
    {
        return $this->usr_temporary;
    }

    /**
     * Get the [usr_fail_auth] column value.
     *
     * @return boolean
     */
    public function getFailAuth()
    {
        return $this->usr_fail_auth;
    }

    /**
     * Get the [usr_blocked] column value.
     *
     * @return boolean
     */
    public function getBlocked()
    {
        return $this->usr_blocked;
    }

    /**
     * Get the [usr_msg_perso] column value.
     *
     * @return string
     */
    public function getMsgPerso()
    {
        return $this->usr_msg_perso;
    }

    /**
     * Set the value of [usr_id] column.
     *
     * @param int $v new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_id !== $v) {
            $this->usr_id = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [usr_pwd] column.
     *
     * @param string $v new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setPwd($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_pwd !== $v) {
            $this->usr_pwd = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_PWD;
        }


        return $this;
    } // setPwd()

    /**
     * Set the value of [usr_firstname] column.
     *
     * @param string $v new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setFirstname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_firstname !== $v) {
            $this->usr_firstname = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_FIRSTNAME;
        }


        return $this;
    } // setFirstname()

    /**
     * Set the value of [usr_lastname] column.
     *
     * @param string $v new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setLastname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_lastname !== $v) {
            $this->usr_lastname = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_LASTNAME;
        }


        return $this;
    } // setLastname()

    /**
     * Set the value of [usr_nickname] column.
     *
     * @param string $v new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setNickname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_nickname !== $v) {
            $this->usr_nickname = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_NICKNAME;
        }


        return $this;
    } // setNickname()

    /**
     * Set the value of [usr_adult] column.
     *
     * @param int $v new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setAdult($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_adult !== $v) {
            $this->usr_adult = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_ADULT;
        }


        return $this;
    } // setAdult()

    /**
     * Set the value of [usr_mail] column.
     *
     * @param string $v new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setMail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_mail !== $v) {
            $this->usr_mail = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_MAIL;
        }


        return $this;
    } // setMail()

    /**
     * Set the value of [usr_credit] column.
     *
     * @param int $v new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setCredit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_credit !== $v) {
            $this->usr_credit = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_CREDIT;
        }


        return $this;
    } // setCredit()

    /**
     * Set the value of [img_id] column.
     *
     * @param int $v new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setImgId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->img_id !== $v) {
            $this->img_id = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::IMG_ID;
        }

        if ($this->aTsImageImg !== null && $this->aTsImageImg->getId() !== $v) {
            $this->aTsImageImg = null;
        }


        return $this;
    } // setImgId()

    /**
     * Sets the value of the [usr_temporary] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setTemporary($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->usr_temporary !== $v) {
            $this->usr_temporary = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_TEMPORARY;
        }


        return $this;
    } // setTemporary()

    /**
     * Sets the value of the [usr_fail_auth] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setFailAuth($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->usr_fail_auth !== $v) {
            $this->usr_fail_auth = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_FAIL_AUTH;
        }


        return $this;
    } // setFailAuth()

    /**
     * Sets the value of the [usr_blocked] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setBlocked($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->usr_blocked !== $v) {
            $this->usr_blocked = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_BLOCKED;
        }


        return $this;
    } // setBlocked()

    /**
     * Set the value of [usr_msg_perso] column.
     *
     * @param string $v new value
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function setMsgPerso($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_msg_perso !== $v) {
            $this->usr_msg_perso = $v;
            $this->modifiedColumns[] = TsUserUsrPeer::USR_MSG_PERSO;
        }


        return $this;
    } // setMsgPerso()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->usr_credit !== 0) {
                return false;
            }

            if ($this->usr_temporary !== false) {
                return false;
            }

            if ($this->usr_fail_auth !== false) {
                return false;
            }

            if ($this->usr_blocked !== false) {
                return false;
            }

        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->usr_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->usr_pwd = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->usr_firstname = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->usr_lastname = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->usr_nickname = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->usr_adult = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->usr_mail = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->usr_credit = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->img_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->usr_temporary = ($row[$startcol + 9] !== null) ? (boolean) $row[$startcol + 9] : null;
            $this->usr_fail_auth = ($row[$startcol + 10] !== null) ? (boolean) $row[$startcol + 10] : null;
            $this->usr_blocked = ($row[$startcol + 11] !== null) ? (boolean) $row[$startcol + 11] : null;
            $this->usr_msg_perso = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = TsUserUsrPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TsUserUsr object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aTsImageImg !== null && $this->img_id !== $this->aTsImageImg->getId()) {
            $this->aTsImageImg = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TsUserUsrPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTsImageImg = null;
            $this->collTPayboxPays = null;

            $this->collTPurchasePursRelatedByUsrIdBuyer = null;

            $this->collTPurchasePursRelatedByUsrIdSeller = null;

            $this->collTRechargeRecsRelatedByUsrIdBuyer = null;

            $this->collTRechargeRecsRelatedByUsrIdOperator = null;

            $this->collTSherlocksShes = null;

            $this->collTVirementVirsRelatedByUsrIdTo = null;

            $this->collTVirementVirsRelatedByUsrIdFrom = null;

            $this->collTjUsrGrpJugs = null;

            $this->collTjUsrMolJums = null;

            $this->collTjUsrRigJurs = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TsUserUsrQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                TsUserUsrPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aTsImageImg !== null) {
                if ($this->aTsImageImg->isModified() || $this->aTsImageImg->isNew()) {
                    $affectedRows += $this->aTsImageImg->save($con);
                }
                $this->setTsImageImg($this->aTsImageImg);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->tPayboxPaysScheduledForDeletion !== null) {
                if (!$this->tPayboxPaysScheduledForDeletion->isEmpty()) {
                    TPayboxPayQuery::create()
                        ->filterByPrimaryKeys($this->tPayboxPaysScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tPayboxPaysScheduledForDeletion = null;
                }
            }

            if ($this->collTPayboxPays !== null) {
                foreach ($this->collTPayboxPays as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tPurchasePursRelatedByUsrIdBuyerScheduledForDeletion !== null) {
                if (!$this->tPurchasePursRelatedByUsrIdBuyerScheduledForDeletion->isEmpty()) {
                    TPurchasePurQuery::create()
                        ->filterByPrimaryKeys($this->tPurchasePursRelatedByUsrIdBuyerScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tPurchasePursRelatedByUsrIdBuyerScheduledForDeletion = null;
                }
            }

            if ($this->collTPurchasePursRelatedByUsrIdBuyer !== null) {
                foreach ($this->collTPurchasePursRelatedByUsrIdBuyer as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tPurchasePursRelatedByUsrIdSellerScheduledForDeletion !== null) {
                if (!$this->tPurchasePursRelatedByUsrIdSellerScheduledForDeletion->isEmpty()) {
                    TPurchasePurQuery::create()
                        ->filterByPrimaryKeys($this->tPurchasePursRelatedByUsrIdSellerScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tPurchasePursRelatedByUsrIdSellerScheduledForDeletion = null;
                }
            }

            if ($this->collTPurchasePursRelatedByUsrIdSeller !== null) {
                foreach ($this->collTPurchasePursRelatedByUsrIdSeller as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tRechargeRecsRelatedByUsrIdBuyerScheduledForDeletion !== null) {
                if (!$this->tRechargeRecsRelatedByUsrIdBuyerScheduledForDeletion->isEmpty()) {
                    TRechargeRecQuery::create()
                        ->filterByPrimaryKeys($this->tRechargeRecsRelatedByUsrIdBuyerScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tRechargeRecsRelatedByUsrIdBuyerScheduledForDeletion = null;
                }
            }

            if ($this->collTRechargeRecsRelatedByUsrIdBuyer !== null) {
                foreach ($this->collTRechargeRecsRelatedByUsrIdBuyer as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tRechargeRecsRelatedByUsrIdOperatorScheduledForDeletion !== null) {
                if (!$this->tRechargeRecsRelatedByUsrIdOperatorScheduledForDeletion->isEmpty()) {
                    TRechargeRecQuery::create()
                        ->filterByPrimaryKeys($this->tRechargeRecsRelatedByUsrIdOperatorScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tRechargeRecsRelatedByUsrIdOperatorScheduledForDeletion = null;
                }
            }

            if ($this->collTRechargeRecsRelatedByUsrIdOperator !== null) {
                foreach ($this->collTRechargeRecsRelatedByUsrIdOperator as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tSherlocksShesScheduledForDeletion !== null) {
                if (!$this->tSherlocksShesScheduledForDeletion->isEmpty()) {
                    TSherlocksSheQuery::create()
                        ->filterByPrimaryKeys($this->tSherlocksShesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tSherlocksShesScheduledForDeletion = null;
                }
            }

            if ($this->collTSherlocksShes !== null) {
                foreach ($this->collTSherlocksShes as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tVirementVirsRelatedByUsrIdToScheduledForDeletion !== null) {
                if (!$this->tVirementVirsRelatedByUsrIdToScheduledForDeletion->isEmpty()) {
                    TVirementVirQuery::create()
                        ->filterByPrimaryKeys($this->tVirementVirsRelatedByUsrIdToScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tVirementVirsRelatedByUsrIdToScheduledForDeletion = null;
                }
            }

            if ($this->collTVirementVirsRelatedByUsrIdTo !== null) {
                foreach ($this->collTVirementVirsRelatedByUsrIdTo as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tVirementVirsRelatedByUsrIdFromScheduledForDeletion !== null) {
                if (!$this->tVirementVirsRelatedByUsrIdFromScheduledForDeletion->isEmpty()) {
                    TVirementVirQuery::create()
                        ->filterByPrimaryKeys($this->tVirementVirsRelatedByUsrIdFromScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tVirementVirsRelatedByUsrIdFromScheduledForDeletion = null;
                }
            }

            if ($this->collTVirementVirsRelatedByUsrIdFrom !== null) {
                foreach ($this->collTVirementVirsRelatedByUsrIdFrom as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tjUsrGrpJugsScheduledForDeletion !== null) {
                if (!$this->tjUsrGrpJugsScheduledForDeletion->isEmpty()) {
                    TjUsrGrpJugQuery::create()
                        ->filterByPrimaryKeys($this->tjUsrGrpJugsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tjUsrGrpJugsScheduledForDeletion = null;
                }
            }

            if ($this->collTjUsrGrpJugs !== null) {
                foreach ($this->collTjUsrGrpJugs as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tjUsrMolJumsScheduledForDeletion !== null) {
                if (!$this->tjUsrMolJumsScheduledForDeletion->isEmpty()) {
                    TjUsrMolJumQuery::create()
                        ->filterByPrimaryKeys($this->tjUsrMolJumsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tjUsrMolJumsScheduledForDeletion = null;
                }
            }

            if ($this->collTjUsrMolJums !== null) {
                foreach ($this->collTjUsrMolJums as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tjUsrRigJursScheduledForDeletion !== null) {
                if (!$this->tjUsrRigJursScheduledForDeletion->isEmpty()) {
                    foreach ($this->tjUsrRigJursScheduledForDeletion as $tjUsrRigJur) {
                        // need to save related object because we set the relation to null
                        $tjUsrRigJur->save($con);
                    }
                    $this->tjUsrRigJursScheduledForDeletion = null;
                }
            }

            if ($this->collTjUsrRigJurs !== null) {
                foreach ($this->collTjUsrRigJurs as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = TsUserUsrPeer::USR_ID;
        if (null !== $this->usr_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TsUserUsrPeer::USR_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TsUserUsrPeer::USR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ID`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::USR_PWD)) {
            $modifiedColumns[':p' . $index++]  = '`USR_PWD`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::USR_FIRSTNAME)) {
            $modifiedColumns[':p' . $index++]  = '`USR_FIRSTNAME`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::USR_LASTNAME)) {
            $modifiedColumns[':p' . $index++]  = '`USR_LASTNAME`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::USR_NICKNAME)) {
            $modifiedColumns[':p' . $index++]  = '`USR_NICKNAME`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::USR_ADULT)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ADULT`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::USR_MAIL)) {
            $modifiedColumns[':p' . $index++]  = '`USR_MAIL`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::USR_CREDIT)) {
            $modifiedColumns[':p' . $index++]  = '`USR_CREDIT`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::IMG_ID)) {
            $modifiedColumns[':p' . $index++]  = '`IMG_ID`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::USR_TEMPORARY)) {
            $modifiedColumns[':p' . $index++]  = '`USR_TEMPORARY`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::USR_FAIL_AUTH)) {
            $modifiedColumns[':p' . $index++]  = '`USR_FAIL_AUTH`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::USR_BLOCKED)) {
            $modifiedColumns[':p' . $index++]  = '`USR_BLOCKED`';
        }
        if ($this->isColumnModified(TsUserUsrPeer::USR_MSG_PERSO)) {
            $modifiedColumns[':p' . $index++]  = '`USR_MSG_PERSO`';
        }

        $sql = sprintf(
            'INSERT INTO `ts_user_usr` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`USR_ID`':
                        $stmt->bindValue($identifier, $this->usr_id, PDO::PARAM_INT);
                        break;
                    case '`USR_PWD`':
                        $stmt->bindValue($identifier, $this->usr_pwd, PDO::PARAM_STR);
                        break;
                    case '`USR_FIRSTNAME`':
                        $stmt->bindValue($identifier, $this->usr_firstname, PDO::PARAM_STR);
                        break;
                    case '`USR_LASTNAME`':
                        $stmt->bindValue($identifier, $this->usr_lastname, PDO::PARAM_STR);
                        break;
                    case '`USR_NICKNAME`':
                        $stmt->bindValue($identifier, $this->usr_nickname, PDO::PARAM_STR);
                        break;
                    case '`USR_ADULT`':
                        $stmt->bindValue($identifier, $this->usr_adult, PDO::PARAM_INT);
                        break;
                    case '`USR_MAIL`':
                        $stmt->bindValue($identifier, $this->usr_mail, PDO::PARAM_STR);
                        break;
                    case '`USR_CREDIT`':
                        $stmt->bindValue($identifier, $this->usr_credit, PDO::PARAM_INT);
                        break;
                    case '`IMG_ID`':
                        $stmt->bindValue($identifier, $this->img_id, PDO::PARAM_INT);
                        break;
                    case '`USR_TEMPORARY`':
                        $stmt->bindValue($identifier, (int) $this->usr_temporary, PDO::PARAM_INT);
                        break;
                    case '`USR_FAIL_AUTH`':
                        $stmt->bindValue($identifier, (int) $this->usr_fail_auth, PDO::PARAM_INT);
                        break;
                    case '`USR_BLOCKED`':
                        $stmt->bindValue($identifier, (int) $this->usr_blocked, PDO::PARAM_INT);
                        break;
                    case '`USR_MSG_PERSO`':
                        $stmt->bindValue($identifier, $this->usr_msg_perso, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        } else {
            $this->validationFailures = $res;

            return false;
        }
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aTsImageImg !== null) {
                if (!$this->aTsImageImg->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTsImageImg->getValidationFailures());
                }
            }


            if (($retval = TsUserUsrPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collTPayboxPays !== null) {
                    foreach ($this->collTPayboxPays as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTPurchasePursRelatedByUsrIdBuyer !== null) {
                    foreach ($this->collTPurchasePursRelatedByUsrIdBuyer as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTPurchasePursRelatedByUsrIdSeller !== null) {
                    foreach ($this->collTPurchasePursRelatedByUsrIdSeller as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTRechargeRecsRelatedByUsrIdBuyer !== null) {
                    foreach ($this->collTRechargeRecsRelatedByUsrIdBuyer as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTRechargeRecsRelatedByUsrIdOperator !== null) {
                    foreach ($this->collTRechargeRecsRelatedByUsrIdOperator as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTSherlocksShes !== null) {
                    foreach ($this->collTSherlocksShes as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTVirementVirsRelatedByUsrIdTo !== null) {
                    foreach ($this->collTVirementVirsRelatedByUsrIdTo as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTVirementVirsRelatedByUsrIdFrom !== null) {
                    foreach ($this->collTVirementVirsRelatedByUsrIdFrom as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTjUsrGrpJugs !== null) {
                    foreach ($this->collTjUsrGrpJugs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTjUsrMolJums !== null) {
                    foreach ($this->collTjUsrMolJums as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTjUsrRigJurs !== null) {
                    foreach ($this->collTjUsrRigJurs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = TsUserUsrPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getPwd();
                break;
            case 2:
                return $this->getFirstname();
                break;
            case 3:
                return $this->getLastname();
                break;
            case 4:
                return $this->getNickname();
                break;
            case 5:
                return $this->getAdult();
                break;
            case 6:
                return $this->getMail();
                break;
            case 7:
                return $this->getCredit();
                break;
            case 8:
                return $this->getImgId();
                break;
            case 9:
                return $this->getTemporary();
                break;
            case 10:
                return $this->getFailAuth();
                break;
            case 11:
                return $this->getBlocked();
                break;
            case 12:
                return $this->getMsgPerso();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['TsUserUsr'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TsUserUsr'][$this->getPrimaryKey()] = true;
        $keys = TsUserUsrPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPwd(),
            $keys[2] => $this->getFirstname(),
            $keys[3] => $this->getLastname(),
            $keys[4] => $this->getNickname(),
            $keys[5] => $this->getAdult(),
            $keys[6] => $this->getMail(),
            $keys[7] => $this->getCredit(),
            $keys[8] => $this->getImgId(),
            $keys[9] => $this->getTemporary(),
            $keys[10] => $this->getFailAuth(),
            $keys[11] => $this->getBlocked(),
            $keys[12] => $this->getMsgPerso(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTsImageImg) {
                $result['TsImageImg'] = $this->aTsImageImg->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collTPayboxPays) {
                $result['TPayboxPays'] = $this->collTPayboxPays->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTPurchasePursRelatedByUsrIdBuyer) {
                $result['TPurchasePursRelatedByUsrIdBuyer'] = $this->collTPurchasePursRelatedByUsrIdBuyer->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTPurchasePursRelatedByUsrIdSeller) {
                $result['TPurchasePursRelatedByUsrIdSeller'] = $this->collTPurchasePursRelatedByUsrIdSeller->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTRechargeRecsRelatedByUsrIdBuyer) {
                $result['TRechargeRecsRelatedByUsrIdBuyer'] = $this->collTRechargeRecsRelatedByUsrIdBuyer->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTRechargeRecsRelatedByUsrIdOperator) {
                $result['TRechargeRecsRelatedByUsrIdOperator'] = $this->collTRechargeRecsRelatedByUsrIdOperator->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTSherlocksShes) {
                $result['TSherlocksShes'] = $this->collTSherlocksShes->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTVirementVirsRelatedByUsrIdTo) {
                $result['TVirementVirsRelatedByUsrIdTo'] = $this->collTVirementVirsRelatedByUsrIdTo->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTVirementVirsRelatedByUsrIdFrom) {
                $result['TVirementVirsRelatedByUsrIdFrom'] = $this->collTVirementVirsRelatedByUsrIdFrom->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTjUsrGrpJugs) {
                $result['TjUsrGrpJugs'] = $this->collTjUsrGrpJugs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTjUsrMolJums) {
                $result['TjUsrMolJums'] = $this->collTjUsrMolJums->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTjUsrRigJurs) {
                $result['TjUsrRigJurs'] = $this->collTjUsrRigJurs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = TsUserUsrPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPwd($value);
                break;
            case 2:
                $this->setFirstname($value);
                break;
            case 3:
                $this->setLastname($value);
                break;
            case 4:
                $this->setNickname($value);
                break;
            case 5:
                $this->setAdult($value);
                break;
            case 6:
                $this->setMail($value);
                break;
            case 7:
                $this->setCredit($value);
                break;
            case 8:
                $this->setImgId($value);
                break;
            case 9:
                $this->setTemporary($value);
                break;
            case 10:
                $this->setFailAuth($value);
                break;
            case 11:
                $this->setBlocked($value);
                break;
            case 12:
                $this->setMsgPerso($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = TsUserUsrPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setPwd($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setFirstname($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setLastname($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setNickname($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setAdult($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setMail($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCredit($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setImgId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setTemporary($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setFailAuth($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setBlocked($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setMsgPerso($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TsUserUsrPeer::DATABASE_NAME);

        if ($this->isColumnModified(TsUserUsrPeer::USR_ID)) $criteria->add(TsUserUsrPeer::USR_ID, $this->usr_id);
        if ($this->isColumnModified(TsUserUsrPeer::USR_PWD)) $criteria->add(TsUserUsrPeer::USR_PWD, $this->usr_pwd);
        if ($this->isColumnModified(TsUserUsrPeer::USR_FIRSTNAME)) $criteria->add(TsUserUsrPeer::USR_FIRSTNAME, $this->usr_firstname);
        if ($this->isColumnModified(TsUserUsrPeer::USR_LASTNAME)) $criteria->add(TsUserUsrPeer::USR_LASTNAME, $this->usr_lastname);
        if ($this->isColumnModified(TsUserUsrPeer::USR_NICKNAME)) $criteria->add(TsUserUsrPeer::USR_NICKNAME, $this->usr_nickname);
        if ($this->isColumnModified(TsUserUsrPeer::USR_ADULT)) $criteria->add(TsUserUsrPeer::USR_ADULT, $this->usr_adult);
        if ($this->isColumnModified(TsUserUsrPeer::USR_MAIL)) $criteria->add(TsUserUsrPeer::USR_MAIL, $this->usr_mail);
        if ($this->isColumnModified(TsUserUsrPeer::USR_CREDIT)) $criteria->add(TsUserUsrPeer::USR_CREDIT, $this->usr_credit);
        if ($this->isColumnModified(TsUserUsrPeer::IMG_ID)) $criteria->add(TsUserUsrPeer::IMG_ID, $this->img_id);
        if ($this->isColumnModified(TsUserUsrPeer::USR_TEMPORARY)) $criteria->add(TsUserUsrPeer::USR_TEMPORARY, $this->usr_temporary);
        if ($this->isColumnModified(TsUserUsrPeer::USR_FAIL_AUTH)) $criteria->add(TsUserUsrPeer::USR_FAIL_AUTH, $this->usr_fail_auth);
        if ($this->isColumnModified(TsUserUsrPeer::USR_BLOCKED)) $criteria->add(TsUserUsrPeer::USR_BLOCKED, $this->usr_blocked);
        if ($this->isColumnModified(TsUserUsrPeer::USR_MSG_PERSO)) $criteria->add(TsUserUsrPeer::USR_MSG_PERSO, $this->usr_msg_perso);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(TsUserUsrPeer::DATABASE_NAME);
        $criteria->add(TsUserUsrPeer::USR_ID, $this->usr_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (usr_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of TsUserUsr (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPwd($this->getPwd());
        $copyObj->setFirstname($this->getFirstname());
        $copyObj->setLastname($this->getLastname());
        $copyObj->setNickname($this->getNickname());
        $copyObj->setAdult($this->getAdult());
        $copyObj->setMail($this->getMail());
        $copyObj->setCredit($this->getCredit());
        $copyObj->setImgId($this->getImgId());
        $copyObj->setTemporary($this->getTemporary());
        $copyObj->setFailAuth($this->getFailAuth());
        $copyObj->setBlocked($this->getBlocked());
        $copyObj->setMsgPerso($this->getMsgPerso());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getTPayboxPays() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTPayboxPay($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTPurchasePursRelatedByUsrIdBuyer() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTPurchasePurRelatedByUsrIdBuyer($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTPurchasePursRelatedByUsrIdSeller() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTPurchasePurRelatedByUsrIdSeller($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTRechargeRecsRelatedByUsrIdBuyer() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTRechargeRecRelatedByUsrIdBuyer($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTRechargeRecsRelatedByUsrIdOperator() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTRechargeRecRelatedByUsrIdOperator($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTSherlocksShes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTSherlocksShe($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTVirementVirsRelatedByUsrIdTo() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTVirementVirRelatedByUsrIdTo($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTVirementVirsRelatedByUsrIdFrom() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTVirementVirRelatedByUsrIdFrom($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTjUsrGrpJugs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTjUsrGrpJug($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTjUsrMolJums() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTjUsrMolJum($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTjUsrRigJurs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTjUsrRigJur($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return TsUserUsr Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return TsUserUsrPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TsUserUsrPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TsImageImg object.
     *
     * @param             TsImageImg $v
     * @return TsUserUsr The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTsImageImg(TsImageImg $v = null)
    {
        if ($v === null) {
            $this->setImgId(NULL);
        } else {
            $this->setImgId($v->getId());
        }

        $this->aTsImageImg = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TsImageImg object, it will not be re-added.
        if ($v !== null) {
            $v->addTsUserUsr($this);
        }


        return $this;
    }


    /**
     * Get the associated TsImageImg object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TsImageImg The associated TsImageImg object.
     * @throws PropelException
     */
    public function getTsImageImg(PropelPDO $con = null)
    {
        if ($this->aTsImageImg === null && ($this->img_id !== null)) {
            $this->aTsImageImg = TsImageImgQuery::create()->findPk($this->img_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTsImageImg->addTsUserUsrs($this);
             */
        }

        return $this->aTsImageImg;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('TPayboxPay' == $relationName) {
            $this->initTPayboxPays();
        }
        if ('TPurchasePurRelatedByUsrIdBuyer' == $relationName) {
            $this->initTPurchasePursRelatedByUsrIdBuyer();
        }
        if ('TPurchasePurRelatedByUsrIdSeller' == $relationName) {
            $this->initTPurchasePursRelatedByUsrIdSeller();
        }
        if ('TRechargeRecRelatedByUsrIdBuyer' == $relationName) {
            $this->initTRechargeRecsRelatedByUsrIdBuyer();
        }
        if ('TRechargeRecRelatedByUsrIdOperator' == $relationName) {
            $this->initTRechargeRecsRelatedByUsrIdOperator();
        }
        if ('TSherlocksShe' == $relationName) {
            $this->initTSherlocksShes();
        }
        if ('TVirementVirRelatedByUsrIdTo' == $relationName) {
            $this->initTVirementVirsRelatedByUsrIdTo();
        }
        if ('TVirementVirRelatedByUsrIdFrom' == $relationName) {
            $this->initTVirementVirsRelatedByUsrIdFrom();
        }
        if ('TjUsrGrpJug' == $relationName) {
            $this->initTjUsrGrpJugs();
        }
        if ('TjUsrMolJum' == $relationName) {
            $this->initTjUsrMolJums();
        }
        if ('TjUsrRigJur' == $relationName) {
            $this->initTjUsrRigJurs();
        }
    }

    /**
     * Clears out the collTPayboxPays collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTPayboxPays()
     */
    public function clearTPayboxPays()
    {
        $this->collTPayboxPays = null; // important to set this to null since that means it is uninitialized
        $this->collTPayboxPaysPartial = null;
    }

    /**
     * reset is the collTPayboxPays collection loaded partially
     *
     * @return void
     */
    public function resetPartialTPayboxPays($v = true)
    {
        $this->collTPayboxPaysPartial = $v;
    }

    /**
     * Initializes the collTPayboxPays collection.
     *
     * By default this just sets the collTPayboxPays collection to an empty array (like clearcollTPayboxPays());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTPayboxPays($overrideExisting = true)
    {
        if (null !== $this->collTPayboxPays && !$overrideExisting) {
            return;
        }
        $this->collTPayboxPays = new PropelObjectCollection();
        $this->collTPayboxPays->setModel('TPayboxPay');
    }

    /**
     * Gets an array of TPayboxPay objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsUserUsr is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TPayboxPay[] List of TPayboxPay objects
     * @throws PropelException
     */
    public function getTPayboxPays($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTPayboxPaysPartial && !$this->isNew();
        if (null === $this->collTPayboxPays || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTPayboxPays) {
                // return empty collection
                $this->initTPayboxPays();
            } else {
                $collTPayboxPays = TPayboxPayQuery::create(null, $criteria)
                    ->filterByTsUserUsr($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTPayboxPaysPartial && count($collTPayboxPays)) {
                      $this->initTPayboxPays(false);

                      foreach($collTPayboxPays as $obj) {
                        if (false == $this->collTPayboxPays->contains($obj)) {
                          $this->collTPayboxPays->append($obj);
                        }
                      }

                      $this->collTPayboxPaysPartial = true;
                    }

                    return $collTPayboxPays;
                }

                if($partial && $this->collTPayboxPays) {
                    foreach($this->collTPayboxPays as $obj) {
                        if($obj->isNew()) {
                            $collTPayboxPays[] = $obj;
                        }
                    }
                }

                $this->collTPayboxPays = $collTPayboxPays;
                $this->collTPayboxPaysPartial = false;
            }
        }

        return $this->collTPayboxPays;
    }

    /**
     * Sets a collection of TPayboxPay objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tPayboxPays A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTPayboxPays(PropelCollection $tPayboxPays, PropelPDO $con = null)
    {
        $this->tPayboxPaysScheduledForDeletion = $this->getTPayboxPays(new Criteria(), $con)->diff($tPayboxPays);

        foreach ($this->tPayboxPaysScheduledForDeletion as $tPayboxPayRemoved) {
            $tPayboxPayRemoved->setTsUserUsr(null);
        }

        $this->collTPayboxPays = null;
        foreach ($tPayboxPays as $tPayboxPay) {
            $this->addTPayboxPay($tPayboxPay);
        }

        $this->collTPayboxPays = $tPayboxPays;
        $this->collTPayboxPaysPartial = false;
    }

    /**
     * Returns the number of related TPayboxPay objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TPayboxPay objects.
     * @throws PropelException
     */
    public function countTPayboxPays(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTPayboxPaysPartial && !$this->isNew();
        if (null === $this->collTPayboxPays || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTPayboxPays) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTPayboxPays());
                }
                $query = TPayboxPayQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsUserUsr($this)
                    ->count($con);
            }
        } else {
            return count($this->collTPayboxPays);
        }
    }

    /**
     * Method called to associate a TPayboxPay object to this object
     * through the TPayboxPay foreign key attribute.
     *
     * @param    TPayboxPay $l TPayboxPay
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function addTPayboxPay(TPayboxPay $l)
    {
        if ($this->collTPayboxPays === null) {
            $this->initTPayboxPays();
            $this->collTPayboxPaysPartial = true;
        }
        if (!in_array($l, $this->collTPayboxPays->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTPayboxPay($l);
        }

        return $this;
    }

    /**
     * @param	TPayboxPay $tPayboxPay The tPayboxPay object to add.
     */
    protected function doAddTPayboxPay($tPayboxPay)
    {
        $this->collTPayboxPays[]= $tPayboxPay;
        $tPayboxPay->setTsUserUsr($this);
    }

    /**
     * @param	TPayboxPay $tPayboxPay The tPayboxPay object to remove.
     */
    public function removeTPayboxPay($tPayboxPay)
    {
        if ($this->getTPayboxPays()->contains($tPayboxPay)) {
            $this->collTPayboxPays->remove($this->collTPayboxPays->search($tPayboxPay));
            if (null === $this->tPayboxPaysScheduledForDeletion) {
                $this->tPayboxPaysScheduledForDeletion = clone $this->collTPayboxPays;
                $this->tPayboxPaysScheduledForDeletion->clear();
            }
            $this->tPayboxPaysScheduledForDeletion[]= $tPayboxPay;
            $tPayboxPay->setTsUserUsr(null);
        }
    }

    /**
     * Clears out the collTPurchasePursRelatedByUsrIdBuyer collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTPurchasePursRelatedByUsrIdBuyer()
     */
    public function clearTPurchasePursRelatedByUsrIdBuyer()
    {
        $this->collTPurchasePursRelatedByUsrIdBuyer = null; // important to set this to null since that means it is uninitialized
        $this->collTPurchasePursRelatedByUsrIdBuyerPartial = null;
    }

    /**
     * reset is the collTPurchasePursRelatedByUsrIdBuyer collection loaded partially
     *
     * @return void
     */
    public function resetPartialTPurchasePursRelatedByUsrIdBuyer($v = true)
    {
        $this->collTPurchasePursRelatedByUsrIdBuyerPartial = $v;
    }

    /**
     * Initializes the collTPurchasePursRelatedByUsrIdBuyer collection.
     *
     * By default this just sets the collTPurchasePursRelatedByUsrIdBuyer collection to an empty array (like clearcollTPurchasePursRelatedByUsrIdBuyer());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTPurchasePursRelatedByUsrIdBuyer($overrideExisting = true)
    {
        if (null !== $this->collTPurchasePursRelatedByUsrIdBuyer && !$overrideExisting) {
            return;
        }
        $this->collTPurchasePursRelatedByUsrIdBuyer = new PropelObjectCollection();
        $this->collTPurchasePursRelatedByUsrIdBuyer->setModel('TPurchasePur');
    }

    /**
     * Gets an array of TPurchasePur objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsUserUsr is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     * @throws PropelException
     */
    public function getTPurchasePursRelatedByUsrIdBuyer($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTPurchasePursRelatedByUsrIdBuyerPartial && !$this->isNew();
        if (null === $this->collTPurchasePursRelatedByUsrIdBuyer || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTPurchasePursRelatedByUsrIdBuyer) {
                // return empty collection
                $this->initTPurchasePursRelatedByUsrIdBuyer();
            } else {
                $collTPurchasePursRelatedByUsrIdBuyer = TPurchasePurQuery::create(null, $criteria)
                    ->filterByTsUserUsrRelatedByUsrIdBuyer($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTPurchasePursRelatedByUsrIdBuyerPartial && count($collTPurchasePursRelatedByUsrIdBuyer)) {
                      $this->initTPurchasePursRelatedByUsrIdBuyer(false);

                      foreach($collTPurchasePursRelatedByUsrIdBuyer as $obj) {
                        if (false == $this->collTPurchasePursRelatedByUsrIdBuyer->contains($obj)) {
                          $this->collTPurchasePursRelatedByUsrIdBuyer->append($obj);
                        }
                      }

                      $this->collTPurchasePursRelatedByUsrIdBuyerPartial = true;
                    }

                    return $collTPurchasePursRelatedByUsrIdBuyer;
                }

                if($partial && $this->collTPurchasePursRelatedByUsrIdBuyer) {
                    foreach($this->collTPurchasePursRelatedByUsrIdBuyer as $obj) {
                        if($obj->isNew()) {
                            $collTPurchasePursRelatedByUsrIdBuyer[] = $obj;
                        }
                    }
                }

                $this->collTPurchasePursRelatedByUsrIdBuyer = $collTPurchasePursRelatedByUsrIdBuyer;
                $this->collTPurchasePursRelatedByUsrIdBuyerPartial = false;
            }
        }

        return $this->collTPurchasePursRelatedByUsrIdBuyer;
    }

    /**
     * Sets a collection of TPurchasePurRelatedByUsrIdBuyer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tPurchasePursRelatedByUsrIdBuyer A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTPurchasePursRelatedByUsrIdBuyer(PropelCollection $tPurchasePursRelatedByUsrIdBuyer, PropelPDO $con = null)
    {
        $this->tPurchasePursRelatedByUsrIdBuyerScheduledForDeletion = $this->getTPurchasePursRelatedByUsrIdBuyer(new Criteria(), $con)->diff($tPurchasePursRelatedByUsrIdBuyer);

        foreach ($this->tPurchasePursRelatedByUsrIdBuyerScheduledForDeletion as $tPurchasePurRelatedByUsrIdBuyerRemoved) {
            $tPurchasePurRelatedByUsrIdBuyerRemoved->setTsUserUsrRelatedByUsrIdBuyer(null);
        }

        $this->collTPurchasePursRelatedByUsrIdBuyer = null;
        foreach ($tPurchasePursRelatedByUsrIdBuyer as $tPurchasePurRelatedByUsrIdBuyer) {
            $this->addTPurchasePurRelatedByUsrIdBuyer($tPurchasePurRelatedByUsrIdBuyer);
        }

        $this->collTPurchasePursRelatedByUsrIdBuyer = $tPurchasePursRelatedByUsrIdBuyer;
        $this->collTPurchasePursRelatedByUsrIdBuyerPartial = false;
    }

    /**
     * Returns the number of related TPurchasePur objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TPurchasePur objects.
     * @throws PropelException
     */
    public function countTPurchasePursRelatedByUsrIdBuyer(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTPurchasePursRelatedByUsrIdBuyerPartial && !$this->isNew();
        if (null === $this->collTPurchasePursRelatedByUsrIdBuyer || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTPurchasePursRelatedByUsrIdBuyer) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTPurchasePursRelatedByUsrIdBuyer());
                }
                $query = TPurchasePurQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsUserUsrRelatedByUsrIdBuyer($this)
                    ->count($con);
            }
        } else {
            return count($this->collTPurchasePursRelatedByUsrIdBuyer);
        }
    }

    /**
     * Method called to associate a TPurchasePur object to this object
     * through the TPurchasePur foreign key attribute.
     *
     * @param    TPurchasePur $l TPurchasePur
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function addTPurchasePurRelatedByUsrIdBuyer(TPurchasePur $l)
    {
        if ($this->collTPurchasePursRelatedByUsrIdBuyer === null) {
            $this->initTPurchasePursRelatedByUsrIdBuyer();
            $this->collTPurchasePursRelatedByUsrIdBuyerPartial = true;
        }
        if (!in_array($l, $this->collTPurchasePursRelatedByUsrIdBuyer->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTPurchasePurRelatedByUsrIdBuyer($l);
        }

        return $this;
    }

    /**
     * @param	TPurchasePurRelatedByUsrIdBuyer $tPurchasePurRelatedByUsrIdBuyer The tPurchasePurRelatedByUsrIdBuyer object to add.
     */
    protected function doAddTPurchasePurRelatedByUsrIdBuyer($tPurchasePurRelatedByUsrIdBuyer)
    {
        $this->collTPurchasePursRelatedByUsrIdBuyer[]= $tPurchasePurRelatedByUsrIdBuyer;
        $tPurchasePurRelatedByUsrIdBuyer->setTsUserUsrRelatedByUsrIdBuyer($this);
    }

    /**
     * @param	TPurchasePurRelatedByUsrIdBuyer $tPurchasePurRelatedByUsrIdBuyer The tPurchasePurRelatedByUsrIdBuyer object to remove.
     */
    public function removeTPurchasePurRelatedByUsrIdBuyer($tPurchasePurRelatedByUsrIdBuyer)
    {
        if ($this->getTPurchasePursRelatedByUsrIdBuyer()->contains($tPurchasePurRelatedByUsrIdBuyer)) {
            $this->collTPurchasePursRelatedByUsrIdBuyer->remove($this->collTPurchasePursRelatedByUsrIdBuyer->search($tPurchasePurRelatedByUsrIdBuyer));
            if (null === $this->tPurchasePursRelatedByUsrIdBuyerScheduledForDeletion) {
                $this->tPurchasePursRelatedByUsrIdBuyerScheduledForDeletion = clone $this->collTPurchasePursRelatedByUsrIdBuyer;
                $this->tPurchasePursRelatedByUsrIdBuyerScheduledForDeletion->clear();
            }
            $this->tPurchasePursRelatedByUsrIdBuyerScheduledForDeletion[]= $tPurchasePurRelatedByUsrIdBuyer;
            $tPurchasePurRelatedByUsrIdBuyer->setTsUserUsrRelatedByUsrIdBuyer(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TPurchasePursRelatedByUsrIdBuyer from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursRelatedByUsrIdBuyerJoinTObjectObj($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TObjectObj', $join_behavior);

        return $this->getTPurchasePursRelatedByUsrIdBuyer($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TPurchasePursRelatedByUsrIdBuyer from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursRelatedByUsrIdBuyerJoinTPointPoi($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TPointPoi', $join_behavior);

        return $this->getTPurchasePursRelatedByUsrIdBuyer($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TPurchasePursRelatedByUsrIdBuyer from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursRelatedByUsrIdBuyerJoinTFundationFun($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TFundationFun', $join_behavior);

        return $this->getTPurchasePursRelatedByUsrIdBuyer($query, $con);
    }

    /**
     * Clears out the collTPurchasePursRelatedByUsrIdSeller collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTPurchasePursRelatedByUsrIdSeller()
     */
    public function clearTPurchasePursRelatedByUsrIdSeller()
    {
        $this->collTPurchasePursRelatedByUsrIdSeller = null; // important to set this to null since that means it is uninitialized
        $this->collTPurchasePursRelatedByUsrIdSellerPartial = null;
    }

    /**
     * reset is the collTPurchasePursRelatedByUsrIdSeller collection loaded partially
     *
     * @return void
     */
    public function resetPartialTPurchasePursRelatedByUsrIdSeller($v = true)
    {
        $this->collTPurchasePursRelatedByUsrIdSellerPartial = $v;
    }

    /**
     * Initializes the collTPurchasePursRelatedByUsrIdSeller collection.
     *
     * By default this just sets the collTPurchasePursRelatedByUsrIdSeller collection to an empty array (like clearcollTPurchasePursRelatedByUsrIdSeller());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTPurchasePursRelatedByUsrIdSeller($overrideExisting = true)
    {
        if (null !== $this->collTPurchasePursRelatedByUsrIdSeller && !$overrideExisting) {
            return;
        }
        $this->collTPurchasePursRelatedByUsrIdSeller = new PropelObjectCollection();
        $this->collTPurchasePursRelatedByUsrIdSeller->setModel('TPurchasePur');
    }

    /**
     * Gets an array of TPurchasePur objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsUserUsr is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     * @throws PropelException
     */
    public function getTPurchasePursRelatedByUsrIdSeller($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTPurchasePursRelatedByUsrIdSellerPartial && !$this->isNew();
        if (null === $this->collTPurchasePursRelatedByUsrIdSeller || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTPurchasePursRelatedByUsrIdSeller) {
                // return empty collection
                $this->initTPurchasePursRelatedByUsrIdSeller();
            } else {
                $collTPurchasePursRelatedByUsrIdSeller = TPurchasePurQuery::create(null, $criteria)
                    ->filterByTsUserUsrRelatedByUsrIdSeller($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTPurchasePursRelatedByUsrIdSellerPartial && count($collTPurchasePursRelatedByUsrIdSeller)) {
                      $this->initTPurchasePursRelatedByUsrIdSeller(false);

                      foreach($collTPurchasePursRelatedByUsrIdSeller as $obj) {
                        if (false == $this->collTPurchasePursRelatedByUsrIdSeller->contains($obj)) {
                          $this->collTPurchasePursRelatedByUsrIdSeller->append($obj);
                        }
                      }

                      $this->collTPurchasePursRelatedByUsrIdSellerPartial = true;
                    }

                    return $collTPurchasePursRelatedByUsrIdSeller;
                }

                if($partial && $this->collTPurchasePursRelatedByUsrIdSeller) {
                    foreach($this->collTPurchasePursRelatedByUsrIdSeller as $obj) {
                        if($obj->isNew()) {
                            $collTPurchasePursRelatedByUsrIdSeller[] = $obj;
                        }
                    }
                }

                $this->collTPurchasePursRelatedByUsrIdSeller = $collTPurchasePursRelatedByUsrIdSeller;
                $this->collTPurchasePursRelatedByUsrIdSellerPartial = false;
            }
        }

        return $this->collTPurchasePursRelatedByUsrIdSeller;
    }

    /**
     * Sets a collection of TPurchasePurRelatedByUsrIdSeller objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tPurchasePursRelatedByUsrIdSeller A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTPurchasePursRelatedByUsrIdSeller(PropelCollection $tPurchasePursRelatedByUsrIdSeller, PropelPDO $con = null)
    {
        $this->tPurchasePursRelatedByUsrIdSellerScheduledForDeletion = $this->getTPurchasePursRelatedByUsrIdSeller(new Criteria(), $con)->diff($tPurchasePursRelatedByUsrIdSeller);

        foreach ($this->tPurchasePursRelatedByUsrIdSellerScheduledForDeletion as $tPurchasePurRelatedByUsrIdSellerRemoved) {
            $tPurchasePurRelatedByUsrIdSellerRemoved->setTsUserUsrRelatedByUsrIdSeller(null);
        }

        $this->collTPurchasePursRelatedByUsrIdSeller = null;
        foreach ($tPurchasePursRelatedByUsrIdSeller as $tPurchasePurRelatedByUsrIdSeller) {
            $this->addTPurchasePurRelatedByUsrIdSeller($tPurchasePurRelatedByUsrIdSeller);
        }

        $this->collTPurchasePursRelatedByUsrIdSeller = $tPurchasePursRelatedByUsrIdSeller;
        $this->collTPurchasePursRelatedByUsrIdSellerPartial = false;
    }

    /**
     * Returns the number of related TPurchasePur objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TPurchasePur objects.
     * @throws PropelException
     */
    public function countTPurchasePursRelatedByUsrIdSeller(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTPurchasePursRelatedByUsrIdSellerPartial && !$this->isNew();
        if (null === $this->collTPurchasePursRelatedByUsrIdSeller || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTPurchasePursRelatedByUsrIdSeller) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTPurchasePursRelatedByUsrIdSeller());
                }
                $query = TPurchasePurQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsUserUsrRelatedByUsrIdSeller($this)
                    ->count($con);
            }
        } else {
            return count($this->collTPurchasePursRelatedByUsrIdSeller);
        }
    }

    /**
     * Method called to associate a TPurchasePur object to this object
     * through the TPurchasePur foreign key attribute.
     *
     * @param    TPurchasePur $l TPurchasePur
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function addTPurchasePurRelatedByUsrIdSeller(TPurchasePur $l)
    {
        if ($this->collTPurchasePursRelatedByUsrIdSeller === null) {
            $this->initTPurchasePursRelatedByUsrIdSeller();
            $this->collTPurchasePursRelatedByUsrIdSellerPartial = true;
        }
        if (!in_array($l, $this->collTPurchasePursRelatedByUsrIdSeller->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTPurchasePurRelatedByUsrIdSeller($l);
        }

        return $this;
    }

    /**
     * @param	TPurchasePurRelatedByUsrIdSeller $tPurchasePurRelatedByUsrIdSeller The tPurchasePurRelatedByUsrIdSeller object to add.
     */
    protected function doAddTPurchasePurRelatedByUsrIdSeller($tPurchasePurRelatedByUsrIdSeller)
    {
        $this->collTPurchasePursRelatedByUsrIdSeller[]= $tPurchasePurRelatedByUsrIdSeller;
        $tPurchasePurRelatedByUsrIdSeller->setTsUserUsrRelatedByUsrIdSeller($this);
    }

    /**
     * @param	TPurchasePurRelatedByUsrIdSeller $tPurchasePurRelatedByUsrIdSeller The tPurchasePurRelatedByUsrIdSeller object to remove.
     */
    public function removeTPurchasePurRelatedByUsrIdSeller($tPurchasePurRelatedByUsrIdSeller)
    {
        if ($this->getTPurchasePursRelatedByUsrIdSeller()->contains($tPurchasePurRelatedByUsrIdSeller)) {
            $this->collTPurchasePursRelatedByUsrIdSeller->remove($this->collTPurchasePursRelatedByUsrIdSeller->search($tPurchasePurRelatedByUsrIdSeller));
            if (null === $this->tPurchasePursRelatedByUsrIdSellerScheduledForDeletion) {
                $this->tPurchasePursRelatedByUsrIdSellerScheduledForDeletion = clone $this->collTPurchasePursRelatedByUsrIdSeller;
                $this->tPurchasePursRelatedByUsrIdSellerScheduledForDeletion->clear();
            }
            $this->tPurchasePursRelatedByUsrIdSellerScheduledForDeletion[]= $tPurchasePurRelatedByUsrIdSeller;
            $tPurchasePurRelatedByUsrIdSeller->setTsUserUsrRelatedByUsrIdSeller(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TPurchasePursRelatedByUsrIdSeller from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursRelatedByUsrIdSellerJoinTObjectObj($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TObjectObj', $join_behavior);

        return $this->getTPurchasePursRelatedByUsrIdSeller($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TPurchasePursRelatedByUsrIdSeller from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursRelatedByUsrIdSellerJoinTPointPoi($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TPointPoi', $join_behavior);

        return $this->getTPurchasePursRelatedByUsrIdSeller($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TPurchasePursRelatedByUsrIdSeller from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursRelatedByUsrIdSellerJoinTFundationFun($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TFundationFun', $join_behavior);

        return $this->getTPurchasePursRelatedByUsrIdSeller($query, $con);
    }

    /**
     * Clears out the collTRechargeRecsRelatedByUsrIdBuyer collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTRechargeRecsRelatedByUsrIdBuyer()
     */
    public function clearTRechargeRecsRelatedByUsrIdBuyer()
    {
        $this->collTRechargeRecsRelatedByUsrIdBuyer = null; // important to set this to null since that means it is uninitialized
        $this->collTRechargeRecsRelatedByUsrIdBuyerPartial = null;
    }

    /**
     * reset is the collTRechargeRecsRelatedByUsrIdBuyer collection loaded partially
     *
     * @return void
     */
    public function resetPartialTRechargeRecsRelatedByUsrIdBuyer($v = true)
    {
        $this->collTRechargeRecsRelatedByUsrIdBuyerPartial = $v;
    }

    /**
     * Initializes the collTRechargeRecsRelatedByUsrIdBuyer collection.
     *
     * By default this just sets the collTRechargeRecsRelatedByUsrIdBuyer collection to an empty array (like clearcollTRechargeRecsRelatedByUsrIdBuyer());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTRechargeRecsRelatedByUsrIdBuyer($overrideExisting = true)
    {
        if (null !== $this->collTRechargeRecsRelatedByUsrIdBuyer && !$overrideExisting) {
            return;
        }
        $this->collTRechargeRecsRelatedByUsrIdBuyer = new PropelObjectCollection();
        $this->collTRechargeRecsRelatedByUsrIdBuyer->setModel('TRechargeRec');
    }

    /**
     * Gets an array of TRechargeRec objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsUserUsr is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TRechargeRec[] List of TRechargeRec objects
     * @throws PropelException
     */
    public function getTRechargeRecsRelatedByUsrIdBuyer($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTRechargeRecsRelatedByUsrIdBuyerPartial && !$this->isNew();
        if (null === $this->collTRechargeRecsRelatedByUsrIdBuyer || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTRechargeRecsRelatedByUsrIdBuyer) {
                // return empty collection
                $this->initTRechargeRecsRelatedByUsrIdBuyer();
            } else {
                $collTRechargeRecsRelatedByUsrIdBuyer = TRechargeRecQuery::create(null, $criteria)
                    ->filterByTsUserUsrRelatedByUsrIdBuyer($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTRechargeRecsRelatedByUsrIdBuyerPartial && count($collTRechargeRecsRelatedByUsrIdBuyer)) {
                      $this->initTRechargeRecsRelatedByUsrIdBuyer(false);

                      foreach($collTRechargeRecsRelatedByUsrIdBuyer as $obj) {
                        if (false == $this->collTRechargeRecsRelatedByUsrIdBuyer->contains($obj)) {
                          $this->collTRechargeRecsRelatedByUsrIdBuyer->append($obj);
                        }
                      }

                      $this->collTRechargeRecsRelatedByUsrIdBuyerPartial = true;
                    }

                    return $collTRechargeRecsRelatedByUsrIdBuyer;
                }

                if($partial && $this->collTRechargeRecsRelatedByUsrIdBuyer) {
                    foreach($this->collTRechargeRecsRelatedByUsrIdBuyer as $obj) {
                        if($obj->isNew()) {
                            $collTRechargeRecsRelatedByUsrIdBuyer[] = $obj;
                        }
                    }
                }

                $this->collTRechargeRecsRelatedByUsrIdBuyer = $collTRechargeRecsRelatedByUsrIdBuyer;
                $this->collTRechargeRecsRelatedByUsrIdBuyerPartial = false;
            }
        }

        return $this->collTRechargeRecsRelatedByUsrIdBuyer;
    }

    /**
     * Sets a collection of TRechargeRecRelatedByUsrIdBuyer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tRechargeRecsRelatedByUsrIdBuyer A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTRechargeRecsRelatedByUsrIdBuyer(PropelCollection $tRechargeRecsRelatedByUsrIdBuyer, PropelPDO $con = null)
    {
        $this->tRechargeRecsRelatedByUsrIdBuyerScheduledForDeletion = $this->getTRechargeRecsRelatedByUsrIdBuyer(new Criteria(), $con)->diff($tRechargeRecsRelatedByUsrIdBuyer);

        foreach ($this->tRechargeRecsRelatedByUsrIdBuyerScheduledForDeletion as $tRechargeRecRelatedByUsrIdBuyerRemoved) {
            $tRechargeRecRelatedByUsrIdBuyerRemoved->setTsUserUsrRelatedByUsrIdBuyer(null);
        }

        $this->collTRechargeRecsRelatedByUsrIdBuyer = null;
        foreach ($tRechargeRecsRelatedByUsrIdBuyer as $tRechargeRecRelatedByUsrIdBuyer) {
            $this->addTRechargeRecRelatedByUsrIdBuyer($tRechargeRecRelatedByUsrIdBuyer);
        }

        $this->collTRechargeRecsRelatedByUsrIdBuyer = $tRechargeRecsRelatedByUsrIdBuyer;
        $this->collTRechargeRecsRelatedByUsrIdBuyerPartial = false;
    }

    /**
     * Returns the number of related TRechargeRec objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TRechargeRec objects.
     * @throws PropelException
     */
    public function countTRechargeRecsRelatedByUsrIdBuyer(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTRechargeRecsRelatedByUsrIdBuyerPartial && !$this->isNew();
        if (null === $this->collTRechargeRecsRelatedByUsrIdBuyer || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTRechargeRecsRelatedByUsrIdBuyer) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTRechargeRecsRelatedByUsrIdBuyer());
                }
                $query = TRechargeRecQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsUserUsrRelatedByUsrIdBuyer($this)
                    ->count($con);
            }
        } else {
            return count($this->collTRechargeRecsRelatedByUsrIdBuyer);
        }
    }

    /**
     * Method called to associate a TRechargeRec object to this object
     * through the TRechargeRec foreign key attribute.
     *
     * @param    TRechargeRec $l TRechargeRec
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function addTRechargeRecRelatedByUsrIdBuyer(TRechargeRec $l)
    {
        if ($this->collTRechargeRecsRelatedByUsrIdBuyer === null) {
            $this->initTRechargeRecsRelatedByUsrIdBuyer();
            $this->collTRechargeRecsRelatedByUsrIdBuyerPartial = true;
        }
        if (!in_array($l, $this->collTRechargeRecsRelatedByUsrIdBuyer->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTRechargeRecRelatedByUsrIdBuyer($l);
        }

        return $this;
    }

    /**
     * @param	TRechargeRecRelatedByUsrIdBuyer $tRechargeRecRelatedByUsrIdBuyer The tRechargeRecRelatedByUsrIdBuyer object to add.
     */
    protected function doAddTRechargeRecRelatedByUsrIdBuyer($tRechargeRecRelatedByUsrIdBuyer)
    {
        $this->collTRechargeRecsRelatedByUsrIdBuyer[]= $tRechargeRecRelatedByUsrIdBuyer;
        $tRechargeRecRelatedByUsrIdBuyer->setTsUserUsrRelatedByUsrIdBuyer($this);
    }

    /**
     * @param	TRechargeRecRelatedByUsrIdBuyer $tRechargeRecRelatedByUsrIdBuyer The tRechargeRecRelatedByUsrIdBuyer object to remove.
     */
    public function removeTRechargeRecRelatedByUsrIdBuyer($tRechargeRecRelatedByUsrIdBuyer)
    {
        if ($this->getTRechargeRecsRelatedByUsrIdBuyer()->contains($tRechargeRecRelatedByUsrIdBuyer)) {
            $this->collTRechargeRecsRelatedByUsrIdBuyer->remove($this->collTRechargeRecsRelatedByUsrIdBuyer->search($tRechargeRecRelatedByUsrIdBuyer));
            if (null === $this->tRechargeRecsRelatedByUsrIdBuyerScheduledForDeletion) {
                $this->tRechargeRecsRelatedByUsrIdBuyerScheduledForDeletion = clone $this->collTRechargeRecsRelatedByUsrIdBuyer;
                $this->tRechargeRecsRelatedByUsrIdBuyerScheduledForDeletion->clear();
            }
            $this->tRechargeRecsRelatedByUsrIdBuyerScheduledForDeletion[]= $tRechargeRecRelatedByUsrIdBuyer;
            $tRechargeRecRelatedByUsrIdBuyer->setTsUserUsrRelatedByUsrIdBuyer(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TRechargeRecsRelatedByUsrIdBuyer from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TRechargeRec[] List of TRechargeRec objects
     */
    public function getTRechargeRecsRelatedByUsrIdBuyerJoinTPointPoi($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TRechargeRecQuery::create(null, $criteria);
        $query->joinWith('TPointPoi', $join_behavior);

        return $this->getTRechargeRecsRelatedByUsrIdBuyer($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TRechargeRecsRelatedByUsrIdBuyer from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TRechargeRec[] List of TRechargeRec objects
     */
    public function getTRechargeRecsRelatedByUsrIdBuyerJoinTRechargeTypeRty($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TRechargeRecQuery::create(null, $criteria);
        $query->joinWith('TRechargeTypeRty', $join_behavior);

        return $this->getTRechargeRecsRelatedByUsrIdBuyer($query, $con);
    }

    /**
     * Clears out the collTRechargeRecsRelatedByUsrIdOperator collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTRechargeRecsRelatedByUsrIdOperator()
     */
    public function clearTRechargeRecsRelatedByUsrIdOperator()
    {
        $this->collTRechargeRecsRelatedByUsrIdOperator = null; // important to set this to null since that means it is uninitialized
        $this->collTRechargeRecsRelatedByUsrIdOperatorPartial = null;
    }

    /**
     * reset is the collTRechargeRecsRelatedByUsrIdOperator collection loaded partially
     *
     * @return void
     */
    public function resetPartialTRechargeRecsRelatedByUsrIdOperator($v = true)
    {
        $this->collTRechargeRecsRelatedByUsrIdOperatorPartial = $v;
    }

    /**
     * Initializes the collTRechargeRecsRelatedByUsrIdOperator collection.
     *
     * By default this just sets the collTRechargeRecsRelatedByUsrIdOperator collection to an empty array (like clearcollTRechargeRecsRelatedByUsrIdOperator());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTRechargeRecsRelatedByUsrIdOperator($overrideExisting = true)
    {
        if (null !== $this->collTRechargeRecsRelatedByUsrIdOperator && !$overrideExisting) {
            return;
        }
        $this->collTRechargeRecsRelatedByUsrIdOperator = new PropelObjectCollection();
        $this->collTRechargeRecsRelatedByUsrIdOperator->setModel('TRechargeRec');
    }

    /**
     * Gets an array of TRechargeRec objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsUserUsr is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TRechargeRec[] List of TRechargeRec objects
     * @throws PropelException
     */
    public function getTRechargeRecsRelatedByUsrIdOperator($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTRechargeRecsRelatedByUsrIdOperatorPartial && !$this->isNew();
        if (null === $this->collTRechargeRecsRelatedByUsrIdOperator || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTRechargeRecsRelatedByUsrIdOperator) {
                // return empty collection
                $this->initTRechargeRecsRelatedByUsrIdOperator();
            } else {
                $collTRechargeRecsRelatedByUsrIdOperator = TRechargeRecQuery::create(null, $criteria)
                    ->filterByTsUserUsrRelatedByUsrIdOperator($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTRechargeRecsRelatedByUsrIdOperatorPartial && count($collTRechargeRecsRelatedByUsrIdOperator)) {
                      $this->initTRechargeRecsRelatedByUsrIdOperator(false);

                      foreach($collTRechargeRecsRelatedByUsrIdOperator as $obj) {
                        if (false == $this->collTRechargeRecsRelatedByUsrIdOperator->contains($obj)) {
                          $this->collTRechargeRecsRelatedByUsrIdOperator->append($obj);
                        }
                      }

                      $this->collTRechargeRecsRelatedByUsrIdOperatorPartial = true;
                    }

                    return $collTRechargeRecsRelatedByUsrIdOperator;
                }

                if($partial && $this->collTRechargeRecsRelatedByUsrIdOperator) {
                    foreach($this->collTRechargeRecsRelatedByUsrIdOperator as $obj) {
                        if($obj->isNew()) {
                            $collTRechargeRecsRelatedByUsrIdOperator[] = $obj;
                        }
                    }
                }

                $this->collTRechargeRecsRelatedByUsrIdOperator = $collTRechargeRecsRelatedByUsrIdOperator;
                $this->collTRechargeRecsRelatedByUsrIdOperatorPartial = false;
            }
        }

        return $this->collTRechargeRecsRelatedByUsrIdOperator;
    }

    /**
     * Sets a collection of TRechargeRecRelatedByUsrIdOperator objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tRechargeRecsRelatedByUsrIdOperator A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTRechargeRecsRelatedByUsrIdOperator(PropelCollection $tRechargeRecsRelatedByUsrIdOperator, PropelPDO $con = null)
    {
        $this->tRechargeRecsRelatedByUsrIdOperatorScheduledForDeletion = $this->getTRechargeRecsRelatedByUsrIdOperator(new Criteria(), $con)->diff($tRechargeRecsRelatedByUsrIdOperator);

        foreach ($this->tRechargeRecsRelatedByUsrIdOperatorScheduledForDeletion as $tRechargeRecRelatedByUsrIdOperatorRemoved) {
            $tRechargeRecRelatedByUsrIdOperatorRemoved->setTsUserUsrRelatedByUsrIdOperator(null);
        }

        $this->collTRechargeRecsRelatedByUsrIdOperator = null;
        foreach ($tRechargeRecsRelatedByUsrIdOperator as $tRechargeRecRelatedByUsrIdOperator) {
            $this->addTRechargeRecRelatedByUsrIdOperator($tRechargeRecRelatedByUsrIdOperator);
        }

        $this->collTRechargeRecsRelatedByUsrIdOperator = $tRechargeRecsRelatedByUsrIdOperator;
        $this->collTRechargeRecsRelatedByUsrIdOperatorPartial = false;
    }

    /**
     * Returns the number of related TRechargeRec objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TRechargeRec objects.
     * @throws PropelException
     */
    public function countTRechargeRecsRelatedByUsrIdOperator(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTRechargeRecsRelatedByUsrIdOperatorPartial && !$this->isNew();
        if (null === $this->collTRechargeRecsRelatedByUsrIdOperator || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTRechargeRecsRelatedByUsrIdOperator) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTRechargeRecsRelatedByUsrIdOperator());
                }
                $query = TRechargeRecQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsUserUsrRelatedByUsrIdOperator($this)
                    ->count($con);
            }
        } else {
            return count($this->collTRechargeRecsRelatedByUsrIdOperator);
        }
    }

    /**
     * Method called to associate a TRechargeRec object to this object
     * through the TRechargeRec foreign key attribute.
     *
     * @param    TRechargeRec $l TRechargeRec
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function addTRechargeRecRelatedByUsrIdOperator(TRechargeRec $l)
    {
        if ($this->collTRechargeRecsRelatedByUsrIdOperator === null) {
            $this->initTRechargeRecsRelatedByUsrIdOperator();
            $this->collTRechargeRecsRelatedByUsrIdOperatorPartial = true;
        }
        if (!in_array($l, $this->collTRechargeRecsRelatedByUsrIdOperator->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTRechargeRecRelatedByUsrIdOperator($l);
        }

        return $this;
    }

    /**
     * @param	TRechargeRecRelatedByUsrIdOperator $tRechargeRecRelatedByUsrIdOperator The tRechargeRecRelatedByUsrIdOperator object to add.
     */
    protected function doAddTRechargeRecRelatedByUsrIdOperator($tRechargeRecRelatedByUsrIdOperator)
    {
        $this->collTRechargeRecsRelatedByUsrIdOperator[]= $tRechargeRecRelatedByUsrIdOperator;
        $tRechargeRecRelatedByUsrIdOperator->setTsUserUsrRelatedByUsrIdOperator($this);
    }

    /**
     * @param	TRechargeRecRelatedByUsrIdOperator $tRechargeRecRelatedByUsrIdOperator The tRechargeRecRelatedByUsrIdOperator object to remove.
     */
    public function removeTRechargeRecRelatedByUsrIdOperator($tRechargeRecRelatedByUsrIdOperator)
    {
        if ($this->getTRechargeRecsRelatedByUsrIdOperator()->contains($tRechargeRecRelatedByUsrIdOperator)) {
            $this->collTRechargeRecsRelatedByUsrIdOperator->remove($this->collTRechargeRecsRelatedByUsrIdOperator->search($tRechargeRecRelatedByUsrIdOperator));
            if (null === $this->tRechargeRecsRelatedByUsrIdOperatorScheduledForDeletion) {
                $this->tRechargeRecsRelatedByUsrIdOperatorScheduledForDeletion = clone $this->collTRechargeRecsRelatedByUsrIdOperator;
                $this->tRechargeRecsRelatedByUsrIdOperatorScheduledForDeletion->clear();
            }
            $this->tRechargeRecsRelatedByUsrIdOperatorScheduledForDeletion[]= $tRechargeRecRelatedByUsrIdOperator;
            $tRechargeRecRelatedByUsrIdOperator->setTsUserUsrRelatedByUsrIdOperator(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TRechargeRecsRelatedByUsrIdOperator from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TRechargeRec[] List of TRechargeRec objects
     */
    public function getTRechargeRecsRelatedByUsrIdOperatorJoinTPointPoi($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TRechargeRecQuery::create(null, $criteria);
        $query->joinWith('TPointPoi', $join_behavior);

        return $this->getTRechargeRecsRelatedByUsrIdOperator($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TRechargeRecsRelatedByUsrIdOperator from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TRechargeRec[] List of TRechargeRec objects
     */
    public function getTRechargeRecsRelatedByUsrIdOperatorJoinTRechargeTypeRty($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TRechargeRecQuery::create(null, $criteria);
        $query->joinWith('TRechargeTypeRty', $join_behavior);

        return $this->getTRechargeRecsRelatedByUsrIdOperator($query, $con);
    }

    /**
     * Clears out the collTSherlocksShes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTSherlocksShes()
     */
    public function clearTSherlocksShes()
    {
        $this->collTSherlocksShes = null; // important to set this to null since that means it is uninitialized
        $this->collTSherlocksShesPartial = null;
    }

    /**
     * reset is the collTSherlocksShes collection loaded partially
     *
     * @return void
     */
    public function resetPartialTSherlocksShes($v = true)
    {
        $this->collTSherlocksShesPartial = $v;
    }

    /**
     * Initializes the collTSherlocksShes collection.
     *
     * By default this just sets the collTSherlocksShes collection to an empty array (like clearcollTSherlocksShes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTSherlocksShes($overrideExisting = true)
    {
        if (null !== $this->collTSherlocksShes && !$overrideExisting) {
            return;
        }
        $this->collTSherlocksShes = new PropelObjectCollection();
        $this->collTSherlocksShes->setModel('TSherlocksShe');
    }

    /**
     * Gets an array of TSherlocksShe objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsUserUsr is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TSherlocksShe[] List of TSherlocksShe objects
     * @throws PropelException
     */
    public function getTSherlocksShes($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTSherlocksShesPartial && !$this->isNew();
        if (null === $this->collTSherlocksShes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTSherlocksShes) {
                // return empty collection
                $this->initTSherlocksShes();
            } else {
                $collTSherlocksShes = TSherlocksSheQuery::create(null, $criteria)
                    ->filterByTsUserUsr($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTSherlocksShesPartial && count($collTSherlocksShes)) {
                      $this->initTSherlocksShes(false);

                      foreach($collTSherlocksShes as $obj) {
                        if (false == $this->collTSherlocksShes->contains($obj)) {
                          $this->collTSherlocksShes->append($obj);
                        }
                      }

                      $this->collTSherlocksShesPartial = true;
                    }

                    return $collTSherlocksShes;
                }

                if($partial && $this->collTSherlocksShes) {
                    foreach($this->collTSherlocksShes as $obj) {
                        if($obj->isNew()) {
                            $collTSherlocksShes[] = $obj;
                        }
                    }
                }

                $this->collTSherlocksShes = $collTSherlocksShes;
                $this->collTSherlocksShesPartial = false;
            }
        }

        return $this->collTSherlocksShes;
    }

    /**
     * Sets a collection of TSherlocksShe objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tSherlocksShes A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTSherlocksShes(PropelCollection $tSherlocksShes, PropelPDO $con = null)
    {
        $this->tSherlocksShesScheduledForDeletion = $this->getTSherlocksShes(new Criteria(), $con)->diff($tSherlocksShes);

        foreach ($this->tSherlocksShesScheduledForDeletion as $tSherlocksSheRemoved) {
            $tSherlocksSheRemoved->setTsUserUsr(null);
        }

        $this->collTSherlocksShes = null;
        foreach ($tSherlocksShes as $tSherlocksShe) {
            $this->addTSherlocksShe($tSherlocksShe);
        }

        $this->collTSherlocksShes = $tSherlocksShes;
        $this->collTSherlocksShesPartial = false;
    }

    /**
     * Returns the number of related TSherlocksShe objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TSherlocksShe objects.
     * @throws PropelException
     */
    public function countTSherlocksShes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTSherlocksShesPartial && !$this->isNew();
        if (null === $this->collTSherlocksShes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTSherlocksShes) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTSherlocksShes());
                }
                $query = TSherlocksSheQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsUserUsr($this)
                    ->count($con);
            }
        } else {
            return count($this->collTSherlocksShes);
        }
    }

    /**
     * Method called to associate a TSherlocksShe object to this object
     * through the TSherlocksShe foreign key attribute.
     *
     * @param    TSherlocksShe $l TSherlocksShe
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function addTSherlocksShe(TSherlocksShe $l)
    {
        if ($this->collTSherlocksShes === null) {
            $this->initTSherlocksShes();
            $this->collTSherlocksShesPartial = true;
        }
        if (!in_array($l, $this->collTSherlocksShes->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTSherlocksShe($l);
        }

        return $this;
    }

    /**
     * @param	TSherlocksShe $tSherlocksShe The tSherlocksShe object to add.
     */
    protected function doAddTSherlocksShe($tSherlocksShe)
    {
        $this->collTSherlocksShes[]= $tSherlocksShe;
        $tSherlocksShe->setTsUserUsr($this);
    }

    /**
     * @param	TSherlocksShe $tSherlocksShe The tSherlocksShe object to remove.
     */
    public function removeTSherlocksShe($tSherlocksShe)
    {
        if ($this->getTSherlocksShes()->contains($tSherlocksShe)) {
            $this->collTSherlocksShes->remove($this->collTSherlocksShes->search($tSherlocksShe));
            if (null === $this->tSherlocksShesScheduledForDeletion) {
                $this->tSherlocksShesScheduledForDeletion = clone $this->collTSherlocksShes;
                $this->tSherlocksShesScheduledForDeletion->clear();
            }
            $this->tSherlocksShesScheduledForDeletion[]= $tSherlocksShe;
            $tSherlocksShe->setTsUserUsr(null);
        }
    }

    /**
     * Clears out the collTVirementVirsRelatedByUsrIdTo collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTVirementVirsRelatedByUsrIdTo()
     */
    public function clearTVirementVirsRelatedByUsrIdTo()
    {
        $this->collTVirementVirsRelatedByUsrIdTo = null; // important to set this to null since that means it is uninitialized
        $this->collTVirementVirsRelatedByUsrIdToPartial = null;
    }

    /**
     * reset is the collTVirementVirsRelatedByUsrIdTo collection loaded partially
     *
     * @return void
     */
    public function resetPartialTVirementVirsRelatedByUsrIdTo($v = true)
    {
        $this->collTVirementVirsRelatedByUsrIdToPartial = $v;
    }

    /**
     * Initializes the collTVirementVirsRelatedByUsrIdTo collection.
     *
     * By default this just sets the collTVirementVirsRelatedByUsrIdTo collection to an empty array (like clearcollTVirementVirsRelatedByUsrIdTo());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTVirementVirsRelatedByUsrIdTo($overrideExisting = true)
    {
        if (null !== $this->collTVirementVirsRelatedByUsrIdTo && !$overrideExisting) {
            return;
        }
        $this->collTVirementVirsRelatedByUsrIdTo = new PropelObjectCollection();
        $this->collTVirementVirsRelatedByUsrIdTo->setModel('TVirementVir');
    }

    /**
     * Gets an array of TVirementVir objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsUserUsr is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TVirementVir[] List of TVirementVir objects
     * @throws PropelException
     */
    public function getTVirementVirsRelatedByUsrIdTo($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTVirementVirsRelatedByUsrIdToPartial && !$this->isNew();
        if (null === $this->collTVirementVirsRelatedByUsrIdTo || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTVirementVirsRelatedByUsrIdTo) {
                // return empty collection
                $this->initTVirementVirsRelatedByUsrIdTo();
            } else {
                $collTVirementVirsRelatedByUsrIdTo = TVirementVirQuery::create(null, $criteria)
                    ->filterByTsUserUsrRelatedByUsrIdTo($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTVirementVirsRelatedByUsrIdToPartial && count($collTVirementVirsRelatedByUsrIdTo)) {
                      $this->initTVirementVirsRelatedByUsrIdTo(false);

                      foreach($collTVirementVirsRelatedByUsrIdTo as $obj) {
                        if (false == $this->collTVirementVirsRelatedByUsrIdTo->contains($obj)) {
                          $this->collTVirementVirsRelatedByUsrIdTo->append($obj);
                        }
                      }

                      $this->collTVirementVirsRelatedByUsrIdToPartial = true;
                    }

                    return $collTVirementVirsRelatedByUsrIdTo;
                }

                if($partial && $this->collTVirementVirsRelatedByUsrIdTo) {
                    foreach($this->collTVirementVirsRelatedByUsrIdTo as $obj) {
                        if($obj->isNew()) {
                            $collTVirementVirsRelatedByUsrIdTo[] = $obj;
                        }
                    }
                }

                $this->collTVirementVirsRelatedByUsrIdTo = $collTVirementVirsRelatedByUsrIdTo;
                $this->collTVirementVirsRelatedByUsrIdToPartial = false;
            }
        }

        return $this->collTVirementVirsRelatedByUsrIdTo;
    }

    /**
     * Sets a collection of TVirementVirRelatedByUsrIdTo objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tVirementVirsRelatedByUsrIdTo A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTVirementVirsRelatedByUsrIdTo(PropelCollection $tVirementVirsRelatedByUsrIdTo, PropelPDO $con = null)
    {
        $this->tVirementVirsRelatedByUsrIdToScheduledForDeletion = $this->getTVirementVirsRelatedByUsrIdTo(new Criteria(), $con)->diff($tVirementVirsRelatedByUsrIdTo);

        foreach ($this->tVirementVirsRelatedByUsrIdToScheduledForDeletion as $tVirementVirRelatedByUsrIdToRemoved) {
            $tVirementVirRelatedByUsrIdToRemoved->setTsUserUsrRelatedByUsrIdTo(null);
        }

        $this->collTVirementVirsRelatedByUsrIdTo = null;
        foreach ($tVirementVirsRelatedByUsrIdTo as $tVirementVirRelatedByUsrIdTo) {
            $this->addTVirementVirRelatedByUsrIdTo($tVirementVirRelatedByUsrIdTo);
        }

        $this->collTVirementVirsRelatedByUsrIdTo = $tVirementVirsRelatedByUsrIdTo;
        $this->collTVirementVirsRelatedByUsrIdToPartial = false;
    }

    /**
     * Returns the number of related TVirementVir objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TVirementVir objects.
     * @throws PropelException
     */
    public function countTVirementVirsRelatedByUsrIdTo(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTVirementVirsRelatedByUsrIdToPartial && !$this->isNew();
        if (null === $this->collTVirementVirsRelatedByUsrIdTo || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTVirementVirsRelatedByUsrIdTo) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTVirementVirsRelatedByUsrIdTo());
                }
                $query = TVirementVirQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsUserUsrRelatedByUsrIdTo($this)
                    ->count($con);
            }
        } else {
            return count($this->collTVirementVirsRelatedByUsrIdTo);
        }
    }

    /**
     * Method called to associate a TVirementVir object to this object
     * through the TVirementVir foreign key attribute.
     *
     * @param    TVirementVir $l TVirementVir
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function addTVirementVirRelatedByUsrIdTo(TVirementVir $l)
    {
        if ($this->collTVirementVirsRelatedByUsrIdTo === null) {
            $this->initTVirementVirsRelatedByUsrIdTo();
            $this->collTVirementVirsRelatedByUsrIdToPartial = true;
        }
        if (!in_array($l, $this->collTVirementVirsRelatedByUsrIdTo->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTVirementVirRelatedByUsrIdTo($l);
        }

        return $this;
    }

    /**
     * @param	TVirementVirRelatedByUsrIdTo $tVirementVirRelatedByUsrIdTo The tVirementVirRelatedByUsrIdTo object to add.
     */
    protected function doAddTVirementVirRelatedByUsrIdTo($tVirementVirRelatedByUsrIdTo)
    {
        $this->collTVirementVirsRelatedByUsrIdTo[]= $tVirementVirRelatedByUsrIdTo;
        $tVirementVirRelatedByUsrIdTo->setTsUserUsrRelatedByUsrIdTo($this);
    }

    /**
     * @param	TVirementVirRelatedByUsrIdTo $tVirementVirRelatedByUsrIdTo The tVirementVirRelatedByUsrIdTo object to remove.
     */
    public function removeTVirementVirRelatedByUsrIdTo($tVirementVirRelatedByUsrIdTo)
    {
        if ($this->getTVirementVirsRelatedByUsrIdTo()->contains($tVirementVirRelatedByUsrIdTo)) {
            $this->collTVirementVirsRelatedByUsrIdTo->remove($this->collTVirementVirsRelatedByUsrIdTo->search($tVirementVirRelatedByUsrIdTo));
            if (null === $this->tVirementVirsRelatedByUsrIdToScheduledForDeletion) {
                $this->tVirementVirsRelatedByUsrIdToScheduledForDeletion = clone $this->collTVirementVirsRelatedByUsrIdTo;
                $this->tVirementVirsRelatedByUsrIdToScheduledForDeletion->clear();
            }
            $this->tVirementVirsRelatedByUsrIdToScheduledForDeletion[]= $tVirementVirRelatedByUsrIdTo;
            $tVirementVirRelatedByUsrIdTo->setTsUserUsrRelatedByUsrIdTo(null);
        }
    }

    /**
     * Clears out the collTVirementVirsRelatedByUsrIdFrom collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTVirementVirsRelatedByUsrIdFrom()
     */
    public function clearTVirementVirsRelatedByUsrIdFrom()
    {
        $this->collTVirementVirsRelatedByUsrIdFrom = null; // important to set this to null since that means it is uninitialized
        $this->collTVirementVirsRelatedByUsrIdFromPartial = null;
    }

    /**
     * reset is the collTVirementVirsRelatedByUsrIdFrom collection loaded partially
     *
     * @return void
     */
    public function resetPartialTVirementVirsRelatedByUsrIdFrom($v = true)
    {
        $this->collTVirementVirsRelatedByUsrIdFromPartial = $v;
    }

    /**
     * Initializes the collTVirementVirsRelatedByUsrIdFrom collection.
     *
     * By default this just sets the collTVirementVirsRelatedByUsrIdFrom collection to an empty array (like clearcollTVirementVirsRelatedByUsrIdFrom());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTVirementVirsRelatedByUsrIdFrom($overrideExisting = true)
    {
        if (null !== $this->collTVirementVirsRelatedByUsrIdFrom && !$overrideExisting) {
            return;
        }
        $this->collTVirementVirsRelatedByUsrIdFrom = new PropelObjectCollection();
        $this->collTVirementVirsRelatedByUsrIdFrom->setModel('TVirementVir');
    }

    /**
     * Gets an array of TVirementVir objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsUserUsr is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TVirementVir[] List of TVirementVir objects
     * @throws PropelException
     */
    public function getTVirementVirsRelatedByUsrIdFrom($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTVirementVirsRelatedByUsrIdFromPartial && !$this->isNew();
        if (null === $this->collTVirementVirsRelatedByUsrIdFrom || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTVirementVirsRelatedByUsrIdFrom) {
                // return empty collection
                $this->initTVirementVirsRelatedByUsrIdFrom();
            } else {
                $collTVirementVirsRelatedByUsrIdFrom = TVirementVirQuery::create(null, $criteria)
                    ->filterByTsUserUsrRelatedByUsrIdFrom($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTVirementVirsRelatedByUsrIdFromPartial && count($collTVirementVirsRelatedByUsrIdFrom)) {
                      $this->initTVirementVirsRelatedByUsrIdFrom(false);

                      foreach($collTVirementVirsRelatedByUsrIdFrom as $obj) {
                        if (false == $this->collTVirementVirsRelatedByUsrIdFrom->contains($obj)) {
                          $this->collTVirementVirsRelatedByUsrIdFrom->append($obj);
                        }
                      }

                      $this->collTVirementVirsRelatedByUsrIdFromPartial = true;
                    }

                    return $collTVirementVirsRelatedByUsrIdFrom;
                }

                if($partial && $this->collTVirementVirsRelatedByUsrIdFrom) {
                    foreach($this->collTVirementVirsRelatedByUsrIdFrom as $obj) {
                        if($obj->isNew()) {
                            $collTVirementVirsRelatedByUsrIdFrom[] = $obj;
                        }
                    }
                }

                $this->collTVirementVirsRelatedByUsrIdFrom = $collTVirementVirsRelatedByUsrIdFrom;
                $this->collTVirementVirsRelatedByUsrIdFromPartial = false;
            }
        }

        return $this->collTVirementVirsRelatedByUsrIdFrom;
    }

    /**
     * Sets a collection of TVirementVirRelatedByUsrIdFrom objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tVirementVirsRelatedByUsrIdFrom A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTVirementVirsRelatedByUsrIdFrom(PropelCollection $tVirementVirsRelatedByUsrIdFrom, PropelPDO $con = null)
    {
        $this->tVirementVirsRelatedByUsrIdFromScheduledForDeletion = $this->getTVirementVirsRelatedByUsrIdFrom(new Criteria(), $con)->diff($tVirementVirsRelatedByUsrIdFrom);

        foreach ($this->tVirementVirsRelatedByUsrIdFromScheduledForDeletion as $tVirementVirRelatedByUsrIdFromRemoved) {
            $tVirementVirRelatedByUsrIdFromRemoved->setTsUserUsrRelatedByUsrIdFrom(null);
        }

        $this->collTVirementVirsRelatedByUsrIdFrom = null;
        foreach ($tVirementVirsRelatedByUsrIdFrom as $tVirementVirRelatedByUsrIdFrom) {
            $this->addTVirementVirRelatedByUsrIdFrom($tVirementVirRelatedByUsrIdFrom);
        }

        $this->collTVirementVirsRelatedByUsrIdFrom = $tVirementVirsRelatedByUsrIdFrom;
        $this->collTVirementVirsRelatedByUsrIdFromPartial = false;
    }

    /**
     * Returns the number of related TVirementVir objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TVirementVir objects.
     * @throws PropelException
     */
    public function countTVirementVirsRelatedByUsrIdFrom(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTVirementVirsRelatedByUsrIdFromPartial && !$this->isNew();
        if (null === $this->collTVirementVirsRelatedByUsrIdFrom || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTVirementVirsRelatedByUsrIdFrom) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTVirementVirsRelatedByUsrIdFrom());
                }
                $query = TVirementVirQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsUserUsrRelatedByUsrIdFrom($this)
                    ->count($con);
            }
        } else {
            return count($this->collTVirementVirsRelatedByUsrIdFrom);
        }
    }

    /**
     * Method called to associate a TVirementVir object to this object
     * through the TVirementVir foreign key attribute.
     *
     * @param    TVirementVir $l TVirementVir
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function addTVirementVirRelatedByUsrIdFrom(TVirementVir $l)
    {
        if ($this->collTVirementVirsRelatedByUsrIdFrom === null) {
            $this->initTVirementVirsRelatedByUsrIdFrom();
            $this->collTVirementVirsRelatedByUsrIdFromPartial = true;
        }
        if (!in_array($l, $this->collTVirementVirsRelatedByUsrIdFrom->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTVirementVirRelatedByUsrIdFrom($l);
        }

        return $this;
    }

    /**
     * @param	TVirementVirRelatedByUsrIdFrom $tVirementVirRelatedByUsrIdFrom The tVirementVirRelatedByUsrIdFrom object to add.
     */
    protected function doAddTVirementVirRelatedByUsrIdFrom($tVirementVirRelatedByUsrIdFrom)
    {
        $this->collTVirementVirsRelatedByUsrIdFrom[]= $tVirementVirRelatedByUsrIdFrom;
        $tVirementVirRelatedByUsrIdFrom->setTsUserUsrRelatedByUsrIdFrom($this);
    }

    /**
     * @param	TVirementVirRelatedByUsrIdFrom $tVirementVirRelatedByUsrIdFrom The tVirementVirRelatedByUsrIdFrom object to remove.
     */
    public function removeTVirementVirRelatedByUsrIdFrom($tVirementVirRelatedByUsrIdFrom)
    {
        if ($this->getTVirementVirsRelatedByUsrIdFrom()->contains($tVirementVirRelatedByUsrIdFrom)) {
            $this->collTVirementVirsRelatedByUsrIdFrom->remove($this->collTVirementVirsRelatedByUsrIdFrom->search($tVirementVirRelatedByUsrIdFrom));
            if (null === $this->tVirementVirsRelatedByUsrIdFromScheduledForDeletion) {
                $this->tVirementVirsRelatedByUsrIdFromScheduledForDeletion = clone $this->collTVirementVirsRelatedByUsrIdFrom;
                $this->tVirementVirsRelatedByUsrIdFromScheduledForDeletion->clear();
            }
            $this->tVirementVirsRelatedByUsrIdFromScheduledForDeletion[]= $tVirementVirRelatedByUsrIdFrom;
            $tVirementVirRelatedByUsrIdFrom->setTsUserUsrRelatedByUsrIdFrom(null);
        }
    }

    /**
     * Clears out the collTjUsrGrpJugs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTjUsrGrpJugs()
     */
    public function clearTjUsrGrpJugs()
    {
        $this->collTjUsrGrpJugs = null; // important to set this to null since that means it is uninitialized
        $this->collTjUsrGrpJugsPartial = null;
    }

    /**
     * reset is the collTjUsrGrpJugs collection loaded partially
     *
     * @return void
     */
    public function resetPartialTjUsrGrpJugs($v = true)
    {
        $this->collTjUsrGrpJugsPartial = $v;
    }

    /**
     * Initializes the collTjUsrGrpJugs collection.
     *
     * By default this just sets the collTjUsrGrpJugs collection to an empty array (like clearcollTjUsrGrpJugs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTjUsrGrpJugs($overrideExisting = true)
    {
        if (null !== $this->collTjUsrGrpJugs && !$overrideExisting) {
            return;
        }
        $this->collTjUsrGrpJugs = new PropelObjectCollection();
        $this->collTjUsrGrpJugs->setModel('TjUsrGrpJug');
    }

    /**
     * Gets an array of TjUsrGrpJug objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsUserUsr is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TjUsrGrpJug[] List of TjUsrGrpJug objects
     * @throws PropelException
     */
    public function getTjUsrGrpJugs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTjUsrGrpJugsPartial && !$this->isNew();
        if (null === $this->collTjUsrGrpJugs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTjUsrGrpJugs) {
                // return empty collection
                $this->initTjUsrGrpJugs();
            } else {
                $collTjUsrGrpJugs = TjUsrGrpJugQuery::create(null, $criteria)
                    ->filterByTsUserUsr($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTjUsrGrpJugsPartial && count($collTjUsrGrpJugs)) {
                      $this->initTjUsrGrpJugs(false);

                      foreach($collTjUsrGrpJugs as $obj) {
                        if (false == $this->collTjUsrGrpJugs->contains($obj)) {
                          $this->collTjUsrGrpJugs->append($obj);
                        }
                      }

                      $this->collTjUsrGrpJugsPartial = true;
                    }

                    return $collTjUsrGrpJugs;
                }

                if($partial && $this->collTjUsrGrpJugs) {
                    foreach($this->collTjUsrGrpJugs as $obj) {
                        if($obj->isNew()) {
                            $collTjUsrGrpJugs[] = $obj;
                        }
                    }
                }

                $this->collTjUsrGrpJugs = $collTjUsrGrpJugs;
                $this->collTjUsrGrpJugsPartial = false;
            }
        }

        return $this->collTjUsrGrpJugs;
    }

    /**
     * Sets a collection of TjUsrGrpJug objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tjUsrGrpJugs A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTjUsrGrpJugs(PropelCollection $tjUsrGrpJugs, PropelPDO $con = null)
    {
        $this->tjUsrGrpJugsScheduledForDeletion = $this->getTjUsrGrpJugs(new Criteria(), $con)->diff($tjUsrGrpJugs);

        foreach ($this->tjUsrGrpJugsScheduledForDeletion as $tjUsrGrpJugRemoved) {
            $tjUsrGrpJugRemoved->setTsUserUsr(null);
        }

        $this->collTjUsrGrpJugs = null;
        foreach ($tjUsrGrpJugs as $tjUsrGrpJug) {
            $this->addTjUsrGrpJug($tjUsrGrpJug);
        }

        $this->collTjUsrGrpJugs = $tjUsrGrpJugs;
        $this->collTjUsrGrpJugsPartial = false;
    }

    /**
     * Returns the number of related TjUsrGrpJug objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TjUsrGrpJug objects.
     * @throws PropelException
     */
    public function countTjUsrGrpJugs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTjUsrGrpJugsPartial && !$this->isNew();
        if (null === $this->collTjUsrGrpJugs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTjUsrGrpJugs) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTjUsrGrpJugs());
                }
                $query = TjUsrGrpJugQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsUserUsr($this)
                    ->count($con);
            }
        } else {
            return count($this->collTjUsrGrpJugs);
        }
    }

    /**
     * Method called to associate a TjUsrGrpJug object to this object
     * through the TjUsrGrpJug foreign key attribute.
     *
     * @param    TjUsrGrpJug $l TjUsrGrpJug
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function addTjUsrGrpJug(TjUsrGrpJug $l)
    {
        if ($this->collTjUsrGrpJugs === null) {
            $this->initTjUsrGrpJugs();
            $this->collTjUsrGrpJugsPartial = true;
        }
        if (!in_array($l, $this->collTjUsrGrpJugs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTjUsrGrpJug($l);
        }

        return $this;
    }

    /**
     * @param	TjUsrGrpJug $tjUsrGrpJug The tjUsrGrpJug object to add.
     */
    protected function doAddTjUsrGrpJug($tjUsrGrpJug)
    {
        $this->collTjUsrGrpJugs[]= $tjUsrGrpJug;
        $tjUsrGrpJug->setTsUserUsr($this);
    }

    /**
     * @param	TjUsrGrpJug $tjUsrGrpJug The tjUsrGrpJug object to remove.
     */
    public function removeTjUsrGrpJug($tjUsrGrpJug)
    {
        if ($this->getTjUsrGrpJugs()->contains($tjUsrGrpJug)) {
            $this->collTjUsrGrpJugs->remove($this->collTjUsrGrpJugs->search($tjUsrGrpJug));
            if (null === $this->tjUsrGrpJugsScheduledForDeletion) {
                $this->tjUsrGrpJugsScheduledForDeletion = clone $this->collTjUsrGrpJugs;
                $this->tjUsrGrpJugsScheduledForDeletion->clear();
            }
            $this->tjUsrGrpJugsScheduledForDeletion[]= $tjUsrGrpJug;
            $tjUsrGrpJug->setTsUserUsr(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TjUsrGrpJugs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TjUsrGrpJug[] List of TjUsrGrpJug objects
     */
    public function getTjUsrGrpJugsJoinTPeriodPer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TjUsrGrpJugQuery::create(null, $criteria);
        $query->joinWith('TPeriodPer', $join_behavior);

        return $this->getTjUsrGrpJugs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TjUsrGrpJugs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TjUsrGrpJug[] List of TjUsrGrpJug objects
     */
    public function getTjUsrGrpJugsJoinTGroupGrp($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TjUsrGrpJugQuery::create(null, $criteria);
        $query->joinWith('TGroupGrp', $join_behavior);

        return $this->getTjUsrGrpJugs($query, $con);
    }

    /**
     * Clears out the collTjUsrMolJums collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTjUsrMolJums()
     */
    public function clearTjUsrMolJums()
    {
        $this->collTjUsrMolJums = null; // important to set this to null since that means it is uninitialized
        $this->collTjUsrMolJumsPartial = null;
    }

    /**
     * reset is the collTjUsrMolJums collection loaded partially
     *
     * @return void
     */
    public function resetPartialTjUsrMolJums($v = true)
    {
        $this->collTjUsrMolJumsPartial = $v;
    }

    /**
     * Initializes the collTjUsrMolJums collection.
     *
     * By default this just sets the collTjUsrMolJums collection to an empty array (like clearcollTjUsrMolJums());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTjUsrMolJums($overrideExisting = true)
    {
        if (null !== $this->collTjUsrMolJums && !$overrideExisting) {
            return;
        }
        $this->collTjUsrMolJums = new PropelObjectCollection();
        $this->collTjUsrMolJums->setModel('TjUsrMolJum');
    }

    /**
     * Gets an array of TjUsrMolJum objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsUserUsr is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TjUsrMolJum[] List of TjUsrMolJum objects
     * @throws PropelException
     */
    public function getTjUsrMolJums($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTjUsrMolJumsPartial && !$this->isNew();
        if (null === $this->collTjUsrMolJums || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTjUsrMolJums) {
                // return empty collection
                $this->initTjUsrMolJums();
            } else {
                $collTjUsrMolJums = TjUsrMolJumQuery::create(null, $criteria)
                    ->filterByTsUserUsr($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTjUsrMolJumsPartial && count($collTjUsrMolJums)) {
                      $this->initTjUsrMolJums(false);

                      foreach($collTjUsrMolJums as $obj) {
                        if (false == $this->collTjUsrMolJums->contains($obj)) {
                          $this->collTjUsrMolJums->append($obj);
                        }
                      }

                      $this->collTjUsrMolJumsPartial = true;
                    }

                    return $collTjUsrMolJums;
                }

                if($partial && $this->collTjUsrMolJums) {
                    foreach($this->collTjUsrMolJums as $obj) {
                        if($obj->isNew()) {
                            $collTjUsrMolJums[] = $obj;
                        }
                    }
                }

                $this->collTjUsrMolJums = $collTjUsrMolJums;
                $this->collTjUsrMolJumsPartial = false;
            }
        }

        return $this->collTjUsrMolJums;
    }

    /**
     * Sets a collection of TjUsrMolJum objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tjUsrMolJums A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTjUsrMolJums(PropelCollection $tjUsrMolJums, PropelPDO $con = null)
    {
        $this->tjUsrMolJumsScheduledForDeletion = $this->getTjUsrMolJums(new Criteria(), $con)->diff($tjUsrMolJums);

        foreach ($this->tjUsrMolJumsScheduledForDeletion as $tjUsrMolJumRemoved) {
            $tjUsrMolJumRemoved->setTsUserUsr(null);
        }

        $this->collTjUsrMolJums = null;
        foreach ($tjUsrMolJums as $tjUsrMolJum) {
            $this->addTjUsrMolJum($tjUsrMolJum);
        }

        $this->collTjUsrMolJums = $tjUsrMolJums;
        $this->collTjUsrMolJumsPartial = false;
    }

    /**
     * Returns the number of related TjUsrMolJum objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TjUsrMolJum objects.
     * @throws PropelException
     */
    public function countTjUsrMolJums(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTjUsrMolJumsPartial && !$this->isNew();
        if (null === $this->collTjUsrMolJums || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTjUsrMolJums) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTjUsrMolJums());
                }
                $query = TjUsrMolJumQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsUserUsr($this)
                    ->count($con);
            }
        } else {
            return count($this->collTjUsrMolJums);
        }
    }

    /**
     * Method called to associate a TjUsrMolJum object to this object
     * through the TjUsrMolJum foreign key attribute.
     *
     * @param    TjUsrMolJum $l TjUsrMolJum
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function addTjUsrMolJum(TjUsrMolJum $l)
    {
        if ($this->collTjUsrMolJums === null) {
            $this->initTjUsrMolJums();
            $this->collTjUsrMolJumsPartial = true;
        }
        if (!in_array($l, $this->collTjUsrMolJums->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTjUsrMolJum($l);
        }

        return $this;
    }

    /**
     * @param	TjUsrMolJum $tjUsrMolJum The tjUsrMolJum object to add.
     */
    protected function doAddTjUsrMolJum($tjUsrMolJum)
    {
        $this->collTjUsrMolJums[]= $tjUsrMolJum;
        $tjUsrMolJum->setTsUserUsr($this);
    }

    /**
     * @param	TjUsrMolJum $tjUsrMolJum The tjUsrMolJum object to remove.
     */
    public function removeTjUsrMolJum($tjUsrMolJum)
    {
        if ($this->getTjUsrMolJums()->contains($tjUsrMolJum)) {
            $this->collTjUsrMolJums->remove($this->collTjUsrMolJums->search($tjUsrMolJum));
            if (null === $this->tjUsrMolJumsScheduledForDeletion) {
                $this->tjUsrMolJumsScheduledForDeletion = clone $this->collTjUsrMolJums;
                $this->tjUsrMolJumsScheduledForDeletion->clear();
            }
            $this->tjUsrMolJumsScheduledForDeletion[]= $tjUsrMolJum;
            $tjUsrMolJum->setTsUserUsr(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TjUsrMolJums from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TjUsrMolJum[] List of TjUsrMolJum objects
     */
    public function getTjUsrMolJumsJoinTsMeanOfLoginMol($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TjUsrMolJumQuery::create(null, $criteria);
        $query->joinWith('TsMeanOfLoginMol', $join_behavior);

        return $this->getTjUsrMolJums($query, $con);
    }

    /**
     * Clears out the collTjUsrRigJurs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTjUsrRigJurs()
     */
    public function clearTjUsrRigJurs()
    {
        $this->collTjUsrRigJurs = null; // important to set this to null since that means it is uninitialized
        $this->collTjUsrRigJursPartial = null;
    }

    /**
     * reset is the collTjUsrRigJurs collection loaded partially
     *
     * @return void
     */
    public function resetPartialTjUsrRigJurs($v = true)
    {
        $this->collTjUsrRigJursPartial = $v;
    }

    /**
     * Initializes the collTjUsrRigJurs collection.
     *
     * By default this just sets the collTjUsrRigJurs collection to an empty array (like clearcollTjUsrRigJurs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTjUsrRigJurs($overrideExisting = true)
    {
        if (null !== $this->collTjUsrRigJurs && !$overrideExisting) {
            return;
        }
        $this->collTjUsrRigJurs = new PropelObjectCollection();
        $this->collTjUsrRigJurs->setModel('TjUsrRigJur');
    }

    /**
     * Gets an array of TjUsrRigJur objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsUserUsr is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TjUsrRigJur[] List of TjUsrRigJur objects
     * @throws PropelException
     */
    public function getTjUsrRigJurs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTjUsrRigJursPartial && !$this->isNew();
        if (null === $this->collTjUsrRigJurs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTjUsrRigJurs) {
                // return empty collection
                $this->initTjUsrRigJurs();
            } else {
                $collTjUsrRigJurs = TjUsrRigJurQuery::create(null, $criteria)
                    ->filterByTsUserUsr($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTjUsrRigJursPartial && count($collTjUsrRigJurs)) {
                      $this->initTjUsrRigJurs(false);

                      foreach($collTjUsrRigJurs as $obj) {
                        if (false == $this->collTjUsrRigJurs->contains($obj)) {
                          $this->collTjUsrRigJurs->append($obj);
                        }
                      }

                      $this->collTjUsrRigJursPartial = true;
                    }

                    return $collTjUsrRigJurs;
                }

                if($partial && $this->collTjUsrRigJurs) {
                    foreach($this->collTjUsrRigJurs as $obj) {
                        if($obj->isNew()) {
                            $collTjUsrRigJurs[] = $obj;
                        }
                    }
                }

                $this->collTjUsrRigJurs = $collTjUsrRigJurs;
                $this->collTjUsrRigJursPartial = false;
            }
        }

        return $this->collTjUsrRigJurs;
    }

    /**
     * Sets a collection of TjUsrRigJur objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tjUsrRigJurs A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTjUsrRigJurs(PropelCollection $tjUsrRigJurs, PropelPDO $con = null)
    {
        $this->tjUsrRigJursScheduledForDeletion = $this->getTjUsrRigJurs(new Criteria(), $con)->diff($tjUsrRigJurs);

        foreach ($this->tjUsrRigJursScheduledForDeletion as $tjUsrRigJurRemoved) {
            $tjUsrRigJurRemoved->setTsUserUsr(null);
        }

        $this->collTjUsrRigJurs = null;
        foreach ($tjUsrRigJurs as $tjUsrRigJur) {
            $this->addTjUsrRigJur($tjUsrRigJur);
        }

        $this->collTjUsrRigJurs = $tjUsrRigJurs;
        $this->collTjUsrRigJursPartial = false;
    }

    /**
     * Returns the number of related TjUsrRigJur objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TjUsrRigJur objects.
     * @throws PropelException
     */
    public function countTjUsrRigJurs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTjUsrRigJursPartial && !$this->isNew();
        if (null === $this->collTjUsrRigJurs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTjUsrRigJurs) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTjUsrRigJurs());
                }
                $query = TjUsrRigJurQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsUserUsr($this)
                    ->count($con);
            }
        } else {
            return count($this->collTjUsrRigJurs);
        }
    }

    /**
     * Method called to associate a TjUsrRigJur object to this object
     * through the TjUsrRigJur foreign key attribute.
     *
     * @param    TjUsrRigJur $l TjUsrRigJur
     * @return TsUserUsr The current object (for fluent API support)
     */
    public function addTjUsrRigJur(TjUsrRigJur $l)
    {
        if ($this->collTjUsrRigJurs === null) {
            $this->initTjUsrRigJurs();
            $this->collTjUsrRigJursPartial = true;
        }
        if (!in_array($l, $this->collTjUsrRigJurs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTjUsrRigJur($l);
        }

        return $this;
    }

    /**
     * @param	TjUsrRigJur $tjUsrRigJur The tjUsrRigJur object to add.
     */
    protected function doAddTjUsrRigJur($tjUsrRigJur)
    {
        $this->collTjUsrRigJurs[]= $tjUsrRigJur;
        $tjUsrRigJur->setTsUserUsr($this);
    }

    /**
     * @param	TjUsrRigJur $tjUsrRigJur The tjUsrRigJur object to remove.
     */
    public function removeTjUsrRigJur($tjUsrRigJur)
    {
        if ($this->getTjUsrRigJurs()->contains($tjUsrRigJur)) {
            $this->collTjUsrRigJurs->remove($this->collTjUsrRigJurs->search($tjUsrRigJur));
            if (null === $this->tjUsrRigJursScheduledForDeletion) {
                $this->tjUsrRigJursScheduledForDeletion = clone $this->collTjUsrRigJurs;
                $this->tjUsrRigJursScheduledForDeletion->clear();
            }
            $this->tjUsrRigJursScheduledForDeletion[]= $tjUsrRigJur;
            $tjUsrRigJur->setTsUserUsr(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TjUsrRigJur[] List of TjUsrRigJur objects
     */
    public function getTjUsrRigJursJoinTPeriodPer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TjUsrRigJurQuery::create(null, $criteria);
        $query->joinWith('TPeriodPer', $join_behavior);

        return $this->getTjUsrRigJurs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TjUsrRigJur[] List of TjUsrRigJur objects
     */
    public function getTjUsrRigJursJoinTsRightRig($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TjUsrRigJurQuery::create(null, $criteria);
        $query->joinWith('TsRightRig', $join_behavior);

        return $this->getTjUsrRigJurs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TjUsrRigJur[] List of TjUsrRigJur objects
     */
    public function getTjUsrRigJursJoinTFundationFun($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TjUsrRigJurQuery::create(null, $criteria);
        $query->joinWith('TFundationFun', $join_behavior);

        return $this->getTjUsrRigJurs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsUserUsr is new, it will return
     * an empty collection; or if this TsUserUsr has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsUserUsr.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TjUsrRigJur[] List of TjUsrRigJur objects
     */
    public function getTjUsrRigJursJoinTPointPoi($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TjUsrRigJurQuery::create(null, $criteria);
        $query->joinWith('TPointPoi', $join_behavior);

        return $this->getTjUsrRigJurs($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->usr_id = null;
        $this->usr_pwd = null;
        $this->usr_firstname = null;
        $this->usr_lastname = null;
        $this->usr_nickname = null;
        $this->usr_adult = null;
        $this->usr_mail = null;
        $this->usr_credit = null;
        $this->img_id = null;
        $this->usr_temporary = null;
        $this->usr_fail_auth = null;
        $this->usr_blocked = null;
        $this->usr_msg_perso = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collTPayboxPays) {
                foreach ($this->collTPayboxPays as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTPurchasePursRelatedByUsrIdBuyer) {
                foreach ($this->collTPurchasePursRelatedByUsrIdBuyer as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTPurchasePursRelatedByUsrIdSeller) {
                foreach ($this->collTPurchasePursRelatedByUsrIdSeller as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTRechargeRecsRelatedByUsrIdBuyer) {
                foreach ($this->collTRechargeRecsRelatedByUsrIdBuyer as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTRechargeRecsRelatedByUsrIdOperator) {
                foreach ($this->collTRechargeRecsRelatedByUsrIdOperator as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTSherlocksShes) {
                foreach ($this->collTSherlocksShes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTVirementVirsRelatedByUsrIdTo) {
                foreach ($this->collTVirementVirsRelatedByUsrIdTo as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTVirementVirsRelatedByUsrIdFrom) {
                foreach ($this->collTVirementVirsRelatedByUsrIdFrom as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTjUsrGrpJugs) {
                foreach ($this->collTjUsrGrpJugs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTjUsrMolJums) {
                foreach ($this->collTjUsrMolJums as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTjUsrRigJurs) {
                foreach ($this->collTjUsrRigJurs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collTPayboxPays instanceof PropelCollection) {
            $this->collTPayboxPays->clearIterator();
        }
        $this->collTPayboxPays = null;
        if ($this->collTPurchasePursRelatedByUsrIdBuyer instanceof PropelCollection) {
            $this->collTPurchasePursRelatedByUsrIdBuyer->clearIterator();
        }
        $this->collTPurchasePursRelatedByUsrIdBuyer = null;
        if ($this->collTPurchasePursRelatedByUsrIdSeller instanceof PropelCollection) {
            $this->collTPurchasePursRelatedByUsrIdSeller->clearIterator();
        }
        $this->collTPurchasePursRelatedByUsrIdSeller = null;
        if ($this->collTRechargeRecsRelatedByUsrIdBuyer instanceof PropelCollection) {
            $this->collTRechargeRecsRelatedByUsrIdBuyer->clearIterator();
        }
        $this->collTRechargeRecsRelatedByUsrIdBuyer = null;
        if ($this->collTRechargeRecsRelatedByUsrIdOperator instanceof PropelCollection) {
            $this->collTRechargeRecsRelatedByUsrIdOperator->clearIterator();
        }
        $this->collTRechargeRecsRelatedByUsrIdOperator = null;
        if ($this->collTSherlocksShes instanceof PropelCollection) {
            $this->collTSherlocksShes->clearIterator();
        }
        $this->collTSherlocksShes = null;
        if ($this->collTVirementVirsRelatedByUsrIdTo instanceof PropelCollection) {
            $this->collTVirementVirsRelatedByUsrIdTo->clearIterator();
        }
        $this->collTVirementVirsRelatedByUsrIdTo = null;
        if ($this->collTVirementVirsRelatedByUsrIdFrom instanceof PropelCollection) {
            $this->collTVirementVirsRelatedByUsrIdFrom->clearIterator();
        }
        $this->collTVirementVirsRelatedByUsrIdFrom = null;
        if ($this->collTjUsrGrpJugs instanceof PropelCollection) {
            $this->collTjUsrGrpJugs->clearIterator();
        }
        $this->collTjUsrGrpJugs = null;
        if ($this->collTjUsrMolJums instanceof PropelCollection) {
            $this->collTjUsrMolJums->clearIterator();
        }
        $this->collTjUsrMolJums = null;
        if ($this->collTjUsrRigJurs instanceof PropelCollection) {
            $this->collTjUsrRigJurs->clearIterator();
        }
        $this->collTjUsrRigJurs = null;
        $this->aTsImageImg = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TsUserUsrPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
