<?php


/**
 * Base static class for performing query and update operations on the 'ts_user_usr' table.
 *
 *
 *
 * @package propel.generator.payutc_server.om
 */
abstract class BaseTsUserUsrPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'payutc_server';

    /** the table name for this class */
    const TABLE_NAME = 'ts_user_usr';

    /** the related Propel class for this table */
    const OM_CLASS = 'TsUserUsr';

    /** the related TableMap class for this table */
    const TM_CLASS = 'TsUserUsrTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 13;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 13;

    /** the column name for the USR_ID field */
    const USR_ID = 'ts_user_usr.USR_ID';

    /** the column name for the USR_PWD field */
    const USR_PWD = 'ts_user_usr.USR_PWD';

    /** the column name for the USR_FIRSTNAME field */
    const USR_FIRSTNAME = 'ts_user_usr.USR_FIRSTNAME';

    /** the column name for the USR_LASTNAME field */
    const USR_LASTNAME = 'ts_user_usr.USR_LASTNAME';

    /** the column name for the USR_NICKNAME field */
    const USR_NICKNAME = 'ts_user_usr.USR_NICKNAME';

    /** the column name for the USR_ADULT field */
    const USR_ADULT = 'ts_user_usr.USR_ADULT';

    /** the column name for the USR_MAIL field */
    const USR_MAIL = 'ts_user_usr.USR_MAIL';

    /** the column name for the USR_CREDIT field */
    const USR_CREDIT = 'ts_user_usr.USR_CREDIT';

    /** the column name for the IMG_ID field */
    const IMG_ID = 'ts_user_usr.IMG_ID';

    /** the column name for the USR_TEMPORARY field */
    const USR_TEMPORARY = 'ts_user_usr.USR_TEMPORARY';

    /** the column name for the USR_FAIL_AUTH field */
    const USR_FAIL_AUTH = 'ts_user_usr.USR_FAIL_AUTH';

    /** the column name for the USR_BLOCKED field */
    const USR_BLOCKED = 'ts_user_usr.USR_BLOCKED';

    /** the column name for the USR_MSG_PERSO field */
    const USR_MSG_PERSO = 'ts_user_usr.USR_MSG_PERSO';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of TsUserUsr objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array TsUserUsr[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. TsUserUsrPeer::$fieldNames[TsUserUsrPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Pwd', 'Firstname', 'Lastname', 'Nickname', 'Adult', 'Mail', 'Credit', 'ImgId', 'Temporary', 'FailAuth', 'Blocked', 'MsgPerso', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'pwd', 'firstname', 'lastname', 'nickname', 'adult', 'mail', 'credit', 'imgId', 'temporary', 'failAuth', 'blocked', 'msgPerso', ),
        BasePeer::TYPE_COLNAME => array (TsUserUsrPeer::USR_ID, TsUserUsrPeer::USR_PWD, TsUserUsrPeer::USR_FIRSTNAME, TsUserUsrPeer::USR_LASTNAME, TsUserUsrPeer::USR_NICKNAME, TsUserUsrPeer::USR_ADULT, TsUserUsrPeer::USR_MAIL, TsUserUsrPeer::USR_CREDIT, TsUserUsrPeer::IMG_ID, TsUserUsrPeer::USR_TEMPORARY, TsUserUsrPeer::USR_FAIL_AUTH, TsUserUsrPeer::USR_BLOCKED, TsUserUsrPeer::USR_MSG_PERSO, ),
        BasePeer::TYPE_RAW_COLNAME => array ('USR_ID', 'USR_PWD', 'USR_FIRSTNAME', 'USR_LASTNAME', 'USR_NICKNAME', 'USR_ADULT', 'USR_MAIL', 'USR_CREDIT', 'IMG_ID', 'USR_TEMPORARY', 'USR_FAIL_AUTH', 'USR_BLOCKED', 'USR_MSG_PERSO', ),
        BasePeer::TYPE_FIELDNAME => array ('usr_id', 'usr_pwd', 'usr_firstname', 'usr_lastname', 'usr_nickname', 'usr_adult', 'usr_mail', 'usr_credit', 'img_id', 'usr_temporary', 'usr_fail_auth', 'usr_blocked', 'usr_msg_perso', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. TsUserUsrPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Pwd' => 1, 'Firstname' => 2, 'Lastname' => 3, 'Nickname' => 4, 'Adult' => 5, 'Mail' => 6, 'Credit' => 7, 'ImgId' => 8, 'Temporary' => 9, 'FailAuth' => 10, 'Blocked' => 11, 'MsgPerso' => 12, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'pwd' => 1, 'firstname' => 2, 'lastname' => 3, 'nickname' => 4, 'adult' => 5, 'mail' => 6, 'credit' => 7, 'imgId' => 8, 'temporary' => 9, 'failAuth' => 10, 'blocked' => 11, 'msgPerso' => 12, ),
        BasePeer::TYPE_COLNAME => array (TsUserUsrPeer::USR_ID => 0, TsUserUsrPeer::USR_PWD => 1, TsUserUsrPeer::USR_FIRSTNAME => 2, TsUserUsrPeer::USR_LASTNAME => 3, TsUserUsrPeer::USR_NICKNAME => 4, TsUserUsrPeer::USR_ADULT => 5, TsUserUsrPeer::USR_MAIL => 6, TsUserUsrPeer::USR_CREDIT => 7, TsUserUsrPeer::IMG_ID => 8, TsUserUsrPeer::USR_TEMPORARY => 9, TsUserUsrPeer::USR_FAIL_AUTH => 10, TsUserUsrPeer::USR_BLOCKED => 11, TsUserUsrPeer::USR_MSG_PERSO => 12, ),
        BasePeer::TYPE_RAW_COLNAME => array ('USR_ID' => 0, 'USR_PWD' => 1, 'USR_FIRSTNAME' => 2, 'USR_LASTNAME' => 3, 'USR_NICKNAME' => 4, 'USR_ADULT' => 5, 'USR_MAIL' => 6, 'USR_CREDIT' => 7, 'IMG_ID' => 8, 'USR_TEMPORARY' => 9, 'USR_FAIL_AUTH' => 10, 'USR_BLOCKED' => 11, 'USR_MSG_PERSO' => 12, ),
        BasePeer::TYPE_FIELDNAME => array ('usr_id' => 0, 'usr_pwd' => 1, 'usr_firstname' => 2, 'usr_lastname' => 3, 'usr_nickname' => 4, 'usr_adult' => 5, 'usr_mail' => 6, 'usr_credit' => 7, 'img_id' => 8, 'usr_temporary' => 9, 'usr_fail_auth' => 10, 'usr_blocked' => 11, 'usr_msg_perso' => 12, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $toNames = TsUserUsrPeer::getFieldNames($toType);
        $key = isset(TsUserUsrPeer::$fieldKeys[$fromType][$name]) ? TsUserUsrPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(TsUserUsrPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, TsUserUsrPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return TsUserUsrPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. TsUserUsrPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(TsUserUsrPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(TsUserUsrPeer::USR_ID);
            $criteria->addSelectColumn(TsUserUsrPeer::USR_PWD);
            $criteria->addSelectColumn(TsUserUsrPeer::USR_FIRSTNAME);
            $criteria->addSelectColumn(TsUserUsrPeer::USR_LASTNAME);
            $criteria->addSelectColumn(TsUserUsrPeer::USR_NICKNAME);
            $criteria->addSelectColumn(TsUserUsrPeer::USR_ADULT);
            $criteria->addSelectColumn(TsUserUsrPeer::USR_MAIL);
            $criteria->addSelectColumn(TsUserUsrPeer::USR_CREDIT);
            $criteria->addSelectColumn(TsUserUsrPeer::IMG_ID);
            $criteria->addSelectColumn(TsUserUsrPeer::USR_TEMPORARY);
            $criteria->addSelectColumn(TsUserUsrPeer::USR_FAIL_AUTH);
            $criteria->addSelectColumn(TsUserUsrPeer::USR_BLOCKED);
            $criteria->addSelectColumn(TsUserUsrPeer::USR_MSG_PERSO);
        } else {
            $criteria->addSelectColumn($alias . '.USR_ID');
            $criteria->addSelectColumn($alias . '.USR_PWD');
            $criteria->addSelectColumn($alias . '.USR_FIRSTNAME');
            $criteria->addSelectColumn($alias . '.USR_LASTNAME');
            $criteria->addSelectColumn($alias . '.USR_NICKNAME');
            $criteria->addSelectColumn($alias . '.USR_ADULT');
            $criteria->addSelectColumn($alias . '.USR_MAIL');
            $criteria->addSelectColumn($alias . '.USR_CREDIT');
            $criteria->addSelectColumn($alias . '.IMG_ID');
            $criteria->addSelectColumn($alias . '.USR_TEMPORARY');
            $criteria->addSelectColumn($alias . '.USR_FAIL_AUTH');
            $criteria->addSelectColumn($alias . '.USR_BLOCKED');
            $criteria->addSelectColumn($alias . '.USR_MSG_PERSO');
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
        $criteria->setPrimaryTableName(TsUserUsrPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TsUserUsrPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(TsUserUsrPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 TsUserUsr
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = TsUserUsrPeer::doSelect($critcopy, $con);
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
        return TsUserUsrPeer::populateObjects(TsUserUsrPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            TsUserUsrPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(TsUserUsrPeer::DATABASE_NAME);

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
     * @param      TsUserUsr $obj A TsUserUsr object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            TsUserUsrPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A TsUserUsr object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof TsUserUsr) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or TsUserUsr object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(TsUserUsrPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   TsUserUsr Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(TsUserUsrPeer::$instances[$key])) {
                return TsUserUsrPeer::$instances[$key];
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
        TsUserUsrPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to ts_user_usr
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
        $cls = TsUserUsrPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = TsUserUsrPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = TsUserUsrPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TsUserUsrPeer::addInstanceToPool($obj, $key);
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
     * @return array (TsUserUsr object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = TsUserUsrPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = TsUserUsrPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + TsUserUsrPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TsUserUsrPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            TsUserUsrPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
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
        $criteria->setPrimaryTableName(TsUserUsrPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TsUserUsrPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TsUserUsrPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TsUserUsrPeer::IMG_ID, TsImageImgPeer::IMG_ID, $join_behavior);

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
     * Selects a collection of TsUserUsr objects pre-filled with their TsImageImg objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TsUserUsr objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinTsImageImg(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TsUserUsrPeer::DATABASE_NAME);
        }

        TsUserUsrPeer::addSelectColumns($criteria);
        $startcol = TsUserUsrPeer::NUM_HYDRATE_COLUMNS;
        TsImageImgPeer::addSelectColumns($criteria);

        $criteria->addJoin(TsUserUsrPeer::IMG_ID, TsImageImgPeer::IMG_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TsUserUsrPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TsUserUsrPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = TsUserUsrPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TsUserUsrPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (TsUserUsr) to $obj2 (TsImageImg)
                $obj2->addTsUserUsr($obj1);

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
        $criteria->setPrimaryTableName(TsUserUsrPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TsUserUsrPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TsUserUsrPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TsUserUsrPeer::IMG_ID, TsImageImgPeer::IMG_ID, $join_behavior);

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
     * Selects a collection of TsUserUsr objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TsUserUsr objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TsUserUsrPeer::DATABASE_NAME);
        }

        TsUserUsrPeer::addSelectColumns($criteria);
        $startcol2 = TsUserUsrPeer::NUM_HYDRATE_COLUMNS;

        TsImageImgPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + TsImageImgPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(TsUserUsrPeer::IMG_ID, TsImageImgPeer::IMG_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TsUserUsrPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TsUserUsrPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = TsUserUsrPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TsUserUsrPeer::addInstanceToPool($obj1, $key1);
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
                } // if obj2 loaded

                // Add the $obj1 (TsUserUsr) to the collection in $obj2 (TsImageImg)
                $obj2->addTsUserUsr($obj1);
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
        return Propel::getDatabaseMap(TsUserUsrPeer::DATABASE_NAME)->getTable(TsUserUsrPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseTsUserUsrPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseTsUserUsrPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new TsUserUsrTableMap());
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
        return TsUserUsrPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a TsUserUsr or Criteria object.
     *
     * @param      mixed $values Criteria or TsUserUsr object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from TsUserUsr object
        }

        if ($criteria->containsKey(TsUserUsrPeer::USR_ID) && $criteria->keyContainsValue(TsUserUsrPeer::USR_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TsUserUsrPeer::USR_ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(TsUserUsrPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a TsUserUsr or Criteria object.
     *
     * @param      mixed $values Criteria or TsUserUsr object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(TsUserUsrPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(TsUserUsrPeer::USR_ID);
            $value = $criteria->remove(TsUserUsrPeer::USR_ID);
            if ($value) {
                $selectCriteria->add(TsUserUsrPeer::USR_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(TsUserUsrPeer::TABLE_NAME);
            }

        } else { // $values is TsUserUsr object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(TsUserUsrPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the ts_user_usr table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(TsUserUsrPeer::TABLE_NAME, $con, TsUserUsrPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TsUserUsrPeer::clearInstancePool();
            TsUserUsrPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a TsUserUsr or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or TsUserUsr object or primary key or array of primary keys
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
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            TsUserUsrPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof TsUserUsr) { // it's a model object
            // invalidate the cache for this single object
            TsUserUsrPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TsUserUsrPeer::DATABASE_NAME);
            $criteria->add(TsUserUsrPeer::USR_ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                TsUserUsrPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(TsUserUsrPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            TsUserUsrPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given TsUserUsr object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      TsUserUsr $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(TsUserUsrPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(TsUserUsrPeer::TABLE_NAME);

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

        return BasePeer::doValidate(TsUserUsrPeer::DATABASE_NAME, TsUserUsrPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return TsUserUsr
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = TsUserUsrPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(TsUserUsrPeer::DATABASE_NAME);
        $criteria->add(TsUserUsrPeer::USR_ID, $pk);

        $v = TsUserUsrPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return TsUserUsr[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(TsUserUsrPeer::DATABASE_NAME);
            $criteria->add(TsUserUsrPeer::USR_ID, $pks, Criteria::IN);
            $objs = TsUserUsrPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseTsUserUsrPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseTsUserUsrPeer::buildTableMap();

