<?php

namespace Payutc\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use Payutc\User;
use Payutc\UserQuery;
use Payutc\Virement;
use Payutc\VirementPeer;
use Payutc\VirementQuery;

/**
 * Base class that represents a row from the 't_virement_vir' table.
 *
 *
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseVirement extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Payutc\\VirementPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        VirementPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the vir_id field.
     * @var        int
     */
    protected $vir_id;

    /**
     * The value for the vir_date field.
     * @var        string
     */
    protected $vir_date;

    /**
     * The value for the vir_amount field.
     * @var        int
     */
    protected $vir_amount;

    /**
     * The value for the usr_id_from field.
     * @var        int
     */
    protected $usr_id_from;

    /**
     * The value for the usr_id_to field.
     * @var        int
     */
    protected $usr_id_to;

    /**
     * @var        User
     */
    protected $aUserRelatedByUsrIdTo;

    /**
     * @var        User
     */
    protected $aUserRelatedByUsrIdFrom;

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
     * Get the [vir_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->vir_id;
    }

    /**
     * Get the [optionally formatted] temporal [vir_date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDate($format = 'Y-m-d H:i:s')
    {
        if ($this->vir_date === null) {
            return null;
        }

        if ($this->vir_date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->vir_date);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->vir_date, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [vir_amount] column value.
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->vir_amount;
    }

    /**
     * Get the [usr_id_from] column value.
     *
     * @return int
     */
    public function getUsrIdFrom()
    {
        return $this->usr_id_from;
    }

    /**
     * Get the [usr_id_to] column value.
     *
     * @return int
     */
    public function getUsrIdTo()
    {
        return $this->usr_id_to;
    }

    /**
     * Set the value of [vir_id] column.
     *
     * @param int $v new value
     * @return Virement The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->vir_id !== $v) {
            $this->vir_id = $v;
            $this->modifiedColumns[] = VirementPeer::VIR_ID;
        }


        return $this;
    } // setId()

    /**
     * Sets the value of [vir_date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Virement The current object (for fluent API support)
     */
    public function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->vir_date !== null || $dt !== null) {
            $currentDateAsString = ($this->vir_date !== null && $tmpDt = new DateTime($this->vir_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->vir_date = $newDateAsString;
                $this->modifiedColumns[] = VirementPeer::VIR_DATE;
            }
        } // if either are not null


        return $this;
    } // setDate()

    /**
     * Set the value of [vir_amount] column.
     *
     * @param int $v new value
     * @return Virement The current object (for fluent API support)
     */
    public function setAmount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->vir_amount !== $v) {
            $this->vir_amount = $v;
            $this->modifiedColumns[] = VirementPeer::VIR_AMOUNT;
        }


        return $this;
    } // setAmount()

    /**
     * Set the value of [usr_id_from] column.
     *
     * @param int $v new value
     * @return Virement The current object (for fluent API support)
     */
    public function setUsrIdFrom($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_id_from !== $v) {
            $this->usr_id_from = $v;
            $this->modifiedColumns[] = VirementPeer::USR_ID_FROM;
        }

        if ($this->aUserRelatedByUsrIdFrom !== null && $this->aUserRelatedByUsrIdFrom->getId() !== $v) {
            $this->aUserRelatedByUsrIdFrom = null;
        }


        return $this;
    } // setUsrIdFrom()

    /**
     * Set the value of [usr_id_to] column.
     *
     * @param int $v new value
     * @return Virement The current object (for fluent API support)
     */
    public function setUsrIdTo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_id_to !== $v) {
            $this->usr_id_to = $v;
            $this->modifiedColumns[] = VirementPeer::USR_ID_TO;
        }

        if ($this->aUserRelatedByUsrIdTo !== null && $this->aUserRelatedByUsrIdTo->getId() !== $v) {
            $this->aUserRelatedByUsrIdTo = null;
        }


        return $this;
    } // setUsrIdTo()

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

            $this->vir_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->vir_date = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->vir_amount = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->usr_id_from = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->usr_id_to = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = VirementPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Virement object", $e);
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

        if ($this->aUserRelatedByUsrIdFrom !== null && $this->usr_id_from !== $this->aUserRelatedByUsrIdFrom->getId()) {
            $this->aUserRelatedByUsrIdFrom = null;
        }
        if ($this->aUserRelatedByUsrIdTo !== null && $this->usr_id_to !== $this->aUserRelatedByUsrIdTo->getId()) {
            $this->aUserRelatedByUsrIdTo = null;
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
            $con = Propel::getConnection(VirementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = VirementPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserRelatedByUsrIdTo = null;
            $this->aUserRelatedByUsrIdFrom = null;
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
            $con = Propel::getConnection(VirementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = VirementQuery::create()
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
            $con = Propel::getConnection(VirementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                VirementPeer::addInstanceToPool($this);
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

            if ($this->aUserRelatedByUsrIdTo !== null) {
                if ($this->aUserRelatedByUsrIdTo->isModified() || $this->aUserRelatedByUsrIdTo->isNew()) {
                    $affectedRows += $this->aUserRelatedByUsrIdTo->save($con);
                }
                $this->setUserRelatedByUsrIdTo($this->aUserRelatedByUsrIdTo);
            }

            if ($this->aUserRelatedByUsrIdFrom !== null) {
                if ($this->aUserRelatedByUsrIdFrom->isModified() || $this->aUserRelatedByUsrIdFrom->isNew()) {
                    $affectedRows += $this->aUserRelatedByUsrIdFrom->save($con);
                }
                $this->setUserRelatedByUsrIdFrom($this->aUserRelatedByUsrIdFrom);
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

        $this->modifiedColumns[] = VirementPeer::VIR_ID;
        if (null !== $this->vir_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . VirementPeer::VIR_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(VirementPeer::VIR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`VIR_ID`';
        }
        if ($this->isColumnModified(VirementPeer::VIR_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`VIR_DATE`';
        }
        if ($this->isColumnModified(VirementPeer::VIR_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = '`VIR_AMOUNT`';
        }
        if ($this->isColumnModified(VirementPeer::USR_ID_FROM)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ID_FROM`';
        }
        if ($this->isColumnModified(VirementPeer::USR_ID_TO)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ID_TO`';
        }

        $sql = sprintf(
            'INSERT INTO `t_virement_vir` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`VIR_ID`':
                        $stmt->bindValue($identifier, $this->vir_id, PDO::PARAM_INT);
                        break;
                    case '`VIR_DATE`':
                        $stmt->bindValue($identifier, $this->vir_date, PDO::PARAM_STR);
                        break;
                    case '`VIR_AMOUNT`':
                        $stmt->bindValue($identifier, $this->vir_amount, PDO::PARAM_INT);
                        break;
                    case '`USR_ID_FROM`':
                        $stmt->bindValue($identifier, $this->usr_id_from, PDO::PARAM_INT);
                        break;
                    case '`USR_ID_TO`':
                        $stmt->bindValue($identifier, $this->usr_id_to, PDO::PARAM_INT);
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

            if ($this->aUserRelatedByUsrIdTo !== null) {
                if (!$this->aUserRelatedByUsrIdTo->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUserRelatedByUsrIdTo->getValidationFailures());
                }
            }

            if ($this->aUserRelatedByUsrIdFrom !== null) {
                if (!$this->aUserRelatedByUsrIdFrom->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUserRelatedByUsrIdFrom->getValidationFailures());
                }
            }


            if (($retval = VirementPeer::doValidate($this, $columns)) !== true) {
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
        $pos = VirementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getDate();
                break;
            case 2:
                return $this->getAmount();
                break;
            case 3:
                return $this->getUsrIdFrom();
                break;
            case 4:
                return $this->getUsrIdTo();
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
        if (isset($alreadyDumpedObjects['Virement'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Virement'][$this->getPrimaryKey()] = true;
        $keys = VirementPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getDate(),
            $keys[2] => $this->getAmount(),
            $keys[3] => $this->getUsrIdFrom(),
            $keys[4] => $this->getUsrIdTo(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aUserRelatedByUsrIdTo) {
                $result['UserRelatedByUsrIdTo'] = $this->aUserRelatedByUsrIdTo->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByUsrIdFrom) {
                $result['UserRelatedByUsrIdFrom'] = $this->aUserRelatedByUsrIdFrom->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = VirementPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setDate($value);
                break;
            case 2:
                $this->setAmount($value);
                break;
            case 3:
                $this->setUsrIdFrom($value);
                break;
            case 4:
                $this->setUsrIdTo($value);
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
        $keys = VirementPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setDate($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setAmount($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUsrIdFrom($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setUsrIdTo($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(VirementPeer::DATABASE_NAME);

        if ($this->isColumnModified(VirementPeer::VIR_ID)) $criteria->add(VirementPeer::VIR_ID, $this->vir_id);
        if ($this->isColumnModified(VirementPeer::VIR_DATE)) $criteria->add(VirementPeer::VIR_DATE, $this->vir_date);
        if ($this->isColumnModified(VirementPeer::VIR_AMOUNT)) $criteria->add(VirementPeer::VIR_AMOUNT, $this->vir_amount);
        if ($this->isColumnModified(VirementPeer::USR_ID_FROM)) $criteria->add(VirementPeer::USR_ID_FROM, $this->usr_id_from);
        if ($this->isColumnModified(VirementPeer::USR_ID_TO)) $criteria->add(VirementPeer::USR_ID_TO, $this->usr_id_to);

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
        $criteria = new Criteria(VirementPeer::DATABASE_NAME);
        $criteria->add(VirementPeer::VIR_ID, $this->vir_id);

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
     * Generic method to set the primary key (vir_id column).
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
     * @param object $copyObj An object of Virement (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDate($this->getDate());
        $copyObj->setAmount($this->getAmount());
        $copyObj->setUsrIdFrom($this->getUsrIdFrom());
        $copyObj->setUsrIdTo($this->getUsrIdTo());

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
     * @return Virement Clone of current object.
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
     * @return VirementPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new VirementPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return Virement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByUsrIdTo(User $v = null)
    {
        if ($v === null) {
            $this->setUsrIdTo(NULL);
        } else {
            $this->setUsrIdTo($v->getId());
        }

        $this->aUserRelatedByUsrIdTo = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addVirementRelatedByUsrIdTo($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUserRelatedByUsrIdTo(PropelPDO $con = null)
    {
        if ($this->aUserRelatedByUsrIdTo === null && ($this->usr_id_to !== null)) {
            $this->aUserRelatedByUsrIdTo = UserQuery::create()->findPk($this->usr_id_to, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByUsrIdTo->addVirementsRelatedByUsrIdTo($this);
             */
        }

        return $this->aUserRelatedByUsrIdTo;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return Virement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByUsrIdFrom(User $v = null)
    {
        if ($v === null) {
            $this->setUsrIdFrom(NULL);
        } else {
            $this->setUsrIdFrom($v->getId());
        }

        $this->aUserRelatedByUsrIdFrom = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addVirementRelatedByUsrIdFrom($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUserRelatedByUsrIdFrom(PropelPDO $con = null)
    {
        if ($this->aUserRelatedByUsrIdFrom === null && ($this->usr_id_from !== null)) {
            $this->aUserRelatedByUsrIdFrom = UserQuery::create()->findPk($this->usr_id_from, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByUsrIdFrom->addVirementsRelatedByUsrIdFrom($this);
             */
        }

        return $this->aUserRelatedByUsrIdFrom;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->vir_id = null;
        $this->vir_date = null;
        $this->vir_amount = null;
        $this->usr_id_from = null;
        $this->usr_id_to = null;
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

        $this->aUserRelatedByUsrIdTo = null;
        $this->aUserRelatedByUsrIdFrom = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VirementPeer::DEFAULT_STRING_FORMAT);
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
