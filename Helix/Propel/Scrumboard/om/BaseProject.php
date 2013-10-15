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
use ScrumBoard\Project;
use ScrumBoard\ProjectPeer;
use ScrumBoard\ProjectQuery;
use ScrumBoard\ProjectStory;
use ScrumBoard\ProjectStoryQuery;
use ScrumBoard\ProjectTab;
use ScrumBoard\ProjectTabQuery;
use ScrumBoard\ProjectUser;
use ScrumBoard\ProjectUserQuery;

/**
 * Base class that represents a row from the 'project' table.
 *
 *
 *
 * @package    propel.generator.Scrumboard.om
 */
abstract class BaseProject extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'ScrumBoard\\ProjectPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ProjectPeer
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
     * The value for the company_id field.
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * @var        Customer
     */
    protected $aCustomer;

    /**
     * @var        PropelObjectCollection|ProjectUser[] Collection to store aggregation of ProjectUser objects.
     */
    protected $collProjectUsers;
    protected $collProjectUsersPartial;

    /**
     * @var        PropelObjectCollection|ProjectTab[] Collection to store aggregation of ProjectTab objects.
     */
    protected $collProjectTabs;
    protected $collProjectTabsPartial;

    /**
     * @var        PropelObjectCollection|ProjectStory[] Collection to store aggregation of ProjectStory objects.
     */
    protected $collProjectStorys;
    protected $collProjectStorysPartial;

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
    protected $projectUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $projectTabsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $projectStorysScheduledForDeletion = null;

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
     * Get the [company_id] column value.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Project The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ProjectPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [company_id] column.
     *
     * @param int $v new value
     * @return Project The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[] = ProjectPeer::COMPANY_ID;
        }

        if ($this->aCustomer !== null && $this->aCustomer->getId() !== $v) {
            $this->aCustomer = null;
        }


        return $this;
    } // setCompanyId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return Project The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = ProjectPeer::NAME;
        }


        return $this;
    } // setName()

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
            $this->company_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 3; // 3 = ProjectPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Project object", $e);
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
            $con = Propel::getConnection(ProjectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ProjectPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCustomer = null;
            $this->collProjectUsers = null;

            $this->collProjectTabs = null;

            $this->collProjectStorys = null;

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
            $con = Propel::getConnection(ProjectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ProjectQuery::create()
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
            $con = Propel::getConnection(ProjectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ProjectPeer::addInstanceToPool($this);
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

            if ($this->projectTabsScheduledForDeletion !== null) {
                if (!$this->projectTabsScheduledForDeletion->isEmpty()) {
                    foreach ($this->projectTabsScheduledForDeletion as $projectTab) {
                        // need to save related object because we set the relation to null
                        $projectTab->save($con);
                    }
                    $this->projectTabsScheduledForDeletion = null;
                }
            }

            if ($this->collProjectTabs !== null) {
                foreach ($this->collProjectTabs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->projectStorysScheduledForDeletion !== null) {
                if (!$this->projectStorysScheduledForDeletion->isEmpty()) {
                    foreach ($this->projectStorysScheduledForDeletion as $projectStory) {
                        // need to save related object because we set the relation to null
                        $projectStory->save($con);
                    }
                    $this->projectStorysScheduledForDeletion = null;
                }
            }

            if ($this->collProjectStorys !== null) {
                foreach ($this->collProjectStorys as $referrerFK) {
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

        $this->modifiedColumns[] = ProjectPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProjectPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProjectPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ProjectPeer::COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`company_id`';
        }
        if ($this->isColumnModified(ProjectPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }

        $sql = sprintf(
            'INSERT INTO `project` (%s) VALUES (%s)',
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
                    case '`company_id`':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
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


            if (($retval = ProjectPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collProjectUsers !== null) {
                    foreach ($this->collProjectUsers as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collProjectTabs !== null) {
                    foreach ($this->collProjectTabs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collProjectStorys !== null) {
                    foreach ($this->collProjectStorys as $referrerFK) {
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
        $pos = ProjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getCompanyId();
                break;
            case 2:
                return $this->getName();
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
        if (isset($alreadyDumpedObjects['Project'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Project'][$this->getPrimaryKey()] = true;
        $keys = ProjectPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCompanyId(),
            $keys[2] => $this->getName(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aCustomer) {
                $result['Customer'] = $this->aCustomer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collProjectUsers) {
                $result['ProjectUsers'] = $this->collProjectUsers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjectTabs) {
                $result['ProjectTabs'] = $this->collProjectTabs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjectStorys) {
                $result['ProjectStorys'] = $this->collProjectStorys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ProjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setCompanyId($value);
                break;
            case 2:
                $this->setName($value);
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
        $keys = ProjectPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCompanyId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ProjectPeer::DATABASE_NAME);

        if ($this->isColumnModified(ProjectPeer::ID)) $criteria->add(ProjectPeer::ID, $this->id);
        if ($this->isColumnModified(ProjectPeer::COMPANY_ID)) $criteria->add(ProjectPeer::COMPANY_ID, $this->company_id);
        if ($this->isColumnModified(ProjectPeer::NAME)) $criteria->add(ProjectPeer::NAME, $this->name);

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
        $criteria = new Criteria(ProjectPeer::DATABASE_NAME);
        $criteria->add(ProjectPeer::ID, $this->id);

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
     * @param object $copyObj An object of Project (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setName($this->getName());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getProjectUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProjectTabs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectTab($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProjectStorys() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectStory($relObj->copy($deepCopy));
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
     * @return Project Clone of current object.
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
     * @return ProjectPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ProjectPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Customer object.
     *
     * @param             Customer $v
     * @return Project The current object (for fluent API support)
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
            $v->addProject($this);
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
                $this->aCustomer->addProjects($this);
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
        if ('ProjectUser' == $relationName) {
            $this->initProjectUsers();
        }
        if ('ProjectTab' == $relationName) {
            $this->initProjectTabs();
        }
        if ('ProjectStory' == $relationName) {
            $this->initProjectStorys();
        }
    }

    /**
     * Clears out the collProjectUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Project The current object (for fluent API support)
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
     * If this Project is new, it will return
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
                    ->filterByProject($this)
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
     * @return Project The current object (for fluent API support)
     */
    public function setProjectUsers(PropelCollection $projectUsers, PropelPDO $con = null)
    {
        $projectUsersToDelete = $this->getProjectUsers(new Criteria(), $con)->diff($projectUsers);

        $this->projectUsersScheduledForDeletion = unserialize(serialize($projectUsersToDelete));

        foreach ($projectUsersToDelete as $projectUserRemoved) {
            $projectUserRemoved->setProject(null);
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
                ->filterByProject($this)
                ->count($con);
        }

        return count($this->collProjectUsers);
    }

    /**
     * Method called to associate a ProjectUser object to this object
     * through the ProjectUser foreign key attribute.
     *
     * @param    ProjectUser $l ProjectUser
     * @return Project The current object (for fluent API support)
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
        $projectUser->setProject($this);
    }

    /**
     * @param	ProjectUser $projectUser The projectUser object to remove.
     * @return Project The current object (for fluent API support)
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
            $projectUser->setProject(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Project is new, it will return
     * an empty collection; or if this Project has previously
     * been saved, it will retrieve related ProjectUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Project.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProjectUser[] List of ProjectUser objects
     */
    public function getProjectUsersJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectUserQuery::create(null, $criteria);
        $query->joinWith('User', $join_behavior);

        return $this->getProjectUsers($query, $con);
    }

    /**
     * Clears out the collProjectTabs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Project The current object (for fluent API support)
     * @see        addProjectTabs()
     */
    public function clearProjectTabs()
    {
        $this->collProjectTabs = null; // important to set this to null since that means it is uninitialized
        $this->collProjectTabsPartial = null;

        return $this;
    }

    /**
     * reset is the collProjectTabs collection loaded partially
     *
     * @return void
     */
    public function resetPartialProjectTabs($v = true)
    {
        $this->collProjectTabsPartial = $v;
    }

    /**
     * Initializes the collProjectTabs collection.
     *
     * By default this just sets the collProjectTabs collection to an empty array (like clearcollProjectTabs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectTabs($overrideExisting = true)
    {
        if (null !== $this->collProjectTabs && !$overrideExisting) {
            return;
        }
        $this->collProjectTabs = new PropelObjectCollection();
        $this->collProjectTabs->setModel('ProjectTab');
    }

    /**
     * Gets an array of ProjectTab objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Project is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ProjectTab[] List of ProjectTab objects
     * @throws PropelException
     */
    public function getProjectTabs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collProjectTabsPartial && !$this->isNew();
        if (null === $this->collProjectTabs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjectTabs) {
                // return empty collection
                $this->initProjectTabs();
            } else {
                $collProjectTabs = ProjectTabQuery::create(null, $criteria)
                    ->filterByProject($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collProjectTabsPartial && count($collProjectTabs)) {
                      $this->initProjectTabs(false);

                      foreach($collProjectTabs as $obj) {
                        if (false == $this->collProjectTabs->contains($obj)) {
                          $this->collProjectTabs->append($obj);
                        }
                      }

                      $this->collProjectTabsPartial = true;
                    }

                    $collProjectTabs->getInternalIterator()->rewind();
                    return $collProjectTabs;
                }

                if($partial && $this->collProjectTabs) {
                    foreach($this->collProjectTabs as $obj) {
                        if($obj->isNew()) {
                            $collProjectTabs[] = $obj;
                        }
                    }
                }

                $this->collProjectTabs = $collProjectTabs;
                $this->collProjectTabsPartial = false;
            }
        }

        return $this->collProjectTabs;
    }

    /**
     * Sets a collection of ProjectTab objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $projectTabs A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Project The current object (for fluent API support)
     */
    public function setProjectTabs(PropelCollection $projectTabs, PropelPDO $con = null)
    {
        $projectTabsToDelete = $this->getProjectTabs(new Criteria(), $con)->diff($projectTabs);

        $this->projectTabsScheduledForDeletion = unserialize(serialize($projectTabsToDelete));

        foreach ($projectTabsToDelete as $projectTabRemoved) {
            $projectTabRemoved->setProject(null);
        }

        $this->collProjectTabs = null;
        foreach ($projectTabs as $projectTab) {
            $this->addProjectTab($projectTab);
        }

        $this->collProjectTabs = $projectTabs;
        $this->collProjectTabsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProjectTab objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ProjectTab objects.
     * @throws PropelException
     */
    public function countProjectTabs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collProjectTabsPartial && !$this->isNew();
        if (null === $this->collProjectTabs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectTabs) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getProjectTabs());
            }
            $query = ProjectTabQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProject($this)
                ->count($con);
        }

        return count($this->collProjectTabs);
    }

    /**
     * Method called to associate a ProjectTab object to this object
     * through the ProjectTab foreign key attribute.
     *
     * @param    ProjectTab $l ProjectTab
     * @return Project The current object (for fluent API support)
     */
    public function addProjectTab(ProjectTab $l)
    {
        if ($this->collProjectTabs === null) {
            $this->initProjectTabs();
            $this->collProjectTabsPartial = true;
        }
        if (!in_array($l, $this->collProjectTabs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProjectTab($l);
        }

        return $this;
    }

    /**
     * @param	ProjectTab $projectTab The projectTab object to add.
     */
    protected function doAddProjectTab($projectTab)
    {
        $this->collProjectTabs[]= $projectTab;
        $projectTab->setProject($this);
    }

    /**
     * @param	ProjectTab $projectTab The projectTab object to remove.
     * @return Project The current object (for fluent API support)
     */
    public function removeProjectTab($projectTab)
    {
        if ($this->getProjectTabs()->contains($projectTab)) {
            $this->collProjectTabs->remove($this->collProjectTabs->search($projectTab));
            if (null === $this->projectTabsScheduledForDeletion) {
                $this->projectTabsScheduledForDeletion = clone $this->collProjectTabs;
                $this->projectTabsScheduledForDeletion->clear();
            }
            $this->projectTabsScheduledForDeletion[]= $projectTab;
            $projectTab->setProject(null);
        }

        return $this;
    }

    /**
     * Clears out the collProjectStorys collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Project The current object (for fluent API support)
     * @see        addProjectStorys()
     */
    public function clearProjectStorys()
    {
        $this->collProjectStorys = null; // important to set this to null since that means it is uninitialized
        $this->collProjectStorysPartial = null;

        return $this;
    }

    /**
     * reset is the collProjectStorys collection loaded partially
     *
     * @return void
     */
    public function resetPartialProjectStorys($v = true)
    {
        $this->collProjectStorysPartial = $v;
    }

    /**
     * Initializes the collProjectStorys collection.
     *
     * By default this just sets the collProjectStorys collection to an empty array (like clearcollProjectStorys());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectStorys($overrideExisting = true)
    {
        if (null !== $this->collProjectStorys && !$overrideExisting) {
            return;
        }
        $this->collProjectStorys = new PropelObjectCollection();
        $this->collProjectStorys->setModel('ProjectStory');
    }

    /**
     * Gets an array of ProjectStory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Project is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ProjectStory[] List of ProjectStory objects
     * @throws PropelException
     */
    public function getProjectStorys($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collProjectStorysPartial && !$this->isNew();
        if (null === $this->collProjectStorys || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjectStorys) {
                // return empty collection
                $this->initProjectStorys();
            } else {
                $collProjectStorys = ProjectStoryQuery::create(null, $criteria)
                    ->filterByProject($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collProjectStorysPartial && count($collProjectStorys)) {
                      $this->initProjectStorys(false);

                      foreach($collProjectStorys as $obj) {
                        if (false == $this->collProjectStorys->contains($obj)) {
                          $this->collProjectStorys->append($obj);
                        }
                      }

                      $this->collProjectStorysPartial = true;
                    }

                    $collProjectStorys->getInternalIterator()->rewind();
                    return $collProjectStorys;
                }

                if($partial && $this->collProjectStorys) {
                    foreach($this->collProjectStorys as $obj) {
                        if($obj->isNew()) {
                            $collProjectStorys[] = $obj;
                        }
                    }
                }

                $this->collProjectStorys = $collProjectStorys;
                $this->collProjectStorysPartial = false;
            }
        }

        return $this->collProjectStorys;
    }

    /**
     * Sets a collection of ProjectStory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $projectStorys A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Project The current object (for fluent API support)
     */
    public function setProjectStorys(PropelCollection $projectStorys, PropelPDO $con = null)
    {
        $projectStorysToDelete = $this->getProjectStorys(new Criteria(), $con)->diff($projectStorys);

        $this->projectStorysScheduledForDeletion = unserialize(serialize($projectStorysToDelete));

        foreach ($projectStorysToDelete as $projectStoryRemoved) {
            $projectStoryRemoved->setProject(null);
        }

        $this->collProjectStorys = null;
        foreach ($projectStorys as $projectStory) {
            $this->addProjectStory($projectStory);
        }

        $this->collProjectStorys = $projectStorys;
        $this->collProjectStorysPartial = false;

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
    public function countProjectStorys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collProjectStorysPartial && !$this->isNew();
        if (null === $this->collProjectStorys || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectStorys) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getProjectStorys());
            }
            $query = ProjectStoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProject($this)
                ->count($con);
        }

        return count($this->collProjectStorys);
    }

    /**
     * Method called to associate a ProjectStory object to this object
     * through the ProjectStory foreign key attribute.
     *
     * @param    ProjectStory $l ProjectStory
     * @return Project The current object (for fluent API support)
     */
    public function addProjectStory(ProjectStory $l)
    {
        if ($this->collProjectStorys === null) {
            $this->initProjectStorys();
            $this->collProjectStorysPartial = true;
        }
        if (!in_array($l, $this->collProjectStorys->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProjectStory($l);
        }

        return $this;
    }

    /**
     * @param	ProjectStory $projectStory The projectStory object to add.
     */
    protected function doAddProjectStory($projectStory)
    {
        $this->collProjectStorys[]= $projectStory;
        $projectStory->setProject($this);
    }

    /**
     * @param	ProjectStory $projectStory The projectStory object to remove.
     * @return Project The current object (for fluent API support)
     */
    public function removeProjectStory($projectStory)
    {
        if ($this->getProjectStorys()->contains($projectStory)) {
            $this->collProjectStorys->remove($this->collProjectStorys->search($projectStory));
            if (null === $this->projectStorysScheduledForDeletion) {
                $this->projectStorysScheduledForDeletion = clone $this->collProjectStorys;
                $this->projectStorysScheduledForDeletion->clear();
            }
            $this->projectStorysScheduledForDeletion[]= $projectStory;
            $projectStory->setProject(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Project is new, it will return
     * an empty collection; or if this Project has previously
     * been saved, it will retrieve related ProjectStorys from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Project.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProjectStory[] List of ProjectStory objects
     */
    public function getProjectStorysJoinUserRelatedByOwnerId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectStoryQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByOwnerId', $join_behavior);

        return $this->getProjectStorys($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Project is new, it will return
     * an empty collection; or if this Project has previously
     * been saved, it will retrieve related ProjectStorys from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Project.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProjectStory[] List of ProjectStory objects
     */
    public function getProjectStorysJoinUserRelatedByAppointedId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectStoryQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByAppointedId', $join_behavior);

        return $this->getProjectStorys($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Project is new, it will return
     * an empty collection; or if this Project has previously
     * been saved, it will retrieve related ProjectStorys from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Project.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProjectStory[] List of ProjectStory objects
     */
    public function getProjectStorysJoinProjectTab($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectStoryQuery::create(null, $criteria);
        $query->joinWith('ProjectTab', $join_behavior);

        return $this->getProjectStorys($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->company_id = null;
        $this->name = null;
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
            if ($this->collProjectUsers) {
                foreach ($this->collProjectUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProjectTabs) {
                foreach ($this->collProjectTabs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProjectStorys) {
                foreach ($this->collProjectStorys as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aCustomer instanceof Persistent) {
              $this->aCustomer->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collProjectUsers instanceof PropelCollection) {
            $this->collProjectUsers->clearIterator();
        }
        $this->collProjectUsers = null;
        if ($this->collProjectTabs instanceof PropelCollection) {
            $this->collProjectTabs->clearIterator();
        }
        $this->collProjectTabs = null;
        if ($this->collProjectStorys instanceof PropelCollection) {
            $this->collProjectStorys->clearIterator();
        }
        $this->collProjectStorys = null;
        $this->aCustomer = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProjectPeer::DEFAULT_STRING_FORMAT);
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
