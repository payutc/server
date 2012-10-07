<?php

namespace Payutc\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \PDO;
use \Propel;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Payutc\Error;
use Payutc\ErrorPeer;
use Payutc\ErrorQuery;

/**
 * Base class that represents a query for the 'ts_error_err' table.
 *
 *
 *
 * @method ErrorQuery orderByCode($order = Criteria::ASC) Order by the err_code column
 * @method ErrorQuery orderByName($order = Criteria::ASC) Order by the err_name column
 * @method ErrorQuery orderByDescription($order = Criteria::ASC) Order by the err_description column
 * @method ErrorQuery orderByRemoved($order = Criteria::ASC) Order by the err_removed column
 *
 * @method ErrorQuery groupByCode() Group by the err_code column
 * @method ErrorQuery groupByName() Group by the err_name column
 * @method ErrorQuery groupByDescription() Group by the err_description column
 * @method ErrorQuery groupByRemoved() Group by the err_removed column
 *
 * @method ErrorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ErrorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ErrorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Error findOne(PropelPDO $con = null) Return the first Error matching the query
 * @method Error findOneOrCreate(PropelPDO $con = null) Return the first Error matching the query, or a new Error object populated from the query conditions when no match is found
 *
 * @method Error findOneByName(string $err_name) Return the first Error filtered by the err_name column
 * @method Error findOneByDescription(string $err_description) Return the first Error filtered by the err_description column
 * @method Error findOneByRemoved(boolean $err_removed) Return the first Error filtered by the err_removed column
 *
 * @method array findByCode(int $err_code) Return Error objects filtered by the err_code column
 * @method array findByName(string $err_name) Return Error objects filtered by the err_name column
 * @method array findByDescription(string $err_description) Return Error objects filtered by the err_description column
 * @method array findByRemoved(boolean $err_removed) Return Error objects filtered by the err_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseErrorQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseErrorQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Error', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ErrorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ErrorQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ErrorQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ErrorQuery) {
            return $criteria;
        }
        $query = new ErrorQuery();
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
     * @return   Error|Error[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ErrorPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ErrorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Error A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneByCode($key, $con = null)
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
     * @return   Error A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ERR_CODE`, `ERR_NAME`, `ERR_DESCRIPTION`, `ERR_REMOVED` FROM `ts_error_err` WHERE `ERR_CODE` = :p0';
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
            $obj = new Error();
            $obj->hydrate($row);
            ErrorPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Error|Error[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Error[]|mixed the list of results, formatted by the current formatter
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
     * @return ErrorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ErrorPeer::ERR_CODE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ErrorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ErrorPeer::ERR_CODE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the err_code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode(1234); // WHERE err_code = 1234
     * $query->filterByCode(array(12, 34)); // WHERE err_code IN (12, 34)
     * $query->filterByCode(array('min' => 12)); // WHERE err_code > 12
     * </code>
     *
     * @param     mixed $code The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ErrorQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (is_array($code) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ErrorPeer::ERR_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the err_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE err_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE err_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ErrorQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ErrorPeer::ERR_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the err_description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE err_description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE err_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ErrorQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ErrorPeer::ERR_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the err_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE err_removed = true
     * $query->filterByRemoved('yes'); // WHERE err_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ErrorQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $err_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ErrorPeer::ERR_REMOVED, $removed, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Error $error Object to remove from the list of results
     *
     * @return ErrorQuery The current query, for fluid interface
     */
    public function prune($error = null)
    {
        if ($error) {
            $this->addUsingAlias(ErrorPeer::ERR_CODE, $error->getCode(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
