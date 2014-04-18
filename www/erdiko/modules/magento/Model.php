<?php
/**
 * Magento model
 * Base model every magento model should inherit
 * 
 * @category 	Erdiko
 * @package  	Modules
 * @copyright 	Copyright (c) 2014, Arroyo Labs, http://www.arroyolabs.com
 * @author 		John Arroyo, john@arroyolabs.com
 */
namespace erdiko\modules\magento;
require_once __DIR__."/bootstrap.php";

use \Erdiko;

class Model extends \erdiko\core\ModelAbstract
{
	protected $_storeId = null;
	public static $storeMapper = array(
			'0' => 'admin',
			'1' => 'default'
		);

	public function __construct($storeId = 1)
	{
		$this->_storeId = $storeId;
		$this->bootstrap($this->_storeId);
	}

	/**
	 * Load Magento's bootstrap
	 * @param int $storeId
	 */
	public function bootstrap($storeId = 1)
	{
		if ( ! defined('IS_MAGENTO_ACTIVE'))
		{
			require_once MAGENTO_ROOT.'/app/Mage.php';
			\Mage::app( self::$storeMapper[$storeId] );
			// $resource = \Mage::getSingleton('core/resource');
			// error_log("mage: ".get_class($resource));
			define('IS_MAGENTO_ACTIVE', TRUE); // define var so we know Magento is loaded
		}
	}
}
