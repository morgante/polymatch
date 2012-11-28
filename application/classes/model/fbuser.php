<?php

class Model_FBUser extends Model_Kohana_FBUser
{
	
	protected $_belongs_to = array(
		'state' => array( 'foreign_key' => 'state' )
	);
		
	/**
	 * Override to pull out our data
	 */
	public function __get( $key )
	{
		if( $key == 'state' )
		{
			return $this->state();
		}
		
		return parent::__get( $key );
	}
	
	/**
	 * Helper function to derive state
	 */
	public function state()
	{
		if( parent::__get( 'state' ) != null )
		{
			return parent::__get( 'state' );
		}
		
		$data = Facebook::factory()->fql('SELECT current_location, hometown_location FROM user WHERE uid=' . $this->id);
		
		$state = 'NA';
				
		if($data[0]['current_location']['country'] == 'United States') // first see if currently living in the states
		{
			$state = $data[0]['current_location']['state'];
		}
		elseif($data[0]['hometown_location']['country'] == 'United States') // then see if born in the states
		{
			$state = $data[0]['hometown_location']['state'];
		}
		
		if( $state != 'NA' )
		{
			// we found a state, now convert it to 2 letters
			$state = ORM::factory('state', array( 'name' => $state ))->abbreviation;			
		}
		
		parent::__set( 'state', $state );
		
		return $state;

	}

}

?>