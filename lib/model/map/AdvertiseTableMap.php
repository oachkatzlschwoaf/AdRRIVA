<?php


/**
 * This class defines the structure of the 'advertise' table.
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
class AdvertiseTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AdvertiseTableMap';

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
		$this->setName('advertise');
		$this->setPhpName('Advertise');
		$this->setClassname('Advertise');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, 11, null);
		$this->addColumn('TYPE', 'Type', 'INTEGER', true, 3, null);
		$this->addForeignKey('OWNER_ID', 'OwnerId', 'INTEGER', 'user', 'ID', true, 11, null);
		$this->addForeignKey('CATEGORY_ID', 'CategoryId', 'INTEGER', 'advertise_catalog', 'ID', true, 11, null);
		$this->addColumn('STATUS', 'Status', 'INTEGER', true, 3, null);
		$this->addColumn('SUBJECT', 'Subject', 'VARCHAR', true, 100, null);
		$this->addColumn('TEXT', 'Text', 'VARCHAR', true, 300, null);
		$this->addColumn('IMAGE', 'Image', 'VARCHAR', true, 300, null);
		$this->addColumn('HTML', 'Html', 'LONGVARCHAR', true, null, null);
		$this->addColumn('URL', 'Url', 'VARCHAR', true, 300, null);
		$this->addColumn('COST', 'Cost', 'INTEGER', true, 5, null);
		$this->addColumn('AGENTS', 'Agents', 'INTEGER', true, 7, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('owner_id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('AdvertiseCatalog', 'AdvertiseCatalog', RelationMap::MANY_TO_ONE, array('category_id' => 'id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('StatAdvertDaily', 'StatAdvertDaily', RelationMap::ONE_TO_MANY, array('id' => 'ad_id', ), 'CASCADE', 'CASCADE');
    $this->addRelation('UserAdvertise', 'UserAdvertise', RelationMap::ONE_TO_MANY, array('id' => 'advertise_id', ), 'CASCADE', 'CASCADE');
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
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // AdvertiseTableMap
