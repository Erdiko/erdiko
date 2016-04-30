<?php
/**
 * Erdiko
 *
 * All global helpers
 *
 * @category    Erdiko
 * @package         Erdiko
 * @copyright   Copyright (c) 2015, Arroyo Labs, www.arroyolabs.com
 * @author      John Arroyo, john@arroyolabs.com
 */

/**
 * Erdiko Class
 */
class Erdiko
{
    /**
     * Log Object
     */
    protected static $_logObject=null; // @todo get rid of this...
    
    /**
     * Load a template file from a module
     *
     * @param string $filename
     * @param mixed $data , data to expose to template
     * @todo can we deprecate this function and only use the one in the theme engine? -John
     */
    public static function getTemplate($filename, $data)
    {
        $filename = addslashes($filename);

        if (is_file($filename)) {
            ob_start();
            include $filename;
            return ob_get_clean();
        }
        return false;
    }

    /**
     * Load a view from the current theme with the given data
     *
     * @param string $viewName
     * @param array $data
     */
    public static function getView($viewName, $data = null, $templateRootFolder = null)
    {
        $view = new \erdiko\core\View($viewName, $data);

        if ($templateRootFolder !== null) {
            $view->setTemplateRootFolder($templateRootFolder);
        }
        return  $view->toHtml();
    }
    
    /**
     * Read JSON config file and return array
     *
     * @param string $file
     * @return array $config
     */
    public static function getConfigFile($filename)
    {
        $filename = addslashes($filename);
        if (is_file($filename)) {
            $data = str_replace("\\", "\\\\", file_get_contents($filename));
            $json = json_decode($data, true);

            if (empty($json)) {
                throw new \Exception("Config file has a json parse error, $filename");
            }

        } else {
            throw new \Exception("Config file not found, $filename");
        }
        
        return $json;
    }
    
    /**
     * Get configuration
     */
    public static function getConfig($name = 'application/default')
    {
        $filename = APPROOT.'/config/'.$name.'.json';
        return self::getConfigFile($filename);
    }
    
    /**
     * Get the compiled application routes from the config files
     *
     * @todo cache the loaded/compiled routes
     */
    public static function getRoutes()
    {
        $file = APPROOT.'/config/application/routes.json';
        $applicationConfig = Erdiko::getConfigFile($file);
        
        return $applicationConfig['routes'];
    }
    
    /**
     * Send email
     * @todo add ways to swap out ways of sending
     */
    public static function sendEmail($toEmail, $subject, $body, $fromEmail)
    {
        $headers = "From: $fromEmail\r\n" .
            "Reply-To: $fromEmail\r\n" .
            "X-Mailer: PHP/" . phpversion();
        
        return mail($toEmail, $subject, $body, $headers);
    }
    
    /**
     * log message to log file
     * If you enter null for level it will default to 'debug'
     *
     * @usage \Erdiko::log('debug',"Message here...", array())
     *
     * @param string $level
     * @param string $message
     * @param array $context
     * @return bool $success
     */
    public static function log($level, $message, array $context = array())
    {
        if(Erdiko::$_logObject==null)
        {
            $config = Erdiko::getConfig("application/default");
            $logFiles = $config["logs"]["files"][0];
            $logDir = $config["logs"]["path"];

            Erdiko::$_logObject = new erdiko\core\Logger($logFiles, $logDir);
        }

        if(empty($level))
            $level = \Psr\Log\LogLevel::DEBUG; // Default to debug for convenience

        return Erdiko::$_logObject->log($level, $message, $context);
    }
    
    /**
     * Get the configured cache instance using name
     *
     * @return cache $cache returns the instance of the cache type
     */
    public static function getCache($cacheType = "default")
    {
        $config = Erdiko::getConfig("application/default");
        
        if (isset($config["cache"][$cacheType])) {
            $cacheConfig = $config["cache"][$cacheType];
            $class = "erdiko\core\cache\\".$cacheConfig["type"];
            return new $class;
        } else {
            return false;
        }
    }
}
