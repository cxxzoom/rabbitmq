<?php
require_once "vendor/autoload.php";


function halt(...$var)
{
	var_dump(...$var);
	die();
}


function config() : array
{
	return [
		'host' => '192.168.1.180',
		'port' => '5672',
		'user' => 'test',
		'password'  => 'test',
		'vhost'   => 'ucdo',
	];
}