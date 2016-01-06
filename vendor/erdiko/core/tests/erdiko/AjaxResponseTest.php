<?php

use erdiko\core\AjaxResponse;
require_once dirname(__DIR__).'/ErdikoTestCase.php';


class AjaxResponseTest extends \tests\ErdikoTestCase
{
    var $ajaxResponseObj = null;

    function setUp()
    {
        $this->ajaxResponseObj = new \erdiko\core\AjaxResponse;
    }

    function tearDown() {
        unset($this->ajaxResponseObj);
    }

    function testRender()
    {
        $tempData = array(
            "status" => 200,
            "body" => null,
            "errors" => false
        );

        $tempData = json_encode($tempData);
        $return = $this->ajaxResponseObj->render();
        $this->assertEquals($tempData, $return);
    }

    function testRenderError()
    {
        $this->ajaxResponseObj->setStatusCode(500);
        $this->ajaxResponseObj->setErrors("true");

        $tempData = array(
            "status" => 500,
            "body" => null,
            "errors" => array("true")
        );
        $tempData = json_encode($tempData);
        $return = $this->ajaxResponseObj->render();
        $this->assertEquals($tempData, $return);
    }

  }
?>