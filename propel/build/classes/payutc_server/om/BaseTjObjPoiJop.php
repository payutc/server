<?php


/**
 * Base class that represents a row from the 'tj_obj_poi_jop' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTjObjPoiJop extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TjObjPoiJopPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TjObjPoiJopPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the obj_id field.
     * @var        int
     */
    protected $obj_id;

    /**
     * The value for the jop_priority field.
     * Note: this column has a database default value of: 100
     * @var        int
     */
    protected $jop_priority;

    /**
     * The value for the poi_id field.
     * @var        int
     */
    protected $poi_id;

    /**
     * @var        TPointPoi
     */
    protected $aTPointPoi;

    /**
     * @var        TObjectObj
     */
    protected $aTObjectObj;

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
        $this->jop_priority = 100;
    }

    /**
     * Initializes internal state of BaseTjObjPoiJop object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [obj_id] column value.
     *
     * @return int
     */
    public function getObjId()
    {
        return $this->obj_id;
    }

    /**
     * Get the [jop_priority] column value.
     *
     * @return int
     */
    public function getJopPriority()
    {
        return $this->jop_priority;
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
     * Set the value of [obj_id] column.
     *
     * @param int $v new value
     * @return TjObjPoiJop The current object (for fluent API support)
     */
    public function setObjId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_id !== $v) {
            $this->obj_id = $v;
            $this->modifiedColumns[] = TjObjPoiJopPeer::OBJ_ID;
        }

        if ($this->aTObjectObj !== null && $this->aTObjectObj->getId() !== $v) {
            $this->aTObjectObj = null;
        }


        return $this;
    } // setObjId()

    /**
     * Set the value of [jop_priority] column.
     *
     * @param int $v new value
     * @return TjObjPoiJop The current object (for fluent API support)
     */
    public function setJopPriority($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->jop_priority !== $v) {
            $this->jop_priority = $v;
            $this->modifiedColumns[] = TjObjPoiJopPeer::JOP_PRIORITY;
        }


        return $this;
    } // setJopPriority()

    /**
     * Set the value of [poi_id] column.
     *
     * @param int $v new value
     * @return TjObjPoiJop The current object (for fluent API support)
     */
    public function setPoiId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->poi_id !== $v) {
            $this->poi_id = $v;
            $this->modifiedColumns[] = TjObjPoiJopPeer::POI_ID;
        }

        if ($this->aTPointPoi !== null && $this->aTPointPoi->getId() !== $v) {
            $this->aTPointPoi = null;
        }


        return $this;
    } // setPoiId()

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
            if ($this->jop_priority !== 100) {
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

            $this->obj_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->jop_priority = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->poi_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = TjObjPoiJopPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TjObjPoiJop object", $e);
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

        if ($this->aTObjectObj !== null && $this->obj_id !== $this->aTObjectObj->getId()) {
            $this->aTObjectObj = null;
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
            $con = Propel::getConnection(TjObjPoiJopPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TjObjPoiJopPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTPointPoi = null;
            $this->aTObjectObj = null;
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
            $con = Propel::getConnection(TjObjPoiJopPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TjObjPoiJopQuery::create()
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
            $con = Propel::getConnection(TjObjPoiJopPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TjObjPoiJopPeer::addInstanceToPool($this);
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

            if ($this->aTObjectObj !== null) {
                if ($this->aTObjectObj->isModified() || $this->aTObjectObj->isNew()) {
                    $affectedRows += $this->aTObjectObj->save($con);
                }
                $this->setTObjectObj($this->aTObjectObj);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TjObjPoiJopPeer::OBJ_ID)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_ID`';
        }
        if ($this->isColumnModified(TjObjPoiJopPeer::JOP_PRIORITY)) {
            $modifiedColumns[':p' . $index++]  = '`JOP_PRIORITY`';
        }
        if ($this->isColumnModified(TjObjPoiJopPeer::POI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`POI_ID`';
        }

        $sql = sprintf(
            'INSERT INTO `tj_obj_poi_jop` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`OBJ_ID`':
                        $stmt->bindValue($identifier, $this->obj_id, PDO::PARAM_INT);
                        break;
                    case '`JOP_PRIORITY`':
                        $stmt->bindValue($identifier, $this->jop_priority, PDO::PARAM_INT);
                        break;
                    case '`POI_ID`':
                        $stmt->bindValue($identifier, $this->poi_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

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

            if ($this->aTObjectObj !== null) {
                if (!$this->aTObjectObj->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTObjectObj->getValidationFailures());
                }
            }


            if (($retval = TjObjPoiJopPeer::doValidate($this, $columns)) !== true) {
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
        $pos = TjObjPoiJopPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getObjId();
                break;
            case 1:
                return $this->getJopPriority();
                break;
            case 2:
                return $this->getPoiId();
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
        if (isset($alreadyDumpedObjects['TjObjPoiJop'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TjObjPoiJop'][serialize($this->getPrimaryKey())] = true;
        $keys = TjObjPoiJopPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getObjId(),
            $keys[1] => $this->getJopPriority(),
            $keys[2] => $this->getPoiId(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTPointPoi) {
                $result['TPointPoi'] = $this->aTPointPoi->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTObjectObj) {
                $result['TObjectObj'] = $this->aTObjectObj->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = TjObjPoiJopPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setObjId($value);
                break;
            case 1:
                $this->setJopPriority($value);
                break;
            case 2:
                $this->setPoiId($value);
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
        $keys = TjObjPoiJopPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setObjId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setJopPriority($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPoiId($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TjObjPoiJopPeer::DATABASE_NAME);

        if ($this->isColumnModified(TjObjPoiJopPeer::OBJ_ID)) $criteria->add(TjObjPoiJopPeer::OBJ_ID, $this->obj_id);
        if ($this->isColumnModified(TjObjPoiJopPeer::JOP_PRIORITY)) $criteria->add(TjObjPoiJopPeer::JOP_PRIORITY, $this->jop_priority);
        if ($this->isColumnModified(TjObjPoiJopPeer::POI_ID)) $criteria->add(TjObjPoiJopPeer::POI_ID, $this->poi_id);

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
        $criteria = new Criteria(TjObjPoiJopPeer::DATABASE_NAME);
        $criteria->add(TjObjPoiJopPeer::OBJ_ID, $this->obj_id);
        $criteria->add(TjObjPoiJopPeer::POI_ID, $this->poi_id);

        return $criteria;
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getObjId();
        $pks[1] = $this->getPoiId();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setObjId($keys[0]);
        $this->setPoiId($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return (null === $this->getObjId()) && (null === $this->getPoiId());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of TjObjPoiJop (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setObjId($this->getObjId());
        $copyObj->setJopPriority($this->getJopPriority());
        $copyObj->setPoiId($this->getPoiId());

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
     * @return TjObjPoiJop Clone of current object.
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
     * @return TjObjPoiJopPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TjObjPoiJopPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TPointPoi object.
     *
     * @param             TPointPoi $v
     * @return TjObjPoiJop The current object (for fluent API support)
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
            $v->addTjObjPoiJop($this);
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
                $this->aTPointPoi->addTjObjPoiJops($this);
             */
        }

        return $this->aTPointPoi;
    }

    /**
     * Declares an association between this object and a TObjectObj object.
     *
     * @param             TObjectObj $v
     * @return TjObjPoiJop The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTObjectObj(TObjectObj $v = null)
    {
        if ($v === null) {
            $this->setObjId(NULL);
        } else {
            $this->setObjId($v->getId());
        }

        $this->aTObjectObj = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TObjectObj object, it will not be re-added.
        if ($v !== null) {
            $v->addTjObjPoiJop($this);
        }


        return $this;
    }


    /**
     * Get the associated TObjectObj object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TObjectObj The associated TObjectObj object.
     * @throws PropelException
     */
    public function getTObjectObj(PropelPDO $con = null)
    {
        if ($this->aTObjectObj === null && ($this->obj_id !== null)) {
            $this->aTObjectObj = TObjectObjQuery::create()->findPk($this->obj_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTObjectObj->addTjObjPoiJops($this);
             */
        }

        return $this->aTObjectObj;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->obj_id = null;
        $this->jop_priority = null;
        $this->poi_id = null;
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

        $this->aTPointPoi = null;
        $this->aTObjectObj = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TjObjPoiJopPeer::DEFAULT_STRING_FORMAT);
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
