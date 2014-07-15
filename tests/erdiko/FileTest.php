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

		$string2 = "Sample string 2";
		$this->fileObj->write($string2,"sample2.txt", $this->webRoot."/www/");
		$result2=$this->fileObj->read("sample2.txt", $this->webRoot."/www/");
        $this->assertTrue($result2 == $string2);

        $string3 = "Sample string 3";
        $this->fileObj->write($string3,"sample3.txt", $this->webRoot."/www/", "a");
        $result3=$this->fileObj->read("sample3.txt", $this->webRoot."/www/");
        $this->assertTrue($result3 == $string3);
    }

    /**
     * @depends testWriteAndRead
     */
    function testMove() {
        $this->assertTrue($this->fileObj->move("sample2.txt", $this->webRoot."/www/var/", $this->webRoot."/www/"));
    }
	
    /**
     * @depends testWriteAndRead
     */
    function testRename() {
        $this->assertTrue($this->fileObj->rename("sample3.txt","sample4.txt",$this->webRoot."/www/"));
    }

    /**
     * @depends testWriteAndRead
     */
    function testCopy() {
        $this->assertTrue($this->fileObj->copy("sample.txt", $this->webRoot."/www/"));
        $this->assertTrue($this->fileObj->copy("sample.txt", $this->webRoot."/www/","sample_copy.txt"));
        $this->assertTrue($this->fileObj->copy("sample.txt", $this->webRoot."/www/", "sample_copy2.txt", $this->webRoot."/www/var/"));
    }

    /**
     * @depends testWriteAndRead
     */
    function testFileExists() {
        $this->assertTrue($this->fileObj->fileExists("sample.txt"));
        $this->assertFalse($this->fileObj->fileExists("sample_not_exist.txt"));

        $this->assertTrue($this->fileObj->fileExists("sample.txt", $this->webRoot."/www/var/"));
        $this->assertFalse($this->fileObj->fileExists("sample_not_exist.txt", $this->webRoot."/www/var/"));
    }

    /**
     * @depends testMove
     * @depends testRename
     * @depends testCopy
     * @depends testFileExists
     */
	function testDelete() {
        $this->assertTrue($this->fileObj->delete("sample.txt"));
		$this->assertTrue($this->fileObj->delete("sample2.txt"));
        $this->assertTrue($this->fileObj->delete("sample4.txt", $this->webRoot."/www/"));

        $this->assertTrue($this->fileObj->delete("sample.txt", $this->webRoot."/www/"));
        $this->assertTrue($this->fileObj->delete("sample_copy.txt", $this->webRoot."/www/"));
        $this->assertTrue($this->fileObj->delete("sample_copy2.txt", $this->webRoot."/www/"));
    }

  }
?>