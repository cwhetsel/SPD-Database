<?php
	//set the session data save location and timezone
	#ini_set('session.save_path',realpath(dirname(name of location));
	error_reporting(E_ALL); ini_set('display_errors', 'On');
	/*if ($_SERVER['HTTPS'] !== 'on') {
		$redirectURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header("Location: $redirectURL");
		exit;
	}*/
    if(!isset($_SESSION)) {
		if(!session_start()) {
			header("Location: error.php");
			exit;
		}
	}
	
	date_default_timezone_set('America/Chicago');
	define('USER', 'redacted');
	define('DB', 'redacted');
	define('HOST', 'redacted');
	define('PASS', 'redacted');
	
	//This file can be included in other pages and the check login function can be callled to redirect not logged in users. 
	function checkLogin() {

		//get the id
		$id = empty($_SESSION['memID']) ? false : $_SESSION['memID'];
		if(!$id) {
			//redirect to login if id is not set meaning the user is not logged in. 
			header("Location: loginLogic.php"); 
		}
	}
	//check if the user has admin access
	function checkAdminAccess() {
		$access = empty($_SESSION['access_level']) ? false : $_SESSION['access_level'];
		if(strcmp($access, "Admin") !== 0 ) {
			//redirect to login if id is not set meaning the user is not logged in. 
			header("Location: loginLogic.php"); 
		}
	}
	//check if user is admin or exec
	function checkExecAccess() {
		$access = empty($_SESSION['access_level']) ? false : $_SESSION['access_level'];
		if(strcmp($access, "Admin") !== 0 && strcmp($access, "Exec") !== 0) {
			//redirect to login if id is not set meaning the user is not logged in. 
			header("Location: loginLogic.php"); 
		}
	}
?>