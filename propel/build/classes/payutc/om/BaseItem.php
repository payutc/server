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
use Payutc\Image;
use Payutc\ImageQuery;
use Payutc\Item;
use Payutc\ItemPeer;
use Payutc\ItemQuery;
use Payutc\JObjPoi;
use Payutc\JObjPoiQuery;
use Payutc\JObjectLink;
use Payutc\JObjectLinkQuery;
use Payutc\Point;
use Payutc\PointQuery;
use Payutc\Price;
use Payutc\PriceQuery;
use Payutc\Purchase;
use Payutc\PurchaseQuery;
use Payutc\Sale;
use Payutc\SaleQuery;

/**
 * Base class that represents a row from the 't_object_obj' table.
 *
 *
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseItem extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Payutc\\ItemPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ItemPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the obj_id field.
     * @var        int
     */
    protected $obj_id;

    /**
     * The value for the obj_name field.
     * @var        string
     */
    protected $obj_name;

    /**
     * The value for the obj_type field.
     * @var        string
     */
    protected $obj_type;

    /**
     * The value for the obj_stock field.
     * @var        int
     */
    protected $obj_stock;

    /**
     * The value for the obj_single field.
     * @var        boolean
     */
    protected $obj_single;

    /**
     * The value for the obj_tva field.
     * @var        int
     */
    protected $obj_tva;

    /**
     * The value for the obj_alcool field.
     * @var        int
     */
    protected $obj_alcool;

    /**
     * The value for the img_id field.
     * @var        int
     */
    protected $img_id;

    /**
     * The value for the fun_id field.
     * @var        int
     */
    protected $fun_id;

    /**
     * The value for the obj_removed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $obj_removed;

    /**
     * @var        Fundation
     */
    protected $aFundation;

    /**
     * @var        Image
     */
    protected $aImage;

    /**
     * @var        PropelObjectCollection|Price[] Collection to store aggregation of Price objects.
     */
    protected $collPrices;
    protected $collPricesPartial;

    /**
     * @var        PropelObjectCollection|Purchase[] Collection to store aggregation of Purchase objects.
     */
    protected $collPurchases;
    protected $collPurchasesPartial;

    /**
     * @var        PropelObjectCollection|Sale[] Collection to store aggregation of Sale objects.
     */
    protected $collSales;
    protected $collSalesPartial;

    /**
     * @var        PropelObjectCollection|JObjPoi[] Collection to store aggregation of JObjPoi objects.
     */
    protected $collJObjPois;
    protected $collJObjPoisPartial;

    /**
     * @var        PropelObjectCollection|JObjectLink[] Collection to store aggregation of JObjectLink objects.
     */
    protected $collJObjectLinksRelatedByIdChild;
    protected $collJObjectLinksRelatedByIdChildPartial;

    /**
     * @var        PropelObjectCollection|JObjectLink[] Collection to store aggregation of JObjectLink objects.
     */
    protected $collJObjectLinksRelatedByIdParent;
    protected $collJObjectLinksRelatedByIdParentPartial;

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
    protected $pointsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $pricesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $purchasesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $salesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $jObjPoisScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $jObjectLinksRelatedByIdChildScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $jObjectLinksRelatedByIdParentScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->obj_removed = false;
    }

    /**
     * Initializes internal state of BaseItem object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [obj_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->obj_id;
    }

    /**
     * Get the [obj_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->obj_name;
    }

    /**
     * Get the [obj_type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->obj_type;
    }

    /**
     * Get the [obj_stock] column value.
     *
     * @return int
     */
    public function getStock()
    {
        return $this->obj_stock;
    }

    /**
     * Get the [obj_single] column value.
     *
     * @return boolean
     */
    public function getSingle()
    {
        return $this->obj_single;
    }

    /**
     * Get the [obj_tva] column value.
     *
     * @return int
     */
    public function getTva()
    {
        return $this->obj_tva;
    }

    /**
     * Get the [obj_alcool] column value.
     *
     * @return int
     */
    public function getAlcool()
    {
        return $this->obj_alcool;
    }

    /**
     * Get the [img_id] column value.
     *
     * @return int
     */
    public function getImgId()
    {
        return $this->img_id;
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
     * Get the [obj_removed] column value.
     *
     * @return boolean
     */
    public function getRemoved()
    {
        return $this->obj_removed;
    }

    /**
     * Set the value of [obj_id] column.
     *
     * @param int $v new value
     * @return Item The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_id !== $v) {
            $this->obj_id = $v;
            $this->modifiedColumns[] = ItemPeer::OBJ_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [obj_name] column.
     *
     * @param string $v new value
     * @return Item The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->obj_name !== $v) {
            $this->obj_name = $v;
            $this->modifiedColumns[] = ItemPeer::OBJ_NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [obj_type] column.
     *
     * @param string $v new value
     * @return Item The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->obj_type !== $v) {
            $this->obj_type = $v;
            $this->modifiedColumns[] = ItemPeer::OBJ_TYPE;
        }


        return $this;
    } // setType()

    /**
     * Set the value of [obj_stock] column.
     *
     * @param int $v new value
     * @return Item The current object (for fluent API support)
     */
    public function setStock($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_stock !== $v) {
            $this->obj_stock = $v;
            $this->modifiedColumns[] = ItemPeer::OBJ_STOCK;
        }


        return $this;
    } // setStock()

    /**
     * Sets the value of the [obj_single] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Item The current object (for fluent API support)
     */
    public function setSingle($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->obj_single !== $v) {
            $this->obj_single = $v;
            $this->modifiedColumns[] = ItemPeer::OBJ_SINGLE;
        }


        return $this;
    } // setSingle()

    /**
     * Set the value of [obj_tva] column.
     *
     * @param int $v new value
     * @return Item The current object (for fluent API support)
     */
    public function setTva($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_tva !== $v) {
            $this->obj_tva = $v;
            $this->modifiedColumns[] = ItemPeer::OBJ_TVA;
        }


        return $this;
    } // setTva()

    /**
     * Set the value of [obj_alcool] column.
     *
     * @param int $v new value
     * @return Item The current object (for fluent API support)
     */
    public function setAlcool($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_alcool !== $v) {
            $this->obj_alcool = $v;
            $this->modifiedColumns[] = ItemPeer::OBJ_ALCOOL;
        }


        return $this;
    } // setAlcool()

    /**
     * Set the value of [img_id] column.
     *
     * @param int $v new value
     * @return Item The current object (for fluent API support)
     */
    public function setImgId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->img_id !== $v) {
            $this->img_id = $v;
            $this->modifiedColumns[] = ItemPeer::IMG_ID;
        }

        if ($this->aImage !== null && $this->aImage->getId() !== $v) {
            $this->aImage = null;
        }


        return $this;
    } // setImgId()

    /**
     * Set the value of [fun_id] column.
     *
     * @param int $v new value
     * @return Item The current object (for fluent API support)
     */
    public function setFunId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fun_id !== $v) {
            $this->fun_id = $v;
            $this->modifiedColumns[] = ItemPeer::FUN_ID;
        }

        if ($this->aFundation !== null && $this->aFundation->getId() !== $v) {
            $this->aFundation = null;
        }


        return $this;
    } // setFunId()

    /**
     * Sets the value of the [obj_removed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Item The current object (for fluent API support)
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

        if ($this->obj_removed !== $v) {
            $this->obj_removed = $v;
            $this->modifiedColumns[] = ItemPeer::OBJ_REMOVED;
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
            if ($this->obj_removed !== false) {
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

            $this->obj_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->obj_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->obj_type = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->obj_stock = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->obj_single = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->obj_tva = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->obj_alcool = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->img_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->fun_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->obj_removed = ($row[$startcol + 9] !== null) ? (boolean) $row[$startcol + 9] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = ItemPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Item object", $e);
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

        if ($this->aImage !== null && $this->img_id !== $this->aImage->getId()) {
            $this->aImage = null;
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
            $con = Propel::getConnection(ItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ItemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFundation = null;
            $this->aImage = null;
            $this->collPrices = null;

            $this->collPurchases = null;

            $this->collSales = null;

            $this->collJObjPois = null;

            $this->collJObjectLinksRelatedByIdChild = null;

            $this->collJObjectLinksRelatedByIdParent = null;

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
            $con = Propel::getConnection(ItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ItemQuery::create()
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
            $con = Propel::getConnection(ItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ItemPeer::addInstanceToPool($this);
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

            if ($this->aImage !== null) {
                if ($this->aImage->isModified() || $this->aImage->isNew()) {
                    $affectedRows += $this->aImage->save($con);
                }
                $this->setImage($this->aImage);
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

            if ($this->pointsScheduledForDeletion !== null) {
                if (!$this->pointsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->pointsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    JObjPoiQuery::create()
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

            if ($this->pricesScheduledForDeletion !== null) {
                if (!$this->pricesScheduledForDeletion->isEmpty()) {
                    PriceQuery::create()
                        ->filterByPrimaryKeys($this->pricesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->salesScheduledForDeletion !== null) {
                if (!$this->salesScheduledForDeletion->isEmpty()) {
                    SaleQuery::create()
                        ->filterByPrimaryKeys($this->salesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->salesScheduledForDeletion = null;
                }
            }

            if ($this->collSales !== null) {
                foreach ($this->collSales as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->jObjPoisScheduledForDeletion !== null) {
                if (!$this->jObjPoisScheduledForDeletion->isEmpty()) {
                    JObjPoiQuery::create()
                        ->filterByPrimaryKeys($this->jObjPoisScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jObjPoisScheduledForDeletion = null;
                }
            }

            if ($this->collJObjPois !== null) {
                foreach ($this->collJObjPois as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->jObjectLinksRelatedByIdChildScheduledForDeletion !== null) {
                if (!$this->jObjectLinksRelatedByIdChildScheduledForDeletion->isEmpty()) {
                    JObjectLinkQuery::create()
                        ->filterByPrimaryKeys($this->jObjectLinksRelatedByIdChildScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jObjectLinksRelatedByIdChildScheduledForDeletion = null;
                }
            }

            if ($this->collJObjectLinksRelatedByIdChild !== null) {
                foreach ($this->collJObjectLinksRelatedByIdChild as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->jObjectLinksRelatedByIdParentScheduledForDeletion !== null) {
                if (!$this->jObjectLinksRelatedByIdParentScheduledForDeletion->isEmpty()) {
                    JObjectLinkQuery::create()
                        ->filterByPrimaryKeys($this->jObjectLinksRelatedByIdParentScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jObjectLinksRelatedByIdParentScheduledForDeletion = null;
                }
            }

            if ($this->collJObjectLinksRelatedByIdParent !== null) {
                foreach ($this->collJObjectLinksRelatedByIdParent as $referrerFK) {
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

        $this->modifiedColumns[] = ItemPeer::OBJ_ID;
        if (null !== $this->obj_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ItemPeer::OBJ_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ItemPeer::OBJ_ID)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_ID`';
        }
        if ($this->isColumnModified(ItemPeer::OBJ_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_NAME`';
        }
        if ($this->isColumnModified(ItemPeer::OBJ_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_TYPE`';
        }
        if ($this->isColumnModified(ItemPeer::OBJ_STOCK)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_STOCK`';
        }
        if ($this->isColumnModified(ItemPeer::OBJ_SINGLE)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_SINGLE`';
        }
        if ($this->isColumnModified(ItemPeer::OBJ_TVA)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_TVA`';
        }
        if ($this->isColumnModified(ItemPeer::OBJ_ALCOOL)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_ALCOOL`';
        }
        if ($this->isColumnModified(ItemPeer::IMG_ID)) {
            $modifiedColumns[':p' . $index++]  = '`IMG_ID`';
        }
        if ($this->isColumnModified(ItemPeer::FUN_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_ID`';
        }
        if ($this->isColumnModified(ItemPeer::OBJ_REMOVED)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_REMOVED`';
        }

        $sql = sprintf(
            'INSERT INTO `t_object_obj` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`OBJ_ID`':
                        $stmt->bindValue($identifier, $this->obj_id, PDO::PARAM_INT);
                        break;
                    case '`OBJ_NAME`':
                        $stmt->bindValue($identifier, $this->obj_name, PDO::PARAM_STR);
                        break;
                    case '`OBJ_TYPE`':
                        $stmt->bindValue($identifier, $this->obj_type, PDO::PARAM_STR);
                        break;
                    case '`OBJ_STOCK`':
                        $stmt->bindValue($identifier, $this->obj_stock, PDO::PARAM_INT);
                        break;
                    case '`OBJ_SINGLE`':
                        $stmt->bindValue($identifier, (int) $this->obj_single, PDO::PARAM_INT);
                        break;
                    case '`OBJ_TVA`':
                        $stmt->bindValue($identifier, $this->obj_tva, PDO::PARAM_INT);
                        break;
                    case '`OBJ_ALCOOL`':
                        $stmt->bindValue($identifier, $this->obj_alcool, PDO::PARAM_INT);
                        break;
                    case '`IMG_ID`':
                        $stmt->bindValue($identifier, $this->img_id, PDO::PARAM_INT);
                        break;
                    case '`FUN_ID`':
                        $stmt->bindValue($identifier, $this->fun_id, PDO::PARAM_INT);
                        break;
                    case '`OBJ_REMOVED`':
                        $stmt->bindValue($identifier, (int) $this->obj_removed, PDO::PARAM_INT);
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

            if ($this->aImage !== null) {
                if (!$this->aImage->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aImage->getValidationFailures());
                }
            }


            if (($retval = ItemPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPrices !== null) {
                    foreach ($this->collPrices as $referrerFK) {
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

                if ($this->collSales !== null) {
                    foreach ($this->collSales as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collJObjPois !== null) {
                    foreach ($this->collJObjPois as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collJObjectLinksRelatedByIdChild !== null) {
                    foreach ($this->collJObjectLinksRelatedByIdChild as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collJObjectLinksRelatedByIdParent !== null) {
                    foreach ($this->collJObjectLinksRelatedByIdParent as $referrerFK) {
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
        $pos = ItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getType();
                break;
            case 3:
                return $this->getStock();
                break;
            case 4:
                return $this->getSingle();
                break;
            case 5:
                return $this->getTva();
                break;
            case 6:
                return $this->getAlcool();
                break;
            case 7:
                return $this->getImgId();
                break;
            case 8:
                return $this->getFunId();
                break;
            case 9:
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
        if (isset($alreadyDumpedObjects['Item'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Item'][$this->getPrimaryKey()] = true;
        $keys = ItemPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getType(),
            $keys[3] => $this->getStock(),
            $keys[4] => $this->getSingle(),
            $keys[5] => $this->getTva(),
            $keys[6] => $this->getAlcool(),
            $keys[7] => $this->getImgId(),
            $keys[8] => $this->getFunId(),
            $keys[9] => $this->getRemoved(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aFundation) {
                $result['Fundation'] = $this->aFundation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aImage) {
                $result['Image'] = $this->aImage->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPrices) {
                $result['Prices'] = $this->collPrices->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPurchases) {
                $result['Purchases'] = $this->collPurchases->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSales) {
                $result['Sales'] = $this->collSales->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collJObjPois) {
                $result['JObjPois'] = $this->collJObjPois->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collJObjectLinksRelatedByIdChild) {
                $result['JObjectLinksRelatedByIdChild'] = $this->collJObjectLinksRelatedByIdChild->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collJObjectLinksRelatedByIdParent) {
                $result['JObjectLinksRelatedByIdParent'] = $this->collJObjectLinksRelatedByIdParent->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setType($value);
                break;
            case 3:
                $this->setStock($value);
                break;
            case 4:
                $this->setSingle($value);
                break;
            case 5:
                $this->setTva($value);
                break;
            case 6:
                $this->setAlcool($value);
                break;
            case 7:
                $this->setImgId($value);
                break;
            case 8:
                $this->setFunId($value);
                break;
            case 9:
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
        $keys = ItemPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setType($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setStock($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setSingle($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setTva($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setAlcool($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setImgId($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setFunId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setRemoved($arr[$keys[9]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ItemPeer::DATABASE_NAME);

        if ($this->isColumnModified(ItemPeer::OBJ_ID)) $criteria->add(ItemPeer::OBJ_ID, $this->obj_id);
        if ($this->isColumnModified(ItemPeer::OBJ_NAME)) $criteria->add(ItemPeer::OBJ_NAME, $this->obj_name);
        if ($this->isColumnModified(ItemPeer::OBJ_TYPE)) $criteria->add(ItemPeer::OBJ_TYPE, $this->obj_type);
        if ($this->isColumnModified(ItemPeer::OBJ_STOCK)) $criteria->add(ItemPeer::OBJ_STOCK, $this->obj_stock);
        if ($this->isColumnModified(ItemPeer::OBJ_SINGLE)) $criteria->add(ItemPeer::OBJ_SINGLE, $this->obj_single);
        if ($this->isColumnModified(ItemPeer::OBJ_TVA)) $criteria->add(ItemPeer::OBJ_TVA, $this->obj_tva);
        if ($this->isColumnModified(ItemPeer::OBJ_ALCOOL)) $criteria->add(ItemPeer::OBJ_ALCOOL, $this->obj_alcool);
        if ($this->isColumnModified(ItemPeer::IMG_ID)) $criteria->add(ItemPeer::IMG_ID, $this->img_id);
        if ($this->isColumnModified(ItemPeer::FUN_ID)) $criteria->add(ItemPeer::FUN_ID, $this->fun_id);
        if ($this->isColumnModified(ItemPeer::OBJ_REMOVED)) $criteria->add(ItemPeer::OBJ_REMOVED, $this->obj_removed);

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
        $criteria = new Criteria(ItemPeer::DATABASE_NAME);
        $criteria->add(ItemPeer::OBJ_ID, $this->obj_id);

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
     * Generic method to set the primary key (obj_id column).
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
     * @param object $copyObj An object of Item (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setType($this->getType());
        $copyObj->setStock($this->getStock());
        $copyObj->setSingle($this->getSingle());
        $copyObj->setTva($this->getTva());
        $copyObj->setAlcool($this->getAlcool());
        $copyObj->setImgId($this->getImgId());
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

            foreach ($this->getPurchases() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPurchase($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSales() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSale($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getJObjPois() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJObjPoi($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getJObjectLinksRelatedByIdChild() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJObjectLinkRelatedByIdChild($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getJObjectLinksRelatedByIdParent() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJObjectLinkRelatedByIdParent($relObj->copy($deepCopy));
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
     * @return Item Clone of current object.
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
     * @return ItemPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ItemPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Fundation object.
     *
     * @param             Fundation $v
     * @return Item The current object (for fluent API support)
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
            $v->addItem($this);
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
                $this->aFundation->addItems($this);
             */
        }

        return $this->aFundation;
    }

    /**
     * Declares an association between this object and a Image object.
     *
     * @param             Image $v
     * @return Item The current object (for fluent API support)
     * @throws PropelException
     */
    public function setImage(Image $v = null)
    {
        if ($v === null) {
            $this->setImgId(NULL);
        } else {
            $this->setImgId($v->getId());
        }

        $this->aImage = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Image object, it will not be re-added.
        if ($v !== null) {
            $v->addItem($this);
        }


        return $this;
    }


    /**
     * Get the associated Image object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Image The associated Image object.
     * @throws PropelException
     */
    public function getImage(PropelPDO $con = null)
    {
        if ($this->aImage === null && ($this->img_id !== null)) {
            $this->aImage = ImageQuery::create()->findPk($this->img_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aImage->addItems($this);
             */
        }

        return $this->aImage;
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
        if ('Purchase' == $relationName) {
            $this->initPurchases();
        }
        if ('Sale' == $relationName) {
            $this->initSales();
        }
        if ('JObjPoi' == $relationName) {
            $this->initJObjPois();
        }
        if ('JObjectLinkRelatedByIdChild' == $relationName) {
            $this->initJObjectLinksRelatedByIdChild();
        }
        if ('JObjectLinkRelatedByIdParent' == $relationName) {
            $this->initJObjectLinksRelatedByIdParent();
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
     * If this Item is new, it will return
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
                    ->filterByItem($this)
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
            $priceRemoved->setItem(null);
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
                    ->filterByItem($this)
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
     * @return Item The current object (for fluent API support)
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
        $price->setItem($this);
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
            $price->setItem(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related Prices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
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
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related Prices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Price[] List of Price objects
     */
    public function getPricesJoinGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PriceQuery::create(null, $criteria);
        $query->joinWith('Group', $join_behavior);

        return $this->getPrices($query, $con);
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
     * If this Item is new, it will return
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
                    ->filterByItem($this)
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
            $purchaseRemoved->setItem(null);
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
                    ->filterByItem($this)
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
     * @return Item The current object (for fluent API support)
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
        $purchase->setItem($this);
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
            $purchase->setItem(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related Purchases from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
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
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related Purchases from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
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
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related Purchases from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related Purchases from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     */
    public function getPurchasesJoinFundation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PurchaseQuery::create(null, $criteria);
        $query->joinWith('Fundation', $join_behavior);

        return $this->getPurchases($query, $con);
    }

    /**
     * Clears out the collSales collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSales()
     */
    public function clearSales()
    {
        $this->collSales = null; // important to set this to null since that means it is uninitialized
        $this->collSalesPartial = null;
    }

    /**
     * reset is the collSales collection loaded partially
     *
     * @return void
     */
    public function resetPartialSales($v = true)
    {
        $this->collSalesPartial = $v;
    }

    /**
     * Initializes the collSales collection.
     *
     * By default this just sets the collSales collection to an empty array (like clearcollSales());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSales($overrideExisting = true)
    {
        if (null !== $this->collSales && !$overrideExisting) {
            return;
        }
        $this->collSales = new PropelObjectCollection();
        $this->collSales->setModel('Sale');
    }

    /**
     * Gets an array of Sale objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Item is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Sale[] List of Sale objects
     * @throws PropelException
     */
    public function getSales($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collSalesPartial && !$this->isNew();
        if (null === $this->collSales || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSales) {
                // return empty collection
                $this->initSales();
            } else {
                $collSales = SaleQuery::create(null, $criteria)
                    ->filterByItem($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collSalesPartial && count($collSales)) {
                      $this->initSales(false);

                      foreach($collSales as $obj) {
                        if (false == $this->collSales->contains($obj)) {
                          $this->collSales->append($obj);
                        }
                      }

                      $this->collSalesPartial = true;
                    }

                    return $collSales;
                }

                if($partial && $this->collSales) {
                    foreach($this->collSales as $obj) {
                        if($obj->isNew()) {
                            $collSales[] = $obj;
                        }
                    }
                }

                $this->collSales = $collSales;
                $this->collSalesPartial = false;
            }
        }

        return $this->collSales;
    }

    /**
     * Sets a collection of Sale objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $sales A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setSales(PropelCollection $sales, PropelPDO $con = null)
    {
        $this->salesScheduledForDeletion = $this->getSales(new Criteria(), $con)->diff($sales);

        foreach ($this->salesScheduledForDeletion as $saleRemoved) {
            $saleRemoved->setItem(null);
        }

        $this->collSales = null;
        foreach ($sales as $sale) {
            $this->addSale($sale);
        }

        $this->collSales = $sales;
        $this->collSalesPartial = false;
    }

    /**
     * Returns the number of related Sale objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Sale objects.
     * @throws PropelException
     */
    public function countSales(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collSalesPartial && !$this->isNew();
        if (null === $this->collSales || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSales) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getSales());
                }
                $query = SaleQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByItem($this)
                    ->count($con);
            }
        } else {
            return count($this->collSales);
        }
    }

    /**
     * Method called to associate a Sale object to this object
     * through the Sale foreign key attribute.
     *
     * @param    Sale $l Sale
     * @return Item The current object (for fluent API support)
     */
    public function addSale(Sale $l)
    {
        if ($this->collSales === null) {
            $this->initSales();
            $this->collSalesPartial = true;
        }
        if (!in_array($l, $this->collSales->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddSale($l);
        }

        return $this;
    }

    /**
     * @param	Sale $sale The sale object to add.
     */
    protected function doAddSale($sale)
    {
        $this->collSales[]= $sale;
        $sale->setItem($this);
    }

    /**
     * @param	Sale $sale The sale object to remove.
     */
    public function removeSale($sale)
    {
        if ($this->getSales()->contains($sale)) {
            $this->collSales->remove($this->collSales->search($sale));
            if (null === $this->salesScheduledForDeletion) {
                $this->salesScheduledForDeletion = clone $this->collSales;
                $this->salesScheduledForDeletion->clear();
            }
            $this->salesScheduledForDeletion[]= $sale;
            $sale->setItem(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related Sales from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Sale[] List of Sale objects
     */
    public function getSalesJoinPeriod($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SaleQuery::create(null, $criteria);
        $query->joinWith('Period', $join_behavior);

        return $this->getSales($query, $con);
    }

    /**
     * Clears out the collJObjPois collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJObjPois()
     */
    public function clearJObjPois()
    {
        $this->collJObjPois = null; // important to set this to null since that means it is uninitialized
        $this->collJObjPoisPartial = null;
    }

    /**
     * reset is the collJObjPois collection loaded partially
     *
     * @return void
     */
    public function resetPartialJObjPois($v = true)
    {
        $this->collJObjPoisPartial = $v;
    }

    /**
     * Initializes the collJObjPois collection.
     *
     * By default this just sets the collJObjPois collection to an empty array (like clearcollJObjPois());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJObjPois($overrideExisting = true)
    {
        if (null !== $this->collJObjPois && !$overrideExisting) {
            return;
        }
        $this->collJObjPois = new PropelObjectCollection();
        $this->collJObjPois->setModel('JObjPoi');
    }

    /**
     * Gets an array of JObjPoi objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Item is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|JObjPoi[] List of JObjPoi objects
     * @throws PropelException
     */
    public function getJObjPois($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collJObjPoisPartial && !$this->isNew();
        if (null === $this->collJObjPois || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJObjPois) {
                // return empty collection
                $this->initJObjPois();
            } else {
                $collJObjPois = JObjPoiQuery::create(null, $criteria)
                    ->filterByItem($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collJObjPoisPartial && count($collJObjPois)) {
                      $this->initJObjPois(false);

                      foreach($collJObjPois as $obj) {
                        if (false == $this->collJObjPois->contains($obj)) {
                          $this->collJObjPois->append($obj);
                        }
                      }

                      $this->collJObjPoisPartial = true;
                    }

                    return $collJObjPois;
                }

                if($partial && $this->collJObjPois) {
                    foreach($this->collJObjPois as $obj) {
                        if($obj->isNew()) {
                            $collJObjPois[] = $obj;
                        }
                    }
                }

                $this->collJObjPois = $collJObjPois;
                $this->collJObjPoisPartial = false;
            }
        }

        return $this->collJObjPois;
    }

    /**
     * Sets a collection of JObjPoi objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $jObjPois A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setJObjPois(PropelCollection $jObjPois, PropelPDO $con = null)
    {
        $this->jObjPoisScheduledForDeletion = $this->getJObjPois(new Criteria(), $con)->diff($jObjPois);

        foreach ($this->jObjPoisScheduledForDeletion as $jObjPoiRemoved) {
            $jObjPoiRemoved->setItem(null);
        }

        $this->collJObjPois = null;
        foreach ($jObjPois as $jObjPoi) {
            $this->addJObjPoi($jObjPoi);
        }

        $this->collJObjPois = $jObjPois;
        $this->collJObjPoisPartial = false;
    }

    /**
     * Returns the number of related JObjPoi objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related JObjPoi objects.
     * @throws PropelException
     */
    public function countJObjPois(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collJObjPoisPartial && !$this->isNew();
        if (null === $this->collJObjPois || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJObjPois) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getJObjPois());
                }
                $query = JObjPoiQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByItem($this)
                    ->count($con);
            }
        } else {
            return count($this->collJObjPois);
        }
    }

    /**
     * Method called to associate a JObjPoi object to this object
     * through the JObjPoi foreign key attribute.
     *
     * @param    JObjPoi $l JObjPoi
     * @return Item The current object (for fluent API support)
     */
    public function addJObjPoi(JObjPoi $l)
    {
        if ($this->collJObjPois === null) {
            $this->initJObjPois();
            $this->collJObjPoisPartial = true;
        }
        if (!in_array($l, $this->collJObjPois->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddJObjPoi($l);
        }

        return $this;
    }

    /**
     * @param	JObjPoi $jObjPoi The jObjPoi object to add.
     */
    protected function doAddJObjPoi($jObjPoi)
    {
        $this->collJObjPois[]= $jObjPoi;
        $jObjPoi->setItem($this);
    }

    /**
     * @param	JObjPoi $jObjPoi The jObjPoi object to remove.
     */
    public function removeJObjPoi($jObjPoi)
    {
        if ($this->getJObjPois()->contains($jObjPoi)) {
            $this->collJObjPois->remove($this->collJObjPois->search($jObjPoi));
            if (null === $this->jObjPoisScheduledForDeletion) {
                $this->jObjPoisScheduledForDeletion = clone $this->collJObjPois;
                $this->jObjPoisScheduledForDeletion->clear();
            }
            $this->jObjPoisScheduledForDeletion[]= $jObjPoi;
            $jObjPoi->setItem(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Item is new, it will return
     * an empty collection; or if this Item has previously
     * been saved, it will retrieve related JObjPois from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Item.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|JObjPoi[] List of JObjPoi objects
     */
    public function getJObjPoisJoinPoint($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = JObjPoiQuery::create(null, $criteria);
        $query->joinWith('Point', $join_behavior);

        return $this->getJObjPois($query, $con);
    }

    /**
     * Clears out the collJObjectLinksRelatedByIdChild collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJObjectLinksRelatedByIdChild()
     */
    public function clearJObjectLinksRelatedByIdChild()
    {
        $this->collJObjectLinksRelatedByIdChild = null; // important to set this to null since that means it is uninitialized
        $this->collJObjectLinksRelatedByIdChildPartial = null;
    }

    /**
     * reset is the collJObjectLinksRelatedByIdChild collection loaded partially
     *
     * @return void
     */
    public function resetPartialJObjectLinksRelatedByIdChild($v = true)
    {
        $this->collJObjectLinksRelatedByIdChildPartial = $v;
    }

    /**
     * Initializes the collJObjectLinksRelatedByIdChild collection.
     *
     * By default this just sets the collJObjectLinksRelatedByIdChild collection to an empty array (like clearcollJObjectLinksRelatedByIdChild());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJObjectLinksRelatedByIdChild($overrideExisting = true)
    {
        if (null !== $this->collJObjectLinksRelatedByIdChild && !$overrideExisting) {
            return;
        }
        $this->collJObjectLinksRelatedByIdChild = new PropelObjectCollection();
        $this->collJObjectLinksRelatedByIdChild->setModel('JObjectLink');
    }

    /**
     * Gets an array of JObjectLink objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Item is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|JObjectLink[] List of JObjectLink objects
     * @throws PropelException
     */
    public function getJObjectLinksRelatedByIdChild($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collJObjectLinksRelatedByIdChildPartial && !$this->isNew();
        if (null === $this->collJObjectLinksRelatedByIdChild || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJObjectLinksRelatedByIdChild) {
                // return empty collection
                $this->initJObjectLinksRelatedByIdChild();
            } else {
                $collJObjectLinksRelatedByIdChild = JObjectLinkQuery::create(null, $criteria)
                    ->filterByItemRelatedByIdChild($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collJObjectLinksRelatedByIdChildPartial && count($collJObjectLinksRelatedByIdChild)) {
                      $this->initJObjectLinksRelatedByIdChild(false);

                      foreach($collJObjectLinksRelatedByIdChild as $obj) {
                        if (false == $this->collJObjectLinksRelatedByIdChild->contains($obj)) {
                          $this->collJObjectLinksRelatedByIdChild->append($obj);
                        }
                      }

                      $this->collJObjectLinksRelatedByIdChildPartial = true;
                    }

                    return $collJObjectLinksRelatedByIdChild;
                }

                if($partial && $this->collJObjectLinksRelatedByIdChild) {
                    foreach($this->collJObjectLinksRelatedByIdChild as $obj) {
                        if($obj->isNew()) {
                            $collJObjectLinksRelatedByIdChild[] = $obj;
                        }
                    }
                }

                $this->collJObjectLinksRelatedByIdChild = $collJObjectLinksRelatedByIdChild;
                $this->collJObjectLinksRelatedByIdChildPartial = false;
            }
        }

        return $this->collJObjectLinksRelatedByIdChild;
    }

    /**
     * Sets a collection of JObjectLinkRelatedByIdChild objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $jObjectLinksRelatedByIdChild A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setJObjectLinksRelatedByIdChild(PropelCollection $jObjectLinksRelatedByIdChild, PropelPDO $con = null)
    {
        $this->jObjectLinksRelatedByIdChildScheduledForDeletion = $this->getJObjectLinksRelatedByIdChild(new Criteria(), $con)->diff($jObjectLinksRelatedByIdChild);

        foreach ($this->jObjectLinksRelatedByIdChildScheduledForDeletion as $jObjectLinkRelatedByIdChildRemoved) {
            $jObjectLinkRelatedByIdChildRemoved->setItemRelatedByIdChild(null);
        }

        $this->collJObjectLinksRelatedByIdChild = null;
        foreach ($jObjectLinksRelatedByIdChild as $jObjectLinkRelatedByIdChild) {
            $this->addJObjectLinkRelatedByIdChild($jObjectLinkRelatedByIdChild);
        }

        $this->collJObjectLinksRelatedByIdChild = $jObjectLinksRelatedByIdChild;
        $this->collJObjectLinksRelatedByIdChildPartial = false;
    }

    /**
     * Returns the number of related JObjectLink objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related JObjectLink objects.
     * @throws PropelException
     */
    public function countJObjectLinksRelatedByIdChild(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collJObjectLinksRelatedByIdChildPartial && !$this->isNew();
        if (null === $this->collJObjectLinksRelatedByIdChild || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJObjectLinksRelatedByIdChild) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getJObjectLinksRelatedByIdChild());
                }
                $query = JObjectLinkQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByItemRelatedByIdChild($this)
                    ->count($con);
            }
        } else {
            return count($this->collJObjectLinksRelatedByIdChild);
        }
    }

    /**
     * Method called to associate a JObjectLink object to this object
     * through the JObjectLink foreign key attribute.
     *
     * @param    JObjectLink $l JObjectLink
     * @return Item The current object (for fluent API support)
     */
    public function addJObjectLinkRelatedByIdChild(JObjectLink $l)
    {
        if ($this->collJObjectLinksRelatedByIdChild === null) {
            $this->initJObjectLinksRelatedByIdChild();
            $this->collJObjectLinksRelatedByIdChildPartial = true;
        }
        if (!in_array($l, $this->collJObjectLinksRelatedByIdChild->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddJObjectLinkRelatedByIdChild($l);
        }

        return $this;
    }

    /**
     * @param	JObjectLinkRelatedByIdChild $jObjectLinkRelatedByIdChild The jObjectLinkRelatedByIdChild object to add.
     */
    protected function doAddJObjectLinkRelatedByIdChild($jObjectLinkRelatedByIdChild)
    {
        $this->collJObjectLinksRelatedByIdChild[]= $jObjectLinkRelatedByIdChild;
        $jObjectLinkRelatedByIdChild->setItemRelatedByIdChild($this);
    }

    /**
     * @param	JObjectLinkRelatedByIdChild $jObjectLinkRelatedByIdChild The jObjectLinkRelatedByIdChild object to remove.
     */
    public function removeJObjectLinkRelatedByIdChild($jObjectLinkRelatedByIdChild)
    {
        if ($this->getJObjectLinksRelatedByIdChild()->contains($jObjectLinkRelatedByIdChild)) {
            $this->collJObjectLinksRelatedByIdChild->remove($this->collJObjectLinksRelatedByIdChild->search($jObjectLinkRelatedByIdChild));
            if (null === $this->jObjectLinksRelatedByIdChildScheduledForDeletion) {
                $this->jObjectLinksRelatedByIdChildScheduledForDeletion = clone $this->collJObjectLinksRelatedByIdChild;
                $this->jObjectLinksRelatedByIdChildScheduledForDeletion->clear();
            }
            $this->jObjectLinksRelatedByIdChildScheduledForDeletion[]= $jObjectLinkRelatedByIdChild;
            $jObjectLinkRelatedByIdChild->setItemRelatedByIdChild(null);
        }
    }

    /**
     * Clears out the collJObjectLinksRelatedByIdParent collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJObjectLinksRelatedByIdParent()
     */
    public function clearJObjectLinksRelatedByIdParent()
    {
        $this->collJObjectLinksRelatedByIdParent = null; // important to set this to null since that means it is uninitialized
        $this->collJObjectLinksRelatedByIdParentPartial = null;
    }

    /**
     * reset is the collJObjectLinksRelatedByIdParent collection loaded partially
     *
     * @return void
     */
    public function resetPartialJObjectLinksRelatedByIdParent($v = true)
    {
        $this->collJObjectLinksRelatedByIdParentPartial = $v;
    }

    /**
     * Initializes the collJObjectLinksRelatedByIdParent collection.
     *
     * By default this just sets the collJObjectLinksRelatedByIdParent collection to an empty array (like clearcollJObjectLinksRelatedByIdParent());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJObjectLinksRelatedByIdParent($overrideExisting = true)
    {
        if (null !== $this->collJObjectLinksRelatedByIdParent && !$overrideExisting) {
            return;
        }
        $this->collJObjectLinksRelatedByIdParent = new PropelObjectCollection();
        $this->collJObjectLinksRelatedByIdParent->setModel('JObjectLink');
    }

    /**
     * Gets an array of JObjectLink objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Item is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|JObjectLink[] List of JObjectLink objects
     * @throws PropelException
     */
    public function getJObjectLinksRelatedByIdParent($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collJObjectLinksRelatedByIdParentPartial && !$this->isNew();
        if (null === $this->collJObjectLinksRelatedByIdParent || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJObjectLinksRelatedByIdParent) {
                // return empty collection
                $this->initJObjectLinksRelatedByIdParent();
            } else {
                $collJObjectLinksRelatedByIdParent = JObjectLinkQuery::create(null, $criteria)
                    ->filterByItemRelatedByIdParent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collJObjectLinksRelatedByIdParentPartial && count($collJObjectLinksRelatedByIdParent)) {
                      $this->initJObjectLinksRelatedByIdParent(false);

                      foreach($collJObjectLinksRelatedByIdParent as $obj) {
                        if (false == $this->collJObjectLinksRelatedByIdParent->contains($obj)) {
                          $this->collJObjectLinksRelatedByIdParent->append($obj);
                        }
                      }

                      $this->collJObjectLinksRelatedByIdParentPartial = true;
                    }

                    return $collJObjectLinksRelatedByIdParent;
                }

                if($partial && $this->collJObjectLinksRelatedByIdParent) {
                    foreach($this->collJObjectLinksRelatedByIdParent as $obj) {
                        if($obj->isNew()) {
                            $collJObjectLinksRelatedByIdParent[] = $obj;
                        }
                    }
                }

                $this->collJObjectLinksRelatedByIdParent = $collJObjectLinksRelatedByIdParent;
                $this->collJObjectLinksRelatedByIdParentPartial = false;
            }
        }

        return $this->collJObjectLinksRelatedByIdParent;
    }

    /**
     * Sets a collection of JObjectLinkRelatedByIdParent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $jObjectLinksRelatedByIdParent A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setJObjectLinksRelatedByIdParent(PropelCollection $jObjectLinksRelatedByIdParent, PropelPDO $con = null)
    {
        $this->jObjectLinksRelatedByIdParentScheduledForDeletion = $this->getJObjectLinksRelatedByIdParent(new Criteria(), $con)->diff($jObjectLinksRelatedByIdParent);

        foreach ($this->jObjectLinksRelatedByIdParentScheduledForDeletion as $jObjectLinkRelatedByIdParentRemoved) {
            $jObjectLinkRelatedByIdParentRemoved->setItemRelatedByIdParent(null);
        }

        $this->collJObjectLinksRelatedByIdParent = null;
        foreach ($jObjectLinksRelatedByIdParent as $jObjectLinkRelatedByIdParent) {
            $this->addJObjectLinkRelatedByIdParent($jObjectLinkRelatedByIdParent);
        }

        $this->collJObjectLinksRelatedByIdParent = $jObjectLinksRelatedByIdParent;
        $this->collJObjectLinksRelatedByIdParentPartial = false;
    }

    /**
     * Returns the number of related JObjectLink objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related JObjectLink objects.
     * @throws PropelException
     */
    public function countJObjectLinksRelatedByIdParent(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collJObjectLinksRelatedByIdParentPartial && !$this->isNew();
        if (null === $this->collJObjectLinksRelatedByIdParent || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJObjectLinksRelatedByIdParent) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getJObjectLinksRelatedByIdParent());
                }
                $query = JObjectLinkQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByItemRelatedByIdParent($this)
                    ->count($con);
            }
        } else {
            return count($this->collJObjectLinksRelatedByIdParent);
        }
    }

    /**
     * Method called to associate a JObjectLink object to this object
     * through the JObjectLink foreign key attribute.
     *
     * @param    JObjectLink $l JObjectLink
     * @return Item The current object (for fluent API support)
     */
    public function addJObjectLinkRelatedByIdParent(JObjectLink $l)
    {
        if ($this->collJObjectLinksRelatedByIdParent === null) {
            $this->initJObjectLinksRelatedByIdParent();
            $this->collJObjectLinksRelatedByIdParentPartial = true;
        }
        if (!in_array($l, $this->collJObjectLinksRelatedByIdParent->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddJObjectLinkRelatedByIdParent($l);
        }

        return $this;
    }

    /**
     * @param	JObjectLinkRelatedByIdParent $jObjectLinkRelatedByIdParent The jObjectLinkRelatedByIdParent object to add.
     */
    protected function doAddJObjectLinkRelatedByIdParent($jObjectLinkRelatedByIdParent)
    {
        $this->collJObjectLinksRelatedByIdParent[]= $jObjectLinkRelatedByIdParent;
        $jObjectLinkRelatedByIdParent->setItemRelatedByIdParent($this);
    }

    /**
     * @param	JObjectLinkRelatedByIdParent $jObjectLinkRelatedByIdParent The jObjectLinkRelatedByIdParent object to remove.
     */
    public function removeJObjectLinkRelatedByIdParent($jObjectLinkRelatedByIdParent)
    {
        if ($this->getJObjectLinksRelatedByIdParent()->contains($jObjectLinkRelatedByIdParent)) {
            $this->collJObjectLinksRelatedByIdParent->remove($this->collJObjectLinksRelatedByIdParent->search($jObjectLinkRelatedByIdParent));
            if (null === $this->jObjectLinksRelatedByIdParentScheduledForDeletion) {
                $this->jObjectLinksRelatedByIdParentScheduledForDeletion = clone $this->collJObjectLinksRelatedByIdParent;
                $this->jObjectLinksRelatedByIdParentScheduledForDeletion->clear();
            }
            $this->jObjectLinksRelatedByIdParentScheduledForDeletion[]= $jObjectLinkRelatedByIdParent;
            $jObjectLinkRelatedByIdParent->setItemRelatedByIdParent(null);
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
     * to the current object by way of the tj_obj_poi_jop cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Item is new, it will return
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
                    ->filterByItem($this)
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
     * to the current object by way of the tj_obj_poi_jop cross-reference table.
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
     * to the current object by way of the tj_obj_poi_jop cross-reference table.
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
                    ->filterByItem($this)
                    ->count($con);
            }
        } else {
            return count($this->collPoints);
        }
    }

    /**
     * Associate a Point object to this object
     * through the tj_obj_poi_jop cross reference table.
     *
     * @param  Point $point The JObjPoi object to relate
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
        $jObjPoi = new JObjPoi();
        $jObjPoi->setPoint($point);
        $this->addJObjPoi($jObjPoi);
    }

    /**
     * Remove a Point object to this object
     * through the tj_obj_poi_jop cross reference table.
     *
     * @param Point $point The JObjPoi object to relate
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
        $this->obj_id = null;
        $this->obj_name = null;
        $this->obj_type = null;
        $this->obj_stock = null;
        $this->obj_single = null;
        $this->obj_tva = null;
        $this->obj_alcool = null;
        $this->img_id = null;
        $this->fun_id = null;
        $this->obj_removed = null;
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
            if ($this->collPurchases) {
                foreach ($this->collPurchases as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSales) {
                foreach ($this->collSales as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJObjPois) {
                foreach ($this->collJObjPois as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJObjectLinksRelatedByIdChild) {
                foreach ($this->collJObjectLinksRelatedByIdChild as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJObjectLinksRelatedByIdParent) {
                foreach ($this->collJObjectLinksRelatedByIdParent as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPoints) {
                foreach ($this->collPoints as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collPrices instanceof PropelCollection) {
            $this->collPrices->clearIterator();
        }
        $this->collPrices = null;
        if ($this->collPurchases instanceof PropelCollection) {
            $this->collPurchases->clearIterator();
        }
        $this->collPurchases = null;
        if ($this->collSales instanceof PropelCollection) {
            $this->collSales->clearIterator();
        }
        $this->collSales = null;
        if ($this->collJObjPois instanceof PropelCollection) {
            $this->collJObjPois->clearIterator();
        }
        $this->collJObjPois = null;
        if ($this->collJObjectLinksRelatedByIdChild instanceof PropelCollection) {
            $this->collJObjectLinksRelatedByIdChild->clearIterator();
        }
        $this->collJObjectLinksRelatedByIdChild = null;
        if ($this->collJObjectLinksRelatedByIdParent instanceof PropelCollection) {
            $this->collJObjectLinksRelatedByIdParent->clearIterator();
        }
        $this->collJObjectLinksRelatedByIdParent = null;
        if ($this->collPoints instanceof PropelCollection) {
            $this->collPoints->clearIterator();
        }
        $this->collPoints = null;
        $this->aFundation = null;
        $this->aImage = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ItemPeer::DEFAULT_STRING_FORMAT);
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
