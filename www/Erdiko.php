<?php
/**
 * Erdiko
 * All factory classes and global helper
 * 
 * @category	Erdiko
 * @package		Erdiko
 * @copyright 	Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author		John Arroyo, john@arroyolabs.com
 */

class Erdiko
{
	/**
	 * Factory Module Classes
	 */
	public static function getModule($moduleName)
	{
		
	}
	
	/**
	 * get the registered theme
	 * @param string $name
	 * @param string $namespace
	 * @param string $path
	 * @return object $theme
	 */
	public static function getTheme($name = 'default', $namespace = '\erdiko\theme\default', $path = '/erdiko/theme/default', $extras = null)
	{
		// get Theme
		$themeEngine = new \erdiko\modules\theme\ThemeEngine;
		$themeEngine->loadTheme($name, $namespace, $path, $extras);
		
		return $themeEngine;
	}
	
	/**
	 * Load a template file from a module
	 * @param string $filename
	 * @param mixed $data, data to expose to template
	 * 
	 * @todo can we deprecate this function and only use the one in the theme engine? -John
	 */
	public static function getTemplate($filename, $data)
	{
		if (is_file($filename))
		{
			ob_start();
			include $filename;
			return ob_get_clean();
		}
		return false;
	}

	/**
	 * Load a view from the current theme with the given data
	 * 
	 * @param string $file
	 * @param array $data
	 * 
	 * @todo deprecate this function -John 
	 * @todo render views with the theme engine instead
	 * @note this based off of the core handler function of the same name
	 */
	public static function getView($data = null, $file = null)
	{
		// $this->_data['layout']['columns']
		$webroot = WEBROOT;
		$config = Erdiko::getConfigFile($webroot."/app/config/contexts/"."default".".json");
		$localConfig['theme'] = $config['theme'];

		$filename = $webroot.$localConfig['theme']['path'].'/views/'.$file;
		return  Erdiko::getTemplate($filename, $data);
	}
	
	/**
	 * Read JSON config file and return array
	 * @param filename $filename
	 * @return array $config
	 */
	public static function getConfigFile($file)
	{
		$data = str_replace("\\", "\\\\", file_get_contents($file));
		$json = json_decode($data, TRUE);
		
		return $json;
	}
	
	public static function getConfig($name)
	{
		// @todo check cache first
		$webroot = __DIR__;
		$file = $webroot."/app/config/$name.json";
		
		return self::getConfigFile($file);
	}
	
	/**
	 * Get the compiled application routes from the config files
	 * 
	 * @todo cache the loaded/compiled routes
	 */
	public static function getRoutes()
	{
		$file = __DIR__.'/app/config/application.json';
		$applicationConfig = Erdiko::getConfigFile($file);
		
		return $applicationConfig['routes'];
	}
	
	/**
	 * send email
	 */
	public static function sendEmail($toEmail, $subject, $body, $fromEmail)
	{	
		$headers = "From: $fromEmail\r\n" .
			"Reply-To: $fromEmail\r\n" .
			"X-Mailer: PHP/" . phpversion();
		
		return mail($toEmail, $subject, $body, $headers);
	}

	/**
	 * getModel
	 * Currently only works with zend models
	 * Model Factory (eventually turn it into a factory and/or leverage singletons)
	 * @usage Erdiko::getModel('Product_Service');
	 * @param string $modelName, with no preceeding backslash
	 * @return 
	 * @todo throw exception if load fails
	 */
	public static function getModel($modelName)
	{
		$class = "\\$modelName";
		return new $class;
	}

	/**
	 * getService
	 * Service Factory (eventually turn it into a factory and/or leverage singletons)
	 * @usage Erdiko::getService('product'); // first character does not have to be uppercase
	 * @return 
	 * @todo throw exception if load fails
	 */
	public static function getService($service)
	{
		$class = "\\".ucfirst($service)."_Service";
		return new $class;
	}
	
	/**
	 * getTable
	 * Service Factory (eventually turn it into a factory and/or leverage singletons)
	 * @usage Erdiko::getTable('product'); // first character does not have to be uppercase
	 * @usage Erdiko::getTable('Product_Index');
	 * @return 
	 * @todo throw exception if load fails?
	 */
	public static function getTable($table)
	{
		$class = "\\".ucfirst($table)."_Table";
		return new $class;
	}
	
	/**
	 * writeToFile
	 * @usage Erdiko::writeToFile('sample string',filename,path,mode); 
	 * @return 
	 */
	public static function writeToFile($string,$filename,$path=null,$mode=null)
	{
		$fileObj = new \erdiko\core\datasource\File();
		return $fileObj->write($string,$filename,$path,$mode);
	}
	
	public static function readFromFile($filename,$path=null)
	{
		$fileObj = new \erdiko\core\datasource\File();
		return $fileObj->read($filename,$path);
	}
	
	public static function deleteFile($filename,$path=null)
	{
		$fileObj = new \erdiko\core\datasource\File();
		return $fileObj->delete($filename,$path);
	}
	
	public static function moveFile($filename,$pathTo,$pathFrom=null)
	{
		$fileObj = new \erdiko\core\datasource\File();
		return $fileObj->move($filename,$pathTo,$pathFrom=null);
	}
	
	public static function copyFile($filename,$newFilePath,$newFileName=null,$path=null)
	{
		$fileObj = new \erdiko\core\datasource\File();
		return $fileObj->copy($filename,$newFilePath,$newFileName,$path);
	}
	
	public static function renameFile($oldName,$newName,$path=null)
	{
		$fileObj = new \erdiko\core\datasource\File();
		return $fileObj->rename($oldName,$newName,$path);
	}
	
	/**
	 * log
	 * @usage Erdiko::logNotice('Sample notice',Logger::LogLevel)
	 * Need to import erdiko\core\Logger to use this function
	 * @todo add log level as a number instead of a constant
	 * @return 
	 */
	public static function log($logString,$logLevel=null)
	{
		$logObj=new \erdiko\core\Logger();
		$logObj->log($logString,$logLevel);
	}
	
	/**
	 * logException
	 * @usage Erdiko::logException('Sample exception');
	 * @return 
	 */
	public static function logException($exception)
	{
		$logObj=new \erdiko\core\Logger();
		$logObj->logException($exception);
	}
	
	/**
	 * logWarning
	 * @usage Erdiko::logWarning('Sample warning');
	 * @return 
	 */
	public static function logWarning($warning)
	{
		$logObj=new \erdiko\core\Logger();
		$logObj->log($warning,Logger::WARNING);
	}
	
	/**
	 * logInfo
	 * @usage Erdiko::logInfo('Sample info log');
	 * @return 
	 */
	public static function logInfo($info)
	{
		$logObj=new \erdiko\core\Logger();
		$logObj->log($info,Logger::INFO);
	}
	
	/**
	 * logNotice
	 * @usage Erdiko::logNotice('Sample notice');
	 * @return 
	 */
	public static function logNotice($notice)
	{
		$logObj=new \erdiko\core\Logger();
		$logObj->log($notice,Logger::NOTICE);
	}
	
}