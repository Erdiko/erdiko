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
	
	public function __construct()
	{	
		$rootFolder=dirname(dirname(dirname(__DIR__))); 
		$this->_defaultPath=$rootFolder."/var";
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
			return null;
	}
	
	public function __destruct()
	{
	}
}

?>