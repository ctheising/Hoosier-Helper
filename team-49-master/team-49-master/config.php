<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'googleApi/vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('140800144162-d33le531e64ocnb72b4copoq1ltt73ma.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('_gwtExgA-wuhTJb5g0gjr3ab');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://cgi.luddy.indiana.edu/~team49/team-49/website.php');

$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>