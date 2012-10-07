<?php


/**
 * Base class that represents a query for the 'tj_obj_poi_jop' table.
 *
 *
 *
 * @method TjObjPoiJopQuery orderByObjId($order = Criteria::ASC) Order by the obj_id column
 * @method TjObjPoiJopQuery orderByJopPriority($order = Criteria::ASC) Order by the jop_priority column
 * @method TjObjPoiJopQuery orderByPoiId($order = Criteria::ASC) Order by the poi_id column
 *
 * @method TjObjPoiJopQuery groupByObjId() Group by the obj_id column
 * @method TjObjPoiJopQuery groupByJopPriority() Group by the jop_priority column
 * @method TjObjPoiJopQuery groupByPoiId() Group by the poi_id column
 *
 * @method TjObjPoiJopQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TjObjPoiJopQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TjObjPoiJopQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TjObjPoiJopQuery leftJoinTPointPoi($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPointPoi relation
 * @method TjObjPoiJopQuery rightJoinTPointPoi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPointPoi relation
 * @method TjObjPoiJopQuery innerJoinTPointPoi($relationAlias = null) Adds a INNER JOIN clause to the query using the TPointPoi relation
 *
 * @method TjObjPoiJopQuery leftJoinTObjectObj($relationAlias = null) Adds a LEFT JOIN clause to the query using the TObjectObj relation
 * @method TjObjPoiJopQuery rightJoinTObjectObj($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TObjectObj relation
 * @method TjObjPoiJopQuery innerJoinTObjectObj($relationAlias = null) Adds a INNER JOIN clause to the query using the TObjectObj relation
 *
 * @method TjObjPoiJop findOne(PropelPDO $con = null) Return the first TjObjPoiJop matching the query
 * @method TjObjPoiJop findOneOrCreate(PropelPDO $con = null) Return the first TjObjPoiJop matching the query, or a new TjObjPoiJop object populated from the query conditions when no match is found
 *
 * @method TjObjPoiJop findOneByObjId(int $obj_id) Return the first TjObjPoiJop filtered by the obj_id column
 * @method TjObjPoiJop findOneByJopPriority(int $jop_priority) Return the first TjObjPoiJop filtered by the jop_priority column
 * @method TjObjPoiJop findOneByPoiId(int $poi_id) Return the first TjObjPoiJop filtered by the poi_id column
 *
 * @method array findByObjId(int $obj_id) Return TjObjPoiJop objects filtered by the obj_id column
 * @method array findByJopPriority(int $jop_priority) Return TjObjPoiJop objects filtered by the jop_priority column
 * @method array findByPoiId(int $poi_id) Return TjObjPoiJop objects filtered by the poi_id column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTjObjPoiJopQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTjObjPoiJopQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TjObjPoiJop', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TjObjPoiJopQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TjObjPoiJopQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TjObjPoiJopQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TjObjPoiJopQuery) {
            return $criteria;
        }
        $query = new TjObjPoiJopQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$obj_id, $poi_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   TjObjPoiJop|TjObjPoiJop[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TjObjPoiJopPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TjObjPoiJopPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   TjObjPoiJop A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `OBJ_ID`, `JOP_PRIORITY`, `POI_ID` FROM `tj_obj_poi_jop` WHERE `OBJ_ID` = :p0 AND `POI_ID` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new TjObjPoiJop();
            $obj->hydrate($row);
            TjObjPoiJopPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return TjObjPoiJop|TjObjPoiJop[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|TjObjPoiJop[]|mixed the list of results, formatted by the current formatter
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
     * @return TjObjPoiJopQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(TjObjPoiJopPeer::OBJ_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TjObjPoiJopPeer::POI_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TjObjPoiJopQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TjObjPoiJopPeer::OBJ_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TjObjPoiJopPeer::POI_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return TjObjPoiJopQuery The current query, for fluid interface
     */
    public function filterByObjId($objId = null, $comparison = null)
    {
        if (is_array($objId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TjObjPoiJopPeer::OBJ_ID, $objId, $comparison);
    }

    /**
     * Filter the query on the jop_priority column
     *
     * Example usage:
     * <code>
     * $query->filterByJopPriority(1234); // WHERE jop_priority = 1234
     * $query->filterByJopPriority(array(12, 34)); // WHERE jop_priority IN (12, 34)
     * $query->filterByJopPriority(array('min' => 12)); // WHERE jop_priority > 12
     * </code>
     *
     * @param     mixed $jopPriority The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjObjPoiJopQuery The current query, for fluid interface
     */
    public function filterByJopPriority($jopPriority = null, $comparison = null)
    {
        if (is_array($jopPriority)) {
            $useMinMax = false;
            if (isset($jopPriority['min'])) {
                $this->addUsingAlias(TjObjPoiJopPeer::JOP_PRIORITY, $jopPriority['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($jopPriority['max'])) {
                $this->addUsingAlias(TjObjPoiJopPeer::JOP_PRIORITY, $jopPriority['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjObjPoiJopPeer::JOP_PRIORITY, $jopPriority, $comparison);
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
     * @return TjObjPoiJopQuery The current query, for fluid interface
     */
    public function filterByPoiId($poiId = null, $comparison = null)
    {
        if (is_array($poiId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TjObjPoiJopPeer::POI_ID, $poiId, $comparison);
    }

    /**
     * Filter the query by a related TPointPoi object
     *
     * @param   TPointPoi|PropelObjectCollection $tPointPoi The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjObjPoiJopQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPointPoi($tPointPoi, $comparison = null)
    {
        if ($tPointPoi instanceof TPointPoi) {
            return $this
                ->addUsingAlias(TjObjPoiJopPeer::POI_ID, $tPointPoi->getId(), $comparison);
        } elseif ($tPointPoi instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjObjPoiJopPeer::POI_ID, $tPointPoi->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TjObjPoiJopQuery The current query, for fluid interface
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
     * Filter the query by a related TObjectObj object
     *
     * @param   TObjectObj|PropelObjectCollection $tObjectObj The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjObjPoiJopQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTObjectObj($tObjectObj, $comparison = null)
    {
        if ($tObjectObj instanceof TObjectObj) {
            return $this
                ->addUsingAlias(TjObjPoiJopPeer::OBJ_ID, $tObjectObj->getId(), $comparison);
        } elseif ($tObjectObj instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjObjPoiJopPeer::OBJ_ID, $tObjectObj->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TjObjPoiJopQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   TjObjPoiJop $tjObjPoiJop Object to remove from the list of results
     *
     * @return TjObjPoiJopQuery The current query, for fluid interface
     */
    public function prune($tjObjPoiJop = null)
    {
        if ($tjObjPoiJop) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TjObjPoiJopPeer::OBJ_ID), $tjObjPoiJop->getObjId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TjObjPoiJopPeer::POI_ID), $tjObjPoiJop->getPoiId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
