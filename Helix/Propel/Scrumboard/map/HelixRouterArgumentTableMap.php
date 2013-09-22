<?php



/**
 * This class defines the structure of the 'Helix_router_argument' table.
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
class HelixRouterArgumentTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Scrumboard.map.HelixRouterArgumentTableMap';

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
        $this->setName('Helix_router_argument');
        $this->setPhpName('HelixRouterArgument');
        $this->setClassname('HelixRouterArgument');
        $this->setPackage('Scrumboard');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('router_id', 'RouterId', 'INTEGER', 'Helix_router', 'id', true, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 32, null);
        $this->addColumn('value', 'Value', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('HelixRouter', 'HelixRouter', RelationMap::MANY_TO_ONE, array('router_id' => 'id', ), null, null);
    } // buildRelations()

} // HelixRouterArgumentTableMap
