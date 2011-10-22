<?php

class Core_Log {
	
	//Set the different types of logging used in Brickal
	const T_ERROR = 1;
	const T_WARNING = 2;
	const T_DEBUG = 3;
	const T_QUERY = 4;
	
	//Actual logbook
	public static $_log = array();
	
	public static function init()
	{
		//Add the first entry
		self::$_log[] = array('message' => 'Front controller loaded', 'type' => self::T_DEBUG, 'time' => 0);
	}
	
	public static function log($message, $type = self::T_DEBUG)
	{
		//Add the item to the logbook
		self::$_log[] = array('message' => $message, 'type' => $type, 'time' => microtime(TRUE) - BRICKAL_START_TIME);
	}
	
}
