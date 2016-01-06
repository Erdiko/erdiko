<?php
namespace tests\erdiko;

use erdiko\core\View;

require_once dirname(__DIR__).'/ErdikoTestCase.php';


class ViewTest extends \tests\ErdikoTestCase
{
    public $viewObj = null;

    public function setUp()
    {
        $this->viewObj = new \erdiko\core\View;
    }

    public function tearDown()
    {
        unset($this->viewObj);
    }

    public function testNoFunctino()
    {
        //There is no function in view class
    }
}
