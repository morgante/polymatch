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
		if( $file == 'Database/Mysql' )
		{
			print_r( $file . '<br>');
		}
		
		if ($ext === NULL)
		{
			// Use the default extension
			$ext = EXT;
		}
		elseif ($ext)
		{
			// Prefix the extension with a period
			$ext = ".{$ext}";
		}
		else
		{
			// Use no extension
			$ext = '';
		}

		// Create a partial path of the filename
		$path = $dir.DIRECTORY_SEPARATOR.$file.$ext;

		if (Kohana::$caching === TRUE AND isset(Kohana::$_files[$path.($array ? '_array' : '_path')]))
		{
			// This path has been cached
			return Kohana::$_files[$path.($array ? '_array' : '_path')];
		}

		if (Kohana::$profiling === TRUE AND class_exists('Profiler', FALSE))
		{
			// Start a new benchmark
			$benchmark = Profiler::start('Kohana', __FUNCTION__);
		}

		if ($array OR $dir === 'config' OR $dir === 'i18n' OR $dir === 'messages')
		{
			// Include paths must be searched in reverse
			$paths = array_reverse(Kohana::$_paths);

			// Array of files that have been found
			$found = array();

			foreach ($paths as $dir)
			{
				if (is_file($dir.$path))
				{
					// This path has a file, add it to the list
					$found[] = $dir.$path;
				}
			}
		}
		else
		{
			// The file has not been found yet
			$found = FALSE;

			foreach (Kohana::$_paths as $dir)
			{
				if (is_file($dir.$path))
				{
					// A path has been found
					$found = $dir.$path;

					// Stop searching
					break;
				}
			}
		}

		if (Kohana::$caching === TRUE)
		{
			// Add the path to the cache
			Kohana::$_files[$path.($array ? '_array' : '_path')] = $found;

			// Files have been changed
			Kohana::$_files_changed = TRUE;
		}

		if (isset($benchmark))
		{
			// Stop the benchmark
			Profiler::stop($benchmark);
		}

		return $found;
	}
		
}