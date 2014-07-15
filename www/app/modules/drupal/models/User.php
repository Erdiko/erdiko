<?php
/**
 * Erdiko CMS model
 * 
 * @category	app
 * @package		cms
 * @copyright	Copyright (c) 2013, Arroyo Labs, Inc.
 * @author		John Arroyo, john@arroyolabs.com
 */
namespace app\modules\community\cms\models;

use \Erdiko;


class User extends \erdiko\modules\drupal\Model
{
	protected $_userData;
	protected $_userId = 0;

	const ROLE_ADMINISTRATOR = 3;
	const ROLE_AUTHENTICATED_USER = 2;


	public function setUserData($userData)
	{
		$this->_userData = $userData;
	}

	public function getUserData()
	{
		return $this->_userData;
	}

	public function setUserId($userId)
	{
		$this->_userId = $userId;
	}

	public function getUserId()
	{
		return $this->_userId;
	}

	/**
	 * Create new user
	 * @param array $form
	 */
	public function createUser($form)
	{
		// @todo additional form validate

		// Prepare user data to write to drupal
		$userinfo = array(
      		'init' => $form['email'],
      		'mail' => $form['email'],
      		'pass' => $form['password'],
      		'field_gender' => array(LANGUAGE_NONE =>
			 	array(0 =>
					array('value' => $form['gender']) ) ),
      		'roles' => array(2 => 'authenticated user'),
      		'language' => 'en',
      		'status' => 1
    	);
    	
    	// determine username
    	if(isset($form['name']))
    		$userinfo['name'] = $this->_convertUserName($form['name']);
    	else
    		$userinfo['name'] = $this->_emailToUserName($form['email']);
		
		$success = 0;
		$e = null;

    	try {
    		$account = \user_save(null, $userinfo);

			// see if successful
    		if(!empty($account->uid))
			{
				if(is_numeric($account->uid))
				{
					$success = 1;

                    $this->setUserData($account);
                    $this->setUserId($account->uid);
				}
			}
    	} catch (\Exception $e) {
			error_log("e: ".print_r($e, true));
    	}

    	$data = array(
    		'success' => $success
    		);

    	// prepare response 
    	// @todo redo to send back flag and load additional data into model object
    	if($success) {
    		$data['user'] = $account;
    		$this->createSession();

    	} else {
    		$data['user'] = null;
    		$data['error'] = array();
    		if($e == null)
    			$data['error']['message'] = $account['errorInfo'];
    		else
    			$data['error']['message'] = $e->getMessage();
    	}
    	// error_log("data: ".print_r($data, true));

    	return $data;
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
		$sucess = 0;

		try {
			if( $this->isEmail($email) )
				$username = $this->getUserName($email);
			else
				$username = $email;

			if(\user_authenticate($username, $password)) {
      			$userObj = \user_load_by_name($username);
      			$this->setUserData($userObj);
      			$this->setUserId($userObj->uid);
      			$formState = array();
      			$formState['uid'] = $userObj->uid;      
      			\user_login_submit(array(), $formState);

      			$sucess = 1;
      		} else {
      			$this->setError("login failed, bad username or password.");
      		}
    	} catch (\Exception $e) {
    		$this->setError($e->getMessage());
    	}

    	return $sucess;
	}

	/**
	 * get drupal username from email address (users:name)
	 * @param string $email
	 * @return string $name
	 */
	public function getUserName($email)
	{
 		$query = \db_select('users', 'u');
 		$name = $query->fields('u', array('name'))
 			->condition('u.mail', $email)
 			->execute()
 			->fetchField();

  		if($name) {
    		return $name;
  		} else {
    		return null;
  		}
  	}

  	public function createSession()
	{
		session_start();
		$_SESSION['user_object'] 		= $this->getUserData();
		$_SESSION['user_id']     		= $this->getUserId();
	}

	public function getUser($userId)
	{
		try {
			if($userObj = \user_load($userId)) {
      			$this->setUserData($userObj);
      			$this->setUserId($userObj->uid);
      		} else {
      			$this->setError("No user found with id $userId.");
      		}
    	} catch (\Exception $e) {
    		$this->setError($e->getMessage());
    	}
	}

	public function updateUser($user)
	{
		
	}

  	public function logout()
  	{
  		// \user_logout(); // drupal logout
  		return session_destroy(); // destroy Erdiko session
  	}

	public static function getIdentity()
	{
        	$identity = array();

	        if(!empty($_SESSION['user_object'])) {
        	    $identity = array("user_id" => $_SESSION['user_id'], "user_object" => $_SESSION['user_object']);
	        }

	        return $identity;
	}
	
	public function resetPassword($email)
	{	
		$users = \user_load_multiple(array(), array('mail' => $email, 'status' => '1'));
		$account = \reset($users);

		if (isset($account->uid))
		{
			$mail=\_user_mail_notify('password_reset', $account, null);
			if (!empty($mail))
				return true;
		}
		return false;
	}
	
	public function submitPassword($password,$userId)
	{
		$account = \user_load($userId); // actually returns a user object but can be used as an account object
		//$newhash = \user_hash_password($password);
		$user = \user_save($account, $edit = array('pass' => $password), $category = 'account');
		return $user;
		
		if($user)
			return true;
		else
			return false;
	}
}