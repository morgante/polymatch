<?php defined('SYSPATH') OR die('No direct script access.');

class Utils
{

	private static $debug_defined = false;

	/**
	* Outputs an HTML string of information about a single variable.
	* Passes on the string to Debug class
	* Emulates the Habari structure
	*
	* @param   mixed   $value              variable to dump
	* @param   integer $length             maximum length of strings
	* @param   integer $level_recursion    recursion limit
	* @return  string
	*/
	public static function debug()
	{
		throw new Exception('test');
		
		if (func_num_args() === 0)
			return;

		// Get all passed variables
		$variables = func_get_args();

		$output = "<div class=\"utils__debugger\">";
		if ( !self::$debug_defined ) {
			$output .= "<script type=\"text/javascript\">
				debuggebi = function(id) {return document.getElementById(id);}
				debugtoggle = function(id) {debuggebi(id).style.display = debuggebi(id).style.display=='none'?'inline':'none';}
				</script>
				<style type=\"text/css\">
				.utils__debugger{background-color:#550000;border:1px solid red;text-align:left;}
				.utils__debugger pre{margin:5px;background-color:#000;overflow-x:scroll}
				.utils__debugger pre em{color:#dddddd;}
				.utils__debugger table{background-color:#770000;color:white;width:100%;}
				.utils__debugger tr{background-color:#000000;}
				.utils__debugger td{padding-left: 10px;vertical-align:top;white-space: pre;font-family:Courier New,Courier,monospace;}
				.utils__debugger .utils__odd{background:#880000;}
				.utils__debugger .utils__arg a{color:#ff3333;}
				.utils__debugger .utils__arg span{display:none;}
				.utils__debugger .utils__arg span span{display:inline;}
				.utils__debugger .utils__arg span .utils__block{display:block;background:#990000;margin:0px 2em;border-radius:10px;-moz-border-radius:10px;-webkit-border-radius:9px;padding:5px;}
				</style>
			";
			self::$debug_defined = true;
		}

		foreach ($variables as $var)
		{
			$output.= '<pre style="color:white;">' . Debug::dump($var, 1024) . '</pre>';
		}

		$output .= '</div>';
		
		echo $output;
	}
	
}