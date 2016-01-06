<?php
/**
 * ErdikoTestCase
 * Erdiko base test case. Extend this for all unit tests and place shared utility functions here
 */
namespace tests;

use \Erdiko;

require_once dirname(dirname(dirname(dirname(__DIR__)))).'/bootstrap.php';

class ErdikoTestCase extends \PHPUnit_Framework_TestCase
{

}
