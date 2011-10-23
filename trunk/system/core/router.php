<?php

class Core_Router {

	public static function route($uri = NULL) {

		//Retrieve the uri from the SERVER superglobal
		if ($uri == NULL) {
			if (!isset($_SERVER['REQUEST_URI'])) {
				$uri = '';
			} else {
				$uri = $_SERVER['REQUEST_URI'];
			}
		}

		//Remove everything after the question mark, we don't use query strings
		if (strpos($uri, '?') !== FALSE) {
			$uri = substr($uri, 0, strpos($uri, '?'));
		}

		//Explode the uri
		$segments = explode('/', $uri);
		
		//Remove all empty segments and all index.php segments
		$segments = str_replace('index.php', '', $segments);
		$segments = array_values(array_filter($segments, function ($element) { return (isset($element) AND $element <> ''); }));
		
		//Take the default route if no uri is passed
		if ( ! isset($segments[0]))
		{
			//Set the default controller
			$segments[0] = 'home';
			$segments[1] = 'index';
		}

		//Take the default action if no action is set
		if ( ! isset($segments[1]))
		{
			$segments[1] = 'index';
		}
		
		//Extract controller and action		
		$controller = $segments[0];
		$action = $segments[1];
		
		//Extract parameters
		$params = $segments;
		array_shift($params);
		array_shift($params);
		
		$results = array(
			'controller' => $controller,
			'action' => $action,
			'params' => $params,		
		);

		//Add routing results to logbook
		Core_Log::log('Routing finished, calling Controller_' . ucfirst($controller) . '::action_' . $action);
		
		return $results;
	}

}
