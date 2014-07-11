<?php

use erdiko\core\Logger;
require_once dirname(__DIR__).'/ErdikoTestCase.php';

class LoggerTest extends ErdikoTestCase
{
    var $loggerObject;
    var $webRoot;

    function setUp() {
		$logFiles=array(
			"default" => "erdiko_test_default.log",
			"errorLog" => "erdiko_test_error.log",
		);

		$this->loggerObject=new Logger($logFiles);
		$this->webRoot = dirname(dirname(__DIR__));

    }

    function tearDown() {

    	$this->loggerObject->delete("erdiko_test_default.log", $this->webRoot."/www/var/logs");
    	$this->loggerObject->delete("erdiko_test_error.log", $this->webRoot."/www/var/logs");

        unset($this->loggerObject);
    }

    function testLog() {
	
		//Test the clearlog functon
		$this->loggerObject->clearLog();
		$return=Erdiko::readFromFile("erdiko_test_default.log", $this->webRoot."/www/var/logs");
		$return = trim($return);
		$this->assertTrue(empty($return));	

		//Should log to the default log... 
		$this->loggerObject->clearLog();
        $this->loggerObject->log('This is a test log in default test file');
		$return=Erdiko::readFromFile("erdiko_test_default.log", $this->webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test log in default test file') != false );	
		
		//Warning Log test
		$this->loggerObject->clearLog();
		$this->loggerObject->log('This is a test warning log',Logger::WARNING);
		$return=Erdiko::readFromFile("erdiko_test_default.log", $this->webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test warning log') != false );	
		
		//Error Log Test
		$this->loggerObject->clearLog();
		$this->loggerObject->log('This is a test error log',Logger::ERROR,"errorLog");
		$return=Erdiko::readFromFile("erdiko_test_error.log", $this->webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test error log') != false );
		
		//Error Log Test 2
		$this->loggerObject->clearLog();
		$this->loggerObject->log(new Exception("This is a test error log 2"),null,"errorLog");
		$return=Erdiko::readFromFile("erdiko_test_error.log", $this->webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test error log 2') != false );
		
    }

    function testAddLogFile(){

    	$this->loggerObject->addLogFile("temp", "erdiko_test_temp_log.log");
    	$this->loggerObject->log('This is a test log in test temp file', null, "temp");
    	$return=Erdiko::readFromFile("erdiko_test_temp_log.log" , $this->webRoot."/www/var/logs");
		$this->assertTrue(strpos($return, 'This is a test log in test temp file') != false );	

    }

    /**
     * @depends testAddLogFile
     */
    function testRemoveLogFile(){

    	//Once the removeLogFile() is called, the log will be written into the default log file.
    	$this->loggerObject->removeLogFile("temp");
    	$this->loggerObject->log('This is a test log in test temp file 2', null, "temp");
    	$return=Erdiko::readFromFile("erdiko_test_default.log" , $this->webRoot."/www/var/logs");
		$this->assertTrue(strpos($return, 'This is a test log in test temp file 2') != false );
		$this->loggerObject->delete("erdiko_test_temp_log.log", $this->webRoot."/www/var/logs");
    }
  }
?>