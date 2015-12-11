<?php
	
	// Process user sessions
	require_once("userSession.php");
	$sess = new userSession;
	
	require_once("functions/sessionData.php");
	
	// Start Session
	session_start();
	
	error_reporting(E_ALL); // Change to none on the real server
	
	define('BASE_DOMAIN', 'localhost');
	define('BASE_URI', 'http://localhost/offstreams/');
	define('ROOT', '/offstreams/');
	define('BASEPATH', $_SERVER['DOCUMENT_ROOT'] . ROOT);
	define('SALT', 'nfg87yerityleriasfderubvw8uwe8erq3o9r8fhDFshdkbjHJKadsffguhalsg');
	
	// Require functions and database
	require_once(BASEPATH . "includes/config/functions/functions.php");
	require_once(BASEPATH . "includes/config/db/database.php");
	
	
	# CALL ANY GENERAL FUNCTION CLASSES HERE
	$navigation = new Navigation;
	$clean = new cleanInput;
	$url = new urlInfo;
	$zepp = new zeppTranslate;
	$camel = new camelCaseSplit;
	$image = new imageCentering;
	
	# HTML PURIFIER INSTANCE
	$purifyConfig = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($purifyConfig);
	
	
?>