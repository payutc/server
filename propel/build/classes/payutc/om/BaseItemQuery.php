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
use Payutc\Image;
use Payutc\Item;
use Payutc\ItemPeer;
use Payutc\ItemQuery;
use Payutc\JObjPoi;
use Payutc\JObjectLink;
use Payutc\Point;
use Payutc\Price;
use Payutc\Purchase;
use Payutc\Sale;

/**
 * Base class that represents a query for the 't_object_obj' table.
 *
 *
 *
 * @method ItemQuery orderById($order = Criteria::ASC) Order by the obj_id column
 * @method ItemQuery orderByName($order = Criteria::ASC) Order by the obj_name column
 * @method ItemQuery orderByType($order = Criteria::ASC) Order by the obj_type column
 * @method ItemQuery orderByStock($order = Criteria::ASC) Order by the obj_stock column
 * @method ItemQuery orderBySingle($order = Criteria::ASC) Order by the obj_single column
 * @method ItemQuery orderByTva($order = Criteria::ASC) Order by the obj_tva column
 * @method ItemQuery orderByAlcool($order = Criteria::ASC) Order by the obj_alcool column
 * @method ItemQuery orderByImgId($order = Criteria::ASC) Order by the img_id column
 * @method ItemQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method ItemQuery orderByRemoved($order = Criteria::ASC) Order by the obj_removed column
 *
 * @method ItemQuery groupById() Group by the obj_id column
 * @method ItemQuery groupByName() Group by the obj_name column
 * @method ItemQuery groupByType() Group by the obj_type column
 * @method ItemQuery groupByStock() Group by the obj_stock column
 * @method ItemQuery groupBySingle() Group by the obj_single column
 * @method ItemQuery groupByTva() Group by the obj_tva column
 * @method ItemQuery groupByAlcool() Group by the obj_alcool column
 * @method ItemQuery groupByImgId() Group by the img_id column
 * @method ItemQuery groupByFunId() Group by the fun_id column
 * @method ItemQuery groupByRemoved() Group by the obj_removed column
 *
 * @method ItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ItemQuery leftJoinFundation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fundation relation
 * @method ItemQuery rightJoinFundation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fundation relation
 * @method ItemQuery innerJoinFundation($relationAlias = null) Adds a INNER JOIN clause to the query using the Fundation relation
 *
 * @method ItemQuery leftJoinImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Image relation
 * @method ItemQuery rightJoinImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Image relation
 * @method ItemQuery innerJoinImage($relationAlias = null) Adds a INNER JOIN clause to the query using the Image relation
 *
 * @method ItemQuery leftJoinPrice($relationAlias = null) Adds a LEFT JOIN clause to the query using the Price relation
 * @method ItemQuery rightJoinPrice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Price relation
 * @method ItemQuery innerJoinPrice($relationAlias = null) Adds a INNER JOIN clause to the query using the Price relation
 *
 * @method ItemQuery leftJoinPurchase($relationAlias = null) Adds a LEFT JOIN clause to the query using the Purchase relation
 * @method ItemQuery rightJoinPurchase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Purchase relation
 * @method ItemQuery innerJoinPurchase($relationAlias = null) Adds a INNER JOIN clause to the query using the Purchase relation
 *
 * @method ItemQuery leftJoinSale($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sale relation
 * @method ItemQuery rightJoinSale($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sale relation
 * @method ItemQuery innerJoinSale($relationAlias = null) Adds a INNER JOIN clause to the query using the Sale relation
 *
 * @method ItemQuery leftJoinJObjPoi($relationAlias = null) Adds a LEFT JOIN clause to the query using the JObjPoi relation
 * @method ItemQuery rightJoinJObjPoi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JObjPoi relation
 * @method ItemQuery innerJoinJObjPoi($relationAlias = null) Adds a INNER JOIN clause to the query using the JObjPoi relation
 *
 * @method ItemQuery leftJoinJObjectLinkRelatedByIdChild($relationAlias = null) Adds a LEFT JOIN clause to the query using the JObjectLinkRelatedByIdChild relation
 * @method ItemQuery rightJoinJObjectLinkRelatedByIdChild($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JObjectLinkRelatedByIdChild relation
 * @method ItemQuery innerJoinJObjectLinkRelatedByIdChild($relationAlias = null) Adds a INNER JOIN clause to the query using the JObjectLinkRelatedByIdChild relation
 *
 * @method ItemQuery leftJoinJObjectLinkRelatedByIdParent($relationAlias = null) Adds a LEFT JOIN clause to the query using the JObjectLinkRelatedByIdParent relation
 * @method ItemQuery rightJoinJObjectLinkRelatedByIdParent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JObjectLinkRelatedByIdParent relation
 * @method ItemQuery innerJoinJObjectLinkRelatedByIdParent($relationAlias = null) Adds a INNER JOIN clause to the query using the JObjectLinkRelatedByIdParent relation
 *
 * @method Item findOne(PropelPDO $con = null) Return the first Item matching the query
 * @method Item findOneOrCreate(PropelPDO $con = null) Return the first Item matching the query, or a new Item object populated from the query conditions when no match is found
 *
 * @method Item findOneByName(string $obj_name) Return the first Item filtered by the obj_name column
 * @method Item findOneByType(string $obj_type) Return the first Item filtered by the obj_type column
 * @method Item findOneByStock(int $obj_stock) Return the first Item filtered by the obj_stock column
 * @method Item findOneBySingle(boolean $obj_single) Return the first Item filtered by the obj_single column
 * @method Item findOneByTva(int $obj_tva) Return the first Item filtered by the obj_tva column
 * @method Item findOneByAlcool(int $obj_alcool) Return the first Item filtered by the obj_alcool column
 * @method Item findOneByImgId(int $img_id) Return the first Item filtered by the img_id column
 * @method Item findOneByFunId(int $fun_id) Return the first Item filtered by the fun_id column
 * @method Item findOneByRemoved(boolean $obj_removed) Return the first Item filtered by the obj_removed column
 *
 * @method array findById(int $obj_id) Return Item objects filtered by the obj_id column
 * @method array findByName(string $obj_name) Return Item objects filtered by the obj_name column
 * @method array findByType(string $obj_type) Return Item objects filtered by the obj_type column
 * @method array findByStock(int $obj_stock) Return Item objects filtered by the obj_stock column
 * @method array findBySingle(boolean $obj_single) Return Item objects filtered by the obj_single column
 * @method array findByTva(int $obj_tva) Return Item objects filtered by the obj_tva column
 * @method array findByAlcool(int $obj_alcool) Return Item objects filtered by the obj_alcool column
 * @method array findByImgId(int $img_id) Return Item objects filtered by the img_id column
 * @method array findByFunId(int $fun_id) Return Item objects filtered by the fun_id column
 * @method array findByRemoved(boolean $obj_removed) Return Item objects filtered by the obj_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseItemQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseItemQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Item', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ItemQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ItemQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ItemQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ItemQuery) {
            return $criteria;
        }
        $query = new ItemQuery();
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
     * @return   Item|Item[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ItemPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Item A model object, or null if the key is not found
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
     * @return   Item A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `OBJ_ID`, `OBJ_NAME`, `OBJ_TYPE`, `OBJ_STOCK`, `OBJ_SINGLE`, `OBJ_TVA`, `OBJ_ALCOOL`, `IMG_ID`, `FUN_ID`, `OBJ_REMOVED` FROM `t_object_obj` WHERE `OBJ_ID` = :p0';
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
            $obj = new Item();
            $obj->hydrate($row);
            ItemPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Item|Item[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Item[]|mixed the list of results, formatted by the current formatter
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
     * @return ItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ItemPeer::OBJ_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ItemPeer::OBJ_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the obj_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE obj_id = 1234
     * $query->filterById(array(12, 34)); // WHERE obj_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE obj_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ItemPeer::OBJ_ID, $id, $comparison);
    }

    /**
     * Filter the query on the obj_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE obj_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE obj_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ItemQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ItemPeer::OBJ_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the obj_type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE obj_type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE obj_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ItemQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ItemPeer::OBJ_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the obj_stock column
     *
     * Example usage:
     * <code>
     * $query->filterByStock(1234); // WHERE obj_stock = 1234
     * $query->filterByStock(array(12, 34)); // WHERE obj_stock IN (12, 34)
     * $query->filterByStock(array('min' => 12)); // WHERE obj_stock > 12
     * </code>
     *
     * @param     mixed $stock The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function filterByStock($stock = null, $comparison = null)
    {
        if (is_array($stock)) {
            $useMinMax = false;
            if (isset($stock['min'])) {
                $this->addUsingAlias(ItemPeer::OBJ_STOCK, $stock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stock['max'])) {
                $this->addUsingAlias(ItemPeer::OBJ_STOCK, $stock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemPeer::OBJ_STOCK, $stock, $comparison);
    }

    /**
     * Filter the query on the obj_single column
     *
     * Example usage:
     * <code>
     * $query->filterBySingle(true); // WHERE obj_single = true
     * $query->filterBySingle('yes'); // WHERE obj_single = true
     * </code>
     *
     * @param     boolean|string $single The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function filterBySingle($single = null, $comparison = null)
    {
        if (is_string($single)) {
            $obj_single = in_array(strtolower($single), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ItemPeer::OBJ_SINGLE, $single, $comparison);
    }

    /**
     * Filter the query on the obj_tva column
     *
     * Example usage:
     * <code>
     * $query->filterByTva(1234); // WHERE obj_tva = 1234
     * $query->filterByTva(array(12, 34)); // WHERE obj_tva IN (12, 34)
     * $query->filterByTva(array('min' => 12)); // WHERE obj_tva > 12
     * </code>
     *
     * @param     mixed $tva The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function filterByTva($tva = null, $comparison = null)
    {
        if (is_array($tva)) {
            $useMinMax = false;
            if (isset($tva['min'])) {
                $this->addUsingAlias(ItemPeer::OBJ_TVA, $tva['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tva['max'])) {
                $this->addUsingAlias(ItemPeer::OBJ_TVA, $tva['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemPeer::OBJ_TVA, $tva, $comparison);
    }

    /**
     * Filter the query on the obj_alcool column
     *
     * Example usage:
     * <code>
     * $query->filterByAlcool(1234); // WHERE obj_alcool = 1234
     * $query->filterByAlcool(array(12, 34)); // WHERE obj_alcool IN (12, 34)
     * $query->filterByAlcool(array('min' => 12)); // WHERE obj_alcool > 12
     * </code>
     *
     * @param     mixed $alcool The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function filterByAlcool($alcool = null, $comparison = null)
    {
        if (is_array($alcool)) {
            $useMinMax = false;
            if (isset($alcool['min'])) {
                $this->addUsingAlias(ItemPeer::OBJ_ALCOOL, $alcool['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($alcool['max'])) {
                $this->addUsingAlias(ItemPeer::OBJ_ALCOOL, $alcool['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemPeer::OBJ_ALCOOL, $alcool, $comparison);
    }

    /**
     * Filter the query on the img_id column
     *
     * Example usage:
     * <code>
     * $query->filterByImgId(1234); // WHERE img_id = 1234
     * $query->filterByImgId(array(12, 34)); // WHERE img_id IN (12, 34)
     * $query->filterByImgId(array('min' => 12)); // WHERE img_id > 12
     * </code>
     *
     * @see       filterByImage()
     *
     * @param     mixed $imgId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function filterByImgId($imgId = null, $comparison = null)
    {
        if (is_array($imgId)) {
            $useMinMax = false;
            if (isset($imgId['min'])) {
                $this->addUsingAlias(ItemPeer::IMG_ID, $imgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($imgId['max'])) {
                $this->addUsingAlias(ItemPeer::IMG_ID, $imgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemPeer::IMG_ID, $imgId, $comparison);
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
     * @return ItemQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(ItemPeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(ItemPeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ItemPeer::FUN_ID, $funId, $comparison);
    }

    /**
     * Filter the query on the obj_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE obj_removed = true
     * $query->filterByRemoved('yes'); // WHERE obj_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $obj_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ItemPeer::OBJ_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Fundation object
     *
     * @param   Fundation|PropelObjectCollection $fundation The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ItemQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByFundation($fundation, $comparison = null)
    {
        if ($fundation instanceof Fundation) {
            return $this
                ->addUsingAlias(ItemPeer::FUN_ID, $fundation->getId(), $comparison);
        } elseif ($fundation instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ItemPeer::FUN_ID, $fundation->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ItemQuery The current query, for fluid interface
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
     * Filter the query by a related Image object
     *
     * @param   Image|PropelObjectCollection $image The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ItemQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByImage($image, $comparison = null)
    {
        if ($image instanceof Image) {
            return $this
                ->addUsingAlias(ItemPeer::IMG_ID, $image->getId(), $comparison);
        } elseif ($image instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ItemPeer::IMG_ID, $image->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByImage() only accepts arguments of type Image or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Image relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function joinImage($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Image');

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
            $this->addJoinObject($join, 'Image');
        }

        return $this;
    }

    /**
     * Use the Image relation Image object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\ImageQuery A secondary query class using the current class as primary query
     */
    public function useImageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Image', '\Payutc\ImageQuery');
    }

    /**
     * Filter the query by a related Price object
     *
     * @param   Price|PropelObjectCollection $price  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ItemQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPrice($price, $comparison = null)
    {
        if ($price instanceof Price) {
            return $this
                ->addUsingAlias(ItemPeer::OBJ_ID, $price->getObjId(), $comparison);
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
     * @return ItemQuery The current query, for fluid interface
     */
    public function joinPrice($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function usePriceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Price', '\Payutc\PriceQuery');
    }

    /**
     * Filter the query by a related Purchase object
     *
     * @param   Purchase|PropelObjectCollection $purchase  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ItemQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPurchase($purchase, $comparison = null)
    {
        if ($purchase instanceof Purchase) {
            return $this
                ->addUsingAlias(ItemPeer::OBJ_ID, $purchase->getObjId(), $comparison);
        } elseif ($purchase instanceof PropelObjectCollection) {
            return $this
                ->usePurchaseQuery()
                ->filterByPrimaryKeys($purchase->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPurchase() only accepts arguments of type Purchase or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Purchase relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function joinPurchase($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Purchase');

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
            $this->addJoinObject($join, 'Purchase');
        }

        return $this;
    }

    /**
     * Use the Purchase relation Purchase object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\PurchaseQuery A secondary query class using the current class as primary query
     */
    public function usePurchaseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPurchase($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Purchase', '\Payutc\PurchaseQuery');
    }

    /**
     * Filter the query by a related Sale object
     *
     * @param   Sale|PropelObjectCollection $sale  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ItemQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySale($sale, $comparison = null)
    {
        if ($sale instanceof Sale) {
            return $this
                ->addUsingAlias(ItemPeer::OBJ_ID, $sale->getObjId(), $comparison);
        } elseif ($sale instanceof PropelObjectCollection) {
            return $this
                ->useSaleQuery()
                ->filterByPrimaryKeys($sale->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySale() only accepts arguments of type Sale or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Sale relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function joinSale($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Sale');

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
            $this->addJoinObject($join, 'Sale');
        }

        return $this;
    }

    /**
     * Use the Sale relation Sale object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\SaleQuery A secondary query class using the current class as primary query
     */
    public function useSaleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSale($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Sale', '\Payutc\SaleQuery');
    }

    /**
     * Filter the query by a related JObjPoi object
     *
     * @param   JObjPoi|PropelObjectCollection $jObjPoi  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ItemQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJObjPoi($jObjPoi, $comparison = null)
    {
        if ($jObjPoi instanceof JObjPoi) {
            return $this
                ->addUsingAlias(ItemPeer::OBJ_ID, $jObjPoi->getObjId(), $comparison);
        } elseif ($jObjPoi instanceof PropelObjectCollection) {
            return $this
                ->useJObjPoiQuery()
                ->filterByPrimaryKeys($jObjPoi->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJObjPoi() only accepts arguments of type JObjPoi or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JObjPoi relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function joinJObjPoi($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JObjPoi');

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
            $this->addJoinObject($join, 'JObjPoi');
        }

        return $this;
    }

    /**
     * Use the JObjPoi relation JObjPoi object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\JObjPoiQuery A secondary query class using the current class as primary query
     */
    public function useJObjPoiQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJObjPoi($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JObjPoi', '\Payutc\JObjPoiQuery');
    }

    /**
     * Filter the query by a related JObjectLink object
     *
     * @param   JObjectLink|PropelObjectCollection $jObjectLink  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ItemQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJObjectLinkRelatedByIdChild($jObjectLink, $comparison = null)
    {
        if ($jObjectLink instanceof JObjectLink) {
            return $this
                ->addUsingAlias(ItemPeer::OBJ_ID, $jObjectLink->getIdChild(), $comparison);
        } elseif ($jObjectLink instanceof PropelObjectCollection) {
            return $this
                ->useJObjectLinkRelatedByIdChildQuery()
                ->filterByPrimaryKeys($jObjectLink->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJObjectLinkRelatedByIdChild() only accepts arguments of type JObjectLink or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JObjectLinkRelatedByIdChild relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function joinJObjectLinkRelatedByIdChild($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JObjectLinkRelatedByIdChild');

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
            $this->addJoinObject($join, 'JObjectLinkRelatedByIdChild');
        }

        return $this;
    }

    /**
     * Use the JObjectLinkRelatedByIdChild relation JObjectLink object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\JObjectLinkQuery A secondary query class using the current class as primary query
     */
    public function useJObjectLinkRelatedByIdChildQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJObjectLinkRelatedByIdChild($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JObjectLinkRelatedByIdChild', '\Payutc\JObjectLinkQuery');
    }

    /**
     * Filter the query by a related JObjectLink object
     *
     * @param   JObjectLink|PropelObjectCollection $jObjectLink  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ItemQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJObjectLinkRelatedByIdParent($jObjectLink, $comparison = null)
    {
        if ($jObjectLink instanceof JObjectLink) {
            return $this
                ->addUsingAlias(ItemPeer::OBJ_ID, $jObjectLink->getIdParent(), $comparison);
        } elseif ($jObjectLink instanceof PropelObjectCollection) {
            return $this
                ->useJObjectLinkRelatedByIdParentQuery()
                ->filterByPrimaryKeys($jObjectLink->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJObjectLinkRelatedByIdParent() only accepts arguments of type JObjectLink or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JObjectLinkRelatedByIdParent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function joinJObjectLinkRelatedByIdParent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JObjectLinkRelatedByIdParent');

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
            $this->addJoinObject($join, 'JObjectLinkRelatedByIdParent');
        }

        return $this;
    }

    /**
     * Use the JObjectLinkRelatedByIdParent relation JObjectLink object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\JObjectLinkQuery A secondary query class using the current class as primary query
     */
    public function useJObjectLinkRelatedByIdParentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJObjectLinkRelatedByIdParent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JObjectLinkRelatedByIdParent', '\Payutc\JObjectLinkQuery');
    }

    /**
     * Filter the query by a related Point object
     * using the tj_obj_poi_jop table as cross reference
     *
     * @param   Point $point the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ItemQuery The current query, for fluid interface
     */
    public function filterByPoint($point, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJObjPoiQuery()
            ->filterByPoint($point, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Item $item Object to remove from the list of results
     *
     * @return ItemQuery The current query, for fluid interface
     */
    public function prune($item = null)
    {
        if ($item) {
            $this->addUsingAlias(ItemPeer::OBJ_ID, $item->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
