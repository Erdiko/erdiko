<?php
/**
 * Erdiko Test Suite
 * Be sure to name your test cases MyClassTest.php where MyClass is the functionality being tested
 */
namespace tests;

class AllTests
{
    public static function suite()
    {
        $suite = new \PHPUnit_Framework_TestSuite('ErdikoTests');
        $testFiles = AllTests::_getTestFiles();

        foreach ($testFiles as $file) {
            $suite->addTestFile($file);
        }

        return $suite;
    }

    private static function _getTestFiles()
    {
        return glob('./*/*Test.php');
    }
}
