<?php
/**
 * default theme engine
 * 
 * @category   Erdiko
 * @package    ThemeEngine
 * @module	   Theme
 * @copyright Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author	John Arroyo
 *
 * @todo add interface to this module
 */
namespace erdiko\modules\theme;

use erdiko\core\Module;
use erdiko\core\interfaces\Theme;

class ThemeEngine extends Module implements Theme
{
	private $_folder;
	private $_themeName;
	private $_templates;
	private $_data;
	
	public function __construct()
	{
		$this->_templates = array(
			'header' => 'header',
		);
	}
	
	public function getThemeFolder()
	{
		return $this->_folder;
	}
	
	/**
	 * @todo get the url programmatically.
	 */
	public function getThemeUrl()
	{
		return '/erdiko/theme/default';
	}
	
	public function getHeader($name = "")
	{
		return "Header";
	}
	
	public function getFooter($name = "")
	{
		return "Footer";
	}
		
	public function getFile($section)
	{
		
	}
	
	public function getMainContent($name = "", $options = null)
	{
		return "Main Content...";
	}
	
	public function getSidebar($name = "", $options = null)
	{
		return "sidebar";
	}
	
	public function getLayout()
	{
		$layoutName = "1";
		$filename = $this->_folder.'/templates/layout-'.$layoutName.'.phtml';
		$html = $this->getTemplateFile($filename, $this);
		echo $html;
	}
	
	public function loadTheme($namespace, $themeName)
	{
		if($namespace = 'core')
			$this->_folder = dirname(dirname(__DIR__)).'/theme/'.$themeName;
		else
			$this->_folder = dirname(dirname(dirname(__DIR__))).'/app/theme/'.$themeName; // @todo fix this line...
		
		$this->_themeName = $themeName;
	}
	
	public function setData($data)
	{
		$this->_data = $data;
	}
	
	public function theme($data)
	{
		$filename = $this->_folder.'/templates/page.phtml';
		$this->setData($data);
		$html = $this->getTemplateFile($filename, $this);
		echo $html;
	}
	
	function getTemplateFile($filename, $data)
	{	
		error_log("get file: $filename");
		
	    if (is_file($filename))
		{
			ob_start();
			include $filename;
			return ob_get_clean();
	    }
	    return false;
	}
}