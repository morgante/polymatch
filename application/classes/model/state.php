<?php

class Model_State extends ORM
{
	
	protected $_primary_key = 'abbreviation';
	
	protected $_has_many = array(
		'people' => array( 'model' => 'person', 'foreign_key' => 'state' ),
		'politicians' => array( 'model' => 'politician', 'foreign_key' => 'state' ),
		'fbusers' => array( 'model' => 'fbuser', 'foreign_key' => 'state' )
	 );
	
	/**
	 * helper to get the politicians which relate to a state
	 */
	public function politicians( $include_national = true, $include_self = true )
	{
		$state = $this->politicians->find_all()->as_array();
		
		if( $include_national )
		{
			$national = ORM::Factory( 'state', 'US')->politicians->find_all()->as_array();	
		}
		
		if( $include_self )
		{
			$national[] = Model_Politician::self();
		}
		
		$pols = array_merge( $state, $national );
		
		return $pols;
		
	}
	
}

?>