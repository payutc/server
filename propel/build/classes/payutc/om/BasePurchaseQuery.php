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
use Payutc\Item;
use Payutc\Point;
use Payutc\Purchase;
use Payutc\PurchasePeer;
use Payutc\PurchaseQuery;
use Payutc\User;

/**
 * Base class that represents a query for the 't_purchase_pur' table.
 *
 *
 *
 * @method PurchaseQuery orderById($order = Criteria::ASC) Order by the pur_id column
 * @method PurchaseQuery orderByDate($order = Criteria::ASC) Order by the pur_date column
 * @method PurchaseQuery orderByType($order = Criteria::ASC) Order by the pur_type column
 * @method PurchaseQuery orderByObjId($order = Criteria::ASC) Order by the obj_id column
 * @method PurchaseQuery orderByPrice($order = Criteria::ASC) Order by the pur_price column
 * @method PurchaseQuery orderByUsrIdBuyer($order = Criteria::ASC) Order by the usr_id_buyer column
 * @method PurchaseQuery orderByUsrIdSeller($order = Criteria::ASC) Order by the usr_id_seller column
 * @method PurchaseQuery orderByPoiId($order = Criteria::ASC) Order by the poi_id column
 * @method PurchaseQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method PurchaseQuery orderByIp($order = Criteria::ASC) Order by the pur_ip column
 * @method PurchaseQuery orderByRemoved($order = Criteria::ASC) Order by the pur_removed column
 *
 * @method PurchaseQuery groupById() Group by the pur_id column
 * @method PurchaseQuery groupByDate() Group by the pur_date column
 * @method PurchaseQuery groupByType() Group by the pur_type column
 * @method PurchaseQuery groupByObjId() Group by the obj_id column
 * @method PurchaseQuery groupByPrice() Group by the pur_price column
 * @method PurchaseQuery groupByUsrIdBuyer() Group by the usr_id_buyer column
 * @method PurchaseQuery groupByUsrIdSeller() Group by the usr_id_seller column
 * @method PurchaseQuery groupByPoiId() Group by the poi_id column
 * @method PurchaseQuery groupByFunId() Group by the fun_id column
 * @method PurchaseQuery groupByIp() Group by the pur_ip column
 * @method PurchaseQuery groupByRemoved() Group by the pur_removed column
 *
 * @method PurchaseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PurchaseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PurchaseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PurchaseQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method PurchaseQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method PurchaseQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method PurchaseQuery leftJoinUserRelatedByUsrIdBuyer($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUsrIdBuyer relation
 * @method PurchaseQuery rightJoinUserRelatedByUsrIdBuyer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUsrIdBuyer relation
 * @method PurchaseQuery innerJoinUserRelatedByUsrIdBuyer($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUsrIdBuyer relation
 *
 * @method PurchaseQuery leftJoinUserRelatedByUsrIdSeller($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUsrIdSeller relation
 * @method PurchaseQuery rightJoinUserRelatedByUsrIdSeller($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUsrIdSeller relation
 * @method PurchaseQuery innerJoinUserRelatedByUsrIdSeller($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUsrIdSeller relation
 *
 * @method PurchaseQuery leftJoinPoint($relationAlias = null) Adds a LEFT JOIN clause to the query using the Point relation
 * @method PurchaseQuery rightJoinPoint($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Point relation
 * @method PurchaseQuery innerJoinPoint($relationAlias = null) Adds a INNER JOIN clause to the query using the Point relation
 *
 * @method PurchaseQuery leftJoinFundation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fundation relation
 * @method PurchaseQuery rightJoinFundation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fundation relation
 * @method PurchaseQuery innerJoinFundation($relationAlias = null) Adds a INNER JOIN clause to the query using the Fundation relation
 *
 * @method Purchase findOne(PropelPDO $con = null) Return the first Purchase matching the query
 * @method Purchase findOneOrCreate(PropelPDO $con = null) Return the first Purchase matching the query, or a new Purchase object populated from the query conditions when no match is found
 *
 * @method Purchase findOneByDate(string $pur_date) Return the first Purchase filtered by the pur_date column
 * @method Purchase findOneByType(string $pur_type) Return the first Purchase filtered by the pur_type column
 * @method Purchase findOneByObjId(int $obj_id) Return the first Purchase filtered by the obj_id column
 * @method Purchase findOneByPrice(int $pur_price) Return the first Purchase filtered by the pur_price column
 * @method Purchase findOneByUsrIdBuyer(int $usr_id_buyer) Return the first Purchase filtered by the usr_id_buyer column
 * @method Purchase findOneByUsrIdSeller(int $usr_id_seller) Return the first Purchase filtered by the usr_id_seller column
 * @method Purchase findOneByPoiId(int $poi_id) Return the first Purchase filtered by the poi_id column
 * @method Purchase findOneByFunId(int $fun_id) Return the first Purchase filtered by the fun_id column
 * @method Purchase findOneByIp(string $pur_ip) Return the first Purchase filtered by the pur_ip column
 * @method Purchase findOneByRemoved(boolean $pur_removed) Return the first Purchase filtered by the pur_removed column
 *
 * @method array findById(int $pur_id) Return Purchase objects filtered by the pur_id column
 * @method array findByDate(string $pur_date) Return Purchase objects filtered by the pur_date column
 * @method array findByType(string $pur_type) Return Purchase objects filtered by the pur_type column
 * @method array findByObjId(int $obj_id) Return Purchase objects filtered by the obj_id column
 * @method array findByPrice(int $pur_price) Return Purchase objects filtered by the pur_price column
 * @method array findByUsrIdBuyer(int $usr_id_buyer) Return Purchase objects filtered by the usr_id_buyer column
 * @method array findByUsrIdSeller(int $usr_id_seller) Return Purchase objects filtered by the usr_id_seller column
 * @method array findByPoiId(int $poi_id) Return Purchase objects filtered by the poi_id column
 * @method array findByFunId(int $fun_id) Return Purchase objects filtered by the fun_id column
 * @method array findByIp(string $pur_ip) Return Purchase objects filtered by the pur_ip column
 * @method array findByRemoved(boolean $pur_removed) Return Purchase objects filtered by the pur_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BasePurchaseQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePurchaseQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Purchase', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PurchaseQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PurchaseQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PurchaseQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PurchaseQuery) {
            return $criteria;
        }
        $query = new PurchaseQuery();
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
     * @return   Purchase|Purchase[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PurchasePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Purchase A model object, or null if the key is not found
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
     * @return   Purchase A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `PUR_ID`, `PUR_DATE`, `PUR_TYPE`, `OBJ_ID`, `PUR_PRICE`, `USR_ID_BUYER`, `USR_ID_SELLER`, `POI_ID`, `FUN_ID`, `PUR_IP`, `PUR_REMOVED` FROM `t_purchase_pur` WHERE `PUR_ID` = :p0';
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
            $obj = new Purchase();
            $obj->hydrate($row);
            PurchasePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Purchase|Purchase[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Purchase[]|mixed the list of results, formatted by the current formatter
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
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PurchasePeer::PUR_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PurchasePeer::PUR_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pur_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE pur_id = 1234
     * $query->filterById(array(12, 34)); // WHERE pur_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE pur_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PurchasePeer::PUR_ID, $id, $comparison);
    }

    /**
     * Filter the query on the pur_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE pur_date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE pur_date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE pur_date > '2011-03-13'
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
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(PurchasePeer::PUR_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(PurchasePeer::PUR_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::PUR_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the pur_type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE pur_type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE pur_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PurchasePeer::PUR_TYPE, $type, $comparison);
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
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByObjId($objId = null, $comparison = null)
    {
        if (is_array($objId)) {
            $useMinMax = false;
            if (isset($objId['min'])) {
                $this->addUsingAlias(PurchasePeer::OBJ_ID, $objId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($objId['max'])) {
                $this->addUsingAlias(PurchasePeer::OBJ_ID, $objId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::OBJ_ID, $objId, $comparison);
    }

    /**
     * Filter the query on the pur_price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE pur_price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE pur_price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE pur_price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(PurchasePeer::PUR_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(PurchasePeer::PUR_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::PUR_PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the usr_id_buyer column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrIdBuyer(1234); // WHERE usr_id_buyer = 1234
     * $query->filterByUsrIdBuyer(array(12, 34)); // WHERE usr_id_buyer IN (12, 34)
     * $query->filterByUsrIdBuyer(array('min' => 12)); // WHERE usr_id_buyer > 12
     * </code>
     *
     * @see       filterByUserRelatedByUsrIdBuyer()
     *
     * @param     mixed $usrIdBuyer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByUsrIdBuyer($usrIdBuyer = null, $comparison = null)
    {
        if (is_array($usrIdBuyer)) {
            $useMinMax = false;
            if (isset($usrIdBuyer['min'])) {
                $this->addUsingAlias(PurchasePeer::USR_ID_BUYER, $usrIdBuyer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrIdBuyer['max'])) {
                $this->addUsingAlias(PurchasePeer::USR_ID_BUYER, $usrIdBuyer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::USR_ID_BUYER, $usrIdBuyer, $comparison);
    }

    /**
     * Filter the query on the usr_id_seller column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrIdSeller(1234); // WHERE usr_id_seller = 1234
     * $query->filterByUsrIdSeller(array(12, 34)); // WHERE usr_id_seller IN (12, 34)
     * $query->filterByUsrIdSeller(array('min' => 12)); // WHERE usr_id_seller > 12
     * </code>
     *
     * @see       filterByUserRelatedByUsrIdSeller()
     *
     * @param     mixed $usrIdSeller The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByUsrIdSeller($usrIdSeller = null, $comparison = null)
    {
        if (is_array($usrIdSeller)) {
            $useMinMax = false;
            if (isset($usrIdSeller['min'])) {
                $this->addUsingAlias(PurchasePeer::USR_ID_SELLER, $usrIdSeller['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrIdSeller['max'])) {
                $this->addUsingAlias(PurchasePeer::USR_ID_SELLER, $usrIdSeller['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::USR_ID_SELLER, $usrIdSeller, $comparison);
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
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByPoiId($poiId = null, $comparison = null)
    {
        if (is_array($poiId)) {
            $useMinMax = false;
            if (isset($poiId['min'])) {
                $this->addUsingAlias(PurchasePeer::POI_ID, $poiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($poiId['max'])) {
                $this->addUsingAlias(PurchasePeer::POI_ID, $poiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::POI_ID, $poiId, $comparison);
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
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(PurchasePeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(PurchasePeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchasePeer::FUN_ID, $funId, $comparison);
    }

    /**
     * Filter the query on the pur_ip column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE pur_ip = 'fooValue'
     * $query->filterByIp('%fooValue%'); // WHERE pur_ip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ip)) {
                $ip = str_replace('*', '%', $ip);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PurchasePeer::PUR_IP, $ip, $comparison);
    }

    /**
     * Filter the query on the pur_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE pur_removed = true
     * $query->filterByRemoved('yes'); // WHERE pur_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $pur_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PurchasePeer::PUR_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Item object
     *
     * @param   Item|PropelObjectCollection $item The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PurchaseQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByItem($item, $comparison = null)
    {
        if ($item instanceof Item) {
            return $this
                ->addUsingAlias(PurchasePeer::OBJ_ID, $item->getId(), $comparison);
        } elseif ($item instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchasePeer::OBJ_ID, $item->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return PurchaseQuery The current query, for fluid interface
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
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PurchaseQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByUsrIdBuyer($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(PurchasePeer::USR_ID_BUYER, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchasePeer::USR_ID_BUYER, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByUsrIdBuyer() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByUsrIdBuyer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function joinUserRelatedByUsrIdBuyer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByUsrIdBuyer');

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
            $this->addJoinObject($join, 'UserRelatedByUsrIdBuyer');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByUsrIdBuyer relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByUsrIdBuyerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserRelatedByUsrIdBuyer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByUsrIdBuyer', '\Payutc\UserQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PurchaseQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByUsrIdSeller($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(PurchasePeer::USR_ID_SELLER, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchasePeer::USR_ID_SELLER, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByUsrIdSeller() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByUsrIdSeller relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function joinUserRelatedByUsrIdSeller($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByUsrIdSeller');

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
            $this->addJoinObject($join, 'UserRelatedByUsrIdSeller');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByUsrIdSeller relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByUsrIdSellerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserRelatedByUsrIdSeller($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByUsrIdSeller', '\Payutc\UserQuery');
    }

    /**
     * Filter the query by a related Point object
     *
     * @param   Point|PropelObjectCollection $point The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PurchaseQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPoint($point, $comparison = null)
    {
        if ($point instanceof Point) {
            return $this
                ->addUsingAlias(PurchasePeer::POI_ID, $point->getId(), $comparison);
        } elseif ($point instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchasePeer::POI_ID, $point->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return PurchaseQuery The current query, for fluid interface
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
     * Filter the query by a related Fundation object
     *
     * @param   Fundation|PropelObjectCollection $fundation The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PurchaseQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFundation($fundation, $comparison = null)
    {
        if ($fundation instanceof Fundation) {
            return $this
                ->addUsingAlias(PurchasePeer::FUN_ID, $fundation->getId(), $comparison);
        } elseif ($fundation instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchasePeer::FUN_ID, $fundation->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return PurchaseQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Purchase $purchase Object to remove from the list of results
     *
     * @return PurchaseQuery The current query, for fluid interface
     */
    public function prune($purchase = null)
    {
        if ($purchase) {
            $this->addUsingAlias(PurchasePeer::PUR_ID, $purchase->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
