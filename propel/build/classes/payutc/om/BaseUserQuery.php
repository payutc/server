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
use Payutc\Image;
use Payutc\JUsrGrp;
use Payutc\JUsrMol;
use Payutc\JUsrRig;
use Payutc\MeanOfLogin;
use Payutc\Paybox;
use Payutc\Period;
use Payutc\Point;
use Payutc\Purchase;
use Payutc\Recharge;
use Payutc\Right;
use Payutc\Sherlocks;
use Payutc\User;
use Payutc\UserPeer;
use Payutc\UserQuery;
use Payutc\Virement;

/**
 * Base class that represents a query for the 'ts_user_usr' table.
 *
 *
 *
 * @method UserQuery orderById($order = Criteria::ASC) Order by the usr_id column
 * @method UserQuery orderByPwd($order = Criteria::ASC) Order by the usr_pwd column
 * @method UserQuery orderByFirstname($order = Criteria::ASC) Order by the usr_firstname column
 * @method UserQuery orderByLastname($order = Criteria::ASC) Order by the usr_lastname column
 * @method UserQuery orderByNickname($order = Criteria::ASC) Order by the usr_nickname column
 * @method UserQuery orderByAdult($order = Criteria::ASC) Order by the usr_adult column
 * @method UserQuery orderByMail($order = Criteria::ASC) Order by the usr_mail column
 * @method UserQuery orderByCredit($order = Criteria::ASC) Order by the usr_credit column
 * @method UserQuery orderByImgId($order = Criteria::ASC) Order by the img_id column
 * @method UserQuery orderByTemporary($order = Criteria::ASC) Order by the usr_temporary column
 * @method UserQuery orderByFailAuth($order = Criteria::ASC) Order by the usr_fail_auth column
 * @method UserQuery orderByBlocked($order = Criteria::ASC) Order by the usr_blocked column
 * @method UserQuery orderByMsgPerso($order = Criteria::ASC) Order by the usr_msg_perso column
 *
 * @method UserQuery groupById() Group by the usr_id column
 * @method UserQuery groupByPwd() Group by the usr_pwd column
 * @method UserQuery groupByFirstname() Group by the usr_firstname column
 * @method UserQuery groupByLastname() Group by the usr_lastname column
 * @method UserQuery groupByNickname() Group by the usr_nickname column
 * @method UserQuery groupByAdult() Group by the usr_adult column
 * @method UserQuery groupByMail() Group by the usr_mail column
 * @method UserQuery groupByCredit() Group by the usr_credit column
 * @method UserQuery groupByImgId() Group by the img_id column
 * @method UserQuery groupByTemporary() Group by the usr_temporary column
 * @method UserQuery groupByFailAuth() Group by the usr_fail_auth column
 * @method UserQuery groupByBlocked() Group by the usr_blocked column
 * @method UserQuery groupByMsgPerso() Group by the usr_msg_perso column
 *
 * @method UserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UserQuery leftJoinImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Image relation
 * @method UserQuery rightJoinImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Image relation
 * @method UserQuery innerJoinImage($relationAlias = null) Adds a INNER JOIN clause to the query using the Image relation
 *
 * @method UserQuery leftJoinPaybox($relationAlias = null) Adds a LEFT JOIN clause to the query using the Paybox relation
 * @method UserQuery rightJoinPaybox($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Paybox relation
 * @method UserQuery innerJoinPaybox($relationAlias = null) Adds a INNER JOIN clause to the query using the Paybox relation
 *
 * @method UserQuery leftJoinPurchaseRelatedByUsrIdBuyer($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseRelatedByUsrIdBuyer relation
 * @method UserQuery rightJoinPurchaseRelatedByUsrIdBuyer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseRelatedByUsrIdBuyer relation
 * @method UserQuery innerJoinPurchaseRelatedByUsrIdBuyer($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseRelatedByUsrIdBuyer relation
 *
 * @method UserQuery leftJoinPurchaseRelatedByUsrIdSeller($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseRelatedByUsrIdSeller relation
 * @method UserQuery rightJoinPurchaseRelatedByUsrIdSeller($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseRelatedByUsrIdSeller relation
 * @method UserQuery innerJoinPurchaseRelatedByUsrIdSeller($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseRelatedByUsrIdSeller relation
 *
 * @method UserQuery leftJoinRechargeRelatedByUsrIdBuyer($relationAlias = null) Adds a LEFT JOIN clause to the query using the RechargeRelatedByUsrIdBuyer relation
 * @method UserQuery rightJoinRechargeRelatedByUsrIdBuyer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RechargeRelatedByUsrIdBuyer relation
 * @method UserQuery innerJoinRechargeRelatedByUsrIdBuyer($relationAlias = null) Adds a INNER JOIN clause to the query using the RechargeRelatedByUsrIdBuyer relation
 *
 * @method UserQuery leftJoinRechargeRelatedByUsrIdOperator($relationAlias = null) Adds a LEFT JOIN clause to the query using the RechargeRelatedByUsrIdOperator relation
 * @method UserQuery rightJoinRechargeRelatedByUsrIdOperator($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RechargeRelatedByUsrIdOperator relation
 * @method UserQuery innerJoinRechargeRelatedByUsrIdOperator($relationAlias = null) Adds a INNER JOIN clause to the query using the RechargeRelatedByUsrIdOperator relation
 *
 * @method UserQuery leftJoinSherlocks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sherlocks relation
 * @method UserQuery rightJoinSherlocks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sherlocks relation
 * @method UserQuery innerJoinSherlocks($relationAlias = null) Adds a INNER JOIN clause to the query using the Sherlocks relation
 *
 * @method UserQuery leftJoinVirementRelatedByUsrIdTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the VirementRelatedByUsrIdTo relation
 * @method UserQuery rightJoinVirementRelatedByUsrIdTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VirementRelatedByUsrIdTo relation
 * @method UserQuery innerJoinVirementRelatedByUsrIdTo($relationAlias = null) Adds a INNER JOIN clause to the query using the VirementRelatedByUsrIdTo relation
 *
 * @method UserQuery leftJoinVirementRelatedByUsrIdFrom($relationAlias = null) Adds a LEFT JOIN clause to the query using the VirementRelatedByUsrIdFrom relation
 * @method UserQuery rightJoinVirementRelatedByUsrIdFrom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VirementRelatedByUsrIdFrom relation
 * @method UserQuery innerJoinVirementRelatedByUsrIdFrom($relationAlias = null) Adds a INNER JOIN clause to the query using the VirementRelatedByUsrIdFrom relation
 *
 * @method UserQuery leftJoinJUsrGrp($relationAlias = null) Adds a LEFT JOIN clause to the query using the JUsrGrp relation
 * @method UserQuery rightJoinJUsrGrp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JUsrGrp relation
 * @method UserQuery innerJoinJUsrGrp($relationAlias = null) Adds a INNER JOIN clause to the query using the JUsrGrp relation
 *
 * @method UserQuery leftJoinJUsrMol($relationAlias = null) Adds a LEFT JOIN clause to the query using the JUsrMol relation
 * @method UserQuery rightJoinJUsrMol($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JUsrMol relation
 * @method UserQuery innerJoinJUsrMol($relationAlias = null) Adds a INNER JOIN clause to the query using the JUsrMol relation
 *
 * @method UserQuery leftJoinJUsrRig($relationAlias = null) Adds a LEFT JOIN clause to the query using the JUsrRig relation
 * @method UserQuery rightJoinJUsrRig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JUsrRig relation
 * @method UserQuery innerJoinJUsrRig($relationAlias = null) Adds a INNER JOIN clause to the query using the JUsrRig relation
 *
 * @method User findOne(PropelPDO $con = null) Return the first User matching the query
 * @method User findOneOrCreate(PropelPDO $con = null) Return the first User matching the query, or a new User object populated from the query conditions when no match is found
 *
 * @method User findOneByPwd(string $usr_pwd) Return the first User filtered by the usr_pwd column
 * @method User findOneByFirstname(string $usr_firstname) Return the first User filtered by the usr_firstname column
 * @method User findOneByLastname(string $usr_lastname) Return the first User filtered by the usr_lastname column
 * @method User findOneByNickname(string $usr_nickname) Return the first User filtered by the usr_nickname column
 * @method User findOneByAdult(int $usr_adult) Return the first User filtered by the usr_adult column
 * @method User findOneByMail(string $usr_mail) Return the first User filtered by the usr_mail column
 * @method User findOneByCredit(int $usr_credit) Return the first User filtered by the usr_credit column
 * @method User findOneByImgId(int $img_id) Return the first User filtered by the img_id column
 * @method User findOneByTemporary(boolean $usr_temporary) Return the first User filtered by the usr_temporary column
 * @method User findOneByFailAuth(boolean $usr_fail_auth) Return the first User filtered by the usr_fail_auth column
 * @method User findOneByBlocked(boolean $usr_blocked) Return the first User filtered by the usr_blocked column
 * @method User findOneByMsgPerso(string $usr_msg_perso) Return the first User filtered by the usr_msg_perso column
 *
 * @method array findById(int $usr_id) Return User objects filtered by the usr_id column
 * @method array findByPwd(string $usr_pwd) Return User objects filtered by the usr_pwd column
 * @method array findByFirstname(string $usr_firstname) Return User objects filtered by the usr_firstname column
 * @method array findByLastname(string $usr_lastname) Return User objects filtered by the usr_lastname column
 * @method array findByNickname(string $usr_nickname) Return User objects filtered by the usr_nickname column
 * @method array findByAdult(int $usr_adult) Return User objects filtered by the usr_adult column
 * @method array findByMail(string $usr_mail) Return User objects filtered by the usr_mail column
 * @method array findByCredit(int $usr_credit) Return User objects filtered by the usr_credit column
 * @method array findByImgId(int $img_id) Return User objects filtered by the img_id column
 * @method array findByTemporary(boolean $usr_temporary) Return User objects filtered by the usr_temporary column
 * @method array findByFailAuth(boolean $usr_fail_auth) Return User objects filtered by the usr_fail_auth column
 * @method array findByBlocked(boolean $usr_blocked) Return User objects filtered by the usr_blocked column
 * @method array findByMsgPerso(string $usr_msg_perso) Return User objects filtered by the usr_msg_perso column
 *
 * @package    propel.generator.payutc.om
 */
