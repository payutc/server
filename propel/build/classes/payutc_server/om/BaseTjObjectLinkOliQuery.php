<?php


/**
 * Base class that represents a query for the 'tj_object_link_oli' table.
 *
 *
 *
 * @method TjObjectLinkOliQuery orderById($order = Criteria::ASC) Order by the oli_id column
 * @method TjObjectLinkOliQuery orderByObjIdParent($order = Criteria::ASC) Order by the obj_id_parent column
 * @method TjObjectLinkOliQuery orderByObjIdChild($order = Criteria::ASC) Order by the obj_id_child column
 * @method TjObjectLinkOliQuery orderByStep($order = Criteria::ASC) Order by the oli_step column
 * @method TjObjectLinkOliQuery orderByRemoved($order = Criteria::ASC) Order by the oli_removed column
 *
 * @method TjObjectLinkOliQuery groupById() Group by the oli_id column
 * @method TjObjectLinkOliQuery groupByObjIdParent() Group by the obj_id_parent column
 * @method TjObjectLinkOliQuery groupByObjIdChild() Group by the obj_id_child column
 * @method TjObjectLinkOliQuery groupByStep() Group by the oli_step column
 * @method TjObjectLinkOliQuery groupByRemoved() Group by the oli_removed column
 *
 * @method TjObjectLinkOliQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TjObjectLinkOliQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TjObjectLinkOliQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TjObjectLinkOliQuery leftJoinTObjectObjRelatedByObjIdChild($relationAlias = null) Adds a LEFT JOIN clause to the query using the TObjectObjRelatedByObjIdChild relation
 * @method TjObjectLinkOliQuery rightJoinTObjectObjRelatedByObjIdChild($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TObjectObjRelatedByObjIdChild relation
 * @method TjObjectLinkOliQuery innerJoinTObjectObjRelatedByObjIdChild($relationAlias = null) Adds a INNER JOIN clause to the query using the TObjectObjRelatedByObjIdChild relation
 *
 * @method TjObjectLinkOliQuery leftJoinTObjectObjRelatedByObjIdParent($relationAlias = null) Adds a LEFT JOIN clause to the query using the TObjectObjRelatedByObjIdParent relation
 * @method TjObjectLinkOliQuery rightJoinTObjectObjRelatedByObjIdParent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TObjectObjRelatedByObjIdParent relation
 * @method TjObjectLinkOliQuery innerJoinTObjectObjRelatedByObjIdParent($relationAlias = null) Adds a INNER JOIN clause to the query using the TObjectObjRelatedByObjIdParent relation
 *
 * @method TjObjectLinkOli findOne(PropelPDO $con = null) Return the first TjObjectLinkOli matching the query
 * @method TjObjectLinkOli findOneOrCreate(PropelPDO $con = null) Return the first TjObjectLinkOli matching the query, or a new TjObjectLinkOli object populated from the query conditions when no match is found
 *
 * @method TjObjectLinkOli findOneByObjIdParent(int $obj_id_parent) Return the first TjObjectLinkOli filtered by the obj_id_parent column
 * @method TjObjectLinkOli findOneByObjIdChild(int $obj_id_child) Return the first TjObjectLinkOli filtered by the obj_id_child column
 * @method TjObjectLinkOli findOneByStep(int $oli_step) Return the first TjObjectLinkOli filtered by the oli_step column
 * @method TjObjectLinkOli findOneByRemoved(int $oli_removed) Return the first TjObjectLinkOli filtered by the oli_removed column
 *
 * @method array findById(int $oli_id) Return TjObjectLinkOli objects filtered by the oli_id column
 * @method array findByObjIdParent(int $obj_id_parent) Return TjObjectLinkOli objects filtered by the obj_id_parent column
 * @method array findByObjIdChild(int $obj_id_child) Return TjObjectLinkOli objects filtered by the obj_id_child column
 * @method array findByStep(int $oli_step) Return TjObjectLinkOli objects filtered by the oli_step column
 * @method array findByRemoved(int $oli_removed) Return TjObjectLinkOli objects filtered by the oli_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTjObjectLinkOliQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTjObjectLinkOliQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TjObjectLinkOli', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TjObjectLinkOliQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TjObjectLinkOliQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TjObjectLinkOliQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TjObjectLinkOliQuery) {
            return $criteria;
        }
        $query = new TjObjectLinkOliQuery();
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
     * @return   TjObjectLinkOli|TjObjectLinkOli[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TjObjectLinkOliPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TjObjectLinkOliPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TjObjectLinkOli A model object, or null if the key is not found
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
     * @return   TjObjectLinkOli A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `OLI_ID`, `OBJ_ID_PARENT`, `OBJ_ID_CHILD`, `OLI_STEP`, `OLI_REMOVED` FROM `tj_object_link_oli` WHERE `OLI_ID` = :p0';
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
            $obj = new TjObjectLinkOli();
            $obj->hydrate($row);
            TjObjectLinkOliPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TjObjectLinkOli|TjObjectLinkOli[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TjObjectLinkOli[]|mixed the list of results, formatted by the current formatter
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
     * @return TjObjectLinkOliQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TjObjectLinkOliPeer::OLI_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TjObjectLinkOliQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TjObjectLinkOliPeer::OLI_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the oli_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE oli_id = 1234
     * $query->filterById(array(12, 34)); // WHERE oli_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE oli_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjObjectLinkOliQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TjObjectLinkOliPeer::OLI_ID, $id, $comparison);
    }

    /**
     * Filter the query on the obj_id_parent column
     *
     * Example usage:
     * <code>
     * $query->filterByObjIdParent(1234); // WHERE obj_id_parent = 1234
     * $query->filterByObjIdParent(array(12, 34)); // WHERE obj_id_parent IN (12, 34)
     * $query->filterByObjIdParent(array('min' => 12)); // WHERE obj_id_parent > 12
     * </code>
     *
     * @see       filterByTObjectObjRelatedByObjIdParent()
     *
     * @param     mixed $objIdParent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjObjectLinkOliQuery The current query, for fluid interface
     */
    public function filterByObjIdParent($objIdParent = null, $comparison = null)
    {
        if (is_array($objIdParent)) {
            $useMinMax = false;
            if (isset($objIdParent['min'])) {
                $this->addUsingAlias(TjObjectLinkOliPeer::OBJ_ID_PARENT, $objIdParent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($objIdParent['max'])) {
                $this->addUsingAlias(TjObjectLinkOliPeer::OBJ_ID_PARENT, $objIdParent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjObjectLinkOliPeer::OBJ_ID_PARENT, $objIdParent, $comparison);
    }

    /**
     * Filter the query on the obj_id_child column
     *
     * Example usage:
     * <code>
     * $query->filterByObjIdChild(1234); // WHERE obj_id_child = 1234
     * $query->filterByObjIdChild(array(12, 34)); // WHERE obj_id_child IN (12, 34)
     * $query->filterByObjIdChild(array('min' => 12)); // WHERE obj_id_child > 12
     * </code>
     *
     * @see       filterByTObjectObjRelatedByObjIdChild()
     *
     * @param     mixed $objIdChild The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjObjectLinkOliQuery The current query, for fluid interface
     */
    public function filterByObjIdChild($objIdChild = null, $comparison = null)
    {
        if (is_array($objIdChild)) {
            $useMinMax = false;
            if (isset($objIdChild['min'])) {
                $this->addUsingAlias(TjObjectLinkOliPeer::OBJ_ID_CHILD, $objIdChild['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($objIdChild['max'])) {
                $this->addUsingAlias(TjObjectLinkOliPeer::OBJ_ID_CHILD, $objIdChild['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjObjectLinkOliPeer::OBJ_ID_CHILD, $objIdChild, $comparison);
    }

    /**
     * Filter the query on the oli_step column
     *
     * Example usage:
     * <code>
     * $query->filterByStep(1234); // WHERE oli_step = 1234
     * $query->filterByStep(array(12, 34)); // WHERE oli_step IN (12, 34)
     * $query->filterByStep(array('min' => 12)); // WHERE oli_step > 12
     * </code>
     *
     * @param     mixed $step The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjObjectLinkOliQuery The current query, for fluid interface
     */
    public function filterByStep($step = null, $comparison = null)
    {
        if (is_array($step)) {
            $useMinMax = false;
            if (isset($step['min'])) {
                $this->addUsingAlias(TjObjectLinkOliPeer::OLI_STEP, $step['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($step['max'])) {
                $this->addUsingAlias(TjObjectLinkOliPeer::OLI_STEP, $step['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjObjectLinkOliPeer::OLI_STEP, $step, $comparison);
    }

    /**
     * Filter the query on the oli_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(1234); // WHERE oli_removed = 1234
     * $query->filterByRemoved(array(12, 34)); // WHERE oli_removed IN (12, 34)
     * $query->filterByRemoved(array('min' => 12)); // WHERE oli_removed > 12
     * </code>
     *
     * @param     mixed $removed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjObjectLinkOliQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_array($removed)) {
            $useMinMax = false;
            if (isset($removed['min'])) {
                $this->addUsingAlias(TjObjectLinkOliPeer::OLI_REMOVED, $removed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($removed['max'])) {
                $this->addUsingAlias(TjObjectLinkOliPeer::OLI_REMOVED, $removed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjObjectLinkOliPeer::OLI_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TObjectObj object
     *
     * @param   TObjectObj|PropelObjectCollection $tObjectObj The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjObjectLinkOliQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTObjectObjRelatedByObjIdChild($tObjectObj, $comparison = null)
    {
        if ($tObjectObj instanceof TObjectObj) {
            return $this
                ->addUsingAlias(TjObjectLinkOliPeer::OBJ_ID_CHILD, $tObjectObj->getId(), $comparison);
        } elseif ($tObjectObj instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjObjectLinkOliPeer::OBJ_ID_CHILD, $tObjectObj->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTObjectObjRelatedByObjIdChild() only accepts arguments of type TObjectObj or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TObjectObjRelatedByObjIdChild relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TjObjectLinkOliQuery The current query, for fluid interface
     */
    public function joinTObjectObjRelatedByObjIdChild($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TObjectObjRelatedByObjIdChild');

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
            $this->addJoinObject($join, 'TObjectObjRelatedByObjIdChild');
        }

        return $this;
    }

    /**
     * Use the TObjectObjRelatedByObjIdChild relation TObjectObj object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TObjectObjQuery A secondary query class using the current class as primary query
     */
    public function useTObjectObjRelatedByObjIdChildQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTObjectObjRelatedByObjIdChild($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TObjectObjRelatedByObjIdChild', 'TObjectObjQuery');
    }

    /**
     * Filter the query by a related TObjectObj object
     *
     * @param   TObjectObj|PropelObjectCollection $tObjectObj The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjObjectLinkOliQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTObjectObjRelatedByObjIdParent($tObjectObj, $comparison = null)
    {
        if ($tObjectObj instanceof TObjectObj) {
            return $this
                ->addUsingAlias(TjObjectLinkOliPeer::OBJ_ID_PARENT, $tObjectObj->getId(), $comparison);
        } elseif ($tObjectObj instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjObjectLinkOliPeer::OBJ_ID_PARENT, $tObjectObj->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTObjectObjRelatedByObjIdParent() only accepts arguments of type TObjectObj or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TObjectObjRelatedByObjIdParent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TjObjectLinkOliQuery The current query, for fluid interface
     */
    public function joinTObjectObjRelatedByObjIdParent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TObjectObjRelatedByObjIdParent');

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
            $this->addJoinObject($join, 'TObjectObjRelatedByObjIdParent');
        }

        return $this;
    }

    /**
     * Use the TObjectObjRelatedByObjIdParent relation TObjectObj object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TObjectObjQuery A secondary query class using the current class as primary query
     */
    public function useTObjectObjRelatedByObjIdParentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTObjectObjRelatedByObjIdParent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TObjectObjRelatedByObjIdParent', 'TObjectObjQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TjObjectLinkOli $tjObjectLinkOli Object to remove from the list of results
     *
     * @return TjObjectLinkOliQuery The current query, for fluid interface
     */
    public function prune($tjObjectLinkOli = null)
    {
        if ($tjObjectLinkOli) {
            $this->addUsingAlias(TjObjectLinkOliPeer::OLI_ID, $tjObjectLinkOli->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
