<?php
/**
 * Handler
 * Base request handler, All handlers should inherit this class.
 * 
 * @category   Erdiko
 * @package    Core
 * @copyright  Copyright (c) 2012, Arroyo Labs, http://www.arroyolabs.com
 * @author	   John Arroyo
 */
namespace erdiko\core;
use Erdiko;

class Handler extends \ToroHandler 
{
    protected $_localConfig;
	protected $_webroot;
	protected $_themeExtras;
	protected $_pageData;
	protected $_numberColumns;
	
	public function __construct()
	{
		$this->_webroot = dirname(dirname(__DIR__));
		$file = $this->_webroot.'/app/config/contexts/application.json';
		$this->_localConfig = Erdiko::getConfigFile($file);
		
		$this->_themeExtras = array(
			'js' => array(), 
			'css' => array(), 
			'meta' => array(),
			'title' => "",
			);

		$this->_pageData = array(
			'data' => array('title' => null, 'content' => null), 
			'view' => array('page' => null), 
			'sidebar' => array(),
			);
	}

	/**
	 * Add page title text to current page
	 */
	public function setPageTitle($title)
	{
		$this->_themeExtras['title'] = $title;
	}

	/**
	 * Add js file to current page
	 */
	public function addJs($file)
	{
		$this->_themeExtras['js'][] = array('file' => $file);
	}
	
	/**
	 * Add Css file to current page
	 * @note Not yet supported
	 */
	public function addCss($file)
	{
		$this->_themeExtras['css'][] = array('file' => $file);
	}
	
	/**
	 * Add Meta Tags to the page
	 * 
	 * @param string $content
	 * @param string $name, html meta name (e.g. 'description' or 'keywords')
	 */
	public function addMeta($content, $name = 'description')
	{
		$this->_themeExtras['meta'][$name] = $content;
	}
	
	/**
	 * Theme a set of data
	 * Generates an entire page with the given data 
	 * 
	 * @param array $data
	 */
	public function theme($data)
	{	
		$theme = Erdiko::getTheme($this->_localConfig['theme']['name'], $this->_localConfig['theme']['namespace'], $this->_localConfig['theme']['path'], $this->_themeExtras);
		
		// If no data is given load the view
		if(!isset($data['main_content']))
		{
			// render the page
			$data['main_content'] = $theme->renderView($this->_pageData['view']['page'], $this->_pageData['data']);
		}

		// Alter layout if needed
		if($this->_numberColumns)
			$theme->setNumCloumns($this->_numberColumns);

		// Deal with sidebars for multi-column layouts
		if(!empty($this->_pageData['sidebar']))
			$theme->setSidebars($this->_pageData['sidebar']);

		$theme->theme($data);
	}
	
	/**
	 * @param string $arguments
	 * @return array $arguments
	 */
	public function parseArguments($arguments)
	{
		$arguments = explode("/", $arguments); 
		return $arguments;
	}
	
	/**
	 * 
	 */
	public function get($name = null, $arguments = null)
	{
		return $this->route($name, $arguments);
	}
	
	/**
	 * 
	 */
	public function post($name = null, $arguments = null)
	{
		return $this->route($name, $arguments);
	}
	
	/**
	 * Primary request router
	 *
	 * @param string $name, action name
	 * @param string $arguments remaining url params
	 */
	public function route($name, $arguments)
	{
		$arguments = $this->parseArguments($arguments);
		
		// Get the theme config defined in local.inc
		// $file = $this->_webroot.$this->_localConfig['theme']['config'];
		// $themeConfig = Erdiko::getConfigFile($file);
		
		// Get data to populate page wrapper
		$data = $this->_localConfig['layout'];
		
		// Determine what conetent should be called 
		if( empty($name) )
		{
			$data['main_content'] = $this->indexAction($arguments);
		}
		else 
		{
			try 
			{
				$action = $name.'Action';
				$this->$action($arguments); // run the action method of the handler/controller
			}
			catch(\Exception $e)
			{
				$data['main_content'] = $this->getExceptionHtml( $e->getMessage() );
			}
		}
		
		$this->theme($data);
	}
	
	/**
	 * Load a view from the current theme with the given data
	 * 
	 * @param string $file
	 * @param array $data
	 * 
	 * @todo deprecate this function -John 
	 */
	public function getView($data = null, $file = null)
	{
		// $this->_data['layout']['columns']

		$filename = $this->_webroot.$this->_localConfig['theme']['path'].'/views/'.$file;
		return  Erdiko::getTemplate($filename, $data);
	}

	/**
	 * Set data to be themed in the given view
	 *
	 * @param array $data
	 */
	public function setData($data)
	{
		$this->_pageData['data'] = $data;
	}

	/**
	 * Set page content data to be themed in the view
	 *
	 * @param mixed $data
	 */
	public function setBodyContent($data)
	{
		$this->_pageData['data']['content'] = $data;
	}

	/**
	 * Set page content data to be themed in the view
	 *
	 * @param string $title
	 */
	public function setBodyTitle($title)
	{
		$this->_pageData['data']['title'] = $title;
	}

	/**
	 * Set the view template to be used
	 *
	 * @param string $view, view file
	 */
	public function setView($view, $type = 'page')
	{
		$this->_pageData['view'][$type] = $view;
	}

	public function setLayoutColumns($cols)
	{
		$this->_numberColumns = $cols;
	}

	/**
	 * Set the view template to be used
	 *
	 * @param string $name
	 * @param mixed $content
	 * @param string $view, view filename
	 */
	public function setSidebar($name, $content, $view = null)
	{
		$this->_pageData['sidebar'][$name]['content'] = $content;
		if($view != null)
			$this->_pageData['sidebar'][$name]['view'] = $view;
	}
}