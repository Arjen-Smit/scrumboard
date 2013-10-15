<?php

namespace ScrumBoard\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'project_user' table.
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
class ProjectUserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Scrumboard.map.ProjectUserTableMap';

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
        $this->setName('project_user');
        $this->setPhpName('ProjectUser');
        $this->setClassname('ScrumBoard\\ProjectUser');
        $this->setPackage('Scrumboard');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('user_id', 'UserId', 'INTEGER' , 'user', 'id', true, null, null);
        $this->addForeignPrimaryKey('project_id', 'ProjectId', 'INTEGER' , 'project', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'ScrumBoard\\User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
        $this->addRelation('Project', 'ScrumBoard\\Project', RelationMap::MANY_TO_ONE, array('project_id' => 'id', ), null, null);
    } // buildRelations()

} // ProjectUserTableMap
