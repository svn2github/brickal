<?php
/*
 |---------------------------------------------------------------
 | BRICKAL FRAMEWORK
 |---------------------------------------------------------------
 | More information:	http://www.brickal.org/
 */

//Set file conventions
$system_folder = "system";
$application_folder = "application";
$extension = ".php";

//Enable all error reporting because we handle that ourselves
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

//Set profiling start values
define('BRICKAL_START_TIME', microtime(TRUE));
define('BRICKAL_START_MEMORY', memory_get_usage(TRUE));

//Set the exact path to our installation folders
if (strpos($system_folder, '/') === FALSE) {
	$system_folder = realpath(dirname(__FILE__) . '/' . $system_folder);
}
if (strpos($application_folder, '/') === FALSE) {
	$application_folder = realpath(dirname(__FILE__) . '/' . $application_folder);
}

//Define some constants
define('SYSPATH', $system_folder);
define('APPPATH', $application_folder);
define('EXT', $extension);

//Include our core
require (SYSPATH . '/core' . EXT);

//Start the magic...
Core::execute();