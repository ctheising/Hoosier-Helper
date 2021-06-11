<?php
	
	// DB Connection Configuration
	define('DB_HOST', 'db.luddy.indiana.edu'); 
	define('DB_USERNAME', 'i494f20_team49'); 
	define('DB_PASSWORD', 'my+sql=i494f20_team49'); 
	define('DATABASE', 'i494f20_team49'); 
	define('TABLE', 'calendar');
	define('USERS_TABLE', 'users');
	
	// Path to the files for upload
	define('SITE_FILES_URL', 'https://cgi.sice.indiana.edu/~ctheisin/sports');

	// Default Categories
	$categories = array("Basketball", "Tennis", "Baseball", "Soccer", "Volleyball");
	
	/*
	true - will make all events on the database public and visible to anyone.
	false - will make events private and visible to the respective owner only.
	*/
	define('PUBLIC_PRIVATE_EVENTS', true);
	
	// Feature to import events
	define('IMPORT_EVENTS', true);
	
?>
