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

//Include Configuration File
include('config.php');
$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
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

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img  style=float:"right"; src="sign-in-with-google.png"  height = 70px; width = 260px;/></a>';
}
?>

			<?php
			session_start();
			$email = $_SESSION['user_email_address'];
			$fname = $_SESSION['user_first_name'];
			$lname = $_SESSION['user_last_name'];
				if($login_button == '')
					{
						$_SESSION['logged_in'] = true;
						$emailCheck = "SELECT uID from user where email = '$email'";
						$result = mysqli_query($conn, $emailCheck);
						$emailCount = mysqli_num_rows($result);
						
						//echo strval($emailCount);
						
						if($emailCount < 1){
							$addSql = "INSERT INTO user (fname, lname, email) VALUES ('$fname', '$lname', '$email')";
							
							$result2 = mysqli_query($conn, $addSql);
						}
						echo '<h5 align = "right";><a href="logout.php">Logout</h3>';
					}
					else
						{
						echo '<div align="right">'.$login_button . '</div>';
						}
			?>
		</div>


<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link media="all" rel="stylesheet" href="../rivet.css">
    <title>Rivet starter file</title>
	
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
		  <a href="../website.php" aria-current="page">Home</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../sports/basketball.php">Sports</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../food-feature/food.php">Food</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../deals-feature/deals-feature.php">Specials</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="experience/experience.php">Gallery</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../study-feature/study.php">Study Groups</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../locations-feature/Scenic-Locations.php">Locations</a>
		</li>
		<li class="rvt-menu__item">
		  <a href="../maps-feature/maps.php">Maps</a>
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
    		<h1 class="rvt-ts-md">Explore Bloomington</h1>
  		</div>
  		<div class="rvt-box__body">
    		<p class="rvt-m-all-remove" style="text-align: center"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d98980.96690409284!2d-86.60188606590526!3d39.17119198678359!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886c5df6b483d8e7%3A0xe91a912d8bad33d9!2sBloomington%2C%20IN!5e0!3m2!1sen!2sus!4v1612988423677!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></p>
  		</div>
  		<div class="rvt-box__footer rvt-text-right">
    		
  		</div>
	</div>
	
	
		<p style="text-align: center"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d98980.96690409284!2d-86.60188606590526!3d39.17119198678359!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886c5df6b483d8e7%3A0xe91a912d8bad33d9!2sBloomington%2C%20IN!5e0!3m2!1sen!2sus!4v1612988423677!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></p>
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
