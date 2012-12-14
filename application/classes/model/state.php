<?php

class Model_State extends ORM
{
	
	protected $_primary_key = 'abbreviation';
	
	protected $_has_many = array(
		'people' => array( 'model' => 'person', 'foreign_key' => 'state' ),
		'politicians' => array( 'model' => 'politician', 'foreign_key' => 'state' ),
		'fbusers' => array( 'model' => 'fbuser', 'foreign_key' => 'state' )
	 );
	
}

?>