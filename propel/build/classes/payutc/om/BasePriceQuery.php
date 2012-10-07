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
use Payutc\Group;
use Payutc\Item;
use Payutc\Period;
use Payutc\Price;
use Payutc\PricePeer;
use Payutc\PriceQuery;

/**
 * Base class that represents a query for the 't_price_pri' table.
 *
 *
 *
 * @method PriceQuery orderById($order = Criteria::ASC) Order by the pri_id column
 * @method PriceQuery orderByObjId($order = Criteria::ASC) Order by the obj_id column
 * @method PriceQuery orderByGrpId($order = Criteria::ASC) Order by the grp_id column
 * @method PriceQuery orderByPerId($order = Criteria::ASC) Order by the per_id column
 * @method PriceQuery orderByCredit($order = Criteria::ASC) Order by the pri_credit column
 * @method PriceQuery orderByRemoved($order = Criteria::ASC) Order by the pri_removed column
 *
 * @method PriceQuery groupById() Group by the pri_id column
 * @method PriceQuery groupByObjId() Group by the obj_id column
 * @method PriceQuery groupByGrpId() Group by the grp_id column
 * @method PriceQuery groupByPerId() Group by the per_id column
 * @method PriceQuery groupByCredit() Group by the pri_credit column
 * @method PriceQuery groupByRemoved() Group by the pri_removed column
 *
 * @method PriceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PriceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PriceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PriceQuery leftJoinPeriod($relationAlias = null) Adds a LEFT JOIN clause to the query using the Period relation
 * @method PriceQuery rightJoinPeriod($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Period relation
 * @method PriceQuery innerJoinPeriod($relationAlias = null) Adds a INNER JOIN clause to the query using the Period relation
 *
 * @method PriceQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method PriceQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method PriceQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method PriceQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method PriceQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method PriceQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method Price findOne(PropelPDO $con = null) Return the first Price matching the query
 * @method Price findOneOrCreate(PropelPDO $con = null) Return the first Price matching the query, or a new Price object populated from the query conditions when no match is found
 *
 * @method Price findOneByObjId(int $obj_id) Return the first Price filtered by the obj_id column
 * @method Price findOneByGrpId(int $grp_id) Return the first Price filtered by the grp_id column
 * @method Price findOneByPerId(int $per_id) Return the first Price filtered by the per_id column
 * @method Price findOneByCredit(int $pri_credit) Return the first Price filtered by the pri_credit column
 * @method Price findOneByRemoved(boolean $pri_removed) Return the first Price filtered by the pri_removed column
 *
 * @method array findById(int $pri_id) Return Price objects filtered by the pri_id column
 * @method array findByObjId(int $obj_id) Return Price objects filtered by the obj_id column
 * @method array findByGrpId(int $grp_id) Return Price objects filtered by the grp_id column
 * @method array findByPerId(int $per_id) Return Price objects filtered by the per_id column
 * @method array findByCredit(int $pri_credit) Return Price objects filtered by the pri_credit column
 * @method array findByRemoved(boolean $pri_removed) Return Price objects filtered by the pri_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BasePriceQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePriceQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Price', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PriceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PriceQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PriceQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PriceQuery) {
            return $criteria;
        }
        $query = new PriceQuery();
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
     * @return   Price|Price[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PricePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PricePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Price A model object, or null if the key is not found
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
     * @return   Price A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `PRI_ID`, `OBJ_ID`, `GRP_ID`, `PER_ID`, `PRI_CREDIT`, `PRI_REMOVED` FROM `t_price_pri` WHERE `PRI_ID` = :p0';
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
            $obj = new Price();
            $obj->hydrate($row);
            PricePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Price|Price[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Price[]|mixed the list of results, formatted by the current formatter
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
     * @return PriceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PricePeer::PRI_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PriceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PricePeer::PRI_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pri_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE pri_id = 1234
     * $query->filterById(array(12, 34)); // WHERE pri_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE pri_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PriceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PricePeer::PRI_ID, $id, $comparison);
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
     * @see       filterByItem()
     *
     * @param     mixed $objId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PriceQuery The current query, for fluid interface
     */
    public function filterByObjId($objId = null, $comparison = null)
    {
        if (is_array($objId)) {
            $useMinMax = false;
            if (isset($objId['min'])) {
                $this->addUsingAlias(PricePeer::OBJ_ID, $objId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($objId['max'])) {
                $this->addUsingAlias(PricePeer::OBJ_ID, $objId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PricePeer::OBJ_ID, $objId, $comparison);
    }

    /**
     * Filter the query on the grp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGrpId(1234); // WHERE grp_id = 1234
     * $query->filterByGrpId(array(12, 34)); // WHERE grp_id IN (12, 34)
     * $query->filterByGrpId(array('min' => 12)); // WHERE grp_id > 12
     * </code>
     *
     * @see       filterByGroup()
     *
     * @param     mixed $grpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PriceQuery The current query, for fluid interface
     */
    public function filterByGrpId($grpId = null, $comparison = null)
    {
        if (is_array($grpId)) {
            $useMinMax = false;
            if (isset($grpId['min'])) {
                $this->addUsingAlias(PricePeer::GRP_ID, $grpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grpId['max'])) {
                $this->addUsingAlias(PricePeer::GRP_ID, $grpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PricePeer::GRP_ID, $grpId, $comparison);
    }

    /**
     * Filter the query on the per_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPerId(1234); // WHERE per_id = 1234
     * $query->filterByPerId(array(12, 34)); // WHERE per_id IN (12, 34)
     * $query->filterByPerId(array('min' => 12)); // WHERE per_id > 12
     * </code>
     *
     * @see       filterByPeriod()
     *
     * @param     mixed $perId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PriceQuery The current query, for fluid interface
     */
    public function filterByPerId($perId = null, $comparison = null)
    {
        if (is_array($perId)) {
            $useMinMax = false;
            if (isset($perId['min'])) {
                $this->addUsingAlias(PricePeer::PER_ID, $perId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($perId['max'])) {
                $this->addUsingAlias(PricePeer::PER_ID, $perId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PricePeer::PER_ID, $perId, $comparison);
    }

    /**
     * Filter the query on the pri_credit column
     *
     * Example usage:
     * <code>
     * $query->filterByCredit(1234); // WHERE pri_credit = 1234
     * $query->filterByCredit(array(12, 34)); // WHERE pri_credit IN (12, 34)
     * $query->filterByCredit(array('min' => 12)); // WHERE pri_credit > 12
     * </code>
     *
     * @param     mixed $credit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PriceQuery The current query, for fluid interface
     */
    public function filterByCredit($credit = null, $comparison = null)
    {
        if (is_array($credit)) {
            $useMinMax = false;
            if (isset($credit['min'])) {
                $this->addUsingAlias(PricePeer::PRI_CREDIT, $credit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($credit['max'])) {
                $this->addUsingAlias(PricePeer::PRI_CREDIT, $credit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PricePeer::PRI_CREDIT, $credit, $comparison);
    }

    /**
     * Filter the query on the pri_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE pri_removed = true
     * $query->filterByRemoved('yes'); // WHERE pri_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PriceQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $pri_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PricePeer::PRI_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Period object
     *
     * @param   Period|PropelObjectCollection $period The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PriceQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPeriod($period, $comparison = null)
    {
        if ($period instanceof Period) {
            return $this
                ->addUsingAlias(PricePeer::PER_ID, $period->getId(), $comparison);
        } elseif ($period instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PricePeer::PER_ID, $period->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPeriod() only accepts arguments of type Period or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Period relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PriceQuery The current query, for fluid interface
     */
    public function joinPeriod($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Period');

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
            $this->addJoinObject($join, 'Period');
        }

        return $this;
    }

    /**
     * Use the Period relation Period object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\PeriodQuery A secondary query class using the current class as primary query
     */
    public function usePeriodQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPeriod($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Period', '\Payutc\PeriodQuery');
    }

    /**
     * Filter the query by a related Item object
     *
     * @param   Item|PropelObjectCollection $item The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PriceQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByItem($item, $comparison = null)
    {
        if ($item instanceof Item) {
            return $this
                ->addUsingAlias(PricePeer::OBJ_ID, $item->getId(), $comparison);
        } elseif ($item instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PricePeer::OBJ_ID, $item->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByItem() only accepts arguments of type Item or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Item relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PriceQuery The current query, for fluid interface
     */
    public function joinItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Item');

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
            $this->addJoinObject($join, 'Item');
        }

        return $this;
    }

    /**
     * Use the Item relation Item object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\ItemQuery A secondary query class using the current class as primary query
     */
    public function useItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Item', '\Payutc\ItemQuery');
    }

    /**
     * Filter the query by a related Group object
     *
     * @param   Group|PropelObjectCollection $group The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PriceQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByGroup($group, $comparison = null)
    {
        if ($group instanceof Group) {
            return $this
                ->addUsingAlias(PricePeer::GRP_ID, $group->getId(), $comparison);
        } elseif ($group instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PricePeer::GRP_ID, $group->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGroup() only accepts arguments of type Group or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Group relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PriceQuery The current query, for fluid interface
     */
    public function joinGroup($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Group');

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
            $this->addJoinObject($join, 'Group');
        }

        return $this;
    }

    /**
     * Use the Group relation Group object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\GroupQuery A secondary query class using the current class as primary query
     */
    public function useGroupQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Group', '\Payutc\GroupQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Price $price Object to remove from the list of results
     *
     * @return PriceQuery The current query, for fluid interface
     */
    public function prune($price = null)
    {
        if ($price) {
            $this->addUsingAlias(PricePeer::PRI_ID, $price->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
