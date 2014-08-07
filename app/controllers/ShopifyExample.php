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
	private $cacheObj;
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
			
			// get the URL to the current page
	        $pageURL = 'http';
	        //if ($_SERVER["HTTPS"] == "on") { $pageURL .= "s"; }
	        $pageURL .= "://";
	        if ($_SERVER["SERVER_PORT"] != "80") {
	            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	        } else {
	            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	        }
	      	//echo($pageURL);
			//$pageURL = 'http://local.erdiko2.org/shopify/product';
	        // redirect to authorize url
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

	private function returnSite()
	{
        $config = \Erdiko::getConfig('local/shopify');
        return $config['shop']['erdiko'];
	}

	private function returnApiKey()
	{
        $config = \Erdiko::getConfig('local/shopify');
        return $config['appInfo']['SHOPIFY_API_KEY'];
	}

	private function returnSecret()
	{
        $config = \Erdiko::getConfig('local/shopify');
        return $config['appInfo']['SHOPIFY_SECRET'];
	}

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
		$products = $this->shopify->call('GET', '/admin/customers.json', array());
		$this->setTitle('Shopify: Grid');
		$this->setContent( $this->getLayout('grid/shopify', $products) );
	}

	/**
	 * Get Order
	 */
	public function getOrder()
	{
		$products = $this->shopify->call('GET', '/admin/orders.json', array());
		$this->setTitle('Shopify: Grid');
		$this->setContent( $this->getLayout('grid/shopify', $products) );
	}


	/**
	 * Get Product
	 */
	public function getProduct()
	{
        $products = $this->shopify->call('GET', '/admin/products.json', array());
		$this->setTitle('Shopify: Grid');
		$this->setContent( $this->getLayout('grid/shopify', $products) );
	}

}