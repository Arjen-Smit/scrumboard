<?php



/**
 * This class defines the structure of the 'Helix_router' table.
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
class HelixRouterTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Scrumboard.map.HelixRouterTableMap';

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
        $this->setName('Helix_router');
        $this->setPhpName('HelixRouter');
        $this->setClassname('HelixRouter');
        $this->setPackage('Scrumboard');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, false);
        $this->addColumn('seolink', 'Seolink', 'VARCHAR', true, 255, null);
        $this->addColumn('module', 'Module', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('HelixRouterArgument', 'HelixRouterArgument', RelationMap::ONE_TO_MANY, array('id' => 'router_id', ), null, null, 'HelixRouterArguments');
    } // buildRelations()

} // HelixRouterTableMap
