<?php


/**
 * Base class that represents a row from the 'tj_usr_grp_jug' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTjUsrGrpJug extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TjUsrGrpJugPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TjUsrGrpJugPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the jug_id field.
     * @var        int
     */
    protected $jug_id;

    /**
     * The value for the usr_id field.
     * @var        int
     */
    protected $usr_id;

    /**
     * The value for the grp_id field.
     * @var        int
     */
    protected $grp_id;

    /**
     * The value for the per_id field.
     * @var        int
     */
    protected $per_id;

    /**
     * The value for the jug_removed field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $jug_removed;

    /**
     * @var        TPeriodPer
     */
    protected $aTPeriodPer;

    /**
     * @var        TsUserUsr
     */
    protected $aTsUserUsr;

    /**
     * @var        TGroupGrp
     */
    protected $aTGroupGrp;

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
        $this->jug_removed = 0;
    }

    /**
     * Initializes internal state of BaseTjUsrGrpJug object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [jug_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->jug_id;
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
     * Get the [grp_id] column value.
     *
     * @return int
     */
    public function getGrpId()
    {
        return $this->grp_id;
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
     * Get the [jug_removed] column value.
     *
     * @return int
     */
    public function getRemoved()
    {
        return $this->jug_removed;
    }

    /**
     * Set the value of [jug_id] column.
     *
     * @param int $v new value
     * @return TjUsrGrpJug The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->jug_id !== $v) {
            $this->jug_id = $v;
            $this->modifiedColumns[] = TjUsrGrpJugPeer::JUG_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [usr_id] column.
     *
     * @param int $v new value
     * @return TjUsrGrpJug The current object (for fluent API support)
     */
    public function setUsrId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_id !== $v) {
            $this->usr_id = $v;
            $this->modifiedColumns[] = TjUsrGrpJugPeer::USR_ID;
        }

        if ($this->aTsUserUsr !== null && $this->aTsUserUsr->getId() !== $v) {
            $this->aTsUserUsr = null;
        }


        return $this;
    } // setUsrId()

    /**
     * Set the value of [grp_id] column.
     *
     * @param int $v new value
     * @return TjUsrGrpJug The current object (for fluent API support)
     */
    public function setGrpId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->grp_id !== $v) {
            $this->grp_id = $v;
            $this->modifiedColumns[] = TjUsrGrpJugPeer::GRP_ID;
        }

        if ($this->aTGroupGrp !== null && $this->aTGroupGrp->getId() !== $v) {
            $this->aTGroupGrp = null;
        }


        return $this;
    } // setGrpId()

    /**
     * Set the value of [per_id] column.
     *
     * @param int $v new value
     * @return TjUsrGrpJug The current object (for fluent API support)
     */
    public function setPerId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_id !== $v) {
            $this->per_id = $v;
            $this->modifiedColumns[] = TjUsrGrpJugPeer::PER_ID;
        }

        if ($this->aTPeriodPer !== null && $this->aTPeriodPer->getId() !== $v) {
            $this->aTPeriodPer = null;
        }


        return $this;
    } // setPerId()

    /**
     * Set the value of [jug_removed] column.
     *
     * @param int $v new value
     * @return TjUsrGrpJug The current object (for fluent API support)
     */
    public function setRemoved($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->jug_removed !== $v) {
            $this->jug_removed = $v;
            $this->modifiedColumns[] = TjUsrGrpJugPeer::JUG_REMOVED;
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
            if ($this->jug_removed !== 0) {
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

            $this->jug_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->usr_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->grp_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->per_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->jug_removed = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = TjUsrGrpJugPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TjUsrGrpJug object", $e);
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
        if ($this->aTGroupGrp !== null && $this->grp_id !== $this->aTGroupGrp->getId()) {
            $this->aTGroupGrp = null;
        }
        if ($this->aTPeriodPer !== null && $this->per_id !== $this->aTPeriodPer->getId()) {
            $this->aTPeriodPer = null;
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
            $con = Propel::getConnection(TjUsrGrpJugPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TjUsrGrpJugPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTPeriodPer = null;
            $this->aTsUserUsr = null;
            $this->aTGroupGrp = null;
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
            $con = Propel::getConnection(TjUsrGrpJugPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TjUsrGrpJugQuery::create()
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
            $con = Propel::getConnection(TjUsrGrpJugPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TjUsrGrpJugPeer::addInstanceToPool($this);
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

            if ($this->aTGroupGrp !== null) {
                if ($this->aTGroupGrp->isModified() || $this->aTGroupGrp->isNew()) {
                    $affectedRows += $this->aTGroupGrp->save($con);
                }
                $this->setTGroupGrp($this->aTGroupGrp);
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

        $this->modifiedColumns[] = TjUsrGrpJugPeer::JUG_ID;
        if (null !== $this->jug_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TjUsrGrpJugPeer::JUG_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TjUsrGrpJugPeer::JUG_ID)) {
            $modifiedColumns[':p' . $index++]  = '`JUG_ID`';
        }
        if ($this->isColumnModified(TjUsrGrpJugPeer::USR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ID`';
        }
        if ($this->isColumnModified(TjUsrGrpJugPeer::GRP_ID)) {
            $modifiedColumns[':p' . $index++]  = '`GRP_ID`';
        }
        if ($this->isColumnModified(TjUsrGrpJugPeer::PER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`PER_ID`';
        }
        if ($this->isColumnModified(TjUsrGrpJugPeer::JUG_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`JUG_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `tj_usr_grp_jug` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`JUG_ID`':
                        $stmt->bindValue($identifier, $this->jug_id, PDO::PARAM_INT);
                        break;
                    case '`USR_ID`':
                        $stmt->bindValue($identifier, $this->usr_id, PDO::PARAM_INT);
                        break;
                    case '`GRP_ID`':
                        $stmt->bindValue($identifier, $this->grp_id, PDO::PARAM_INT);
                        break;
                    case '`PER_ID`':
                        $stmt->bindValue($identifier, $this->per_id, PDO::PARAM_INT);
                        break;
                    case '`JUG_REMOVED`':
                        $stmt->bindValue($identifier, $this->jug_removed, PDO::PARAM_INT);
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

            if ($this->aTGroupGrp !== null) {
                if (!$this->aTGroupGrp->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTGroupGrp->getValidationFailures());
                }
            }


            if (($retval = TjUsrGrpJugPeer::doValidate($this, $columns)) !== true) {
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
        $pos = TjUsrGrpJugPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getGrpId();
                break;
            case 3:
                return $this->getPerId();
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
        if (isset($alreadyDumpedObjects['TjUsrGrpJug'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TjUsrGrpJug'][$this->getPrimaryKey()] = true;
        $keys = TjUsrGrpJugPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUsrId(),
            $keys[2] => $this->getGrpId(),
            $keys[3] => $this->getPerId(),
            $keys[4] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTPeriodPer) {
                $result['TPeriodPer'] = $this->aTPeriodPer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTsUserUsr) {
                $result['TsUserUsr'] = $this->aTsUserUsr->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTGroupGrp) {
                $result['TGroupGrp'] = $this->aTGroupGrp->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = TjUsrGrpJugPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setGrpId($value);
                break;
            case 3:
                $this->setPerId($value);
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
        $keys = TjUsrGrpJugPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setUsrId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setGrpId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPerId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setRemoved($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TjUsrGrpJugPeer::DATABASE_NAME);

        if ($this->isColumnModified(TjUsrGrpJugPeer::JUG_ID)) $criteria->add(TjUsrGrpJugPeer::JUG_ID, $this->jug_id);
        if ($this->isColumnModified(TjUsrGrpJugPeer::USR_ID)) $criteria->add(TjUsrGrpJugPeer::USR_ID, $this->usr_id);
        if ($this->isColumnModified(TjUsrGrpJugPeer::GRP_ID)) $criteria->add(TjUsrGrpJugPeer::GRP_ID, $this->grp_id);
        if ($this->isColumnModified(TjUsrGrpJugPeer::PER_ID)) $criteria->add(TjUsrGrpJugPeer::PER_ID, $this->per_id);
        if ($this->isColumnModified(TjUsrGrpJugPeer::JUG_REMOVED)) $criteria->add(TjUsrGrpJugPeer::JUG_REMOVED, $this->jug_removed);

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
        $criteria = new Criteria(TjUsrGrpJugPeer::DATABASE_NAME);
        $criteria->add(TjUsrGrpJugPeer::JUG_ID, $this->jug_id);

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
     * Generic method to set the primary key (jug_id column).
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
     * @param object $copyObj An object of TjUsrGrpJug (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUsrId($this->getUsrId());
        $copyObj->setGrpId($this->getGrpId());
        $copyObj->setPerId($this->getPerId());
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
     * @return TjUsrGrpJug Clone of current object.
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
     * @return TjUsrGrpJugPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TjUsrGrpJugPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TPeriodPer object.
     *
     * @param             TPeriodPer $v
     * @return TjUsrGrpJug The current object (for fluent API support)
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
            $v->addTjUsrGrpJug($this);
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
                $this->aTPeriodPer->addTjUsrGrpJugs($this);
             */
        }

        return $this->aTPeriodPer;
    }

    /**
     * Declares an association between this object and a TsUserUsr object.
     *
     * @param             TsUserUsr $v
     * @return TjUsrGrpJug The current object (for fluent API support)
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
            $v->addTjUsrGrpJug($this);
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
                $this->aTsUserUsr->addTjUsrGrpJugs($this);
             */
        }

        return $this->aTsUserUsr;
    }

    /**
     * Declares an association between this object and a TGroupGrp object.
     *
     * @param             TGroupGrp $v
     * @return TjUsrGrpJug The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTGroupGrp(TGroupGrp $v = null)
    {
        if ($v === null) {
            $this->setGrpId(NULL);
        } else {
            $this->setGrpId($v->getId());
        }

        $this->aTGroupGrp = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TGroupGrp object, it will not be re-added.
        if ($v !== null) {
            $v->addTjUsrGrpJug($this);
        }


        return $this;
    }


    /**
     * Get the associated TGroupGrp object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TGroupGrp The associated TGroupGrp object.
     * @throws PropelException
     */
    public function getTGroupGrp(PropelPDO $con = null)
    {
        if ($this->aTGroupGrp === null && ($this->grp_id !== null)) {
            $this->aTGroupGrp = TGroupGrpQuery::create()->findPk($this->grp_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTGroupGrp->addTjUsrGrpJugs($this);
             */
        }

        return $this->aTGroupGrp;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->jug_id = null;
        $this->usr_id = null;
        $this->grp_id = null;
        $this->per_id = null;
        $this->jug_removed = null;
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
        $this->aTGroupGrp = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TjUsrGrpJugPeer::DEFAULT_STRING_FORMAT);
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
