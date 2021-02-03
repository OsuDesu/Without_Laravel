<?php

	// Отображение ошибок
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	// Каталоги
	define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/without_laravel/');
	define('ASSETS', dirname('index.php').'/');
	define('CONF', ROOT.'config/');
	define('PAGE', ROOT.'pages/');
	define('LIB', ROOT.'library/');
	define('VIEW', ASSETS.'view/');

	// Настройки
	include(CONF.'settings.php'); 

	$db = new mysqli($config['database']['host'], $config['database']['user'], $config['database']['passwd'], $config['database']['db']);

	// Библиотеки
	include(LIB.'tools.php');

	if ($db->connect_error)
		die($db->connect_error);

	$tools = new tools($db);
	$src = PAGE.$tools->url().'.php';

	if(file_exists($src)) 
		include($src);
	else {
		http_response_code(404);
		include(PAGE.'404.php');
		die();
	}
?>