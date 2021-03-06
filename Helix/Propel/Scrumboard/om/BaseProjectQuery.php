<?php

namespace ScrumBoard\om;

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
use ScrumBoard\Customer;
use ScrumBoard\Project;
use ScrumBoard\ProjectPeer;
use ScrumBoard\ProjectQuery;
use ScrumBoard\ProjectStory;
use ScrumBoard\ProjectTab;
use ScrumBoard\ProjectUser;

/**
 * Base class that represents a query for the 'project' table.
 *
 *
 *
 * @method ProjectQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ProjectQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method ProjectQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method ProjectQuery groupById() Group by the id column
 * @method ProjectQuery groupByCompanyId() Group by the company_id column
 * @method ProjectQuery groupByName() Group by the name column
 *
 * @method ProjectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ProjectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ProjectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ProjectQuery leftJoinCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customer relation
 * @method ProjectQuery rightJoinCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customer relation
 * @method ProjectQuery innerJoinCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the Customer relation
 *
 * @method ProjectQuery leftJoinProjectUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectUser relation
 * @method ProjectQuery rightJoinProjectUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectUser relation
 * @method ProjectQuery innerJoinProjectUser($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectUser relation
 *
 * @method ProjectQuery leftJoinProjectTab($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectTab relation
 * @method ProjectQuery rightJoinProjectTab($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectTab relation
 * @method ProjectQuery innerJoinProjectTab($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectTab relation
 *
 * @method ProjectQuery leftJoinProjectStory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectStory relation
 * @method ProjectQuery rightJoinProjectStory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectStory relation
 * @method ProjectQuery innerJoinProjectStory($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectStory relation
 *
 * @method Project findOne(PropelPDO $con = null) Return the first Project matching the query
 * @method Project findOneOrCreate(PropelPDO $con = null) Return the first Project matching the query, or a new Project object populated from the query conditions when no match is found
 *
 * @method Project findOneByCompanyId(int $company_id) Return the first Project filtered by the company_id column
 * @method Project findOneByName(string $name) Return the first Project filtered by the name column
 *
 * @method array findById(int $id) Return Project objects filtered by the id column
 * @method array findByCompanyId(int $company_id) Return Project objects filtered by the company_id column
 * @method array findByName(string $name) Return Project objects filtered by the name column
 *
 * @package    propel.generator.Scrumboard.om
 */
abstract class BaseProjectQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseProjectQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'scrumboard', $modelName = 'ScrumBoard\\Project', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ProjectQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ProjectQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ProjectQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ProjectQuery) {
            return $criteria;
        }
        $query = new ProjectQuery();
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
     * @return   Project|Project[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProjectPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ProjectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Project A model object, or null if the key is not found
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
     * @return                 Project A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `company_id`, `name` FROM `project` WHERE `id` = :p0';
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
            $obj = new Project();
            $obj->hydrate($row);
            ProjectPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Project|Project[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Project[]|mixed the list of results, formatted by the current formatter
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProjectPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProjectPeer::ID, $keys, Criteria::IN);
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProjectPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProjectPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the company_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyId(1234); // WHERE company_id = 1234
     * $query->filterByCompanyId(array(12, 34)); // WHERE company_id IN (12, 34)
     * $query->filterByCompanyId(array('min' => 12)); // WHERE company_id >= 12
     * $query->filterByCompanyId(array('max' => 12)); // WHERE company_id <= 12
     * </code>
     *
     * @see       filterByCustomer()
     *
     * @param     mixed $companyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByCompanyId($companyId = null, $comparison = null)
    {
        if (is_array($companyId)) {
            $useMinMax = false;
            if (isset($companyId['min'])) {
                $this->addUsingAlias(ProjectPeer::COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(ProjectPeer::COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::COMPANY_ID, $companyId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProjectPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related Customer object
     *
     * @param   Customer|PropelObjectCollection $customer The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCustomer($customer, $comparison = null)
    {
        if ($customer instanceof Customer) {
            return $this
                ->addUsingAlias(ProjectPeer::COMPANY_ID, $customer->getId(), $comparison);
        } elseif ($customer instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectPeer::COMPANY_ID, $customer->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCustomer() only accepts arguments of type Customer or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Customer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function joinCustomer($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Customer');

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
            $this->addJoinObject($join, 'Customer');
        }

        return $this;
    }

    /**
     * Use the Customer relation Customer object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \ScrumBoard\CustomerQuery A secondary query class using the current class as primary query
     */
    public function useCustomerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCustomer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Customer', '\ScrumBoard\CustomerQuery');
    }

    /**
     * Filter the query by a related ProjectUser object
     *
     * @param   ProjectUser|PropelObjectCollection $projectUser  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByProjectUser($projectUser, $comparison = null)
    {
        if ($projectUser instanceof ProjectUser) {
            return $this
                ->addUsingAlias(ProjectPeer::ID, $projectUser->getProjectId(), $comparison);
        } elseif ($projectUser instanceof PropelObjectCollection) {
            return $this
                ->useProjectUserQuery()
                ->filterByPrimaryKeys($projectUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProjectUser() only accepts arguments of type ProjectUser or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function joinProjectUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectUser');

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
            $this->addJoinObject($join, 'ProjectUser');
        }

        return $this;
    }

    /**
     * Use the ProjectUser relation ProjectUser object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \ScrumBoard\ProjectUserQuery A secondary query class using the current class as primary query
     */
    public function useProjectUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProjectUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectUser', '\ScrumBoard\ProjectUserQuery');
    }

    /**
     * Filter the query by a related ProjectTab object
     *
     * @param   ProjectTab|PropelObjectCollection $projectTab  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByProjectTab($projectTab, $comparison = null)
    {
        if ($projectTab instanceof ProjectTab) {
            return $this
                ->addUsingAlias(ProjectPeer::ID, $projectTab->getProjectId(), $comparison);
        } elseif ($projectTab instanceof PropelObjectCollection) {
            return $this
                ->useProjectTabQuery()
                ->filterByPrimaryKeys($projectTab->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProjectTab() only accepts arguments of type ProjectTab or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectTab relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function joinProjectTab($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectTab');

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
            $this->addJoinObject($join, 'ProjectTab');
        }

        return $this;
    }

    /**
     * Use the ProjectTab relation ProjectTab object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \ScrumBoard\ProjectTabQuery A secondary query class using the current class as primary query
     */
    public function useProjectTabQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProjectTab($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectTab', '\ScrumBoard\ProjectTabQuery');
    }

    /**
     * Filter the query by a related ProjectStory object
     *
     * @param   ProjectStory|PropelObjectCollection $projectStory  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByProjectStory($projectStory, $comparison = null)
    {
        if ($projectStory instanceof ProjectStory) {
            return $this
                ->addUsingAlias(ProjectPeer::ID, $projectStory->getProjectId(), $comparison);
        } elseif ($projectStory instanceof PropelObjectCollection) {
            return $this
                ->useProjectStoryQuery()
                ->filterByPrimaryKeys($projectStory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProjectStory() only accepts arguments of type ProjectStory or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectStory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function joinProjectStory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectStory');

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
            $this->addJoinObject($join, 'ProjectStory');
        }

        return $this;
    }

    /**
     * Use the ProjectStory relation ProjectStory object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \ScrumBoard\ProjectStoryQuery A secondary query class using the current class as primary query
     */
    public function useProjectStoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProjectStory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectStory', '\ScrumBoard\ProjectStoryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Project $project Object to remove from the list of results
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function prune($project = null)
    {
        if ($project) {
            $this->addUsingAlias(ProjectPeer::ID, $project->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
