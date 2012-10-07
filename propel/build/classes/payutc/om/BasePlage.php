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
use Payutc\Fundation;
use Payutc\FundationQuery;
use Payutc\Plage;
use Payutc\PlagePeer;
use Payutc\PlageQuery;
use Payutc\Point;
use Payutc\PointQuery;

/**
 * Base class that represents a row from the 't_plage_pla' table.
 *
 *
 *
 * @package    propel.generator.payutc.om
 */
abstract class BasePlage extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Payutc\\PlagePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PlagePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the pla_id field.
     * @var        int
     */
    protected $pla_id;

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
     * The value for the pla_start field.
     * @var        int
     */
    protected $pla_start;

    /**
     * The value for the pla_end field.
     * @var        int
     */
    protected $pla_end;

    /**
     * The value for the pla_name field.
     * @var        string
     */
    protected $pla_name;

    /**
     * @var        Point
     */
    protected $aPoint;

    /**
     * @var        Fundation
     */
    protected $aFundation;

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
     * Get the [pla_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->pla_id;
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
     * Get the [pla_start] column value.
     *
     * @return int
     */
    public function getStart()
    {
        return $this->pla_start;
    }

    /**
     * Get the [pla_end] column value.
     *
     * @return int
     */
    public function getEnd()
    {
        return $this->pla_end;
    }

    /**
     * Get the [pla_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->pla_name;
    }

    /**
     * Set the value of [pla_id] column.
     *
     * @param int $v new value
     * @return Plage The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pla_id !== $v) {
            $this->pla_id = $v;
            $this->modifiedColumns[] = PlagePeer::PLA_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [fun_id] column.
     *
     * @param int $v new value
     * @return Plage The current object (for fluent API support)
     */
    public function setFunId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fun_id !== $v) {
            $this->fun_id = $v;
            $this->modifiedColumns[] = PlagePeer::FUN_ID;
        }

        if ($this->aFundation !== null && $this->aFundation->getId() !== $v) {
            $this->aFundation = null;
        }


        return $this;
    } // setFunId()

    /**
     * Set the value of [poi_id] column.
     *
     * @param int $v new value
     * @return Plage The current object (for fluent API support)
     */
    public function setPoiId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->poi_id !== $v) {
            $this->poi_id = $v;
            $this->modifiedColumns[] = PlagePeer::POI_ID;
        }

        if ($this->aPoint !== null && $this->aPoint->getId() !== $v) {
            $this->aPoint = null;
        }


        return $this;
    } // setPoiId()

    /**
     * Set the value of [pla_start] column.
     *
     * @param int $v new value
     * @return Plage The current object (for fluent API support)
     */
    public function setStart($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pla_start !== $v) {
            $this->pla_start = $v;
            $this->modifiedColumns[] = PlagePeer::PLA_START;
        }


        return $this;
    } // setStart()

    /**
     * Set the value of [pla_end] column.
     *
     * @param int $v new value
     * @return Plage The current object (for fluent API support)
     */
    public function setEnd($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pla_end !== $v) {
            $this->pla_end = $v;
            $this->modifiedColumns[] = PlagePeer::PLA_END;
        }


        return $this;
    } // setEnd()

    /**
     * Set the value of [pla_name] column.
     *
     * @param string $v new value
     * @return Plage The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pla_name !== $v) {
            $this->pla_name = $v;
            $this->modifiedColumns[] = PlagePeer::PLA_NAME;
        }


        return $this;
    } // setName()

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

            $this->pla_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->fun_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->poi_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->pla_start = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->pla_end = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->pla_name = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = PlagePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Plage object", $e);
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

        if ($this->aFundation !== null && $this->fun_id !== $this->aFundation->getId()) {
            $this->aFundation = null;
        }
        if ($this->aPoint !== null && $this->poi_id !== $this->aPoint->getId()) {
            $this->aPoint = null;
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
            $con = Propel::getConnection(PlagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PlagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPoint = null;
            $this->aFundation = null;
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
            $con = Propel::getConnection(PlagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PlageQuery::create()
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
            $con = Propel::getConnection(PlagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                PlagePeer::addInstanceToPool($this);
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

            if ($this->aPoint !== null) {
                if ($this->aPoint->isModified() || $this->aPoint->isNew()) {
                    $affectedRows += $this->aPoint->save($con);
                }
                $this->setPoint($this->aPoint);
            }

            if ($this->aFundation !== null) {
                if ($this->aFundation->isModified() || $this->aFundation->isNew()) {
                    $affectedRows += $this->aFundation->save($con);
                }
                $this->setFundation($this->aFundation);
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

        $this->modifiedColumns[] = PlagePeer::PLA_ID;
        if (null !== $this->pla_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PlagePeer::PLA_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PlagePeer::PLA_ID)) {
            $modifiedColumns[':p' . $index++]  = '`PLA_ID`';
        }
        if ($this->isColumnModified(PlagePeer::FUN_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_ID`';
        }
        if ($this->isColumnModified(PlagePeer::POI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`POI_ID`';
        }
        if ($this->isColumnModified(PlagePeer::PLA_START)) {
            $modifiedColumns[':p' . $index++]  = '`PLA_START`';
        }
        if ($this->isColumnModified(PlagePeer::PLA_END)) {
            $modifiedColumns[':p' . $index++]  = '`PLA_END`';
        }
        if ($this->isColumnModified(PlagePeer::PLA_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`PLA_NAME`';
        }

        $sql = sprintf(
            'INSERT INTO `t_plage_pla` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`PLA_ID`':
                        $stmt->bindValue($identifier, $this->pla_id, PDO::PARAM_INT);
                        break;
                    case '`FUN_ID`':
                        $stmt->bindValue($identifier, $this->fun_id, PDO::PARAM_INT);
                        break;
                    case '`POI_ID`':
                        $stmt->bindValue($identifier, $this->poi_id, PDO::PARAM_INT);
                        break;
                    case '`PLA_START`':
                        $stmt->bindValue($identifier, $this->pla_start, PDO::PARAM_INT);
                        break;
                    case '`PLA_END`':
                        $stmt->bindValue($identifier, $this->pla_end, PDO::PARAM_INT);
                        break;
                    case '`PLA_NAME`':
                        $stmt->bindValue($identifier, $this->pla_name, PDO::PARAM_STR);
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

            if ($this->aPoint !== null) {
                if (!$this->aPoint->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aPoint->getValidationFailures());
                }
            }

            if ($this->aFundation !== null) {
                if (!$this->aFundation->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aFundation->getValidationFailures());
                }
            }


            if (($retval = PlagePeer::doValidate($this, $columns)) !== true) {
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
        $pos = PlagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getFunId();
                break;
            case 2:
                return $this->getPoiId();
                break;
            case 3:
                return $this->getStart();
                break;
            case 4:
                return $this->getEnd();
                break;
            case 5:
                return $this->getName();
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
        if (isset($alreadyDumpedObjects['Plage'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Plage'][$this->getPrimaryKey()] = true;
        $keys = PlagePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFunId(),
            $keys[2] => $this->getPoiId(),
            $keys[3] => $this->getStart(),
            $keys[4] => $this->getEnd(),
            $keys[5] => $this->getName(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aPoint) {
                $result['Point'] = $this->aPoint->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aFundation) {
                $result['Fundation'] = $this->aFundation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = PlagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setFunId($value);
                break;
            case 2:
                $this->setPoiId($value);
                break;
            case 3:
                $this->setStart($value);
                break;
            case 4:
                $this->setEnd($value);
                break;
            case 5:
                $this->setName($value);
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
        $keys = PlagePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFunId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPoiId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setStart($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setEnd($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setName($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PlagePeer::DATABASE_NAME);

        if ($this->isColumnModified(PlagePeer::PLA_ID)) $criteria->add(PlagePeer::PLA_ID, $this->pla_id);
        if ($this->isColumnModified(PlagePeer::FUN_ID)) $criteria->add(PlagePeer::FUN_ID, $this->fun_id);
        if ($this->isColumnModified(PlagePeer::POI_ID)) $criteria->add(PlagePeer::POI_ID, $this->poi_id);
        if ($this->isColumnModified(PlagePeer::PLA_START)) $criteria->add(PlagePeer::PLA_START, $this->pla_start);
        if ($this->isColumnModified(PlagePeer::PLA_END)) $criteria->add(PlagePeer::PLA_END, $this->pla_end);
        if ($this->isColumnModified(PlagePeer::PLA_NAME)) $criteria->add(PlagePeer::PLA_NAME, $this->pla_name);

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
        $criteria = new Criteria(PlagePeer::DATABASE_NAME);
        $criteria->add(PlagePeer::PLA_ID, $this->pla_id);

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
     * Generic method to set the primary key (pla_id column).
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
     * @param object $copyObj An object of Plage (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFunId($this->getFunId());
        $copyObj->setPoiId($this->getPoiId());
        $copyObj->setStart($this->getStart());
        $copyObj->setEnd($this->getEnd());
        $copyObj->setName($this->getName());

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
     * @return Plage Clone of current object.
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
     * @return PlagePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PlagePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Point object.
     *
     * @param             Point $v
     * @return Plage The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPoint(Point $v = null)
    {
        if ($v === null) {
            $this->setPoiId(NULL);
        } else {
            $this->setPoiId($v->getId());
        }

        $this->aPoint = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Point object, it will not be re-added.
        if ($v !== null) {
            $v->addPlage($this);
        }


        return $this;
    }


    /**
     * Get the associated Point object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Point The associated Point object.
     * @throws PropelException
     */
    public function getPoint(PropelPDO $con = null)
    {
        if ($this->aPoint === null && ($this->poi_id !== null)) {
            $this->aPoint = PointQuery::create()->findPk($this->poi_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPoint->addPlages($this);
             */
        }

        return $this->aPoint;
    }

    /**
     * Declares an association between this object and a Fundation object.
     *
     * @param             Fundation $v
     * @return Plage The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFundation(Fundation $v = null)
    {
        if ($v === null) {
            $this->setFunId(NULL);
        } else {
            $this->setFunId($v->getId());
        }

        $this->aFundation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Fundation object, it will not be re-added.
        if ($v !== null) {
            $v->addPlage($this);
        }


        return $this;
    }


    /**
     * Get the associated Fundation object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Fundation The associated Fundation object.
     * @throws PropelException
     */
    public function getFundation(PropelPDO $con = null)
    {
        if ($this->aFundation === null && ($this->fun_id !== null)) {
            $this->aFundation = FundationQuery::create()->findPk($this->fun_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFundation->addPlages($this);
             */
        }

        return $this->aFundation;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->pla_id = null;
        $this->fun_id = null;
        $this->poi_id = null;
        $this->pla_start = null;
        $this->pla_end = null;
        $this->pla_name = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
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

        $this->aPoint = null;
        $this->aFundation = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PlagePeer::DEFAULT_STRING_FORMAT);
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
