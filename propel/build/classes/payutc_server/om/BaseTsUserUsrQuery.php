<?php


/**
 * Base class that represents a query for the 'ts_user_usr' table.
 *
 *
 *
 * @method TsUserUsrQuery orderById($order = Criteria::ASC) Order by the usr_id column
 * @method TsUserUsrQuery orderByPwd($order = Criteria::ASC) Order by the usr_pwd column
 * @method TsUserUsrQuery orderByFirstname($order = Criteria::ASC) Order by the usr_firstname column
 * @method TsUserUsrQuery orderByLastname($order = Criteria::ASC) Order by the usr_lastname column
 * @method TsUserUsrQuery orderByNickname($order = Criteria::ASC) Order by the usr_nickname column
 * @method TsUserUsrQuery orderByAdult($order = Criteria::ASC) Order by the usr_adult column
 * @method TsUserUsrQuery orderByMail($order = Criteria::ASC) Order by the usr_mail column
 * @method TsUserUsrQuery orderByCredit($order = Criteria::ASC) Order by the usr_credit column
 * @method TsUserUsrQuery orderByImgId($order = Criteria::ASC) Order by the img_id column
 * @method TsUserUsrQuery orderByTemporary($order = Criteria::ASC) Order by the usr_temporary column
 * @method TsUserUsrQuery orderByFailAuth($order = Criteria::ASC) Order by the usr_fail_auth column
 * @method TsUserUsrQuery orderByBlocked($order = Criteria::ASC) Order by the usr_blocked column
 * @method TsUserUsrQuery orderByMsgPerso($order = Criteria::ASC) Order by the usr_msg_perso column
 *
 * @method TsUserUsrQuery groupById() Group by the usr_id column
 * @method TsUserUsrQuery groupByPwd() Group by the usr_pwd column
 * @method TsUserUsrQuery groupByFirstname() Group by the usr_firstname column
 * @method TsUserUsrQuery groupByLastname() Group by the usr_lastname column
 * @method TsUserUsrQuery groupByNickname() Group by the usr_nickname column
 * @method TsUserUsrQuery groupByAdult() Group by the usr_adult column
 * @method TsUserUsrQuery groupByMail() Group by the usr_mail column
 * @method TsUserUsrQuery groupByCredit() Group by the usr_credit column
 * @method TsUserUsrQuery groupByImgId() Group by the img_id column
 * @method TsUserUsrQuery groupByTemporary() Group by the usr_temporary column
 * @method TsUserUsrQuery groupByFailAuth() Group by the usr_fail_auth column
 * @method TsUserUsrQuery groupByBlocked() Group by the usr_blocked column
 * @method TsUserUsrQuery groupByMsgPerso() Group by the usr_msg_perso column
 *
 * @method TsUserUsrQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TsUserUsrQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TsUserUsrQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TsUserUsrQuery leftJoinTsImageImg($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsImageImg relation
 * @method TsUserUsrQuery rightJoinTsImageImg($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsImageImg relation
 * @method TsUserUsrQuery innerJoinTsImageImg($relationAlias = null) Adds a INNER JOIN clause to the query using the TsImageImg relation
 *
 * @method TsUserUsrQuery leftJoinTPayboxPay($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPayboxPay relation
 * @method TsUserUsrQuery rightJoinTPayboxPay($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPayboxPay relation
 * @method TsUserUsrQuery innerJoinTPayboxPay($relationAlias = null) Adds a INNER JOIN clause to the query using the TPayboxPay relation
 *
 * @method TsUserUsrQuery leftJoinTPurchasePurRelatedByUsrIdBuyer($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPurchasePurRelatedByUsrIdBuyer relation
 * @method TsUserUsrQuery rightJoinTPurchasePurRelatedByUsrIdBuyer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPurchasePurRelatedByUsrIdBuyer relation
 * @method TsUserUsrQuery innerJoinTPurchasePurRelatedByUsrIdBuyer($relationAlias = null) Adds a INNER JOIN clause to the query using the TPurchasePurRelatedByUsrIdBuyer relation
 *
 * @method TsUserUsrQuery leftJoinTPurchasePurRelatedByUsrIdSeller($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPurchasePurRelatedByUsrIdSeller relation
 * @method TsUserUsrQuery rightJoinTPurchasePurRelatedByUsrIdSeller($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPurchasePurRelatedByUsrIdSeller relation
 * @method TsUserUsrQuery innerJoinTPurchasePurRelatedByUsrIdSeller($relationAlias = null) Adds a INNER JOIN clause to the query using the TPurchasePurRelatedByUsrIdSeller relation
 *
 * @method TsUserUsrQuery leftJoinTRechargeRecRelatedByUsrIdBuyer($relationAlias = null) Adds a LEFT JOIN clause to the query using the TRechargeRecRelatedByUsrIdBuyer relation
 * @method TsUserUsrQuery rightJoinTRechargeRecRelatedByUsrIdBuyer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TRechargeRecRelatedByUsrIdBuyer relation
 * @method TsUserUsrQuery innerJoinTRechargeRecRelatedByUsrIdBuyer($relationAlias = null) Adds a INNER JOIN clause to the query using the TRechargeRecRelatedByUsrIdBuyer relation
 *
 * @method TsUserUsrQuery leftJoinTRechargeRecRelatedByUsrIdOperator($relationAlias = null) Adds a LEFT JOIN clause to the query using the TRechargeRecRelatedByUsrIdOperator relation
 * @method TsUserUsrQuery rightJoinTRechargeRecRelatedByUsrIdOperator($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TRechargeRecRelatedByUsrIdOperator relation
 * @method TsUserUsrQuery innerJoinTRechargeRecRelatedByUsrIdOperator($relationAlias = null) Adds a INNER JOIN clause to the query using the TRechargeRecRelatedByUsrIdOperator relation
 *
 * @method TsUserUsrQuery leftJoinTSherlocksShe($relationAlias = null) Adds a LEFT JOIN clause to the query using the TSherlocksShe relation
 * @method TsUserUsrQuery rightJoinTSherlocksShe($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TSherlocksShe relation
 * @method TsUserUsrQuery innerJoinTSherlocksShe($relationAlias = null) Adds a INNER JOIN clause to the query using the TSherlocksShe relation
 *
 * @method TsUserUsrQuery leftJoinTVirementVirRelatedByUsrIdTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the TVirementVirRelatedByUsrIdTo relation
 * @method TsUserUsrQuery rightJoinTVirementVirRelatedByUsrIdTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TVirementVirRelatedByUsrIdTo relation
 * @method TsUserUsrQuery innerJoinTVirementVirRelatedByUsrIdTo($relationAlias = null) Adds a INNER JOIN clause to the query using the TVirementVirRelatedByUsrIdTo relation
 *
 * @method TsUserUsrQuery leftJoinTVirementVirRelatedByUsrIdFrom($relationAlias = null) Adds a LEFT JOIN clause to the query using the TVirementVirRelatedByUsrIdFrom relation
 * @method TsUserUsrQuery rightJoinTVirementVirRelatedByUsrIdFrom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TVirementVirRelatedByUsrIdFrom relation
 * @method TsUserUsrQuery innerJoinTVirementVirRelatedByUsrIdFrom($relationAlias = null) Adds a INNER JOIN clause to the query using the TVirementVirRelatedByUsrIdFrom relation
 *
 * @method TsUserUsrQuery leftJoinTjUsrGrpJug($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjUsrGrpJug relation
 * @method TsUserUsrQuery rightJoinTjUsrGrpJug($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjUsrGrpJug relation
 * @method TsUserUsrQuery innerJoinTjUsrGrpJug($relationAlias = null) Adds a INNER JOIN clause to the query using the TjUsrGrpJug relation
 *
 * @method TsUserUsrQuery leftJoinTjUsrMolJum($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjUsrMolJum relation
 * @method TsUserUsrQuery rightJoinTjUsrMolJum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjUsrMolJum relation
 * @method TsUserUsrQuery innerJoinTjUsrMolJum($relationAlias = null) Adds a INNER JOIN clause to the query using the TjUsrMolJum relation
 *
 * @method TsUserUsrQuery leftJoinTjUsrRigJur($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjUsrRigJur relation
 * @method TsUserUsrQuery rightJoinTjUsrRigJur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjUsrRigJur relation
 * @method TsUserUsrQuery innerJoinTjUsrRigJur($relationAlias = null) Adds a INNER JOIN clause to the query using the TjUsrRigJur relation
 *
 * @method TsUserUsr findOne(PropelPDO $con = null) Return the first TsUserUsr matching the query
 * @method TsUserUsr findOneOrCreate(PropelPDO $con = null) Return the first TsUserUsr matching the query, or a new TsUserUsr object populated from the query conditions when no match is found
 *
 * @method TsUserUsr findOneByPwd(string $usr_pwd) Return the first TsUserUsr filtered by the usr_pwd column
 * @method TsUserUsr findOneByFirstname(string $usr_firstname) Return the first TsUserUsr filtered by the usr_firstname column
 * @method TsUserUsr findOneByLastname(string $usr_lastname) Return the first TsUserUsr filtered by the usr_lastname column
 * @method TsUserUsr findOneByNickname(string $usr_nickname) Return the first TsUserUsr filtered by the usr_nickname column
 * @method TsUserUsr findOneByAdult(int $usr_adult) Return the first TsUserUsr filtered by the usr_adult column
 * @method TsUserUsr findOneByMail(string $usr_mail) Return the first TsUserUsr filtered by the usr_mail column
 * @method TsUserUsr findOneByCredit(int $usr_credit) Return the first TsUserUsr filtered by the usr_credit column
 * @method TsUserUsr findOneByImgId(int $img_id) Return the first TsUserUsr filtered by the img_id column
 * @method TsUserUsr findOneByTemporary(boolean $usr_temporary) Return the first TsUserUsr filtered by the usr_temporary column
 * @method TsUserUsr findOneByFailAuth(boolean $usr_fail_auth) Return the first TsUserUsr filtered by the usr_fail_auth column
 * @method TsUserUsr findOneByBlocked(boolean $usr_blocked) Return the first TsUserUsr filtered by the usr_blocked column
 * @method TsUserUsr findOneByMsgPerso(string $usr_msg_perso) Return the first TsUserUsr filtered by the usr_msg_perso column
 *
 * @method array findById(int $usr_id) Return TsUserUsr objects filtered by the usr_id column
 * @method array findByPwd(string $usr_pwd) Return TsUserUsr objects filtered by the usr_pwd column
 * @method array findByFirstname(string $usr_firstname) Return TsUserUsr objects filtered by the usr_firstname column
 * @method array findByLastname(string $usr_lastname) Return TsUserUsr objects filtered by the usr_lastname column
 * @method array findByNickname(string $usr_nickname) Return TsUserUsr objects filtered by the usr_nickname column
 * @method array findByAdult(int $usr_adult) Return TsUserUsr objects filtered by the usr_adult column
 * @method array findByMail(string $usr_mail) Return TsUserUsr objects filtered by the usr_mail column
 * @method array findByCredit(int $usr_credit) Return TsUserUsr objects filtered by the usr_credit column
 * @method array findByImgId(int $img_id) Return TsUserUsr objects filtered by the img_id column
 * @method array findByTemporary(boolean $usr_temporary) Return TsUserUsr objects filtered by the usr_temporary column
 * @method array findByFailAuth(boolean $usr_fail_auth) Return TsUserUsr objects filtered by the usr_fail_auth column
 * @method array findByBlocked(boolean $usr_blocked) Return TsUserUsr objects filtered by the usr_blocked column
 * @method array findByMsgPerso(string $usr_msg_perso) Return TsUserUsr objects filtered by the usr_msg_perso column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTsUserUsrQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTsUserUsrQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TsUserUsr', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TsUserUsrQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TsUserUsrQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TsUserUsrQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TsUserUsrQuery) {
            return $criteria;
        }
        $query = new TsUserUsrQuery();
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
     * @return   TsUserUsr|TsUserUsr[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TsUserUsrPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TsUserUsrPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TsUserUsr A model object, or null if the key is not found
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
     * @return   TsUserUsr A model object, or null if the key is not found
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
            $obj = new TsUserUsr();
            $obj->hydrate($row);
            TsUserUsrPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TsUserUsr|TsUserUsr[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TsUserUsr[]|mixed the list of results, formatted by the current formatter
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
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TsUserUsrPeer::USR_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TsUserUsrPeer::USR_ID, $keys, Criteria::IN);
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
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TsUserUsrPeer::USR_ID, $id, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TsUserUsrPeer::USR_PWD, $pwd, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TsUserUsrPeer::USR_FIRSTNAME, $firstname, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TsUserUsrPeer::USR_LASTNAME, $lastname, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TsUserUsrPeer::USR_NICKNAME, $nickname, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function filterByAdult($adult = null, $comparison = null)
    {
        if (is_array($adult)) {
            $useMinMax = false;
            if (isset($adult['min'])) {
                $this->addUsingAlias(TsUserUsrPeer::USR_ADULT, $adult['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($adult['max'])) {
                $this->addUsingAlias(TsUserUsrPeer::USR_ADULT, $adult['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TsUserUsrPeer::USR_ADULT, $adult, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TsUserUsrPeer::USR_MAIL, $mail, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function filterByCredit($credit = null, $comparison = null)
    {
        if (is_array($credit)) {
            $useMinMax = false;
            if (isset($credit['min'])) {
                $this->addUsingAlias(TsUserUsrPeer::USR_CREDIT, $credit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($credit['max'])) {
                $this->addUsingAlias(TsUserUsrPeer::USR_CREDIT, $credit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TsUserUsrPeer::USR_CREDIT, $credit, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function filterByImgId($imgId = null, $comparison = null)
    {
        if (is_array($imgId)) {
            $useMinMax = false;
            if (isset($imgId['min'])) {
                $this->addUsingAlias(TsUserUsrPeer::IMG_ID, $imgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($imgId['max'])) {
                $this->addUsingAlias(TsUserUsrPeer::IMG_ID, $imgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TsUserUsrPeer::IMG_ID, $imgId, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function filterByTemporary($temporary = null, $comparison = null)
    {
        if (is_string($temporary)) {
            $usr_temporary = in_array(strtolower($temporary), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TsUserUsrPeer::USR_TEMPORARY, $temporary, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function filterByFailAuth($failAuth = null, $comparison = null)
    {
        if (is_string($failAuth)) {
            $usr_fail_auth = in_array(strtolower($failAuth), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TsUserUsrPeer::USR_FAIL_AUTH, $failAuth, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function filterByBlocked($blocked = null, $comparison = null)
    {
        if (is_string($blocked)) {
            $usr_blocked = in_array(strtolower($blocked), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TsUserUsrPeer::USR_BLOCKED, $blocked, $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TsUserUsrPeer::USR_MSG_PERSO, $msgPerso, $comparison);
    }

    /**
     * Filter the query by a related TsImageImg object
     *
     * @param   TsImageImg|PropelObjectCollection $tsImageImg The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsImageImg($tsImageImg, $comparison = null)
    {
        if ($tsImageImg instanceof TsImageImg) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::IMG_ID, $tsImageImg->getId(), $comparison);
        } elseif ($tsImageImg instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TsUserUsrPeer::IMG_ID, $tsImageImg->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TsUserUsrQuery The current query, for fluid interface
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
     * Filter the query by a related TPayboxPay object
     *
     * @param   TPayboxPay|PropelObjectCollection $tPayboxPay  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPayboxPay($tPayboxPay, $comparison = null)
    {
        if ($tPayboxPay instanceof TPayboxPay) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::USR_ID, $tPayboxPay->getUsrId(), $comparison);
        } elseif ($tPayboxPay instanceof PropelObjectCollection) {
            return $this
                ->useTPayboxPayQuery()
                ->filterByPrimaryKeys($tPayboxPay->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTPayboxPay() only accepts arguments of type TPayboxPay or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPayboxPay relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function joinTPayboxPay($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPayboxPay');

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
            $this->addJoinObject($join, 'TPayboxPay');
        }

        return $this;
    }

    /**
     * Use the TPayboxPay relation TPayboxPay object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPayboxPayQuery A secondary query class using the current class as primary query
     */
    public function useTPayboxPayQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTPayboxPay($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPayboxPay', 'TPayboxPayQuery');
    }

    /**
     * Filter the query by a related TPurchasePur object
     *
     * @param   TPurchasePur|PropelObjectCollection $tPurchasePur  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPurchasePurRelatedByUsrIdBuyer($tPurchasePur, $comparison = null)
    {
        if ($tPurchasePur instanceof TPurchasePur) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::USR_ID, $tPurchasePur->getUsrIdBuyer(), $comparison);
        } elseif ($tPurchasePur instanceof PropelObjectCollection) {
            return $this
                ->useTPurchasePurRelatedByUsrIdBuyerQuery()
                ->filterByPrimaryKeys($tPurchasePur->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTPurchasePurRelatedByUsrIdBuyer() only accepts arguments of type TPurchasePur or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPurchasePurRelatedByUsrIdBuyer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function joinTPurchasePurRelatedByUsrIdBuyer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPurchasePurRelatedByUsrIdBuyer');

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
            $this->addJoinObject($join, 'TPurchasePurRelatedByUsrIdBuyer');
        }

        return $this;
    }

    /**
     * Use the TPurchasePurRelatedByUsrIdBuyer relation TPurchasePur object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPurchasePurQuery A secondary query class using the current class as primary query
     */
    public function useTPurchasePurRelatedByUsrIdBuyerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTPurchasePurRelatedByUsrIdBuyer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPurchasePurRelatedByUsrIdBuyer', 'TPurchasePurQuery');
    }

    /**
     * Filter the query by a related TPurchasePur object
     *
     * @param   TPurchasePur|PropelObjectCollection $tPurchasePur  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPurchasePurRelatedByUsrIdSeller($tPurchasePur, $comparison = null)
    {
        if ($tPurchasePur instanceof TPurchasePur) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::USR_ID, $tPurchasePur->getUsrIdSeller(), $comparison);
        } elseif ($tPurchasePur instanceof PropelObjectCollection) {
            return $this
                ->useTPurchasePurRelatedByUsrIdSellerQuery()
                ->filterByPrimaryKeys($tPurchasePur->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTPurchasePurRelatedByUsrIdSeller() only accepts arguments of type TPurchasePur or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPurchasePurRelatedByUsrIdSeller relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function joinTPurchasePurRelatedByUsrIdSeller($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPurchasePurRelatedByUsrIdSeller');

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
            $this->addJoinObject($join, 'TPurchasePurRelatedByUsrIdSeller');
        }

        return $this;
    }

    /**
     * Use the TPurchasePurRelatedByUsrIdSeller relation TPurchasePur object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPurchasePurQuery A secondary query class using the current class as primary query
     */
    public function useTPurchasePurRelatedByUsrIdSellerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTPurchasePurRelatedByUsrIdSeller($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPurchasePurRelatedByUsrIdSeller', 'TPurchasePurQuery');
    }

    /**
     * Filter the query by a related TRechargeRec object
     *
     * @param   TRechargeRec|PropelObjectCollection $tRechargeRec  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTRechargeRecRelatedByUsrIdBuyer($tRechargeRec, $comparison = null)
    {
        if ($tRechargeRec instanceof TRechargeRec) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::USR_ID, $tRechargeRec->getUsrIdBuyer(), $comparison);
        } elseif ($tRechargeRec instanceof PropelObjectCollection) {
            return $this
                ->useTRechargeRecRelatedByUsrIdBuyerQuery()
                ->filterByPrimaryKeys($tRechargeRec->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTRechargeRecRelatedByUsrIdBuyer() only accepts arguments of type TRechargeRec or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TRechargeRecRelatedByUsrIdBuyer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function joinTRechargeRecRelatedByUsrIdBuyer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TRechargeRecRelatedByUsrIdBuyer');

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
            $this->addJoinObject($join, 'TRechargeRecRelatedByUsrIdBuyer');
        }

        return $this;
    }

    /**
     * Use the TRechargeRecRelatedByUsrIdBuyer relation TRechargeRec object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TRechargeRecQuery A secondary query class using the current class as primary query
     */
    public function useTRechargeRecRelatedByUsrIdBuyerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTRechargeRecRelatedByUsrIdBuyer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TRechargeRecRelatedByUsrIdBuyer', 'TRechargeRecQuery');
    }

    /**
     * Filter the query by a related TRechargeRec object
     *
     * @param   TRechargeRec|PropelObjectCollection $tRechargeRec  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTRechargeRecRelatedByUsrIdOperator($tRechargeRec, $comparison = null)
    {
        if ($tRechargeRec instanceof TRechargeRec) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::USR_ID, $tRechargeRec->getUsrIdOperator(), $comparison);
        } elseif ($tRechargeRec instanceof PropelObjectCollection) {
            return $this
                ->useTRechargeRecRelatedByUsrIdOperatorQuery()
                ->filterByPrimaryKeys($tRechargeRec->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTRechargeRecRelatedByUsrIdOperator() only accepts arguments of type TRechargeRec or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TRechargeRecRelatedByUsrIdOperator relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function joinTRechargeRecRelatedByUsrIdOperator($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TRechargeRecRelatedByUsrIdOperator');

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
            $this->addJoinObject($join, 'TRechargeRecRelatedByUsrIdOperator');
        }

        return $this;
    }

    /**
     * Use the TRechargeRecRelatedByUsrIdOperator relation TRechargeRec object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TRechargeRecQuery A secondary query class using the current class as primary query
     */
    public function useTRechargeRecRelatedByUsrIdOperatorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTRechargeRecRelatedByUsrIdOperator($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TRechargeRecRelatedByUsrIdOperator', 'TRechargeRecQuery');
    }

    /**
     * Filter the query by a related TSherlocksShe object
     *
     * @param   TSherlocksShe|PropelObjectCollection $tSherlocksShe  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTSherlocksShe($tSherlocksShe, $comparison = null)
    {
        if ($tSherlocksShe instanceof TSherlocksShe) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::USR_ID, $tSherlocksShe->getUsrId(), $comparison);
        } elseif ($tSherlocksShe instanceof PropelObjectCollection) {
            return $this
                ->useTSherlocksSheQuery()
                ->filterByPrimaryKeys($tSherlocksShe->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTSherlocksShe() only accepts arguments of type TSherlocksShe or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TSherlocksShe relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function joinTSherlocksShe($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TSherlocksShe');

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
            $this->addJoinObject($join, 'TSherlocksShe');
        }

        return $this;
    }

    /**
     * Use the TSherlocksShe relation TSherlocksShe object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TSherlocksSheQuery A secondary query class using the current class as primary query
     */
    public function useTSherlocksSheQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTSherlocksShe($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TSherlocksShe', 'TSherlocksSheQuery');
    }

    /**
     * Filter the query by a related TVirementVir object
     *
     * @param   TVirementVir|PropelObjectCollection $tVirementVir  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTVirementVirRelatedByUsrIdTo($tVirementVir, $comparison = null)
    {
        if ($tVirementVir instanceof TVirementVir) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::USR_ID, $tVirementVir->getUsrIdTo(), $comparison);
        } elseif ($tVirementVir instanceof PropelObjectCollection) {
            return $this
                ->useTVirementVirRelatedByUsrIdToQuery()
                ->filterByPrimaryKeys($tVirementVir->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTVirementVirRelatedByUsrIdTo() only accepts arguments of type TVirementVir or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TVirementVirRelatedByUsrIdTo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function joinTVirementVirRelatedByUsrIdTo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TVirementVirRelatedByUsrIdTo');

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
            $this->addJoinObject($join, 'TVirementVirRelatedByUsrIdTo');
        }

        return $this;
    }

    /**
     * Use the TVirementVirRelatedByUsrIdTo relation TVirementVir object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TVirementVirQuery A secondary query class using the current class as primary query
     */
    public function useTVirementVirRelatedByUsrIdToQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTVirementVirRelatedByUsrIdTo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TVirementVirRelatedByUsrIdTo', 'TVirementVirQuery');
    }

    /**
     * Filter the query by a related TVirementVir object
     *
     * @param   TVirementVir|PropelObjectCollection $tVirementVir  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTVirementVirRelatedByUsrIdFrom($tVirementVir, $comparison = null)
    {
        if ($tVirementVir instanceof TVirementVir) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::USR_ID, $tVirementVir->getUsrIdFrom(), $comparison);
        } elseif ($tVirementVir instanceof PropelObjectCollection) {
            return $this
                ->useTVirementVirRelatedByUsrIdFromQuery()
                ->filterByPrimaryKeys($tVirementVir->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTVirementVirRelatedByUsrIdFrom() only accepts arguments of type TVirementVir or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TVirementVirRelatedByUsrIdFrom relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function joinTVirementVirRelatedByUsrIdFrom($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TVirementVirRelatedByUsrIdFrom');

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
            $this->addJoinObject($join, 'TVirementVirRelatedByUsrIdFrom');
        }

        return $this;
    }

    /**
     * Use the TVirementVirRelatedByUsrIdFrom relation TVirementVir object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TVirementVirQuery A secondary query class using the current class as primary query
     */
    public function useTVirementVirRelatedByUsrIdFromQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTVirementVirRelatedByUsrIdFrom($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TVirementVirRelatedByUsrIdFrom', 'TVirementVirQuery');
    }

    /**
     * Filter the query by a related TjUsrGrpJug object
     *
     * @param   TjUsrGrpJug|PropelObjectCollection $tjUsrGrpJug  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjUsrGrpJug($tjUsrGrpJug, $comparison = null)
    {
        if ($tjUsrGrpJug instanceof TjUsrGrpJug) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::USR_ID, $tjUsrGrpJug->getUsrId(), $comparison);
        } elseif ($tjUsrGrpJug instanceof PropelObjectCollection) {
            return $this
                ->useTjUsrGrpJugQuery()
                ->filterByPrimaryKeys($tjUsrGrpJug->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTjUsrGrpJug() only accepts arguments of type TjUsrGrpJug or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TjUsrGrpJug relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function joinTjUsrGrpJug($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TjUsrGrpJug');

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
            $this->addJoinObject($join, 'TjUsrGrpJug');
        }

        return $this;
    }

    /**
     * Use the TjUsrGrpJug relation TjUsrGrpJug object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TjUsrGrpJugQuery A secondary query class using the current class as primary query
     */
    public function useTjUsrGrpJugQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTjUsrGrpJug($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TjUsrGrpJug', 'TjUsrGrpJugQuery');
    }

    /**
     * Filter the query by a related TjUsrMolJum object
     *
     * @param   TjUsrMolJum|PropelObjectCollection $tjUsrMolJum  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjUsrMolJum($tjUsrMolJum, $comparison = null)
    {
        if ($tjUsrMolJum instanceof TjUsrMolJum) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::USR_ID, $tjUsrMolJum->getUsrId(), $comparison);
        } elseif ($tjUsrMolJum instanceof PropelObjectCollection) {
            return $this
                ->useTjUsrMolJumQuery()
                ->filterByPrimaryKeys($tjUsrMolJum->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTjUsrMolJum() only accepts arguments of type TjUsrMolJum or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TjUsrMolJum relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function joinTjUsrMolJum($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TjUsrMolJum');

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
            $this->addJoinObject($join, 'TjUsrMolJum');
        }

        return $this;
    }

    /**
     * Use the TjUsrMolJum relation TjUsrMolJum object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TjUsrMolJumQuery A secondary query class using the current class as primary query
     */
    public function useTjUsrMolJumQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTjUsrMolJum($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TjUsrMolJum', 'TjUsrMolJumQuery');
    }

    /**
     * Filter the query by a related TjUsrRigJur object
     *
     * @param   TjUsrRigJur|PropelObjectCollection $tjUsrRigJur  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsUserUsrQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjUsrRigJur($tjUsrRigJur, $comparison = null)
    {
        if ($tjUsrRigJur instanceof TjUsrRigJur) {
            return $this
                ->addUsingAlias(TsUserUsrPeer::USR_ID, $tjUsrRigJur->getUsrId(), $comparison);
        } elseif ($tjUsrRigJur instanceof PropelObjectCollection) {
            return $this
                ->useTjUsrRigJurQuery()
                ->filterByPrimaryKeys($tjUsrRigJur->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTjUsrRigJur() only accepts arguments of type TjUsrRigJur or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TjUsrRigJur relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function joinTjUsrRigJur($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TjUsrRigJur');

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
            $this->addJoinObject($join, 'TjUsrRigJur');
        }

        return $this;
    }

    /**
     * Use the TjUsrRigJur relation TjUsrRigJur object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TjUsrRigJurQuery A secondary query class using the current class as primary query
     */
    public function useTjUsrRigJurQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTjUsrRigJur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TjUsrRigJur', 'TjUsrRigJurQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TsUserUsr $tsUserUsr Object to remove from the list of results
     *
     * @return TsUserUsrQuery The current query, for fluid interface
     */
    public function prune($tsUserUsr = null)
    {
        if ($tsUserUsr) {
            $this->addUsingAlias(TsUserUsrPeer::USR_ID, $tsUserUsr->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
