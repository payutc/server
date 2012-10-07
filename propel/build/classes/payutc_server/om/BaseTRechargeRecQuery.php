<?php


/**
 * Base class that represents a query for the 't_recharge_rec' table.
 *
 *
 *
 * @method TRechargeRecQuery orderById($order = Criteria::ASC) Order by the rec_id column
 * @method TRechargeRecQuery orderByRtyId($order = Criteria::ASC) Order by the rty_id column
 * @method TRechargeRecQuery orderByUsrIdBuyer($order = Criteria::ASC) Order by the usr_id_buyer column
 * @method TRechargeRecQuery orderByUsrIdOperator($order = Criteria::ASC) Order by the usr_id_operator column
 * @method TRechargeRecQuery orderByPoiId($order = Criteria::ASC) Order by the poi_id column
 * @method TRechargeRecQuery orderByDate($order = Criteria::ASC) Order by the rec_date column
 * @method TRechargeRecQuery orderByCredit($order = Criteria::ASC) Order by the rec_credit column
 * @method TRechargeRecQuery orderByTrace($order = Criteria::ASC) Order by the rec_trace column
 * @method TRechargeRecQuery orderByRemoved($order = Criteria::ASC) Order by the rec_removed column
 *
 * @method TRechargeRecQuery groupById() Group by the rec_id column
 * @method TRechargeRecQuery groupByRtyId() Group by the rty_id column
 * @method TRechargeRecQuery groupByUsrIdBuyer() Group by the usr_id_buyer column
 * @method TRechargeRecQuery groupByUsrIdOperator() Group by the usr_id_operator column
 * @method TRechargeRecQuery groupByPoiId() Group by the poi_id column
 * @method TRechargeRecQuery groupByDate() Group by the rec_date column
 * @method TRechargeRecQuery groupByCredit() Group by the rec_credit column
 * @method TRechargeRecQuery groupByTrace() Group by the rec_trace column
 * @method TRechargeRecQuery groupByRemoved() Group by the rec_removed column
 *
 * @method TRechargeRecQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TRechargeRecQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TRechargeRecQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TRechargeRecQuery leftJoinTPointPoi($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPointPoi relation
 * @method TRechargeRecQuery rightJoinTPointPoi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPointPoi relation
 * @method TRechargeRecQuery innerJoinTPointPoi($relationAlias = null) Adds a INNER JOIN clause to the query using the TPointPoi relation
 *
 * @method TRechargeRecQuery leftJoinTRechargeTypeRty($relationAlias = null) Adds a LEFT JOIN clause to the query using the TRechargeTypeRty relation
 * @method TRechargeRecQuery rightJoinTRechargeTypeRty($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TRechargeTypeRty relation
 * @method TRechargeRecQuery innerJoinTRechargeTypeRty($relationAlias = null) Adds a INNER JOIN clause to the query using the TRechargeTypeRty relation
 *
 * @method TRechargeRecQuery leftJoinTsUserUsrRelatedByUsrIdBuyer($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsUserUsrRelatedByUsrIdBuyer relation
 * @method TRechargeRecQuery rightJoinTsUserUsrRelatedByUsrIdBuyer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsUserUsrRelatedByUsrIdBuyer relation
 * @method TRechargeRecQuery innerJoinTsUserUsrRelatedByUsrIdBuyer($relationAlias = null) Adds a INNER JOIN clause to the query using the TsUserUsrRelatedByUsrIdBuyer relation
 *
 * @method TRechargeRecQuery leftJoinTsUserUsrRelatedByUsrIdOperator($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsUserUsrRelatedByUsrIdOperator relation
 * @method TRechargeRecQuery rightJoinTsUserUsrRelatedByUsrIdOperator($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsUserUsrRelatedByUsrIdOperator relation
 * @method TRechargeRecQuery innerJoinTsUserUsrRelatedByUsrIdOperator($relationAlias = null) Adds a INNER JOIN clause to the query using the TsUserUsrRelatedByUsrIdOperator relation
 *
 * @method TRechargeRec findOne(PropelPDO $con = null) Return the first TRechargeRec matching the query
 * @method TRechargeRec findOneOrCreate(PropelPDO $con = null) Return the first TRechargeRec matching the query, or a new TRechargeRec object populated from the query conditions when no match is found
 *
 * @method TRechargeRec findOneByRtyId(int $rty_id) Return the first TRechargeRec filtered by the rty_id column
 * @method TRechargeRec findOneByUsrIdBuyer(int $usr_id_buyer) Return the first TRechargeRec filtered by the usr_id_buyer column
 * @method TRechargeRec findOneByUsrIdOperator(int $usr_id_operator) Return the first TRechargeRec filtered by the usr_id_operator column
 * @method TRechargeRec findOneByPoiId(int $poi_id) Return the first TRechargeRec filtered by the poi_id column
 * @method TRechargeRec findOneByDate(string $rec_date) Return the first TRechargeRec filtered by the rec_date column
 * @method TRechargeRec findOneByCredit(int $rec_credit) Return the first TRechargeRec filtered by the rec_credit column
 * @method TRechargeRec findOneByTrace(string $rec_trace) Return the first TRechargeRec filtered by the rec_trace column
 * @method TRechargeRec findOneByRemoved(boolean $rec_removed) Return the first TRechargeRec filtered by the rec_removed column
 *
 * @method array findById(int $rec_id) Return TRechargeRec objects filtered by the rec_id column
 * @method array findByRtyId(int $rty_id) Return TRechargeRec objects filtered by the rty_id column
 * @method array findByUsrIdBuyer(int $usr_id_buyer) Return TRechargeRec objects filtered by the usr_id_buyer column
 * @method array findByUsrIdOperator(int $usr_id_operator) Return TRechargeRec objects filtered by the usr_id_operator column
 * @method array findByPoiId(int $poi_id) Return TRechargeRec objects filtered by the poi_id column
 * @method array findByDate(string $rec_date) Return TRechargeRec objects filtered by the rec_date column
 * @method array findByCredit(int $rec_credit) Return TRechargeRec objects filtered by the rec_credit column
 * @method array findByTrace(string $rec_trace) Return TRechargeRec objects filtered by the rec_trace column
 * @method array findByRemoved(boolean $rec_removed) Return TRechargeRec objects filtered by the rec_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTRechargeRecQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTRechargeRecQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TRechargeRec', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TRechargeRecQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TRechargeRecQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TRechargeRecQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TRechargeRecQuery) {
            return $criteria;
        }
        $query = new TRechargeRecQuery();
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
     * @return   TRechargeRec|TRechargeRec[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TRechargeRecPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TRechargeRecPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TRechargeRec A model object, or null if the key is not found
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
     * @return   TRechargeRec A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `REC_ID`, `RTY_ID`, `USR_ID_BUYER`, `USR_ID_OPERATOR`, `POI_ID`, `REC_DATE`, `REC_CREDIT`, `REC_TRACE`, `REC_REMOVED` FROM `t_recharge_rec` WHERE `REC_ID` = :p0';
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
            $obj = new TRechargeRec();
            $obj->hydrate($row);
            TRechargeRecPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TRechargeRec|TRechargeRec[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TRechargeRec[]|mixed the list of results, formatted by the current formatter
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
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TRechargeRecPeer::REC_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TRechargeRecPeer::REC_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the rec_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE rec_id = 1234
     * $query->filterById(array(12, 34)); // WHERE rec_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE rec_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TRechargeRecPeer::REC_ID, $id, $comparison);
    }

    /**
     * Filter the query on the rty_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRtyId(1234); // WHERE rty_id = 1234
     * $query->filterByRtyId(array(12, 34)); // WHERE rty_id IN (12, 34)
     * $query->filterByRtyId(array('min' => 12)); // WHERE rty_id > 12
     * </code>
     *
     * @see       filterByTRechargeTypeRty()
     *
     * @param     mixed $rtyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function filterByRtyId($rtyId = null, $comparison = null)
    {
        if (is_array($rtyId)) {
            $useMinMax = false;
            if (isset($rtyId['min'])) {
                $this->addUsingAlias(TRechargeRecPeer::RTY_ID, $rtyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rtyId['max'])) {
                $this->addUsingAlias(TRechargeRecPeer::RTY_ID, $rtyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TRechargeRecPeer::RTY_ID, $rtyId, $comparison);
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
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function filterByUsrIdBuyer($usrIdBuyer = null, $comparison = null)
    {
        if (is_array($usrIdBuyer)) {
            $useMinMax = false;
            if (isset($usrIdBuyer['min'])) {
                $this->addUsingAlias(TRechargeRecPeer::USR_ID_BUYER, $usrIdBuyer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrIdBuyer['max'])) {
                $this->addUsingAlias(TRechargeRecPeer::USR_ID_BUYER, $usrIdBuyer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TRechargeRecPeer::USR_ID_BUYER, $usrIdBuyer, $comparison);
    }

    /**
     * Filter the query on the usr_id_operator column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrIdOperator(1234); // WHERE usr_id_operator = 1234
     * $query->filterByUsrIdOperator(array(12, 34)); // WHERE usr_id_operator IN (12, 34)
     * $query->filterByUsrIdOperator(array('min' => 12)); // WHERE usr_id_operator > 12
     * </code>
     *
     * @see       filterByTsUserUsrRelatedByUsrIdOperator()
     *
     * @param     mixed $usrIdOperator The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function filterByUsrIdOperator($usrIdOperator = null, $comparison = null)
    {
        if (is_array($usrIdOperator)) {
            $useMinMax = false;
            if (isset($usrIdOperator['min'])) {
                $this->addUsingAlias(TRechargeRecPeer::USR_ID_OPERATOR, $usrIdOperator['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrIdOperator['max'])) {
                $this->addUsingAlias(TRechargeRecPeer::USR_ID_OPERATOR, $usrIdOperator['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TRechargeRecPeer::USR_ID_OPERATOR, $usrIdOperator, $comparison);
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
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function filterByPoiId($poiId = null, $comparison = null)
    {
        if (is_array($poiId)) {
            $useMinMax = false;
            if (isset($poiId['min'])) {
                $this->addUsingAlias(TRechargeRecPeer::POI_ID, $poiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($poiId['max'])) {
                $this->addUsingAlias(TRechargeRecPeer::POI_ID, $poiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TRechargeRecPeer::POI_ID, $poiId, $comparison);
    }

    /**
     * Filter the query on the rec_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE rec_date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE rec_date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE rec_date > '2011-03-13'
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
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(TRechargeRecPeer::REC_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(TRechargeRecPeer::REC_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TRechargeRecPeer::REC_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the rec_credit column
     *
     * Example usage:
     * <code>
     * $query->filterByCredit(1234); // WHERE rec_credit = 1234
     * $query->filterByCredit(array(12, 34)); // WHERE rec_credit IN (12, 34)
     * $query->filterByCredit(array('min' => 12)); // WHERE rec_credit > 12
     * </code>
     *
     * @param     mixed $credit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function filterByCredit($credit = null, $comparison = null)
    {
        if (is_array($credit)) {
            $useMinMax = false;
            if (isset($credit['min'])) {
                $this->addUsingAlias(TRechargeRecPeer::REC_CREDIT, $credit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($credit['max'])) {
                $this->addUsingAlias(TRechargeRecPeer::REC_CREDIT, $credit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TRechargeRecPeer::REC_CREDIT, $credit, $comparison);
    }

    /**
     * Filter the query on the rec_trace column
     *
     * Example usage:
     * <code>
     * $query->filterByTrace('fooValue');   // WHERE rec_trace = 'fooValue'
     * $query->filterByTrace('%fooValue%'); // WHERE rec_trace LIKE '%fooValue%'
     * </code>
     *
     * @param     string $trace The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function filterByTrace($trace = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($trace)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $trace)) {
                $trace = str_replace('*', '%', $trace);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TRechargeRecPeer::REC_TRACE, $trace, $comparison);
    }

    /**
     * Filter the query on the rec_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE rec_removed = true
     * $query->filterByRemoved('yes'); // WHERE rec_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $rec_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TRechargeRecPeer::REC_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TPointPoi object
     *
     * @param   TPointPoi|PropelObjectCollection $tPointPoi The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TRechargeRecQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPointPoi($tPointPoi, $comparison = null)
    {
        if ($tPointPoi instanceof TPointPoi) {
            return $this
                ->addUsingAlias(TRechargeRecPeer::POI_ID, $tPointPoi->getId(), $comparison);
        } elseif ($tPointPoi instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TRechargeRecPeer::POI_ID, $tPointPoi->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TRechargeRecQuery The current query, for fluid interface
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
     * Filter the query by a related TRechargeTypeRty object
     *
     * @param   TRechargeTypeRty|PropelObjectCollection $tRechargeTypeRty The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TRechargeRecQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTRechargeTypeRty($tRechargeTypeRty, $comparison = null)
    {
        if ($tRechargeTypeRty instanceof TRechargeTypeRty) {
            return $this
                ->addUsingAlias(TRechargeRecPeer::RTY_ID, $tRechargeTypeRty->getRtyId(), $comparison);
        } elseif ($tRechargeTypeRty instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TRechargeRecPeer::RTY_ID, $tRechargeTypeRty->toKeyValue('PrimaryKey', 'RtyId'), $comparison);
        } else {
            throw new PropelException('filterByTRechargeTypeRty() only accepts arguments of type TRechargeTypeRty or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TRechargeTypeRty relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function joinTRechargeTypeRty($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TRechargeTypeRty');

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
            $this->addJoinObject($join, 'TRechargeTypeRty');
        }

        return $this;
    }

    /**
     * Use the TRechargeTypeRty relation TRechargeTypeRty object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TRechargeTypeRtyQuery A secondary query class using the current class as primary query
     */
    public function useTRechargeTypeRtyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTRechargeTypeRty($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TRechargeTypeRty', 'TRechargeTypeRtyQuery');
    }

    /**
     * Filter the query by a related TsUserUsr object
     *
     * @param   TsUserUsr|PropelObjectCollection $tsUserUsr The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TRechargeRecQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsUserUsrRelatedByUsrIdBuyer($tsUserUsr, $comparison = null)
    {
        if ($tsUserUsr instanceof TsUserUsr) {
            return $this
                ->addUsingAlias(TRechargeRecPeer::USR_ID_BUYER, $tsUserUsr->getId(), $comparison);
        } elseif ($tsUserUsr instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TRechargeRecPeer::USR_ID_BUYER, $tsUserUsr->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TRechargeRecQuery The current query, for fluid interface
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
     * @return   TRechargeRecQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsUserUsrRelatedByUsrIdOperator($tsUserUsr, $comparison = null)
    {
        if ($tsUserUsr instanceof TsUserUsr) {
            return $this
                ->addUsingAlias(TRechargeRecPeer::USR_ID_OPERATOR, $tsUserUsr->getId(), $comparison);
        } elseif ($tsUserUsr instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TRechargeRecPeer::USR_ID_OPERATOR, $tsUserUsr->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTsUserUsrRelatedByUsrIdOperator() only accepts arguments of type TsUserUsr or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TsUserUsrRelatedByUsrIdOperator relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function joinTsUserUsrRelatedByUsrIdOperator($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TsUserUsrRelatedByUsrIdOperator');

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
            $this->addJoinObject($join, 'TsUserUsrRelatedByUsrIdOperator');
        }

        return $this;
    }

    /**
     * Use the TsUserUsrRelatedByUsrIdOperator relation TsUserUsr object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TsUserUsrQuery A secondary query class using the current class as primary query
     */
    public function useTsUserUsrRelatedByUsrIdOperatorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTsUserUsrRelatedByUsrIdOperator($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TsUserUsrRelatedByUsrIdOperator', 'TsUserUsrQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TRechargeRec $tRechargeRec Object to remove from the list of results
     *
     * @return TRechargeRecQuery The current query, for fluid interface
     */
    public function prune($tRechargeRec = null)
    {
        if ($tRechargeRec) {
            $this->addUsingAlias(TRechargeRecPeer::REC_ID, $tRechargeRec->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
