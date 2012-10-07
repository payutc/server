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
use Payutc\JUsrGrp;
use Payutc\JUsrGrpPeer;
use Payutc\JUsrGrpQuery;
use Payutc\Period;
use Payutc\User;

/**
 * Base class that represents a query for the 'tj_usr_grp_jug' table.
 *
 *
 *
 * @method JUsrGrpQuery orderById($order = Criteria::ASC) Order by the jug_id column
 * @method JUsrGrpQuery orderByUsrId($order = Criteria::ASC) Order by the usr_id column
 * @method JUsrGrpQuery orderByGrpId($order = Criteria::ASC) Order by the grp_id column
 * @method JUsrGrpQuery orderByPerId($order = Criteria::ASC) Order by the per_id column
 * @method JUsrGrpQuery orderByRemoved($order = Criteria::ASC) Order by the jug_removed column
 *
 * @method JUsrGrpQuery groupById() Group by the jug_id column
 * @method JUsrGrpQuery groupByUsrId() Group by the usr_id column
 * @method JUsrGrpQuery groupByGrpId() Group by the grp_id column
 * @method JUsrGrpQuery groupByPerId() Group by the per_id column
 * @method JUsrGrpQuery groupByRemoved() Group by the jug_removed column
 *
 * @method JUsrGrpQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method JUsrGrpQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method JUsrGrpQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method JUsrGrpQuery leftJoinPeriod($relationAlias = null) Adds a LEFT JOIN clause to the query using the Period relation
 * @method JUsrGrpQuery rightJoinPeriod($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Period relation
 * @method JUsrGrpQuery innerJoinPeriod($relationAlias = null) Adds a INNER JOIN clause to the query using the Period relation
 *
 * @method JUsrGrpQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method JUsrGrpQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method JUsrGrpQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method JUsrGrpQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method JUsrGrpQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method JUsrGrpQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method JUsrGrp findOne(PropelPDO $con = null) Return the first JUsrGrp matching the query
 * @method JUsrGrp findOneOrCreate(PropelPDO $con = null) Return the first JUsrGrp matching the query, or a new JUsrGrp object populated from the query conditions when no match is found
 *
 * @method JUsrGrp findOneById(int $jug_id) Return the first JUsrGrp filtered by the jug_id column
 * @method JUsrGrp findOneByUsrId(int $usr_id) Return the first JUsrGrp filtered by the usr_id column
 * @method JUsrGrp findOneByGrpId(int $grp_id) Return the first JUsrGrp filtered by the grp_id column
 * @method JUsrGrp findOneByPerId(int $per_id) Return the first JUsrGrp filtered by the per_id column
 * @method JUsrGrp findOneByRemoved(int $jug_removed) Return the first JUsrGrp filtered by the jug_removed column
 *
 * @method array findById(int $jug_id) Return JUsrGrp objects filtered by the jug_id column
 * @method array findByUsrId(int $usr_id) Return JUsrGrp objects filtered by the usr_id column
 * @method array findByGrpId(int $grp_id) Return JUsrGrp objects filtered by the grp_id column
 * @method array findByPerId(int $per_id) Return JUsrGrp objects filtered by the per_id column
 * @method array findByRemoved(int $jug_removed) Return JUsrGrp objects filtered by the jug_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseJUsrGrpQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseJUsrGrpQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\JUsrGrp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new JUsrGrpQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     JUsrGrpQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return JUsrGrpQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof JUsrGrpQuery) {
            return $criteria;
        }
        $query = new JUsrGrpQuery();
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
                         A Primary key composition: [$usr_id, $grp_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   JUsrGrp|JUsrGrp[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JUsrGrpPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(JUsrGrpPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   JUsrGrp A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `JUG_ID`, `USR_ID`, `GRP_ID`, `PER_ID`, `JUG_REMOVED` FROM `tj_usr_grp_jug` WHERE `USR_ID` = :p0 AND `GRP_ID` = :p1';
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
            $obj = new JUsrGrp();
            $obj->hydrate($row);
            JUsrGrpPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return JUsrGrp|JUsrGrp[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|JUsrGrp[]|mixed the list of results, formatted by the current formatter
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
     * @return JUsrGrpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(JUsrGrpPeer::USR_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(JUsrGrpPeer::GRP_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return JUsrGrpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(JUsrGrpPeer::USR_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(JUsrGrpPeer::GRP_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the jug_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE jug_id = 1234
     * $query->filterById(array(12, 34)); // WHERE jug_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE jug_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JUsrGrpQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JUsrGrpPeer::JUG_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JUsrGrpPeer::JUG_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JUsrGrpPeer::JUG_ID, $id, $comparison);
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
     * @return JUsrGrpQuery The current query, for fluid interface
     */
    public function filterByUsrId($usrId = null, $comparison = null)
    {
        if (is_array($usrId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(JUsrGrpPeer::USR_ID, $usrId, $comparison);
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
     * @return JUsrGrpQuery The current query, for fluid interface
     */
    public function filterByGrpId($grpId = null, $comparison = null)
    {
        if (is_array($grpId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(JUsrGrpPeer::GRP_ID, $grpId, $comparison);
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
     * @return JUsrGrpQuery The current query, for fluid interface
     */
    public function filterByPerId($perId = null, $comparison = null)
    {
        if (is_array($perId)) {
            $useMinMax = false;
            if (isset($perId['min'])) {
                $this->addUsingAlias(JUsrGrpPeer::PER_ID, $perId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($perId['max'])) {
                $this->addUsingAlias(JUsrGrpPeer::PER_ID, $perId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JUsrGrpPeer::PER_ID, $perId, $comparison);
    }

    /**
     * Filter the query on the jug_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(1234); // WHERE jug_removed = 1234
     * $query->filterByRemoved(array(12, 34)); // WHERE jug_removed IN (12, 34)
     * $query->filterByRemoved(array('min' => 12)); // WHERE jug_removed > 12
     * </code>
     *
     * @param     mixed $removed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JUsrGrpQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_array($removed)) {
            $useMinMax = false;
            if (isset($removed['min'])) {
                $this->addUsingAlias(JUsrGrpPeer::JUG_REMOVED, $removed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($removed['max'])) {
                $this->addUsingAlias(JUsrGrpPeer::JUG_REMOVED, $removed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JUsrGrpPeer::JUG_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Period object
     *
     * @param   Period|PropelObjectCollection $period The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JUsrGrpQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPeriod($period, $comparison = null)
    {
        if ($period instanceof Period) {
            return $this
                ->addUsingAlias(JUsrGrpPeer::PER_ID, $period->getId(), $comparison);
        } elseif ($period instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JUsrGrpPeer::PER_ID, $period->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return JUsrGrpQuery The current query, for fluid interface
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
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JUsrGrpQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(JUsrGrpPeer::USR_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JUsrGrpPeer::USR_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return JUsrGrpQuery The current query, for fluid interface
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
     * Filter the query by a related Group object
     *
     * @param   Group|PropelObjectCollection $group The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JUsrGrpQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByGroup($group, $comparison = null)
    {
        if ($group instanceof Group) {
            return $this
                ->addUsingAlias(JUsrGrpPeer::GRP_ID, $group->getId(), $comparison);
        } elseif ($group instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JUsrGrpPeer::GRP_ID, $group->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return JUsrGrpQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   JUsrGrp $jUsrGrp Object to remove from the list of results
     *
     * @return JUsrGrpQuery The current query, for fluid interface
     */
    public function prune($jUsrGrp = null)
    {
        if ($jUsrGrp) {
            $this->addCond('pruneCond0', $this->getAliasedColName(JUsrGrpPeer::USR_ID), $jUsrGrp->getUsrId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(JUsrGrpPeer::GRP_ID), $jUsrGrp->getGrpId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
