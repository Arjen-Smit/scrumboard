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
use ScrumBoard\Project;
use ScrumBoard\ProjectStory;
use ScrumBoard\ProjectStoryPeer;
use ScrumBoard\ProjectStoryQuery;
use ScrumBoard\ProjectTab;
use ScrumBoard\User;

/**
 * Base class that represents a query for the 'project_story' table.
 *
 *
 *
 * @method ProjectStoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ProjectStoryQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method ProjectStoryQuery orderByText($order = Criteria::ASC) Order by the text column
 * @method ProjectStoryQuery orderByTimeEstimate($order = Criteria::ASC) Order by the time_estimate column
 * @method ProjectStoryQuery orderByTimeSpend($order = Criteria::ASC) Order by the time_spend column
 * @method ProjectStoryQuery orderByOwnerId($order = Criteria::ASC) Order by the owner_id column
 * @method ProjectStoryQuery orderByAppointedId($order = Criteria::ASC) Order by the appointed_id column
 * @method ProjectStoryQuery orderByProjectId($order = Criteria::ASC) Order by the project_id column
 * @method ProjectStoryQuery orderByProjectTabId($order = Criteria::ASC) Order by the project_tab_id column
 * @method ProjectStoryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method ProjectStoryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method ProjectStoryQuery groupById() Group by the id column
 * @method ProjectStoryQuery groupByPosition() Group by the position column
 * @method ProjectStoryQuery groupByText() Group by the text column
 * @method ProjectStoryQuery groupByTimeEstimate() Group by the time_estimate column
 * @method ProjectStoryQuery groupByTimeSpend() Group by the time_spend column
 * @method ProjectStoryQuery groupByOwnerId() Group by the owner_id column
 * @method ProjectStoryQuery groupByAppointedId() Group by the appointed_id column
 * @method ProjectStoryQuery groupByProjectId() Group by the project_id column
 * @method ProjectStoryQuery groupByProjectTabId() Group by the project_tab_id column
 * @method ProjectStoryQuery groupByCreatedAt() Group by the created_at column
 * @method ProjectStoryQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method ProjectStoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ProjectStoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ProjectStoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ProjectStoryQuery leftJoinUserRelatedByOwnerId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByOwnerId relation
 * @method ProjectStoryQuery rightJoinUserRelatedByOwnerId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByOwnerId relation
 * @method ProjectStoryQuery innerJoinUserRelatedByOwnerId($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByOwnerId relation
 *
 * @method ProjectStoryQuery leftJoinUserRelatedByAppointedId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByAppointedId relation
 * @method ProjectStoryQuery rightJoinUserRelatedByAppointedId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByAppointedId relation
 * @method ProjectStoryQuery innerJoinUserRelatedByAppointedId($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByAppointedId relation
 *
 * @method ProjectStoryQuery leftJoinProject($relationAlias = null) Adds a LEFT JOIN clause to the query using the Project relation
 * @method ProjectStoryQuery rightJoinProject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Project relation
 * @method ProjectStoryQuery innerJoinProject($relationAlias = null) Adds a INNER JOIN clause to the query using the Project relation
 *
 * @method ProjectStoryQuery leftJoinProjectTab($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectTab relation
 * @method ProjectStoryQuery rightJoinProjectTab($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectTab relation
 * @method ProjectStoryQuery innerJoinProjectTab($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectTab relation
 *
 * @method ProjectStory findOne(PropelPDO $con = null) Return the first ProjectStory matching the query
 * @method ProjectStory findOneOrCreate(PropelPDO $con = null) Return the first ProjectStory matching the query, or a new ProjectStory object populated from the query conditions when no match is found
 *
 * @method ProjectStory findOneByPosition(int $position) Return the first ProjectStory filtered by the position column
 * @method ProjectStory findOneByText(string $text) Return the first ProjectStory filtered by the text column
 * @method ProjectStory findOneByTimeEstimate(double $time_estimate) Return the first ProjectStory filtered by the time_estimate column
 * @method ProjectStory findOneByTimeSpend(double $time_spend) Return the first ProjectStory filtered by the time_spend column
 * @method ProjectStory findOneByOwnerId(int $owner_id) Return the first ProjectStory filtered by the owner_id column
 * @method ProjectStory findOneByAppointedId(int $appointed_id) Return the first ProjectStory filtered by the appointed_id column
 * @method ProjectStory findOneByProjectId(int $project_id) Return the first ProjectStory filtered by the project_id column
 * @method ProjectStory findOneByProjectTabId(int $project_tab_id) Return the first ProjectStory filtered by the project_tab_id column
 * @method ProjectStory findOneByCreatedAt(string $created_at) Return the first ProjectStory filtered by the created_at column
 * @method ProjectStory findOneByUpdatedAt(string $updated_at) Return the first ProjectStory filtered by the updated_at column
 *
 * @method array findById(int $id) Return ProjectStory objects filtered by the id column
 * @method array findByPosition(int $position) Return ProjectStory objects filtered by the position column
 * @method array findByText(string $text) Return ProjectStory objects filtered by the text column
 * @method array findByTimeEstimate(double $time_estimate) Return ProjectStory objects filtered by the time_estimate column
 * @method array findByTimeSpend(double $time_spend) Return ProjectStory objects filtered by the time_spend column
 * @method array findByOwnerId(int $owner_id) Return ProjectStory objects filtered by the owner_id column
 * @method array findByAppointedId(int $appointed_id) Return ProjectStory objects filtered by the appointed_id column
 * @method array findByProjectId(int $project_id) Return ProjectStory objects filtered by the project_id column
 * @method array findByProjectTabId(int $project_tab_id) Return ProjectStory objects filtered by the project_tab_id column
 * @method array findByCreatedAt(string $created_at) Return ProjectStory objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return ProjectStory objects filtered by the updated_at column
 *
 * @package    propel.generator.Scrumboard.om
 */
