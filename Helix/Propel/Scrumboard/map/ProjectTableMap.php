<?php

namespace ScrumBoard\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'project' table.
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
class ProjectTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Scrumboard.map.ProjectTableMap';

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
        $this->setName('project');
        $this->setPhpName('Project');
        $this->setClassname('ScrumBoard\\Project');
        $this->setPackage('Scrumboard');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'id', false, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Customer', 'ScrumBoard\\Customer', RelationMap::MANY_TO_ONE, array('company_id' => 'id', ), null, null);
        $this->addRelation('ProjectUser', 'ScrumBoard\\ProjectUser', RelationMap::ONE_TO_MANY, array('id' => 'project_id', ), null, null, 'ProjectUsers');
        $this->addRelation('ProjectTab', 'ScrumBoard\\ProjectTab', RelationMap::ONE_TO_MANY, array('id' => 'project_id', ), null, null, 'ProjectTabs');
        $this->addRelation('ProjectStory', 'ScrumBoard\\ProjectStory', RelationMap::ONE_TO_MANY, array('id' => 'project_id', ), null, null, 'ProjectStorys');
    } // buildRelations()

} // ProjectTableMap
