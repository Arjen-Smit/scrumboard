<?php


/**
 * Base class that represents a query for the 'Helix_router' table.
 *
 *
 *
 * @method HelixRouterQuery orderById($order = Criteria::ASC) Order by the id column
 * @method HelixRouterQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method HelixRouterQuery orderBySeolink($order = Criteria::ASC) Order by the seolink column
 * @method HelixRouterQuery orderByModule($order = Criteria::ASC) Order by the module column
 *
 * @method HelixRouterQuery groupById() Group by the id column
 * @method HelixRouterQuery groupByActive() Group by the active column
 * @method HelixRouterQuery groupBySeolink() Group by the seolink column
 * @method HelixRouterQuery groupByModule() Group by the module column
 *
 * @method HelixRouterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method HelixRouterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method HelixRouterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method HelixRouterQuery leftJoinHelixRouterArgument($relationAlias = null) Adds a LEFT JOIN clause to the query using the HelixRouterArgument relation
 * @method HelixRouterQuery rightJoinHelixRouterArgument($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HelixRouterArgument relation
 * @method HelixRouterQuery innerJoinHelixRouterArgument($relationAlias = null) Adds a INNER JOIN clause to the query using the HelixRouterArgument relation
 *
 * @method HelixRouter findOne(PropelPDO $con = null) Return the first HelixRouter matching the query
 * @method HelixRouter findOneOrCreate(PropelPDO $con = null) Return the first HelixRouter matching the query, or a new HelixRouter object populated from the query conditions when no match is found
 *
 * @method HelixRouter findOneByActive(boolean $active) Return the first HelixRouter filtered by the active column
 * @method HelixRouter findOneBySeolink(string $seolink) Return the first HelixRouter filtered by the seolink column
 * @method HelixRouter findOneByModule(string $module) Return the first HelixRouter filtered by the module column
 *
 * @method array findById(int $id) Return HelixRouter objects filtered by the id column
 * @method array findByActive(boolean $active) Return HelixRouter objects filtered by the active column
 * @method array findBySeolink(string $seolink) Return HelixRouter objects filtered by the seolink column
 * @method array findByModule(string $module) Return HelixRouter objects filtered by the module column
 *
 * @package    propel.generator.Scrumboard.om
 */
abstract class BaseHelixRouterQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseHelixRouterQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'scrumboard', $modelName = 'HelixRouter', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new HelixRouterQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   HelixRouterQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return HelixRouterQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof HelixRouterQuery) {
            return $criteria;
        }
        $query = new HelixRouterQuery();
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
     * @return   HelixRouter|HelixRouter[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = HelixRouterPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(HelixRouterPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 HelixRouter A model object, or null if the key is not found
     * @throws PropelException
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
     * @return                 HelixRouter A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `active`, `seolink`, `module` FROM `Helix_router` WHERE `id` = :p0';
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
            $obj = new HelixRouter();
            $obj->hydrate($row);
            HelixRouterPeer::addInstanceToPool($obj, (string) $key);
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
     * @return HelixRouter|HelixRouter[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|HelixRouter[]|mixed the list of results, formatted by the current formatter
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
     * @return HelixRouterQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HelixRouterPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return HelixRouterQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HelixRouterPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HelixRouterQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(HelixRouterPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(HelixRouterPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HelixRouterPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HelixRouterQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(HelixRouterPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the seolink column
     *
     * Example usage:
     * <code>
     * $query->filterBySeolink('fooValue');   // WHERE seolink = 'fooValue'
     * $query->filterBySeolink('%fooValue%'); // WHERE seolink LIKE '%fooValue%'
     * </code>
     *
     * @param     string $seolink The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HelixRouterQuery The current query, for fluid interface
     */
    public function filterBySeolink($seolink = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($seolink)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $seolink)) {
                $seolink = str_replace('*', '%', $seolink);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HelixRouterPeer::SEOLINK, $seolink, $comparison);
    }

    /**
     * Filter the query on the module column
     *
     * Example usage:
     * <code>
     * $query->filterByModule('fooValue');   // WHERE module = 'fooValue'
     * $query->filterByModule('%fooValue%'); // WHERE module LIKE '%fooValue%'
     * </code>
     *
     * @param     string $module The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return HelixRouterQuery The current query, for fluid interface
     */
    public function filterByModule($module = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($module)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $module)) {
                $module = str_replace('*', '%', $module);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(HelixRouterPeer::MODULE, $module, $comparison);
    }

    /**
     * Filter the query by a related HelixRouterArgument object
     *
     * @param   HelixRouterArgument|PropelObjectCollection $helixRouterArgument  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 HelixRouterQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByHelixRouterArgument($helixRouterArgument, $comparison = null)
    {
        if ($helixRouterArgument instanceof HelixRouterArgument) {
            return $this
                ->addUsingAlias(HelixRouterPeer::ID, $helixRouterArgument->getRouterId(), $comparison);
        } elseif ($helixRouterArgument instanceof PropelObjectCollection) {
            return $this
                ->useHelixRouterArgumentQuery()
                ->filterByPrimaryKeys($helixRouterArgument->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByHelixRouterArgument() only accepts arguments of type HelixRouterArgument or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HelixRouterArgument relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return HelixRouterQuery The current query, for fluid interface
     */
    public function joinHelixRouterArgument($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HelixRouterArgument');

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
            $this->addJoinObject($join, 'HelixRouterArgument');
        }

        return $this;
    }

    /**
     * Use the HelixRouterArgument relation HelixRouterArgument object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   HelixRouterArgumentQuery A secondary query class using the current class as primary query
     */
    public function useHelixRouterArgumentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHelixRouterArgument($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HelixRouterArgument', 'HelixRouterArgumentQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   HelixRouter $helixRouter Object to remove from the list of results
     *
     * @return HelixRouterQuery The current query, for fluid interface
     */
    public function prune($helixRouter = null)
    {
        if ($helixRouter) {
            $this->addUsingAlias(HelixRouterPeer::ID, $helixRouter->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
