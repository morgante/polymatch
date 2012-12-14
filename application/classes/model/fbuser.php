<?php

class Model_FBUser extends Model_Kohana_FBUser
{
	
	protected $_belongs_to = array(
	);
		
	/**
	 * Override to pull out our custom data
	 */
	public function __get( $key )
	{
		switch( $key )
		{
			case 'quiz':
				return parent::__get( $key );
			case 'state':
				// we no longer store this
				return 'NA';
				return $this->state();
				break;
			default:
				return parent::__get( $key );
		}
	}
	
	/**
	 * Helper function to derive state
	 * 
	 * NOTE: we don't store state data attached to the user
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