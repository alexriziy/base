<?php

namespace Triangulum\WebsiteBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'group' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Triangulum.WebsiteBundle.Model.map
 */
class GroupTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Triangulum.WebsiteBundle.Model.map.GroupTableMap';

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
        $this->setName('group');
        $this->setPhpName('Group');
        $this->setClassname('Triangulum\\WebsiteBundle\\Model\\Group');
        $this->setPackage('src.Triangulum.WebsiteBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('parentId', 'ParentId', 'INTEGER', false, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 300, null);
        $this->addColumn('role', 'Role', 'VARCHAR', true, 300, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', 'Triangulum\\WebsiteBundle\\Model\\User', RelationMap::ONE_TO_MANY, array('id' => 'groupId', ), 'CASCADE', null, 'Users');
    } // buildRelations()

} // GroupTableMap
