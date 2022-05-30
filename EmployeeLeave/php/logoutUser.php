<?php
	session_start();
	// $_SESSION['user'] = null;
	// $_SESSION['login'] = false;
	// $_SESSION['userType'] = null;
	unset($_SESSION['user']);
	unset($_SESSION['login']);
	unset($_SESSION['userType']);
	session_destroy();
	session_write_close();
	// setcookie(session_name(),'',0,'/');
	// session_regenerate_id(true);
	// session_destroy();
	header('LOCATION: ../index.html');
	exit;
?>