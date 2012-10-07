<?php


/**
 * Base class that represents a query for the 't_object_obj' table.
 *
 *
 *
 * @method TObjectObjQuery orderById($order = Criteria::ASC) Order by the obj_id column
 * @method TObjectObjQuery orderByName($order = Criteria::ASC) Order by the obj_name column
 * @method TObjectObjQuery orderByType($order = Criteria::ASC) Order by the obj_type column
 * @method TObjectObjQuery orderByStock($order = Criteria::ASC) Order by the obj_stock column
 * @method TObjectObjQuery orderBySingle($order = Criteria::ASC) Order by the obj_single column
 * @method TObjectObjQuery orderByTva($order = Criteria::ASC) Order by the obj_tva column
 * @method TObjectObjQuery orderByAlcool($order = Criteria::ASC) Order by the obj_alcool column
 * @method TObjectObjQuery orderByImgId($order = Criteria::ASC) Order by the img_id column
 * @method TObjectObjQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method TObjectObjQuery orderByRemoved($order = Criteria::ASC) Order by the obj_removed column
 *
 * @method TObjectObjQuery groupById() Group by the obj_id column
 * @method TObjectObjQuery groupByName() Group by the obj_name column
 * @method TObjectObjQuery groupByType() Group by the obj_type column
 * @method TObjectObjQuery groupByStock() Group by the obj_stock column
 * @method TObjectObjQuery groupBySingle() Group by the obj_single column
 * @method TObjectObjQuery groupByTva() Group by the obj_tva column
 * @method TObjectObjQuery groupByAlcool() Group by the obj_alcool column
 * @method TObjectObjQuery groupByImgId() Group by the img_id column
 * @method TObjectObjQuery groupByFunId() Group by the fun_id column
 * @method TObjectObjQuery groupByRemoved() Group by the obj_removed column
 *
 * @method TObjectObjQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TObjectObjQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TObjectObjQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TObjectObjQuery leftJoinTFundationFun($relationAlias = null) Adds a LEFT JOIN clause to the query using the TFundationFun relation
 * @method TObjectObjQuery rightJoinTFundationFun($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TFundationFun relation
 * @method TObjectObjQuery innerJoinTFundationFun($relationAlias = null) Adds a INNER JOIN clause to the query using the TFundationFun relation
 *
 * @method TObjectObjQuery leftJoinTsImageImg($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsImageImg relation
 * @method TObjectObjQuery rightJoinTsImageImg($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsImageImg relation
 * @method TObjectObjQuery innerJoinTsImageImg($relationAlias = null) Adds a INNER JOIN clause to the query using the TsImageImg relation
 *
 * @method TObjectObjQuery leftJoinTPricePri($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPricePri relation
 * @method TObjectObjQuery rightJoinTPricePri($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPricePri relation
 * @method TObjectObjQuery innerJoinTPricePri($relationAlias = null) Adds a INNER JOIN clause to the query using the TPricePri relation
 *
 * @method TObjectObjQuery leftJoinTPurchasePur($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPurchasePur relation
 * @method TObjectObjQuery rightJoinTPurchasePur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPurchasePur relation
 * @method TObjectObjQuery innerJoinTPurchasePur($relationAlias = null) Adds a INNER JOIN clause to the query using the TPurchasePur relation
 *
 * @method TObjectObjQuery leftJoinTSaleSal($relationAlias = null) Adds a LEFT JOIN clause to the query using the TSaleSal relation
 * @method TObjectObjQuery rightJoinTSaleSal($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TSaleSal relation
 * @method TObjectObjQuery innerJoinTSaleSal($relationAlias = null) Adds a INNER JOIN clause to the query using the TSaleSal relation
 *
 * @method TObjectObjQuery leftJoinTjObjPoiJop($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjObjPoiJop relation
 * @method TObjectObjQuery rightJoinTjObjPoiJop($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjObjPoiJop relation
 * @method TObjectObjQuery innerJoinTjObjPoiJop($relationAlias = null) Adds a INNER JOIN clause to the query using the TjObjPoiJop relation
 *
 * @method TObjectObjQuery leftJoinTjObjectLinkOliRelatedByObjIdChild($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjObjectLinkOliRelatedByObjIdChild relation
 * @method TObjectObjQuery rightJoinTjObjectLinkOliRelatedByObjIdChild($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjObjectLinkOliRelatedByObjIdChild relation
 * @method TObjectObjQuery innerJoinTjObjectLinkOliRelatedByObjIdChild($relationAlias = null) Adds a INNER JOIN clause to the query using the TjObjectLinkOliRelatedByObjIdChild relation
 *
 * @method TObjectObjQuery leftJoinTjObjectLinkOliRelatedByObjIdParent($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjObjectLinkOliRelatedByObjIdParent relation
 * @method TObjectObjQuery rightJoinTjObjectLinkOliRelatedByObjIdParent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjObjectLinkOliRelatedByObjIdParent relation
 * @method TObjectObjQuery innerJoinTjObjectLinkOliRelatedByObjIdParent($relationAlias = null) Adds a INNER JOIN clause to the query using the TjObjectLinkOliRelatedByObjIdParent relation
 *
 * @method TObjectObj findOne(PropelPDO $con = null) Return the first TObjectObj matching the query
 * @method TObjectObj findOneOrCreate(PropelPDO $con = null) Return the first TObjectObj matching the query, or a new TObjectObj object populated from the query conditions when no match is found
 *
 * @method TObjectObj findOneByName(string $obj_name) Return the first TObjectObj filtered by the obj_name column
 * @method TObjectObj findOneByType(string $obj_type) Return the first TObjectObj filtered by the obj_type column
 * @method TObjectObj findOneByStock(int $obj_stock) Return the first TObjectObj filtered by the obj_stock column
 * @method TObjectObj findOneBySingle(boolean $obj_single) Return the first TObjectObj filtered by the obj_single column
 * @method TObjectObj findOneByTva(int $obj_tva) Return the first TObjectObj filtered by the obj_tva column
 * @method TObjectObj findOneByAlcool(int $obj_alcool) Return the first TObjectObj filtered by the obj_alcool column
 * @method TObjectObj findOneByImgId(int $img_id) Return the first TObjectObj filtered by the img_id column
 * @method TObjectObj findOneByFunId(int $fun_id) Return the first TObjectObj filtered by the fun_id column
 * @method TObjectObj findOneByRemoved(boolean $obj_removed) Return the first TObjectObj filtered by the obj_removed column
 *
 * @method array findById(int $obj_id) Return TObjectObj objects filtered by the obj_id column
 * @method array findByName(string $obj_name) Return TObjectObj objects filtered by the obj_name column
 * @method array findByType(string $obj_type) Return TObjectObj objects filtered by the obj_type column
 * @method array findByStock(int $obj_stock) Return TObjectObj objects filtered by the obj_stock column
 * @method array findBySingle(boolean $obj_single) Return TObjectObj objects filtered by the obj_single column
 * @method array findByTva(int $obj_tva) Return TObjectObj objects filtered by the obj_tva column
 * @method array findByAlcool(int $obj_alcool) Return TObjectObj objects filtered by the obj_alcool column
 * @method array findByImgId(int $img_id) Return TObjectObj objects filtered by the img_id column
 * @method array findByFunId(int $fun_id) Return TObjectObj objects filtered by the fun_id column
 * @method array findByRemoved(boolean $obj_removed) Return TObjectObj objects filtered by the obj_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTObjectObjQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTObjectObjQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TObjectObj', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TObjectObjQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TObjectObjQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TObjectObjQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TObjectObjQuery) {
            return $criteria;
        }
        $query = new TObjectObjQuery();
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
     * @return   TObjectObj|TObjectObj[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TObjectObjPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TObjectObjPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TObjectObj A model object, or null if the key is not found
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
     * @return   TObjectObj A model object, or null if the key is not found
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
            $obj = new TObjectObj();
            $obj->hydrate($row);
            TObjectObjPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TObjectObj|TObjectObj[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TObjectObj[]|mixed the list of results, formatted by the current formatter
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
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TObjectObjPeer::OBJ_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TObjectObjPeer::OBJ_ID, $keys, Criteria::IN);
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
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TObjectObjPeer::OBJ_ID, $id, $comparison);
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
     * @return TObjectObjQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TObjectObjPeer::OBJ_NAME, $name, $comparison);
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
     * @return TObjectObjQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TObjectObjPeer::OBJ_TYPE, $type, $comparison);
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
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function filterByStock($stock = null, $comparison = null)
    {
        if (is_array($stock)) {
            $useMinMax = false;
            if (isset($stock['min'])) {
                $this->addUsingAlias(TObjectObjPeer::OBJ_STOCK, $stock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stock['max'])) {
                $this->addUsingAlias(TObjectObjPeer::OBJ_STOCK, $stock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TObjectObjPeer::OBJ_STOCK, $stock, $comparison);
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
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function filterBySingle($single = null, $comparison = null)
    {
        if (is_string($single)) {
            $obj_single = in_array(strtolower($single), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TObjectObjPeer::OBJ_SINGLE, $single, $comparison);
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
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function filterByTva($tva = null, $comparison = null)
    {
        if (is_array($tva)) {
            $useMinMax = false;
            if (isset($tva['min'])) {
                $this->addUsingAlias(TObjectObjPeer::OBJ_TVA, $tva['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tva['max'])) {
                $this->addUsingAlias(TObjectObjPeer::OBJ_TVA, $tva['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TObjectObjPeer::OBJ_TVA, $tva, $comparison);
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
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function filterByAlcool($alcool = null, $comparison = null)
    {
        if (is_array($alcool)) {
            $useMinMax = false;
            if (isset($alcool['min'])) {
                $this->addUsingAlias(TObjectObjPeer::OBJ_ALCOOL, $alcool['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($alcool['max'])) {
                $this->addUsingAlias(TObjectObjPeer::OBJ_ALCOOL, $alcool['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TObjectObjPeer::OBJ_ALCOOL, $alcool, $comparison);
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
     * @see       filterByTsImageImg()
     *
     * @param     mixed $imgId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function filterByImgId($imgId = null, $comparison = null)
    {
        if (is_array($imgId)) {
            $useMinMax = false;
            if (isset($imgId['min'])) {
                $this->addUsingAlias(TObjectObjPeer::IMG_ID, $imgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($imgId['max'])) {
                $this->addUsingAlias(TObjectObjPeer::IMG_ID, $imgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TObjectObjPeer::IMG_ID, $imgId, $comparison);
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
     * @see       filterByTFundationFun()
     *
     * @param     mixed $funId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(TObjectObjPeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(TObjectObjPeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TObjectObjPeer::FUN_ID, $funId, $comparison);
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
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $obj_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TObjectObjPeer::OBJ_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TFundationFun object
     *
     * @param   TFundationFun|PropelObjectCollection $tFundationFun The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TObjectObjQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTFundationFun($tFundationFun, $comparison = null)
    {
        if ($tFundationFun instanceof TFundationFun) {
            return $this
                ->addUsingAlias(TObjectObjPeer::FUN_ID, $tFundationFun->getId(), $comparison);
        } elseif ($tFundationFun instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TObjectObjPeer::FUN_ID, $tFundationFun->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTFundationFun() only accepts arguments of type TFundationFun or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TFundationFun relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function joinTFundationFun($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TFundationFun');

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
            $this->addJoinObject($join, 'TFundationFun');
        }

        return $this;
    }

    /**
     * Use the TFundationFun relation TFundationFun object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TFundationFunQuery A secondary query class using the current class as primary query
     */
    public function useTFundationFunQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTFundationFun($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TFundationFun', 'TFundationFunQuery');
    }

    /**
     * Filter the query by a related TsImageImg object
     *
     * @param   TsImageImg|PropelObjectCollection $tsImageImg The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TObjectObjQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsImageImg($tsImageImg, $comparison = null)
    {
        if ($tsImageImg instanceof TsImageImg) {
            return $this
                ->addUsingAlias(TObjectObjPeer::IMG_ID, $tsImageImg->getId(), $comparison);
        } elseif ($tsImageImg instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TObjectObjPeer::IMG_ID, $tsImageImg->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTsImageImg() only accepts arguments of type TsImageImg or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TsImageImg relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function joinTsImageImg($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TsImageImg');

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
            $this->addJoinObject($join, 'TsImageImg');
        }

        return $this;
    }

    /**
     * Use the TsImageImg relation TsImageImg object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TsImageImgQuery A secondary query class using the current class as primary query
     */
    public function useTsImageImgQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTsImageImg($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TsImageImg', 'TsImageImgQuery');
    }

    /**
     * Filter the query by a related TPricePri object
     *
     * @param   TPricePri|PropelObjectCollection $tPricePri  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TObjectObjQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPricePri($tPricePri, $comparison = null)
    {
        if ($tPricePri instanceof TPricePri) {
            return $this
                ->addUsingAlias(TObjectObjPeer::OBJ_ID, $tPricePri->getObjId(), $comparison);
        } elseif ($tPricePri instanceof PropelObjectCollection) {
            return $this
                ->useTPricePriQuery()
                ->filterByPrimaryKeys($tPricePri->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTPricePri() only accepts arguments of type TPricePri or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPricePri relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function joinTPricePri($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPricePri');

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
            $this->addJoinObject($join, 'TPricePri');
        }

        return $this;
    }

    /**
     * Use the TPricePri relation TPricePri object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPricePriQuery A secondary query class using the current class as primary query
     */
    public function useTPricePriQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTPricePri($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPricePri', 'TPricePriQuery');
    }

    /**
     * Filter the query by a related TPurchasePur object
     *
     * @param   TPurchasePur|PropelObjectCollection $tPurchasePur  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TObjectObjQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPurchasePur($tPurchasePur, $comparison = null)
    {
        if ($tPurchasePur instanceof TPurchasePur) {
            return $this
                ->addUsingAlias(TObjectObjPeer::OBJ_ID, $tPurchasePur->getObjId(), $comparison);
        } elseif ($tPurchasePur instanceof PropelObjectCollection) {
            return $this
                ->useTPurchasePurQuery()
                ->filterByPrimaryKeys($tPurchasePur->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTPurchasePur() only accepts arguments of type TPurchasePur or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPurchasePur relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function joinTPurchasePur($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPurchasePur');

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
            $this->addJoinObject($join, 'TPurchasePur');
        }

        return $this;
    }

    /**
     * Use the TPurchasePur relation TPurchasePur object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPurchasePurQuery A secondary query class using the current class as primary query
     */
    public function useTPurchasePurQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTPurchasePur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPurchasePur', 'TPurchasePurQuery');
    }

    /**
     * Filter the query by a related TSaleSal object
     *
     * @param   TSaleSal|PropelObjectCollection $tSaleSal  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TObjectObjQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTSaleSal($tSaleSal, $comparison = null)
    {
        if ($tSaleSal instanceof TSaleSal) {
            return $this
                ->addUsingAlias(TObjectObjPeer::OBJ_ID, $tSaleSal->getObjId(), $comparison);
        } elseif ($tSaleSal instanceof PropelObjectCollection) {
            return $this
                ->useTSaleSalQuery()
                ->filterByPrimaryKeys($tSaleSal->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTSaleSal() only accepts arguments of type TSaleSal or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TSaleSal relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function joinTSaleSal($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TSaleSal');

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
            $this->addJoinObject($join, 'TSaleSal');
        }

        return $this;
    }

    /**
     * Use the TSaleSal relation TSaleSal object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TSaleSalQuery A secondary query class using the current class as primary query
     */
    public function useTSaleSalQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTSaleSal($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TSaleSal', 'TSaleSalQuery');
    }

    /**
     * Filter the query by a related TjObjPoiJop object
     *
     * @param   TjObjPoiJop|PropelObjectCollection $tjObjPoiJop  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TObjectObjQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjObjPoiJop($tjObjPoiJop, $comparison = null)
    {
        if ($tjObjPoiJop instanceof TjObjPoiJop) {
            return $this
                ->addUsingAlias(TObjectObjPeer::OBJ_ID, $tjObjPoiJop->getObjId(), $comparison);
        } elseif ($tjObjPoiJop instanceof PropelObjectCollection) {
            return $this
                ->useTjObjPoiJopQuery()
                ->filterByPrimaryKeys($tjObjPoiJop->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTjObjPoiJop() only accepts arguments of type TjObjPoiJop or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TjObjPoiJop relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function joinTjObjPoiJop($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TjObjPoiJop');

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
            $this->addJoinObject($join, 'TjObjPoiJop');
        }

        return $this;
    }

    /**
     * Use the TjObjPoiJop relation TjObjPoiJop object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TjObjPoiJopQuery A secondary query class using the current class as primary query
     */
    public function useTjObjPoiJopQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTjObjPoiJop($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TjObjPoiJop', 'TjObjPoiJopQuery');
    }

    /**
     * Filter the query by a related TjObjectLinkOli object
     *
     * @param   TjObjectLinkOli|PropelObjectCollection $tjObjectLinkOli  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TObjectObjQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjObjectLinkOliRelatedByObjIdChild($tjObjectLinkOli, $comparison = null)
    {
        if ($tjObjectLinkOli instanceof TjObjectLinkOli) {
            return $this
                ->addUsingAlias(TObjectObjPeer::OBJ_ID, $tjObjectLinkOli->getObjIdChild(), $comparison);
        } elseif ($tjObjectLinkOli instanceof PropelObjectCollection) {
            return $this
                ->useTjObjectLinkOliRelatedByObjIdChildQuery()
                ->filterByPrimaryKeys($tjObjectLinkOli->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTjObjectLinkOliRelatedByObjIdChild() only accepts arguments of type TjObjectLinkOli or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TjObjectLinkOliRelatedByObjIdChild relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function joinTjObjectLinkOliRelatedByObjIdChild($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TjObjectLinkOliRelatedByObjIdChild');

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
            $this->addJoinObject($join, 'TjObjectLinkOliRelatedByObjIdChild');
        }

        return $this;
    }

    /**
     * Use the TjObjectLinkOliRelatedByObjIdChild relation TjObjectLinkOli object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TjObjectLinkOliQuery A secondary query class using the current class as primary query
     */
    public function useTjObjectLinkOliRelatedByObjIdChildQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTjObjectLinkOliRelatedByObjIdChild($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TjObjectLinkOliRelatedByObjIdChild', 'TjObjectLinkOliQuery');
    }

    /**
     * Filter the query by a related TjObjectLinkOli object
     *
     * @param   TjObjectLinkOli|PropelObjectCollection $tjObjectLinkOli  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TObjectObjQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjObjectLinkOliRelatedByObjIdParent($tjObjectLinkOli, $comparison = null)
    {
        if ($tjObjectLinkOli instanceof TjObjectLinkOli) {
            return $this
                ->addUsingAlias(TObjectObjPeer::OBJ_ID, $tjObjectLinkOli->getObjIdParent(), $comparison);
        } elseif ($tjObjectLinkOli instanceof PropelObjectCollection) {
            return $this
                ->useTjObjectLinkOliRelatedByObjIdParentQuery()
                ->filterByPrimaryKeys($tjObjectLinkOli->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTjObjectLinkOliRelatedByObjIdParent() only accepts arguments of type TjObjectLinkOli or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TjObjectLinkOliRelatedByObjIdParent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function joinTjObjectLinkOliRelatedByObjIdParent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TjObjectLinkOliRelatedByObjIdParent');

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
            $this->addJoinObject($join, 'TjObjectLinkOliRelatedByObjIdParent');
        }

        return $this;
    }

    /**
     * Use the TjObjectLinkOliRelatedByObjIdParent relation TjObjectLinkOli object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TjObjectLinkOliQuery A secondary query class using the current class as primary query
     */
    public function useTjObjectLinkOliRelatedByObjIdParentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTjObjectLinkOliRelatedByObjIdParent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TjObjectLinkOliRelatedByObjIdParent', 'TjObjectLinkOliQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TObjectObj $tObjectObj Object to remove from the list of results
     *
     * @return TObjectObjQuery The current query, for fluid interface
     */
    public function prune($tObjectObj = null)
    {
        if ($tObjectObj) {
            $this->addUsingAlias(TObjectObjPeer::OBJ_ID, $tObjectObj->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
