<?php

namespace Payutc\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Payutc\ItemPeer;
use Payutc\JObjPoi;
use Payutc\JObjPoiPeer;
use Payutc\PointPeer;
use Payutc\map\JObjPoiTableMap;

/**
 * Base static class for performing query and update operations on the 'tj_obj_poi_jop' table.
 *
 *
 *
 * @package propel.generator.payutc.om
 */
abstract class BaseJObjPoiPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'payutc';

    /** the table name for this class */
    const TABLE_NAME = 'tj_obj_poi_jop';

    /** the related Propel class for this table */
    const OM_CLASS = 'Payutc\\JObjPoi';

    /** the related TableMap class for this table */
    const TM_CLASS = 'JObjPoiTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 3;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 3;

    /** the column name for the OBJ_ID field */
    const OBJ_ID = 'tj_obj_poi_jop.OBJ_ID';

    /** the column name for the JOP_PRIORITY field */
    const JOP_PRIORITY = 'tj_obj_poi_jop.JOP_PRIORITY';

    /** the column name for the POI_ID field */
    const POI_ID = 'tj_obj_poi_jop.POI_ID';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of JObjPoi objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array JObjPoi[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. JObjPoiPeer::$fieldNames[JObjPoiPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('ObjId', 'JopPriority', 'PoiId', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('objId', 'jopPriority', 'poiId', ),
        BasePeer::TYPE_COLNAME => array (JObjPoiPeer::OBJ_ID, JObjPoiPeer::JOP_PRIORITY, JObjPoiPeer::POI_ID, ),
        BasePeer::TYPE_RAW_COLNAME => array ('OBJ_ID', 'JOP_PRIORITY', 'POI_ID', ),
        BasePeer::TYPE_FIELDNAME => array ('obj_id', 'jop_priority', 'poi_id', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. JObjPoiPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('ObjId' => 0, 'JopPriority' => 1, 'PoiId' => 2, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('objId' => 0, 'jopPriority' => 1, 'poiId' => 2, ),
        BasePeer::TYPE_COLNAME => array (JObjPoiPeer::OBJ_ID => 0, JObjPoiPeer::JOP_PRIORITY => 1, JObjPoiPeer::POI_ID => 2, ),
        BasePeer::TYPE_RAW_COLNAME => array ('OBJ_ID' => 0, 'JOP_PRIORITY' => 1, 'POI_ID' => 2, ),
        BasePeer::TYPE_FIELDNAME => array ('obj_id' => 0, 'jop_priority' => 1, 'poi_id' => 2, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, )
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
        $toNames = JObjPoiPeer::getFieldNames($toType);
        $key = isset(JObjPoiPeer::$fieldKeys[$fromType][$name]) ? JObjPoiPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(JObjPoiPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, JObjPoiPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return JObjPoiPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. JObjPoiPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(JObjPoiPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(JObjPoiPeer::OBJ_ID);
            $criteria->addSelectColumn(JObjPoiPeer::JOP_PRIORITY);
            $criteria->addSelectColumn(JObjPoiPeer::POI_ID);
        } else {
            $criteria->addSelectColumn($alias . '.OBJ_ID');
            $criteria->addSelectColumn($alias . '.JOP_PRIORITY');
            $criteria->addSelectColumn($alias . '.POI_ID');
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
        $criteria->setPrimaryTableName(JObjPoiPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JObjPoiPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(JObjPoiPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 JObjPoi
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = JObjPoiPeer::doSelect($critcopy, $con);
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
        return JObjPoiPeer::populateObjects(JObjPoiPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            JObjPoiPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);

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
     * @param      JObjPoi $obj A JObjPoi object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = serialize(array((string) $obj->getObjId(), (string) $obj->getPoiId()));
            } // if key === null
            JObjPoiPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A JObjPoi object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof JObjPoi) {
                $key = serialize(array((string) $value->getObjId(), (string) $value->getPoiId()));
            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or JObjPoi object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(JObjPoiPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   JObjPoi Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(JObjPoiPeer::$instances[$key])) {
                return JObjPoiPeer::$instances[$key];
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
        JObjPoiPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to tj_obj_poi_jop
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
        if ($row[$startcol] === null && $row[$startcol + 2] === null) {
            return null;
        }

        return serialize(array((string) $row[$startcol], (string) $row[$startcol + 2]));
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

        return array((int) $row[$startcol], (int) $row[$startcol + 2]);
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
        $cls = JObjPoiPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = JObjPoiPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = JObjPoiPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JObjPoiPeer::addInstanceToPool($obj, $key);
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
     * @return array (JObjPoi object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = JObjPoiPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = JObjPoiPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + JObjPoiPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JObjPoiPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            JObjPoiPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
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
        $criteria->setPrimaryTableName(JObjPoiPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JObjPoiPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JObjPoiPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

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
        $criteria->setPrimaryTableName(JObjPoiPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JObjPoiPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JObjPoiPeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

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
     * Selects a collection of JObjPoi objects pre-filled with their Point objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JObjPoi objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinPoint(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);
        }

        JObjPoiPeer::addSelectColumns($criteria);
        $startcol = JObjPoiPeer::NUM_HYDRATE_COLUMNS;
        PointPeer::addSelectColumns($criteria);

        $criteria->addJoin(JObjPoiPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JObjPoiPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JObjPoiPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = JObjPoiPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JObjPoiPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (JObjPoi) to $obj2 (Point)
                $obj2->addJObjPoi($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of JObjPoi objects pre-filled with their Item objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JObjPoi objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinItem(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);
        }

        JObjPoiPeer::addSelectColumns($criteria);
        $startcol = JObjPoiPeer::NUM_HYDRATE_COLUMNS;
        ItemPeer::addSelectColumns($criteria);

        $criteria->addJoin(JObjPoiPeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JObjPoiPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JObjPoiPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = JObjPoiPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JObjPoiPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (JObjPoi) to $obj2 (Item)
                $obj2->addJObjPoi($obj1);

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
        $criteria->setPrimaryTableName(JObjPoiPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JObjPoiPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JObjPoiPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $criteria->addJoin(JObjPoiPeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

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
     * Selects a collection of JObjPoi objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JObjPoi objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);
        }

        JObjPoiPeer::addSelectColumns($criteria);
        $startcol2 = JObjPoiPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + PointPeer::NUM_HYDRATE_COLUMNS;

        ItemPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ItemPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(JObjPoiPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

        $criteria->addJoin(JObjPoiPeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JObjPoiPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JObjPoiPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = JObjPoiPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JObjPoiPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Point rows

            $key2 = PointPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = PointPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = PointPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    PointPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (JObjPoi) to the collection in $obj2 (Point)
                $obj2->addJObjPoi($obj1);
            } // if joined row not null

            // Add objects for joined Item rows

            $key3 = ItemPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = ItemPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = ItemPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    ItemPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (JObjPoi) to the collection in $obj3 (Item)
                $obj3->addJObjPoi($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
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
        $criteria->setPrimaryTableName(JObjPoiPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JObjPoiPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JObjPoiPeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);

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
        $criteria->setPrimaryTableName(JObjPoiPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            JObjPoiPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(JObjPoiPeer::POI_ID, PointPeer::POI_ID, $join_behavior);

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
     * Selects a collection of JObjPoi objects pre-filled with all related objects except Point.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JObjPoi objects.
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
            $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);
        }

        JObjPoiPeer::addSelectColumns($criteria);
        $startcol2 = JObjPoiPeer::NUM_HYDRATE_COLUMNS;

        ItemPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ItemPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(JObjPoiPeer::OBJ_ID, ItemPeer::OBJ_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JObjPoiPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JObjPoiPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = JObjPoiPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JObjPoiPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (JObjPoi) to the collection in $obj2 (Item)
                $obj2->addJObjPoi($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of JObjPoi objects pre-filled with all related objects except Item.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of JObjPoi objects.
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
            $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);
        }

        JObjPoiPeer::addSelectColumns($criteria);
        $startcol2 = JObjPoiPeer::NUM_HYDRATE_COLUMNS;

        PointPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + PointPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(JObjPoiPeer::POI_ID, PointPeer::POI_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = JObjPoiPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = JObjPoiPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = JObjPoiPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                JObjPoiPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Point rows

                $key2 = PointPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = PointPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = PointPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    PointPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (JObjPoi) to the collection in $obj2 (Point)
                $obj2->addJObjPoi($obj1);

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
        return Propel::getDatabaseMap(JObjPoiPeer::DATABASE_NAME)->getTable(JObjPoiPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseJObjPoiPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseJObjPoiPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new JObjPoiTableMap());
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
        return JObjPoiPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a JObjPoi or Criteria object.
     *
     * @param      mixed $values Criteria or JObjPoi object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from JObjPoi object
        }


        // Set the correct dbName
        $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a JObjPoi or Criteria object.
     *
     * @param      mixed $values Criteria or JObjPoi object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(JObjPoiPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(JObjPoiPeer::OBJ_ID);
            $value = $criteria->remove(JObjPoiPeer::OBJ_ID);
            if ($value) {
                $selectCriteria->add(JObjPoiPeer::OBJ_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(JObjPoiPeer::TABLE_NAME);
            }

            $comparison = $criteria->getComparison(JObjPoiPeer::POI_ID);
            $value = $criteria->remove(JObjPoiPeer::POI_ID);
            if ($value) {
                $selectCriteria->add(JObjPoiPeer::POI_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(JObjPoiPeer::TABLE_NAME);
            }

        } else { // $values is JObjPoi object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the tj_obj_poi_jop table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(JObjPoiPeer::TABLE_NAME, $con, JObjPoiPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JObjPoiPeer::clearInstancePool();
            JObjPoiPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a JObjPoi or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or JObjPoi object or primary key or array of primary keys
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
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            JObjPoiPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof JObjPoi) { // it's a model object
            // invalidate the cache for this single object
            JObjPoiPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JObjPoiPeer::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(JObjPoiPeer::OBJ_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(JObjPoiPeer::POI_ID, $value[1]));
                $criteria->addOr($criterion);
                // we can invalidate the cache for this single PK
                JObjPoiPeer::removeInstanceFromPool($value);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(JObjPoiPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            JObjPoiPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given JObjPoi object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      JObjPoi $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(JObjPoiPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(JObjPoiPeer::TABLE_NAME);

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

        return BasePeer::doValidate(JObjPoiPeer::DATABASE_NAME, JObjPoiPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve object using using composite pkey values.
     * @param   int $obj_id
     * @param   int $poi_id
     * @param      PropelPDO $con
     * @return   JObjPoi
     */
    public static function retrieveByPK($obj_id, $poi_id, PropelPDO $con = null) {
        $_instancePoolKey = serialize(array((string) $obj_id, (string) $poi_id));
         if (null !== ($obj = JObjPoiPeer::getInstanceFromPool($_instancePoolKey))) {
             return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $criteria = new Criteria(JObjPoiPeer::DATABASE_NAME);
        $criteria->add(JObjPoiPeer::OBJ_ID, $obj_id);
        $criteria->add(JObjPoiPeer::POI_ID, $poi_id);
        $v = JObjPoiPeer::doSelect($criteria, $con);

        return !empty($v) ? $v[0] : null;
    }
} // BaseJObjPoiPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseJObjPoiPeer::buildTableMap();

