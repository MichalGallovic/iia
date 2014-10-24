<?php
function __autoload($class_name) {
	$parts = explode('\\', $class_name);
	var_dump($parts);
	require_once end($parts) . '.php';
}



use \IIA\Auth as Auth;
use \IIA\Redirect as Redirect;

Auth::logIn();

Redirect::movePage(200,'/z3');