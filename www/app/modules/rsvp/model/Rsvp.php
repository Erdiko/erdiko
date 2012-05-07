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
		$this->checkForComplete($id);
		
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
		{
			// It matches, great!
			$confirmedGuests = $this->addGuests($id, $guests);
		}
		else
		{
			// Not good, this shouldn't happen maybe we can fix w/javascript
			$guests = array_slice($guests, 0, $request['num_guests']);
			$confirmedGuests = $this->addGuests($id, $guests);
		}
		
		// Mark wedding_rsvp column 'accept'
		$this->setAccept($id, 1, $request['comments']);
		
		// error_log("guestCt: $guestCt, num_guests: ".$request['num_guests']);
		// error_log('Confirmed Guests: '.print_r($confirmedGuests, true));
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
	
	public function setAccept($id, $accept, $comments = "")
	{
		$this->checkForComplete($id);
		
		if($accept === null)
			$accept = "null";
		else
			$accept = "'$accept'";
		
		$comments = addslashes($comments);
		
		$sql = "UPDATE `wedding_rsvp` SET `accept`=$accept, `comments`='$comments', `rsvp_date`=NOW() WHERE `wedding_rsvp_id`='$id'";
		$this->_db->write($sql);
	}
	
	/**
	 * Confirm recent changes, set 'rsvp_complete' flag
	 * @param int $id
	 */
	public function setComplete($id)
	{
		// mark wedding_rsvp table as complete
		$sql = "UPDATE `wedding_rsvp` SET `rsvp_complete`='1' WHERE `wedding_rsvp_id`='$id'";
		$this->_db->write($sql);
	}
	
	public function decline($id, $request)
	{
		$this->checkForComplete($id);
		
		// Mark wedding_rsvp column 'accept' as 0 (not comming)
		$this->setAccept($id, 0, $request['comments']);
	}
	
	public function deleteAllGuests($id)
	{	
		$sql = "DELETE FROM `wedding_rsvp_guest` WHERE `wedding_rsvp_id`='$id'";
		$this->_db->write($sql);
	}
	
	public function reset($id)
	{
		$this->checkForComplete($id);
		
		$this->setAccept($id, null, "");
		$this->deleteAllGuests($id);
	}
	
	/**
	 * If the guest has already completed their RSVP throw an exception.
	 * They should not be able to modify the RSVP.
	 */
	public function checkForComplete($id)
	{
		$sql = "SELECT * FROM `wedding_rsvp` WHERE `wedding_rsvp_id`='$id'";
		$data = $this->_db->query($sql);
		
		error_log('rsvp complete: '.$data[0]['rsvp_complete']);
		
		if( $data[0]['rsvp_complete'] == 1 )
			throw new \Exception('You cannot edit an RSVP after it has been confirmed.');
	}

}
?>