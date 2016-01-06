<?php
/**
 * Controller
 *
 * Base request handler, All controllers should inherit this class.
 *
 * @category   Erdiko
 * @package    Core
 * @copyright  Copyright (c) 2014, Arroyo Labs, http://www.arroyolabs.com
 *
 * @author     John Arroyo john@arroyolabs.com
 * @author     Andy Armstrong andy@arroyolabs.com
 */
namespace erdiko\core;

use Erdiko;

/**
 * AjaxController class
 */
class AjaxController extends Controller
{

  /**
   * Contructor
   */
    public function __construct()
    {
        $this->_webroot = ROOT;
        $this->_response = new \erdiko\core\AjaxResponse;
    }

  /**
   * setStatusCode
   *
   */
    public function setStatusCode($code = null)
    {
        if (!empty($code)) {
            $this->_response->setStatusCode($code);
        }
    }

    public function setErrors($errors = null)
    {
        if (!empty($errors)) {
            $this->_response->setErrors($errors);
        }
    }
}
