<?php
abstract class Abstract_Service
{
    /**
     * The array of initial(raw) parameters passed from client(controller)
     * @var array
     */
    protected $_arr_params;

    /**
     * the response object of the service
     * @var Erdiko_Response
     */
    protected $_response;

    public function __construct($arr_params=null)
    {
        $this->_arr_params = $arr_params;
        $this->_response = new Erdiko_Response(true);
        $this->init();
    }

    public function getResponse() {
        return $this->_response;
    }

    // This is just a post-constructor hook to implement in derived classes if there's a need
    public function init(){}
}