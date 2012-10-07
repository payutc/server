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
use Payutc\Callback;
use Payutc\CallbackPeer;
use Payutc\CallbackQuery;
use Payutc\MeanOfLogin;

/**
 * Base class that represents a query for the 'ts_callback_cal' table.
 *
 *
 *
 * @method CallbackQuery orderById($order = Criteria::ASC) Order by the cal_id column
 * @method CallbackQuery orderByProId($order = Criteria::ASC) Order by the pro_id column
 * @method CallbackQuery orderByRequest($order = Criteria::ASC) Order by the cal_request column
 * @method CallbackQuery orderByMolId($order = Criteria::ASC) Order by the mol_id column
 * @method CallbackQuery orderByRemoved($order = Criteria::ASC) Order by the cal_removed column
 *
 * @method CallbackQuery groupById() Group by the cal_id column
 * @method CallbackQuery groupByProId() Group by the pro_id column
 * @method CallbackQuery groupByRequest() Group by the cal_request column
 * @method CallbackQuery groupByMolId() Group by the mol_id column
 * @method CallbackQuery groupByRemoved() Group by the cal_removed column
 *
 * @method CallbackQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CallbackQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CallbackQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CallbackQuery leftJoinMeanOfLogin($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeanOfLogin relation
 * @method CallbackQuery rightJoinMeanOfLogin($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeanOfLogin relation
 * @method CallbackQuery innerJoinMeanOfLogin($relationAlias = null) Adds a INNER JOIN clause to the query using the MeanOfLogin relation
 *
 * @method Callback findOne(PropelPDO $con = null) Return the first Callback matching the query
 * @method Callback findOneOrCreate(PropelPDO $con = null) Return the first Callback matching the query, or a new Callback object populated from the query conditions when no match is found
 *
 * @method Callback findOneByProId(int $pro_id) Return the first Callback filtered by the pro_id column
 * @method Callback findOneByRequest(string $cal_request) Return the first Callback filtered by the cal_request column
 * @method Callback findOneByMolId(int $mol_id) Return the first Callback filtered by the mol_id column
 * @method Callback findOneByRemoved(boolean $cal_removed) Return the first Callback filtered by the cal_removed column
 *
 * @method array findById(int $cal_id) Return Callback objects filtered by the cal_id column
 * @method array findByProId(int $pro_id) Return Callback objects filtered by the pro_id column
 * @method array findByRequest(string $cal_request) Return Callback objects filtered by the cal_request column
 * @method array findByMolId(int $mol_id) Return Callback objects filtered by the mol_id column
 * @method array findByRemoved(boolean $cal_removed) Return Callback objects filtered by the cal_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseCallbackQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCallbackQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Callback', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CallbackQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CallbackQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CallbackQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CallbackQuery) {
            return $criteria;
        }
        $query = new CallbackQuery();
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
     * @return   Callback|Callback[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CallbackPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CallbackPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Callback A model object, or null if the key is not found
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
     * @return   Callback A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `CAL_ID`, `PRO_ID`, `CAL_REQUEST`, `MOL_ID`, `CAL_REMOVED` FROM `ts_callback_cal` WHERE `CAL_ID` = :p0';
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
            $obj = new Callback();
            $obj->hydrate($row);
            CallbackPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Callback|Callback[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Callback[]|mixed the list of results, formatted by the current formatter
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
     * @return CallbackQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CallbackPeer::CAL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CallbackQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CallbackPeer::CAL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the cal_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE cal_id = 1234
     * $query->filterById(array(12, 34)); // WHERE cal_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE cal_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CallbackQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CallbackPeer::CAL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the pro_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProId(1234); // WHERE pro_id = 1234
     * $query->filterByProId(array(12, 34)); // WHERE pro_id IN (12, 34)
     * $query->filterByProId(array('min' => 12)); // WHERE pro_id > 12
     * </code>
     *
     * @param     mixed $proId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CallbackQuery The current query, for fluid interface
     */
    public function filterByProId($proId = null, $comparison = null)
    {
        if (is_array($proId)) {
            $useMinMax = false;
            if (isset($proId['min'])) {
                $this->addUsingAlias(CallbackPeer::PRO_ID, $proId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($proId['max'])) {
                $this->addUsingAlias(CallbackPeer::PRO_ID, $proId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CallbackPeer::PRO_ID, $proId, $comparison);
    }

    /**
     * Filter the query on the cal_request column
     *
     * Example usage:
     * <code>
     * $query->filterByRequest('fooValue');   // WHERE cal_request = 'fooValue'
     * $query->filterByRequest('%fooValue%'); // WHERE cal_request LIKE '%fooValue%'
     * </code>
     *
     * @param     string $request The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CallbackQuery The current query, for fluid interface
     */
    public function filterByRequest($request = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($request)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $request)) {
                $request = str_replace('*', '%', $request);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CallbackPeer::CAL_REQUEST, $request, $comparison);
    }

    /**
     * Filter the query on the mol_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMolId(1234); // WHERE mol_id = 1234
     * $query->filterByMolId(array(12, 34)); // WHERE mol_id IN (12, 34)
     * $query->filterByMolId(array('min' => 12)); // WHERE mol_id > 12
     * </code>
     *
     * @see       filterByMeanOfLogin()
     *
     * @param     mixed $molId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CallbackQuery The current query, for fluid interface
     */
    public function filterByMolId($molId = null, $comparison = null)
    {
        if (is_array($molId)) {
            $useMinMax = false;
            if (isset($molId['min'])) {
                $this->addUsingAlias(CallbackPeer::MOL_ID, $molId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($molId['max'])) {
                $this->addUsingAlias(CallbackPeer::MOL_ID, $molId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CallbackPeer::MOL_ID, $molId, $comparison);
    }

    /**
     * Filter the query on the cal_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE cal_removed = true
     * $query->filterByRemoved('yes'); // WHERE cal_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CallbackQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $cal_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CallbackPeer::CAL_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related MeanOfLogin object
     *
     * @param   MeanOfLogin|PropelObjectCollection $meanOfLogin The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CallbackQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMeanOfLogin($meanOfLogin, $comparison = null)
    {
        if ($meanOfLogin instanceof MeanOfLogin) {
            return $this
                ->addUsingAlias(CallbackPeer::MOL_ID, $meanOfLogin->getId(), $comparison);
        } elseif ($meanOfLogin instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CallbackPeer::MOL_ID, $meanOfLogin->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMeanOfLogin() only accepts arguments of type MeanOfLogin or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MeanOfLogin relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CallbackQuery The current query, for fluid interface
     */
    public function joinMeanOfLogin($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MeanOfLogin');

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
            $this->addJoinObject($join, 'MeanOfLogin');
        }

        return $this;
    }

    /**
     * Use the MeanOfLogin relation MeanOfLogin object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\MeanOfLoginQuery A secondary query class using the current class as primary query
     */
    public function useMeanOfLoginQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMeanOfLogin($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MeanOfLogin', '\Payutc\MeanOfLoginQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Callback $callback Object to remove from the list of results
     *
     * @return CallbackQuery The current query, for fluid interface
     */
    public function prune($callback = null)
    {
        if ($callback) {
            $this->addUsingAlias(CallbackPeer::CAL_ID, $callback->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
