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
use Payutc\User;
use Payutc\Virement;
use Payutc\VirementPeer;
use Payutc\VirementQuery;

/**
 * Base class that represents a query for the 't_virement_vir' table.
 *
 *
 *
 * @method VirementQuery orderById($order = Criteria::ASC) Order by the vir_id column
 * @method VirementQuery orderByDate($order = Criteria::ASC) Order by the vir_date column
 * @method VirementQuery orderByAmount($order = Criteria::ASC) Order by the vir_amount column
 * @method VirementQuery orderByUsrIdFrom($order = Criteria::ASC) Order by the usr_id_from column
 * @method VirementQuery orderByUsrIdTo($order = Criteria::ASC) Order by the usr_id_to column
 *
 * @method VirementQuery groupById() Group by the vir_id column
 * @method VirementQuery groupByDate() Group by the vir_date column
 * @method VirementQuery groupByAmount() Group by the vir_amount column
 * @method VirementQuery groupByUsrIdFrom() Group by the usr_id_from column
 * @method VirementQuery groupByUsrIdTo() Group by the usr_id_to column
 *
 * @method VirementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method VirementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method VirementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method VirementQuery leftJoinUserRelatedByUsrIdTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUsrIdTo relation
 * @method VirementQuery rightJoinUserRelatedByUsrIdTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUsrIdTo relation
 * @method VirementQuery innerJoinUserRelatedByUsrIdTo($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUsrIdTo relation
 *
 * @method VirementQuery leftJoinUserRelatedByUsrIdFrom($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUsrIdFrom relation
 * @method VirementQuery rightJoinUserRelatedByUsrIdFrom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUsrIdFrom relation
 * @method VirementQuery innerJoinUserRelatedByUsrIdFrom($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUsrIdFrom relation
 *
 * @method Virement findOne(PropelPDO $con = null) Return the first Virement matching the query
 * @method Virement findOneOrCreate(PropelPDO $con = null) Return the first Virement matching the query, or a new Virement object populated from the query conditions when no match is found
 *
 * @method Virement findOneByDate(string $vir_date) Return the first Virement filtered by the vir_date column
 * @method Virement findOneByAmount(int $vir_amount) Return the first Virement filtered by the vir_amount column
 * @method Virement findOneByUsrIdFrom(int $usr_id_from) Return the first Virement filtered by the usr_id_from column
 * @method Virement findOneByUsrIdTo(int $usr_id_to) Return the first Virement filtered by the usr_id_to column
 *
 * @method array findById(int $vir_id) Return Virement objects filtered by the vir_id column
 * @method array findByDate(string $vir_date) Return Virement objects filtered by the vir_date column
 * @method array findByAmount(int $vir_amount) Return Virement objects filtered by the vir_amount column
 * @method array findByUsrIdFrom(int $usr_id_from) Return Virement objects filtered by the usr_id_from column
 * @method array findByUsrIdTo(int $usr_id_to) Return Virement objects filtered by the usr_id_to column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseVirementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseVirementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Virement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VirementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     VirementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return VirementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VirementQuery) {
            return $criteria;
        }
        $query = new VirementQuery();
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
     * @return   Virement|Virement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VirementPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(VirementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Virement A model object, or null if the key is not found
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
     * @return   Virement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `VIR_ID`, `VIR_DATE`, `VIR_AMOUNT`, `USR_ID_FROM`, `USR_ID_TO` FROM `t_virement_vir` WHERE `VIR_ID` = :p0';
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
            $obj = new Virement();
            $obj->hydrate($row);
            VirementPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Virement|Virement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Virement[]|mixed the list of results, formatted by the current formatter
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
     * @return VirementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VirementPeer::VIR_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return VirementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VirementPeer::VIR_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the vir_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE vir_id = 1234
     * $query->filterById(array(12, 34)); // WHERE vir_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE vir_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VirementQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(VirementPeer::VIR_ID, $id, $comparison);
    }

    /**
     * Filter the query on the vir_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE vir_date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE vir_date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE vir_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VirementQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(VirementPeer::VIR_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(VirementPeer::VIR_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VirementPeer::VIR_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the vir_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE vir_amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE vir_amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE vir_amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VirementQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(VirementPeer::VIR_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(VirementPeer::VIR_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VirementPeer::VIR_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the usr_id_from column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrIdFrom(1234); // WHERE usr_id_from = 1234
     * $query->filterByUsrIdFrom(array(12, 34)); // WHERE usr_id_from IN (12, 34)
     * $query->filterByUsrIdFrom(array('min' => 12)); // WHERE usr_id_from > 12
     * </code>
     *
     * @see       filterByUserRelatedByUsrIdFrom()
     *
     * @param     mixed $usrIdFrom The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VirementQuery The current query, for fluid interface
     */
    public function filterByUsrIdFrom($usrIdFrom = null, $comparison = null)
    {
        if (is_array($usrIdFrom)) {
            $useMinMax = false;
            if (isset($usrIdFrom['min'])) {
                $this->addUsingAlias(VirementPeer::USR_ID_FROM, $usrIdFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrIdFrom['max'])) {
                $this->addUsingAlias(VirementPeer::USR_ID_FROM, $usrIdFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VirementPeer::USR_ID_FROM, $usrIdFrom, $comparison);
    }

    /**
     * Filter the query on the usr_id_to column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrIdTo(1234); // WHERE usr_id_to = 1234
     * $query->filterByUsrIdTo(array(12, 34)); // WHERE usr_id_to IN (12, 34)
     * $query->filterByUsrIdTo(array('min' => 12)); // WHERE usr_id_to > 12
     * </code>
     *
     * @see       filterByUserRelatedByUsrIdTo()
     *
     * @param     mixed $usrIdTo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VirementQuery The current query, for fluid interface
     */
    public function filterByUsrIdTo($usrIdTo = null, $comparison = null)
    {
        if (is_array($usrIdTo)) {
            $useMinMax = false;
            if (isset($usrIdTo['min'])) {
                $this->addUsingAlias(VirementPeer::USR_ID_TO, $usrIdTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrIdTo['max'])) {
                $this->addUsingAlias(VirementPeer::USR_ID_TO, $usrIdTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VirementPeer::USR_ID_TO, $usrIdTo, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   VirementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByUsrIdTo($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(VirementPeer::USR_ID_TO, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VirementPeer::USR_ID_TO, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByUsrIdTo() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByUsrIdTo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return VirementQuery The current query, for fluid interface
     */
    public function joinUserRelatedByUsrIdTo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByUsrIdTo');

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
            $this->addJoinObject($join, 'UserRelatedByUsrIdTo');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByUsrIdTo relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByUsrIdToQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserRelatedByUsrIdTo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByUsrIdTo', '\Payutc\UserQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   VirementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByUsrIdFrom($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(VirementPeer::USR_ID_FROM, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VirementPeer::USR_ID_FROM, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByUsrIdFrom() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByUsrIdFrom relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return VirementQuery The current query, for fluid interface
     */
    public function joinUserRelatedByUsrIdFrom($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByUsrIdFrom');

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
            $this->addJoinObject($join, 'UserRelatedByUsrIdFrom');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByUsrIdFrom relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByUsrIdFromQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserRelatedByUsrIdFrom($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByUsrIdFrom', '\Payutc\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Virement $virement Object to remove from the list of results
     *
     * @return VirementQuery The current query, for fluid interface
     */
    public function prune($virement = null)
    {
        if ($virement) {
            $this->addUsingAlias(VirementPeer::VIR_ID, $virement->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
