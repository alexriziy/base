<?php

namespace Triangulum\WebsiteBundle\Model\map;

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
 * @package    propel.generator.src.Triangulum.WebsiteBundle.Model.map
 */
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Triangulum.WebsiteBundle.Model.map.UserTableMap';

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
        $this->setClassname('Triangulum\\WebsiteBundle\\Model\\User');
        $this->setPackage('src.Triangulum.WebsiteBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('datetime', 'DateTime', 'INTEGER', true, null, null);
        $this->addColumn('username', 'UserName', 'VARCHAR', true, 300, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 300, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 300, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', true, 300, null);
        $this->addForeignKey('groupId', 'GroupId', 'INTEGER', 'group', 'id', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Group', 'Triangulum\\WebsiteBundle\\Model\\Group', RelationMap::MANY_TO_ONE, array('groupId' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // UserTableMap
