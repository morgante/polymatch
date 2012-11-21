<?php defined('SYSPATH') OR die('No direct script access.');

class Kohana extends Kohana_Core {
	
	public static $host = 'LOCAL';
	
	public static function auto_load($class, $directory = 'classes')
	{		
		// Transform the class name according to PSR-0
		$class     = ltrim($class, '\\');
		$file      = '';
		$namespace = '';

		if ($last_namespace_position = strripos($class, '\\'))
		{
			$namespace = substr($class, 0, $last_namespace_position);
			$class     = substr($class, $last_namespace_position + 1);
			$file      = str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR;
		}

		$file .= str_replace('_', DIRECTORY_SEPARATOR, $class);
				
		if ($path = Kohana::find_file($directory, $file))
		{
			// Load the class file
			require $path;

			// Class has been found
			return TRUE;
		}

		// Class is not in the filesystem
		return FALSE;
	}
	
	public static function find_file($dir, $file, $ext = NULL, $array = FALSE)
	{
		// normal function works fine
		if( $path = parent::find_file( $dir, $file, $ext, $array ) )
		{
			return $path;
		}
		
		// now try our silly kludge
		
		if( is_array( $array ) )
		{
			$files = Kohana::list_files( $dir, $array );
		}
		else
		{
			$files = Kohana::list_files( $dir, parent::include_paths() );
		}
		
		// print_r( parent::include_paths() );
		// print_r( $files );
		// print_r( $dir );
		
		$file_lower = strtolower($file);
				
		$file = self::check_dir_for( $files, $dir . '/' . $file_lower );
				
		return parent::find_file( $dir, $file, $ext, $array );
	}
	
	private static function check_dir_for( $haystack, $needle )
	{
		foreach( $haystack as $name => $file )
		{
			if( is_array( $file ) )
			{
				if( self::check_dir_for( $file, $needle ) )
				{
					return $file;
				}
			}
			else
			{
				// if( strtolower( $name ) == strtolower( ))
				// print_r( strtolower( $name ) . strtolower( $needle ) . 'P.php<br>' );
				if( strtolower( $name ) == strtolower( $needle ) . '.php' )
				{
					return $file;
				}
			}
		}
		
		// not found
		return false;
						
		// foreach($files as $file) {
		// 	if (strtolower($file) == $lcaseFilename) {
		// 		return true;
		// 	}
		// }
	}
		
}