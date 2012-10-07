<?php

namespace Payutc\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Payutc\Callback;
use Payutc\CallbackQuery;
use Payutc\JUsrMol;
use Payutc\JUsrMolQuery;
use Payutc\MeanOfLogin;
use Payutc\MeanOfLoginPeer;
use Payutc\MeanOfLoginQuery;
use Payutc\User;
use Payutc\UserQuery;

/**
 * Base class that represents a row from the 'ts_mean_of_login_mol' table.
 *
 *
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseMeanOfLogin extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Payutc\\MeanOfLoginPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        MeanOfLoginPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the mol_id field.
     * @var        int
     */
    protected $mol_id;

    /**
     * The value for the mol_name field.
     * @var        string
     */
    protected $mol_name;

    /**
     * The value for the mol_removed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $mol_removed;

    /**
     * @var        PropelObjectCollection|JUsrMol[] Collection to store aggregation of JUsrMol objects.
     */
    protected $collJUsrMols;
    protected $collJUsrMolsPartial;

    /**
     * @var        PropelObjectCollection|Callback[] Collection to store aggregation of Callback objects.
     */
    protected $collCallbacks;
    protected $collCallbacksPartial;

    /**
     * @var        PropelObjectCollection|User[] Collection to store aggregation of User objects.
     */
    protected $collUsers;

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
    protected $usersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $jUsrMolsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $callbacksScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->mol_removed = false;
    }

    /**
     * Initializes internal state of BaseMeanOfLogin object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [mol_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->mol_id;
    }

    /**
     * Get the [mol_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->mol_name;
    }

    /**
     * Get the [mol_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->mol_removed;
    }

    /**
     * Set the value of [mol_id] column.
     *
     * @param int $v new value
     * @return MeanOfLogin The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->mol_id !== $v) {
            $this->mol_id = $v;
            $this->modifiedColumns[] = MeanOfLoginPeer::MOL_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [mol_name] column.
     *
     * @param string $v new value
     * @return MeanOfLogin The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mol_name !== $v) {
            $this->mol_name = $v;
            $this->modifiedColumns[] = MeanOfLoginPeer::MOL_NAME;
        }


        return $this;
    } // setName()

    /**
     * Sets the value of the [mol_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return MeanOfLogin The current object (for fluent API support)
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

        if ($this->mol_removed !== $v) {
            $this->mol_removed = $v;
            $this->modifiedColumns[] = MeanOfLoginPeer::MOL_REMOVED;
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
            if ($this->mol_removed !== false) {
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

            $this->mol_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->mol_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->mol_removed = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = MeanOfLoginPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating MeanOfLogin object", $e);
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
            $con = Propel::getConnection(MeanOfLoginPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = MeanOfLoginPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collJUsrMols = null;

            $this->collCallbacks = null;

            $this->collUsers = null;
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
            $con = Propel::getConnection(MeanOfLoginPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = MeanOfLoginQuery::create()
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
            $con = Propel::getConnection(MeanOfLoginPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                MeanOfLoginPeer::addInstanceToPool($this);
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

            if ($this->usersScheduledForDeletion !== null) {
                if (!$this->usersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->usersScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    JUsrMolQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->usersScheduledForDeletion = null;
                }

                foreach ($this->getUsers() as $user) {
                    if ($user->isModified()) {
                        $user->save($con);
                    }
                }
            }

            if ($this->jUsrMolsScheduledForDeletion !== null) {
                if (!$this->jUsrMolsScheduledForDeletion->isEmpty()) {
                    JUsrMolQuery::create()
                        ->filterByPrimaryKeys($this->jUsrMolsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jUsrMolsScheduledForDeletion = null;
                }
            }

            if ($this->collJUsrMols !== null) {
                foreach ($this->collJUsrMols as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->callbacksScheduledForDeletion !== null) {
                if (!$this->callbacksScheduledForDeletion->isEmpty()) {
                    CallbackQuery::create()
                        ->filterByPrimaryKeys($this->callbacksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->callbacksScheduledForDeletion = null;
                }
            }

            if ($this->collCallbacks !== null) {
                foreach ($this->collCallbacks as $referrerFK) {
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

        $this->modifiedColumns[] = MeanOfLoginPeer::MOL_ID;
        if (null !== $this->mol_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MeanOfLoginPeer::MOL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MeanOfLoginPeer::MOL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`MOL_ID`';
        }
        if ($this->isColumnModified(MeanOfLoginPeer::MOL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`MOL_NAME`';
        }
        if ($this->isColumnModified(MeanOfLoginPeer::MOL_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`MOL_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `ts_mean_of_login_mol` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`MOL_ID`':
                        $stmt->bindValue($identifier, $this->mol_id, PDO::PARAM_INT);
                        break;
                    case '`MOL_NAME`':
                        $stmt->bindValue($identifier, $this->mol_name, PDO::PARAM_STR);
                        break;
                    case '`MOL_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->mol_removed, PDO::PARAM_INT);
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


            if (($retval = MeanOfLoginPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collJUsrMols !== null) {
                    foreach ($this->collJUsrMols as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCallbacks !== null) {
                    foreach ($this->collCallbacks as $referrerFK) {
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
        $pos = MeanOfLoginPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['MeanOfLogin'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['MeanOfLogin'][$this->getPrimaryKey()] = true;
        $keys = MeanOfLoginPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collJUsrMols) {
                $result['JUsrMols'] = $this->collJUsrMols->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCallbacks) {
                $result['Callbacks'] = $this->collCallbacks->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = MeanOfLoginPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
        $keys = MeanOfLoginPeer::getFieldNames($keyType);

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
        $criteria = new Criteria(MeanOfLoginPeer::DATABASE_NAME);

        if ($this->isColumnModified(MeanOfLoginPeer::MOL_ID)) $criteria->add(MeanOfLoginPeer::MOL_ID, $this->mol_id);
        if ($this->isColumnModified(MeanOfLoginPeer::MOL_NAME)) $criteria->add(MeanOfLoginPeer::MOL_NAME, $this->mol_name);
        if ($this->isColumnModified(MeanOfLoginPeer::MOL_REMOVED)) $criteria->add(MeanOfLoginPeer::MOL_REMOVED, $this->mol_removed);

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
        $criteria = new Criteria(MeanOfLoginPeer::DATABASE_NAME);
        $criteria->add(MeanOfLoginPeer::MOL_ID, $this->mol_id);

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
     * Generic method to set the primary key (mol_id column).
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
     * @param object $copyObj An object of MeanOfLogin (or compatible) type.
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

            foreach ($this->getJUsrMols() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJUsrMol($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCallbacks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCallback($relObj->copy($deepCopy));
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
     * @return MeanOfLogin Clone of current object.
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
     * @return MeanOfLoginPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new MeanOfLoginPeer();
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
        if ('JUsrMol' == $relationName) {
            $this->initJUsrMols();
        }
        if ('Callback' == $relationName) {
            $this->initCallbacks();
        }
    }

    /**
     * Clears out the collJUsrMols collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJUsrMols()
     */
    public function clearJUsrMols()
    {
        $this->collJUsrMols = null; // important to set this to null since that means it is uninitialized
        $this->collJUsrMolsPartial = null;
    }

    /**
     * reset is the collJUsrMols collection loaded partially
     *
     * @return void
     */
    public function resetPartialJUsrMols($v = true)
    {
        $this->collJUsrMolsPartial = $v;
    }

    /**
     * Initializes the collJUsrMols collection.
     *
     * By default this just sets the collJUsrMols collection to an empty array (like clearcollJUsrMols());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJUsrMols($overrideExisting = true)
    {
        if (null !== $this->collJUsrMols && !$overrideExisting) {
            return;
        }
        $this->collJUsrMols = new PropelObjectCollection();
        $this->collJUsrMols->setModel('JUsrMol');
    }

    /**
     * Gets an array of JUsrMol objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this MeanOfLogin is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|JUsrMol[] List of JUsrMol objects
     * @throws PropelException
     */
    public function getJUsrMols($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collJUsrMolsPartial && !$this->isNew();
        if (null === $this->collJUsrMols || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJUsrMols) {
                // return empty collection
                $this->initJUsrMols();
            } else {
                $collJUsrMols = JUsrMolQuery::create(null, $criteria)
                    ->filterByMeanOfLogin($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collJUsrMolsPartial && count($collJUsrMols)) {
                      $this->initJUsrMols(false);

                      foreach($collJUsrMols as $obj) {
                        if (false == $this->collJUsrMols->contains($obj)) {
                          $this->collJUsrMols->append($obj);
                        }
                      }

                      $this->collJUsrMolsPartial = true;
                    }

                    return $collJUsrMols;
                }

                if($partial && $this->collJUsrMols) {
                    foreach($this->collJUsrMols as $obj) {
                        if($obj->isNew()) {
                            $collJUsrMols[] = $obj;
                        }
                    }
                }

                $this->collJUsrMols = $collJUsrMols;
                $this->collJUsrMolsPartial = false;
            }
        }

        return $this->collJUsrMols;
    }

    /**
     * Sets a collection of JUsrMol objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $jUsrMols A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setJUsrMols(PropelCollection $jUsrMols, PropelPDO $con = null)
    {
        $this->jUsrMolsScheduledForDeletion = $this->getJUsrMols(new Criteria(), $con)->diff($jUsrMols);

        foreach ($this->jUsrMolsScheduledForDeletion as $jUsrMolRemoved) {
            $jUsrMolRemoved->setMeanOfLogin(null);
        }

        $this->collJUsrMols = null;
        foreach ($jUsrMols as $jUsrMol) {
            $this->addJUsrMol($jUsrMol);
        }

        $this->collJUsrMols = $jUsrMols;
        $this->collJUsrMolsPartial = false;
    }

    /**
     * Returns the number of related JUsrMol objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related JUsrMol objects.
     * @throws PropelException
     */
    public function countJUsrMols(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collJUsrMolsPartial && !$this->isNew();
        if (null === $this->collJUsrMols || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJUsrMols) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getJUsrMols());
                }
                $query = JUsrMolQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByMeanOfLogin($this)
                    ->count($con);
            }
        } else {
            return count($this->collJUsrMols);
        }
    }

    /**
     * Method called to associate a JUsrMol object to this object
     * through the JUsrMol foreign key attribute.
     *
     * @param    JUsrMol $l JUsrMol
     * @return MeanOfLogin The current object (for fluent API support)
     */
    public function addJUsrMol(JUsrMol $l)
    {
        if ($this->collJUsrMols === null) {
            $this->initJUsrMols();
            $this->collJUsrMolsPartial = true;
        }
        if (!in_array($l, $this->collJUsrMols->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddJUsrMol($l);
        }

        return $this;
    }

    /**
     * @param	JUsrMol $jUsrMol The jUsrMol object to add.
     */
    protected function doAddJUsrMol($jUsrMol)
    {
        $this->collJUsrMols[]= $jUsrMol;
        $jUsrMol->setMeanOfLogin($this);
    }

    /**
     * @param	JUsrMol $jUsrMol The jUsrMol object to remove.
     */
    public function removeJUsrMol($jUsrMol)
    {
        if ($this->getJUsrMols()->contains($jUsrMol)) {
            $this->collJUsrMols->remove($this->collJUsrMols->search($jUsrMol));
            if (null === $this->jUsrMolsScheduledForDeletion) {
                $this->jUsrMolsScheduledForDeletion = clone $this->collJUsrMols;
                $this->jUsrMolsScheduledForDeletion->clear();
            }
            $this->jUsrMolsScheduledForDeletion[]= $jUsrMol;
            $jUsrMol->setMeanOfLogin(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this MeanOfLogin is new, it will return
     * an empty collection; or if this MeanOfLogin has previously
     * been saved, it will retrieve related JUsrMols from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in MeanOfLogin.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|JUsrMol[] List of JUsrMol objects
     */
    public function getJUsrMolsJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = JUsrMolQuery::create(null, $criteria);
        $query->joinWith('User', $join_behavior);

        return $this->getJUsrMols($query, $con);
    }

    /**
     * Clears out the collCallbacks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCallbacks()
     */
    public function clearCallbacks()
    {
        $this->collCallbacks = null; // important to set this to null since that means it is uninitialized
        $this->collCallbacksPartial = null;
    }

    /**
     * reset is the collCallbacks collection loaded partially
     *
     * @return void
     */
    public function resetPartialCallbacks($v = true)
    {
        $this->collCallbacksPartial = $v;
    }

    /**
     * Initializes the collCallbacks collection.
     *
     * By default this just sets the collCallbacks collection to an empty array (like clearcollCallbacks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCallbacks($overrideExisting = true)
    {
        if (null !== $this->collCallbacks && !$overrideExisting) {
            return;
        }
        $this->collCallbacks = new PropelObjectCollection();
        $this->collCallbacks->setModel('Callback');
    }

    /**
     * Gets an array of Callback objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this MeanOfLogin is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Callback[] List of Callback objects
     * @throws PropelException
     */
    public function getCallbacks($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCallbacksPartial && !$this->isNew();
        if (null === $this->collCallbacks || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCallbacks) {
                // return empty collection
                $this->initCallbacks();
            } else {
                $collCallbacks = CallbackQuery::create(null, $criteria)
                    ->filterByMeanOfLogin($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCallbacksPartial && count($collCallbacks)) {
                      $this->initCallbacks(false);

                      foreach($collCallbacks as $obj) {
                        if (false == $this->collCallbacks->contains($obj)) {
                          $this->collCallbacks->append($obj);
                        }
                      }

                      $this->collCallbacksPartial = true;
                    }

                    return $collCallbacks;
                }

                if($partial && $this->collCallbacks) {
                    foreach($this->collCallbacks as $obj) {
                        if($obj->isNew()) {
                            $collCallbacks[] = $obj;
                        }
                    }
                }

                $this->collCallbacks = $collCallbacks;
                $this->collCallbacksPartial = false;
            }
        }

        return $this->collCallbacks;
    }

    /**
     * Sets a collection of Callback objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $callbacks A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setCallbacks(PropelCollection $callbacks, PropelPDO $con = null)
    {
        $this->callbacksScheduledForDeletion = $this->getCallbacks(new Criteria(), $con)->diff($callbacks);

        foreach ($this->callbacksScheduledForDeletion as $callbackRemoved) {
            $callbackRemoved->setMeanOfLogin(null);
        }

        $this->collCallbacks = null;
        foreach ($callbacks as $callback) {
            $this->addCallback($callback);
        }

        $this->collCallbacks = $callbacks;
        $this->collCallbacksPartial = false;
    }

    /**
     * Returns the number of related Callback objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Callback objects.
     * @throws PropelException
     */
    public function countCallbacks(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCallbacksPartial && !$this->isNew();
        if (null === $this->collCallbacks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCallbacks) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getCallbacks());
                }
                $query = CallbackQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByMeanOfLogin($this)
                    ->count($con);
            }
        } else {
            return count($this->collCallbacks);
        }
    }

    /**
     * Method called to associate a Callback object to this object
     * through the Callback foreign key attribute.
     *
     * @param    Callback $l Callback
     * @return MeanOfLogin The current object (for fluent API support)
     */
    public function addCallback(Callback $l)
    {
        if ($this->collCallbacks === null) {
            $this->initCallbacks();
            $this->collCallbacksPartial = true;
        }
        if (!in_array($l, $this->collCallbacks->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCallback($l);
        }

        return $this;
    }

    /**
     * @param	Callback $callback The callback object to add.
     */
    protected function doAddCallback($callback)
    {
        $this->collCallbacks[]= $callback;
        $callback->setMeanOfLogin($this);
    }

    /**
     * @param	Callback $callback The callback object to remove.
     */
    public function removeCallback($callback)
    {
        if ($this->getCallbacks()->contains($callback)) {
            $this->collCallbacks->remove($this->collCallbacks->search($callback));
            if (null === $this->callbacksScheduledForDeletion) {
                $this->callbacksScheduledForDeletion = clone $this->collCallbacks;
                $this->callbacksScheduledForDeletion->clear();
            }
            $this->callbacksScheduledForDeletion[]= $callback;
            $callback->setMeanOfLogin(null);
        }
    }

    /**
     * Clears out the collUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsers()
     */
    public function clearUsers()
    {
        $this->collUsers = null; // important to set this to null since that means it is uninitialized
        $this->collUsersPartial = null;
    }

    /**
     * Initializes the collUsers collection.
     *
     * By default this just sets the collUsers collection to an empty collection (like clearUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initUsers()
    {
        $this->collUsers = new PropelObjectCollection();
        $this->collUsers->setModel('User');
    }

    /**
     * Gets a collection of User objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_mol_jum cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this MeanOfLogin is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|User[] List of User objects
     */
    public function getUsers($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collUsers || null !== $criteria) {
            if ($this->isNew() && null === $this->collUsers) {
                // return empty collection
                $this->initUsers();
            } else {
                $collUsers = UserQuery::create(null, $criteria)
                    ->filterByMeanOfLogin($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collUsers;
                }
                $this->collUsers = $collUsers;
            }
        }

        return $this->collUsers;
    }

    /**
     * Sets a collection of User objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_mol_jum cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $users A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setUsers(PropelCollection $users, PropelPDO $con = null)
    {
        $this->clearUsers();
        $currentUsers = $this->getUsers();

        $this->usersScheduledForDeletion = $currentUsers->diff($users);

        foreach ($users as $user) {
            if (!$currentUsers->contains($user)) {
                $this->doAddUser($user);
            }
        }

        $this->collUsers = $users;
    }

    /**
     * Gets the number of User objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_mol_jum cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related User objects
     */
    public function countUsers($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collUsers || null !== $criteria) {
            if ($this->isNew() && null === $this->collUsers) {
                return 0;
            } else {
                $query = UserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByMeanOfLogin($this)
                    ->count($con);
            }
        } else {
            return count($this->collUsers);
        }
    }

    /**
     * Associate a User object to this object
     * through the tj_usr_mol_jum cross reference table.
     *
     * @param  User $user The JUsrMol object to relate
     * @return void
     */
    public function addUser(User $user)
    {
        if ($this->collUsers === null) {
            $this->initUsers();
        }
        if (!$this->collUsers->contains($user)) { // only add it if the **same** object is not already associated
            $this->doAddUser($user);

            $this->collUsers[]= $user;
        }
    }

    /**
     * @param	User $user The user object to add.
     */
    protected function doAddUser($user)
    {
        $jUsrMol = new JUsrMol();
        $jUsrMol->setUser($user);
        $this->addJUsrMol($jUsrMol);
    }

    /**
     * Remove a User object to this object
     * through the tj_usr_mol_jum cross reference table.
     *
     * @param User $user The JUsrMol object to relate
     * @return void
     */
    public function removeUser(User $user)
    {
        if ($this->getUsers()->contains($user)) {
            $this->collUsers->remove($this->collUsers->search($user));
            if (null === $this->usersScheduledForDeletion) {
                $this->usersScheduledForDeletion = clone $this->collUsers;
                $this->usersScheduledForDeletion->clear();
            }
            $this->usersScheduledForDeletion[]= $user;
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->mol_id = null;
        $this->mol_name = null;
        $this->mol_removed = null;
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
            if ($this->collJUsrMols) {
                foreach ($this->collJUsrMols as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCallbacks) {
                foreach ($this->collCallbacks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsers) {
                foreach ($this->collUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collJUsrMols instanceof PropelCollection) {
            $this->collJUsrMols->clearIterator();
        }
        $this->collJUsrMols = null;
        if ($this->collCallbacks instanceof PropelCollection) {
            $this->collCallbacks->clearIterator();
        }
        $this->collCallbacks = null;
        if ($this->collUsers instanceof PropelCollection) {
            $this->collUsers->clearIterator();
        }
        $this->collUsers = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(MeanOfLoginPeer::DEFAULT_STRING_FORMAT);
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
