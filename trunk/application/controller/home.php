<?php

class Controller_Home 
{
	public static function action_index()
	{
		Core_Output::set('content', 'blah, blah, blah');
		Core_Output::view('template/default');
	}
}