abstract class BaseUserQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUserQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc', $modelName = 'Payutc\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     UserQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UserQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UserQuery) {
            return $criteria;
        }
        $query = new UserQuery();
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
     * @return   User|User[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   User A model object, or null if the key is not found
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
     * @return   User A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `USR_ID`, `USR_PWD`, `USR_FIRSTNAME`, `USR_LASTNAME`, `USR_NICKNAME`, `USR_ADULT`, `USR_MAIL`, `USR_CREDIT`, `IMG_ID`, `USR_TEMPORARY`, `USR_FAIL_AUTH`, `USR_BLOCKED`, `USR_MSG_PERSO` FROM `ts_user_usr` WHERE `USR_ID` = :p0';
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
            $obj = new User();
            $obj->hydrate($row);
            UserPeer::addInstanceToPool($obj, (string) $key);
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
     * @return User|User[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|User[]|mixed the list of results, formatted by the current formatter
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserPeer::USR_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserPeer::USR_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the usr_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE usr_id = 1234
     * $query->filterById(array(12, 34)); // WHERE usr_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE usr_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(UserPeer::USR_ID, $id, $comparison);
    }

    /**
     * Filter the query on the usr_pwd column
     *
     * Example usage:
     * <code>
     * $query->filterByPwd('fooValue');   // WHERE usr_pwd = 'fooValue'
     * $query->filterByPwd('%fooValue%'); // WHERE usr_pwd LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pwd The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPwd($pwd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pwd)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pwd)) {
                $pwd = str_replace('*', '%', $pwd);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_PWD, $pwd, $comparison);
    }

    /**
     * Filter the query on the usr_firstname column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstname('fooValue');   // WHERE usr_firstname = 'fooValue'
     * $query->filterByFirstname('%fooValue%'); // WHERE usr_firstname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByFirstname($firstname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstname)) {
                $firstname = str_replace('*', '%', $firstname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_FIRSTNAME, $firstname, $comparison);
    }

    /**
     * Filter the query on the usr_lastname column
     *
     * Example usage:
     * <code>
     * $query->filterByLastname('fooValue');   // WHERE usr_lastname = 'fooValue'
     * $query->filterByLastname('%fooValue%'); // WHERE usr_lastname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByLastname($lastname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastname)) {
                $lastname = str_replace('*', '%', $lastname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_LASTNAME, $lastname, $comparison);
    }

    /**
     * Filter the query on the usr_nickname column
     *
     * Example usage:
     * <code>
     * $query->filterByNickname('fooValue');   // WHERE usr_nickname = 'fooValue'
     * $query->filterByNickname('%fooValue%'); // WHERE usr_nickname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nickname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByNickname($nickname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nickname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nickname)) {
                $nickname = str_replace('*', '%', $nickname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_NICKNAME, $nickname, $comparison);
    }

    /**
     * Filter the query on the usr_adult column
     *
     * Example usage:
     * <code>
     * $query->filterByAdult(1234); // WHERE usr_adult = 1234
     * $query->filterByAdult(array(12, 34)); // WHERE usr_adult IN (12, 34)
     * $query->filterByAdult(array('min' => 12)); // WHERE usr_adult > 12
     * </code>
     *
     * @param     mixed $adult The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByAdult($adult = null, $comparison = null)
    {
        if (is_array($adult)) {
            $useMinMax = false;
            if (isset($adult['min'])) {
                $this->addUsingAlias(UserPeer::USR_ADULT, $adult['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($adult['max'])) {
                $this->addUsingAlias(UserPeer::USR_ADULT, $adult['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_ADULT, $adult, $comparison);
    }

    /**
     * Filter the query on the usr_mail column
     *
     * Example usage:
     * <code>
     * $query->filterByMail('fooValue');   // WHERE usr_mail = 'fooValue'
     * $query->filterByMail('%fooValue%'); // WHERE usr_mail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByMail($mail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mail)) {
                $mail = str_replace('*', '%', $mail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_MAIL, $mail, $comparison);
    }

    /**
     * Filter the query on the usr_credit column
     *
     * Example usage:
     * <code>
     * $query->filterByCredit(1234); // WHERE usr_credit = 1234
     * $query->filterByCredit(array(12, 34)); // WHERE usr_credit IN (12, 34)
     * $query->filterByCredit(array('min' => 12)); // WHERE usr_credit > 12
     * </code>
     *
     * @param     mixed $credit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByCredit($credit = null, $comparison = null)
    {
        if (is_array($credit)) {
            $useMinMax = false;
            if (isset($credit['min'])) {
                $this->addUsingAlias(UserPeer::USR_CREDIT, $credit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($credit['max'])) {
                $this->addUsingAlias(UserPeer::USR_CREDIT, $credit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_CREDIT, $credit, $comparison);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByImgId($imgId = null, $comparison = null)
    {
        if (is_array($imgId)) {
            $useMinMax = false;
            if (isset($imgId['min'])) {
                $this->addUsingAlias(UserPeer::IMG_ID, $imgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($imgId['max'])) {
                $this->addUsingAlias(UserPeer::IMG_ID, $imgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::IMG_ID, $imgId, $comparison);
    }

    /**
     * Filter the query on the usr_temporary column
     *
     * Example usage:
     * <code>
     * $query->filterByTemporary(true); // WHERE usr_temporary = true
     * $query->filterByTemporary('yes'); // WHERE usr_temporary = true
     * </code>
     *
     * @param     boolean|string $temporary The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByTemporary($temporary = null, $comparison = null)
    {
        if (is_string($temporary)) {
            $usr_temporary = in_array(strtolower($temporary), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserPeer::USR_TEMPORARY, $temporary, $comparison);
    }

    /**
     * Filter the query on the usr_fail_auth column
     *
     * Example usage:
     * <code>
     * $query->filterByFailAuth(true); // WHERE usr_fail_auth = true
     * $query->filterByFailAuth('yes'); // WHERE usr_fail_auth = true
     * </code>
     *
     * @param     boolean|string $failAuth The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByFailAuth($failAuth = null, $comparison = null)
    {
        if (is_string($failAuth)) {
            $usr_fail_auth = in_array(strtolower($failAuth), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserPeer::USR_FAIL_AUTH, $failAuth, $comparison);
    }

    /**
     * Filter the query on the usr_blocked column
     *
     * Example usage:
     * <code>
     * $query->filterByBlocked(true); // WHERE usr_blocked = true
     * $query->filterByBlocked('yes'); // WHERE usr_blocked = true
     * </code>
     *
     * @param     boolean|string $blocked The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByBlocked($blocked = null, $comparison = null)
    {
        if (is_string($blocked)) {
            $usr_blocked = in_array(strtolower($blocked), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserPeer::USR_BLOCKED, $blocked, $comparison);
    }

    /**
     * Filter the query on the usr_msg_perso column
     *
     * Example usage:
     * <code>
     * $query->filterByMsgPerso('fooValue');   // WHERE usr_msg_perso = 'fooValue'
     * $query->filterByMsgPerso('%fooValue%'); // WHERE usr_msg_perso LIKE '%fooValue%'
     * </code>
     *
     * @param     string $msgPerso The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByMsgPerso($msgPerso = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($msgPerso)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $msgPerso)) {
                $msgPerso = str_replace('*', '%', $msgPerso);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_MSG_PERSO, $msgPerso, $comparison);
    }

    /**
     * Filter the query by a related Image object
     *
     * @param   Image|PropelObjectCollection $image The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByImage($image, $comparison = null)
    {
        if ($image instanceof Image) {
            return $this
                ->addUsingAlias(UserPeer::IMG_ID, $image->getId(), $comparison);
        } elseif ($image instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserPeer::IMG_ID, $image->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return UserQuery The current query, for fluid interface
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
     * Filter the query by a related Paybox object
     *
     * @param   Paybox|PropelObjectCollection $paybox  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPaybox($paybox, $comparison = null)
    {
        if ($paybox instanceof Paybox) {
            return $this
                ->addUsingAlias(UserPeer::USR_ID, $paybox->getUsrId(), $comparison);
        } elseif ($paybox instanceof PropelObjectCollection) {
            return $this
                ->usePayboxQuery()
                ->filterByPrimaryKeys($paybox->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPaybox() only accepts arguments of type Paybox or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Paybox relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinPaybox($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Paybox');

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
            $this->addJoinObject($join, 'Paybox');
        }

        return $this;
    }

    /**
     * Use the Paybox relation Paybox object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\PayboxQuery A secondary query class using the current class as primary query
     */
    public function usePayboxQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPaybox($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Paybox', '\Payutc\PayboxQuery');
    }

    /**
     * Filter the query by a related Purchase object
     *
     * @param   Purchase|PropelObjectCollection $purchase  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPurchaseRelatedByUsrIdBuyer($purchase, $comparison = null)
    {
        if ($purchase instanceof Purchase) {
            return $this
                ->addUsingAlias(UserPeer::USR_ID, $purchase->getUsrIdBuyer(), $comparison);
        } elseif ($purchase instanceof PropelObjectCollection) {
            return $this
                ->usePurchaseRelatedByUsrIdBuyerQuery()
                ->filterByPrimaryKeys($purchase->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPurchaseRelatedByUsrIdBuyer() only accepts arguments of type Purchase or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PurchaseRelatedByUsrIdBuyer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinPurchaseRelatedByUsrIdBuyer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PurchaseRelatedByUsrIdBuyer');

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
            $this->addJoinObject($join, 'PurchaseRelatedByUsrIdBuyer');
        }

        return $this;
    }

    /**
     * Use the PurchaseRelatedByUsrIdBuyer relation Purchase object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\PurchaseQuery A secondary query class using the current class as primary query
     */
    public function usePurchaseRelatedByUsrIdBuyerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPurchaseRelatedByUsrIdBuyer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PurchaseRelatedByUsrIdBuyer', '\Payutc\PurchaseQuery');
    }

    /**
     * Filter the query by a related Purchase object
     *
     * @param   Purchase|PropelObjectCollection $purchase  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPurchaseRelatedByUsrIdSeller($purchase, $comparison = null)
    {
        if ($purchase instanceof Purchase) {
            return $this
                ->addUsingAlias(UserPeer::USR_ID, $purchase->getUsrIdSeller(), $comparison);
        } elseif ($purchase instanceof PropelObjectCollection) {
            return $this
                ->usePurchaseRelatedByUsrIdSellerQuery()
                ->filterByPrimaryKeys($purchase->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPurchaseRelatedByUsrIdSeller() only accepts arguments of type Purchase or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PurchaseRelatedByUsrIdSeller relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinPurchaseRelatedByUsrIdSeller($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PurchaseRelatedByUsrIdSeller');

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
            $this->addJoinObject($join, 'PurchaseRelatedByUsrIdSeller');
        }

        return $this;
    }

    /**
     * Use the PurchaseRelatedByUsrIdSeller relation Purchase object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\PurchaseQuery A secondary query class using the current class as primary query
     */
    public function usePurchaseRelatedByUsrIdSellerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPurchaseRelatedByUsrIdSeller($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PurchaseRelatedByUsrIdSeller', '\Payutc\PurchaseQuery');
    }

    /**
     * Filter the query by a related Recharge object
     *
     * @param   Recharge|PropelObjectCollection $recharge  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByRechargeRelatedByUsrIdBuyer($recharge, $comparison = null)
    {
        if ($recharge instanceof Recharge) {
            return $this
                ->addUsingAlias(UserPeer::USR_ID, $recharge->getUsrIdBuyer(), $comparison);
        } elseif ($recharge instanceof PropelObjectCollection) {
            return $this
                ->useRechargeRelatedByUsrIdBuyerQuery()
                ->filterByPrimaryKeys($recharge->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRechargeRelatedByUsrIdBuyer() only accepts arguments of type Recharge or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RechargeRelatedByUsrIdBuyer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinRechargeRelatedByUsrIdBuyer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RechargeRelatedByUsrIdBuyer');

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
            $this->addJoinObject($join, 'RechargeRelatedByUsrIdBuyer');
        }

        return $this;
    }

    /**
     * Use the RechargeRelatedByUsrIdBuyer relation Recharge object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\RechargeQuery A secondary query class using the current class as primary query
     */
    public function useRechargeRelatedByUsrIdBuyerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRechargeRelatedByUsrIdBuyer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RechargeRelatedByUsrIdBuyer', '\Payutc\RechargeQuery');
    }

    /**
     * Filter the query by a related Recharge object
     *
     * @param   Recharge|PropelObjectCollection $recharge  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByRechargeRelatedByUsrIdOperator($recharge, $comparison = null)
    {
        if ($recharge instanceof Recharge) {
            return $this
                ->addUsingAlias(UserPeer::USR_ID, $recharge->getUsrIdOperator(), $comparison);
        } elseif ($recharge instanceof PropelObjectCollection) {
            return $this
                ->useRechargeRelatedByUsrIdOperatorQuery()
                ->filterByPrimaryKeys($recharge->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRechargeRelatedByUsrIdOperator() only accepts arguments of type Recharge or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RechargeRelatedByUsrIdOperator relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinRechargeRelatedByUsrIdOperator($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RechargeRelatedByUsrIdOperator');

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
            $this->addJoinObject($join, 'RechargeRelatedByUsrIdOperator');
        }

        return $this;
    }

    /**
     * Use the RechargeRelatedByUsrIdOperator relation Recharge object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\RechargeQuery A secondary query class using the current class as primary query
     */
    public function useRechargeRelatedByUsrIdOperatorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRechargeRelatedByUsrIdOperator($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RechargeRelatedByUsrIdOperator', '\Payutc\RechargeQuery');
    }

    /**
     * Filter the query by a related Sherlocks object
     *
     * @param   Sherlocks|PropelObjectCollection $sherlocks  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySherlocks($sherlocks, $comparison = null)
    {
        if ($sherlocks instanceof Sherlocks) {
            return $this
                ->addUsingAlias(UserPeer::USR_ID, $sherlocks->getUsrId(), $comparison);
        } elseif ($sherlocks instanceof PropelObjectCollection) {
            return $this
                ->useSherlocksQuery()
                ->filterByPrimaryKeys($sherlocks->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySherlocks() only accepts arguments of type Sherlocks or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Sherlocks relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinSherlocks($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Sherlocks');

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
            $this->addJoinObject($join, 'Sherlocks');
        }

        return $this;
    }

    /**
     * Use the Sherlocks relation Sherlocks object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\SherlocksQuery A secondary query class using the current class as primary query
     */
    public function useSherlocksQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSherlocks($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Sherlocks', '\Payutc\SherlocksQuery');
    }

    /**
     * Filter the query by a related Virement object
     *
     * @param   Virement|PropelObjectCollection $virement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByVirementRelatedByUsrIdTo($virement, $comparison = null)
    {
        if ($virement instanceof Virement) {
            return $this
                ->addUsingAlias(UserPeer::USR_ID, $virement->getUsrIdTo(), $comparison);
        } elseif ($virement instanceof PropelObjectCollection) {
            return $this
                ->useVirementRelatedByUsrIdToQuery()
                ->filterByPrimaryKeys($virement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVirementRelatedByUsrIdTo() only accepts arguments of type Virement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VirementRelatedByUsrIdTo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinVirementRelatedByUsrIdTo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VirementRelatedByUsrIdTo');

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
            $this->addJoinObject($join, 'VirementRelatedByUsrIdTo');
        }

        return $this;
    }

    /**
     * Use the VirementRelatedByUsrIdTo relation Virement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\VirementQuery A secondary query class using the current class as primary query
     */
    public function useVirementRelatedByUsrIdToQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVirementRelatedByUsrIdTo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VirementRelatedByUsrIdTo', '\Payutc\VirementQuery');
    }

    /**
     * Filter the query by a related Virement object
     *
     * @param   Virement|PropelObjectCollection $virement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByVirementRelatedByUsrIdFrom($virement, $comparison = null)
    {
        if ($virement instanceof Virement) {
            return $this
                ->addUsingAlias(UserPeer::USR_ID, $virement->getUsrIdFrom(), $comparison);
        } elseif ($virement instanceof PropelObjectCollection) {
            return $this
                ->useVirementRelatedByUsrIdFromQuery()
                ->filterByPrimaryKeys($virement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVirementRelatedByUsrIdFrom() only accepts arguments of type Virement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VirementRelatedByUsrIdFrom relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinVirementRelatedByUsrIdFrom($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VirementRelatedByUsrIdFrom');

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
            $this->addJoinObject($join, 'VirementRelatedByUsrIdFrom');
        }

        return $this;
    }

    /**
     * Use the VirementRelatedByUsrIdFrom relation Virement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\VirementQuery A secondary query class using the current class as primary query
     */
    public function useVirementRelatedByUsrIdFromQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVirementRelatedByUsrIdFrom($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VirementRelatedByUsrIdFrom', '\Payutc\VirementQuery');
    }

    /**
     * Filter the query by a related JUsrGrp object
     *
     * @param   JUsrGrp|PropelObjectCollection $jUsrGrp  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJUsrGrp($jUsrGrp, $comparison = null)
    {
        if ($jUsrGrp instanceof JUsrGrp) {
            return $this
                ->addUsingAlias(UserPeer::USR_ID, $jUsrGrp->getUsrId(), $comparison);
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
     * @return UserQuery The current query, for fluid interface
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
     * Filter the query by a related JUsrMol object
     *
     * @param   JUsrMol|PropelObjectCollection $jUsrMol  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJUsrMol($jUsrMol, $comparison = null)
    {
        if ($jUsrMol instanceof JUsrMol) {
            return $this
                ->addUsingAlias(UserPeer::USR_ID, $jUsrMol->getUsrId(), $comparison);
        } elseif ($jUsrMol instanceof PropelObjectCollection) {
            return $this
                ->useJUsrMolQuery()
                ->filterByPrimaryKeys($jUsrMol->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJUsrMol() only accepts arguments of type JUsrMol or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JUsrMol relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinJUsrMol($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JUsrMol');

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
            $this->addJoinObject($join, 'JUsrMol');
        }

        return $this;
    }

    /**
     * Use the JUsrMol relation JUsrMol object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\JUsrMolQuery A secondary query class using the current class as primary query
     */
    public function useJUsrMolQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJUsrMol($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JUsrMol', '\Payutc\JUsrMolQuery');
    }

    /**
     * Filter the query by a related JUsrRig object
     *
     * @param   JUsrRig|PropelObjectCollection $jUsrRig  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByJUsrRig($jUsrRig, $comparison = null)
    {
        if ($jUsrRig instanceof JUsrRig) {
            return $this
                ->addUsingAlias(UserPeer::USR_ID, $jUsrRig->getUsrId(), $comparison);
        } elseif ($jUsrRig instanceof PropelObjectCollection) {
            return $this
                ->useJUsrRigQuery()
                ->filterByPrimaryKeys($jUsrRig->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByJUsrRig() only accepts arguments of type JUsrRig or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the JUsrRig relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinJUsrRig($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('JUsrRig');

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
            $this->addJoinObject($join, 'JUsrRig');
        }

        return $this;
    }

    /**
     * Use the JUsrRig relation JUsrRig object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Payutc\JUsrRigQuery A secondary query class using the current class as primary query
     */
    public function useJUsrRigQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJUsrRig($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'JUsrRig', '\Payutc\JUsrRigQuery');
    }

    /**
     * Filter the query by a related Period object
     * using the tj_usr_grp_jug table as cross reference
     *
     * @param   Period $period the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     */
    public function filterByPeriod($period, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrGrpQuery()
            ->filterByPeriod($period, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Group object
     * using the tj_usr_grp_jug table as cross reference
     *
     * @param   Group $group the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     */
    public function filterByGroup($group, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrGrpQuery()
            ->filterByGroup($group, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related MeanOfLogin object
     * using the tj_usr_mol_jum table as cross reference
     *
     * @param   MeanOfLogin $meanOfLogin the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     */
    public function filterByMeanOfLogin($meanOfLogin, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrMolQuery()
            ->filterByMeanOfLogin($meanOfLogin, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Period object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   Period $period the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     */
    public function filterByJurPeriod($period, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrRigQuery()
            ->filterByJurPeriod($period, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Right object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   Right $right the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     */
    public function filterByRight($right, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrRigQuery()
            ->filterByRight($right, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Fundation object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   Fundation $fundation the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     */
    public function filterByFundation($fundation, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrRigQuery()
            ->filterByFundation($fundation, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Point object
     * using the tj_usr_rig_jur table as cross reference
     *
     * @param   Point $point the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     */
    public function filterByPoint($point, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useJUsrRigQuery()
            ->filterByPoint($point, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   User $user Object to remove from the list of results
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserPeer::USR_ID, $user->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
