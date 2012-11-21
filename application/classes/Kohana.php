<?php defined('SYSPATH') OR die('No direct script access.');

class Kohana extends Kohana_Core {
	
	public static $host = 'LOCAL';
	
	public static function auto_load($class, $directory = 'classes')
	{
		print_r( '<br>' . $class );
		
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
		
		print_r( '<br>l' . $directory . '---' . $file );
		
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
		
}