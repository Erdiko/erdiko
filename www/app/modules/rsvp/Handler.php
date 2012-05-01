<?php
/**
 * RSVP Handler
 * @author John Arroyo, john@arroyolabs.com
 */
namespace app\modules\rsvp;
use Erdiko;

class Handler extends \erdiko\core\Handler
{	
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
		error_log('rsvp webroot: '.$this->_webroot);
		error_log('rsvp local config: '.print_r($this->_localConfig, true));
		
		// Get the theme config defined in local.inc
		$file = $this->_webroot.$this->_localConfig['theme']['config'];
		$themeConfig = Erdiko::getConfigFile($file);
		
		error_log('file: '.$file);
		error_log('JSON theme config: '.print_r($themeConfig, true));
		
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
		// check to see if code is valied
		// load guest's info
		// send info to page (dummy data below)
		$data = array(
			'guest' => array(
				'id' => 2,
				'name' => 'Enrique & Natalia Sacasa',
				'code' => '7LVCMZ',
				'address' => '1067 Hart St Brooklyn NY 11237',
				'num_rsvps' => 6,
				'sangeet' => 2,
				'rsvp_complete' => 0,
				
			)
		);
		
		$filename = __DIR__.'/templates/form/rsvp.phtml';
		return  Erdiko::getTemplate($filename, $data);
		
		return "Sorry, we do not recognize that code.";
	}
	
	/**
	 *
	 */
	public function formAction($arguments)
	{
		
	}
	
	public function indexAction($arguments)
	{
		$formData = array('boo' => 'yah');
		
		$filename = __DIR__.'/templates/form/login.phtml';
		return  Erdiko::getTemplate($filename, $formData);
	}
}

?>