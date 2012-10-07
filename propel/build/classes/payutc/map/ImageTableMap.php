<?php

namespace Payutc\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'ts_image_img' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.payutc.map
 */
class ImageTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'payutc.map.ImageTableMap';

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
        $this->setName('ts_image_img');
        $this->setPhpName('Image');
        $this->setClassname('Payutc\\Image');
        $this->setPackage('payutc');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('IMG_ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('IMG_MIME', 'Mime', 'VARCHAR', true, 20, null);
        $this->addColumn('IMG_WIDTH', 'Width', 'INTEGER', true, 5, null);
        $this->addColumn('IMG_LENGTH', 'Length', 'INTEGER', true, 5, null);
        $this->addColumn('IMG_CONTENT', 'Content', 'BLOB', true, null, null);
        $this->addColumn('IMG_REMOVED', 'Removed', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Item', 'Payutc\\Item', RelationMap::ONE_TO_MANY, array('img_id' => 'img_id', ), null, null, 'Items');
        $this->addRelation('User', 'Payutc\\User', RelationMap::ONE_TO_MANY, array('img_id' => 'img_id', ), null, 'CASCADE', 'Users');
    } // buildRelations()

} // ImageTableMap
