<?php


/**
 * Base class that represents a row from the 't_object_obj' table.
 *
 *
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTObjectObj extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TObjectObjPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TObjectObjPeer
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
     * @var        TFundationFun
     */
    protected $aTFundationFun;

    /**
     * @var        TsImageImg
     */
    protected $aTsImageImg;

    /**
     * @var        PropelObjectCollection|TPricePri[] Collection to store aggregation of TPricePri objects.
     */
    protected $collTPricePris;
    protected $collTPricePrisPartial;

    /**
     * @var        PropelObjectCollection|TPurchasePur[] Collection to store aggregation of TPurchasePur objects.
     */
    protected $collTPurchasePurs;
    protected $collTPurchasePursPartial;

    /**
     * @var        PropelObjectCollection|TSaleSal[] Collection to store aggregation of TSaleSal objects.
     */
    protected $collTSaleSals;
    protected $collTSaleSalsPartial;

    /**
     * @var        PropelObjectCollection|TjObjPoiJop[] Collection to store aggregation of TjObjPoiJop objects.
     */
    protected $collTjObjPoiJops;
    protected $collTjObjPoiJopsPartial;

    /**
     * @var        PropelObjectCollection|TjObjectLinkOli[] Collection to store aggregation of TjObjectLinkOli objects.
     */
    protected $collTjObjectLinkOlisRelatedByObjIdChild;
    protected $collTjObjectLinkOlisRelatedByObjIdChildPartial;

    /**
     * @var        PropelObjectCollection|TjObjectLinkOli[] Collection to store aggregation of TjObjectLinkOli objects.
     */
    protected $collTjObjectLinkOlisRelatedByObjIdParent;
    protected $collTjObjectLinkOlisRelatedByObjIdParentPartial;

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
    protected $tPricePrisScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tPurchasePursScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tSaleSalsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tjObjPoiJopsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tjObjectLinkOlisRelatedByObjIdChildScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tjObjectLinkOlisRelatedByObjIdParentScheduledForDeletion = null;

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
     * Initializes internal state of BaseTObjectObj object.
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
     * @return TObjectObj The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_id !== $v) {
            $this->obj_id = $v;
            $this->modifiedColumns[] = TObjectObjPeer::OBJ_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [obj_name] column.
     *
     * @param string $v new value
     * @return TObjectObj The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->obj_name !== $v) {
            $this->obj_name = $v;
            $this->modifiedColumns[] = TObjectObjPeer::OBJ_NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [obj_type] column.
     *
     * @param string $v new value
     * @return TObjectObj The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->obj_type !== $v) {
            $this->obj_type = $v;
            $this->modifiedColumns[] = TObjectObjPeer::OBJ_TYPE;
        }


        return $this;
    } // setType()

    /**
     * Set the value of [obj_stock] column.
     *
     * @param int $v new value
     * @return TObjectObj The current object (for fluent API support)
     */
    public function setStock($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_stock !== $v) {
            $this->obj_stock = $v;
            $this->modifiedColumns[] = TObjectObjPeer::OBJ_STOCK;
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
     * @return TObjectObj The current object (for fluent API support)
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
            $this->modifiedColumns[] = TObjectObjPeer::OBJ_SINGLE;
        }


        return $this;
    } // setSingle()

    /**
     * Set the value of [obj_tva] column.
     *
     * @param int $v new value
     * @return TObjectObj The current object (for fluent API support)
     */
    public function setTva($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_tva !== $v) {
            $this->obj_tva = $v;
            $this->modifiedColumns[] = TObjectObjPeer::OBJ_TVA;
        }


        return $this;
    } // setTva()

    /**
     * Set the value of [obj_alcool] column.
     *
     * @param int $v new value
     * @return TObjectObj The current object (for fluent API support)
     */
    public function setAlcool($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->obj_alcool !== $v) {
            $this->obj_alcool = $v;
            $this->modifiedColumns[] = TObjectObjPeer::OBJ_ALCOOL;
        }


        return $this;
    } // setAlcool()

    /**
     * Set the value of [img_id] column.
     *
     * @param int $v new value
     * @return TObjectObj The current object (for fluent API support)
     */
    public function setImgId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->img_id !== $v) {
            $this->img_id = $v;
            $this->modifiedColumns[] = TObjectObjPeer::IMG_ID;
        }

        if ($this->aTsImageImg !== null && $this->aTsImageImg->getId() !== $v) {
            $this->aTsImageImg = null;
        }


        return $this;
    } // setImgId()

    /**
     * Set the value of [fun_id] column.
     *
     * @param int $v new value
     * @return TObjectObj The current object (for fluent API support)
     */
    public function setFunId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fun_id !== $v) {
            $this->fun_id = $v;
            $this->modifiedColumns[] = TObjectObjPeer::FUN_ID;
        }

        if ($this->aTFundationFun !== null && $this->aTFundationFun->getId() !== $v) {
            $this->aTFundationFun = null;
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
     * @return TObjectObj The current object (for fluent API support)
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
            $this->modifiedColumns[] = TObjectObjPeer::OBJ_REMOVED;
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

            return $startcol + 10; // 10 = TObjectObjPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating TObjectObj object", $e);
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

        if ($this->aTsImageImg !== null && $this->img_id !== $this->aTsImageImg->getId()) {
            $this->aTsImageImg = null;
        }
        if ($this->aTFundationFun !== null && $this->fun_id !== $this->aTFundationFun->getId()) {
            $this->aTFundationFun = null;
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
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TObjectObjPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTFundationFun = null;
            $this->aTsImageImg = null;
            $this->collTPricePris = null;

            $this->collTPurchasePurs = null;

            $this->collTSaleSals = null;

            $this->collTjObjPoiJops = null;

            $this->collTjObjectLinkOlisRelatedByObjIdChild = null;

            $this->collTjObjectLinkOlisRelatedByObjIdParent = null;

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
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TObjectObjQuery::create()
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
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TObjectObjPeer::addInstanceToPool($this);
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

            if ($this->aTFundationFun !== null) {
                if ($this->aTFundationFun->isModified() || $this->aTFundationFun->isNew()) {
                    $affectedRows += $this->aTFundationFun->save($con);
                }
                $this->setTFundationFun($this->aTFundationFun);
            }

            if ($this->aTsImageImg !== null) {
                if ($this->aTsImageImg->isModified() || $this->aTsImageImg->isNew()) {
                    $affectedRows += $this->aTsImageImg->save($con);
                }
                $this->setTsImageImg($this->aTsImageImg);
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

            if ($this->tPricePrisScheduledForDeletion !== null) {
                if (!$this->tPricePrisScheduledForDeletion->isEmpty()) {
                    TPricePriQuery::create()
                        ->filterByPrimaryKeys($this->tPricePrisScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tPricePrisScheduledForDeletion = null;
                }
            }

            if ($this->collTPricePris !== null) {
                foreach ($this->collTPricePris as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tPurchasePursScheduledForDeletion !== null) {
                if (!$this->tPurchasePursScheduledForDeletion->isEmpty()) {
                    TPurchasePurQuery::create()
                        ->filterByPrimaryKeys($this->tPurchasePursScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tPurchasePursScheduledForDeletion = null;
                }
            }

            if ($this->collTPurchasePurs !== null) {
                foreach ($this->collTPurchasePurs as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tSaleSalsScheduledForDeletion !== null) {
                if (!$this->tSaleSalsScheduledForDeletion->isEmpty()) {
                    TSaleSalQuery::create()
                        ->filterByPrimaryKeys($this->tSaleSalsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tSaleSalsScheduledForDeletion = null;
                }
            }

            if ($this->collTSaleSals !== null) {
                foreach ($this->collTSaleSals as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tjObjPoiJopsScheduledForDeletion !== null) {
                if (!$this->tjObjPoiJopsScheduledForDeletion->isEmpty()) {
                    TjObjPoiJopQuery::create()
                        ->filterByPrimaryKeys($this->tjObjPoiJopsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tjObjPoiJopsScheduledForDeletion = null;
                }
            }

            if ($this->collTjObjPoiJops !== null) {
                foreach ($this->collTjObjPoiJops as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tjObjectLinkOlisRelatedByObjIdChildScheduledForDeletion !== null) {
                if (!$this->tjObjectLinkOlisRelatedByObjIdChildScheduledForDeletion->isEmpty()) {
                    TjObjectLinkOliQuery::create()
                        ->filterByPrimaryKeys($this->tjObjectLinkOlisRelatedByObjIdChildScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tjObjectLinkOlisRelatedByObjIdChildScheduledForDeletion = null;
                }
            }

            if ($this->collTjObjectLinkOlisRelatedByObjIdChild !== null) {
                foreach ($this->collTjObjectLinkOlisRelatedByObjIdChild as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tjObjectLinkOlisRelatedByObjIdParentScheduledForDeletion !== null) {
                if (!$this->tjObjectLinkOlisRelatedByObjIdParentScheduledForDeletion->isEmpty()) {
                    TjObjectLinkOliQuery::create()
                        ->filterByPrimaryKeys($this->tjObjectLinkOlisRelatedByObjIdParentScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tjObjectLinkOlisRelatedByObjIdParentScheduledForDeletion = null;
                }
            }

            if ($this->collTjObjectLinkOlisRelatedByObjIdParent !== null) {
                foreach ($this->collTjObjectLinkOlisRelatedByObjIdParent as $referrerFK) {
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

        $this->modifiedColumns[] = TObjectObjPeer::OBJ_ID;
        if (null !== $this->obj_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TObjectObjPeer::OBJ_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TObjectObjPeer::OBJ_ID)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_ID`';
        }
        if ($this->isColumnModified(TObjectObjPeer::OBJ_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_NAME`';
        }
        if ($this->isColumnModified(TObjectObjPeer::OBJ_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_TYPE`';
        }
        if ($this->isColumnModified(TObjectObjPeer::OBJ_STOCK)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_STOCK`';
        }
        if ($this->isColumnModified(TObjectObjPeer::OBJ_SINGLE)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_SINGLE`';
        }
        if ($this->isColumnModified(TObjectObjPeer::OBJ_TVA)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_TVA`';
        }
        if ($this->isColumnModified(TObjectObjPeer::OBJ_ALCOOL)) {
            $modifiedColumns[':p' . $index++]  = '`OBJ_ALCOOL`';
        }
        if ($this->isColumnModified(TObjectObjPeer::IMG_ID)) {
            $modifiedColumns[':p' . $index++]  = '`IMG_ID`';
        }
        if ($this->isColumnModified(TObjectObjPeer::FUN_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FUN_ID`';
        }
        if ($this->isColumnModified(TObjectObjPeer::OBJ_REMOVED)) {
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

            if ($this->aTFundationFun !== null) {
                if (!$this->aTFundationFun->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTFundationFun->getValidationFailures());
                }
            }

            if ($this->aTsImageImg !== null) {
                if (!$this->aTsImageImg->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTsImageImg->getValidationFailures());
                }
            }


            if (($retval = TObjectObjPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collTPricePris !== null) {
                    foreach ($this->collTPricePris as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTPurchasePurs !== null) {
                    foreach ($this->collTPurchasePurs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTSaleSals !== null) {
                    foreach ($this->collTSaleSals as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTjObjPoiJops !== null) {
                    foreach ($this->collTjObjPoiJops as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTjObjectLinkOlisRelatedByObjIdChild !== null) {
                    foreach ($this->collTjObjectLinkOlisRelatedByObjIdChild as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTjObjectLinkOlisRelatedByObjIdParent !== null) {
                    foreach ($this->collTjObjectLinkOlisRelatedByObjIdParent as $referrerFK) {
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
        $pos = TObjectObjPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['TObjectObj'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['TObjectObj'][$this->getPrimaryKey()] = true;
        $keys = TObjectObjPeer::getFieldNames($keyType);
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
            if (null !== $this->aTFundationFun) {
                $result['TFundationFun'] = $this->aTFundationFun->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTsImageImg) {
                $result['TsImageImg'] = $this->aTsImageImg->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collTPricePris) {
                $result['TPricePris'] = $this->collTPricePris->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTPurchasePurs) {
                $result['TPurchasePurs'] = $this->collTPurchasePurs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTSaleSals) {
                $result['TSaleSals'] = $this->collTSaleSals->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTjObjPoiJops) {
                $result['TjObjPoiJops'] = $this->collTjObjPoiJops->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTjObjectLinkOlisRelatedByObjIdChild) {
                $result['TjObjectLinkOlisRelatedByObjIdChild'] = $this->collTjObjectLinkOlisRelatedByObjIdChild->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTjObjectLinkOlisRelatedByObjIdParent) {
                $result['TjObjectLinkOlisRelatedByObjIdParent'] = $this->collTjObjectLinkOlisRelatedByObjIdParent->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TObjectObjPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
        $keys = TObjectObjPeer::getFieldNames($keyType);

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
        $criteria = new Criteria(TObjectObjPeer::DATABASE_NAME);

        if ($this->isColumnModified(TObjectObjPeer::OBJ_ID)) $criteria->add(TObjectObjPeer::OBJ_ID, $this->obj_id);
        if ($this->isColumnModified(TObjectObjPeer::OBJ_NAME)) $criteria->add(TObjectObjPeer::OBJ_NAME, $this->obj_name);
        if ($this->isColumnModified(TObjectObjPeer::OBJ_TYPE)) $criteria->add(TObjectObjPeer::OBJ_TYPE, $this->obj_type);
        if ($this->isColumnModified(TObjectObjPeer::OBJ_STOCK)) $criteria->add(TObjectObjPeer::OBJ_STOCK, $this->obj_stock);
        if ($this->isColumnModified(TObjectObjPeer::OBJ_SINGLE)) $criteria->add(TObjectObjPeer::OBJ_SINGLE, $this->obj_single);
        if ($this->isColumnModified(TObjectObjPeer::OBJ_TVA)) $criteria->add(TObjectObjPeer::OBJ_TVA, $this->obj_tva);
        if ($this->isColumnModified(TObjectObjPeer::OBJ_ALCOOL)) $criteria->add(TObjectObjPeer::OBJ_ALCOOL, $this->obj_alcool);
        if ($this->isColumnModified(TObjectObjPeer::IMG_ID)) $criteria->add(TObjectObjPeer::IMG_ID, $this->img_id);
        if ($this->isColumnModified(TObjectObjPeer::FUN_ID)) $criteria->add(TObjectObjPeer::FUN_ID, $this->fun_id);
        if ($this->isColumnModified(TObjectObjPeer::OBJ_REMOVED)) $criteria->add(TObjectObjPeer::OBJ_REMOVED, $this->obj_removed);

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
        $criteria = new Criteria(TObjectObjPeer::DATABASE_NAME);
        $criteria->add(TObjectObjPeer::OBJ_ID, $this->obj_id);

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
     * @param object $copyObj An object of TObjectObj (or compatible) type.
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

            foreach ($this->getTPricePris() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTPricePri($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTPurchasePurs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTPurchasePur($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTSaleSals() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTSaleSal($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTjObjPoiJops() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTjObjPoiJop($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTjObjectLinkOlisRelatedByObjIdChild() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTjObjectLinkOliRelatedByObjIdChild($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTjObjectLinkOlisRelatedByObjIdParent() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTjObjectLinkOliRelatedByObjIdParent($relObj->copy($deepCopy));
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
     * @return TObjectObj Clone of current object.
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
     * @return TObjectObjPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TObjectObjPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TFundationFun object.
     *
     * @param             TFundationFun $v
     * @return TObjectObj The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTFundationFun(TFundationFun $v = null)
    {
        if ($v === null) {
            $this->setFunId(NULL);
        } else {
            $this->setFunId($v->getId());
        }

        $this->aTFundationFun = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TFundationFun object, it will not be re-added.
        if ($v !== null) {
            $v->addTObjectObj($this);
        }


        return $this;
    }


    /**
     * Get the associated TFundationFun object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TFundationFun The associated TFundationFun object.
     * @throws PropelException
     */
    public function getTFundationFun(PropelPDO $con = null)
    {
        if ($this->aTFundationFun === null && ($this->fun_id !== null)) {
            $this->aTFundationFun = TFundationFunQuery::create()->findPk($this->fun_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTFundationFun->addTObjectObjs($this);
             */
        }

        return $this->aTFundationFun;
    }

    /**
     * Declares an association between this object and a TsImageImg object.
     *
     * @param             TsImageImg $v
     * @return TObjectObj The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTsImageImg(TsImageImg $v = null)
    {
        if ($v === null) {
            $this->setImgId(NULL);
        } else {
            $this->setImgId($v->getId());
        }

        $this->aTsImageImg = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TsImageImg object, it will not be re-added.
        if ($v !== null) {
            $v->addTObjectObj($this);
        }


        return $this;
    }


    /**
     * Get the associated TsImageImg object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return TsImageImg The associated TsImageImg object.
     * @throws PropelException
     */
    public function getTsImageImg(PropelPDO $con = null)
    {
        if ($this->aTsImageImg === null && ($this->img_id !== null)) {
            $this->aTsImageImg = TsImageImgQuery::create()->findPk($this->img_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTsImageImg->addTObjectObjs($this);
             */
        }

        return $this->aTsImageImg;
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
        if ('TPricePri' == $relationName) {
            $this->initTPricePris();
        }
        if ('TPurchasePur' == $relationName) {
            $this->initTPurchasePurs();
        }
        if ('TSaleSal' == $relationName) {
            $this->initTSaleSals();
        }
        if ('TjObjPoiJop' == $relationName) {
            $this->initTjObjPoiJops();
        }
        if ('TjObjectLinkOliRelatedByObjIdChild' == $relationName) {
            $this->initTjObjectLinkOlisRelatedByObjIdChild();
        }
        if ('TjObjectLinkOliRelatedByObjIdParent' == $relationName) {
            $this->initTjObjectLinkOlisRelatedByObjIdParent();
        }
    }

    /**
     * Clears out the collTPricePris collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTPricePris()
     */
    public function clearTPricePris()
    {
        $this->collTPricePris = null; // important to set this to null since that means it is uninitialized
        $this->collTPricePrisPartial = null;
    }

    /**
     * reset is the collTPricePris collection loaded partially
     *
     * @return void
     */
    public function resetPartialTPricePris($v = true)
    {
        $this->collTPricePrisPartial = $v;
    }

    /**
     * Initializes the collTPricePris collection.
     *
     * By default this just sets the collTPricePris collection to an empty array (like clearcollTPricePris());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTPricePris($overrideExisting = true)
    {
        if (null !== $this->collTPricePris && !$overrideExisting) {
            return;
        }
        $this->collTPricePris = new PropelObjectCollection();
        $this->collTPricePris->setModel('TPricePri');
    }

    /**
     * Gets an array of TPricePri objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TObjectObj is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TPricePri[] List of TPricePri objects
     * @throws PropelException
     */
    public function getTPricePris($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTPricePrisPartial && !$this->isNew();
        if (null === $this->collTPricePris || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTPricePris) {
                // return empty collection
                $this->initTPricePris();
            } else {
                $collTPricePris = TPricePriQuery::create(null, $criteria)
                    ->filterByTObjectObj($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTPricePrisPartial && count($collTPricePris)) {
                      $this->initTPricePris(false);

                      foreach($collTPricePris as $obj) {
                        if (false == $this->collTPricePris->contains($obj)) {
                          $this->collTPricePris->append($obj);
                        }
                      }

                      $this->collTPricePrisPartial = true;
                    }

                    return $collTPricePris;
                }

                if($partial && $this->collTPricePris) {
                    foreach($this->collTPricePris as $obj) {
                        if($obj->isNew()) {
                            $collTPricePris[] = $obj;
                        }
                    }
                }

                $this->collTPricePris = $collTPricePris;
                $this->collTPricePrisPartial = false;
            }
        }

        return $this->collTPricePris;
    }

    /**
     * Sets a collection of TPricePri objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tPricePris A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTPricePris(PropelCollection $tPricePris, PropelPDO $con = null)
    {
        $this->tPricePrisScheduledForDeletion = $this->getTPricePris(new Criteria(), $con)->diff($tPricePris);

        foreach ($this->tPricePrisScheduledForDeletion as $tPricePriRemoved) {
            $tPricePriRemoved->setTObjectObj(null);
        }

        $this->collTPricePris = null;
        foreach ($tPricePris as $tPricePri) {
            $this->addTPricePri($tPricePri);
        }

        $this->collTPricePris = $tPricePris;
        $this->collTPricePrisPartial = false;
    }

    /**
     * Returns the number of related TPricePri objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TPricePri objects.
     * @throws PropelException
     */
    public function countTPricePris(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTPricePrisPartial && !$this->isNew();
        if (null === $this->collTPricePris || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTPricePris) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTPricePris());
                }
                $query = TPricePriQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTObjectObj($this)
                    ->count($con);
            }
        } else {
            return count($this->collTPricePris);
        }
    }

    /**
     * Method called to associate a TPricePri object to this object
     * through the TPricePri foreign key attribute.
     *
     * @param    TPricePri $l TPricePri
     * @return TObjectObj The current object (for fluent API support)
     */
    public function addTPricePri(TPricePri $l)
    {
        if ($this->collTPricePris === null) {
            $this->initTPricePris();
            $this->collTPricePrisPartial = true;
        }
        if (!in_array($l, $this->collTPricePris->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTPricePri($l);
        }

        return $this;
    }

    /**
     * @param	TPricePri $tPricePri The tPricePri object to add.
     */
    protected function doAddTPricePri($tPricePri)
    {
        $this->collTPricePris[]= $tPricePri;
        $tPricePri->setTObjectObj($this);
    }

    /**
     * @param	TPricePri $tPricePri The tPricePri object to remove.
     */
    public function removeTPricePri($tPricePri)
    {
        if ($this->getTPricePris()->contains($tPricePri)) {
            $this->collTPricePris->remove($this->collTPricePris->search($tPricePri));
            if (null === $this->tPricePrisScheduledForDeletion) {
                $this->tPricePrisScheduledForDeletion = clone $this->collTPricePris;
                $this->tPricePrisScheduledForDeletion->clear();
            }
            $this->tPricePrisScheduledForDeletion[]= $tPricePri;
            $tPricePri->setTObjectObj(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TObjectObj is new, it will return
     * an empty collection; or if this TObjectObj has previously
     * been saved, it will retrieve related TPricePris from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TObjectObj.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPricePri[] List of TPricePri objects
     */
    public function getTPricePrisJoinTPeriodPer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPricePriQuery::create(null, $criteria);
        $query->joinWith('TPeriodPer', $join_behavior);

        return $this->getTPricePris($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TObjectObj is new, it will return
     * an empty collection; or if this TObjectObj has previously
     * been saved, it will retrieve related TPricePris from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TObjectObj.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPricePri[] List of TPricePri objects
     */
    public function getTPricePrisJoinTGroupGrp($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPricePriQuery::create(null, $criteria);
        $query->joinWith('TGroupGrp', $join_behavior);

        return $this->getTPricePris($query, $con);
    }

    /**
     * Clears out the collTPurchasePurs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTPurchasePurs()
     */
    public function clearTPurchasePurs()
    {
        $this->collTPurchasePurs = null; // important to set this to null since that means it is uninitialized
        $this->collTPurchasePursPartial = null;
    }

    /**
     * reset is the collTPurchasePurs collection loaded partially
     *
     * @return void
     */
    public function resetPartialTPurchasePurs($v = true)
    {
        $this->collTPurchasePursPartial = $v;
    }

    /**
     * Initializes the collTPurchasePurs collection.
     *
     * By default this just sets the collTPurchasePurs collection to an empty array (like clearcollTPurchasePurs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTPurchasePurs($overrideExisting = true)
    {
        if (null !== $this->collTPurchasePurs && !$overrideExisting) {
            return;
        }
        $this->collTPurchasePurs = new PropelObjectCollection();
        $this->collTPurchasePurs->setModel('TPurchasePur');
    }

    /**
     * Gets an array of TPurchasePur objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TObjectObj is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     * @throws PropelException
     */
    public function getTPurchasePurs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTPurchasePursPartial && !$this->isNew();
        if (null === $this->collTPurchasePurs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTPurchasePurs) {
                // return empty collection
                $this->initTPurchasePurs();
            } else {
                $collTPurchasePurs = TPurchasePurQuery::create(null, $criteria)
                    ->filterByTObjectObj($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTPurchasePursPartial && count($collTPurchasePurs)) {
                      $this->initTPurchasePurs(false);

                      foreach($collTPurchasePurs as $obj) {
                        if (false == $this->collTPurchasePurs->contains($obj)) {
                          $this->collTPurchasePurs->append($obj);
                        }
                      }

                      $this->collTPurchasePursPartial = true;
                    }

                    return $collTPurchasePurs;
                }

                if($partial && $this->collTPurchasePurs) {
                    foreach($this->collTPurchasePurs as $obj) {
                        if($obj->isNew()) {
                            $collTPurchasePurs[] = $obj;
                        }
                    }
                }

                $this->collTPurchasePurs = $collTPurchasePurs;
                $this->collTPurchasePursPartial = false;
            }
        }

        return $this->collTPurchasePurs;
    }

    /**
     * Sets a collection of TPurchasePur objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tPurchasePurs A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTPurchasePurs(PropelCollection $tPurchasePurs, PropelPDO $con = null)
    {
        $this->tPurchasePursScheduledForDeletion = $this->getTPurchasePurs(new Criteria(), $con)->diff($tPurchasePurs);

        foreach ($this->tPurchasePursScheduledForDeletion as $tPurchasePurRemoved) {
            $tPurchasePurRemoved->setTObjectObj(null);
        }

        $this->collTPurchasePurs = null;
        foreach ($tPurchasePurs as $tPurchasePur) {
            $this->addTPurchasePur($tPurchasePur);
        }

        $this->collTPurchasePurs = $tPurchasePurs;
        $this->collTPurchasePursPartial = false;
    }

    /**
     * Returns the number of related TPurchasePur objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TPurchasePur objects.
     * @throws PropelException
     */
    public function countTPurchasePurs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTPurchasePursPartial && !$this->isNew();
        if (null === $this->collTPurchasePurs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTPurchasePurs) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTPurchasePurs());
                }
                $query = TPurchasePurQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTObjectObj($this)
                    ->count($con);
            }
        } else {
            return count($this->collTPurchasePurs);
        }
    }

    /**
     * Method called to associate a TPurchasePur object to this object
     * through the TPurchasePur foreign key attribute.
     *
     * @param    TPurchasePur $l TPurchasePur
     * @return TObjectObj The current object (for fluent API support)
     */
    public function addTPurchasePur(TPurchasePur $l)
    {
        if ($this->collTPurchasePurs === null) {
            $this->initTPurchasePurs();
            $this->collTPurchasePursPartial = true;
        }
        if (!in_array($l, $this->collTPurchasePurs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTPurchasePur($l);
        }

        return $this;
    }

    /**
     * @param	TPurchasePur $tPurchasePur The tPurchasePur object to add.
     */
    protected function doAddTPurchasePur($tPurchasePur)
    {
        $this->collTPurchasePurs[]= $tPurchasePur;
        $tPurchasePur->setTObjectObj($this);
    }

    /**
     * @param	TPurchasePur $tPurchasePur The tPurchasePur object to remove.
     */
    public function removeTPurchasePur($tPurchasePur)
    {
        if ($this->getTPurchasePurs()->contains($tPurchasePur)) {
            $this->collTPurchasePurs->remove($this->collTPurchasePurs->search($tPurchasePur));
            if (null === $this->tPurchasePursScheduledForDeletion) {
                $this->tPurchasePursScheduledForDeletion = clone $this->collTPurchasePurs;
                $this->tPurchasePursScheduledForDeletion->clear();
            }
            $this->tPurchasePursScheduledForDeletion[]= $tPurchasePur;
            $tPurchasePur->setTObjectObj(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TObjectObj is new, it will return
     * an empty collection; or if this TObjectObj has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TObjectObj.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursJoinTsUserUsrRelatedByUsrIdBuyer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TsUserUsrRelatedByUsrIdBuyer', $join_behavior);

        return $this->getTPurchasePurs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TObjectObj is new, it will return
     * an empty collection; or if this TObjectObj has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TObjectObj.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursJoinTsUserUsrRelatedByUsrIdSeller($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TsUserUsrRelatedByUsrIdSeller', $join_behavior);

        return $this->getTPurchasePurs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TObjectObj is new, it will return
     * an empty collection; or if this TObjectObj has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TObjectObj.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursJoinTPointPoi($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TPointPoi', $join_behavior);

        return $this->getTPurchasePurs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TObjectObj is new, it will return
     * an empty collection; or if this TObjectObj has previously
     * been saved, it will retrieve related TPurchasePurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TObjectObj.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TPurchasePur[] List of TPurchasePur objects
     */
    public function getTPurchasePursJoinTFundationFun($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TPurchasePurQuery::create(null, $criteria);
        $query->joinWith('TFundationFun', $join_behavior);

        return $this->getTPurchasePurs($query, $con);
    }

    /**
     * Clears out the collTSaleSals collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTSaleSals()
     */
    public function clearTSaleSals()
    {
        $this->collTSaleSals = null; // important to set this to null since that means it is uninitialized
        $this->collTSaleSalsPartial = null;
    }

    /**
     * reset is the collTSaleSals collection loaded partially
     *
     * @return void
     */
    public function resetPartialTSaleSals($v = true)
    {
        $this->collTSaleSalsPartial = $v;
    }

    /**
     * Initializes the collTSaleSals collection.
     *
     * By default this just sets the collTSaleSals collection to an empty array (like clearcollTSaleSals());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTSaleSals($overrideExisting = true)
    {
        if (null !== $this->collTSaleSals && !$overrideExisting) {
            return;
        }
        $this->collTSaleSals = new PropelObjectCollection();
        $this->collTSaleSals->setModel('TSaleSal');
    }

    /**
     * Gets an array of TSaleSal objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TObjectObj is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TSaleSal[] List of TSaleSal objects
     * @throws PropelException
     */
    public function getTSaleSals($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTSaleSalsPartial && !$this->isNew();
        if (null === $this->collTSaleSals || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTSaleSals) {
                // return empty collection
                $this->initTSaleSals();
            } else {
                $collTSaleSals = TSaleSalQuery::create(null, $criteria)
                    ->filterByTObjectObj($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTSaleSalsPartial && count($collTSaleSals)) {
                      $this->initTSaleSals(false);

                      foreach($collTSaleSals as $obj) {
                        if (false == $this->collTSaleSals->contains($obj)) {
                          $this->collTSaleSals->append($obj);
                        }
                      }

                      $this->collTSaleSalsPartial = true;
                    }

                    return $collTSaleSals;
                }

                if($partial && $this->collTSaleSals) {
                    foreach($this->collTSaleSals as $obj) {
                        if($obj->isNew()) {
                            $collTSaleSals[] = $obj;
                        }
                    }
                }

                $this->collTSaleSals = $collTSaleSals;
                $this->collTSaleSalsPartial = false;
            }
        }

        return $this->collTSaleSals;
    }

    /**
     * Sets a collection of TSaleSal objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tSaleSals A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTSaleSals(PropelCollection $tSaleSals, PropelPDO $con = null)
    {
        $this->tSaleSalsScheduledForDeletion = $this->getTSaleSals(new Criteria(), $con)->diff($tSaleSals);

        foreach ($this->tSaleSalsScheduledForDeletion as $tSaleSalRemoved) {
            $tSaleSalRemoved->setTObjectObj(null);
        }

        $this->collTSaleSals = null;
        foreach ($tSaleSals as $tSaleSal) {
            $this->addTSaleSal($tSaleSal);
        }

        $this->collTSaleSals = $tSaleSals;
        $this->collTSaleSalsPartial = false;
    }

    /**
     * Returns the number of related TSaleSal objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TSaleSal objects.
     * @throws PropelException
     */
    public function countTSaleSals(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTSaleSalsPartial && !$this->isNew();
        if (null === $this->collTSaleSals || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTSaleSals) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTSaleSals());
                }
                $query = TSaleSalQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTObjectObj($this)
                    ->count($con);
            }
        } else {
            return count($this->collTSaleSals);
        }
    }

    /**
     * Method called to associate a TSaleSal object to this object
     * through the TSaleSal foreign key attribute.
     *
     * @param    TSaleSal $l TSaleSal
     * @return TObjectObj The current object (for fluent API support)
     */
    public function addTSaleSal(TSaleSal $l)
    {
        if ($this->collTSaleSals === null) {
            $this->initTSaleSals();
            $this->collTSaleSalsPartial = true;
        }
        if (!in_array($l, $this->collTSaleSals->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTSaleSal($l);
        }

        return $this;
    }

    /**
     * @param	TSaleSal $tSaleSal The tSaleSal object to add.
     */
    protected function doAddTSaleSal($tSaleSal)
    {
        $this->collTSaleSals[]= $tSaleSal;
        $tSaleSal->setTObjectObj($this);
    }

    /**
     * @param	TSaleSal $tSaleSal The tSaleSal object to remove.
     */
    public function removeTSaleSal($tSaleSal)
    {
        if ($this->getTSaleSals()->contains($tSaleSal)) {
            $this->collTSaleSals->remove($this->collTSaleSals->search($tSaleSal));
            if (null === $this->tSaleSalsScheduledForDeletion) {
                $this->tSaleSalsScheduledForDeletion = clone $this->collTSaleSals;
                $this->tSaleSalsScheduledForDeletion->clear();
            }
            $this->tSaleSalsScheduledForDeletion[]= $tSaleSal;
            $tSaleSal->setTObjectObj(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TObjectObj is new, it will return
     * an empty collection; or if this TObjectObj has previously
     * been saved, it will retrieve related TSaleSals from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TObjectObj.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TSaleSal[] List of TSaleSal objects
     */
    public function getTSaleSalsJoinTPeriodPer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TSaleSalQuery::create(null, $criteria);
        $query->joinWith('TPeriodPer', $join_behavior);

        return $this->getTSaleSals($query, $con);
    }

    /**
     * Clears out the collTjObjPoiJops collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTjObjPoiJops()
     */
    public function clearTjObjPoiJops()
    {
        $this->collTjObjPoiJops = null; // important to set this to null since that means it is uninitialized
        $this->collTjObjPoiJopsPartial = null;
    }

    /**
     * reset is the collTjObjPoiJops collection loaded partially
     *
     * @return void
     */
    public function resetPartialTjObjPoiJops($v = true)
    {
        $this->collTjObjPoiJopsPartial = $v;
    }

    /**
     * Initializes the collTjObjPoiJops collection.
     *
     * By default this just sets the collTjObjPoiJops collection to an empty array (like clearcollTjObjPoiJops());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTjObjPoiJops($overrideExisting = true)
    {
        if (null !== $this->collTjObjPoiJops && !$overrideExisting) {
            return;
        }
        $this->collTjObjPoiJops = new PropelObjectCollection();
        $this->collTjObjPoiJops->setModel('TjObjPoiJop');
    }

    /**
     * Gets an array of TjObjPoiJop objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TObjectObj is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TjObjPoiJop[] List of TjObjPoiJop objects
     * @throws PropelException
     */
    public function getTjObjPoiJops($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTjObjPoiJopsPartial && !$this->isNew();
        if (null === $this->collTjObjPoiJops || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTjObjPoiJops) {
                // return empty collection
                $this->initTjObjPoiJops();
            } else {
                $collTjObjPoiJops = TjObjPoiJopQuery::create(null, $criteria)
                    ->filterByTObjectObj($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTjObjPoiJopsPartial && count($collTjObjPoiJops)) {
                      $this->initTjObjPoiJops(false);

                      foreach($collTjObjPoiJops as $obj) {
                        if (false == $this->collTjObjPoiJops->contains($obj)) {
                          $this->collTjObjPoiJops->append($obj);
                        }
                      }

                      $this->collTjObjPoiJopsPartial = true;
                    }

                    return $collTjObjPoiJops;
                }

                if($partial && $this->collTjObjPoiJops) {
                    foreach($this->collTjObjPoiJops as $obj) {
                        if($obj->isNew()) {
                            $collTjObjPoiJops[] = $obj;
                        }
                    }
                }

                $this->collTjObjPoiJops = $collTjObjPoiJops;
                $this->collTjObjPoiJopsPartial = false;
            }
        }

        return $this->collTjObjPoiJops;
    }

    /**
     * Sets a collection of TjObjPoiJop objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tjObjPoiJops A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTjObjPoiJops(PropelCollection $tjObjPoiJops, PropelPDO $con = null)
    {
        $this->tjObjPoiJopsScheduledForDeletion = $this->getTjObjPoiJops(new Criteria(), $con)->diff($tjObjPoiJops);

        foreach ($this->tjObjPoiJopsScheduledForDeletion as $tjObjPoiJopRemoved) {
            $tjObjPoiJopRemoved->setTObjectObj(null);
        }

        $this->collTjObjPoiJops = null;
        foreach ($tjObjPoiJops as $tjObjPoiJop) {
            $this->addTjObjPoiJop($tjObjPoiJop);
        }

        $this->collTjObjPoiJops = $tjObjPoiJops;
        $this->collTjObjPoiJopsPartial = false;
    }

    /**
     * Returns the number of related TjObjPoiJop objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TjObjPoiJop objects.
     * @throws PropelException
     */
    public function countTjObjPoiJops(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTjObjPoiJopsPartial && !$this->isNew();
        if (null === $this->collTjObjPoiJops || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTjObjPoiJops) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTjObjPoiJops());
                }
                $query = TjObjPoiJopQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTObjectObj($this)
                    ->count($con);
            }
        } else {
            return count($this->collTjObjPoiJops);
        }
    }

    /**
     * Method called to associate a TjObjPoiJop object to this object
     * through the TjObjPoiJop foreign key attribute.
     *
     * @param    TjObjPoiJop $l TjObjPoiJop
     * @return TObjectObj The current object (for fluent API support)
     */
    public function addTjObjPoiJop(TjObjPoiJop $l)
    {
        if ($this->collTjObjPoiJops === null) {
            $this->initTjObjPoiJops();
            $this->collTjObjPoiJopsPartial = true;
        }
        if (!in_array($l, $this->collTjObjPoiJops->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTjObjPoiJop($l);
        }

        return $this;
    }

    /**
     * @param	TjObjPoiJop $tjObjPoiJop The tjObjPoiJop object to add.
     */
    protected function doAddTjObjPoiJop($tjObjPoiJop)
    {
        $this->collTjObjPoiJops[]= $tjObjPoiJop;
        $tjObjPoiJop->setTObjectObj($this);
    }

    /**
     * @param	TjObjPoiJop $tjObjPoiJop The tjObjPoiJop object to remove.
     */
    public function removeTjObjPoiJop($tjObjPoiJop)
    {
        if ($this->getTjObjPoiJops()->contains($tjObjPoiJop)) {
            $this->collTjObjPoiJops->remove($this->collTjObjPoiJops->search($tjObjPoiJop));
            if (null === $this->tjObjPoiJopsScheduledForDeletion) {
                $this->tjObjPoiJopsScheduledForDeletion = clone $this->collTjObjPoiJops;
                $this->tjObjPoiJopsScheduledForDeletion->clear();
            }
            $this->tjObjPoiJopsScheduledForDeletion[]= $tjObjPoiJop;
            $tjObjPoiJop->setTObjectObj(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this TObjectObj is new, it will return
     * an empty collection; or if this TObjectObj has previously
     * been saved, it will retrieve related TjObjPoiJops from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in TObjectObj.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TjObjPoiJop[] List of TjObjPoiJop objects
     */
    public function getTjObjPoiJopsJoinTPointPoi($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TjObjPoiJopQuery::create(null, $criteria);
        $query->joinWith('TPointPoi', $join_behavior);

        return $this->getTjObjPoiJops($query, $con);
    }

    /**
     * Clears out the collTjObjectLinkOlisRelatedByObjIdChild collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTjObjectLinkOlisRelatedByObjIdChild()
     */
    public function clearTjObjectLinkOlisRelatedByObjIdChild()
    {
        $this->collTjObjectLinkOlisRelatedByObjIdChild = null; // important to set this to null since that means it is uninitialized
        $this->collTjObjectLinkOlisRelatedByObjIdChildPartial = null;
    }

    /**
     * reset is the collTjObjectLinkOlisRelatedByObjIdChild collection loaded partially
     *
     * @return void
     */
    public function resetPartialTjObjectLinkOlisRelatedByObjIdChild($v = true)
    {
        $this->collTjObjectLinkOlisRelatedByObjIdChildPartial = $v;
    }

    /**
     * Initializes the collTjObjectLinkOlisRelatedByObjIdChild collection.
     *
     * By default this just sets the collTjObjectLinkOlisRelatedByObjIdChild collection to an empty array (like clearcollTjObjectLinkOlisRelatedByObjIdChild());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTjObjectLinkOlisRelatedByObjIdChild($overrideExisting = true)
    {
        if (null !== $this->collTjObjectLinkOlisRelatedByObjIdChild && !$overrideExisting) {
            return;
        }
        $this->collTjObjectLinkOlisRelatedByObjIdChild = new PropelObjectCollection();
        $this->collTjObjectLinkOlisRelatedByObjIdChild->setModel('TjObjectLinkOli');
    }

    /**
     * Gets an array of TjObjectLinkOli objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TObjectObj is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TjObjectLinkOli[] List of TjObjectLinkOli objects
     * @throws PropelException
     */
    public function getTjObjectLinkOlisRelatedByObjIdChild($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTjObjectLinkOlisRelatedByObjIdChildPartial && !$this->isNew();
        if (null === $this->collTjObjectLinkOlisRelatedByObjIdChild || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTjObjectLinkOlisRelatedByObjIdChild) {
                // return empty collection
                $this->initTjObjectLinkOlisRelatedByObjIdChild();
            } else {
                $collTjObjectLinkOlisRelatedByObjIdChild = TjObjectLinkOliQuery::create(null, $criteria)
                    ->filterByTObjectObjRelatedByObjIdChild($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTjObjectLinkOlisRelatedByObjIdChildPartial && count($collTjObjectLinkOlisRelatedByObjIdChild)) {
                      $this->initTjObjectLinkOlisRelatedByObjIdChild(false);

                      foreach($collTjObjectLinkOlisRelatedByObjIdChild as $obj) {
                        if (false == $this->collTjObjectLinkOlisRelatedByObjIdChild->contains($obj)) {
                          $this->collTjObjectLinkOlisRelatedByObjIdChild->append($obj);
                        }
                      }

                      $this->collTjObjectLinkOlisRelatedByObjIdChildPartial = true;
                    }

                    return $collTjObjectLinkOlisRelatedByObjIdChild;
                }

                if($partial && $this->collTjObjectLinkOlisRelatedByObjIdChild) {
                    foreach($this->collTjObjectLinkOlisRelatedByObjIdChild as $obj) {
                        if($obj->isNew()) {
                            $collTjObjectLinkOlisRelatedByObjIdChild[] = $obj;
                        }
                    }
                }

                $this->collTjObjectLinkOlisRelatedByObjIdChild = $collTjObjectLinkOlisRelatedByObjIdChild;
                $this->collTjObjectLinkOlisRelatedByObjIdChildPartial = false;
            }
        }

        return $this->collTjObjectLinkOlisRelatedByObjIdChild;
    }

    /**
     * Sets a collection of TjObjectLinkOliRelatedByObjIdChild objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tjObjectLinkOlisRelatedByObjIdChild A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTjObjectLinkOlisRelatedByObjIdChild(PropelCollection $tjObjectLinkOlisRelatedByObjIdChild, PropelPDO $con = null)
    {
        $this->tjObjectLinkOlisRelatedByObjIdChildScheduledForDeletion = $this->getTjObjectLinkOlisRelatedByObjIdChild(new Criteria(), $con)->diff($tjObjectLinkOlisRelatedByObjIdChild);

        foreach ($this->tjObjectLinkOlisRelatedByObjIdChildScheduledForDeletion as $tjObjectLinkOliRelatedByObjIdChildRemoved) {
            $tjObjectLinkOliRelatedByObjIdChildRemoved->setTObjectObjRelatedByObjIdChild(null);
        }

        $this->collTjObjectLinkOlisRelatedByObjIdChild = null;
        foreach ($tjObjectLinkOlisRelatedByObjIdChild as $tjObjectLinkOliRelatedByObjIdChild) {
            $this->addTjObjectLinkOliRelatedByObjIdChild($tjObjectLinkOliRelatedByObjIdChild);
        }

        $this->collTjObjectLinkOlisRelatedByObjIdChild = $tjObjectLinkOlisRelatedByObjIdChild;
        $this->collTjObjectLinkOlisRelatedByObjIdChildPartial = false;
    }

    /**
     * Returns the number of related TjObjectLinkOli objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TjObjectLinkOli objects.
     * @throws PropelException
     */
    public function countTjObjectLinkOlisRelatedByObjIdChild(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTjObjectLinkOlisRelatedByObjIdChildPartial && !$this->isNew();
        if (null === $this->collTjObjectLinkOlisRelatedByObjIdChild || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTjObjectLinkOlisRelatedByObjIdChild) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTjObjectLinkOlisRelatedByObjIdChild());
                }
                $query = TjObjectLinkOliQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTObjectObjRelatedByObjIdChild($this)
                    ->count($con);
            }
        } else {
            return count($this->collTjObjectLinkOlisRelatedByObjIdChild);
        }
    }

    /**
     * Method called to associate a TjObjectLinkOli object to this object
     * through the TjObjectLinkOli foreign key attribute.
     *
     * @param    TjObjectLinkOli $l TjObjectLinkOli
     * @return TObjectObj The current object (for fluent API support)
     */
    public function addTjObjectLinkOliRelatedByObjIdChild(TjObjectLinkOli $l)
    {
        if ($this->collTjObjectLinkOlisRelatedByObjIdChild === null) {
            $this->initTjObjectLinkOlisRelatedByObjIdChild();
            $this->collTjObjectLinkOlisRelatedByObjIdChildPartial = true;
        }
        if (!in_array($l, $this->collTjObjectLinkOlisRelatedByObjIdChild->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTjObjectLinkOliRelatedByObjIdChild($l);
        }

        return $this;
    }

    /**
     * @param	TjObjectLinkOliRelatedByObjIdChild $tjObjectLinkOliRelatedByObjIdChild The tjObjectLinkOliRelatedByObjIdChild object to add.
     */
    protected function doAddTjObjectLinkOliRelatedByObjIdChild($tjObjectLinkOliRelatedByObjIdChild)
    {
        $this->collTjObjectLinkOlisRelatedByObjIdChild[]= $tjObjectLinkOliRelatedByObjIdChild;
        $tjObjectLinkOliRelatedByObjIdChild->setTObjectObjRelatedByObjIdChild($this);
    }

    /**
     * @param	TjObjectLinkOliRelatedByObjIdChild $tjObjectLinkOliRelatedByObjIdChild The tjObjectLinkOliRelatedByObjIdChild object to remove.
     */
    public function removeTjObjectLinkOliRelatedByObjIdChild($tjObjectLinkOliRelatedByObjIdChild)
    {
        if ($this->getTjObjectLinkOlisRelatedByObjIdChild()->contains($tjObjectLinkOliRelatedByObjIdChild)) {
            $this->collTjObjectLinkOlisRelatedByObjIdChild->remove($this->collTjObjectLinkOlisRelatedByObjIdChild->search($tjObjectLinkOliRelatedByObjIdChild));
            if (null === $this->tjObjectLinkOlisRelatedByObjIdChildScheduledForDeletion) {
                $this->tjObjectLinkOlisRelatedByObjIdChildScheduledForDeletion = clone $this->collTjObjectLinkOlisRelatedByObjIdChild;
                $this->tjObjectLinkOlisRelatedByObjIdChildScheduledForDeletion->clear();
            }
            $this->tjObjectLinkOlisRelatedByObjIdChildScheduledForDeletion[]= $tjObjectLinkOliRelatedByObjIdChild;
            $tjObjectLinkOliRelatedByObjIdChild->setTObjectObjRelatedByObjIdChild(null);
        }
    }

    /**
     * Clears out the collTjObjectLinkOlisRelatedByObjIdParent collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTjObjectLinkOlisRelatedByObjIdParent()
     */
    public function clearTjObjectLinkOlisRelatedByObjIdParent()
    {
        $this->collTjObjectLinkOlisRelatedByObjIdParent = null; // important to set this to null since that means it is uninitialized
        $this->collTjObjectLinkOlisRelatedByObjIdParentPartial = null;
    }

    /**
     * reset is the collTjObjectLinkOlisRelatedByObjIdParent collection loaded partially
     *
     * @return void
     */
    public function resetPartialTjObjectLinkOlisRelatedByObjIdParent($v = true)
    {
        $this->collTjObjectLinkOlisRelatedByObjIdParentPartial = $v;
    }

    /**
     * Initializes the collTjObjectLinkOlisRelatedByObjIdParent collection.
     *
     * By default this just sets the collTjObjectLinkOlisRelatedByObjIdParent collection to an empty array (like clearcollTjObjectLinkOlisRelatedByObjIdParent());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTjObjectLinkOlisRelatedByObjIdParent($overrideExisting = true)
    {
        if (null !== $this->collTjObjectLinkOlisRelatedByObjIdParent && !$overrideExisting) {
            return;
        }
        $this->collTjObjectLinkOlisRelatedByObjIdParent = new PropelObjectCollection();
        $this->collTjObjectLinkOlisRelatedByObjIdParent->setModel('TjObjectLinkOli');
    }

    /**
     * Gets an array of TjObjectLinkOli objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this TObjectObj is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TjObjectLinkOli[] List of TjObjectLinkOli objects
     * @throws PropelException
     */
    public function getTjObjectLinkOlisRelatedByObjIdParent($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTjObjectLinkOlisRelatedByObjIdParentPartial && !$this->isNew();
        if (null === $this->collTjObjectLinkOlisRelatedByObjIdParent || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTjObjectLinkOlisRelatedByObjIdParent) {
                // return empty collection
                $this->initTjObjectLinkOlisRelatedByObjIdParent();
            } else {
                $collTjObjectLinkOlisRelatedByObjIdParent = TjObjectLinkOliQuery::create(null, $criteria)
                    ->filterByTObjectObjRelatedByObjIdParent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTjObjectLinkOlisRelatedByObjIdParentPartial && count($collTjObjectLinkOlisRelatedByObjIdParent)) {
                      $this->initTjObjectLinkOlisRelatedByObjIdParent(false);

                      foreach($collTjObjectLinkOlisRelatedByObjIdParent as $obj) {
                        if (false == $this->collTjObjectLinkOlisRelatedByObjIdParent->contains($obj)) {
                          $this->collTjObjectLinkOlisRelatedByObjIdParent->append($obj);
                        }
                      }

                      $this->collTjObjectLinkOlisRelatedByObjIdParentPartial = true;
                    }

                    return $collTjObjectLinkOlisRelatedByObjIdParent;
                }

                if($partial && $this->collTjObjectLinkOlisRelatedByObjIdParent) {
                    foreach($this->collTjObjectLinkOlisRelatedByObjIdParent as $obj) {
                        if($obj->isNew()) {
                            $collTjObjectLinkOlisRelatedByObjIdParent[] = $obj;
                        }
                    }
                }

                $this->collTjObjectLinkOlisRelatedByObjIdParent = $collTjObjectLinkOlisRelatedByObjIdParent;
                $this->collTjObjectLinkOlisRelatedByObjIdParentPartial = false;
            }
        }

        return $this->collTjObjectLinkOlisRelatedByObjIdParent;
    }

    /**
     * Sets a collection of TjObjectLinkOliRelatedByObjIdParent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tjObjectLinkOlisRelatedByObjIdParent A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setTjObjectLinkOlisRelatedByObjIdParent(PropelCollection $tjObjectLinkOlisRelatedByObjIdParent, PropelPDO $con = null)
    {
        $this->tjObjectLinkOlisRelatedByObjIdParentScheduledForDeletion = $this->getTjObjectLinkOlisRelatedByObjIdParent(new Criteria(), $con)->diff($tjObjectLinkOlisRelatedByObjIdParent);

        foreach ($this->tjObjectLinkOlisRelatedByObjIdParentScheduledForDeletion as $tjObjectLinkOliRelatedByObjIdParentRemoved) {
            $tjObjectLinkOliRelatedByObjIdParentRemoved->setTObjectObjRelatedByObjIdParent(null);
        }

        $this->collTjObjectLinkOlisRelatedByObjIdParent = null;
        foreach ($tjObjectLinkOlisRelatedByObjIdParent as $tjObjectLinkOliRelatedByObjIdParent) {
            $this->addTjObjectLinkOliRelatedByObjIdParent($tjObjectLinkOliRelatedByObjIdParent);
        }

        $this->collTjObjectLinkOlisRelatedByObjIdParent = $tjObjectLinkOlisRelatedByObjIdParent;
        $this->collTjObjectLinkOlisRelatedByObjIdParentPartial = false;
    }

    /**
     * Returns the number of related TjObjectLinkOli objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TjObjectLinkOli objects.
     * @throws PropelException
     */
    public function countTjObjectLinkOlisRelatedByObjIdParent(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTjObjectLinkOlisRelatedByObjIdParentPartial && !$this->isNew();
        if (null === $this->collTjObjectLinkOlisRelatedByObjIdParent || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTjObjectLinkOlisRelatedByObjIdParent) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getTjObjectLinkOlisRelatedByObjIdParent());
                }
                $query = TjObjectLinkOliQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTObjectObjRelatedByObjIdParent($this)
                    ->count($con);
            }
        } else {
            return count($this->collTjObjectLinkOlisRelatedByObjIdParent);
        }
    }

    /**
     * Method called to associate a TjObjectLinkOli object to this object
     * through the TjObjectLinkOli foreign key attribute.
     *
     * @param    TjObjectLinkOli $l TjObjectLinkOli
     * @return TObjectObj The current object (for fluent API support)
     */
    public function addTjObjectLinkOliRelatedByObjIdParent(TjObjectLinkOli $l)
    {
        if ($this->collTjObjectLinkOlisRelatedByObjIdParent === null) {
            $this->initTjObjectLinkOlisRelatedByObjIdParent();
            $this->collTjObjectLinkOlisRelatedByObjIdParentPartial = true;
        }
        if (!in_array($l, $this->collTjObjectLinkOlisRelatedByObjIdParent->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTjObjectLinkOliRelatedByObjIdParent($l);
        }

        return $this;
    }

    /**
     * @param	TjObjectLinkOliRelatedByObjIdParent $tjObjectLinkOliRelatedByObjIdParent The tjObjectLinkOliRelatedByObjIdParent object to add.
     */
    protected function doAddTjObjectLinkOliRelatedByObjIdParent($tjObjectLinkOliRelatedByObjIdParent)
    {
        $this->collTjObjectLinkOlisRelatedByObjIdParent[]= $tjObjectLinkOliRelatedByObjIdParent;
        $tjObjectLinkOliRelatedByObjIdParent->setTObjectObjRelatedByObjIdParent($this);
    }

    /**
     * @param	TjObjectLinkOliRelatedByObjIdParent $tjObjectLinkOliRelatedByObjIdParent The tjObjectLinkOliRelatedByObjIdParent object to remove.
     */
    public function removeTjObjectLinkOliRelatedByObjIdParent($tjObjectLinkOliRelatedByObjIdParent)
    {
        if ($this->getTjObjectLinkOlisRelatedByObjIdParent()->contains($tjObjectLinkOliRelatedByObjIdParent)) {
            $this->collTjObjectLinkOlisRelatedByObjIdParent->remove($this->collTjObjectLinkOlisRelatedByObjIdParent->search($tjObjectLinkOliRelatedByObjIdParent));
            if (null === $this->tjObjectLinkOlisRelatedByObjIdParentScheduledForDeletion) {
                $this->tjObjectLinkOlisRelatedByObjIdParentScheduledForDeletion = clone $this->collTjObjectLinkOlisRelatedByObjIdParent;
                $this->tjObjectLinkOlisRelatedByObjIdParentScheduledForDeletion->clear();
            }
            $this->tjObjectLinkOlisRelatedByObjIdParentScheduledForDeletion[]= $tjObjectLinkOliRelatedByObjIdParent;
            $tjObjectLinkOliRelatedByObjIdParent->setTObjectObjRelatedByObjIdParent(null);
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
            if ($this->collTPricePris) {
                foreach ($this->collTPricePris as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTPurchasePurs) {
                foreach ($this->collTPurchasePurs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTSaleSals) {
                foreach ($this->collTSaleSals as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTjObjPoiJops) {
                foreach ($this->collTjObjPoiJops as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTjObjectLinkOlisRelatedByObjIdChild) {
                foreach ($this->collTjObjectLinkOlisRelatedByObjIdChild as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTjObjectLinkOlisRelatedByObjIdParent) {
                foreach ($this->collTjObjectLinkOlisRelatedByObjIdParent as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collTPricePris instanceof PropelCollection) {
            $this->collTPricePris->clearIterator();
        }
        $this->collTPricePris = null;
        if ($this->collTPurchasePurs instanceof PropelCollection) {
            $this->collTPurchasePurs->clearIterator();
        }
        $this->collTPurchasePurs = null;
        if ($this->collTSaleSals instanceof PropelCollection) {
            $this->collTSaleSals->clearIterator();
        }
        $this->collTSaleSals = null;
        if ($this->collTjObjPoiJops instanceof PropelCollection) {
            $this->collTjObjPoiJops->clearIterator();
        }
        $this->collTjObjPoiJops = null;
        if ($this->collTjObjectLinkOlisRelatedByObjIdChild instanceof PropelCollection) {
            $this->collTjObjectLinkOlisRelatedByObjIdChild->clearIterator();
        }
        $this->collTjObjectLinkOlisRelatedByObjIdChild = null;
        if ($this->collTjObjectLinkOlisRelatedByObjIdParent instanceof PropelCollection) {
            $this->collTjObjectLinkOlisRelatedByObjIdParent->clearIterator();
        }
        $this->collTjObjectLinkOlisRelatedByObjIdParent = null;
        $this->aTFundationFun = null;
        $this->aTsImageImg = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TObjectObjPeer::DEFAULT_STRING_FORMAT);
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
