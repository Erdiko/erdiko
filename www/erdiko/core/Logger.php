<?php
/**
 * Logging utility for Erdiko
 * 
 * @category   Erdiko
 * @package    core
 * @copyright Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author	Varun Brahme varun@arroyolabs.com
 */
namespace erdiko\core;

use erdiko\core\datasource\File;

class Logger extends File{
	
	protected $_logFiles = array(
		"default" => "erdiko.log",
	);
	
	const WARNING = "Warning";
	const ERROR = "Error";
	const NOTICE = "Notice";
	const INFO = "Info";
	
	public function __construct($logFiles=array(),$logDir=null)
	{
		// Set the log files
		if(!empty($logFiles))
			$this->_logFiles = array_merge($this->_logFiles,array_change_key_case($logFiles));
			
		
		// Set the logging directory
		if($logDir!=null && is_dir($logDir))
			$this->_defaultPath=$logDir;
		else
		{
			$rootFolder=dirname(dirname(__DIR__));
			$this->_defaultPath=$rootFolder."/var/logs";
		}
	}
	
	public function addLogFile($key,$logFileName)
	{
		$arrayKey=strtolower($key);
		return $this->_logFiles[$arrayKey] = $logFileName;
	}
	
	public function removeLogFile($key)
	{
		$arrayKey=strtolower($key);
		unset($this->_logFiles[$arrayKey]);
		return true;
	}
	
	/**
	 * @param string $logstring
	 * return value true/false
	 */
	public function log($log,$logLevel=null,$logKey=null)
	{
		$logFileName="";
		$logString="";
		if(is_string($log))
		{
			if($logLevel==null)
				$logLevel=Logger::INFO;
			$logString=date('Y-m-d H:i:s')." ".$logLevel." ".$log.PHP_EOL;
		}
		else
		{
			if("Exception" == get_class($log))
				$logString=date('Y-m-d H:i:s')." ".Logger::ERROR." ".$log.PHP_EOL;
		}
		
		if($logKey==null)
			$logFileName=$this->_logFiles["default"]; // If log key is null use the default log file
		else
		{
			$arrayKey=strtolower($logKey);
			if(isset($this->_logFiles[$arrayKey])) // If log key exists, use that log file
				$logFileName=$this->_logFiles[$arrayKey];
			else
				$logFileName=$this->_logFiles["default"]; // Otherwise use the default log file
		}
		
		return $this->write($logString,$logFileName,null,"a");	
	}
	
	public function clearLog($logKey=null)
	{
		$ret=true;
		if($logKey==null)
		{
			foreach($this->_logFiles as $key => $logFile)
				$ret = $ret && $this->write("",$logFile,null,"w");
			return $ret;
		}
		else
		{
			$arrayKey=strtolower($logKey);
			if(isset($this->_logFiles[$arrayKey]))
				return $this->write("",$this->_logFiles[$arrayKey],null,"w");
			else
				return 0;
		}
	}
	
	public function __destruct()
	{
	}
}

?>