<?php


/**
 * Base class that represents a row from the 'tj_usr_rig_jur' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTjUsrRigJur extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TjUsrRigJurPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TjUsrRigJurPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the jur_id field.
     * @var        int
     */
    protected $jur_id;

    /**
     * The value for the usr_id field.
     * @var        int
     */
    protected $usr_id;

    /**
     * The value for the rig_id field.
     * @var        int
     */
    protected $rig_id;

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
     * The value for the poi_id field.
     * @var        int
     */
    protected $poi_id;

    /**
     * The value for the jur_removed field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $jur_removed;

    /**
     * @var        TPeriodPer
     */
    protected $aTPeriodPer;

    /**
     * @var        TsUserUsr
     */
    protected $aTsUserUsr;

    /**
     * @var        TsRightRig
     */
    protected $aTsRightRig;

    /**
     * @var        TFundationFun
     */
    protected $aTFundationFun;

    /**
     * @var        TPointPoi
     */
    protected $aTPointPoi;

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
        $this->jur_removed = 0;
    }

    /**
     * Initializes internal state of BaseTjUsrRigJur object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [jur_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->jur_id;
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
     * Get the [rig_id] column value.
     *
     * @return int
     */
    public function getRigId()
    {
        return $this->rig_id;
    }

    /**
     * Get the [per_id] column value.
     *
     * @return int
     */
    public function getPerId()
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
     * Get the [poi_id] column value.
     *
     * @return int
     */
    public function getPoiId()
    {
        return $this->poi_id;
    }

    /**
     * Get the [jur_removed] column value.
     *
     * @return int
     */
    public function getRemoved()
    {
        return $this->jur_removed;
    }

    /**
     * Set the value of [jur_id] column.
     *
     * @param int $v new value
     * @return TjUsrRigJur The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->jur_id !== $v) {
            $this->jur_id = $v;
            $this->modifiedColumns[] = TjUsrRigJurPeer::JUR_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [usr_id] column.
     *
     * @param int $v new value
     * @return TjUsrRigJur The current object (for fluent API support)
     */
    public function setUsrId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_id !== $v) {
            $this->usr_id = $v;
            $this->modifiedColumns[] = TjUsrRigJurPeer::USR_ID;
        }

        if ($this->aTsUserUsr !== null && $this->aTsUserUsr->getId() !== $v) {
            $this->aTsUserUsr = null;
        }


        return $this;
    } // setUsrId()

    /**
     * Set the value of [rig_id] column.
     *
     * @param int $v new value
     * @return TjUsrRigJur The current object (for fluent API support)
     */
    public function setRigId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rig_id !== $v) {
            $this->rig_id = $v;
            $this->modifiedColumns[] = TjUsrRigJurPeer::RIG_ID;
        }

        if ($this->aTsRightRig !== null && $this->aTsRightRig->getId() !== $v) {
            $this->aTsRightRig = null;
        }


        return $this;
    } // setRigId()

    /**
     * Set the value of [per_id] column.
     *
     * @param int $v new value
     * @return TjUsrRigJur The current object (for fluent API support)
     */
    public function setPerId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_id !== $v) {
            $this->per_id = $v;
            $this->modifiedColumns[] = TjUsrRigJurPeer::PER_ID;
        }

        if ($this->aTPeriodPer !== null && $this->aTPeriodPer->getId() !== $v) {
            $this->aTPeriodPer = null;
        }


        return $this;
    } // setPerId()

    /**
     * Set the value of [fun_id] column.
     *
     * @param int $v new value
     * @return TjUsrRigJur The current object (for fluent API support)
     */
    public function setFunId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fun_id !== $v) {
            $this->fun_id = $v;
            $this->modifiedColumns[] = TjUsrRigJurPeer::FUN_ID;
        }

        if ($this->aTFundationFun !== null && $this->aTFundationFun->getId() !== $v) {
            $this->aTFundationFun = null;
        }


        return $this;
    } // setFunId()

    /**
     * Set the value of [poi_id] column.
     *
     * @param int $v new value
     * @return TjUsrRigJur The current object (for fluent API support)
     */
    public function setPoiId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->poi_id !== $v) {
            $this->poi_id = $v;
            $this->modifiedColumns[] = TjUsrRigJurPeer::POI_ID;
        }

        if ($this->aTPointPoi !== null && $this->aTPointPoi->getId() !== $v) {
            $this->aTPointPoi = null;
        }


        return $this;
    } // setPoiId()

    /**
     * Set the value of [jur_removed] column.
     *
     * @param int $v new value
     * @return TjUsrRigJur The current object (for fluent API support)
     */
    public function setRemoved($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->jur_removed !== $v) {
            $this->jur_removed = $v;
            $this->modifiedColumns[] = TjUsrRigJurPeer::JUR_REMOVED;
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
            if ($this->jur_removed !== 0) {
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

            $this->jur_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->usr_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->rig_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->per_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->fun_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->poi_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->jur_removed = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = TjUsrRigJurPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TjUsrRigJur object", $e);
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
        if ($this->aTsRightRig !== null && $this->rig_id !== $this->aTsRightRig->getId()) {
            $this->aTsRightRig = null;
        }
        if ($this->aTPeriodPer !== null && $this->per_id !== $this->aTPeriodPer->getId()) {
            $this->aTPeriodPer = null;
        }
        if ($this->aTFundationFun !== null && $this->fun_id !== $this->aTFundationFun->getId()) {
            $this->aTFundationFun = null;
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
            $con = Propel::getConnection(TjUsrRigJurPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TjUsrRigJurPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTPeriodPer = null;
            $this->aTsUserUsr = null;
            $this->aTsRightRig = null;
            $this->aTFundationFun = null;
            $this->aTPointPoi = null;
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
            $con = Propel::getConnection(TjUsrRigJurPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TjUsrRigJurQuery::create()
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
            $con = Propel::getConnection(TjUsrRigJurPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TjUsrRigJurPeer::addInstanceToPool($this);
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

            if ($this->aTPeriodPer !== null) {
                if ($this->aTPeriodPer->isModified() || $this->aTPeriodPer->isNew()) {
                    $affectedRows += $this->aTPeriodPer->save($con);
                }
                $this->setTPeriodPer($this->aTPeriodPer);
            }

            if ($this->aTsUserUsr !== null) {
                if ($this->aTsUserUsr->isModified() || $this->aTsUserUsr->isNew()) {
                    $affectedRows += $this->aTsUserUsr->save($con);
                }
                $this->setTsUserUsr($this->aTsUserUsr);
            }

            if ($this->aTsRightRig !== null) {
                if ($this->aTsRightRig->isModified() || $this->aTsRightRig->isNew()) {
                    $affectedRows += $this->aTsRightRig->save($con);
                }
                $this->setTsRightRig($this->aTsRightRig);
            }

            if ($this->aTFundationFun !== null) {
                if ($this->aTFundationFun->isModified() || $this->aTFundationFun->isNew()) {
                    $affectedRows += $this->aTFundationFun->save($con);
                }
                $this->setTFundationFun($this->aTFundationFun);
            }

            if ($this->aTPointPoi !== null) {
                if ($this->aTPointPoi->isModified() || $this->aTPointPoi->isNew()) {
                    $affectedRows += $this->aTPointPoi->save($con);
                }
                $this->setTPointPoi($this->aTPointPoi);
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

        $this->modifiedColumns[] = TjUsrRigJurPeer::JUR_ID;
        if (null !== $this->jur_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TjUsrRigJurPeer::JUR_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TjUsrRigJurPeer::JUR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`JUR_ID`';
        }
        if ($this->isColumnModified(TjUsrRigJurPeer::USR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ID`';
        }
        if ($this->isColumnModified(TjUsrRigJurPeer::RIG_ID)) {
            $modifiedColumns[':p' . $index++]  = '`RIG_ID`';
        }
        if ($this->isColumnModified(TjUsrRigJurPeer::PER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`PER_ID`';
        }
        if ($this->isColumnModified(TjUsrRigJurPeer::FUN_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_ID`';
        }
        if ($this->isColumnModified(TjUsrRigJurPeer::POI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`POI_ID`';
        }
        if ($this->isColumnModified(TjUsrRigJurPeer::JUR_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`JUR_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `tj_usr_rig_jur` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`JUR_ID`':
                        $stmt->bindValue($identifier, $this->jur_id, PDO::PARAM_INT);
                        break;
                    case '`USR_ID`':
                        $stmt->bindValue($identifier, $this->usr_id, PDO::PARAM_INT);
                        break;
                    case '`RIG_ID`':
                        $stmt->bindValue($identifier, $this->rig_id, PDO::PARAM_INT);
                        break;
                    case '`PER_ID`':
                        $stmt->bindValue($identifier, $this->per_id, PDO::PARAM_INT);
                        break;
                    case '`FUN_ID`':
                        $stmt->bindValue($identifier, $this->fun_id, PDO::PARAM_INT);
                        break;
                    case '`POI_ID`':
                        $stmt->bindValue($identifier, $this->poi_id, PDO::PARAM_INT);
                        break;
                    case '`JUR_REMOVED`':
                        $stmt->bindValue($identifier, $this->jur_removed, PDO::PARAM_INT);
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

            if ($this->aTPeriodPer !== null) {
                if (!$this->aTPeriodPer->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTPeriodPer->getValidationFailures());
                }
            }

            if ($this->aTsUserUsr !== null) {
                if (!$this->aTsUserUsr->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTsUserUsr->getValidationFailures());
                }
            }

            if ($this->aTsRightRig !== null) {
                if (!$this->aTsRightRig->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTsRightRig->getValidationFailures());
                }
            }

            if ($this->aTFundationFun !== null) {
                if (!$this->aTFundationFun->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTFundationFun->getValidationFailures());
                }
            }

            if ($this->aTPointPoi !== null) {
                if (!$this->aTPointPoi->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTPointPoi->getValidationFailures());
                }
            }


            if (($retval = TjUsrRigJurPeer::doValidate($this, $columns)) !== true) {
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
        $pos = TjUsrRigJurPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getRigId();
                break;
            case 3:
                return $this->getPerId();
                break;
            case 4:
                return $this->getFunId();
                break;
            case 5:
                return $this->getPoiId();
                break;
            case 6:
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
        if (isset($alreadyDumpedObjects['TjUsrRigJur'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TjUsrRigJur'][$this->getPrimaryKey()] = true;
        $keys = TjUsrRigJurPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUsrId(),
            $keys[2] => $this->getRigId(),
            $keys[3] => $this->getPerId(),
            $keys[4] => $this->getFunId(),
            $keys[5] => $this->getPoiId(),
            $keys[6] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTPeriodPer) {
                $result['TPeriodPer'] = $this->aTPeriodPer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTsUserUsr) {
                $result['TsUserUsr'] = $this->aTsUserUsr->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTsRightRig) {
                $result['TsRightRig'] = $this->aTsRightRig->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTFundationFun) {
                $result['TFundationFun'] = $this->aTFundationFun->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTPointPoi) {
                $result['TPointPoi'] = $this->aTPointPoi->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = TjUsrRigJurPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setRigId($value);
                break;
            case 3:
                $this->setPerId($value);
                break;
            case 4:
                $this->setFunId($value);
                break;
            case 5:
                $this->setPoiId($value);
                break;
            case 6:
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
        $keys = TjUsrRigJurPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setUsrId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setRigId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPerId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setFunId($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPoiId($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setRemoved($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TjUsrRigJurPeer::DATABASE_NAME);

        if ($this->isColumnModified(TjUsrRigJurPeer::JUR_ID)) $criteria->add(TjUsrRigJurPeer::JUR_ID, $this->jur_id);
        if ($this->isColumnModified(TjUsrRigJurPeer::USR_ID)) $criteria->add(TjUsrRigJurPeer::USR_ID, $this->usr_id);
        if ($this->isColumnModified(TjUsrRigJurPeer::RIG_ID)) $criteria->add(TjUsrRigJurPeer::RIG_ID, $this->rig_id);
        if ($this->isColumnModified(TjUsrRigJurPeer::PER_ID)) $criteria->add(TjUsrRigJurPeer::PER_ID, $this->per_id);
        if ($this->isColumnModified(TjUsrRigJurPeer::FUN_ID)) $criteria->add(TjUsrRigJurPeer::FUN_ID, $this->fun_id);
        if ($this->isColumnModified(TjUsrRigJurPeer::POI_ID)) $criteria->add(TjUsrRigJurPeer::POI_ID, $this->poi_id);
        if ($this->isColumnModified(TjUsrRigJurPeer::JUR_REMOVED)) $criteria->add(TjUsrRigJurPeer::JUR_REMOVED, $this->jur_removed);

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
        $criteria = new Criteria(TjUsrRigJurPeer::DATABASE_NAME);
        $criteria->add(TjUsrRigJurPeer::JUR_ID, $this->jur_id);

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
     * Generic method to set the primary key (jur_id column).
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
     * @param object $copyObj An object of TjUsrRigJur (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUsrId($this->getUsrId());
        $copyObj->setRigId($this->getRigId());
        $copyObj->setPerId($this->getPerId());
        $copyObj->setFunId($this->getFunId());
        $copyObj->setPoiId($this->getPoiId());
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
     * @return TjUsrRigJur Clone of current object.
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
     * @return TjUsrRigJurPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TjUsrRigJurPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TPeriodPer object.
     *
     * @param             TPeriodPer $v
     * @return TjUsrRigJur The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTPeriodPer(TPeriodPer $v = null)
    {
        if ($v === null) {
            $this->setPerId(NULL);
        } else {
            $this->setPerId($v->getId());
        }

        $this->aTPeriodPer = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TPeriodPer object, it will not be re-added.
        if ($v !== null) {
            $v->addTjUsrRigJur($this);
        }


        return $this;
    }


    /**
     * Get the associated TPeriodPer object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TPeriodPer The associated TPeriodPer object.
     * @throws PropelException
     */
    public function getTPeriodPer(PropelPDO $con = null)
    {
        if ($this->aTPeriodPer === null && ($this->per_id !== null)) {
            $this->aTPeriodPer = TPeriodPerQuery::create()->findPk($this->per_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTPeriodPer->addTjUsrRigJurs($this);
             */
        }

        return $this->aTPeriodPer;
    }

    /**
     * Declares an association between this object and a TsUserUsr object.
     *
     * @param             TsUserUsr $v
     * @return TjUsrRigJur The current object (for fluent API support)
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
            $v->addTjUsrRigJur($this);
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
                $this->aTsUserUsr->addTjUsrRigJurs($this);
             */
        }

        return $this->aTsUserUsr;
    }

    /**
     * Declares an association between this object and a TsRightRig object.
     *
     * @param             TsRightRig $v
     * @return TjUsrRigJur The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTsRightRig(TsRightRig $v = null)
    {
        if ($v === null) {
            $this->setRigId(NULL);
        } else {
            $this->setRigId($v->getId());
        }

        $this->aTsRightRig = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TsRightRig object, it will not be re-added.
        if ($v !== null) {
            $v->addTjUsrRigJur($this);
        }


        return $this;
    }


    /**
     * Get the associated TsRightRig object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TsRightRig The associated TsRightRig object.
     * @throws PropelException
     */
    public function getTsRightRig(PropelPDO $con = null)
    {
        if ($this->aTsRightRig === null && ($this->rig_id !== null)) {
            $this->aTsRightRig = TsRightRigQuery::create()->findPk($this->rig_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTsRightRig->addTjUsrRigJurs($this);
             */
        }

        return $this->aTsRightRig;
    }

    /**
     * Declares an association between this object and a TFundationFun object.
     *
     * @param             TFundationFun $v
     * @return TjUsrRigJur The current object (for fluent API support)
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
            $v->addTjUsrRigJur($this);
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
                $this->aTFundationFun->addTjUsrRigJurs($this);
             */
        }

        return $this->aTFundationFun;
    }

    /**
     * Declares an association between this object and a TPointPoi object.
     *
     * @param             TPointPoi $v
     * @return TjUsrRigJur The current object (for fluent API support)
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
            $v->addTjUsrRigJur($this);
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
                $this->aTPointPoi->addTjUsrRigJurs($this);
             */
        }

        return $this->aTPointPoi;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->jur_id = null;
        $this->usr_id = null;
        $this->rig_id = null;
        $this->per_id = null;
        $this->fun_id = null;
        $this->poi_id = null;
        $this->jur_removed = null;
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

        $this->aTPeriodPer = null;
        $this->aTsUserUsr = null;
        $this->aTsRightRig = null;
        $this->aTFundationFun = null;
        $this->aTPointPoi = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TjUsrRigJurPeer::DEFAULT_STRING_FORMAT);
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
