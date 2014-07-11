<?php

use erdiko\core\datasource\File;
require_once dirname(__DIR__).'/ErdikoTestCase.php';


class FileTest extends ErdikoTestCase
{
    // contains the object handle of the string class
    var $fileObj=null;
    var $webRoot=null;

    // called before the test functions will be executed
    // this function is defined in PHPUnit_TestCase and overwritten
    // here
    function setUp() {
        // create a new instance of String with the
        // string 'abc'
        $this->fileObj = new File();

        $this->webRoot = dirname(dirname(__DIR__));
        //echo $this->webRoot;
    }

    // called after the test functions are executed
    // this function is defined in PHPUnit_TestCase and overwritten
    // here
    function tearDown() {
        // delete your instance
        unset($this->fileObj);
    }

    // test the toString function
    function testWriteAndRead() {

		$string="Sample string";
		$this->fileObj->write($string,"sample.txt");
		$result=$this->fileObj->read("sample.txt");
        $this->assertTrue($result == $string);
		$string="Sample string";
		$this->fileObj->write($string,"sample.txt", $this->webRoot."/www/");
		$result2=$this->fileObj->read("sample.txt", $this->webRoot."/www/");
        $this->assertTrue($result2 == $string);
    }
	
	function testDelete() {
		$this->assertTrue($this->fileObj->delete("sample.txt", $this->webRoot."/www/"));
    }

    // test the copy function
    function testCopy() {
		$this->assertTrue($this->fileObj->copy("sample.txt", $this->webRoot."/www/"));
		$this->assertTrue($this->fileObj->copy("sample.txt", $this->webRoot."/www/","sample2.txt"));
		$this->assertTrue($this->fileObj->copy("sample2.txt", $this->webRoot."/www/",null, $this->webRoot));
    }
    
	
	function testRename() {
		$this->assertTrue($this->fileObj->rename("sample2.txt","sample.txt",$this->webRoot."/www/"));
    }
	
	function testMove() {
		$this->assertTrue($this->fileObj->move("sample.txt", $this->webRoot, $this->webRoot."/www/"));
    }
    

  }
?>