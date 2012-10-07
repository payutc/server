<?php


/**
 * Base static class for performing query and update operations on the 't_paybox_pay' table.
 *
 *
 *
 * @package propel.generator.payutc_server.om
 */
abstract class BaseTPayboxPayPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'payutc_server';

    /** the table name for this class */
    const TABLE_NAME = 't_paybox_pay';

    /** the related Propel class for this table */
    const OM_CLASS = 'TPayboxPay';

    /** the related TableMap class for this table */
    const TM_CLASS = 'TPayboxPayTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 11;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 11;

    /** the column name for the PAY_ID field */
    const PAY_ID = 't_paybox_pay.PAY_ID';

    /** the column name for the USR_ID field */
    const USR_ID = 't_paybox_pay.USR_ID';

    /** the column name for the PAY_STEP field */
    const PAY_STEP = 't_paybox_pay.PAY_STEP';

    /** the column name for the PAY_AMOUNT field */
    const PAY_AMOUNT = 't_paybox_pay.PAY_AMOUNT';

    /** the column name for the PAY_DATE_CREATE field */
    const PAY_DATE_CREATE = 't_paybox_pay.PAY_DATE_CREATE';

    /** the column name for the PAY_DATE_RETOUR field */
    const PAY_DATE_RETOUR = 't_paybox_pay.PAY_DATE_RETOUR';

    /** the column name for the PAY_AUTO field */
    const PAY_AUTO = 't_paybox_pay.PAY_AUTO';

    /** the column name for the PAY_TRANS field */
    const PAY_TRANS = 't_paybox_pay.PAY_TRANS';

    /** the column name for the PAY_CALLBACK_URL field */
    const PAY_CALLBACK_URL = 't_paybox_pay.PAY_CALLBACK_URL';

    /** the column name for the PAY_MOBILE field */
    const PAY_MOBILE = 't_paybox_pay.PAY_MOBILE';

    /** the column name for the PAY_ERROR field */
    const PAY_ERROR = 't_paybox_pay.PAY_ERROR';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of TPayboxPay objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array TPayboxPay[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. TPayboxPayPeer::$fieldNames[TPayboxPayPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'UsrId', 'Step', 'Amount', 'DateCreate', 'DateRetour', 'Auto', 'Trans', 'CallbackUrl', 'Mobile', 'Error', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'usrId', 'step', 'amount', 'dateCreate', 'dateRetour', 'auto', 'trans', 'callbackUrl', 'mobile', 'error', ),
        BasePeer::TYPE_COLNAME => array (TPayboxPayPeer::PAY_ID, TPayboxPayPeer::USR_ID, TPayboxPayPeer::PAY_STEP, TPayboxPayPeer::PAY_AMOUNT, TPayboxPayPeer::PAY_DATE_CREATE, TPayboxPayPeer::PAY_DATE_RETOUR, TPayboxPayPeer::PAY_AUTO, TPayboxPayPeer::PAY_TRANS, TPayboxPayPeer::PAY_CALLBACK_URL, TPayboxPayPeer::PAY_MOBILE, TPayboxPayPeer::PAY_ERROR, ),
        BasePeer::TYPE_RAW_COLNAME => array ('PAY_ID', 'USR_ID', 'PAY_STEP', 'PAY_AMOUNT', 'PAY_DATE_CREATE', 'PAY_DATE_RETOUR', 'PAY_AUTO', 'PAY_TRANS', 'PAY_CALLBACK_URL', 'PAY_MOBILE', 'PAY_ERROR', ),
        BasePeer::TYPE_FIELDNAME => array ('pay_id', 'usr_id', 'pay_step', 'pay_amount', 'pay_date_create', 'pay_date_retour', 'pay_auto', 'pay_trans', 'pay_callback_url', 'pay_mobile', 'pay_error', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. TPayboxPayPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UsrId' => 1, 'Step' => 2, 'Amount' => 3, 'DateCreate' => 4, 'DateRetour' => 5, 'Auto' => 6, 'Trans' => 7, 'CallbackUrl' => 8, 'Mobile' => 9, 'Error' => 10, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'usrId' => 1, 'step' => 2, 'amount' => 3, 'dateCreate' => 4, 'dateRetour' => 5, 'auto' => 6, 'trans' => 7, 'callbackUrl' => 8, 'mobile' => 9, 'error' => 10, ),
        BasePeer::TYPE_COLNAME => array (TPayboxPayPeer::PAY_ID => 0, TPayboxPayPeer::USR_ID => 1, TPayboxPayPeer::PAY_STEP => 2, TPayboxPayPeer::PAY_AMOUNT => 3, TPayboxPayPeer::PAY_DATE_CREATE => 4, TPayboxPayPeer::PAY_DATE_RETOUR => 5, TPayboxPayPeer::PAY_AUTO => 6, TPayboxPayPeer::PAY_TRANS => 7, TPayboxPayPeer::PAY_CALLBACK_URL => 8, TPayboxPayPeer::PAY_MOBILE => 9, TPayboxPayPeer::PAY_ERROR => 10, ),
        BasePeer::TYPE_RAW_COLNAME => array ('PAY_ID' => 0, 'USR_ID' => 1, 'PAY_STEP' => 2, 'PAY_AMOUNT' => 3, 'PAY_DATE_CREATE' => 4, 'PAY_DATE_RETOUR' => 5, 'PAY_AUTO' => 6, 'PAY_TRANS' => 7, 'PAY_CALLBACK_URL' => 8, 'PAY_MOBILE' => 9, 'PAY_ERROR' => 10, ),
        BasePeer::TYPE_FIELDNAME => array ('pay_id' => 0, 'usr_id' => 1, 'pay_step' => 2, 'pay_amount' => 3, 'pay_date_create' => 4, 'pay_date_retour' => 5, 'pay_auto' => 6, 'pay_trans' => 7, 'pay_callback_url' => 8, 'pay_mobile' => 9, 'pay_error' => 10, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = TPayboxPayPeer::getFieldNames($toType);
        $key = isset(TPayboxPayPeer::$fieldKeys[$fromType][$name]) ? TPayboxPayPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(TPayboxPayPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, TPayboxPayPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return TPayboxPayPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. TPayboxPayPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(TPayboxPayPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(TPayboxPayPeer::PAY_ID);
            $criteria->addSelectColumn(TPayboxPayPeer::USR_ID);
            $criteria->addSelectColumn(TPayboxPayPeer::PAY_STEP);
            $criteria->addSelectColumn(TPayboxPayPeer::PAY_AMOUNT);
            $criteria->addSelectColumn(TPayboxPayPeer::PAY_DATE_CREATE);
            $criteria->addSelectColumn(TPayboxPayPeer::PAY_DATE_RETOUR);
            $criteria->addSelectColumn(TPayboxPayPeer::PAY_AUTO);
            $criteria->addSelectColumn(TPayboxPayPeer::PAY_TRANS);
            $criteria->addSelectColumn(TPayboxPayPeer::PAY_CALLBACK_URL);
            $criteria->addSelectColumn(TPayboxPayPeer::PAY_MOBILE);
            $criteria->addSelectColumn(TPayboxPayPeer::PAY_ERROR);
        } else {
            $criteria->addSelectColumn($alias . '.PAY_ID');
            $criteria->addSelectColumn($alias . '.USR_ID');
            $criteria->addSelectColumn($alias . '.PAY_STEP');
            $criteria->addSelectColumn($alias . '.PAY_AMOUNT');
            $criteria->addSelectColumn($alias . '.PAY_DATE_CREATE');
            $criteria->addSelectColumn($alias . '.PAY_DATE_RETOUR');
            $criteria->addSelectColumn($alias . '.PAY_AUTO');
            $criteria->addSelectColumn($alias . '.PAY_TRANS');
            $criteria->addSelectColumn($alias . '.PAY_CALLBACK_URL');
            $criteria->addSelectColumn($alias . '.PAY_MOBILE');
            $criteria->addSelectColumn($alias . '.PAY_ERROR');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TPayboxPayPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TPayboxPayPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(TPayboxPayPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 TPayboxPay
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = TPayboxPayPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return TPayboxPayPeer::populateObjects(TPayboxPayPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement durirectly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            TPayboxPayPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(TPayboxPayPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      TPayboxPay $obj A TPayboxPay object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            TPayboxPayPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A TPayboxPay object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof TPayboxPay) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or TPayboxPay object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(TPayboxPayPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   TPayboxPay Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(TPayboxPayPeer::$instances[$key])) {
                return TPayboxPayPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool()
    {
        TPayboxPayPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to t_paybox_pay
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = TPayboxPayPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = TPayboxPayPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = TPayboxPayPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TPayboxPayPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (TPayboxPay object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = TPayboxPayPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = TPayboxPayPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + TPayboxPayPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TPayboxPayPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            TPayboxPayPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related TsUserUsr table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinTsUserUsr(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TPayboxPayPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TPayboxPayPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TPayboxPayPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TPayboxPayPeer::USR_ID, TsUserUsrPeer::USR_ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of TPayboxPay objects pre-filled with their TsUserUsr objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TPayboxPay objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinTsUserUsr(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TPayboxPayPeer::DATABASE_NAME);
        }

        TPayboxPayPeer::addSelectColumns($criteria);
        $startcol = TPayboxPayPeer::NUM_HYDRATE_COLUMNS;
        TsUserUsrPeer::addSelectColumns($criteria);

        $criteria->addJoin(TPayboxPayPeer::USR_ID, TsUserUsrPeer::USR_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TPayboxPayPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TPayboxPayPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = TPayboxPayPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TPayboxPayPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = TsUserUsrPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = TsUserUsrPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = TsUserUsrPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    TsUserUsrPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (TPayboxPay) to $obj2 (TsUserUsr)
                $obj2->addTPayboxPay($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TPayboxPayPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TPayboxPayPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TPayboxPayPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TPayboxPayPeer::USR_ID, TsUserUsrPeer::USR_ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of TPayboxPay objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TPayboxPay objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TPayboxPayPeer::DATABASE_NAME);
        }

        TPayboxPayPeer::addSelectColumns($criteria);
        $startcol2 = TPayboxPayPeer::NUM_HYDRATE_COLUMNS;

        TsUserUsrPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + TsUserUsrPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(TPayboxPayPeer::USR_ID, TsUserUsrPeer::USR_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TPayboxPayPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TPayboxPayPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = TPayboxPayPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TPayboxPayPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined TsUserUsr rows

            $key2 = TsUserUsrPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = TsUserUsrPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = TsUserUsrPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    TsUserUsrPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (TPayboxPay) to the collection in $obj2 (TsUserUsr)
                $obj2->addTPayboxPay($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(TPayboxPayPeer::DATABASE_NAME)->getTable(TPayboxPayPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseTPayboxPayPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseTPayboxPayPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new TPayboxPayTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass()
    {
        return TPayboxPayPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a TPayboxPay or Criteria object.
     *
     * @param      mixed $values Criteria or TPayboxPay object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from TPayboxPay object
        }

        if ($criteria->containsKey(TPayboxPayPeer::PAY_ID) && $criteria->keyContainsValue(TPayboxPayPeer::PAY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TPayboxPayPeer::PAY_ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(TPayboxPayPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a TPayboxPay or Criteria object.
     *
     * @param      mixed $values Criteria or TPayboxPay object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(TPayboxPayPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(TPayboxPayPeer::PAY_ID);
            $value = $criteria->remove(TPayboxPayPeer::PAY_ID);
            if ($value) {
                $selectCriteria->add(TPayboxPayPeer::PAY_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(TPayboxPayPeer::TABLE_NAME);
            }

        } else { // $values is TPayboxPay object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(TPayboxPayPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the t_paybox_pay table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(TPayboxPayPeer::TABLE_NAME, $con, TPayboxPayPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TPayboxPayPeer::clearInstancePool();
            TPayboxPayPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a TPayboxPay or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or TPayboxPay object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            TPayboxPayPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof TPayboxPay) { // it's a model object
            // invalidate the cache for this single object
            TPayboxPayPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TPayboxPayPeer::DATABASE_NAME);
            $criteria->add(TPayboxPayPeer::PAY_ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                TPayboxPayPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(TPayboxPayPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            TPayboxPayPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given TPayboxPay object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      TPayboxPay $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(TPayboxPayPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(TPayboxPayPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(TPayboxPayPeer::DATABASE_NAME, TPayboxPayPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return TPayboxPay
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = TPayboxPayPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(TPayboxPayPeer::DATABASE_NAME);
        $criteria->add(TPayboxPayPeer::PAY_ID, $pk);

        $v = TPayboxPayPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return TPayboxPay[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TPayboxPayPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(TPayboxPayPeer::DATABASE_NAME);
            $criteria->add(TPayboxPayPeer::PAY_ID, $pks, Criteria::IN);
            $objs = TPayboxPayPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseTPayboxPayPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseTPayboxPayPeer::buildTableMap();

