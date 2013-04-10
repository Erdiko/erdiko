<?php
/**
 * Wrapper for php file commmands
 * 
 * @category   Erdiko
 * @package    core
 * @copyright Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author	Varun Brahme varun@arroyolabs.com
 */
namespace erdiko\core\datasource;

class File{

	protected $_defaultPath =null;
	
	public function __construct($defaultPath=null)
	{	
		if(isset($defaultPath))
			$this->_defaultPath=$defaultPath;
		else
		{
			$rootFolder=dirname(dirname(dirname(__DIR__))); 
			$this->_defaultPath=$rootFolder."/var";
		}
		if(!is_dir($this->_defaultPath))
			mkdir($this->_defaultPath,null,true);
			
	}
	
	/**
	 * @param string $filename, string $path
	 * @return int $ret - bytes written to file
	 */
	public function write($string,$filename,$pathToFile=null,$mode=null)
	{
		if($pathToFile==null)
			$pathToFile=$this->_defaultPath;
		if($mode==null)
			$mode="w";
		if(is_dir($pathToFile))
		{
			$fh=fopen($pathToFile."/".$filename,$mode);
			$ret=fwrite($fh,$string);
			fclose($fh);
			return $ret;
		}
		else
			return false;
	}
	
	public function read($filename,$pathToFile=null)
	{
		if($pathToFile==null)
			return file_get_contents($this->_defaultPath."/".$filename);
		else
			return file_get_contents($pathToFile."/".$filename);
	}
	
	public function delete($filename,$pathToFile=null)
	{
		if($pathToFile==null)
			$pathToFile=$this->_defaultPath;
		if(file_exists($pathToFile."/".$filename))
			return unlink($pathToFile."/".$filename);
		else 
			return false;
	}
	
	public function move($filename,$pathTo,$pathFrom=null)
	{
		if($pathFrom==null)
			$pathFrom=$this->_defaultPath;
		if(file_exists($pathFrom."/".$filename))
			return rename($pathFrom."/".$filename,$pathTo."/".$filename);
		else 
			return null;
	}
	
	public function rename($oldName,$newName,$pathToFile=null)
	{
		if($pathToFile==null)
			$pathToFile=$this->_defaultPath;
		if(file_exists($pathToFile."/".$oldName))
			return rename($pathToFile."/".$oldName,$pathToFile."/".$newName);
		else 
			return false;
	}
	
	public function copy($filename,$newFilePath,$newFileName=null,$pathToFile=null)
	{
		if($pathToFile==null)
			$pathToFile=$this->_defaultPath;
		if($newFileName==null)
			$newFileName=$filename;
		if(file_exists($pathToFile."/".$filename))
			return copy($pathToFile."/".$filename,$newFilePath."/".$newFileName);
		else 
			return false;
	}
	
	public function fileExists($filename,$pathToFile=null)
	{
		if($pathToFile==null)
			$pathToFile=$this->_defaultPath;
		return file_exists($pathToFile."/".$filename);
	}
	
	public function __destruct()
	{
	}
}

?>