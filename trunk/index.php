<?php
/*
 |---------------------------------------------------------------
 | BRICKAL FRAMEWORK
 |---------------------------------------------------------------
 | More information:	http://www.brickal.org/
 */

/*
 |---------------------------------------------------------------
 | SYSTEM FOLDER NAME
 |---------------------------------------------------------------
 | This variable must contain the name of your "system" folder.
 | This directory does not need to be web-accessible.
 |
 | NO TRAILING SLASH!
 */
$system_folder = "system";

/*
 |---------------------------------------------------------------
 | APPLICATION FOLDER NAME
 |---------------------------------------------------------------
 | This variable must contain the name of your "application"
 | folder. This directory does not need to be web-accessible.
 |
 | NO TRAILING SLASH!
 */
$application_folder = "application";

/*
 |---------------------------------------------------------------
 | FILE EXTENSION
 |---------------------------------------------------------------
 | This variable must contain the extension of your PHP files.
 */
$extension = ".php";

/*
 |===============================================================
 | END OF USER CONFIGURABLE SETTINGS
 |===============================================================
 */

//Enable all error reporting during development
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

//Set the exact path to our installation folder
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
