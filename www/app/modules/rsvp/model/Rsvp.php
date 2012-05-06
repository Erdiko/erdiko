<?php
/**
 * Rsvp model
 * Not a true model...a pseudo model
 */
namespace app\modules\rsvp\model;

use \erdiko\core\datasource\MySql;
use \Erdiko;

class Rsvp
{
	private $_db;
	
	public function __construct()
	{
		$this->getDb();
	}
	
	public function getDb()
	{
		// get connection info...
		$config = Erdiko::getConfig('database');
		
		$this->_db = new MySql($config['master']['host'], 
			$config['master']['user'], $config['master']['pass'], $config['master']['schema']);
	}
	
	public function checkCode($code)
	{
		$sql = "SELECT * FROM wedding_rsvp WHERE code='$code'";
		$data = $this->_db->query($sql);
		// error_log('check code: '.print_r($data, true));
		
		return $data;
	}
	
	// @todo flush out
	public function addGuests($id, $guests)
	{
		// write each guest to the db...
		for($i = 0; $i < count($guests); $i++)
		{
			$sql = "INSERT INTO `wedding_rsvp_guest` (`wedding_rsvp_id`, `name`) 
				VALUES ( '$id', '".addslashes($guests[$i]['name'])."')";
			$rsvpGuestId = $this->_db->write($sql);
		}
		
		return $guests;
	}
	
	public function accept($id, $request)
	{
		// check num_guests against number found in form.
		
		// add each guest
		$guests = array();
		$guestId = 1;
		$guestIdName = 'guest'.$guestId;
		while( isset($request[$guestIdName]) )
		{
			if( ! empty($request[$guestIdName]) )
			{
				$guests[] = array( 'name' => $request[$guestIdName] );
			}
			$guestId++;
			$guestIdName = 'guest'.$guestId;
		}
		
		// make sure counts match
		$guestCt = count($guests);
		if($request['num_guests'] == $guestCt)
			$confirmedGuests = $this->addGuests($id, $guests);
		
		error_log("guestCt: $guestCt, num_guests: ".$request['num_guests']);
		error_log('Confirmed Guests: '.print_r($confirmedGuests, true));
		
		// mark wedding_rsvp table as complete
		// $this->markComplete(); // could add this as a confirmation step :-)
	}
	
	public function getRsvpData($id)
	{
		$data = array();
		
		// get the guest data
		$sql = "SELECT * FROM wedding_rsvp WHERE wedding_rsvp_id='$id'";
		$temp = $this->_db->query($sql);
		$data['guest'] = $temp[0];
		
		// get the rsvp guests data
		$sql = "SELECT * FROM wedding_rsvp_guest WHERE wedding_rsvp_id='$id'";
		$data['guests'] = $this->_db->query($sql);
		
		return $data;
	}
	
	/**
	 * Confirm recent changes
	 * @param int $id
	 * @return int $success
	 */
	public function confirm($id)
	{
		
	}
	
	public function decline($id, $_REQUEST)
	{
		
	}

}
?>