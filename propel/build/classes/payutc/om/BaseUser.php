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
use Payutc\GroupQuery;
use Payutc\Image;
use Payutc\ImageQuery;
use Payutc\JUsrGrp;
use Payutc\JUsrGrpQuery;
use Payutc\JUsrMol;
use Payutc\JUsrMolQuery;
use Payutc\JUsrRig;
use Payutc\JUsrRigQuery;
use Payutc\MeanOfLogin;
use Payutc\MeanOfLoginQuery;
use Payutc\Paybox;
use Payutc\PayboxQuery;
use Payutc\Period;
use Payutc\PeriodQuery;
use Payutc\Point;
use Payutc\PointQuery;
use Payutc\Purchase;
use Payutc\PurchaseQuery;
use Payutc\Recharge;
use Payutc\RechargeQuery;
use Payutc\Right;
use Payutc\RightQuery;
use Payutc\Sherlocks;
use Payutc\SherlocksQuery;
use Payutc\User;
use Payutc\UserPeer;
use Payutc\UserQuery;
use Payutc\Virement;
use Payutc\VirementQuery;

/**
 * Base class that represents a row from the 'ts_user_usr' table.
 *
 *
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseUser extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Payutc\\UserPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UserPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the usr_id field.
     * @var        int
     */
    protected $usr_id;

    /**
     * The value for the usr_pwd field.
     * @var        string
     */
    protected $usr_pwd;

    /**
     * The value for the usr_firstname field.
     * @var        string
     */
    protected $usr_firstname;

    /**
     * The value for the usr_lastname field.
     * @var        string
     */
    protected $usr_lastname;

    /**
     * The value for the usr_nickname field.
     * @var        string
     */
    protected $usr_nickname;

    /**
     * The value for the usr_adult field.
     * @var        int
     */
    protected $usr_adult;

    /**
     * The value for the usr_mail field.
     * @var        string
     */
    protected $usr_mail;

    /**
     * The value for the usr_credit field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $usr_credit;

    /**
     * The value for the img_id field.
     * @var        int
     */
    protected $img_id;

    /**
     * The value for the usr_temporary field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $usr_temporary;

    /**
     * The value for the usr_fail_auth field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $usr_fail_auth;

    /**
     * The value for the usr_blocked field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $usr_blocked;

    /**
     * The value for the usr_msg_perso field.
     * @var        string
     */
    protected $usr_msg_perso;

    /**
     * @var        Image
     */
    protected $aImage;

    /**
     * @var        PropelObjectCollection|Paybox[] Collection to store aggregation of Paybox objects.
     */
    protected $collPayboxs;
    protected $collPayboxsPartial;

    /**
     * @var        PropelObjectCollection|Purchase[] Collection to store aggregation of Purchase objects.
     */
    protected $collPurchasesRelatedByUsrIdBuyer;
    protected $collPurchasesRelatedByUsrIdBuyerPartial;

    /**
     * @var        PropelObjectCollection|Purchase[] Collection to store aggregation of Purchase objects.
     */
    protected $collPurchasesRelatedByUsrIdSeller;
    protected $collPurchasesRelatedByUsrIdSellerPartial;

    /**
     * @var        PropelObjectCollection|Recharge[] Collection to store aggregation of Recharge objects.
     */
    protected $collRechargesRelatedByUsrIdBuyer;
    protected $collRechargesRelatedByUsrIdBuyerPartial;

    /**
     * @var        PropelObjectCollection|Recharge[] Collection to store aggregation of Recharge objects.
     */
    protected $collRechargesRelatedByUsrIdOperator;
    protected $collRechargesRelatedByUsrIdOperatorPartial;

    /**
     * @var        PropelObjectCollection|Sherlocks[] Collection to store aggregation of Sherlocks objects.
     */
    protected $collSherlockss;
    protected $collSherlockssPartial;

    /**
     * @var        PropelObjectCollection|Virement[] Collection to store aggregation of Virement objects.
     */
    protected $collVirementsRelatedByUsrIdTo;
    protected $collVirementsRelatedByUsrIdToPartial;

    /**
     * @var        PropelObjectCollection|Virement[] Collection to store aggregation of Virement objects.
     */
    protected $collVirementsRelatedByUsrIdFrom;
    protected $collVirementsRelatedByUsrIdFromPartial;

    /**
     * @var        PropelObjectCollection|JUsrGrp[] Collection to store aggregation of JUsrGrp objects.
     */
    protected $collJUsrGrps;
    protected $collJUsrGrpsPartial;

    /**
     * @var        PropelObjectCollection|JUsrMol[] Collection to store aggregation of JUsrMol objects.
     */
    protected $collJUsrMols;
    protected $collJUsrMolsPartial;

    /**
     * @var        PropelObjectCollection|JUsrRig[] Collection to store aggregation of JUsrRig objects.
     */
    protected $collJUsrRigs;
    protected $collJUsrRigsPartial;

    /**
     * @var        PropelObjectCollection|Period[] Collection to store aggregation of Period objects.
     */
    protected $collPeriods;

    /**
     * @var        PropelObjectCollection|Group[] Collection to store aggregation of Group objects.
     */
    protected $collGroups;

    /**
     * @var        PropelObjectCollection|MeanOfLogin[] Collection to store aggregation of MeanOfLogin objects.
     */
    protected $collMeanOfLogins;

    /**
     * @var        PropelObjectCollection|Period[] Collection to store aggregation of Period objects.
     */
    protected $collJurPeriods;

    /**
     * @var        PropelObjectCollection|Right[] Collection to store aggregation of Right objects.
     */
    protected $collRights;

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
    protected $periodsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $groupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $meanOfLoginsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $jurPeriodsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $rightsScheduledForDeletion = null;

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
    protected $payboxsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $purchasesRelatedByUsrIdBuyerScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $purchasesRelatedByUsrIdSellerScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $rechargesRelatedByUsrIdBuyerScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $rechargesRelatedByUsrIdOperatorScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $sherlockssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $virementsRelatedByUsrIdToScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $virementsRelatedByUsrIdFromScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $jUsrGrpsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $jUsrMolsScheduledForDeletion = null;

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
        $this->usr_credit = 0;
        $this->usr_temporary = false;
        $this->usr_fail_auth = false;
        $this->usr_blocked = false;
    }

    /**
     * Initializes internal state of BaseUser object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [usr_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->usr_id;
    }

    /**
     * Get the [usr_pwd] column value.
     *
     * @return string
     */
    public function getPwd()
    {
        return $this->usr_pwd;
    }

    /**
     * Get the [usr_firstname] column value.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->usr_firstname;
    }

    /**
     * Get the [usr_lastname] column value.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->usr_lastname;
    }

    /**
     * Get the [usr_nickname] column value.
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->usr_nickname;
    }

    /**
     * Get the [usr_adult] column value.
     *
     * @return int
     */
    public function getAdult()
    {
        return $this->usr_adult;
    }

    /**
     * Get the [usr_mail] column value.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->usr_mail;
    }

    /**
     * Get the [usr_credit] column value.
     *
     * @return int
     */
    public function getCredit()
    {
        return $this->usr_credit;
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
     * Get the [usr_temporary] column value.
     *
     * @return boolean
     */
    public function getTemporary()
    {
        return $this->usr_temporary;
    }

    /**
     * Get the [usr_fail_auth] column value.
     *
     * @return boolean
     */
    public function getFailAuth()
    {
        return $this->usr_fail_auth;
    }

    /**
     * Get the [usr_blocked] column value.
     *
     * @return boolean
     */
    public function getBlocked()
    {
        return $this->usr_blocked;
    }

    /**
     * Get the [usr_msg_perso] column value.
     *
     * @return string
     */
    public function getMsgPerso()
    {
        return $this->usr_msg_perso;
    }

    /**
     * Set the value of [usr_id] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_id !== $v) {
            $this->usr_id = $v;
            $this->modifiedColumns[] = UserPeer::USR_ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [usr_pwd] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setPwd($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_pwd !== $v) {
            $this->usr_pwd = $v;
            $this->modifiedColumns[] = UserPeer::USR_PWD;
        }


        return $this;
    } // setPwd()

    /**
     * Set the value of [usr_firstname] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setFirstname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_firstname !== $v) {
            $this->usr_firstname = $v;
            $this->modifiedColumns[] = UserPeer::USR_FIRSTNAME;
        }


        return $this;
    } // setFirstname()

    /**
     * Set the value of [usr_lastname] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setLastname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_lastname !== $v) {
            $this->usr_lastname = $v;
            $this->modifiedColumns[] = UserPeer::USR_LASTNAME;
        }


        return $this;
    } // setLastname()

    /**
     * Set the value of [usr_nickname] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setNickname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_nickname !== $v) {
            $this->usr_nickname = $v;
            $this->modifiedColumns[] = UserPeer::USR_NICKNAME;
        }


        return $this;
    } // setNickname()

    /**
     * Set the value of [usr_adult] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setAdult($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_adult !== $v) {
            $this->usr_adult = $v;
            $this->modifiedColumns[] = UserPeer::USR_ADULT;
        }


        return $this;
    } // setAdult()

    /**
     * Set the value of [usr_mail] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setMail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_mail !== $v) {
            $this->usr_mail = $v;
            $this->modifiedColumns[] = UserPeer::USR_MAIL;
        }


        return $this;
    } // setMail()

    /**
     * Set the value of [usr_credit] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setCredit($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->usr_credit !== $v) {
            $this->usr_credit = $v;
            $this->modifiedColumns[] = UserPeer::USR_CREDIT;
        }


        return $this;
    } // setCredit()

    /**
     * Set the value of [img_id] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setImgId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->img_id !== $v) {
            $this->img_id = $v;
            $this->modifiedColumns[] = UserPeer::IMG_ID;
        }

        if ($this->aImage !== null && $this->aImage->getId() !== $v) {
            $this->aImage = null;
        }


        return $this;
    } // setImgId()

    /**
     * Sets the value of the [usr_temporary] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return User The current object (for fluent API support)
     */
    public function setTemporary($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->usr_temporary !== $v) {
            $this->usr_temporary = $v;
            $this->modifiedColumns[] = UserPeer::USR_TEMPORARY;
        }


        return $this;
    } // setTemporary()

    /**
     * Sets the value of the [usr_fail_auth] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return User The current object (for fluent API support)
     */
    public function setFailAuth($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->usr_fail_auth !== $v) {
            $this->usr_fail_auth = $v;
            $this->modifiedColumns[] = UserPeer::USR_FAIL_AUTH;
        }


        return $this;
    } // setFailAuth()

    /**
     * Sets the value of the [usr_blocked] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return User The current object (for fluent API support)
     */
    public function setBlocked($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->usr_blocked !== $v) {
            $this->usr_blocked = $v;
            $this->modifiedColumns[] = UserPeer::USR_BLOCKED;
        }


        return $this;
    } // setBlocked()

    /**
     * Set the value of [usr_msg_perso] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setMsgPerso($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usr_msg_perso !== $v) {
            $this->usr_msg_perso = $v;
            $this->modifiedColumns[] = UserPeer::USR_MSG_PERSO;
        }


        return $this;
    } // setMsgPerso()

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
            if ($this->usr_credit !== 0) {
                return false;
            }

            if ($this->usr_temporary !== false) {
                return false;
            }

            if ($this->usr_fail_auth !== false) {
                return false;
            }

            if ($this->usr_blocked !== false) {
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

            $this->usr_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->usr_pwd = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->usr_firstname = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->usr_lastname = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->usr_nickname = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->usr_adult = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->usr_mail = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->usr_credit = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->img_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->usr_temporary = ($row[$startcol + 9] !== null) ? (boolean) $row[$startcol + 9] : null;
            $this->usr_fail_auth = ($row[$startcol + 10] !== null) ? (boolean) $row[$startcol + 10] : null;
            $this->usr_blocked = ($row[$startcol + 11] !== null) ? (boolean) $row[$startcol + 11] : null;
            $this->usr_msg_perso = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = UserPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating User object", $e);
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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aImage = null;
            $this->collPayboxs = null;

            $this->collPurchasesRelatedByUsrIdBuyer = null;

            $this->collPurchasesRelatedByUsrIdSeller = null;

            $this->collRechargesRelatedByUsrIdBuyer = null;

            $this->collRechargesRelatedByUsrIdOperator = null;

            $this->collSherlockss = null;

            $this->collVirementsRelatedByUsrIdTo = null;

            $this->collVirementsRelatedByUsrIdFrom = null;

            $this->collJUsrGrps = null;

            $this->collJUsrMols = null;

            $this->collJUsrRigs = null;

            $this->collPeriods = null;
            $this->collGroups = null;
            $this->collMeanOfLogins = null;
            $this->collJurPeriods = null;
            $this->collRights = null;
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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UserQuery::create()
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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                UserPeer::addInstanceToPool($this);
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

            if ($this->groupsScheduledForDeletion !== null) {
                if (!$this->groupsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->groupsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    JUsrGrpQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->groupsScheduledForDeletion = null;
                }

                foreach ($this->getGroups() as $group) {
                    if ($group->isModified()) {
                        $group->save($con);
                    }
                }
            }

            if ($this->meanOfLoginsScheduledForDeletion !== null) {
                if (!$this->meanOfLoginsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->meanOfLoginsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    JUsrMolQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->meanOfLoginsScheduledForDeletion = null;
                }

                foreach ($this->getMeanOfLogins() as $meanOfLogin) {
                    if ($meanOfLogin->isModified()) {
                        $meanOfLogin->save($con);
                    }
                }
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

            if ($this->payboxsScheduledForDeletion !== null) {
                if (!$this->payboxsScheduledForDeletion->isEmpty()) {
                    PayboxQuery::create()
                        ->filterByPrimaryKeys($this->payboxsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->payboxsScheduledForDeletion = null;
                }
            }

            if ($this->collPayboxs !== null) {
                foreach ($this->collPayboxs as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->purchasesRelatedByUsrIdBuyerScheduledForDeletion !== null) {
                if (!$this->purchasesRelatedByUsrIdBuyerScheduledForDeletion->isEmpty()) {
                    PurchaseQuery::create()
                        ->filterByPrimaryKeys($this->purchasesRelatedByUsrIdBuyerScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->purchasesRelatedByUsrIdBuyerScheduledForDeletion = null;
                }
            }

            if ($this->collPurchasesRelatedByUsrIdBuyer !== null) {
                foreach ($this->collPurchasesRelatedByUsrIdBuyer as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->purchasesRelatedByUsrIdSellerScheduledForDeletion !== null) {
                if (!$this->purchasesRelatedByUsrIdSellerScheduledForDeletion->isEmpty()) {
                    PurchaseQuery::create()
                        ->filterByPrimaryKeys($this->purchasesRelatedByUsrIdSellerScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->purchasesRelatedByUsrIdSellerScheduledForDeletion = null;
                }
            }

            if ($this->collPurchasesRelatedByUsrIdSeller !== null) {
                foreach ($this->collPurchasesRelatedByUsrIdSeller as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->rechargesRelatedByUsrIdBuyerScheduledForDeletion !== null) {
                if (!$this->rechargesRelatedByUsrIdBuyerScheduledForDeletion->isEmpty()) {
                    RechargeQuery::create()
                        ->filterByPrimaryKeys($this->rechargesRelatedByUsrIdBuyerScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->rechargesRelatedByUsrIdBuyerScheduledForDeletion = null;
                }
            }

            if ($this->collRechargesRelatedByUsrIdBuyer !== null) {
                foreach ($this->collRechargesRelatedByUsrIdBuyer as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->rechargesRelatedByUsrIdOperatorScheduledForDeletion !== null) {
                if (!$this->rechargesRelatedByUsrIdOperatorScheduledForDeletion->isEmpty()) {
                    RechargeQuery::create()
                        ->filterByPrimaryKeys($this->rechargesRelatedByUsrIdOperatorScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->rechargesRelatedByUsrIdOperatorScheduledForDeletion = null;
                }
            }

            if ($this->collRechargesRelatedByUsrIdOperator !== null) {
                foreach ($this->collRechargesRelatedByUsrIdOperator as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->sherlockssScheduledForDeletion !== null) {
                if (!$this->sherlockssScheduledForDeletion->isEmpty()) {
                    SherlocksQuery::create()
                        ->filterByPrimaryKeys($this->sherlockssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->sherlockssScheduledForDeletion = null;
                }
            }

            if ($this->collSherlockss !== null) {
                foreach ($this->collSherlockss as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->virementsRelatedByUsrIdToScheduledForDeletion !== null) {
                if (!$this->virementsRelatedByUsrIdToScheduledForDeletion->isEmpty()) {
                    VirementQuery::create()
                        ->filterByPrimaryKeys($this->virementsRelatedByUsrIdToScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->virementsRelatedByUsrIdToScheduledForDeletion = null;
                }
            }

            if ($this->collVirementsRelatedByUsrIdTo !== null) {
                foreach ($this->collVirementsRelatedByUsrIdTo as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->virementsRelatedByUsrIdFromScheduledForDeletion !== null) {
                if (!$this->virementsRelatedByUsrIdFromScheduledForDeletion->isEmpty()) {
                    VirementQuery::create()
                        ->filterByPrimaryKeys($this->virementsRelatedByUsrIdFromScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->virementsRelatedByUsrIdFromScheduledForDeletion = null;
                }
            }

            if ($this->collVirementsRelatedByUsrIdFrom !== null) {
                foreach ($this->collVirementsRelatedByUsrIdFrom as $referrerFK) {
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

            if ($this->jUsrMolsScheduledForDeletion !== null) {
                if (!$this->jUsrMolsScheduledForDeletion->isEmpty()) {
                    JUsrMolQuery::create()
                        ->filterByPrimaryKeys($this->jUsrMolsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->jUsrMolsScheduledForDeletion = null;
                }
            }

            if ($this->collJUsrMols !== null) {
                foreach ($this->collJUsrMols as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
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

        $this->modifiedColumns[] = UserPeer::USR_ID;
        if (null !== $this->usr_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserPeer::USR_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserPeer::USR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ID`';
        }
        if ($this->isColumnModified(UserPeer::USR_PWD)) {
            $modifiedColumns[':p' . $index++]  = '`USR_PWD`';
        }
        if ($this->isColumnModified(UserPeer::USR_FIRSTNAME)) {
            $modifiedColumns[':p' . $index++]  = '`USR_FIRSTNAME`';
        }
        if ($this->isColumnModified(UserPeer::USR_LASTNAME)) {
            $modifiedColumns[':p' . $index++]  = '`USR_LASTNAME`';
        }
        if ($this->isColumnModified(UserPeer::USR_NICKNAME)) {
            $modifiedColumns[':p' . $index++]  = '`USR_NICKNAME`';
        }
        if ($this->isColumnModified(UserPeer::USR_ADULT)) {
            $modifiedColumns[':p' . $index++]  = '`USR_ADULT`';
        }
        if ($this->isColumnModified(UserPeer::USR_MAIL)) {
            $modifiedColumns[':p' . $index++]  = '`USR_MAIL`';
        }
        if ($this->isColumnModified(UserPeer::USR_CREDIT)) {
            $modifiedColumns[':p' . $index++]  = '`USR_CREDIT`';
        }
        if ($this->isColumnModified(UserPeer::IMG_ID)) {
            $modifiedColumns[':p' . $index++]  = '`IMG_ID`';
        }
        if ($this->isColumnModified(UserPeer::USR_TEMPORARY)) {
            $modifiedColumns[':p' . $index++]  = '`USR_TEMPORARY`';
        }
        if ($this->isColumnModified(UserPeer::USR_FAIL_AUTH)) {
            $modifiedColumns[':p' . $index++]  = '`USR_FAIL_AUTH`';
        }
        if ($this->isColumnModified(UserPeer::USR_BLOCKED)) {
            $modifiedColumns[':p' . $index++]  = '`USR_BLOCKED`';
        }
        if ($this->isColumnModified(UserPeer::USR_MSG_PERSO)) {
            $modifiedColumns[':p' . $index++]  = '`USR_MSG_PERSO`';
        }

        $sql = sprintf(
            'INSERT INTO `ts_user_usr` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`USR_ID`':
                        $stmt->bindValue($identifier, $this->usr_id, PDO::PARAM_INT);
                        break;
                    case '`USR_PWD`':
                        $stmt->bindValue($identifier, $this->usr_pwd, PDO::PARAM_STR);
                        break;
                    case '`USR_FIRSTNAME`':
                        $stmt->bindValue($identifier, $this->usr_firstname, PDO::PARAM_STR);
                        break;
                    case '`USR_LASTNAME`':
                        $stmt->bindValue($identifier, $this->usr_lastname, PDO::PARAM_STR);
                        break;
                    case '`USR_NICKNAME`':
                        $stmt->bindValue($identifier, $this->usr_nickname, PDO::PARAM_STR);
                        break;
                    case '`USR_ADULT`':
                        $stmt->bindValue($identifier, $this->usr_adult, PDO::PARAM_INT);
                        break;
                    case '`USR_MAIL`':
                        $stmt->bindValue($identifier, $this->usr_mail, PDO::PARAM_STR);
                        break;
                    case '`USR_CREDIT`':
                        $stmt->bindValue($identifier, $this->usr_credit, PDO::PARAM_INT);
                        break;
                    case '`IMG_ID`':
                        $stmt->bindValue($identifier, $this->img_id, PDO::PARAM_INT);
                        break;
                    case '`USR_TEMPORARY`':
                        $stmt->bindValue($identifier, (int) $this->usr_temporary, PDO::PARAM_INT);
                        break;
                    case '`USR_FAIL_AUTH`':
                        $stmt->bindValue($identifier, (int) $this->usr_fail_auth, PDO::PARAM_INT);
                        break;
                    case '`USR_BLOCKED`':
                        $stmt->bindValue($identifier, (int) $this->usr_blocked, PDO::PARAM_INT);
                        break;
                    case '`USR_MSG_PERSO`':
                        $stmt->bindValue($identifier, $this->usr_msg_perso, PDO::PARAM_STR);
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

            if ($this->aImage !== null) {
                if (!$this->aImage->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aImage->getValidationFailures());
                }
            }


            if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPayboxs !== null) {
                    foreach ($this->collPayboxs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPurchasesRelatedByUsrIdBuyer !== null) {
                    foreach ($this->collPurchasesRelatedByUsrIdBuyer as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPurchasesRelatedByUsrIdSeller !== null) {
                    foreach ($this->collPurchasesRelatedByUsrIdSeller as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRechargesRelatedByUsrIdBuyer !== null) {
                    foreach ($this->collRechargesRelatedByUsrIdBuyer as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRechargesRelatedByUsrIdOperator !== null) {
                    foreach ($this->collRechargesRelatedByUsrIdOperator as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collSherlockss !== null) {
                    foreach ($this->collSherlockss as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collVirementsRelatedByUsrIdTo !== null) {
                    foreach ($this->collVirementsRelatedByUsrIdTo as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collVirementsRelatedByUsrIdFrom !== null) {
                    foreach ($this->collVirementsRelatedByUsrIdFrom as $referrerFK) {
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

                if ($this->collJUsrMols !== null) {
                    foreach ($this->collJUsrMols as $referrerFK) {
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
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getPwd();
                break;
            case 2:
                return $this->getFirstname();
                break;
            case 3:
                return $this->getLastname();
                break;
            case 4:
                return $this->getNickname();
                break;
            case 5:
                return $this->getAdult();
                break;
            case 6:
                return $this->getMail();
                break;
            case 7:
                return $this->getCredit();
                break;
            case 8:
                return $this->getImgId();
                break;
            case 9:
                return $this->getTemporary();
                break;
            case 10:
                return $this->getFailAuth();
                break;
            case 11:
                return $this->getBlocked();
                break;
            case 12:
                return $this->getMsgPerso();
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
        if (isset($alreadyDumpedObjects['User'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->getPrimaryKey()] = true;
        $keys = UserPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPwd(),
            $keys[2] => $this->getFirstname(),
            $keys[3] => $this->getLastname(),
            $keys[4] => $this->getNickname(),
            $keys[5] => $this->getAdult(),
            $keys[6] => $this->getMail(),
            $keys[7] => $this->getCredit(),
            $keys[8] => $this->getImgId(),
            $keys[9] => $this->getTemporary(),
            $keys[10] => $this->getFailAuth(),
            $keys[11] => $this->getBlocked(),
            $keys[12] => $this->getMsgPerso(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aImage) {
                $result['Image'] = $this->aImage->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPayboxs) {
                $result['Payboxs'] = $this->collPayboxs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPurchasesRelatedByUsrIdBuyer) {
                $result['PurchasesRelatedByUsrIdBuyer'] = $this->collPurchasesRelatedByUsrIdBuyer->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPurchasesRelatedByUsrIdSeller) {
                $result['PurchasesRelatedByUsrIdSeller'] = $this->collPurchasesRelatedByUsrIdSeller->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRechargesRelatedByUsrIdBuyer) {
                $result['RechargesRelatedByUsrIdBuyer'] = $this->collRechargesRelatedByUsrIdBuyer->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRechargesRelatedByUsrIdOperator) {
                $result['RechargesRelatedByUsrIdOperator'] = $this->collRechargesRelatedByUsrIdOperator->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSherlockss) {
                $result['Sherlockss'] = $this->collSherlockss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVirementsRelatedByUsrIdTo) {
                $result['VirementsRelatedByUsrIdTo'] = $this->collVirementsRelatedByUsrIdTo->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVirementsRelatedByUsrIdFrom) {
                $result['VirementsRelatedByUsrIdFrom'] = $this->collVirementsRelatedByUsrIdFrom->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collJUsrGrps) {
                $result['JUsrGrps'] = $this->collJUsrGrps->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collJUsrMols) {
                $result['JUsrMols'] = $this->collJUsrMols->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setPwd($value);
                break;
            case 2:
                $this->setFirstname($value);
                break;
            case 3:
                $this->setLastname($value);
                break;
            case 4:
                $this->setNickname($value);
                break;
            case 5:
                $this->setAdult($value);
                break;
            case 6:
                $this->setMail($value);
                break;
            case 7:
                $this->setCredit($value);
                break;
            case 8:
                $this->setImgId($value);
                break;
            case 9:
                $this->setTemporary($value);
                break;
            case 10:
                $this->setFailAuth($value);
                break;
            case 11:
                $this->setBlocked($value);
                break;
            case 12:
                $this->setMsgPerso($value);
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
        $keys = UserPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setPwd($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setFirstname($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setLastname($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setNickname($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setAdult($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setMail($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCredit($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setImgId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setTemporary($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setFailAuth($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setBlocked($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setMsgPerso($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);

        if ($this->isColumnModified(UserPeer::USR_ID)) $criteria->add(UserPeer::USR_ID, $this->usr_id);
        if ($this->isColumnModified(UserPeer::USR_PWD)) $criteria->add(UserPeer::USR_PWD, $this->usr_pwd);
        if ($this->isColumnModified(UserPeer::USR_FIRSTNAME)) $criteria->add(UserPeer::USR_FIRSTNAME, $this->usr_firstname);
        if ($this->isColumnModified(UserPeer::USR_LASTNAME)) $criteria->add(UserPeer::USR_LASTNAME, $this->usr_lastname);
        if ($this->isColumnModified(UserPeer::USR_NICKNAME)) $criteria->add(UserPeer::USR_NICKNAME, $this->usr_nickname);
        if ($this->isColumnModified(UserPeer::USR_ADULT)) $criteria->add(UserPeer::USR_ADULT, $this->usr_adult);
        if ($this->isColumnModified(UserPeer::USR_MAIL)) $criteria->add(UserPeer::USR_MAIL, $this->usr_mail);
        if ($this->isColumnModified(UserPeer::USR_CREDIT)) $criteria->add(UserPeer::USR_CREDIT, $this->usr_credit);
        if ($this->isColumnModified(UserPeer::IMG_ID)) $criteria->add(UserPeer::IMG_ID, $this->img_id);
        if ($this->isColumnModified(UserPeer::USR_TEMPORARY)) $criteria->add(UserPeer::USR_TEMPORARY, $this->usr_temporary);
        if ($this->isColumnModified(UserPeer::USR_FAIL_AUTH)) $criteria->add(UserPeer::USR_FAIL_AUTH, $this->usr_fail_auth);
        if ($this->isColumnModified(UserPeer::USR_BLOCKED)) $criteria->add(UserPeer::USR_BLOCKED, $this->usr_blocked);
        if ($this->isColumnModified(UserPeer::USR_MSG_PERSO)) $criteria->add(UserPeer::USR_MSG_PERSO, $this->usr_msg_perso);

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
        $criteria = new Criteria(UserPeer::DATABASE_NAME);
        $criteria->add(UserPeer::USR_ID, $this->usr_id);

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
     * Generic method to set the primary key (usr_id column).
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
     * @param object $copyObj An object of User (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPwd($this->getPwd());
        $copyObj->setFirstname($this->getFirstname());
        $copyObj->setLastname($this->getLastname());
        $copyObj->setNickname($this->getNickname());
        $copyObj->setAdult($this->getAdult());
        $copyObj->setMail($this->getMail());
        $copyObj->setCredit($this->getCredit());
        $copyObj->setImgId($this->getImgId());
        $copyObj->setTemporary($this->getTemporary());
        $copyObj->setFailAuth($this->getFailAuth());
        $copyObj->setBlocked($this->getBlocked());
        $copyObj->setMsgPerso($this->getMsgPerso());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getPayboxs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPaybox($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPurchasesRelatedByUsrIdBuyer() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPurchaseRelatedByUsrIdBuyer($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPurchasesRelatedByUsrIdSeller() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPurchaseRelatedByUsrIdSeller($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRechargesRelatedByUsrIdBuyer() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRechargeRelatedByUsrIdBuyer($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRechargesRelatedByUsrIdOperator() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRechargeRelatedByUsrIdOperator($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSherlockss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSherlocks($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVirementsRelatedByUsrIdTo() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVirementRelatedByUsrIdTo($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVirementsRelatedByUsrIdFrom() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVirementRelatedByUsrIdFrom($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getJUsrGrps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJUsrGrp($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getJUsrMols() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addJUsrMol($relObj->copy($deepCopy));
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
     * @return User Clone of current object.
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
     * @return UserPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UserPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Image object.
     *
     * @param             Image $v
     * @return User The current object (for fluent API support)
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
            $v->addUser($this);
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
                $this->aImage->addUsers($this);
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
        if ('Paybox' == $relationName) {
            $this->initPayboxs();
        }
        if ('PurchaseRelatedByUsrIdBuyer' == $relationName) {
            $this->initPurchasesRelatedByUsrIdBuyer();
        }
        if ('PurchaseRelatedByUsrIdSeller' == $relationName) {
            $this->initPurchasesRelatedByUsrIdSeller();
        }
        if ('RechargeRelatedByUsrIdBuyer' == $relationName) {
            $this->initRechargesRelatedByUsrIdBuyer();
        }
        if ('RechargeRelatedByUsrIdOperator' == $relationName) {
            $this->initRechargesRelatedByUsrIdOperator();
        }
        if ('Sherlocks' == $relationName) {
            $this->initSherlockss();
        }
        if ('VirementRelatedByUsrIdTo' == $relationName) {
            $this->initVirementsRelatedByUsrIdTo();
        }
        if ('VirementRelatedByUsrIdFrom' == $relationName) {
            $this->initVirementsRelatedByUsrIdFrom();
        }
        if ('JUsrGrp' == $relationName) {
            $this->initJUsrGrps();
        }
        if ('JUsrMol' == $relationName) {
            $this->initJUsrMols();
        }
        if ('JUsrRig' == $relationName) {
            $this->initJUsrRigs();
        }
    }

    /**
     * Clears out the collPayboxs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPayboxs()
     */
    public function clearPayboxs()
    {
        $this->collPayboxs = null; // important to set this to null since that means it is uninitialized
        $this->collPayboxsPartial = null;
    }

    /**
     * reset is the collPayboxs collection loaded partially
     *
     * @return void
     */
    public function resetPartialPayboxs($v = true)
    {
        $this->collPayboxsPartial = $v;
    }

    /**
     * Initializes the collPayboxs collection.
     *
     * By default this just sets the collPayboxs collection to an empty array (like clearcollPayboxs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPayboxs($overrideExisting = true)
    {
        if (null !== $this->collPayboxs && !$overrideExisting) {
            return;
        }
        $this->collPayboxs = new PropelObjectCollection();
        $this->collPayboxs->setModel('Paybox');
    }

    /**
     * Gets an array of Paybox objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Paybox[] List of Paybox objects
     * @throws PropelException
     */
    public function getPayboxs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPayboxsPartial && !$this->isNew();
        if (null === $this->collPayboxs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPayboxs) {
                // return empty collection
                $this->initPayboxs();
            } else {
                $collPayboxs = PayboxQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPayboxsPartial && count($collPayboxs)) {
                      $this->initPayboxs(false);

                      foreach($collPayboxs as $obj) {
                        if (false == $this->collPayboxs->contains($obj)) {
                          $this->collPayboxs->append($obj);
                        }
                      }

                      $this->collPayboxsPartial = true;
                    }

                    return $collPayboxs;
                }

                if($partial && $this->collPayboxs) {
                    foreach($this->collPayboxs as $obj) {
                        if($obj->isNew()) {
                            $collPayboxs[] = $obj;
                        }
                    }
                }

                $this->collPayboxs = $collPayboxs;
                $this->collPayboxsPartial = false;
            }
        }

        return $this->collPayboxs;
    }

    /**
     * Sets a collection of Paybox objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $payboxs A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setPayboxs(PropelCollection $payboxs, PropelPDO $con = null)
    {
        $this->payboxsScheduledForDeletion = $this->getPayboxs(new Criteria(), $con)->diff($payboxs);

        foreach ($this->payboxsScheduledForDeletion as $payboxRemoved) {
            $payboxRemoved->setUser(null);
        }

        $this->collPayboxs = null;
        foreach ($payboxs as $paybox) {
            $this->addPaybox($paybox);
        }

        $this->collPayboxs = $payboxs;
        $this->collPayboxsPartial = false;
    }

    /**
     * Returns the number of related Paybox objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Paybox objects.
     * @throws PropelException
     */
    public function countPayboxs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPayboxsPartial && !$this->isNew();
        if (null === $this->collPayboxs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPayboxs) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getPayboxs());
                }
                $query = PayboxQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collPayboxs);
        }
    }

    /**
     * Method called to associate a Paybox object to this object
     * through the Paybox foreign key attribute.
     *
     * @param    Paybox $l Paybox
     * @return User The current object (for fluent API support)
     */
    public function addPaybox(Paybox $l)
    {
        if ($this->collPayboxs === null) {
            $this->initPayboxs();
            $this->collPayboxsPartial = true;
        }
        if (!in_array($l, $this->collPayboxs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPaybox($l);
        }

        return $this;
    }

    /**
     * @param	Paybox $paybox The paybox object to add.
     */
    protected function doAddPaybox($paybox)
    {
        $this->collPayboxs[]= $paybox;
        $paybox->setUser($this);
    }

    /**
     * @param	Paybox $paybox The paybox object to remove.
     */
    public function removePaybox($paybox)
    {
        if ($this->getPayboxs()->contains($paybox)) {
            $this->collPayboxs->remove($this->collPayboxs->search($paybox));
            if (null === $this->payboxsScheduledForDeletion) {
                $this->payboxsScheduledForDeletion = clone $this->collPayboxs;
                $this->payboxsScheduledForDeletion->clear();
            }
            $this->payboxsScheduledForDeletion[]= $paybox;
            $paybox->setUser(null);
        }
    }

    /**
     * Clears out the collPurchasesRelatedByUsrIdBuyer collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPurchasesRelatedByUsrIdBuyer()
     */
    public function clearPurchasesRelatedByUsrIdBuyer()
    {
        $this->collPurchasesRelatedByUsrIdBuyer = null; // important to set this to null since that means it is uninitialized
        $this->collPurchasesRelatedByUsrIdBuyerPartial = null;
    }

    /**
     * reset is the collPurchasesRelatedByUsrIdBuyer collection loaded partially
     *
     * @return void
     */
    public function resetPartialPurchasesRelatedByUsrIdBuyer($v = true)
    {
        $this->collPurchasesRelatedByUsrIdBuyerPartial = $v;
    }

    /**
     * Initializes the collPurchasesRelatedByUsrIdBuyer collection.
     *
     * By default this just sets the collPurchasesRelatedByUsrIdBuyer collection to an empty array (like clearcollPurchasesRelatedByUsrIdBuyer());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPurchasesRelatedByUsrIdBuyer($overrideExisting = true)
    {
        if (null !== $this->collPurchasesRelatedByUsrIdBuyer && !$overrideExisting) {
            return;
        }
        $this->collPurchasesRelatedByUsrIdBuyer = new PropelObjectCollection();
        $this->collPurchasesRelatedByUsrIdBuyer->setModel('Purchase');
    }

    /**
     * Gets an array of Purchase objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     * @throws PropelException
     */
    public function getPurchasesRelatedByUsrIdBuyer($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPurchasesRelatedByUsrIdBuyerPartial && !$this->isNew();
        if (null === $this->collPurchasesRelatedByUsrIdBuyer || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPurchasesRelatedByUsrIdBuyer) {
                // return empty collection
                $this->initPurchasesRelatedByUsrIdBuyer();
            } else {
                $collPurchasesRelatedByUsrIdBuyer = PurchaseQuery::create(null, $criteria)
                    ->filterByUserRelatedByUsrIdBuyer($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPurchasesRelatedByUsrIdBuyerPartial && count($collPurchasesRelatedByUsrIdBuyer)) {
                      $this->initPurchasesRelatedByUsrIdBuyer(false);

                      foreach($collPurchasesRelatedByUsrIdBuyer as $obj) {
                        if (false == $this->collPurchasesRelatedByUsrIdBuyer->contains($obj)) {
                          $this->collPurchasesRelatedByUsrIdBuyer->append($obj);
                        }
                      }

                      $this->collPurchasesRelatedByUsrIdBuyerPartial = true;
                    }

                    return $collPurchasesRelatedByUsrIdBuyer;
                }

                if($partial && $this->collPurchasesRelatedByUsrIdBuyer) {
                    foreach($this->collPurchasesRelatedByUsrIdBuyer as $obj) {
                        if($obj->isNew()) {
                            $collPurchasesRelatedByUsrIdBuyer[] = $obj;
                        }
                    }
                }

                $this->collPurchasesRelatedByUsrIdBuyer = $collPurchasesRelatedByUsrIdBuyer;
                $this->collPurchasesRelatedByUsrIdBuyerPartial = false;
            }
        }

        return $this->collPurchasesRelatedByUsrIdBuyer;
    }

    /**
     * Sets a collection of PurchaseRelatedByUsrIdBuyer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $purchasesRelatedByUsrIdBuyer A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setPurchasesRelatedByUsrIdBuyer(PropelCollection $purchasesRelatedByUsrIdBuyer, PropelPDO $con = null)
    {
        $this->purchasesRelatedByUsrIdBuyerScheduledForDeletion = $this->getPurchasesRelatedByUsrIdBuyer(new Criteria(), $con)->diff($purchasesRelatedByUsrIdBuyer);

        foreach ($this->purchasesRelatedByUsrIdBuyerScheduledForDeletion as $purchaseRelatedByUsrIdBuyerRemoved) {
            $purchaseRelatedByUsrIdBuyerRemoved->setUserRelatedByUsrIdBuyer(null);
        }

        $this->collPurchasesRelatedByUsrIdBuyer = null;
        foreach ($purchasesRelatedByUsrIdBuyer as $purchaseRelatedByUsrIdBuyer) {
            $this->addPurchaseRelatedByUsrIdBuyer($purchaseRelatedByUsrIdBuyer);
        }

        $this->collPurchasesRelatedByUsrIdBuyer = $purchasesRelatedByUsrIdBuyer;
        $this->collPurchasesRelatedByUsrIdBuyerPartial = false;
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
    public function countPurchasesRelatedByUsrIdBuyer(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPurchasesRelatedByUsrIdBuyerPartial && !$this->isNew();
        if (null === $this->collPurchasesRelatedByUsrIdBuyer || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPurchasesRelatedByUsrIdBuyer) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getPurchasesRelatedByUsrIdBuyer());
                }
                $query = PurchaseQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUserRelatedByUsrIdBuyer($this)
                    ->count($con);
            }
        } else {
            return count($this->collPurchasesRelatedByUsrIdBuyer);
        }
    }

    /**
     * Method called to associate a Purchase object to this object
     * through the Purchase foreign key attribute.
     *
     * @param    Purchase $l Purchase
     * @return User The current object (for fluent API support)
     */
    public function addPurchaseRelatedByUsrIdBuyer(Purchase $l)
    {
        if ($this->collPurchasesRelatedByUsrIdBuyer === null) {
            $this->initPurchasesRelatedByUsrIdBuyer();
            $this->collPurchasesRelatedByUsrIdBuyerPartial = true;
        }
        if (!in_array($l, $this->collPurchasesRelatedByUsrIdBuyer->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPurchaseRelatedByUsrIdBuyer($l);
        }

        return $this;
    }

    /**
     * @param	PurchaseRelatedByUsrIdBuyer $purchaseRelatedByUsrIdBuyer The purchaseRelatedByUsrIdBuyer object to add.
     */
    protected function doAddPurchaseRelatedByUsrIdBuyer($purchaseRelatedByUsrIdBuyer)
    {
        $this->collPurchasesRelatedByUsrIdBuyer[]= $purchaseRelatedByUsrIdBuyer;
        $purchaseRelatedByUsrIdBuyer->setUserRelatedByUsrIdBuyer($this);
    }

    /**
     * @param	PurchaseRelatedByUsrIdBuyer $purchaseRelatedByUsrIdBuyer The purchaseRelatedByUsrIdBuyer object to remove.
     */
    public function removePurchaseRelatedByUsrIdBuyer($purchaseRelatedByUsrIdBuyer)
    {
        if ($this->getPurchasesRelatedByUsrIdBuyer()->contains($purchaseRelatedByUsrIdBuyer)) {
            $this->collPurchasesRelatedByUsrIdBuyer->remove($this->collPurchasesRelatedByUsrIdBuyer->search($purchaseRelatedByUsrIdBuyer));
            if (null === $this->purchasesRelatedByUsrIdBuyerScheduledForDeletion) {
                $this->purchasesRelatedByUsrIdBuyerScheduledForDeletion = clone $this->collPurchasesRelatedByUsrIdBuyer;
                $this->purchasesRelatedByUsrIdBuyerScheduledForDeletion->clear();
            }
            $this->purchasesRelatedByUsrIdBuyerScheduledForDeletion[]= $purchaseRelatedByUsrIdBuyer;
            $purchaseRelatedByUsrIdBuyer->setUserRelatedByUsrIdBuyer(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related PurchasesRelatedByUsrIdBuyer from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     */
    public function getPurchasesRelatedByUsrIdBuyerJoinItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PurchaseQuery::create(null, $criteria);
        $query->joinWith('Item', $join_behavior);

        return $this->getPurchasesRelatedByUsrIdBuyer($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related PurchasesRelatedByUsrIdBuyer from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     */
    public function getPurchasesRelatedByUsrIdBuyerJoinPoint($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PurchaseQuery::create(null, $criteria);
        $query->joinWith('Point', $join_behavior);

        return $this->getPurchasesRelatedByUsrIdBuyer($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related PurchasesRelatedByUsrIdBuyer from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     */
    public function getPurchasesRelatedByUsrIdBuyerJoinFundation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PurchaseQuery::create(null, $criteria);
        $query->joinWith('Fundation', $join_behavior);

        return $this->getPurchasesRelatedByUsrIdBuyer($query, $con);
    }

    /**
     * Clears out the collPurchasesRelatedByUsrIdSeller collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPurchasesRelatedByUsrIdSeller()
     */
    public function clearPurchasesRelatedByUsrIdSeller()
    {
        $this->collPurchasesRelatedByUsrIdSeller = null; // important to set this to null since that means it is uninitialized
        $this->collPurchasesRelatedByUsrIdSellerPartial = null;
    }

    /**
     * reset is the collPurchasesRelatedByUsrIdSeller collection loaded partially
     *
     * @return void
     */
    public function resetPartialPurchasesRelatedByUsrIdSeller($v = true)
    {
        $this->collPurchasesRelatedByUsrIdSellerPartial = $v;
    }

    /**
     * Initializes the collPurchasesRelatedByUsrIdSeller collection.
     *
     * By default this just sets the collPurchasesRelatedByUsrIdSeller collection to an empty array (like clearcollPurchasesRelatedByUsrIdSeller());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPurchasesRelatedByUsrIdSeller($overrideExisting = true)
    {
        if (null !== $this->collPurchasesRelatedByUsrIdSeller && !$overrideExisting) {
            return;
        }
        $this->collPurchasesRelatedByUsrIdSeller = new PropelObjectCollection();
        $this->collPurchasesRelatedByUsrIdSeller->setModel('Purchase');
    }

    /**
     * Gets an array of Purchase objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     * @throws PropelException
     */
    public function getPurchasesRelatedByUsrIdSeller($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPurchasesRelatedByUsrIdSellerPartial && !$this->isNew();
        if (null === $this->collPurchasesRelatedByUsrIdSeller || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPurchasesRelatedByUsrIdSeller) {
                // return empty collection
                $this->initPurchasesRelatedByUsrIdSeller();
            } else {
                $collPurchasesRelatedByUsrIdSeller = PurchaseQuery::create(null, $criteria)
                    ->filterByUserRelatedByUsrIdSeller($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPurchasesRelatedByUsrIdSellerPartial && count($collPurchasesRelatedByUsrIdSeller)) {
                      $this->initPurchasesRelatedByUsrIdSeller(false);

                      foreach($collPurchasesRelatedByUsrIdSeller as $obj) {
                        if (false == $this->collPurchasesRelatedByUsrIdSeller->contains($obj)) {
                          $this->collPurchasesRelatedByUsrIdSeller->append($obj);
                        }
                      }

                      $this->collPurchasesRelatedByUsrIdSellerPartial = true;
                    }

                    return $collPurchasesRelatedByUsrIdSeller;
                }

                if($partial && $this->collPurchasesRelatedByUsrIdSeller) {
                    foreach($this->collPurchasesRelatedByUsrIdSeller as $obj) {
                        if($obj->isNew()) {
                            $collPurchasesRelatedByUsrIdSeller[] = $obj;
                        }
                    }
                }

                $this->collPurchasesRelatedByUsrIdSeller = $collPurchasesRelatedByUsrIdSeller;
                $this->collPurchasesRelatedByUsrIdSellerPartial = false;
            }
        }

        return $this->collPurchasesRelatedByUsrIdSeller;
    }

    /**
     * Sets a collection of PurchaseRelatedByUsrIdSeller objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $purchasesRelatedByUsrIdSeller A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setPurchasesRelatedByUsrIdSeller(PropelCollection $purchasesRelatedByUsrIdSeller, PropelPDO $con = null)
    {
        $this->purchasesRelatedByUsrIdSellerScheduledForDeletion = $this->getPurchasesRelatedByUsrIdSeller(new Criteria(), $con)->diff($purchasesRelatedByUsrIdSeller);

        foreach ($this->purchasesRelatedByUsrIdSellerScheduledForDeletion as $purchaseRelatedByUsrIdSellerRemoved) {
            $purchaseRelatedByUsrIdSellerRemoved->setUserRelatedByUsrIdSeller(null);
        }

        $this->collPurchasesRelatedByUsrIdSeller = null;
        foreach ($purchasesRelatedByUsrIdSeller as $purchaseRelatedByUsrIdSeller) {
            $this->addPurchaseRelatedByUsrIdSeller($purchaseRelatedByUsrIdSeller);
        }

        $this->collPurchasesRelatedByUsrIdSeller = $purchasesRelatedByUsrIdSeller;
        $this->collPurchasesRelatedByUsrIdSellerPartial = false;
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
    public function countPurchasesRelatedByUsrIdSeller(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPurchasesRelatedByUsrIdSellerPartial && !$this->isNew();
        if (null === $this->collPurchasesRelatedByUsrIdSeller || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPurchasesRelatedByUsrIdSeller) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getPurchasesRelatedByUsrIdSeller());
                }
                $query = PurchaseQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUserRelatedByUsrIdSeller($this)
                    ->count($con);
            }
        } else {
            return count($this->collPurchasesRelatedByUsrIdSeller);
        }
    }

    /**
     * Method called to associate a Purchase object to this object
     * through the Purchase foreign key attribute.
     *
     * @param    Purchase $l Purchase
     * @return User The current object (for fluent API support)
     */
    public function addPurchaseRelatedByUsrIdSeller(Purchase $l)
    {
        if ($this->collPurchasesRelatedByUsrIdSeller === null) {
            $this->initPurchasesRelatedByUsrIdSeller();
            $this->collPurchasesRelatedByUsrIdSellerPartial = true;
        }
        if (!in_array($l, $this->collPurchasesRelatedByUsrIdSeller->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPurchaseRelatedByUsrIdSeller($l);
        }

        return $this;
    }

    /**
     * @param	PurchaseRelatedByUsrIdSeller $purchaseRelatedByUsrIdSeller The purchaseRelatedByUsrIdSeller object to add.
     */
    protected function doAddPurchaseRelatedByUsrIdSeller($purchaseRelatedByUsrIdSeller)
    {
        $this->collPurchasesRelatedByUsrIdSeller[]= $purchaseRelatedByUsrIdSeller;
        $purchaseRelatedByUsrIdSeller->setUserRelatedByUsrIdSeller($this);
    }

    /**
     * @param	PurchaseRelatedByUsrIdSeller $purchaseRelatedByUsrIdSeller The purchaseRelatedByUsrIdSeller object to remove.
     */
    public function removePurchaseRelatedByUsrIdSeller($purchaseRelatedByUsrIdSeller)
    {
        if ($this->getPurchasesRelatedByUsrIdSeller()->contains($purchaseRelatedByUsrIdSeller)) {
            $this->collPurchasesRelatedByUsrIdSeller->remove($this->collPurchasesRelatedByUsrIdSeller->search($purchaseRelatedByUsrIdSeller));
            if (null === $this->purchasesRelatedByUsrIdSellerScheduledForDeletion) {
                $this->purchasesRelatedByUsrIdSellerScheduledForDeletion = clone $this->collPurchasesRelatedByUsrIdSeller;
                $this->purchasesRelatedByUsrIdSellerScheduledForDeletion->clear();
            }
            $this->purchasesRelatedByUsrIdSellerScheduledForDeletion[]= $purchaseRelatedByUsrIdSeller;
            $purchaseRelatedByUsrIdSeller->setUserRelatedByUsrIdSeller(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related PurchasesRelatedByUsrIdSeller from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     */
    public function getPurchasesRelatedByUsrIdSellerJoinItem($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PurchaseQuery::create(null, $criteria);
        $query->joinWith('Item', $join_behavior);

        return $this->getPurchasesRelatedByUsrIdSeller($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related PurchasesRelatedByUsrIdSeller from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     */
    public function getPurchasesRelatedByUsrIdSellerJoinPoint($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PurchaseQuery::create(null, $criteria);
        $query->joinWith('Point', $join_behavior);

        return $this->getPurchasesRelatedByUsrIdSeller($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related PurchasesRelatedByUsrIdSeller from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Purchase[] List of Purchase objects
     */
    public function getPurchasesRelatedByUsrIdSellerJoinFundation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PurchaseQuery::create(null, $criteria);
        $query->joinWith('Fundation', $join_behavior);

        return $this->getPurchasesRelatedByUsrIdSeller($query, $con);
    }

    /**
     * Clears out the collRechargesRelatedByUsrIdBuyer collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRechargesRelatedByUsrIdBuyer()
     */
    public function clearRechargesRelatedByUsrIdBuyer()
    {
        $this->collRechargesRelatedByUsrIdBuyer = null; // important to set this to null since that means it is uninitialized
        $this->collRechargesRelatedByUsrIdBuyerPartial = null;
    }

    /**
     * reset is the collRechargesRelatedByUsrIdBuyer collection loaded partially
     *
     * @return void
     */
    public function resetPartialRechargesRelatedByUsrIdBuyer($v = true)
    {
        $this->collRechargesRelatedByUsrIdBuyerPartial = $v;
    }

    /**
     * Initializes the collRechargesRelatedByUsrIdBuyer collection.
     *
     * By default this just sets the collRechargesRelatedByUsrIdBuyer collection to an empty array (like clearcollRechargesRelatedByUsrIdBuyer());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRechargesRelatedByUsrIdBuyer($overrideExisting = true)
    {
        if (null !== $this->collRechargesRelatedByUsrIdBuyer && !$overrideExisting) {
            return;
        }
        $this->collRechargesRelatedByUsrIdBuyer = new PropelObjectCollection();
        $this->collRechargesRelatedByUsrIdBuyer->setModel('Recharge');
    }

    /**
     * Gets an array of Recharge objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Recharge[] List of Recharge objects
     * @throws PropelException
     */
    public function getRechargesRelatedByUsrIdBuyer($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRechargesRelatedByUsrIdBuyerPartial && !$this->isNew();
        if (null === $this->collRechargesRelatedByUsrIdBuyer || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRechargesRelatedByUsrIdBuyer) {
                // return empty collection
                $this->initRechargesRelatedByUsrIdBuyer();
            } else {
                $collRechargesRelatedByUsrIdBuyer = RechargeQuery::create(null, $criteria)
                    ->filterByUserRelatedByUsrIdBuyer($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRechargesRelatedByUsrIdBuyerPartial && count($collRechargesRelatedByUsrIdBuyer)) {
                      $this->initRechargesRelatedByUsrIdBuyer(false);

                      foreach($collRechargesRelatedByUsrIdBuyer as $obj) {
                        if (false == $this->collRechargesRelatedByUsrIdBuyer->contains($obj)) {
                          $this->collRechargesRelatedByUsrIdBuyer->append($obj);
                        }
                      }

                      $this->collRechargesRelatedByUsrIdBuyerPartial = true;
                    }

                    return $collRechargesRelatedByUsrIdBuyer;
                }

                if($partial && $this->collRechargesRelatedByUsrIdBuyer) {
                    foreach($this->collRechargesRelatedByUsrIdBuyer as $obj) {
                        if($obj->isNew()) {
                            $collRechargesRelatedByUsrIdBuyer[] = $obj;
                        }
                    }
                }

                $this->collRechargesRelatedByUsrIdBuyer = $collRechargesRelatedByUsrIdBuyer;
                $this->collRechargesRelatedByUsrIdBuyerPartial = false;
            }
        }

        return $this->collRechargesRelatedByUsrIdBuyer;
    }

    /**
     * Sets a collection of RechargeRelatedByUsrIdBuyer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $rechargesRelatedByUsrIdBuyer A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setRechargesRelatedByUsrIdBuyer(PropelCollection $rechargesRelatedByUsrIdBuyer, PropelPDO $con = null)
    {
        $this->rechargesRelatedByUsrIdBuyerScheduledForDeletion = $this->getRechargesRelatedByUsrIdBuyer(new Criteria(), $con)->diff($rechargesRelatedByUsrIdBuyer);

        foreach ($this->rechargesRelatedByUsrIdBuyerScheduledForDeletion as $rechargeRelatedByUsrIdBuyerRemoved) {
            $rechargeRelatedByUsrIdBuyerRemoved->setUserRelatedByUsrIdBuyer(null);
        }

        $this->collRechargesRelatedByUsrIdBuyer = null;
        foreach ($rechargesRelatedByUsrIdBuyer as $rechargeRelatedByUsrIdBuyer) {
            $this->addRechargeRelatedByUsrIdBuyer($rechargeRelatedByUsrIdBuyer);
        }

        $this->collRechargesRelatedByUsrIdBuyer = $rechargesRelatedByUsrIdBuyer;
        $this->collRechargesRelatedByUsrIdBuyerPartial = false;
    }

    /**
     * Returns the number of related Recharge objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Recharge objects.
     * @throws PropelException
     */
    public function countRechargesRelatedByUsrIdBuyer(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRechargesRelatedByUsrIdBuyerPartial && !$this->isNew();
        if (null === $this->collRechargesRelatedByUsrIdBuyer || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRechargesRelatedByUsrIdBuyer) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getRechargesRelatedByUsrIdBuyer());
                }
                $query = RechargeQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUserRelatedByUsrIdBuyer($this)
                    ->count($con);
            }
        } else {
            return count($this->collRechargesRelatedByUsrIdBuyer);
        }
    }

    /**
     * Method called to associate a Recharge object to this object
     * through the Recharge foreign key attribute.
     *
     * @param    Recharge $l Recharge
     * @return User The current object (for fluent API support)
     */
    public function addRechargeRelatedByUsrIdBuyer(Recharge $l)
    {
        if ($this->collRechargesRelatedByUsrIdBuyer === null) {
            $this->initRechargesRelatedByUsrIdBuyer();
            $this->collRechargesRelatedByUsrIdBuyerPartial = true;
        }
        if (!in_array($l, $this->collRechargesRelatedByUsrIdBuyer->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRechargeRelatedByUsrIdBuyer($l);
        }

        return $this;
    }

    /**
     * @param	RechargeRelatedByUsrIdBuyer $rechargeRelatedByUsrIdBuyer The rechargeRelatedByUsrIdBuyer object to add.
     */
    protected function doAddRechargeRelatedByUsrIdBuyer($rechargeRelatedByUsrIdBuyer)
    {
        $this->collRechargesRelatedByUsrIdBuyer[]= $rechargeRelatedByUsrIdBuyer;
        $rechargeRelatedByUsrIdBuyer->setUserRelatedByUsrIdBuyer($this);
    }

    /**
     * @param	RechargeRelatedByUsrIdBuyer $rechargeRelatedByUsrIdBuyer The rechargeRelatedByUsrIdBuyer object to remove.
     */
    public function removeRechargeRelatedByUsrIdBuyer($rechargeRelatedByUsrIdBuyer)
    {
        if ($this->getRechargesRelatedByUsrIdBuyer()->contains($rechargeRelatedByUsrIdBuyer)) {
            $this->collRechargesRelatedByUsrIdBuyer->remove($this->collRechargesRelatedByUsrIdBuyer->search($rechargeRelatedByUsrIdBuyer));
            if (null === $this->rechargesRelatedByUsrIdBuyerScheduledForDeletion) {
                $this->rechargesRelatedByUsrIdBuyerScheduledForDeletion = clone $this->collRechargesRelatedByUsrIdBuyer;
                $this->rechargesRelatedByUsrIdBuyerScheduledForDeletion->clear();
            }
            $this->rechargesRelatedByUsrIdBuyerScheduledForDeletion[]= $rechargeRelatedByUsrIdBuyer;
            $rechargeRelatedByUsrIdBuyer->setUserRelatedByUsrIdBuyer(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RechargesRelatedByUsrIdBuyer from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recharge[] List of Recharge objects
     */
    public function getRechargesRelatedByUsrIdBuyerJoinPoint($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RechargeQuery::create(null, $criteria);
        $query->joinWith('Point', $join_behavior);

        return $this->getRechargesRelatedByUsrIdBuyer($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RechargesRelatedByUsrIdBuyer from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recharge[] List of Recharge objects
     */
    public function getRechargesRelatedByUsrIdBuyerJoinRechargeType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RechargeQuery::create(null, $criteria);
        $query->joinWith('RechargeType', $join_behavior);

        return $this->getRechargesRelatedByUsrIdBuyer($query, $con);
    }

    /**
     * Clears out the collRechargesRelatedByUsrIdOperator collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRechargesRelatedByUsrIdOperator()
     */
    public function clearRechargesRelatedByUsrIdOperator()
    {
        $this->collRechargesRelatedByUsrIdOperator = null; // important to set this to null since that means it is uninitialized
        $this->collRechargesRelatedByUsrIdOperatorPartial = null;
    }

    /**
     * reset is the collRechargesRelatedByUsrIdOperator collection loaded partially
     *
     * @return void
     */
    public function resetPartialRechargesRelatedByUsrIdOperator($v = true)
    {
        $this->collRechargesRelatedByUsrIdOperatorPartial = $v;
    }

    /**
     * Initializes the collRechargesRelatedByUsrIdOperator collection.
     *
     * By default this just sets the collRechargesRelatedByUsrIdOperator collection to an empty array (like clearcollRechargesRelatedByUsrIdOperator());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRechargesRelatedByUsrIdOperator($overrideExisting = true)
    {
        if (null !== $this->collRechargesRelatedByUsrIdOperator && !$overrideExisting) {
            return;
        }
        $this->collRechargesRelatedByUsrIdOperator = new PropelObjectCollection();
        $this->collRechargesRelatedByUsrIdOperator->setModel('Recharge');
    }

    /**
     * Gets an array of Recharge objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Recharge[] List of Recharge objects
     * @throws PropelException
     */
    public function getRechargesRelatedByUsrIdOperator($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRechargesRelatedByUsrIdOperatorPartial && !$this->isNew();
        if (null === $this->collRechargesRelatedByUsrIdOperator || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRechargesRelatedByUsrIdOperator) {
                // return empty collection
                $this->initRechargesRelatedByUsrIdOperator();
            } else {
                $collRechargesRelatedByUsrIdOperator = RechargeQuery::create(null, $criteria)
                    ->filterByUserRelatedByUsrIdOperator($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRechargesRelatedByUsrIdOperatorPartial && count($collRechargesRelatedByUsrIdOperator)) {
                      $this->initRechargesRelatedByUsrIdOperator(false);

                      foreach($collRechargesRelatedByUsrIdOperator as $obj) {
                        if (false == $this->collRechargesRelatedByUsrIdOperator->contains($obj)) {
                          $this->collRechargesRelatedByUsrIdOperator->append($obj);
                        }
                      }

                      $this->collRechargesRelatedByUsrIdOperatorPartial = true;
                    }

                    return $collRechargesRelatedByUsrIdOperator;
                }

                if($partial && $this->collRechargesRelatedByUsrIdOperator) {
                    foreach($this->collRechargesRelatedByUsrIdOperator as $obj) {
                        if($obj->isNew()) {
                            $collRechargesRelatedByUsrIdOperator[] = $obj;
                        }
                    }
                }

                $this->collRechargesRelatedByUsrIdOperator = $collRechargesRelatedByUsrIdOperator;
                $this->collRechargesRelatedByUsrIdOperatorPartial = false;
            }
        }

        return $this->collRechargesRelatedByUsrIdOperator;
    }

    /**
     * Sets a collection of RechargeRelatedByUsrIdOperator objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $rechargesRelatedByUsrIdOperator A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setRechargesRelatedByUsrIdOperator(PropelCollection $rechargesRelatedByUsrIdOperator, PropelPDO $con = null)
    {
        $this->rechargesRelatedByUsrIdOperatorScheduledForDeletion = $this->getRechargesRelatedByUsrIdOperator(new Criteria(), $con)->diff($rechargesRelatedByUsrIdOperator);

        foreach ($this->rechargesRelatedByUsrIdOperatorScheduledForDeletion as $rechargeRelatedByUsrIdOperatorRemoved) {
            $rechargeRelatedByUsrIdOperatorRemoved->setUserRelatedByUsrIdOperator(null);
        }

        $this->collRechargesRelatedByUsrIdOperator = null;
        foreach ($rechargesRelatedByUsrIdOperator as $rechargeRelatedByUsrIdOperator) {
            $this->addRechargeRelatedByUsrIdOperator($rechargeRelatedByUsrIdOperator);
        }

        $this->collRechargesRelatedByUsrIdOperator = $rechargesRelatedByUsrIdOperator;
        $this->collRechargesRelatedByUsrIdOperatorPartial = false;
    }

    /**
     * Returns the number of related Recharge objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Recharge objects.
     * @throws PropelException
     */
    public function countRechargesRelatedByUsrIdOperator(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRechargesRelatedByUsrIdOperatorPartial && !$this->isNew();
        if (null === $this->collRechargesRelatedByUsrIdOperator || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRechargesRelatedByUsrIdOperator) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getRechargesRelatedByUsrIdOperator());
                }
                $query = RechargeQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUserRelatedByUsrIdOperator($this)
                    ->count($con);
            }
        } else {
            return count($this->collRechargesRelatedByUsrIdOperator);
        }
    }

    /**
     * Method called to associate a Recharge object to this object
     * through the Recharge foreign key attribute.
     *
     * @param    Recharge $l Recharge
     * @return User The current object (for fluent API support)
     */
    public function addRechargeRelatedByUsrIdOperator(Recharge $l)
    {
        if ($this->collRechargesRelatedByUsrIdOperator === null) {
            $this->initRechargesRelatedByUsrIdOperator();
            $this->collRechargesRelatedByUsrIdOperatorPartial = true;
        }
        if (!in_array($l, $this->collRechargesRelatedByUsrIdOperator->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRechargeRelatedByUsrIdOperator($l);
        }

        return $this;
    }

    /**
     * @param	RechargeRelatedByUsrIdOperator $rechargeRelatedByUsrIdOperator The rechargeRelatedByUsrIdOperator object to add.
     */
    protected function doAddRechargeRelatedByUsrIdOperator($rechargeRelatedByUsrIdOperator)
    {
        $this->collRechargesRelatedByUsrIdOperator[]= $rechargeRelatedByUsrIdOperator;
        $rechargeRelatedByUsrIdOperator->setUserRelatedByUsrIdOperator($this);
    }

    /**
     * @param	RechargeRelatedByUsrIdOperator $rechargeRelatedByUsrIdOperator The rechargeRelatedByUsrIdOperator object to remove.
     */
    public function removeRechargeRelatedByUsrIdOperator($rechargeRelatedByUsrIdOperator)
    {
        if ($this->getRechargesRelatedByUsrIdOperator()->contains($rechargeRelatedByUsrIdOperator)) {
            $this->collRechargesRelatedByUsrIdOperator->remove($this->collRechargesRelatedByUsrIdOperator->search($rechargeRelatedByUsrIdOperator));
            if (null === $this->rechargesRelatedByUsrIdOperatorScheduledForDeletion) {
                $this->rechargesRelatedByUsrIdOperatorScheduledForDeletion = clone $this->collRechargesRelatedByUsrIdOperator;
                $this->rechargesRelatedByUsrIdOperatorScheduledForDeletion->clear();
            }
            $this->rechargesRelatedByUsrIdOperatorScheduledForDeletion[]= $rechargeRelatedByUsrIdOperator;
            $rechargeRelatedByUsrIdOperator->setUserRelatedByUsrIdOperator(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RechargesRelatedByUsrIdOperator from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recharge[] List of Recharge objects
     */
    public function getRechargesRelatedByUsrIdOperatorJoinPoint($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RechargeQuery::create(null, $criteria);
        $query->joinWith('Point', $join_behavior);

        return $this->getRechargesRelatedByUsrIdOperator($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RechargesRelatedByUsrIdOperator from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recharge[] List of Recharge objects
     */
    public function getRechargesRelatedByUsrIdOperatorJoinRechargeType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RechargeQuery::create(null, $criteria);
        $query->joinWith('RechargeType', $join_behavior);

        return $this->getRechargesRelatedByUsrIdOperator($query, $con);
    }

    /**
     * Clears out the collSherlockss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSherlockss()
     */
    public function clearSherlockss()
    {
        $this->collSherlockss = null; // important to set this to null since that means it is uninitialized
        $this->collSherlockssPartial = null;
    }

    /**
     * reset is the collSherlockss collection loaded partially
     *
     * @return void
     */
    public function resetPartialSherlockss($v = true)
    {
        $this->collSherlockssPartial = $v;
    }

    /**
     * Initializes the collSherlockss collection.
     *
     * By default this just sets the collSherlockss collection to an empty array (like clearcollSherlockss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSherlockss($overrideExisting = true)
    {
        if (null !== $this->collSherlockss && !$overrideExisting) {
            return;
        }
        $this->collSherlockss = new PropelObjectCollection();
        $this->collSherlockss->setModel('Sherlocks');
    }

    /**
     * Gets an array of Sherlocks objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Sherlocks[] List of Sherlocks objects
     * @throws PropelException
     */
    public function getSherlockss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collSherlockssPartial && !$this->isNew();
        if (null === $this->collSherlockss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSherlockss) {
                // return empty collection
                $this->initSherlockss();
            } else {
                $collSherlockss = SherlocksQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collSherlockssPartial && count($collSherlockss)) {
                      $this->initSherlockss(false);

                      foreach($collSherlockss as $obj) {
                        if (false == $this->collSherlockss->contains($obj)) {
                          $this->collSherlockss->append($obj);
                        }
                      }

                      $this->collSherlockssPartial = true;
                    }

                    return $collSherlockss;
                }

                if($partial && $this->collSherlockss) {
                    foreach($this->collSherlockss as $obj) {
                        if($obj->isNew()) {
                            $collSherlockss[] = $obj;
                        }
                    }
                }

                $this->collSherlockss = $collSherlockss;
                $this->collSherlockssPartial = false;
            }
        }

        return $this->collSherlockss;
    }

    /**
     * Sets a collection of Sherlocks objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $sherlockss A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setSherlockss(PropelCollection $sherlockss, PropelPDO $con = null)
    {
        $this->sherlockssScheduledForDeletion = $this->getSherlockss(new Criteria(), $con)->diff($sherlockss);

        foreach ($this->sherlockssScheduledForDeletion as $sherlocksRemoved) {
            $sherlocksRemoved->setUser(null);
        }

        $this->collSherlockss = null;
        foreach ($sherlockss as $sherlocks) {
            $this->addSherlocks($sherlocks);
        }

        $this->collSherlockss = $sherlockss;
        $this->collSherlockssPartial = false;
    }

    /**
     * Returns the number of related Sherlocks objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Sherlocks objects.
     * @throws PropelException
     */
    public function countSherlockss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collSherlockssPartial && !$this->isNew();
        if (null === $this->collSherlockss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSherlockss) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getSherlockss());
                }
                $query = SherlocksQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collSherlockss);
        }
    }

    /**
     * Method called to associate a Sherlocks object to this object
     * through the Sherlocks foreign key attribute.
     *
     * @param    Sherlocks $l Sherlocks
     * @return User The current object (for fluent API support)
     */
    public function addSherlocks(Sherlocks $l)
    {
        if ($this->collSherlockss === null) {
            $this->initSherlockss();
            $this->collSherlockssPartial = true;
        }
        if (!in_array($l, $this->collSherlockss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddSherlocks($l);
        }

        return $this;
    }

    /**
     * @param	Sherlocks $sherlocks The sherlocks object to add.
     */
    protected function doAddSherlocks($sherlocks)
    {
        $this->collSherlockss[]= $sherlocks;
        $sherlocks->setUser($this);
    }

    /**
     * @param	Sherlocks $sherlocks The sherlocks object to remove.
     */
    public function removeSherlocks($sherlocks)
    {
        if ($this->getSherlockss()->contains($sherlocks)) {
            $this->collSherlockss->remove($this->collSherlockss->search($sherlocks));
            if (null === $this->sherlockssScheduledForDeletion) {
                $this->sherlockssScheduledForDeletion = clone $this->collSherlockss;
                $this->sherlockssScheduledForDeletion->clear();
            }
            $this->sherlockssScheduledForDeletion[]= $sherlocks;
            $sherlocks->setUser(null);
        }
    }

    /**
     * Clears out the collVirementsRelatedByUsrIdTo collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVirementsRelatedByUsrIdTo()
     */
    public function clearVirementsRelatedByUsrIdTo()
    {
        $this->collVirementsRelatedByUsrIdTo = null; // important to set this to null since that means it is uninitialized
        $this->collVirementsRelatedByUsrIdToPartial = null;
    }

    /**
     * reset is the collVirementsRelatedByUsrIdTo collection loaded partially
     *
     * @return void
     */
    public function resetPartialVirementsRelatedByUsrIdTo($v = true)
    {
        $this->collVirementsRelatedByUsrIdToPartial = $v;
    }

    /**
     * Initializes the collVirementsRelatedByUsrIdTo collection.
     *
     * By default this just sets the collVirementsRelatedByUsrIdTo collection to an empty array (like clearcollVirementsRelatedByUsrIdTo());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVirementsRelatedByUsrIdTo($overrideExisting = true)
    {
        if (null !== $this->collVirementsRelatedByUsrIdTo && !$overrideExisting) {
            return;
        }
        $this->collVirementsRelatedByUsrIdTo = new PropelObjectCollection();
        $this->collVirementsRelatedByUsrIdTo->setModel('Virement');
    }

    /**
     * Gets an array of Virement objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Virement[] List of Virement objects
     * @throws PropelException
     */
    public function getVirementsRelatedByUsrIdTo($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collVirementsRelatedByUsrIdToPartial && !$this->isNew();
        if (null === $this->collVirementsRelatedByUsrIdTo || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVirementsRelatedByUsrIdTo) {
                // return empty collection
                $this->initVirementsRelatedByUsrIdTo();
            } else {
                $collVirementsRelatedByUsrIdTo = VirementQuery::create(null, $criteria)
                    ->filterByUserRelatedByUsrIdTo($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collVirementsRelatedByUsrIdToPartial && count($collVirementsRelatedByUsrIdTo)) {
                      $this->initVirementsRelatedByUsrIdTo(false);

                      foreach($collVirementsRelatedByUsrIdTo as $obj) {
                        if (false == $this->collVirementsRelatedByUsrIdTo->contains($obj)) {
                          $this->collVirementsRelatedByUsrIdTo->append($obj);
                        }
                      }

                      $this->collVirementsRelatedByUsrIdToPartial = true;
                    }

                    return $collVirementsRelatedByUsrIdTo;
                }

                if($partial && $this->collVirementsRelatedByUsrIdTo) {
                    foreach($this->collVirementsRelatedByUsrIdTo as $obj) {
                        if($obj->isNew()) {
                            $collVirementsRelatedByUsrIdTo[] = $obj;
                        }
                    }
                }

                $this->collVirementsRelatedByUsrIdTo = $collVirementsRelatedByUsrIdTo;
                $this->collVirementsRelatedByUsrIdToPartial = false;
            }
        }

        return $this->collVirementsRelatedByUsrIdTo;
    }

    /**
     * Sets a collection of VirementRelatedByUsrIdTo objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $virementsRelatedByUsrIdTo A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setVirementsRelatedByUsrIdTo(PropelCollection $virementsRelatedByUsrIdTo, PropelPDO $con = null)
    {
        $this->virementsRelatedByUsrIdToScheduledForDeletion = $this->getVirementsRelatedByUsrIdTo(new Criteria(), $con)->diff($virementsRelatedByUsrIdTo);

        foreach ($this->virementsRelatedByUsrIdToScheduledForDeletion as $virementRelatedByUsrIdToRemoved) {
            $virementRelatedByUsrIdToRemoved->setUserRelatedByUsrIdTo(null);
        }

        $this->collVirementsRelatedByUsrIdTo = null;
        foreach ($virementsRelatedByUsrIdTo as $virementRelatedByUsrIdTo) {
            $this->addVirementRelatedByUsrIdTo($virementRelatedByUsrIdTo);
        }

        $this->collVirementsRelatedByUsrIdTo = $virementsRelatedByUsrIdTo;
        $this->collVirementsRelatedByUsrIdToPartial = false;
    }

    /**
     * Returns the number of related Virement objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Virement objects.
     * @throws PropelException
     */
    public function countVirementsRelatedByUsrIdTo(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collVirementsRelatedByUsrIdToPartial && !$this->isNew();
        if (null === $this->collVirementsRelatedByUsrIdTo || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVirementsRelatedByUsrIdTo) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getVirementsRelatedByUsrIdTo());
                }
                $query = VirementQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUserRelatedByUsrIdTo($this)
                    ->count($con);
            }
        } else {
            return count($this->collVirementsRelatedByUsrIdTo);
        }
    }

    /**
     * Method called to associate a Virement object to this object
     * through the Virement foreign key attribute.
     *
     * @param    Virement $l Virement
     * @return User The current object (for fluent API support)
     */
    public function addVirementRelatedByUsrIdTo(Virement $l)
    {
        if ($this->collVirementsRelatedByUsrIdTo === null) {
            $this->initVirementsRelatedByUsrIdTo();
            $this->collVirementsRelatedByUsrIdToPartial = true;
        }
        if (!in_array($l, $this->collVirementsRelatedByUsrIdTo->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddVirementRelatedByUsrIdTo($l);
        }

        return $this;
    }

    /**
     * @param	VirementRelatedByUsrIdTo $virementRelatedByUsrIdTo The virementRelatedByUsrIdTo object to add.
     */
    protected function doAddVirementRelatedByUsrIdTo($virementRelatedByUsrIdTo)
    {
        $this->collVirementsRelatedByUsrIdTo[]= $virementRelatedByUsrIdTo;
        $virementRelatedByUsrIdTo->setUserRelatedByUsrIdTo($this);
    }

    /**
     * @param	VirementRelatedByUsrIdTo $virementRelatedByUsrIdTo The virementRelatedByUsrIdTo object to remove.
     */
    public function removeVirementRelatedByUsrIdTo($virementRelatedByUsrIdTo)
    {
        if ($this->getVirementsRelatedByUsrIdTo()->contains($virementRelatedByUsrIdTo)) {
            $this->collVirementsRelatedByUsrIdTo->remove($this->collVirementsRelatedByUsrIdTo->search($virementRelatedByUsrIdTo));
            if (null === $this->virementsRelatedByUsrIdToScheduledForDeletion) {
                $this->virementsRelatedByUsrIdToScheduledForDeletion = clone $this->collVirementsRelatedByUsrIdTo;
                $this->virementsRelatedByUsrIdToScheduledForDeletion->clear();
            }
            $this->virementsRelatedByUsrIdToScheduledForDeletion[]= $virementRelatedByUsrIdTo;
            $virementRelatedByUsrIdTo->setUserRelatedByUsrIdTo(null);
        }
    }

    /**
     * Clears out the collVirementsRelatedByUsrIdFrom collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVirementsRelatedByUsrIdFrom()
     */
    public function clearVirementsRelatedByUsrIdFrom()
    {
        $this->collVirementsRelatedByUsrIdFrom = null; // important to set this to null since that means it is uninitialized
        $this->collVirementsRelatedByUsrIdFromPartial = null;
    }

    /**
     * reset is the collVirementsRelatedByUsrIdFrom collection loaded partially
     *
     * @return void
     */
    public function resetPartialVirementsRelatedByUsrIdFrom($v = true)
    {
        $this->collVirementsRelatedByUsrIdFromPartial = $v;
    }

    /**
     * Initializes the collVirementsRelatedByUsrIdFrom collection.
     *
     * By default this just sets the collVirementsRelatedByUsrIdFrom collection to an empty array (like clearcollVirementsRelatedByUsrIdFrom());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVirementsRelatedByUsrIdFrom($overrideExisting = true)
    {
        if (null !== $this->collVirementsRelatedByUsrIdFrom && !$overrideExisting) {
            return;
        }
        $this->collVirementsRelatedByUsrIdFrom = new PropelObjectCollection();
        $this->collVirementsRelatedByUsrIdFrom->setModel('Virement');
    }

    /**
     * Gets an array of Virement objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Virement[] List of Virement objects
     * @throws PropelException
     */
    public function getVirementsRelatedByUsrIdFrom($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collVirementsRelatedByUsrIdFromPartial && !$this->isNew();
        if (null === $this->collVirementsRelatedByUsrIdFrom || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVirementsRelatedByUsrIdFrom) {
                // return empty collection
                $this->initVirementsRelatedByUsrIdFrom();
            } else {
                $collVirementsRelatedByUsrIdFrom = VirementQuery::create(null, $criteria)
                    ->filterByUserRelatedByUsrIdFrom($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collVirementsRelatedByUsrIdFromPartial && count($collVirementsRelatedByUsrIdFrom)) {
                      $this->initVirementsRelatedByUsrIdFrom(false);

                      foreach($collVirementsRelatedByUsrIdFrom as $obj) {
                        if (false == $this->collVirementsRelatedByUsrIdFrom->contains($obj)) {
                          $this->collVirementsRelatedByUsrIdFrom->append($obj);
                        }
                      }

                      $this->collVirementsRelatedByUsrIdFromPartial = true;
                    }

                    return $collVirementsRelatedByUsrIdFrom;
                }

                if($partial && $this->collVirementsRelatedByUsrIdFrom) {
                    foreach($this->collVirementsRelatedByUsrIdFrom as $obj) {
                        if($obj->isNew()) {
                            $collVirementsRelatedByUsrIdFrom[] = $obj;
                        }
                    }
                }

                $this->collVirementsRelatedByUsrIdFrom = $collVirementsRelatedByUsrIdFrom;
                $this->collVirementsRelatedByUsrIdFromPartial = false;
            }
        }

        return $this->collVirementsRelatedByUsrIdFrom;
    }

    /**
     * Sets a collection of VirementRelatedByUsrIdFrom objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $virementsRelatedByUsrIdFrom A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setVirementsRelatedByUsrIdFrom(PropelCollection $virementsRelatedByUsrIdFrom, PropelPDO $con = null)
    {
        $this->virementsRelatedByUsrIdFromScheduledForDeletion = $this->getVirementsRelatedByUsrIdFrom(new Criteria(), $con)->diff($virementsRelatedByUsrIdFrom);

        foreach ($this->virementsRelatedByUsrIdFromScheduledForDeletion as $virementRelatedByUsrIdFromRemoved) {
            $virementRelatedByUsrIdFromRemoved->setUserRelatedByUsrIdFrom(null);
        }

        $this->collVirementsRelatedByUsrIdFrom = null;
        foreach ($virementsRelatedByUsrIdFrom as $virementRelatedByUsrIdFrom) {
            $this->addVirementRelatedByUsrIdFrom($virementRelatedByUsrIdFrom);
        }

        $this->collVirementsRelatedByUsrIdFrom = $virementsRelatedByUsrIdFrom;
        $this->collVirementsRelatedByUsrIdFromPartial = false;
    }

    /**
     * Returns the number of related Virement objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Virement objects.
     * @throws PropelException
     */
    public function countVirementsRelatedByUsrIdFrom(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collVirementsRelatedByUsrIdFromPartial && !$this->isNew();
        if (null === $this->collVirementsRelatedByUsrIdFrom || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVirementsRelatedByUsrIdFrom) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getVirementsRelatedByUsrIdFrom());
                }
                $query = VirementQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUserRelatedByUsrIdFrom($this)
                    ->count($con);
            }
        } else {
            return count($this->collVirementsRelatedByUsrIdFrom);
        }
    }

    /**
     * Method called to associate a Virement object to this object
     * through the Virement foreign key attribute.
     *
     * @param    Virement $l Virement
     * @return User The current object (for fluent API support)
     */
    public function addVirementRelatedByUsrIdFrom(Virement $l)
    {
        if ($this->collVirementsRelatedByUsrIdFrom === null) {
            $this->initVirementsRelatedByUsrIdFrom();
            $this->collVirementsRelatedByUsrIdFromPartial = true;
        }
        if (!in_array($l, $this->collVirementsRelatedByUsrIdFrom->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddVirementRelatedByUsrIdFrom($l);
        }

        return $this;
    }

    /**
     * @param	VirementRelatedByUsrIdFrom $virementRelatedByUsrIdFrom The virementRelatedByUsrIdFrom object to add.
     */
    protected function doAddVirementRelatedByUsrIdFrom($virementRelatedByUsrIdFrom)
    {
        $this->collVirementsRelatedByUsrIdFrom[]= $virementRelatedByUsrIdFrom;
        $virementRelatedByUsrIdFrom->setUserRelatedByUsrIdFrom($this);
    }

    /**
     * @param	VirementRelatedByUsrIdFrom $virementRelatedByUsrIdFrom The virementRelatedByUsrIdFrom object to remove.
     */
    public function removeVirementRelatedByUsrIdFrom($virementRelatedByUsrIdFrom)
    {
        if ($this->getVirementsRelatedByUsrIdFrom()->contains($virementRelatedByUsrIdFrom)) {
            $this->collVirementsRelatedByUsrIdFrom->remove($this->collVirementsRelatedByUsrIdFrom->search($virementRelatedByUsrIdFrom));
            if (null === $this->virementsRelatedByUsrIdFromScheduledForDeletion) {
                $this->virementsRelatedByUsrIdFromScheduledForDeletion = clone $this->collVirementsRelatedByUsrIdFrom;
                $this->virementsRelatedByUsrIdFromScheduledForDeletion->clear();
            }
            $this->virementsRelatedByUsrIdFromScheduledForDeletion[]= $virementRelatedByUsrIdFrom;
            $virementRelatedByUsrIdFrom->setUserRelatedByUsrIdFrom(null);
        }
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
     * If this User is new, it will return
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
                    ->filterByUser($this)
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
            $jUsrGrpRemoved->setUser(null);
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
                    ->filterByUser($this)
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
     * @return User The current object (for fluent API support)
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
        $jUsrGrp->setUser($this);
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
            $jUsrGrp->setUser(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related JUsrGrps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
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
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related JUsrGrps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|JUsrGrp[] List of JUsrGrp objects
     */
    public function getJUsrGrpsJoinGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = JUsrGrpQuery::create(null, $criteria);
        $query->joinWith('Group', $join_behavior);

        return $this->getJUsrGrps($query, $con);
    }

    /**
     * Clears out the collJUsrMols collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addJUsrMols()
     */
    public function clearJUsrMols()
    {
        $this->collJUsrMols = null; // important to set this to null since that means it is uninitialized
        $this->collJUsrMolsPartial = null;
    }

    /**
     * reset is the collJUsrMols collection loaded partially
     *
     * @return void
     */
    public function resetPartialJUsrMols($v = true)
    {
        $this->collJUsrMolsPartial = $v;
    }

    /**
     * Initializes the collJUsrMols collection.
     *
     * By default this just sets the collJUsrMols collection to an empty array (like clearcollJUsrMols());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initJUsrMols($overrideExisting = true)
    {
        if (null !== $this->collJUsrMols && !$overrideExisting) {
            return;
        }
        $this->collJUsrMols = new PropelObjectCollection();
        $this->collJUsrMols->setModel('JUsrMol');
    }

    /**
     * Gets an array of JUsrMol objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|JUsrMol[] List of JUsrMol objects
     * @throws PropelException
     */
    public function getJUsrMols($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collJUsrMolsPartial && !$this->isNew();
        if (null === $this->collJUsrMols || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collJUsrMols) {
                // return empty collection
                $this->initJUsrMols();
            } else {
                $collJUsrMols = JUsrMolQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collJUsrMolsPartial && count($collJUsrMols)) {
                      $this->initJUsrMols(false);

                      foreach($collJUsrMols as $obj) {
                        if (false == $this->collJUsrMols->contains($obj)) {
                          $this->collJUsrMols->append($obj);
                        }
                      }

                      $this->collJUsrMolsPartial = true;
                    }

                    return $collJUsrMols;
                }

                if($partial && $this->collJUsrMols) {
                    foreach($this->collJUsrMols as $obj) {
                        if($obj->isNew()) {
                            $collJUsrMols[] = $obj;
                        }
                    }
                }

                $this->collJUsrMols = $collJUsrMols;
                $this->collJUsrMolsPartial = false;
            }
        }

        return $this->collJUsrMols;
    }

    /**
     * Sets a collection of JUsrMol objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $jUsrMols A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setJUsrMols(PropelCollection $jUsrMols, PropelPDO $con = null)
    {
        $this->jUsrMolsScheduledForDeletion = $this->getJUsrMols(new Criteria(), $con)->diff($jUsrMols);

        foreach ($this->jUsrMolsScheduledForDeletion as $jUsrMolRemoved) {
            $jUsrMolRemoved->setUser(null);
        }

        $this->collJUsrMols = null;
        foreach ($jUsrMols as $jUsrMol) {
            $this->addJUsrMol($jUsrMol);
        }

        $this->collJUsrMols = $jUsrMols;
        $this->collJUsrMolsPartial = false;
    }

    /**
     * Returns the number of related JUsrMol objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related JUsrMol objects.
     * @throws PropelException
     */
    public function countJUsrMols(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collJUsrMolsPartial && !$this->isNew();
        if (null === $this->collJUsrMols || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collJUsrMols) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getJUsrMols());
                }
                $query = JUsrMolQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collJUsrMols);
        }
    }

    /**
     * Method called to associate a JUsrMol object to this object
     * through the JUsrMol foreign key attribute.
     *
     * @param    JUsrMol $l JUsrMol
     * @return User The current object (for fluent API support)
     */
    public function addJUsrMol(JUsrMol $l)
    {
        if ($this->collJUsrMols === null) {
            $this->initJUsrMols();
            $this->collJUsrMolsPartial = true;
        }
        if (!in_array($l, $this->collJUsrMols->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddJUsrMol($l);
        }

        return $this;
    }

    /**
     * @param	JUsrMol $jUsrMol The jUsrMol object to add.
     */
    protected function doAddJUsrMol($jUsrMol)
    {
        $this->collJUsrMols[]= $jUsrMol;
        $jUsrMol->setUser($this);
    }

    /**
     * @param	JUsrMol $jUsrMol The jUsrMol object to remove.
     */
    public function removeJUsrMol($jUsrMol)
    {
        if ($this->getJUsrMols()->contains($jUsrMol)) {
            $this->collJUsrMols->remove($this->collJUsrMols->search($jUsrMol));
            if (null === $this->jUsrMolsScheduledForDeletion) {
                $this->jUsrMolsScheduledForDeletion = clone $this->collJUsrMols;
                $this->jUsrMolsScheduledForDeletion->clear();
            }
            $this->jUsrMolsScheduledForDeletion[]= $jUsrMol;
            $jUsrMol->setUser(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related JUsrMols from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|JUsrMol[] List of JUsrMol objects
     */
    public function getJUsrMolsJoinMeanOfLogin($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = JUsrMolQuery::create(null, $criteria);
        $query->joinWith('MeanOfLogin', $join_behavior);

        return $this->getJUsrMols($query, $con);
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
     * If this User is new, it will return
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
                    ->filterByUser($this)
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
            $jUsrRigRemoved->setUser(null);
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
                    ->filterByUser($this)
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
     * @return User The current object (for fluent API support)
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
        $jUsrRig->setUser($this);
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
            $jUsrRig->setUser(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
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
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
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
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
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
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related JUsrRigs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
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
     * If this User is new, it will return
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
                    ->filterByUser($this)
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
                    ->filterByUser($this)
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
     * Initializes the collGroups collection.
     *
     * By default this just sets the collGroups collection to an empty collection (like clearGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initGroups()
    {
        $this->collGroups = new PropelObjectCollection();
        $this->collGroups->setModel('Group');
    }

    /**
     * Gets a collection of Group objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_grp_jug cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Group[] List of Group objects
     */
    public function getGroups($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collGroups || null !== $criteria) {
            if ($this->isNew() && null === $this->collGroups) {
                // return empty collection
                $this->initGroups();
            } else {
                $collGroups = GroupQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collGroups;
                }
                $this->collGroups = $collGroups;
            }
        }

        return $this->collGroups;
    }

    /**
     * Sets a collection of Group objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_grp_jug cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $groups A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setGroups(PropelCollection $groups, PropelPDO $con = null)
    {
        $this->clearGroups();
        $currentGroups = $this->getGroups();

        $this->groupsScheduledForDeletion = $currentGroups->diff($groups);

        foreach ($groups as $group) {
            if (!$currentGroups->contains($group)) {
                $this->doAddGroup($group);
            }
        }

        $this->collGroups = $groups;
    }

    /**
     * Gets the number of Group objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_grp_jug cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Group objects
     */
    public function countGroups($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collGroups || null !== $criteria) {
            if ($this->isNew() && null === $this->collGroups) {
                return 0;
            } else {
                $query = GroupQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collGroups);
        }
    }

    /**
     * Associate a Group object to this object
     * through the tj_usr_grp_jug cross reference table.
     *
     * @param  Group $group The JUsrGrp object to relate
     * @return void
     */
    public function addGroup(Group $group)
    {
        if ($this->collGroups === null) {
            $this->initGroups();
        }
        if (!$this->collGroups->contains($group)) { // only add it if the **same** object is not already associated
            $this->doAddGroup($group);

            $this->collGroups[]= $group;
        }
    }

    /**
     * @param	Group $group The group object to add.
     */
    protected function doAddGroup($group)
    {
        $jUsrGrp = new JUsrGrp();
        $jUsrGrp->setGroup($group);
        $this->addJUsrGrp($jUsrGrp);
    }

    /**
     * Remove a Group object to this object
     * through the tj_usr_grp_jug cross reference table.
     *
     * @param Group $group The JUsrGrp object to relate
     * @return void
     */
    public function removeGroup(Group $group)
    {
        if ($this->getGroups()->contains($group)) {
            $this->collGroups->remove($this->collGroups->search($group));
            if (null === $this->groupsScheduledForDeletion) {
                $this->groupsScheduledForDeletion = clone $this->collGroups;
                $this->groupsScheduledForDeletion->clear();
            }
            $this->groupsScheduledForDeletion[]= $group;
        }
    }

    /**
     * Clears out the collMeanOfLogins collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMeanOfLogins()
     */
    public function clearMeanOfLogins()
    {
        $this->collMeanOfLogins = null; // important to set this to null since that means it is uninitialized
        $this->collMeanOfLoginsPartial = null;
    }

    /**
     * Initializes the collMeanOfLogins collection.
     *
     * By default this just sets the collMeanOfLogins collection to an empty collection (like clearMeanOfLogins());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initMeanOfLogins()
    {
        $this->collMeanOfLogins = new PropelObjectCollection();
        $this->collMeanOfLogins->setModel('MeanOfLogin');
    }

    /**
     * Gets a collection of MeanOfLogin objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_mol_jum cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|MeanOfLogin[] List of MeanOfLogin objects
     */
    public function getMeanOfLogins($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collMeanOfLogins || null !== $criteria) {
            if ($this->isNew() && null === $this->collMeanOfLogins) {
                // return empty collection
                $this->initMeanOfLogins();
            } else {
                $collMeanOfLogins = MeanOfLoginQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collMeanOfLogins;
                }
                $this->collMeanOfLogins = $collMeanOfLogins;
            }
        }

        return $this->collMeanOfLogins;
    }

    /**
     * Sets a collection of MeanOfLogin objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_mol_jum cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $meanOfLogins A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setMeanOfLogins(PropelCollection $meanOfLogins, PropelPDO $con = null)
    {
        $this->clearMeanOfLogins();
        $currentMeanOfLogins = $this->getMeanOfLogins();

        $this->meanOfLoginsScheduledForDeletion = $currentMeanOfLogins->diff($meanOfLogins);

        foreach ($meanOfLogins as $meanOfLogin) {
            if (!$currentMeanOfLogins->contains($meanOfLogin)) {
                $this->doAddMeanOfLogin($meanOfLogin);
            }
        }

        $this->collMeanOfLogins = $meanOfLogins;
    }

    /**
     * Gets the number of MeanOfLogin objects related by a many-to-many relationship
     * to the current object by way of the tj_usr_mol_jum cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related MeanOfLogin objects
     */
    public function countMeanOfLogins($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collMeanOfLogins || null !== $criteria) {
            if ($this->isNew() && null === $this->collMeanOfLogins) {
                return 0;
            } else {
                $query = MeanOfLoginQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collMeanOfLogins);
        }
    }

    /**
     * Associate a MeanOfLogin object to this object
     * through the tj_usr_mol_jum cross reference table.
     *
     * @param  MeanOfLogin $meanOfLogin The JUsrMol object to relate
     * @return void
     */
    public function addMeanOfLogin(MeanOfLogin $meanOfLogin)
    {
        if ($this->collMeanOfLogins === null) {
            $this->initMeanOfLogins();
        }
        if (!$this->collMeanOfLogins->contains($meanOfLogin)) { // only add it if the **same** object is not already associated
            $this->doAddMeanOfLogin($meanOfLogin);

            $this->collMeanOfLogins[]= $meanOfLogin;
        }
    }

    /**
     * @param	MeanOfLogin $meanOfLogin The meanOfLogin object to add.
     */
    protected function doAddMeanOfLogin($meanOfLogin)
    {
        $jUsrMol = new JUsrMol();
        $jUsrMol->setMeanOfLogin($meanOfLogin);
        $this->addJUsrMol($jUsrMol);
    }

    /**
     * Remove a MeanOfLogin object to this object
     * through the tj_usr_mol_jum cross reference table.
     *
     * @param MeanOfLogin $meanOfLogin The JUsrMol object to relate
     * @return void
     */
    public function removeMeanOfLogin(MeanOfLogin $meanOfLogin)
    {
        if ($this->getMeanOfLogins()->contains($meanOfLogin)) {
            $this->collMeanOfLogins->remove($this->collMeanOfLogins->search($meanOfLogin));
            if (null === $this->meanOfLoginsScheduledForDeletion) {
                $this->meanOfLoginsScheduledForDeletion = clone $this->collMeanOfLogins;
                $this->meanOfLoginsScheduledForDeletion->clear();
            }
            $this->meanOfLoginsScheduledForDeletion[]= $meanOfLogin;
        }
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
     * If this User is new, it will return
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
                    ->filterByUser($this)
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
                    ->filterByUser($this)
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
     * If this User is new, it will return
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
                    ->filterByUser($this)
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
                    ->filterByUser($this)
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
     * If this User is new, it will return
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
                    ->filterByUser($this)
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
                    ->filterByUser($this)
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
     * If this User is new, it will return
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
                    ->filterByUser($this)
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
                    ->filterByUser($this)
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
        $this->usr_id = null;
        $this->usr_pwd = null;
        $this->usr_firstname = null;
        $this->usr_lastname = null;
        $this->usr_nickname = null;
        $this->usr_adult = null;
        $this->usr_mail = null;
        $this->usr_credit = null;
        $this->img_id = null;
        $this->usr_temporary = null;
        $this->usr_fail_auth = null;
        $this->usr_blocked = null;
        $this->usr_msg_perso = null;
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
            if ($this->collPayboxs) {
                foreach ($this->collPayboxs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPurchasesRelatedByUsrIdBuyer) {
                foreach ($this->collPurchasesRelatedByUsrIdBuyer as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPurchasesRelatedByUsrIdSeller) {
                foreach ($this->collPurchasesRelatedByUsrIdSeller as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRechargesRelatedByUsrIdBuyer) {
                foreach ($this->collRechargesRelatedByUsrIdBuyer as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRechargesRelatedByUsrIdOperator) {
                foreach ($this->collRechargesRelatedByUsrIdOperator as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSherlockss) {
                foreach ($this->collSherlockss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVirementsRelatedByUsrIdTo) {
                foreach ($this->collVirementsRelatedByUsrIdTo as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVirementsRelatedByUsrIdFrom) {
                foreach ($this->collVirementsRelatedByUsrIdFrom as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJUsrGrps) {
                foreach ($this->collJUsrGrps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJUsrMols) {
                foreach ($this->collJUsrMols as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJUsrRigs) {
                foreach ($this->collJUsrRigs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPeriods) {
                foreach ($this->collPeriods as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGroups) {
                foreach ($this->collGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMeanOfLogins) {
                foreach ($this->collMeanOfLogins as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collJurPeriods) {
                foreach ($this->collJurPeriods as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRights) {
                foreach ($this->collRights as $o) {
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

        if ($this->collPayboxs instanceof PropelCollection) {
            $this->collPayboxs->clearIterator();
        }
        $this->collPayboxs = null;
        if ($this->collPurchasesRelatedByUsrIdBuyer instanceof PropelCollection) {
            $this->collPurchasesRelatedByUsrIdBuyer->clearIterator();
        }
        $this->collPurchasesRelatedByUsrIdBuyer = null;
        if ($this->collPurchasesRelatedByUsrIdSeller instanceof PropelCollection) {
            $this->collPurchasesRelatedByUsrIdSeller->clearIterator();
        }
        $this->collPurchasesRelatedByUsrIdSeller = null;
        if ($this->collRechargesRelatedByUsrIdBuyer instanceof PropelCollection) {
            $this->collRechargesRelatedByUsrIdBuyer->clearIterator();
        }
        $this->collRechargesRelatedByUsrIdBuyer = null;
        if ($this->collRechargesRelatedByUsrIdOperator instanceof PropelCollection) {
            $this->collRechargesRelatedByUsrIdOperator->clearIterator();
        }
        $this->collRechargesRelatedByUsrIdOperator = null;
        if ($this->collSherlockss instanceof PropelCollection) {
            $this->collSherlockss->clearIterator();
        }
        $this->collSherlockss = null;
        if ($this->collVirementsRelatedByUsrIdTo instanceof PropelCollection) {
            $this->collVirementsRelatedByUsrIdTo->clearIterator();
        }
        $this->collVirementsRelatedByUsrIdTo = null;
        if ($this->collVirementsRelatedByUsrIdFrom instanceof PropelCollection) {
            $this->collVirementsRelatedByUsrIdFrom->clearIterator();
        }
        $this->collVirementsRelatedByUsrIdFrom = null;
        if ($this->collJUsrGrps instanceof PropelCollection) {
            $this->collJUsrGrps->clearIterator();
        }
        $this->collJUsrGrps = null;
        if ($this->collJUsrMols instanceof PropelCollection) {
            $this->collJUsrMols->clearIterator();
        }
        $this->collJUsrMols = null;
        if ($this->collJUsrRigs instanceof PropelCollection) {
            $this->collJUsrRigs->clearIterator();
        }
        $this->collJUsrRigs = null;
        if ($this->collPeriods instanceof PropelCollection) {
            $this->collPeriods->clearIterator();
        }
        $this->collPeriods = null;
        if ($this->collGroups instanceof PropelCollection) {
            $this->collGroups->clearIterator();
        }
        $this->collGroups = null;
        if ($this->collMeanOfLogins instanceof PropelCollection) {
            $this->collMeanOfLogins->clearIterator();
        }
        $this->collMeanOfLogins = null;
        if ($this->collJurPeriods instanceof PropelCollection) {
            $this->collJurPeriods->clearIterator();
        }
        $this->collJurPeriods = null;
        if ($this->collRights instanceof PropelCollection) {
            $this->collRights->clearIterator();
        }
        $this->collRights = null;
        if ($this->collFundations instanceof PropelCollection) {
            $this->collFundations->clearIterator();
        }
        $this->collFundations = null;
        if ($this->collPoints instanceof PropelCollection) {
            $this->collPoints->clearIterator();
        }
        $this->collPoints = null;
        $this->aImage = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserPeer::DEFAULT_STRING_FORMAT);
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
