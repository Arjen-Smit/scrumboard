<?php

namespace ScrumBoard\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'project_story' table.
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
class ProjectStoryTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Scrumboard.map.ProjectStoryTableMap';

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
        $this->setName('project_story');
        $this->setPhpName('ProjectStory');
        $this->setClassname('ScrumBoard\\ProjectStory');
        $this->setPackage('Scrumboard');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('position', 'Position', 'INTEGER', false, null, null);
        $this->addColumn('text', 'Text', 'VARCHAR', false, 255, null);
        $this->addColumn('time_estimate', 'TimeEstimate', 'FLOAT', false, null, null);
        $this->addColumn('time_spend', 'TimeSpend', 'FLOAT', false, null, null);
        $this->addForeignKey('owner_id', 'OwnerId', 'INTEGER', 'user', 'id', false, null, null);
        $this->addForeignKey('appointed_id', 'AppointedId', 'INTEGER', 'user', 'id', false, null, null);
        $this->addForeignKey('project_id', 'ProjectId', 'INTEGER', 'project', 'id', false, null, null);
        $this->addForeignKey('project_tab_id', 'ProjectTabId', 'INTEGER', 'project_tab', 'id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('UserRelatedByOwnerId', 'ScrumBoard\\User', RelationMap::MANY_TO_ONE, array('owner_id' => 'id', ), null, null);
        $this->addRelation('UserRelatedByAppointedId', 'ScrumBoard\\User', RelationMap::MANY_TO_ONE, array('appointed_id' => 'id', ), null, null);
        $this->addRelation('Project', 'ScrumBoard\\Project', RelationMap::MANY_TO_ONE, array('project_id' => 'id', ), null, null);
        $this->addRelation('ProjectTab', 'ScrumBoard\\ProjectTab', RelationMap::MANY_TO_ONE, array('project_tab_id' => 'id', ), null, null);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
        );
    } // getBehaviors()

} // ProjectStoryTableMap
