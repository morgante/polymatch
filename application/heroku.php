<?php

function load_application_files( $dir )
{
	$contents = Kohana::list_files( $dir, array( APPPATH ) );
		
	foreach( $contents as $name => $file )
	{
		if( is_array( $file ) )
		{
			load_application_files( $name );
		}
		else
		{
			require_once( $file );
		}
	}
}

load_application_files( 'classes' );

// print_r( Kohana::$_paths );

?>