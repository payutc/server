<?php


/**
 * Base class that represents a query for the 'ts_mean_of_login_mol' table.
 *
 *
 *
 * @method TsMeanOfLoginMolQuery orderById($order = Criteria::ASC) Order by the mol_id column
 * @method TsMeanOfLoginMolQuery orderByName($order = Criteria::ASC) Order by the mol_name column
 * @method TsMeanOfLoginMolQuery orderByRemoved($order = Criteria::ASC) Order by the mol_removed column
 *
 * @method TsMeanOfLoginMolQuery groupById() Group by the mol_id column
 * @method TsMeanOfLoginMolQuery groupByName() Group by the mol_name column
 * @method TsMeanOfLoginMolQuery groupByRemoved() Group by the mol_removed column
 *
 * @method TsMeanOfLoginMolQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TsMeanOfLoginMolQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TsMeanOfLoginMolQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TsMeanOfLoginMolQuery leftJoinTjUsrMolJum($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjUsrMolJum relation
 * @method TsMeanOfLoginMolQuery rightJoinTjUsrMolJum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjUsrMolJum relation
 * @method TsMeanOfLoginMolQuery innerJoinTjUsrMolJum($relationAlias = null) Adds a INNER JOIN clause to the query using the TjUsrMolJum relation
 *
 * @method TsMeanOfLoginMolQuery leftJoinTsCallbackCal($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsCallbackCal relation
 * @method TsMeanOfLoginMolQuery rightJoinTsCallbackCal($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsCallbackCal relation
 * @method TsMeanOfLoginMolQuery innerJoinTsCallbackCal($relationAlias = null) Adds a INNER JOIN clause to the query using the TsCallbackCal relation
 *
 * @method TsMeanOfLoginMol findOne(PropelPDO $con = null) Return the first TsMeanOfLoginMol matching the query
 * @method TsMeanOfLoginMol findOneOrCreate(PropelPDO $con = null) Return the first TsMeanOfLoginMol matching the query, or a new TsMeanOfLoginMol object populated from the query conditions when no match is found
 *
 * @method TsMeanOfLoginMol findOneByName(string $mol_name) Return the first TsMeanOfLoginMol filtered by the mol_name column
 * @method TsMeanOfLoginMol findOneByRemoved(boolean $mol_removed) Return the first TsMeanOfLoginMol filtered by the mol_removed column
 *
 * @method array findById(int $mol_id) Return TsMeanOfLoginMol objects filtered by the mol_id column
 * @method array findByName(string $mol_name) Return TsMeanOfLoginMol objects filtered by the mol_name column
 * @method array findByRemoved(boolean $mol_removed) Return TsMeanOfLoginMol objects filtered by the mol_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTsMeanOfLoginMolQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTsMeanOfLoginMolQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TsMeanOfLoginMol', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TsMeanOfLoginMolQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TsMeanOfLoginMolQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TsMeanOfLoginMolQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TsMeanOfLoginMolQuery) {
            return $criteria;
        }
        $query = new TsMeanOfLoginMolQuery();
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
     * @return   TsMeanOfLoginMol|TsMeanOfLoginMol[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TsMeanOfLoginMolPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TsMeanOfLoginMolPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TsMeanOfLoginMol A model object, or null if the key is not found
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
     * @return   TsMeanOfLoginMol A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `MOL_ID`, `MOL_NAME`, `MOL_REMOVED` FROM `ts_mean_of_login_mol` WHERE `MOL_ID` = :p0';
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
            $obj = new TsMeanOfLoginMol();
            $obj->hydrate($row);
            TsMeanOfLoginMolPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TsMeanOfLoginMol|TsMeanOfLoginMol[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TsMeanOfLoginMol[]|mixed the list of results, formatted by the current formatter
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
     * @return TsMeanOfLoginMolQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TsMeanOfLoginMolPeer::MOL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TsMeanOfLoginMolQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TsMeanOfLoginMolPeer::MOL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the mol_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE mol_id = 1234
     * $query->filterById(array(12, 34)); // WHERE mol_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE mol_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsMeanOfLoginMolQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TsMeanOfLoginMolPeer::MOL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the mol_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE mol_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE mol_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsMeanOfLoginMolQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TsMeanOfLoginMolPeer::MOL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the mol_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE mol_removed = true
     * $query->filterByRemoved('yes'); // WHERE mol_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsMeanOfLoginMolQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $mol_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TsMeanOfLoginMolPeer::MOL_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TjUsrMolJum object
     *
     * @param   TjUsrMolJum|PropelObjectCollection $tjUsrMolJum  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsMeanOfLoginMolQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjUsrMolJum($tjUsrMolJum, $comparison = null)
    {
        if ($tjUsrMolJum instanceof TjUsrMolJum) {
            return $this
                ->addUsingAlias(TsMeanOfLoginMolPeer::MOL_ID, $tjUsrMolJum->getMolId(), $comparison);
        } elseif ($tjUsrMolJum instanceof PropelObjectCollection) {
            return $this
                ->useTjUsrMolJumQuery()
                ->filterByPrimaryKeys($tjUsrMolJum->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTjUsrMolJum() only accepts arguments of type TjUsrMolJum or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TjUsrMolJum relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsMeanOfLoginMolQuery The current query, for fluid interface
     */
    public function joinTjUsrMolJum($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TjUsrMolJum');

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
            $this->addJoinObject($join, 'TjUsrMolJum');
        }

        return $this;
    }

    /**
     * Use the TjUsrMolJum relation TjUsrMolJum object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TjUsrMolJumQuery A secondary query class using the current class as primary query
     */
    public function useTjUsrMolJumQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTjUsrMolJum($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TjUsrMolJum', 'TjUsrMolJumQuery');
    }

    /**
     * Filter the query by a related TsCallbackCal object
     *
     * @param   TsCallbackCal|PropelObjectCollection $tsCallbackCal  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsMeanOfLoginMolQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsCallbackCal($tsCallbackCal, $comparison = null)
    {
        if ($tsCallbackCal instanceof TsCallbackCal) {
            return $this
                ->addUsingAlias(TsMeanOfLoginMolPeer::MOL_ID, $tsCallbackCal->getMolId(), $comparison);
        } elseif ($tsCallbackCal instanceof PropelObjectCollection) {
            return $this
                ->useTsCallbackCalQuery()
                ->filterByPrimaryKeys($tsCallbackCal->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTsCallbackCal() only accepts arguments of type TsCallbackCal or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TsCallbackCal relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsMeanOfLoginMolQuery The current query, for fluid interface
     */
    public function joinTsCallbackCal($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TsCallbackCal');

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
            $this->addJoinObject($join, 'TsCallbackCal');
        }

        return $this;
    }

    /**
     * Use the TsCallbackCal relation TsCallbackCal object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TsCallbackCalQuery A secondary query class using the current class as primary query
     */
    public function useTsCallbackCalQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTsCallbackCal($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TsCallbackCal', 'TsCallbackCalQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TsMeanOfLoginMol $tsMeanOfLoginMol Object to remove from the list of results
     *
     * @return TsMeanOfLoginMolQuery The current query, for fluid interface
     */
    public function prune($tsMeanOfLoginMol = null)
    {
        if ($tsMeanOfLoginMol) {
            $this->addUsingAlias(TsMeanOfLoginMolPeer::MOL_ID, $tsMeanOfLoginMol->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
