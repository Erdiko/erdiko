<?php
/**
 * Wrapper for php file commmands
 * 
 * @category   Erdiko
 * @package    core
 * @copyright Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author	Varun Brahme varun@arroyolabs.com
 */
namespace erdiko\core\cache;
use erdiko\core\datasource\File;
use erdiko\core\cache\CacheableInterface;

class FileCache extends File implements CacheableInterface{

	protected $_fileData=array();

	public function __construct($cacheDir=null)
	{
		if(!isset($cacheDir))
		{
			$rootFolder=dirname(dirname(dirname(__DIR__))); 
			$cacheDir=$rootFolder."/var/cache";
		}
		parent::__construct($cacheDir);
	}

	public function set($key,$data)
	{
		$filename=null;
		if(isset($this->_fileData[(string)$key]))
			$filename=$this->_fileData[(string)$key];
		if(!isset($filename))
			$filename=$key;
		if($this->write($data,$filename))
		{
			$this->_fileData[(string)$key]=$filename;
			return true;
		}
		else
			return false;
	}
	
	public function append($key,$data)
	{
		$filename=null;
		if(isset($this->_fileData[(string)$key]))
			$filename=$this->_fileData[(string)$key];
		if(!isset($filename))
			$filename=$key;
		if($this->write($data,$filename,null,"a"))
		{
			$this->_fileData[(string)$key]=$filename;
			return true;
		}
		else
			return false;
	}
	
	public function get($key)
	{
		$filename=null;
		if(isset($this->_fileData[(string)$key]))
			$filename=$this->_fileData[(string)$key];
		if(!isset($filename))
			return false;
		else
			return $this->read($filename);
	}
	
	public function deleteFromCache($key)
	{
		$filename=null;
		if(isset($this->_fileData[(string)$key]))
			$filename=$this->_fileData[(string)$key];
		if(!isset($filename))
			return false;
		else
		{
			if($this->delete($filename))
			{
				unset($this->_fileData[(string)$key]);
				return true;
			}
			return false;
		}
			
	}
	
	public function exists($key)
	{
		$filename=null;
		if(isset($this->_fileData[(string)$key]))
			$filename=$this->_fileData[(string)$key];
		return(isset($filename) && $this->fileExists($filename));
	}
	
	public function clearCache()
	{
		$ret=true;
		foreach($this->_fileData as $key => $filename)
			$ret = $ret && $this->delete($filename);
		if($ret)
		{
			$this->_fileData = array();
			return true;
		}
		return false;
			
		
	}
}

?>