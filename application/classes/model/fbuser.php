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
		
		return ORM::factory('state', array( 'name' => $state ));
		// parent::__set( 'state', $state ); // we don't store this for privacy reasons

	}

}

?>