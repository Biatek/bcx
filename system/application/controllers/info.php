<?php

class Info extends Controller {

	function Info()
	{
		parent::Controller();
	}
	
	function index()
	{
		phpinfo();
	}
}