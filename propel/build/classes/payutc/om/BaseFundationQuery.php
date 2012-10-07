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
use Payutc\FundationPeer;
use Payutc\FundationQuery;
use Payutc\Group;
use Payutc\Item;
use Payutc\JUsrRig;
use Payutc\Period;
use Payutc\Plage;
use Payutc\Point;
use Payutc\Purchase;
use Payutc\Right;
use Payutc\User;

/**
 * Base class that represents a query for the 't_fundation_fun' table.
 *
 *
 *
 * @method FundationQuery orderById($order = Criteria::ASC) Order by the fun_id column
 * @method FundationQuery orderByName($order = Criteria::ASC) Order by the fun_name column
 * @method FundationQuery orderByRemoved($order = Criteria::ASC) Order by the fun_removed column
 *
 * @method FundationQuery groupById() Group by the fun_id column
 * @method FundationQuery groupByName() Group by the fun_name column
 * @method FundationQuery groupByRemoved() Group by the fun_removed column
 *
 * @method FundationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FundationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FundationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method FundationQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method FundationQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method FundationQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method FundationQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method FundationQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method FundationQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method FundationQuery leftJoinPeriod($relationAlias = null) Adds a LEFT JOIN clause to the query using the Period relation
 * @method FundationQuery rightJoinPeriod($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Period relation
 * @method FundationQuery innerJoinPeriod($relationAlias = null) Adds a INNER JOIN clause to the query using the Period relation
 *
 * @method FundationQuery leftJoinPlage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Plage relation
 * @method FundationQuery rightJoinPlage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Plage relation
 * @method FundationQuery innerJoinPlage($relationAlias = null) Adds a INNER JOIN clause to the query using the Plage relation
 *
 * @method FundationQuery leftJoinPurchase($relationAlias = null) Adds a LEFT JOIN clause to the query using the Purchase relation
 * @method FundationQuery rightJoinPurchase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Purchase relation
 * @method FundationQuery innerJoinPurchase($relationAlias = null) Adds a INNER JOIN clause to the query using the Purchase relation
 *
 * @method FundationQuery leftJoinJUsrRig($relationAlias = null) Adds a LEFT JOIN clause to the query using the JUsrRig relation
 * @method FundationQuery rightJoinJUsrRig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JUsrRig relation
 * @method FundationQuery innerJoinJUsrRig($relationAlias = null) Adds a INNER JOIN clause to the query using the JUsrRig relation
 *
 * @method Fundation findOne(PropelPDO $con = null) Return the first Fundation matching the query
 * @method Fundation findOneOrCreate(PropelPDO $con = null) Return the first Fundation matching the query, or a new Fundation object populated from the query conditions when no match is found
 *
 * @method Fundation findOneByName(string $fun_name) Return the first Fundation filtered by the fun_name column
 * @method Fundation findOneByRemoved(boolean $fun_removed) Return the first Fundation filtered by the fun_removed column
 *
 * @method array findById(int $fun_id) Return Fundation objects filtered by the fun_id column
 * @method array findByName(string $fun_name) Return Fundation objects filtered by the fun_name column
 * @method array findByRemoved(boolean $fun_removed) Return Fundation objects filtered by the fun_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseFundationQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseFundationQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Fundation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new FundationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     FundationQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return FundationQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof FundationQuery) {
            return $criteria;
        }
        $query = new FundationQuery();
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
     * @return   Fundation|Fundation[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FundationPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(FundationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Fundation A model object, or null if the key is not found
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
     * @return   Fundation A model object, or null if the key is not found
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
            $obj = new Fundation();
            $obj->hydrate($row);
            FundationPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Fundation|Fundation[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Fundation[]|mixed the list of results, formatted by the current formatter
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
     * @return FundationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FundationPeer::FUN_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return FundationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FundationPeer::FUN_ID, $keys, Criteria::IN);
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
     * @return FundationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(FundationPeer::FUN_ID, $id, $comparison);
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
     * @return FundationQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FundationPeer::FUN_NAME, $name, $comparison);
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
     * @return FundationQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $fun_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FundationPeer::FUN_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Group object
     *
     * @param   Group|PropelObjectCollection $group  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FundationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByGroup($group, $comparison = null)
    {
        if ($group instanceof Group) {
            return $this
                ->addUsingAlias(FundationPeer::FUN_ID, $group->getFunId(), $comparison);
        } elseif ($group instanceof PropelObjectCollection) {
            return $this
                ->useGroupQuery()
                ->filterByPrimaryKeys($group->getPrimaryKeys())
                ->endUse();
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
     * @return FundationQuery The current query, for fluid interface
     */
    public function joinGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Group', '\Payutc\GroupQuery');
    }

    /**
     * Filter the query by a related Item object
     *
     * @param   Item|PropelObjectCollection $item  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FundationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByItem($item, $comparison = null)
    {
        if ($item instanceof Item) {
            return $this
                ->addUsingAlias(FundationPeer::FUN_ID, $item->getFunId(), $comparison);
        } elseif ($item instanceof PropelObjectCollection) {
            return $this
                ->useItemQuery()
                ->filterByPrimaryKeys($item->getPrimaryKeys())
                ->endUse();
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
     * @return FundationQuery The current query, for fluid interface
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
     * Filter the query by a related Period object
     *
     * @param   Period|PropelObjectCollection $period  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FundationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPeriod($period, $comparison = null)
    {
        if ($period instanceof Period) {
            return $this
                ->addUsingAlias(FundationPeer::FUN_ID, $period->getFunId(), $comparison);
        } elseif ($period instanceof PropelObjectCollection) {
            return $this
                ->usePeriodQuery()
                ->filterByPrimaryKeys($period->getPrimaryKeys())
                ->endUse();
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
     * @return FundationQuery The current query, for fluid interface
     */
    public function joinPeriod($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function usePeriodQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPeriod($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Period', '\Payutc\PeriodQuery');
    }

    /**
     * Filter the query by a related Plage object
     *
     * @param   Plage|PropelObjectCollection $plage  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FundationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPlage($plage, $comparison = null)
    {
        if ($plage instanceof Plage) {
            return $this
                ->addUsingAlias(FundationPeer::FUN_ID, $plage->getFunId(), $comparison);
        } elseif ($plage instanceof PropelObjectCollection) {
            return $this
                ->usePlageQuery()
                ->filterByPrimaryKeys($plage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPlage() only accepts arguments of type Plage or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Plage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return FundationQuery The current query, for fluid interface
     */
    public function joinPlage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Plage');

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
            $this->addJoinObject($join, 'Plage');
        }

        return $this;
    }

    /**
     * Use the Plage relation Plage object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\PlageQuery A secondary query class using the current class as primary query
     */
    public function usePlageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Plage', '\Payutc\PlageQuery');
    }

    /**
     * Filter the query by a related Purchase object
     *
     * @param   Purchase|PropelObjectCollection $purchase  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FundationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPurchase($purchase, $comparison = null)
    {
        if ($purchase instanceof Purchase) {
            return $this
                ->addUsingAlias(FundationPeer::FUN_ID, $purchase->getFunId(), $comparison);
        } elseif ($purchase instanceof PropelObjectCollection) {
            return $this
                ->usePurchaseQuery()
                ->filterByPrimaryKeys($purchase->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPurchase() only accepts arguments of type Purchase or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Purchase relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return FundationQuery The current query, for fluid interface
     */
    public function joinPurchase($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Purchase');

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
            $this->addJoinObject($join, 'Purchase');
        }

        return $this;
    }

    /**
     * Use the Purchase relation Purchase object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\PurchaseQuery A secondary query class using the current class as primary query
     */
    public function usePurchaseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPurchase($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Purchase', '\Payutc\PurchaseQuery');
    }

    /**
     * Filter the query by a related JUsrRig object
     *
     * @param   JUsrRig|PropelObjectCollection $jUsrRig  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FundationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJUsrRig($jUsrRig, $comparison = null)
    {
        if ($jUsrRig instanceof JUsrRig) {
            return $this
                ->addUsingAlias(FundationPeer::FUN_ID, $jUsrRig->getFunId(), $comparison);
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
     * @return FundationQuery The current query, for fluid interface
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
     * Filter the query by a related Period object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   Period $period the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FundationQuery The current query, for fluid interface
     */
    public function filterByJurPeriod($period, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrRigQuery()
            ->filterByJurPeriod($period, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related User object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   User $user the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FundationQuery The current query, for fluid interface
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
     * @return   FundationQuery The current query, for fluid interface
     */
    public function filterByRight($right, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrRigQuery()
            ->filterByRight($right, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Point object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   Point $point the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   FundationQuery The current query, for fluid interface
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
     * @param   Fundation $fundation Object to remove from the list of results
     *
     * @return FundationQuery The current query, for fluid interface
     */
    public function prune($fundation = null)
    {
        if ($fundation) {
            $this->addUsingAlias(FundationPeer::FUN_ID, $fundation->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
