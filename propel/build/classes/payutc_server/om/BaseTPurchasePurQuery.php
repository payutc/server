<?php


/**
 * Base class that represents a query for the 't_purchase_pur' table.
 *
 *
 *
 * @method TPurchasePurQuery orderById($order = Criteria::ASC) Order by the pur_id column
 * @method TPurchasePurQuery orderByDate($order = Criteria::ASC) Order by the pur_date column
 * @method TPurchasePurQuery orderByType($order = Criteria::ASC) Order by the pur_type column
 * @method TPurchasePurQuery orderByObjId($order = Criteria::ASC) Order by the obj_id column
 * @method TPurchasePurQuery orderByPrice($order = Criteria::ASC) Order by the pur_price column
 * @method TPurchasePurQuery orderByUsrIdBuyer($order = Criteria::ASC) Order by the usr_id_buyer column
 * @method TPurchasePurQuery orderByUsrIdSeller($order = Criteria::ASC) Order by the usr_id_seller column
 * @method TPurchasePurQuery orderByPoiId($order = Criteria::ASC) Order by the poi_id column
 * @method TPurchasePurQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method TPurchasePurQuery orderByIp($order = Criteria::ASC) Order by the pur_ip column
 * @method TPurchasePurQuery orderByRemoved($order = Criteria::ASC) Order by the pur_removed column
 *
 * @method TPurchasePurQuery groupById() Group by the pur_id column
 * @method TPurchasePurQuery groupByDate() Group by the pur_date column
 * @method TPurchasePurQuery groupByType() Group by the pur_type column
 * @method TPurchasePurQuery groupByObjId() Group by the obj_id column
 * @method TPurchasePurQuery groupByPrice() Group by the pur_price column
 * @method TPurchasePurQuery groupByUsrIdBuyer() Group by the usr_id_buyer column
 * @method TPurchasePurQuery groupByUsrIdSeller() Group by the usr_id_seller column
 * @method TPurchasePurQuery groupByPoiId() Group by the poi_id column
 * @method TPurchasePurQuery groupByFunId() Group by the fun_id column
 * @method TPurchasePurQuery groupByIp() Group by the pur_ip column
 * @method TPurchasePurQuery groupByRemoved() Group by the pur_removed column
 *
 * @method TPurchasePurQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TPurchasePurQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TPurchasePurQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TPurchasePurQuery leftJoinTObjectObj($relationAlias = null) Adds a LEFT JOIN clause to the query using the TObjectObj relation
 * @method TPurchasePurQuery rightJoinTObjectObj($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TObjectObj relation
 * @method TPurchasePurQuery innerJoinTObjectObj($relationAlias = null) Adds a INNER JOIN clause to the query using the TObjectObj relation
 *
 * @method TPurchasePurQuery leftJoinTsUserUsrRelatedByUsrIdBuyer($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsUserUsrRelatedByUsrIdBuyer relation
 * @method TPurchasePurQuery rightJoinTsUserUsrRelatedByUsrIdBuyer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsUserUsrRelatedByUsrIdBuyer relation
 * @method TPurchasePurQuery innerJoinTsUserUsrRelatedByUsrIdBuyer($relationAlias = null) Adds a INNER JOIN clause to the query using the TsUserUsrRelatedByUsrIdBuyer relation
 *
 * @method TPurchasePurQuery leftJoinTsUserUsrRelatedByUsrIdSeller($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsUserUsrRelatedByUsrIdSeller relation
 * @method TPurchasePurQuery rightJoinTsUserUsrRelatedByUsrIdSeller($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsUserUsrRelatedByUsrIdSeller relation
 * @method TPurchasePurQuery innerJoinTsUserUsrRelatedByUsrIdSeller($relationAlias = null) Adds a INNER JOIN clause to the query using the TsUserUsrRelatedByUsrIdSeller relation
 *
 * @method TPurchasePurQuery leftJoinTPointPoi($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPointPoi relation
 * @method TPurchasePurQuery rightJoinTPointPoi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPointPoi relation
 * @method TPurchasePurQuery innerJoinTPointPoi($relationAlias = null) Adds a INNER JOIN clause to the query using the TPointPoi relation
 *
 * @method TPurchasePurQuery leftJoinTFundationFun($relationAlias = null) Adds a LEFT JOIN clause to the query using the TFundationFun relation
 * @method TPurchasePurQuery rightJoinTFundationFun($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TFundationFun relation
 * @method TPurchasePurQuery innerJoinTFundationFun($relationAlias = null) Adds a INNER JOIN clause to the query using the TFundationFun relation
 *
 * @method TPurchasePur findOne(PropelPDO $con = null) Return the first TPurchasePur matching the query
 * @method TPurchasePur findOneOrCreate(PropelPDO $con = null) Return the first TPurchasePur matching the query, or a new TPurchasePur object populated from the query conditions when no match is found
 *
 * @method TPurchasePur findOneByDate(string $pur_date) Return the first TPurchasePur filtered by the pur_date column
 * @method TPurchasePur findOneByType(string $pur_type) Return the first TPurchasePur filtered by the pur_type column
 * @method TPurchasePur findOneByObjId(int $obj_id) Return the first TPurchasePur filtered by the obj_id column
 * @method TPurchasePur findOneByPrice(int $pur_price) Return the first TPurchasePur filtered by the pur_price column
 * @method TPurchasePur findOneByUsrIdBuyer(int $usr_id_buyer) Return the first TPurchasePur filtered by the usr_id_buyer column
 * @method TPurchasePur findOneByUsrIdSeller(int $usr_id_seller) Return the first TPurchasePur filtered by the usr_id_seller column
 * @method TPurchasePur findOneByPoiId(int $poi_id) Return the first TPurchasePur filtered by the poi_id column
 * @method TPurchasePur findOneByFunId(int $fun_id) Return the first TPurchasePur filtered by the fun_id column
 * @method TPurchasePur findOneByIp(string $pur_ip) Return the first TPurchasePur filtered by the pur_ip column
 * @method TPurchasePur findOneByRemoved(boolean $pur_removed) Return the first TPurchasePur filtered by the pur_removed column
 *
 * @method array findById(int $pur_id) Return TPurchasePur objects filtered by the pur_id column
 * @method array findByDate(string $pur_date) Return TPurchasePur objects filtered by the pur_date column
 * @method array findByType(string $pur_type) Return TPurchasePur objects filtered by the pur_type column
 * @method array findByObjId(int $obj_id) Return TPurchasePur objects filtered by the obj_id column
 * @method array findByPrice(int $pur_price) Return TPurchasePur objects filtered by the pur_price column
 * @method array findByUsrIdBuyer(int $usr_id_buyer) Return TPurchasePur objects filtered by the usr_id_buyer column
 * @method array findByUsrIdSeller(int $usr_id_seller) Return TPurchasePur objects filtered by the usr_id_seller column
 * @method array findByPoiId(int $poi_id) Return TPurchasePur objects filtered by the poi_id column
 * @method array findByFunId(int $fun_id) Return TPurchasePur objects filtered by the fun_id column
 * @method array findByIp(string $pur_ip) Return TPurchasePur objects filtered by the pur_ip column
 * @method array findByRemoved(boolean $pur_removed) Return TPurchasePur objects filtered by the pur_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTPurchasePurQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTPurchasePurQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TPurchasePur', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TPurchasePurQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TPurchasePurQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TPurchasePurQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TPurchasePurQuery) {
            return $criteria;
        }
        $query = new TPurchasePurQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   TPurchasePur|TPurchasePur[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TPurchasePurPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TPurchasePurPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   TPurchasePur A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   TPurchasePur A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `PUR_ID`, `PUR_DATE`, `PUR_TYPE`, `OBJ_ID`, `PUR_PRICE`, `USR_ID_BUYER`, `USR_ID_SELLER`, `POI_ID`, `FUN_ID`, `PUR_IP`, `PUR_REMOVED` FROM `t_purchase_pur` WHERE `PUR_ID` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new TPurchasePur();
            $obj->hydrate($row);
            TPurchasePurPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return TPurchasePur|TPurchasePur[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|TPurchasePur[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TPurchasePurPeer::PUR_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TPurchasePurPeer::PUR_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pur_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE pur_id = 1234
     * $query->filterById(array(12, 34)); // WHERE pur_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE pur_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TPurchasePurPeer::PUR_ID, $id, $comparison);
    }

    /**
     * Filter the query on the pur_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE pur_date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE pur_date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE pur_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(TPurchasePurPeer::PUR_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(TPurchasePurPeer::PUR_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPurchasePurPeer::PUR_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the pur_type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE pur_type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE pur_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TPurchasePurPeer::PUR_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the obj_id column
     *
     * Example usage:
     * <code>
     * $query->filterByObjId(1234); // WHERE obj_id = 1234
     * $query->filterByObjId(array(12, 34)); // WHERE obj_id IN (12, 34)
     * $query->filterByObjId(array('min' => 12)); // WHERE obj_id > 12
     * </code>
     *
     * @see       filterByTObjectObj()
     *
     * @param     mixed $objId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByObjId($objId = null, $comparison = null)
    {
        if (is_array($objId)) {
            $useMinMax = false;
            if (isset($objId['min'])) {
                $this->addUsingAlias(TPurchasePurPeer::OBJ_ID, $objId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($objId['max'])) {
                $this->addUsingAlias(TPurchasePurPeer::OBJ_ID, $objId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPurchasePurPeer::OBJ_ID, $objId, $comparison);
    }

    /**
     * Filter the query on the pur_price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE pur_price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE pur_price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE pur_price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(TPurchasePurPeer::PUR_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(TPurchasePurPeer::PUR_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPurchasePurPeer::PUR_PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the usr_id_buyer column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrIdBuyer(1234); // WHERE usr_id_buyer = 1234
     * $query->filterByUsrIdBuyer(array(12, 34)); // WHERE usr_id_buyer IN (12, 34)
     * $query->filterByUsrIdBuyer(array('min' => 12)); // WHERE usr_id_buyer > 12
     * </code>
     *
     * @see       filterByTsUserUsrRelatedByUsrIdBuyer()
     *
     * @param     mixed $usrIdBuyer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByUsrIdBuyer($usrIdBuyer = null, $comparison = null)
    {
        if (is_array($usrIdBuyer)) {
            $useMinMax = false;
            if (isset($usrIdBuyer['min'])) {
                $this->addUsingAlias(TPurchasePurPeer::USR_ID_BUYER, $usrIdBuyer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrIdBuyer['max'])) {
                $this->addUsingAlias(TPurchasePurPeer::USR_ID_BUYER, $usrIdBuyer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPurchasePurPeer::USR_ID_BUYER, $usrIdBuyer, $comparison);
    }

    /**
     * Filter the query on the usr_id_seller column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrIdSeller(1234); // WHERE usr_id_seller = 1234
     * $query->filterByUsrIdSeller(array(12, 34)); // WHERE usr_id_seller IN (12, 34)
     * $query->filterByUsrIdSeller(array('min' => 12)); // WHERE usr_id_seller > 12
     * </code>
     *
     * @see       filterByTsUserUsrRelatedByUsrIdSeller()
     *
     * @param     mixed $usrIdSeller The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByUsrIdSeller($usrIdSeller = null, $comparison = null)
    {
        if (is_array($usrIdSeller)) {
            $useMinMax = false;
            if (isset($usrIdSeller['min'])) {
                $this->addUsingAlias(TPurchasePurPeer::USR_ID_SELLER, $usrIdSeller['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrIdSeller['max'])) {
                $this->addUsingAlias(TPurchasePurPeer::USR_ID_SELLER, $usrIdSeller['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPurchasePurPeer::USR_ID_SELLER, $usrIdSeller, $comparison);
    }

    /**
     * Filter the query on the poi_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPoiId(1234); // WHERE poi_id = 1234
     * $query->filterByPoiId(array(12, 34)); // WHERE poi_id IN (12, 34)
     * $query->filterByPoiId(array('min' => 12)); // WHERE poi_id > 12
     * </code>
     *
     * @see       filterByTPointPoi()
     *
     * @param     mixed $poiId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByPoiId($poiId = null, $comparison = null)
    {
        if (is_array($poiId)) {
            $useMinMax = false;
            if (isset($poiId['min'])) {
                $this->addUsingAlias(TPurchasePurPeer::POI_ID, $poiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($poiId['max'])) {
                $this->addUsingAlias(TPurchasePurPeer::POI_ID, $poiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPurchasePurPeer::POI_ID, $poiId, $comparison);
    }

    /**
     * Filter the query on the fun_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFunId(1234); // WHERE fun_id = 1234
     * $query->filterByFunId(array(12, 34)); // WHERE fun_id IN (12, 34)
     * $query->filterByFunId(array('min' => 12)); // WHERE fun_id > 12
     * </code>
     *
     * @see       filterByTFundationFun()
     *
     * @param     mixed $funId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(TPurchasePurPeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(TPurchasePurPeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPurchasePurPeer::FUN_ID, $funId, $comparison);
    }

    /**
     * Filter the query on the pur_ip column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE pur_ip = 'fooValue'
     * $query->filterByIp('%fooValue%'); // WHERE pur_ip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ip)) {
                $ip = str_replace('*', '%', $ip);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TPurchasePurPeer::PUR_IP, $ip, $comparison);
    }

    /**
     * Filter the query on the pur_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE pur_removed = true
     * $query->filterByRemoved('yes'); // WHERE pur_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $pur_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TPurchasePurPeer::PUR_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TObjectObj object
     *
     * @param   TObjectObj|PropelObjectCollection $tObjectObj The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPurchasePurQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTObjectObj($tObjectObj, $comparison = null)
    {
        if ($tObjectObj instanceof TObjectObj) {
            return $this
                ->addUsingAlias(TPurchasePurPeer::OBJ_ID, $tObjectObj->getId(), $comparison);
        } elseif ($tObjectObj instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TPurchasePurPeer::OBJ_ID, $tObjectObj->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTObjectObj() only accepts arguments of type TObjectObj or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TObjectObj relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function joinTObjectObj($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TObjectObj');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TObjectObj');
        }

        return $this;
    }

    /**
     * Use the TObjectObj relation TObjectObj object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TObjectObjQuery A secondary query class using the current class as primary query
     */
    public function useTObjectObjQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTObjectObj($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TObjectObj', 'TObjectObjQuery');
    }

    /**
     * Filter the query by a related TsUserUsr object
     *
     * @param   TsUserUsr|PropelObjectCollection $tsUserUsr The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPurchasePurQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsUserUsrRelatedByUsrIdBuyer($tsUserUsr, $comparison = null)
    {
        if ($tsUserUsr instanceof TsUserUsr) {
            return $this
                ->addUsingAlias(TPurchasePurPeer::USR_ID_BUYER, $tsUserUsr->getId(), $comparison);
        } elseif ($tsUserUsr instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TPurchasePurPeer::USR_ID_BUYER, $tsUserUsr->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTsUserUsrRelatedByUsrIdBuyer() only accepts arguments of type TsUserUsr or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TsUserUsrRelatedByUsrIdBuyer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function joinTsUserUsrRelatedByUsrIdBuyer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TsUserUsrRelatedByUsrIdBuyer');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TsUserUsrRelatedByUsrIdBuyer');
        }

        return $this;
    }

    /**
     * Use the TsUserUsrRelatedByUsrIdBuyer relation TsUserUsr object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TsUserUsrQuery A secondary query class using the current class as primary query
     */
    public function useTsUserUsrRelatedByUsrIdBuyerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTsUserUsrRelatedByUsrIdBuyer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TsUserUsrRelatedByUsrIdBuyer', 'TsUserUsrQuery');
    }

    /**
     * Filter the query by a related TsUserUsr object
     *
     * @param   TsUserUsr|PropelObjectCollection $tsUserUsr The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPurchasePurQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsUserUsrRelatedByUsrIdSeller($tsUserUsr, $comparison = null)
    {
        if ($tsUserUsr instanceof TsUserUsr) {
            return $this
                ->addUsingAlias(TPurchasePurPeer::USR_ID_SELLER, $tsUserUsr->getId(), $comparison);
        } elseif ($tsUserUsr instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TPurchasePurPeer::USR_ID_SELLER, $tsUserUsr->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTsUserUsrRelatedByUsrIdSeller() only accepts arguments of type TsUserUsr or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TsUserUsrRelatedByUsrIdSeller relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function joinTsUserUsrRelatedByUsrIdSeller($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TsUserUsrRelatedByUsrIdSeller');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TsUserUsrRelatedByUsrIdSeller');
        }

        return $this;
    }

    /**
     * Use the TsUserUsrRelatedByUsrIdSeller relation TsUserUsr object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TsUserUsrQuery A secondary query class using the current class as primary query
     */
    public function useTsUserUsrRelatedByUsrIdSellerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTsUserUsrRelatedByUsrIdSeller($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TsUserUsrRelatedByUsrIdSeller', 'TsUserUsrQuery');
    }

    /**
     * Filter the query by a related TPointPoi object
     *
     * @param   TPointPoi|PropelObjectCollection $tPointPoi The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPurchasePurQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPointPoi($tPointPoi, $comparison = null)
    {
        if ($tPointPoi instanceof TPointPoi) {
            return $this
                ->addUsingAlias(TPurchasePurPeer::POI_ID, $tPointPoi->getId(), $comparison);
        } elseif ($tPointPoi instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TPurchasePurPeer::POI_ID, $tPointPoi->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTPointPoi() only accepts arguments of type TPointPoi or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPointPoi relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function joinTPointPoi($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPointPoi');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TPointPoi');
        }

        return $this;
    }

    /**
     * Use the TPointPoi relation TPointPoi object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPointPoiQuery A secondary query class using the current class as primary query
     */
    public function useTPointPoiQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTPointPoi($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPointPoi', 'TPointPoiQuery');
    }

    /**
     * Filter the query by a related TFundationFun object
     *
     * @param   TFundationFun|PropelObjectCollection $tFundationFun The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPurchasePurQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTFundationFun($tFundationFun, $comparison = null)
    {
        if ($tFundationFun instanceof TFundationFun) {
            return $this
                ->addUsingAlias(TPurchasePurPeer::FUN_ID, $tFundationFun->getId(), $comparison);
        } elseif ($tFundationFun instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TPurchasePurPeer::FUN_ID, $tFundationFun->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTFundationFun() only accepts arguments of type TFundationFun or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TFundationFun relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function joinTFundationFun($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TFundationFun');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TFundationFun');
        }

        return $this;
    }

    /**
     * Use the TFundationFun relation TFundationFun object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TFundationFunQuery A secondary query class using the current class as primary query
     */
    public function useTFundationFunQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTFundationFun($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TFundationFun', 'TFundationFunQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TPurchasePur $tPurchasePur Object to remove from the list of results
     *
     * @return TPurchasePurQuery The current query, for fluid interface
     */
    public function prune($tPurchasePur = null)
    {
        if ($tPurchasePur) {
            $this->addUsingAlias(TPurchasePurPeer::PUR_ID, $tPurchasePur->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
