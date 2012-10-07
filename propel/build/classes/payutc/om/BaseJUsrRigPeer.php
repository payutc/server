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
use Payutc\JUsrRig;
use Payutc\JUsrRigPeer;
use Payutc\PeriodPeer;
use Payutc\PointPeer;
use Payutc\RightPeer;
use Payutc\UserPeer;
use Payutc\map\JUsrRigTableMap;

/**
 * Base static class for performing query and update operations on the 'tj_usr_rig_jur' table.
 *
 *
 *
 * @package propel.generator.payutc.om
 */
abstract class BaseJUsrRigPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'payutc';

    /** the table name for this class */
    const TABLE_NAME = 'tj_usr_rig_jur';

    /** the related Propel class for this table */
    const OM_CLASS = 'Payutc\\JUsrRig';

    /** the related TableMap class for this table */
    const TM_CLASS = 'JUsrRigTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 7;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 7;

    /** the column name for the JUR_ID field */
    const JUR_ID = 'tj_usr_rig_jur.JUR_ID';

    /** the column name for the USR_ID field */
    const USR_ID = 'tj_usr_rig_jur.USR_ID';

    /** the column name for the RIG_ID field */
    const RIG_ID = 'tj_usr_rig_jur.RIG_ID';

    /** the column name for the PER_ID field */
    const PER_ID = 'tj_usr_rig_jur.PER_ID';

    /** the column name for the FUN_ID field */
    const FUN_ID = 'tj_usr_rig_jur.FUN_ID';

    /** the column name for the POI_ID field */
    const POI_ID = 'tj_usr_rig_jur.POI_ID';

    /** the column name for the JUR_REMOVED field */
    const JUR_REMOVED = 'tj_usr_rig_jur.JUR_REMOVED';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of JUsrRig objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array JUsrRig[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. JUsrRigPeer::$fieldNames[JUsrRigPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'UsrId', 'RigId', 'PerId', 'FunId', 'PoiId', 'Removed', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'usrId', 'rigId', 'perId', 'funId', 'poiId', 'removed', ),
        BasePeer::TYPE_COLNAME => array (JUsrRigPeer::JUR_ID, JUsrRigPeer::USR_ID, JUsrRigPeer::RIG_ID, JUsrRigPeer::PER_ID, JUsrRigPeer::FUN_ID, JUsrRigPeer::POI_ID, JUsrRigPeer::JUR_REMOVED, ),
        BasePeer::TYPE_RAW_COLNAME => array ('JUR_ID', 'USR_ID', 'RIG_ID', 'PER_ID', 'FUN_ID', 'POI_ID', 'JUR_REMOVED', ),
        BasePeer::TYPE_FIELDNAME => array ('jur_id', 'usr_id', 'rig_id', 'per_id', 'fun_id', 'poi_id', 'jur_removed', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. JUsrRigPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UsrId' => 1, 'RigId' => 2, 'PerId' => 3, 'FunId' => 4, 'PoiId' => 5, 'Removed' => 6, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'usrId' => 1, 'rigId' => 2, 'perId' => 3, 'funId' => 4, 'poiId' => 5, 'removed' => 6, ),
        BasePeer::TYPE_COLNAME => array (JUsrRigPeer::JUR_ID => 0, JUsrRigPeer::USR_ID => 1, JUsrRigPeer::RIG_ID => 2, JUsrRigPeer::PER_ID => 3, JUsrRigPeer::FUN_ID => 4, JUsrRigPeer::POI_ID => 5, JUsrRigPeer::JUR_REMOVED => 6, ),
        BasePeer::TYPE_RAW_COLNAME => array ('JUR_ID' => 0, 'USR_ID' => 1, 'RIG_ID' => 2, 'PER_ID' => 3, 'FUN_ID' => 4, 'POI_ID' => 5, 'JUR_REMOVED' => 6, ),
        BasePeer::TYPE_FIELDNAME => array ('jur_id' => 0, 'usr_id' => 1, 'rig_id' => 2, 'per_id' => 3, 'fun_id' => 4, 'poi_id' => 5, 'jur_removed' => 6, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
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
        $toNames = JUsrRigPeer::getFieldNames($toType);
        $key = isset(JUsrRigPeer::$fieldKeys[$fromType][$name]) ? JUsrRigPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(JUsrRigPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, JUsrRigPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return JUsrRigPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. JUsrRigPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(JUsrRigPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(JUsrRigPeer::JUR_ID);
            $criteria->addSelectColumn(JUsrRigPeer::USR_ID);
            $criteria->addSelectColumn(JUsrRigPeer::RIG_ID);
            $criteria->addSelectColumn(JUsrRigPeer::PER_ID);
            $criteria->addSelectColumn(JUsrRigPeer::FUN_ID);
            $criteria->addSelectColumn(JUsrRigPeer::POI_ID);
            $criteria->addSelectColumn(JUsrRigPeer::JUR_REMOVED);
        } else {
            $criteria->addSelectColumn($alias . '.JUR_ID');
            $criteria->addSelectColumn($alias . '.USR_ID');
            $criteria->addSelectColumn($alias . '.RIG_ID');
            $criteria->addSelectColumn($alias . '.PER_ID');
            $criteria->addSelectColumn($alias . '.FUN_ID');
            $criteria->addSelectColumn($alias . '.POI_ID');
            $criteria->addSelectColumn($alias . '.JUR_REMOVED');
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
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 JUsrRig
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = JUsrRigPeer::doSelect($critcopy, $con);
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
        return JUsrRigPeer::populateObjects(JUsrRigPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            JUsrRigPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

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
     * @param      JUsrRig $obj A JUsrRig object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = serialize(array((string) $obj->getUsrId(), (string) $obj->getRigId()));
            } // if key === null
            JUsrRigPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A JUsrRig object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof JUsrRig) {
                $key = serialize(array((string) $value->getUsrId(), (string) $value->getRigId()));
            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or JUsrRig object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(JUsrRigPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   JUsrRig Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(JUsrRigPeer::$instances[$key])) {
                return JUsrRigPeer::$instances[$key];
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
        JUsrRigPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to tj_usr_rig_jur
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
        if ($row[$startcol + 1] === null && $row[$startcol + 2] === null) {
            return null;
        }

        return serialize(array((string) $row[$startcol + 1], (string) $row[$startcol + 2]));
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

        return array((int) $row[$startcol + 1], (int) $row[$startcol + 2]);
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
        $cls = JUsrRigPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = JUsrRigPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JUsrRigPeer::addInstanceToPool($obj, $key);
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
     * @return array (JUsrRig object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = JUsrRigPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = JUsrRigPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + JUsrRigPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JUsrRigPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            JUsrRigPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related JurPeriod table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinJurPeriod(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related User table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related Right table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinRight(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

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
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

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
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

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
     * Selects a collection of JUsrRig objects pre-filled with their Period objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JUsrRig objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinJurPeriod(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);
        }

        JUsrRigPeer::addSelectColumns($criteria);
        $startcol = JUsrRigPeer::NUM_HYDRATE_COLUMNS;
        PeriodPeer::addSelectColumns($criteria);

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JUsrRigPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = JUsrRigPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JUsrRigPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = PeriodPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = PeriodPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = PeriodPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    PeriodPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (JUsrRig) to $obj2 (Period)
                $obj2->addJUsrRig($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of JUsrRig objects pre-filled with their User objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JUsrRig objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinUser(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);
        }

        JUsrRigPeer::addSelectColumns($criteria);
        $startcol = JUsrRigPeer::NUM_HYDRATE_COLUMNS;
        UserPeer::addSelectColumns($criteria);

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JUsrRigPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = JUsrRigPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JUsrRigPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (JUsrRig) to $obj2 (User)
                $obj2->addJUsrRig($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of JUsrRig objects pre-filled with their Right objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JUsrRig objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinRight(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);
        }

        JUsrRigPeer::addSelectColumns($criteria);
        $startcol = JUsrRigPeer::NUM_HYDRATE_COLUMNS;
        RightPeer::addSelectColumns($criteria);

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JUsrRigPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = JUsrRigPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JUsrRigPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = RightPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = RightPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = RightPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    RightPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (JUsrRig) to $obj2 (Right)
                $obj2->addJUsrRig($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of JUsrRig objects pre-filled with their Fundation objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JUsrRig objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinFundation(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);
        }

        JUsrRigPeer::addSelectColumns($criteria);
        $startcol = JUsrRigPeer::NUM_HYDRATE_COLUMNS;
        FundationPeer::addSelectColumns($criteria);

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JUsrRigPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = JUsrRigPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JUsrRigPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (JUsrRig) to $obj2 (Fundation)
                $obj2->addJUsrRig($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of JUsrRig objects pre-filled with their Point objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JUsrRig objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinPoint(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);
        }

        JUsrRigPeer::addSelectColumns($criteria);
        $startcol = JUsrRigPeer::NUM_HYDRATE_COLUMNS;
        PointPeer::addSelectColumns($criteria);

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JUsrRigPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = JUsrRigPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JUsrRigPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (JUsrRig) to $obj2 (Point)
                $obj2->addJUsrRig($obj1);

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
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

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
     * Selects a collection of JUsrRig objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JUsrRig objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);
        }

        JUsrRigPeer::addSelectColumns($criteria);
        $startcol2 = JUsrRigPeer::NUM_HYDRATE_COLUMNS;

        PeriodPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + PeriodPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UserPeer::NUM_HYDRATE_COLUMNS;

        RightPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + RightPeer::NUM_HYDRATE_COLUMNS;

        FundationPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + FundationPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + PointPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JUsrRigPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = JUsrRigPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JUsrRigPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Period rows

            $key2 = PeriodPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = PeriodPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = PeriodPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    PeriodPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj2 (Period)
                $obj2->addJUsrRig($obj1);
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

                // Add the $obj1 (JUsrRig) to the collection in $obj3 (User)
                $obj3->addJUsrRig($obj1);
            } // if joined row not null

            // Add objects for joined Right rows

            $key4 = RightPeer::getPrimaryKeyHashFromRow($row, $startcol4);
            if ($key4 !== null) {
                $obj4 = RightPeer::getInstanceFromPool($key4);
                if (!$obj4) {

                    $cls = RightPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    RightPeer::addInstanceToPool($obj4, $key4);
                } // if obj4 loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj4 (Right)
                $obj4->addJUsrRig($obj1);
            } // if joined row not null

            // Add objects for joined Fundation rows

            $key5 = FundationPeer::getPrimaryKeyHashFromRow($row, $startcol5);
            if ($key5 !== null) {
                $obj5 = FundationPeer::getInstanceFromPool($key5);
                if (!$obj5) {

                    $cls = FundationPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    FundationPeer::addInstanceToPool($obj5, $key5);
                } // if obj5 loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj5 (Fundation)
                $obj5->addJUsrRig($obj1);
            } // if joined row not null

            // Add objects for joined Point rows

            $key6 = PointPeer::getPrimaryKeyHashFromRow($row, $startcol6);
            if ($key6 !== null) {
                $obj6 = PointPeer::getInstanceFromPool($key6);
                if (!$obj6) {

                    $cls = PointPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    PointPeer::addInstanceToPool($obj6, $key6);
                } // if obj6 loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj6 (Point)
                $obj6->addJUsrRig($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related JurPeriod table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptJurPeriod(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related User table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related Right table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptRight(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

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
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

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
        $criteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JUsrRigPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

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
     * Selects a collection of JUsrRig objects pre-filled with all related objects except JurPeriod.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JUsrRig objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptJurPeriod(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);
        }

        JUsrRigPeer::addSelectColumns($criteria);
        $startcol2 = JUsrRigPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

        RightPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + RightPeer::NUM_HYDRATE_COLUMNS;

        FundationPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + FundationPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + PointPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JUsrRigPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = JUsrRigPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JUsrRigPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (JUsrRig) to the collection in $obj2 (User)
                $obj2->addJUsrRig($obj1);

            } // if joined row is not null

                // Add objects for joined Right rows

                $key3 = RightPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = RightPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = RightPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    RightPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj3 (Right)
                $obj3->addJUsrRig($obj1);

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

                // Add the $obj1 (JUsrRig) to the collection in $obj4 (Fundation)
                $obj4->addJUsrRig($obj1);

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

                // Add the $obj1 (JUsrRig) to the collection in $obj5 (Point)
                $obj5->addJUsrRig($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of JUsrRig objects pre-filled with all related objects except User.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JUsrRig objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptUser(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);
        }

        JUsrRigPeer::addSelectColumns($criteria);
        $startcol2 = JUsrRigPeer::NUM_HYDRATE_COLUMNS;

        PeriodPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + PeriodPeer::NUM_HYDRATE_COLUMNS;

        RightPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + RightPeer::NUM_HYDRATE_COLUMNS;

        FundationPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + FundationPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + PointPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JUsrRigPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = JUsrRigPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JUsrRigPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Period rows

                $key2 = PeriodPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = PeriodPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = PeriodPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    PeriodPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj2 (Period)
                $obj2->addJUsrRig($obj1);

            } // if joined row is not null

                // Add objects for joined Right rows

                $key3 = RightPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = RightPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = RightPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    RightPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj3 (Right)
                $obj3->addJUsrRig($obj1);

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

                // Add the $obj1 (JUsrRig) to the collection in $obj4 (Fundation)
                $obj4->addJUsrRig($obj1);

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

                // Add the $obj1 (JUsrRig) to the collection in $obj5 (Point)
                $obj5->addJUsrRig($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of JUsrRig objects pre-filled with all related objects except Right.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JUsrRig objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptRight(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);
        }

        JUsrRigPeer::addSelectColumns($criteria);
        $startcol2 = JUsrRigPeer::NUM_HYDRATE_COLUMNS;

        PeriodPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + PeriodPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UserPeer::NUM_HYDRATE_COLUMNS;

        FundationPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + FundationPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + PointPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JUsrRigPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = JUsrRigPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JUsrRigPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Period rows

                $key2 = PeriodPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = PeriodPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = PeriodPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    PeriodPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj2 (Period)
                $obj2->addJUsrRig($obj1);

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

                // Add the $obj1 (JUsrRig) to the collection in $obj3 (User)
                $obj3->addJUsrRig($obj1);

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

                // Add the $obj1 (JUsrRig) to the collection in $obj4 (Fundation)
                $obj4->addJUsrRig($obj1);

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

                // Add the $obj1 (JUsrRig) to the collection in $obj5 (Point)
                $obj5->addJUsrRig($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of JUsrRig objects pre-filled with all related objects except Fundation.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JUsrRig objects.
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
            $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);
        }

        JUsrRigPeer::addSelectColumns($criteria);
        $startcol2 = JUsrRigPeer::NUM_HYDRATE_COLUMNS;

        PeriodPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + PeriodPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UserPeer::NUM_HYDRATE_COLUMNS;

        RightPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + RightPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + PointPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::POI_ID, PointPeer::POI_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JUsrRigPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = JUsrRigPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JUsrRigPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Period rows

                $key2 = PeriodPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = PeriodPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = PeriodPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    PeriodPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj2 (Period)
                $obj2->addJUsrRig($obj1);

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

                // Add the $obj1 (JUsrRig) to the collection in $obj3 (User)
                $obj3->addJUsrRig($obj1);

            } // if joined row is not null

                // Add objects for joined Right rows

                $key4 = RightPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = RightPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = RightPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    RightPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj4 (Right)
                $obj4->addJUsrRig($obj1);

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

                // Add the $obj1 (JUsrRig) to the collection in $obj5 (Point)
                $obj5->addJUsrRig($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of JUsrRig objects pre-filled with all related objects except Point.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JUsrRig objects.
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
            $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);
        }

        JUsrRigPeer::addSelectColumns($criteria);
        $startcol2 = JUsrRigPeer::NUM_HYDRATE_COLUMNS;

        PeriodPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + PeriodPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UserPeer::NUM_HYDRATE_COLUMNS;

        RightPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + RightPeer::NUM_HYDRATE_COLUMNS;

        FundationPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + FundationPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(JUsrRigPeer::PER_ID, PeriodPeer::PER_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::USR_ID, UserPeer::USR_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::RIG_ID, RightPeer::RIG_ID, $join_behavior);

        $criteria->addJoin(JUsrRigPeer::FUN_ID, FundationPeer::FUN_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JUsrRigPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JUsrRigPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = JUsrRigPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JUsrRigPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Period rows

                $key2 = PeriodPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = PeriodPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = PeriodPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    PeriodPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj2 (Period)
                $obj2->addJUsrRig($obj1);

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

                // Add the $obj1 (JUsrRig) to the collection in $obj3 (User)
                $obj3->addJUsrRig($obj1);

            } // if joined row is not null

                // Add objects for joined Right rows

                $key4 = RightPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = RightPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = RightPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    RightPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (JUsrRig) to the collection in $obj4 (Right)
                $obj4->addJUsrRig($obj1);

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

                // Add the $obj1 (JUsrRig) to the collection in $obj5 (Fundation)
                $obj5->addJUsrRig($obj1);

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
        return Propel::getDatabaseMap(JUsrRigPeer::DATABASE_NAME)->getTable(JUsrRigPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseJUsrRigPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseJUsrRigPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new JUsrRigTableMap());
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
        return JUsrRigPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a JUsrRig or Criteria object.
     *
     * @param      mixed $values Criteria or JUsrRig object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from JUsrRig object
        }


        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a JUsrRig or Criteria object.
     *
     * @param      mixed $values Criteria or JUsrRig object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(JUsrRigPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(JUsrRigPeer::USR_ID);
            $value = $criteria->remove(JUsrRigPeer::USR_ID);
            if ($value) {
                $selectCriteria->add(JUsrRigPeer::USR_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);
            }

            $comparison = $criteria->getComparison(JUsrRigPeer::RIG_ID);
            $value = $criteria->remove(JUsrRigPeer::RIG_ID);
            if ($value) {
                $selectCriteria->add(JUsrRigPeer::RIG_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(JUsrRigPeer::TABLE_NAME);
            }

        } else { // $values is JUsrRig object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the tj_usr_rig_jur table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(JUsrRigPeer::TABLE_NAME, $con, JUsrRigPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JUsrRigPeer::clearInstancePool();
            JUsrRigPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a JUsrRig or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or JUsrRig object or primary key or array of primary keys
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
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            JUsrRigPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof JUsrRig) { // it's a model object
            // invalidate the cache for this single object
            JUsrRigPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JUsrRigPeer::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(JUsrRigPeer::USR_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(JUsrRigPeer::RIG_ID, $value[1]));
                $criteria->addOr($criterion);
                // we can invalidate the cache for this single PK
                JUsrRigPeer::removeInstanceFromPool($value);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(JUsrRigPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            JUsrRigPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given JUsrRig object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      JUsrRig $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(JUsrRigPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(JUsrRigPeer::TABLE_NAME);

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

        return BasePeer::doValidate(JUsrRigPeer::DATABASE_NAME, JUsrRigPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve object using using composite pkey values.
     * @param   int $usr_id
     * @param   int $rig_id
     * @param      PropelPDO $con
     * @return   JUsrRig
     */
    public static function retrieveByPK($usr_id, $rig_id, PropelPDO $con = null) {
        $_instancePoolKey = serialize(array((string) $usr_id, (string) $rig_id));
         if (null !== ($obj = JUsrRigPeer::getInstanceFromPool($_instancePoolKey))) {
             return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $criteria = new Criteria(JUsrRigPeer::DATABASE_NAME);
        $criteria->add(JUsrRigPeer::USR_ID, $usr_id);
        $criteria->add(JUsrRigPeer::RIG_ID, $rig_id);
        $v = JUsrRigPeer::doSelect($criteria, $con);

        return !empty($v) ? $v[0] : null;
    }
} // BaseJUsrRigPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseJUsrRigPeer::buildTableMap();

