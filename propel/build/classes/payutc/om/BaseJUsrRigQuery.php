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
use Payutc\JUsrRig;
use Payutc\JUsrRigPeer;
use Payutc\JUsrRigQuery;
use Payutc\Period;
use Payutc\Point;
use Payutc\Right;
use Payutc\User;

/**
 * Base class that represents a query for the 'tj_usr_rig_jur' table.
 *
 *
 *
 * @method JUsrRigQuery orderById($order = Criteria::ASC) Order by the jur_id column
 * @method JUsrRigQuery orderByUsrId($order = Criteria::ASC) Order by the usr_id column
 * @method JUsrRigQuery orderByRigId($order = Criteria::ASC) Order by the rig_id column
 * @method JUsrRigQuery orderByPerId($order = Criteria::ASC) Order by the per_id column
 * @method JUsrRigQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method JUsrRigQuery orderByPoiId($order = Criteria::ASC) Order by the poi_id column
 * @method JUsrRigQuery orderByRemoved($order = Criteria::ASC) Order by the jur_removed column
 *
 * @method JUsrRigQuery groupById() Group by the jur_id column
 * @method JUsrRigQuery groupByUsrId() Group by the usr_id column
 * @method JUsrRigQuery groupByRigId() Group by the rig_id column
 * @method JUsrRigQuery groupByPerId() Group by the per_id column
 * @method JUsrRigQuery groupByFunId() Group by the fun_id column
 * @method JUsrRigQuery groupByPoiId() Group by the poi_id column
 * @method JUsrRigQuery groupByRemoved() Group by the jur_removed column
 *
 * @method JUsrRigQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method JUsrRigQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method JUsrRigQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method JUsrRigQuery leftJoinJurPeriod($relationAlias = null) Adds a LEFT JOIN clause to the query using the JurPeriod relation
 * @method JUsrRigQuery rightJoinJurPeriod($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JurPeriod relation
 * @method JUsrRigQuery innerJoinJurPeriod($relationAlias = null) Adds a INNER JOIN clause to the query using the JurPeriod relation
 *
 * @method JUsrRigQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method JUsrRigQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method JUsrRigQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method JUsrRigQuery leftJoinRight($relationAlias = null) Adds a LEFT JOIN clause to the query using the Right relation
 * @method JUsrRigQuery rightJoinRight($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Right relation
 * @method JUsrRigQuery innerJoinRight($relationAlias = null) Adds a INNER JOIN clause to the query using the Right relation
 *
 * @method JUsrRigQuery leftJoinFundation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fundation relation
 * @method JUsrRigQuery rightJoinFundation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fundation relation
 * @method JUsrRigQuery innerJoinFundation($relationAlias = null) Adds a INNER JOIN clause to the query using the Fundation relation
 *
 * @method JUsrRigQuery leftJoinPoint($relationAlias = null) Adds a LEFT JOIN clause to the query using the Point relation
 * @method JUsrRigQuery rightJoinPoint($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Point relation
 * @method JUsrRigQuery innerJoinPoint($relationAlias = null) Adds a INNER JOIN clause to the query using the Point relation
 *
 * @method JUsrRig findOne(PropelPDO $con = null) Return the first JUsrRig matching the query
 * @method JUsrRig findOneOrCreate(PropelPDO $con = null) Return the first JUsrRig matching the query, or a new JUsrRig object populated from the query conditions when no match is found
 *
 * @method JUsrRig findOneById(int $jur_id) Return the first JUsrRig filtered by the jur_id column
 * @method JUsrRig findOneByUsrId(int $usr_id) Return the first JUsrRig filtered by the usr_id column
 * @method JUsrRig findOneByRigId(int $rig_id) Return the first JUsrRig filtered by the rig_id column
 * @method JUsrRig findOneByPerId(int $per_id) Return the first JUsrRig filtered by the per_id column
 * @method JUsrRig findOneByFunId(int $fun_id) Return the first JUsrRig filtered by the fun_id column
 * @method JUsrRig findOneByPoiId(int $poi_id) Return the first JUsrRig filtered by the poi_id column
 * @method JUsrRig findOneByRemoved(int $jur_removed) Return the first JUsrRig filtered by the jur_removed column
 *
 * @method array findById(int $jur_id) Return JUsrRig objects filtered by the jur_id column
 * @method array findByUsrId(int $usr_id) Return JUsrRig objects filtered by the usr_id column
 * @method array findByRigId(int $rig_id) Return JUsrRig objects filtered by the rig_id column
 * @method array findByPerId(int $per_id) Return JUsrRig objects filtered by the per_id column
 * @method array findByFunId(int $fun_id) Return JUsrRig objects filtered by the fun_id column
 * @method array findByPoiId(int $poi_id) Return JUsrRig objects filtered by the poi_id column
 * @method array findByRemoved(int $jur_removed) Return JUsrRig objects filtered by the jur_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseJUsrRigQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseJUsrRigQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\JUsrRig', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new JUsrRigQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     JUsrRigQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return JUsrRigQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof JUsrRigQuery) {
            return $criteria;
        }
        $query = new JUsrRigQuery();
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
                         A Primary key composition: [$usr_id, $rig_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   JUsrRig|JUsrRig[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JUsrRigPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(JUsrRigPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   JUsrRig A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `JUR_ID`, `USR_ID`, `RIG_ID`, `PER_ID`, `FUN_ID`, `POI_ID`, `JUR_REMOVED` FROM `tj_usr_rig_jur` WHERE `USR_ID` = :p0 AND `RIG_ID` = :p1';
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
            $obj = new JUsrRig();
            $obj->hydrate($row);
            JUsrRigPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return JUsrRig|JUsrRig[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|JUsrRig[]|mixed the list of results, formatted by the current formatter
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
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(JUsrRigPeer::USR_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(JUsrRigPeer::RIG_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(JUsrRigPeer::USR_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(JUsrRigPeer::RIG_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the jur_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE jur_id = 1234
     * $query->filterById(array(12, 34)); // WHERE jur_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE jur_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JUsrRigPeer::JUR_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JUsrRigPeer::JUR_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JUsrRigPeer::JUR_ID, $id, $comparison);
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
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function filterByUsrId($usrId = null, $comparison = null)
    {
        if (is_array($usrId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(JUsrRigPeer::USR_ID, $usrId, $comparison);
    }

    /**
     * Filter the query on the rig_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRigId(1234); // WHERE rig_id = 1234
     * $query->filterByRigId(array(12, 34)); // WHERE rig_id IN (12, 34)
     * $query->filterByRigId(array('min' => 12)); // WHERE rig_id > 12
     * </code>
     *
     * @see       filterByRight()
     *
     * @param     mixed $rigId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function filterByRigId($rigId = null, $comparison = null)
    {
        if (is_array($rigId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(JUsrRigPeer::RIG_ID, $rigId, $comparison);
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
     * @see       filterByJurPeriod()
     *
     * @param     mixed $perId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function filterByPerId($perId = null, $comparison = null)
    {
        if (is_array($perId)) {
            $useMinMax = false;
            if (isset($perId['min'])) {
                $this->addUsingAlias(JUsrRigPeer::PER_ID, $perId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($perId['max'])) {
                $this->addUsingAlias(JUsrRigPeer::PER_ID, $perId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JUsrRigPeer::PER_ID, $perId, $comparison);
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
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(JUsrRigPeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(JUsrRigPeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JUsrRigPeer::FUN_ID, $funId, $comparison);
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
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function filterByPoiId($poiId = null, $comparison = null)
    {
        if (is_array($poiId)) {
            $useMinMax = false;
            if (isset($poiId['min'])) {
                $this->addUsingAlias(JUsrRigPeer::POI_ID, $poiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($poiId['max'])) {
                $this->addUsingAlias(JUsrRigPeer::POI_ID, $poiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JUsrRigPeer::POI_ID, $poiId, $comparison);
    }

    /**
     * Filter the query on the jur_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(1234); // WHERE jur_removed = 1234
     * $query->filterByRemoved(array(12, 34)); // WHERE jur_removed IN (12, 34)
     * $query->filterByRemoved(array('min' => 12)); // WHERE jur_removed > 12
     * </code>
     *
     * @param     mixed $removed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_array($removed)) {
            $useMinMax = false;
            if (isset($removed['min'])) {
                $this->addUsingAlias(JUsrRigPeer::JUR_REMOVED, $removed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($removed['max'])) {
                $this->addUsingAlias(JUsrRigPeer::JUR_REMOVED, $removed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JUsrRigPeer::JUR_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Period object
     *
     * @param   Period|PropelObjectCollection $period The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JUsrRigQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJurPeriod($period, $comparison = null)
    {
        if ($period instanceof Period) {
            return $this
                ->addUsingAlias(JUsrRigPeer::PER_ID, $period->getId(), $comparison);
        } elseif ($period instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JUsrRigPeer::PER_ID, $period->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJurPeriod() only accepts arguments of type Period or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JurPeriod relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function joinJurPeriod($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JurPeriod');

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
            $this->addJoinObject($join, 'JurPeriod');
        }

        return $this;
    }

    /**
     * Use the JurPeriod relation Period object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\PeriodQuery A secondary query class using the current class as primary query
     */
    public function useJurPeriodQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinJurPeriod($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JurPeriod', '\Payutc\PeriodQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JUsrRigQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(JUsrRigPeer::USR_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JUsrRigPeer::USR_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return JUsrRigQuery The current query, for fluid interface
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
     * Filter the query by a related Right object
     *
     * @param   Right|PropelObjectCollection $right The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JUsrRigQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByRight($right, $comparison = null)
    {
        if ($right instanceof Right) {
            return $this
                ->addUsingAlias(JUsrRigPeer::RIG_ID, $right->getId(), $comparison);
        } elseif ($right instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JUsrRigPeer::RIG_ID, $right->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRight() only accepts arguments of type Right or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Right relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function joinRight($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Right');

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
            $this->addJoinObject($join, 'Right');
        }

        return $this;
    }

    /**
     * Use the Right relation Right object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\RightQuery A secondary query class using the current class as primary query
     */
    public function useRightQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRight($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Right', '\Payutc\RightQuery');
    }

    /**
     * Filter the query by a related Fundation object
     *
     * @param   Fundation|PropelObjectCollection $fundation The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JUsrRigQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFundation($fundation, $comparison = null)
    {
        if ($fundation instanceof Fundation) {
            return $this
                ->addUsingAlias(JUsrRigPeer::FUN_ID, $fundation->getId(), $comparison);
        } elseif ($fundation instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JUsrRigPeer::FUN_ID, $fundation->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function joinFundation($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useFundationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFundation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fundation', '\Payutc\FundationQuery');
    }

    /**
     * Filter the query by a related Point object
     *
     * @param   Point|PropelObjectCollection $point The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JUsrRigQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPoint($point, $comparison = null)
    {
        if ($point instanceof Point) {
            return $this
                ->addUsingAlias(JUsrRigPeer::POI_ID, $point->getId(), $comparison);
        } elseif ($point instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JUsrRigPeer::POI_ID, $point->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function joinPoint($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function usePointQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPoint($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Point', '\Payutc\PointQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   JUsrRig $jUsrRig Object to remove from the list of results
     *
     * @return JUsrRigQuery The current query, for fluid interface
     */
    public function prune($jUsrRig = null)
    {
        if ($jUsrRig) {
            $this->addCond('pruneCond0', $this->getAliasedColName(JUsrRigPeer::USR_ID), $jUsrRig->getUsrId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(JUsrRigPeer::RIG_ID), $jUsrRig->getRigId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
