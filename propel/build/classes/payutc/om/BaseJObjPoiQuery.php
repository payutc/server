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
use Payutc\Item;
use Payutc\JObjPoi;
use Payutc\JObjPoiPeer;
use Payutc\JObjPoiQuery;
use Payutc\Point;

/**
 * Base class that represents a query for the 'tj_obj_poi_jop' table.
 *
 *
 *
 * @method JObjPoiQuery orderByObjId($order = Criteria::ASC) Order by the obj_id column
 * @method JObjPoiQuery orderByJopPriority($order = Criteria::ASC) Order by the jop_priority column
 * @method JObjPoiQuery orderByPoiId($order = Criteria::ASC) Order by the poi_id column
 *
 * @method JObjPoiQuery groupByObjId() Group by the obj_id column
 * @method JObjPoiQuery groupByJopPriority() Group by the jop_priority column
 * @method JObjPoiQuery groupByPoiId() Group by the poi_id column
 *
 * @method JObjPoiQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method JObjPoiQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method JObjPoiQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method JObjPoiQuery leftJoinPoint($relationAlias = null) Adds a LEFT JOIN clause to the query using the Point relation
 * @method JObjPoiQuery rightJoinPoint($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Point relation
 * @method JObjPoiQuery innerJoinPoint($relationAlias = null) Adds a INNER JOIN clause to the query using the Point relation
 *
 * @method JObjPoiQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method JObjPoiQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method JObjPoiQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method JObjPoi findOne(PropelPDO $con = null) Return the first JObjPoi matching the query
 * @method JObjPoi findOneOrCreate(PropelPDO $con = null) Return the first JObjPoi matching the query, or a new JObjPoi object populated from the query conditions when no match is found
 *
 * @method JObjPoi findOneByObjId(int $obj_id) Return the first JObjPoi filtered by the obj_id column
 * @method JObjPoi findOneByJopPriority(int $jop_priority) Return the first JObjPoi filtered by the jop_priority column
 * @method JObjPoi findOneByPoiId(int $poi_id) Return the first JObjPoi filtered by the poi_id column
 *
 * @method array findByObjId(int $obj_id) Return JObjPoi objects filtered by the obj_id column
 * @method array findByJopPriority(int $jop_priority) Return JObjPoi objects filtered by the jop_priority column
 * @method array findByPoiId(int $poi_id) Return JObjPoi objects filtered by the poi_id column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseJObjPoiQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseJObjPoiQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\JObjPoi', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new JObjPoiQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     JObjPoiQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return JObjPoiQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof JObjPoiQuery) {
            return $criteria;
        }
        $query = new JObjPoiQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$obj_id, $poi_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   JObjPoi|JObjPoi[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JObjPoiPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(JObjPoiPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   JObjPoi A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `OBJ_ID`, `JOP_PRIORITY`, `POI_ID` FROM `tj_obj_poi_jop` WHERE `OBJ_ID` = :p0 AND `POI_ID` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new JObjPoi();
            $obj->hydrate($row);
            JObjPoiPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return JObjPoi|JObjPoi[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|JObjPoi[]|mixed the list of results, formatted by the current formatter
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
     * @return JObjPoiQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(JObjPoiPeer::OBJ_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(JObjPoiPeer::POI_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return JObjPoiQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(JObjPoiPeer::OBJ_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(JObjPoiPeer::POI_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return JObjPoiQuery The current query, for fluid interface
     */
    public function filterByObjId($objId = null, $comparison = null)
    {
        if (is_array($objId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(JObjPoiPeer::OBJ_ID, $objId, $comparison);
    }

    /**
     * Filter the query on the jop_priority column
     *
     * Example usage:
     * <code>
     * $query->filterByJopPriority(1234); // WHERE jop_priority = 1234
     * $query->filterByJopPriority(array(12, 34)); // WHERE jop_priority IN (12, 34)
     * $query->filterByJopPriority(array('min' => 12)); // WHERE jop_priority > 12
     * </code>
     *
     * @param     mixed $jopPriority The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JObjPoiQuery The current query, for fluid interface
     */
    public function filterByJopPriority($jopPriority = null, $comparison = null)
    {
        if (is_array($jopPriority)) {
            $useMinMax = false;
            if (isset($jopPriority['min'])) {
                $this->addUsingAlias(JObjPoiPeer::JOP_PRIORITY, $jopPriority['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($jopPriority['max'])) {
                $this->addUsingAlias(JObjPoiPeer::JOP_PRIORITY, $jopPriority['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JObjPoiPeer::JOP_PRIORITY, $jopPriority, $comparison);
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
     * @return JObjPoiQuery The current query, for fluid interface
     */
    public function filterByPoiId($poiId = null, $comparison = null)
    {
        if (is_array($poiId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(JObjPoiPeer::POI_ID, $poiId, $comparison);
    }

    /**
     * Filter the query by a related Point object
     *
     * @param   Point|PropelObjectCollection $point The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JObjPoiQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPoint($point, $comparison = null)
    {
        if ($point instanceof Point) {
            return $this
                ->addUsingAlias(JObjPoiPeer::POI_ID, $point->getId(), $comparison);
        } elseif ($point instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JObjPoiPeer::POI_ID, $point->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return JObjPoiQuery The current query, for fluid interface
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
     * Filter the query by a related Item object
     *
     * @param   Item|PropelObjectCollection $item The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JObjPoiQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByItem($item, $comparison = null)
    {
        if ($item instanceof Item) {
            return $this
                ->addUsingAlias(JObjPoiPeer::OBJ_ID, $item->getId(), $comparison);
        } elseif ($item instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JObjPoiPeer::OBJ_ID, $item->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return JObjPoiQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   JObjPoi $jObjPoi Object to remove from the list of results
     *
     * @return JObjPoiQuery The current query, for fluid interface
     */
    public function prune($jObjPoi = null)
    {
        if ($jObjPoi) {
            $this->addCond('pruneCond0', $this->getAliasedColName(JObjPoiPeer::OBJ_ID), $jObjPoi->getObjId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(JObjPoiPeer::POI_ID), $jObjPoi->getPoiId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
