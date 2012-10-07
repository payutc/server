<?php


/**
 * Base class that represents a query for the 't_oldusr_osr' table.
 *
 *
 *
 * @method TOldusrOsrQuery orderById($order = Criteria::ASC) Order by the osr_id column
 * @method TOldusrOsrQuery orderByLogin($order = Criteria::ASC) Order by the osr_login column
 * @method TOldusrOsrQuery orderByCredit($order = Criteria::ASC) Order by the osr_credit column
 * @method TOldusrOsrQuery orderByDate($order = Criteria::ASC) Order by the osr_date column
 *
 * @method TOldusrOsrQuery groupById() Group by the osr_id column
 * @method TOldusrOsrQuery groupByLogin() Group by the osr_login column
 * @method TOldusrOsrQuery groupByCredit() Group by the osr_credit column
 * @method TOldusrOsrQuery groupByDate() Group by the osr_date column
 *
 * @method TOldusrOsrQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TOldusrOsrQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TOldusrOsrQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TOldusrOsr findOne(PropelPDO $con = null) Return the first TOldusrOsr matching the query
 * @method TOldusrOsr findOneOrCreate(PropelPDO $con = null) Return the first TOldusrOsr matching the query, or a new TOldusrOsr object populated from the query conditions when no match is found
 *
 * @method TOldusrOsr findOneByLogin(string $osr_login) Return the first TOldusrOsr filtered by the osr_login column
 * @method TOldusrOsr findOneByCredit(double $osr_credit) Return the first TOldusrOsr filtered by the osr_credit column
 * @method TOldusrOsr findOneByDate(string $osr_date) Return the first TOldusrOsr filtered by the osr_date column
 *
 * @method array findById(int $osr_id) Return TOldusrOsr objects filtered by the osr_id column
 * @method array findByLogin(string $osr_login) Return TOldusrOsr objects filtered by the osr_login column
 * @method array findByCredit(double $osr_credit) Return TOldusrOsr objects filtered by the osr_credit column
 * @method array findByDate(string $osr_date) Return TOldusrOsr objects filtered by the osr_date column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTOldusrOsrQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTOldusrOsrQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TOldusrOsr', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TOldusrOsrQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TOldusrOsrQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TOldusrOsrQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TOldusrOsrQuery) {
            return $criteria;
        }
        $query = new TOldusrOsrQuery();
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
     * @return   TOldusrOsr|TOldusrOsr[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TOldusrOsrPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TOldusrOsrPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TOldusrOsr A model object, or null if the key is not found
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
     * @return   TOldusrOsr A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `OSR_ID`, `OSR_LOGIN`, `OSR_CREDIT`, `OSR_DATE` FROM `t_oldusr_osr` WHERE `OSR_ID` = :p0';
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
            $obj = new TOldusrOsr();
            $obj->hydrate($row);
            TOldusrOsrPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TOldusrOsr|TOldusrOsr[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TOldusrOsr[]|mixed the list of results, formatted by the current formatter
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
     * @return TOldusrOsrQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TOldusrOsrPeer::OSR_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TOldusrOsrQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TOldusrOsrPeer::OSR_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the osr_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE osr_id = 1234
     * $query->filterById(array(12, 34)); // WHERE osr_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE osr_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TOldusrOsrQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TOldusrOsrPeer::OSR_ID, $id, $comparison);
    }

    /**
     * Filter the query on the osr_login column
     *
     * Example usage:
     * <code>
     * $query->filterByLogin('fooValue');   // WHERE osr_login = 'fooValue'
     * $query->filterByLogin('%fooValue%'); // WHERE osr_login LIKE '%fooValue%'
     * </code>
     *
     * @param     string $login The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TOldusrOsrQuery The current query, for fluid interface
     */
    public function filterByLogin($login = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($login)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $login)) {
                $login = str_replace('*', '%', $login);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TOldusrOsrPeer::OSR_LOGIN, $login, $comparison);
    }

    /**
     * Filter the query on the osr_credit column
     *
     * Example usage:
     * <code>
     * $query->filterByCredit(1234); // WHERE osr_credit = 1234
     * $query->filterByCredit(array(12, 34)); // WHERE osr_credit IN (12, 34)
     * $query->filterByCredit(array('min' => 12)); // WHERE osr_credit > 12
     * </code>
     *
     * @param     mixed $credit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TOldusrOsrQuery The current query, for fluid interface
     */
    public function filterByCredit($credit = null, $comparison = null)
    {
        if (is_array($credit)) {
            $useMinMax = false;
            if (isset($credit['min'])) {
                $this->addUsingAlias(TOldusrOsrPeer::OSR_CREDIT, $credit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($credit['max'])) {
                $this->addUsingAlias(TOldusrOsrPeer::OSR_CREDIT, $credit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TOldusrOsrPeer::OSR_CREDIT, $credit, $comparison);
    }

    /**
     * Filter the query on the osr_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE osr_date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE osr_date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE osr_date > '2011-03-13'
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
     * @return TOldusrOsrQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(TOldusrOsrPeer::OSR_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(TOldusrOsrPeer::OSR_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TOldusrOsrPeer::OSR_DATE, $date, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   TOldusrOsr $tOldusrOsr Object to remove from the list of results
     *
     * @return TOldusrOsrQuery The current query, for fluid interface
     */
    public function prune($tOldusrOsr = null)
    {
        if ($tOldusrOsr) {
            $this->addUsingAlias(TOldusrOsrPeer::OSR_ID, $tOldusrOsr->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
