<?php

class Core_Output
{
	public static $_vars = array();

	public static function view($template_file)
	{
		$content = file_get_contents(Core_Filesystem::exactpath('view/' . $template_file));
		foreach(self::$_vars as $name => $value)
		{
			$content = str_replace('{' . $name . '}', $value, $content);
		}
		
		preg_match_all("/{(.*)}/", $content, $fragments, PREG_SET_ORDER);
		foreach($fragments as $fragment)
		{
			$content = str_replace($fragment[0], Core_Fragment::execute($fragment[1]), $content);
		}
		
		echo $content;
	}
	
	public static function set($name, $value)
	{
		self::$_vars[$name] = $value;
	}

}