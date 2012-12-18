<?php

class Model_Politician extends ORM
{

	protected $_belongs_to = array( 'state' => array( 'foreign_key' => 'state' ) );
	
	protected $_has_many = array(
		'scores' => array( 'model' => 'score', 'foreign_key' => 'politician_id' ),
	 );
	
	public static function get_id( $politician )
	{		
		if( is_int( $politician ) )
		{
			$politician_id = $politician;
		}
		elseif( is_string( $politician ) )
		{
			$politician = ORM::factory( 'politician' )->where( 'name', '=', $politician )->find();
		}
		
		if( is_object( $politician ) )
		{
			$politician_id = $politician->id;
		}
		
		return $politician_id;
	}
	
	/**
	 * Helper function to create the "self" politician
	 */
	public static function self()
	{
		$pol = ORM::factory( 'politician' );
		$pol->id = 'self';
		$pol->name = 'Yourself';
		
		return $pol;
	}
	
}

?>