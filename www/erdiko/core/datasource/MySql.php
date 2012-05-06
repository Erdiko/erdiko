<?php
/**
 * MySQL datasource
 * Database wrapper for mysql
 * 
 * @category   Erdiko
 * @package    core
 * @copyright Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author	John Arroyo, john@arroyolabs.com
 * @todo re-implement in PDO?
 */
namespace erdiko\core\datasource;

class MySql
{
	private $_db = null;
	private $_host;
	private $_user;
	private $_pass;
	private $_database;
	
	public function __construct($host, $user, $pass, $database)
	{	
		$this->_host = $host;
		$this->_user = $user;
		$this->_pass = $pass;
		$this->_database = $database;
		
		$this->getWriteConnection();
	}
	
	public function getReadConnection()
	{
		return $this->getWriteConnection();
	}
	
	public function getWriteConnection()
	{
		$this->_db = mysql_connect($this->_host, $this->_user, $this->_pass);
		mysql_select_db($this->_database, $this->_db);
		
		return $this->_db;
	}
	
	/**
	 * @param string $query
	 * @return array $rows
	 */
	public function query($sql)
	{
		if($this->_db == null)
			$this->getWriteConnection();
		
		$data =  mysql_query($sql, $this->_db);
		$rows = array();
		
		while($row = mysql_fetch_array($data))
			$rows[] = $row;
		
		return $rows;
	}
	
	/**
	 * @param string $sql
	 * @return int $id, insert id
	 */
	public function write($sql)
	{
		if($this->_db == null)
			$this->getWriteConnection();
		
		$data =  mysql_query($sql, $this->_db);
		$id = mysql_insert_id();
		// error_log("write: $id");
		
		return $id;
	}
	
	public function __destruct()
	{
		mysql_close($this->_db);
	}
}

?>