<?php

namespace ScrumBoard\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use ScrumBoard\Project;
use ScrumBoard\ProjectQuery;
use ScrumBoard\ProjectStory;
use ScrumBoard\ProjectStoryPeer;
use ScrumBoard\ProjectStoryQuery;
use ScrumBoard\ProjectTab;
use ScrumBoard\ProjectTabQuery;
use ScrumBoard\User;
use ScrumBoard\UserQuery;

/**
 * Base class that represents a row from the 'project_story' table.
 *
 *
 *
 * @package    propel.generator.Scrumboard.om
 */
abstract class BaseProjectStory extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'ScrumBoard\\ProjectStoryPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ProjectStoryPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the position field.
     * @var        int
     */
    protected $position;

    /**
     * The value for the text field.
     * @var        string
     */
    protected $text;

    /**
     * The value for the time_estimate field.
     * @var        double
     */
    protected $time_estimate;

    /**
     * The value for the time_spend field.
     * @var        double
     */
    protected $time_spend;

    /**
     * The value for the owner_id field.
     * @var        int
     */
    protected $owner_id;

    /**
     * The value for the appointed_id field.
     * @var        int
     */
    protected $appointed_id;

    /**
     * The value for the project_id field.
     * @var        int
     */
    protected $project_id;

    /**
     * The value for the project_tab_id field.
     * @var        int
     */
    protected $project_tab_id;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        User
     */
    protected $aUserRelatedByOwnerId;

    /**
     * @var        User
     */
    protected $aUserRelatedByAppointedId;

    /**
     * @var        Project
     */
    protected $aProject;

    /**
     * @var        ProjectTab
     */
    protected $aProjectTab;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [position] column value.
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Get the [text] column value.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get the [time_estimate] column value.
     *
     * @return double
     */
    public function getTimeEstimate()
    {
        return $this->time_estimate;
    }

    /**
     * Get the [time_spend] column value.
     *
     * @return double
     */
    public function getTimeSpend()
    {
        return $this->time_spend;
    }

    /**
     * Get the [owner_id] column value.
     *
     * @return int
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * Get the [appointed_id] column value.
     *
     * @return int
     */
    public function getAppointedId()
    {
        return $this->appointed_id;
    }

    /**
     * Get the [project_id] column value.
     *
     * @return int
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * Get the [project_tab_id] column value.
     *
     * @return int
     */
    public function getProjectTabId()
    {
        return $this->project_tab_id;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->created_at === null) {
            return null;
        }

        if ($this->created_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->created_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->updated_at === null) {
            return null;
        }

        if ($this->updated_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->updated_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return ProjectStory The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ProjectStoryPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [position] column.
     *
     * @param int $v new value
     * @return ProjectStory The current object (for fluent API support)
     */
    public function setPosition($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->position !== $v) {
            $this->position = $v;
            $this->modifiedColumns[] = ProjectStoryPeer::POSITION;
        }


        return $this;
    } // setPosition()

    /**
     * Set the value of [text] column.
     *
     * @param string $v new value
     * @return ProjectStory The current object (for fluent API support)
     */
    public function setText($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->text !== $v) {
            $this->text = $v;
            $this->modifiedColumns[] = ProjectStoryPeer::TEXT;
        }


        return $this;
    } // setText()

    /**
     * Set the value of [time_estimate] column.
     *
     * @param double $v new value
     * @return ProjectStory The current object (for fluent API support)
     */
    public function setTimeEstimate($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->time_estimate !== $v) {
            $this->time_estimate = $v;
            $this->modifiedColumns[] = ProjectStoryPeer::TIME_ESTIMATE;
        }


        return $this;
    } // setTimeEstimate()

    /**
     * Set the value of [time_spend] column.
     *
     * @param double $v new value
     * @return ProjectStory The current object (for fluent API support)
     */
    public function setTimeSpend($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->time_spend !== $v) {
            $this->time_spend = $v;
            $this->modifiedColumns[] = ProjectStoryPeer::TIME_SPEND;
        }


        return $this;
    } // setTimeSpend()

    /**
     * Set the value of [owner_id] column.
     *
     * @param int $v new value
     * @return ProjectStory The current object (for fluent API support)
     */
    public function setOwnerId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->owner_id !== $v) {
            $this->owner_id = $v;
            $this->modifiedColumns[] = ProjectStoryPeer::OWNER_ID;
        }

        if ($this->aUserRelatedByOwnerId !== null && $this->aUserRelatedByOwnerId->getId() !== $v) {
            $this->aUserRelatedByOwnerId = null;
        }


        return $this;
    } // setOwnerId()

    /**
     * Set the value of [appointed_id] column.
     *
     * @param int $v new value
     * @return ProjectStory The current object (for fluent API support)
     */
    public function setAppointedId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->appointed_id !== $v) {
            $this->appointed_id = $v;
            $this->modifiedColumns[] = ProjectStoryPeer::APPOINTED_ID;
        }

        if ($this->aUserRelatedByAppointedId !== null && $this->aUserRelatedByAppointedId->getId() !== $v) {
            $this->aUserRelatedByAppointedId = null;
        }


        return $this;
    } // setAppointedId()

    /**
     * Set the value of [project_id] column.
     *
     * @param int $v new value
     * @return ProjectStory The current object (for fluent API support)
     */
    public function setProjectId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->project_id !== $v) {
            $this->project_id = $v;
            $this->modifiedColumns[] = ProjectStoryPeer::PROJECT_ID;
        }

        if ($this->aProject !== null && $this->aProject->getId() !== $v) {
            $this->aProject = null;
        }


        return $this;
    } // setProjectId()

    /**
     * Set the value of [project_tab_id] column.
     *
     * @param int $v new value
     * @return ProjectStory The current object (for fluent API support)
     */
    public function setProjectTabId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->project_tab_id !== $v) {
            $this->project_tab_id = $v;
            $this->modifiedColumns[] = ProjectStoryPeer::PROJECT_TAB_ID;
        }

        if ($this->aProjectTab !== null && $this->aProjectTab->getId() !== $v) {
            $this->aProjectTab = null;
        }


        return $this;
    } // setProjectTabId()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return ProjectStory The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = ProjectStoryPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return ProjectStory The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = ProjectStoryPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->position = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->text = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->time_estimate = ($row[$startcol + 3] !== null) ? (double) $row[$startcol + 3] : null;
            $this->time_spend = ($row[$startcol + 4] !== null) ? (double) $row[$startcol + 4] : null;
            $this->owner_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->appointed_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->project_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->project_tab_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->created_at = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->updated_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 11; // 11 = ProjectStoryPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating ProjectStory object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aUserRelatedByOwnerId !== null && $this->owner_id !== $this->aUserRelatedByOwnerId->getId()) {
            $this->aUserRelatedByOwnerId = null;
        }
        if ($this->aUserRelatedByAppointedId !== null && $this->appointed_id !== $this->aUserRelatedByAppointedId->getId()) {
            $this->aUserRelatedByAppointedId = null;
        }
        if ($this->aProject !== null && $this->project_id !== $this->aProject->getId()) {
            $this->aProject = null;
        }
        if ($this->aProjectTab !== null && $this->project_tab_id !== $this->aProjectTab->getId()) {
            $this->aProjectTab = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ProjectStoryPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserRelatedByOwnerId = null;
            $this->aUserRelatedByAppointedId = null;
            $this->aProject = null;
            $this->aProjectTab = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ProjectStoryQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(ProjectStoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(ProjectStoryPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(ProjectStoryPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(ProjectStoryPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ProjectStoryPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUserRelatedByOwnerId !== null) {
                if ($this->aUserRelatedByOwnerId->isModified() || $this->aUserRelatedByOwnerId->isNew()) {
                    $affectedRows += $this->aUserRelatedByOwnerId->save($con);
                }
                $this->setUserRelatedByOwnerId($this->aUserRelatedByOwnerId);
            }

            if ($this->aUserRelatedByAppointedId !== null) {
                if ($this->aUserRelatedByAppointedId->isModified() || $this->aUserRelatedByAppointedId->isNew()) {
                    $affectedRows += $this->aUserRelatedByAppointedId->save($con);
                }
                $this->setUserRelatedByAppointedId($this->aUserRelatedByAppointedId);
            }

            if ($this->aProject !== null) {
                if ($this->aProject->isModified() || $this->aProject->isNew()) {
                    $affectedRows += $this->aProject->save($con);
                }
                $this->setProject($this->aProject);
            }

            if ($this->aProjectTab !== null) {
                if ($this->aProjectTab->isModified() || $this->aProjectTab->isNew()) {
                    $affectedRows += $this->aProjectTab->save($con);
                }
                $this->setProjectTab($this->aProjectTab);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = ProjectStoryPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProjectStoryPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProjectStoryPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ProjectStoryPeer::POSITION)) {
            $modifiedColumns[':p' . $index++]  = '`position`';
        }
        if ($this->isColumnModified(ProjectStoryPeer::TEXT)) {
            $modifiedColumns[':p' . $index++]  = '`text`';
        }
        if ($this->isColumnModified(ProjectStoryPeer::TIME_ESTIMATE)) {
            $modifiedColumns[':p' . $index++]  = '`time_estimate`';
        }
        if ($this->isColumnModified(ProjectStoryPeer::TIME_SPEND)) {
            $modifiedColumns[':p' . $index++]  = '`time_spend`';
        }
        if ($this->isColumnModified(ProjectStoryPeer::OWNER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`owner_id`';
        }
        if ($this->isColumnModified(ProjectStoryPeer::APPOINTED_ID)) {
            $modifiedColumns[':p' . $index++]  = '`appointed_id`';
        }
        if ($this->isColumnModified(ProjectStoryPeer::PROJECT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`project_id`';
        }
        if ($this->isColumnModified(ProjectStoryPeer::PROJECT_TAB_ID)) {
            $modifiedColumns[':p' . $index++]  = '`project_tab_id`';
        }
        if ($this->isColumnModified(ProjectStoryPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(ProjectStoryPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `project_story` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`position`':
                        $stmt->bindValue($identifier, $this->position, PDO::PARAM_INT);
                        break;
                    case '`text`':
                        $stmt->bindValue($identifier, $this->text, PDO::PARAM_STR);
                        break;
                    case '`time_estimate`':
                        $stmt->bindValue($identifier, $this->time_estimate, PDO::PARAM_STR);
                        break;
                    case '`time_spend`':
                        $stmt->bindValue($identifier, $this->time_spend, PDO::PARAM_STR);
                        break;
                    case '`owner_id`':
                        $stmt->bindValue($identifier, $this->owner_id, PDO::PARAM_INT);
                        break;
                    case '`appointed_id`':
                        $stmt->bindValue($identifier, $this->appointed_id, PDO::PARAM_INT);
                        break;
                    case '`project_id`':
                        $stmt->bindValue($identifier, $this->project_id, PDO::PARAM_INT);
                        break;
                    case '`project_tab_id`':
                        $stmt->bindValue($identifier, $this->project_tab_id, PDO::PARAM_INT);
                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUserRelatedByOwnerId !== null) {
                if (!$this->aUserRelatedByOwnerId->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUserRelatedByOwnerId->getValidationFailures());
                }
            }

            if ($this->aUserRelatedByAppointedId !== null) {
                if (!$this->aUserRelatedByAppointedId->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUserRelatedByAppointedId->getValidationFailures());
                }
            }

            if ($this->aProject !== null) {
                if (!$this->aProject->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aProject->getValidationFailures());
                }
            }

            if ($this->aProjectTab !== null) {
                if (!$this->aProjectTab->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aProjectTab->getValidationFailures());
                }
            }


            if (($retval = ProjectStoryPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = ProjectStoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getPosition();
                break;
            case 2:
                return $this->getText();
                break;
            case 3:
                return $this->getTimeEstimate();
                break;
            case 4:
                return $this->getTimeSpend();
                break;
            case 5:
                return $this->getOwnerId();
                break;
            case 6:
                return $this->getAppointedId();
                break;
            case 7:
                return $this->getProjectId();
                break;
            case 8:
                return $this->getProjectTabId();
                break;
            case 9:
                return $this->getCreatedAt();
                break;
            case 10:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['ProjectStory'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ProjectStory'][$this->getPrimaryKey()] = true;
        $keys = ProjectStoryPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPosition(),
            $keys[2] => $this->getText(),
            $keys[3] => $this->getTimeEstimate(),
            $keys[4] => $this->getTimeSpend(),
            $keys[5] => $this->getOwnerId(),
            $keys[6] => $this->getAppointedId(),
            $keys[7] => $this->getProjectId(),
            $keys[8] => $this->getProjectTabId(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aUserRelatedByOwnerId) {
                $result['UserRelatedByOwnerId'] = $this->aUserRelatedByOwnerId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByAppointedId) {
                $result['UserRelatedByAppointedId'] = $this->aUserRelatedByAppointedId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProject) {
                $result['Project'] = $this->aProject->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProjectTab) {
                $result['ProjectTab'] = $this->aProjectTab->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = ProjectStoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPosition($value);
                break;
            case 2:
                $this->setText($value);
                break;
            case 3:
                $this->setTimeEstimate($value);
                break;
            case 4:
                $this->setTimeSpend($value);
                break;
            case 5:
                $this->setOwnerId($value);
                break;
            case 6:
                $this->setAppointedId($value);
                break;
            case 7:
                $this->setProjectId($value);
                break;
            case 8:
                $this->setProjectTabId($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
                $this->setUpdatedAt($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = ProjectStoryPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setPosition($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setText($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setTimeEstimate($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setTimeSpend($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setOwnerId($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setAppointedId($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setProjectId($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setProjectTabId($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ProjectStoryPeer::DATABASE_NAME);

        if ($this->isColumnModified(ProjectStoryPeer::ID)) $criteria->add(ProjectStoryPeer::ID, $this->id);
        if ($this->isColumnModified(ProjectStoryPeer::POSITION)) $criteria->add(ProjectStoryPeer::POSITION, $this->position);
        if ($this->isColumnModified(ProjectStoryPeer::TEXT)) $criteria->add(ProjectStoryPeer::TEXT, $this->text);
        if ($this->isColumnModified(ProjectStoryPeer::TIME_ESTIMATE)) $criteria->add(ProjectStoryPeer::TIME_ESTIMATE, $this->time_estimate);
        if ($this->isColumnModified(ProjectStoryPeer::TIME_SPEND)) $criteria->add(ProjectStoryPeer::TIME_SPEND, $this->time_spend);
        if ($this->isColumnModified(ProjectStoryPeer::OWNER_ID)) $criteria->add(ProjectStoryPeer::OWNER_ID, $this->owner_id);
        if ($this->isColumnModified(ProjectStoryPeer::APPOINTED_ID)) $criteria->add(ProjectStoryPeer::APPOINTED_ID, $this->appointed_id);
        if ($this->isColumnModified(ProjectStoryPeer::PROJECT_ID)) $criteria->add(ProjectStoryPeer::PROJECT_ID, $this->project_id);
        if ($this->isColumnModified(ProjectStoryPeer::PROJECT_TAB_ID)) $criteria->add(ProjectStoryPeer::PROJECT_TAB_ID, $this->project_tab_id);
        if ($this->isColumnModified(ProjectStoryPeer::CREATED_AT)) $criteria->add(ProjectStoryPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(ProjectStoryPeer::UPDATED_AT)) $criteria->add(ProjectStoryPeer::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(ProjectStoryPeer::DATABASE_NAME);
        $criteria->add(ProjectStoryPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of ProjectStory (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPosition($this->getPosition());
        $copyObj->setText($this->getText());
        $copyObj->setTimeEstimate($this->getTimeEstimate());
        $copyObj->setTimeSpend($this->getTimeSpend());
        $copyObj->setOwnerId($this->getOwnerId());
        $copyObj->setAppointedId($this->getAppointedId());
        $copyObj->setProjectId($this->getProjectId());
        $copyObj->setProjectTabId($this->getProjectTabId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return ProjectStory Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return ProjectStoryPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ProjectStoryPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return ProjectStory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByOwnerId(User $v = null)
    {
        if ($v === null) {
            $this->setOwnerId(NULL);
        } else {
            $this->setOwnerId($v->getId());
        }

        $this->aUserRelatedByOwnerId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addProjectStoryRelatedByOwnerId($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUserRelatedByOwnerId(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aUserRelatedByOwnerId === null && ($this->owner_id !== null) && $doQuery) {
            $this->aUserRelatedByOwnerId = UserQuery::create()->findPk($this->owner_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByOwnerId->addProjectStorysRelatedByOwnerId($this);
             */
        }

        return $this->aUserRelatedByOwnerId;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return ProjectStory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByAppointedId(User $v = null)
    {
        if ($v === null) {
            $this->setAppointedId(NULL);
        } else {
            $this->setAppointedId($v->getId());
        }

        $this->aUserRelatedByAppointedId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addProjectStoryRelatedByAppointedId($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUserRelatedByAppointedId(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aUserRelatedByAppointedId === null && ($this->appointed_id !== null) && $doQuery) {
            $this->aUserRelatedByAppointedId = UserQuery::create()->findPk($this->appointed_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByAppointedId->addProjectStorysRelatedByAppointedId($this);
             */
        }

        return $this->aUserRelatedByAppointedId;
    }

    /**
     * Declares an association between this object and a Project object.
     *
     * @param             Project $v
     * @return ProjectStory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProject(Project $v = null)
    {
        if ($v === null) {
            $this->setProjectId(NULL);
        } else {
            $this->setProjectId($v->getId());
        }

        $this->aProject = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Project object, it will not be re-added.
        if ($v !== null) {
            $v->addProjectStory($this);
        }


        return $this;
    }


    /**
     * Get the associated Project object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Project The associated Project object.
     * @throws PropelException
     */
    public function getProject(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aProject === null && ($this->project_id !== null) && $doQuery) {
            $this->aProject = ProjectQuery::create()->findPk($this->project_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProject->addProjectStorys($this);
             */
        }

        return $this->aProject;
    }

    /**
     * Declares an association between this object and a ProjectTab object.
     *
     * @param             ProjectTab $v
     * @return ProjectStory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProjectTab(ProjectTab $v = null)
    {
        if ($v === null) {
            $this->setProjectTabId(NULL);
        } else {
            $this->setProjectTabId($v->getId());
        }

        $this->aProjectTab = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ProjectTab object, it will not be re-added.
        if ($v !== null) {
            $v->addProjectStory($this);
        }


        return $this;
    }


    /**
     * Get the associated ProjectTab object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return ProjectTab The associated ProjectTab object.
     * @throws PropelException
     */
    public function getProjectTab(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aProjectTab === null && ($this->project_tab_id !== null) && $doQuery) {
            $this->aProjectTab = ProjectTabQuery::create()->findPk($this->project_tab_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProjectTab->addProjectStorys($this);
             */
        }

        return $this->aProjectTab;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->position = null;
        $this->text = null;
        $this->time_estimate = null;
        $this->time_spend = null;
        $this->owner_id = null;
        $this->appointed_id = null;
        $this->project_id = null;
        $this->project_tab_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->aUserRelatedByOwnerId instanceof Persistent) {
              $this->aUserRelatedByOwnerId->clearAllReferences($deep);
            }
            if ($this->aUserRelatedByAppointedId instanceof Persistent) {
              $this->aUserRelatedByAppointedId->clearAllReferences($deep);
            }
            if ($this->aProject instanceof Persistent) {
              $this->aProject->clearAllReferences($deep);
            }
            if ($this->aProjectTab instanceof Persistent) {
              $this->aProjectTab->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aUserRelatedByOwnerId = null;
        $this->aUserRelatedByAppointedId = null;
        $this->aProject = null;
        $this->aProjectTab = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProjectStoryPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     ProjectStory The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = ProjectStoryPeer::UPDATED_AT;

        return $this;
    }

}
