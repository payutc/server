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
use Payutc\GroupPeer;
use Payutc\GroupQuery;
use Payutc\JUsrGrp;
use Payutc\Period;
use Payutc\Price;
use Payutc\User;

/**
 * Base class that represents a query for the 't_group_grp' table.
 *
 *
 *
 * @method GroupQuery orderById($order = Criteria::ASC) Order by the grp_id column
 * @method GroupQuery orderByName($order = Criteria::ASC) Order by the grp_name column
 * @method GroupQuery orderByOpen($order = Criteria::ASC) Order by the grp_open column
 * @method GroupQuery orderByPublic($order = Criteria::ASC) Order by the grp_public column
 * @method GroupQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method GroupQuery orderByRemoved($order = Criteria::ASC) Order by the grp_removed column
 *
 * @method GroupQuery groupById() Group by the grp_id column
 * @method GroupQuery groupByName() Group by the grp_name column
 * @method GroupQuery groupByOpen() Group by the grp_open column
 * @method GroupQuery groupByPublic() Group by the grp_public column
 * @method GroupQuery groupByFunId() Group by the fun_id column
 * @method GroupQuery groupByRemoved() Group by the grp_removed column
 *
 * @method GroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method GroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method GroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method GroupQuery leftJoinFundation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fundation relation
 * @method GroupQuery rightJoinFundation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fundation relation
 * @method GroupQuery innerJoinFundation($relationAlias = null) Adds a INNER JOIN clause to the query using the Fundation relation
 *
 * @method GroupQuery leftJoinPrice($relationAlias = null) Adds a LEFT JOIN clause to the query using the Price relation
 * @method GroupQuery rightJoinPrice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Price relation
 * @method GroupQuery innerJoinPrice($relationAlias = null) Adds a INNER JOIN clause to the query using the Price relation
 *
 * @method GroupQuery leftJoinJUsrGrp($relationAlias = null) Adds a LEFT JOIN clause to the query using the JUsrGrp relation
 * @method GroupQuery rightJoinJUsrGrp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JUsrGrp relation
 * @method GroupQuery innerJoinJUsrGrp($relationAlias = null) Adds a INNER JOIN clause to the query using the JUsrGrp relation
 *
 * @method Group findOne(PropelPDO $con = null) Return the first Group matching the query
 * @method Group findOneOrCreate(PropelPDO $con = null) Return the first Group matching the query, or a new Group object populated from the query conditions when no match is found
 *
 * @method Group findOneByName(string $grp_name) Return the first Group filtered by the grp_name column
 * @method Group findOneByOpen(boolean $grp_open) Return the first Group filtered by the grp_open column
 * @method Group findOneByPublic(boolean $grp_public) Return the first Group filtered by the grp_public column
 * @method Group findOneByFunId(int $fun_id) Return the first Group filtered by the fun_id column
 * @method Group findOneByRemoved(boolean $grp_removed) Return the first Group filtered by the grp_removed column
 *
 * @method array findById(int $grp_id) Return Group objects filtered by the grp_id column
 * @method array findByName(string $grp_name) Return Group objects filtered by the grp_name column
 * @method array findByOpen(boolean $grp_open) Return Group objects filtered by the grp_open column
 * @method array findByPublic(boolean $grp_public) Return Group objects filtered by the grp_public column
 * @method array findByFunId(int $fun_id) Return Group objects filtered by the fun_id column
 * @method array findByRemoved(boolean $grp_removed) Return Group objects filtered by the grp_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseGroupQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseGroupQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Group', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new GroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     GroupQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return GroupQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof GroupQuery) {
            return $criteria;
        }
        $query = new GroupQuery();
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
     * @return   Group|Group[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GroupPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(GroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Group A model object, or null if the key is not found
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
     * @return   Group A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `GRP_ID`, `GRP_NAME`, `GRP_OPEN`, `GRP_PUBLIC`, `FUN_ID`, `GRP_REMOVED` FROM `t_group_grp` WHERE `GRP_ID` = :p0';
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
            $obj = new Group();
            $obj->hydrate($row);
            GroupPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Group|Group[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Group[]|mixed the list of results, formatted by the current formatter
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
     * @return GroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GroupPeer::GRP_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return GroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GroupPeer::GRP_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the grp_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE grp_id = 1234
     * $query->filterById(array(12, 34)); // WHERE grp_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE grp_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GroupQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(GroupPeer::GRP_ID, $id, $comparison);
    }

    /**
     * Filter the query on the grp_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE grp_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE grp_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GroupQuery The current query, for fluid interface
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

        return $this->addUsingAlias(GroupPeer::GRP_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the grp_open column
     *
     * Example usage:
     * <code>
     * $query->filterByOpen(true); // WHERE grp_open = true
     * $query->filterByOpen('yes'); // WHERE grp_open = true
     * </code>
     *
     * @param     boolean|string $open The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GroupQuery The current query, for fluid interface
     */
    public function filterByOpen($open = null, $comparison = null)
    {
        if (is_string($open)) {
            $grp_open = in_array(strtolower($open), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(GroupPeer::GRP_OPEN, $open, $comparison);
    }

    /**
     * Filter the query on the grp_public column
     *
     * Example usage:
     * <code>
     * $query->filterByPublic(true); // WHERE grp_public = true
     * $query->filterByPublic('yes'); // WHERE grp_public = true
     * </code>
     *
     * @param     boolean|string $public The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GroupQuery The current query, for fluid interface
     */
    public function filterByPublic($public = null, $comparison = null)
    {
        if (is_string($public)) {
            $grp_public = in_array(strtolower($public), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(GroupPeer::GRP_PUBLIC, $public, $comparison);
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
     * @return GroupQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(GroupPeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(GroupPeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GroupPeer::FUN_ID, $funId, $comparison);
    }

    /**
     * Filter the query on the grp_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE grp_removed = true
     * $query->filterByRemoved('yes'); // WHERE grp_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GroupQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $grp_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(GroupPeer::GRP_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Fundation object
     *
     * @param   Fundation|PropelObjectCollection $fundation The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   GroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFundation($fundation, $comparison = null)
    {
        if ($fundation instanceof Fundation) {
            return $this
                ->addUsingAlias(GroupPeer::FUN_ID, $fundation->getId(), $comparison);
        } elseif ($fundation instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GroupPeer::FUN_ID, $fundation->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return GroupQuery The current query, for fluid interface
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
     * @return   GroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPrice($price, $comparison = null)
    {
        if ($price instanceof Price) {
            return $this
                ->addUsingAlias(GroupPeer::GRP_ID, $price->getGrpId(), $comparison);
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
     * @return GroupQuery The current query, for fluid interface
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
     * Filter the query by a related JUsrGrp object
     *
     * @param   JUsrGrp|PropelObjectCollection $jUsrGrp  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   GroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJUsrGrp($jUsrGrp, $comparison = null)
    {
        if ($jUsrGrp instanceof JUsrGrp) {
            return $this
                ->addUsingAlias(GroupPeer::GRP_ID, $jUsrGrp->getGrpId(), $comparison);
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
     * @return GroupQuery The current query, for fluid interface
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
     * Filter the query by a related Period object
     * using the tj_usr_grp_jug table as cross reference
     *
     * @param   Period $period the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   GroupQuery The current query, for fluid interface
     */
    public function filterByPeriod($period, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrGrpQuery()
            ->filterByPeriod($period, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related User object
     * using the tj_usr_grp_jug table as cross reference
     *
     * @param   User $user the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   GroupQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrGrpQuery()
            ->filterByUser($user, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Group $group Object to remove from the list of results
     *
     * @return GroupQuery The current query, for fluid interface
     */
    public function prune($group = null)
    {
        if ($group) {
            $this->addUsingAlias(GroupPeer::GRP_ID, $group->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
