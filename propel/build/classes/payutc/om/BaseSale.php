<?php

namespace Payutc\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelException;
use \PropelPDO;
use Payutc\Item;
use Payutc\ItemQuery;
use Payutc\Period;
use Payutc\PeriodQuery;
use Payutc\Sale;
use Payutc\SalePeer;
use Payutc\SaleQuery;

/**
 * Base class that represents a row from the 't_sale_sal' table.
 *
 *
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseSale extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Payutc\\SalePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        SalePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the sal_id field.
     * @var        int
     */
    protected $sal_id;

    /**
     * The value for the sal_name field.
     * @var        string
     */
    protected $sal_name;

    /**
     * The value for the per_id field.
     * @var        int
     */
    protected $per_id;

    /**
     * The value for the obj_id field.
     * @var        int
     */
    protected $obj_id;

    /**
     * The value for the sal_removed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $sal_removed;

    /**
     * @var        Item
     */
    protected $aItem;

    /**
     * @var        Period
     */
    protected $aPeriod;

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
        $this->sal_removed = false;
    }

    /**
     * Initializes internal state of BaseSale object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [sal_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->sal_id;
    }

    /**
     * Get the [sal_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->sal_name;
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
     * Get the [obj_id] column value.
     *
     * @return int
     */
    public function getObjId()
    {
        return $this->obj_id;
    }

    /**
     * Get the [sal_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->sal_removed;
    }

    /**
     * Set the value of [sal_id] column.
     *
     * @param int $v new value
     * @return Sale The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sal_id !== $v) {
            $this->sal_id = $v;
            $this->modifiedColumns[] = SalePeer::SAL_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [sal_name] column.
     *
     * @param string $v new value
     * @return Sale The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sal_name !== $v) {
            $this->sal_name = $v;
            $this->modifiedColumns[] = SalePeer::SAL_NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [per_id] column.
     *
     * @param int $v new value
     * @return Sale The current object (for fluent API support)
     */
    public function setPerId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->per_id !== $v) {
            $this->per_id = $v;
            $this->modifiedColumns[] = SalePeer::PER_ID;
        }

        if ($this->aPeriod !== null && $this->aPeriod->getId() !== $v) {
            $this->aPeriod = null;
        }


        return $this;
    } // setPerId()

    /**
     * Set the value of [obj_id] column.
     *
     * @param int $v new value
     * @return Sale The current object (for fluent API support)
     */
    public function setObjId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_id !== $v) {
            $this->obj_id = $v;
            $this->modifiedColumns[] = SalePeer::OBJ_ID;
        }

        if ($this->aItem !== null && $this->aItem->getId() !== $v) {
            $this->aItem = null;
        }


        return $this;
    } // setObjId()

    /**
     * Sets the value of the [sal_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Sale The current object (for fluent API support)
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

        if ($this->sal_removed !== $v) {
            $this->sal_removed = $v;
            $this->modifiedColumns[] = SalePeer::SAL_REMOVED;
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
            if ($this->sal_removed !== false) {
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

            $this->sal_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->sal_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->per_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->obj_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->sal_removed = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = SalePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Sale object", $e);
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

        if ($this->aPeriod !== null && $this->per_id !== $this->aPeriod->getId()) {
            $this->aPeriod = null;
        }
        if ($this->aItem !== null && $this->obj_id !== $this->aItem->getId()) {
            $this->aItem = null;
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
            $con = Propel::getConnection(SalePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = SalePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aItem = null;
            $this->aPeriod = null;
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
            $con = Propel::getConnection(SalePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = SaleQuery::create()
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
            $con = Propel::getConnection(SalePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                SalePeer::addInstanceToPool($this);
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

            if ($this->aItem !== null) {
                if ($this->aItem->isModified() || $this->aItem->isNew()) {
                    $affectedRows += $this->aItem->save($con);
                }
                $this->setItem($this->aItem);
            }

            if ($this->aPeriod !== null) {
                if ($this->aPeriod->isModified() || $this->aPeriod->isNew()) {
                    $affectedRows += $this->aPeriod->save($con);
                }
                $this->setPeriod($this->aPeriod);
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

        $this->modifiedColumns[] = SalePeer::SAL_ID;
        if (null !== $this->sal_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SalePeer::SAL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SalePeer::SAL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`SAL_ID`';
        }
        if ($this->isColumnModified(SalePeer::SAL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`SAL_NAME`';
        }
        if ($this->isColumnModified(SalePeer::PER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`PER_ID`';
        }
        if ($this->isColumnModified(SalePeer::OBJ_ID)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_ID`';
        }
        if ($this->isColumnModified(SalePeer::SAL_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`SAL_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `t_sale_sal` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`SAL_ID`':
                        $stmt->bindValue($identifier, $this->sal_id, PDO::PARAM_INT);
                        break;
                    case '`SAL_NAME`':
                        $stmt->bindValue($identifier, $this->sal_name, PDO::PARAM_STR);
                        break;
                    case '`PER_ID`':
                        $stmt->bindValue($identifier, $this->per_id, PDO::PARAM_INT);
                        break;
                    case '`OBJ_ID`':
                        $stmt->bindValue($identifier, $this->obj_id, PDO::PARAM_INT);
                        break;
                    case '`SAL_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->sal_removed, PDO::PARAM_INT);
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

            if ($this->aItem !== null) {
                if (!$this->aItem->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aItem->getValidationFailures());
                }
            }

            if ($this->aPeriod !== null) {
                if (!$this->aPeriod->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aPeriod->getValidationFailures());
                }
            }


            if (($retval = SalePeer::doValidate($this, $columns)) !== true) {
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
        $pos = SalePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getPerId();
                break;
            case 3:
                return $this->getObjId();
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
        if (isset($alreadyDumpedObjects['Sale'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Sale'][$this->getPrimaryKey()] = true;
        $keys = SalePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getPerId(),
            $keys[3] => $this->getObjId(),
            $keys[4] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aItem) {
                $result['Item'] = $this->aItem->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPeriod) {
                $result['Period'] = $this->aPeriod->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = SalePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setPerId($value);
                break;
            case 3:
                $this->setObjId($value);
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
        $keys = SalePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPerId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setObjId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setRemoved($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SalePeer::DATABASE_NAME);

        if ($this->isColumnModified(SalePeer::SAL_ID)) $criteria->add(SalePeer::SAL_ID, $this->sal_id);
        if ($this->isColumnModified(SalePeer::SAL_NAME)) $criteria->add(SalePeer::SAL_NAME, $this->sal_name);
        if ($this->isColumnModified(SalePeer::PER_ID)) $criteria->add(SalePeer::PER_ID, $this->per_id);
        if ($this->isColumnModified(SalePeer::OBJ_ID)) $criteria->add(SalePeer::OBJ_ID, $this->obj_id);
        if ($this->isColumnModified(SalePeer::SAL_REMOVED)) $criteria->add(SalePeer::SAL_REMOVED, $this->sal_removed);

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
        $criteria = new Criteria(SalePeer::DATABASE_NAME);
        $criteria->add(SalePeer::SAL_ID, $this->sal_id);

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
     * Generic method to set the primary key (sal_id column).
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
     * @param object $copyObj An object of Sale (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setPerId($this->getPerId());
        $copyObj->setObjId($this->getObjId());
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
     * @return Sale Clone of current object.
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
     * @return SalePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new SalePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Item object.
     *
     * @param             Item $v
     * @return Sale The current object (for fluent API support)
     * @throws PropelException
     */
    public function setItem(Item $v = null)
    {
        if ($v === null) {
            $this->setObjId(NULL);
        } else {
            $this->setObjId($v->getId());
        }

        $this->aItem = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Item object, it will not be re-added.
        if ($v !== null) {
            $v->addSale($this);
        }


        return $this;
    }


    /**
     * Get the associated Item object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Item The associated Item object.
     * @throws PropelException
     */
    public function getItem(PropelPDO $con = null)
    {
        if ($this->aItem === null && ($this->obj_id !== null)) {
            $this->aItem = ItemQuery::create()->findPk($this->obj_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aItem->addSales($this);
             */
        }

        return $this->aItem;
    }

    /**
     * Declares an association between this object and a Period object.
     *
     * @param             Period $v
     * @return Sale The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPeriod(Period $v = null)
    {
        if ($v === null) {
            $this->setPerId(NULL);
        } else {
            $this->setPerId($v->getId());
        }

        $this->aPeriod = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Period object, it will not be re-added.
        if ($v !== null) {
            $v->addSale($this);
        }


        return $this;
    }


    /**
     * Get the associated Period object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Period The associated Period object.
     * @throws PropelException
     */
    public function getPeriod(PropelPDO $con = null)
    {
        if ($this->aPeriod === null && ($this->per_id !== null)) {
            $this->aPeriod = PeriodQuery::create()->findPk($this->per_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPeriod->addSales($this);
             */
        }

        return $this->aPeriod;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->sal_id = null;
        $this->sal_name = null;
        $this->per_id = null;
        $this->obj_id = null;
        $this->sal_removed = null;
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

        $this->aItem = null;
        $this->aPeriod = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SalePeer::DEFAULT_STRING_FORMAT);
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
