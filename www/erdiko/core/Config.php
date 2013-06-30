<?php
/**
 * Config singleton class
 * @author  John Arroyo, john@arroyolabs.com
 */
namespace erdiko\core;

class Config
{
    protected $_configs = array();
    protected $_webroot = null;
    protected $_contexts = array();

    /**
     * Call this method to get singleton
     *
     * @return UserFactory
     */
    public static function getConfig($context = 'default')
    {
        error_log("getConfig");

        // Get singleton instance
        static $inst = null;
        if ($inst === null)
            $inst = new Config;

        // get context
        return $inst->getContext($context);
        // return $inst;
    }

    /**
     * Private constructor so nobody else can create instance
     * 
     * @todo read the entire config from cache
     */
    private function __construct()
    {
        $this->_webroot = WEBROOT;
        error_log("load config");
    }

    public function getContext($context)
    {
        if(empty($this->_contexts[$context]))
        {
            $file = $this->_webroot."/app/config/contexts/$context.json";
            $this->_contexts[$context] = $this->getConfigFile($file);
            error_log("load context: $context");
        }

        return $this->_contexts[$context];
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