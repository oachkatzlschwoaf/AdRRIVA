<?php


/**
 * This class defines the structure of the 'advertise_catalog' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Jun  1 18:48:12 2011
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class AdvertiseCatalogTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AdvertiseCatalogTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('advertise_catalog');
		$this->setPhpName('AdvertiseCatalog');
		$this->setClassname('AdvertiseCatalog');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11, null);
		$this->addColumn('PARENT_ID', 'ParentId', 'INTEGER', false, 11, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 100, null);
		$this->addColumn('MIN_COST', 'MinCost', 'INTEGER', true, 5, null);
		$this->addColumn('ORDER_ID', 'OrderId', 'INTEGER', true, 5, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Advertise', 'Advertise', RelationMap::ONE_TO_MANY, array('id' => 'category_id', ), 'CASCADE', 'CASCADE');
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
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // AdvertiseCatalogTableMap
