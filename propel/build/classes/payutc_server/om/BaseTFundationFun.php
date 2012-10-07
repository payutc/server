<?php


/**
 * Base class that represents a row from the 't_fundation_fun' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTFundationFun extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TFundationFunPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TFundationFunPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the fun_id field.
     * @var        int
     */
    protected $fun_id;

    /**
     * The value for the fun_name field.
     * @var        string
     */
    protected $fun_name;

    /**
     * The value for the fun_removed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $fun_removed;

    /**
     * @var        PropelObjectCollection|TGroupGrp[] Collection to store aggregation of TGroupGrp objects.
     */
    protected $collTGroupGrps;
    protected $collTGroupGrpsPartial;

    /**
     * @var        PropelObjectCollection|TObjectObj[] Collection to store aggregation of TObjectObj objects.
     */
    protected $collTObjectObjs;
    protected $collTObjectObjsPartial;

    /**
     * @var        PropelObjectCollection|TPeriodPer[] Collection to store aggregation of TPeriodPer objects.
     */
    protected $collTPeriodPers;
    protected $collTPeriodPersPartial;

    /**
     * @var        PropelObjectCollection|TPlagePla[] Collection to store aggregation of TPlagePla objects.
     */
    protected $collTPlagePlas;
    protected $collTPlagePlasPartial;

    /**
     * @var        PropelObjectCollection|TPurchasePur[] Collection to store aggregation of TPurchasePur objects.
     */
    protected $collTPurchasePurs;
    protected $collTPurchasePursPartial;

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
    protected $tGroupGrpsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tObjectObjsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tPeriodPersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tPlagePlasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tPurchasePursScheduledForDeletion = null;

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
        $this->fun_removed = false;
    }

    /**
     * Initializes internal state of BaseTFundationFun object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [fun_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->fun_id;
    }

    /**
     * Get the [fun_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->fun_name;
    }

    /**
     * Get the [fun_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->fun_removed;
    }

    /**
     * Set the value of [fun_id] column.
     *
     * @param int $v new value
     * @return TFundationFun The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fun_id !== $v) {
            $this->fun_id = $v;
            $this->modifiedColumns[] = TFundationFunPeer::FUN_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [fun_name] column.
     *
     * @param string $v new value
     * @return TFundationFun The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fun_name !== $v) {
            $this->fun_name = $v;
            $this->modifiedColumns[] = TFundationFunPeer::FUN_NAME;
        }


        return $this;
    } // setName()

    /**
     * Sets the value of the [fun_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return TFundationFun The current object (for fluent API support)
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

        if ($this->fun_removed !== $v) {
            $this->fun_removed = $v;
            $this->modifiedColumns[] = TFundationFunPeer::FUN_REMOVED;
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
            if ($this->fun_removed !== false) {
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

            $this->fun_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->fun_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->fun_removed = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = TFundationFunPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TFundationFun object", $e);
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
            $con = Propel::getConnection(TFundationFunPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TFundationFunPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collTGroupGrps = null;

            $this->collTObjectObjs = null;

            $this->collTPeriodPers = null;

            $this->collTPlagePlas = null;

            $this->collTPurchasePurs = null;

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
            $con = Propel::getConnection(TFundationFunPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TFundationFunQuery::create()
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
            $con = Propel::getConnection(TFundationFunPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TFundationFunPeer::addInstanceToPool($this);
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

            if ($this->tGroupGrpsScheduledForDeletion !== null) {
                if (!$this->tGroupGrpsScheduledForDeletion->isEmpty()) {
                    TGroupGrpQuery::create()
                        ->filterByPrimaryKeys($this->tGroupGrpsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tGroupGrpsScheduledForDeletion = null;
                }
            }

            if ($this->collTGroupGrps !== null) {
                foreach ($this->collTGroupGrps as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tObjectObjsScheduledForDeletion !== null) {
                if (!$this->tObjectObjsScheduledForDeletion->isEmpty()) {
                    TObjectObjQuery::create()
                        ->filterByPrimaryKeys($this->tObjectObjsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tObjectObjsScheduledForDeletion = null;
                }
            }

            if ($this->collTObjectObjs !== null) {
                foreach ($this->collTObjectObjs as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tPeriodPersScheduledForDeletion !== null) {
                if (!$this->tPeriodPersScheduledForDeletion->isEmpty()) {
                    TPeriodPerQuery::create()
                        ->filterByPrimaryKeys($this->tPeriodPersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tPeriodPersScheduledForDeletion = null;
                }
            }

            if ($this->collTPeriodPers !== null) {
                foreach ($this->collTPeriodPers as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tPlagePlasScheduledForDeletion !== null) {
                if (!$this->tPlagePlasScheduledForDeletion->isEmpty()) {
                    TPlagePlaQuery::create()
                        ->filterByPrimaryKeys($this->tPlagePlasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tPlagePlasScheduledForDeletion = null;
                }
            }

            if ($this->collTPlagePlas !== null) {
                foreach ($this->collTPlagePlas as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tPurchasePursScheduledForDeletion !== null) {
                if (!$this->tPurchasePursScheduledForDeletion->isEmpty()) {
                    TPurchasePurQuery::create()
                        ->filterByPrimaryKeys($this->tPurchasePursScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tPurchasePursScheduledForDeletion = null;
                }
            }

            if ($this->collTPurchasePurs !== null) {
                foreach ($this->collTPurchasePurs as $referrerFK) {
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

        $this->modifiedColumns[] = TFundationFunPeer::FUN_ID;
        if (null !== $this->fun_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TFundationFunPeer::FUN_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TFundationFunPeer::FUN_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_ID`';
        }
        if ($this->isColumnModified(TFundationFunPeer::FUN_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_NAME`';
        }
        if ($this->isColumnModified(TFundationFunPeer::FUN_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `t_fundation_fun` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`FUN_ID`':
                        $stmt->bindValue($identifier, $this->fun_id, PDO::PARAM_INT);
                        break;
                    case '`FUN_NAME`':
                        $stmt->bindValue($identifier, $this->fun_name, PDO::PARAM_STR);
                        break;
                    case '`FUN_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->fun_removed, PDO::PARAM_INT);
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


            if (($retval = TFundationFunPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collTGroupGrps !== null) {
                    foreach ($this->collTGroupGrps as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTObjectObjs !== null) {
                    foreach ($this->collTObjectObjs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTPeriodPers !== null) {
                    foreach ($this->collTPeriodPers as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTPlagePlas !== null) {
                    foreach ($this->collTPlagePlas as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTPurchasePurs !== null) {
                    foreach ($this->collTPurchasePurs as $referrerFK) {
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
        $pos = TFundationFunPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getName();
                break;
            case 2:
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
        if (isset($alreadyDumpedObjects['TFundationFun'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TFundationFun'][$this->getPrimaryKey()] = true;
        $keys = TFundationFunPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collTGroupGrps) {
                $result['TGroupGrps'] = $this->collTGroupGrps->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTObjectObjs) {
                $result['TObjectObjs'] = $this->collTObjectObjs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTPeriodPers) {
                $result['TPeriodPers'] = $this->collTPeriodPers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTPlagePlas) {
                $result['TPlagePlas'] = $this->collTPlagePlas->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTPurchasePurs) {
                $result['TPurchasePurs'] = $this->collTPurchasePurs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TFundationFunPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setName($value);
                break;
            case 2:
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
        $keys = TFundationFunPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setRemoved($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TFundationFunPeer::DATABASE_NAME);

        if ($this->isColumnModified(TFundationFunPeer::FUN_ID)) $criteria->add(TFundationFunPeer::FUN_ID, $this->fun_id);
        if ($this->isColumnModified(TFundationFunPeer::FUN_NAME)) $criteria->add(TFundationFunPeer::FUN_NAME, $this->fun_name);
        if ($this->isColumnModified(TFundationFunPeer::FUN_REMOVED)) $criteria->add(TFundationFunPeer::FUN_REMOVED, $this->fun_removed);

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
        $criteria = new Criteria(TFundationFunPeer::DATABASE_NAME);
        $criteria->add(TFundationFunPeer::FUN_ID, $this->fun_id);

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
     * Generic method to set the primary key (fun_id column).
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
     * @param object $copyObj An object of TFundationFun (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setRemoved($this->getRemoved());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getTGroupGrps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTGroupGrp($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTObjectObjs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTObjectObj($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTPeriodPers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTPeriodPer($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTPlagePlas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTPlagePla($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTPurchasePurs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTPurchasePur($relObj->copy($deepCopy));
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
     * @return TFundationFun Clone of current object.
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
     * @return TFundationFunPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TFundationFunPeer();
        }

        return self::$peer;
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
        if ('TGroupGrp' == $relationName) {
            $this->initTGroupGrps();
        }
        if ('TObjectObj' == $relationName) {
            $this->initTObjectObjs();
        }
        if ('TPeriodPer' == $relationName) {
            $this->initTPeriodPers();
        }
        if ('TPlagePla' == $relationName) {
            $this->initTPlagePlas();
        }
        if ('TPurchasePur' == $relationName) {
            $this->initTPurchasePurs();
        }
        if ('TjUsrRigJur' == $relationName) {
            $this->initTjUsrRigJurs();
        }
    }

    /**
     * Clears out the collTGroupGrps collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTGroupGrps()
     */
    public function clearTGroupGrps()
    {
        $this->collTGroupGrps = null; // important to set this to null since that means it is uninitialized
        $this->collTGroupGrpsPartial = null;
    }

    /**
     * reset is the collTGroupGrps collection loaded partially
     *
     * @return void
     */
    public function resetPartialTGroupGrps($v = true)
    {
        $this->collTGroupGrpsPartial = $v;
    }

    /**
     * Initializes the collTGroupGrps collection.
     *
     * By default this just sets the collTGroupGrps collection to an empty array (like clearcollTGroupGrps());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTGroupGrps($overrideExisting = true)
    {
        if (null !== $this->collTGroupGrps && !$overrideExisting) {
            return;
        }
        $this->collTGroupGrps = new PropelObjectCollection();
        $this->collTGroupGrps->setModel('TGroupGrp');
    }

    /**
     * Gets an array of TGroupGrp objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TFundationFun is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TGroupGrp[] List of TGroupGrp objects
     * @throws PropelException
     */
    public function getTGroupGrps($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTGroupGrpsPartial && !$this->isNew();
        if (null === $this->collTGroupGrps || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTGroupGrps) {
                // return empty collection
                $this->initTGroupGrps();
            } else {
                $collTGroupGrps = TGroupGrpQuery::create(null, $criteria)
                    ->filterByTFundationFun($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTGroupGrpsPartial && count($collTGroupGrps)) {
                      $this->initTGroupGrps(false);

                      foreach($collTGroupGrps as $obj) {
                        if (false == $this->collTGroupGrps->contains($obj)) {
                          $this->collTGroupGrps->append($obj);
                        }
                      }

                      $this->collTGroupGrpsPartial = true;
                    }

                    return $collTGroupGrps;
                }

                if($partial && $this->collTGroupGrps) {
                    foreach($this->collTGroupGrps as $obj) {
                        if($obj->isNew()) {
                            $collTGroupGrps[] = $obj;
                        }
                    }
                }

                $this->collTGroupGrps = $collTGroupGrps;
                $this->collTGroupGrpsPartial = false;
            }
        }

        return $this->collTGroupGrps;
    }

    /**
     * Sets a collection of TGroupGrp objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tGroupGrps A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTGroupGrps(PropelCollection $tGroupGrps, PropelPDO $con = null)
    {
        $this->tGroupGrpsScheduledForDeletion = $this->getTGroupGrps(new Criteria(), $con)->diff($tGroupGrps);

        foreach ($this->tGroupGrpsScheduledForDeletion as $tGroupGrpRemoved) {
            $tGroupGrpRemoved->setTFundationFun(null);
        }

        $this->collTGroupGrps = null;
        foreach ($tGroupGrps as $tGroupGrp) {
            $this->addTGroupGrp($tGroupGrp);
        }

        $this->collTGroupGrps = $tGroupGrps;
        $this->collTGroupGrpsPartial = false;
    }

    /**
     * Returns the number of related TGroupGrp objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TGroupGrp objects.
     * @throws PropelException
     */
    public function countTGroupGrps(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTGroupGrpsPartial && !$this->isNew();
        if (null === $this->collTGroupGrps || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTGroupGrps) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTGroupGrps());
                }
                $query = TGroupGrpQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTFundationFun($this)
                    ->count($con);
            }
        } else {
            return count($this->collTGroupGrps);
        }
    }

    /**
     * Method called to associate a TGroupGrp object to this object
     * through the TGroupGrp foreign key attribute.
     *
     * @param    TGroupGrp $l TGroupGrp
     * @return TFundationFun The current object (for fluent API support)
     */
    public function addTGroupGrp(TGroupGrp $l)
    {
        if ($this->collTGroupGrps === null) {
            $this->initTGroupGrps();
            $this->collTGroupGrpsPartial = true;
        }
        if (!in_array($l, $this->collTGroupGrps->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTGroupGrp($l);
        }

        return $this;
    }

    /**
     * @param	TGroupGrp $tGroupGrp The tGroupGrp object to add.
     */
    protected function doAddTGroupGrp($tGroupGrp)
    {
        $this->collTGroupGrps[]= $tGroupGrp;
        $tGroupGrp->setTFundationFun($this);
    }

    /**
     * @param	TGroupGrp $tGroupGrp The tGroupGrp object to remove.
     */
    public function removeTGroupGrp($tGroupGrp)
    {
        if ($this->getTGroupGrps()->contains($tGroupGrp)) {
            $this->collTGroupGrps->remove($this->collTGroupGrps->search($tGroupGrp));
            if (null === $this->tGroupGrpsScheduledForDeletion) {
                $this->tGroupGrpsScheduledForDeletion = clone $this->collTGroupGrps;
                $this->tGroupGrpsScheduledForDeletion->clear();
            }
            $this->tGroupGrpsScheduledForDeletion[]= $tGroupGrp;
            $tGroupGrp->setTFundationFun(null);
        }
    }

    /**
     * Clears out the collTObjectObjs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTObjectObjs()
     */
    public function clearTObjectObjs()
    {
        $this->collTObjectObjs = null; // important to set this to null since that means it is uninitialized
        $this->collTObjectObjsPartial = null;
    }

    /**
     * reset is the collTObjectObjs collection loaded partially
     *
     * @return void
     */
    public function resetPartialTObjectObjs($v = true)
    {
        $this->collTObjectObjsPartial = $v;
    }

    /**
     * Initializes the collTObjectObjs collection.
     *
     * By default this just sets the collTObjectObjs collection to an empty array (like clearcollTObjectObjs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTObjectObjs($overrideExisting = true)
    {
        if (null !== $this->collTObjectObjs && !$overrideExisting) {
            return;
        }
        $this->collTObjectObjs = new PropelObjectCollection();
        $this->collTObjectObjs->setModel('TObjectObj');
    }

    /**
     * Gets an array of TObjectObj objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TFundationFun is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TObjectObj[] List of TObjectObj objects
     * @throws PropelException
     */
    public function getTObjectObjs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTObjectObjsPartial && !$this->isNew();
        if (null === $this->collTObjectObjs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTObjectObjs) {
                // return empty collection
                $this->initTObjectObjs();
            } else {
                $collTObjectObjs = TObjectObjQuery::create(null, $criteria)
                    ->filterByTFundationFun($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTObjectObjsPartial && count($collTObjectObjs)) {
                      $this->initTObjectObjs(false);

                      foreach($collTObjectObjs as $obj) {
                        if (false == $this->collTObjectObjs->contains($obj)) {
                          $this->collTObjectObjs->append($obj);
                        }
                      }

                      $this->collTObjectObjsPartial = true;
                    }

                    return $collTObjectObjs;
                }

                if($partial && $this->collTObjectObjs) {
                    foreach($this->collTObjectObjs as $obj) {
                        if($obj->isNew()) {
                            $collTObjectObjs[] = $obj;
                        }
                    }
                }

                $this->collTObjectObjs = $collTObjectObjs;
                $this->collTObjectObjsPartial = false;
            }
        }

        return $this->collTObjectObjs;
    }

    /**
     * Sets a collection of TObjectObj objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tObjectObjs A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTObjectObjs(PropelCollection $tObjectObjs, PropelPDO $con = null)
    {
        $this->tObjectObjsScheduledForDeletion = $this->getTObjectObjs(new Criteria(), $con)->diff($tObjectObjs);

        foreach ($this->tObjectObjsScheduledForDeletion as $tObjectObjRemoved) {
            $tObjectObjRemoved->setTFundationFun(null);
        }

        $this->collTObjectObjs = null;
        foreach ($tObjectObjs as $tObjectObj) {
            $this->addTObjectObj($tObjectObj);
        }

        $this->collTObjectObjs = $tObjectObjs;
        $this->collTObjectObjsPartial = false;
    }

    /**
     * Returns the number of related TObjectObj objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TObjectObj objects.
     * @throws PropelException
     */
    public function countTObjectObjs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTObjectObjsPartial && !$this->isNew();
        if (null === $this->collTObjectObjs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTObjectObjs) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTObjectObjs());
                }
                $query = TObjectObjQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTFundationFun($this)
                    ->count($con);
            }
        } else {
            return count($this->collTObjectObjs);
        }
    }

    /**
     * Method called to associate a TObjectObj object to this object
     * through the TObjectObj foreign key attribute.
     *
     * @param    TObjectObj $l TObjectObj
     * @return TFundationFun The current object (for fluent API support)
     */
    public function addTObjectObj(TObjectObj $l)
    {
        if ($this->collTObjectObjs === null) {
            $this->initTObjectObjs();
            $this->collTObjectObjsPartial = true;
        }
        if (!in_array($l, $this->collTObjectObjs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTObjectObj($l);
        }

        return $this;
    }

    /**
     * @param	TObjectObj $tObjectObj The tObjectObj object to add.
     */
    protected function doAddTObjectObj($tObjectObj)
    {
        $this->collTObjectObjs[]= $tObjectObj;
        $tObjectObj->setTFundationFun($this);
    }

    /**
     * @param	TObjectObj $tObjectObj The tObjectObj object to remove.
     */
    public function removeTObjectObj($tObjectObj)
    {
        if ($this->getTObjectObjs()->contains($tObjectObj)) {
            $this->collTObjectObjs->remove($this->collTObjectObjs->search($tObjectObj));
            if (null === $this->tObjectObjsScheduledForDeletion) {
                $this->tObjectObjsScheduledForDeletion = clone $this->collTObjectObjs;
                $this->tObjectObjsScheduledForDeletion->clear();
            }
            $this->tObjectObjsScheduledForDeletion[]= $tObjectObj;
            $tObjectObj->setTFundationFun(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TFundationFun is new, it will return
     * an empty collection; or if this TFundationFun has previously
     * been saved, it will retrieve related TObjectObjs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TFundationFun.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TObjectObj[] List of TObjectObj objects
     */
    public function getTObjectObjsJoinTsImageImg($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TObjectObjQuery::create(null, $criteria);
        $query->joinWith('TsImageImg', $join_behavior);

        return $this->getTObjectObjs($query, $con);
    }

    /**
     * Clears out the collTPeriodPers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTPeriodPers()
     */
    public function clearTPeriodPers()
    {
        $this->collTPeriodPers = null; // important to set this to null since that means it is uninitialized
        $this->collTPeriodPersPartial = null;
    }

    /**
     * reset is the collTPeriodPers collection loaded partially
     *
     * @return void
     */
    public function resetPartialTPeriodPers($v = true)
    {
        $this->collTPeriodPersPartial = $v;
    }

    /**
     * Initializes the collTPeriodPers collection.
     *
     * By default this just sets the collTPeriodPers collection to an empty array (like clearcollTPeriodPers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTPeriodPers($overrideExisting = true)
    {
        if (null !== $this->collTPeriodPers && !$overrideExisting) {
            return;
        }
        $this->collTPeriodPers = new PropelObjectCollection();
        $this->collTPeriodPers->setModel('TPeriodPer');
    }

    /**
     * Gets an array of TPeriodPer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TFundationFun is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TPeriodPer[] List of TPeriodPer objects
     * @throws PropelException
     */
    public function getTPeriodPers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTPeriodPersPartial && !$this->isNew();
        if (null === $this->collTPeriodPers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTPeriodPers) {
                // return empty collection
                $this->initTPeriodPers();
            } else {
                $collTPeriodPers = TPeriodPerQuery::create(null, $criteria)
                    ->filterByTFundationFun($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTPeriodPersPartial && count($collTPeriodPers)) {
                      $this->initTPeriodPers(false);

                      foreach($collTPeriodPers as $obj) {
                        if (false == $this->collTPeriodPers->contains($obj)) {
                          $this->collTPeriodPers->append($obj);
                        }
                      }

                      $this->collTPeriodPersPartial = true;
                    }

                    return $collTPeriodPers;
                }

                if($partial && $this->collTPeriodPers) {
                    foreach($this->collTPeriodPers as $obj) {
                        if($obj->isNew()) {
                            $collTPeriodPers[] = $obj;
                        }
                    }
                }

                $this->collTPeriodPers = $collTPeriodPers;
                $this->collTPeriodPersPartial = false;
            }
        }

        return $this->collTPeriodPers;
    }

    /**
     * Sets a collection of TPeriodPer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tPeriodPers A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTPeriodPers(PropelCollection $tPeriodPers, PropelPDO $con = null)
    {
        $this->tPeriodPersScheduledForDeletion = $this->getTPeriodPers(new Criteria(), $con)->diff($tPeriodPers);

        foreach ($this->tPeriodPersScheduledForDeletion as $tPeriodPerRemoved) {
            $tPeriodPerRemoved->setTFundationFun(null);
        }

        $this->collTPeriodPers = null;
        foreach ($tPeriodPers as $tPeriodPer) {
            $this->addTPeriodPer($tPeriodPer);
        }

        $this->collTPeriodPers = $tPeriodPers;
        $this->collTPeriodPersPartial = false;
    }

    /**
     * Returns the number of related TPeriodPer objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TPeriodPer objects.
     * @throws PropelException
     */
    public function countTPeriodPers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTPeriodPersPartial && !$this->isNew();
        if (null === $this->collTPeriodPers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTPeriodPers) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTPeriodPers());
                }
                $query = TPeriodPerQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTFundationFun($this)
                    ->count($con);
            }
        } else {
            return count($this->collTPeriodPers);
        }
    }

    /**
     * Method called to associate a TPeriodPer object to this object
     * through the TPeriodPer foreign key attribute.
     *
     * @param    TPeriodPer $l TPeriodPer
     * @return TFundationFun The current object (for fluent API support)
     */
    public function addTPeriodPer(TPeriodPer $l)
    {
        if ($this->collTPeriodPers === null) {
            $this->initTPeriodPers();
            $this->collTPeriodPersPartial = true;
        }
        if (!in_array($l, $this->collTPeriodPers->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTPeriodPer($l);
        }

        return $this;
    }

    /**
     * @param	TPeriodPer $tPeriodPer The tPeriodPer object to add.
     */
    protected function doAddTPeriodPer($tPeriodPer)
    {
        $this->collTPeriodPers[]= $tPeriodPer;
        $tPeriodPer->setTFundationFun($this);
    }

    /**
     * @param	TPeriodPer $tPeriodPer The tPeriodPer object to remove.
     */
    public function removeTPeriodPer($tPeriodPer)
    {
        if ($this->getTPeriodPers()->contains($tPeriodPer)) {
            $this->collTPeriodPers->remove($this->collTPeriodPers->search($tPeriodPer));
            if (null === $this->tPeriodPersScheduledForDeletion) {
                $this->tPeriodPersScheduledForDeletion = clone $this->collTPeriodPers;
                $this->tPeriodPersScheduledForDeletion->clear();
            }
            $this->tPeriodPersScheduledForDeletion[]= $tPeriodPer;
            $tPeriodPer->setTFundationFun(null);
        }
    }

    /**
     * Clears out the collTPlagePlas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTPlagePlas()
     */
    public function clearTPlagePlas()
    {
        $this->collTPlagePlas = null; // important to set this to null since that means it is uninitialized
        $this->collTPlagePlasPartial = null;
    }

    /**
     * reset is the collTPlagePlas collection loaded partially
     *
     * @return void
     */
    public function resetPartialTPlagePlas($v = true)
    {
        $this->collTPlagePlasPartial = $v;
    }

    /**
     * Initializes the collTPlagePlas collection.
     *
     * By default this just sets the collTPlagePlas collection to an empty array (like clearcollTPlagePlas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTPlagePlas($overrideExisting = true)
    {
        if (null !== $this->collTPlagePlas && !$overrideExisting) {
            return;
        }
        $this->collTPlagePlas = new PropelObjectCollection();
        $this->collTPlagePlas->setModel('TPlagePla');
    }

    /**
     * Gets an array of TPlagePla objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TFundationFun is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TPlagePla[] List of TPlagePla objects
     * @throws PropelException
     */
    public function getTPlagePlas($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTPlagePlasPartial && !$this->isNew();
        if (null === $this->collTPlagePlas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTPlagePlas) {
                // return empty collection
                $this->initTPlagePlas();
            } else {
                $collTPlagePlas = TPlagePlaQuery::create(null, $criteria)
                    ->filterByTFundationFun($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTPlagePlasPartial && count($collTPlagePlas)) {
                      $this->initTPlagePlas(false);

                      foreach($collTPlagePlas as $obj) {
                        if (false == $this->collTPlagePlas->contains($obj)) {
                          $this->collTPlagePlas->append($obj);
                        }
                      }

                      $this->collTPlagePlasPartial = true;
                    }

                    return $collTPlagePlas;
                }

                if($partial && $this->collTPlagePlas) {
                    foreach($this->collTPlagePlas as $obj) {
                        if($obj->isNew()) {
                            $collTPlagePlas[] = $obj;
                        }
                    }
                }

                $this->collTPlagePlas = $collTPlagePlas;
                $this->collTPlagePlasPartial = false;
            }
        }

        return $this->collTPlagePlas;
    }

    /**
     * Sets a collection of TPlagePla objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tPlagePlas A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTPlagePlas(PropelCollection $tPlagePlas, PropelPDO $con = null)
    {
        $this->tPlagePlasScheduledForDeletion = $this->getTPlagePlas(new Criteria(), $con)->diff($tPlagePlas);

        foreach ($this->tPlagePlasScheduledForDeletion as $tPlagePlaRemoved) {
            $tPlagePlaRemoved->setTFundationFun(null);
        }

        $this->collTPlagePlas = null;
        foreach ($tPlagePlas as $tPlagePla) {
            $this->addTPlagePla($tPlagePla);
        }

        $this->collTPlagePlas = $tPlagePlas;
        $this->collTPlagePlasPartial = false;
    }

    /**
     * Returns the number of related TPlagePla objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TPlagePla objects.
     * @throws PropelException
     */
    public function countTPlagePlas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTPlagePlasPartial && !$this->isNew();
        if (null === $this->collTPlagePlas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTPlagePlas) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTPlagePlas());
                }
                $query = TPlagePlaQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTFundationFun($this)
                    ->count($con);
            }
        } else {
            return count($this->collTPlagePlas);
        }
    }

    /**
     * Method called to associate a TPlagePla object to this object
     * through the TPlagePla foreign key attribute.
     *
     * @param    TPlagePla $l TPlagePla
     * @return TFundationFun The current object (for fluent API support)
     */
    public function addTPlagePla(TPlagePla $l)
    {
        if ($this->collTPlagePlas === null) {
            $this->initTPlagePlas();
            $this->collTPlagePlasPartial = true;
        }
        if (!in_array($l, $this->collTPlagePlas->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTPlagePla($l);
        }

        return $this;
    }

    /**
     * @param	TPlagePla $tPlagePla The tPlagePla object to add.
     */
    protected function doAddTPlagePla($tPlagePla)
    {
        $this->collTPlagePlas[]= $tPlagePla;
        $tPlagePla->setTFundationFun($this);
    }

    /**
     * @param	TPlagePla $tPlagePla The tPlagePla object to remove.
     */
    public function removeTPlagePla($tPlagePla)
    {
        if ($this->getTPlagePlas()->contains($tPlagePla)) {
            $this->collTPlagePlas->remove($this->collTPlagePlas->search($tPlagePla));
            if (null === $this->tPlagePlasScheduledForDeletion) {
                $this->tPlagePlasScheduledForDeletion = clone $this->collTPlagePlas;
                $this->tPlagePlasScheduledForDeletion->clear();
            }
            $this->tPlagePlasScheduledForDeletion[]= $tPlagePla;
            $tPlagePla->setTFundationFun(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TFundationFun is new, it will return
     * an empty collection; or if this TFundationFun has previously
     * been saved, it will retrieve related TPlagePlas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TFundationFun.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPlagePla[] List of TPlagePla objects
     */
    public function getTPlagePlasJoinTPointPoi($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPlagePlaQuery::create(null, $criteria);
        $query->joinWith('TPointPoi', $join_behavior);

        return $this->getTPlagePlas($query, $con);
    }

    /**
     * Clears out the collTPurchasePurs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTPurchasePurs()
     */
    public function clearTPurchasePurs()
    {
        $this->collTPurchasePurs = null; // important to set this to null since that means it is uninitialized
        $this->collTPurchasePursPartial = null;
    }

    /**
     * reset is the collTPurchasePurs collection loaded partially
     *
     * @return void
     */
    public function resetPartialTPurchasePurs($v = true)
    {
        $this->collTPurchasePursPartial = $v;
    }

    /**
     * Initializes the collTPurchasePurs collection.
     *
     * By default this just sets the collTPurchasePurs collection to an empty array (like clearcollTPurchasePurs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTPurchasePurs($overrideExisting = true)
    {
        if (null !== $this->collTPurchasePurs && !$overrideExisting) {
            return;
        }
        $this->collTPurchasePurs = new PropelObjectCollection();
        $this->collTPurchasePurs->setModel('TPurchasePur');
    }

    /**
     * Gets an array of TPurchasePur objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TFundationFun is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     * @throws PropelException
     */
    public function getTPurchasePurs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTPurchasePursPartial && !$this->isNew();
        if (null === $this->collTPurchasePurs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTPurchasePurs) {
                // return empty collection
                $this->initTPurchasePurs();
            } else {
                $collTPurchasePurs = TPurchasePurQuery::create(null, $criteria)
                    ->filterByTFundationFun($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTPurchasePursPartial && count($collTPurchasePurs)) {
                      $this->initTPurchasePurs(false);

                      foreach($collTPurchasePurs as $obj) {
                        if (false == $this->collTPurchasePurs->contains($obj)) {
                          $this->collTPurchasePurs->append($obj);
                        }
                      }

                      $this->collTPurchasePursPartial = true;
                    }

                    return $collTPurchasePurs;
                }

                if($partial && $this->collTPurchasePurs) {
                    foreach($this->collTPurchasePurs as $obj) {
                        if($obj->isNew()) {
                            $collTPurchasePurs[] = $obj;
                        }
                    }
                }

                $this->collTPurchasePurs = $collTPurchasePurs;
                $this->collTPurchasePursPartial = false;
            }
        }

        return $this->collTPurchasePurs;
    }

    /**
     * Sets a collection of TPurchasePur objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tPurchasePurs A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTPurchasePurs(PropelCollection $tPurchasePurs, PropelPDO $con = null)
    {
        $this->tPurchasePursScheduledForDeletion = $this->getTPurchasePurs(new Criteria(), $con)->diff($tPurchasePurs);

        foreach ($this->tPurchasePursScheduledForDeletion as $tPurchasePurRemoved) {
            $tPurchasePurRemoved->setTFundationFun(null);
        }

        $this->collTPurchasePurs = null;
        foreach ($tPurchasePurs as $tPurchasePur) {
            $this->addTPurchasePur($tPurchasePur);
        }

        $this->collTPurchasePurs = $tPurchasePurs;
        $this->collTPurchasePursPartial = false;
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
    public function countTPurchasePurs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTPurchasePursPartial && !$this->isNew();
        if (null === $this->collTPurchasePurs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTPurchasePurs) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTPurchasePurs());
                }
                $query = TPurchasePurQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTFundationFun($this)
                    ->count($con);
            }
        } else {
            return count($this->collTPurchasePurs);
        }
    }

    /**
     * Method called to associate a TPurchasePur object to this object
     * through the TPurchasePur foreign key attribute.
     *
     * @param    TPurchasePur $l TPurchasePur
     * @return TFundationFun The current object (for fluent API support)
     */
    public function addTPurchasePur(TPurchasePur $l)
    {
        if ($this->collTPurchasePurs === null) {
            $this->initTPurchasePurs();
            $this->collTPurchasePursPartial = true;
        }
        if (!in_array($l, $this->collTPurchasePurs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTPurchasePur($l);
        }

        return $this;
    }

    /**
     * @param	TPurchasePur $tPurchasePur The tPurchasePur object to add.
     */
    protected function doAddTPurchasePur($tPurchasePur)
    {
        $this->collTPurchasePurs[]= $tPurchasePur;
        $tPurchasePur->setTFundationFun($this);
    }

    /**
     * @param	TPurchasePur $tPurchasePur The tPurchasePur object to remove.
     */
    public function removeTPurchasePur($tPurchasePur)
    {
        if ($this->getTPurchasePurs()->contains($tPurchasePur)) {
            $this->collTPurchasePurs->remove($this->collTPurchasePurs->search($tPurchasePur));
            if (null === $this->tPurchasePursScheduledForDeletion) {
                $this->tPurchasePursScheduledForDeletion = clone $this->collTPurchasePurs;
                $this->tPurchasePursScheduledForDeletion->clear();
            }
            $this->tPurchasePursScheduledForDeletion[]= $tPurchasePur;
            $tPurchasePur->setTFundationFun(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TFundationFun is new, it will return
     * an empty collection; or if this TFundationFun has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TFundationFun.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursJoinTObjectObj($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TObjectObj', $join_behavior);

        return $this->getTPurchasePurs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TFundationFun is new, it will return
     * an empty collection; or if this TFundationFun has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TFundationFun.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursJoinTsUserUsrRelatedByUsrIdBuyer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TsUserUsrRelatedByUsrIdBuyer', $join_behavior);

        return $this->getTPurchasePurs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TFundationFun is new, it will return
     * an empty collection; or if this TFundationFun has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TFundationFun.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursJoinTsUserUsrRelatedByUsrIdSeller($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TsUserUsrRelatedByUsrIdSeller', $join_behavior);

        return $this->getTPurchasePurs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TFundationFun is new, it will return
     * an empty collection; or if this TFundationFun has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TFundationFun.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursJoinTPointPoi($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TPointPoi', $join_behavior);

        return $this->getTPurchasePurs($query, $con);
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
     * If this TFundationFun is new, it will return
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
                    ->filterByTFundationFun($this)
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
            $tjUsrRigJurRemoved->setTFundationFun(null);
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
                    ->filterByTFundationFun($this)
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
     * @return TFundationFun The current object (for fluent API support)
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
        $tjUsrRigJur->setTFundationFun($this);
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
            $tjUsrRigJur->setTFundationFun(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TFundationFun is new, it will return
     * an empty collection; or if this TFundationFun has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TFundationFun.
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
     * Otherwise if this TFundationFun is new, it will return
     * an empty collection; or if this TFundationFun has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TFundationFun.
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
     * Otherwise if this TFundationFun is new, it will return
     * an empty collection; or if this TFundationFun has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TFundationFun.
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
     * Otherwise if this TFundationFun is new, it will return
     * an empty collection; or if this TFundationFun has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TFundationFun.
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
        $this->fun_id = null;
        $this->fun_name = null;
        $this->fun_removed = null;
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
            if ($this->collTGroupGrps) {
                foreach ($this->collTGroupGrps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTObjectObjs) {
                foreach ($this->collTObjectObjs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTPeriodPers) {
                foreach ($this->collTPeriodPers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTPlagePlas) {
                foreach ($this->collTPlagePlas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTPurchasePurs) {
                foreach ($this->collTPurchasePurs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTjUsrRigJurs) {
                foreach ($this->collTjUsrRigJurs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collTGroupGrps instanceof PropelCollection) {
            $this->collTGroupGrps->clearIterator();
        }
        $this->collTGroupGrps = null;
        if ($this->collTObjectObjs instanceof PropelCollection) {
            $this->collTObjectObjs->clearIterator();
        }
        $this->collTObjectObjs = null;
        if ($this->collTPeriodPers instanceof PropelCollection) {
            $this->collTPeriodPers->clearIterator();
        }
        $this->collTPeriodPers = null;
        if ($this->collTPlagePlas instanceof PropelCollection) {
            $this->collTPlagePlas->clearIterator();
        }
        $this->collTPlagePlas = null;
        if ($this->collTPurchasePurs instanceof PropelCollection) {
            $this->collTPurchasePurs->clearIterator();
        }
        $this->collTPurchasePurs = null;
        if ($this->collTjUsrRigJurs instanceof PropelCollection) {
            $this->collTjUsrRigJurs->clearIterator();
        }
        $this->collTjUsrRigJurs = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TFundationFunPeer::DEFAULT_STRING_FORMAT);
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
