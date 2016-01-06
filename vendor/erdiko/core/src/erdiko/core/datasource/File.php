<?php
/**
 * Wrapper for php file commmands
 *
 * @category    Erdiko
 * @package     core
 * @copyright   Copyright (c) 2014, Arroyo Labs, www.arroyolabs.com
 * @author      Varun Brahme
 * @author      Coleman Tung, coleman@arroyolabs.com
 * @author      John Arroyo, john@arroyolabs.com
 */
namespace erdiko\core\datasource;

/**
 * File Class
 */
class File
{
    /**
     * Default Path
     */
    protected $_filePath = null;
    
    /**
    * Contructor
    *
    * @param string $defaultPath
    */
    public function __construct($defaultPath = null)
    {
        if (isset($defaultPath)) {
            $this->_filePath=$defaultPath;
        } else {
            $rootFolder=dirname(dirname(dirname(__DIR__)));
            $this->_filePath=$rootFolder."/var";
        }
        if (!is_dir($this->_filePath)) {
            mkdir($this->_filePath, 0775, true);
        }
    }
    
    /**
     * Write string to file
     *
     * @param string $content
     * @param string $filename
     * @param string $pathToFile
     * @param string $mode - Default mode: w
     * @return int - bytes written to file
     */
    public function write($content, $filename, $pathToFile = null, $mode = "w")
    {
        if ($pathToFile == null) {
            $pathToFile = $this->_filePath;
        }

        if (!is_dir($pathToFile)) {
            $success = mkdir($pathToFile, 0775, true);
            if (!$success) {
                throw new \Exception("Cannot create folder. Check file system permissions.");
            }
        }

        $fileHandle = fopen($pathToFile."/".$filename, $mode);
        $success = fwrite($fileHandle, $content);
        fclose($fileHandle);

        return $success;
    }
    
    /**
     * Read string to file
     *
     * @param string $filename
     * @param string $pathToFile
     * @return string
     */
    public function read($filename, $pathToFile = null)
    {
        if ($pathToFile==null) {
            return file_get_contents($this->_filePath."/".$filename);
        } else {
            return file_get_contents($pathToFile."/".$filename);
        }
    }
    
    /**
     * Delete a file
     *
     * @param string $filename
     * @param string $pathToFile
     * @return bool
     */
    public function delete($filename, $pathToFile = null)
    {
        if ($pathToFile==null) {
            $pathToFile=$this->_filePath;
        }
        if (file_exists($pathToFile."/".$filename)) {
            return unlink($pathToFile."/".$filename);
        } else {
            return false;
        }
    }

    /**
     * Move a file
     *
     * @param string $filename
     * @param string $pathTo
     * @param string $pathToFrom
     * @return bool
     */
    public function move($filename, $pathTo, $pathFrom = null)
    {
        if ($pathFrom==null) {
            $pathFrom=$this->_filePath;
        }
        if (file_exists($pathFrom."/".$filename)) {
            return rename($pathFrom."/".$filename, $pathTo."/".$filename);
        } else {
            return null;
        }
    }
    
    /**
     * Rename a file
     *
     * @param string $oldName
     * @param string $pathTo
     * @param string $pathToFrom
     * @return bool
     */
    public function rename($oldName, $newName, $pathToFile = null)
    {
        if ($pathToFile==null) {
            $pathToFile=$this->_filePath;
        }
        if (file_exists($pathToFile."/".$oldName)) {
            return rename($pathToFile."/".$oldName, $pathToFile."/".$newName);
        } else {
            return false;
        }
    }
    
    /**
     * Copy a file
     *
     * @param string $filename
     * @param string $newFilePath
     * @param string $newFileName
     * @param string $pathToFile
     * @return bool
     */
    public function copy($filename, $newFilePath, $newFileName = null, $pathToFile = null)
    {
        if ($pathToFile==null) {
            $pathToFile=$this->_filePath;
        }
        if ($newFileName==null) {
            $newFileName=$filename;
        }
        if (file_exists($pathToFile."/".$filename)) {
            return copy($pathToFile."/".$filename, $newFilePath."/".$newFileName);
        } else {
            return false;
        }
    }
    
    /**
     * Check if a file exists
     *
     * @param string $filename
     * @param string $pathToFile
     * @return bool
     */
    public function fileExists($filename, $pathToFile = null)
    {
        if ($pathToFile==null) {
            $pathToFile=$this->_filePath;
        }
        return file_exists($pathToFile."/".$filename);
    }
    
    /**
     * Destructor
     */
    public function __destruct()
    {
    }
}
