<?php

namespace Payutc\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Payutc\FundationPeer;
use Payutc\ItemPeer;
use Payutc\PointPeer;
use Payutc\Purchase;
use Payutc\PurchasePeer;
use Payutc\UserPeer;
use Payutc\map\PurchaseTableMap;

/**
 * Base static class for performing query and update operations on the 't_purchase_pur' table.
 *
 *
 *
 * @package propel.generator.payutc.om
 */
abstract class BasePurchasePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'payutc';

    /** the table name for this class */
    const TABLE_NAME = 't_purchase_pur';

    /** the related Propel class for this table */
    const OM_CLASS = 'Payutc\\Purchase';

    /** the related TableMap class for this table */
    const TM_CLASS = 'PurchaseTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 11;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 11;

    /** the column name for the PUR_ID field */
    const PUR_ID = 't_purchase_pur.PUR_ID';

    /** the column name for the PUR_DATE field */
    const PUR_DATE = 't_purchase_pur.PUR_DATE';

    /** the column name for the PUR_TYPE field */
    const PUR_TYPE = 't_purchase_pur.PUR_TYPE';

    /** the column name for the OBJ_ID field */
    const OBJ_ID = 't_purchase_pur.OBJ_ID';

    /** the column name for the PUR_PRICE field */
    const PUR_PRICE = 't_purchase_pur.PUR_PRICE';

    /** the column name for the USR_ID_BUYER field */
    const USR_ID_BUYER = 't_purchase_pur.USR_ID_BUYER';

    /** the column name for the USR_ID_SELLER field */
    const USR_ID_SELLER = 't_purchase_pur.USR_ID_SELLER';

    /** the column name for the POI_ID field */
    const POI_ID = 't_purchase_pur.POI_ID';

    /** the column name for the FUN_ID field */
    const FUN_ID = 't_purchase_pur.FUN_ID';

    /** the column name for the PUR_IP field */
    const PUR_IP = 't_purchase_pur.PUR_IP';

    /** the column name for the PUR_REMOVED field */
    const PUR_REMOVED = 't_purchase_pur.PUR_REMOVED';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Purchase objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Purchase[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. PurchasePeer::$fieldNames[PurchasePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Date', 'Type', 'ObjId', 'Price', 'UsrIdBuyer', 'UsrIdSeller', 'PoiId', 'FunId', 'Ip', 'Removed', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'date', 'type', 'objId', 'price', 'usrIdBuyer', 'usrIdSeller', 'poiId', 'funId', 'ip', 'removed', ),
        BasePeer::TYPE_COLNAME => array (PurchasePeer::PUR_ID, PurchasePeer::PUR_DATE, PurchasePeer::PUR_TYPE, PurchasePeer::OBJ_ID, PurchasePeer::PUR_PRICE, PurchasePeer::USR_ID_BUYER, PurchasePeer::USR_ID_SELLER, PurchasePeer::POI_ID, PurchasePeer::FUN_ID, PurchasePeer::PUR_IP, PurchasePeer::PUR_REMOVED, ),
        BasePeer::TYPE_RAW_COLNAME => array ('PUR_ID', 'PUR_DATE', 'PUR_TYPE', 'OBJ_ID', 'PUR_PRICE', 'USR_ID_BUYER', 'USR_ID_SELLER', 'POI_ID', 'FUN_ID', 'PUR_IP', 'PUR_REMOVED', ),
        BasePeer::TYPE_FIELDNAME => array ('pur_id', 'pur_date', 'pur_type', 'obj_id', 'pur_price', 'usr_id_buyer', 'usr_id_seller', 'poi_id', 'fun_id', 'pur_ip', 'pur_removed', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. PurchasePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Date' => 1, 'Type' => 2, 'ObjId' => 3, 'Price' => 4, 'UsrIdBuyer' => 5, 'UsrIdSeller' => 6, 'PoiId' => 7, 'FunId' => 8, 'Ip' => 9, 'Removed' => 10, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'date' => 1, 'type' => 2, 'objId' => 3, 'price' => 4, 'usrIdBuyer' => 5, 'usrIdSeller' => 6, 'poiId' => 7, 'funId' => 8, 'ip' => 9, 'removed' => 10, ),
        BasePeer::TYPE_COLNAME => array (PurchasePeer::PUR_ID => 0, PurchasePeer::PUR_DATE => 1, PurchasePeer::PUR_TYPE => 2, PurchasePeer::OBJ_ID => 3, PurchasePeer::PUR_PRICE => 4, PurchasePeer::USR_ID_BUYER => 5, PurchasePeer::USR_ID_SELLER => 6, PurchasePeer::POI_ID => 7, PurchasePeer::FUN_ID => 8, PurchasePeer::PUR_IP => 9, PurchasePeer::PUR_REMOVED => 10, ),
        BasePeer::TYPE_RAW_COLNAME => array ('PUR_ID' => 0, 'PUR_DATE' => 1, 'PUR_TYPE' => 2, 'OBJ_ID' => 3, 'PUR_PRICE' => 4, 'USR_ID_BUYER' => 5, 'USR_ID_SELLER' => 6, 'POI_ID' => 7, 'FUN_ID' => 8, 'PUR_IP' => 9, 'PUR_REMOVED' => 10, ),
        BasePeer::TYPE_FIELDNAME => array ('pur_id' => 0, 'pur_date' => 1, 'pur_type' => 2, 'obj_id' => 3, 'pur_price' => 4, 'usr_id_buyer' => 5, 'usr_id_seller' => 6, 'poi_id' => 7, 'fun_id' => 8, 'pur_ip' => 9, 'pur_removed' => 10, ),
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
        $toNames = PurchasePeer::getFieldNames($toType);
        $key = isset(PurchasePeer::$fieldKeys[$fromType][$name]) ? PurchasePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(PurchasePeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, PurchasePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return PurchasePeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. PurchasePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(PurchasePeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(PurchasePeer::PUR_ID);
            $criteria->addSelectColumn(PurchasePeer::PUR_DATE);
            $criteria->addSelectColumn(PurchasePeer::PUR_TYPE);
            $criteria->addSelectColumn(PurchasePeer::OBJ_ID);
            $criteria->addSelectColumn(PurchasePeer::PUR_PRICE);
            $criteria->addSelectColumn(PurchasePeer::USR_ID_BUYER);
            $criteria->addSelectColumn(PurchasePeer::USR_ID_SELLER);
            $criteria->addSelectColumn(PurchasePeer::POI_ID);
            $criteria->addSelectColumn(PurchasePeer::FUN_ID);
            $criteria->addSelectColumn(PurchasePeer::PUR_IP);
            $criteria->addSelectColumn(PurchasePeer::PUR_REMOVED);
        } else {
            $criteria->addSelectColumn($alias . '.PUR_ID');
            $criteria->addSelectColumn($alias . '.PUR_DATE');
            $criteria->addSelectColumn($alias . '.PUR_TYPE');
            $criteria->addSelectColumn($alias . '.OBJ_ID');
            $criteria->addSelectColumn($alias . '.PUR_PRICE');
            $criteria->addSelectColumn($alias . '.USR_ID_BUYER');
            $criteria->addSelectColumn($alias . '.USR_ID_SELLER');
            $criteria->addSelectColumn($alias . '.POI_ID');
            $criteria->addSelectColumn($alias . '.FUN_ID');
            $criteria->addSelectColumn($alias . '.PUR_IP');
            $criteria->addSelectColumn($alias . '.PUR_REMOVED');
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
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(PurchasePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Purchase
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = PurchasePeer::doSelect($critcopy, $con);
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
        return PurchasePeer::populateObjects(PurchasePeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            PurchasePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

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
     * @param      Purchase $obj A Purchase object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            PurchasePeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Purchase object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Purchase) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Purchase object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(PurchasePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Purchase Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(PurchasePeer::$instances[$key])) {
                return PurchasePeer::$instances[$key];
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
        PurchasePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to t_purchase_pur
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
        $cls = PurchasePeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = PurchasePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PurchasePeer::addInstanceToPool($obj, $key);
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
     * @return array (Purchase object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = PurchasePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = PurchasePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + PurchasePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PurchasePeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            PurchasePeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Item table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinItem(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related UserRelatedByUsrIdBuyer table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinUserRelatedByUsrIdBuyer(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PurchasePeer::USR_ID_BUYER, UserPeer::USR_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related UserRelatedByUsrIdSeller table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinUserRelatedByUsrIdSeller(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PurchasePeer::USR_ID_SELLER, UserPeer::USR_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related Point table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinPoint(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related Fundation table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinFundation(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

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
     * Selects a collection of Purchase objects pre-filled with their Item objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Purchase objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinItem(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PurchasePeer::DATABASE_NAME);
        }

        PurchasePeer::addSelectColumns($criteria);
        $startcol = PurchasePeer::NUM_HYDRATE_COLUMNS;
        ItemPeer::addSelectColumns($criteria);

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PurchasePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = PurchasePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PurchasePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = ItemPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = ItemPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ItemPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    ItemPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Purchase) to $obj2 (Item)
                $obj2->addPurchase($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Purchase objects pre-filled with their User objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Purchase objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinUserRelatedByUsrIdBuyer(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PurchasePeer::DATABASE_NAME);
        }

        PurchasePeer::addSelectColumns($criteria);
        $startcol = PurchasePeer::NUM_HYDRATE_COLUMNS;
        UserPeer::addSelectColumns($criteria);

        $criteria->addJoin(PurchasePeer::USR_ID_BUYER, UserPeer::USR_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PurchasePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = PurchasePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PurchasePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = UserPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Purchase) to $obj2 (User)
                $obj2->addPurchaseRelatedByUsrIdBuyer($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Purchase objects pre-filled with their User objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Purchase objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinUserRelatedByUsrIdSeller(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PurchasePeer::DATABASE_NAME);
        }

        PurchasePeer::addSelectColumns($criteria);
        $startcol = PurchasePeer::NUM_HYDRATE_COLUMNS;
        UserPeer::addSelectColumns($criteria);

        $criteria->addJoin(PurchasePeer::USR_ID_SELLER, UserPeer::USR_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PurchasePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = PurchasePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PurchasePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = UserPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Purchase) to $obj2 (User)
                $obj2->addPurchaseRelatedByUsrIdSeller($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Purchase objects pre-filled with their Point objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Purchase objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinPoint(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PurchasePeer::DATABASE_NAME);
        }

        PurchasePeer::addSelectColumns($criteria);
        $startcol = PurchasePeer::NUM_HYDRATE_COLUMNS;
        PointPeer::addSelectColumns($criteria);

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PurchasePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = PurchasePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PurchasePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = PointPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = PointPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = PointPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    PointPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Purchase) to $obj2 (Point)
                $obj2->addPurchase($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Purchase objects pre-filled with their Fundation objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Purchase objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinFundation(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PurchasePeer::DATABASE_NAME);
        }

        PurchasePeer::addSelectColumns($criteria);
        $startcol = PurchasePeer::NUM_HYDRATE_COLUMNS;
        FundationPeer::addSelectColumns($criteria);

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PurchasePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = PurchasePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PurchasePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = FundationPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = FundationPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = FundationPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    FundationPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Purchase) to $obj2 (Fundation)
                $obj2->addPurchase($obj1);

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
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_BUYER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_SELLER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

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
     * Selects a collection of Purchase objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Purchase objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PurchasePeer::DATABASE_NAME);
        }

        PurchasePeer::addSelectColumns($criteria);
        $startcol2 = PurchasePeer::NUM_HYDRATE_COLUMNS;

        ItemPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ItemPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UserPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + UserPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + PointPeer::NUM_HYDRATE_COLUMNS;

        FundationPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + FundationPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_BUYER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_SELLER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PurchasePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = PurchasePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PurchasePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Item rows

            $key2 = ItemPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = ItemPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ItemPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ItemPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (Purchase) to the collection in $obj2 (Item)
                $obj2->addPurchase($obj1);
            } // if joined row not null

            // Add objects for joined User rows

            $key3 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = UserPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = UserPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    UserPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (Purchase) to the collection in $obj3 (User)
                $obj3->addPurchaseRelatedByUsrIdBuyer($obj1);
            } // if joined row not null

            // Add objects for joined User rows

            $key4 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol4);
            if ($key4 !== null) {
                $obj4 = UserPeer::getInstanceFromPool($key4);
                if (!$obj4) {

                    $cls = UserPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    UserPeer::addInstanceToPool($obj4, $key4);
                } // if obj4 loaded

                // Add the $obj1 (Purchase) to the collection in $obj4 (User)
                $obj4->addPurchaseRelatedByUsrIdSeller($obj1);
            } // if joined row not null

            // Add objects for joined Point rows

            $key5 = PointPeer::getPrimaryKeyHashFromRow($row, $startcol5);
            if ($key5 !== null) {
                $obj5 = PointPeer::getInstanceFromPool($key5);
                if (!$obj5) {

                    $cls = PointPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    PointPeer::addInstanceToPool($obj5, $key5);
                } // if obj5 loaded

                // Add the $obj1 (Purchase) to the collection in $obj5 (Point)
                $obj5->addPurchase($obj1);
            } // if joined row not null

            // Add objects for joined Fundation rows

            $key6 = FundationPeer::getPrimaryKeyHashFromRow($row, $startcol6);
            if ($key6 !== null) {
                $obj6 = FundationPeer::getInstanceFromPool($key6);
                if (!$obj6) {

                    $cls = FundationPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    FundationPeer::addInstanceToPool($obj6, $key6);
                } // if obj6 loaded

                // Add the $obj1 (Purchase) to the collection in $obj6 (Fundation)
                $obj6->addPurchase($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Item table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptItem(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PurchasePeer::USR_ID_BUYER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_SELLER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related UserRelatedByUsrIdBuyer table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptUserRelatedByUsrIdBuyer(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related UserRelatedByUsrIdSeller table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptUserRelatedByUsrIdSeller(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related Point table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptPoint(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_BUYER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_SELLER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related Fundation table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptFundation(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PurchasePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_BUYER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_SELLER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);

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
     * Selects a collection of Purchase objects pre-filled with all related objects except Item.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Purchase objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptItem(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PurchasePeer::DATABASE_NAME);
        }

        PurchasePeer::addSelectColumns($criteria);
        $startcol2 = PurchasePeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UserPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + PointPeer::NUM_HYDRATE_COLUMNS;

        FundationPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + FundationPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(PurchasePeer::USR_ID_BUYER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_SELLER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PurchasePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = PurchasePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PurchasePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined User rows

                $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = UserPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj2 (User)
                $obj2->addPurchaseRelatedByUsrIdBuyer($obj1);

            } // if joined row is not null

                // Add objects for joined User rows

                $key3 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = UserPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = UserPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    UserPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj3 (User)
                $obj3->addPurchaseRelatedByUsrIdSeller($obj1);

            } // if joined row is not null

                // Add objects for joined Point rows

                $key4 = PointPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = PointPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = PointPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    PointPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj4 (Point)
                $obj4->addPurchase($obj1);

            } // if joined row is not null

                // Add objects for joined Fundation rows

                $key5 = FundationPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = FundationPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = FundationPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    FundationPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj5 (Fundation)
                $obj5->addPurchase($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Purchase objects pre-filled with all related objects except UserRelatedByUsrIdBuyer.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Purchase objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptUserRelatedByUsrIdBuyer(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PurchasePeer::DATABASE_NAME);
        }

        PurchasePeer::addSelectColumns($criteria);
        $startcol2 = PurchasePeer::NUM_HYDRATE_COLUMNS;

        ItemPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ItemPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + PointPeer::NUM_HYDRATE_COLUMNS;

        FundationPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + FundationPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PurchasePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = PurchasePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PurchasePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Item rows

                $key2 = ItemPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ItemPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ItemPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ItemPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj2 (Item)
                $obj2->addPurchase($obj1);

            } // if joined row is not null

                // Add objects for joined Point rows

                $key3 = PointPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = PointPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = PointPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    PointPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj3 (Point)
                $obj3->addPurchase($obj1);

            } // if joined row is not null

                // Add objects for joined Fundation rows

                $key4 = FundationPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = FundationPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = FundationPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    FundationPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj4 (Fundation)
                $obj4->addPurchase($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Purchase objects pre-filled with all related objects except UserRelatedByUsrIdSeller.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Purchase objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptUserRelatedByUsrIdSeller(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PurchasePeer::DATABASE_NAME);
        }

        PurchasePeer::addSelectColumns($criteria);
        $startcol2 = PurchasePeer::NUM_HYDRATE_COLUMNS;

        ItemPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ItemPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + PointPeer::NUM_HYDRATE_COLUMNS;

        FundationPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + FundationPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PurchasePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = PurchasePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PurchasePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Item rows

                $key2 = ItemPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ItemPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ItemPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ItemPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj2 (Item)
                $obj2->addPurchase($obj1);

            } // if joined row is not null

                // Add objects for joined Point rows

                $key3 = PointPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = PointPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = PointPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    PointPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj3 (Point)
                $obj3->addPurchase($obj1);

            } // if joined row is not null

                // Add objects for joined Fundation rows

                $key4 = FundationPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = FundationPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = FundationPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    FundationPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj4 (Fundation)
                $obj4->addPurchase($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Purchase objects pre-filled with all related objects except Point.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Purchase objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptPoint(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PurchasePeer::DATABASE_NAME);
        }

        PurchasePeer::addSelectColumns($criteria);
        $startcol2 = PurchasePeer::NUM_HYDRATE_COLUMNS;

        ItemPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ItemPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UserPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + UserPeer::NUM_HYDRATE_COLUMNS;

        FundationPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + FundationPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_BUYER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_SELLER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PurchasePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = PurchasePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PurchasePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Item rows

                $key2 = ItemPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ItemPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ItemPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ItemPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj2 (Item)
                $obj2->addPurchase($obj1);

            } // if joined row is not null

                // Add objects for joined User rows

                $key3 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = UserPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = UserPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    UserPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj3 (User)
                $obj3->addPurchaseRelatedByUsrIdBuyer($obj1);

            } // if joined row is not null

                // Add objects for joined User rows

                $key4 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = UserPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = UserPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    UserPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj4 (User)
                $obj4->addPurchaseRelatedByUsrIdSeller($obj1);

            } // if joined row is not null

                // Add objects for joined Fundation rows

                $key5 = FundationPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = FundationPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = FundationPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    FundationPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj5 (Fundation)
                $obj5->addPurchase($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Purchase objects pre-filled with all related objects except Fundation.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Purchase objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptFundation(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PurchasePeer::DATABASE_NAME);
        }

        PurchasePeer::addSelectColumns($criteria);
        $startcol2 = PurchasePeer::NUM_HYDRATE_COLUMNS;

        ItemPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ItemPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UserPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + UserPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + PointPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(PurchasePeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_BUYER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::USR_ID_SELLER, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(PurchasePeer::POI_ID, PointPeer::POI_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PurchasePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PurchasePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = PurchasePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PurchasePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Item rows

                $key2 = ItemPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ItemPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ItemPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ItemPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj2 (Item)
                $obj2->addPurchase($obj1);

            } // if joined row is not null

                // Add objects for joined User rows

                $key3 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = UserPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = UserPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    UserPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj3 (User)
                $obj3->addPurchaseRelatedByUsrIdBuyer($obj1);

            } // if joined row is not null

                // Add objects for joined User rows

                $key4 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = UserPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = UserPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    UserPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj4 (User)
                $obj4->addPurchaseRelatedByUsrIdSeller($obj1);

            } // if joined row is not null

                // Add objects for joined Point rows

                $key5 = PointPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = PointPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = PointPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    PointPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (Purchase) to the collection in $obj5 (Point)
                $obj5->addPurchase($obj1);

            } // if joined row is not null

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
        return Propel::getDatabaseMap(PurchasePeer::DATABASE_NAME)->getTable(PurchasePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BasePurchasePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BasePurchasePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new PurchaseTableMap());
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
        return PurchasePeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Purchase or Criteria object.
     *
     * @param      mixed $values Criteria or Purchase object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Purchase object
        }

        if ($criteria->containsKey(PurchasePeer::PUR_ID) && $criteria->keyContainsValue(PurchasePeer::PUR_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PurchasePeer::PUR_ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Purchase or Criteria object.
     *
     * @param      mixed $values Criteria or Purchase object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(PurchasePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(PurchasePeer::PUR_ID);
            $value = $criteria->remove(PurchasePeer::PUR_ID);
            if ($value) {
                $selectCriteria->add(PurchasePeer::PUR_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(PurchasePeer::TABLE_NAME);
            }

        } else { // $values is Purchase object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the t_purchase_pur table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(PurchasePeer::TABLE_NAME, $con, PurchasePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PurchasePeer::clearInstancePool();
            PurchasePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Purchase or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Purchase object or primary key or array of primary keys
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
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            PurchasePeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Purchase) { // it's a model object
            // invalidate the cache for this single object
            PurchasePeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PurchasePeer::DATABASE_NAME);
            $criteria->add(PurchasePeer::PUR_ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                PurchasePeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(PurchasePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            PurchasePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Purchase object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Purchase $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(PurchasePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(PurchasePeer::TABLE_NAME);

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

        return BasePeer::doValidate(PurchasePeer::DATABASE_NAME, PurchasePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Purchase
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = PurchasePeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(PurchasePeer::DATABASE_NAME);
        $criteria->add(PurchasePeer::PUR_ID, $pk);

        $v = PurchasePeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Purchase[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(PurchasePeer::DATABASE_NAME);
            $criteria->add(PurchasePeer::PUR_ID, $pks, Criteria::IN);
            $objs = PurchasePeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BasePurchasePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BasePurchasePeer::buildTableMap();

