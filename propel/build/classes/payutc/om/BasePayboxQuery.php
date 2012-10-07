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
use Payutc\Paybox;
use Payutc\PayboxPeer;
use Payutc\PayboxQuery;
use Payutc\User;

/**
 * Base class that represents a query for the 't_paybox_pay' table.
 *
 *
 *
 * @method PayboxQuery orderById($order = Criteria::ASC) Order by the pay_id column
 * @method PayboxQuery orderByUsrId($order = Criteria::ASC) Order by the usr_id column
 * @method PayboxQuery orderByStep($order = Criteria::ASC) Order by the pay_step column
 * @method PayboxQuery orderByAmount($order = Criteria::ASC) Order by the pay_amount column
 * @method PayboxQuery orderByDateCreate($order = Criteria::ASC) Order by the pay_date_create column
 * @method PayboxQuery orderByDateRetour($order = Criteria::ASC) Order by the pay_date_retour column
 * @method PayboxQuery orderByAuto($order = Criteria::ASC) Order by the pay_auto column
 * @method PayboxQuery orderByTrans($order = Criteria::ASC) Order by the pay_trans column
 * @method PayboxQuery orderByCallbackUrl($order = Criteria::ASC) Order by the pay_callback_url column
 * @method PayboxQuery orderByMobile($order = Criteria::ASC) Order by the pay_mobile column
 * @method PayboxQuery orderByError($order = Criteria::ASC) Order by the pay_error column
 *
 * @method PayboxQuery groupById() Group by the pay_id column
 * @method PayboxQuery groupByUsrId() Group by the usr_id column
 * @method PayboxQuery groupByStep() Group by the pay_step column
 * @method PayboxQuery groupByAmount() Group by the pay_amount column
 * @method PayboxQuery groupByDateCreate() Group by the pay_date_create column
 * @method PayboxQuery groupByDateRetour() Group by the pay_date_retour column
 * @method PayboxQuery groupByAuto() Group by the pay_auto column
 * @method PayboxQuery groupByTrans() Group by the pay_trans column
 * @method PayboxQuery groupByCallbackUrl() Group by the pay_callback_url column
 * @method PayboxQuery groupByMobile() Group by the pay_mobile column
 * @method PayboxQuery groupByError() Group by the pay_error column
 *
 * @method PayboxQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PayboxQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PayboxQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PayboxQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method PayboxQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method PayboxQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method Paybox findOne(PropelPDO $con = null) Return the first Paybox matching the query
 * @method Paybox findOneOrCreate(PropelPDO $con = null) Return the first Paybox matching the query, or a new Paybox object populated from the query conditions when no match is found
 *
 * @method Paybox findOneByUsrId(int $usr_id) Return the first Paybox filtered by the usr_id column
 * @method Paybox findOneByStep(string $pay_step) Return the first Paybox filtered by the pay_step column
 * @method Paybox findOneByAmount(int $pay_amount) Return the first Paybox filtered by the pay_amount column
 * @method Paybox findOneByDateCreate(string $pay_date_create) Return the first Paybox filtered by the pay_date_create column
 * @method Paybox findOneByDateRetour(string $pay_date_retour) Return the first Paybox filtered by the pay_date_retour column
 * @method Paybox findOneByAuto(string $pay_auto) Return the first Paybox filtered by the pay_auto column
 * @method Paybox findOneByTrans(string $pay_trans) Return the first Paybox filtered by the pay_trans column
 * @method Paybox findOneByCallbackUrl(string $pay_callback_url) Return the first Paybox filtered by the pay_callback_url column
 * @method Paybox findOneByMobile(boolean $pay_mobile) Return the first Paybox filtered by the pay_mobile column
 * @method Paybox findOneByError(string $pay_error) Return the first Paybox filtered by the pay_error column
 *
 * @method array findById(int $pay_id) Return Paybox objects filtered by the pay_id column
 * @method array findByUsrId(int $usr_id) Return Paybox objects filtered by the usr_id column
 * @method array findByStep(string $pay_step) Return Paybox objects filtered by the pay_step column
 * @method array findByAmount(int $pay_amount) Return Paybox objects filtered by the pay_amount column
 * @method array findByDateCreate(string $pay_date_create) Return Paybox objects filtered by the pay_date_create column
 * @method array findByDateRetour(string $pay_date_retour) Return Paybox objects filtered by the pay_date_retour column
 * @method array findByAuto(string $pay_auto) Return Paybox objects filtered by the pay_auto column
 * @method array findByTrans(string $pay_trans) Return Paybox objects filtered by the pay_trans column
 * @method array findByCallbackUrl(string $pay_callback_url) Return Paybox objects filtered by the pay_callback_url column
 * @method array findByMobile(boolean $pay_mobile) Return Paybox objects filtered by the pay_mobile column
 * @method array findByError(string $pay_error) Return Paybox objects filtered by the pay_error column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BasePayboxQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePayboxQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Paybox', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PayboxQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PayboxQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PayboxQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PayboxQuery) {
            return $criteria;
        }
        $query = new PayboxQuery();
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
     * @return   Paybox|Paybox[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PayboxPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PayboxPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Paybox A model object, or null if the key is not found
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
     * @return   Paybox A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `PAY_ID`, `USR_ID`, `PAY_STEP`, `PAY_AMOUNT`, `PAY_DATE_CREATE`, `PAY_DATE_RETOUR`, `PAY_AUTO`, `PAY_TRANS`, `PAY_CALLBACK_URL`, `PAY_MOBILE`, `PAY_ERROR` FROM `t_paybox_pay` WHERE `PAY_ID` = :p0';
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
            $obj = new Paybox();
            $obj->hydrate($row);
            PayboxPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Paybox|Paybox[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Paybox[]|mixed the list of results, formatted by the current formatter
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
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PayboxPeer::PAY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PayboxPeer::PAY_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pay_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE pay_id = 1234
     * $query->filterById(array(12, 34)); // WHERE pay_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE pay_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PayboxPeer::PAY_ID, $id, $comparison);
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
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByUsrId($usrId = null, $comparison = null)
    {
        if (is_array($usrId)) {
            $useMinMax = false;
            if (isset($usrId['min'])) {
                $this->addUsingAlias(PayboxPeer::USR_ID, $usrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrId['max'])) {
                $this->addUsingAlias(PayboxPeer::USR_ID, $usrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PayboxPeer::USR_ID, $usrId, $comparison);
    }

    /**
     * Filter the query on the pay_step column
     *
     * Example usage:
     * <code>
     * $query->filterByStep('fooValue');   // WHERE pay_step = 'fooValue'
     * $query->filterByStep('%fooValue%'); // WHERE pay_step LIKE '%fooValue%'
     * </code>
     *
     * @param     string $step The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByStep($step = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($step)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $step)) {
                $step = str_replace('*', '%', $step);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PayboxPeer::PAY_STEP, $step, $comparison);
    }

    /**
     * Filter the query on the pay_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE pay_amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE pay_amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE pay_amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(PayboxPeer::PAY_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(PayboxPeer::PAY_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PayboxPeer::PAY_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the pay_date_create column
     *
     * Example usage:
     * <code>
     * $query->filterByDateCreate('2011-03-14'); // WHERE pay_date_create = '2011-03-14'
     * $query->filterByDateCreate('now'); // WHERE pay_date_create = '2011-03-14'
     * $query->filterByDateCreate(array('max' => 'yesterday')); // WHERE pay_date_create > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateCreate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByDateCreate($dateCreate = null, $comparison = null)
    {
        if (is_array($dateCreate)) {
            $useMinMax = false;
            if (isset($dateCreate['min'])) {
                $this->addUsingAlias(PayboxPeer::PAY_DATE_CREATE, $dateCreate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCreate['max'])) {
                $this->addUsingAlias(PayboxPeer::PAY_DATE_CREATE, $dateCreate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PayboxPeer::PAY_DATE_CREATE, $dateCreate, $comparison);
    }

    /**
     * Filter the query on the pay_date_retour column
     *
     * Example usage:
     * <code>
     * $query->filterByDateRetour('2011-03-14'); // WHERE pay_date_retour = '2011-03-14'
     * $query->filterByDateRetour('now'); // WHERE pay_date_retour = '2011-03-14'
     * $query->filterByDateRetour(array('max' => 'yesterday')); // WHERE pay_date_retour > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateRetour The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByDateRetour($dateRetour = null, $comparison = null)
    {
        if (is_array($dateRetour)) {
            $useMinMax = false;
            if (isset($dateRetour['min'])) {
                $this->addUsingAlias(PayboxPeer::PAY_DATE_RETOUR, $dateRetour['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateRetour['max'])) {
                $this->addUsingAlias(PayboxPeer::PAY_DATE_RETOUR, $dateRetour['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PayboxPeer::PAY_DATE_RETOUR, $dateRetour, $comparison);
    }

    /**
     * Filter the query on the pay_auto column
     *
     * Example usage:
     * <code>
     * $query->filterByAuto('fooValue');   // WHERE pay_auto = 'fooValue'
     * $query->filterByAuto('%fooValue%'); // WHERE pay_auto LIKE '%fooValue%'
     * </code>
     *
     * @param     string $auto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByAuto($auto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($auto)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $auto)) {
                $auto = str_replace('*', '%', $auto);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PayboxPeer::PAY_AUTO, $auto, $comparison);
    }

    /**
     * Filter the query on the pay_trans column
     *
     * Example usage:
     * <code>
     * $query->filterByTrans('fooValue');   // WHERE pay_trans = 'fooValue'
     * $query->filterByTrans('%fooValue%'); // WHERE pay_trans LIKE '%fooValue%'
     * </code>
     *
     * @param     string $trans The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByTrans($trans = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($trans)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $trans)) {
                $trans = str_replace('*', '%', $trans);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PayboxPeer::PAY_TRANS, $trans, $comparison);
    }

    /**
     * Filter the query on the pay_callback_url column
     *
     * Example usage:
     * <code>
     * $query->filterByCallbackUrl('fooValue');   // WHERE pay_callback_url = 'fooValue'
     * $query->filterByCallbackUrl('%fooValue%'); // WHERE pay_callback_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $callbackUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByCallbackUrl($callbackUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($callbackUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $callbackUrl)) {
                $callbackUrl = str_replace('*', '%', $callbackUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PayboxPeer::PAY_CALLBACK_URL, $callbackUrl, $comparison);
    }

    /**
     * Filter the query on the pay_mobile column
     *
     * Example usage:
     * <code>
     * $query->filterByMobile(true); // WHERE pay_mobile = true
     * $query->filterByMobile('yes'); // WHERE pay_mobile = true
     * </code>
     *
     * @param     boolean|string $mobile The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByMobile($mobile = null, $comparison = null)
    {
        if (is_string($mobile)) {
            $pay_mobile = in_array(strtolower($mobile), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PayboxPeer::PAY_MOBILE, $mobile, $comparison);
    }

    /**
     * Filter the query on the pay_error column
     *
     * Example usage:
     * <code>
     * $query->filterByError('fooValue');   // WHERE pay_error = 'fooValue'
     * $query->filterByError('%fooValue%'); // WHERE pay_error LIKE '%fooValue%'
     * </code>
     *
     * @param     string $error The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function filterByError($error = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($error)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $error)) {
                $error = str_replace('*', '%', $error);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PayboxPeer::PAY_ERROR, $error, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PayboxQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(PayboxPeer::USR_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PayboxPeer::USR_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return PayboxQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Paybox $paybox Object to remove from the list of results
     *
     * @return PayboxQuery The current query, for fluid interface
     */
    public function prune($paybox = null)
    {
        if ($paybox) {
            $this->addUsingAlias(PayboxPeer::PAY_ID, $paybox->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
