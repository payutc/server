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
use Payutc\Recharge;
use Payutc\RechargeType;
use Payutc\RechargeTypePeer;
use Payutc\RechargeTypeQuery;

/**
 * Base class that represents a query for the 't_recharge_type_rty' table.
 *
 *
 *
 * @method RechargeTypeQuery orderByRtyId($order = Criteria::ASC) Order by the rty_id column
 * @method RechargeTypeQuery orderByName($order = Criteria::ASC) Order by the rty_name column
 * @method RechargeTypeQuery orderByType($order = Criteria::ASC) Order by the rty_type column
 * @method RechargeTypeQuery orderByRemoved($order = Criteria::ASC) Order by the rty_removed column
 *
 * @method RechargeTypeQuery groupByRtyId() Group by the rty_id column
 * @method RechargeTypeQuery groupByName() Group by the rty_name column
 * @method RechargeTypeQuery groupByType() Group by the rty_type column
 * @method RechargeTypeQuery groupByRemoved() Group by the rty_removed column
 *
 * @method RechargeTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RechargeTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RechargeTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method RechargeTypeQuery leftJoinRecharge($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recharge relation
 * @method RechargeTypeQuery rightJoinRecharge($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recharge relation
 * @method RechargeTypeQuery innerJoinRecharge($relationAlias = null) Adds a INNER JOIN clause to the query using the Recharge relation
 *
 * @method RechargeType findOne(PropelPDO $con = null) Return the first RechargeType matching the query
 * @method RechargeType findOneOrCreate(PropelPDO $con = null) Return the first RechargeType matching the query, or a new RechargeType object populated from the query conditions when no match is found
 *
 * @method RechargeType findOneByName(string $rty_name) Return the first RechargeType filtered by the rty_name column
 * @method RechargeType findOneByType(string $rty_type) Return the first RechargeType filtered by the rty_type column
 * @method RechargeType findOneByRemoved(int $rty_removed) Return the first RechargeType filtered by the rty_removed column
 *
 * @method array findByRtyId(int $rty_id) Return RechargeType objects filtered by the rty_id column
 * @method array findByName(string $rty_name) Return RechargeType objects filtered by the rty_name column
 * @method array findByType(string $rty_type) Return RechargeType objects filtered by the rty_type column
 * @method array findByRemoved(int $rty_removed) Return RechargeType objects filtered by the rty_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseRechargeTypeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRechargeTypeQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\RechargeType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RechargeTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     RechargeTypeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RechargeTypeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RechargeTypeQuery) {
            return $criteria;
        }
        $query = new RechargeTypeQuery();
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
     * @return   RechargeType|RechargeType[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RechargeTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RechargeTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   RechargeType A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByRtyId($key, $con = null)
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
     * @return   RechargeType A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `RTY_ID`, `RTY_NAME`, `RTY_TYPE`, `RTY_REMOVED` FROM `t_recharge_type_rty` WHERE `RTY_ID` = :p0';
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
            $obj = new RechargeType();
            $obj->hydrate($row);
            RechargeTypePeer::addInstanceToPool($obj, (string) $key);
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
     * @return RechargeType|RechargeType[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|RechargeType[]|mixed the list of results, formatted by the current formatter
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
     * @return RechargeTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RechargeTypePeer::RTY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RechargeTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RechargeTypePeer::RTY_ID, $keys, Criteria::IN);
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
     * @param     mixed $rtyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RechargeTypeQuery The current query, for fluid interface
     */
    public function filterByRtyId($rtyId = null, $comparison = null)
    {
        if (is_array($rtyId)) {
            $useMinMax = false;
            if (isset($rtyId['min'])) {
                $this->addUsingAlias(RechargeTypePeer::RTY_ID, $rtyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rtyId['max'])) {
                $this->addUsingAlias(RechargeTypePeer::RTY_ID, $rtyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RechargeTypePeer::RTY_ID, $rtyId, $comparison);
    }

    /**
     * Filter the query on the rty_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE rty_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE rty_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RechargeTypeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RechargeTypePeer::RTY_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the rty_type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE rty_type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE rty_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RechargeTypeQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RechargeTypePeer::RTY_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the rty_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(1234); // WHERE rty_removed = 1234
     * $query->filterByRemoved(array(12, 34)); // WHERE rty_removed IN (12, 34)
     * $query->filterByRemoved(array('min' => 12)); // WHERE rty_removed > 12
     * </code>
     *
     * @param     mixed $removed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RechargeTypeQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_array($removed)) {
            $useMinMax = false;
            if (isset($removed['min'])) {
                $this->addUsingAlias(RechargeTypePeer::RTY_REMOVED, $removed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($removed['max'])) {
                $this->addUsingAlias(RechargeTypePeer::RTY_REMOVED, $removed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RechargeTypePeer::RTY_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Recharge object
     *
     * @param   Recharge|PropelObjectCollection $recharge  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   RechargeTypeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByRecharge($recharge, $comparison = null)
    {
        if ($recharge instanceof Recharge) {
            return $this
                ->addUsingAlias(RechargeTypePeer::RTY_ID, $recharge->getRtyId(), $comparison);
        } elseif ($recharge instanceof PropelObjectCollection) {
            return $this
                ->useRechargeQuery()
                ->filterByPrimaryKeys($recharge->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRecharge() only accepts arguments of type Recharge or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Recharge relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RechargeTypeQuery The current query, for fluid interface
     */
    public function joinRecharge($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Recharge');

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
            $this->addJoinObject($join, 'Recharge');
        }

        return $this;
    }

    /**
     * Use the Recharge relation Recharge object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\RechargeQuery A secondary query class using the current class as primary query
     */
    public function useRechargeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRecharge($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Recharge', '\Payutc\RechargeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   RechargeType $rechargeType Object to remove from the list of results
     *
     * @return RechargeTypeQuery The current query, for fluid interface
     */
    public function prune($rechargeType = null)
    {
        if ($rechargeType) {
            $this->addUsingAlias(RechargeTypePeer::RTY_ID, $rechargeType->getRtyId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
