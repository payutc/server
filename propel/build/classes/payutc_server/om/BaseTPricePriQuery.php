<?php


/**
 * Base class that represents a query for the 't_price_pri' table.
 *
 *
 *
 * @method TPricePriQuery orderById($order = Criteria::ASC) Order by the pri_id column
 * @method TPricePriQuery orderByObjId($order = Criteria::ASC) Order by the obj_id column
 * @method TPricePriQuery orderByGrpId($order = Criteria::ASC) Order by the grp_id column
 * @method TPricePriQuery orderByPerId($order = Criteria::ASC) Order by the per_id column
 * @method TPricePriQuery orderByCredit($order = Criteria::ASC) Order by the pri_credit column
 * @method TPricePriQuery orderByRemoved($order = Criteria::ASC) Order by the pri_removed column
 *
 * @method TPricePriQuery groupById() Group by the pri_id column
 * @method TPricePriQuery groupByObjId() Group by the obj_id column
 * @method TPricePriQuery groupByGrpId() Group by the grp_id column
 * @method TPricePriQuery groupByPerId() Group by the per_id column
 * @method TPricePriQuery groupByCredit() Group by the pri_credit column
 * @method TPricePriQuery groupByRemoved() Group by the pri_removed column
 *
 * @method TPricePriQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TPricePriQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TPricePriQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TPricePriQuery leftJoinTPeriodPer($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPeriodPer relation
 * @method TPricePriQuery rightJoinTPeriodPer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPeriodPer relation
 * @method TPricePriQuery innerJoinTPeriodPer($relationAlias = null) Adds a INNER JOIN clause to the query using the TPeriodPer relation
 *
 * @method TPricePriQuery leftJoinTObjectObj($relationAlias = null) Adds a LEFT JOIN clause to the query using the TObjectObj relation
 * @method TPricePriQuery rightJoinTObjectObj($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TObjectObj relation
 * @method TPricePriQuery innerJoinTObjectObj($relationAlias = null) Adds a INNER JOIN clause to the query using the TObjectObj relation
 *
 * @method TPricePriQuery leftJoinTGroupGrp($relationAlias = null) Adds a LEFT JOIN clause to the query using the TGroupGrp relation
 * @method TPricePriQuery rightJoinTGroupGrp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TGroupGrp relation
 * @method TPricePriQuery innerJoinTGroupGrp($relationAlias = null) Adds a INNER JOIN clause to the query using the TGroupGrp relation
 *
 * @method TPricePri findOne(PropelPDO $con = null) Return the first TPricePri matching the query
 * @method TPricePri findOneOrCreate(PropelPDO $con = null) Return the first TPricePri matching the query, or a new TPricePri object populated from the query conditions when no match is found
 *
 * @method TPricePri findOneByObjId(int $obj_id) Return the first TPricePri filtered by the obj_id column
 * @method TPricePri findOneByGrpId(int $grp_id) Return the first TPricePri filtered by the grp_id column
 * @method TPricePri findOneByPerId(int $per_id) Return the first TPricePri filtered by the per_id column
 * @method TPricePri findOneByCredit(int $pri_credit) Return the first TPricePri filtered by the pri_credit column
 * @method TPricePri findOneByRemoved(boolean $pri_removed) Return the first TPricePri filtered by the pri_removed column
 *
 * @method array findById(int $pri_id) Return TPricePri objects filtered by the pri_id column
 * @method array findByObjId(int $obj_id) Return TPricePri objects filtered by the obj_id column
 * @method array findByGrpId(int $grp_id) Return TPricePri objects filtered by the grp_id column
 * @method array findByPerId(int $per_id) Return TPricePri objects filtered by the per_id column
 * @method array findByCredit(int $pri_credit) Return TPricePri objects filtered by the pri_credit column
 * @method array findByRemoved(boolean $pri_removed) Return TPricePri objects filtered by the pri_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTPricePriQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTPricePriQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TPricePri', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TPricePriQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TPricePriQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TPricePriQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TPricePriQuery) {
            return $criteria;
        }
        $query = new TPricePriQuery();
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
     * @return   TPricePri|TPricePri[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TPricePriPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TPricePriPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TPricePri A model object, or null if the key is not found
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
     * @return   TPricePri A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `PRI_ID`, `OBJ_ID`, `GRP_ID`, `PER_ID`, `PRI_CREDIT`, `PRI_REMOVED` FROM `t_price_pri` WHERE `PRI_ID` = :p0';
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
            $obj = new TPricePri();
            $obj->hydrate($row);
            TPricePriPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TPricePri|TPricePri[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TPricePri[]|mixed the list of results, formatted by the current formatter
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
     * @return TPricePriQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TPricePriPeer::PRI_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TPricePriQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TPricePriPeer::PRI_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pri_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE pri_id = 1234
     * $query->filterById(array(12, 34)); // WHERE pri_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE pri_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPricePriQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TPricePriPeer::PRI_ID, $id, $comparison);
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
     * @return TPricePriQuery The current query, for fluid interface
     */
    public function filterByObjId($objId = null, $comparison = null)
    {
        if (is_array($objId)) {
            $useMinMax = false;
            if (isset($objId['min'])) {
                $this->addUsingAlias(TPricePriPeer::OBJ_ID, $objId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($objId['max'])) {
                $this->addUsingAlias(TPricePriPeer::OBJ_ID, $objId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPricePriPeer::OBJ_ID, $objId, $comparison);
    }

    /**
     * Filter the query on the grp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGrpId(1234); // WHERE grp_id = 1234
     * $query->filterByGrpId(array(12, 34)); // WHERE grp_id IN (12, 34)
     * $query->filterByGrpId(array('min' => 12)); // WHERE grp_id > 12
     * </code>
     *
     * @see       filterByTGroupGrp()
     *
     * @param     mixed $grpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPricePriQuery The current query, for fluid interface
     */
    public function filterByGrpId($grpId = null, $comparison = null)
    {
        if (is_array($grpId)) {
            $useMinMax = false;
            if (isset($grpId['min'])) {
                $this->addUsingAlias(TPricePriPeer::GRP_ID, $grpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grpId['max'])) {
                $this->addUsingAlias(TPricePriPeer::GRP_ID, $grpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPricePriPeer::GRP_ID, $grpId, $comparison);
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
     * @return TPricePriQuery The current query, for fluid interface
     */
    public function filterByPerId($perId = null, $comparison = null)
    {
        if (is_array($perId)) {
            $useMinMax = false;
            if (isset($perId['min'])) {
                $this->addUsingAlias(TPricePriPeer::PER_ID, $perId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($perId['max'])) {
                $this->addUsingAlias(TPricePriPeer::PER_ID, $perId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPricePriPeer::PER_ID, $perId, $comparison);
    }

    /**
     * Filter the query on the pri_credit column
     *
     * Example usage:
     * <code>
     * $query->filterByCredit(1234); // WHERE pri_credit = 1234
     * $query->filterByCredit(array(12, 34)); // WHERE pri_credit IN (12, 34)
     * $query->filterByCredit(array('min' => 12)); // WHERE pri_credit > 12
     * </code>
     *
     * @param     mixed $credit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPricePriQuery The current query, for fluid interface
     */
    public function filterByCredit($credit = null, $comparison = null)
    {
        if (is_array($credit)) {
            $useMinMax = false;
            if (isset($credit['min'])) {
                $this->addUsingAlias(TPricePriPeer::PRI_CREDIT, $credit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($credit['max'])) {
                $this->addUsingAlias(TPricePriPeer::PRI_CREDIT, $credit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPricePriPeer::PRI_CREDIT, $credit, $comparison);
    }

    /**
     * Filter the query on the pri_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE pri_removed = true
     * $query->filterByRemoved('yes'); // WHERE pri_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPricePriQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $pri_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TPricePriPeer::PRI_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TPeriodPer object
     *
     * @param   TPeriodPer|PropelObjectCollection $tPeriodPer The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPricePriQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPeriodPer($tPeriodPer, $comparison = null)
    {
        if ($tPeriodPer instanceof TPeriodPer) {
            return $this
                ->addUsingAlias(TPricePriPeer::PER_ID, $tPeriodPer->getId(), $comparison);
        } elseif ($tPeriodPer instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TPricePriPeer::PER_ID, $tPeriodPer->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TPricePriQuery The current query, for fluid interface
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
     * Filter the query by a related TObjectObj object
     *
     * @param   TObjectObj|PropelObjectCollection $tObjectObj The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPricePriQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTObjectObj($tObjectObj, $comparison = null)
    {
        if ($tObjectObj instanceof TObjectObj) {
            return $this
                ->addUsingAlias(TPricePriPeer::OBJ_ID, $tObjectObj->getId(), $comparison);
        } elseif ($tObjectObj instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TPricePriPeer::OBJ_ID, $tObjectObj->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TPricePriQuery The current query, for fluid interface
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
     * Filter the query by a related TGroupGrp object
     *
     * @param   TGroupGrp|PropelObjectCollection $tGroupGrp The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPricePriQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTGroupGrp($tGroupGrp, $comparison = null)
    {
        if ($tGroupGrp instanceof TGroupGrp) {
            return $this
                ->addUsingAlias(TPricePriPeer::GRP_ID, $tGroupGrp->getId(), $comparison);
        } elseif ($tGroupGrp instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TPricePriPeer::GRP_ID, $tGroupGrp->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTGroupGrp() only accepts arguments of type TGroupGrp or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TGroupGrp relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TPricePriQuery The current query, for fluid interface
     */
    public function joinTGroupGrp($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TGroupGrp');

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
            $this->addJoinObject($join, 'TGroupGrp');
        }

        return $this;
    }

    /**
     * Use the TGroupGrp relation TGroupGrp object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TGroupGrpQuery A secondary query class using the current class as primary query
     */
    public function useTGroupGrpQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTGroupGrp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TGroupGrp', 'TGroupGrpQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TPricePri $tPricePri Object to remove from the list of results
     *
     * @return TPricePriQuery The current query, for fluid interface
     */
    public function prune($tPricePri = null)
    {
        if ($tPricePri) {
            $this->addUsingAlias(TPricePriPeer::PRI_ID, $tPricePri->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
