<?php
namespace tests\erdiko;

use erdiko\core\AjaxController;

require_once dirname(__DIR__).'/ErdikoTestCase.php';

class AjaxControllerTest extends \tests\ErdikoTestCase
{
    public $AjaxControllerObj = null;

    public function setUp()
    {
        $this->AjaxControllerObj = new \erdiko\core\AjaxController;
    }

    public function tearDown()
    {
        unset($this->AjaxControllerObj);
    }

    public function testNoFunctino()
    {
        //There is no function in AjaxController class
    }
}
