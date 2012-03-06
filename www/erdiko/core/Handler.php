<?php
/**
 * 
 */
namespace erdiko\core;

class Handler extends \ToroHandler 
{
    // public function __construct() { }
	
    public function get($param = null)
	{
		error_log("Hello World!");
		
		echo "Hello World!";
	}
}
