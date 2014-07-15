<?php

use erdiko\core\cache\Cache;
require_once dirname(__DIR__).'/ErdikoTestCase.php';


class CacheTest extends ErdikoTestCase
{
    // contains the object handle of the string class
    var $cacheObj=null;

    // called before the test functions will be executed
    // this function is defined in PHPUnit_TestCase and overwritten
    // here
    function setUp() {
        // create a new instance of String with the
        // string 'abc'
        $this->cacheObj = Erdiko::getCache("default");
		//$this->cacheObj = new Cache();
    }

    // called after the test functions are executed
    // this function is defined in PHPUnit_TestCase and overwritten
    // here
    function tearDown() {
        // delete your instance
        unset($this->cacheObj);
    }
	
	function testGetAndSet()
	{
		$this->cacheObj->set("test1","test1");
		$return=$this->cacheObj->get("test1");
		$this->assertTrue($return == "test1");
	}

	/*
	* @depends testGetAndSet
	*/
	function testAppend()
	{
		$this->assertFalse($this->cacheObj->exists("test2"));	

		$this->cacheObj->set("test1","test1");
		$return=$this->cacheObj->get("test1");
		$this->assertTrue($return == "test1");

		$this->cacheObj->append("test1", "test2");
		$return=$this->cacheObj->get("test1");
		$this->assertFalse($return == "test1");
		$this->assertFalse($return == "test2");
		$this->assertTrue($return == "test1test2");
	}

	function testDeleteFromCache()
	{	
		$this->assertFalse($this->cacheObj->exists("test1"));
		
		$this->cacheObj->set("test1","test1");
		$this->assertTrue($this->cacheObj->exists("test1"));
		$return=$this->cacheObj->get("test1");
		$this->assertTrue($return == "test1");

		$return=$this->cacheObj->deleteFromCache("test1");
		$this->assertFalse($this->cacheObj->exists("test1"));
	}
	
	function testExists()
	{	
		$this->assertFalse($this->cacheObj->exists("test2"));
		$this->cacheObj->set("test2","test2");
		$this->assertTrue($this->cacheObj->exists("test2"));
	}
	
	function testDelete()
	{
		$this->cacheObj->set("test3","test3");
		$this->assertTrue($this->cacheObj->exists("test3"));
		$this->cacheObj->deleteFromCache("test3");
		$this->assertFalse($this->cacheObj->exists("test3"));
	}	
	
	function testClearCache()
	{
		$this->cacheObj->set("test1","test1");
		$this->assertTrue($this->cacheObj->exists("test1"));
		$this->assertFalse($this->cacheObj->exists("test2"));

		$this->cacheObj->clearCache();

		$this->assertFalse($this->cacheObj->exists("test1"));
		$this->assertFalse($this->cacheObj->exists("test2"));
	}

  }
?>