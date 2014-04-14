<?php
/**
 * Config class (singleton)
 *
 * @category    erdiko
 * @package     core
 * @copyright   Copyright (c) 2013, Arroyo Labs, www.arroyolabs.com
 * @author      John Arroyo, john@arroyolabs.com
 */
namespace erdiko\core;

class Config
{
    protected $_configs = array();
    protected $_contexts = array();
    protected $_themes = array();
    protected $_webroot = null;
    protected $_context = null;
    protected $_theme = null;

    /**
     * Private constructor for singleton
     * 
     * @todo read the entire config from cache
     */
    private function __construct()
    {
        $this->_webroot = APPROOT;
    }

    /**
     * Call this method to get singleton config
     *
     * @return Config
     */
    public static function getConfig($context = 'default')
    {
        // Get singleton instance
        static $inst = null;
        if ($inst === null)
            $inst = new Config;

        $inst->setContext($context);

        // get context
        // return $inst->getContext($context);
        return $inst;
    }

    /**
     * setContext
     * 
     * @param string $context 
     */
    public function setContext($context)
    {
        $this->_context = $context;
    }

    public function getContext()
    {
        if(empty($this->_contexts[$this->_context]))
        {
            $file = $this->_webroot."/app/config/contexts/".$this->_context.".json";
            $this->_contexts[$this->_context] = $this->getConfigFile($file);
            $this->_theme = $this->_contexts[$this->_context]['theme']['name'];
        }
        
        return $this->_contexts[$this->_context];
    }

    public function getTheme()
    {
        if(empty($this->_themes[$this->_theme]))
        {
            $context = $this->getContext();
            $file = $this->_webroot.$context['theme']['config'];
            $this->_themes[$this->_theme] = $this->getConfigFile($file);
        }
        
        return $this->_themes[$this->_theme];
    }

    /**
     * Read JSON config file and return array
     * @param filename $filename
     * @return array $config
     */
    public function getConfigFile($file)
    {
        $data = str_replace("\\", "\\\\", file_get_contents($file));
        $json = json_decode($data, TRUE);
        
        return $json;
    }
    
    public function getConfigByName($name)
    {
        $file = $this->_webroot."/app/config/$name.json";

        return $this->getConfigFile($file);
    }
}