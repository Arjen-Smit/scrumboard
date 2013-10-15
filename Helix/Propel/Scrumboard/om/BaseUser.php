<?php

namespace ScrumBoard\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use ScrumBoard\Customer;
use ScrumBoard\CustomerQuery;
use ScrumBoard\ProjectStory;
use ScrumBoard\ProjectStoryQuery;
use ScrumBoard\ProjectUser;
use ScrumBoard\ProjectUserQuery;
use ScrumBoard\User;
use ScrumBoard\UserGroup;
use ScrumBoard\UserGroupQuery;
use ScrumBoard\UserPeer;
use ScrumBoard\UserQuery;

/**
 * Base class that represents a row from the 'user' table.
 *
 *
 *
 * @package    propel.generator.Scrumboard.om
 */
abstract class BaseUser extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'ScrumBoard\\UserPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UserPeer
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
     * The value for the username field.
     * @var        string
     */
    protected $username;

    /**
     * The value for the password field.
     * @var        string
     */
    protected $password;

    /**
     * The value for the fullname field.
     * @var        string
     */
    protected $fullname;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the company_id field.
     * @var        int
     */
    protected $company_id;

    /**
     * @var        Customer
     */
    protected $aCustomer;

    /**
     * @var        PropelObjectCollection|UserGroup[] Collection to store aggregation of UserGroup objects.
     */
    protected $collUserGroups;
    protected $collUserGroupsPartial;

    /**
     * @var        PropelObjectCollection|ProjectUser[] Collection to store aggregation of ProjectUser objects.
     */
    protected $collProjectUsers;
    protected $collProjectUsersPartial;

    /**
     * @var        PropelObjectCollection|ProjectStory[] Collection to store aggregation of ProjectStory objects.
     */
    protected $collProjectStorysRelatedByOwnerId;
    protected $collProjectStorysRelatedByOwnerIdPartial;

    /**
     * @var        PropelObjectCollection|ProjectStory[] Collection to store aggregation of ProjectStory objects.
     */
    protected $collProjectStorysRelatedByAppointedId;
    protected $collProjectStorysRelatedByAppointedIdPartial;

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
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $userGroupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $projectUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $projectStorysRelatedByOwnerIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $projectStorysRelatedByAppointedIdScheduledForDeletion = null;

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
     * Get the [username] column value.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [fullname] column value.
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [company_id] column value.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = UserPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [username] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[] = UserPeer::USERNAME;
        }


        return $this;
    } // setUsername()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[] = UserPeer::PASSWORD;
        }


        return $this;
    } // setPassword()

    /**
     * Set the value of [fullname] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setFullname($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->fullname !== $v) {
            $this->fullname = $v;
            $this->modifiedColumns[] = UserPeer::FULLNAME;
        }


        return $this;
    } // setFullname()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = UserPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [company_id] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[] = UserPeer::COMPANY_ID;
        }

        if ($this->aCustomer !== null && $this->aCustomer->getId() !== $v) {
            $this->aCustomer = null;
        }


        return $this;
    } // setCompanyId()

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
            $this->username = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->password = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->fullname = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->email = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->company_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 6; // 6 = UserPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating User object", $e);
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

        if ($this->aCustomer !== null && $this->company_id !== $this->aCustomer->getId()) {
            $this->aCustomer = null;
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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCustomer = null;
            $this->collUserGroups = null;

            $this->collProjectUsers = null;

            $this->collProjectStorysRelatedByOwnerId = null;

            $this->collProjectStorysRelatedByAppointedId = null;

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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UserQuery::create()
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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UserPeer::addInstanceToPool($this);
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

            if ($this->aCustomer !== null) {
                if ($this->aCustomer->isModified() || $this->aCustomer->isNew()) {
                    $affectedRows += $this->aCustomer->save($con);
                }
                $this->setCustomer($this->aCustomer);
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

            if ($this->userGroupsScheduledForDeletion !== null) {
                if (!$this->userGroupsScheduledForDeletion->isEmpty()) {
                    UserGroupQuery::create()
                        ->filterByPrimaryKeys($this->userGroupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userGroupsScheduledForDeletion = null;
                }
            }

            if ($this->collUserGroups !== null) {
                foreach ($this->collUserGroups as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->projectUsersScheduledForDeletion !== null) {
                if (!$this->projectUsersScheduledForDeletion->isEmpty()) {
                    ProjectUserQuery::create()
                        ->filterByPrimaryKeys($this->projectUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->projectUsersScheduledForDeletion = null;
                }
            }

            if ($this->collProjectUsers !== null) {
                foreach ($this->collProjectUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->projectStorysRelatedByOwnerIdScheduledForDeletion !== null) {
                if (!$this->projectStorysRelatedByOwnerIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->projectStorysRelatedByOwnerIdScheduledForDeletion as $projectStoryRelatedByOwnerId) {
                        // need to save related object because we set the relation to null
                        $projectStoryRelatedByOwnerId->save($con);
                    }
                    $this->projectStorysRelatedByOwnerIdScheduledForDeletion = null;
                }
            }

            if ($this->collProjectStorysRelatedByOwnerId !== null) {
                foreach ($this->collProjectStorysRelatedByOwnerId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->projectStorysRelatedByAppointedIdScheduledForDeletion !== null) {
                if (!$this->projectStorysRelatedByAppointedIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->projectStorysRelatedByAppointedIdScheduledForDeletion as $projectStoryRelatedByAppointedId) {
                        // need to save related object because we set the relation to null
                        $projectStoryRelatedByAppointedId->save($con);
                    }
                    $this->projectStorysRelatedByAppointedIdScheduledForDeletion = null;
                }
            }

            if ($this->collProjectStorysRelatedByAppointedId !== null) {
                foreach ($this->collProjectStorysRelatedByAppointedId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[] = UserPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(UserPeer::USERNAME)) {
            $modifiedColumns[':p' . $index++]  = '`username`';
        }
        if ($this->isColumnModified(UserPeer::PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = '`password`';
        }
        if ($this->isColumnModified(UserPeer::FULLNAME)) {
            $modifiedColumns[':p' . $index++]  = '`fullname`';
        }
        if ($this->isColumnModified(UserPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(UserPeer::COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`company_id`';
        }

        $sql = sprintf(
            'INSERT INTO `user` (%s) VALUES (%s)',
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
                    case '`username`':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case '`password`':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case '`fullname`':
                        $stmt->bindValue($identifier, $this->fullname, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`company_id`':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);
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

            if ($this->aCustomer !== null) {
                if (!$this->aCustomer->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCustomer->getValidationFailures());
                }
            }


            if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collUserGroups !== null) {
                    foreach ($this->collUserGroups as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collProjectUsers !== null) {
                    foreach ($this->collProjectUsers as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collProjectStorysRelatedByOwnerId !== null) {
                    foreach ($this->collProjectStorysRelatedByOwnerId as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collProjectStorysRelatedByAppointedId !== null) {
                    foreach ($this->collProjectStorysRelatedByAppointedId as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
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
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getUsername();
                break;
            case 2:
                return $this->getPassword();
                break;
            case 3:
                return $this->getFullname();
                break;
            case 4:
                return $this->getEmail();
                break;
            case 5:
                return $this->getCompanyId();
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
        if (isset($alreadyDumpedObjects['User'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->getPrimaryKey()] = true;
        $keys = UserPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUsername(),
            $keys[2] => $this->getPassword(),
            $keys[3] => $this->getFullname(),
            $keys[4] => $this->getEmail(),
            $keys[5] => $this->getCompanyId(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aCustomer) {
                $result['Customer'] = $this->aCustomer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collUserGroups) {
                $result['UserGroups'] = $this->collUserGroups->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjectUsers) {
                $result['ProjectUsers'] = $this->collProjectUsers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjectStorysRelatedByOwnerId) {
                $result['ProjectStorysRelatedByOwnerId'] = $this->collProjectStorysRelatedByOwnerId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjectStorysRelatedByAppointedId) {
                $result['ProjectStorysRelatedByAppointedId'] = $this->collProjectStorysRelatedByAppointedId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setUsername($value);
                break;
            case 2:
                $this->setPassword($value);
                break;
            case 3:
                $this->setFullname($value);
                break;
            case 4:
                $this->setEmail($value);
                break;
            case 5:
                $this->setCompanyId($value);
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
        $keys = UserPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setUsername($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPassword($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setFullname($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setEmail($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCompanyId($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);

        if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
        if ($this->isColumnModified(UserPeer::USERNAME)) $criteria->add(UserPeer::USERNAME, $this->username);
        if ($this->isColumnModified(UserPeer::PASSWORD)) $criteria->add(UserPeer::PASSWORD, $this->password);
        if ($this->isColumnModified(UserPeer::FULLNAME)) $criteria->add(UserPeer::FULLNAME, $this->fullname);
        if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
        if ($this->isColumnModified(UserPeer::COMPANY_ID)) $criteria->add(UserPeer::COMPANY_ID, $this->company_id);

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
        $criteria = new Criteria(UserPeer::DATABASE_NAME);
        $criteria->add(UserPeer::ID, $this->id);

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
     * @param object $copyObj An object of User (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUsername($this->getUsername());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setFullname($this->getFullname());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setCompanyId($this->getCompanyId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getUserGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProjectUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProjectStorysRelatedByOwnerId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectStoryRelatedByOwnerId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProjectStorysRelatedByAppointedId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectStoryRelatedByAppointedId($relObj->copy($deepCopy));
                }
            }

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
     * @return User Clone of current object.
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
     * @return UserPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UserPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Customer object.
     *
     * @param             Customer $v
     * @return User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCustomer(Customer $v = null)
    {
        if ($v === null) {
            $this->setCompanyId(NULL);
        } else {
            $this->setCompanyId($v->getId());
        }

        $this->aCustomer = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Customer object, it will not be re-added.
        if ($v !== null) {
            $v->addUser($this);
        }


        return $this;
    }


    /**
     * Get the associated Customer object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Customer The associated Customer object.
     * @throws PropelException
     */
    public function getCustomer(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aCustomer === null && ($this->company_id !== null) && $doQuery) {
            $this->aCustomer = CustomerQuery::create()->findPk($this->company_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCustomer->addUsers($this);
             */
        }

        return $this->aCustomer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('UserGroup' == $relationName) {
            $this->initUserGroups();
        }
        if ('ProjectUser' == $relationName) {
            $this->initProjectUsers();
        }
        if ('ProjectStoryRelatedByOwnerId' == $relationName) {
            $this->initProjectStorysRelatedByOwnerId();
        }
        if ('ProjectStoryRelatedByAppointedId' == $relationName) {
            $this->initProjectStorysRelatedByAppointedId();
        }
    }

    /**
     * Clears out the collUserGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addUserGroups()
     */
    public function clearUserGroups()
    {
        $this->collUserGroups = null; // important to set this to null since that means it is uninitialized
        $this->collUserGroupsPartial = null;

        return $this;
    }

    /**
     * reset is the collUserGroups collection loaded partially
     *
     * @return void
     */
    public function resetPartialUserGroups($v = true)
    {
        $this->collUserGroupsPartial = $v;
    }

    /**
     * Initializes the collUserGroups collection.
     *
     * By default this just sets the collUserGroups collection to an empty array (like clearcollUserGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserGroups($overrideExisting = true)
    {
        if (null !== $this->collUserGroups && !$overrideExisting) {
            return;
        }
        $this->collUserGroups = new PropelObjectCollection();
        $this->collUserGroups->setModel('UserGroup');
    }

    /**
     * Gets an array of UserGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|UserGroup[] List of UserGroup objects
     * @throws PropelException
     */
    public function getUserGroups($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUserGroupsPartial && !$this->isNew();
        if (null === $this->collUserGroups || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserGroups) {
                // return empty collection
                $this->initUserGroups();
            } else {
                $collUserGroups = UserGroupQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUserGroupsPartial && count($collUserGroups)) {
                      $this->initUserGroups(false);

                      foreach($collUserGroups as $obj) {
                        if (false == $this->collUserGroups->contains($obj)) {
                          $this->collUserGroups->append($obj);
                        }
                      }

                      $this->collUserGroupsPartial = true;
                    }

                    $collUserGroups->getInternalIterator()->rewind();
                    return $collUserGroups;
                }

                if($partial && $this->collUserGroups) {
                    foreach($this->collUserGroups as $obj) {
                        if($obj->isNew()) {
                            $collUserGroups[] = $obj;
                        }
                    }
                }

                $this->collUserGroups = $collUserGroups;
                $this->collUserGroupsPartial = false;
            }
        }

        return $this->collUserGroups;
    }

    /**
     * Sets a collection of UserGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $userGroups A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setUserGroups(PropelCollection $userGroups, PropelPDO $con = null)
    {
        $userGroupsToDelete = $this->getUserGroups(new Criteria(), $con)->diff($userGroups);

        $this->userGroupsScheduledForDeletion = unserialize(serialize($userGroupsToDelete));

        foreach ($userGroupsToDelete as $userGroupRemoved) {
            $userGroupRemoved->setUser(null);
        }

        $this->collUserGroups = null;
        foreach ($userGroups as $userGroup) {
            $this->addUserGroup($userGroup);
        }

        $this->collUserGroups = $userGroups;
        $this->collUserGroupsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserGroup objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related UserGroup objects.
     * @throws PropelException
     */
    public function countUserGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUserGroupsPartial && !$this->isNew();
        if (null === $this->collUserGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserGroups) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getUserGroups());
            }
            $query = UserGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collUserGroups);
    }

    /**
     * Method called to associate a UserGroup object to this object
     * through the UserGroup foreign key attribute.
     *
     * @param    UserGroup $l UserGroup
     * @return User The current object (for fluent API support)
     */
    public function addUserGroup(UserGroup $l)
    {
        if ($this->collUserGroups === null) {
            $this->initUserGroups();
            $this->collUserGroupsPartial = true;
        }
        if (!in_array($l, $this->collUserGroups->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUserGroup($l);
        }

        return $this;
    }

    /**
     * @param	UserGroup $userGroup The userGroup object to add.
     */
    protected function doAddUserGroup($userGroup)
    {
        $this->collUserGroups[]= $userGroup;
        $userGroup->setUser($this);
    }

    /**
     * @param	UserGroup $userGroup The userGroup object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeUserGroup($userGroup)
    {
        if ($this->getUserGroups()->contains($userGroup)) {
            $this->collUserGroups->remove($this->collUserGroups->search($userGroup));
            if (null === $this->userGroupsScheduledForDeletion) {
                $this->userGroupsScheduledForDeletion = clone $this->collUserGroups;
                $this->userGroupsScheduledForDeletion->clear();
            }
            $this->userGroupsScheduledForDeletion[]= clone $userGroup;
            $userGroup->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserGroups from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|UserGroup[] List of UserGroup objects
     */
    public function getUserGroupsJoinGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UserGroupQuery::create(null, $criteria);
        $query->joinWith('Group', $join_behavior);

        return $this->getUserGroups($query, $con);
    }

    /**
     * Clears out the collProjectUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addProjectUsers()
     */
    public function clearProjectUsers()
    {
        $this->collProjectUsers = null; // important to set this to null since that means it is uninitialized
        $this->collProjectUsersPartial = null;

        return $this;
    }

    /**
     * reset is the collProjectUsers collection loaded partially
     *
     * @return void
     */
    public function resetPartialProjectUsers($v = true)
    {
        $this->collProjectUsersPartial = $v;
    }

    /**
     * Initializes the collProjectUsers collection.
     *
     * By default this just sets the collProjectUsers collection to an empty array (like clearcollProjectUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectUsers($overrideExisting = true)
    {
        if (null !== $this->collProjectUsers && !$overrideExisting) {
            return;
        }
        $this->collProjectUsers = new PropelObjectCollection();
        $this->collProjectUsers->setModel('ProjectUser');
    }

    /**
     * Gets an array of ProjectUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ProjectUser[] List of ProjectUser objects
     * @throws PropelException
     */
    public function getProjectUsers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collProjectUsersPartial && !$this->isNew();
        if (null === $this->collProjectUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjectUsers) {
                // return empty collection
                $this->initProjectUsers();
            } else {
                $collProjectUsers = ProjectUserQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collProjectUsersPartial && count($collProjectUsers)) {
                      $this->initProjectUsers(false);

                      foreach($collProjectUsers as $obj) {
                        if (false == $this->collProjectUsers->contains($obj)) {
                          $this->collProjectUsers->append($obj);
                        }
                      }

                      $this->collProjectUsersPartial = true;
                    }

                    $collProjectUsers->getInternalIterator()->rewind();
                    return $collProjectUsers;
                }

                if($partial && $this->collProjectUsers) {
                    foreach($this->collProjectUsers as $obj) {
                        if($obj->isNew()) {
                            $collProjectUsers[] = $obj;
                        }
                    }
                }

                $this->collProjectUsers = $collProjectUsers;
                $this->collProjectUsersPartial = false;
            }
        }

        return $this->collProjectUsers;
    }

    /**
     * Sets a collection of ProjectUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $projectUsers A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setProjectUsers(PropelCollection $projectUsers, PropelPDO $con = null)
    {
        $projectUsersToDelete = $this->getProjectUsers(new Criteria(), $con)->diff($projectUsers);

        $this->projectUsersScheduledForDeletion = unserialize(serialize($projectUsersToDelete));

        foreach ($projectUsersToDelete as $projectUserRemoved) {
            $projectUserRemoved->setUser(null);
        }

        $this->collProjectUsers = null;
        foreach ($projectUsers as $projectUser) {
            $this->addProjectUser($projectUser);
        }

        $this->collProjectUsers = $projectUsers;
        $this->collProjectUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProjectUser objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ProjectUser objects.
     * @throws PropelException
     */
    public function countProjectUsers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collProjectUsersPartial && !$this->isNew();
        if (null === $this->collProjectUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectUsers) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getProjectUsers());
            }
            $query = ProjectUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collProjectUsers);
    }

    /**
     * Method called to associate a ProjectUser object to this object
     * through the ProjectUser foreign key attribute.
     *
     * @param    ProjectUser $l ProjectUser
     * @return User The current object (for fluent API support)
     */
    public function addProjectUser(ProjectUser $l)
    {
        if ($this->collProjectUsers === null) {
            $this->initProjectUsers();
            $this->collProjectUsersPartial = true;
        }
        if (!in_array($l, $this->collProjectUsers->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProjectUser($l);
        }

        return $this;
    }

    /**
     * @param	ProjectUser $projectUser The projectUser object to add.
     */
    protected function doAddProjectUser($projectUser)
    {
        $this->collProjectUsers[]= $projectUser;
        $projectUser->setUser($this);
    }

    /**
     * @param	ProjectUser $projectUser The projectUser object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeProjectUser($projectUser)
    {
        if ($this->getProjectUsers()->contains($projectUser)) {
            $this->collProjectUsers->remove($this->collProjectUsers->search($projectUser));
            if (null === $this->projectUsersScheduledForDeletion) {
                $this->projectUsersScheduledForDeletion = clone $this->collProjectUsers;
                $this->projectUsersScheduledForDeletion->clear();
            }
            $this->projectUsersScheduledForDeletion[]= clone $projectUser;
            $projectUser->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related ProjectUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProjectUser[] List of ProjectUser objects
     */
    public function getProjectUsersJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectUserQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getProjectUsers($query, $con);
    }

    /**
     * Clears out the collProjectStorysRelatedByOwnerId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addProjectStorysRelatedByOwnerId()
     */
    public function clearProjectStorysRelatedByOwnerId()
    {
        $this->collProjectStorysRelatedByOwnerId = null; // important to set this to null since that means it is uninitialized
        $this->collProjectStorysRelatedByOwnerIdPartial = null;

        return $this;
    }

    /**
     * reset is the collProjectStorysRelatedByOwnerId collection loaded partially
     *
     * @return void
     */
    public function resetPartialProjectStorysRelatedByOwnerId($v = true)
    {
        $this->collProjectStorysRelatedByOwnerIdPartial = $v;
    }

    /**
     * Initializes the collProjectStorysRelatedByOwnerId collection.
     *
     * By default this just sets the collProjectStorysRelatedByOwnerId collection to an empty array (like clearcollProjectStorysRelatedByOwnerId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectStorysRelatedByOwnerId($overrideExisting = true)
    {
        if (null !== $this->collProjectStorysRelatedByOwnerId && !$overrideExisting) {
            return;
        }
        $this->collProjectStorysRelatedByOwnerId = new PropelObjectCollection();
        $this->collProjectStorysRelatedByOwnerId->setModel('ProjectStory');
    }

    /**
     * Gets an array of ProjectStory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ProjectStory[] List of ProjectStory objects
     * @throws PropelException
     */
    public function getProjectStorysRelatedByOwnerId($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collProjectStorysRelatedByOwnerIdPartial && !$this->isNew();
        if (null === $this->collProjectStorysRelatedByOwnerId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjectStorysRelatedByOwnerId) {
                // return empty collection
                $this->initProjectStorysRelatedByOwnerId();
            } else {
                $collProjectStorysRelatedByOwnerId = ProjectStoryQuery::create(null, $criteria)
                    ->filterByUserRelatedByOwnerId($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collProjectStorysRelatedByOwnerIdPartial && count($collProjectStorysRelatedByOwnerId)) {
                      $this->initProjectStorysRelatedByOwnerId(false);

                      foreach($collProjectStorysRelatedByOwnerId as $obj) {
                        if (false == $this->collProjectStorysRelatedByOwnerId->contains($obj)) {
                          $this->collProjectStorysRelatedByOwnerId->append($obj);
                        }
                      }

                      $this->collProjectStorysRelatedByOwnerIdPartial = true;
                    }

                    $collProjectStorysRelatedByOwnerId->getInternalIterator()->rewind();
                    return $collProjectStorysRelatedByOwnerId;
                }

                if($partial && $this->collProjectStorysRelatedByOwnerId) {
                    foreach($this->collProjectStorysRelatedByOwnerId as $obj) {
                        if($obj->isNew()) {
                            $collProjectStorysRelatedByOwnerId[] = $obj;
                        }
                    }
                }

                $this->collProjectStorysRelatedByOwnerId = $collProjectStorysRelatedByOwnerId;
                $this->collProjectStorysRelatedByOwnerIdPartial = false;
            }
        }

        return $this->collProjectStorysRelatedByOwnerId;
    }

    /**
     * Sets a collection of ProjectStoryRelatedByOwnerId objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $projectStorysRelatedByOwnerId A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setProjectStorysRelatedByOwnerId(PropelCollection $projectStorysRelatedByOwnerId, PropelPDO $con = null)
    {
        $projectStorysRelatedByOwnerIdToDelete = $this->getProjectStorysRelatedByOwnerId(new Criteria(), $con)->diff($projectStorysRelatedByOwnerId);

        $this->projectStorysRelatedByOwnerIdScheduledForDeletion = unserialize(serialize($projectStorysRelatedByOwnerIdToDelete));

        foreach ($projectStorysRelatedByOwnerIdToDelete as $projectStoryRelatedByOwnerIdRemoved) {
            $projectStoryRelatedByOwnerIdRemoved->setUserRelatedByOwnerId(null);
        }

        $this->collProjectStorysRelatedByOwnerId = null;
        foreach ($projectStorysRelatedByOwnerId as $projectStoryRelatedByOwnerId) {
            $this->addProjectStoryRelatedByOwnerId($projectStoryRelatedByOwnerId);
        }

        $this->collProjectStorysRelatedByOwnerId = $projectStorysRelatedByOwnerId;
        $this->collProjectStorysRelatedByOwnerIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProjectStory objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ProjectStory objects.
     * @throws PropelException
     */
    public function countProjectStorysRelatedByOwnerId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collProjectStorysRelatedByOwnerIdPartial && !$this->isNew();
        if (null === $this->collProjectStorysRelatedByOwnerId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectStorysRelatedByOwnerId) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getProjectStorysRelatedByOwnerId());
            }
            $query = ProjectStoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByOwnerId($this)
                ->count($con);
        }

        return count($this->collProjectStorysRelatedByOwnerId);
    }

    /**
     * Method called to associate a ProjectStory object to this object
     * through the ProjectStory foreign key attribute.
     *
     * @param    ProjectStory $l ProjectStory
     * @return User The current object (for fluent API support)
     */
    public function addProjectStoryRelatedByOwnerId(ProjectStory $l)
    {
        if ($this->collProjectStorysRelatedByOwnerId === null) {
            $this->initProjectStorysRelatedByOwnerId();
            $this->collProjectStorysRelatedByOwnerIdPartial = true;
        }
        if (!in_array($l, $this->collProjectStorysRelatedByOwnerId->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProjectStoryRelatedByOwnerId($l);
        }

        return $this;
    }

    /**
     * @param	ProjectStoryRelatedByOwnerId $projectStoryRelatedByOwnerId The projectStoryRelatedByOwnerId object to add.
     */
    protected function doAddProjectStoryRelatedByOwnerId($projectStoryRelatedByOwnerId)
    {
        $this->collProjectStorysRelatedByOwnerId[]= $projectStoryRelatedByOwnerId;
        $projectStoryRelatedByOwnerId->setUserRelatedByOwnerId($this);
    }

    /**
     * @param	ProjectStoryRelatedByOwnerId $projectStoryRelatedByOwnerId The projectStoryRelatedByOwnerId object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeProjectStoryRelatedByOwnerId($projectStoryRelatedByOwnerId)
    {
        if ($this->getProjectStorysRelatedByOwnerId()->contains($projectStoryRelatedByOwnerId)) {
            $this->collProjectStorysRelatedByOwnerId->remove($this->collProjectStorysRelatedByOwnerId->search($projectStoryRelatedByOwnerId));
            if (null === $this->projectStorysRelatedByOwnerIdScheduledForDeletion) {
                $this->projectStorysRelatedByOwnerIdScheduledForDeletion = clone $this->collProjectStorysRelatedByOwnerId;
                $this->projectStorysRelatedByOwnerIdScheduledForDeletion->clear();
            }
            $this->projectStorysRelatedByOwnerIdScheduledForDeletion[]= $projectStoryRelatedByOwnerId;
            $projectStoryRelatedByOwnerId->setUserRelatedByOwnerId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related ProjectStorysRelatedByOwnerId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProjectStory[] List of ProjectStory objects
     */
    public function getProjectStorysRelatedByOwnerIdJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectStoryQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getProjectStorysRelatedByOwnerId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related ProjectStorysRelatedByOwnerId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProjectStory[] List of ProjectStory objects
     */
    public function getProjectStorysRelatedByOwnerIdJoinProjectTab($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectStoryQuery::create(null, $criteria);
        $query->joinWith('ProjectTab', $join_behavior);

        return $this->getProjectStorysRelatedByOwnerId($query, $con);
    }

    /**
     * Clears out the collProjectStorysRelatedByAppointedId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addProjectStorysRelatedByAppointedId()
     */
    public function clearProjectStorysRelatedByAppointedId()
    {
        $this->collProjectStorysRelatedByAppointedId = null; // important to set this to null since that means it is uninitialized
        $this->collProjectStorysRelatedByAppointedIdPartial = null;

        return $this;
    }

    /**
     * reset is the collProjectStorysRelatedByAppointedId collection loaded partially
     *
     * @return void
     */
    public function resetPartialProjectStorysRelatedByAppointedId($v = true)
    {
        $this->collProjectStorysRelatedByAppointedIdPartial = $v;
    }

    /**
     * Initializes the collProjectStorysRelatedByAppointedId collection.
     *
     * By default this just sets the collProjectStorysRelatedByAppointedId collection to an empty array (like clearcollProjectStorysRelatedByAppointedId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectStorysRelatedByAppointedId($overrideExisting = true)
    {
        if (null !== $this->collProjectStorysRelatedByAppointedId && !$overrideExisting) {
            return;
        }
        $this->collProjectStorysRelatedByAppointedId = new PropelObjectCollection();
        $this->collProjectStorysRelatedByAppointedId->setModel('ProjectStory');
    }

    /**
     * Gets an array of ProjectStory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ProjectStory[] List of ProjectStory objects
     * @throws PropelException
     */
    public function getProjectStorysRelatedByAppointedId($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collProjectStorysRelatedByAppointedIdPartial && !$this->isNew();
        if (null === $this->collProjectStorysRelatedByAppointedId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjectStorysRelatedByAppointedId) {
                // return empty collection
                $this->initProjectStorysRelatedByAppointedId();
            } else {
                $collProjectStorysRelatedByAppointedId = ProjectStoryQuery::create(null, $criteria)
                    ->filterByUserRelatedByAppointedId($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collProjectStorysRelatedByAppointedIdPartial && count($collProjectStorysRelatedByAppointedId)) {
                      $this->initProjectStorysRelatedByAppointedId(false);

                      foreach($collProjectStorysRelatedByAppointedId as $obj) {
                        if (false == $this->collProjectStorysRelatedByAppointedId->contains($obj)) {
                          $this->collProjectStorysRelatedByAppointedId->append($obj);
                        }
                      }

                      $this->collProjectStorysRelatedByAppointedIdPartial = true;
                    }

                    $collProjectStorysRelatedByAppointedId->getInternalIterator()->rewind();
                    return $collProjectStorysRelatedByAppointedId;
                }

                if($partial && $this->collProjectStorysRelatedByAppointedId) {
                    foreach($this->collProjectStorysRelatedByAppointedId as $obj) {
                        if($obj->isNew()) {
                            $collProjectStorysRelatedByAppointedId[] = $obj;
                        }
                    }
                }

                $this->collProjectStorysRelatedByAppointedId = $collProjectStorysRelatedByAppointedId;
                $this->collProjectStorysRelatedByAppointedIdPartial = false;
            }
        }

        return $this->collProjectStorysRelatedByAppointedId;
    }

    /**
     * Sets a collection of ProjectStoryRelatedByAppointedId objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $projectStorysRelatedByAppointedId A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setProjectStorysRelatedByAppointedId(PropelCollection $projectStorysRelatedByAppointedId, PropelPDO $con = null)
    {
        $projectStorysRelatedByAppointedIdToDelete = $this->getProjectStorysRelatedByAppointedId(new Criteria(), $con)->diff($projectStorysRelatedByAppointedId);

        $this->projectStorysRelatedByAppointedIdScheduledForDeletion = unserialize(serialize($projectStorysRelatedByAppointedIdToDelete));

        foreach ($projectStorysRelatedByAppointedIdToDelete as $projectStoryRelatedByAppointedIdRemoved) {
            $projectStoryRelatedByAppointedIdRemoved->setUserRelatedByAppointedId(null);
        }

        $this->collProjectStorysRelatedByAppointedId = null;
        foreach ($projectStorysRelatedByAppointedId as $projectStoryRelatedByAppointedId) {
            $this->addProjectStoryRelatedByAppointedId($projectStoryRelatedByAppointedId);
        }

        $this->collProjectStorysRelatedByAppointedId = $projectStorysRelatedByAppointedId;
        $this->collProjectStorysRelatedByAppointedIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProjectStory objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ProjectStory objects.
     * @throws PropelException
     */
    public function countProjectStorysRelatedByAppointedId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collProjectStorysRelatedByAppointedIdPartial && !$this->isNew();
        if (null === $this->collProjectStorysRelatedByAppointedId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectStorysRelatedByAppointedId) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getProjectStorysRelatedByAppointedId());
            }
            $query = ProjectStoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByAppointedId($this)
                ->count($con);
        }

        return count($this->collProjectStorysRelatedByAppointedId);
    }

    /**
     * Method called to associate a ProjectStory object to this object
     * through the ProjectStory foreign key attribute.
     *
     * @param    ProjectStory $l ProjectStory
     * @return User The current object (for fluent API support)
     */
    public function addProjectStoryRelatedByAppointedId(ProjectStory $l)
    {
        if ($this->collProjectStorysRelatedByAppointedId === null) {
            $this->initProjectStorysRelatedByAppointedId();
            $this->collProjectStorysRelatedByAppointedIdPartial = true;
        }
        if (!in_array($l, $this->collProjectStorysRelatedByAppointedId->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProjectStoryRelatedByAppointedId($l);
        }

        return $this;
    }

    /**
     * @param	ProjectStoryRelatedByAppointedId $projectStoryRelatedByAppointedId The projectStoryRelatedByAppointedId object to add.
     */
    protected function doAddProjectStoryRelatedByAppointedId($projectStoryRelatedByAppointedId)
    {
        $this->collProjectStorysRelatedByAppointedId[]= $projectStoryRelatedByAppointedId;
        $projectStoryRelatedByAppointedId->setUserRelatedByAppointedId($this);
    }

    /**
     * @param	ProjectStoryRelatedByAppointedId $projectStoryRelatedByAppointedId The projectStoryRelatedByAppointedId object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeProjectStoryRelatedByAppointedId($projectStoryRelatedByAppointedId)
    {
        if ($this->getProjectStorysRelatedByAppointedId()->contains($projectStoryRelatedByAppointedId)) {
            $this->collProjectStorysRelatedByAppointedId->remove($this->collProjectStorysRelatedByAppointedId->search($projectStoryRelatedByAppointedId));
            if (null === $this->projectStorysRelatedByAppointedIdScheduledForDeletion) {
                $this->projectStorysRelatedByAppointedIdScheduledForDeletion = clone $this->collProjectStorysRelatedByAppointedId;
                $this->projectStorysRelatedByAppointedIdScheduledForDeletion->clear();
            }
            $this->projectStorysRelatedByAppointedIdScheduledForDeletion[]= $projectStoryRelatedByAppointedId;
            $projectStoryRelatedByAppointedId->setUserRelatedByAppointedId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related ProjectStorysRelatedByAppointedId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProjectStory[] List of ProjectStory objects
     */
    public function getProjectStorysRelatedByAppointedIdJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectStoryQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getProjectStorysRelatedByAppointedId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related ProjectStorysRelatedByAppointedId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProjectStory[] List of ProjectStory objects
     */
    public function getProjectStorysRelatedByAppointedIdJoinProjectTab($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectStoryQuery::create(null, $criteria);
        $query->joinWith('ProjectTab', $join_behavior);

        return $this->getProjectStorysRelatedByAppointedId($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->username = null;
        $this->password = null;
        $this->fullname = null;
        $this->email = null;
        $this->company_id = null;
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
            if ($this->collUserGroups) {
                foreach ($this->collUserGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProjectUsers) {
                foreach ($this->collProjectUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProjectStorysRelatedByOwnerId) {
                foreach ($this->collProjectStorysRelatedByOwnerId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProjectStorysRelatedByAppointedId) {
                foreach ($this->collProjectStorysRelatedByAppointedId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aCustomer instanceof Persistent) {
              $this->aCustomer->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collUserGroups instanceof PropelCollection) {
            $this->collUserGroups->clearIterator();
        }
        $this->collUserGroups = null;
        if ($this->collProjectUsers instanceof PropelCollection) {
            $this->collProjectUsers->clearIterator();
        }
        $this->collProjectUsers = null;
        if ($this->collProjectStorysRelatedByOwnerId instanceof PropelCollection) {
            $this->collProjectStorysRelatedByOwnerId->clearIterator();
        }
        $this->collProjectStorysRelatedByOwnerId = null;
        if ($this->collProjectStorysRelatedByAppointedId instanceof PropelCollection) {
            $this->collProjectStorysRelatedByAppointedId->clearIterator();
        }
        $this->collProjectStorysRelatedByAppointedId = null;
        $this->aCustomer = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserPeer::DEFAULT_STRING_FORMAT);
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

}
