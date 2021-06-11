<?php

//logout.php

include('config.php');

//Reset OAuth access token
$google_client->revokeToken();

//Destroy entire session data.
session_destroy();

//redirect page to index.php
header('location:https://cgi.luddy.indiana.edu/~team49/team-49/website.php');

?>