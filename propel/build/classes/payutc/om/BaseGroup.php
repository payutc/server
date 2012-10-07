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
use Payutc\Group;
use Payutc\GroupPeer;
use Payutc\GroupQuery;
use Payutc\JUsrGrp;
use Payutc\JUsrGrpQuery;
use Payutc\Period;
use Payutc\PeriodQuery;
use Payutc\Price;
use Payutc\PriceQuery;
use Payutc\User;
use Payutc\UserQuery;

/**
 * Base class that represents a row from the 't_group_grp' table.
 *
 *
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseGroup extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Payutc\\GroupPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        GroupPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the grp_id field.
     * @var        int
     */
    protected $grp_id;

    /**
     * The value for the grp_name field.
     * @var        string
     */
    protected $grp_name;

    /**
     * The value for the grp_open field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $grp_open;

    /**
     * The value for the grp_public field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $grp_public;

    /**
     * The value for the fun_id field.
     * @var        int
     */
    protected $fun_id;

    /**
     * The value for the grp_removed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $grp_removed;

    /**
     * @var        Fundation
     */
    protected $aFundation;

    /**
     * @var        PropelObjectCollection|Price[] Collection to store aggregation of Price objects.
     */
    protected $collPrices;
    protected $collPricesPartial;

    /**
     * @var        PropelObjectCollection|JUsrGrp[] Collection to store aggregation of JUsrGrp objects.
     */
    protected $collJUsrGrps;
    protected $collJUsrGrpsPartial;

    /**
     * @var        PropelObjectCollection|Period[] Collection to store aggregation of Period objects.
     */
    protected $collPeriods;

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
    protected $periodsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $pricesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $jUsrGrpsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->grp_open = false;
        $this->grp_public = false;
        $this->grp_removed = false;
    }

    /**
     * Initializes internal state of BaseGroup object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [grp_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->grp_id;
    }

    /**
     * Get the [grp_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->grp_name;
    }

    /**
     * Get the [grp_open] column value.
     *
     * @return boolean
     */
    public function getOpen()
    {
        return $this->grp_open;
    }

    /**
     * Get the [grp_public] column value.
     *
     * @return boolean
     */
    public function getPublic()
    {
        return $this->grp_public;
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
     * Get the [grp_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->grp_removed;
    }

    /**
     * Set the value of [grp_id] column.
     *
     * @param int $v new value
     * @return Group The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->grp_id !== $v) {
            $this->grp_id = $v;
            $this->modifiedColumns[] = GroupPeer::GRP_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [grp_name] column.
     *
     * @param string $v new value
     * @return Group The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->grp_name !== $v) {
            $this->grp_name = $v;
            $this->modifiedColumns[] = GroupPeer::GRP_NAME;
        }


        return $this;
    } // setName()

    /**
     * Sets the value of the [grp_open] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Group The current object (for fluent API support)
     */
    public function setOpen($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->grp_open !== $v) {
            $this->grp_open = $v;
            $this->modifiedColumns[] = GroupPeer::GRP_OPEN;
        }


        return $this;
    } // setOpen()

    /**
     * Sets the value of the [grp_public] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Group The current object (for fluent API support)
     */
    public function setPublic($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->grp_public !== $v) {
            $this->grp_public = $v;
            $this->modifiedColumns[] = GroupPeer::GRP_PUBLIC;
        }


        return $this;
    } // setPublic()

    /**
     * Set the value of [fun_id] column.
     *
     * @param int $v new value
     * @return Group The current object (for fluent API support)
     */
    public function setFunId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fun_id !== $v) {
            $this->fun_id = $v;
            $this->modifiedColumns[] = GroupPeer::FUN_ID;
        }

        if ($this->aFundation !== null && $this->aFundation->getId() !== $v) {
            $this->aFundation = null;
        }


        return $this;
    } // setFunId()

    /**
     * Sets the value of the [grp_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Group The current object (for fluent API support)
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

        if ($this->grp_removed !== $v) {
            $this->grp_removed = $v;
            $this->modifiedColumns[] = GroupPeer::GRP_REMOVED;
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
            if ($this->grp_open !== false) {
                return false;
            }

            if ($this->grp_public !== false) {
                return false;
            }

            if ($this->grp_removed !== false) {
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

            $this->grp_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->grp_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->grp_open = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->grp_public = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
            $this->fun_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->grp_removed = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = GroupPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Group object", $e);
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
            $con = Propel::getConnection(GroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = GroupPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFundation = null;
            $this->collPrices = null;

            $this->collJUsrGrps = null;

            $this->collPeriods = null;
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
            $con = Propel::getConnection(GroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = GroupQuery::create()
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
            $con = Propel::getConnection(GroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                GroupPeer::addInstanceToPool($this);
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

            if ($this->periodsScheduledForDeletion !== null) {
                if (!$this->periodsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->periodsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    JUsrGrpQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->periodsScheduledForDeletion = null;
                }

                foreach ($this->getPeriods() as $period) {
                    if ($period->isModified()) {
                        $period->save($con);
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
                    JUsrGrpQuery::create()
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

            if ($this->pricesScheduledForDeletion !== null) {
                if (!$this->pricesScheduledForDeletion->isEmpty()) {
                    foreach ($this->pricesScheduledForDeletion as $price) {
                        // need to save related object because we set the relation to null
                        $price->save($con);
                    }
                    $this->pricesScheduledForDeletion = null;
                }
            }

            if ($this->collPrices !== null) {
                foreach ($this->collPrices as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->jUsrGrpsScheduledForDeletion !== null) {
                if (!$this->jUsrGrpsScheduledForDeletion->isEmpty()) {
                    JUsrGrpQuery::create()
                        ->filterByPrimaryKeys($this->jUsrGrpsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jUsrGrpsScheduledForDeletion = null;
                }
            }

            if ($this->collJUsrGrps !== null) {
                foreach ($this->collJUsrGrps as $referrerFK) {
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

        $this->modifiedColumns[] = GroupPeer::GRP_ID;
        if (null !== $this->grp_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GroupPeer::GRP_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GroupPeer::GRP_ID)) {
            $modifiedColumns[':p' . $index++]  = '`GRP_ID`';
        }
        if ($this->isColumnModified(GroupPeer::GRP_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`GRP_NAME`';
        }
        if ($this->isColumnModified(GroupPeer::GRP_OPEN)) {
            $modifiedColumns[':p' . $index++]  = '`GRP_OPEN`';
        }
        if ($this->isColumnModified(GroupPeer::GRP_PUBLIC)) {
            $modifiedColumns[':p' . $index++]  = '`GRP_PUBLIC`';
        }
        if ($this->isColumnModified(GroupPeer::FUN_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_ID`';
        }
        if ($this->isColumnModified(GroupPeer::GRP_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`GRP_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `t_group_grp` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`GRP_ID`':
                        $stmt->bindValue($identifier, $this->grp_id, PDO::PARAM_INT);
                        break;
                    case '`GRP_NAME`':
                        $stmt->bindValue($identifier, $this->grp_name, PDO::PARAM_STR);
                        break;
                    case '`GRP_OPEN`':
                        $stmt->bindValue($identifier, (int) $this->grp_open, PDO::PARAM_INT);
                        break;
                    case '`GRP_PUBLIC`':
                        $stmt->bindValue($identifier, (int) $this->grp_public, PDO::PARAM_INT);
                        break;
                    case '`FUN_ID`':
                        $stmt->bindValue($identifier, $this->fun_id, PDO::PARAM_INT);
                        break;
                    case '`GRP_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->grp_removed, PDO::PARAM_INT);
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

            if ($this->aFundation !== null) {
                if (!$this->aFundation->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aFundation->getValidationFailures());
                }
            }


            if (($retval = GroupPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPrices !== null) {
                    foreach ($this->collPrices as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collJUsrGrps !== null) {
                    foreach ($this->collJUsrGrps as $referrerFK) {
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
        $pos = GroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getOpen();
                break;
            case 3:
                return $this->getPublic();
                break;
            case 4:
                return $this->getFunId();
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
        if (isset($alreadyDumpedObjects['Group'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Group'][$this->getPrimaryKey()] = true;
        $keys = GroupPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getOpen(),
            $keys[3] => $this->getPublic(),
            $keys[4] => $this->getFunId(),
            $keys[5] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aFundation) {
                $result['Fundation'] = $this->aFundation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPrices) {
                $result['Prices'] = $this->collPrices->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collJUsrGrps) {
                $result['JUsrGrps'] = $this->collJUsrGrps->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = GroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setOpen($value);
                break;
            case 3:
                $this->setPublic($value);
                break;
            case 4:
                $this->setFunId($value);
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
        $keys = GroupPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setOpen($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPublic($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setFunId($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setRemoved($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(GroupPeer::DATABASE_NAME);

        if ($this->isColumnModified(GroupPeer::GRP_ID)) $criteria->add(GroupPeer::GRP_ID, $this->grp_id);
        if ($this->isColumnModified(GroupPeer::GRP_NAME)) $criteria->add(GroupPeer::GRP_NAME, $this->grp_name);
        if ($this->isColumnModified(GroupPeer::GRP_OPEN)) $criteria->add(GroupPeer::GRP_OPEN, $this->grp_open);
        if ($this->isColumnModified(GroupPeer::GRP_PUBLIC)) $criteria->add(GroupPeer::GRP_PUBLIC, $this->grp_public);
        if ($this->isColumnModified(GroupPeer::FUN_ID)) $criteria->add(GroupPeer::FUN_ID, $this->fun_id);
        if ($this->isColumnModified(GroupPeer::GRP_REMOVED)) $criteria->add(GroupPeer::GRP_REMOVED, $this->grp_removed);

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
        $criteria = new Criteria(GroupPeer::DATABASE_NAME);
        $criteria->add(GroupPeer::GRP_ID, $this->grp_id);

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
     * Generic method to set the primary key (grp_id column).
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
     * @param object $copyObj An object of Group (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setOpen($this->getOpen());
        $copyObj->setPublic($this->getPublic());
        $copyObj->setFunId($this->getFunId());
        $copyObj->setRemoved($this->getRemoved());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getPrices() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPrice($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getJUsrGrps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJUsrGrp($relObj->copy($deepCopy));
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
     * @return Group Clone of current object.
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
     * @return GroupPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new GroupPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Fundation object.
     *
     * @param             Fundation $v
     * @return Group The current object (for fluent API support)
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
            $v->addGroup($this);
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
                $this->aFundation->addGroups($this);
             */
        }

        return $this->aFundation;
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
        if ('Price' == $relationName) {
            $this->initPrices();
        }
        if ('JUsrGrp' == $relationName) {
            $this->initJUsrGrps();
        }
    }

    /**
     * Clears out the collPrices collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPrices()
     */
    public function clearPrices()
    {
        $this->collPrices = null; // important to set this to null since that means it is uninitialized
        $this->collPricesPartial = null;
    }

    /**
     * reset is the collPrices collection loaded partially
     *
     * @return void
     */
    public function resetPartialPrices($v = true)
    {
        $this->collPricesPartial = $v;
    }

    /**
     * Initializes the collPrices collection.
     *
     * By default this just sets the collPrices collection to an empty array (like clearcollPrices());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPrices($overrideExisting = true)
    {
        if (null !== $this->collPrices && !$overrideExisting) {
            return;
        }
        $this->collPrices = new PropelObjectCollection();
        $this->collPrices->setModel('Price');
    }

    /**
     * Gets an array of Price objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Group is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Price[] List of Price objects
     * @throws PropelException
     */
    public function getPrices($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPricesPartial && !$this->isNew();
        if (null === $this->collPrices || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPrices) {
                // return empty collection
                $this->initPrices();
            } else {
                $collPrices = PriceQuery::create(null, $criteria)
                    ->filterByGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPricesPartial && count($collPrices)) {
                      $this->initPrices(false);

                      foreach($collPrices as $obj) {
                        if (false == $this->collPrices->contains($obj)) {
                          $this->collPrices->append($obj);
                        }
                      }

                      $this->collPricesPartial = true;
                    }

                    return $collPrices;
                }

                if($partial && $this->collPrices) {
                    foreach($this->collPrices as $obj) {
                        if($obj->isNew()) {
                            $collPrices[] = $obj;
                        }
                    }
                }

                $this->collPrices = $collPrices;
                $this->collPricesPartial = false;
            }
        }

        return $this->collPrices;
    }

    /**
     * Sets a collection of Price objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $prices A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setPrices(PropelCollection $prices, PropelPDO $con = null)
    {
        $this->pricesScheduledForDeletion = $this->getPrices(new Criteria(), $con)->diff($prices);

        foreach ($this->pricesScheduledForDeletion as $priceRemoved) {
            $priceRemoved->setGroup(null);
        }

        $this->collPrices = null;
        foreach ($prices as $price) {
            $this->addPrice($price);
        }

        $this->collPrices = $prices;
        $this->collPricesPartial = false;
    }

    /**
     * Returns the number of related Price objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Price objects.
     * @throws PropelException
     */
    public function countPrices(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPricesPartial && !$this->isNew();
        if (null === $this->collPrices || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPrices) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getPrices());
                }
                $query = PriceQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByGroup($this)
                    ->count($con);
            }
        } else {
            return count($this->collPrices);
        }
    }

    /**
     * Method called to associate a Price object to this object
     * through the Price foreign key attribute.
     *
     * @param    Price $l Price
     * @return Group The current object (for fluent API support)
     */
    public function addPrice(Price $l)
    {
        if ($this->collPrices === null) {
            $this->initPrices();
            $this->collPricesPartial = true;
        }
        if (!in_array($l, $this->collPrices->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPrice($l);
        }

        return $this;
    }

    /**
     * @param	Price $price The price object to add.
     */
    protected function doAddPrice($price)
    {
        $this->collPrices[]= $price;
        $price->setGroup($this);
    }

    /**
     * @param	Price $price The price object to remove.
     */
    public function removePrice($price)
    {
        if ($this->getPrices()->contains($price)) {
            $this->collPrices->remove($this->collPrices->search($price));
            if (null === $this->pricesScheduledForDeletion) {
                $this->pricesScheduledForDeletion = clone $this->collPrices;
                $this->pricesScheduledForDeletion->clear();
            }
            $this->pricesScheduledForDeletion[]= $price;
            $price->setGroup(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Group is new, it will return
     * an empty collection; or if this Group has previously
     * been saved, it will retrieve related Prices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Group.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Price[] List of Price objects
     */
    public function getPricesJoinPeriod($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PriceQuery::create(null, $criteria);
        $query->joinWith('Period', $join_behavior);

        return $this->getPrices($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Group is new, it will return
     * an empty collection; or if this Group has previously
     * been saved, it will retrieve related Prices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Group.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Price[] List of Price objects
     */
    public function getPricesJoinItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PriceQuery::create(null, $criteria);
        $query->joinWith('Item', $join_behavior);

        return $this->getPrices($query, $con);
    }

    /**
     * Clears out the collJUsrGrps collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJUsrGrps()
     */
    public function clearJUsrGrps()
    {
        $this->collJUsrGrps = null; // important to set this to null since that means it is uninitialized
        $this->collJUsrGrpsPartial = null;
    }

    /**
     * reset is the collJUsrGrps collection loaded partially
     *
     * @return void
     */
    public function resetPartialJUsrGrps($v = true)
    {
        $this->collJUsrGrpsPartial = $v;
    }

    /**
     * Initializes the collJUsrGrps collection.
     *
     * By default this just sets the collJUsrGrps collection to an empty array (like clearcollJUsrGrps());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJUsrGrps($overrideExisting = true)
    {
        if (null !== $this->collJUsrGrps && !$overrideExisting) {
            return;
        }
        $this->collJUsrGrps = new PropelObjectCollection();
        $this->collJUsrGrps->setModel('JUsrGrp');
    }

    /**
     * Gets an array of JUsrGrp objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Group is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|JUsrGrp[] List of JUsrGrp objects
     * @throws PropelException
     */
    public function getJUsrGrps($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collJUsrGrpsPartial && !$this->isNew();
        if (null === $this->collJUsrGrps || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJUsrGrps) {
                // return empty collection
                $this->initJUsrGrps();
            } else {
                $collJUsrGrps = JUsrGrpQuery::create(null, $criteria)
                    ->filterByGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collJUsrGrpsPartial && count($collJUsrGrps)) {
                      $this->initJUsrGrps(false);

                      foreach($collJUsrGrps as $obj) {
                        if (false == $this->collJUsrGrps->contains($obj)) {
                          $this->collJUsrGrps->append($obj);
                        }
                      }

                      $this->collJUsrGrpsPartial = true;
                    }

                    return $collJUsrGrps;
                }

                if($partial && $this->collJUsrGrps) {
                    foreach($this->collJUsrGrps as $obj) {
                        if($obj->isNew()) {
                            $collJUsrGrps[] = $obj;
                        }
                    }
                }

                $this->collJUsrGrps = $collJUsrGrps;
                $this->collJUsrGrpsPartial = false;
            }
        }

        return $this->collJUsrGrps;
    }

    /**
     * Sets a collection of JUsrGrp objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $jUsrGrps A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setJUsrGrps(PropelCollection $jUsrGrps, PropelPDO $con = null)
    {
        $this->jUsrGrpsScheduledForDeletion = $this->getJUsrGrps(new Criteria(), $con)->diff($jUsrGrps);

        foreach ($this->jUsrGrpsScheduledForDeletion as $jUsrGrpRemoved) {
            $jUsrGrpRemoved->setGroup(null);
        }

        $this->collJUsrGrps = null;
        foreach ($jUsrGrps as $jUsrGrp) {
            $this->addJUsrGrp($jUsrGrp);
        }

        $this->collJUsrGrps = $jUsrGrps;
        $this->collJUsrGrpsPartial = false;
    }

    /**
     * Returns the number of related JUsrGrp objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related JUsrGrp objects.
     * @throws PropelException
     */
    public function countJUsrGrps(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collJUsrGrpsPartial && !$this->isNew();
        if (null === $this->collJUsrGrps || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJUsrGrps) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getJUsrGrps());
                }
                $query = JUsrGrpQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByGroup($this)
                    ->count($con);
            }
        } else {
            return count($this->collJUsrGrps);
        }
    }

    /**
     * Method called to associate a JUsrGrp object to this object
     * through the JUsrGrp foreign key attribute.
     *
     * @param    JUsrGrp $l JUsrGrp
     * @return Group The current object (for fluent API support)
     */
    public function addJUsrGrp(JUsrGrp $l)
    {
        if ($this->collJUsrGrps === null) {
            $this->initJUsrGrps();
            $this->collJUsrGrpsPartial = true;
        }
        if (!in_array($l, $this->collJUsrGrps->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddJUsrGrp($l);
        }

        return $this;
    }

    /**
     * @param	JUsrGrp $jUsrGrp The jUsrGrp object to add.
     */
    protected function doAddJUsrGrp($jUsrGrp)
    {
        $this->collJUsrGrps[]= $jUsrGrp;
        $jUsrGrp->setGroup($this);
    }

    /**
     * @param	JUsrGrp $jUsrGrp The jUsrGrp object to remove.
     */
    public function removeJUsrGrp($jUsrGrp)
    {
        if ($this->getJUsrGrps()->contains($jUsrGrp)) {
            $this->collJUsrGrps->remove($this->collJUsrGrps->search($jUsrGrp));
            if (null === $this->jUsrGrpsScheduledForDeletion) {
                $this->jUsrGrpsScheduledForDeletion = clone $this->collJUsrGrps;
                $this->jUsrGrpsScheduledForDeletion->clear();
            }
            $this->jUsrGrpsScheduledForDeletion[]= $jUsrGrp;
            $jUsrGrp->setGroup(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Group is new, it will return
     * an empty collection; or if this Group has previously
     * been saved, it will retrieve related JUsrGrps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Group.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|JUsrGrp[] List of JUsrGrp objects
     */
    public function getJUsrGrpsJoinPeriod($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = JUsrGrpQuery::create(null, $criteria);
        $query->joinWith('Period', $join_behavior);

        return $this->getJUsrGrps($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Group is new, it will return
     * an empty collection; or if this Group has previously
     * been saved, it will retrieve related JUsrGrps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Group.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|JUsrGrp[] List of JUsrGrp objects
     */
    public function getJUsrGrpsJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = JUsrGrpQuery::create(null, $criteria);
        $query->joinWith('User', $join_behavior);

        return $this->getJUsrGrps($query, $con);
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
     * Initializes the collPeriods collection.
     *
     * By default this just sets the collPeriods collection to an empty collection (like clearPeriods());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPeriods()
    {
        $this->collPeriods = new PropelObjectCollection();
        $this->collPeriods->setModel('Period');
    }

    /**
     * Gets a collection of Period objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_grp_jug cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Group is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Period[] List of Period objects
     */
    public function getPeriods($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPeriods || null !== $criteria) {
            if ($this->isNew() && null === $this->collPeriods) {
                // return empty collection
                $this->initPeriods();
            } else {
                $collPeriods = PeriodQuery::create(null, $criteria)
                    ->filterByGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPeriods;
                }
                $this->collPeriods = $collPeriods;
            }
        }

        return $this->collPeriods;
    }

    /**
     * Sets a collection of Period objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_grp_jug cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $periods A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setPeriods(PropelCollection $periods, PropelPDO $con = null)
    {
        $this->clearPeriods();
        $currentPeriods = $this->getPeriods();

        $this->periodsScheduledForDeletion = $currentPeriods->diff($periods);

        foreach ($periods as $period) {
            if (!$currentPeriods->contains($period)) {
                $this->doAddPeriod($period);
            }
        }

        $this->collPeriods = $periods;
    }

    /**
     * Gets the number of Period objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_grp_jug cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Period objects
     */
    public function countPeriods($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPeriods || null !== $criteria) {
            if ($this->isNew() && null === $this->collPeriods) {
                return 0;
            } else {
                $query = PeriodQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByGroup($this)
                    ->count($con);
            }
        } else {
            return count($this->collPeriods);
        }
    }

    /**
     * Associate a Period object to this object
     * through the tj_usr_grp_jug cross reference table.
     *
     * @param  Period $period The JUsrGrp object to relate
     * @return void
     */
    public function addPeriod(Period $period)
    {
        if ($this->collPeriods === null) {
            $this->initPeriods();
        }
        if (!$this->collPeriods->contains($period)) { // only add it if the **same** object is not already associated
            $this->doAddPeriod($period);

            $this->collPeriods[]= $period;
        }
    }

    /**
     * @param	Period $period The period object to add.
     */
    protected function doAddPeriod($period)
    {
        $jUsrGrp = new JUsrGrp();
        $jUsrGrp->setPeriod($period);
        $this->addJUsrGrp($jUsrGrp);
    }

    /**
     * Remove a Period object to this object
     * through the tj_usr_grp_jug cross reference table.
     *
     * @param Period $period The JUsrGrp object to relate
     * @return void
     */
    public function removePeriod(Period $period)
    {
        if ($this->getPeriods()->contains($period)) {
            $this->collPeriods->remove($this->collPeriods->search($period));
            if (null === $this->periodsScheduledForDeletion) {
                $this->periodsScheduledForDeletion = clone $this->collPeriods;
                $this->periodsScheduledForDeletion->clear();
            }
            $this->periodsScheduledForDeletion[]= $period;
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
     * to the current object by way of the tj_usr_grp_jug cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Group is new, it will return
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
                    ->filterByGroup($this)
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
     * to the current object by way of the tj_usr_grp_jug cross-reference table.
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
     * to the current object by way of the tj_usr_grp_jug cross-reference table.
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
                    ->filterByGroup($this)
                    ->count($con);
            }
        } else {
            return count($this->collUsers);
        }
    }

    /**
     * Associate a User object to this object
     * through the tj_usr_grp_jug cross reference table.
     *
     * @param  User $user The JUsrGrp object to relate
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
        $jUsrGrp = new JUsrGrp();
        $jUsrGrp->setUser($user);
        $this->addJUsrGrp($jUsrGrp);
    }

    /**
     * Remove a User object to this object
     * through the tj_usr_grp_jug cross reference table.
     *
     * @param User $user The JUsrGrp object to relate
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
        $this->grp_id = null;
        $this->grp_name = null;
        $this->grp_open = null;
        $this->grp_public = null;
        $this->fun_id = null;
        $this->grp_removed = null;
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
            if ($this->collPrices) {
                foreach ($this->collPrices as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJUsrGrps) {
                foreach ($this->collJUsrGrps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPeriods) {
                foreach ($this->collPeriods as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsers) {
                foreach ($this->collUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collPrices instanceof PropelCollection) {
            $this->collPrices->clearIterator();
        }
        $this->collPrices = null;
        if ($this->collJUsrGrps instanceof PropelCollection) {
            $this->collJUsrGrps->clearIterator();
        }
        $this->collJUsrGrps = null;
        if ($this->collPeriods instanceof PropelCollection) {
            $this->collPeriods->clearIterator();
        }
        $this->collPeriods = null;
        if ($this->collUsers instanceof PropelCollection) {
            $this->collUsers->clearIterator();
        }
        $this->collUsers = null;
        $this->aFundation = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GroupPeer::DEFAULT_STRING_FORMAT);
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
