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
use Payutc\JUsrMol;
use Payutc\JUsrMolPeer;
use Payutc\JUsrMolQuery;
use Payutc\MeanOfLogin;
use Payutc\User;

/**
 * Base class that represents a query for the 'tj_usr_mol_jum' table.
 *
 *
 *
 * @method JUsrMolQuery orderByUsrId($order = Criteria::ASC) Order by the usr_id column
 * @method JUsrMolQuery orderByMolId($order = Criteria::ASC) Order by the mol_id column
 * @method JUsrMolQuery orderByData($order = Criteria::ASC) Order by the jum_data column
 *
 * @method JUsrMolQuery groupByUsrId() Group by the usr_id column
 * @method JUsrMolQuery groupByMolId() Group by the mol_id column
 * @method JUsrMolQuery groupByData() Group by the jum_data column
 *
 * @method JUsrMolQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method JUsrMolQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method JUsrMolQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method JUsrMolQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method JUsrMolQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method JUsrMolQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method JUsrMolQuery leftJoinMeanOfLogin($relationAlias = null) Adds a LEFT JOIN clause to the query using the MeanOfLogin relation
 * @method JUsrMolQuery rightJoinMeanOfLogin($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MeanOfLogin relation
 * @method JUsrMolQuery innerJoinMeanOfLogin($relationAlias = null) Adds a INNER JOIN clause to the query using the MeanOfLogin relation
 *
 * @method JUsrMol findOne(PropelPDO $con = null) Return the first JUsrMol matching the query
 * @method JUsrMol findOneOrCreate(PropelPDO $con = null) Return the first JUsrMol matching the query, or a new JUsrMol object populated from the query conditions when no match is found
 *
 * @method JUsrMol findOneByUsrId(int $usr_id) Return the first JUsrMol filtered by the usr_id column
 * @method JUsrMol findOneByMolId(int $mol_id) Return the first JUsrMol filtered by the mol_id column
 * @method JUsrMol findOneByData(string $jum_data) Return the first JUsrMol filtered by the jum_data column
 *
 * @method array findByUsrId(int $usr_id) Return JUsrMol objects filtered by the usr_id column
 * @method array findByMolId(int $mol_id) Return JUsrMol objects filtered by the mol_id column
 * @method array findByData(string $jum_data) Return JUsrMol objects filtered by the jum_data column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseJUsrMolQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseJUsrMolQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\JUsrMol', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new JUsrMolQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     JUsrMolQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return JUsrMolQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof JUsrMolQuery) {
            return $criteria;
        }
        $query = new JUsrMolQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$usr_id, $mol_id, $jum_data]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   JUsrMol|JUsrMol[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JUsrMolPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(JUsrMolPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   JUsrMol A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `USR_ID`, `MOL_ID`, `JUM_DATA` FROM `tj_usr_mol_jum` WHERE `USR_ID` = :p0 AND `MOL_ID` = :p1 AND `JUM_DATA` = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new JUsrMol();
            $obj->hydrate($row);
            JUsrMolPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1], (string) $key[2])));
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
     * @return JUsrMol|JUsrMol[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|JUsrMol[]|mixed the list of results, formatted by the current formatter
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
     * @return JUsrMolQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(JUsrMolPeer::USR_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(JUsrMolPeer::MOL_ID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(JUsrMolPeer::JUM_DATA, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return JUsrMolQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(JUsrMolPeer::USR_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(JUsrMolPeer::MOL_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(JUsrMolPeer::JUM_DATA, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return JUsrMolQuery The current query, for fluid interface
     */
    public function filterByUsrId($usrId = null, $comparison = null)
    {
        if (is_array($usrId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(JUsrMolPeer::USR_ID, $usrId, $comparison);
    }

    /**
     * Filter the query on the mol_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMolId(1234); // WHERE mol_id = 1234
     * $query->filterByMolId(array(12, 34)); // WHERE mol_id IN (12, 34)
     * $query->filterByMolId(array('min' => 12)); // WHERE mol_id > 12
     * </code>
     *
     * @see       filterByMeanOfLogin()
     *
     * @param     mixed $molId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JUsrMolQuery The current query, for fluid interface
     */
    public function filterByMolId($molId = null, $comparison = null)
    {
        if (is_array($molId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(JUsrMolPeer::MOL_ID, $molId, $comparison);
    }

    /**
     * Filter the query on the jum_data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('fooValue');   // WHERE jum_data = 'fooValue'
     * $query->filterByData('%fooValue%'); // WHERE jum_data LIKE '%fooValue%'
     * </code>
     *
     * @param     string $data The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JUsrMolQuery The current query, for fluid interface
     */
    public function filterByData($data = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($data)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $data)) {
                $data = str_replace('*', '%', $data);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JUsrMolPeer::JUM_DATA, $data, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JUsrMolQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(JUsrMolPeer::USR_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JUsrMolPeer::USR_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return JUsrMolQuery The current query, for fluid interface
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
     * Filter the query by a related MeanOfLogin object
     *
     * @param   MeanOfLogin|PropelObjectCollection $meanOfLogin The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   JUsrMolQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMeanOfLogin($meanOfLogin, $comparison = null)
    {
        if ($meanOfLogin instanceof MeanOfLogin) {
            return $this
                ->addUsingAlias(JUsrMolPeer::MOL_ID, $meanOfLogin->getId(), $comparison);
        } elseif ($meanOfLogin instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(JUsrMolPeer::MOL_ID, $meanOfLogin->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMeanOfLogin() only accepts arguments of type MeanOfLogin or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MeanOfLogin relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return JUsrMolQuery The current query, for fluid interface
     */
    public function joinMeanOfLogin($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MeanOfLogin');

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
            $this->addJoinObject($join, 'MeanOfLogin');
        }

        return $this;
    }

    /**
     * Use the MeanOfLogin relation MeanOfLogin object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\MeanOfLoginQuery A secondary query class using the current class as primary query
     */
    public function useMeanOfLoginQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMeanOfLogin($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MeanOfLogin', '\Payutc\MeanOfLoginQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   JUsrMol $jUsrMol Object to remove from the list of results
     *
     * @return JUsrMolQuery The current query, for fluid interface
     */
    public function prune($jUsrMol = null)
    {
        if ($jUsrMol) {
            $this->addCond('pruneCond0', $this->getAliasedColName(JUsrMolPeer::USR_ID), $jUsrMol->getUsrId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(JUsrMolPeer::MOL_ID), $jUsrMol->getMolId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(JUsrMolPeer::JUM_DATA), $jUsrMol->getData(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
