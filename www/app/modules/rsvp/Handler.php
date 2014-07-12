<?php
/**
 * RSVP Handler
 * 
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
		'review' => array(
			'title' => 'Pandey / Arroyo Wedding',
			'sub_title' => '',
			'description' => 'Below is the RSVP information we have for you.  
				If it is not correct please call John at (646) 283-4609',
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
			'sub_title' => 'Thank you for your RSVP',
			'description' => '',
		),
		'exception' => array(
			'title' => 'Pandey / Arroyo Wedding',
			'sub_title' => 'Error Occurred',
			'description' => 'There was an error processing your request, please start over and try again.  <a href="/rsvp/">Click Here</a>.',
		),
	);
	
	public function post($name = null, $arguments = null)
	{
		return $this->get($name, $arguments);
	}
	
	public function get($name = null, $arguments = null)
	{
		$arguments = $this->parseArguments($arguments);
		
		error_log("name: ".$name);
		error_log("arguments: ".print_r($arguments, true));
		
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
				'content' => '<img src="/app/contexts/rsvp/images/header.jpg">',
				'tagline' => "RSVP Tagline",
				'site_name' => "RSVP Site",
			),
			'footer' => array(
				'content' => "",
				'links' => array(
					array( 
						'name' => 'Visit JohnAndSweta.com',
						'url' => 'http://www.johnandsweta.com/',
					),
				),
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
			catch(\Exception $e)
			{
				$data['main_content'] = $this->getExceptionHtml( $e->getMessage() );
			}
		}
		
		$this->theme($data);
	}
	
	/**
	 *
	 */
	public function loginAction($arguments)
	{
		// error_log('request: '.print_r($_REQUEST, true));
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
					'error' => 'Sorry, we did not find your code.  Please re-enter it.',
				);
				
				$filename = __DIR__.'/views/form/login.phtml';
				return  Erdiko::getTemplate($filename, $formData);
			}
			else
			{
				error_log('check: '.print_r($check, true));
				error_log("id: ".$check[0]['wedding_rsvp_id']);
				
				// if marked as complete do not allow edits, show rsvp info instead
				if( $check[0]['rsvp_complete'] == 1)
				{
					$data = $rsvp->getRsvpData($check[0]['wedding_rsvp_id']);
					$temp = $this->_textConfig['review'];
					$data = $data + $temp;
					
					$filename = __DIR__.'/views/form/review.phtml';
					return  Erdiko::getTemplate($filename, $data);
				}
				else
				{
					$guest = $check[0];
					return $this->rsvp($guest);	
				}
			}
		}
	}
	
	public function rsvp($guest)
	{
		$data = array(
			'guest' => array(
				'wedding_rsvp_id' => $guest['wedding_rsvp_id'],
				'name' => $guest['name'],
				'code' => $guest['code'],
				'address' => $guest['address'],
				'num_rsvps' => $guest['num_rsvps'],
				'sangeet' => $guest['sangeet'],
				'rsvp_complete' => $guest['rsvp_complete'],
			),
			'title' => $this->_textConfig['rsvp']['title'],
			'sub_title' => $this->_textConfig['rsvp']['sub_title'],
			'description' => $this->_textConfig['rsvp']['description'],
		);

		$filename = __DIR__.'/views/form/rsvp.phtml';
		return  Erdiko::getTemplate($filename, $data);
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
			
			$filename = __DIR__.'/views/form/confirmation.phtml';
			return  Erdiko::getTemplate($filename, $formData);
		}
	}
	
	/**
	 *
	 */
	public function confirm()
	{
		$rsvp = new Rsvp();
		$rsvp->setComplete($_REQUEST['wedding_rsvp_id']);
		
		// Prepare email data
		$rsvpData = $rsvp->getRsvpData($_REQUEST['wedding_rsvp_id']);
		$body = "New RSVP\n\n".
			"Name: ".$rsvpData['guest']['name'].
			"\nComments: ".$rsvpData['guest']['comments'].
			"\nAccept Status: ".$rsvpData['guest']['accept']."\n\n";
		
		$i = 0;
		$guests = "";
		if( isset($rsvpData['guests'][0]) )
		{
			foreach( $rsvpData['guests'] as $guest )
			{
				$i++;
				$guests .= "name $i: ".$guest['name']."\n";
			}
		}
		
		if($i > 0)
			$body .= "RSVP Guest Names: \n".$guests;
		else
			$body .= "They will not be attending.";
		
		// send us an email
		Erdiko::sendEmail('johnandsweta@gmail.com', 'New Wedding RSVP', $body, 'johnandsweta@gmail.com');
		// Erdiko::sendEmail('john.arroyo@gmail.com', 'New Wedding RSVP', $body, 'johnandsweta@gmail.com');
		
		$formData = array(
			'title' => $this->_textConfig['done']['title'],
			'sub_title' => $this->_textConfig['done']['sub_title'],
			'description' => $this->_textConfig['done']['description'],
		);
		
		$filename = __DIR__.'/views/form/done.phtml';
		return  Erdiko::getTemplate($filename, $formData);
	}
	
	public function reset($id)
	{
		// clear RSVP info
		$rsvp = new Rsvp();
		$rsvp->reset($id);
		$data = $rsvp->getRsvpData($id);
		
		// return the rsvp form
		return $this->rsvp($data['guest']);
	}
	
	/**
	 *
	 */
	public function formAction($arguments)
	{
		// error_log('arguments: '.print_r($arguments, true));
		// error_log('request: '.print_r($_REQUEST, true));
		
		if($arguments[0] == "submit")
		{
			return $this->submit();
		}
		elseif($arguments[0] == "confirm")
		{
			return $this->confirm();
		}
		elseif($arguments[0] == "reset")
		{
			if( ! isset($arguments[1]) )
				return $this->getGenericError();
			
			return $this->reset($arguments[1]);
		}
		else
		{
			return $this->getGenericError();
		}	
	}
	
	public function getExceptionHtml($message)
	{
		$formData = array(
			'title' => $this->_textConfig['exception']['title'],
			'sub_title' => $this->_textConfig['exception']['sub_title'],
			'description' => $this->_textConfig['exception']['description'],
			'message' => $message,
		);
		
		$filename = __DIR__.'/views/form/exception.phtml';
		return  Erdiko::getTemplate($filename, $formData);
	}
	
	public function indexAction($arguments)
	{
		// this should be in a config file
		$formData = array(
			'title' => $this->_textConfig['login']['title'],
			'sub_title' => $this->_textConfig['login']['sub_title'],
			'description' => $this->_textConfig['login']['description'],
		);
		
		$filename = __DIR__.'/views/form/login.phtml';
		return  Erdiko::getTemplate($filename, $formData);  // new signature: Erdiko::getView($module, $template, $formData)
	}
}

?>