<?php

/**
 * Base static class for performing query and update operations on the 'stat_activity_daily' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Jun  1 18:48:13 2011
 *
 * @package    lib.model.om
 */
abstract class BaseStatActivityDailyPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'stat_activity_daily';

	/** the related Propel class for this table */
	const OM_CLASS = 'StatActivityDaily';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.StatActivityDaily';

	/** the related TableMap class for this table */
	const TM_CLASS = 'StatActivityDailyTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'stat_activity_daily.ID';

	/** the column name for the DATE field */
	const DATE = 'stat_activity_daily.DATE';

	/** the column name for the SHARES field */
	const SHARES = 'stat_activity_daily.SHARES';

	/** the column name for the CLICKS field */
	const CLICKS = 'stat_activity_daily.CLICKS';

	/** the column name for the CLICKS_SHARES field */
	const CLICKS_SHARES = 'stat_activity_daily.CLICKS_SHARES';

	/** the column name for the AVG_SHARE_AGENTS field */
	const AVG_SHARE_AGENTS = 'stat_activity_daily.AVG_SHARE_AGENTS';

	/** the column name for the AVG_SHARE_ACTIVE_AGENTS field */
	const AVG_SHARE_ACTIVE_AGENTS = 'stat_activity_daily.AVG_SHARE_ACTIVE_AGENTS';

	/** the column name for the AVG_CLICKS_AGENTS field */
	const AVG_CLICKS_AGENTS = 'stat_activity_daily.AVG_CLICKS_AGENTS';

	/** the column name for the AVG_CLICKS_ACTIVE_AGENTS field */
	const AVG_CLICKS_ACTIVE_AGENTS = 'stat_activity_daily.AVG_CLICKS_ACTIVE_AGENTS';

	/** the column name for the ADVERTISE_CATALOG field */
	const ADVERTISE_CATALOG = 'stat_activity_daily.ADVERTISE_CATALOG';

	/** the column name for the ACTIVE_ADVERTISE field */
	const ACTIVE_ADVERTISE = 'stat_activity_daily.ACTIVE_ADVERTISE';

	/** the column name for the ACTIVE_UNACTIVE_ADVERTISE field */
	const ACTIVE_UNACTIVE_ADVERTISE = 'stat_activity_daily.ACTIVE_UNACTIVE_ADVERTISE';

	/** the column name for the ADVERTISE_SHARES field */
	const ADVERTISE_SHARES = 'stat_activity_daily.ADVERTISE_SHARES';

	/** the column name for the ADVERTISE_CLICKS field */
	const ADVERTISE_CLICKS = 'stat_activity_daily.ADVERTISE_CLICKS';

	/** the column name for the ACTIVE_ADVERTISE_SHARES field */
	const ACTIVE_ADVERTISE_SHARES = 'stat_activity_daily.ACTIVE_ADVERTISE_SHARES';

	/** the column name for the ACTIVE_ADVERTISE_CLICKS field */
	const ACTIVE_ADVERTISE_CLICKS = 'stat_activity_daily.ACTIVE_ADVERTISE_CLICKS';

	/** the column name for the ADVERTISE_ADVERTS field */
	const ADVERTISE_ADVERTS = 'stat_activity_daily.ADVERTISE_ADVERTS';

	/**
	 * An identiy map to hold any loaded instances of StatActivityDaily objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array StatActivityDaily[]
	 */
	public static $instances = array();


	// symfony behavior
	
	/**
	 * Indicates whether the current model includes I18N.
	 */
	const IS_I18N = false;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Date', 'Shares', 'Clicks', 'ClicksShares', 'AvgShareAgents', 'AvgShareActiveAgents', 'AvgClicksAgents', 'AvgClicksActiveAgents', 'AdvertiseCatalog', 'ActiveAdvertise', 'ActiveUnactiveAdvertise', 'AdvertiseShares', 'AdvertiseClicks', 'ActiveAdvertiseShares', 'ActiveAdvertiseClicks', 'AdvertiseAdverts', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'date', 'shares', 'clicks', 'clicksShares', 'avgShareAgents', 'avgShareActiveAgents', 'avgClicksAgents', 'avgClicksActiveAgents', 'advertiseCatalog', 'activeAdvertise', 'activeUnactiveAdvertise', 'advertiseShares', 'advertiseClicks', 'activeAdvertiseShares', 'activeAdvertiseClicks', 'advertiseAdverts', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::DATE, self::SHARES, self::CLICKS, self::CLICKS_SHARES, self::AVG_SHARE_AGENTS, self::AVG_SHARE_ACTIVE_AGENTS, self::AVG_CLICKS_AGENTS, self::AVG_CLICKS_ACTIVE_AGENTS, self::ADVERTISE_CATALOG, self::ACTIVE_ADVERTISE, self::ACTIVE_UNACTIVE_ADVERTISE, self::ADVERTISE_SHARES, self::ADVERTISE_CLICKS, self::ACTIVE_ADVERTISE_SHARES, self::ACTIVE_ADVERTISE_CLICKS, self::ADVERTISE_ADVERTS, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'date', 'shares', 'clicks', 'clicks_shares', 'avg_share_agents', 'avg_share_active_agents', 'avg_clicks_agents', 'avg_clicks_active_agents', 'advertise_catalog', 'active_advertise', 'active_unactive_advertise', 'advertise_shares', 'advertise_clicks', 'active_advertise_shares', 'active_advertise_clicks', 'advertise_adverts', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Date' => 1, 'Shares' => 2, 'Clicks' => 3, 'ClicksShares' => 4, 'AvgShareAgents' => 5, 'AvgShareActiveAgents' => 6, 'AvgClicksAgents' => 7, 'AvgClicksActiveAgents' => 8, 'AdvertiseCatalog' => 9, 'ActiveAdvertise' => 10, 'ActiveUnactiveAdvertise' => 11, 'AdvertiseShares' => 12, 'AdvertiseClicks' => 13, 'ActiveAdvertiseShares' => 14, 'ActiveAdvertiseClicks' => 15, 'AdvertiseAdverts' => 16, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'date' => 1, 'shares' => 2, 'clicks' => 3, 'clicksShares' => 4, 'avgShareAgents' => 5, 'avgShareActiveAgents' => 6, 'avgClicksAgents' => 7, 'avgClicksActiveAgents' => 8, 'advertiseCatalog' => 9, 'activeAdvertise' => 10, 'activeUnactiveAdvertise' => 11, 'advertiseShares' => 12, 'advertiseClicks' => 13, 'activeAdvertiseShares' => 14, 'activeAdvertiseClicks' => 15, 'advertiseAdverts' => 16, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::DATE => 1, self::SHARES => 2, self::CLICKS => 3, self::CLICKS_SHARES => 4, self::AVG_SHARE_AGENTS => 5, self::AVG_SHARE_ACTIVE_AGENTS => 6, self::AVG_CLICKS_AGENTS => 7, self::AVG_CLICKS_ACTIVE_AGENTS => 8, self::ADVERTISE_CATALOG => 9, self::ACTIVE_ADVERTISE => 10, self::ACTIVE_UNACTIVE_ADVERTISE => 11, self::ADVERTISE_SHARES => 12, self::ADVERTISE_CLICKS => 13, self::ACTIVE_ADVERTISE_SHARES => 14, self::ACTIVE_ADVERTISE_CLICKS => 15, self::ADVERTISE_ADVERTS => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'date' => 1, 'shares' => 2, 'clicks' => 3, 'clicks_shares' => 4, 'avg_share_agents' => 5, 'avg_share_active_agents' => 6, 'avg_clicks_agents' => 7, 'avg_clicks_active_agents' => 8, 'advertise_catalog' => 9, 'active_advertise' => 10, 'active_unactive_advertise' => 11, 'advertise_shares' => 12, 'advertise_clicks' => 13, 'active_advertise_shares' => 14, 'active_advertise_clicks' => 15, 'advertise_adverts' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. StatActivityDailyPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(StatActivityDailyPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(StatActivityDailyPeer::ID);
		$criteria->addSelectColumn(StatActivityDailyPeer::DATE);
		$criteria->addSelectColumn(StatActivityDailyPeer::SHARES);
		$criteria->addSelectColumn(StatActivityDailyPeer::CLICKS);
		$criteria->addSelectColumn(StatActivityDailyPeer::CLICKS_SHARES);
		$criteria->addSelectColumn(StatActivityDailyPeer::AVG_SHARE_AGENTS);
		$criteria->addSelectColumn(StatActivityDailyPeer::AVG_SHARE_ACTIVE_AGENTS);
		$criteria->addSelectColumn(StatActivityDailyPeer::AVG_CLICKS_AGENTS);
		$criteria->addSelectColumn(StatActivityDailyPeer::AVG_CLICKS_ACTIVE_AGENTS);
		$criteria->addSelectColumn(StatActivityDailyPeer::ADVERTISE_CATALOG);
		$criteria->addSelectColumn(StatActivityDailyPeer::ACTIVE_ADVERTISE);
		$criteria->addSelectColumn(StatActivityDailyPeer::ACTIVE_UNACTIVE_ADVERTISE);
		$criteria->addSelectColumn(StatActivityDailyPeer::ADVERTISE_SHARES);
		$criteria->addSelectColumn(StatActivityDailyPeer::ADVERTISE_CLICKS);
		$criteria->addSelectColumn(StatActivityDailyPeer::ACTIVE_ADVERTISE_SHARES);
		$criteria->addSelectColumn(StatActivityDailyPeer::ACTIVE_ADVERTISE_CLICKS);
		$criteria->addSelectColumn(StatActivityDailyPeer::ADVERTISE_ADVERTS);
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(StatActivityDailyPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			StatActivityDailyPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(StatActivityDailyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BaseStatActivityDailyPeer', $criteria, $con);
		}

		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     StatActivityDaily
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = StatActivityDailyPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return StatActivityDailyPeer::populateObjects(StatActivityDailyPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(StatActivityDailyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			StatActivityDailyPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BaseStatActivityDailyPeer', $criteria, $con);
		}


		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      StatActivityDaily $value A StatActivityDaily object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(StatActivityDaily $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A StatActivityDaily object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof StatActivityDaily) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or StatActivityDaily object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     StatActivityDaily Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to stat_activity_daily
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = StatActivityDailyPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = StatActivityDailyPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = StatActivityDailyPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				StatActivityDailyPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseStatActivityDailyPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseStatActivityDailyPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new StatActivityDailyTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean  Whether or not to return the path wit hthe class name 
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? StatActivityDailyPeer::CLASS_DEFAULT : StatActivityDailyPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a StatActivityDaily or Criteria object.
	 *
	 * @param      mixed $values Criteria or StatActivityDaily object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseStatActivityDailyPeer:doInsert:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseStatActivityDailyPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(StatActivityDailyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from StatActivityDaily object
		}

		if ($criteria->containsKey(StatActivityDailyPeer::ID) && $criteria->keyContainsValue(StatActivityDailyPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.StatActivityDailyPeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseStatActivityDailyPeer:doInsert:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseStatActivityDailyPeer', $values, $con, $pk);
    }

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a StatActivityDaily or Criteria object.
	 *
	 * @param      mixed $values Criteria or StatActivityDaily object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseStatActivityDailyPeer:doUpdate:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseStatActivityDailyPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(StatActivityDailyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(StatActivityDailyPeer::ID);
			$selectCriteria->add(StatActivityDailyPeer::ID, $criteria->remove(StatActivityDailyPeer::ID), $comparison);

		} else { // $values is StatActivityDaily object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseStatActivityDailyPeer:doUpdate:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseStatActivityDailyPeer', $values, $con, $ret);
    }

    return $ret;
	}

	/**
	 * Method to DELETE all rows from the stat_activity_daily table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(StatActivityDailyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(StatActivityDailyPeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			StatActivityDailyPeer::clearInstancePool();
			StatActivityDailyPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a StatActivityDaily or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or StatActivityDaily object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(StatActivityDailyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			StatActivityDailyPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof StatActivityDaily) { // it's a model object
			// invalidate the cache for this single object
			StatActivityDailyPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(StatActivityDailyPeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				StatActivityDailyPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			StatActivityDailyPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given StatActivityDaily object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      StatActivityDaily $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(StatActivityDaily $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(StatActivityDailyPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(StatActivityDailyPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(StatActivityDailyPeer::DATABASE_NAME, StatActivityDailyPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     StatActivityDaily
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = StatActivityDailyPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(StatActivityDailyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(StatActivityDailyPeer::DATABASE_NAME);
		$criteria->add(StatActivityDailyPeer::ID, $pk);

		$v = StatActivityDailyPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(StatActivityDailyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(StatActivityDailyPeer::DATABASE_NAME);
			$criteria->add(StatActivityDailyPeer::ID, $pks, Criteria::IN);
			$objs = StatActivityDailyPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	// symfony behavior
	
	/**
	 * Returns an array of arrays that contain columns in each unique index.
	 *
	 * @return array
	 */
	static public function getUniqueColumnNames()
	{
	  return array(array('date'));
	}

	// symfony_behaviors behavior
	
	/**
	 * Returns the name of the hook to call from inside the supplied method.
	 *
	 * @param string $method The calling method
	 *
	 * @return string A hook name for {@link sfMixer}
	 *
	 * @throws LogicException If the method name is not recognized
	 */
	static private function getMixerPreSelectHook($method)
	{
	  if (preg_match('/^do(Select|Count)(Join(All(Except)?)?|Stmt)?/', $method, $match))
	  {
	    return sprintf('BaseStatActivityDailyPeer:%s:%1$s', 'Count' == $match[1] ? 'doCount' : $match[0]);
	  }
	
	  throw new LogicException(sprintf('Unrecognized function "%s"', $method));
	}

} // BaseStatActivityDailyPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseStatActivityDailyPeer::buildTableMap();

