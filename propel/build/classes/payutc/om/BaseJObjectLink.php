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
use Payutc\JObjectLink;
use Payutc\JObjectLinkPeer;
use Payutc\JObjectLinkQuery;

/**
 * Base class that represents a row from the 'tj_object_link_oli' table.
 *
 *
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseJObjectLink extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Payutc\\JObjectLinkPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        JObjectLinkPeer
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
     * @var        Item
     */
    protected $aItemRelatedByIdChild;

    /**
     * @var        Item
     */
    protected $aItemRelatedByIdParent;

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
     * Initializes internal state of BaseJObjectLink object.
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
    public function getIdParent()
    {
        return $this->obj_id_parent;
    }

    /**
     * Get the [obj_id_child] column value.
     *
     * @return int
     */
    public function getIdChild()
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
     * @return JObjectLink The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oli_id !== $v) {
            $this->oli_id = $v;
            $this->modifiedColumns[] = JObjectLinkPeer::OLI_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [obj_id_parent] column.
     *
     * @param int $v new value
     * @return JObjectLink The current object (for fluent API support)
     */
    public function setIdParent($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_id_parent !== $v) {
            $this->obj_id_parent = $v;
            $this->modifiedColumns[] = JObjectLinkPeer::OBJ_ID_PARENT;
        }

        if ($this->aItemRelatedByIdParent !== null && $this->aItemRelatedByIdParent->getId() !== $v) {
            $this->aItemRelatedByIdParent = null;
        }


        return $this;
    } // setIdParent()

    /**
     * Set the value of [obj_id_child] column.
     *
     * @param int $v new value
     * @return JObjectLink The current object (for fluent API support)
     */
    public function setIdChild($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_id_child !== $v) {
            $this->obj_id_child = $v;
            $this->modifiedColumns[] = JObjectLinkPeer::OBJ_ID_CHILD;
        }

        if ($this->aItemRelatedByIdChild !== null && $this->aItemRelatedByIdChild->getId() !== $v) {
            $this->aItemRelatedByIdChild = null;
        }


        return $this;
    } // setIdChild()

    /**
     * Set the value of [oli_step] column.
     *
     * @param int $v new value
     * @return JObjectLink The current object (for fluent API support)
     */
    public function setStep($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oli_step !== $v) {
            $this->oli_step = $v;
            $this->modifiedColumns[] = JObjectLinkPeer::OLI_STEP;
        }


        return $this;
    } // setStep()

    /**
     * Set the value of [oli_removed] column.
     *
     * @param int $v new value
     * @return JObjectLink The current object (for fluent API support)
     */
    public function setRemoved($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oli_removed !== $v) {
            $this->oli_removed = $v;
            $this->modifiedColumns[] = JObjectLinkPeer::OLI_REMOVED;
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

            return $startcol + 5; // 5 = JObjectLinkPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating JObjectLink object", $e);
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

        if ($this->aItemRelatedByIdParent !== null && $this->obj_id_parent !== $this->aItemRelatedByIdParent->getId()) {
            $this->aItemRelatedByIdParent = null;
        }
        if ($this->aItemRelatedByIdChild !== null && $this->obj_id_child !== $this->aItemRelatedByIdChild->getId()) {
            $this->aItemRelatedByIdChild = null;
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
            $con = Propel::getConnection(JObjectLinkPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = JObjectLinkPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aItemRelatedByIdChild = null;
            $this->aItemRelatedByIdParent = null;
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
            $con = Propel::getConnection(JObjectLinkPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = JObjectLinkQuery::create()
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
            $con = Propel::getConnection(JObjectLinkPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                JObjectLinkPeer::addInstanceToPool($this);
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

            if ($this->aItemRelatedByIdChild !== null) {
                if ($this->aItemRelatedByIdChild->isModified() || $this->aItemRelatedByIdChild->isNew()) {
                    $affectedRows += $this->aItemRelatedByIdChild->save($con);
                }
                $this->setItemRelatedByIdChild($this->aItemRelatedByIdChild);
            }

            if ($this->aItemRelatedByIdParent !== null) {
                if ($this->aItemRelatedByIdParent->isModified() || $this->aItemRelatedByIdParent->isNew()) {
                    $affectedRows += $this->aItemRelatedByIdParent->save($con);
                }
                $this->setItemRelatedByIdParent($this->aItemRelatedByIdParent);
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
        if ($this->isColumnModified(JObjectLinkPeer::OLI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`OLI_ID`';
        }
        if ($this->isColumnModified(JObjectLinkPeer::OBJ_ID_PARENT)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_ID_PARENT`';
        }
        if ($this->isColumnModified(JObjectLinkPeer::OBJ_ID_CHILD)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_ID_CHILD`';
        }
        if ($this->isColumnModified(JObjectLinkPeer::OLI_STEP)) {
            $modifiedColumns[':p' . $index++]  = '`OLI_STEP`';
        }
        if ($this->isColumnModified(JObjectLinkPeer::OLI_REMOVED)) {
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
        $this->setIdParent($pk);

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

            if ($this->aItemRelatedByIdChild !== null) {
                if (!$this->aItemRelatedByIdChild->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aItemRelatedByIdChild->getValidationFailures());
                }
            }

            if ($this->aItemRelatedByIdParent !== null) {
                if (!$this->aItemRelatedByIdParent->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aItemRelatedByIdParent->getValidationFailures());
                }
            }


            if (($retval = JObjectLinkPeer::doValidate($this, $columns)) !== true) {
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
        $pos = JObjectLinkPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getIdParent();
                break;
            case 2:
                return $this->getIdChild();
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
        if (isset($alreadyDumpedObjects['JObjectLink'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['JObjectLink'][serialize($this->getPrimaryKey())] = true;
        $keys = JObjectLinkPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdParent(),
            $keys[2] => $this->getIdChild(),
            $keys[3] => $this->getStep(),
            $keys[4] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aItemRelatedByIdChild) {
                $result['ItemRelatedByIdChild'] = $this->aItemRelatedByIdChild->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aItemRelatedByIdParent) {
                $result['ItemRelatedByIdParent'] = $this->aItemRelatedByIdParent->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = JObjectLinkPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIdParent($value);
                break;
            case 2:
                $this->setIdChild($value);
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
        $keys = JObjectLinkPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setIdParent($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setIdChild($arr[$keys[2]]);
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
        $criteria = new Criteria(JObjectLinkPeer::DATABASE_NAME);

        if ($this->isColumnModified(JObjectLinkPeer::OLI_ID)) $criteria->add(JObjectLinkPeer::OLI_ID, $this->oli_id);
        if ($this->isColumnModified(JObjectLinkPeer::OBJ_ID_PARENT)) $criteria->add(JObjectLinkPeer::OBJ_ID_PARENT, $this->obj_id_parent);
        if ($this->isColumnModified(JObjectLinkPeer::OBJ_ID_CHILD)) $criteria->add(JObjectLinkPeer::OBJ_ID_CHILD, $this->obj_id_child);
        if ($this->isColumnModified(JObjectLinkPeer::OLI_STEP)) $criteria->add(JObjectLinkPeer::OLI_STEP, $this->oli_step);
        if ($this->isColumnModified(JObjectLinkPeer::OLI_REMOVED)) $criteria->add(JObjectLinkPeer::OLI_REMOVED, $this->oli_removed);

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
        $criteria = new Criteria(JObjectLinkPeer::DATABASE_NAME);
        $criteria->add(JObjectLinkPeer::OBJ_ID_PARENT, $this->obj_id_parent);
        $criteria->add(JObjectLinkPeer::OBJ_ID_CHILD, $this->obj_id_child);

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
        $pks[0] = $this->getIdParent();
        $pks[1] = $this->getIdChild();

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
        $this->setIdParent($keys[0]);
        $this->setIdChild($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return (null === $this->getIdParent()) && (null === $this->getIdChild());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of JObjectLink (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdParent($this->getIdParent());
        $copyObj->setIdChild($this->getIdChild());
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
     * @return JObjectLink Clone of current object.
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
     * @return JObjectLinkPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new JObjectLinkPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Item object.
     *
     * @param             Item $v
     * @return JObjectLink The current object (for fluent API support)
     * @throws PropelException
     */
    public function setItemRelatedByIdChild(Item $v = null)
    {
        if ($v === null) {
            $this->setIdChild(NULL);
        } else {
            $this->setIdChild($v->getId());
        }

        $this->aItemRelatedByIdChild = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Item object, it will not be re-added.
        if ($v !== null) {
            $v->addJObjectLinkRelatedByIdChild($this);
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
    public function getItemRelatedByIdChild(PropelPDO $con = null)
    {
        if ($this->aItemRelatedByIdChild === null && ($this->obj_id_child !== null)) {
            $this->aItemRelatedByIdChild = ItemQuery::create()->findPk($this->obj_id_child, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aItemRelatedByIdChild->addJObjectLinksRelatedByIdChild($this);
             */
        }

        return $this->aItemRelatedByIdChild;
    }

    /**
     * Declares an association between this object and a Item object.
     *
     * @param             Item $v
     * @return JObjectLink The current object (for fluent API support)
     * @throws PropelException
     */
    public function setItemRelatedByIdParent(Item $v = null)
    {
        if ($v === null) {
            $this->setIdParent(NULL);
        } else {
            $this->setIdParent($v->getId());
        }

        $this->aItemRelatedByIdParent = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Item object, it will not be re-added.
        if ($v !== null) {
            $v->addJObjectLinkRelatedByIdParent($this);
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
    public function getItemRelatedByIdParent(PropelPDO $con = null)
    {
        if ($this->aItemRelatedByIdParent === null && ($this->obj_id_parent !== null)) {
            $this->aItemRelatedByIdParent = ItemQuery::create()->findPk($this->obj_id_parent, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aItemRelatedByIdParent->addJObjectLinksRelatedByIdParent($this);
             */
        }

        return $this->aItemRelatedByIdParent;
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

        $this->aItemRelatedByIdChild = null;
        $this->aItemRelatedByIdParent = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(JObjectLinkPeer::DEFAULT_STRING_FORMAT);
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
