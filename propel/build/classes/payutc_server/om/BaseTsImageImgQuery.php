<?php


/**
 * Base class that represents a query for the 'ts_image_img' table.
 *
 *
 *
 * @method TsImageImgQuery orderById($order = Criteria::ASC) Order by the img_id column
 * @method TsImageImgQuery orderByMime($order = Criteria::ASC) Order by the img_mime column
 * @method TsImageImgQuery orderByWidth($order = Criteria::ASC) Order by the img_width column
 * @method TsImageImgQuery orderByLength($order = Criteria::ASC) Order by the img_length column
 * @method TsImageImgQuery orderByContent($order = Criteria::ASC) Order by the img_content column
 * @method TsImageImgQuery orderByRemoved($order = Criteria::ASC) Order by the img_removed column
 *
 * @method TsImageImgQuery groupById() Group by the img_id column
 * @method TsImageImgQuery groupByMime() Group by the img_mime column
 * @method TsImageImgQuery groupByWidth() Group by the img_width column
 * @method TsImageImgQuery groupByLength() Group by the img_length column
 * @method TsImageImgQuery groupByContent() Group by the img_content column
 * @method TsImageImgQuery groupByRemoved() Group by the img_removed column
 *
 * @method TsImageImgQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TsImageImgQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TsImageImgQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TsImageImgQuery leftJoinTObjectObj($relationAlias = null) Adds a LEFT JOIN clause to the query using the TObjectObj relation
 * @method TsImageImgQuery rightJoinTObjectObj($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TObjectObj relation
 * @method TsImageImgQuery innerJoinTObjectObj($relationAlias = null) Adds a INNER JOIN clause to the query using the TObjectObj relation
 *
 * @method TsImageImgQuery leftJoinTsUserUsr($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsUserUsr relation
 * @method TsImageImgQuery rightJoinTsUserUsr($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsUserUsr relation
 * @method TsImageImgQuery innerJoinTsUserUsr($relationAlias = null) Adds a INNER JOIN clause to the query using the TsUserUsr relation
 *
 * @method TsImageImg findOne(PropelPDO $con = null) Return the first TsImageImg matching the query
 * @method TsImageImg findOneOrCreate(PropelPDO $con = null) Return the first TsImageImg matching the query, or a new TsImageImg object populated from the query conditions when no match is found
 *
 * @method TsImageImg findOneByMime(string $img_mime) Return the first TsImageImg filtered by the img_mime column
 * @method TsImageImg findOneByWidth(int $img_width) Return the first TsImageImg filtered by the img_width column
 * @method TsImageImg findOneByLength(int $img_length) Return the first TsImageImg filtered by the img_length column
 * @method TsImageImg findOneByContent(resource $img_content) Return the first TsImageImg filtered by the img_content column
 * @method TsImageImg findOneByRemoved(boolean $img_removed) Return the first TsImageImg filtered by the img_removed column
 *
 * @method array findById(int $img_id) Return TsImageImg objects filtered by the img_id column
 * @method array findByMime(string $img_mime) Return TsImageImg objects filtered by the img_mime column
 * @method array findByWidth(int $img_width) Return TsImageImg objects filtered by the img_width column
 * @method array findByLength(int $img_length) Return TsImageImg objects filtered by the img_length column
 * @method array findByContent(resource $img_content) Return TsImageImg objects filtered by the img_content column
 * @method array findByRemoved(boolean $img_removed) Return TsImageImg objects filtered by the img_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTsImageImgQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTsImageImgQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TsImageImg', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TsImageImgQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TsImageImgQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TsImageImgQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TsImageImgQuery) {
            return $criteria;
        }
        $query = new TsImageImgQuery();
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
     * @return   TsImageImg|TsImageImg[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TsImageImgPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TsImageImgPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TsImageImg A model object, or null if the key is not found
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
     * @return   TsImageImg A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `IMG_ID`, `IMG_MIME`, `IMG_WIDTH`, `IMG_LENGTH`, `IMG_CONTENT`, `IMG_REMOVED` FROM `ts_image_img` WHERE `IMG_ID` = :p0';
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
            $obj = new TsImageImg();
            $obj->hydrate($row);
            TsImageImgPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TsImageImg|TsImageImg[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TsImageImg[]|mixed the list of results, formatted by the current formatter
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
     * @return TsImageImgQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TsImageImgPeer::IMG_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TsImageImgQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TsImageImgPeer::IMG_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the img_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE img_id = 1234
     * $query->filterById(array(12, 34)); // WHERE img_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE img_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsImageImgQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TsImageImgPeer::IMG_ID, $id, $comparison);
    }

    /**
     * Filter the query on the img_mime column
     *
     * Example usage:
     * <code>
     * $query->filterByMime('fooValue');   // WHERE img_mime = 'fooValue'
     * $query->filterByMime('%fooValue%'); // WHERE img_mime LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mime The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsImageImgQuery The current query, for fluid interface
     */
    public function filterByMime($mime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mime)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mime)) {
                $mime = str_replace('*', '%', $mime);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TsImageImgPeer::IMG_MIME, $mime, $comparison);
    }

    /**
     * Filter the query on the img_width column
     *
     * Example usage:
     * <code>
     * $query->filterByWidth(1234); // WHERE img_width = 1234
     * $query->filterByWidth(array(12, 34)); // WHERE img_width IN (12, 34)
     * $query->filterByWidth(array('min' => 12)); // WHERE img_width > 12
     * </code>
     *
     * @param     mixed $width The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsImageImgQuery The current query, for fluid interface
     */
    public function filterByWidth($width = null, $comparison = null)
    {
        if (is_array($width)) {
            $useMinMax = false;
            if (isset($width['min'])) {
                $this->addUsingAlias(TsImageImgPeer::IMG_WIDTH, $width['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($width['max'])) {
                $this->addUsingAlias(TsImageImgPeer::IMG_WIDTH, $width['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TsImageImgPeer::IMG_WIDTH, $width, $comparison);
    }

    /**
     * Filter the query on the img_length column
     *
     * Example usage:
     * <code>
     * $query->filterByLength(1234); // WHERE img_length = 1234
     * $query->filterByLength(array(12, 34)); // WHERE img_length IN (12, 34)
     * $query->filterByLength(array('min' => 12)); // WHERE img_length > 12
     * </code>
     *
     * @param     mixed $length The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsImageImgQuery The current query, for fluid interface
     */
    public function filterByLength($length = null, $comparison = null)
    {
        if (is_array($length)) {
            $useMinMax = false;
            if (isset($length['min'])) {
                $this->addUsingAlias(TsImageImgPeer::IMG_LENGTH, $length['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($length['max'])) {
                $this->addUsingAlias(TsImageImgPeer::IMG_LENGTH, $length['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TsImageImgPeer::IMG_LENGTH, $length, $comparison);
    }

    /**
     * Filter the query on the img_content column
     *
     * @param     mixed $content The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsImageImgQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {

        return $this->addUsingAlias(TsImageImgPeer::IMG_CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the img_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE img_removed = true
     * $query->filterByRemoved('yes'); // WHERE img_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsImageImgQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $img_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TsImageImgPeer::IMG_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TObjectObj object
     *
     * @param   TObjectObj|PropelObjectCollection $tObjectObj  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsImageImgQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTObjectObj($tObjectObj, $comparison = null)
    {
        if ($tObjectObj instanceof TObjectObj) {
            return $this
                ->addUsingAlias(TsImageImgPeer::IMG_ID, $tObjectObj->getImgId(), $comparison);
        } elseif ($tObjectObj instanceof PropelObjectCollection) {
            return $this
                ->useTObjectObjQuery()
                ->filterByPrimaryKeys($tObjectObj->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTObjectObj() only accepts arguments of type TObjectObj or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TObjectObj relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsImageImgQuery The current query, for fluid interface
     */
    public function joinTObjectObj($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TObjectObj');

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
            $this->addJoinObject($join, 'TObjectObj');
        }

        return $this;
    }

    /**
     * Use the TObjectObj relation TObjectObj object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TObjectObjQuery A secondary query class using the current class as primary query
     */
    public function useTObjectObjQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTObjectObj($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TObjectObj', 'TObjectObjQuery');
    }

    /**
     * Filter the query by a related TsUserUsr object
     *
     * @param   TsUserUsr|PropelObjectCollection $tsUserUsr  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsImageImgQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsUserUsr($tsUserUsr, $comparison = null)
    {
        if ($tsUserUsr instanceof TsUserUsr) {
            return $this
                ->addUsingAlias(TsImageImgPeer::IMG_ID, $tsUserUsr->getImgId(), $comparison);
        } elseif ($tsUserUsr instanceof PropelObjectCollection) {
            return $this
                ->useTsUserUsrQuery()
                ->filterByPrimaryKeys($tsUserUsr->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTsUserUsr() only accepts arguments of type TsUserUsr or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TsUserUsr relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsImageImgQuery The current query, for fluid interface
     */
    public function joinTsUserUsr($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TsUserUsr');

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
            $this->addJoinObject($join, 'TsUserUsr');
        }

        return $this;
    }

    /**
     * Use the TsUserUsr relation TsUserUsr object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TsUserUsrQuery A secondary query class using the current class as primary query
     */
    public function useTsUserUsrQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTsUserUsr($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TsUserUsr', 'TsUserUsrQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TsImageImg $tsImageImg Object to remove from the list of results
     *
     * @return TsImageImgQuery The current query, for fluid interface
     */
    public function prune($tsImageImg = null)
    {
        if ($tsImageImg) {
            $this->addUsingAlias(TsImageImgPeer::IMG_ID, $tsImageImg->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
