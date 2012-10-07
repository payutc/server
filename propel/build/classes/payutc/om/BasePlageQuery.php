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
use Payutc\Fundation;
use Payutc\Plage;
use Payutc\PlagePeer;
use Payutc\PlageQuery;
use Payutc\Point;

/**
 * Base class that represents a query for the 't_plage_pla' table.
 *
 *
 *
 * @method PlageQuery orderById($order = Criteria::ASC) Order by the pla_id column
 * @method PlageQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method PlageQuery orderByPoiId($order = Criteria::ASC) Order by the poi_id column
 * @method PlageQuery orderByStart($order = Criteria::ASC) Order by the pla_start column
 * @method PlageQuery orderByEnd($order = Criteria::ASC) Order by the pla_end column
 * @method PlageQuery orderByName($order = Criteria::ASC) Order by the pla_name column
 *
 * @method PlageQuery groupById() Group by the pla_id column
 * @method PlageQuery groupByFunId() Group by the fun_id column
 * @method PlageQuery groupByPoiId() Group by the poi_id column
 * @method PlageQuery groupByStart() Group by the pla_start column
 * @method PlageQuery groupByEnd() Group by the pla_end column
 * @method PlageQuery groupByName() Group by the pla_name column
 *
 * @method PlageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PlageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PlageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PlageQuery leftJoinPoint($relationAlias = null) Adds a LEFT JOIN clause to the query using the Point relation
 * @method PlageQuery rightJoinPoint($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Point relation
 * @method PlageQuery innerJoinPoint($relationAlias = null) Adds a INNER JOIN clause to the query using the Point relation
 *
 * @method PlageQuery leftJoinFundation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fundation relation
 * @method PlageQuery rightJoinFundation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fundation relation
 * @method PlageQuery innerJoinFundation($relationAlias = null) Adds a INNER JOIN clause to the query using the Fundation relation
 *
 * @method Plage findOne(PropelPDO $con = null) Return the first Plage matching the query
 * @method Plage findOneOrCreate(PropelPDO $con = null) Return the first Plage matching the query, or a new Plage object populated from the query conditions when no match is found
 *
 * @method Plage findOneByFunId(int $fun_id) Return the first Plage filtered by the fun_id column
 * @method Plage findOneByPoiId(int $poi_id) Return the first Plage filtered by the poi_id column
 * @method Plage findOneByStart(int $pla_start) Return the first Plage filtered by the pla_start column
 * @method Plage findOneByEnd(int $pla_end) Return the first Plage filtered by the pla_end column
 * @method Plage findOneByName(string $pla_name) Return the first Plage filtered by the pla_name column
 *
 * @method array findById(int $pla_id) Return Plage objects filtered by the pla_id column
 * @method array findByFunId(int $fun_id) Return Plage objects filtered by the fun_id column
 * @method array findByPoiId(int $poi_id) Return Plage objects filtered by the poi_id column
 * @method array findByStart(int $pla_start) Return Plage objects filtered by the pla_start column
 * @method array findByEnd(int $pla_end) Return Plage objects filtered by the pla_end column
 * @method array findByName(string $pla_name) Return Plage objects filtered by the pla_name column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BasePlageQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePlageQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Plage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PlageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PlageQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PlageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PlageQuery) {
            return $criteria;
        }
        $query = new PlageQuery();
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
     * @return   Plage|Plage[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PlagePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PlagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Plage A model object, or null if the key is not found
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
     * @return   Plage A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `PLA_ID`, `FUN_ID`, `POI_ID`, `PLA_START`, `PLA_END`, `PLA_NAME` FROM `t_plage_pla` WHERE `PLA_ID` = :p0';
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
            $obj = new Plage();
            $obj->hydrate($row);
            PlagePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Plage|Plage[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Plage[]|mixed the list of results, formatted by the current formatter
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
     * @return PlageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PlagePeer::PLA_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PlageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PlagePeer::PLA_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pla_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE pla_id = 1234
     * $query->filterById(array(12, 34)); // WHERE pla_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE pla_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PlagePeer::PLA_ID, $id, $comparison);
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
     * @see       filterByFundation()
     *
     * @param     mixed $funId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlageQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(PlagePeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(PlagePeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlagePeer::FUN_ID, $funId, $comparison);
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
     * @see       filterByPoint()
     *
     * @param     mixed $poiId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlageQuery The current query, for fluid interface
     */
    public function filterByPoiId($poiId = null, $comparison = null)
    {
        if (is_array($poiId)) {
            $useMinMax = false;
            if (isset($poiId['min'])) {
                $this->addUsingAlias(PlagePeer::POI_ID, $poiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($poiId['max'])) {
                $this->addUsingAlias(PlagePeer::POI_ID, $poiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlagePeer::POI_ID, $poiId, $comparison);
    }

    /**
     * Filter the query on the pla_start column
     *
     * Example usage:
     * <code>
     * $query->filterByStart(1234); // WHERE pla_start = 1234
     * $query->filterByStart(array(12, 34)); // WHERE pla_start IN (12, 34)
     * $query->filterByStart(array('min' => 12)); // WHERE pla_start > 12
     * </code>
     *
     * @param     mixed $start The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlageQuery The current query, for fluid interface
     */
    public function filterByStart($start = null, $comparison = null)
    {
        if (is_array($start)) {
            $useMinMax = false;
            if (isset($start['min'])) {
                $this->addUsingAlias(PlagePeer::PLA_START, $start['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($start['max'])) {
                $this->addUsingAlias(PlagePeer::PLA_START, $start['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlagePeer::PLA_START, $start, $comparison);
    }

    /**
     * Filter the query on the pla_end column
     *
     * Example usage:
     * <code>
     * $query->filterByEnd(1234); // WHERE pla_end = 1234
     * $query->filterByEnd(array(12, 34)); // WHERE pla_end IN (12, 34)
     * $query->filterByEnd(array('min' => 12)); // WHERE pla_end > 12
     * </code>
     *
     * @param     mixed $end The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlageQuery The current query, for fluid interface
     */
    public function filterByEnd($end = null, $comparison = null)
    {
        if (is_array($end)) {
            $useMinMax = false;
            if (isset($end['min'])) {
                $this->addUsingAlias(PlagePeer::PLA_END, $end['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($end['max'])) {
                $this->addUsingAlias(PlagePeer::PLA_END, $end['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlagePeer::PLA_END, $end, $comparison);
    }

    /**
     * Filter the query on the pla_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE pla_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE pla_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PlagePeer::PLA_NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related Point object
     *
     * @param   Point|PropelObjectCollection $point The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PlageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPoint($point, $comparison = null)
    {
        if ($point instanceof Point) {
            return $this
                ->addUsingAlias(PlagePeer::POI_ID, $point->getId(), $comparison);
        } elseif ($point instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlagePeer::POI_ID, $point->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPoint() only accepts arguments of type Point or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Point relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PlageQuery The current query, for fluid interface
     */
    public function joinPoint($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Point');

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
            $this->addJoinObject($join, 'Point');
        }

        return $this;
    }

    /**
     * Use the Point relation Point object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\PointQuery A secondary query class using the current class as primary query
     */
    public function usePointQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPoint($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Point', '\Payutc\PointQuery');
    }

    /**
     * Filter the query by a related Fundation object
     *
     * @param   Fundation|PropelObjectCollection $fundation The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PlageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFundation($fundation, $comparison = null)
    {
        if ($fundation instanceof Fundation) {
            return $this
                ->addUsingAlias(PlagePeer::FUN_ID, $fundation->getId(), $comparison);
        } elseif ($fundation instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlagePeer::FUN_ID, $fundation->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFundation() only accepts arguments of type Fundation or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fundation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PlageQuery The current query, for fluid interface
     */
    public function joinFundation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fundation');

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
            $this->addJoinObject($join, 'Fundation');
        }

        return $this;
    }

    /**
     * Use the Fundation relation Fundation object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\FundationQuery A secondary query class using the current class as primary query
     */
    public function useFundationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFundation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fundation', '\Payutc\FundationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Plage $plage Object to remove from the list of results
     *
     * @return PlageQuery The current query, for fluid interface
     */
    public function prune($plage = null)
    {
        if ($plage) {
            $this->addUsingAlias(PlagePeer::PLA_ID, $plage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
