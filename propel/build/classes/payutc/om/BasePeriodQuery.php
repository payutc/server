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
use Payutc\Group;
use Payutc\JUsrGrp;
use Payutc\JUsrRig;
use Payutc\Period;
use Payutc\PeriodPeer;
use Payutc\PeriodQuery;
use Payutc\Point;
use Payutc\Price;
use Payutc\Right;
use Payutc\Sale;
use Payutc\User;

/**
 * Base class that represents a query for the 't_period_per' table.
 *
 *
 *
 * @method PeriodQuery orderById($order = Criteria::ASC) Order by the per_id column
 * @method PeriodQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method PeriodQuery orderByName($order = Criteria::ASC) Order by the per_name column
 * @method PeriodQuery orderByDateStart($order = Criteria::ASC) Order by the per_date_start column
 * @method PeriodQuery orderByDateEnd($order = Criteria::ASC) Order by the per_date_end column
 * @method PeriodQuery orderByRemoved($order = Criteria::ASC) Order by the per_removed column
 *
 * @method PeriodQuery groupById() Group by the per_id column
 * @method PeriodQuery groupByFunId() Group by the fun_id column
 * @method PeriodQuery groupByName() Group by the per_name column
 * @method PeriodQuery groupByDateStart() Group by the per_date_start column
 * @method PeriodQuery groupByDateEnd() Group by the per_date_end column
 * @method PeriodQuery groupByRemoved() Group by the per_removed column
 *
 * @method PeriodQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PeriodQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PeriodQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PeriodQuery leftJoinFundation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fundation relation
 * @method PeriodQuery rightJoinFundation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fundation relation
 * @method PeriodQuery innerJoinFundation($relationAlias = null) Adds a INNER JOIN clause to the query using the Fundation relation
 *
 * @method PeriodQuery leftJoinPrice($relationAlias = null) Adds a LEFT JOIN clause to the query using the Price relation
 * @method PeriodQuery rightJoinPrice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Price relation
 * @method PeriodQuery innerJoinPrice($relationAlias = null) Adds a INNER JOIN clause to the query using the Price relation
 *
 * @method PeriodQuery leftJoinSale($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sale relation
 * @method PeriodQuery rightJoinSale($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sale relation
 * @method PeriodQuery innerJoinSale($relationAlias = null) Adds a INNER JOIN clause to the query using the Sale relation
 *
 * @method PeriodQuery leftJoinJUsrGrp($relationAlias = null) Adds a LEFT JOIN clause to the query using the JUsrGrp relation
 * @method PeriodQuery rightJoinJUsrGrp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JUsrGrp relation
 * @method PeriodQuery innerJoinJUsrGrp($relationAlias = null) Adds a INNER JOIN clause to the query using the JUsrGrp relation
 *
 * @method PeriodQuery leftJoinJUsrRig($relationAlias = null) Adds a LEFT JOIN clause to the query using the JUsrRig relation
 * @method PeriodQuery rightJoinJUsrRig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JUsrRig relation
 * @method PeriodQuery innerJoinJUsrRig($relationAlias = null) Adds a INNER JOIN clause to the query using the JUsrRig relation
 *
 * @method Period findOne(PropelPDO $con = null) Return the first Period matching the query
 * @method Period findOneOrCreate(PropelPDO $con = null) Return the first Period matching the query, or a new Period object populated from the query conditions when no match is found
 *
 * @method Period findOneByFunId(int $fun_id) Return the first Period filtered by the fun_id column
 * @method Period findOneByName(string $per_name) Return the first Period filtered by the per_name column
 * @method Period findOneByDateStart(string $per_date_start) Return the first Period filtered by the per_date_start column
 * @method Period findOneByDateEnd(string $per_date_end) Return the first Period filtered by the per_date_end column
 * @method Period findOneByRemoved(boolean $per_removed) Return the first Period filtered by the per_removed column
 *
 * @method array findById(int $per_id) Return Period objects filtered by the per_id column
 * @method array findByFunId(int $fun_id) Return Period objects filtered by the fun_id column
 * @method array findByName(string $per_name) Return Period objects filtered by the per_name column
 * @method array findByDateStart(string $per_date_start) Return Period objects filtered by the per_date_start column
 * @method array findByDateEnd(string $per_date_end) Return Period objects filtered by the per_date_end column
 * @method array findByRemoved(boolean $per_removed) Return Period objects filtered by the per_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BasePeriodQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePeriodQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Period', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PeriodQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PeriodQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PeriodQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PeriodQuery) {
            return $criteria;
        }
        $query = new PeriodQuery();
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
     * @return   Period|Period[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PeriodPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PeriodPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Period A model object, or null if the key is not found
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
     * @return   Period A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `PER_ID`, `FUN_ID`, `PER_NAME`, `PER_DATE_START`, `PER_DATE_END`, `PER_REMOVED` FROM `t_period_per` WHERE `PER_ID` = :p0';
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
            $obj = new Period();
            $obj->hydrate($row);
            PeriodPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Period|Period[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Period[]|mixed the list of results, formatted by the current formatter
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
     * @return PeriodQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PeriodPeer::PER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PeriodQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PeriodPeer::PER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the per_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE per_id = 1234
     * $query->filterById(array(12, 34)); // WHERE per_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE per_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PeriodQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PeriodPeer::PER_ID, $id, $comparison);
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
     * @return PeriodQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(PeriodPeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(PeriodPeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodPeer::FUN_ID, $funId, $comparison);
    }

    /**
     * Filter the query on the per_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE per_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE per_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PeriodQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PeriodPeer::PER_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the per_date_start column
     *
     * Example usage:
     * <code>
     * $query->filterByDateStart('2011-03-14'); // WHERE per_date_start = '2011-03-14'
     * $query->filterByDateStart('now'); // WHERE per_date_start = '2011-03-14'
     * $query->filterByDateStart(array('max' => 'yesterday')); // WHERE per_date_start > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateStart The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PeriodQuery The current query, for fluid interface
     */
    public function filterByDateStart($dateStart = null, $comparison = null)
    {
        if (is_array($dateStart)) {
            $useMinMax = false;
            if (isset($dateStart['min'])) {
                $this->addUsingAlias(PeriodPeer::PER_DATE_START, $dateStart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateStart['max'])) {
                $this->addUsingAlias(PeriodPeer::PER_DATE_START, $dateStart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodPeer::PER_DATE_START, $dateStart, $comparison);
    }

    /**
     * Filter the query on the per_date_end column
     *
     * Example usage:
     * <code>
     * $query->filterByDateEnd('2011-03-14'); // WHERE per_date_end = '2011-03-14'
     * $query->filterByDateEnd('now'); // WHERE per_date_end = '2011-03-14'
     * $query->filterByDateEnd(array('max' => 'yesterday')); // WHERE per_date_end > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateEnd The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PeriodQuery The current query, for fluid interface
     */
    public function filterByDateEnd($dateEnd = null, $comparison = null)
    {
        if (is_array($dateEnd)) {
            $useMinMax = false;
            if (isset($dateEnd['min'])) {
                $this->addUsingAlias(PeriodPeer::PER_DATE_END, $dateEnd['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateEnd['max'])) {
                $this->addUsingAlias(PeriodPeer::PER_DATE_END, $dateEnd['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodPeer::PER_DATE_END, $dateEnd, $comparison);
    }

    /**
     * Filter the query on the per_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE per_removed = true
     * $query->filterByRemoved('yes'); // WHERE per_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PeriodQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $per_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PeriodPeer::PER_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Fundation object
     *
     * @param   Fundation|PropelObjectCollection $fundation The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PeriodQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFundation($fundation, $comparison = null)
    {
        if ($fundation instanceof Fundation) {
            return $this
                ->addUsingAlias(PeriodPeer::FUN_ID, $fundation->getId(), $comparison);
        } elseif ($fundation instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PeriodPeer::FUN_ID, $fundation->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return PeriodQuery The current query, for fluid interface
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
     * Filter the query by a related Price object
     *
     * @param   Price|PropelObjectCollection $price  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PeriodQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPrice($price, $comparison = null)
    {
        if ($price instanceof Price) {
            return $this
                ->addUsingAlias(PeriodPeer::PER_ID, $price->getPerId(), $comparison);
        } elseif ($price instanceof PropelObjectCollection) {
            return $this
                ->usePriceQuery()
                ->filterByPrimaryKeys($price->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPrice() only accepts arguments of type Price or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Price relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PeriodQuery The current query, for fluid interface
     */
    public function joinPrice($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Price');

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
            $this->addJoinObject($join, 'Price');
        }

        return $this;
    }

    /**
     * Use the Price relation Price object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\PriceQuery A secondary query class using the current class as primary query
     */
    public function usePriceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPrice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Price', '\Payutc\PriceQuery');
    }

    /**
     * Filter the query by a related Sale object
     *
     * @param   Sale|PropelObjectCollection $sale  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PeriodQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySale($sale, $comparison = null)
    {
        if ($sale instanceof Sale) {
            return $this
                ->addUsingAlias(PeriodPeer::PER_ID, $sale->getPerId(), $comparison);
        } elseif ($sale instanceof PropelObjectCollection) {
            return $this
                ->useSaleQuery()
                ->filterByPrimaryKeys($sale->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySale() only accepts arguments of type Sale or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Sale relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PeriodQuery The current query, for fluid interface
     */
    public function joinSale($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Sale');

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
            $this->addJoinObject($join, 'Sale');
        }

        return $this;
    }

    /**
     * Use the Sale relation Sale object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\SaleQuery A secondary query class using the current class as primary query
     */
    public function useSaleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSale($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Sale', '\Payutc\SaleQuery');
    }

    /**
     * Filter the query by a related JUsrGrp object
     *
     * @param   JUsrGrp|PropelObjectCollection $jUsrGrp  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PeriodQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJUsrGrp($jUsrGrp, $comparison = null)
    {
        if ($jUsrGrp instanceof JUsrGrp) {
            return $this
                ->addUsingAlias(PeriodPeer::PER_ID, $jUsrGrp->getPerId(), $comparison);
        } elseif ($jUsrGrp instanceof PropelObjectCollection) {
            return $this
                ->useJUsrGrpQuery()
                ->filterByPrimaryKeys($jUsrGrp->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJUsrGrp() only accepts arguments of type JUsrGrp or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JUsrGrp relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PeriodQuery The current query, for fluid interface
     */
    public function joinJUsrGrp($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JUsrGrp');

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
            $this->addJoinObject($join, 'JUsrGrp');
        }

        return $this;
    }

    /**
     * Use the JUsrGrp relation JUsrGrp object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\JUsrGrpQuery A secondary query class using the current class as primary query
     */
    public function useJUsrGrpQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJUsrGrp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JUsrGrp', '\Payutc\JUsrGrpQuery');
    }

    /**
     * Filter the query by a related JUsrRig object
     *
     * @param   JUsrRig|PropelObjectCollection $jUsrRig  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PeriodQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJUsrRig($jUsrRig, $comparison = null)
    {
        if ($jUsrRig instanceof JUsrRig) {
            return $this
                ->addUsingAlias(PeriodPeer::PER_ID, $jUsrRig->getPerId(), $comparison);
        } elseif ($jUsrRig instanceof PropelObjectCollection) {
            return $this
                ->useJUsrRigQuery()
                ->filterByPrimaryKeys($jUsrRig->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJUsrRig() only accepts arguments of type JUsrRig or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JUsrRig relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PeriodQuery The current query, for fluid interface
     */
    public function joinJUsrRig($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JUsrRig');

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
            $this->addJoinObject($join, 'JUsrRig');
        }

        return $this;
    }

    /**
     * Use the JUsrRig relation JUsrRig object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\JUsrRigQuery A secondary query class using the current class as primary query
     */
    public function useJUsrRigQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinJUsrRig($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JUsrRig', '\Payutc\JUsrRigQuery');
    }

    /**
     * Filter the query by a related User object
     * using the tj_usr_grp_jug table as cross reference
     *
     * @param   User $user the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PeriodQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrGrpQuery()
            ->filterByUser($user, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Group object
     * using the tj_usr_grp_jug table as cross reference
     *
     * @param   Group $group the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PeriodQuery The current query, for fluid interface
     */
    public function filterByGroup($group, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrGrpQuery()
            ->filterByGroup($group, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related User object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   User $user the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PeriodQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrRigQuery()
            ->filterByUser($user, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Right object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   Right $right the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PeriodQuery The current query, for fluid interface
     */
    public function filterByRight($right, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrRigQuery()
            ->filterByRight($right, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Fundation object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   Fundation $fundation the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PeriodQuery The current query, for fluid interface
     */
    public function filterByFundation($fundation, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrRigQuery()
            ->filterByFundation($fundation, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Point object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   Point $point the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PeriodQuery The current query, for fluid interface
     */
    public function filterByPoint($point, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrRigQuery()
            ->filterByPoint($point, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Period $period Object to remove from the list of results
     *
     * @return PeriodQuery The current query, for fluid interface
     */
    public function prune($period = null)
    {
        if ($period) {
            $this->addUsingAlias(PeriodPeer::PER_ID, $period->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
