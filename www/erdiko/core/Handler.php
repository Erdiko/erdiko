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
	protected $_arguments;
	protected $_themeExtras;
	protected $_pageData;
	protected $_numberColumns = 1;
	protected $_template = null;
	protected $_layout = null;
	
	public function __construct()
	{
		$this->_webroot = WEBROOT;
		$file = $this->_webroot.'/app/config/contexts/default.json';
		$this->_localConfig = Erdiko::getConfigFile($file);
		
		$this->_themeExtras = array(
			'js' => array(), 
			'css' => array(), 
			'phpToJs' => array(),
			'meta' => array(),
			'title' => "",
			'identifier' => array(),
			'id' => "id",
			'data' => ""
			);

		$this->_pageData = array(
			'data' => array(
				'title' => null, 
				'content' => null, 
				'style' => array(
					'class' => array()
					),
				'identifier' => array()
				),
			'view' => array('page' => null), 
			'sidebar' => array(),
			);

        // Add an init hook for derrived controllers
        $this->init();
	}

    /**
     * This is just an init hook to be implemented in derived classes if needed
     */
    public function init()
    {

    }

	/**
	 * Add page title text to current page
	 */
	public function setPageTitle($title)
	{
		$this->_themeExtras['title'] = $title;
	}

	/**
	 * Add data variable to the layout
	 */
	public function setLayoutData($data)
	{
		$this->_themeExtras['data'] = $data;
	}

	/**
	 * Set both the page title and body title at the same time
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->setBodyTitle($title);
		$this->setPageTitle($title);
	}

	/**
	 * Add js file to current page
	 */
	public function addJs($file)
	{
		$this->_themeExtras['js'][] = array(
			'file' => $file,
			'active' => 1);
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
	 * Add Identifier to current page
	 * @note Not yet supported
	 */
	public function addIdentifier($name)
	{
		$this->_themeExtras['identifier'][] = $name;
	}

	/**
	 * Get identifiers
	 */
	public function getIdentifiers()
	{
		return $this->_themeExtras['identifier'];
	}

	/**
	 * Set id (unique name)
	 */
	public function setId($id)
	{
		$this->_themeExtras['id'] = $id;
	}

	/**
	 * Get id (unique name)
	 */
	public function getId()
	{
		return $this->_themeExtras['id'];
	}

    /**
     * Add phpToJs variable to be set on the current page
     */
    public function addPhpToJs($key, $value)
    {
        if(is_bool($value)) {
            $value = $value ? "true" : "false";
        }elseif(is_string($value)) {
            $value = "\"$value\"";
        }elseif(is_array($value)) {
            $value = json_encode($value);
        }elseif(is_object($value) && method_exists($value, "toArray")) {
            $value = json_encode($value->toArray());
        }else{
            throw new \Exception("Can not translate a parameter from PHP to JS\n".print_r($value,true));
        }

        $this->_themeExtras['phpToJs'][$key] = $value;
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
		$theme->setLocalConfig($this->_localConfig);
		
		// If no data is given load the view
		if(!isset($data['main_content']))
		{
			// render the page
			$data['main_content'] = $theme->renderView($this->_pageData['view']['page'], $this->_pageData['data']);
		}

		$theme->setTitle($this->_pageData['data']['title']);

		// Alter layout if needed
		if($this->_numberColumns)
			$theme->setNumCloumns($this->_numberColumns);
		if($this->_layout)
			$theme->setLayout($this->_layout);
		$theme->setTemplate( $this->getTemplate() );

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
	 * @param array $intArray
	 * @return array $keyArray
	 */
	public function compileNameValue($intArray)
	{
		$keyArray = array();
		for($i = 0; $i < count($intArray); $i += 2)
		{
			$keyArray[$intArray[$i]] = $intArray[$i+1];
		}
		return $keyArray;
	}
	
	/**
	 * Primary request router
	 *
	 * @param string $name, action name
	 * @param string $arguments remaining url params
	 */
	public function route($name, $arguments)
	{
		// Prepare arguments and name
		$arguments = $this->parseArguments($arguments);
		$splitName = $this->parseArguments($name);
		$ct = count($splitName);
		if($arguments == null)
			$arguments = array('raw_url_key' => $name);
		else
			$arguments = array_merge(array('raw_url_key' => $name), $arguments);

		// Check name for rest url components
		// @todo check for first arg after action name is an int, if so insert it as array("id" => [int])
		switch($ct) {
			case 0:
				$name = "index";
				break;
			case 1:
				$name = $splitName[0];
				break;
			default:
				$name = $splitName[0];
				$len = $ct-1;
				if( ($len % 2) > 0 )
					$nameArgs = array_slice($splitName, 1, $len);
				else
					$nameArgs = $this->compileNameValue(array_slice($splitName, 1, $len));
				$arguments = array_merge($nameArgs, $arguments);
				break;
		}
		
		// Get the theme config defined in local.inc
		// $file = $this->_webroot.$this->_localConfig['theme']['config'];
		// $themeConfig = Erdiko::getConfigFile($file);
		
		// Get data to populate page wrapper
		$data = $this->_localConfig['layout'];
		$this->_arguments = $arguments;
		
		// Determine what conetent should be called 
		if( empty($name) )
		{
			$data['main_content'] = $this->indexAction($arguments);
		}
		else 
		{
			try 
			{
                $action = $this->urlToActionName($name);
                $this->_before();
				$this->$action($arguments); // run the action method of the handler/controller
				$this->_after();
			}
			catch(\Exception $e)
			{
				$data['main_content'] = $this->getExceptionHtml( $e->getMessage() );
			}
		}
		
		$this->theme($data);
	}

	/**
	 * Before action hook
	 * Anything here gets called immediately BEFORE the Action method runs.
	 */
	protected function _before()
	{

		$this->addBodyStyleClass("content-body-".$this->_arguments['raw_url_key']);
		$this->addIdentifier($this->_arguments['raw_url_key']);
		$this->setId($this->_arguments['raw_url_key']);
	}

	/**
	 * After action hook
	 * anything here gets called immediately AFTER the Action method runs.
	 */
	protected function _after()
	{
		
	}

	/**
	 * Load a view from the current theme with the given data
	 * 
	 * @param string $file
	 * @param array $data
	 * 
	 * @todo deprecate this function -John 
	 * @todo render views with the theme engine instead
	 */
	public function getView($data = null, $file = null)
	{
		// $this->_data['layout']['columns']

		$filename = $this->_webroot.$this->_localConfig['theme']['path'].'/views/'.$file;
		return  Erdiko::getTemplate($filename, $data);
	}

	/**
	 * Override existing context with the supplied context
	 * @param string $contextName
	 * @param string $configDir, folder where the config lives (default: /app/config/contexts/)
	 */
	public function setContext($contextName, $configDir = "/app/config/contexts/")
	{
		$config = Erdiko::getConfigFile($this->_webroot.$configDir.$contextName.".json");
		$this->_localConfig['theme'] = $config['theme']; // swap out theme configs
		// error_log("config: ".print_r($config, true));
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
	 * @param string $title
	 */
	public function setBodyTitle($title)
	{
		$this->_pageData['data']['title'] = $title;
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
	 * @param mixed $data
	 */
	public function setBodyStyle($data, $key)
	{
		$this->_pageData['data']['style'][$key] = $data;
	}

	/**
	 * Set page content data to be themed in the view
	 *
	 * @param mixed $data
	 */
	public function addBodyStyleClass($name)
	{
		$this->_pageData['data']['style']['class'][] = $name;
	}

    /**
	 * Add a page content data to be themed in the view
	 *
	 * @param mixed $data
     * @return $this: Provides chaining
	 */
	public function addContentData($key, $value)
	{
        if(empty($this->_pageData['data']['content'])) {
            $this->_pageData['data']['content'] = array();
        }
        // If we have a scalar value setup then just return false(maybe throw an exception in future)
        if(!is_array($this->_pageData['data']['content'])) {
            return false;
        }
        $this->_pageData['data']['content'][$key] = $value;
        return $this;
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
	 * Set layout 
	 */
	public function setLayout($name)
	{
		$this->_layout = $name;
	}

	/**
	 * Get layout 
	 */
	public function getLayout()
	{
		return $this->_layout;
	}

	/**
	 * Set layout template
	 */
	public function setTemplate($name)
	{
		$this->_template = $name;
	}

	/**
	 * Get template name
	 * Returns null if not overriding the template/layout
	 * @return string $name
	 */
	public function getTemplate()
	{
		return $this->_template;
	}

    /**
     * Modify the action name coming from the URL into proper action name
     * @param string $name: The raw action name
     * @return string
     */
    public function urlToActionName($name){
        // just turn dash-format into upperCamelCaseFormat
        return preg_replace("/\-(.)/e", "strtoupper('\\1')", $name) . 'Action';
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

	public function redirect($url)
	{
		header( "Location: $url" );
		exit;
	}

	public function getExceptionHtml($message)
	{
		$formData = array(
			'title' => $this->_textConfig['exception']['title'],
			'sub_title' => $this->_textConfig['exception']['sub_title'],
			'description' => $this->_textConfig['exception']['description'],
			'message' => $message,
		);
		
		$filename = __DIR__.'/views/form/exception.phtml';
		return  Erdiko::getTemplate($filename, $formData);
	}
}
