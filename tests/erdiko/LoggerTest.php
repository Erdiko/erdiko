<?php

use erdiko\core\Logger;
require_once dirname(__DIR__).'/ErdikoTestCase.php';

class LoggerTest extends ErdikoTestCase
{
    var $loggerObject;

    function setUp() {
        $this->loggerObject = new Logger();
    }

    function tearDown() {
        unset($this->loggerObject);
    }

    function testLog() {
        $this->loggerObject->log('This is a test log');
		$this->loggerObject->log('This is a test warning log',Logger::WARNING);
		$this->loggerObject->log('This is a test exception log',Logger::ERROR);
		$this->loggerObject->log(new Exception("This is a test exception log 2"));
    }

    function testLogException() {
		$this->loggerObject->logToExceptionFile('This is an exception log using the other function');
    }
	
  }
?>