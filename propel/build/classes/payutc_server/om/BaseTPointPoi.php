<?php


/**
 * Base class that represents a row from the 't_point_poi' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTPointPoi extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TPointPoiPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TPointPoiPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the poi_id field.
     * @var        int
     */
    protected $poi_id;

    /**
     * The value for the poi_name field.
     * @var        string
     */
    protected $poi_name;

    /**
     * The value for the poi_removed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $poi_removed;

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
     * @var        PropelObjectCollection|TRechargeRec[] Collection to store aggregation of TRechargeRec objects.
     */
    protected $collTRechargeRecs;
    protected $collTRechargeRecsPartial;

    /**
     * @var        PropelObjectCollection|TjObjPoiJop[] Collection to store aggregation of TjObjPoiJop objects.
     */
    protected $collTjObjPoiJops;
    protected $collTjObjPoiJopsPartial;

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
    protected $tRechargeRecsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tjObjPoiJopsScheduledForDeletion = null;

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
        $this->poi_removed = false;
    }

    /**
     * Initializes internal state of BaseTPointPoi object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [poi_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->poi_id;
    }

    /**
     * Get the [poi_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->poi_name;
    }

    /**
     * Get the [poi_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->poi_removed;
    }

    /**
     * Set the value of [poi_id] column.
     *
     * @param int $v new value
     * @return TPointPoi The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->poi_id !== $v) {
            $this->poi_id = $v;
            $this->modifiedColumns[] = TPointPoiPeer::POI_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [poi_name] column.
     *
     * @param string $v new value
     * @return TPointPoi The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->poi_name !== $v) {
            $this->poi_name = $v;
            $this->modifiedColumns[] = TPointPoiPeer::POI_NAME;
        }


        return $this;
    } // setName()

    /**
     * Sets the value of the [poi_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return TPointPoi The current object (for fluent API support)
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

        if ($this->poi_removed !== $v) {
            $this->poi_removed = $v;
            $this->modifiedColumns[] = TPointPoiPeer::POI_REMOVED;
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
            if ($this->poi_removed !== false) {
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

            $this->poi_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->poi_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->poi_removed = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = TPointPoiPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TPointPoi object", $e);
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
            $con = Propel::getConnection(TPointPoiPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TPointPoiPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collTPlagePlas = null;

            $this->collTPurchasePurs = null;

            $this->collTRechargeRecs = null;

            $this->collTjObjPoiJops = null;

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
            $con = Propel::getConnection(TPointPoiPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TPointPoiQuery::create()
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
            $con = Propel::getConnection(TPointPoiPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TPointPoiPeer::addInstanceToPool($this);
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

            if ($this->tRechargeRecsScheduledForDeletion !== null) {
                if (!$this->tRechargeRecsScheduledForDeletion->isEmpty()) {
                    TRechargeRecQuery::create()
                        ->filterByPrimaryKeys($this->tRechargeRecsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tRechargeRecsScheduledForDeletion = null;
                }
            }

            if ($this->collTRechargeRecs !== null) {
                foreach ($this->collTRechargeRecs as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tjObjPoiJopsScheduledForDeletion !== null) {
                if (!$this->tjObjPoiJopsScheduledForDeletion->isEmpty()) {
                    TjObjPoiJopQuery::create()
                        ->filterByPrimaryKeys($this->tjObjPoiJopsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tjObjPoiJopsScheduledForDeletion = null;
                }
            }

            if ($this->collTjObjPoiJops !== null) {
                foreach ($this->collTjObjPoiJops as $referrerFK) {
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

        $this->modifiedColumns[] = TPointPoiPeer::POI_ID;
        if (null !== $this->poi_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TPointPoiPeer::POI_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TPointPoiPeer::POI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`POI_ID`';
        }
        if ($this->isColumnModified(TPointPoiPeer::POI_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`POI_NAME`';
        }
        if ($this->isColumnModified(TPointPoiPeer::POI_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`POI_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `t_point_poi` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`POI_ID`':
                        $stmt->bindValue($identifier, $this->poi_id, PDO::PARAM_INT);
                        break;
                    case '`POI_NAME`':
                        $stmt->bindValue($identifier, $this->poi_name, PDO::PARAM_STR);
                        break;
                    case '`POI_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->poi_removed, PDO::PARAM_INT);
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


            if (($retval = TPointPoiPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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

                if ($this->collTRechargeRecs !== null) {
                    foreach ($this->collTRechargeRecs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTjObjPoiJops !== null) {
                    foreach ($this->collTjObjPoiJops as $referrerFK) {
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
        $pos = TPointPoiPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['TPointPoi'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TPointPoi'][$this->getPrimaryKey()] = true;
        $keys = TPointPoiPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collTPlagePlas) {
                $result['TPlagePlas'] = $this->collTPlagePlas->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTPurchasePurs) {
                $result['TPurchasePurs'] = $this->collTPurchasePurs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTRechargeRecs) {
                $result['TRechargeRecs'] = $this->collTRechargeRecs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTjObjPoiJops) {
                $result['TjObjPoiJops'] = $this->collTjObjPoiJops->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TPointPoiPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
        $keys = TPointPoiPeer::getFieldNames($keyType);

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
        $criteria = new Criteria(TPointPoiPeer::DATABASE_NAME);

        if ($this->isColumnModified(TPointPoiPeer::POI_ID)) $criteria->add(TPointPoiPeer::POI_ID, $this->poi_id);
        if ($this->isColumnModified(TPointPoiPeer::POI_NAME)) $criteria->add(TPointPoiPeer::POI_NAME, $this->poi_name);
        if ($this->isColumnModified(TPointPoiPeer::POI_REMOVED)) $criteria->add(TPointPoiPeer::POI_REMOVED, $this->poi_removed);

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
        $criteria = new Criteria(TPointPoiPeer::DATABASE_NAME);
        $criteria->add(TPointPoiPeer::POI_ID, $this->poi_id);

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
     * Generic method to set the primary key (poi_id column).
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
     * @param object $copyObj An object of TPointPoi (or compatible) type.
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

            foreach ($this->getTRechargeRecs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTRechargeRec($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTjObjPoiJops() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTjObjPoiJop($relObj->copy($deepCopy));
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
     * @return TPointPoi Clone of current object.
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
     * @return TPointPoiPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TPointPoiPeer();
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
        if ('TPlagePla' == $relationName) {
            $this->initTPlagePlas();
        }
        if ('TPurchasePur' == $relationName) {
            $this->initTPurchasePurs();
        }
        if ('TRechargeRec' == $relationName) {
            $this->initTRechargeRecs();
        }
        if ('TjObjPoiJop' == $relationName) {
            $this->initTjObjPoiJops();
        }
        if ('TjUsrRigJur' == $relationName) {
            $this->initTjUsrRigJurs();
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
     * If this TPointPoi is new, it will return
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
                    ->filterByTPointPoi($this)
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
            $tPlagePlaRemoved->setTPointPoi(null);
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
                    ->filterByTPointPoi($this)
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
     * @return TPointPoi The current object (for fluent API support)
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
        $tPlagePla->setTPointPoi($this);
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
            $tPlagePla->setTPointPoi(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TPlagePlas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPlagePla[] List of TPlagePla objects
     */
    public function getTPlagePlasJoinTFundationFun($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPlagePlaQuery::create(null, $criteria);
        $query->joinWith('TFundationFun', $join_behavior);

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
     * If this TPointPoi is new, it will return
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
                    ->filterByTPointPoi($this)
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
            $tPurchasePurRemoved->setTPointPoi(null);
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
                    ->filterByTPointPoi($this)
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
     * @return TPointPoi The current object (for fluent API support)
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
        $tPurchasePur->setTPointPoi($this);
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
            $tPurchasePur->setTPointPoi(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
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
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
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
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
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
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursJoinTFundationFun($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TFundationFun', $join_behavior);

        return $this->getTPurchasePurs($query, $con);
    }

    /**
     * Clears out the collTRechargeRecs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTRechargeRecs()
     */
    public function clearTRechargeRecs()
    {
        $this->collTRechargeRecs = null; // important to set this to null since that means it is uninitialized
        $this->collTRechargeRecsPartial = null;
    }

    /**
     * reset is the collTRechargeRecs collection loaded partially
     *
     * @return void
     */
    public function resetPartialTRechargeRecs($v = true)
    {
        $this->collTRechargeRecsPartial = $v;
    }

    /**
     * Initializes the collTRechargeRecs collection.
     *
     * By default this just sets the collTRechargeRecs collection to an empty array (like clearcollTRechargeRecs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTRechargeRecs($overrideExisting = true)
    {
        if (null !== $this->collTRechargeRecs && !$overrideExisting) {
            return;
        }
        $this->collTRechargeRecs = new PropelObjectCollection();
        $this->collTRechargeRecs->setModel('TRechargeRec');
    }

    /**
     * Gets an array of TRechargeRec objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TPointPoi is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TRechargeRec[] List of TRechargeRec objects
     * @throws PropelException
     */
    public function getTRechargeRecs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTRechargeRecsPartial && !$this->isNew();
        if (null === $this->collTRechargeRecs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTRechargeRecs) {
                // return empty collection
                $this->initTRechargeRecs();
            } else {
                $collTRechargeRecs = TRechargeRecQuery::create(null, $criteria)
                    ->filterByTPointPoi($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTRechargeRecsPartial && count($collTRechargeRecs)) {
                      $this->initTRechargeRecs(false);

                      foreach($collTRechargeRecs as $obj) {
                        if (false == $this->collTRechargeRecs->contains($obj)) {
                          $this->collTRechargeRecs->append($obj);
                        }
                      }

                      $this->collTRechargeRecsPartial = true;
                    }

                    return $collTRechargeRecs;
                }

                if($partial && $this->collTRechargeRecs) {
                    foreach($this->collTRechargeRecs as $obj) {
                        if($obj->isNew()) {
                            $collTRechargeRecs[] = $obj;
                        }
                    }
                }

                $this->collTRechargeRecs = $collTRechargeRecs;
                $this->collTRechargeRecsPartial = false;
            }
        }

        return $this->collTRechargeRecs;
    }

    /**
     * Sets a collection of TRechargeRec objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tRechargeRecs A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTRechargeRecs(PropelCollection $tRechargeRecs, PropelPDO $con = null)
    {
        $this->tRechargeRecsScheduledForDeletion = $this->getTRechargeRecs(new Criteria(), $con)->diff($tRechargeRecs);

        foreach ($this->tRechargeRecsScheduledForDeletion as $tRechargeRecRemoved) {
            $tRechargeRecRemoved->setTPointPoi(null);
        }

        $this->collTRechargeRecs = null;
        foreach ($tRechargeRecs as $tRechargeRec) {
            $this->addTRechargeRec($tRechargeRec);
        }

        $this->collTRechargeRecs = $tRechargeRecs;
        $this->collTRechargeRecsPartial = false;
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
    public function countTRechargeRecs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTRechargeRecsPartial && !$this->isNew();
        if (null === $this->collTRechargeRecs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTRechargeRecs) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTRechargeRecs());
                }
                $query = TRechargeRecQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTPointPoi($this)
                    ->count($con);
            }
        } else {
            return count($this->collTRechargeRecs);
        }
    }

    /**
     * Method called to associate a TRechargeRec object to this object
     * through the TRechargeRec foreign key attribute.
     *
     * @param    TRechargeRec $l TRechargeRec
     * @return TPointPoi The current object (for fluent API support)
     */
    public function addTRechargeRec(TRechargeRec $l)
    {
        if ($this->collTRechargeRecs === null) {
            $this->initTRechargeRecs();
            $this->collTRechargeRecsPartial = true;
        }
        if (!in_array($l, $this->collTRechargeRecs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTRechargeRec($l);
        }

        return $this;
    }

    /**
     * @param	TRechargeRec $tRechargeRec The tRechargeRec object to add.
     */
    protected function doAddTRechargeRec($tRechargeRec)
    {
        $this->collTRechargeRecs[]= $tRechargeRec;
        $tRechargeRec->setTPointPoi($this);
    }

    /**
     * @param	TRechargeRec $tRechargeRec The tRechargeRec object to remove.
     */
    public function removeTRechargeRec($tRechargeRec)
    {
        if ($this->getTRechargeRecs()->contains($tRechargeRec)) {
            $this->collTRechargeRecs->remove($this->collTRechargeRecs->search($tRechargeRec));
            if (null === $this->tRechargeRecsScheduledForDeletion) {
                $this->tRechargeRecsScheduledForDeletion = clone $this->collTRechargeRecs;
                $this->tRechargeRecsScheduledForDeletion->clear();
            }
            $this->tRechargeRecsScheduledForDeletion[]= $tRechargeRec;
            $tRechargeRec->setTPointPoi(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TRechargeRecs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TRechargeRec[] List of TRechargeRec objects
     */
    public function getTRechargeRecsJoinTRechargeTypeRty($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TRechargeRecQuery::create(null, $criteria);
        $query->joinWith('TRechargeTypeRty', $join_behavior);

        return $this->getTRechargeRecs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TRechargeRecs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TRechargeRec[] List of TRechargeRec objects
     */
    public function getTRechargeRecsJoinTsUserUsrRelatedByUsrIdBuyer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TRechargeRecQuery::create(null, $criteria);
        $query->joinWith('TsUserUsrRelatedByUsrIdBuyer', $join_behavior);

        return $this->getTRechargeRecs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TRechargeRecs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TRechargeRec[] List of TRechargeRec objects
     */
    public function getTRechargeRecsJoinTsUserUsrRelatedByUsrIdOperator($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TRechargeRecQuery::create(null, $criteria);
        $query->joinWith('TsUserUsrRelatedByUsrIdOperator', $join_behavior);

        return $this->getTRechargeRecs($query, $con);
    }

    /**
     * Clears out the collTjObjPoiJops collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTjObjPoiJops()
     */
    public function clearTjObjPoiJops()
    {
        $this->collTjObjPoiJops = null; // important to set this to null since that means it is uninitialized
        $this->collTjObjPoiJopsPartial = null;
    }

    /**
     * reset is the collTjObjPoiJops collection loaded partially
     *
     * @return void
     */
    public function resetPartialTjObjPoiJops($v = true)
    {
        $this->collTjObjPoiJopsPartial = $v;
    }

    /**
     * Initializes the collTjObjPoiJops collection.
     *
     * By default this just sets the collTjObjPoiJops collection to an empty array (like clearcollTjObjPoiJops());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTjObjPoiJops($overrideExisting = true)
    {
        if (null !== $this->collTjObjPoiJops && !$overrideExisting) {
            return;
        }
        $this->collTjObjPoiJops = new PropelObjectCollection();
        $this->collTjObjPoiJops->setModel('TjObjPoiJop');
    }

    /**
     * Gets an array of TjObjPoiJop objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TPointPoi is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TjObjPoiJop[] List of TjObjPoiJop objects
     * @throws PropelException
     */
    public function getTjObjPoiJops($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTjObjPoiJopsPartial && !$this->isNew();
        if (null === $this->collTjObjPoiJops || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTjObjPoiJops) {
                // return empty collection
                $this->initTjObjPoiJops();
            } else {
                $collTjObjPoiJops = TjObjPoiJopQuery::create(null, $criteria)
                    ->filterByTPointPoi($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTjObjPoiJopsPartial && count($collTjObjPoiJops)) {
                      $this->initTjObjPoiJops(false);

                      foreach($collTjObjPoiJops as $obj) {
                        if (false == $this->collTjObjPoiJops->contains($obj)) {
                          $this->collTjObjPoiJops->append($obj);
                        }
                      }

                      $this->collTjObjPoiJopsPartial = true;
                    }

                    return $collTjObjPoiJops;
                }

                if($partial && $this->collTjObjPoiJops) {
                    foreach($this->collTjObjPoiJops as $obj) {
                        if($obj->isNew()) {
                            $collTjObjPoiJops[] = $obj;
                        }
                    }
                }

                $this->collTjObjPoiJops = $collTjObjPoiJops;
                $this->collTjObjPoiJopsPartial = false;
            }
        }

        return $this->collTjObjPoiJops;
    }

    /**
     * Sets a collection of TjObjPoiJop objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tjObjPoiJops A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTjObjPoiJops(PropelCollection $tjObjPoiJops, PropelPDO $con = null)
    {
        $this->tjObjPoiJopsScheduledForDeletion = $this->getTjObjPoiJops(new Criteria(), $con)->diff($tjObjPoiJops);

        foreach ($this->tjObjPoiJopsScheduledForDeletion as $tjObjPoiJopRemoved) {
            $tjObjPoiJopRemoved->setTPointPoi(null);
        }

        $this->collTjObjPoiJops = null;
        foreach ($tjObjPoiJops as $tjObjPoiJop) {
            $this->addTjObjPoiJop($tjObjPoiJop);
        }

        $this->collTjObjPoiJops = $tjObjPoiJops;
        $this->collTjObjPoiJopsPartial = false;
    }

    /**
     * Returns the number of related TjObjPoiJop objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TjObjPoiJop objects.
     * @throws PropelException
     */
    public function countTjObjPoiJops(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTjObjPoiJopsPartial && !$this->isNew();
        if (null === $this->collTjObjPoiJops || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTjObjPoiJops) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTjObjPoiJops());
                }
                $query = TjObjPoiJopQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTPointPoi($this)
                    ->count($con);
            }
        } else {
            return count($this->collTjObjPoiJops);
        }
    }

    /**
     * Method called to associate a TjObjPoiJop object to this object
     * through the TjObjPoiJop foreign key attribute.
     *
     * @param    TjObjPoiJop $l TjObjPoiJop
     * @return TPointPoi The current object (for fluent API support)
     */
    public function addTjObjPoiJop(TjObjPoiJop $l)
    {
        if ($this->collTjObjPoiJops === null) {
            $this->initTjObjPoiJops();
            $this->collTjObjPoiJopsPartial = true;
        }
        if (!in_array($l, $this->collTjObjPoiJops->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTjObjPoiJop($l);
        }

        return $this;
    }

    /**
     * @param	TjObjPoiJop $tjObjPoiJop The tjObjPoiJop object to add.
     */
    protected function doAddTjObjPoiJop($tjObjPoiJop)
    {
        $this->collTjObjPoiJops[]= $tjObjPoiJop;
        $tjObjPoiJop->setTPointPoi($this);
    }

    /**
     * @param	TjObjPoiJop $tjObjPoiJop The tjObjPoiJop object to remove.
     */
    public function removeTjObjPoiJop($tjObjPoiJop)
    {
        if ($this->getTjObjPoiJops()->contains($tjObjPoiJop)) {
            $this->collTjObjPoiJops->remove($this->collTjObjPoiJops->search($tjObjPoiJop));
            if (null === $this->tjObjPoiJopsScheduledForDeletion) {
                $this->tjObjPoiJopsScheduledForDeletion = clone $this->collTjObjPoiJops;
                $this->tjObjPoiJopsScheduledForDeletion->clear();
            }
            $this->tjObjPoiJopsScheduledForDeletion[]= $tjObjPoiJop;
            $tjObjPoiJop->setTPointPoi(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TjObjPoiJops from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TjObjPoiJop[] List of TjObjPoiJop objects
     */
    public function getTjObjPoiJopsJoinTObjectObj($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TjObjPoiJopQuery::create(null, $criteria);
        $query->joinWith('TObjectObj', $join_behavior);

        return $this->getTjObjPoiJops($query, $con);
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
     * If this TPointPoi is new, it will return
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
                    ->filterByTPointPoi($this)
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
            $tjUsrRigJurRemoved->setTPointPoi(null);
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
                    ->filterByTPointPoi($this)
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
     * @return TPointPoi The current object (for fluent API support)
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
        $tjUsrRigJur->setTPointPoi($this);
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
            $tjUsrRigJur->setTPointPoi(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
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
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
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
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
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
     * Otherwise if this TPointPoi is new, it will return
     * an empty collection; or if this TPointPoi has previously
     * been saved, it will retrieve related TjUsrRigJurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TPointPoi.
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
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->poi_id = null;
        $this->poi_name = null;
        $this->poi_removed = null;
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
            if ($this->collTRechargeRecs) {
                foreach ($this->collTRechargeRecs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTjObjPoiJops) {
                foreach ($this->collTjObjPoiJops as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTjUsrRigJurs) {
                foreach ($this->collTjUsrRigJurs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collTPlagePlas instanceof PropelCollection) {
            $this->collTPlagePlas->clearIterator();
        }
        $this->collTPlagePlas = null;
        if ($this->collTPurchasePurs instanceof PropelCollection) {
            $this->collTPurchasePurs->clearIterator();
        }
        $this->collTPurchasePurs = null;
        if ($this->collTRechargeRecs instanceof PropelCollection) {
            $this->collTRechargeRecs->clearIterator();
        }
        $this->collTRechargeRecs = null;
        if ($this->collTjObjPoiJops instanceof PropelCollection) {
            $this->collTjObjPoiJops->clearIterator();
        }
        $this->collTjObjPoiJops = null;
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
        return (string) $this->exportTo(TPointPoiPeer::DEFAULT_STRING_FORMAT);
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
