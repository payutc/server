<?php


/**
 * Base class that represents a row from the 't_recharge_type_rty' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTRechargeTypeRty extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TRechargeTypeRtyPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TRechargeTypeRtyPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the rty_id field.
     * @var        int
     */
    protected $rty_id;

    /**
     * The value for the rty_name field.
     * @var        string
     */
    protected $rty_name;

    /**
     * The value for the rty_type field.
     * @var        string
     */
    protected $rty_type;

    /**
     * The value for the rty_removed field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $rty_removed;

    /**
     * @var        PropelObjectCollection|TRechargeRec[] Collection to store aggregation of TRechargeRec objects.
     */
    protected $collTRechargeRecs;
    protected $collTRechargeRecsPartial;

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
    protected $tRechargeRecsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->rty_removed = 0;
    }

    /**
     * Initializes internal state of BaseTRechargeTypeRty object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
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
     * Get the [rty_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->rty_name;
    }

    /**
     * Get the [rty_type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->rty_type;
    }

    /**
     * Get the [rty_removed] column value.
     *
     * @return int
     */
    public function getRemoved()
    {
        return $this->rty_removed;
    }

    /**
     * Set the value of [rty_id] column.
     *
     * @param int $v new value
     * @return TRechargeTypeRty The current object (for fluent API support)
     */
    public function setRtyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rty_id !== $v) {
            $this->rty_id = $v;
            $this->modifiedColumns[] = TRechargeTypeRtyPeer::RTY_ID;
        }


        return $this;
    } // setRtyId()

    /**
     * Set the value of [rty_name] column.
     *
     * @param string $v new value
     * @return TRechargeTypeRty The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rty_name !== $v) {
            $this->rty_name = $v;
            $this->modifiedColumns[] = TRechargeTypeRtyPeer::RTY_NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [rty_type] column.
     *
     * @param string $v new value
     * @return TRechargeTypeRty The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rty_type !== $v) {
            $this->rty_type = $v;
            $this->modifiedColumns[] = TRechargeTypeRtyPeer::RTY_TYPE;
        }


        return $this;
    } // setType()

    /**
     * Set the value of [rty_removed] column.
     *
     * @param int $v new value
     * @return TRechargeTypeRty The current object (for fluent API support)
     */
    public function setRemoved($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rty_removed !== $v) {
            $this->rty_removed = $v;
            $this->modifiedColumns[] = TRechargeTypeRtyPeer::RTY_REMOVED;
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
            if ($this->rty_removed !== 0) {
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

            $this->rty_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->rty_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->rty_type = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->rty_removed = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = TRechargeTypeRtyPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TRechargeTypeRty object", $e);
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
            $con = Propel::getConnection(TRechargeTypeRtyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TRechargeTypeRtyPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collTRechargeRecs = null;

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
            $con = Propel::getConnection(TRechargeTypeRtyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TRechargeTypeRtyQuery::create()
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
            $con = Propel::getConnection(TRechargeTypeRtyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TRechargeTypeRtyPeer::addInstanceToPool($this);
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

        $this->modifiedColumns[] = TRechargeTypeRtyPeer::RTY_ID;
        if (null !== $this->rty_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TRechargeTypeRtyPeer::RTY_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TRechargeTypeRtyPeer::RTY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`RTY_ID`';
        }
        if ($this->isColumnModified(TRechargeTypeRtyPeer::RTY_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`RTY_NAME`';
        }
        if ($this->isColumnModified(TRechargeTypeRtyPeer::RTY_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`RTY_TYPE`';
        }
        if ($this->isColumnModified(TRechargeTypeRtyPeer::RTY_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`RTY_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `t_recharge_type_rty` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`RTY_ID`':
                        $stmt->bindValue($identifier, $this->rty_id, PDO::PARAM_INT);
                        break;
                    case '`RTY_NAME`':
                        $stmt->bindValue($identifier, $this->rty_name, PDO::PARAM_STR);
                        break;
                    case '`RTY_TYPE`':
                        $stmt->bindValue($identifier, $this->rty_type, PDO::PARAM_STR);
                        break;
                    case '`RTY_REMOVED`':
                        $stmt->bindValue($identifier, $this->rty_removed, PDO::PARAM_INT);
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
        $this->setRtyId($pk);

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


            if (($retval = TRechargeTypeRtyPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collTRechargeRecs !== null) {
                    foreach ($this->collTRechargeRecs as $referrerFK) {
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
        $pos = TRechargeTypeRtyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getRtyId();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getType();
                break;
            case 3:
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
        if (isset($alreadyDumpedObjects['TRechargeTypeRty'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TRechargeTypeRty'][$this->getPrimaryKey()] = true;
        $keys = TRechargeTypeRtyPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getRtyId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getType(),
            $keys[3] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collTRechargeRecs) {
                $result['TRechargeRecs'] = $this->collTRechargeRecs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TRechargeTypeRtyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setRtyId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setType($value);
                break;
            case 3:
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
        $keys = TRechargeTypeRtyPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setRtyId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setType($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setRemoved($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TRechargeTypeRtyPeer::DATABASE_NAME);

        if ($this->isColumnModified(TRechargeTypeRtyPeer::RTY_ID)) $criteria->add(TRechargeTypeRtyPeer::RTY_ID, $this->rty_id);
        if ($this->isColumnModified(TRechargeTypeRtyPeer::RTY_NAME)) $criteria->add(TRechargeTypeRtyPeer::RTY_NAME, $this->rty_name);
        if ($this->isColumnModified(TRechargeTypeRtyPeer::RTY_TYPE)) $criteria->add(TRechargeTypeRtyPeer::RTY_TYPE, $this->rty_type);
        if ($this->isColumnModified(TRechargeTypeRtyPeer::RTY_REMOVED)) $criteria->add(TRechargeTypeRtyPeer::RTY_REMOVED, $this->rty_removed);

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
        $criteria = new Criteria(TRechargeTypeRtyPeer::DATABASE_NAME);
        $criteria->add(TRechargeTypeRtyPeer::RTY_ID, $this->rty_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getRtyId();
    }

    /**
     * Generic method to set the primary key (rty_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setRtyId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getRtyId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of TRechargeTypeRty (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setType($this->getType());
        $copyObj->setRemoved($this->getRemoved());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getTRechargeRecs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTRechargeRec($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setRtyId(NULL); // this is a auto-increment column, so set to default value
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
     * @return TRechargeTypeRty Clone of current object.
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
     * @return TRechargeTypeRtyPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TRechargeTypeRtyPeer();
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
        if ('TRechargeRec' == $relationName) {
            $this->initTRechargeRecs();
        }
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
     * If this TRechargeTypeRty is new, it will return
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
                    ->filterByTRechargeTypeRty($this)
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
            $tRechargeRecRemoved->setTRechargeTypeRty(null);
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
                    ->filterByTRechargeTypeRty($this)
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
     * @return TRechargeTypeRty The current object (for fluent API support)
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
        $tRechargeRec->setTRechargeTypeRty($this);
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
            $tRechargeRec->setTRechargeTypeRty(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TRechargeTypeRty is new, it will return
     * an empty collection; or if this TRechargeTypeRty has previously
     * been saved, it will retrieve related TRechargeRecs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TRechargeTypeRty.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TRechargeRec[] List of TRechargeRec objects
     */
    public function getTRechargeRecsJoinTPointPoi($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TRechargeRecQuery::create(null, $criteria);
        $query->joinWith('TPointPoi', $join_behavior);

        return $this->getTRechargeRecs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TRechargeTypeRty is new, it will return
     * an empty collection; or if this TRechargeTypeRty has previously
     * been saved, it will retrieve related TRechargeRecs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TRechargeTypeRty.
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
     * Otherwise if this TRechargeTypeRty is new, it will return
     * an empty collection; or if this TRechargeTypeRty has previously
     * been saved, it will retrieve related TRechargeRecs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TRechargeTypeRty.
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
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->rty_id = null;
        $this->rty_name = null;
        $this->rty_type = null;
        $this->rty_removed = null;
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
            if ($this->collTRechargeRecs) {
                foreach ($this->collTRechargeRecs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collTRechargeRecs instanceof PropelCollection) {
            $this->collTRechargeRecs->clearIterator();
        }
        $this->collTRechargeRecs = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TRechargeTypeRtyPeer::DEFAULT_STRING_FORMAT);
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
