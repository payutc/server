<?php

namespace Payutc\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Payutc\Sherlocks;
use Payutc\SherlocksPeer;
use Payutc\SherlocksQuery;
use Payutc\User;

/**
 * Base class that represents a query for the 't_sherlocks_she' table.
 *
 *
 *
 * @method SherlocksQuery orderById($order = Criteria::ASC) Order by the she_id column
 * @method SherlocksQuery orderByUsrId($order = Criteria::ASC) Order by the usr_id column
 * @method SherlocksQuery orderByStep($order = Criteria::ASC) Order by the she_step column
 * @method SherlocksQuery orderByAmount($order = Criteria::ASC) Order by the she_amount column
 * @method SherlocksQuery orderByDate($order = Criteria::ASC) Order by the she_date column
 * @method SherlocksQuery orderByParentId($order = Criteria::ASC) Order by the she_parent_id column
 * @method SherlocksQuery orderByState($order = Criteria::ASC) Order by the she_state column
 * @method SherlocksQuery orderByTrace($order = Criteria::ASC) Order by the she_trace column
 *
 * @method SherlocksQuery groupById() Group by the she_id column
 * @method SherlocksQuery groupByUsrId() Group by the usr_id column
 * @method SherlocksQuery groupByStep() Group by the she_step column
 * @method SherlocksQuery groupByAmount() Group by the she_amount column
 * @method SherlocksQuery groupByDate() Group by the she_date column
 * @method SherlocksQuery groupByParentId() Group by the she_parent_id column
 * @method SherlocksQuery groupByState() Group by the she_state column
 * @method SherlocksQuery groupByTrace() Group by the she_trace column
 *
 * @method SherlocksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SherlocksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SherlocksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SherlocksQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method SherlocksQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method SherlocksQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method Sherlocks findOne(PropelPDO $con = null) Return the first Sherlocks matching the query
 * @method Sherlocks findOneOrCreate(PropelPDO $con = null) Return the first Sherlocks matching the query, or a new Sherlocks object populated from the query conditions when no match is found
 *
 * @method Sherlocks findOneByUsrId(int $usr_id) Return the first Sherlocks filtered by the usr_id column
 * @method Sherlocks findOneByStep(boolean $she_step) Return the first Sherlocks filtered by the she_step column
 * @method Sherlocks findOneByAmount(int $she_amount) Return the first Sherlocks filtered by the she_amount column
 * @method Sherlocks findOneByDate(string $she_date) Return the first Sherlocks filtered by the she_date column
 * @method Sherlocks findOneByParentId(int $she_parent_id) Return the first Sherlocks filtered by the she_parent_id column
 * @method Sherlocks findOneByState(int $she_state) Return the first Sherlocks filtered by the she_state column
 * @method Sherlocks findOneByTrace(string $she_trace) Return the first Sherlocks filtered by the she_trace column
 *
 * @method array findById(int $she_id) Return Sherlocks objects filtered by the she_id column
 * @method array findByUsrId(int $usr_id) Return Sherlocks objects filtered by the usr_id column
 * @method array findByStep(boolean $she_step) Return Sherlocks objects filtered by the she_step column
 * @method array findByAmount(int $she_amount) Return Sherlocks objects filtered by the she_amount column
 * @method array findByDate(string $she_date) Return Sherlocks objects filtered by the she_date column
 * @method array findByParentId(int $she_parent_id) Return Sherlocks objects filtered by the she_parent_id column
 * @method array findByState(int $she_state) Return Sherlocks objects filtered by the she_state column
 * @method array findByTrace(string $she_trace) Return Sherlocks objects filtered by the she_trace column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseSherlocksQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSherlocksQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Sherlocks', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SherlocksQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     SherlocksQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SherlocksQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SherlocksQuery) {
            return $criteria;
        }
        $query = new SherlocksQuery();
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
     * @return   Sherlocks|Sherlocks[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SherlocksPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SherlocksPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Sherlocks A model object, or null if the key is not found
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
     * @return   Sherlocks A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `SHE_ID`, `USR_ID`, `SHE_STEP`, `SHE_AMOUNT`, `SHE_DATE`, `SHE_PARENT_ID`, `SHE_STATE`, `SHE_TRACE` FROM `t_sherlocks_she` WHERE `SHE_ID` = :p0';
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
            $obj = new Sherlocks();
            $obj->hydrate($row);
            SherlocksPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Sherlocks|Sherlocks[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Sherlocks[]|mixed the list of results, formatted by the current formatter
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
     * @return SherlocksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SherlocksPeer::SHE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SherlocksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SherlocksPeer::SHE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the she_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE she_id = 1234
     * $query->filterById(array(12, 34)); // WHERE she_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE she_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SherlocksQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(SherlocksPeer::SHE_ID, $id, $comparison);
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
     * @see       filterByUser()
     *
     * @param     mixed $usrId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SherlocksQuery The current query, for fluid interface
     */
    public function filterByUsrId($usrId = null, $comparison = null)
    {
        if (is_array($usrId)) {
            $useMinMax = false;
            if (isset($usrId['min'])) {
                $this->addUsingAlias(SherlocksPeer::USR_ID, $usrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrId['max'])) {
                $this->addUsingAlias(SherlocksPeer::USR_ID, $usrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SherlocksPeer::USR_ID, $usrId, $comparison);
    }

    /**
     * Filter the query on the she_step column
     *
     * Example usage:
     * <code>
     * $query->filterByStep(true); // WHERE she_step = true
     * $query->filterByStep('yes'); // WHERE she_step = true
     * </code>
     *
     * @param     boolean|string $step The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SherlocksQuery The current query, for fluid interface
     */
    public function filterByStep($step = null, $comparison = null)
    {
        if (is_string($step)) {
            $she_step = in_array(strtolower($step), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SherlocksPeer::SHE_STEP, $step, $comparison);
    }

    /**
     * Filter the query on the she_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE she_amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE she_amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE she_amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SherlocksQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(SherlocksPeer::SHE_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(SherlocksPeer::SHE_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SherlocksPeer::SHE_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the she_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE she_date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE she_date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE she_date > '2011-03-13'
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
     * @return SherlocksQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(SherlocksPeer::SHE_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(SherlocksPeer::SHE_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SherlocksPeer::SHE_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the she_parent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByParentId(1234); // WHERE she_parent_id = 1234
     * $query->filterByParentId(array(12, 34)); // WHERE she_parent_id IN (12, 34)
     * $query->filterByParentId(array('min' => 12)); // WHERE she_parent_id > 12
     * </code>
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SherlocksQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(SherlocksPeer::SHE_PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(SherlocksPeer::SHE_PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SherlocksPeer::SHE_PARENT_ID, $parentId, $comparison);
    }

    /**
     * Filter the query on the she_state column
     *
     * Example usage:
     * <code>
     * $query->filterByState(1234); // WHERE she_state = 1234
     * $query->filterByState(array(12, 34)); // WHERE she_state IN (12, 34)
     * $query->filterByState(array('min' => 12)); // WHERE she_state > 12
     * </code>
     *
     * @param     mixed $state The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SherlocksQuery The current query, for fluid interface
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (is_array($state)) {
            $useMinMax = false;
            if (isset($state['min'])) {
                $this->addUsingAlias(SherlocksPeer::SHE_STATE, $state['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($state['max'])) {
                $this->addUsingAlias(SherlocksPeer::SHE_STATE, $state['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SherlocksPeer::SHE_STATE, $state, $comparison);
    }

    /**
     * Filter the query on the she_trace column
     *
     * Example usage:
     * <code>
     * $query->filterByTrace('fooValue');   // WHERE she_trace = 'fooValue'
     * $query->filterByTrace('%fooValue%'); // WHERE she_trace LIKE '%fooValue%'
     * </code>
     *
     * @param     string $trace The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SherlocksQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SherlocksPeer::SHE_TRACE, $trace, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SherlocksQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(SherlocksPeer::USR_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SherlocksPeer::USR_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SherlocksQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\Payutc\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Sherlocks $sherlocks Object to remove from the list of results
     *
     * @return SherlocksQuery The current query, for fluid interface
     */
    public function prune($sherlocks = null)
    {
        if ($sherlocks) {
            $this->addUsingAlias(SherlocksPeer::SHE_ID, $sherlocks->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
