<?php
/**
 * Erdiko CMS model example
 *
 * @category   app
 * @package    cms
 * @copyright  Copyright (c) 2012, Arroyo Labs, www.arroyolabs.com
 * @author John Arroyo, john@arroyolabs.com
 */
namespace app\modules\community\cms\models;

use \Erdiko;

class Cms extends \erdiko\modules\drupal\Model
{
	/**
	 * Get test node
	 * 
	 * @return array $data
	 */
	public function getTestNode()
	{
		$node = $this->getNode(1);
		error_log('test node: '.print_r($node, true));
		
		return $node;
	}

	public function getContactForm()
	{
		\module_load_include('inc', 'contact', 'contact.pages');
		return \drupal_render( \drupal_get_form('contact_site_form') );
	}
	
	public function submitContactForm($formState)
	{
		\contact_site_form_submit(null,$formState);
	}
}