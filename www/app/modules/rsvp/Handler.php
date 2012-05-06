<?php
/**
 * RSVP Handler
 * @author John Arroyo, john@arroyolabs.com
 */
namespace app\modules\rsvp;

use Erdiko;
use \app\modules\rsvp\model\Rsvp;

class Handler extends \erdiko\core\Handler
{	
	// should be in config file (JSON)
	private $_textConfig = array(
		'login' => array(
			'title' => 'Welcome to the Pandey / Arroyo Wedding',
			'sub_title' => '',
			'description' => 'Have the RSVP card we sent you handy.',
		),
		'rsvp' => array(
			'title' => 'Pandey / Arroyo Wedding',
			'sub_title' => '',
			'description' => 'Please enter your RSVP information below.',
		),
		'confirmation' => array(
			'title' => 'Pandey / Arroyo Wedding',
			'sub_title' => '',
			'description' => 'Please check the the information below for accuracy.',
		),
		'done' => array(
			'title' => 'Pandey / Arroyo Wedding',
			'sub_title' => '',
			'description' => 'Thank you for your RSVP.',
		),
	);
	
	public function post($name = null, $arguments = null)
	{
		return $this->get($name, $arguments);
	}
	
	public function get($name = null, $arguments = null)
	{
		$arguments = $this->parseArguments($arguments);
		
		// error_log("name: ".$name);
		// error_log("arguments: ".print_r($arguments, true));
		
		/**
		 * Notes
		 * ...
		 */
		
		// Get the theme config defined in local.inc
		$file = $this->_webroot.$this->_localConfig['theme']['config'];
		$themeConfig = Erdiko::getConfigFile($file);
		
		// error_log('file: '.$file);
		// error_log('JSON theme config: '.print_r($themeConfig, true));
		
		$data = array(
			'header' => array(
				'content' => '<img src="/app/theme/rsvp/images/header.jpg">',
				'tagline' => "RSVP Tagline",
				'site_name' => "RSVP Site",
			),
			'footer' => array(
				'content' => "",
				'links' => array('link 1', 'link 2', 'link 3'),
			),
			'layout' => array(
				'columns' => 1,
			),
			'title' => "Pandey & Arroyo Wedding RSVP",
		);
		
		$data['sidebar'] = array(
			array(
				'block_title' => 'block 1',
				'block_content' => 'blah blah blah...',
				)
			);
		
		if( empty($name) )
		{
			$data['main_content'] = $this->indexAction($arguments);
		}
		else 
		{
			try 
			{
				$action = $name.'Action';
				$data['main_content'] = $this->$action($arguments);
			}
			catch(Exception $e)
			{
				// do something
			}
		}
		
		$this->theme($data);
	}
	
	/**
	 *
	 */
	public function loginAction($arguments)
	{
		error_log('request: '.print_r($_REQUEST, true));
		
		if($_REQUEST['code'] == "")
		{
			return "Please enter an RSVP code.";
		} 
		else
		{
			$rsvp = new Rsvp();
			$check = $rsvp->checkCode($_REQUEST['code']);
			
			// check to see if code is valid
			if(empty($check))
			{
				// this should be in a config file
				$formData = array(
					'title' => $this->_textConfig['login']['title'],
					'sub_title' => $this->_textConfig['login']['sub_title'],
					'description' => $this->_textConfig['login']['description'],
					'error' => 'We did not find your code, please re-enter it.',
				);
				
				$filename = __DIR__.'/templates/form/login.phtml';
				return  Erdiko::getTemplate($filename, $formData);
			}
			else
			{
				$data = array(
					'guest' => array(
						'wedding_rsvp_id' => $check[0]['wedding_rsvp_id'],
						'name' => $check[0]['name'],
						'code' => $check[0]['code'],
						'address' => $check[0]['address'],
						'num_rsvps' => $check[0]['num_rsvps'],
						'sangeet' => $check[0]['sangeet'],
						'rsvp_complete' => $check[0]['rsvp_complete'],
					),
					'title' => $this->_textConfig['rsvp']['title'],
					'sub_title' => $this->_textConfig['rsvp']['sub_title'],
					'description' => $this->_textConfig['rsvp']['description'],
				);
				
				$filename = __DIR__.'/templates/form/rsvp.phtml';
				return  Erdiko::getTemplate($filename, $data);
			}
		}
	}
	
	public function getGenericError()
	{
		return "<p>There was an error processing your request.  Please try again or call John at (646) 283-4609.</p>";
	}
	
	public function submit()
	{
		if($_REQUEST['wedding_rsvp_id'] == "")
		{
			return $this->getGenericError();
		} 
		else
		{
			$id = $_REQUEST['wedding_rsvp_id'];
			$rsvp = new Rsvp();
			
			// Check num_guests
			if( $_REQUEST['num_guests'] == 0 )
			{				
				$rsvp->decline($id, $_REQUEST);
				
			}
			elseif($_REQUEST['num_guests'] > 0)
			{
				// check num_guests against number found in form.
				$rsvpId = $rsvp->accept($id, $_REQUEST);
			}
			else
			{
				return $this->getGenericError();
			}
			
			$formData = array(
				'title' => $this->_textConfig['confirmation']['title'],
				'sub_title' => $this->_textConfig['confirmation']['sub_title'],
				'description' => $this->_textConfig['confirmation']['description'],
			);
			$formData = array_merge($formData, $rsvp->getRsvpData($id));
			
			$filename = __DIR__.'/templates/form/confirmation.phtml';
			return  Erdiko::getTemplate($filename, $formData);
		}
	}
	
	/**
	 *
	 */
	public function confirm()
	{
		$formData = array(
			'title' => $this->_textConfig['done']['title'],
			'sub_title' => $this->_textConfig['done']['sub_title'],
			'description' => $this->_textConfig['done']['description'],
		);
		
		$filename = __DIR__.'/templates/form/done.phtml';
		return  Erdiko::getTemplate($filename, $formData);
		
		return "still need to implement confirmation...";
	}
	
	/**
	 *
	 */
	public function formAction($arguments)
	{
		error_log('arguments: '.print_r($arguments, true));
		error_log('request: '.print_r($_REQUEST, true));
		
		if($arguments[0] == "submit")
		{
			return $this->submit();
		}
		elseif($arguments[0] == "confirm")
		{
			return $this->confirm();
		}
		else
		{
			return $this->getGenericError();
		}	
	}
	
	public function indexAction($arguments)
	{
		// this should be in a config file
		$formData = array(
			'title' => $this->_textConfig['login']['title'],
			'sub_title' => $this->_textConfig['login']['sub_title'],
			'description' => $this->_textConfig['login']['description'],
		);
		
		$filename = __DIR__.'/templates/form/login.phtml';
		return  Erdiko::getTemplate($filename, $formData);
	}
}

?>