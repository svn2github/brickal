<?php

class Core {

	public static function execute() {
		spl_autoload_register('Core::load_class');

		Core_Router::get();

		echo('exectest');
	}

	public static function load_class($class_name) {
		self::load_file(implode('/', explode('_', strtolower($class_name))));
	}

	public static function load_file($file_name) {
		//Define the system folders of Brickal
		//These shouldn't exist in the application folder
		$system_folders = array('core', 'admin', 'base');

		//Convert the uri to an array by exploding it
		$short = explode('/', $file_name);

		//Modules can be in two folders, since the system folder should be read-only
		if ($short[0] == 'module') {
			//Check if the file is in the application folder (overloading)
			//Otherwise we take the one in the system folder
			if (file_exists(APPPATH . '/' . implode('/', $short) . EXT)) {
				$path = APPPATH . '/';
			} else {
				$path = SYSPATH . '/';
			}
		} else {
			//Check if the first segment is in the list of system folders as defined above
			if (in_array($short[0], $system_folders)) {
				$path = SYSPATH . '/';
			} else {
				$path = APPPATH . '/';
			}
		}

		//Make the path complete by adding an extension_loaded
		$path .= implode('/', $short) . EXT;

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

}
