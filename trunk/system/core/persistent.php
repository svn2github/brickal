<?php
class Core_Persistent
{
	//This variable contains the actual data as set in the data file
	public $_data = array();
	
	//This variable contains the data scheme
	public $_data_scheme = array();
	
	//The path to the currently loaded data
	public $_data_location;
	
	//The path to the currently loaded data scheme
	public $_data_scheme_location;

	//Load a specific data file
	public function load($name, $scheme = NULL)
	{
		//Define the file that needs to be loaded
		//Note that this is a short uri (example module/db/config)
		$this->_data_location = $name;
		
		//Check if the file does exist
		if (file_exists($this->core->load_file($name, TRUE)))
		{
			//Load the file using the core function
			$this->_data = $this->core->load_file($this->_data_location);
			
			//Overload with the defaults
			if (isset($scheme))
				{
				//Define the file that needs to be loaded to use as a scheme of the data
				$this->_data_scheme_location = $scheme;
				
				//Load the data scheme file using the core function
				$this->_data_scheme = $this->core->load_file($this->_data_scheme_location);
				
				//Loop through the scheme to override the options whose aren't set
				foreach($this->_data_scheme as $name => $details)
				{
					if ( ! isset($this->_data[$name]) AND isset($details['default']))
					{
						$this->_data[$name] = $details['default'];
					}
				}
			}
		}
	}
	
	//Save changes to the data file
	//This is used in combination with the administration panel
	public function save()
	{
		//Make an array with the overrided properties that should be saved
		$content = array();
		
		//Check if a value is the default value
		foreach($this->_data as $name => $value)
		{
			if (isset($this->_data_scheme[$name]['default']))
			{
				//If the value is the same as the default value, we can omit it
				if ($this->_data_scheme[$name]['default'] != $value)
				{
					$content[$name] = $value;
				}
			}
			else
			{
				//If the value is not in the data scheme, we can't omit it
				$content[$name] = $value;
			}
		}
		
		//Define the content of the data file
		//var_export does the hard work
		$filedata = '<?php' . "\n" . '$data = ' . var_export($content, TRUE) . ';';
		
		//Write the data to the file if the file is writable
		if (is_writable($this->core->load_file($this->_data_location, TRUE)) or ! file_exists($this->core->load_file($this->_data_location, TRUE)))
		{
			file_put_contents($this->core->load_file($this->_data_location, TRUE), $filedata);
		}
		else
		{
			//Otherwise simply return FALSE
			return FALSE;
		}
	}

	//Get an data option
	public function get($name)
	{
		//Check if the datauration option does exist
		if (isset($this->_data[$name]))
		{
			return $this->_data[$name];
		}
		else
		{
			return NULL;
		}
	}
	
	//Set a data option (regardless of if it is set or isn't)
	public function set($name, $value)
	{
		$this->_data[$name] = $value;
	}
	
	//Remove an option from the file
	public function remove($name)
	{
		unset($this->_data[$name]);
	}
}