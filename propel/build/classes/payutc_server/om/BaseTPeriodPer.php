<?php


/**
 * Base class that represents a row from the 't_period_per' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTPeriodPer extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TPeriodPerPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TPeriodPerPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the per_id field.
     * @var        int
     */
    protected $per_id;

    /**
     * The value for the fun_id field.
     * @var        int
     */
    protected $fun_id;

    /**
     * The value for the per_name field.
     * @var        string
     */
    protected $per_name;

    /**
     * The value for the per_date_start field.
     * @var        string
     */
    protected $per_date_start;

    /**
     * The value for the per_date_end field.
     * @var        string
     */
    protected $per_date_end;

    /**
     * The value for the per_removed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $per_removed;

    /**
     * @var        TFundationFun
     */
    protected $aTFundationFun;

    /**
     * @var        PropelObjectCollection|TPricePri[] Collection to store aggregation of TPricePri objects.
     */
    protected $collTPricePris;
    protected $collTPricePrisPartial;

    /**
     * @var        PropelObjectCollection|TSaleSal[] Collection to store aggregation of TSaleSal objects.
     */
    protected $collTSaleSals;
    protected $collTSaleSalsPartial;

    /**
     * @var        PropelObjectCollection|TjUsrGrpJug[] Collection to store aggregation of TjUsrGrpJug objects.
     */
    protected $collTjUsrGrpJugs;
    protected $collTjUsrGrpJugsPartial;

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
    protected $tPricePrisScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tSaleSalsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tjUsrGrpJugsScheduledForDeletion = null;

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
        $this->per_removed = false;
    }

    /**
     * Initializes internal state of BaseTPeriodPer object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [per_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->per_id;
    }

    /**
     * Get the [fun_id] column value.
     *
     * @return int
     */
    public function getFunId()
    {
        return $this->fun_id;
    }

    /**
     * Get the [per_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->per_name;
    }

    /**
     * Get the [optionally formatted] temporal [per_date_start] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateStart($format = 'Y-m-d H:i:s')
    {
        if ($this->per_date_start === null) {
            return null;
        }

        if ($this->per_date_start === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->per_date_start);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->per_date_start, true), $x);
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
     * Get the [optionally formatted] temporal [per_date_end] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateEnd($format = 'Y-m-d H:i:s')
    {
        if ($this->per_date_end === null) {
            return null;
        }

        if ($this->per_date_end === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->per_date_end);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->per_date_end, true), $x);
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
     * Get the [per_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->per_removed;
    }

    /**
     * Set the value of [per_id] column.
     *
     * @param int $v new value
     * @return TPeriodPer The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_id !== $v) {
            $this->per_id = $v;
            $this->modifiedColumns[] = TPeriodPerPeer::PER_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [fun_id] column.
     *
     * @param int $v new value
     * @return TPeriodPer The current object (for fluent API support)
     */
    public function setFunId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fun_id !== $v) {
            $this->fun_id = $v;
            $this->modifiedColumns[] = TPeriodPerPeer::FUN_ID;
        }

        if ($this->aTFundationFun !== null && $this->aTFundationFun->getId() !== $v) {
            $this->aTFundationFun = null;
        }


        return $this;
    } // setFunId()

    /**
     * Set the value of [per_name] column.
     *
     * @param string $v new value
     * @return TPeriodPer The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->per_name !== $v) {
            $this->per_name = $v;
            $this->modifiedColumns[] = TPeriodPerPeer::PER_NAME;
        }


        return $this;
    } // setName()

    /**
     * Sets the value of [per_date_start] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return TPeriodPer The current object (for fluent API support)
     */
    public function setDateStart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->per_date_start !== null || $dt !== null) {
            $currentDateAsString = ($this->per_date_start !== null && $tmpDt = new DateTime($this->per_date_start)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->per_date_start = $newDateAsString;
                $this->modifiedColumns[] = TPeriodPerPeer::PER_DATE_START;
            }
        } // if either are not null


        return $this;
    } // setDateStart()

    /**
     * Sets the value of [per_date_end] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return TPeriodPer The current object (for fluent API support)
     */
    public function setDateEnd($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->per_date_end !== null || $dt !== null) {
            $currentDateAsString = ($this->per_date_end !== null && $tmpDt = new DateTime($this->per_date_end)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->per_date_end = $newDateAsString;
                $this->modifiedColumns[] = TPeriodPerPeer::PER_DATE_END;
            }
        } // if either are not null


        return $this;
    } // setDateEnd()

    /**
     * Sets the value of the [per_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return TPeriodPer The current object (for fluent API support)
     */
    public function setRemoved($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->per_removed !== $v) {
            $this->per_removed = $v;
            $this->modifiedColumns[] = TPeriodPerPeer::PER_REMOVED;
        }


        return $this;
    } // setRemoved()

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
            if ($this->per_removed !== false) {
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

            $this->per_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->fun_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->per_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->per_date_start = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->per_date_end = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->per_removed = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = TPeriodPerPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TPeriodPer object", $e);
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

        if ($this->aTFundationFun !== null && $this->fun_id !== $this->aTFundationFun->getId()) {
            $this->aTFundationFun = null;
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
            $con = Propel::getConnection(TPeriodPerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TPeriodPerPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTFundationFun = null;
            $this->collTPricePris = null;

            $this->collTSaleSals = null;

            $this->collTjUsrGrpJugs = null;

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
            $con = Propel::getConnection(TPeriodPerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TPeriodPerQuery::create()
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
            $con = Propel::getConnection(TPeriodPerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TPeriodPerPeer::addInstanceToPool($this);
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

            if ($this->aTFundationFun !== null) {
                if ($this->aTFundationFun->isModified() || $this->aTFundationFun->isNew()) {
                    $affectedRows += $this->aTFundationFun->save($con);
                }
                $this->setTFundationFun($this->aTFundationFun);
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

            if ($this->tPricePrisScheduledForDeletion !== null) {
                if (!$this->tPricePrisScheduledForDeletion->isEmpty()) {
                    foreach ($this->tPricePrisScheduledForDeletion as $tPricePri) {
                        // need to save related object because we set the relation to null
                        $tPricePri->save($con);
                    }
                    $this->tPricePrisScheduledForDeletion = null;
                }
            }

            if ($this->collTPricePris !== null) {
                foreach ($this->collTPricePris as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tSaleSalsScheduledForDeletion !== null) {
                if (!$this->tSaleSalsScheduledForDeletion->isEmpty()) {
                    TSaleSalQuery::create()
                        ->filterByPrimaryKeys($this->tSaleSalsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tSaleSalsScheduledForDeletion = null;
                }
            }

            if ($this->collTSaleSals !== null) {
                foreach ($this->collTSaleSals as $referrerFK) {
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

        $this->modifiedColumns[] = TPeriodPerPeer::PER_ID;
        if (null !== $this->per_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TPeriodPerPeer::PER_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TPeriodPerPeer::PER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`PER_ID`';
        }
        if ($this->isColumnModified(TPeriodPerPeer::FUN_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_ID`';
        }
        if ($this->isColumnModified(TPeriodPerPeer::PER_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`PER_NAME`';
        }
        if ($this->isColumnModified(TPeriodPerPeer::PER_DATE_START)) {
            $modifiedColumns[':p' . $index++]  = '`PER_DATE_START`';
        }
        if ($this->isColumnModified(TPeriodPerPeer::PER_DATE_END)) {
            $modifiedColumns[':p' . $index++]  = '`PER_DATE_END`';
        }
        if ($this->isColumnModified(TPeriodPerPeer::PER_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`PER_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `t_period_per` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`PER_ID`':
                        $stmt->bindValue($identifier, $this->per_id, PDO::PARAM_INT);
                        break;
                    case '`FUN_ID`':
                        $stmt->bindValue($identifier, $this->fun_id, PDO::PARAM_INT);
                        break;
                    case '`PER_NAME`':
                        $stmt->bindValue($identifier, $this->per_name, PDO::PARAM_STR);
                        break;
                    case '`PER_DATE_START`':
                        $stmt->bindValue($identifier, $this->per_date_start, PDO::PARAM_STR);
                        break;
                    case '`PER_DATE_END`':
                        $stmt->bindValue($identifier, $this->per_date_end, PDO::PARAM_STR);
                        break;
                    case '`PER_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->per_removed, PDO::PARAM_INT);
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

            if ($this->aTFundationFun !== null) {
                if (!$this->aTFundationFun->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTFundationFun->getValidationFailures());
                }
            }


            if (($retval = TPeriodPerPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collTPricePris !== null) {
                    foreach ($this->collTPricePris as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTSaleSals !== null) {
                    foreach ($this->collTSaleSals as $referrerFK) {
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
        $pos = TPeriodPerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getFunId();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getDateStart();
                break;
            case 4:
                return $this->getDateEnd();
                break;
            case 5:
                return $this->getRemoved();
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
        if (isset($alreadyDumpedObjects['TPeriodPer'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TPeriodPer'][$this->getPrimaryKey()] = true;
        $keys = TPeriodPerPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFunId(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getDateStart(),
            $keys[4] => $this->getDateEnd(),
            $keys[5] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTFundationFun) {
                $result['TFundationFun'] = $this->aTFundationFun->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collTPricePris) {
                $result['TPricePris'] = $this->collTPricePris->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTSaleSals) {
                $result['TSaleSals'] = $this->collTSaleSals->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTjUsrGrpJugs) {
                $result['TjUsrGrpJugs'] = $this->collTjUsrGrpJugs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TPeriodPerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setFunId($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setDateStart($value);
                break;
            case 4:
                $this->setDateEnd($value);
                break;
            case 5:
                $this->setRemoved($value);
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
        $keys = TPeriodPerPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFunId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDateStart($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setDateEnd($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setRemoved($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TPeriodPerPeer::DATABASE_NAME);

        if ($this->isColumnModified(TPeriodPerPeer::PER_ID)) $criteria->add(TPeriodPerPeer::PER_ID, $this->per_id);
        if ($this->isColumnModified(TPeriodPerPeer::FUN_ID)) $criteria->add(TPeriodPerPeer::FUN_ID, $this->fun_id);
        if ($this->isColumnModified(TPeriodPerPeer::PER_NAME)) $criteria->add(TPeriodPerPeer::PER_NAME, $this->per_name);
        if ($this->isColumnModified(TPeriodPerPeer::PER_DATE_START)) $criteria->add(TPeriodPerPeer::PER_DATE_START, $this->per_date_start);
        if ($this->isColumnModified(TPeriodPerPeer::PER_DATE_END)) $criteria->add(TPeriodPerPeer::PER_DATE_END, $this->per_date_end);
        if ($this->isColumnModified(TPeriodPerPeer::PER_REMOVED)) $criteria->add(TPeriodPerPeer::PER_REMOVED, $this->per_removed);

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
        $criteria = new Criteria(TPeriodPerPeer::DATABASE_NAME);
        $criteria->add(TPeriodPerPeer::PER_ID, $this->per_id);

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
     * Generic method to set the primary key (per_id column).
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
     * @param object $copyObj An object of TPeriodPer (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFunId($this->getFunId());
        $copyObj->setName($this->getName());
        $copyObj->setDateStart($this->getDateStart());
        $copyObj->setDateEnd($this->getDateEnd());
        $copyObj->setRemoved($this->getRemoved());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getTPricePris() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTPricePri($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTSaleSals() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTSaleSal($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTjUsrGrpJugs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTjUsrGrpJug($relObj->copy($deepCopy));
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
     * @return TPeriodPer Clone of current object.
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
     * @return TPeriodPerPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TPeriodPerPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TFundationFun object.
     *
     * @param             TFundationFun $v
     * @return TPeriodPer The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTFundationFun(TFundationFun $v = null)
    {
        if ($v === null) {
            $this->setFunId(NULL);
        } else {
            $this->setFunId($v->getId());
        }

        $this->aTFundationFun = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TFundationFun object, it will not be re-added.
        if ($v !== null) {
            $v->addTPeriodPer($this);
        }


        return $this;
    }


    /**
     * Get the associated TFundationFun object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TFundationFun The associated TFundationFun object.
     * @throws PropelException
     */
    public function getTFundationFun(PropelPDO $con = null)
    {
        if ($this->aTFundationFun === null && ($this->fun_id !== null)) {
            $this->aTFundationFun = TFundationFunQuery::create()->findPk($this->fun_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTFundationFun->addTPeriodPers($this);
             */
        }

        return $this->aTFundationFun;
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
        if ('TPricePri' == $relationName) {
            $this->initTPricePris();
        }
        if ('TSaleSal' == $relationName) {
            $this->initTSaleSals();
        }
        if ('TjUsrGrpJug' == $relationName) {
            $this->initTjUsrGrpJugs();
        }
        if ('TjUsrRigJur' == $relationName) {
            $this->initTjUsrRigJurs();
        }
    }

    /**
     * Clears out the collTPricePris collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTPricePris()
     */
    public function clearTPricePris()
    {
        $this->collTPricePris = null; // important to set this to null since that means it is uninitialized
        $this->collTPricePrisPartial = null;
    }

    /**
     * reset is the collTPricePris collection loaded partially
     *
     * @return void
     */
    public function resetPartialTPricePris($v = true)
    {
        $this->collTPricePrisPartial = $v;
    }

    /**
     * Initializes the collTPricePris collection.
     *
     * By default this just sets the collTPricePris collection to an empty array (like clearcollTPricePris());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTPricePris($overrideExisting = true)
    {
        if (null !== $this->collTPricePris && !$overrideExisting) {
            return;
        }
        $this->collTPricePris = new PropelObjectCollection();
        $this->collTPricePris->setModel('TPricePri');
    }

    /**
     * Gets an array of TPricePri objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TPeriodPer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TPricePri[] List of TPricePri objects
     * @throws PropelException
     */
    public function getTPricePris($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTPricePrisPartial && !$this->isNew();
        if (null === $this->collTPricePris || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTPricePris) {
                // return empty collection
                $this->initTPricePris();
            } else {
                $collTPricePris = TPricePriQuery::create(null, $criteria)
                    ->filterByTPeriodPer($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTPricePrisPartial && count($collTPricePris)) {
                      $this->initTPricePris(false);

                      foreach($collTPricePris as $obj) {
                        if (false == $this->collTPricePris->contains($obj)) {
                          $this->collTPricePris->append($obj);
                        }
                      }

                      $this->collTPricePrisPartial = true;
                    }

                    return $collTPricePris;
                }

                if($partial && $this->collTPricePris) {
                    foreach($this->collTPricePris as $obj) {
                        if($obj->isNew()) {
                            $collTPricePris[] = $obj;
                        }
                    }
                }

                $this->collTPricePris = $collTPricePris;
                $this->collTPricePrisPartial = false;
            }
        }

        return $this->collTPricePris;
    }

    /**
     * Sets a collection of TPricePri objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tPricePris A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTPricePris(PropelCollection $tPricePris, PropelPDO $con = null)
    {
        $this->tPricePrisScheduledForDeletion = $this->getTPricePris(new Criteria(), $con)->diff($tPricePris);

        foreach ($this->tPricePrisScheduledForDeletion as $tPricePriRemoved) {
            $tPricePriRemoved->setTPeriodPer(null);
        }

        $this->collTPricePris = null;
        foreach ($tPricePris as $tPricePri) {
            $this->addTPricePri($tPricePri);
        }

        $this->collTPricePris = $tPricePris;
        $this->collTPricePrisPartial = false;
    }

    /**
     * Returns the number of related TPricePri objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TPricePri objects.
     * @throws PropelException
     */
    public function countTPricePris(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTPricePrisPartial && !$this->isNew();
        if (null === $this->collTPricePris || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTPricePris) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTPricePris());
                }
                $query = TPricePriQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTPeriodPer($this)
                    ->count($con);
            }
        } else {
            return count($this->collTPricePris);
        }
    }

    /**
     * Method called to associate a TPricePri object to this object
     * through the TPricePri foreign key attribute.
     *
     * @param    TPricePri $l TPricePri
     * @return TPeriodPer The current object (for fluent API support)
     */
    public function addTPricePri(TPricePri $l)
    {
        if ($this->collTPricePris === null) {
            $this->initTPricePris();
            $this->collTPricePrisPartial = true;
        }
        if (!in_array($l, $this->collTPricePris->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTPricePri($l);
        }

        return $this;
    }

    /**
     * @param	TPricePri $tPricePri The tPricePri object to add.
     */
    protected function doAddTPricePri($tPricePri)
    {
        $this->collTPricePris[]= $tPricePri;
        $tPricePri->setTPeriodPer($this);
    }

    /**
     * @param	TPricePri $tPricePri The tPricePri object to remove.
     */
    public function removeTPricePri($tPricePri)
    {
        if ($this->getTPricePris()->contains($tPricePri)) {
            $this->collTPricePris->remove($this->collTPricePris->search($tPricePri));
            if (null === $this->tPricePrisScheduledForDeletion) {
                $this->tPricePrisScheduledForDeletion = clone $this->collTPricePris;
                $this->tPricePrisScheduledForDeletion->clear();
            }
            $this->tPricePrisScheduledForDeletion[]= $tPricePri;
            $tPricePri->setTPeriodPer(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPeriodPer is new, it will return
     * an empty collection; or if this TPeriodPer has previously
     * been saved, it will retrieve related TPricePris from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPeriodPer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPricePri[] List of TPricePri objects
     */
    public function getTPricePrisJoinTObjectObj($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPricePriQuery::create(null, $criteria);
        $query->joinWith('TObjectObj', $join_behavior);

        return $this->getTPricePris($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPeriodPer is new, it will return
     * an empty collection; or if this TPeriodPer has previously
     * been saved, it will retrieve related TPricePris from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPeriodPer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPricePri[] List of TPricePri objects
     */
    public function getTPricePrisJoinTGroupGrp($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPricePriQuery::create(null, $criteria);
        $query->joinWith('TGroupGrp', $join_behavior);

        return $this->getTPricePris($query, $con);
    }

    /**
     * Clears out the collTSaleSals collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTSaleSals()
     */
    public function clearTSaleSals()
    {
        $this->collTSaleSals = null; // important to set this to null since that means it is uninitialized
        $this->collTSaleSalsPartial = null;
    }

    /**
     * reset is the collTSaleSals collection loaded partially
     *
     * @return void
     */
    public function resetPartialTSaleSals($v = true)
    {
        $this->collTSaleSalsPartial = $v;
    }

    /**
     * Initializes the collTSaleSals collection.
     *
     * By default this just sets the collTSaleSals collection to an empty array (like clearcollTSaleSals());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTSaleSals($overrideExisting = true)
    {
        if (null !== $this->collTSaleSals && !$overrideExisting) {
            return;
        }
        $this->collTSaleSals = new PropelObjectCollection();
        $this->collTSaleSals->setModel('TSaleSal');
    }

    /**
     * Gets an array of TSaleSal objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TPeriodPer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TSaleSal[] List of TSaleSal objects
     * @throws PropelException
     */
    public function getTSaleSals($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTSaleSalsPartial && !$this->isNew();
        if (null === $this->collTSaleSals || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTSaleSals) {
                // return empty collection
                $this->initTSaleSals();
            } else {
                $collTSaleSals = TSaleSalQuery::create(null, $criteria)
                    ->filterByTPeriodPer($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTSaleSalsPartial && count($collTSaleSals)) {
                      $this->initTSaleSals(false);

                      foreach($collTSaleSals as $obj) {
                        if (false == $this->collTSaleSals->contains($obj)) {
                          $this->collTSaleSals->append($obj);
                        }
                      }

                      $this->collTSaleSalsPartial = true;
                    }

                    return $collTSaleSals;
                }

                if($partial && $this->collTSaleSals) {
                    foreach($this->collTSaleSals as $obj) {
                        if($obj->isNew()) {
                            $collTSaleSals[] = $obj;
                        }
                    }
                }

                $this->collTSaleSals = $collTSaleSals;
                $this->collTSaleSalsPartial = false;
            }
        }

        return $this->collTSaleSals;
    }

    /**
     * Sets a collection of TSaleSal objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tSaleSals A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTSaleSals(PropelCollection $tSaleSals, PropelPDO $con = null)
    {
        $this->tSaleSalsScheduledForDeletion = $this->getTSaleSals(new Criteria(), $con)->diff($tSaleSals);

        foreach ($this->tSaleSalsScheduledForDeletion as $tSaleSalRemoved) {
            $tSaleSalRemoved->setTPeriodPer(null);
        }

        $this->collTSaleSals = null;
        foreach ($tSaleSals as $tSaleSal) {
            $this->addTSaleSal($tSaleSal);
        }

        $this->collTSaleSals = $tSaleSals;
        $this->collTSaleSalsPartial = false;
    }

    /**
     * Returns the number of related TSaleSal objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TSaleSal objects.
     * @throws PropelException
     */
    public function countTSaleSals(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTSaleSalsPartial && !$this->isNew();
        if (null === $this->collTSaleSals || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTSaleSals) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTSaleSals());
                }
                $query = TSaleSalQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTPeriodPer($this)
                    ->count($con);
            }
        } else {
            return count($this->collTSaleSals);
        }
    }

    /**
     * Method called to associate a TSaleSal object to this object
     * through the TSaleSal foreign key attribute.
     *
     * @param    TSaleSal $l TSaleSal
     * @return TPeriodPer The current object (for fluent API support)
     */
    public function addTSaleSal(TSaleSal $l)
    {
        if ($this->collTSaleSals === null) {
            $this->initTSaleSals();
            $this->collTSaleSalsPartial = true;
        }
        if (!in_array($l, $this->collTSaleSals->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTSaleSal($l);
        }

        return $this;
    }

    /**
     * @param	TSaleSal $tSaleSal The tSaleSal object to add.
     */
    protected function doAddTSaleSal($tSaleSal)
    {
        $this->collTSaleSals[]= $tSaleSal;
        $tSaleSal->setTPeriodPer($this);
    }

    /**
     * @param	TSaleSal $tSaleSal The tSaleSal object to remove.
     */
    public function removeTSaleSal($tSaleSal)
    {
        if ($this->getTSaleSals()->contains($tSaleSal)) {
            $this->collTSaleSals->remove($this->collTSaleSals->search($tSaleSal));
            if (null === $this->tSaleSalsScheduledForDeletion) {
                $this->tSaleSalsScheduledForDeletion = clone $this->collTSaleSals;
                $this->tSaleSalsScheduledForDeletion->clear();
            }
            $this->tSaleSalsScheduledForDeletion[]= $tSaleSal;
            $tSaleSal->setTPeriodPer(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPeriodPer is new, it will return
     * an empty collection; or if this TPeriodPer has previously
     * been saved, it will retrieve related TSaleSals from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPeriodPer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TSaleSal[] List of TSaleSal objects
     */
    public function getTSaleSalsJoinTObjectObj($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TSaleSalQuery::create(null, $criteria);
        $query->joinWith('TObjectObj', $join_behavior);

        return $this->getTSaleSals($query, $con);
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
     * If this TPeriodPer is new, it will return
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
                    ->filterByTPeriodPer($this)
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
            $tjUsrGrpJugRemoved->setTPeriodPer(null);
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
                    ->filterByTPeriodPer($this)
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
     * @return TPeriodPer The current object (for fluent API support)
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
        $tjUsrGrpJug->setTPeriodPer($this);
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
            $tjUsrGrpJug->setTPeriodPer(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPeriodPer is new, it will return
     * an empty collection; or if this TPeriodPer has previously
     * been saved, it will retrieve related TjUsrGrpJugs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPeriodPer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TjUsrGrpJug[] List of TjUsrGrpJug objects
     */
    public function getTjUsrGrpJugsJoinTsUserUsr($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TjUsrGrpJugQuery::create(null, $criteria);
        $query->joinWith('TsUserUsr', $join_behavior);

        return $this->getTjUsrGrpJugs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPeriodPer is new, it will return
     * an empty collection; or if this TPeriodPer has previously
     * been saved, it will retrieve related TjUsrGrpJugs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPeriodPer.
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
     * If this TPeriodPer is new, it will return
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
                    ->filterByTPeriodPer($this)
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
            $tjUsrRigJurRemoved->setTPeriodPer(null);
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
                    ->filterByTPeriodPer($this)
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
     * @return TPeriodPer The current object (for fluent API support)
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
        $tjUsrRigJur->setTPeriodPer($this);
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
            $tjUsrRigJur->setTPeriodPer(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPeriodPer is new, it will return
     * an empty collection; or if this TPeriodPer has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPeriodPer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TjUsrRigJur[] List of TjUsrRigJur objects
     */
    public function getTjUsrRigJursJoinTsUserUsr($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TjUsrRigJurQuery::create(null, $criteria);
        $query->joinWith('TsUserUsr', $join_behavior);

        return $this->getTjUsrRigJurs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPeriodPer is new, it will return
     * an empty collection; or if this TPeriodPer has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPeriodPer.
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
     * Otherwise if this TPeriodPer is new, it will return
     * an empty collection; or if this TPeriodPer has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPeriodPer.
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
     * Otherwise if this TPeriodPer is new, it will return
     * an empty collection; or if this TPeriodPer has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPeriodPer.
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
        $this->per_id = null;
        $this->fun_id = null;
        $this->per_name = null;
        $this->per_date_start = null;
        $this->per_date_end = null;
        $this->per_removed = null;
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
            if ($this->collTPricePris) {
                foreach ($this->collTPricePris as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTSaleSals) {
                foreach ($this->collTSaleSals as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTjUsrGrpJugs) {
                foreach ($this->collTjUsrGrpJugs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTjUsrRigJurs) {
                foreach ($this->collTjUsrRigJurs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collTPricePris instanceof PropelCollection) {
            $this->collTPricePris->clearIterator();
        }
        $this->collTPricePris = null;
        if ($this->collTSaleSals instanceof PropelCollection) {
            $this->collTSaleSals->clearIterator();
        }
        $this->collTSaleSals = null;
        if ($this->collTjUsrGrpJugs instanceof PropelCollection) {
            $this->collTjUsrGrpJugs->clearIterator();
        }
        $this->collTjUsrGrpJugs = null;
        if ($this->collTjUsrRigJurs instanceof PropelCollection) {
            $this->collTjUsrRigJurs->clearIterator();
        }
        $this->collTjUsrRigJurs = null;
        $this->aTFundationFun = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TPeriodPerPeer::DEFAULT_STRING_FORMAT);
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
