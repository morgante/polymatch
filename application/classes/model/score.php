<?php

class Model_Score extends ORM {

    public $_belongs_to = array(
		'person' => array( 'foreign_key' => 'person_id' ),
		'politician' => array( 'foreign_key' => 'politician_id' )
    );

	public static $min_score = 1;
	public static $max_score = 9;

	
	/**
	 * Define rules for the score
	 */
	public function rules()
	{
	    return array(
	        'person_id' => array(
	            // Uses Valid::not_empty($value);
	            array('not_empty')
	        ),
	        'politician_id' => array(
	            // Uses Valid::not_empty($value);
	            array('not_empty')
	        ),
	        'score' => array(
	            // Uses Valid::not_empty($value);
	            array('not_empty'),
				array('numeric'),
				array('range', array( self::$min_score, self::$max_score ) )
	        ),
	    );
	}

}

?>