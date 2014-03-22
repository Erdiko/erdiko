<?php
/**
 * Magento User model
 * 
 * @category	app
 * @package		magento
 * @copyright	Copyright (c) 2014, Arroyo Labs, Inc.
 * @author		John Arroyo, john@arroyolabs.com
 */
namespace app\modules\magento\models;

use \Erdiko;


class User extends \erdiko\modules\magento\Model
{
	protected $_userData;
	protected $_userId = 0;


	public function test()
	{
		error_log("test");
	}

	public function getAdminUser($id)
	{
		$adminUser = \Mage::getModel('admin/user')->load($id);

		return $adminUser;
	}

	/**
	 * Create new user
	 * @param array $form
	 */
	public function createUser($form)
	{

	}

	/**
	 * Sanitize username
	 * @todo imeplement this function
	 */
	protected function _convertUserName($name)
	{
		return trim($name);
	}

	/**
	 *
	 */
	protected function _emailToUserName($email)
	{
		$username = preg_replace('/[^\x{80}-\x{F7} a-z0-9@_.\'-]/i', '-', trim($email));
		return $username;
	}

	public function isEmail($email)
	{
		return filter_var( $email, FILTER_VALIDATE_EMAIL );
	}

	/**
	 * Login
	 * User can login via username or email
	 * @param string $email, username or email adddress
	 * @return bool $success
	 */
	public function login($email, $password)
	{

	}

  	public function createSession()
	{

	}

	public function getUser($userId)
	{

	}

	public function updateUser($user)
	{
		
	}

  	public function logout()
  	{
  		return session_destroy(); // destroy Erdiko session
  	}
}