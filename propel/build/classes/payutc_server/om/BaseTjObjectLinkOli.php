<?php


/**
 * Base class that represents a row from the 'tj_object_link_oli' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTjObjectLinkOli extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TjObjectLinkOliPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TjObjectLinkOliPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the oli_id field.
     * @var        int
     */
    protected $oli_id;

    /**
     * The value for the obj_id_parent field.
     * @var        int
     */
    protected $obj_id_parent;

    /**
     * The value for the obj_id_child field.
     * @var        int
     */
    protected $obj_id_child;

    /**
     * The value for the oli_step field.
     * @var        int
     */
    protected $oli_step;

    /**
     * The value for the oli_removed field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $oli_removed;

    /**
     * @var        TObjectObj
     */
    protected $aTObjectObjRelatedByObjIdChild;

    /**
     * @var        TObjectObj
     */
    protected $aTObjectObjRelatedByObjIdParent;

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
        $this->oli_removed = 0;
    }

    /**
     * Initializes internal state of BaseTjObjectLinkOli object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [oli_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->oli_id;
    }

    /**
     * Get the [obj_id_parent] column value.
     *
     * @return int
     */
    public function getObjIdParent()
    {
        return $this->obj_id_parent;
    }

    /**
     * Get the [obj_id_child] column value.
     *
     * @return int
     */
    public function getObjIdChild()
    {
        return $this->obj_id_child;
    }

    /**
     * Get the [oli_step] column value.
     *
     * @return int
     */
    public function getStep()
    {
        return $this->oli_step;
    }

    /**
     * Get the [oli_removed] column value.
     *
     * @return int
     */
    public function getRemoved()
    {
        return $this->oli_removed;
    }

    /**
     * Set the value of [oli_id] column.
     *
     * @param int $v new value
     * @return TjObjectLinkOli The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oli_id !== $v) {
            $this->oli_id = $v;
            $this->modifiedColumns[] = TjObjectLinkOliPeer::OLI_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [obj_id_parent] column.
     *
     * @param int $v new value
     * @return TjObjectLinkOli The current object (for fluent API support)
     */
    public function setObjIdParent($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_id_parent !== $v) {
            $this->obj_id_parent = $v;
            $this->modifiedColumns[] = TjObjectLinkOliPeer::OBJ_ID_PARENT;
        }

        if ($this->aTObjectObjRelatedByObjIdParent !== null && $this->aTObjectObjRelatedByObjIdParent->getId() !== $v) {
            $this->aTObjectObjRelatedByObjIdParent = null;
        }


        return $this;
    } // setObjIdParent()

    /**
     * Set the value of [obj_id_child] column.
     *
     * @param int $v new value
     * @return TjObjectLinkOli The current object (for fluent API support)
     */
    public function setObjIdChild($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_id_child !== $v) {
            $this->obj_id_child = $v;
            $this->modifiedColumns[] = TjObjectLinkOliPeer::OBJ_ID_CHILD;
        }

        if ($this->aTObjectObjRelatedByObjIdChild !== null && $this->aTObjectObjRelatedByObjIdChild->getId() !== $v) {
            $this->aTObjectObjRelatedByObjIdChild = null;
        }


        return $this;
    } // setObjIdChild()

    /**
     * Set the value of [oli_step] column.
     *
     * @param int $v new value
     * @return TjObjectLinkOli The current object (for fluent API support)
     */
    public function setStep($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oli_step !== $v) {
            $this->oli_step = $v;
            $this->modifiedColumns[] = TjObjectLinkOliPeer::OLI_STEP;
        }


        return $this;
    } // setStep()

    /**
     * Set the value of [oli_removed] column.
     *
     * @param int $v new value
     * @return TjObjectLinkOli The current object (for fluent API support)
     */
    public function setRemoved($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oli_removed !== $v) {
            $this->oli_removed = $v;
            $this->modifiedColumns[] = TjObjectLinkOliPeer::OLI_REMOVED;
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
            if ($this->oli_removed !== 0) {
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

            $this->oli_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->obj_id_parent = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->obj_id_child = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->oli_step = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->oli_removed = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = TjObjectLinkOliPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TjObjectLinkOli object", $e);
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

        if ($this->aTObjectObjRelatedByObjIdParent !== null && $this->obj_id_parent !== $this->aTObjectObjRelatedByObjIdParent->getId()) {
            $this->aTObjectObjRelatedByObjIdParent = null;
        }
        if ($this->aTObjectObjRelatedByObjIdChild !== null && $this->obj_id_child !== $this->aTObjectObjRelatedByObjIdChild->getId()) {
            $this->aTObjectObjRelatedByObjIdChild = null;
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
            $con = Propel::getConnection(TjObjectLinkOliPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TjObjectLinkOliPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTObjectObjRelatedByObjIdChild = null;
            $this->aTObjectObjRelatedByObjIdParent = null;
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
            $con = Propel::getConnection(TjObjectLinkOliPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TjObjectLinkOliQuery::create()
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
            $con = Propel::getConnection(TjObjectLinkOliPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TjObjectLinkOliPeer::addInstanceToPool($this);
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

            if ($this->aTObjectObjRelatedByObjIdChild !== null) {
                if ($this->aTObjectObjRelatedByObjIdChild->isModified() || $this->aTObjectObjRelatedByObjIdChild->isNew()) {
                    $affectedRows += $this->aTObjectObjRelatedByObjIdChild->save($con);
                }
                $this->setTObjectObjRelatedByObjIdChild($this->aTObjectObjRelatedByObjIdChild);
            }

            if ($this->aTObjectObjRelatedByObjIdParent !== null) {
                if ($this->aTObjectObjRelatedByObjIdParent->isModified() || $this->aTObjectObjRelatedByObjIdParent->isNew()) {
                    $affectedRows += $this->aTObjectObjRelatedByObjIdParent->save($con);
                }
                $this->setTObjectObjRelatedByObjIdParent($this->aTObjectObjRelatedByObjIdParent);
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

        $this->modifiedColumns[] = TjObjectLinkOliPeer::OLI_ID;
        if (null !== $this->oli_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TjObjectLinkOliPeer::OLI_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TjObjectLinkOliPeer::OLI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`OLI_ID`';
        }
        if ($this->isColumnModified(TjObjectLinkOliPeer::OBJ_ID_PARENT)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_ID_PARENT`';
        }
        if ($this->isColumnModified(TjObjectLinkOliPeer::OBJ_ID_CHILD)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_ID_CHILD`';
        }
        if ($this->isColumnModified(TjObjectLinkOliPeer::OLI_STEP)) {
            $modifiedColumns[':p' . $index++]  = '`OLI_STEP`';
        }
        if ($this->isColumnModified(TjObjectLinkOliPeer::OLI_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`OLI_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `tj_object_link_oli` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`OLI_ID`':
                        $stmt->bindValue($identifier, $this->oli_id, PDO::PARAM_INT);
                        break;
                    case '`OBJ_ID_PARENT`':
                        $stmt->bindValue($identifier, $this->obj_id_parent, PDO::PARAM_INT);
                        break;
                    case '`OBJ_ID_CHILD`':
                        $stmt->bindValue($identifier, $this->obj_id_child, PDO::PARAM_INT);
                        break;
                    case '`OLI_STEP`':
                        $stmt->bindValue($identifier, $this->oli_step, PDO::PARAM_INT);
                        break;
                    case '`OLI_REMOVED`':
                        $stmt->bindValue($identifier, $this->oli_removed, PDO::PARAM_INT);
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

            if ($this->aTObjectObjRelatedByObjIdChild !== null) {
                if (!$this->aTObjectObjRelatedByObjIdChild->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTObjectObjRelatedByObjIdChild->getValidationFailures());
                }
            }

            if ($this->aTObjectObjRelatedByObjIdParent !== null) {
                if (!$this->aTObjectObjRelatedByObjIdParent->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTObjectObjRelatedByObjIdParent->getValidationFailures());
                }
            }


            if (($retval = TjObjectLinkOliPeer::doValidate($this, $columns)) !== true) {
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
        $pos = TjObjectLinkOliPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getObjIdParent();
                break;
            case 2:
                return $this->getObjIdChild();
                break;
            case 3:
                return $this->getStep();
                break;
            case 4:
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
        if (isset($alreadyDumpedObjects['TjObjectLinkOli'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TjObjectLinkOli'][$this->getPrimaryKey()] = true;
        $keys = TjObjectLinkOliPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getObjIdParent(),
            $keys[2] => $this->getObjIdChild(),
            $keys[3] => $this->getStep(),
            $keys[4] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTObjectObjRelatedByObjIdChild) {
                $result['TObjectObjRelatedByObjIdChild'] = $this->aTObjectObjRelatedByObjIdChild->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTObjectObjRelatedByObjIdParent) {
                $result['TObjectObjRelatedByObjIdParent'] = $this->aTObjectObjRelatedByObjIdParent->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = TjObjectLinkOliPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setObjIdParent($value);
                break;
            case 2:
                $this->setObjIdChild($value);
                break;
            case 3:
                $this->setStep($value);
                break;
            case 4:
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
        $keys = TjObjectLinkOliPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setObjIdParent($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setObjIdChild($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setStep($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setRemoved($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TjObjectLinkOliPeer::DATABASE_NAME);

        if ($this->isColumnModified(TjObjectLinkOliPeer::OLI_ID)) $criteria->add(TjObjectLinkOliPeer::OLI_ID, $this->oli_id);
        if ($this->isColumnModified(TjObjectLinkOliPeer::OBJ_ID_PARENT)) $criteria->add(TjObjectLinkOliPeer::OBJ_ID_PARENT, $this->obj_id_parent);
        if ($this->isColumnModified(TjObjectLinkOliPeer::OBJ_ID_CHILD)) $criteria->add(TjObjectLinkOliPeer::OBJ_ID_CHILD, $this->obj_id_child);
        if ($this->isColumnModified(TjObjectLinkOliPeer::OLI_STEP)) $criteria->add(TjObjectLinkOliPeer::OLI_STEP, $this->oli_step);
        if ($this->isColumnModified(TjObjectLinkOliPeer::OLI_REMOVED)) $criteria->add(TjObjectLinkOliPeer::OLI_REMOVED, $this->oli_removed);

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
        $criteria = new Criteria(TjObjectLinkOliPeer::DATABASE_NAME);
        $criteria->add(TjObjectLinkOliPeer::OLI_ID, $this->oli_id);

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
     * Generic method to set the primary key (oli_id column).
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
     * @param object $copyObj An object of TjObjectLinkOli (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setObjIdParent($this->getObjIdParent());
        $copyObj->setObjIdChild($this->getObjIdChild());
        $copyObj->setStep($this->getStep());
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
     * @return TjObjectLinkOli Clone of current object.
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
     * @return TjObjectLinkOliPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TjObjectLinkOliPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TObjectObj object.
     *
     * @param             TObjectObj $v
     * @return TjObjectLinkOli The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTObjectObjRelatedByObjIdChild(TObjectObj $v = null)
    {
        if ($v === null) {
            $this->setObjIdChild(NULL);
        } else {
            $this->setObjIdChild($v->getId());
        }

        $this->aTObjectObjRelatedByObjIdChild = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TObjectObj object, it will not be re-added.
        if ($v !== null) {
            $v->addTjObjectLinkOliRelatedByObjIdChild($this);
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
    public function getTObjectObjRelatedByObjIdChild(PropelPDO $con = null)
    {
        if ($this->aTObjectObjRelatedByObjIdChild === null && ($this->obj_id_child !== null)) {
            $this->aTObjectObjRelatedByObjIdChild = TObjectObjQuery::create()->findPk($this->obj_id_child, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTObjectObjRelatedByObjIdChild->addTjObjectLinkOlisRelatedByObjIdChild($this);
             */
        }

        return $this->aTObjectObjRelatedByObjIdChild;
    }

    /**
     * Declares an association between this object and a TObjectObj object.
     *
     * @param             TObjectObj $v
     * @return TjObjectLinkOli The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTObjectObjRelatedByObjIdParent(TObjectObj $v = null)
    {
        if ($v === null) {
            $this->setObjIdParent(NULL);
        } else {
            $this->setObjIdParent($v->getId());
        }

        $this->aTObjectObjRelatedByObjIdParent = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TObjectObj object, it will not be re-added.
        if ($v !== null) {
            $v->addTjObjectLinkOliRelatedByObjIdParent($this);
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
    public function getTObjectObjRelatedByObjIdParent(PropelPDO $con = null)
    {
        if ($this->aTObjectObjRelatedByObjIdParent === null && ($this->obj_id_parent !== null)) {
            $this->aTObjectObjRelatedByObjIdParent = TObjectObjQuery::create()->findPk($this->obj_id_parent, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTObjectObjRelatedByObjIdParent->addTjObjectLinkOlisRelatedByObjIdParent($this);
             */
        }

        return $this->aTObjectObjRelatedByObjIdParent;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->oli_id = null;
        $this->obj_id_parent = null;
        $this->obj_id_child = null;
        $this->oli_step = null;
        $this->oli_removed = null;
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

        $this->aTObjectObjRelatedByObjIdChild = null;
        $this->aTObjectObjRelatedByObjIdParent = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TjObjectLinkOliPeer::DEFAULT_STRING_FORMAT);
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
