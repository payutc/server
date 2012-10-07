<?php


/**
 * Base class that represents a query for the 't_fundation_fun' table.
 *
 *
 *
 * @method TFundationFunQuery orderById($order = Criteria::ASC) Order by the fun_id column
 * @method TFundationFunQuery orderByName($order = Criteria::ASC) Order by the fun_name column
 * @method TFundationFunQuery orderByRemoved($order = Criteria::ASC) Order by the fun_removed column
 *
 * @method TFundationFunQuery groupById() Group by the fun_id column
 * @method TFundationFunQuery groupByName() Group by the fun_name column
 * @method TFundationFunQuery groupByRemoved() Group by the fun_removed column
 *
 * @method TFundationFunQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TFundationFunQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TFundationFunQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TFundationFunQuery leftJoinTGroupGrp($relationAlias = null) Adds a LEFT JOIN clause to the query using the TGroupGrp relation
 * @method TFundationFunQuery rightJoinTGroupGrp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TGroupGrp relation
 * @method TFundationFunQuery innerJoinTGroupGrp($relationAlias = null) Adds a INNER JOIN clause to the query using the TGroupGrp relation
 *
 * @method TFundationFunQuery leftJoinTObjectObj($relationAlias = null) Adds a LEFT JOIN clause to the query using the TObjectObj relation
 * @method TFundationFunQuery rightJoinTObjectObj($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TObjectObj relation
 * @method TFundationFunQuery innerJoinTObjectObj($relationAlias = null) Adds a INNER JOIN clause to the query using the TObjectObj relation
 *
 * @method TFundationFunQuery leftJoinTPeriodPer($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPeriodPer relation
 * @method TFundationFunQuery rightJoinTPeriodPer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPeriodPer relation
 * @method TFundationFunQuery innerJoinTPeriodPer($relationAlias = null) Adds a INNER JOIN clause to the query using the TPeriodPer relation
 *
 * @method TFundationFunQuery leftJoinTPlagePla($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPlagePla relation
 * @method TFundationFunQuery rightJoinTPlagePla($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPlagePla relation
 * @method TFundationFunQuery innerJoinTPlagePla($relationAlias = null) Adds a INNER JOIN clause to the query using the TPlagePla relation
 *
 * @method TFundationFunQuery leftJoinTPurchasePur($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPurchasePur relation
 * @method TFundationFunQuery rightJoinTPurchasePur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPurchasePur relation
 * @method TFundationFunQuery innerJoinTPurchasePur($relationAlias = null) Adds a INNER JOIN clause to the query using the TPurchasePur relation
 *
 * @method TFundationFunQuery leftJoinTjUsrRigJur($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjUsrRigJur relation
 * @method TFundationFunQuery rightJoinTjUsrRigJur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjUsrRigJur relation
 * @method TFundationFunQuery innerJoinTjUsrRigJur($relationAlias = null) Adds a INNER JOIN clause to the query using the TjUsrRigJur relation
 *
 * @method TFundationFun findOne(PropelPDO $con = null) Return the first TFundationFun matching the query
 * @method TFundationFun findOneOrCreate(PropelPDO $con = null) Return the first TFundationFun matching the query, or a new TFundationFun object populated from the query conditions when no match is found
 *
 * @method TFundationFun findOneByName(string $fun_name) Return the first TFundationFun filtered by the fun_name column
 * @method TFundationFun findOneByRemoved(boolean $fun_removed) Return the first TFundationFun filtered by the fun_removed column
 *
 * @method array findById(int $fun_id) Return TFundationFun objects filtered by the fun_id column
 * @method array findByName(string $fun_name) Return TFundationFun objects filtered by the fun_name column
 * @method array findByRemoved(boolean $fun_removed) Return TFundationFun objects filtered by the fun_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTFundationFunQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTFundationFunQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TFundationFun', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TFundationFunQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TFundationFunQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TFundationFunQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TFundationFunQuery) {
            return $criteria;
        }
        $query = new TFundationFunQuery();
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
     * @return   TFundationFun|TFundationFun[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TFundationFunPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TFundationFunPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TFundationFun A model object, or null if the key is not found
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
     * @return   TFundationFun A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `FUN_ID`, `FUN_NAME`, `FUN_REMOVED` FROM `t_fundation_fun` WHERE `FUN_ID` = :p0';
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
            $obj = new TFundationFun();
            $obj->hydrate($row);
            TFundationFunPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TFundationFun|TFundationFun[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TFundationFun[]|mixed the list of results, formatted by the current formatter
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
     * @return TFundationFunQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TFundationFunPeer::FUN_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TFundationFunQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TFundationFunPeer::FUN_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the fun_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE fun_id = 1234
     * $query->filterById(array(12, 34)); // WHERE fun_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE fun_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TFundationFunQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TFundationFunPeer::FUN_ID, $id, $comparison);
    }

    /**
     * Filter the query on the fun_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE fun_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE fun_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TFundationFunQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TFundationFunPeer::FUN_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the fun_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE fun_removed = true
     * $query->filterByRemoved('yes'); // WHERE fun_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TFundationFunQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $fun_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TFundationFunPeer::FUN_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TGroupGrp object
     *
     * @param   TGroupGrp|PropelObjectCollection $tGroupGrp  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TFundationFunQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTGroupGrp($tGroupGrp, $comparison = null)
    {
        if ($tGroupGrp instanceof TGroupGrp) {
            return $this
                ->addUsingAlias(TFundationFunPeer::FUN_ID, $tGroupGrp->getFunId(), $comparison);
        } elseif ($tGroupGrp instanceof PropelObjectCollection) {
            return $this
                ->useTGroupGrpQuery()
                ->filterByPrimaryKeys($tGroupGrp->getPrimaryKeys())
                ->endUse();
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
     * @return TFundationFunQuery The current query, for fluid interface
     */
    public function joinTGroupGrp($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useTGroupGrpQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTGroupGrp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TGroupGrp', 'TGroupGrpQuery');
    }

    /**
     * Filter the query by a related TObjectObj object
     *
     * @param   TObjectObj|PropelObjectCollection $tObjectObj  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TFundationFunQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTObjectObj($tObjectObj, $comparison = null)
    {
        if ($tObjectObj instanceof TObjectObj) {
            return $this
                ->addUsingAlias(TFundationFunPeer::FUN_ID, $tObjectObj->getFunId(), $comparison);
        } elseif ($tObjectObj instanceof PropelObjectCollection) {
            return $this
                ->useTObjectObjQuery()
                ->filterByPrimaryKeys($tObjectObj->getPrimaryKeys())
                ->endUse();
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
     * @return TFundationFunQuery The current query, for fluid interface
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
     * Filter the query by a related TPeriodPer object
     *
     * @param   TPeriodPer|PropelObjectCollection $tPeriodPer  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TFundationFunQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPeriodPer($tPeriodPer, $comparison = null)
    {
        if ($tPeriodPer instanceof TPeriodPer) {
            return $this
                ->addUsingAlias(TFundationFunPeer::FUN_ID, $tPeriodPer->getFunId(), $comparison);
        } elseif ($tPeriodPer instanceof PropelObjectCollection) {
            return $this
                ->useTPeriodPerQuery()
                ->filterByPrimaryKeys($tPeriodPer->getPrimaryKeys())
                ->endUse();
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
     * @return TFundationFunQuery The current query, for fluid interface
     */
    public function joinTPeriodPer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useTPeriodPerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTPeriodPer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPeriodPer', 'TPeriodPerQuery');
    }

    /**
     * Filter the query by a related TPlagePla object
     *
     * @param   TPlagePla|PropelObjectCollection $tPlagePla  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TFundationFunQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPlagePla($tPlagePla, $comparison = null)
    {
        if ($tPlagePla instanceof TPlagePla) {
            return $this
                ->addUsingAlias(TFundationFunPeer::FUN_ID, $tPlagePla->getFunId(), $comparison);
        } elseif ($tPlagePla instanceof PropelObjectCollection) {
            return $this
                ->useTPlagePlaQuery()
                ->filterByPrimaryKeys($tPlagePla->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTPlagePla() only accepts arguments of type TPlagePla or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPlagePla relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TFundationFunQuery The current query, for fluid interface
     */
    public function joinTPlagePla($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPlagePla');

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
            $this->addJoinObject($join, 'TPlagePla');
        }

        return $this;
    }

    /**
     * Use the TPlagePla relation TPlagePla object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPlagePlaQuery A secondary query class using the current class as primary query
     */
    public function useTPlagePlaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTPlagePla($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPlagePla', 'TPlagePlaQuery');
    }

    /**
     * Filter the query by a related TPurchasePur object
     *
     * @param   TPurchasePur|PropelObjectCollection $tPurchasePur  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TFundationFunQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPurchasePur($tPurchasePur, $comparison = null)
    {
        if ($tPurchasePur instanceof TPurchasePur) {
            return $this
                ->addUsingAlias(TFundationFunPeer::FUN_ID, $tPurchasePur->getFunId(), $comparison);
        } elseif ($tPurchasePur instanceof PropelObjectCollection) {
            return $this
                ->useTPurchasePurQuery()
                ->filterByPrimaryKeys($tPurchasePur->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTPurchasePur() only accepts arguments of type TPurchasePur or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPurchasePur relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TFundationFunQuery The current query, for fluid interface
     */
    public function joinTPurchasePur($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPurchasePur');

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
            $this->addJoinObject($join, 'TPurchasePur');
        }

        return $this;
    }

    /**
     * Use the TPurchasePur relation TPurchasePur object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPurchasePurQuery A secondary query class using the current class as primary query
     */
    public function useTPurchasePurQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTPurchasePur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPurchasePur', 'TPurchasePurQuery');
    }

    /**
     * Filter the query by a related TjUsrRigJur object
     *
     * @param   TjUsrRigJur|PropelObjectCollection $tjUsrRigJur  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TFundationFunQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjUsrRigJur($tjUsrRigJur, $comparison = null)
    {
        if ($tjUsrRigJur instanceof TjUsrRigJur) {
            return $this
                ->addUsingAlias(TFundationFunPeer::FUN_ID, $tjUsrRigJur->getFunId(), $comparison);
        } elseif ($tjUsrRigJur instanceof PropelObjectCollection) {
            return $this
                ->useTjUsrRigJurQuery()
                ->filterByPrimaryKeys($tjUsrRigJur->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTjUsrRigJur() only accepts arguments of type TjUsrRigJur or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TjUsrRigJur relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TFundationFunQuery The current query, for fluid interface
     */
    public function joinTjUsrRigJur($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TjUsrRigJur');

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
            $this->addJoinObject($join, 'TjUsrRigJur');
        }

        return $this;
    }

    /**
     * Use the TjUsrRigJur relation TjUsrRigJur object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TjUsrRigJurQuery A secondary query class using the current class as primary query
     */
    public function useTjUsrRigJurQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTjUsrRigJur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TjUsrRigJur', 'TjUsrRigJurQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TFundationFun $tFundationFun Object to remove from the list of results
     *
     * @return TFundationFunQuery The current query, for fluid interface
     */
    public function prune($tFundationFun = null)
    {
        if ($tFundationFun) {
            $this->addUsingAlias(TFundationFunPeer::FUN_ID, $tFundationFun->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
