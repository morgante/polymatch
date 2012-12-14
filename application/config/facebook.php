<?php

return array
(
    'id' => '507074295977621',
	'secret' => 'a72057a1e5e09ef69ac8ed0be1ff5c12',
	
	// what to store in the database for users
	'user' => array(
		'id' => 'val', // stores the value directly in the database
		'quiz' => 'special', //special self-created value
		'state' => 'special', //special self-created value
		'link' => false,
		'username' => false,
		'name' => false,
		'first_name' => false, // doesn't store value in database
		'last_name' => false,
		'hometown' => false, // stores a serialized version of the array in the database
		'location' => false,
		'work' => false,
		'inspirational_people' => false,
		'education' => false,
		'gender' => false,
		'religion' => false,
		'political' => false,
		'timezone' => false,		
		'locale' => false,		
		'languages' => false,		
		'verified' => false,		
		'updated_time' => false
	)
);

?>