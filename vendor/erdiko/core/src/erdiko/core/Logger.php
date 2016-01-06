<?php
/**
 * Logging utility for Erdiko
 *
 * @category    Erdiko
 * @package     core
 * @copyright   Copyright (c) 2014, Arroyo Labs, www.arroyolabs.com
 * @author      Varun Brahme
 * @author      Coleman Tung, coleman@arroyolabs.com
 * @author      John Arroyo, john@arroyolabs.com
 */
namespace erdiko\core;

use erdiko\core\datasource\File;
use \Psr\Log\LoggerInterface;
use \Psr\Log\InvalidArgumentException;
use \Psr\Log\LogLevel;

/**
 * Logger Class
 */
class Logger extends File implements LoggerInterface
{
    
    /** Log files */
    protected $_logFiles = array(
        "default" => "system.log",
    );
    protected $_defaultPath = '/var/logs';
    
    /**
     * Constructor
     *
     * @param array $logFiles
     * @param string $logDir, fully qualified path or a path relative to the erdiko root
     */
    public function __construct($logFiles = array(), $logDir = null)
    {
        // Set the log files
        if (!empty($logFiles)) {
            $this->_logFiles = array_merge($this->_logFiles, array_change_key_case($logFiles));
        }
        
        // Set the logging directory
        if ($logDir != null) {
            if (is_dir($logDir)) {
                $this->_filePath = $logDir; // fully qualified & valid path
            } else {
                $this->_filePath = \ROOT.$logDir; // otherwise assume it's relative to the root
            }
        } else {
            $this->_filePath = \ROOT.$this->_defaultPath;
        }
    }
    
    /**
     * Log
     *
     * @param string $level
     * @param string or an object with a __toString() method$ message
     * @param array $context
     * @return bool
     */
    public function log($level, $message, array $context = array())
    {
        switch ($level) {
            case \Psr\Log\LogLevel::EMERGENCY:
                return $this->emergency($message, $context);
                break;
            case \Psr\Log\LogLevel::ALERT:
                return $this->alert($message, $context);
                break;
            case \Psr\Log\LogLevel::CRITICAL:
                return $this->critical($message, $context);
                break;
            case \Psr\Log\LogLevel::ERROR:
                return $this->error($message, $context);
                break;
            case \Psr\Log\LogLevel::WARNING:
                return $this->warning($message, $context);
                break;
            case \Psr\Log\LogLevel::NOTICE:
                return $this->notice($message, $context);
                break;
            case \Psr\Log\LogLevel::INFO:
                return $this->info($message, $context);
                break;
            case \Psr\Log\LogLevel::DEBUG:
                return $this->debug($message, $context);
                break;
            default:
                // PSR-3 states that we must throw a \Psr\Log\InvalidArgumentException
                // if we don't recognize the level
                throw new \InvalidArgumentException(
                    "Unknown severity level passed to Logger"
                );
        }
    }

    /**
     * Add Record
     *
     * @param string $level
     * @param string or an object with a __toString() method$ message
     * @param array $context
     * @return bool
     */
    public function addRecord($level, $message, array $context = array())
    {
        $message = (string) $message;
        $logString=date('Y-m-d H:i:s')." ".$level.": ".$this->interpolate($message, $context).PHP_EOL;
        $logFileName=$this->_logFiles["default"]; // If log key is null use the default log file

        return $this->write($logString, $logFileName, null, "a");
    }

    /**
     * Implementation of Placeholder Interpolation
     * The message MAY contain placeholders which implementors MAY replace with values from the context array.
     * Placeholder names MUST correspond to keys in the context array.
     *
     * @param string $level
     * @param string or an object with a __toString() method$ message
     * @param array $context
     * @return bool
     */
    function interpolate($message, array $context = array())
    {
        // build a replacement array with braces around the context keys
        $replace = array();
        foreach ($context as $key => $val) {
            if ($key == "exception" && $val instanceof \Exception) {
                $replace['{' . $key . '}'] = $val->getMessage();
            } else {
                $replace['{' . $key . '}'] = $val;
            }
        }

        // interpolate replacement values into the message and return
        return strtr($message, $replace);
    }

    /**
     * Add log file
     * Valid if multiple log files exist
     *
     * @param mixed $key
     * @param string $logFileName
     * @return bool
     */
    public function addLogFile($key, $logFileName)
    {
        $arrayKey=strtolower($key);
        return $this->_logFiles[$arrayKey] = $logFileName;
    }

    /**
     * Remove log file
     * Valid if multiple log files exist
     *
     * @param mixed $key
     */
    public function removeLogFile($key)
    {
         $arrayKey=strtolower($key);
         unset($this->_logFiles[$arrayKey]);
         return true;
    }

     /**
      * Clear Log
      *
      * @param string $logKey
      * @return bool
      */
    public function clearLog($logKey = null)
    {
        $ret=true;
        if ($logKey==null) {
            foreach ($this->_logFiles as $key => $logFile) {
                $ret = $ret && $this->write("", $logFile);
            }
            return $ret;
        } else {
            $arrayKey=strtolower($logKey);
            if (isset($this->_logFiles[$arrayKey])) {
                return $this->write("", $this->_logFiles[$arrayKey]);
            } else {
                return 0;
            }
        }
    }

    /** Destructor */
    public function __destruct()
    {
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function emergency($message, array $context = array())
    {
        // TODO: Implement emergency() method.
        return $this->addRecord(\Psr\Log\LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function alert($message, array $context = array())
    {
        // TODO: Implement alert() method.
        return $this->addRecord(\Psr\Log\LogLevel::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function critical($message, array $context = array())
    {
        // TODO: Implement critical() method.
        return $this->addRecord(\Psr\Log\LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function error($message, array $context = array())
    {
        // TODO: Implement error() method.
        return $this->addRecord(\Psr\Log\LogLevel::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function warning($message, array $context = array())
    {
        // TODO: Implement warning() method.
        return $this->addRecord(\Psr\Log\LogLevel::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function notice($message, array $context = array())
    {
        // TODO: Implement notice() method.
        return $this->addRecord(\Psr\Log\LogLevel::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function info($message, array $context = array())
    {
        // TODO: Implement info() method.
        return $this->addRecord(\Psr\Log\LogLevel::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function debug($message, array $context = array())
    {
        // TODO: Implement debug() method.
        return $this->addRecord(\Psr\Log\LogLevel::DEBUG, $message, $context);
    }
}
