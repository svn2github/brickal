<?php

class Core_Filesystem {
	
	//Converts and loads a file
	public static function load_file($file_name)
	{
		$path = Core_Filesystem::exactpath($file_name);
	
		//Check if the file exists before actually loading it
		if (file_exists($path)) {
			//Reset the data variable
			unset($data);
	
			//Include the file
			//Note that it is included and not required, we have our one file_exists function
			include ($path);
		} else {
			//Generate an warning, if the log component is loaded, otherwise do nothing (what can we do?)
		}
	}
	
	//Load a like (for example: Controller_Home > APPPATH/controller/home.php )
	public static function load_class($class_name) {
		self::load_file(implode('/', explode('_', strtolower($class_name))));
	}
	
	//Converts an filename like controller/home to APPPATH/controller/home.php
	public static function exactpath($file_name) {
		//Define the system folders of Brickal
		//These shouldn't exist in the application folder
		$system_folders = array('core', 'admin', 'base');
	
		//Convert the uri to an array by exploding it
		$uri = explode('/', $file_name);
	
		//Modules can be in two folders, since the system folder should be read-only
		if ($uri[0] == 'module') {
			//Check if the file is in the application folder (overloading)
			//Otherwise we take the one in the system folder
			if (file_exists(APPPATH . '/' . implode('/', $short) . EXT)) {
				$path = APPPATH . '/';
			} else {
				$path = SYSPATH . '/';
			}
		} else {
			//Check if the first segment is in the list of system folders as defined above
			if (in_array($uri[0], $system_folders)) {
				$path = SYSPATH . '/';
			} else {
				$path = APPPATH . '/';
			}
		}
	
		//Make the path complete by adding an extension_loaded
		$path .= implode('/', $uri) . EXT;
	
		return $path;
	}
	
}