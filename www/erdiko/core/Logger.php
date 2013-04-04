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

	protected $_logFilename="erdiko.log";
	protected $_exceptionLogFilename="erdiko_error.log";
	
	const WARNING = "Warning";
	const ERROR = "Error";
	const NOTICE = "Notice";
	const INFO = "Info";
	
	public function __construct($logDir=null)
	{	
		if($logDir!=null && is_dir($logDir))
			$this->_defaultPath=$logDir;
		else
		{
			$rootFolder=dirname(dirname(__DIR__)); 
			$this->_defaultPath=$rootFolder."/var/logs";
		}
	}
	
	/**
	 * @param string $logstring
	 */
	public function log($log,$logLevel=null)
	{
		if($logLevel==null)
			$logLevel=Logger::INFO;
		else if($logLevel==Logger::ERROR)
			$this->logException($log);
		else
		{
			$logString=date('Y-m-d H:i:s')." ".$logLevel." ".$log.PHP_EOL;
			$this->write($logString,$this->_logFilename,null,"a");
		}
	}
	
	/**
	 * @param string $exceptionString
	 */
	public function logException($exception)
	{
		$exceptionLogString=date('Y-m-d H:i:s')." ".Logger::ERROR." ".$exception.PHP_EOL;
		$this->write($exceptionLogString,$this->_exceptionLogFilename,null,"a");
	}
	
	public function __destruct()
	{
	}
}

?>