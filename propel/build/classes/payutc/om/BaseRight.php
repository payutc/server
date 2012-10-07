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
use Payutc\Fundation;
use Payutc\FundationQuery;
use Payutc\JUsrRig;
use Payutc\JUsrRigQuery;
use Payutc\Period;
use Payutc\PeriodQuery;
use Payutc\Point;
use Payutc\PointQuery;
use Payutc\Right;
use Payutc\RightPeer;
use Payutc\RightQuery;
use Payutc\User;
use Payutc\UserQuery;

/**
 * Base class that represents a row from the 'ts_right_rig' table.
 *
 *
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseRight extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Payutc\\RightPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        RightPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the rig_id field.
     * @var        int
     */
    protected $rig_id;

    /**
     * The value for the rig_name field.
     * @var        string
     */
    protected $rig_name;

    /**
     * The value for the rig_description field.
     * @var        string
     */
    protected $rig_description;

    /**
     * The value for the rig_admin field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $rig_admin;

    /**
     * The value for the rig_removed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $rig_removed;

    /**
     * @var        PropelObjectCollection|JUsrRig[] Collection to store aggregation of JUsrRig objects.
     */
    protected $collJUsrRigs;
    protected $collJUsrRigsPartial;

    /**
     * @var        PropelObjectCollection|Period[] Collection to store aggregation of Period objects.
     */
    protected $collJurPeriods;

    /**
     * @var        PropelObjectCollection|User[] Collection to store aggregation of User objects.
     */
    protected $collUsers;

    /**
     * @var        PropelObjectCollection|Fundation[] Collection to store aggregation of Fundation objects.
     */
    protected $collFundations;

    /**
     * @var        PropelObjectCollection|Point[] Collection to store aggregation of Point objects.
     */
    protected $collPoints;

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
    protected $jurPeriodsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $fundationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $pointsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $jUsrRigsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->rig_admin = false;
        $this->rig_removed = false;
    }

    /**
     * Initializes internal state of BaseRight object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [rig_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->rig_id;
    }

    /**
     * Get the [rig_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->rig_name;
    }

    /**
     * Get the [rig_description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->rig_description;
    }

    /**
     * Get the [rig_admin] column value.
     *
     * @return boolean
     */
    public function getAdmin()
    {
        return $this->rig_admin;
    }

    /**
     * Get the [rig_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->rig_removed;
    }

    /**
     * Set the value of [rig_id] column.
     *
     * @param int $v new value
     * @return Right The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rig_id !== $v) {
            $this->rig_id = $v;
            $this->modifiedColumns[] = RightPeer::RIG_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [rig_name] column.
     *
     * @param string $v new value
     * @return Right The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rig_name !== $v) {
            $this->rig_name = $v;
            $this->modifiedColumns[] = RightPeer::RIG_NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [rig_description] column.
     *
     * @param string $v new value
     * @return Right The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rig_description !== $v) {
            $this->rig_description = $v;
            $this->modifiedColumns[] = RightPeer::RIG_DESCRIPTION;
        }


        return $this;
    } // setDescription()

    /**
     * Sets the value of the [rig_admin] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Right The current object (for fluent API support)
     */
    public function setAdmin($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->rig_admin !== $v) {
            $this->rig_admin = $v;
            $this->modifiedColumns[] = RightPeer::RIG_ADMIN;
        }


        return $this;
    } // setAdmin()

    /**
     * Sets the value of the [rig_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Right The current object (for fluent API support)
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

        if ($this->rig_removed !== $v) {
            $this->rig_removed = $v;
            $this->modifiedColumns[] = RightPeer::RIG_REMOVED;
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
            if ($this->rig_admin !== false) {
                return false;
            }

            if ($this->rig_removed !== false) {
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

            $this->rig_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->rig_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->rig_description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->rig_admin = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
            $this->rig_removed = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = RightPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Right object", $e);
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
            $con = Propel::getConnection(RightPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = RightPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collJUsrRigs = null;

            $this->collJurPeriods = null;
            $this->collUsers = null;
            $this->collFundations = null;
            $this->collPoints = null;
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
            $con = Propel::getConnection(RightPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = RightQuery::create()
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
            $con = Propel::getConnection(RightPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                RightPeer::addInstanceToPool($this);
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

            if ($this->jurPeriodsScheduledForDeletion !== null) {
                if (!$this->jurPeriodsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->jurPeriodsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    JUsrRigQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->jurPeriodsScheduledForDeletion = null;
                }

                foreach ($this->getJurPeriods() as $jurPeriod) {
                    if ($jurPeriod->isModified()) {
                        $jurPeriod->save($con);
                    }
                }
            }

            if ($this->usersScheduledForDeletion !== null) {
                if (!$this->usersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->usersScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    JUsrRigQuery::create()
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

            if ($this->fundationsScheduledForDeletion !== null) {
                if (!$this->fundationsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->fundationsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    JUsrRigQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->fundationsScheduledForDeletion = null;
                }

                foreach ($this->getFundations() as $fundation) {
                    if ($fundation->isModified()) {
                        $fundation->save($con);
                    }
                }
            }

            if ($this->pointsScheduledForDeletion !== null) {
                if (!$this->pointsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->pointsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    JUsrRigQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->pointsScheduledForDeletion = null;
                }

                foreach ($this->getPoints() as $point) {
                    if ($point->isModified()) {
                        $point->save($con);
                    }
                }
            }

            if ($this->jUsrRigsScheduledForDeletion !== null) {
                if (!$this->jUsrRigsScheduledForDeletion->isEmpty()) {
                    JUsrRigQuery::create()
                        ->filterByPrimaryKeys($this->jUsrRigsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jUsrRigsScheduledForDeletion = null;
                }
            }

            if ($this->collJUsrRigs !== null) {
                foreach ($this->collJUsrRigs as $referrerFK) {
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

        $this->modifiedColumns[] = RightPeer::RIG_ID;
        if (null !== $this->rig_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RightPeer::RIG_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RightPeer::RIG_ID)) {
            $modifiedColumns[':p' . $index++]  = '`RIG_ID`';
        }
        if ($this->isColumnModified(RightPeer::RIG_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`RIG_NAME`';
        }
        if ($this->isColumnModified(RightPeer::RIG_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`RIG_DESCRIPTION`';
        }
        if ($this->isColumnModified(RightPeer::RIG_ADMIN)) {
            $modifiedColumns[':p' . $index++]  = '`RIG_ADMIN`';
        }
        if ($this->isColumnModified(RightPeer::RIG_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`RIG_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `ts_right_rig` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`RIG_ID`':
                        $stmt->bindValue($identifier, $this->rig_id, PDO::PARAM_INT);
                        break;
                    case '`RIG_NAME`':
                        $stmt->bindValue($identifier, $this->rig_name, PDO::PARAM_STR);
                        break;
                    case '`RIG_DESCRIPTION`':
                        $stmt->bindValue($identifier, $this->rig_description, PDO::PARAM_STR);
                        break;
                    case '`RIG_ADMIN`':
                        $stmt->bindValue($identifier, (int) $this->rig_admin, PDO::PARAM_INT);
                        break;
                    case '`RIG_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->rig_removed, PDO::PARAM_INT);
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


            if (($retval = RightPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collJUsrRigs !== null) {
                    foreach ($this->collJUsrRigs as $referrerFK) {
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
        $pos = RightPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getDescription();
                break;
            case 3:
                return $this->getAdmin();
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
        if (isset($alreadyDumpedObjects['Right'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Right'][$this->getPrimaryKey()] = true;
        $keys = RightPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getAdmin(),
            $keys[4] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collJUsrRigs) {
                $result['JUsrRigs'] = $this->collJUsrRigs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = RightPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setDescription($value);
                break;
            case 3:
                $this->setAdmin($value);
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
        $keys = RightPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAdmin($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setRemoved($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(RightPeer::DATABASE_NAME);

        if ($this->isColumnModified(RightPeer::RIG_ID)) $criteria->add(RightPeer::RIG_ID, $this->rig_id);
        if ($this->isColumnModified(RightPeer::RIG_NAME)) $criteria->add(RightPeer::RIG_NAME, $this->rig_name);
        if ($this->isColumnModified(RightPeer::RIG_DESCRIPTION)) $criteria->add(RightPeer::RIG_DESCRIPTION, $this->rig_description);
        if ($this->isColumnModified(RightPeer::RIG_ADMIN)) $criteria->add(RightPeer::RIG_ADMIN, $this->rig_admin);
        if ($this->isColumnModified(RightPeer::RIG_REMOVED)) $criteria->add(RightPeer::RIG_REMOVED, $this->rig_removed);

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
        $criteria = new Criteria(RightPeer::DATABASE_NAME);
        $criteria->add(RightPeer::RIG_ID, $this->rig_id);

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
     * Generic method to set the primary key (rig_id column).
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
     * @param object $copyObj An object of Right (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setAdmin($this->getAdmin());
        $copyObj->setRemoved($this->getRemoved());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getJUsrRigs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJUsrRig($relObj->copy($deepCopy));
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
     * @return Right Clone of current object.
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
     * @return RightPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new RightPeer();
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
        if ('JUsrRig' == $relationName) {
            $this->initJUsrRigs();
        }
    }

    /**
     * Clears out the collJUsrRigs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJUsrRigs()
     */
    public function clearJUsrRigs()
    {
        $this->collJUsrRigs = null; // important to set this to null since that means it is uninitialized
        $this->collJUsrRigsPartial = null;
    }

    /**
     * reset is the collJUsrRigs collection loaded partially
     *
     * @return void
     */
    public function resetPartialJUsrRigs($v = true)
    {
        $this->collJUsrRigsPartial = $v;
    }

    /**
     * Initializes the collJUsrRigs collection.
     *
     * By default this just sets the collJUsrRigs collection to an empty array (like clearcollJUsrRigs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJUsrRigs($overrideExisting = true)
    {
        if (null !== $this->collJUsrRigs && !$overrideExisting) {
            return;
        }
        $this->collJUsrRigs = new PropelObjectCollection();
        $this->collJUsrRigs->setModel('JUsrRig');
    }

    /**
     * Gets an array of JUsrRig objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Right is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|JUsrRig[] List of JUsrRig objects
     * @throws PropelException
     */
    public function getJUsrRigs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collJUsrRigsPartial && !$this->isNew();
        if (null === $this->collJUsrRigs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJUsrRigs) {
                // return empty collection
                $this->initJUsrRigs();
            } else {
                $collJUsrRigs = JUsrRigQuery::create(null, $criteria)
                    ->filterByRight($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collJUsrRigsPartial && count($collJUsrRigs)) {
                      $this->initJUsrRigs(false);

                      foreach($collJUsrRigs as $obj) {
                        if (false == $this->collJUsrRigs->contains($obj)) {
                          $this->collJUsrRigs->append($obj);
                        }
                      }

                      $this->collJUsrRigsPartial = true;
                    }

                    return $collJUsrRigs;
                }

                if($partial && $this->collJUsrRigs) {
                    foreach($this->collJUsrRigs as $obj) {
                        if($obj->isNew()) {
                            $collJUsrRigs[] = $obj;
                        }
                    }
                }

                $this->collJUsrRigs = $collJUsrRigs;
                $this->collJUsrRigsPartial = false;
            }
        }

        return $this->collJUsrRigs;
    }

    /**
     * Sets a collection of JUsrRig objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $jUsrRigs A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setJUsrRigs(PropelCollection $jUsrRigs, PropelPDO $con = null)
    {
        $this->jUsrRigsScheduledForDeletion = $this->getJUsrRigs(new Criteria(), $con)->diff($jUsrRigs);

        foreach ($this->jUsrRigsScheduledForDeletion as $jUsrRigRemoved) {
            $jUsrRigRemoved->setRight(null);
        }

        $this->collJUsrRigs = null;
        foreach ($jUsrRigs as $jUsrRig) {
            $this->addJUsrRig($jUsrRig);
        }

        $this->collJUsrRigs = $jUsrRigs;
        $this->collJUsrRigsPartial = false;
    }

    /**
     * Returns the number of related JUsrRig objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related JUsrRig objects.
     * @throws PropelException
     */
    public function countJUsrRigs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collJUsrRigsPartial && !$this->isNew();
        if (null === $this->collJUsrRigs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJUsrRigs) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getJUsrRigs());
                }
                $query = JUsrRigQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByRight($this)
                    ->count($con);
            }
        } else {
            return count($this->collJUsrRigs);
        }
    }

    /**
     * Method called to associate a JUsrRig object to this object
     * through the JUsrRig foreign key attribute.
     *
     * @param    JUsrRig $l JUsrRig
     * @return Right The current object (for fluent API support)
     */
    public function addJUsrRig(JUsrRig $l)
    {
        if ($this->collJUsrRigs === null) {
            $this->initJUsrRigs();
            $this->collJUsrRigsPartial = true;
        }
        if (!in_array($l, $this->collJUsrRigs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddJUsrRig($l);
        }

        return $this;
    }

    /**
     * @param	JUsrRig $jUsrRig The jUsrRig object to add.
     */
    protected function doAddJUsrRig($jUsrRig)
    {
        $this->collJUsrRigs[]= $jUsrRig;
        $jUsrRig->setRight($this);
    }

    /**
     * @param	JUsrRig $jUsrRig The jUsrRig object to remove.
     */
    public function removeJUsrRig($jUsrRig)
    {
        if ($this->getJUsrRigs()->contains($jUsrRig)) {
            $this->collJUsrRigs->remove($this->collJUsrRigs->search($jUsrRig));
            if (null === $this->jUsrRigsScheduledForDeletion) {
                $this->jUsrRigsScheduledForDeletion = clone $this->collJUsrRigs;
                $this->jUsrRigsScheduledForDeletion->clear();
            }
            $this->jUsrRigsScheduledForDeletion[]= $jUsrRig;
            $jUsrRig->setRight(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Right is new, it will return
     * an empty collection; or if this Right has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Right.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|JUsrRig[] List of JUsrRig objects
     */
    public function getJUsrRigsJoinJurPeriod($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = JUsrRigQuery::create(null, $criteria);
        $query->joinWith('JurPeriod', $join_behavior);

        return $this->getJUsrRigs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Right is new, it will return
     * an empty collection; or if this Right has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Right.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|JUsrRig[] List of JUsrRig objects
     */
    public function getJUsrRigsJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = JUsrRigQuery::create(null, $criteria);
        $query->joinWith('User', $join_behavior);

        return $this->getJUsrRigs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Right is new, it will return
     * an empty collection; or if this Right has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Right.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|JUsrRig[] List of JUsrRig objects
     */
    public function getJUsrRigsJoinFundation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = JUsrRigQuery::create(null, $criteria);
        $query->joinWith('Fundation', $join_behavior);

        return $this->getJUsrRigs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Right is new, it will return
     * an empty collection; or if this Right has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Right.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|JUsrRig[] List of JUsrRig objects
     */
    public function getJUsrRigsJoinPoint($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = JUsrRigQuery::create(null, $criteria);
        $query->joinWith('Point', $join_behavior);

        return $this->getJUsrRigs($query, $con);
    }

    /**
     * Clears out the collJurPeriods collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJurPeriods()
     */
    public function clearJurPeriods()
    {
        $this->collJurPeriods = null; // important to set this to null since that means it is uninitialized
        $this->collJurPeriodsPartial = null;
    }

    /**
     * Initializes the collJurPeriods collection.
     *
     * By default this just sets the collJurPeriods collection to an empty collection (like clearJurPeriods());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initJurPeriods()
    {
        $this->collJurPeriods = new PropelObjectCollection();
        $this->collJurPeriods->setModel('Period');
    }

    /**
     * Gets a collection of Period objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Right is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Period[] List of Period objects
     */
    public function getJurPeriods($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collJurPeriods || null !== $criteria) {
            if ($this->isNew() && null === $this->collJurPeriods) {
                // return empty collection
                $this->initJurPeriods();
            } else {
                $collJurPeriods = PeriodQuery::create(null, $criteria)
                    ->filterByRight($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collJurPeriods;
                }
                $this->collJurPeriods = $collJurPeriods;
            }
        }

        return $this->collJurPeriods;
    }

    /**
     * Sets a collection of Period objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $jurPeriods A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setJurPeriods(PropelCollection $jurPeriods, PropelPDO $con = null)
    {
        $this->clearJurPeriods();
        $currentJurPeriods = $this->getJurPeriods();

        $this->jurPeriodsScheduledForDeletion = $currentJurPeriods->diff($jurPeriods);

        foreach ($jurPeriods as $jurPeriod) {
            if (!$currentJurPeriods->contains($jurPeriod)) {
                $this->doAddJurPeriod($jurPeriod);
            }
        }

        $this->collJurPeriods = $jurPeriods;
    }

    /**
     * Gets the number of Period objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Period objects
     */
    public function countJurPeriods($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collJurPeriods || null !== $criteria) {
            if ($this->isNew() && null === $this->collJurPeriods) {
                return 0;
            } else {
                $query = PeriodQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByRight($this)
                    ->count($con);
            }
        } else {
            return count($this->collJurPeriods);
        }
    }

    /**
     * Associate a Period object to this object
     * through the tj_usr_rig_jur cross reference table.
     *
     * @param  Period $period The JUsrRig object to relate
     * @return void
     */
    public function addJurPeriod(Period $period)
    {
        if ($this->collJurPeriods === null) {
            $this->initJurPeriods();
        }
        if (!$this->collJurPeriods->contains($period)) { // only add it if the **same** object is not already associated
            $this->doAddJurPeriod($period);

            $this->collJurPeriods[]= $period;
        }
    }

    /**
     * @param	JurPeriod $jurPeriod The jurPeriod object to add.
     */
    protected function doAddJurPeriod($jurPeriod)
    {
        $jUsrRig = new JUsrRig();
        $jUsrRig->setJurPeriod($jurPeriod);
        $this->addJUsrRig($jUsrRig);
    }

    /**
     * Remove a Period object to this object
     * through the tj_usr_rig_jur cross reference table.
     *
     * @param Period $period The JUsrRig object to relate
     * @return void
     */
    public function removeJurPeriod(Period $period)
    {
        if ($this->getJurPeriods()->contains($period)) {
            $this->collJurPeriods->remove($this->collJurPeriods->search($period));
            if (null === $this->jurPeriodsScheduledForDeletion) {
                $this->jurPeriodsScheduledForDeletion = clone $this->collJurPeriods;
                $this->jurPeriodsScheduledForDeletion->clear();
            }
            $this->jurPeriodsScheduledForDeletion[]= $period;
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
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Right is new, it will return
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
                    ->filterByRight($this)
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
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
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
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
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
                    ->filterByRight($this)
                    ->count($con);
            }
        } else {
            return count($this->collUsers);
        }
    }

    /**
     * Associate a User object to this object
     * through the tj_usr_rig_jur cross reference table.
     *
     * @param  User $user The JUsrRig object to relate
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
        $jUsrRig = new JUsrRig();
        $jUsrRig->setUser($user);
        $this->addJUsrRig($jUsrRig);
    }

    /**
     * Remove a User object to this object
     * through the tj_usr_rig_jur cross reference table.
     *
     * @param User $user The JUsrRig object to relate
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
     * Clears out the collFundations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFundations()
     */
    public function clearFundations()
    {
        $this->collFundations = null; // important to set this to null since that means it is uninitialized
        $this->collFundationsPartial = null;
    }

    /**
     * Initializes the collFundations collection.
     *
     * By default this just sets the collFundations collection to an empty collection (like clearFundations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initFundations()
    {
        $this->collFundations = new PropelObjectCollection();
        $this->collFundations->setModel('Fundation');
    }

    /**
     * Gets a collection of Fundation objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Right is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Fundation[] List of Fundation objects
     */
    public function getFundations($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collFundations || null !== $criteria) {
            if ($this->isNew() && null === $this->collFundations) {
                // return empty collection
                $this->initFundations();
            } else {
                $collFundations = FundationQuery::create(null, $criteria)
                    ->filterByRight($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collFundations;
                }
                $this->collFundations = $collFundations;
            }
        }

        return $this->collFundations;
    }

    /**
     * Sets a collection of Fundation objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $fundations A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setFundations(PropelCollection $fundations, PropelPDO $con = null)
    {
        $this->clearFundations();
        $currentFundations = $this->getFundations();

        $this->fundationsScheduledForDeletion = $currentFundations->diff($fundations);

        foreach ($fundations as $fundation) {
            if (!$currentFundations->contains($fundation)) {
                $this->doAddFundation($fundation);
            }
        }

        $this->collFundations = $fundations;
    }

    /**
     * Gets the number of Fundation objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Fundation objects
     */
    public function countFundations($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collFundations || null !== $criteria) {
            if ($this->isNew() && null === $this->collFundations) {
                return 0;
            } else {
                $query = FundationQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByRight($this)
                    ->count($con);
            }
        } else {
            return count($this->collFundations);
        }
    }

    /**
     * Associate a Fundation object to this object
     * through the tj_usr_rig_jur cross reference table.
     *
     * @param  Fundation $fundation The JUsrRig object to relate
     * @return void
     */
    public function addFundation(Fundation $fundation)
    {
        if ($this->collFundations === null) {
            $this->initFundations();
        }
        if (!$this->collFundations->contains($fundation)) { // only add it if the **same** object is not already associated
            $this->doAddFundation($fundation);

            $this->collFundations[]= $fundation;
        }
    }

    /**
     * @param	Fundation $fundation The fundation object to add.
     */
    protected function doAddFundation($fundation)
    {
        $jUsrRig = new JUsrRig();
        $jUsrRig->setFundation($fundation);
        $this->addJUsrRig($jUsrRig);
    }

    /**
     * Remove a Fundation object to this object
     * through the tj_usr_rig_jur cross reference table.
     *
     * @param Fundation $fundation The JUsrRig object to relate
     * @return void
     */
    public function removeFundation(Fundation $fundation)
    {
        if ($this->getFundations()->contains($fundation)) {
            $this->collFundations->remove($this->collFundations->search($fundation));
            if (null === $this->fundationsScheduledForDeletion) {
                $this->fundationsScheduledForDeletion = clone $this->collFundations;
                $this->fundationsScheduledForDeletion->clear();
            }
            $this->fundationsScheduledForDeletion[]= $fundation;
        }
    }

    /**
     * Clears out the collPoints collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPoints()
     */
    public function clearPoints()
    {
        $this->collPoints = null; // important to set this to null since that means it is uninitialized
        $this->collPointsPartial = null;
    }

    /**
     * Initializes the collPoints collection.
     *
     * By default this just sets the collPoints collection to an empty collection (like clearPoints());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPoints()
    {
        $this->collPoints = new PropelObjectCollection();
        $this->collPoints->setModel('Point');
    }

    /**
     * Gets a collection of Point objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Right is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Point[] List of Point objects
     */
    public function getPoints($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPoints || null !== $criteria) {
            if ($this->isNew() && null === $this->collPoints) {
                // return empty collection
                $this->initPoints();
            } else {
                $collPoints = PointQuery::create(null, $criteria)
                    ->filterByRight($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPoints;
                }
                $this->collPoints = $collPoints;
            }
        }

        return $this->collPoints;
    }

    /**
     * Sets a collection of Point objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $points A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setPoints(PropelCollection $points, PropelPDO $con = null)
    {
        $this->clearPoints();
        $currentPoints = $this->getPoints();

        $this->pointsScheduledForDeletion = $currentPoints->diff($points);

        foreach ($points as $point) {
            if (!$currentPoints->contains($point)) {
                $this->doAddPoint($point);
            }
        }

        $this->collPoints = $points;
    }

    /**
     * Gets the number of Point objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Point objects
     */
    public function countPoints($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPoints || null !== $criteria) {
            if ($this->isNew() && null === $this->collPoints) {
                return 0;
            } else {
                $query = PointQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByRight($this)
                    ->count($con);
            }
        } else {
            return count($this->collPoints);
        }
    }

    /**
     * Associate a Point object to this object
     * through the tj_usr_rig_jur cross reference table.
     *
     * @param  Point $point The JUsrRig object to relate
     * @return void
     */
    public function addPoint(Point $point)
    {
        if ($this->collPoints === null) {
            $this->initPoints();
        }
        if (!$this->collPoints->contains($point)) { // only add it if the **same** object is not already associated
            $this->doAddPoint($point);

            $this->collPoints[]= $point;
        }
    }

    /**
     * @param	Point $point The point object to add.
     */
    protected function doAddPoint($point)
    {
        $jUsrRig = new JUsrRig();
        $jUsrRig->setPoint($point);
        $this->addJUsrRig($jUsrRig);
    }

    /**
     * Remove a Point object to this object
     * through the tj_usr_rig_jur cross reference table.
     *
     * @param Point $point The JUsrRig object to relate
     * @return void
     */
    public function removePoint(Point $point)
    {
        if ($this->getPoints()->contains($point)) {
            $this->collPoints->remove($this->collPoints->search($point));
            if (null === $this->pointsScheduledForDeletion) {
                $this->pointsScheduledForDeletion = clone $this->collPoints;
                $this->pointsScheduledForDeletion->clear();
            }
            $this->pointsScheduledForDeletion[]= $point;
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->rig_id = null;
        $this->rig_name = null;
        $this->rig_description = null;
        $this->rig_admin = null;
        $this->rig_removed = null;
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
            if ($this->collJUsrRigs) {
                foreach ($this->collJUsrRigs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJurPeriods) {
                foreach ($this->collJurPeriods as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsers) {
                foreach ($this->collUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFundations) {
                foreach ($this->collFundations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPoints) {
                foreach ($this->collPoints as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collJUsrRigs instanceof PropelCollection) {
            $this->collJUsrRigs->clearIterator();
        }
        $this->collJUsrRigs = null;
        if ($this->collJurPeriods instanceof PropelCollection) {
            $this->collJurPeriods->clearIterator();
        }
        $this->collJurPeriods = null;
        if ($this->collUsers instanceof PropelCollection) {
            $this->collUsers->clearIterator();
        }
        $this->collUsers = null;
        if ($this->collFundations instanceof PropelCollection) {
            $this->collFundations->clearIterator();
        }
        $this->collFundations = null;
        if ($this->collPoints instanceof PropelCollection) {
            $this->collPoints->clearIterator();
        }
        $this->collPoints = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(RightPeer::DEFAULT_STRING_FORMAT);
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
