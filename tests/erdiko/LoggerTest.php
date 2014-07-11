<?php

use erdiko\core\Logger;
require_once dirname(__DIR__).'/ErdikoTestCase.php';

class LoggerTest extends ErdikoTestCase
{
    var $loggerObject;

    function setUp() {
		$logFiles=array(
			"default" => "erdiko_test_default.log",
			"errorLog" => "erdiko_test_error.log",
		);
		$this->loggerObject=new Logger($logFiles);
    }

    function tearDown() {

    	$webRoot = dirname(dirname(__DIR__));

    	$this->loggerObject->delete("erdiko_test_default.log", $webRoot."/www/var/logs");
    	$this->loggerObject->delete("erdiko_test_error.log", $webRoot."/www/var/logs");

        unset($this->loggerObject);
    }

    static function tearDownAfterClass()
    {
        $webRoot = dirname(dirname(__DIR__));
        $return = Erdiko::deleteFile("erdiko_test_temp_log.log", $webRoot."/www/var/logs");
    }



    function testLog() {
	
		$webRoot = dirname(dirname(__DIR__));

		//Test the clearlog functon
		$this->loggerObject->clearLog();
		$return=Erdiko::readFromFile("erdiko_test_default.log",$webRoot."/www/var/logs");
		$return = trim($return);
		$this->assertTrue(empty($return));	

		//Should log to the default log... 
		$this->loggerObject->clearLog();
        $this->loggerObject->log('This is a test log in default test file');
		$return=Erdiko::readFromFile("erdiko_test_default.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test log in default test file') != false );	
		
		//Warning Log test
		$this->loggerObject->clearLog();
		$this->loggerObject->log('This is a test warning log',Logger::WARNING);
		$return=Erdiko::readFromFile("erdiko_test_default.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test warning log') != false );	
		
		//Error Log Test
		$this->loggerObject->clearLog();
		$this->loggerObject->log('This is a test error log',Logger::ERROR,"errorLog");
		$return=Erdiko::readFromFile("erdiko_test_error.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test error log') != false );
		
		//Error Log Test 2
		$this->loggerObject->clearLog();
		$this->loggerObject->log(new Exception("This is a test error log 2"),null,"errorLog");
		$return=Erdiko::readFromFile("erdiko_test_error.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test error log 2') != false );
		
    }

    function testAddLogFile(){

    	$webRoot = dirname(dirname(__DIR__));

    	$this->loggerObject->addLogFile("temp", "erdiko_test_temp_log.log");
    	$this->loggerObject->log('This is a test log in test temp file', null, "temp");
    	$return=Erdiko::readFromFile("erdiko_test_temp_log.log" ,$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return, 'This is a test log in test temp file') != false );	

    }

    /**
     * @depends testAddLogFile
     */
    function testRemoveLogFile(){

    	$webRoot = dirname(dirname(__DIR__));

    	$this->loggerObject->removeLogFile( "temp");
    	$this->loggerObject->log('This is a test log in test temp file 2', null, "temp");
    	$return=Erdiko::readFromFile("erdiko_test_temp_log.log" ,$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return, 'This is a test log in test temp file 2') != true );
    }

  }
?>