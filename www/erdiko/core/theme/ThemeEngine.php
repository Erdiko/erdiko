<?php
/**
 * default theme engine
 * 
 * @category 	Erdiko
 * @package 	theme
 * @copyright 	Copyright (c) 2013, Arroyo Labs, www.arroyolabs.com
 * @author		John Arroyo
 *
 * @todo add interface to this engine
 */
namespace erdiko\core\theme;

use erdiko\core\ModelAbstract;
use erdiko\core\interfaces\Theme;
use erdiko\core\Config;
use Erdiko;

class ThemeEngine extends ModelAbstract implements Theme
{
	// @todo audit and remove unnecessary variables
	protected $_templates;
	protected $_data; // data injected by the controller
	protected $_title; // head title tag
	protected $_webroot;
	protected $_themeroot;
	protected $_themeConfig;
	protected $_contextConfig;
	protected $_extras;
	protected $_domainName;
	protected $_numColumns;
	protected $_sidebars;
	protected $_template = null;
	protected $_layout = null;
	
	public function __construct()
	{
		$this->_templates = array(
			'header' => 'header',
		);

		$this->_webroot = APPROOT;
		$this->_themeroot = WEBROOT;
	}
	
	public function getWebroot()
	{
		return $this->_webroot;
	}

	public function getThemeroot()
	{
		return $this->_themeroot;
	}
	
	public function getThemeFolder()
	{
		return $this->_themeroot.$this->_themeConfig['path'];
	}

	public function setLayout($layout)
	{
		$this->_layout = $layout;
	}
	
	public function getCss()
	{
		return $this->_themeConfig['css'];
	} 
	
	public function getJs()
	{
		return $this->_themeConfig['js'];
	}
	public function getPhpToJs()
	{
		return $this->_themeConfig['phpToJs'];
	}
	
	public function getMeta()
	{		
		return $this->_themeConfig['meta'];
	}
	
	public function getHeader($name = "")
	{	
		$filename = $this->_themeroot.$this->_themeConfig['templates']['header']['file'];
		$html = $this->getTemplateFile($filename, $this->getContextConfig());
		
		return $html;
	}
	
	public function getFooter($name = "")
	{
		// return $this->_data['footer'];
		$filename = $this->_themeroot.$this->_themeConfig['templates']['footer']['file'];
		$html = $this->getTemplateFile($filename, $this->getContextConfig());
		
		return $html;
	}
		
	public function getFile($section)
	{
		
	}
	
	/**
	 * Set the title that is in the body, e.g. "My Title" renders as (<H1>[My Title]</H1>)
	 * @param string $title
	 */
	public function setPageTitle($title)
	{
		$this->_data['title'] = $title;
	}

	public function getPageTitle()
	{
		return $this->_data['title'];
	}

	public function setTitle($title)
	{		
		$this->_title = $title;
	}

	public function getTitle()
	{		
		return $this->_title;
	}
	
	public function setSiteName($title)
	{		
		$this->_themeConfig['name'] = $title;
	}

	public function getSiteName()
	{		
		return $this->_themeConfig['name'];
	}

	public function getLayoutData()
	{		
		return $this->_extras['data'];
	}
	
	public function getMainContent($name = "", $options = null)
	{
		return $this->_data['main_content'];
	}
	
	public function getSidebar($name, $options = null)
	{
		try {
			if( isset($this->_sidebars[$name]) )
				$html = $this->renderSidebar($this->_sidebars[$name]);
			else
				$html = "";
		} catch (\Exception $e) {
			$html = $this->getExceptionHtml( $e->getMessage() );
		}

		return $html;
	}

	public function renderSidebar($data)
	{
		// If no view specified use the default
		if(!isset($data['view']))
			$filename = VIEWROOT.$this->_themeConfig['sidebars']['default']['file'];
		else
			$filename = VIEWROOT.$data['view'];
		
		return $this->getTemplateFile($filename, $data['content']);
	}
	
	public function setNumCloumns($cols)
	{
		$this->_numColumns = $cols; // @todo cast to int?
	}

	public function setTemplate($name)
	{
		$this->_template = $name;
	}

	protected function getTemplate()
	{
		if($this->_template == null)
			$file = $this->_themeConfig['templates']['default']['file'];
		else
			$file = $this->_themeConfig['templates']['default']['path'].$this->_template.".php";
		
		return $file;
	}

	public function getLayout()
	{
		if($this->_layout != null)
			$filename = $this->_themeroot.$this->_themeConfig['path'].'/templates'.$this->_layout;
		else
			$filename = $this->_themeroot.$this->_themeConfig['layouts'][$this->_numColumns]['file'];

		echo $this->getTemplateFile($filename, $this);
	}
	
	public function mergeCss($first, $second)
	{
		foreach($second as $css)
			$first[] = array('file' => $css['file']);
		
		return $first;
	}

