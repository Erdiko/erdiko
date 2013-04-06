<?php
/**
 * Example of how to set up a unit test
 * Test the functionality of the Erdiko framework static methods
 */
require_once dirname(__DIR__).'/ErdikoTestCase.php';
use erdiko\core\Logger;


class ErdikoTest extends ErdikoTestCase
{
	public function HelloWorldTest()
	{
		// @todo add assertions here...
	}
	
	public function testWriteToFileAndReadFromFileThenDelete()
	{
		$webRoot = dirname(dirname(__DIR__));
		$string="Sample string";
		Erdiko::writeToFile($string,"sample.txt");
		$result=Erdiko::readFromFile("sample.txt");
        $this->assertTrue($result == $string);
		
		$string="Sample string";
		Erdiko::writeToFile($string,"sample.txt",$webRoot);
		$result2=Erdiko::readFromFile("sample.txt",$webRoot);
        $this->assertTrue($result2 == $string);
		
		Erdiko::deleteFile("sample.txt");
		$this->assertTrue(file_exists($webRoot."www/var/sample.txt") == false);
		
		Erdiko::deleteFile("sample.txt",$webRoot."");
		$this->assertTrue(file_exists($webRoot."/sample.txt") == false);
	}
	
	/*
	* @depends testWriteToFileAndReadFromFileThenDelete
	*/
	public function testMoveFileAndDelete()
	{
		$webRoot = dirname(dirname(__DIR__));
		$string="Sample string";
		Erdiko::writeToFile($string,"sample.txt");
		Erdiko::moveFile("sample.txt",$webRoot."/www");
		$this->assertTrue(file_exists($webRoot."/www/sample.txt") == true);
		Erdiko::deleteFile("sample.txt",$webRoot."/www");
	}
	
	/*
	* @depends testWriteToFileAndReadFromFileThenDelete
	*/
	public function testRenameFileAndDelete()
	{
		$webRoot = dirname(dirname(__DIR__));
		$string="Sample string";
		Erdiko::writeToFile($string,"sample.txt",$webRoot."/www");
		Erdiko::renameFile("sample.txt","sample2.txt",$webRoot."/www");
		$this->assertTrue(file_exists($webRoot."/www/sample2.txt") == true);
		Erdiko::deleteFile("sample2.txt",$webRoot."/www");
	}
	
	/*
	* @depends testWriteToFileAndReadFromFileThenDelete
	*/
	public function testCopyFileRenameAndDelete()
	{
		$webRoot = dirname(dirname(__DIR__));
		$string="Sample string";
		Erdiko::writeToFile($string,"sample.txt");
		Erdiko::copyFile("sample.txt",$webRoot."/www");
		$this->assertTrue(file_exists($webRoot."/www/sample.txt") == true);
		
		$string="Sample string";
		Erdiko::writeToFile($string,"sample.txt");
		Erdiko::copyFile("sample.txt",$webRoot,"sample2.txt",$webRoot."/www");
		$this->assertTrue(file_exists($webRoot."/sample2.txt") == true);
		
		Erdiko::deleteFile("sample.txt");
		Erdiko::deleteFile("sample.txt",$webRoot."/www");
		Erdiko::deleteFile("sample.txt",$webRoot);
	}
	
	public function testLogFunctionsReadFromFile()
	{
		$webRoot = dirname(dirname(__DIR__));
		$sampleText="This is a sample log for Erdiko class test";
		Erdiko::log($sampleText);
		$return=Erdiko::readFromFile("erdiko.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,$sampleText) != false );	
		
		Erdiko::clearLog(true);
		$return=Erdiko::readFromFile("erdiko.log",$webRoot."/www/var/logs");
		$this->assertTrue(empty($return)==true);
		
		Erdiko::clearLog(true);
		Erdiko::log($sampleText,Logger::INFO);
		$return=Erdiko::readFromFile("erdiko.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,$sampleText) != false && strpos($return,"Info") != false);
		
		Erdiko::clearLog(true);
		Erdiko::log($sampleText,Logger::ERROR);
		$return=Erdiko::readFromFile("erdiko_error.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,$sampleText) != false && strpos($return,"Error") != false);
		
		Erdiko::clearLog(true);
		Erdiko::log(new Exception($sampleText));
		$return=Erdiko::readFromFile("erdiko_error.log",$webRoot."/www/var/logs");
		$this->assertTrue(strpos($return,$sampleText) != false );	
		
	}
}