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
use Payutc\Fundation;
use Payutc\FundationQuery;
use Payutc\Item;
use Payutc\ItemQuery;
use Payutc\Point;
use Payutc\PointQuery;
use Payutc\Purchase;
use Payutc\PurchasePeer;
use Payutc\PurchaseQuery;
use Payutc\User;
use Payutc\UserQuery;

/**
 * Base class that represents a row from the 't_purchase_pur' table.
 *
 *
 *
 * @package    propel.generator.payutc.om
 */
abstract class BasePurchase extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Payutc\\PurchasePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PurchasePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the pur_id field.
     * @var        int
     */
    protected $pur_id;

    /**
     * The value for the pur_date field.
     * @var        string
     */
    protected $pur_date;

    /**
     * The value for the pur_type field.
     * Note: this column has a database default value of: 'product'
     * @var        string
     */
    protected $pur_type;

    /**
     * The value for the obj_id field.
     * @var        int
     */
    protected $obj_id;

    /**
     * The value for the pur_price field.
     * @var        int
     */
    protected $pur_price;

    /**
     * The value for the usr_id_buyer field.
     * @var        int
     */
    protected $usr_id_buyer;

    /**
     * The value for the usr_id_seller field.
     * @var        int
     */
    protected $usr_id_seller;

    /**
     * The value for the poi_id field.
     * @var        int
     */
    protected $poi_id;

    /**
     * The value for the fun_id field.
     * @var        int
     */
    protected $fun_id;

    /**
     * The value for the pur_ip field.
     * @var        string
     */
    protected $pur_ip;

    /**
     * The value for the pur_removed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $pur_removed;

    /**
     * @var        Item
     */
    protected $aItem;

    /**
     * @var        User
     */
    protected $aUserRelatedByUsrIdBuyer;

    /**
     * @var        User
     */
    protected $aUserRelatedByUsrIdSeller;

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
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->pur_type = 'product';
        $this->pur_removed = false;
    }

    /**
     * Initializes internal state of BasePurchase object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [pur_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->pur_id;
    }

    /**
     * Get the [optionally formatted] temporal [pur_date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDate($format = 'Y-m-d H:i:s')
    {
        if ($this->pur_date === null) {
            return null;
        }

        if ($this->pur_date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->pur_date);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->pur_date, true), $x);
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
     * Get the [pur_type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->pur_type;
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
     * Get the [pur_price] column value.
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->pur_price;
    }

    /**
     * Get the [usr_id_buyer] column value.
     *
     * @return int
     */
    public function getUsrIdBuyer()
    {
        return $this->usr_id_buyer;
    }

    /**
     * Get the [usr_id_seller] column value.
     *
     * @return int
     */
    public function getUsrIdSeller()
    {
        return $this->usr_id_seller;
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
     * Get the [fun_id] column value.
     *
     * @return int
     */
    public function getFunId()
    {
        return $this->fun_id;
    }

    /**
     * Get the [pur_ip] column value.
     *
     * @return string
     */
    public function getIp()
    {
        return $this->pur_ip;
    }

    /**
     * Get the [pur_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->pur_removed;
    }

    /**
     * Set the value of [pur_id] column.
     *
     * @param int $v new value
     * @return Purchase The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pur_id !== $v) {
            $this->pur_id = $v;
            $this->modifiedColumns[] = PurchasePeer::PUR_ID;
        }


        return $this;
    } // setId()

    /**
     * Sets the value of [pur_date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Purchase The current object (for fluent API support)
     */
    public function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->pur_date !== null || $dt !== null) {
            $currentDateAsString = ($this->pur_date !== null && $tmpDt = new DateTime($this->pur_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->pur_date = $newDateAsString;
                $this->modifiedColumns[] = PurchasePeer::PUR_DATE;
            }
        } // if either are not null


        return $this;
    } // setDate()

    /**
     * Set the value of [pur_type] column.
     *
     * @param string $v new value
     * @return Purchase The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pur_type !== $v) {
            $this->pur_type = $v;
            $this->modifiedColumns[] = PurchasePeer::PUR_TYPE;
        }


        return $this;
    } // setType()

    /**
     * Set the value of [obj_id] column.
     *
     * @param int $v new value
     * @return Purchase The current object (for fluent API support)
     */
    public function setObjId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_id !== $v) {
            $this->obj_id = $v;
            $this->modifiedColumns[] = PurchasePeer::OBJ_ID;
        }

        if ($this->aItem !== null && $this->aItem->getId() !== $v) {
            $this->aItem = null;
        }


        return $this;
    } // setObjId()

    /**
     * Set the value of [pur_price] column.
     *
     * @param int $v new value
     * @return Purchase The current object (for fluent API support)
     */
    public function setPrice($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pur_price !== $v) {
            $this->pur_price = $v;
            $this->modifiedColumns[] = PurchasePeer::PUR_PRICE;
        }


        return $this;
    } // setPrice()

    /**
     * Set the value of [usr_id_buyer] column.
     *
     * @param int $v new value
     * @return Purchase The current object (for fluent API support)
     */
    public function setUsrIdBuyer($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_id_buyer !== $v) {
            $this->usr_id_buyer = $v;
            $this->modifiedColumns[] = PurchasePeer::USR_ID_BUYER;
        }

        if ($this->aUserRelatedByUsrIdBuyer !== null && $this->aUserRelatedByUsrIdBuyer->getId() !== $v) {
            $this->aUserRelatedByUsrIdBuyer = null;
        }


        return $this;
    } // setUsrIdBuyer()

    /**
     * Set the value of [usr_id_seller] column.
     *
     * @param int $v new value
     * @return Purchase The current object (for fluent API support)
     */
    public function setUsrIdSeller($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_id_seller !== $v) {
            $this->usr_id_seller = $v;
            $this->modifiedColumns[] = PurchasePeer::USR_ID_SELLER;
        }

        if ($this->aUserRelatedByUsrIdSeller !== null && $this->aUserRelatedByUsrIdSeller->getId() !== $v) {
            $this->aUserRelatedByUsrIdSeller = null;
        }


        return $this;
    } // setUsrIdSeller()

    /**
     * Set the value of [poi_id] column.
     *
     * @param int $v new value
     * @return Purchase The current object (for fluent API support)
     */
    public function setPoiId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->poi_id !== $v) {
            $this->poi_id = $v;
            $this->modifiedColumns[] = PurchasePeer::POI_ID;
        }

        if ($this->aPoint !== null && $this->aPoint->getId() !== $v) {
            $this->aPoint = null;
        }


        return $this;
    } // setPoiId()

    /**
     * Set the value of [fun_id] column.
     *
     * @param int $v new value
     * @return Purchase The current object (for fluent API support)
     */
    public function setFunId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fun_id !== $v) {
            $this->fun_id = $v;
            $this->modifiedColumns[] = PurchasePeer::FUN_ID;
        }

        if ($this->aFundation !== null && $this->aFundation->getId() !== $v) {
            $this->aFundation = null;
        }


        return $this;
    } // setFunId()

    /**
     * Set the value of [pur_ip] column.
     *
     * @param string $v new value
     * @return Purchase The current object (for fluent API support)
     */
    public function setIp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pur_ip !== $v) {
            $this->pur_ip = $v;
            $this->modifiedColumns[] = PurchasePeer::PUR_IP;
        }


        return $this;
    } // setIp()

    /**
     * Sets the value of the [pur_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Purchase The current object (for fluent API support)
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

        if ($this->pur_removed !== $v) {
            $this->pur_removed = $v;
            $this->modifiedColumns[] = PurchasePeer::PUR_REMOVED;
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
            if ($this->pur_type !== 'product') {
                return false;
            }

            if ($this->pur_removed !== false) {
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

            $this->pur_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->pur_date = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->pur_type = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->obj_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->pur_price = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->usr_id_buyer = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->usr_id_seller = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->poi_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->fun_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->pur_ip = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->pur_removed = ($row[$startcol + 10] !== null) ? (boolean) $row[$startcol + 10] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = PurchasePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Purchase object", $e);
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

        if ($this->aItem !== null && $this->obj_id !== $this->aItem->getId()) {
            $this->aItem = null;
        }
        if ($this->aUserRelatedByUsrIdBuyer !== null && $this->usr_id_buyer !== $this->aUserRelatedByUsrIdBuyer->getId()) {
            $this->aUserRelatedByUsrIdBuyer = null;
        }
        if ($this->aUserRelatedByUsrIdSeller !== null && $this->usr_id_seller !== $this->aUserRelatedByUsrIdSeller->getId()) {
            $this->aUserRelatedByUsrIdSeller = null;
        }
        if ($this->aPoint !== null && $this->poi_id !== $this->aPoint->getId()) {
            $this->aPoint = null;
        }
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
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PurchasePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aItem = null;
            $this->aUserRelatedByUsrIdBuyer = null;
            $this->aUserRelatedByUsrIdSeller = null;
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
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PurchaseQuery::create()
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
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                PurchasePeer::addInstanceToPool($this);
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

            if ($this->aUserRelatedByUsrIdBuyer !== null) {
                if ($this->aUserRelatedByUsrIdBuyer->isModified() || $this->aUserRelatedByUsrIdBuyer->isNew()) {
                    $affectedRows += $this->aUserRelatedByUsrIdBuyer->save($con);
                }
                $this->setUserRelatedByUsrIdBuyer($this->aUserRelatedByUsrIdBuyer);
            }

            if ($this->aUserRelatedByUsrIdSeller !== null) {
                if ($this->aUserRelatedByUsrIdSeller->isModified() || $this->aUserRelatedByUsrIdSeller->isNew()) {
                    $affectedRows += $this->aUserRelatedByUsrIdSeller->save($con);
                }
                $this->setUserRelatedByUsrIdSeller($this->aUserRelatedByUsrIdSeller);
            }

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

        $this->modifiedColumns[] = PurchasePeer::PUR_ID;
        if (null !== $this->pur_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PurchasePeer::PUR_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PurchasePeer::PUR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`PUR_ID`';
        }
        if ($this->isColumnModified(PurchasePeer::PUR_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`PUR_DATE`';
        }
        if ($this->isColumnModified(PurchasePeer::PUR_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`PUR_TYPE`';
        }
        if ($this->isColumnModified(PurchasePeer::OBJ_ID)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_ID`';
        }
        if ($this->isColumnModified(PurchasePeer::PUR_PRICE)) {
            $modifiedColumns[':p' . $index++]  = '`PUR_PRICE`';
        }
        if ($this->isColumnModified(PurchasePeer::USR_ID_BUYER)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ID_BUYER`';
        }
        if ($this->isColumnModified(PurchasePeer::USR_ID_SELLER)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ID_SELLER`';
        }
        if ($this->isColumnModified(PurchasePeer::POI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`POI_ID`';
        }
        if ($this->isColumnModified(PurchasePeer::FUN_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_ID`';
        }
        if ($this->isColumnModified(PurchasePeer::PUR_IP)) {
            $modifiedColumns[':p' . $index++]  = '`PUR_IP`';
        }
        if ($this->isColumnModified(PurchasePeer::PUR_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`PUR_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `t_purchase_pur` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`PUR_ID`':
                        $stmt->bindValue($identifier, $this->pur_id, PDO::PARAM_INT);
                        break;
                    case '`PUR_DATE`':
                        $stmt->bindValue($identifier, $this->pur_date, PDO::PARAM_STR);
                        break;
                    case '`PUR_TYPE`':
                        $stmt->bindValue($identifier, $this->pur_type, PDO::PARAM_STR);
                        break;
                    case '`OBJ_ID`':
                        $stmt->bindValue($identifier, $this->obj_id, PDO::PARAM_INT);
                        break;
                    case '`PUR_PRICE`':
                        $stmt->bindValue($identifier, $this->pur_price, PDO::PARAM_INT);
                        break;
                    case '`USR_ID_BUYER`':
                        $stmt->bindValue($identifier, $this->usr_id_buyer, PDO::PARAM_INT);
                        break;
                    case '`USR_ID_SELLER`':
                        $stmt->bindValue($identifier, $this->usr_id_seller, PDO::PARAM_INT);
                        break;
                    case '`POI_ID`':
                        $stmt->bindValue($identifier, $this->poi_id, PDO::PARAM_INT);
                        break;
                    case '`FUN_ID`':
                        $stmt->bindValue($identifier, $this->fun_id, PDO::PARAM_INT);
                        break;
                    case '`PUR_IP`':
                        $stmt->bindValue($identifier, $this->pur_ip, PDO::PARAM_STR);
                        break;
                    case '`PUR_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->pur_removed, PDO::PARAM_INT);
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

            if ($this->aUserRelatedByUsrIdBuyer !== null) {
                if (!$this->aUserRelatedByUsrIdBuyer->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUserRelatedByUsrIdBuyer->getValidationFailures());
                }
            }

            if ($this->aUserRelatedByUsrIdSeller !== null) {
                if (!$this->aUserRelatedByUsrIdSeller->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUserRelatedByUsrIdSeller->getValidationFailures());
                }
            }

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


            if (($retval = PurchasePeer::doValidate($this, $columns)) !== true) {
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
        $pos = PurchasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getType();
                break;
            case 3:
                return $this->getObjId();
                break;
            case 4:
                return $this->getPrice();
                break;
            case 5:
                return $this->getUsrIdBuyer();
                break;
            case 6:
                return $this->getUsrIdSeller();
                break;
            case 7:
                return $this->getPoiId();
                break;
            case 8:
                return $this->getFunId();
                break;
            case 9:
                return $this->getIp();
                break;
            case 10:
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
        if (isset($alreadyDumpedObjects['Purchase'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Purchase'][$this->getPrimaryKey()] = true;
        $keys = PurchasePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getDate(),
            $keys[2] => $this->getType(),
            $keys[3] => $this->getObjId(),
            $keys[4] => $this->getPrice(),
            $keys[5] => $this->getUsrIdBuyer(),
            $keys[6] => $this->getUsrIdSeller(),
            $keys[7] => $this->getPoiId(),
            $keys[8] => $this->getFunId(),
            $keys[9] => $this->getIp(),
            $keys[10] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aItem) {
                $result['Item'] = $this->aItem->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByUsrIdBuyer) {
                $result['UserRelatedByUsrIdBuyer'] = $this->aUserRelatedByUsrIdBuyer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByUsrIdSeller) {
                $result['UserRelatedByUsrIdSeller'] = $this->aUserRelatedByUsrIdSeller->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
        $pos = PurchasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setType($value);
                break;
            case 3:
                $this->setObjId($value);
                break;
            case 4:
                $this->setPrice($value);
                break;
            case 5:
                $this->setUsrIdBuyer($value);
                break;
            case 6:
                $this->setUsrIdSeller($value);
                break;
            case 7:
                $this->setPoiId($value);
                break;
            case 8:
                $this->setFunId($value);
                break;
            case 9:
                $this->setIp($value);
                break;
            case 10:
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
        $keys = PurchasePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setDate($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setType($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setObjId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPrice($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setUsrIdBuyer($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUsrIdSeller($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setPoiId($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setFunId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setIp($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setRemoved($arr[$keys[10]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PurchasePeer::DATABASE_NAME);

        if ($this->isColumnModified(PurchasePeer::PUR_ID)) $criteria->add(PurchasePeer::PUR_ID, $this->pur_id);
        if ($this->isColumnModified(PurchasePeer::PUR_DATE)) $criteria->add(PurchasePeer::PUR_DATE, $this->pur_date);
        if ($this->isColumnModified(PurchasePeer::PUR_TYPE)) $criteria->add(PurchasePeer::PUR_TYPE, $this->pur_type);
        if ($this->isColumnModified(PurchasePeer::OBJ_ID)) $criteria->add(PurchasePeer::OBJ_ID, $this->obj_id);
        if ($this->isColumnModified(PurchasePeer::PUR_PRICE)) $criteria->add(PurchasePeer::PUR_PRICE, $this->pur_price);
        if ($this->isColumnModified(PurchasePeer::USR_ID_BUYER)) $criteria->add(PurchasePeer::USR_ID_BUYER, $this->usr_id_buyer);
        if ($this->isColumnModified(PurchasePeer::USR_ID_SELLER)) $criteria->add(PurchasePeer::USR_ID_SELLER, $this->usr_id_seller);
        if ($this->isColumnModified(PurchasePeer::POI_ID)) $criteria->add(PurchasePeer::POI_ID, $this->poi_id);
        if ($this->isColumnModified(PurchasePeer::FUN_ID)) $criteria->add(PurchasePeer::FUN_ID, $this->fun_id);
        if ($this->isColumnModified(PurchasePeer::PUR_IP)) $criteria->add(PurchasePeer::PUR_IP, $this->pur_ip);
        if ($this->isColumnModified(PurchasePeer::PUR_REMOVED)) $criteria->add(PurchasePeer::PUR_REMOVED, $this->pur_removed);

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
        $criteria = new Criteria(PurchasePeer::DATABASE_NAME);
        $criteria->add(PurchasePeer::PUR_ID, $this->pur_id);

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
     * Generic method to set the primary key (pur_id column).
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
     * @param object $copyObj An object of Purchase (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDate($this->getDate());
        $copyObj->setType($this->getType());
        $copyObj->setObjId($this->getObjId());
        $copyObj->setPrice($this->getPrice());
        $copyObj->setUsrIdBuyer($this->getUsrIdBuyer());
        $copyObj->setUsrIdSeller($this->getUsrIdSeller());
        $copyObj->setPoiId($this->getPoiId());
        $copyObj->setFunId($this->getFunId());
        $copyObj->setIp($this->getIp());
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
     * @return Purchase Clone of current object.
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
     * @return PurchasePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PurchasePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Item object.
     *
     * @param             Item $v
     * @return Purchase The current object (for fluent API support)
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
            $v->addPurchase($this);
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
                $this->aItem->addPurchases($this);
             */
        }

        return $this->aItem;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return Purchase The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByUsrIdBuyer(User $v = null)
    {
        if ($v === null) {
            $this->setUsrIdBuyer(NULL);
        } else {
            $this->setUsrIdBuyer($v->getId());
        }

        $this->aUserRelatedByUsrIdBuyer = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addPurchaseRelatedByUsrIdBuyer($this);
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
    public function getUserRelatedByUsrIdBuyer(PropelPDO $con = null)
    {
        if ($this->aUserRelatedByUsrIdBuyer === null && ($this->usr_id_buyer !== null)) {
            $this->aUserRelatedByUsrIdBuyer = UserQuery::create()->findPk($this->usr_id_buyer, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByUsrIdBuyer->addPurchasesRelatedByUsrIdBuyer($this);
             */
        }

        return $this->aUserRelatedByUsrIdBuyer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return Purchase The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByUsrIdSeller(User $v = null)
    {
        if ($v === null) {
            $this->setUsrIdSeller(NULL);
        } else {
            $this->setUsrIdSeller($v->getId());
        }

        $this->aUserRelatedByUsrIdSeller = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addPurchaseRelatedByUsrIdSeller($this);
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
    public function getUserRelatedByUsrIdSeller(PropelPDO $con = null)
    {
        if ($this->aUserRelatedByUsrIdSeller === null && ($this->usr_id_seller !== null)) {
            $this->aUserRelatedByUsrIdSeller = UserQuery::create()->findPk($this->usr_id_seller, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByUsrIdSeller->addPurchasesRelatedByUsrIdSeller($this);
             */
        }

        return $this->aUserRelatedByUsrIdSeller;
    }

    /**
     * Declares an association between this object and a Point object.
     *
     * @param             Point $v
     * @return Purchase The current object (for fluent API support)
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
            $v->addPurchase($this);
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
                $this->aPoint->addPurchases($this);
             */
        }

        return $this->aPoint;
    }

    /**
     * Declares an association between this object and a Fundation object.
     *
     * @param             Fundation $v
     * @return Purchase The current object (for fluent API support)
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
            $v->addPurchase($this);
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
                $this->aFundation->addPurchases($this);
             */
        }

        return $this->aFundation;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->pur_id = null;
        $this->pur_date = null;
        $this->pur_type = null;
        $this->obj_id = null;
        $this->pur_price = null;
        $this->usr_id_buyer = null;
        $this->usr_id_seller = null;
        $this->poi_id = null;
        $this->fun_id = null;
        $this->pur_ip = null;
        $this->pur_removed = null;
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
        $this->aUserRelatedByUsrIdBuyer = null;
        $this->aUserRelatedByUsrIdSeller = null;
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
        return (string) $this->exportTo(PurchasePeer::DEFAULT_STRING_FORMAT);
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
