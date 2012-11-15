<?php

class Model_Score extends ORM {

    protected $_belongs_to = array(
		'person' => array( 'foreign_key' => 'person_id' ),
		'politician' => array( 'foreign_key' => 'politician_id' )
    );

}

?>