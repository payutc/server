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
use Payutc\FundationPeer;
use Payutc\FundationQuery;
use Payutc\Group;
use Payutc\GroupQuery;
use Payutc\Item;
use Payutc\ItemQuery;
use Payutc\JUsrRig;
use Payutc\JUsrRigQuery;
use Payutc\Period;
use Payutc\PeriodQuery;
use Payutc\Plage;
use Payutc\PlageQuery;
use Payutc\Point;
use Payutc\PointQuery;
use Payutc\Purchase;
use Payutc\PurchaseQuery;
use Payutc\Right;
use Payutc\RightQuery;
use Payutc\User;
use Payutc\UserQuery;

/**
 * Base class that represents a row from the 't_fundation_fun' table.
 *
 *
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseFundation extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Payutc\\FundationPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        FundationPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the fun_id field.
     * @var        int
     */
    protected $fun_id;

    /**
     * The value for the fun_name field.
     * @var        string
     */
    protected $fun_name;

    /**
     * The value for the fun_removed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $fun_removed;

    /**
     * @var        PropelObjectCollection|Group[] Collection to store aggregation of Group objects.
     */
    protected $collGroups;
    protected $collGroupsPartial;

    /**
     * @var        PropelObjectCollection|Item[] Collection to store aggregation of Item objects.
     */
    protected $collItems;
    protected $collItemsPartial;

    /**
     * @var        PropelObjectCollection|Period[] Collection to store aggregation of Period objects.
     */
    protected $collPeriods;
    protected $collPeriodsPartial;

    /**
     * @var        PropelObjectCollection|Plage[] Collection to store aggregation of Plage objects.
     */
    protected $collPlages;
    protected $collPlagesPartial;

    /**
     * @var        PropelObjectCollection|Purchase[] Collection to store aggregation of Purchase objects.
     */
    protected $collPurchases;
    protected $collPurchasesPartial;

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
     * @var        PropelObjectCollection|Right[] Collection to store aggregation of Right objects.
     */
    protected $collRights;

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
    protected $rightsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $pointsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $groupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $itemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $periodsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $plagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $purchasesScheduledForDeletion = null;

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
        $this->fun_removed = false;
    }

    /**
     * Initializes internal state of BaseFundation object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [fun_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->fun_id;
    }

    /**
     * Get the [fun_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->fun_name;
    }

    /**
     * Get the [fun_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->fun_removed;
    }

    /**
     * Set the value of [fun_id] column.
     *
     * @param int $v new value
     * @return Fundation The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fun_id !== $v) {
            $this->fun_id = $v;
            $this->modifiedColumns[] = FundationPeer::FUN_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [fun_name] column.
     *
     * @param string $v new value
     * @return Fundation The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fun_name !== $v) {
            $this->fun_name = $v;
            $this->modifiedColumns[] = FundationPeer::FUN_NAME;
        }


        return $this;
    } // setName()

    /**
     * Sets the value of the [fun_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Fundation The current object (for fluent API support)
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

        if ($this->fun_removed !== $v) {
            $this->fun_removed = $v;
            $this->modifiedColumns[] = FundationPeer::FUN_REMOVED;
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
            if ($this->fun_removed !== false) {
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

            $this->fun_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->fun_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->fun_removed = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = FundationPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Fundation object", $e);
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
            $con = Propel::getConnection(FundationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = FundationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collGroups = null;

            $this->collItems = null;

            $this->collPeriods = null;

            $this->collPlages = null;

            $this->collPurchases = null;

            $this->collJUsrRigs = null;

            $this->collJurPeriods = null;
            $this->collUsers = null;
            $this->collRights = null;
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
            $con = Propel::getConnection(FundationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = FundationQuery::create()
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
            $con = Propel::getConnection(FundationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                FundationPeer::addInstanceToPool($this);
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

            if ($this->rightsScheduledForDeletion !== null) {
                if (!$this->rightsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->rightsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    JUsrRigQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->rightsScheduledForDeletion = null;
                }

                foreach ($this->getRights() as $right) {
                    if ($right->isModified()) {
                        $right->save($con);
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

            if ($this->groupsScheduledForDeletion !== null) {
                if (!$this->groupsScheduledForDeletion->isEmpty()) {
                    GroupQuery::create()
                        ->filterByPrimaryKeys($this->groupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->groupsScheduledForDeletion = null;
                }
            }

            if ($this->collGroups !== null) {
                foreach ($this->collGroups as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->itemsScheduledForDeletion !== null) {
                if (!$this->itemsScheduledForDeletion->isEmpty()) {
                    ItemQuery::create()
                        ->filterByPrimaryKeys($this->itemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->itemsScheduledForDeletion = null;
                }
            }

            if ($this->collItems !== null) {
                foreach ($this->collItems as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->periodsScheduledForDeletion !== null) {
                if (!$this->periodsScheduledForDeletion->isEmpty()) {
                    PeriodQuery::create()
                        ->filterByPrimaryKeys($this->periodsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->periodsScheduledForDeletion = null;
                }
            }

            if ($this->collPeriods !== null) {
                foreach ($this->collPeriods as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->plagesScheduledForDeletion !== null) {
                if (!$this->plagesScheduledForDeletion->isEmpty()) {
                    PlageQuery::create()
                        ->filterByPrimaryKeys($this->plagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->plagesScheduledForDeletion = null;
                }
            }

            if ($this->collPlages !== null) {
                foreach ($this->collPlages as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->purchasesScheduledForDeletion !== null) {
                if (!$this->purchasesScheduledForDeletion->isEmpty()) {
                    PurchaseQuery::create()
                        ->filterByPrimaryKeys($this->purchasesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->purchasesScheduledForDeletion = null;
                }
            }

            if ($this->collPurchases !== null) {
                foreach ($this->collPurchases as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->jUsrRigsScheduledForDeletion !== null) {
                if (!$this->jUsrRigsScheduledForDeletion->isEmpty()) {
                    foreach ($this->jUsrRigsScheduledForDeletion as $jUsrRig) {
                        // need to save related object because we set the relation to null
                        $jUsrRig->save($con);
                    }
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

        $this->modifiedColumns[] = FundationPeer::FUN_ID;
        if (null !== $this->fun_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FundationPeer::FUN_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FundationPeer::FUN_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_ID`';
        }
        if ($this->isColumnModified(FundationPeer::FUN_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_NAME`';
        }
        if ($this->isColumnModified(FundationPeer::FUN_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `t_fundation_fun` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`FUN_ID`':
                        $stmt->bindValue($identifier, $this->fun_id, PDO::PARAM_INT);
                        break;
                    case '`FUN_NAME`':
                        $stmt->bindValue($identifier, $this->fun_name, PDO::PARAM_STR);
                        break;
                    case '`FUN_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->fun_removed, PDO::PARAM_INT);
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


            if (($retval = FundationPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collGroups !== null) {
                    foreach ($this->collGroups as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collItems !== null) {
                    foreach ($this->collItems as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPeriods !== null) {
                    foreach ($this->collPeriods as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPlages !== null) {
                    foreach ($this->collPlages as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPurchases !== null) {
                    foreach ($this->collPurchases as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
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
        $pos = FundationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['Fundation'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Fundation'][$this->getPrimaryKey()] = true;
        $keys = FundationPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collGroups) {
                $result['Groups'] = $this->collGroups->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collItems) {
                $result['Items'] = $this->collItems->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPeriods) {
                $result['Periods'] = $this->collPeriods->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPlages) {
                $result['Plages'] = $this->collPlages->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPurchases) {
                $result['Purchases'] = $this->collPurchases->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
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
        $pos = FundationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
        $keys = FundationPeer::getFieldNames($keyType);

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
        $criteria = new Criteria(FundationPeer::DATABASE_NAME);

        if ($this->isColumnModified(FundationPeer::FUN_ID)) $criteria->add(FundationPeer::FUN_ID, $this->fun_id);
        if ($this->isColumnModified(FundationPeer::FUN_NAME)) $criteria->add(FundationPeer::FUN_NAME, $this->fun_name);
        if ($this->isColumnModified(FundationPeer::FUN_REMOVED)) $criteria->add(FundationPeer::FUN_REMOVED, $this->fun_removed);

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
        $criteria = new Criteria(FundationPeer::DATABASE_NAME);
        $criteria->add(FundationPeer::FUN_ID, $this->fun_id);

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
     * Generic method to set the primary key (fun_id column).
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
     * @param object $copyObj An object of Fundation (or compatible) type.
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

            foreach ($this->getGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPeriods() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPeriod($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPlages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPlage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPurchases() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPurchase($relObj->copy($deepCopy));
                }
            }

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
     * @return Fundation Clone of current object.
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
     * @return FundationPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new FundationPeer();
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
        if ('Group' == $relationName) {
            $this->initGroups();
        }
        if ('Item' == $relationName) {
            $this->initItems();
        }
        if ('Period' == $relationName) {
            $this->initPeriods();
        }
        if ('Plage' == $relationName) {
            $this->initPlages();
        }
        if ('Purchase' == $relationName) {
            $this->initPurchases();
        }
        if ('JUsrRig' == $relationName) {
            $this->initJUsrRigs();
        }
    }

    /**
     * Clears out the collGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGroups()
     */
    public function clearGroups()
    {
        $this->collGroups = null; // important to set this to null since that means it is uninitialized
        $this->collGroupsPartial = null;
    }

    /**
     * reset is the collGroups collection loaded partially
     *
     * @return void
     */
    public function resetPartialGroups($v = true)
    {
        $this->collGroupsPartial = $v;
    }

    /**
     * Initializes the collGroups collection.
     *
     * By default this just sets the collGroups collection to an empty array (like clearcollGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGroups($overrideExisting = true)
    {
        if (null !== $this->collGroups && !$overrideExisting) {
            return;
        }
        $this->collGroups = new PropelObjectCollection();
        $this->collGroups->setModel('Group');
    }

    /**
     * Gets an array of Group objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Fundation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Group[] List of Group objects
     * @throws PropelException
     */
    public function getGroups($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collGroupsPartial && !$this->isNew();
        if (null === $this->collGroups || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGroups) {
                // return empty collection
                $this->initGroups();
            } else {
                $collGroups = GroupQuery::create(null, $criteria)
                    ->filterByFundation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collGroupsPartial && count($collGroups)) {
                      $this->initGroups(false);

                      foreach($collGroups as $obj) {
                        if (false == $this->collGroups->contains($obj)) {
                          $this->collGroups->append($obj);
                        }
                      }

                      $this->collGroupsPartial = true;
                    }

                    return $collGroups;
                }

                if($partial && $this->collGroups) {
                    foreach($this->collGroups as $obj) {
                        if($obj->isNew()) {
                            $collGroups[] = $obj;
                        }
                    }
                }

                $this->collGroups = $collGroups;
                $this->collGroupsPartial = false;
            }
        }

        return $this->collGroups;
    }

    /**
     * Sets a collection of Group objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $groups A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setGroups(PropelCollection $groups, PropelPDO $con = null)
    {
        $this->groupsScheduledForDeletion = $this->getGroups(new Criteria(), $con)->diff($groups);

        foreach ($this->groupsScheduledForDeletion as $groupRemoved) {
            $groupRemoved->setFundation(null);
        }

        $this->collGroups = null;
        foreach ($groups as $group) {
            $this->addGroup($group);
        }

        $this->collGroups = $groups;
        $this->collGroupsPartial = false;
    }

    /**
     * Returns the number of related Group objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Group objects.
     * @throws PropelException
     */
    public function countGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collGroupsPartial && !$this->isNew();
        if (null === $this->collGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGroups) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getGroups());
                }
                $query = GroupQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByFundation($this)
                    ->count($con);
            }
        } else {
            return count($this->collGroups);
        }
    }

    /**
     * Method called to associate a Group object to this object
     * through the Group foreign key attribute.
     *
     * @param    Group $l Group
     * @return Fundation The current object (for fluent API support)
     */
    public function addGroup(Group $l)
    {
        if ($this->collGroups === null) {
            $this->initGroups();
            $this->collGroupsPartial = true;
        }
        if (!in_array($l, $this->collGroups->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddGroup($l);
        }

        return $this;
    }

    /**
     * @param	Group $group The group object to add.
     */
    protected function doAddGroup($group)
    {
        $this->collGroups[]= $group;
        $group->setFundation($this);
    }

    /**
     * @param	Group $group The group object to remove.
     */
    public function removeGroup($group)
    {
        if ($this->getGroups()->contains($group)) {
            $this->collGroups->remove($this->collGroups->search($group));
            if (null === $this->groupsScheduledForDeletion) {
                $this->groupsScheduledForDeletion = clone $this->collGroups;
                $this->groupsScheduledForDeletion->clear();
            }
            $this->groupsScheduledForDeletion[]= $group;
            $group->setFundation(null);
        }
    }

    /**
     * Clears out the collItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addItems()
     */
    public function clearItems()
    {
        $this->collItems = null; // important to set this to null since that means it is uninitialized
        $this->collItemsPartial = null;
    }

    /**
     * reset is the collItems collection loaded partially
     *
     * @return void
     */
    public function resetPartialItems($v = true)
    {
        $this->collItemsPartial = $v;
    }

    /**
     * Initializes the collItems collection.
     *
     * By default this just sets the collItems collection to an empty array (like clearcollItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initItems($overrideExisting = true)
    {
        if (null !== $this->collItems && !$overrideExisting) {
            return;
        }
        $this->collItems = new PropelObjectCollection();
        $this->collItems->setModel('Item');
    }

    /**
     * Gets an array of Item objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Fundation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Item[] List of Item objects
     * @throws PropelException
     */
    public function getItems($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collItemsPartial && !$this->isNew();
        if (null === $this->collItems || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collItems) {
                // return empty collection
                $this->initItems();
            } else {
                $collItems = ItemQuery::create(null, $criteria)
                    ->filterByFundation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collItemsPartial && count($collItems)) {
                      $this->initItems(false);

                      foreach($collItems as $obj) {
                        if (false == $this->collItems->contains($obj)) {
                          $this->collItems->append($obj);
                        }
                      }

                      $this->collItemsPartial = true;
                    }

                    return $collItems;
                }

                if($partial && $this->collItems) {
                    foreach($this->collItems as $obj) {
                        if($obj->isNew()) {
                            $collItems[] = $obj;
                        }
                    }
                }

                $this->collItems = $collItems;
                $this->collItemsPartial = false;
            }
        }

        return $this->collItems;
    }

    /**
     * Sets a collection of Item objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $items A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setItems(PropelCollection $items, PropelPDO $con = null)
    {
        $this->itemsScheduledForDeletion = $this->getItems(new Criteria(), $con)->diff($items);

        foreach ($this->itemsScheduledForDeletion as $itemRemoved) {
            $itemRemoved->setFundation(null);
        }

        $this->collItems = null;
        foreach ($items as $item) {
            $this->addItem($item);
        }

        $this->collItems = $items;
        $this->collItemsPartial = false;
    }

    /**
     * Returns the number of related Item objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Item objects.
     * @throws PropelException
     */
    public function countItems(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collItemsPartial && !$this->isNew();
        if (null === $this->collItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collItems) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getItems());
                }
                $query = ItemQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByFundation($this)
                    ->count($con);
            }
        } else {
            return count($this->collItems);
        }
    }

    /**
     * Method called to associate a Item object to this object
     * through the Item foreign key attribute.
     *
     * @param    Item $l Item
     * @return Fundation The current object (for fluent API support)
     */
    public function addItem(Item $l)
    {
        if ($this->collItems === null) {
            $this->initItems();
            $this->collItemsPartial = true;
        }
        if (!in_array($l, $this->collItems->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddItem($l);
        }

        return $this;
    }

    /**
     * @param	Item $item The item object to add.
     */
    protected function doAddItem($item)
    {
        $this->collItems[]= $item;
        $item->setFundation($this);
    }

    /**
     * @param	Item $item The item object to remove.
     */
    public function removeItem($item)
    {
        if ($this->getItems()->contains($item)) {
            $this->collItems->remove($this->collItems->search($item));
            if (null === $this->itemsScheduledForDeletion) {
                $this->itemsScheduledForDeletion = clone $this->collItems;
                $this->itemsScheduledForDeletion->clear();
            }
            $this->itemsScheduledForDeletion[]= $item;
            $item->setFundation(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Fundation is new, it will return
     * an empty collection; or if this Fundation has previously
     * been saved, it will retrieve related Items from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Fundation.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Item[] List of Item objects
     */
    public function getItemsJoinImage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ItemQuery::create(null, $criteria);
        $query->joinWith('Image', $join_behavior);

        return $this->getItems($query, $con);
    }

    /**
     * Clears out the collPeriods collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPeriods()
     */
    public function clearPeriods()
    {
        $this->collPeriods = null; // important to set this to null since that means it is uninitialized
        $this->collPeriodsPartial = null;
    }

    /**
     * reset is the collPeriods collection loaded partially
     *
     * @return void
     */
    public function resetPartialPeriods($v = true)
    {
        $this->collPeriodsPartial = $v;
    }

    /**
     * Initializes the collPeriods collection.
     *
     * By default this just sets the collPeriods collection to an empty array (like clearcollPeriods());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPeriods($overrideExisting = true)
    {
        if (null !== $this->collPeriods && !$overrideExisting) {
            return;
        }
        $this->collPeriods = new PropelObjectCollection();
        $this->collPeriods->setModel('Period');
    }

    /**
     * Gets an array of Period objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Fundation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Period[] List of Period objects
     * @throws PropelException
     */
    public function getPeriods($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPeriodsPartial && !$this->isNew();
        if (null === $this->collPeriods || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPeriods) {
                // return empty collection
                $this->initPeriods();
            } else {
                $collPeriods = PeriodQuery::create(null, $criteria)
                    ->filterByFundation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPeriodsPartial && count($collPeriods)) {
                      $this->initPeriods(false);

                      foreach($collPeriods as $obj) {
                        if (false == $this->collPeriods->contains($obj)) {
                          $this->collPeriods->append($obj);
                        }
                      }

                      $this->collPeriodsPartial = true;
                    }

                    return $collPeriods;
                }

                if($partial && $this->collPeriods) {
                    foreach($this->collPeriods as $obj) {
                        if($obj->isNew()) {
                            $collPeriods[] = $obj;
                        }
                    }
                }

                $this->collPeriods = $collPeriods;
                $this->collPeriodsPartial = false;
            }
        }

        return $this->collPeriods;
    }

    /**
     * Sets a collection of Period objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $periods A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setPeriods(PropelCollection $periods, PropelPDO $con = null)
    {
        $this->periodsScheduledForDeletion = $this->getPeriods(new Criteria(), $con)->diff($periods);

        foreach ($this->periodsScheduledForDeletion as $periodRemoved) {
            $periodRemoved->setFundation(null);
        }

        $this->collPeriods = null;
        foreach ($periods as $period) {
            $this->addPeriod($period);
        }

        $this->collPeriods = $periods;
        $this->collPeriodsPartial = false;
    }

    /**
     * Returns the number of related Period objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Period objects.
     * @throws PropelException
     */
    public function countPeriods(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPeriodsPartial && !$this->isNew();
        if (null === $this->collPeriods || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPeriods) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getPeriods());
                }
                $query = PeriodQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByFundation($this)
                    ->count($con);
            }
        } else {
            return count($this->collPeriods);
        }
    }

    /**
     * Method called to associate a Period object to this object
     * through the Period foreign key attribute.
     *
     * @param    Period $l Period
     * @return Fundation The current object (for fluent API support)
     */
    public function addPeriod(Period $l)
    {
        if ($this->collPeriods === null) {
            $this->initPeriods();
            $this->collPeriodsPartial = true;
        }
        if (!in_array($l, $this->collPeriods->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPeriod($l);
        }

        return $this;
    }

    /**
     * @param	Period $period The period object to add.
     */
    protected function doAddPeriod($period)
    {
        $this->collPeriods[]= $period;
        $period->setFundation($this);
    }

    /**
     * @param	Period $period The period object to remove.
     */
    public function removePeriod($period)
    {
        if ($this->getPeriods()->contains($period)) {
            $this->collPeriods->remove($this->collPeriods->search($period));
            if (null === $this->periodsScheduledForDeletion) {
                $this->periodsScheduledForDeletion = clone $this->collPeriods;
                $this->periodsScheduledForDeletion->clear();
            }
            $this->periodsScheduledForDeletion[]= $period;
            $period->setFundation(null);
        }
    }

    /**
     * Clears out the collPlages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPlages()
     */
    public function clearPlages()
    {
        $this->collPlages = null; // important to set this to null since that means it is uninitialized
        $this->collPlagesPartial = null;
    }

    /**
     * reset is the collPlages collection loaded partially
     *
     * @return void
     */
    public function resetPartialPlages($v = true)
    {
        $this->collPlagesPartial = $v;
    }

    /**
     * Initializes the collPlages collection.
     *
     * By default this just sets the collPlages collection to an empty array (like clearcollPlages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPlages($overrideExisting = true)
    {
        if (null !== $this->collPlages && !$overrideExisting) {
            return;
        }
        $this->collPlages = new PropelObjectCollection();
        $this->collPlages->setModel('Plage');
    }

    /**
     * Gets an array of Plage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Fundation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Plage[] List of Plage objects
     * @throws PropelException
     */
    public function getPlages($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPlagesPartial && !$this->isNew();
        if (null === $this->collPlages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPlages) {
                // return empty collection
                $this->initPlages();
            } else {
                $collPlages = PlageQuery::create(null, $criteria)
                    ->filterByFundation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPlagesPartial && count($collPlages)) {
                      $this->initPlages(false);

                      foreach($collPlages as $obj) {
                        if (false == $this->collPlages->contains($obj)) {
                          $this->collPlages->append($obj);
                        }
                      }

                      $this->collPlagesPartial = true;
                    }

                    return $collPlages;
                }

                if($partial && $this->collPlages) {
                    foreach($this->collPlages as $obj) {
                        if($obj->isNew()) {
                            $collPlages[] = $obj;
                        }
                    }
                }

                $this->collPlages = $collPlages;
                $this->collPlagesPartial = false;
            }
        }

        return $this->collPlages;
    }

    /**
     * Sets a collection of Plage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $plages A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setPlages(PropelCollection $plages, PropelPDO $con = null)
    {
        $this->plagesScheduledForDeletion = $this->getPlages(new Criteria(), $con)->diff($plages);

        foreach ($this->plagesScheduledForDeletion as $plageRemoved) {
            $plageRemoved->setFundation(null);
        }

        $this->collPlages = null;
        foreach ($plages as $plage) {
            $this->addPlage($plage);
        }

        $this->collPlages = $plages;
        $this->collPlagesPartial = false;
    }

    /**
     * Returns the number of related Plage objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Plage objects.
     * @throws PropelException
     */
    public function countPlages(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPlagesPartial && !$this->isNew();
        if (null === $this->collPlages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPlages) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getPlages());
                }
                $query = PlageQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByFundation($this)
                    ->count($con);
            }
        } else {
            return count($this->collPlages);
        }
    }

    /**
     * Method called to associate a Plage object to this object
     * through the Plage foreign key attribute.
     *
     * @param    Plage $l Plage
     * @return Fundation The current object (for fluent API support)
     */
    public function addPlage(Plage $l)
    {
        if ($this->collPlages === null) {
            $this->initPlages();
            $this->collPlagesPartial = true;
        }
        if (!in_array($l, $this->collPlages->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPlage($l);
        }

        return $this;
    }

    /**
     * @param	Plage $plage The plage object to add.
     */
    protected function doAddPlage($plage)
    {
        $this->collPlages[]= $plage;
        $plage->setFundation($this);
    }

    /**
     * @param	Plage $plage The plage object to remove.
     */
    public function removePlage($plage)
    {
        if ($this->getPlages()->contains($plage)) {
            $this->collPlages->remove($this->collPlages->search($plage));
            if (null === $this->plagesScheduledForDeletion) {
                $this->plagesScheduledForDeletion = clone $this->collPlages;
                $this->plagesScheduledForDeletion->clear();
            }
            $this->plagesScheduledForDeletion[]= $plage;
            $plage->setFundation(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Fundation is new, it will return
     * an empty collection; or if this Fundation has previously
     * been saved, it will retrieve related Plages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Fundation.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Plage[] List of Plage objects
     */
    public function getPlagesJoinPoint($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PlageQuery::create(null, $criteria);
        $query->joinWith('Point', $join_behavior);

        return $this->getPlages($query, $con);
    }

    /**
     * Clears out the collPurchases collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPurchases()
     */
    public function clearPurchases()
    {
        $this->collPurchases = null; // important to set this to null since that means it is uninitialized
        $this->collPurchasesPartial = null;
    }

    /**
     * reset is the collPurchases collection loaded partially
     *
     * @return void
     */
    public function resetPartialPurchases($v = true)
    {
        $this->collPurchasesPartial = $v;
    }

    /**
     * Initializes the collPurchases collection.
     *
     * By default this just sets the collPurchases collection to an empty array (like clearcollPurchases());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPurchases($overrideExisting = true)
    {
        if (null !== $this->collPurchases && !$overrideExisting) {
            return;
        }
        $this->collPurchases = new PropelObjectCollection();
        $this->collPurchases->setModel('Purchase');
    }

    /**
     * Gets an array of Purchase objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Fundation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     * @throws PropelException
     */
    public function getPurchases($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPurchasesPartial && !$this->isNew();
        if (null === $this->collPurchases || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPurchases) {
                // return empty collection
                $this->initPurchases();
            } else {
                $collPurchases = PurchaseQuery::create(null, $criteria)
                    ->filterByFundation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPurchasesPartial && count($collPurchases)) {
                      $this->initPurchases(false);

                      foreach($collPurchases as $obj) {
                        if (false == $this->collPurchases->contains($obj)) {
                          $this->collPurchases->append($obj);
                        }
                      }

                      $this->collPurchasesPartial = true;
                    }

                    return $collPurchases;
                }

                if($partial && $this->collPurchases) {
                    foreach($this->collPurchases as $obj) {
                        if($obj->isNew()) {
                            $collPurchases[] = $obj;
                        }
                    }
                }

                $this->collPurchases = $collPurchases;
                $this->collPurchasesPartial = false;
            }
        }

        return $this->collPurchases;
    }

    /**
     * Sets a collection of Purchase objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $purchases A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setPurchases(PropelCollection $purchases, PropelPDO $con = null)
    {
        $this->purchasesScheduledForDeletion = $this->getPurchases(new Criteria(), $con)->diff($purchases);

        foreach ($this->purchasesScheduledForDeletion as $purchaseRemoved) {
            $purchaseRemoved->setFundation(null);
        }

        $this->collPurchases = null;
        foreach ($purchases as $purchase) {
            $this->addPurchase($purchase);
        }

        $this->collPurchases = $purchases;
        $this->collPurchasesPartial = false;
    }

    /**
     * Returns the number of related Purchase objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Purchase objects.
     * @throws PropelException
     */
    public function countPurchases(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPurchasesPartial && !$this->isNew();
        if (null === $this->collPurchases || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPurchases) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getPurchases());
                }
                $query = PurchaseQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByFundation($this)
                    ->count($con);
            }
        } else {
            return count($this->collPurchases);
        }
    }

    /**
     * Method called to associate a Purchase object to this object
     * through the Purchase foreign key attribute.
     *
     * @param    Purchase $l Purchase
     * @return Fundation The current object (for fluent API support)
     */
    public function addPurchase(Purchase $l)
    {
        if ($this->collPurchases === null) {
            $this->initPurchases();
            $this->collPurchasesPartial = true;
        }
        if (!in_array($l, $this->collPurchases->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPurchase($l);
        }

        return $this;
    }

    /**
     * @param	Purchase $purchase The purchase object to add.
     */
    protected function doAddPurchase($purchase)
    {
        $this->collPurchases[]= $purchase;
        $purchase->setFundation($this);
    }

    /**
     * @param	Purchase $purchase The purchase object to remove.
     */
    public function removePurchase($purchase)
    {
        if ($this->getPurchases()->contains($purchase)) {
            $this->collPurchases->remove($this->collPurchases->search($purchase));
            if (null === $this->purchasesScheduledForDeletion) {
                $this->purchasesScheduledForDeletion = clone $this->collPurchases;
                $this->purchasesScheduledForDeletion->clear();
            }
            $this->purchasesScheduledForDeletion[]= $purchase;
            $purchase->setFundation(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Fundation is new, it will return
     * an empty collection; or if this Fundation has previously
     * been saved, it will retrieve related Purchases from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Fundation.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     */
    public function getPurchasesJoinItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PurchaseQuery::create(null, $criteria);
        $query->joinWith('Item', $join_behavior);

        return $this->getPurchases($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Fundation is new, it will return
     * an empty collection; or if this Fundation has previously
     * been saved, it will retrieve related Purchases from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Fundation.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     */
    public function getPurchasesJoinUserRelatedByUsrIdBuyer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PurchaseQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByUsrIdBuyer', $join_behavior);

        return $this->getPurchases($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Fundation is new, it will return
     * an empty collection; or if this Fundation has previously
     * been saved, it will retrieve related Purchases from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Fundation.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     */
    public function getPurchasesJoinUserRelatedByUsrIdSeller($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PurchaseQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByUsrIdSeller', $join_behavior);

        return $this->getPurchases($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Fundation is new, it will return
     * an empty collection; or if this Fundation has previously
     * been saved, it will retrieve related Purchases from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Fundation.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     */
    public function getPurchasesJoinPoint($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PurchaseQuery::create(null, $criteria);
        $query->joinWith('Point', $join_behavior);

        return $this->getPurchases($query, $con);
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
     * If this Fundation is new, it will return
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
                    ->filterByFundation($this)
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
            $jUsrRigRemoved->setFundation(null);
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
                    ->filterByFundation($this)
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
     * @return Fundation The current object (for fluent API support)
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
        $jUsrRig->setFundation($this);
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
            $jUsrRig->setFundation(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Fundation is new, it will return
     * an empty collection; or if this Fundation has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Fundation.
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
     * Otherwise if this Fundation is new, it will return
     * an empty collection; or if this Fundation has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Fundation.
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
     * Otherwise if this Fundation is new, it will return
     * an empty collection; or if this Fundation has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Fundation.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|JUsrRig[] List of JUsrRig objects
     */
    public function getJUsrRigsJoinRight($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = JUsrRigQuery::create(null, $criteria);
        $query->joinWith('Right', $join_behavior);

        return $this->getJUsrRigs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Fundation is new, it will return
     * an empty collection; or if this Fundation has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Fundation.
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
     * If this Fundation is new, it will return
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
                    ->filterByFundation($this)
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
                    ->filterByFundation($this)
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
     * If this Fundation is new, it will return
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
                    ->filterByFundation($this)
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
                    ->filterByFundation($this)
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
     * Clears out the collRights collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRights()
     */
    public function clearRights()
    {
        $this->collRights = null; // important to set this to null since that means it is uninitialized
        $this->collRightsPartial = null;
    }

    /**
     * Initializes the collRights collection.
     *
     * By default this just sets the collRights collection to an empty collection (like clearRights());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initRights()
    {
        $this->collRights = new PropelObjectCollection();
        $this->collRights->setModel('Right');
    }

    /**
     * Gets a collection of Right objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Fundation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Right[] List of Right objects
     */
    public function getRights($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collRights || null !== $criteria) {
            if ($this->isNew() && null === $this->collRights) {
                // return empty collection
                $this->initRights();
            } else {
                $collRights = RightQuery::create(null, $criteria)
                    ->filterByFundation($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collRights;
                }
                $this->collRights = $collRights;
            }
        }

        return $this->collRights;
    }

    /**
     * Sets a collection of Right objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $rights A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setRights(PropelCollection $rights, PropelPDO $con = null)
    {
        $this->clearRights();
        $currentRights = $this->getRights();

        $this->rightsScheduledForDeletion = $currentRights->diff($rights);

        foreach ($rights as $right) {
            if (!$currentRights->contains($right)) {
                $this->doAddRight($right);
            }
        }

        $this->collRights = $rights;
    }

    /**
     * Gets the number of Right objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_rig_jur cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Right objects
     */
    public function countRights($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collRights || null !== $criteria) {
            if ($this->isNew() && null === $this->collRights) {
                return 0;
            } else {
                $query = RightQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByFundation($this)
                    ->count($con);
            }
        } else {
            return count($this->collRights);
        }
    }

    /**
     * Associate a Right object to this object
     * through the tj_usr_rig_jur cross reference table.
     *
     * @param  Right $right The JUsrRig object to relate
     * @return void
     */
    public function addRight(Right $right)
    {
        if ($this->collRights === null) {
            $this->initRights();
        }
        if (!$this->collRights->contains($right)) { // only add it if the **same** object is not already associated
            $this->doAddRight($right);

            $this->collRights[]= $right;
        }
    }

    /**
     * @param	Right $right The right object to add.
     */
    protected function doAddRight($right)
    {
        $jUsrRig = new JUsrRig();
        $jUsrRig->setRight($right);
        $this->addJUsrRig($jUsrRig);
    }

    /**
     * Remove a Right object to this object
     * through the tj_usr_rig_jur cross reference table.
     *
     * @param Right $right The JUsrRig object to relate
     * @return void
     */
    public function removeRight(Right $right)
    {
        if ($this->getRights()->contains($right)) {
            $this->collRights->remove($this->collRights->search($right));
            if (null === $this->rightsScheduledForDeletion) {
                $this->rightsScheduledForDeletion = clone $this->collRights;
                $this->rightsScheduledForDeletion->clear();
            }
            $this->rightsScheduledForDeletion[]= $right;
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
     * If this Fundation is new, it will return
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
                    ->filterByFundation($this)
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
                    ->filterByFundation($this)
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
        $this->fun_id = null;
        $this->fun_name = null;
        $this->fun_removed = null;
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
            if ($this->collGroups) {
                foreach ($this->collGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collItems) {
                foreach ($this->collItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPeriods) {
                foreach ($this->collPeriods as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPlages) {
                foreach ($this->collPlages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPurchases) {
                foreach ($this->collPurchases as $o) {
                    $o->clearAllReferences($deep);
                }
            }
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
            if ($this->collRights) {
                foreach ($this->collRights as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPoints) {
                foreach ($this->collPoints as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collGroups instanceof PropelCollection) {
            $this->collGroups->clearIterator();
        }
        $this->collGroups = null;
        if ($this->collItems instanceof PropelCollection) {
            $this->collItems->clearIterator();
        }
        $this->collItems = null;
        if ($this->collPeriods instanceof PropelCollection) {
            $this->collPeriods->clearIterator();
        }
        $this->collPeriods = null;
        if ($this->collPlages instanceof PropelCollection) {
            $this->collPlages->clearIterator();
        }
        $this->collPlages = null;
        if ($this->collPurchases instanceof PropelCollection) {
            $this->collPurchases->clearIterator();
        }
        $this->collPurchases = null;
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
        if ($this->collRights instanceof PropelCollection) {
            $this->collRights->clearIterator();
        }
        $this->collRights = null;
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
        return (string) $this->exportTo(FundationPeer::DEFAULT_STRING_FORMAT);
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
