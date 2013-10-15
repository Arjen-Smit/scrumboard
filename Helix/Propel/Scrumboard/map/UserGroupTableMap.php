<?php

namespace ScrumBoard\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'user_group' table.
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
class UserGroupTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Scrumboard.map.UserGroupTableMap';

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
        $this->setName('user_group');
        $this->setPhpName('UserGroup');
        $this->setClassname('ScrumBoard\\UserGroup');
        $this->setPackage('Scrumboard');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('user_id', 'UserId', 'INTEGER' , 'user', 'id', true, null, null);
        $this->addForeignPrimaryKey('group_id', 'GroupId', 'INTEGER' , 'group', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'ScrumBoard\\User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
        $this->addRelation('Group', 'ScrumBoard\\Group', RelationMap::MANY_TO_ONE, array('group_id' => 'id', ), null, null);
    } // buildRelations()

} // UserGroupTableMap
