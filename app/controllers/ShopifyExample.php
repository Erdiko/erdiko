<?php
/**
 * Examples Controller
 * Multiple examples of how you can use erdiko.  It includes some simple use cases.
 *
 * @category 	app
 * @package   	Example
 * @copyright	Copyright (c) 2014, Arroyo Labs, www.arroyolabs.com
 * @author 		John Arroyo, john@arroyolabs.com
 */
namespace app\controllers;

use Shopify;

/**
 * ShopifyExample Class  extends \erdiko\shopify\Shopify
 */
class ShopifyExample extends \erdiko\core\Controller
{
	/** Cache Object */
	private $cacheObj;
	/** Shopify Object */
	protected $shopify;

	/** Before */
	public function _before()
	{
		$this->setThemeName('bootstrap');
		$this->prepareTheme();

		$this->cacheObj = \Erdiko::getCache();

		if(isset($_GET['code']))
		{
			$this->cacheObj->put('code', $_GET['code']);
			$this->cacheObj->put('shop', $_GET['shop']);
		}

		if(!$this->cacheObj->has('code'))
		{
			$shop = self::returnSite();
			//var_dump($shop);
			$this->shopify = new Shopify($shop, "", self::returnApiKey(), self::returnSecret());
        	// get the URL to the current page
        
      		$pageURL = 'http';
	       // if ($_SERVER["HTTPS"] == "on") { $pageURL .= "s"; }
	        $pageURL .= "://";
	        if ($_SERVER["SERVER_PORT"] != "80") {
	            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	        } else {
	            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	        }

	        header("Location: " . $this->shopify->getAuthorizeUrl(self::returnScope(), $pageURL));
		}

			$this->shopify = new Shopify($this->cacheObj->get('shop'), "", self::returnApiKey(), self::returnSecret());

       		if(!$this->cacheObj->has('token'))
        	{
        		$token = $this->shopify->getAccessToken($this->cacheObj->get('code'));
        		$this->cacheObj->put('token', $token);
        	}

        	$this->shopify->setToken($this->cacheObj->get('token'));


	}

	/**
	 *	Get the shop URL
	 *
	 *	@return URL
	 **/
	private function returnSite()
	{
        $config = \Erdiko::getConfig('local/shopify');
        return $config['shop']['erdiko'];
	}

	/**
	 *	Get the API Key
	 *
	 *	@return string
	 **/
	private function returnApiKey()
	{
        $config = \Erdiko::getConfig('local/shopify');
        return $config['appInfo']['SHOPIFY_API_KEY'];
	}

	/**
	 *	Get the API Secret
	 *
	 *	@return string
	 **/
	private function returnSecret()
	{
        $config = \Erdiko::getConfig('local/shopify');
        return $config['appInfo']['SHOPIFY_SECRET'];
	}

	/**
	 *	Get the API Scope
	 *
	 *	@return string
	 **/
	private function returnScope()
	{
        $config = \Erdiko::getConfig('local/shopify');
        return $config['appInfo']['SHOPIFY_SCOPE'];
	}


	/**
	 * Homepage Action (index)
	 */
	public function getIndex()
	{
		// Add page data
		$this->setTitle('Shopify');
		$this->addView('shopify/index');
	}
	/**
	 * Get
	 *
	 * @param mixed $var
	 * @return mixed
	 */
	public function get($var = null)
	{
		// error_log("var: $var");
		if(!empty($var))
		{
			// load action based off of naming conventions
			return $this->_autoaction($var, 'get');

		} else {
			return $this->getIndex();
		}
	}

	/**
	 * Get Customer
	 */
	public function getCustomer()
	{
		$data = $this->shopify->call('GET', '/admin/customers.json', array());
		$this->setTitle('Shopify: Customers');
		$this->setContent( $this->getLayout('json', $data) );
	}

	/**
	 * Get Order
	 */
	public function getOrder()
	{
		$data = $this->shopify->call('GET', '/admin/orders.json', array());
		$this->setTitle('Shopify: Orders');
		$this->setContent( $this->getLayout('json', $data) );
	}


	/**
	 * Get Product
	 */
	public function getProduct()
	{
        $data = $this->shopify->call('GET', '/admin/products.json', array());
		$this->setTitle('Shopify: Grid');
		$this->setContent( $this->getLayout('grid/shopify', $data) );
	}

}