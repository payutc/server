<?php


/**
 * Base static class for performing query and update operations on the 't_object_obj' table.
 *
 *
 *
 * @package propel.generator.payutc_server.om
 */
abstract class BaseTObjectObjPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'payutc_server';

    /** the table name for this class */
    const TABLE_NAME = 't_object_obj';

    /** the related Propel class for this table */
    const OM_CLASS = 'TObjectObj';

    /** the related TableMap class for this table */
    const TM_CLASS = 'TObjectObjTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 10;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 10;

    /** the column name for the OBJ_ID field */
    const OBJ_ID = 't_object_obj.OBJ_ID';

    /** the column name for the OBJ_NAME field */
    const OBJ_NAME = 't_object_obj.OBJ_NAME';

    /** the column name for the OBJ_TYPE field */
    const OBJ_TYPE = 't_object_obj.OBJ_TYPE';

    /** the column name for the OBJ_STOCK field */
    const OBJ_STOCK = 't_object_obj.OBJ_STOCK';

    /** the column name for the OBJ_SINGLE field */
    const OBJ_SINGLE = 't_object_obj.OBJ_SINGLE';

    /** the column name for the OBJ_TVA field */
    const OBJ_TVA = 't_object_obj.OBJ_TVA';

    /** the column name for the OBJ_ALCOOL field */
    const OBJ_ALCOOL = 't_object_obj.OBJ_ALCOOL';

    /** the column name for the IMG_ID field */
    const IMG_ID = 't_object_obj.IMG_ID';

    /** the column name for the FUN_ID field */
    const FUN_ID = 't_object_obj.FUN_ID';

    /** the column name for the OBJ_REMOVED field */
    const OBJ_REMOVED = 't_object_obj.OBJ_REMOVED';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of TObjectObj objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array TObjectObj[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. TObjectObjPeer::$fieldNames[TObjectObjPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Type', 'Stock', 'Single', 'Tva', 'Alcool', 'ImgId', 'FunId', 'Removed', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'name', 'type', 'stock', 'single', 'tva', 'alcool', 'imgId', 'funId', 'removed', ),
        BasePeer::TYPE_COLNAME => array (TObjectObjPeer::OBJ_ID, TObjectObjPeer::OBJ_NAME, TObjectObjPeer::OBJ_TYPE, TObjectObjPeer::OBJ_STOCK, TObjectObjPeer::OBJ_SINGLE, TObjectObjPeer::OBJ_TVA, TObjectObjPeer::OBJ_ALCOOL, TObjectObjPeer::IMG_ID, TObjectObjPeer::FUN_ID, TObjectObjPeer::OBJ_REMOVED, ),
        BasePeer::TYPE_RAW_COLNAME => array ('OBJ_ID', 'OBJ_NAME', 'OBJ_TYPE', 'OBJ_STOCK', 'OBJ_SINGLE', 'OBJ_TVA', 'OBJ_ALCOOL', 'IMG_ID', 'FUN_ID', 'OBJ_REMOVED', ),
        BasePeer::TYPE_FIELDNAME => array ('obj_id', 'obj_name', 'obj_type', 'obj_stock', 'obj_single', 'obj_tva', 'obj_alcool', 'img_id', 'fun_id', 'obj_removed', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. TObjectObjPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Type' => 2, 'Stock' => 3, 'Single' => 4, 'Tva' => 5, 'Alcool' => 6, 'ImgId' => 7, 'FunId' => 8, 'Removed' => 9, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'name' => 1, 'type' => 2, 'stock' => 3, 'single' => 4, 'tva' => 5, 'alcool' => 6, 'imgId' => 7, 'funId' => 8, 'removed' => 9, ),
        BasePeer::TYPE_COLNAME => array (TObjectObjPeer::OBJ_ID => 0, TObjectObjPeer::OBJ_NAME => 1, TObjectObjPeer::OBJ_TYPE => 2, TObjectObjPeer::OBJ_STOCK => 3, TObjectObjPeer::OBJ_SINGLE => 4, TObjectObjPeer::OBJ_TVA => 5, TObjectObjPeer::OBJ_ALCOOL => 6, TObjectObjPeer::IMG_ID => 7, TObjectObjPeer::FUN_ID => 8, TObjectObjPeer::OBJ_REMOVED => 9, ),
        BasePeer::TYPE_RAW_COLNAME => array ('OBJ_ID' => 0, 'OBJ_NAME' => 1, 'OBJ_TYPE' => 2, 'OBJ_STOCK' => 3, 'OBJ_SINGLE' => 4, 'OBJ_TVA' => 5, 'OBJ_ALCOOL' => 6, 'IMG_ID' => 7, 'FUN_ID' => 8, 'OBJ_REMOVED' => 9, ),
        BasePeer::TYPE_FIELDNAME => array ('obj_id' => 0, 'obj_name' => 1, 'obj_type' => 2, 'obj_stock' => 3, 'obj_single' => 4, 'obj_tva' => 5, 'obj_alcool' => 6, 'img_id' => 7, 'fun_id' => 8, 'obj_removed' => 9, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $toNames = TObjectObjPeer::getFieldNames($toType);
        $key = isset(TObjectObjPeer::$fieldKeys[$fromType][$name]) ? TObjectObjPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(TObjectObjPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, TObjectObjPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return TObjectObjPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. TObjectObjPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(TObjectObjPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(TObjectObjPeer::OBJ_ID);
            $criteria->addSelectColumn(TObjectObjPeer::OBJ_NAME);
            $criteria->addSelectColumn(TObjectObjPeer::OBJ_TYPE);
            $criteria->addSelectColumn(TObjectObjPeer::OBJ_STOCK);
            $criteria->addSelectColumn(TObjectObjPeer::OBJ_SINGLE);
            $criteria->addSelectColumn(TObjectObjPeer::OBJ_TVA);
            $criteria->addSelectColumn(TObjectObjPeer::OBJ_ALCOOL);
            $criteria->addSelectColumn(TObjectObjPeer::IMG_ID);
            $criteria->addSelectColumn(TObjectObjPeer::FUN_ID);
            $criteria->addSelectColumn(TObjectObjPeer::OBJ_REMOVED);
        } else {
            $criteria->addSelectColumn($alias . '.OBJ_ID');
            $criteria->addSelectColumn($alias . '.OBJ_NAME');
            $criteria->addSelectColumn($alias . '.OBJ_TYPE');
            $criteria->addSelectColumn($alias . '.OBJ_STOCK');
            $criteria->addSelectColumn($alias . '.OBJ_SINGLE');
            $criteria->addSelectColumn($alias . '.OBJ_TVA');
            $criteria->addSelectColumn($alias . '.OBJ_ALCOOL');
            $criteria->addSelectColumn($alias . '.IMG_ID');
            $criteria->addSelectColumn($alias . '.FUN_ID');
            $criteria->addSelectColumn($alias . '.OBJ_REMOVED');
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
        $criteria->setPrimaryTableName(TObjectObjPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TObjectObjPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(TObjectObjPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 TObjectObj
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = TObjectObjPeer::doSelect($critcopy, $con);
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
        return TObjectObjPeer::populateObjects(TObjectObjPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            TObjectObjPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);

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
     * @param      TObjectObj $obj A TObjectObj object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            TObjectObjPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A TObjectObj object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof TObjectObj) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or TObjectObj object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(TObjectObjPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   TObjectObj Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(TObjectObjPeer::$instances[$key])) {
                return TObjectObjPeer::$instances[$key];
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
        TObjectObjPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to t_object_obj
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
        $cls = TObjectObjPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = TObjectObjPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = TObjectObjPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TObjectObjPeer::addInstanceToPool($obj, $key);
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
     * @return array (TObjectObj object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = TObjectObjPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = TObjectObjPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + TObjectObjPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TObjectObjPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            TObjectObjPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related TFundationFun table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinTFundationFun(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TObjectObjPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TObjectObjPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TObjectObjPeer::FUN_ID, TFundationFunPeer::FUN_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related TsImageImg table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinTsImageImg(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TObjectObjPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TObjectObjPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TObjectObjPeer::IMG_ID, TsImageImgPeer::IMG_ID, $join_behavior);

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
     * Selects a collection of TObjectObj objects pre-filled with their TFundationFun objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TObjectObj objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinTFundationFun(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);
        }

        TObjectObjPeer::addSelectColumns($criteria);
        $startcol = TObjectObjPeer::NUM_HYDRATE_COLUMNS;
        TFundationFunPeer::addSelectColumns($criteria);

        $criteria->addJoin(TObjectObjPeer::FUN_ID, TFundationFunPeer::FUN_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TObjectObjPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TObjectObjPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = TObjectObjPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TObjectObjPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = TFundationFunPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = TFundationFunPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = TFundationFunPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    TFundationFunPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (TObjectObj) to $obj2 (TFundationFun)
                $obj2->addTObjectObj($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of TObjectObj objects pre-filled with their TsImageImg objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TObjectObj objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinTsImageImg(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);
        }

        TObjectObjPeer::addSelectColumns($criteria);
        $startcol = TObjectObjPeer::NUM_HYDRATE_COLUMNS;
        TsImageImgPeer::addSelectColumns($criteria);

        $criteria->addJoin(TObjectObjPeer::IMG_ID, TsImageImgPeer::IMG_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TObjectObjPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TObjectObjPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = TObjectObjPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TObjectObjPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = TsImageImgPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = TsImageImgPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = TsImageImgPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    TsImageImgPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (TObjectObj) to $obj2 (TsImageImg)
                $obj2->addTObjectObj($obj1);

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
        $criteria->setPrimaryTableName(TObjectObjPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TObjectObjPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TObjectObjPeer::FUN_ID, TFundationFunPeer::FUN_ID, $join_behavior);

        $criteria->addJoin(TObjectObjPeer::IMG_ID, TsImageImgPeer::IMG_ID, $join_behavior);

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
     * Selects a collection of TObjectObj objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TObjectObj objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);
        }

        TObjectObjPeer::addSelectColumns($criteria);
        $startcol2 = TObjectObjPeer::NUM_HYDRATE_COLUMNS;

        TFundationFunPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + TFundationFunPeer::NUM_HYDRATE_COLUMNS;

        TsImageImgPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + TsImageImgPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(TObjectObjPeer::FUN_ID, TFundationFunPeer::FUN_ID, $join_behavior);

        $criteria->addJoin(TObjectObjPeer::IMG_ID, TsImageImgPeer::IMG_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TObjectObjPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TObjectObjPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = TObjectObjPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TObjectObjPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined TFundationFun rows

            $key2 = TFundationFunPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = TFundationFunPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = TFundationFunPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    TFundationFunPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (TObjectObj) to the collection in $obj2 (TFundationFun)
                $obj2->addTObjectObj($obj1);
            } // if joined row not null

            // Add objects for joined TsImageImg rows

            $key3 = TsImageImgPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = TsImageImgPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = TsImageImgPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    TsImageImgPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (TObjectObj) to the collection in $obj3 (TsImageImg)
                $obj3->addTObjectObj($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related TFundationFun table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptTFundationFun(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TObjectObjPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TObjectObjPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TObjectObjPeer::IMG_ID, TsImageImgPeer::IMG_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related TsImageImg table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptTsImageImg(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(TObjectObjPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TObjectObjPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TObjectObjPeer::FUN_ID, TFundationFunPeer::FUN_ID, $join_behavior);

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
     * Selects a collection of TObjectObj objects pre-filled with all related objects except TFundationFun.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TObjectObj objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptTFundationFun(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);
        }

        TObjectObjPeer::addSelectColumns($criteria);
        $startcol2 = TObjectObjPeer::NUM_HYDRATE_COLUMNS;

        TsImageImgPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + TsImageImgPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(TObjectObjPeer::IMG_ID, TsImageImgPeer::IMG_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TObjectObjPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TObjectObjPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = TObjectObjPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TObjectObjPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined TsImageImg rows

                $key2 = TsImageImgPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = TsImageImgPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = TsImageImgPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    TsImageImgPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (TObjectObj) to the collection in $obj2 (TsImageImg)
                $obj2->addTObjectObj($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of TObjectObj objects pre-filled with all related objects except TsImageImg.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TObjectObj objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptTsImageImg(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);
        }

        TObjectObjPeer::addSelectColumns($criteria);
        $startcol2 = TObjectObjPeer::NUM_HYDRATE_COLUMNS;

        TFundationFunPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + TFundationFunPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(TObjectObjPeer::FUN_ID, TFundationFunPeer::FUN_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TObjectObjPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TObjectObjPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = TObjectObjPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TObjectObjPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined TFundationFun rows

                $key2 = TFundationFunPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = TFundationFunPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = TFundationFunPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    TFundationFunPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (TObjectObj) to the collection in $obj2 (TFundationFun)
                $obj2->addTObjectObj($obj1);

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
        return Propel::getDatabaseMap(TObjectObjPeer::DATABASE_NAME)->getTable(TObjectObjPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseTObjectObjPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseTObjectObjPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new TObjectObjTableMap());
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
        return TObjectObjPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a TObjectObj or Criteria object.
     *
     * @param      mixed $values Criteria or TObjectObj object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from TObjectObj object
        }

        if ($criteria->containsKey(TObjectObjPeer::OBJ_ID) && $criteria->keyContainsValue(TObjectObjPeer::OBJ_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TObjectObjPeer::OBJ_ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a TObjectObj or Criteria object.
     *
     * @param      mixed $values Criteria or TObjectObj object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(TObjectObjPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(TObjectObjPeer::OBJ_ID);
            $value = $criteria->remove(TObjectObjPeer::OBJ_ID);
            if ($value) {
                $selectCriteria->add(TObjectObjPeer::OBJ_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(TObjectObjPeer::TABLE_NAME);
            }

        } else { // $values is TObjectObj object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the t_object_obj table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(TObjectObjPeer::TABLE_NAME, $con, TObjectObjPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TObjectObjPeer::clearInstancePool();
            TObjectObjPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a TObjectObj or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or TObjectObj object or primary key or array of primary keys
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
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            TObjectObjPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof TObjectObj) { // it's a model object
            // invalidate the cache for this single object
            TObjectObjPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TObjectObjPeer::DATABASE_NAME);
            $criteria->add(TObjectObjPeer::OBJ_ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                TObjectObjPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(TObjectObjPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            TObjectObjPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given TObjectObj object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      TObjectObj $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(TObjectObjPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(TObjectObjPeer::TABLE_NAME);

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

        return BasePeer::doValidate(TObjectObjPeer::DATABASE_NAME, TObjectObjPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return TObjectObj
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = TObjectObjPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(TObjectObjPeer::DATABASE_NAME);
        $criteria->add(TObjectObjPeer::OBJ_ID, $pk);

        $v = TObjectObjPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return TObjectObj[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(TObjectObjPeer::DATABASE_NAME);
            $criteria->add(TObjectObjPeer::OBJ_ID, $pks, Criteria::IN);
            $objs = TObjectObjPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseTObjectObjPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseTObjectObjPeer::buildTableMap();

