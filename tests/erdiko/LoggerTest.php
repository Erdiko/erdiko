<?php

use erdiko\core\Logger;
require_once dirname(__DIR__).'/ErdikoTestCase.php';

class LoggerTest extends ErdikoTestCase
{
    var $loggerObject;

    function setUp() {
		$logFiles=array(
			"default" => "erdiko_default.log",
			"exceptionLog" => "erdiko_error.log",
		);
		$this->loggerObject=new Logger($logFiles);
    }

    function tearDown() {
        unset($this->loggerObject);
    }

    function testLog() {
	
		$webRoot = dirname(dirname(__DIR__));
		// Should log to the default log... 
		$this->loggerObject->clearLog();
        $this->loggerObject->log('This is a test log in default file');
		$return=Erdiko::readFromFile("erdiko_default.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test log in default file') != false );	
		
		$this->loggerObject->clearLog();
		
		$this->loggerObject->log('This is a test warning log',Logger::WARNING);
		$return=Erdiko::readFromFile("erdiko_default.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test warning log') != false );	
		
		$this->loggerObject->clearLog();
		
		$this->loggerObject->log('This is a test exception log',Logger::ERROR,"exceptionLog");
		$return=Erdiko::readFromFile("erdiko_error.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test exception log') != false );
		
		$this->loggerObject->clearLog();
		
		$this->loggerObject->log(new Exception("This is a test exception log 2"),null,"exceptionLog");
		$return=Erdiko::readFromFile("erdiko_error.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,'This is a test exception log 2') != false );
		
		$this->loggerObject->clearLog();
		$return=Erdiko::readFromFile("erdiko_default.log",$webRoot."/www/var/logs");
		$return = trim($return);
		$this->assertTrue(empty($return));	
		
    }
  }
?>