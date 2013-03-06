<?php
/**
 * Base Model
 * All custom model types should extend this core class
 *
 * @category	Erdiko
 * @package 	Core
 * @copyright 	Copyright (c) 2012, Arroyo Labs, http://www.arroyolabs.com
 * @author 		John Arroyo, john@arroyolabs.com
 */
namespace erdiko\core;
// namespace \erdiko\core;

abstract class ModelAbstract 
{	
	protected $_error = null;


	public function setError($error)
	{
		$this->_error = $error;
	}
	
	public function getError()
	{
		return $this->_error;
	}
}