<?php
	
	// DB Connection Configuration
	define('DB_HOST', 'localhost'); 
	define('DB_USERNAME', 'root'); 
	define('DB_PASSWORD', ''); 
	define('DATABASE', 'calendar'); 
	define('TABLE', 'calendar');
	define('USERS_TABLE', 'users');
	
	// Path to the files for upload
	define('SITE_FILES_URL', 'http://localhost/calendar-2.2.16/files/');

	// Default Categories
	$categories = array("General", "Party", "Work", "Letters & Arts");
	
	/*
	true - will make all events on the database public and visible to anyone.
	false - will make events private and visible to the respective owner only.
	*/
	define('PUBLIC_PRIVATE_EVENTS', false);
	
	// Feature to import events
	define('IMPORT_EVENTS', true);
	
?>
