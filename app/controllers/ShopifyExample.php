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

define('SHOPIFY_API_KEY', 'ec29dd93ee7e40a8f1d9b914ab16ba04');
define('SHOPIFY_SECRET', '6451dac2ba28f48fecb1ec8aa3d0bcb8');
define('SHOPIFY_SCOPE', 'write_products');

/**
 * ShopifyExample Class  extends \erdiko\shopify\Shopify
 */
class ShopifyExample extends \erdiko\core\Controller
{
	static $code;
 	static $shop;

	/** Before */
	public function _before()
	{
		$this->setThemeName('bootstrap');
		$this->prepareTheme();
	}

	/** Get Hello */
	public function getHello()
	{
		//$this->setTitle('Hello World');
		//$this->setContent("Hello World");
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
     * Get Example
     */
	public function getExample()
	{
		$content = array(
			'hello' => 'world',
			'ajax' => 'rocks'
			);

		//$this->setContent($content);
	}

	/**
	 * Install Erdiko APP
	 */
	public function getInstallation()
	{
		$shop = 'beshbox.myshopify.com';
		$shopify = new Shopify($shop, "", SHOPIFY_API_KEY, SHOPIFY_SECRET);

        // get the URL to the current page
        
        $pageURL = 'http';
       // if ($_SERVER["HTTPS"] == "on") { $pageURL .= "s"; }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
		//echo($pageURL);
		$pageURL = 'http://local.erdiko2.org/shopify/accessToken';
        // redirect to authorize url
        header("Location: " . $shopify->getAuthorizeUrl(SHOPIFY_SCOPE, $pageURL));
        exit;
	}

	/**
	 * Get Token
	 */
	public function getAccessToken()
	{
		//var_dump($_GET);
		$json_string = json_encode($_GET, JSON_PRETTY_PRINT);
        echo "<pre>".$json_string."</pre>";
            

		if (isset($_GET['code'])) { // if the code param has been sent to this page... we are in Step 2
        // Step 2: do a form POST to get the access token
        //echo "<pre>".$_GET['shop']."</pre>";
		//echo '<p> Code: '.self::$code.'</p>';
		//echo '<p> Shop: '.self::$shop.'</p>';
		self::$code = $_GET['code'];
		self::$shop = $_GET['shop'];
        
        $shopify = new Shopify($_GET['shop'], "", SHOPIFY_API_KEY, SHOPIFY_SECRET);
        //session_unset();

        // Now, request the token and store it in your session.
        $_SESSION['token'] = $shopify->getAccessToken($_GET['code']);
        if ($_SESSION['token'] != '')
            $_SESSION['shop'] = $_GET['shop'];

        header("Location: http://local.erdiko2.org/");

        exit;  
   		}
   		else if (isset(self::$code))
   		{
   			echo '<p> Code: '.self::$code.'</p>';
			echo '<p> Shop: '.self::$shop.'</p>';
   		}
   		else
   		{
   			echo '<p> Code: '.self::$code.'</p>';
			echo '<p> Shop: '.self::$shop.'</p>';
   			echo('Please install the APP first!');
   		}
	}

	/**
	 * Get Product
	 */
	public function getProduct()
	{
		$shop = 'beshbox.myshopify.com';
		$shopify = new Shopify($shop, "", SHOPIFY_API_KEY, SHOPIFY_SECRET);

        // get the URL to the current page
        
        $pageURL = 'http';
       // if ($_SERVER["HTTPS"] == "on") { $pageURL .= "s"; }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
		//echo($pageURL);
		$pageURL = 'http://local.erdiko2.org/shopify/takingProduct';
        // redirect to authorize url
        header("Location: " . $shopify->getAuthorizeUrl(SHOPIFY_SCOPE, $pageURL));
        exit;
	}

	/**
	 * Taking Product
	 */
	public function getTakingProduct()
	{
		$json_string = json_encode($_GET, JSON_PRETTY_PRINT);
		//echo "<pre>".$json_string."</pre>";

		if (isset($_GET['code'])) { // if the code param has been sent to this page... we are in Step 2
        // Step 2: do a form POST to get the access token
		//echo '<p> Code: '.self::$code.'</p>';
		//echo '<p> Shop: '.self::$shop.'</p>';
		self::$code = $_GET['code'];
		self::$shop = $_GET['shop'];
        
        $shopify = new Shopify($_GET['shop'], "", SHOPIFY_API_KEY, SHOPIFY_SECRET);
        //session_unset();

        // Now, request the token and store it in your session.
        $_SESSION['token'] = $shopify->getAccessToken($_GET['code']);
        if ($_SESSION['token'] != '')
            $_SESSION['shop'] = $_GET['shop'];

        $shopify->setToken($_SESSION['token']);
        //var_dump($_SESSION);
        // Get all products
        $products = $shopify->call('GET', '/admin/products.json', array());
        // header('Content-Type: application/json');
        $json_string = json_encode($products, JSON_PRETTY_PRINT);
        echo "<pre>".$json_string."</pre>";

        //header("Location: http://local.erdiko2.org/");

        exit;  
   		}
   		else
   		{
   			echo('Please install the APP first!');
   		}
	}


	/**
	 * Get Customer
	 */
	public function getCustomer()
	{
		$shop = 'beshbox.myshopify.com';
		$shopify = new Shopify($shop, "", SHOPIFY_API_KEY, SHOPIFY_SECRET);

        // get the URL to the current page
        
        $pageURL = 'http';
       // if ($_SERVER["HTTPS"] == "on") { $pageURL .= "s"; }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
		//echo($pageURL);
		$pageURL = 'http://local.erdiko2.org/shopify/takingCustomer';
        // redirect to authorize url
        header("Location: " . $shopify->getAuthorizeUrl(SHOPIFY_SCOPE, $pageURL));
        exit;
	}

	/**
	 * Taking Customer
	 */
	public function getTakingCustomer()
	{
		$json_string = json_encode($_GET, JSON_PRETTY_PRINT);
		//echo "<pre>".$json_string."</pre>";

		if (isset($_GET['code'])) { // if the code param has been sent to this page... we are in Step 2
        // Step 2: do a form POST to get the access token
		//echo '<p> Code: '.self::$code.'</p>';
		//echo '<p> Shop: '.self::$shop.'</p>';
		self::$code = $_GET['code'];
		self::$shop = $_GET['shop'];
        
        $shopify = new Shopify($_GET['shop'], "", SHOPIFY_API_KEY, SHOPIFY_SECRET);
        //session_unset();

        // Now, request the token and store it in your session.
        $_SESSION['token'] = $shopify->getAccessToken($_GET['code']);
        if ($_SESSION['token'] != '')
            $_SESSION['shop'] = $_GET['shop'];

        $shopify->setToken($_SESSION['token']);
        //var_dump($_SESSION);
        // Get all products
        $products = $shopify->call('GET', '/admin/customers.json', array());
        // header('Content-Type: application/json');
        $json_string = json_encode($products, JSON_PRETTY_PRINT);
        echo "<pre>".$json_string."</pre>";

        //header("Location: http://local.erdiko2.org/");

        exit;  
   		}
   		else
   		{
   			echo('Please install the APP first!');
   		}
	}


	/**
	 * Get Order
	 */
	public function getOrder()
	{
		$shop = 'beshbox.myshopify.com';
		$shopify = new Shopify($shop, "", SHOPIFY_API_KEY, SHOPIFY_SECRET);

        // get the URL to the current page
        
        $pageURL = 'http';
       // if ($_SERVER["HTTPS"] == "on") { $pageURL .= "s"; }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
		//echo($pageURL);
		$pageURL = 'http://local.erdiko2.org/shopify/takingOrder';
        // redirect to authorize url
        header("Location: " . $shopify->getAuthorizeUrl(SHOPIFY_SCOPE, $pageURL));
        exit;
	}

	/**
	 * Taking Order
	 */
	public function getTakingOrder()
	{
		$json_string = json_encode($_GET, JSON_PRETTY_PRINT);
		//echo "<pre>".$json_string."</pre>";

		if (isset($_GET['code'])) { // if the code param has been sent to this page... we are in Step 2
        // Step 2: do a form POST to get the access token
		//echo '<p> Code: '.self::$code.'</p>';
		//echo '<p> Shop: '.self::$shop.'</p>';
		self::$code = $_GET['code'];
		self::$shop = $_GET['shop'];
        
        $shopify = new Shopify($_GET['shop'], "", SHOPIFY_API_KEY, SHOPIFY_SECRET);
        //session_unset();

        // Now, request the token and store it in your session.
        $_SESSION['token'] = $shopify->getAccessToken($_GET['code']);
        if ($_SESSION['token'] != '')
            $_SESSION['shop'] = $_GET['shop'];

        $shopify->setToken($_SESSION['token']);
        //var_dump($_SESSION);
        // Get all products
        $products = $shopify->call('GET', '/admin/orders.json', array('published_status'=>'published'));
        // header('Content-Type: application/json');
        $json_string = json_encode($products, JSON_PRETTY_PRINT);
        echo "<pre>".$json_string."</pre>";

        //header("Location: http://local.erdiko2.org/");

        exit;  
   		}
   		else
   		{
   			echo('Please install the APP first!');
   		}
	}

}