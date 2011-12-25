<?php
function uc_element(&$item, $key)
		{
			$item = ucfirst($item);
		}
class Core_Fragment {
	
	public static function execute($name)
	{
		$fragment_path = explode('/', $name);
		$controller_path = $fragment_path;
		$action = array_pop($controller_path);
		
		if ($controller_path == null)
		{
			$controller_path = array('default');
		}
		
		$class_path = $controller_path;
		array_walk($class_path, 'uc_element');
		$class_name = 'Controller_Fragment_' . implode('_', $class_path);
		
		if (file_exists(Core_Filesystem::exactpath('controller/fragment/' . implode('/',$controller_path))))
		{
			return 'controller';
		}
		elseif (file_exists(Core_Filesystem::exactpath('view/fragment/' . implode('/',$fragment_path))))
		{
			return 'view';
		}
		else
		{
			return 'The requested content couldn\'t not be loaded =[';
		}
	}

}