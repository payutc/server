<?php


/**
 * Base class that represents a query for the 'tj_usr_rig_jur' table.
 *
 *
 *
 * @method TjUsrRigJurQuery orderById($order = Criteria::ASC) Order by the jur_id column
 * @method TjUsrRigJurQuery orderByUsrId($order = Criteria::ASC) Order by the usr_id column
 * @method TjUsrRigJurQuery orderByRigId($order = Criteria::ASC) Order by the rig_id column
 * @method TjUsrRigJurQuery orderByPerId($order = Criteria::ASC) Order by the per_id column
 * @method TjUsrRigJurQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method TjUsrRigJurQuery orderByPoiId($order = Criteria::ASC) Order by the poi_id column
 * @method TjUsrRigJurQuery orderByRemoved($order = Criteria::ASC) Order by the jur_removed column
 *
 * @method TjUsrRigJurQuery groupById() Group by the jur_id column
 * @method TjUsrRigJurQuery groupByUsrId() Group by the usr_id column
 * @method TjUsrRigJurQuery groupByRigId() Group by the rig_id column
 * @method TjUsrRigJurQuery groupByPerId() Group by the per_id column
 * @method TjUsrRigJurQuery groupByFunId() Group by the fun_id column
 * @method TjUsrRigJurQuery groupByPoiId() Group by the poi_id column
 * @method TjUsrRigJurQuery groupByRemoved() Group by the jur_removed column
 *
 * @method TjUsrRigJurQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TjUsrRigJurQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TjUsrRigJurQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TjUsrRigJurQuery leftJoinTPeriodPer($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPeriodPer relation
 * @method TjUsrRigJurQuery rightJoinTPeriodPer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPeriodPer relation
 * @method TjUsrRigJurQuery innerJoinTPeriodPer($relationAlias = null) Adds a INNER JOIN clause to the query using the TPeriodPer relation
 *
 * @method TjUsrRigJurQuery leftJoinTsUserUsr($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsUserUsr relation
 * @method TjUsrRigJurQuery rightJoinTsUserUsr($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsUserUsr relation
 * @method TjUsrRigJurQuery innerJoinTsUserUsr($relationAlias = null) Adds a INNER JOIN clause to the query using the TsUserUsr relation
 *
 * @method TjUsrRigJurQuery leftJoinTsRightRig($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsRightRig relation
 * @method TjUsrRigJurQuery rightJoinTsRightRig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsRightRig relation
 * @method TjUsrRigJurQuery innerJoinTsRightRig($relationAlias = null) Adds a INNER JOIN clause to the query using the TsRightRig relation
 *
 * @method TjUsrRigJurQuery leftJoinTFundationFun($relationAlias = null) Adds a LEFT JOIN clause to the query using the TFundationFun relation
 * @method TjUsrRigJurQuery rightJoinTFundationFun($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TFundationFun relation
 * @method TjUsrRigJurQuery innerJoinTFundationFun($relationAlias = null) Adds a INNER JOIN clause to the query using the TFundationFun relation
 *
 * @method TjUsrRigJurQuery leftJoinTPointPoi($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPointPoi relation
 * @method TjUsrRigJurQuery rightJoinTPointPoi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPointPoi relation
 * @method TjUsrRigJurQuery innerJoinTPointPoi($relationAlias = null) Adds a INNER JOIN clause to the query using the TPointPoi relation
 *
 * @method TjUsrRigJur findOne(PropelPDO $con = null) Return the first TjUsrRigJur matching the query
 * @method TjUsrRigJur findOneOrCreate(PropelPDO $con = null) Return the first TjUsrRigJur matching the query, or a new TjUsrRigJur object populated from the query conditions when no match is found
 *
 * @method TjUsrRigJur findOneByUsrId(int $usr_id) Return the first TjUsrRigJur filtered by the usr_id column
 * @method TjUsrRigJur findOneByRigId(int $rig_id) Return the first TjUsrRigJur filtered by the rig_id column
 * @method TjUsrRigJur findOneByPerId(int $per_id) Return the first TjUsrRigJur filtered by the per_id column
 * @method TjUsrRigJur findOneByFunId(int $fun_id) Return the first TjUsrRigJur filtered by the fun_id column
 * @method TjUsrRigJur findOneByPoiId(int $poi_id) Return the first TjUsrRigJur filtered by the poi_id column
 * @method TjUsrRigJur findOneByRemoved(int $jur_removed) Return the first TjUsrRigJur filtered by the jur_removed column
 *
 * @method array findById(int $jur_id) Return TjUsrRigJur objects filtered by the jur_id column
 * @method array findByUsrId(int $usr_id) Return TjUsrRigJur objects filtered by the usr_id column
 * @method array findByRigId(int $rig_id) Return TjUsrRigJur objects filtered by the rig_id column
 * @method array findByPerId(int $per_id) Return TjUsrRigJur objects filtered by the per_id column
 * @method array findByFunId(int $fun_id) Return TjUsrRigJur objects filtered by the fun_id column
 * @method array findByPoiId(int $poi_id) Return TjUsrRigJur objects filtered by the poi_id column
 * @method array findByRemoved(int $jur_removed) Return TjUsrRigJur objects filtered by the jur_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTjUsrRigJurQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTjUsrRigJurQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TjUsrRigJur', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TjUsrRigJurQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TjUsrRigJurQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TjUsrRigJurQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TjUsrRigJurQuery) {
            return $criteria;
        }
        $query = new TjUsrRigJurQuery();
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
     * @return   TjUsrRigJur|TjUsrRigJur[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TjUsrRigJurPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TjUsrRigJurPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TjUsrRigJur A model object, or null if the key is not found
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
     * @return   TjUsrRigJur A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `JUR_ID`, `USR_ID`, `RIG_ID`, `PER_ID`, `FUN_ID`, `POI_ID`, `JUR_REMOVED` FROM `tj_usr_rig_jur` WHERE `JUR_ID` = :p0';
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
            $obj = new TjUsrRigJur();
            $obj->hydrate($row);
            TjUsrRigJurPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TjUsrRigJur|TjUsrRigJur[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TjUsrRigJur[]|mixed the list of results, formatted by the current formatter
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
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TjUsrRigJurPeer::JUR_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TjUsrRigJurPeer::JUR_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the jur_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE jur_id = 1234
     * $query->filterById(array(12, 34)); // WHERE jur_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE jur_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TjUsrRigJurPeer::JUR_ID, $id, $comparison);
    }

    /**
     * Filter the query on the usr_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrId(1234); // WHERE usr_id = 1234
     * $query->filterByUsrId(array(12, 34)); // WHERE usr_id IN (12, 34)
     * $query->filterByUsrId(array('min' => 12)); // WHERE usr_id > 12
     * </code>
     *
     * @see       filterByTsUserUsr()
     *
     * @param     mixed $usrId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function filterByUsrId($usrId = null, $comparison = null)
    {
        if (is_array($usrId)) {
            $useMinMax = false;
            if (isset($usrId['min'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::USR_ID, $usrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrId['max'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::USR_ID, $usrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjUsrRigJurPeer::USR_ID, $usrId, $comparison);
    }

    /**
     * Filter the query on the rig_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRigId(1234); // WHERE rig_id = 1234
     * $query->filterByRigId(array(12, 34)); // WHERE rig_id IN (12, 34)
     * $query->filterByRigId(array('min' => 12)); // WHERE rig_id > 12
     * </code>
     *
     * @see       filterByTsRightRig()
     *
     * @param     mixed $rigId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function filterByRigId($rigId = null, $comparison = null)
    {
        if (is_array($rigId)) {
            $useMinMax = false;
            if (isset($rigId['min'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::RIG_ID, $rigId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rigId['max'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::RIG_ID, $rigId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjUsrRigJurPeer::RIG_ID, $rigId, $comparison);
    }

    /**
     * Filter the query on the per_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPerId(1234); // WHERE per_id = 1234
     * $query->filterByPerId(array(12, 34)); // WHERE per_id IN (12, 34)
     * $query->filterByPerId(array('min' => 12)); // WHERE per_id > 12
     * </code>
     *
     * @see       filterByTPeriodPer()
     *
     * @param     mixed $perId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function filterByPerId($perId = null, $comparison = null)
    {
        if (is_array($perId)) {
            $useMinMax = false;
            if (isset($perId['min'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::PER_ID, $perId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($perId['max'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::PER_ID, $perId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjUsrRigJurPeer::PER_ID, $perId, $comparison);
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
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjUsrRigJurPeer::FUN_ID, $funId, $comparison);
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
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function filterByPoiId($poiId = null, $comparison = null)
    {
        if (is_array($poiId)) {
            $useMinMax = false;
            if (isset($poiId['min'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::POI_ID, $poiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($poiId['max'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::POI_ID, $poiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjUsrRigJurPeer::POI_ID, $poiId, $comparison);
    }

    /**
     * Filter the query on the jur_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(1234); // WHERE jur_removed = 1234
     * $query->filterByRemoved(array(12, 34)); // WHERE jur_removed IN (12, 34)
     * $query->filterByRemoved(array('min' => 12)); // WHERE jur_removed > 12
     * </code>
     *
     * @param     mixed $removed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_array($removed)) {
            $useMinMax = false;
            if (isset($removed['min'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::JUR_REMOVED, $removed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($removed['max'])) {
                $this->addUsingAlias(TjUsrRigJurPeer::JUR_REMOVED, $removed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjUsrRigJurPeer::JUR_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TPeriodPer object
     *
     * @param   TPeriodPer|PropelObjectCollection $tPeriodPer The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjUsrRigJurQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPeriodPer($tPeriodPer, $comparison = null)
    {
        if ($tPeriodPer instanceof TPeriodPer) {
            return $this
                ->addUsingAlias(TjUsrRigJurPeer::PER_ID, $tPeriodPer->getId(), $comparison);
        } elseif ($tPeriodPer instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjUsrRigJurPeer::PER_ID, $tPeriodPer->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTPeriodPer() only accepts arguments of type TPeriodPer or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPeriodPer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function joinTPeriodPer($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPeriodPer');

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
            $this->addJoinObject($join, 'TPeriodPer');
        }

        return $this;
    }

    /**
     * Use the TPeriodPer relation TPeriodPer object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPeriodPerQuery A secondary query class using the current class as primary query
     */
    public function useTPeriodPerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTPeriodPer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPeriodPer', 'TPeriodPerQuery');
    }

    /**
     * Filter the query by a related TsUserUsr object
     *
     * @param   TsUserUsr|PropelObjectCollection $tsUserUsr The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjUsrRigJurQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsUserUsr($tsUserUsr, $comparison = null)
    {
        if ($tsUserUsr instanceof TsUserUsr) {
            return $this
                ->addUsingAlias(TjUsrRigJurPeer::USR_ID, $tsUserUsr->getId(), $comparison);
        } elseif ($tsUserUsr instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjUsrRigJurPeer::USR_ID, $tsUserUsr->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTsUserUsr() only accepts arguments of type TsUserUsr or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TsUserUsr relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function joinTsUserUsr($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TsUserUsr');

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
            $this->addJoinObject($join, 'TsUserUsr');
        }

        return $this;
    }

    /**
     * Use the TsUserUsr relation TsUserUsr object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TsUserUsrQuery A secondary query class using the current class as primary query
     */
    public function useTsUserUsrQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTsUserUsr($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TsUserUsr', 'TsUserUsrQuery');
    }

    /**
     * Filter the query by a related TsRightRig object
     *
     * @param   TsRightRig|PropelObjectCollection $tsRightRig The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjUsrRigJurQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsRightRig($tsRightRig, $comparison = null)
    {
        if ($tsRightRig instanceof TsRightRig) {
            return $this
                ->addUsingAlias(TjUsrRigJurPeer::RIG_ID, $tsRightRig->getId(), $comparison);
        } elseif ($tsRightRig instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjUsrRigJurPeer::RIG_ID, $tsRightRig->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTsRightRig() only accepts arguments of type TsRightRig or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TsRightRig relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function joinTsRightRig($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TsRightRig');

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
            $this->addJoinObject($join, 'TsRightRig');
        }

        return $this;
    }

    /**
     * Use the TsRightRig relation TsRightRig object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TsRightRigQuery A secondary query class using the current class as primary query
     */
    public function useTsRightRigQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTsRightRig($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TsRightRig', 'TsRightRigQuery');
    }

    /**
     * Filter the query by a related TFundationFun object
     *
     * @param   TFundationFun|PropelObjectCollection $tFundationFun The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjUsrRigJurQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTFundationFun($tFundationFun, $comparison = null)
    {
        if ($tFundationFun instanceof TFundationFun) {
            return $this
                ->addUsingAlias(TjUsrRigJurPeer::FUN_ID, $tFundationFun->getId(), $comparison);
        } elseif ($tFundationFun instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjUsrRigJurPeer::FUN_ID, $tFundationFun->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function joinTFundationFun($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useTFundationFunQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTFundationFun($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TFundationFun', 'TFundationFunQuery');
    }

    /**
     * Filter the query by a related TPointPoi object
     *
     * @param   TPointPoi|PropelObjectCollection $tPointPoi The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjUsrRigJurQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPointPoi($tPointPoi, $comparison = null)
    {
        if ($tPointPoi instanceof TPointPoi) {
            return $this
                ->addUsingAlias(TjUsrRigJurPeer::POI_ID, $tPointPoi->getId(), $comparison);
        } elseif ($tPointPoi instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjUsrRigJurPeer::POI_ID, $tPointPoi->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function joinTPointPoi($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useTPointPoiQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTPointPoi($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPointPoi', 'TPointPoiQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TjUsrRigJur $tjUsrRigJur Object to remove from the list of results
     *
     * @return TjUsrRigJurQuery The current query, for fluid interface
     */
    public function prune($tjUsrRigJur = null)
    {
        if ($tjUsrRigJur) {
            $this->addUsingAlias(TjUsrRigJurPeer::JUR_ID, $tjUsrRigJur->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
