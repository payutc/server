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
use Payutc\JObjectLink;
use Payutc\JObjectLinkPeer;
use Payutc\JObjectLinkQuery;

/**
 * Base class that represents a query for the 'tj_object_link_oli' table.
 *
 *
 *
 * @method JObjectLinkQuery orderById($order = Criteria::ASC) Order by the oli_id column
 * @method JObjectLinkQuery orderByIdParent($order = Criteria::ASC) Order by the obj_id_parent column
 * @method JObjectLinkQuery orderByIdChild($order = Criteria::ASC) Order by the obj_id_child column
 * @method JObjectLinkQuery orderByStep($order = Criteria::ASC) Order by the oli_step column
 * @method JObjectLinkQuery orderByRemoved($order = Criteria::ASC) Order by the oli_removed column
 *
 * @method JObjectLinkQuery groupById() Group by the oli_id column
 * @method JObjectLinkQuery groupByIdParent() Group by the obj_id_parent column
 * @method JObjectLinkQuery groupByIdChild() Group by the obj_id_child column
 * @method JObjectLinkQuery groupByStep() Group by the oli_step column
 * @method JObjectLinkQuery groupByRemoved() Group by the oli_removed column
 *
 * @method JObjectLinkQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method JObjectLinkQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method JObjectLinkQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method JObjectLinkQuery leftJoinItemRelatedByIdChild($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemRelatedByIdChild relation
 * @method JObjectLinkQuery rightJoinItemRelatedByIdChild($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemRelatedByIdChild relation
 * @method JObjectLinkQuery innerJoinItemRelatedByIdChild($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemRelatedByIdChild relation
 *
 * @method JObjectLinkQuery leftJoinItemRelatedByIdParent($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemRelatedByIdParent relation
 * @method JObjectLinkQuery rightJoinItemRelatedByIdParent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemRelatedByIdParent relation
 * @method JObjectLinkQuery innerJoinItemRelatedByIdParent($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemRelatedByIdParent relation
 *
 * @method JObjectLink findOne(PropelPDO $con = null) Return the first JObjectLink matching the query
 * @method JObjectLink findOneOrCreate(PropelPDO $con = null) Return the first JObjectLink matching the query, or a new JObjectLink object populated from the query conditions when no match is found
 *
 * @method JObjectLink findOneById(int $oli_id) Return the first JObjectLink filtered by the oli_id column
 * @method JObjectLink findOneByIdParent(int $obj_id_parent) Return the first JObjectLink filtered by the obj_id_parent column
 * @method JObjectLink findOneByIdChild(int $obj_id_child) Return the first JObjectLink filtered by the obj_id_child column
 * @method JObjectLink findOneByStep(int $oli_step) Return the first JObjectLink filtered by the oli_step column
 * @method JObjectLink findOneByRemoved(int $oli_removed) Return the first JObjectLink filtered by the oli_removed column
 *
 * @method array findById(int $oli_id) Return JObjectLink objects filtered by the oli_id column
 * @method array findByIdParent(int $obj_id_parent) Return JObjectLink objects filtered by the obj_id_parent column
 * @method array findByIdChild(int $obj_id_child) Return JObjectLink objects filtered by the obj_id_child column
 * @method array findByStep(int $oli_step) Return JObjectLink objects filtered by the oli_step column
 * @method array findByRemoved(int $oli_removed) Return JObjectLink objects filtered by the oli_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseJObjectLinkQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseJObjectLinkQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\JObjectLink', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new JObjectLinkQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     JObjectLinkQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return JObjectLinkQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof JObjectLinkQuery) {
            return $criteria;
        }
        $query = new JObjectLinkQuery();
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
                         A Primary key composition: [$obj_id_parent, $obj_id_child]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   JObjectLink|JObjectLink[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JObjectLinkPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(JObjectLinkPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   JObjectLink A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `OLI_ID`, `OBJ_ID_PARENT`, `OBJ_ID_CHILD`, `OLI_STEP`, `OLI_REMOVED` FROM `tj_object_link_oli` WHERE `OBJ_ID_PARENT` = :p0 AND `OBJ_ID_CHILD` = :p1';
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
            $obj = new JObjectLink();
            $obj->hydrate($row);
            JObjectLinkPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return JObjectLink|JObjectLink[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|JObjectLink[]|mixed the list of results, formatted by the current formatter
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
     * @return JObjectLinkQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(JObjectLinkPeer::OBJ_ID_PARENT, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(JObjectLinkPeer::OBJ_ID_CHILD, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return JObjectLinkQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(JObjectLinkPeer::OBJ_ID_PARENT, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(JObjectLinkPeer::OBJ_ID_CHILD, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the oli_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE oli_id = 1234
     * $query->filterById(array(12, 34)); // WHERE oli_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE oli_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JObjectLinkQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JObjectLinkPeer::OLI_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JObjectLinkPeer::OLI_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JObjectLinkPeer::OLI_ID, $id, $comparison);
    }

    /**
     * Filter the query on the obj_id_parent column
     *
     * Example usage:
     * <code>
     * $query->filterByIdParent(1234); // WHERE obj_id_parent = 1234
     * $query->filterByIdParent(array(12, 34)); // WHERE obj_id_parent IN (12, 34)
     * $query->filterByIdParent(array('min' => 12)); // WHERE obj_id_parent > 12
     * </code>
     *
     * @see       filterByItemRelatedByIdParent()
     *
     * @param     mixed $idParent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JObjectLinkQuery The current query, for fluid interface
     */
    public function filterByIdParent($idParent = null, $comparison = null)
    {
        if (is_array($idParent) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(JObjectLinkPeer::OBJ_ID_PARENT, $idParent, $comparison);
    }

    /**
     * Filter the query on the obj_id_child column
     *
     * Example usage:
     * <code>
     * $query->filterByIdChild(1234); // WHERE obj_id_child = 1234
     * $query->filterByIdChild(array(12, 34)); // WHERE obj_id_child IN (12, 34)
     * $query->filterByIdChild(array('min' => 12)); // WHERE obj_id_child > 12
     * </code>
     *
     * @see       filterByItemRelatedByIdChild()
     *
     * @param     mixed $idChild The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JObjectLinkQuery The current query, for fluid interface
     */
    public function filterByIdChild($idChild = null, $comparison = null)
    {
        if (is_array($idChild) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(JObjectLinkPeer::OBJ_ID_CHILD, $idChild, $comparison);
    }

    /**
     * Filter the query on the oli_step column
     *
     * Example usage:
     * <code>
     * $query->filterByStep(1234); // WHERE oli_step = 1234
     * $query->filterByStep(array(12, 34)); // WHERE oli_step IN (12, 34)
     * $query->filterByStep(array('min' => 12)); // WHERE oli_step > 12
     * </code>
     *
     * @param     mixed $step The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JObjectLinkQuery The current query, for fluid interface
     */
    public function filterByStep($step = null, $comparison = null)
    {
        if (is_array($step)) {
            $useMinMax = false;
            if (isset($step['min'])) {
                $this->addUsingAlias(JObjectLinkPeer::OLI_STEP, $step['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($step['max'])) {
                $this->addUsingAlias(JObjectLinkPeer::OLI_STEP, $step['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JObjectLinkPeer::OLI_STEP, $step, $comparison);
    }

    /**
     * Filter the query on the oli_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(1234); // WHERE oli_removed = 1234
     * $query->filterByRemoved(array(12, 34)); // WHERE oli_removed IN (12, 34)
     * $query->filterByRemoved(array('min' => 12)); // WHERE oli_removed > 12
     * </code>
     *
     * @param     mixed $removed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JObjectLinkQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_array($removed)) {
            $useMinMax = false;
            if (isset($removed['min'])) {
                $this->addUsingAlias(JObjectLinkPeer::OLI_REMOVED, $removed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($removed['max'])) {
                $this->addUsingAlias(JObjectLinkPeer::OLI_REMOVED, $removed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JObjectLinkPeer::OLI_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Item object
     *
     * @param   Item|PropelObjectCollection $item The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JObjectLinkQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByItemRelatedByIdChild($item, $comparison = null)
    {
        if ($item instanceof Item) {
            return $this
                ->addUsingAlias(JObjectLinkPeer::OBJ_ID_CHILD, $item->getId(), $comparison);
        } elseif ($item instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JObjectLinkPeer::OBJ_ID_CHILD, $item->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByItemRelatedByIdChild() only accepts arguments of type Item or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ItemRelatedByIdChild relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return JObjectLinkQuery The current query, for fluid interface
     */
    public function joinItemRelatedByIdChild($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ItemRelatedByIdChild');

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
            $this->addJoinObject($join, 'ItemRelatedByIdChild');
        }

        return $this;
    }

    /**
     * Use the ItemRelatedByIdChild relation Item object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\ItemQuery A secondary query class using the current class as primary query
     */
    public function useItemRelatedByIdChildQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItemRelatedByIdChild($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ItemRelatedByIdChild', '\Payutc\ItemQuery');
    }

    /**
     * Filter the query by a related Item object
     *
     * @param   Item|PropelObjectCollection $item The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JObjectLinkQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByItemRelatedByIdParent($item, $comparison = null)
    {
        if ($item instanceof Item) {
            return $this
                ->addUsingAlias(JObjectLinkPeer::OBJ_ID_PARENT, $item->getId(), $comparison);
        } elseif ($item instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JObjectLinkPeer::OBJ_ID_PARENT, $item->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByItemRelatedByIdParent() only accepts arguments of type Item or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ItemRelatedByIdParent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return JObjectLinkQuery The current query, for fluid interface
     */
    public function joinItemRelatedByIdParent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ItemRelatedByIdParent');

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
            $this->addJoinObject($join, 'ItemRelatedByIdParent');
        }

        return $this;
    }

    /**
     * Use the ItemRelatedByIdParent relation Item object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\ItemQuery A secondary query class using the current class as primary query
     */
    public function useItemRelatedByIdParentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItemRelatedByIdParent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ItemRelatedByIdParent', '\Payutc\ItemQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   JObjectLink $jObjectLink Object to remove from the list of results
     *
     * @return JObjectLinkQuery The current query, for fluid interface
     */
    public function prune($jObjectLink = null)
    {
        if ($jObjectLink) {
            $this->addCond('pruneCond0', $this->getAliasedColName(JObjectLinkPeer::OBJ_ID_PARENT), $jObjectLink->getIdParent(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(JObjectLinkPeer::OBJ_ID_CHILD), $jObjectLink->getIdChild(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
