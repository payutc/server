<?php


/**
 * Base class that represents a row from the 'ts_image_img' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTsImageImg extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TsImageImgPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TsImageImgPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the img_id field.
     * @var        int
     */
    protected $img_id;

    /**
     * The value for the img_mime field.
     * @var        string
     */
    protected $img_mime;

    /**
     * The value for the img_width field.
     * @var        int
     */
    protected $img_width;

    /**
     * The value for the img_length field.
     * @var        int
     */
    protected $img_length;

    /**
     * The value for the img_content field.
     * @var        resource
     */
    protected $img_content;

    /**
     * The value for the img_removed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $img_removed;

    /**
     * @var        PropelObjectCollection|TObjectObj[] Collection to store aggregation of TObjectObj objects.
     */
    protected $collTObjectObjs;
    protected $collTObjectObjsPartial;

    /**
     * @var        PropelObjectCollection|TsUserUsr[] Collection to store aggregation of TsUserUsr objects.
     */
    protected $collTsUserUsrs;
    protected $collTsUserUsrsPartial;

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
    protected $tObjectObjsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tsUserUsrsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->img_removed = false;
    }

    /**
     * Initializes internal state of BaseTsImageImg object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [img_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->img_id;
    }

    /**
     * Get the [img_mime] column value.
     *
     * @return string
     */
    public function getMime()
    {
        return $this->img_mime;
    }

    /**
     * Get the [img_width] column value.
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->img_width;
    }

    /**
     * Get the [img_length] column value.
     *
     * @return int
     */
    public function getLength()
    {
        return $this->img_length;
    }

    /**
     * Get the [img_content] column value.
     *
     * @return resource
     */
    public function getContent()
    {
        return $this->img_content;
    }

    /**
     * Get the [img_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->img_removed;
    }

    /**
     * Set the value of [img_id] column.
     *
     * @param int $v new value
     * @return TsImageImg The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->img_id !== $v) {
            $this->img_id = $v;
            $this->modifiedColumns[] = TsImageImgPeer::IMG_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [img_mime] column.
     *
     * @param string $v new value
     * @return TsImageImg The current object (for fluent API support)
     */
    public function setMime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->img_mime !== $v) {
            $this->img_mime = $v;
            $this->modifiedColumns[] = TsImageImgPeer::IMG_MIME;
        }


        return $this;
    } // setMime()

    /**
     * Set the value of [img_width] column.
     *
     * @param int $v new value
     * @return TsImageImg The current object (for fluent API support)
     */
    public function setWidth($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->img_width !== $v) {
            $this->img_width = $v;
            $this->modifiedColumns[] = TsImageImgPeer::IMG_WIDTH;
        }


        return $this;
    } // setWidth()

    /**
     * Set the value of [img_length] column.
     *
     * @param int $v new value
     * @return TsImageImg The current object (for fluent API support)
     */
    public function setLength($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->img_length !== $v) {
            $this->img_length = $v;
            $this->modifiedColumns[] = TsImageImgPeer::IMG_LENGTH;
        }


        return $this;
    } // setLength()

    /**
     * Set the value of [img_content] column.
     *
     * @param resource $v new value
     * @return TsImageImg The current object (for fluent API support)
     */
    public function setContent($v)
    {
        // Because BLOB columns are streams in PDO we have to assume that they are
        // always modified when a new value is passed in.  For example, the contents
        // of the stream itself may have changed externally.
        if (!is_resource($v) && $v !== null) {
            $this->img_content = fopen('php://memory', 'r+');
            fwrite($this->img_content, $v);
            rewind($this->img_content);
        } else { // it's already a stream
            $this->img_content = $v;
        }
        $this->modifiedColumns[] = TsImageImgPeer::IMG_CONTENT;


        return $this;
    } // setContent()

    /**
     * Sets the value of the [img_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return TsImageImg The current object (for fluent API support)
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

        if ($this->img_removed !== $v) {
            $this->img_removed = $v;
            $this->modifiedColumns[] = TsImageImgPeer::IMG_REMOVED;
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
            if ($this->img_removed !== false) {
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

            $this->img_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->img_mime = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->img_width = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->img_length = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            if ($row[$startcol + 4] !== null) {
                $this->img_content = fopen('php://memory', 'r+');
                fwrite($this->img_content, $row[$startcol + 4]);
                rewind($this->img_content);
            } else {
                $this->img_content = null;
            }
            $this->img_removed = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = TsImageImgPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TsImageImg object", $e);
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
            $con = Propel::getConnection(TsImageImgPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TsImageImgPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collTObjectObjs = null;

            $this->collTsUserUsrs = null;

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
            $con = Propel::getConnection(TsImageImgPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TsImageImgQuery::create()
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
            $con = Propel::getConnection(TsImageImgPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TsImageImgPeer::addInstanceToPool($this);
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
                // Rewind the img_content LOB column, since PDO does not rewind after inserting value.
                if ($this->img_content !== null && is_resource($this->img_content)) {
                    rewind($this->img_content);
                }

                $this->resetModified();
            }

            if ($this->tObjectObjsScheduledForDeletion !== null) {
                if (!$this->tObjectObjsScheduledForDeletion->isEmpty()) {
                    foreach ($this->tObjectObjsScheduledForDeletion as $tObjectObj) {
                        // need to save related object because we set the relation to null
                        $tObjectObj->save($con);
                    }
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

            if ($this->tsUserUsrsScheduledForDeletion !== null) {
                if (!$this->tsUserUsrsScheduledForDeletion->isEmpty()) {
                    foreach ($this->tsUserUsrsScheduledForDeletion as $tsUserUsr) {
                        // need to save related object because we set the relation to null
                        $tsUserUsr->save($con);
                    }
                    $this->tsUserUsrsScheduledForDeletion = null;
                }
            }

            if ($this->collTsUserUsrs !== null) {
                foreach ($this->collTsUserUsrs as $referrerFK) {
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

        $this->modifiedColumns[] = TsImageImgPeer::IMG_ID;
        if (null !== $this->img_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TsImageImgPeer::IMG_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TsImageImgPeer::IMG_ID)) {
            $modifiedColumns[':p' . $index++]  = '`IMG_ID`';
        }
        if ($this->isColumnModified(TsImageImgPeer::IMG_MIME)) {
            $modifiedColumns[':p' . $index++]  = '`IMG_MIME`';
        }
        if ($this->isColumnModified(TsImageImgPeer::IMG_WIDTH)) {
            $modifiedColumns[':p' . $index++]  = '`IMG_WIDTH`';
        }
        if ($this->isColumnModified(TsImageImgPeer::IMG_LENGTH)) {
            $modifiedColumns[':p' . $index++]  = '`IMG_LENGTH`';
        }
        if ($this->isColumnModified(TsImageImgPeer::IMG_CONTENT)) {
            $modifiedColumns[':p' . $index++]  = '`IMG_CONTENT`';
        }
        if ($this->isColumnModified(TsImageImgPeer::IMG_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`IMG_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `ts_image_img` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`IMG_ID`':
                        $stmt->bindValue($identifier, $this->img_id, PDO::PARAM_INT);
                        break;
                    case '`IMG_MIME`':
                        $stmt->bindValue($identifier, $this->img_mime, PDO::PARAM_STR);
                        break;
                    case '`IMG_WIDTH`':
                        $stmt->bindValue($identifier, $this->img_width, PDO::PARAM_INT);
                        break;
                    case '`IMG_LENGTH`':
                        $stmt->bindValue($identifier, $this->img_length, PDO::PARAM_INT);
                        break;
                    case '`IMG_CONTENT`':
                        if (is_resource($this->img_content)) {
                            rewind($this->img_content);
                        }
                        $stmt->bindValue($identifier, $this->img_content, PDO::PARAM_LOB);
                        break;
                    case '`IMG_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->img_removed, PDO::PARAM_INT);
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


            if (($retval = TsImageImgPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collTObjectObjs !== null) {
                    foreach ($this->collTObjectObjs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTsUserUsrs !== null) {
                    foreach ($this->collTsUserUsrs as $referrerFK) {
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
        $pos = TsImageImgPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getMime();
                break;
            case 2:
                return $this->getWidth();
                break;
            case 3:
                return $this->getLength();
                break;
            case 4:
                return $this->getContent();
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
        if (isset($alreadyDumpedObjects['TsImageImg'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TsImageImg'][$this->getPrimaryKey()] = true;
        $keys = TsImageImgPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getMime(),
            $keys[2] => $this->getWidth(),
            $keys[3] => $this->getLength(),
            $keys[4] => $this->getContent(),
            $keys[5] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collTObjectObjs) {
                $result['TObjectObjs'] = $this->collTObjectObjs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTsUserUsrs) {
                $result['TsUserUsrs'] = $this->collTsUserUsrs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TsImageImgPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setMime($value);
                break;
            case 2:
                $this->setWidth($value);
                break;
            case 3:
                $this->setLength($value);
                break;
            case 4:
                $this->setContent($value);
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
        $keys = TsImageImgPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setMime($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setWidth($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setLength($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setContent($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setRemoved($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TsImageImgPeer::DATABASE_NAME);

        if ($this->isColumnModified(TsImageImgPeer::IMG_ID)) $criteria->add(TsImageImgPeer::IMG_ID, $this->img_id);
        if ($this->isColumnModified(TsImageImgPeer::IMG_MIME)) $criteria->add(TsImageImgPeer::IMG_MIME, $this->img_mime);
        if ($this->isColumnModified(TsImageImgPeer::IMG_WIDTH)) $criteria->add(TsImageImgPeer::IMG_WIDTH, $this->img_width);
        if ($this->isColumnModified(TsImageImgPeer::IMG_LENGTH)) $criteria->add(TsImageImgPeer::IMG_LENGTH, $this->img_length);
        if ($this->isColumnModified(TsImageImgPeer::IMG_CONTENT)) $criteria->add(TsImageImgPeer::IMG_CONTENT, $this->img_content);
        if ($this->isColumnModified(TsImageImgPeer::IMG_REMOVED)) $criteria->add(TsImageImgPeer::IMG_REMOVED, $this->img_removed);

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
        $criteria = new Criteria(TsImageImgPeer::DATABASE_NAME);
        $criteria->add(TsImageImgPeer::IMG_ID, $this->img_id);

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
     * Generic method to set the primary key (img_id column).
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
     * @param object $copyObj An object of TsImageImg (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setMime($this->getMime());
        $copyObj->setWidth($this->getWidth());
        $copyObj->setLength($this->getLength());
        $copyObj->setContent($this->getContent());
        $copyObj->setRemoved($this->getRemoved());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getTObjectObjs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTObjectObj($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTsUserUsrs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTsUserUsr($relObj->copy($deepCopy));
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
     * @return TsImageImg Clone of current object.
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
     * @return TsImageImgPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TsImageImgPeer();
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
        if ('TObjectObj' == $relationName) {
            $this->initTObjectObjs();
        }
        if ('TsUserUsr' == $relationName) {
            $this->initTsUserUsrs();
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
     * If this TsImageImg is new, it will return
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
                    ->filterByTsImageImg($this)
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
            $tObjectObjRemoved->setTsImageImg(null);
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
                    ->filterByTsImageImg($this)
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
     * @return TsImageImg The current object (for fluent API support)
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
        $tObjectObj->setTsImageImg($this);
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
            $tObjectObj->setTsImageImg(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TsImageImg is new, it will return
     * an empty collection; or if this TsImageImg has previously
     * been saved, it will retrieve related TObjectObjs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TsImageImg.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TObjectObj[] List of TObjectObj objects
     */
    public function getTObjectObjsJoinTFundationFun($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TObjectObjQuery::create(null, $criteria);
        $query->joinWith('TFundationFun', $join_behavior);

        return $this->getTObjectObjs($query, $con);
    }

    /**
     * Clears out the collTsUserUsrs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTsUserUsrs()
     */
    public function clearTsUserUsrs()
    {
        $this->collTsUserUsrs = null; // important to set this to null since that means it is uninitialized
        $this->collTsUserUsrsPartial = null;
    }

    /**
     * reset is the collTsUserUsrs collection loaded partially
     *
     * @return void
     */
    public function resetPartialTsUserUsrs($v = true)
    {
        $this->collTsUserUsrsPartial = $v;
    }

    /**
     * Initializes the collTsUserUsrs collection.
     *
     * By default this just sets the collTsUserUsrs collection to an empty array (like clearcollTsUserUsrs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTsUserUsrs($overrideExisting = true)
    {
        if (null !== $this->collTsUserUsrs && !$overrideExisting) {
            return;
        }
        $this->collTsUserUsrs = new PropelObjectCollection();
        $this->collTsUserUsrs->setModel('TsUserUsr');
    }

    /**
     * Gets an array of TsUserUsr objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TsImageImg is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TsUserUsr[] List of TsUserUsr objects
     * @throws PropelException
     */
    public function getTsUserUsrs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTsUserUsrsPartial && !$this->isNew();
        if (null === $this->collTsUserUsrs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTsUserUsrs) {
                // return empty collection
                $this->initTsUserUsrs();
            } else {
                $collTsUserUsrs = TsUserUsrQuery::create(null, $criteria)
                    ->filterByTsImageImg($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTsUserUsrsPartial && count($collTsUserUsrs)) {
                      $this->initTsUserUsrs(false);

                      foreach($collTsUserUsrs as $obj) {
                        if (false == $this->collTsUserUsrs->contains($obj)) {
                          $this->collTsUserUsrs->append($obj);
                        }
                      }

                      $this->collTsUserUsrsPartial = true;
                    }

                    return $collTsUserUsrs;
                }

                if($partial && $this->collTsUserUsrs) {
                    foreach($this->collTsUserUsrs as $obj) {
                        if($obj->isNew()) {
                            $collTsUserUsrs[] = $obj;
                        }
                    }
                }

                $this->collTsUserUsrs = $collTsUserUsrs;
                $this->collTsUserUsrsPartial = false;
            }
        }

        return $this->collTsUserUsrs;
    }

    /**
     * Sets a collection of TsUserUsr objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tsUserUsrs A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTsUserUsrs(PropelCollection $tsUserUsrs, PropelPDO $con = null)
    {
        $this->tsUserUsrsScheduledForDeletion = $this->getTsUserUsrs(new Criteria(), $con)->diff($tsUserUsrs);

        foreach ($this->tsUserUsrsScheduledForDeletion as $tsUserUsrRemoved) {
            $tsUserUsrRemoved->setTsImageImg(null);
        }

        $this->collTsUserUsrs = null;
        foreach ($tsUserUsrs as $tsUserUsr) {
            $this->addTsUserUsr($tsUserUsr);
        }

        $this->collTsUserUsrs = $tsUserUsrs;
        $this->collTsUserUsrsPartial = false;
    }

    /**
     * Returns the number of related TsUserUsr objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TsUserUsr objects.
     * @throws PropelException
     */
    public function countTsUserUsrs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTsUserUsrsPartial && !$this->isNew();
        if (null === $this->collTsUserUsrs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTsUserUsrs) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTsUserUsrs());
                }
                $query = TsUserUsrQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTsImageImg($this)
                    ->count($con);
            }
        } else {
            return count($this->collTsUserUsrs);
        }
    }

    /**
     * Method called to associate a TsUserUsr object to this object
     * through the TsUserUsr foreign key attribute.
     *
     * @param    TsUserUsr $l TsUserUsr
     * @return TsImageImg The current object (for fluent API support)
     */
    public function addTsUserUsr(TsUserUsr $l)
    {
        if ($this->collTsUserUsrs === null) {
            $this->initTsUserUsrs();
            $this->collTsUserUsrsPartial = true;
        }
        if (!in_array($l, $this->collTsUserUsrs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTsUserUsr($l);
        }

        return $this;
    }

    /**
     * @param	TsUserUsr $tsUserUsr The tsUserUsr object to add.
     */
    protected function doAddTsUserUsr($tsUserUsr)
    {
        $this->collTsUserUsrs[]= $tsUserUsr;
        $tsUserUsr->setTsImageImg($this);
    }

    /**
     * @param	TsUserUsr $tsUserUsr The tsUserUsr object to remove.
     */
    public function removeTsUserUsr($tsUserUsr)
    {
        if ($this->getTsUserUsrs()->contains($tsUserUsr)) {
            $this->collTsUserUsrs->remove($this->collTsUserUsrs->search($tsUserUsr));
            if (null === $this->tsUserUsrsScheduledForDeletion) {
                $this->tsUserUsrsScheduledForDeletion = clone $this->collTsUserUsrs;
                $this->tsUserUsrsScheduledForDeletion->clear();
            }
            $this->tsUserUsrsScheduledForDeletion[]= $tsUserUsr;
            $tsUserUsr->setTsImageImg(null);
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->img_id = null;
        $this->img_mime = null;
        $this->img_width = null;
        $this->img_length = null;
        $this->img_content = null;
        $this->img_removed = null;
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
            if ($this->collTObjectObjs) {
                foreach ($this->collTObjectObjs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTsUserUsrs) {
                foreach ($this->collTsUserUsrs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collTObjectObjs instanceof PropelCollection) {
            $this->collTObjectObjs->clearIterator();
        }
        $this->collTObjectObjs = null;
        if ($this->collTsUserUsrs instanceof PropelCollection) {
            $this->collTsUserUsrs->clearIterator();
        }
        $this->collTsUserUsrs = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TsImageImgPeer::DEFAULT_STRING_FORMAT);
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
