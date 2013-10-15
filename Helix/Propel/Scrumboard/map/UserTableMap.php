<?php

namespace ScrumBoard\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.Scrumboard.map
 */
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Scrumboard.map.UserTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('user');
        $this->setPhpName('User');
        $this->setClassname('ScrumBoard\\User');
        $this->setPackage('Scrumboard');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, 255, null);
        $this->addColumn('password', 'Password', 'VARCHAR', false, 64, null);
        $this->addColumn('fullname', 'Fullname', 'VARCHAR', false, 255, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 128, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'id', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Customer', 'ScrumBoard\\Customer', RelationMap::MANY_TO_ONE, array('company_id' => 'id', ), null, null);
        $this->addRelation('UserGroup', 'ScrumBoard\\UserGroup', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'UserGroups');
        $this->addRelation('ProjectUser', 'ScrumBoard\\ProjectUser', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'ProjectUsers');
        $this->addRelation('ProjectStoryRelatedByOwnerId', 'ScrumBoard\\ProjectStory', RelationMap::ONE_TO_MANY, array('id' => 'owner_id', ), null, null, 'ProjectStorysRelatedByOwnerId');
        $this->addRelation('ProjectStoryRelatedByAppointedId', 'ScrumBoard\\ProjectStory', RelationMap::ONE_TO_MANY, array('id' => 'appointed_id', ), null, null, 'ProjectStorysRelatedByAppointedId');
    } // buildRelations()

} // UserTableMap
