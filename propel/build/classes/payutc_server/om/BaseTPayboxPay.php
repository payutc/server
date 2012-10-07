<?php


/**
 * Base class that represents a row from the 't_paybox_pay' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTPayboxPay extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TPayboxPayPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TPayboxPayPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the pay_id field.
     * @var        int
     */
    protected $pay_id;

    /**
     * The value for the usr_id field.
     * @var        int
     */
    protected $usr_id;

    /**
     * The value for the pay_step field.
     * @var        string
     */
    protected $pay_step;

    /**
     * The value for the pay_amount field.
     * @var        int
     */
    protected $pay_amount;

    /**
     * The value for the pay_date_create field.
     * @var        string
     */
    protected $pay_date_create;

    /**
     * The value for the pay_date_retour field.
     * @var        string
     */
    protected $pay_date_retour;

    /**
     * The value for the pay_auto field.
     * @var        string
     */
    protected $pay_auto;

    /**
     * The value for the pay_trans field.
     * @var        string
     */
    protected $pay_trans;

    /**
     * The value for the pay_callback_url field.
     * @var        string
     */
    protected $pay_callback_url;

    /**
     * The value for the pay_mobile field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $pay_mobile;

    /**
     * The value for the pay_error field.
     * @var        string
     */
    protected $pay_error;

    /**
     * @var        TsUserUsr
     */
    protected $aTsUserUsr;

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
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->pay_mobile = false;
    }

    /**
     * Initializes internal state of BaseTPayboxPay object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [pay_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->pay_id;
    }

    /**
     * Get the [usr_id] column value.
     *
     * @return int
     */
    public function getUsrId()
    {
        return $this->usr_id;
    }

    /**
     * Get the [pay_step] column value.
     *
     * @return string
     */
    public function getStep()
    {
        return $this->pay_step;
    }

    /**
     * Get the [pay_amount] column value.
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->pay_amount;
    }

    /**
     * Get the [optionally formatted] temporal [pay_date_create] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateCreate($format = 'Y-m-d H:i:s')
    {
        if ($this->pay_date_create === null) {
            return null;
        }

        if ($this->pay_date_create === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->pay_date_create);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->pay_date_create, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [optionally formatted] temporal [pay_date_retour] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateRetour($format = 'Y-m-d H:i:s')
    {
        if ($this->pay_date_retour === null) {
            return null;
        }

        if ($this->pay_date_retour === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->pay_date_retour);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->pay_date_retour, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [pay_auto] column value.
     *
     * @return string
     */
    public function getAuto()
    {
        return $this->pay_auto;
    }

    /**
     * Get the [pay_trans] column value.
     *
     * @return string
     */
    public function getTrans()
    {
        return $this->pay_trans;
    }

    /**
     * Get the [pay_callback_url] column value.
     *
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->pay_callback_url;
    }

    /**
     * Get the [pay_mobile] column value.
     *
     * @return boolean
     */
    public function getMobile()
    {
        return $this->pay_mobile;
    }

    /**
     * Get the [pay_error] column value.
     *
     * @return string
     */
    public function getError()
    {
        return $this->pay_error;
    }

    /**
     * Set the value of [pay_id] column.
     *
     * @param int $v new value
     * @return TPayboxPay The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pay_id !== $v) {
            $this->pay_id = $v;
            $this->modifiedColumns[] = TPayboxPayPeer::PAY_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [usr_id] column.
     *
     * @param int $v new value
     * @return TPayboxPay The current object (for fluent API support)
     */
    public function setUsrId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_id !== $v) {
            $this->usr_id = $v;
            $this->modifiedColumns[] = TPayboxPayPeer::USR_ID;
        }

        if ($this->aTsUserUsr !== null && $this->aTsUserUsr->getId() !== $v) {
            $this->aTsUserUsr = null;
        }


        return $this;
    } // setUsrId()

    /**
     * Set the value of [pay_step] column.
     *
     * @param string $v new value
     * @return TPayboxPay The current object (for fluent API support)
     */
    public function setStep($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pay_step !== $v) {
            $this->pay_step = $v;
            $this->modifiedColumns[] = TPayboxPayPeer::PAY_STEP;
        }


        return $this;
    } // setStep()

    /**
     * Set the value of [pay_amount] column.
     *
     * @param int $v new value
     * @return TPayboxPay The current object (for fluent API support)
     */
    public function setAmount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pay_amount !== $v) {
            $this->pay_amount = $v;
            $this->modifiedColumns[] = TPayboxPayPeer::PAY_AMOUNT;
        }


        return $this;
    } // setAmount()

    /**
     * Sets the value of [pay_date_create] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return TPayboxPay The current object (for fluent API support)
     */
    public function setDateCreate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->pay_date_create !== null || $dt !== null) {
            $currentDateAsString = ($this->pay_date_create !== null && $tmpDt = new DateTime($this->pay_date_create)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->pay_date_create = $newDateAsString;
                $this->modifiedColumns[] = TPayboxPayPeer::PAY_DATE_CREATE;
            }
        } // if either are not null


        return $this;
    } // setDateCreate()

    /**
     * Sets the value of [pay_date_retour] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return TPayboxPay The current object (for fluent API support)
     */
    public function setDateRetour($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->pay_date_retour !== null || $dt !== null) {
            $currentDateAsString = ($this->pay_date_retour !== null && $tmpDt = new DateTime($this->pay_date_retour)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->pay_date_retour = $newDateAsString;
                $this->modifiedColumns[] = TPayboxPayPeer::PAY_DATE_RETOUR;
            }
        } // if either are not null


        return $this;
    } // setDateRetour()

    /**
     * Set the value of [pay_auto] column.
     *
     * @param string $v new value
     * @return TPayboxPay The current object (for fluent API support)
     */
    public function setAuto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pay_auto !== $v) {
            $this->pay_auto = $v;
            $this->modifiedColumns[] = TPayboxPayPeer::PAY_AUTO;
        }


        return $this;
    } // setAuto()

    /**
     * Set the value of [pay_trans] column.
     *
     * @param string $v new value
     * @return TPayboxPay The current object (for fluent API support)
     */
    public function setTrans($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pay_trans !== $v) {
            $this->pay_trans = $v;
            $this->modifiedColumns[] = TPayboxPayPeer::PAY_TRANS;
        }


        return $this;
    } // setTrans()

    /**
     * Set the value of [pay_callback_url] column.
     *
     * @param string $v new value
     * @return TPayboxPay The current object (for fluent API support)
     */
    public function setCallbackUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pay_callback_url !== $v) {
            $this->pay_callback_url = $v;
            $this->modifiedColumns[] = TPayboxPayPeer::PAY_CALLBACK_URL;
        }


        return $this;
    } // setCallbackUrl()

    /**
     * Sets the value of the [pay_mobile] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return TPayboxPay The current object (for fluent API support)
     */
    public function setMobile($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->pay_mobile !== $v) {
            $this->pay_mobile = $v;
            $this->modifiedColumns[] = TPayboxPayPeer::PAY_MOBILE;
        }


        return $this;
    } // setMobile()

    /**
     * Set the value of [pay_error] column.
     *
     * @param string $v new value
     * @return TPayboxPay The current object (for fluent API support)
     */
    public function setError($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pay_error !== $v) {
            $this->pay_error = $v;
            $this->modifiedColumns[] = TPayboxPayPeer::PAY_ERROR;
        }


        return $this;
    } // setError()

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
            if ($this->pay_mobile !== false) {
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

            $this->pay_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->usr_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->pay_step = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->pay_amount = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->pay_date_create = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->pay_date_retour = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->pay_auto = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->pay_trans = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->pay_callback_url = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->pay_mobile = ($row[$startcol + 9] !== null) ? (boolean) $row[$startcol + 9] : null;
            $this->pay_error = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = TPayboxPayPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TPayboxPay object", $e);
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

        if ($this->aTsUserUsr !== null && $this->usr_id !== $this->aTsUserUsr->getId()) {
            $this->aTsUserUsr = null;
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
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TPayboxPayPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTsUserUsr = null;
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
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TPayboxPayQuery::create()
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
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TPayboxPayPeer::addInstanceToPool($this);
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

            if ($this->aTsUserUsr !== null) {
                if ($this->aTsUserUsr->isModified() || $this->aTsUserUsr->isNew()) {
                    $affectedRows += $this->aTsUserUsr->save($con);
                }
                $this->setTsUserUsr($this->aTsUserUsr);
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

        $this->modifiedColumns[] = TPayboxPayPeer::PAY_ID;
        if (null !== $this->pay_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TPayboxPayPeer::PAY_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TPayboxPayPeer::PAY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`PAY_ID`';
        }
        if ($this->isColumnModified(TPayboxPayPeer::USR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ID`';
        }
        if ($this->isColumnModified(TPayboxPayPeer::PAY_STEP)) {
            $modifiedColumns[':p' . $index++]  = '`PAY_STEP`';
        }
        if ($this->isColumnModified(TPayboxPayPeer::PAY_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = '`PAY_AMOUNT`';
        }
        if ($this->isColumnModified(TPayboxPayPeer::PAY_DATE_CREATE)) {
            $modifiedColumns[':p' . $index++]  = '`PAY_DATE_CREATE`';
        }
        if ($this->isColumnModified(TPayboxPayPeer::PAY_DATE_RETOUR)) {
            $modifiedColumns[':p' . $index++]  = '`PAY_DATE_RETOUR`';
        }
        if ($this->isColumnModified(TPayboxPayPeer::PAY_AUTO)) {
            $modifiedColumns[':p' . $index++]  = '`PAY_AUTO`';
        }
        if ($this->isColumnModified(TPayboxPayPeer::PAY_TRANS)) {
            $modifiedColumns[':p' . $index++]  = '`PAY_TRANS`';
        }
        if ($this->isColumnModified(TPayboxPayPeer::PAY_CALLBACK_URL)) {
            $modifiedColumns[':p' . $index++]  = '`PAY_CALLBACK_URL`';
        }
        if ($this->isColumnModified(TPayboxPayPeer::PAY_MOBILE)) {
            $modifiedColumns[':p' . $index++]  = '`PAY_MOBILE`';
        }
        if ($this->isColumnModified(TPayboxPayPeer::PAY_ERROR)) {
            $modifiedColumns[':p' . $index++]  = '`PAY_ERROR`';
        }

        $sql = sprintf(
            'INSERT INTO `t_paybox_pay` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`PAY_ID`':
                        $stmt->bindValue($identifier, $this->pay_id, PDO::PARAM_INT);
                        break;
                    case '`USR_ID`':
                        $stmt->bindValue($identifier, $this->usr_id, PDO::PARAM_INT);
                        break;
                    case '`PAY_STEP`':
                        $stmt->bindValue($identifier, $this->pay_step, PDO::PARAM_STR);
                        break;
                    case '`PAY_AMOUNT`':
                        $stmt->bindValue($identifier, $this->pay_amount, PDO::PARAM_INT);
                        break;
                    case '`PAY_DATE_CREATE`':
                        $stmt->bindValue($identifier, $this->pay_date_create, PDO::PARAM_STR);
                        break;
                    case '`PAY_DATE_RETOUR`':
                        $stmt->bindValue($identifier, $this->pay_date_retour, PDO::PARAM_STR);
                        break;
                    case '`PAY_AUTO`':
                        $stmt->bindValue($identifier, $this->pay_auto, PDO::PARAM_STR);
                        break;
                    case '`PAY_TRANS`':
                        $stmt->bindValue($identifier, $this->pay_trans, PDO::PARAM_STR);
                        break;
                    case '`PAY_CALLBACK_URL`':
                        $stmt->bindValue($identifier, $this->pay_callback_url, PDO::PARAM_STR);
                        break;
                    case '`PAY_MOBILE`':
                        $stmt->bindValue($identifier, (int) $this->pay_mobile, PDO::PARAM_INT);
                        break;
                    case '`PAY_ERROR`':
                        $stmt->bindValue($identifier, $this->pay_error, PDO::PARAM_STR);
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

            if ($this->aTsUserUsr !== null) {
                if (!$this->aTsUserUsr->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTsUserUsr->getValidationFailures());
                }
            }


            if (($retval = TPayboxPayPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = TPayboxPayPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getUsrId();
                break;
            case 2:
                return $this->getStep();
                break;
            case 3:
                return $this->getAmount();
                break;
            case 4:
                return $this->getDateCreate();
                break;
            case 5:
                return $this->getDateRetour();
                break;
            case 6:
                return $this->getAuto();
                break;
            case 7:
                return $this->getTrans();
                break;
            case 8:
                return $this->getCallbackUrl();
                break;
            case 9:
                return $this->getMobile();
                break;
            case 10:
                return $this->getError();
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
        if (isset($alreadyDumpedObjects['TPayboxPay'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TPayboxPay'][$this->getPrimaryKey()] = true;
        $keys = TPayboxPayPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUsrId(),
            $keys[2] => $this->getStep(),
            $keys[3] => $this->getAmount(),
            $keys[4] => $this->getDateCreate(),
            $keys[5] => $this->getDateRetour(),
            $keys[6] => $this->getAuto(),
            $keys[7] => $this->getTrans(),
            $keys[8] => $this->getCallbackUrl(),
            $keys[9] => $this->getMobile(),
            $keys[10] => $this->getError(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTsUserUsr) {
                $result['TsUserUsr'] = $this->aTsUserUsr->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = TPayboxPayPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setUsrId($value);
                break;
            case 2:
                $this->setStep($value);
                break;
            case 3:
                $this->setAmount($value);
                break;
            case 4:
                $this->setDateCreate($value);
                break;
            case 5:
                $this->setDateRetour($value);
                break;
            case 6:
                $this->setAuto($value);
                break;
            case 7:
                $this->setTrans($value);
                break;
            case 8:
                $this->setCallbackUrl($value);
                break;
            case 9:
                $this->setMobile($value);
                break;
            case 10:
                $this->setError($value);
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
        $keys = TPayboxPayPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setUsrId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setStep($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAmount($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setDateCreate($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setDateRetour($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setAuto($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setTrans($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setCallbackUrl($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setMobile($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setError($arr[$keys[10]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TPayboxPayPeer::DATABASE_NAME);

        if ($this->isColumnModified(TPayboxPayPeer::PAY_ID)) $criteria->add(TPayboxPayPeer::PAY_ID, $this->pay_id);
        if ($this->isColumnModified(TPayboxPayPeer::USR_ID)) $criteria->add(TPayboxPayPeer::USR_ID, $this->usr_id);
        if ($this->isColumnModified(TPayboxPayPeer::PAY_STEP)) $criteria->add(TPayboxPayPeer::PAY_STEP, $this->pay_step);
        if ($this->isColumnModified(TPayboxPayPeer::PAY_AMOUNT)) $criteria->add(TPayboxPayPeer::PAY_AMOUNT, $this->pay_amount);
        if ($this->isColumnModified(TPayboxPayPeer::PAY_DATE_CREATE)) $criteria->add(TPayboxPayPeer::PAY_DATE_CREATE, $this->pay_date_create);
        if ($this->isColumnModified(TPayboxPayPeer::PAY_DATE_RETOUR)) $criteria->add(TPayboxPayPeer::PAY_DATE_RETOUR, $this->pay_date_retour);
        if ($this->isColumnModified(TPayboxPayPeer::PAY_AUTO)) $criteria->add(TPayboxPayPeer::PAY_AUTO, $this->pay_auto);
        if ($this->isColumnModified(TPayboxPayPeer::PAY_TRANS)) $criteria->add(TPayboxPayPeer::PAY_TRANS, $this->pay_trans);
        if ($this->isColumnModified(TPayboxPayPeer::PAY_CALLBACK_URL)) $criteria->add(TPayboxPayPeer::PAY_CALLBACK_URL, $this->pay_callback_url);
        if ($this->isColumnModified(TPayboxPayPeer::PAY_MOBILE)) $criteria->add(TPayboxPayPeer::PAY_MOBILE, $this->pay_mobile);
        if ($this->isColumnModified(TPayboxPayPeer::PAY_ERROR)) $criteria->add(TPayboxPayPeer::PAY_ERROR, $this->pay_error);

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
        $criteria = new Criteria(TPayboxPayPeer::DATABASE_NAME);
        $criteria->add(TPayboxPayPeer::PAY_ID, $this->pay_id);

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
     * Generic method to set the primary key (pay_id column).
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
     * @param object $copyObj An object of TPayboxPay (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUsrId($this->getUsrId());
        $copyObj->setStep($this->getStep());
        $copyObj->setAmount($this->getAmount());
        $copyObj->setDateCreate($this->getDateCreate());
        $copyObj->setDateRetour($this->getDateRetour());
        $copyObj->setAuto($this->getAuto());
        $copyObj->setTrans($this->getTrans());
        $copyObj->setCallbackUrl($this->getCallbackUrl());
        $copyObj->setMobile($this->getMobile());
        $copyObj->setError($this->getError());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

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
     * @return TPayboxPay Clone of current object.
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
     * @return TPayboxPayPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TPayboxPayPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TsUserUsr object.
     *
     * @param             TsUserUsr $v
     * @return TPayboxPay The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTsUserUsr(TsUserUsr $v = null)
    {
        if ($v === null) {
            $this->setUsrId(NULL);
        } else {
            $this->setUsrId($v->getId());
        }

        $this->aTsUserUsr = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TsUserUsr object, it will not be re-added.
        if ($v !== null) {
            $v->addTPayboxPay($this);
        }


        return $this;
    }


    /**
     * Get the associated TsUserUsr object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TsUserUsr The associated TsUserUsr object.
     * @throws PropelException
     */
    public function getTsUserUsr(PropelPDO $con = null)
    {
        if ($this->aTsUserUsr === null && ($this->usr_id !== null)) {
            $this->aTsUserUsr = TsUserUsrQuery::create()->findPk($this->usr_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTsUserUsr->addTPayboxPays($this);
             */
        }

        return $this->aTsUserUsr;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->pay_id = null;
        $this->usr_id = null;
        $this->pay_step = null;
        $this->pay_amount = null;
        $this->pay_date_create = null;
        $this->pay_date_retour = null;
        $this->pay_auto = null;
        $this->pay_trans = null;
        $this->pay_callback_url = null;
        $this->pay_mobile = null;
        $this->pay_error = null;
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
        } // if ($deep)

        $this->aTsUserUsr = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TPayboxPayPeer::DEFAULT_STRING_FORMAT);
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
