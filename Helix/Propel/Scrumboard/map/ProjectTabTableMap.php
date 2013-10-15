<?php

namespace ScrumBoard\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'project_tab' table.
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
class ProjectTabTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Scrumboard.map.ProjectTabTableMap';

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
        $this->setName('project_tab');
        $this->setPhpName('ProjectTab');
        $this->setClassname('ScrumBoard\\ProjectTab');
        $this->setPackage('Scrumboard');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('position', 'Position', 'INTEGER', false, null, null);
        $this->addForeignKey('project_id', 'ProjectId', 'INTEGER', 'project', 'id', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Project', 'ScrumBoard\\Project', RelationMap::MANY_TO_ONE, array('project_id' => 'id', ), null, null);
        $this->addRelation('ProjectStory', 'ScrumBoard\\ProjectStory', RelationMap::ONE_TO_MANY, array('id' => 'project_tab_id', ), null, null, 'ProjectStorys');
    } // buildRelations()

} // ProjectTabTableMap
