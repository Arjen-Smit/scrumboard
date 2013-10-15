<?php

namespace ScrumBoard\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use ScrumBoard\ProjectPeer;
use ScrumBoard\ProjectStory;
use ScrumBoard\ProjectStoryPeer;
use ScrumBoard\ProjectTabPeer;
use ScrumBoard\UserPeer;
use ScrumBoard\map\ProjectStoryTableMap;

/**
 * Base static class for performing query and update operations on the 'project_story' table.
 *
 *
 *
 * @package propel.generator.Scrumboard.om
 */
abstract class BaseProjectStoryPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'scrumboard';

    /** the table name for this class */
    const TABLE_NAME = 'project_story';

    /** the related Propel class for this table */
    const OM_CLASS = 'ScrumBoard\\ProjectStory';

    /** the related TableMap class for this table */
    const TM_CLASS = 'ProjectStoryTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 11;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 11;

    /** the column name for the id field */
    const ID = 'project_story.id';

    /** the column name for the position field */
    const POSITION = 'project_story.position';

    /** the column name for the text field */
    const TEXT = 'project_story.text';

    /** the column name for the time_estimate field */
    const TIME_ESTIMATE = 'project_story.time_estimate';

    /** the column name for the time_spend field */
    const TIME_SPEND = 'project_story.time_spend';

    /** the column name for the owner_id field */
    const OWNER_ID = 'project_story.owner_id';

    /** the column name for the appointed_id field */
    const APPOINTED_ID = 'project_story.appointed_id';

    /** the column name for the project_id field */
    const PROJECT_ID = 'project_story.project_id';

    /** the column name for the project_tab_id field */
    const PROJECT_TAB_ID = 'project_story.project_tab_id';

    /** the column name for the created_at field */
    const CREATED_AT = 'project_story.created_at';

    /** the column name for the updated_at field */
    const UPDATED_AT = 'project_story.updated_at';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of ProjectStory objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array ProjectStory[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. ProjectStoryPeer::$fieldNames[ProjectStoryPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Position', 'Text', 'TimeEstimate', 'TimeSpend', 'OwnerId', 'AppointedId', 'ProjectId', 'ProjectTabId', 'CreatedAt', 'UpdatedAt', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'position', 'text', 'timeEstimate', 'timeSpend', 'ownerId', 'appointedId', 'projectId', 'projectTabId', 'createdAt', 'updatedAt', ),
        BasePeer::TYPE_COLNAME => array (ProjectStoryPeer::ID, ProjectStoryPeer::POSITION, ProjectStoryPeer::TEXT, ProjectStoryPeer::TIME_ESTIMATE, ProjectStoryPeer::TIME_SPEND, ProjectStoryPeer::OWNER_ID, ProjectStoryPeer::APPOINTED_ID, ProjectStoryPeer::PROJECT_ID, ProjectStoryPeer::PROJECT_TAB_ID, ProjectStoryPeer::CREATED_AT, ProjectStoryPeer::UPDATED_AT, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'POSITION', 'TEXT', 'TIME_ESTIMATE', 'TIME_SPEND', 'OWNER_ID', 'APPOINTED_ID', 'PROJECT_ID', 'PROJECT_TAB_ID', 'CREATED_AT', 'UPDATED_AT', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'position', 'text', 'time_estimate', 'time_spend', 'owner_id', 'appointed_id', 'project_id', 'project_tab_id', 'created_at', 'updated_at', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. ProjectStoryPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Position' => 1, 'Text' => 2, 'TimeEstimate' => 3, 'TimeSpend' => 4, 'OwnerId' => 5, 'AppointedId' => 6, 'ProjectId' => 7, 'ProjectTabId' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'position' => 1, 'text' => 2, 'timeEstimate' => 3, 'timeSpend' => 4, 'ownerId' => 5, 'appointedId' => 6, 'projectId' => 7, 'projectTabId' => 8, 'createdAt' => 9, 'updatedAt' => 10, ),
        BasePeer::TYPE_COLNAME => array (ProjectStoryPeer::ID => 0, ProjectStoryPeer::POSITION => 1, ProjectStoryPeer::TEXT => 2, ProjectStoryPeer::TIME_ESTIMATE => 3, ProjectStoryPeer::TIME_SPEND => 4, ProjectStoryPeer::OWNER_ID => 5, ProjectStoryPeer::APPOINTED_ID => 6, ProjectStoryPeer::PROJECT_ID => 7, ProjectStoryPeer::PROJECT_TAB_ID => 8, ProjectStoryPeer::CREATED_AT => 9, ProjectStoryPeer::UPDATED_AT => 10, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'POSITION' => 1, 'TEXT' => 2, 'TIME_ESTIMATE' => 3, 'TIME_SPEND' => 4, 'OWNER_ID' => 5, 'APPOINTED_ID' => 6, 'PROJECT_ID' => 7, 'PROJECT_TAB_ID' => 8, 'CREATED_AT' => 9, 'UPDATED_AT' => 10, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'position' => 1, 'text' => 2, 'time_estimate' => 3, 'time_spend' => 4, 'owner_id' => 5, 'appointed_id' => 6, 'project_id' => 7, 'project_tab_id' => 8, 'created_at' => 9, 'updated_at' => 10, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = ProjectStoryPeer::getFieldNames($toType);
        $key = isset(ProjectStoryPeer::$fieldKeys[$fromType][$name]) ? ProjectStoryPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(ProjectStoryPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, ProjectStoryPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return ProjectStoryPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. ProjectStoryPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(ProjectStoryPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ProjectStoryPeer::ID);
            $criteria->addSelectColumn(ProjectStoryPeer::POSITION);
            $criteria->addSelectColumn(ProjectStoryPeer::TEXT);
            $criteria->addSelectColumn(ProjectStoryPeer::TIME_ESTIMATE);
            $criteria->addSelectColumn(ProjectStoryPeer::TIME_SPEND);
            $criteria->addSelectColumn(ProjectStoryPeer::OWNER_ID);
            $criteria->addSelectColumn(ProjectStoryPeer::APPOINTED_ID);
            $criteria->addSelectColumn(ProjectStoryPeer::PROJECT_ID);
            $criteria->addSelectColumn(ProjectStoryPeer::PROJECT_TAB_ID);
            $criteria->addSelectColumn(ProjectStoryPeer::CREATED_AT);
            $criteria->addSelectColumn(ProjectStoryPeer::UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.position');
            $criteria->addSelectColumn($alias . '.text');
            $criteria->addSelectColumn($alias . '.time_estimate');
            $criteria->addSelectColumn($alias . '.time_spend');
            $criteria->addSelectColumn($alias . '.owner_id');
            $criteria->addSelectColumn($alias . '.appointed_id');
            $criteria->addSelectColumn($alias . '.project_id');
            $criteria->addSelectColumn($alias . '.project_tab_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ProjectStoryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ProjectStoryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 ProjectStory
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = ProjectStoryPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return ProjectStoryPeer::populateObjects(ProjectStoryPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            ProjectStoryPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      ProjectStory $obj A ProjectStory object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            ProjectStoryPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A ProjectStory object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof ProjectStory) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or ProjectStory object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(ProjectStoryPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   ProjectStory Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(ProjectStoryPeer::$instances[$key])) {
                return ProjectStoryPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references)
      {
        foreach (ProjectStoryPeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        ProjectStoryPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to project_story
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = ProjectStoryPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = ProjectStoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = ProjectStoryPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProjectStoryPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (ProjectStory object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = ProjectStoryPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = ProjectStoryPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + ProjectStoryPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProjectStoryPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            ProjectStoryPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related UserRelatedByOwnerId table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinUserRelatedByOwnerId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ProjectStoryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ProjectStoryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ProjectStoryPeer::OWNER_ID, UserPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related UserRelatedByAppointedId table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinUserRelatedByAppointedId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ProjectStoryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ProjectStoryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ProjectStoryPeer::APPOINTED_ID, UserPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Project table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinProject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ProjectStoryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ProjectStoryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ProjectStoryPeer::PROJECT_ID, ProjectPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related ProjectTab table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinProjectTab(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ProjectStoryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ProjectStoryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ProjectStoryPeer::PROJECT_TAB_ID, ProjectTabPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of ProjectStory objects pre-filled with their User objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ProjectStory objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinUserRelatedByOwnerId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);
        }

        ProjectStoryPeer::addSelectColumns($criteria);
        $startcol = ProjectStoryPeer::NUM_HYDRATE_COLUMNS;
        UserPeer::addSelectColumns($criteria);

        $criteria->addJoin(ProjectStoryPeer::OWNER_ID, UserPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ProjectStoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ProjectStoryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ProjectStoryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ProjectStoryPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = UserPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (ProjectStory) to $obj2 (User)
                $obj2->addProjectStoryRelatedByOwnerId($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ProjectStory objects pre-filled with their User objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ProjectStory objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinUserRelatedByAppointedId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);
        }

        ProjectStoryPeer::addSelectColumns($criteria);
        $startcol = ProjectStoryPeer::NUM_HYDRATE_COLUMNS;
        UserPeer::addSelectColumns($criteria);

        $criteria->addJoin(ProjectStoryPeer::APPOINTED_ID, UserPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ProjectStoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ProjectStoryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ProjectStoryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ProjectStoryPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = UserPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (ProjectStory) to $obj2 (User)
                $obj2->addProjectStoryRelatedByAppointedId($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ProjectStory objects pre-filled with their Project objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ProjectStory objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinProject(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);
        }

        ProjectStoryPeer::addSelectColumns($criteria);
        $startcol = ProjectStoryPeer::NUM_HYDRATE_COLUMNS;
        ProjectPeer::addSelectColumns($criteria);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_ID, ProjectPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ProjectStoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ProjectStoryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ProjectStoryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ProjectStoryPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = ProjectPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ProjectPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    ProjectPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (ProjectStory) to $obj2 (Project)
                $obj2->addProjectStory($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ProjectStory objects pre-filled with their ProjectTab objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ProjectStory objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinProjectTab(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);
        }

        ProjectStoryPeer::addSelectColumns($criteria);
        $startcol = ProjectStoryPeer::NUM_HYDRATE_COLUMNS;
        ProjectTabPeer::addSelectColumns($criteria);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_TAB_ID, ProjectTabPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ProjectStoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ProjectStoryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ProjectStoryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ProjectStoryPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = ProjectTabPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = ProjectTabPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ProjectTabPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    ProjectTabPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (ProjectStory) to $obj2 (ProjectTab)
                $obj2->addProjectStory($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ProjectStoryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ProjectStoryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ProjectStoryPeer::OWNER_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::APPOINTED_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_ID, ProjectPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_TAB_ID, ProjectTabPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of ProjectStory objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ProjectStory objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);
        }

        ProjectStoryPeer::addSelectColumns($criteria);
        $startcol2 = ProjectStoryPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UserPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        ProjectTabPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + ProjectTabPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ProjectStoryPeer::OWNER_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::APPOINTED_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_ID, ProjectPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_TAB_ID, ProjectTabPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ProjectStoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ProjectStoryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ProjectStoryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ProjectStoryPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined User rows

            $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = UserPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj2 (User)
                $obj2->addProjectStoryRelatedByOwnerId($obj1);
            } // if joined row not null

            // Add objects for joined User rows

            $key3 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = UserPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = UserPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    UserPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj3 (User)
                $obj3->addProjectStoryRelatedByAppointedId($obj1);
            } // if joined row not null

            // Add objects for joined Project rows

            $key4 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol4);
            if ($key4 !== null) {
                $obj4 = ProjectPeer::getInstanceFromPool($key4);
                if (!$obj4) {

                    $cls = ProjectPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    ProjectPeer::addInstanceToPool($obj4, $key4);
                } // if obj4 loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj4 (Project)
                $obj4->addProjectStory($obj1);
            } // if joined row not null

            // Add objects for joined ProjectTab rows

            $key5 = ProjectTabPeer::getPrimaryKeyHashFromRow($row, $startcol5);
            if ($key5 !== null) {
                $obj5 = ProjectTabPeer::getInstanceFromPool($key5);
                if (!$obj5) {

                    $cls = ProjectTabPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    ProjectTabPeer::addInstanceToPool($obj5, $key5);
                } // if obj5 loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj5 (ProjectTab)
                $obj5->addProjectStory($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related UserRelatedByOwnerId table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptUserRelatedByOwnerId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ProjectStoryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ProjectStoryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ProjectStoryPeer::PROJECT_ID, ProjectPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_TAB_ID, ProjectTabPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related UserRelatedByAppointedId table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptUserRelatedByAppointedId(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ProjectStoryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ProjectStoryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ProjectStoryPeer::PROJECT_ID, ProjectPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_TAB_ID, ProjectTabPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Project table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptProject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ProjectStoryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ProjectStoryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ProjectStoryPeer::OWNER_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::APPOINTED_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_TAB_ID, ProjectTabPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related ProjectTab table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptProjectTab(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ProjectStoryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ProjectStoryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ProjectStoryPeer::OWNER_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::APPOINTED_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_ID, ProjectPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of ProjectStory objects pre-filled with all related objects except UserRelatedByOwnerId.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ProjectStory objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptUserRelatedByOwnerId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);
        }

        ProjectStoryPeer::addSelectColumns($criteria);
        $startcol2 = ProjectStoryPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        ProjectTabPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectTabPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ProjectStoryPeer::PROJECT_ID, ProjectPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_TAB_ID, ProjectTabPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ProjectStoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ProjectStoryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ProjectStoryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ProjectStoryPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Project rows

                $key2 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ProjectPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ProjectPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ProjectPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj2 (Project)
                $obj2->addProjectStory($obj1);

            } // if joined row is not null

                // Add objects for joined ProjectTab rows

                $key3 = ProjectTabPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = ProjectTabPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = ProjectTabPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    ProjectTabPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj3 (ProjectTab)
                $obj3->addProjectStory($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ProjectStory objects pre-filled with all related objects except UserRelatedByAppointedId.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ProjectStory objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptUserRelatedByAppointedId(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);
        }

        ProjectStoryPeer::addSelectColumns($criteria);
        $startcol2 = ProjectStoryPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        ProjectTabPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectTabPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ProjectStoryPeer::PROJECT_ID, ProjectPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_TAB_ID, ProjectTabPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ProjectStoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ProjectStoryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ProjectStoryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ProjectStoryPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Project rows

                $key2 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ProjectPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ProjectPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ProjectPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj2 (Project)
                $obj2->addProjectStory($obj1);

            } // if joined row is not null

                // Add objects for joined ProjectTab rows

                $key3 = ProjectTabPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = ProjectTabPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = ProjectTabPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    ProjectTabPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj3 (ProjectTab)
                $obj3->addProjectStory($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ProjectStory objects pre-filled with all related objects except Project.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ProjectStory objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptProject(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);
        }

        ProjectStoryPeer::addSelectColumns($criteria);
        $startcol2 = ProjectStoryPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UserPeer::NUM_HYDRATE_COLUMNS;

        ProjectTabPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectTabPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ProjectStoryPeer::OWNER_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::APPOINTED_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_TAB_ID, ProjectTabPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ProjectStoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ProjectStoryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ProjectStoryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ProjectStoryPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined User rows

                $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = UserPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj2 (User)
                $obj2->addProjectStoryRelatedByOwnerId($obj1);

            } // if joined row is not null

                // Add objects for joined User rows

                $key3 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = UserPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = UserPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    UserPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj3 (User)
                $obj3->addProjectStoryRelatedByAppointedId($obj1);

            } // if joined row is not null

                // Add objects for joined ProjectTab rows

                $key4 = ProjectTabPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = ProjectTabPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = ProjectTabPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    ProjectTabPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj4 (ProjectTab)
                $obj4->addProjectStory($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ProjectStory objects pre-filled with all related objects except ProjectTab.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ProjectStory objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptProjectTab(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);
        }

        ProjectStoryPeer::addSelectColumns($criteria);
        $startcol2 = ProjectStoryPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UserPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ProjectStoryPeer::OWNER_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::APPOINTED_ID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(ProjectStoryPeer::PROJECT_ID, ProjectPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ProjectStoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ProjectStoryPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ProjectStoryPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ProjectStoryPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined User rows

                $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = UserPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj2 (User)
                $obj2->addProjectStoryRelatedByOwnerId($obj1);

            } // if joined row is not null

                // Add objects for joined User rows

                $key3 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = UserPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = UserPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    UserPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj3 (User)
                $obj3->addProjectStoryRelatedByAppointedId($obj1);

            } // if joined row is not null

                // Add objects for joined Project rows

                $key4 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = ProjectPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = ProjectPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    ProjectPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (ProjectStory) to the collection in $obj4 (Project)
                $obj4->addProjectStory($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(ProjectStoryPeer::DATABASE_NAME)->getTable(ProjectStoryPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseProjectStoryPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseProjectStoryPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new ProjectStoryTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return ProjectStoryPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a ProjectStory or Criteria object.
     *
     * @param      mixed $values Criteria or ProjectStory object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from ProjectStory object
        }

        if ($criteria->containsKey(ProjectStoryPeer::ID) && $criteria->keyContainsValue(ProjectStoryPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProjectStoryPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a ProjectStory or Criteria object.
     *
     * @param      mixed $values Criteria or ProjectStory object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(ProjectStoryPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(ProjectStoryPeer::ID);
            $value = $criteria->remove(ProjectStoryPeer::ID);
            if ($value) {
                $selectCriteria->add(ProjectStoryPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(ProjectStoryPeer::TABLE_NAME);
            }

        } else { // $values is ProjectStory object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the project_story table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(ProjectStoryPeer::TABLE_NAME, $con, ProjectStoryPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProjectStoryPeer::clearInstancePool();
            ProjectStoryPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a ProjectStory or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or ProjectStory object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            ProjectStoryPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof ProjectStory) { // it's a model object
            // invalidate the cache for this single object
            ProjectStoryPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProjectStoryPeer::DATABASE_NAME);
            $criteria->add(ProjectStoryPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                ProjectStoryPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(ProjectStoryPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            ProjectStoryPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given ProjectStory object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      ProjectStory $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(ProjectStoryPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(ProjectStoryPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(ProjectStoryPeer::DATABASE_NAME, ProjectStoryPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return ProjectStory
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = ProjectStoryPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(ProjectStoryPeer::DATABASE_NAME);
        $criteria->add(ProjectStoryPeer::ID, $pk);

        $v = ProjectStoryPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return ProjectStory[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(ProjectStoryPeer::DATABASE_NAME);
            $criteria->add(ProjectStoryPeer::ID, $pks, Criteria::IN);
            $objs = ProjectStoryPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseProjectStoryPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseProjectStoryPeer::buildTableMap();

