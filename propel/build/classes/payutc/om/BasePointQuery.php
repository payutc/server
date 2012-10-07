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
use Payutc\Item;
use Payutc\JObjPoi;
use Payutc\JUsrRig;
use Payutc\Period;
use Payutc\Plage;
use Payutc\Point;
use Payutc\PointPeer;
use Payutc\PointQuery;
use Payutc\Purchase;
use Payutc\Recharge;
use Payutc\Right;
use Payutc\User;

/**
 * Base class that represents a query for the 't_point_poi' table.
 *
 *
 *
 * @method PointQuery orderById($order = Criteria::ASC) Order by the poi_id column
 * @method PointQuery orderByName($order = Criteria::ASC) Order by the poi_name column
 * @method PointQuery orderByRemoved($order = Criteria::ASC) Order by the poi_removed column
 *
 * @method PointQuery groupById() Group by the poi_id column
 * @method PointQuery groupByName() Group by the poi_name column
 * @method PointQuery groupByRemoved() Group by the poi_removed column
 *
 * @method PointQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PointQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PointQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PointQuery leftJoinPlage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Plage relation
 * @method PointQuery rightJoinPlage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Plage relation
 * @method PointQuery innerJoinPlage($relationAlias = null) Adds a INNER JOIN clause to the query using the Plage relation
 *
 * @method PointQuery leftJoinPurchase($relationAlias = null) Adds a LEFT JOIN clause to the query using the Purchase relation
 * @method PointQuery rightJoinPurchase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Purchase relation
 * @method PointQuery innerJoinPurchase($relationAlias = null) Adds a INNER JOIN clause to the query using the Purchase relation
 *
 * @method PointQuery leftJoinRecharge($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recharge relation
 * @method PointQuery rightJoinRecharge($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recharge relation
 * @method PointQuery innerJoinRecharge($relationAlias = null) Adds a INNER JOIN clause to the query using the Recharge relation
 *
 * @method PointQuery leftJoinJObjPoi($relationAlias = null) Adds a LEFT JOIN clause to the query using the JObjPoi relation
 * @method PointQuery rightJoinJObjPoi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JObjPoi relation
 * @method PointQuery innerJoinJObjPoi($relationAlias = null) Adds a INNER JOIN clause to the query using the JObjPoi relation
 *
 * @method PointQuery leftJoinJUsrRig($relationAlias = null) Adds a LEFT JOIN clause to the query using the JUsrRig relation
 * @method PointQuery rightJoinJUsrRig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JUsrRig relation
 * @method PointQuery innerJoinJUsrRig($relationAlias = null) Adds a INNER JOIN clause to the query using the JUsrRig relation
 *
 * @method Point findOne(PropelPDO $con = null) Return the first Point matching the query
 * @method Point findOneOrCreate(PropelPDO $con = null) Return the first Point matching the query, or a new Point object populated from the query conditions when no match is found
 *
 * @method Point findOneByName(string $poi_name) Return the first Point filtered by the poi_name column
 * @method Point findOneByRemoved(boolean $poi_removed) Return the first Point filtered by the poi_removed column
 *
 * @method array findById(int $poi_id) Return Point objects filtered by the poi_id column
 * @method array findByName(string $poi_name) Return Point objects filtered by the poi_name column
 * @method array findByRemoved(boolean $poi_removed) Return Point objects filtered by the poi_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BasePointQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePointQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Point', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PointQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PointQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PointQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PointQuery) {
            return $criteria;
        }
        $query = new PointQuery();
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
     * @return   Point|Point[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PointPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PointPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Point A model object, or null if the key is not found
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
     * @return   Point A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `POI_ID`, `POI_NAME`, `POI_REMOVED` FROM `t_point_poi` WHERE `POI_ID` = :p0';
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
            $obj = new Point();
            $obj->hydrate($row);
            PointPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Point|Point[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Point[]|mixed the list of results, formatted by the current formatter
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
     * @return PointQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PointPeer::POI_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PointQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PointPeer::POI_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the poi_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE poi_id = 1234
     * $query->filterById(array(12, 34)); // WHERE poi_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE poi_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PointPeer::POI_ID, $id, $comparison);
    }

    /**
     * Filter the query on the poi_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE poi_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE poi_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PointPeer::POI_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the poi_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE poi_removed = true
     * $query->filterByRemoved('yes'); // WHERE poi_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $poi_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PointPeer::POI_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Plage object
     *
     * @param   Plage|PropelObjectCollection $plage  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PointQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPlage($plage, $comparison = null)
    {
        if ($plage instanceof Plage) {
            return $this
                ->addUsingAlias(PointPeer::POI_ID, $plage->getPoiId(), $comparison);
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
     * @return PointQuery The current query, for fluid interface
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
     * @return   PointQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPurchase($purchase, $comparison = null)
    {
        if ($purchase instanceof Purchase) {
            return $this
                ->addUsingAlias(PointPeer::POI_ID, $purchase->getPoiId(), $comparison);
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
     * @return PointQuery The current query, for fluid interface
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
     * Filter the query by a related Recharge object
     *
     * @param   Recharge|PropelObjectCollection $recharge  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PointQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByRecharge($recharge, $comparison = null)
    {
        if ($recharge instanceof Recharge) {
            return $this
                ->addUsingAlias(PointPeer::POI_ID, $recharge->getPoiId(), $comparison);
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
     * @return PointQuery The current query, for fluid interface
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
     * Filter the query by a related JObjPoi object
     *
     * @param   JObjPoi|PropelObjectCollection $jObjPoi  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PointQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJObjPoi($jObjPoi, $comparison = null)
    {
        if ($jObjPoi instanceof JObjPoi) {
            return $this
                ->addUsingAlias(PointPeer::POI_ID, $jObjPoi->getPoiId(), $comparison);
        } elseif ($jObjPoi instanceof PropelObjectCollection) {
            return $this
                ->useJObjPoiQuery()
                ->filterByPrimaryKeys($jObjPoi->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJObjPoi() only accepts arguments of type JObjPoi or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JObjPoi relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PointQuery The current query, for fluid interface
     */
    public function joinJObjPoi($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JObjPoi');

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
            $this->addJoinObject($join, 'JObjPoi');
        }

        return $this;
    }

    /**
     * Use the JObjPoi relation JObjPoi object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\JObjPoiQuery A secondary query class using the current class as primary query
     */
    public function useJObjPoiQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJObjPoi($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JObjPoi', '\Payutc\JObjPoiQuery');
    }

    /**
     * Filter the query by a related JUsrRig object
     *
     * @param   JUsrRig|PropelObjectCollection $jUsrRig  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PointQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJUsrRig($jUsrRig, $comparison = null)
    {
        if ($jUsrRig instanceof JUsrRig) {
            return $this
                ->addUsingAlias(PointPeer::POI_ID, $jUsrRig->getPoiId(), $comparison);
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
     * @return PointQuery The current query, for fluid interface
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
     * Filter the query by a related Item object
     * using the tj_obj_poi_jop table as cross reference
     *
     * @param   Item $item the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PointQuery The current query, for fluid interface
     */
    public function filterByItem($item, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJObjPoiQuery()
            ->filterByItem($item, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Period object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   Period $period the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PointQuery The current query, for fluid interface
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
     * @return   PointQuery The current query, for fluid interface
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
     * @return   PointQuery The current query, for fluid interface
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
     * @return   PointQuery The current query, for fluid interface
     */
    public function filterByFundation($fundation, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrRigQuery()
            ->filterByFundation($fundation, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Point $point Object to remove from the list of results
     *
     * @return PointQuery The current query, for fluid interface
     */
    public function prune($point = null)
    {
        if ($point) {
            $this->addUsingAlias(PointPeer::POI_ID, $point->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
