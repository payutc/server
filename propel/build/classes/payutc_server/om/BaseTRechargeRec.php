<?php


/**
 * Base class that represents a row from the 't_recharge_rec' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTRechargeRec extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TRechargeRecPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TRechargeRecPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the rec_id field.
     * @var        int
     */
    protected $rec_id;

    /**
     * The value for the rty_id field.
     * @var        int
     */
    protected $rty_id;

    /**
     * The value for the usr_id_buyer field.
     * @var        int
     */
    protected $usr_id_buyer;

    /**
     * The value for the usr_id_operator field.
     * @var        int
     */
    protected $usr_id_operator;

    /**
     * The value for the poi_id field.
     * @var        int
     */
    protected $poi_id;

    /**
     * The value for the rec_date field.
     * @var        string
     */
    protected $rec_date;

    /**
     * The value for the rec_credit field.
     * @var        int
     */
    protected $rec_credit;

    /**
     * The value for the rec_trace field.
     * @var        string
     */
    protected $rec_trace;

    /**
     * The value for the rec_removed field.
     * @var        boolean
     */
    protected $rec_removed;

    /**
     * @var        TPointPoi
     */
    protected $aTPointPoi;

    /**
     * @var        TRechargeTypeRty
     */
    protected $aTRechargeTypeRty;

    /**
     * @var        TsUserUsr
     */
    protected $aTsUserUsrRelatedByUsrIdBuyer;

    /**
     * @var        TsUserUsr
     */
    protected $aTsUserUsrRelatedByUsrIdOperator;

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
     * Get the [rec_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->rec_id;
    }

    /**
     * Get the [rty_id] column value.
     *
     * @return int
     */
    public function getRtyId()
    {
        return $this->rty_id;
    }

    /**
     * Get the [usr_id_buyer] column value.
     *
     * @return int
     */
    public function getUsrIdBuyer()
    {
        return $this->usr_id_buyer;
    }

    /**
     * Get the [usr_id_operator] column value.
     *
     * @return int
     */
    public function getUsrIdOperator()
    {
        return $this->usr_id_operator;
    }

    /**
     * Get the [poi_id] column value.
     *
     * @return int
     */
    public function getPoiId()
    {
        return $this->poi_id;
    }

    /**
     * Get the [optionally formatted] temporal [rec_date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDate($format = 'Y-m-d H:i:s')
    {
        if ($this->rec_date === null) {
            return null;
        }

        if ($this->rec_date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->rec_date);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->rec_date, true), $x);
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
     * Get the [rec_credit] column value.
     *
     * @return int
     */
    public function getCredit()
    {
        return $this->rec_credit;
    }

    /**
     * Get the [rec_trace] column value.
     *
     * @return string
     */
    public function getTrace()
    {
        return $this->rec_trace;
    }

    /**
     * Get the [rec_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->rec_removed;
    }

    /**
     * Set the value of [rec_id] column.
     *
     * @param int $v new value
     * @return TRechargeRec The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rec_id !== $v) {
            $this->rec_id = $v;
            $this->modifiedColumns[] = TRechargeRecPeer::REC_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [rty_id] column.
     *
     * @param int $v new value
     * @return TRechargeRec The current object (for fluent API support)
     */
    public function setRtyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rty_id !== $v) {
            $this->rty_id = $v;
            $this->modifiedColumns[] = TRechargeRecPeer::RTY_ID;
        }

        if ($this->aTRechargeTypeRty !== null && $this->aTRechargeTypeRty->getRtyId() !== $v) {
            $this->aTRechargeTypeRty = null;
        }


        return $this;
    } // setRtyId()

    /**
     * Set the value of [usr_id_buyer] column.
     *
     * @param int $v new value
     * @return TRechargeRec The current object (for fluent API support)
     */
    public function setUsrIdBuyer($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_id_buyer !== $v) {
            $this->usr_id_buyer = $v;
            $this->modifiedColumns[] = TRechargeRecPeer::USR_ID_BUYER;
        }

        if ($this->aTsUserUsrRelatedByUsrIdBuyer !== null && $this->aTsUserUsrRelatedByUsrIdBuyer->getId() !== $v) {
            $this->aTsUserUsrRelatedByUsrIdBuyer = null;
        }


        return $this;
    } // setUsrIdBuyer()

    /**
     * Set the value of [usr_id_operator] column.
     *
     * @param int $v new value
     * @return TRechargeRec The current object (for fluent API support)
     */
    public function setUsrIdOperator($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_id_operator !== $v) {
            $this->usr_id_operator = $v;
            $this->modifiedColumns[] = TRechargeRecPeer::USR_ID_OPERATOR;
        }

        if ($this->aTsUserUsrRelatedByUsrIdOperator !== null && $this->aTsUserUsrRelatedByUsrIdOperator->getId() !== $v) {
            $this->aTsUserUsrRelatedByUsrIdOperator = null;
        }


        return $this;
    } // setUsrIdOperator()

    /**
     * Set the value of [poi_id] column.
     *
     * @param int $v new value
     * @return TRechargeRec The current object (for fluent API support)
     */
    public function setPoiId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->poi_id !== $v) {
            $this->poi_id = $v;
            $this->modifiedColumns[] = TRechargeRecPeer::POI_ID;
        }

        if ($this->aTPointPoi !== null && $this->aTPointPoi->getId() !== $v) {
            $this->aTPointPoi = null;
        }


        return $this;
    } // setPoiId()

    /**
     * Sets the value of [rec_date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return TRechargeRec The current object (for fluent API support)
     */
    public function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->rec_date !== null || $dt !== null) {
            $currentDateAsString = ($this->rec_date !== null && $tmpDt = new DateTime($this->rec_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->rec_date = $newDateAsString;
                $this->modifiedColumns[] = TRechargeRecPeer::REC_DATE;
            }
        } // if either are not null


        return $this;
    } // setDate()

    /**
     * Set the value of [rec_credit] column.
     *
     * @param int $v new value
     * @return TRechargeRec The current object (for fluent API support)
     */
    public function setCredit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rec_credit !== $v) {
            $this->rec_credit = $v;
            $this->modifiedColumns[] = TRechargeRecPeer::REC_CREDIT;
        }


        return $this;
    } // setCredit()

    /**
     * Set the value of [rec_trace] column.
     *
     * @param string $v new value
     * @return TRechargeRec The current object (for fluent API support)
     */
    public function setTrace($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rec_trace !== $v) {
            $this->rec_trace = $v;
            $this->modifiedColumns[] = TRechargeRecPeer::REC_TRACE;
        }


        return $this;
    } // setTrace()

    /**
     * Sets the value of the [rec_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return TRechargeRec The current object (for fluent API support)
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

        if ($this->rec_removed !== $v) {
            $this->rec_removed = $v;
            $this->modifiedColumns[] = TRechargeRecPeer::REC_REMOVED;
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

            $this->rec_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->rty_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->usr_id_buyer = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->usr_id_operator = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->poi_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->rec_date = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->rec_credit = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->rec_trace = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->rec_removed = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = TRechargeRecPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TRechargeRec object", $e);
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

        if ($this->aTRechargeTypeRty !== null && $this->rty_id !== $this->aTRechargeTypeRty->getRtyId()) {
            $this->aTRechargeTypeRty = null;
        }
        if ($this->aTsUserUsrRelatedByUsrIdBuyer !== null && $this->usr_id_buyer !== $this->aTsUserUsrRelatedByUsrIdBuyer->getId()) {
            $this->aTsUserUsrRelatedByUsrIdBuyer = null;
        }
        if ($this->aTsUserUsrRelatedByUsrIdOperator !== null && $this->usr_id_operator !== $this->aTsUserUsrRelatedByUsrIdOperator->getId()) {
            $this->aTsUserUsrRelatedByUsrIdOperator = null;
        }
        if ($this->aTPointPoi !== null && $this->poi_id !== $this->aTPointPoi->getId()) {
            $this->aTPointPoi = null;
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
            $con = Propel::getConnection(TRechargeRecPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TRechargeRecPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTPointPoi = null;
            $this->aTRechargeTypeRty = null;
            $this->aTsUserUsrRelatedByUsrIdBuyer = null;
            $this->aTsUserUsrRelatedByUsrIdOperator = null;
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
            $con = Propel::getConnection(TRechargeRecPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TRechargeRecQuery::create()
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
            $con = Propel::getConnection(TRechargeRecPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TRechargeRecPeer::addInstanceToPool($this);
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

            if ($this->aTPointPoi !== null) {
                if ($this->aTPointPoi->isModified() || $this->aTPointPoi->isNew()) {
                    $affectedRows += $this->aTPointPoi->save($con);
                }
                $this->setTPointPoi($this->aTPointPoi);
            }

            if ($this->aTRechargeTypeRty !== null) {
                if ($this->aTRechargeTypeRty->isModified() || $this->aTRechargeTypeRty->isNew()) {
                    $affectedRows += $this->aTRechargeTypeRty->save($con);
                }
                $this->setTRechargeTypeRty($this->aTRechargeTypeRty);
            }

            if ($this->aTsUserUsrRelatedByUsrIdBuyer !== null) {
                if ($this->aTsUserUsrRelatedByUsrIdBuyer->isModified() || $this->aTsUserUsrRelatedByUsrIdBuyer->isNew()) {
                    $affectedRows += $this->aTsUserUsrRelatedByUsrIdBuyer->save($con);
                }
                $this->setTsUserUsrRelatedByUsrIdBuyer($this->aTsUserUsrRelatedByUsrIdBuyer);
            }

            if ($this->aTsUserUsrRelatedByUsrIdOperator !== null) {
                if ($this->aTsUserUsrRelatedByUsrIdOperator->isModified() || $this->aTsUserUsrRelatedByUsrIdOperator->isNew()) {
                    $affectedRows += $this->aTsUserUsrRelatedByUsrIdOperator->save($con);
                }
                $this->setTsUserUsrRelatedByUsrIdOperator($this->aTsUserUsrRelatedByUsrIdOperator);
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

        $this->modifiedColumns[] = TRechargeRecPeer::REC_ID;
        if (null !== $this->rec_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TRechargeRecPeer::REC_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TRechargeRecPeer::REC_ID)) {
            $modifiedColumns[':p' . $index++]  = '`REC_ID`';
        }
        if ($this->isColumnModified(TRechargeRecPeer::RTY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`RTY_ID`';
        }
        if ($this->isColumnModified(TRechargeRecPeer::USR_ID_BUYER)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ID_BUYER`';
        }
        if ($this->isColumnModified(TRechargeRecPeer::USR_ID_OPERATOR)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ID_OPERATOR`';
        }
        if ($this->isColumnModified(TRechargeRecPeer::POI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`POI_ID`';
        }
        if ($this->isColumnModified(TRechargeRecPeer::REC_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`REC_DATE`';
        }
        if ($this->isColumnModified(TRechargeRecPeer::REC_CREDIT)) {
            $modifiedColumns[':p' . $index++]  = '`REC_CREDIT`';
        }
        if ($this->isColumnModified(TRechargeRecPeer::REC_TRACE)) {
            $modifiedColumns[':p' . $index++]  = '`REC_TRACE`';
        }
        if ($this->isColumnModified(TRechargeRecPeer::REC_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`REC_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `t_recharge_rec` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`REC_ID`':
                        $stmt->bindValue($identifier, $this->rec_id, PDO::PARAM_INT);
                        break;
                    case '`RTY_ID`':
                        $stmt->bindValue($identifier, $this->rty_id, PDO::PARAM_INT);
                        break;
                    case '`USR_ID_BUYER`':
                        $stmt->bindValue($identifier, $this->usr_id_buyer, PDO::PARAM_INT);
                        break;
                    case '`USR_ID_OPERATOR`':
                        $stmt->bindValue($identifier, $this->usr_id_operator, PDO::PARAM_INT);
                        break;
                    case '`POI_ID`':
                        $stmt->bindValue($identifier, $this->poi_id, PDO::PARAM_INT);
                        break;
                    case '`REC_DATE`':
                        $stmt->bindValue($identifier, $this->rec_date, PDO::PARAM_STR);
                        break;
                    case '`REC_CREDIT`':
                        $stmt->bindValue($identifier, $this->rec_credit, PDO::PARAM_INT);
                        break;
                    case '`REC_TRACE`':
                        $stmt->bindValue($identifier, $this->rec_trace, PDO::PARAM_STR);
                        break;
                    case '`REC_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->rec_removed, PDO::PARAM_INT);
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

            if ($this->aTPointPoi !== null) {
                if (!$this->aTPointPoi->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTPointPoi->getValidationFailures());
                }
            }

            if ($this->aTRechargeTypeRty !== null) {
                if (!$this->aTRechargeTypeRty->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTRechargeTypeRty->getValidationFailures());
                }
            }

            if ($this->aTsUserUsrRelatedByUsrIdBuyer !== null) {
                if (!$this->aTsUserUsrRelatedByUsrIdBuyer->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTsUserUsrRelatedByUsrIdBuyer->getValidationFailures());
                }
            }

            if ($this->aTsUserUsrRelatedByUsrIdOperator !== null) {
                if (!$this->aTsUserUsrRelatedByUsrIdOperator->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTsUserUsrRelatedByUsrIdOperator->getValidationFailures());
                }
            }


            if (($retval = TRechargeRecPeer::doValidate($this, $columns)) !== true) {
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
        $pos = TRechargeRecPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getRtyId();
                break;
            case 2:
                return $this->getUsrIdBuyer();
                break;
            case 3:
                return $this->getUsrIdOperator();
                break;
            case 4:
                return $this->getPoiId();
                break;
            case 5:
                return $this->getDate();
                break;
            case 6:
                return $this->getCredit();
                break;
            case 7:
                return $this->getTrace();
                break;
            case 8:
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
        if (isset($alreadyDumpedObjects['TRechargeRec'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TRechargeRec'][$this->getPrimaryKey()] = true;
        $keys = TRechargeRecPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getRtyId(),
            $keys[2] => $this->getUsrIdBuyer(),
            $keys[3] => $this->getUsrIdOperator(),
            $keys[4] => $this->getPoiId(),
            $keys[5] => $this->getDate(),
            $keys[6] => $this->getCredit(),
            $keys[7] => $this->getTrace(),
            $keys[8] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTPointPoi) {
                $result['TPointPoi'] = $this->aTPointPoi->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTRechargeTypeRty) {
                $result['TRechargeTypeRty'] = $this->aTRechargeTypeRty->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTsUserUsrRelatedByUsrIdBuyer) {
                $result['TsUserUsrRelatedByUsrIdBuyer'] = $this->aTsUserUsrRelatedByUsrIdBuyer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTsUserUsrRelatedByUsrIdOperator) {
                $result['TsUserUsrRelatedByUsrIdOperator'] = $this->aTsUserUsrRelatedByUsrIdOperator->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = TRechargeRecPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setRtyId($value);
                break;
            case 2:
                $this->setUsrIdBuyer($value);
                break;
            case 3:
                $this->setUsrIdOperator($value);
                break;
            case 4:
                $this->setPoiId($value);
                break;
            case 5:
                $this->setDate($value);
                break;
            case 6:
                $this->setCredit($value);
                break;
            case 7:
                $this->setTrace($value);
                break;
            case 8:
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
        $keys = TRechargeRecPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setRtyId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUsrIdBuyer($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUsrIdOperator($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPoiId($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setDate($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setCredit($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setTrace($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setRemoved($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TRechargeRecPeer::DATABASE_NAME);

        if ($this->isColumnModified(TRechargeRecPeer::REC_ID)) $criteria->add(TRechargeRecPeer::REC_ID, $this->rec_id);
        if ($this->isColumnModified(TRechargeRecPeer::RTY_ID)) $criteria->add(TRechargeRecPeer::RTY_ID, $this->rty_id);
        if ($this->isColumnModified(TRechargeRecPeer::USR_ID_BUYER)) $criteria->add(TRechargeRecPeer::USR_ID_BUYER, $this->usr_id_buyer);
        if ($this->isColumnModified(TRechargeRecPeer::USR_ID_OPERATOR)) $criteria->add(TRechargeRecPeer::USR_ID_OPERATOR, $this->usr_id_operator);
        if ($this->isColumnModified(TRechargeRecPeer::POI_ID)) $criteria->add(TRechargeRecPeer::POI_ID, $this->poi_id);
        if ($this->isColumnModified(TRechargeRecPeer::REC_DATE)) $criteria->add(TRechargeRecPeer::REC_DATE, $this->rec_date);
        if ($this->isColumnModified(TRechargeRecPeer::REC_CREDIT)) $criteria->add(TRechargeRecPeer::REC_CREDIT, $this->rec_credit);
        if ($this->isColumnModified(TRechargeRecPeer::REC_TRACE)) $criteria->add(TRechargeRecPeer::REC_TRACE, $this->rec_trace);
        if ($this->isColumnModified(TRechargeRecPeer::REC_REMOVED)) $criteria->add(TRechargeRecPeer::REC_REMOVED, $this->rec_removed);

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
        $criteria = new Criteria(TRechargeRecPeer::DATABASE_NAME);
        $criteria->add(TRechargeRecPeer::REC_ID, $this->rec_id);

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
     * Generic method to set the primary key (rec_id column).
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
     * @param object $copyObj An object of TRechargeRec (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setRtyId($this->getRtyId());
        $copyObj->setUsrIdBuyer($this->getUsrIdBuyer());
        $copyObj->setUsrIdOperator($this->getUsrIdOperator());
        $copyObj->setPoiId($this->getPoiId());
        $copyObj->setDate($this->getDate());
        $copyObj->setCredit($this->getCredit());
        $copyObj->setTrace($this->getTrace());
        $copyObj->setRemoved($this->getRemoved());

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
     * @return TRechargeRec Clone of current object.
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
     * @return TRechargeRecPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TRechargeRecPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TPointPoi object.
     *
     * @param             TPointPoi $v
     * @return TRechargeRec The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTPointPoi(TPointPoi $v = null)
    {
        if ($v === null) {
            $this->setPoiId(NULL);
        } else {
            $this->setPoiId($v->getId());
        }

        $this->aTPointPoi = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TPointPoi object, it will not be re-added.
        if ($v !== null) {
            $v->addTRechargeRec($this);
        }


        return $this;
    }


    /**
     * Get the associated TPointPoi object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TPointPoi The associated TPointPoi object.
     * @throws PropelException
     */
    public function getTPointPoi(PropelPDO $con = null)
    {
        if ($this->aTPointPoi === null && ($this->poi_id !== null)) {
            $this->aTPointPoi = TPointPoiQuery::create()->findPk($this->poi_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTPointPoi->addTRechargeRecs($this);
             */
        }

        return $this->aTPointPoi;
    }

    /**
     * Declares an association between this object and a TRechargeTypeRty object.
     *
     * @param             TRechargeTypeRty $v
     * @return TRechargeRec The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTRechargeTypeRty(TRechargeTypeRty $v = null)
    {
        if ($v === null) {
            $this->setRtyId(NULL);
        } else {
            $this->setRtyId($v->getRtyId());
        }

        $this->aTRechargeTypeRty = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TRechargeTypeRty object, it will not be re-added.
        if ($v !== null) {
            $v->addTRechargeRec($this);
        }


        return $this;
    }


    /**
     * Get the associated TRechargeTypeRty object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TRechargeTypeRty The associated TRechargeTypeRty object.
     * @throws PropelException
     */
    public function getTRechargeTypeRty(PropelPDO $con = null)
    {
        if ($this->aTRechargeTypeRty === null && ($this->rty_id !== null)) {
            $this->aTRechargeTypeRty = TRechargeTypeRtyQuery::create()->findPk($this->rty_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTRechargeTypeRty->addTRechargeRecs($this);
             */
        }

        return $this->aTRechargeTypeRty;
    }

    /**
     * Declares an association between this object and a TsUserUsr object.
     *
     * @param             TsUserUsr $v
     * @return TRechargeRec The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTsUserUsrRelatedByUsrIdBuyer(TsUserUsr $v = null)
    {
        if ($v === null) {
            $this->setUsrIdBuyer(NULL);
        } else {
            $this->setUsrIdBuyer($v->getId());
        }

        $this->aTsUserUsrRelatedByUsrIdBuyer = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TsUserUsr object, it will not be re-added.
        if ($v !== null) {
            $v->addTRechargeRecRelatedByUsrIdBuyer($this);
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
    public function getTsUserUsrRelatedByUsrIdBuyer(PropelPDO $con = null)
    {
        if ($this->aTsUserUsrRelatedByUsrIdBuyer === null && ($this->usr_id_buyer !== null)) {
            $this->aTsUserUsrRelatedByUsrIdBuyer = TsUserUsrQuery::create()->findPk($this->usr_id_buyer, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTsUserUsrRelatedByUsrIdBuyer->addTRechargeRecsRelatedByUsrIdBuyer($this);
             */
        }

        return $this->aTsUserUsrRelatedByUsrIdBuyer;
    }

    /**
     * Declares an association between this object and a TsUserUsr object.
     *
     * @param             TsUserUsr $v
     * @return TRechargeRec The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTsUserUsrRelatedByUsrIdOperator(TsUserUsr $v = null)
    {
        if ($v === null) {
            $this->setUsrIdOperator(NULL);
        } else {
            $this->setUsrIdOperator($v->getId());
        }

        $this->aTsUserUsrRelatedByUsrIdOperator = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TsUserUsr object, it will not be re-added.
        if ($v !== null) {
            $v->addTRechargeRecRelatedByUsrIdOperator($this);
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
    public function getTsUserUsrRelatedByUsrIdOperator(PropelPDO $con = null)
    {
        if ($this->aTsUserUsrRelatedByUsrIdOperator === null && ($this->usr_id_operator !== null)) {
            $this->aTsUserUsrRelatedByUsrIdOperator = TsUserUsrQuery::create()->findPk($this->usr_id_operator, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTsUserUsrRelatedByUsrIdOperator->addTRechargeRecsRelatedByUsrIdOperator($this);
             */
        }

        return $this->aTsUserUsrRelatedByUsrIdOperator;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->rec_id = null;
        $this->rty_id = null;
        $this->usr_id_buyer = null;
        $this->usr_id_operator = null;
        $this->poi_id = null;
        $this->rec_date = null;
        $this->rec_credit = null;
        $this->rec_trace = null;
        $this->rec_removed = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
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

        $this->aTPointPoi = null;
        $this->aTRechargeTypeRty = null;
        $this->aTsUserUsrRelatedByUsrIdBuyer = null;
        $this->aTsUserUsrRelatedByUsrIdOperator = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TRechargeRecPeer::DEFAULT_STRING_FORMAT);
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