	/**
	 * Merge configs
	 * Entries in $second will overtake $first
	 * @param array $first
	 * @param array $second
	 * @return array $combined
	 */
	public function mergeConfig($first, $second)
	{
		foreach($second as $key => $data)
			$first[$key] = $data;
		
		return $first;
	}
	
	public function mergeJs($first, $second)
	{
		$base = 'js';
		$i = 100;

		foreach($second as $js)
		{
			$key = "$base-$i";
			$js['order'] = $i;
			$first[$key] = $js;
			$i++;
		}
		
		return $first;
	}

	public function getTemplateFile($filename, $data)
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
	 * @param string $themeName
	 * @param string $namespace
	 * @param string $path
	 * @param array $extras
	 */
	public function loadTheme($config, $extras)
	{
		$this->_themeConfig = $config->getTheme(); // Get the theme config data
		$this->_domainName = 'http://'.$_SERVER['SERVER_NAME'];
		$this->_extras = $extras;

		$this->_themeConfig['meta'] = $extras['meta']; // Add injected Meta
		$this->_themeConfig['title'] = $extras['title']; // Add injected Page title
		$this->_themeConfig['phpToJs'] = $extras['phpToJs']; // Add phpToJs variables

		// If a parent theme exists, merge the theme configs
		if( isset($this->_themeConfig['parent']) )
		{
			$parentConfig = Erdiko::getConfigFile($this->_themeroot.$this->_themeConfig['parent']);

			// CSS
			$this->_themeConfig['css'] = $this->mergeCss($parentConfig['css'], $this->_themeConfig['css']);
			unset($parentConfig['css']);
			
			// JS
			$this->_themeConfig['js'] = $this->mergeConfig($parentConfig['js'], $this->_themeConfig['js']);
			unset($parentConfig['js']);
			
			// error_log("parent: ".print_r($parentConfig, true));
			// error_log("theme: ".print_r($this->_themeConfig, true));

			// Templates
			$this->_themeConfig['templates'] = $this->_themeConfig['templates'] + $parentConfig['templates'];

			// Views
			if(!isset($this->_themeConfig['views']))
				$this->_themeConfig['views'] = array();
			$this->_themeConfig['views'] = $this->_themeConfig['views'] + $parentConfig['views'];

			// Sidebars
			if(!isset($this->_themeConfig['sidebars']))
				$this->_themeConfig['sidebars'] = array();
			$this->_themeConfig['sidebars'] = $this->_themeConfig['sidebars'] + $parentConfig['sidebars'];
		}
		
		// Add any additional javascript files needed for the page.
		if($extras['js'] != null)
			$this->_themeConfig['js'] = $this->mergeJs($this->_themeConfig['js'], $extras['js']);

		// Add any additional CSS files needed for the page.
		if($extras['css'] != null)
			$this->_themeConfig['css'] = $this->mergeCss($this->_themeConfig['css'], $extras['css']);

		// Add to the menu to the context if present
		$context = $config->getContext();
		// error_log("context menu: ".print_r($context['menu'], true));
		// error_log("extras menu: ".print_r($extras['menu'], true));

		if($extras['menu'] != null)
			$context['menu'] = $extras['menu'] + $context['menu'];

		$this->setContextConfig($context);

		// Set default number of columns
		$this->_numColumns = $this->_themeConfig['columns'];
	}
	
	/**
	 * This is clobbering setPageTitle
	 */
	public function setData($data)
	{
		$this->_data = $data;
	}
	
	/**
	 *
	 */
	public function theme($data)
	{
		$filename = $this->_themeroot.$this->getTemplate();	
		$this->setData($data);
		$html = $this->getTemplateFile($filename, $this);
		
		echo $html;
	}

	/**
	 * render data given a specific 
	 */
	public function renderView($file = null, $data = null)
	{
		// if no view specified use the default
		if($file == null)
			$filename = VIEWROOT.$this->_themeConfig['views']['default']['file'];
		else
			$filename = VIEWROOT.$file;

		return $this->getTemplateFile($filename, $data);
	}

	/**
	 * 
	 */
	public function setSidebars($data)
	{
		$this->_sidebars = $data;
	}

	/**
	 * Get the theme config data
	 */
	public function getThemeConfig()
	{
		return $this->_themeConfig;
	}

	/**
	 * Set the context config data
	 */
	public function setContextConfig($config)
	{
		$this->_contextConfig = $config;
	}

	/**
	 * Get the context config data
	 */
	public function getContextConfig()
	{
		return $this->_contextConfig;
	}

	/**
	 * 
	 */
	public function getData()
	{
		return $this->_data;
	}

	public function sortByOrder($arr)
	{
		$sorted = array();
		foreach($arr as $element)
		{
			$sorted[$element['order']] = $element;
		} 
		return $sorted;
	}

}
