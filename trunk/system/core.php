<?php

class Core {
	
	//Configuration object	
	public static $config;

	public static function execute() {
		
		//Assign autoloader to filesystem class
		require(SYSPATH . '/core/filesystem' . EXT);
		spl_autoload_register('Core_Filesystem::load_class');

		//Load global configuration
		self::$config = new Core_Persistent();
		self::$config->load('config');
		
		//Initialize log library
		Core_Log::init();
		Core_Log::log('Core classes initialized');
		
		//Start routing
		$route = Core_Router::route();
		call_user_func_array(array('Controller_' . ucfirst($route['controller']), 'action_' . $route['action']), $route['params']);

		Core_Log::log('Core finished!');
		//var_dump(Core_Log::$_log);
		
		//Deinitialize objects and variables
		self::$config->save();
	}

}
