<?php
$servername = "db.luddy.indiana.edu";
$username = "i494f20_team49";
$password = "my+sql=i494f20_team49";
$database = "i494f20_team49";
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

include('config.php');
session_start();
if(empty($_SESSION['logged_in']))
{
    header("Location: https://accounts.google.com/o/oauth2/auth/oauthchooseaccount?response_type=code&access_type=online&client_id=140800144162-d33le531e64ocnb72b4copoq1ltt73ma.apps.googleusercontent.com&redirect_uri=https%3A%2F%2Fcgi.luddy.indiana.edu%2F~team49%2Fteam-49%2Fwebsite.php&state&scope=email%20profile&approval_prompt=auto&flowName=GeneralOAuthFlow");
    exit;
}

if(isset($_GET["code"]))
{
    //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if(!isset($token['error']))
    {
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);

        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];

        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);

        //Get user profile data from google
        $data = $google_service->userinfo->get();

        //Below you can find Get profile data and store into $_SESSION variable
        if(!empty($data['given_name']))
        {
            $_SESSION['user_first_name'] = $data['given_name'];
        }
        if(!empty($data['email']))
        {
            $_SESSION['user_email_address'] = $data['email'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link media="all" rel="stylesheet" href="../rivet.css">
    <script src="../rivet.js"></script>
    <title>Bus Routes</title>
    
    <script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<meta name="google-signin-client_id" content="140800144162-d33le531e64ocnb72b4copoq1ltt73ma.apps.googleusercontent.com">
    
</head>
<body>
    <header class="rvt-header" role="banner">
        <a class="rvt-skip-link" href="#main-content">Skip to content</a>
        <div class="rvt-header__trident">
            <svg role="img" xmlns="http://www.w3.org/2000/svg" width="60" height="70" viewBox="0 0 60 70" aria-labelledby="iu-logo">
                <title id="iu-logo">Indiana University</title>
                <rect width="60" height="70" fill="#900" />
                <polygon points="35.96 18.44 35.96 21.84 38.52 21.84 38.52 40.51 33.41 40.51 33.41 15.9 35.96 15.9 35.96 12.5 24.04 12.5 24.04 15.9 26.58 15.9 26.58 40.51 21.48 40.51 21.48 21.84 24.04 21.84 24.04 18.44 12.09 18.44 12.09 21.84 14.65 21.84 14.65 43.79 18.72 48.15 26.58 48.15 26.58 53.26 24.04 53.26 24.04 57.5 35.96 57.5 35.96 53.26 33.41 53.26 33.41 48.15 40.93 48.15 45.33 43.79 45.33 21.84 47.91 21.84 47.91 18.44 35.96 18.44" fill="#fff" />
            </svg>
        </div>
        <span class="rvt-header__title">
            <a href="#0">Hoosier Helper</a>
        </span>
    </header>
    <main role="main" id="main-content">

        <nav class="rvt-menu" aria-label="Section navigation">
	  <ul class="rvt-menu__list">
		<li class="rvt-menu__item">
		  <a href="../website.php">Home</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../busRoutes/busRoutes.php" aria-current="page">Bus Routes</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../calendar/Final/Sports/index.php">Sports</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../food-feature/food.php">Food</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../deals-feature/deals-feature.php">Specials</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../experience/experience.php">Gallery</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../study-feature/study.php">Study Groups</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../locations-feature/Scenic-Locations.php">Locations</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../calendar-feature/calendar.php">Calendar</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../discussion/discussion.php">Discussion</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../profile-feature/profile.php">Profile</a>
		</li>
	  </ul>
	</nav>

<div class="rvt-box">
  <div class="rvt-box__header">
	<div class="rvt-dropdown">
		<button
			type="button"
			class="rvt-button"
			data-dropdown-toggle="dropdown-navigation"
			aria-haspopup="true"
			aria-expanded="false">
			<span>Select a Route</span>
			<svg aria-hidden="true" class="rvt-m-left-xs" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
				<path fill="currentColor" d="M8,12.46a2,2,0,0,1-1.52-.7L1.24,5.65a1,1,0,1,1,1.52-1.3L8,10.46l5.24-6.11a1,1,0,0,1,1.52,1.3L9.52,11.76A2,2,0,0,1,8,12.46Z"/>
			</svg>
		</button>
		<div
			class="rvt-dropdown__menu"
			id="dropdown-navigation"
			aria-hidden="true"
			role="menu">
			<a href="../busRoutes/Aroute.php">A Route</a>
			<a href="../busRoutes/Broute.php">B Route</a>
			<a href="../busRoutes/Croute.php">C Route</a>
			<a href="../busRoutes/Eroute.php">E Route</a>
			<a href="../busRoutes/Froute.php">F Route</a>
			<a href="../busRoutes/Wroute.php">W Route</a>
			<a href="../busRoutes/Xroute.php">X Route</a>
		</div>
	</div>
  </div>
  <div class="rvt-box__body">
    <p class="rvt-m-all-remove">
    	<h1 class="rvt-ts-sm"><b>F Route - Indiana University</b></h1>
    </p>
    
    <p style="text-align: center;"><iframe src="https://www.google.com/maps/embed?pb=!1m76!1m12!1m3!1d12372.594166885165!2d-86.53005601234997!3d39.
				17134372246742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m61!3e0!4m5!1s0x886c66b62bfe2435%3A0x2660b2355b590e77!2s
				Briscoe%20Quadrangle!3m2!1d39.1784385!2d-86.5199643!4m5!1s0x886c66b896f918fb%3A0xb654d86f31584557!2sNorth%20Fee%
				20Lane%20%26%20East%2010th%20Street!3m2!1d39.171603999999995!2d-86.5190506!4m5!1s0x886c66b9693cc341%3A0xb0c5c374
				75198705!2sNorth%20Jordan%20Avenue%20%26%20East%2010th%20Street!3m2!1d39.171589499999996!2d-86.51565459999999!4m
				5!1s0x886c66958e099e19%3A0x6fa51c9f08c6e2d3!2sSouth%20Jordan%20Avenue%20%26%20East%203rd%20Street!3m2!1d39.16426
				24!2d-86.51640499999999!4m5!1s0x886c66e9cf12d887%3A0xf8081a472ecfc431!2sEast%203rd%20Street%20%26%20South%20Indi
				ana%20Avenue!3m2!1d39.164302899999996!2d-86.5269021!4m5!1s0x886c66c3a5754f03%3A0x3aaf701cf8f4a2c1!2sNorth%20Indi
				ana%20Avenue%20%26%20East%207th%20Street!3m2!1d39.1685054!2d-86.52694699999999!4m5!1s0x886c66c112552ad9%3A0x5daf
				d7f6b1d1bfd8!2sNorth%20Woodlawn%20Avenue%20%26%20East%207th%20Street!3m2!1d39.168487299999995!2d-86.523486499999
				99!4m5!1s0x886c66c6ea8a4231%3A0x5f95538a54274e36!2sNorth%20Woodlawn%20Avenue%20%26%20East%2010th%20Street!3m2!1d
				39.1716347!2d-86.5235008!4m5!1s0x886c66b896f918fb%3A0xb654d86f31584557!2sNorth%20Fee%20Lane%20%26%20East%2010th%
				20Street!3m2!1d39.171603999999995!2d-86.5190506!4m5!1s0x886c66b62bfe2435%3A0x2660b2355b590e77!2sBriscoe%20Quadra
				ngle%2C%20North%20Walnut%20Grove%20Street%2C%20Bloomington%2C%20IN!3m2!1d39.1784385!2d-86.5199643!5e0!3m2!1sen!2
				sus!4v1613695984083!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""
				aria-hidden="false" tabindex="0"></iframe></p>
    
  </div>
  <div class="rvt-box__footer rvt-text-right">
    
  </div>
</div>


    </main>
    <footer class="rvt-footer m-top-xxl" role="contentinfo">
        <div class="rvt-footer__copyright-lockup">
            <div class=rvt-footer__trident>
                <svg role="img" xmlns="http://www.w3.org/2000/svg" width="20" height="25" viewBox="0 0 20 25">
                    <polygon points="13.33 3.32 13.33 5.21 14.76 5.21 14.76 15.64 11.9 15.64 11.9 1.9 13.33 1.9 13.33 0 6.67 0 6.67 1.9 8.09 1.9 8.09 15.64 5.24 15.64 5.24 5.21 6.67 5.21 6.67 3.32 0 3.32 0 5.21 1.43 5.21 1.43 17.47 3.7 19.91 8.09 19.91 8.09 22.76 6.67 22.76 6.67 25.13 13.33 25.13 13.33 22.76 11.9 22.76 11.9 19.91 16.1 19.91 18.56 17.47 18.56 5.21 20 5.21 20 3.32 13.33 3.32" fill="#900"/>
                </svg>
            </div>
            <p><a href="https://www.iu.edu/copyright/index.html">Copyright</a> &copy; 2017 The Trustees of <a href="https://www.iu.edu/">Indiana University</a></p>
        </div>
        <ul class="rvt-footer__aux-links">
            <li class="rvt-footer__aux-item">
                <!-- You can learn more about privacy policies and generate one
                     for your site here:
                     https://protect.iu.edu/online-safety/tools/privacy-notice/index.html -->
                <a href="#0">Privacy Policy</a>
            </li>
            <li class="rvt-footer__aux-item">
                <a href="https://accessibility.iu.edu/">Accessibility help</a>
            </li>
        </ul>
    </footer>
    <script src="./js/rivet.min.js"></script>
</body>
</html>