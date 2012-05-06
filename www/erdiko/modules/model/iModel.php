<?php
/**
 * Model Interface
 * All models should implement this interface
 * 
 * @category   Erdiko
 * @package    modules
 * @module	   model
 * @copyright Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author	John Arroyo, john@arroyolabs.com
 */
namespace erdiko\modules\model;

interface iModel
{
	public function write($data);
	public function get($data);
}

?>