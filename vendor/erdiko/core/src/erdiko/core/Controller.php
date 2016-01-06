<?php
/**
 * Controller
 * Base request handler, All controllers should inherit this class.
 *
 * @category   Erdiko
 * @package    Core
 * @copyright  Copyright (c) 2014, Arroyo Labs, http://www.arroyolabs.com
 * @author     John Arroyo
 */
namespace erdiko\core;

use Erdiko;

/**
 * Controller Class
 */
class Controller
{
    /** Response */
    protected $_response;
    /** Webroot */
    protected $_webroot;
    /** Theme name */
    protected $_themeName = null;
    /** Theme */
    protected $_theme = null;
    /** Request URI */
    protected $_pathInfo = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_webroot = ROOT;
        $this->_response = new \erdiko\core\Response;

        if ($this->_themeName != null) {
            $this->_response->setThemeName($this->_themeName);
        }
    }

    /**
     * Set Path Info (Requested URI)
     */
    public function setPathInfo($pathInfo)
    {
        $this->_pathInfo = $pathInfo;
    }

    /**
     * Prepare theme
     */
    public function prepareTheme()
    {
        $this->getResponse()->setTheme(new \erdiko\core\Theme($this->getThemeName()));
    }

    /**
     * Set the theme name in the response
     * @param string $name, the name/id of the theme
     */
    public function setThemeName($name)
    {
        $this->getResponse()->setThemeName($name);
    }

    /**
     * Get the theme name
     *
     * @return string $name
     */
    public function getThemeName()
    {
        return $this->getResponse()->getThemeName();
    }

    /**
     * Set the theme template used to render the page
     * @param string $template
     */
    public function setThemeTemplate($template)
    {
        $this->getResponse()->setThemeTemplate($template);
    }

    /**
     * Before action hook
     * Anything here gets called immediately BEFORE the Action method runs.
     */
    public function _before()
    {
        // do something...
    }

    /**
     * After action hook
     * anything here gets called immediately AFTER the Action method runs.
     */
    public function _after()
    {
        // do something...
    }

    /**
     * Get Response object
     *
     * @return ResponseObject
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * Send
     */
    final public function send()
    {
        echo $this->getResponse()->render();
    }

    /**
     * Set Response data value
     *
     * @param string $key
     * @param mixed $value
     */
    public function setResponseDataValue($key, $value)
    {
        $this->getResponse()->setDataValue($key, $value);
    }

    /**
     * Add page title text to current page
     *
     * @param string $title
     */
    public function setPageTitle($title)
    {
        $this->setResponseDataValue('page_title', $title);
    }

    /**
     * Set page content title to be themed in the view
     *
     * @param string $title
     */
    public function setBodyTitle($title)
    {
        $this->setResponseDataValue('body_title', $title);
    }

    /**
     * Set both the title (header) and page title (body) at the same time
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->setPageTitle($title);
        $this->setBodyTitle($title);
    }

    /**
     * Set the response content
     *
     * @param string $content
     */
    public function setContent($content)
    {
        $this->getResponse()->setContent($content);
    }

    /**
     * Add/append html text to the response content
     *
     * @param string @content
     */
    public function appendContent($content)
    {
        $this->getResponse()->appendContent($content);
    }

    /**
     *  Autoaction
     *
     * @param string $var
     * @param string $httpMethod
     */
    protected function _autoaction($var, $httpMethod = 'get')
    {
        $method = $this->urlToActionName($var, $httpMethod);
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            \ToroHook::fire('404', array(
                "error" => "Controller ".get_class($this)." does not contain $method action",
                "path_info" => $this->_pathInfo ));
        }
    }

    /**
     * Call back for preg_replace in urlToActionName
     */
    private function _replaceActionName($parts)
    {
        return strtoupper($parts[1]);
    }

    /**
     * Modify the action name coming from the URL into proper action name
     * @param string $name: The raw controller action name
     * @return string
     */
    public function urlToActionName($name, $httpMethod)
    {
        // convert to camelcase if there are dashes
        $function = preg_replace_callback("/\-(.)/", array($this, '_replaceActionName'), $name);

        return $httpMethod.ucfirst($function);
    }
    
    /**
     * Load a view with the given data
     *
     * @param string $viewName
     * @param array $data
     * @return string $html, view contents
     */
    public function getView($viewName, $data = null, $templateRootFolder = null)
    {
        $view = new \erdiko\core\View($viewName, $data);

        if ($templateRootFolder != null) {
            $view->setTemplateRootFolder($templateRootFolder);
        }

        return  $view->toHtml();
    }

    /**
     * Add a view from the current theme with the given data
     *
     * @param string $viewName
     * @param array $data
     * @return string $html, view contents
     */
    public function addView($viewName, $data = null)
    {
        $view = new \erdiko\core\View($viewName, $data);
        $this->appendContent($view->toHtml());
    }

    /**
     * Load a layout with the given data
     *
     * @param string $layoutName
     * @param array $data
     * @return string $html, layout contents
     */
    public function getLayout($layoutName, $data = null, $templateRootFolder = null)
    {
        $layout = new \erdiko\core\Layout($layoutName, $data, $this->getThemeName());

        if ($templateRootFolder != null) {
            $layout->setViewRootFolder($templateRootFolder);
            $layout->setTemplateRootFolder($templateRootFolder);
        }

        return  $layout->toHtml();
    }

    /**
     * Redirect to another url
     * @param string $url
     */
    public function redirect($url)
    {
        header("Location: $url");
        exit;
    }


    /**
     *
     *
     *
     *  Code below are deprecated or may need to be moved!
     *
     *
     *
     */


    /**
     * Add phpToJs variable to be set on the current page
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function addPhpToJs($key, $value)
    {
        if (is_bool($value)) {
            $value = $value ? "true" : "false";
        } elseif (is_string($value)) {
            $value = "\"$value\"";
        } elseif (is_array($value)) {
            $value = json_encode($value);
        } elseif (is_object($value) && method_exists($value, "toArray")) {
            $value = json_encode($value->toArray());
        } else {
            throw new \Exception("Can not translate a parameter from PHP to JS\n".print_r($value, true));
        }

        $this->_themeExtras['phpToJs'][$key] = $value;
    }
    
    /**
     * Add Meta Tags to the page
     *
     * @param string $content
     * @param string $name - html meta name (e.g. 'description' or 'keywords')
     */
    public function addMeta($content, $name = 'description')
    {
        $this->_themeExtras['meta'][$name] = $content;
    }
}
