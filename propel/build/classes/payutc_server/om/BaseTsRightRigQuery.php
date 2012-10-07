<?php


/**
 * Base class that represents a query for the 'ts_right_rig' table.
 *
 *
 *
 * @method TsRightRigQuery orderById($order = Criteria::ASC) Order by the rig_id column
 * @method TsRightRigQuery orderByName($order = Criteria::ASC) Order by the rig_name column
 * @method TsRightRigQuery orderByDescription($order = Criteria::ASC) Order by the rig_description column
 * @method TsRightRigQuery orderByAdmin($order = Criteria::ASC) Order by the rig_admin column
 * @method TsRightRigQuery orderByRemoved($order = Criteria::ASC) Order by the rig_removed column
 *
 * @method TsRightRigQuery groupById() Group by the rig_id column
 * @method TsRightRigQuery groupByName() Group by the rig_name column
 * @method TsRightRigQuery groupByDescription() Group by the rig_description column
 * @method TsRightRigQuery groupByAdmin() Group by the rig_admin column
 * @method TsRightRigQuery groupByRemoved() Group by the rig_removed column
 *
 * @method TsRightRigQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TsRightRigQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TsRightRigQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TsRightRigQuery leftJoinTjUsrRigJur($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjUsrRigJur relation
 * @method TsRightRigQuery rightJoinTjUsrRigJur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjUsrRigJur relation
 * @method TsRightRigQuery innerJoinTjUsrRigJur($relationAlias = null) Adds a INNER JOIN clause to the query using the TjUsrRigJur relation
 *
 * @method TsRightRig findOne(PropelPDO $con = null) Return the first TsRightRig matching the query
 * @method TsRightRig findOneOrCreate(PropelPDO $con = null) Return the first TsRightRig matching the query, or a new TsRightRig object populated from the query conditions when no match is found
 *
 * @method TsRightRig findOneByName(string $rig_name) Return the first TsRightRig filtered by the rig_name column
 * @method TsRightRig findOneByDescription(string $rig_description) Return the first TsRightRig filtered by the rig_description column
 * @method TsRightRig findOneByAdmin(boolean $rig_admin) Return the first TsRightRig filtered by the rig_admin column
 * @method TsRightRig findOneByRemoved(boolean $rig_removed) Return the first TsRightRig filtered by the rig_removed column
 *
 * @method array findById(int $rig_id) Return TsRightRig objects filtered by the rig_id column
 * @method array findByName(string $rig_name) Return TsRightRig objects filtered by the rig_name column
 * @method array findByDescription(string $rig_description) Return TsRightRig objects filtered by the rig_description column
 * @method array findByAdmin(boolean $rig_admin) Return TsRightRig objects filtered by the rig_admin column
 * @method array findByRemoved(boolean $rig_removed) Return TsRightRig objects filtered by the rig_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTsRightRigQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTsRightRigQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TsRightRig', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TsRightRigQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TsRightRigQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TsRightRigQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TsRightRigQuery) {
            return $criteria;
        }
        $query = new TsRightRigQuery();
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
     * @return   TsRightRig|TsRightRig[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TsRightRigPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TsRightRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TsRightRig A model object, or null if the key is not found
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
     * @return   TsRightRig A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `RIG_ID`, `RIG_NAME`, `RIG_DESCRIPTION`, `RIG_ADMIN`, `RIG_REMOVED` FROM `ts_right_rig` WHERE `RIG_ID` = :p0';
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
            $obj = new TsRightRig();
            $obj->hydrate($row);
            TsRightRigPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TsRightRig|TsRightRig[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TsRightRig[]|mixed the list of results, formatted by the current formatter
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
     * @return TsRightRigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TsRightRigPeer::RIG_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TsRightRigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TsRightRigPeer::RIG_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the rig_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE rig_id = 1234
     * $query->filterById(array(12, 34)); // WHERE rig_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE rig_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsRightRigQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TsRightRigPeer::RIG_ID, $id, $comparison);
    }

    /**
     * Filter the query on the rig_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE rig_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE rig_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsRightRigQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TsRightRigPeer::RIG_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the rig_description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE rig_description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE rig_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsRightRigQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TsRightRigPeer::RIG_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the rig_admin column
     *
     * Example usage:
     * <code>
     * $query->filterByAdmin(true); // WHERE rig_admin = true
     * $query->filterByAdmin('yes'); // WHERE rig_admin = true
     * </code>
     *
     * @param     boolean|string $admin The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsRightRigQuery The current query, for fluid interface
     */
    public function filterByAdmin($admin = null, $comparison = null)
    {
        if (is_string($admin)) {
            $rig_admin = in_array(strtolower($admin), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TsRightRigPeer::RIG_ADMIN, $admin, $comparison);
    }

    /**
     * Filter the query on the rig_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE rig_removed = true
     * $query->filterByRemoved('yes'); // WHERE rig_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsRightRigQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $rig_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TsRightRigPeer::RIG_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TjUsrRigJur object
     *
     * @param   TjUsrRigJur|PropelObjectCollection $tjUsrRigJur  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsRightRigQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjUsrRigJur($tjUsrRigJur, $comparison = null)
    {
        if ($tjUsrRigJur instanceof TjUsrRigJur) {
            return $this
                ->addUsingAlias(TsRightRigPeer::RIG_ID, $tjUsrRigJur->getRigId(), $comparison);
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
     * @return TsRightRigQuery The current query, for fluid interface
     */
    public function joinTjUsrRigJur($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useTjUsrRigJurQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTjUsrRigJur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TjUsrRigJur', 'TjUsrRigJurQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TsRightRig $tsRightRig Object to remove from the list of results
     *
     * @return TsRightRigQuery The current query, for fluid interface
     */
    public function prune($tsRightRig = null)
    {
        if ($tsRightRig) {
            $this->addUsingAlias(TsRightRigPeer::RIG_ID, $tsRightRig->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
