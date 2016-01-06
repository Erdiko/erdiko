<?php
/**
 * Example of how to set up a unit test
 * Test the functionality of the Erdiko framework static methods
 */
namespace tests\erdiko;

use erdiko\core\Logger;

require_once dirname(__DIR__).'/ErdikoTestCase.php';

class ErdikoTest extends \tests\ErdikoTestCase
{
    public function testGetConfigFile()
    {
        /**
         *  First Test
         */
        //Get the config file through getConfigFile function
        $filename = APPROOT.'/config/'."application/default.json";
        $return = \Erdiko::getConfigFile($filename);

        //Get the config file through file_get_contents function
        $content = file_get_contents($filename);
        $content = str_replace("\\", "\\\\", $content);
        $content = json_decode($content, true);

        //Validate the config file
        $this->assertEquals($return, $content);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testGetConfigFileException()
    {
        /**
         *  Second Test
         *
         *  Passing a non-exist config file
         */
        $fileName = APPROOT.'/config/'."non-exist.json";
        $return = \Erdiko::getConfigFile($fileName);
    }

    public function testConfig()
    {
        /**
         *  First Test
         */
        $filename = "application/default";
        $this->assertTrue(\Erdiko::getConfig($filename) != false);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testConfigException()
    {
        /**
         *  Second Test
         *
         *  Passing a non-exist config file
         */
        $fileName = "application/non-exist";
        $this->assertTrue(\Erdiko::getConfig($fileName) != false);
    }

    public function testSendEmail()
    {
        \Erdiko::sendEmail("To@arroyolabs.com", "Test Heading", "Test Body", "From@arroyolabs.com");
    }

    public function testGetRoutes()
    {
        //Get routes through getRoutes function
        $return = \Erdiko::getRoutes();

        //Get routes through direct access
        $filename =  APPROOT.'/config/application/routes.json';
        $data = str_replace("\\", "\\\\", file_get_contents($filename));
        $json = json_decode($data, true);
        
        //Validate data
        $this->assertEquals($return, $json['routes']);
    }

    public function testLogs()
    {
        //Initialize a File object locally
        $fileObj = new \erdiko\core\datasource\File;
        $logFolder = \ROOT."/var/logs";

        $sampleText="info: This is a sample log for Erdiko class test";
        
        /**
         *  First test
         *
         *  Log a regular message
         */
        \Erdiko::log(\Psr\Log\LogLevel::INFO, $sampleText);
        $return= $fileObj->read("system.log", $logFolder);
        $this->assertTrue(strpos($return, $sampleText) !== false);

        /**
         *  First test
         *
         *  Log a exception message
         */
        $sampleText="error: This is a sample EXCEPTION log for Erdiko class test";
        \Erdiko::log(\Psr\Log\LogLevel::ERROR, $sampleText);
        $return= $fileObj->read("system.log", $logFolder);
        $this->assertTrue(strpos($return, $sampleText) !== false);

        //Clean up
        $fileObj->delete("system.log", $logFolder);
        $fileObj->delete("exception.log", $logFolder);
    }

    public function getCache()
    {
        //Reture false if config file is not existed
        $this->assertTrue(\Erdiko::getCache("default"));
    }

    public function testGetTemplate()
    {
        //Deprecated function
    }
}
