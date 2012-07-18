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
use Erdiko;

class ThemeEngine extends Module implements Theme
{
	protected $_folder;
	protected $_themeName;
	protected $_namespace;
	protected $_templates;
	protected $_data;
	protected $_webroot;
	protected $_path;
	protected $_themeConfig;
	protected $_domainName;
	
	public function __construct()
	{
		$this->_templates = array(
			'header' => 'header',
		);
	}
	
	public function getWebroot()
	{
		return $this->_webroot;
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
		return $this->_path;
	}
	
	public function getCss()
	{
		return $this->_themeConfig['css'];
	} 
	
	public function getJs()
	{
		return $this->_themeConfig['js'];
	}
	
	public function getHeader($name = "")
	{	
		// return $this->_data['header'];
		$filename = $this->_webroot.$this->_themeConfig['templates']['header']['file'];
		$html = $this->getTemplateFile($filename, $this->_data['header']);
		
		return $html;
	}
	
	public function getFooter($name = "")
	{
		// return $this->_data['footer'];
		$filename = $this->_webroot.$this->_themeConfig['templates']['footer']['file'];
		$html = $this->getTemplateFile($filename, $this->_data['footer']);
		
		return $html;
	}
		
	public function getFile($section)
	{
		
	}
	
	public function getTitle()
	{
		return $this->_data['title'];
	}
	
	public function getMainContent($name = "", $options = null)
	{
		return $this->_data['main_content'];
	}
	
	public function getSidebar($name = "", $options = null)
	{
		// make sidebar name configurable to return particular pages
		return "sidebar: $name";
	}
	
	public function getLayout()
	{
		$numColumns = "1";
		if( isset($this->_data['layout']['columns']) )
			$numColumns = $this->_data['layout']['columns'];
		
		$filename = $this->_webroot.$this->_themeConfig['templates']['layout-'.$numColumns]['file'];
		$html = $this->getTemplateFile($filename, $this);
		echo $html;
	}
	
	public function mergeCss($first, $second)
	{
		foreach($second as $css)
			$first[] = array('file' => $css['file']);
		
		error_log('merge array: '.print_r($first, true));
		
		return $first;
	}
	
	public function mergeJs($first, $second)
	{
		foreach($second as $js)
			$first[] = array('file' => $js['file']);
		
		return $first;
	}
	
	/**
	 * @param string $themeName
	 * @param string $type, 'core' or 'app'
	 */
	public function loadTheme($name, $namespace, $path)
	{	
		$this->_webroot = dirname(dirname(dirname(__DIR__)));
		$this->_themeName = $name;
		$this->_path = $path;
		$this->_namespace = $namespace;
		$this->_domainName = 'http://'.$_SERVER['SERVER_NAME'];
		
		$this->_folder = $this->_webroot.$path;
		$file = $this->_folder.'/theme.inc';
		
		error_log('file: '.$file);
		
		$this->_themeConfig = Erdiko::getConfigFile($file);
		
		// If a parent theme exists, merge the theme configs
		if( isset($this->_themeConfig['parent']) )
		{
			$parentConfig = Erdiko::getConfigFile($this->_webroot.$this->_themeConfig['parent']);
			
			// $parentConfig['css'][] = $this->_themeConfig['css'][0];
			// $this->_themeConfig['css'] = $parentConfig['css'];
			$this->_themeConfig['css'] = $this->mergeCss($parentConfig['css'], $this->_themeConfig['css']);
			unset($parentConfig['css']);
			
			// $this->_themeConfig['css'] = array_merge($this->_themeConfig['css'], $parentConfig['css']);
			$this->_themeConfig['js'] = $this->mergeJs($parentConfig['js'], $this->_themeConfig['js']);
			unset($parentConfig['js']);
			
			// $this->_themeConfig['js'] = $this->_themeConfig['js'] + $parentConfig['js'];
			// $this->_themeConfig = $parentConfig + $this->_themeConfig;
			$this->_themeConfig['templates'] = $this->_themeConfig['templates'] + $parentConfig['templates'];
		}
		
		// error_log('themeEngine parent config: '.print_r($parentConfig, true));		
		// error_log('themeEngine config: '.print_r($this->_themeConfig, true));
	}
	
	public function setData($data)
	{
		$this->_data = $data;
	}
	
	public function theme($data)
	{
		$filename = $this->_webroot.$this->_themeConfig['templates']['page']['file'];
		
		// error_log("filename: $filename");
		// error_log('themeEngine config: '.print_r($this->_themeConfig['templates'], true));
		
		$this->setData($data);
		$html = $this->getTemplateFile($filename, $this);
		echo $html;
	}
	
	function getTemplateFile($filename, $data)
	{	
		// error_log("get file: $filename");
		
	    if (is_file($filename))
		{
			ob_start();
			include $filename;
			return ob_get_clean();
	    }
	    return false;
	}
}