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
?>

<!DOCTYPE html>

<html>
	<head>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<meta name="google-signin-client_id" content="140800144162-d33le531e64ocnb72b4copoq1ltt73ma.apps.googleusercontent.com">
		<link rel="stylesheet" type="text/css" href="../website.css">
		<link href="https://fonts.iu.edu/style.css?family=BentonSans:regular,bold
		|BentonSansCond:regular|GeorgiaPro:regular" media="screen" rel="stylesheet" type="text/css"/>
		<title>Hoosier Helper</title>
	</head>

	<body>
		<div class="logo">
			<img src="../iu_tab_web.png"/>
		</div>
		
		<div class="header">
			<h3>Hoosier Helper</h3>
		</div>
		
		<div class="topnav">
			<a href="../website.php">Home</a>
			<a href="sports/basketball.php">Sports</a>
			<a href="#food">Food</a>
			<a href="../deals-feature/deals-feature.php">Specials</a>
			<a href="../study-feature/study.php">Study Groups</a>
			<div class="dropmenu">
				<button class="dropbtn">Bus Routes</button>
				<div class="content">
					<a href="../busRoutes/Aroute.php">A Route</a>
					<a href="../busRoutes/Broute.php">B Route</a>
					<a href="../busRoutes/Croute.php">C Route</a>
					<a href="../busRoutes/Eroute.php">E Route</a>
					<a href="../busRoutes/Froute.php">F Route</a>
					<a href="../busRoutes/Wroute.php">W Route</a>
					<a href="../busRoutes/Xroute.php">X Route</a>
				</div>
			</div>
			<a href="../locations-feature/Scenic-Locations.php">Locations</a>
			<a href="../maps-feature/maps.php">Map</a>
			<a href="../profile-feature/profile.php">Profile</a>
			<a href="../discussion/discussion.php"> Discussions</a>
			<a href="../logout.php">Logout</a>
			<a href="../calender-feature/calender.php">Logout</a>
		</div>
		<div style="width: 15%; float: left;">
			<h1> <h1>
		</div>
		<div style="width: 70%; text-align: center; float: left; background-color: white;">
			<h2>Explore Bloomington</h2>
			<div style="font-size: 20px;">
				<p>Use the map below to explore the Indiana University campus and Bloomington area</p>
			</div>
			<p style="text-align: center"><iframe src="https://calendar.google.com/calendar/embed?src=c_9rn9emuu60gpscefkrtqlm2nk4%40group.calendar.google.com&ctz=America%2FNew_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe></p>
		</div>
		<div style="width: 15%; float: left;">
			<h1> <h1>
		</div>
	</body>
</html>