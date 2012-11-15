<?php

class Model_Person extends ORM
{

	protected $_belongs_to = array(
		'state' => array( 'foreign_key' => 'state' )
	);
	
	protected $_has_many = array(
		'scores' => array( 'model' => 'score', 'foreign_key' => 'person_id' ),
	 );
	
}

?>