abstract class BaseProjectStoryQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseProjectStoryQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'scrumboard', $modelName = 'ScrumBoard\\ProjectStory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ProjectStoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ProjectStoryQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ProjectStoryQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ProjectStoryQuery) {
            return $criteria;
        }
        $query = new ProjectStoryQuery();
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
     * @return   ProjectStory|ProjectStory[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProjectStoryPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 ProjectStory A model object, or null if the key is not found
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
     * @return                 ProjectStory A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `position`, `text`, `time_estimate`, `time_spend`, `owner_id`, `appointed_id`, `project_id`, `project_tab_id`, `created_at`, `updated_at` FROM `project_story` WHERE `id` = :p0';
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
            $obj = new ProjectStory();
            $obj->hydrate($row);
            ProjectStoryPeer::addInstanceToPool($obj, (string) $key);
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
     * @return ProjectStory|ProjectStory[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|ProjectStory[]|mixed the list of results, formatted by the current formatter
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
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProjectStoryPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProjectStoryPeer::ID, $keys, Criteria::IN);
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
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProjectStoryPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProjectStoryPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStoryPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE position = 1234
     * $query->filterByPosition(array(12, 34)); // WHERE position IN (12, 34)
     * $query->filterByPosition(array('min' => 12)); // WHERE position >= 12
     * $query->filterByPosition(array('max' => 12)); // WHERE position <= 12
     * </code>
     *
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(ProjectStoryPeer::POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(ProjectStoryPeer::POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStoryPeer::POSITION, $position, $comparison);
    }

    /**
     * Filter the query on the text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE text = 'fooValue'
     * $query->filterByText('%fooValue%'); // WHERE text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $text)) {
                $text = str_replace('*', '%', $text);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProjectStoryPeer::TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the time_estimate column
     *
     * Example usage:
     * <code>
     * $query->filterByTimeEstimate(1234); // WHERE time_estimate = 1234
     * $query->filterByTimeEstimate(array(12, 34)); // WHERE time_estimate IN (12, 34)
     * $query->filterByTimeEstimate(array('min' => 12)); // WHERE time_estimate >= 12
     * $query->filterByTimeEstimate(array('max' => 12)); // WHERE time_estimate <= 12
     * </code>
     *
     * @param     mixed $timeEstimate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByTimeEstimate($timeEstimate = null, $comparison = null)
    {
        if (is_array($timeEstimate)) {
            $useMinMax = false;
            if (isset($timeEstimate['min'])) {
                $this->addUsingAlias(ProjectStoryPeer::TIME_ESTIMATE, $timeEstimate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timeEstimate['max'])) {
                $this->addUsingAlias(ProjectStoryPeer::TIME_ESTIMATE, $timeEstimate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStoryPeer::TIME_ESTIMATE, $timeEstimate, $comparison);
    }

    /**
     * Filter the query on the time_spend column
     *
     * Example usage:
     * <code>
     * $query->filterByTimeSpend(1234); // WHERE time_spend = 1234
     * $query->filterByTimeSpend(array(12, 34)); // WHERE time_spend IN (12, 34)
     * $query->filterByTimeSpend(array('min' => 12)); // WHERE time_spend >= 12
     * $query->filterByTimeSpend(array('max' => 12)); // WHERE time_spend <= 12
     * </code>
     *
     * @param     mixed $timeSpend The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByTimeSpend($timeSpend = null, $comparison = null)
    {
        if (is_array($timeSpend)) {
            $useMinMax = false;
            if (isset($timeSpend['min'])) {
                $this->addUsingAlias(ProjectStoryPeer::TIME_SPEND, $timeSpend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timeSpend['max'])) {
                $this->addUsingAlias(ProjectStoryPeer::TIME_SPEND, $timeSpend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStoryPeer::TIME_SPEND, $timeSpend, $comparison);
    }

    /**
     * Filter the query on the owner_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOwnerId(1234); // WHERE owner_id = 1234
     * $query->filterByOwnerId(array(12, 34)); // WHERE owner_id IN (12, 34)
     * $query->filterByOwnerId(array('min' => 12)); // WHERE owner_id >= 12
     * $query->filterByOwnerId(array('max' => 12)); // WHERE owner_id <= 12
     * </code>
     *
     * @see       filterByUserRelatedByOwnerId()
     *
     * @param     mixed $ownerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByOwnerId($ownerId = null, $comparison = null)
    {
        if (is_array($ownerId)) {
            $useMinMax = false;
            if (isset($ownerId['min'])) {
                $this->addUsingAlias(ProjectStoryPeer::OWNER_ID, $ownerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ownerId['max'])) {
                $this->addUsingAlias(ProjectStoryPeer::OWNER_ID, $ownerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStoryPeer::OWNER_ID, $ownerId, $comparison);
    }

    /**
     * Filter the query on the appointed_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAppointedId(1234); // WHERE appointed_id = 1234
     * $query->filterByAppointedId(array(12, 34)); // WHERE appointed_id IN (12, 34)
     * $query->filterByAppointedId(array('min' => 12)); // WHERE appointed_id >= 12
     * $query->filterByAppointedId(array('max' => 12)); // WHERE appointed_id <= 12
     * </code>
     *
     * @see       filterByUserRelatedByAppointedId()
     *
     * @param     mixed $appointedId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByAppointedId($appointedId = null, $comparison = null)
    {
        if (is_array($appointedId)) {
            $useMinMax = false;
            if (isset($appointedId['min'])) {
                $this->addUsingAlias(ProjectStoryPeer::APPOINTED_ID, $appointedId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($appointedId['max'])) {
                $this->addUsingAlias(ProjectStoryPeer::APPOINTED_ID, $appointedId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStoryPeer::APPOINTED_ID, $appointedId, $comparison);
    }

    /**
     * Filter the query on the project_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProjectId(1234); // WHERE project_id = 1234
     * $query->filterByProjectId(array(12, 34)); // WHERE project_id IN (12, 34)
     * $query->filterByProjectId(array('min' => 12)); // WHERE project_id >= 12
     * $query->filterByProjectId(array('max' => 12)); // WHERE project_id <= 12
     * </code>
     *
     * @see       filterByProject()
     *
     * @param     mixed $projectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByProjectId($projectId = null, $comparison = null)
    {
        if (is_array($projectId)) {
            $useMinMax = false;
            if (isset($projectId['min'])) {
                $this->addUsingAlias(ProjectStoryPeer::PROJECT_ID, $projectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectId['max'])) {
                $this->addUsingAlias(ProjectStoryPeer::PROJECT_ID, $projectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStoryPeer::PROJECT_ID, $projectId, $comparison);
    }

    /**
     * Filter the query on the project_tab_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProjectTabId(1234); // WHERE project_tab_id = 1234
     * $query->filterByProjectTabId(array(12, 34)); // WHERE project_tab_id IN (12, 34)
     * $query->filterByProjectTabId(array('min' => 12)); // WHERE project_tab_id >= 12
     * $query->filterByProjectTabId(array('max' => 12)); // WHERE project_tab_id <= 12
     * </code>
     *
     * @see       filterByProjectTab()
     *
     * @param     mixed $projectTabId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByProjectTabId($projectTabId = null, $comparison = null)
    {
        if (is_array($projectTabId)) {
            $useMinMax = false;
            if (isset($projectTabId['min'])) {
                $this->addUsingAlias(ProjectStoryPeer::PROJECT_TAB_ID, $projectTabId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectTabId['max'])) {
                $this->addUsingAlias(ProjectStoryPeer::PROJECT_TAB_ID, $projectTabId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStoryPeer::PROJECT_TAB_ID, $projectTabId, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProjectStoryPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProjectStoryPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStoryPeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProjectStoryPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProjectStoryPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectStoryPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectStoryQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByOwnerId($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(ProjectStoryPeer::OWNER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectStoryPeer::OWNER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByOwnerId() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByOwnerId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function joinUserRelatedByOwnerId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByOwnerId');

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
            $this->addJoinObject($join, 'UserRelatedByOwnerId');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByOwnerId relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \ScrumBoard\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByOwnerIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByOwnerId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByOwnerId', '\ScrumBoard\UserQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectStoryQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByAppointedId($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(ProjectStoryPeer::APPOINTED_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectStoryPeer::APPOINTED_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByAppointedId() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByAppointedId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function joinUserRelatedByAppointedId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByAppointedId');

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
            $this->addJoinObject($join, 'UserRelatedByAppointedId');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByAppointedId relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \ScrumBoard\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByAppointedIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByAppointedId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByAppointedId', '\ScrumBoard\UserQuery');
    }

    /**
     * Filter the query by a related Project object
     *
     * @param   Project|PropelObjectCollection $project The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectStoryQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByProject($project, $comparison = null)
    {
        if ($project instanceof Project) {
            return $this
                ->addUsingAlias(ProjectStoryPeer::PROJECT_ID, $project->getId(), $comparison);
        } elseif ($project instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectStoryPeer::PROJECT_ID, $project->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProject() only accepts arguments of type Project or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Project relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function joinProject($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Project');

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
            $this->addJoinObject($join, 'Project');
        }

        return $this;
    }

    /**
     * Use the Project relation Project object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \ScrumBoard\ProjectQuery A secondary query class using the current class as primary query
     */
    public function useProjectQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Project', '\ScrumBoard\ProjectQuery');
    }

    /**
     * Filter the query by a related ProjectTab object
     *
     * @param   ProjectTab|PropelObjectCollection $projectTab The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectStoryQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByProjectTab($projectTab, $comparison = null)
    {
        if ($projectTab instanceof ProjectTab) {
            return $this
                ->addUsingAlias(ProjectStoryPeer::PROJECT_TAB_ID, $projectTab->getId(), $comparison);
        } elseif ($projectTab instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectStoryPeer::PROJECT_TAB_ID, $projectTab->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ProjectStoryQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ProjectStory $projectStory Object to remove from the list of results
     *
     * @return ProjectStoryQuery The current query, for fluid interface
     */
    public function prune($projectStory = null)
    {
        if ($projectStory) {
            $this->addUsingAlias(ProjectStoryPeer::ID, $projectStory->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ProjectStoryQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ProjectStoryPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ProjectStoryQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProjectStoryPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ProjectStoryQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProjectStoryPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ProjectStoryQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ProjectStoryPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     ProjectStoryQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProjectStoryPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ProjectStoryQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProjectStoryPeer::CREATED_AT);
    }
}
