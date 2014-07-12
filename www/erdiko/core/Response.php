<?php
/**
 * Erdiko Response Object
 * 
 * @category    Erdiko
 * @package     Core
 * @copyright   Copyright (c) 2013, Arroyo Labs, http://www.arroyolabs.com
 * @author      Hayk Hakobyan
 * @author      John Arroyo, john@arroyolabs.com
 */
namespace erdiko\core;

class Response
{
    protected $_success;
    protected $_messages;
    protected $_data;

    /*
     * Constructor - fills member vars $_success, $_data and $_messages
     * depending on validation outcome
     *
     * @param boolean $success holds validation outcome
     * @param misc $primaryInfo : either data or error msgs depending on the $success
     * @param misc $secondaryInfo: either data or error msgs depending on the $success
     */
    public function __construct($success=null, $primaryInfo = null, $secondaryInfo = null)
    {
        if($success !== null)
        {
            if($success) {
                $this->success($primaryInfo, $secondaryInfo);
            } else {
                $this->fail($primaryInfo, $secondaryInfo);
            }
        }
    }

    /*
     * Return array filled with data from instance's
     * protected member vars
     *
     * @return array $arr_response
     *
     */
    public function toArray()
    {
        $arr_response = array('success' => $this->_success);
        if($this->_success)
        {
            if(isset($this->_data))
            {

                // If it's an array go throught the elements and call the toArray on them if it's an object
                if(is_array($this->_data)) {
                    $arr_response['data'] = array();
                    foreach ($this->_data as $key => $value)
                    {
                        if(is_object($value)) {
                            if(method_exists($value, 'toArray')) {
                                $arr_response['data'][$key] = $value->toArray();
                            }else {
                                $arr_response['data'][$key] = "unable to convert";
                            }
                        }else {
                            $arr_response['data'][$key] = $value;
                        }
                    }
                } else {
                    if(is_object($this->_data)) {
                        if(method_exists($this->_data, 'toArray')) {
                            $arr_response['data'] = $this->_data->toArray();
                        }else {
                            $arr_response['data'] = "unable to convert";
                        }
                    } else {
                        $arr_response['data'] = $this->_data;
                    }
                }
            }
        }else {
            if($this->_messages || is_array($this->_messages)) {
                $arr_response['errors'] = $this->_messages;
            }
        }
        return $arr_response;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /*
     * If validation succeed fills member var data with messages if any
     * and returns object instance to caller
     *
     * @param array $data
     *
     * @return Response object of chaining
     *
     */
    public function success($data = null, $messages = null) {
        $this->_success = true;
        if($data!==null) {
            $this->_data = $data;
        }
        if($messages) {
            $this->_messages = $messages;
        }

        return $this;
    }

    /*
     * If validation fails fills member var error_messages with messages
     * and returns object instance to caller
     *
     * @param array $error_messages
     *
     * @return Response object for chaining
     *
     */
    public function fail($messages = null, $data = null) {
        $this->_success = false;
        if($messages) {
            $this->_messages = $messages;
        }
        if($data!==null) {
            $this->_data = $data;
        }

        return $this;
    }


    /*
     * is success or not
     *
     * @return Boolean
     *
     */
    public function isSuccess(){
        return $this->_success;
    }

    /*
     * is failure or not
     *
     * @return Boolean
     *
     */
    public function isFailure(){
        return !$this->_success;
    }

    /*
     * access protected member vars/arrays: either the data array or an element
     * @param String $key - key of array to use
     * @returns Mix
     *
     */
    public function getData($key = null) {

        if($key)
        {
            return $this->_data[$key];
        }

        return $this->_data;

    }
    /**
     * Sets the data and returns $this for chaining
     *
     * @param array $data: key/value pairs
     * @return $this
     */
    public function setData($data) {

        $this->_data = $data;
        return $this;

    }

    public function __get($key)
    {
        if(isset($this->_data[$key]))
        {
            return $this->_data[$key];
        }

        if(isset($this->_messages[$key])) {
            return $this->_messages[$key];
        }

        return false;
    }

    /**
     * Adds data and returns $this for chaining
     *
     * @param string $key
     * @param mix $value
     * @returns Response object for chaining
     */
    public function addData($key, $value)
    {
        $this->__set($key, $value);
        return $this;
    }
    public function __set($key, $value)
    {
        $this->_data[$key] = $value;
    }

    public function setIfNotExist($key, $value)
    {
        if(!isset($this->_data[$key])) {
            $this->_data[$key] = $value;
        }

        return $this;
    }

    /*
     * @param boolean $returnString
     * @returns - array one dimesional array
     * 
     */
    public function getMessages($returnString = false)
    {
        if(!$returnString) {
            return $this->_messages;
        }
        if(!empty($this->_messages)) {
            return implode('<br>', $this->_messages);
        }
        return '';
    }

    /**
     * Similar to fail() method only this one just adds the message in the messages array
     **/
    public function addErrorMessage($errorMessage)
    {
        $this->_success = false;
        $this->_messages[] = $errorMessage;

        return $this;
    }
}