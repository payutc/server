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
use Payutc\Image;
use Payutc\ImagePeer;
use Payutc\ImageQuery;
use Payutc\Item;
use Payutc\User;

/**
 * Base class that represents a query for the 'ts_image_img' table.
 *
 *
 *
 * @method ImageQuery orderById($order = Criteria::ASC) Order by the img_id column
 * @method ImageQuery orderByMime($order = Criteria::ASC) Order by the img_mime column
 * @method ImageQuery orderByWidth($order = Criteria::ASC) Order by the img_width column
 * @method ImageQuery orderByLength($order = Criteria::ASC) Order by the img_length column
 * @method ImageQuery orderByContent($order = Criteria::ASC) Order by the img_content column
 * @method ImageQuery orderByRemoved($order = Criteria::ASC) Order by the img_removed column
 *
 * @method ImageQuery groupById() Group by the img_id column
 * @method ImageQuery groupByMime() Group by the img_mime column
 * @method ImageQuery groupByWidth() Group by the img_width column
 * @method ImageQuery groupByLength() Group by the img_length column
 * @method ImageQuery groupByContent() Group by the img_content column
 * @method ImageQuery groupByRemoved() Group by the img_removed column
 *
 * @method ImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ImageQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method ImageQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method ImageQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method ImageQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method ImageQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method ImageQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method Image findOne(PropelPDO $con = null) Return the first Image matching the query
 * @method Image findOneOrCreate(PropelPDO $con = null) Return the first Image matching the query, or a new Image object populated from the query conditions when no match is found
 *
 * @method Image findOneByMime(string $img_mime) Return the first Image filtered by the img_mime column
 * @method Image findOneByWidth(int $img_width) Return the first Image filtered by the img_width column
 * @method Image findOneByLength(int $img_length) Return the first Image filtered by the img_length column
 * @method Image findOneByContent(resource $img_content) Return the first Image filtered by the img_content column
 * @method Image findOneByRemoved(boolean $img_removed) Return the first Image filtered by the img_removed column
 *
 * @method array findById(int $img_id) Return Image objects filtered by the img_id column
 * @method array findByMime(string $img_mime) Return Image objects filtered by the img_mime column
 * @method array findByWidth(int $img_width) Return Image objects filtered by the img_width column
 * @method array findByLength(int $img_length) Return Image objects filtered by the img_length column
 * @method array findByContent(resource $img_content) Return Image objects filtered by the img_content column
 * @method array findByRemoved(boolean $img_removed) Return Image objects filtered by the img_removed column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseImageQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseImageQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\Image', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ImageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ImageQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ImageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ImageQuery) {
            return $criteria;
        }
        $query = new ImageQuery();
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
     * @return   Image|Image[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ImagePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ImagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Image A model object, or null if the key is not found
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
     * @return   Image A model object, or null if the key is not found
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
            $obj = new Image();
            $obj->hydrate($row);
            ImagePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Image|Image[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Image[]|mixed the list of results, formatted by the current formatter
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
     * @return ImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ImagePeer::IMG_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ImagePeer::IMG_ID, $keys, Criteria::IN);
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
     * @return ImageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ImagePeer::IMG_ID, $id, $comparison);
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
     * @return ImageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ImagePeer::IMG_MIME, $mime, $comparison);
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
     * @return ImageQuery The current query, for fluid interface
     */
    public function filterByWidth($width = null, $comparison = null)
    {
        if (is_array($width)) {
            $useMinMax = false;
            if (isset($width['min'])) {
                $this->addUsingAlias(ImagePeer::IMG_WIDTH, $width['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($width['max'])) {
                $this->addUsingAlias(ImagePeer::IMG_WIDTH, $width['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ImagePeer::IMG_WIDTH, $width, $comparison);
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
     * @return ImageQuery The current query, for fluid interface
     */
    public function filterByLength($length = null, $comparison = null)
    {
        if (is_array($length)) {
            $useMinMax = false;
            if (isset($length['min'])) {
                $this->addUsingAlias(ImagePeer::IMG_LENGTH, $length['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($length['max'])) {
                $this->addUsingAlias(ImagePeer::IMG_LENGTH, $length['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ImagePeer::IMG_LENGTH, $length, $comparison);
    }

    /**
     * Filter the query on the img_content column
     *
     * @param     mixed $content The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ImageQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {

        return $this->addUsingAlias(ImagePeer::IMG_CONTENT, $content, $comparison);
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
     * @return ImageQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $img_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ImagePeer::IMG_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related Item object
     *
     * @param   Item|PropelObjectCollection $item  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ImageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByItem($item, $comparison = null)
    {
        if ($item instanceof Item) {
            return $this
                ->addUsingAlias(ImagePeer::IMG_ID, $item->getImgId(), $comparison);
        } elseif ($item instanceof PropelObjectCollection) {
            return $this
                ->useItemQuery()
                ->filterByPrimaryKeys($item->getPrimaryKeys())
                ->endUse();
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
     * @return ImageQuery The current query, for fluid interface
     */
    public function joinItem($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useItemQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Item', '\Payutc\ItemQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ImageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(ImagePeer::IMG_ID, $user->getImgId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            return $this
                ->useUserQuery()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();
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
     * @return ImageQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\Payutc\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Image $image Object to remove from the list of results
     *
     * @return ImageQuery The current query, for fluid interface
     */
    public function prune($image = null)
    {
        if ($image) {
            $this->addUsingAlias(ImagePeer::IMG_ID, $image->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
