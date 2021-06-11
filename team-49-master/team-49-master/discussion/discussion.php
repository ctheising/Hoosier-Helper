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

function createCommentRow($data) {
    global $conn;
    //$start= $conn->real_escape_string($_POST['start']);

    $response = '
            <div class="comment">
                <div class="user">'.$data['fname'].' <span class="time">'.$data['createdOn'].'</span></div>
                <div class="userComment">'.$data['contents'].'</div>
                <div class="reply"><a href="javascript:void(0)" data-commentID="'.$data['discussionID'].'" onclick="reply(this)">REPLY</a></div>
                <div class="replies">';

    $sql = $conn->query("SELECT reply.replyID, fname, contents, DATE_FORMAT(reply.date, '%Y-%m-%d') AS createdOn FROM reply INNER JOIN user ON reply.uID = user.uID WHERE reply.discussionID = '".$data['discussionID']."' ORDER BY reply.replyID DESC LIMIT 1");
    while($dataR = $sql->fetch_assoc())
        $response .= createCommentRow($dataR);

    $response .= '
                    </div>
            </div>
        ';

    return $response;
	header("Refresh:0");
	
}

if (isset($_POST['getAllComments'])){
    $start= $conn->real_escape_string($_POST['start']);

    $response = "";
    $sql = $conn->query("SELECT discussions.discussionID, fname, contents, DATE_FORMAT(discussions.date, '%Y-%m-%d') AS createdOn FROM discussions INNER JOIN user ON discussions.userID = user.uID ORDER BY discussions.discussionID DESC LIMIT $start, 20");
    while($data = $sql->fetch_assoc())
        $response .= createCommentRow($data);

    exit($response);
}



if (isset($_POST['addComment'])){
    $comment = $conn->real_escape_string($_POST['comment']);
    $isReply = $conn->real_escape_string($_POST['isReply']);
    $commentID = $conn->real_escape_string($_POST['commentID']);

    if($isReply != 'false') {
        $conn->query("INSERT INTO reply (contents, discussionID, uID, date) VALUES ('$comment', '$commentID', '" . $_SESSION['uID'] . "', NOW())");
        $sql = $conn->query("SELECT reply.discussionID, fname, contents, DATE_FORMAT(reply.date, '%Y-%m-%d') AS createdOn FROM reply INNER JOIN user ON reply.uID = user.uID ORDER BY reply.discussionID DESC LIMIT 1");

    }
    else {
        $conn->query("INSERT INTO discussions (userID, contents, date) VALUES('" . $_SESSION['uID'] . "','$comment', NOW())");
        $sql = $conn->query("SELECT discussions.discussionID, fname, contents, DATE_FORMAT(discussions.date, '%Y-%m-%d') AS createdOn FROM discussions INNER JOIN user ON discussions.userID = user.uID ORDER BY discussions.discussionID DESC LIMIT 1");
    }
    $data= $sql->fetch_assoc();
    exit(createCommentRow($data));
	header("Refresh:0");
}


$sql = $conn->query("SELECT uID FROM user WHERE email='{$_SESSION['user_email_address']}'");
$data2 = $sql->fetch_assoc();
$_SESSION['uID'] = $data2['uID'];

$sqlNumComments = $conn->query("SELECT discussionID FROM discussions");
$numComments = $sqlNumComments->num_rows;

?>


<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link media="all" rel="stylesheet" href="../rivet.css">
    <title>Discussion</title> 

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta name="google-signin-client_id" content="140800144162-d33le531e64ocnb72b4copoq1ltt73ma.apps.googleusercontent.com">
    


    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Discussion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        .comment {
            margin-bottom: 20px;
        }

        .user {
            font-weight: bold;
            color: black;
        }

        .time .reply {
            color: gray;
        }

        .userComment {
            color: #000;
        }

        .replies .comment {
            margin-top: 20px;

        }

        .replies {
            margin-left: 20px;
        }

       
    </style>
</head> 
<body>

<header class="rvt-header" role="banner">
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
			  <a href="../busRoutes/busRoutes.php">Bus Routes</a>
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
				<a href="discussion.php" aria-current="page">Discussion</a>
			</li>
			<li class="rvt-menu__item">
				<a href="../profile-feature/profile.php">Profile</a>
			</li>
		</ul>
	</nav>
	<div class="rvt-box__header">
			<h1 class="rvt-ts-md">Discussion Page</h1>
			<br>
		  </div>
		  <div class="rvt-panel">
			<p>This page is for general discussion posts, questions, and comments about Indiana University.</p>
		</div>


	<div class="banner2">
		<img src="students.jpg" padding-left:20px; height ="400" width = 75%>
	</div>



	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<textarea class="form-control" id="mainComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
				<button style="float: right" class="btn-primary btn" onclick="isReply = false;" id="addComment">Add Comment</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">

				<div class="userComments">

				</div>
			</div>
		</div>
	</div>
	<div class="row replyRow" style="display:none">
		<div class="col-md-12">
			<textarea class="form-control" id="replyComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
			<button style="float: right" class="btn-primary btn" onclick="isReply = true;" id="addReply">Add Reply</button>
			<button style="float: right" class="btn-default btn" onclick="$('.replyRow').hide();">Close</button>
		</div>
	</div>



	<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var isReply = false, commentID = 0, max = <?php echo $numComments ?>;
		$(document).ready(function (){
			$("#addComment, #addReply").on('click', function () {
				var comment;

				if(!isReply) {
					comment = $("#mainComment").val();
				}
				else {
					comment = $("#replyComment").val();
				}


				if (comment.length > 5) {
					$.ajax({
						url: 'https://cgi.luddy.indiana.edu/~team49/team-49/discussion/discussion.php',
						method: 'POST',
						dataType: 'text',
						data: {
							addComment: 1,
							comment: comment,
							isReply: isReply,
							commentID: commentID
						}, success: function(response){
							max++;

							if(!isReply){
								$(".userComments").prepend(response);
								$("#mainComment").val("");
								

							}
							else{
								commentID = 0;
								$("#replyComment").val("");
								$(".replyRow").hide();
								$(".replyRow").parent().next().append(response);
								location.reload();

							}
						}

					});
				} else
					alert('Please Check Your Inputs');

			});
			getAllComments(0, max);
			

		});


		function reply(caller){
			commentID = $(caller).attr('data-commentID');
			$(".replyRow").insertAfter($(caller));
			$('.replyRow').show();
		}

		function getAllComments(start, max) {
			if (start > max) {
				return;
			}

			$.ajax({
				url: 'https://cgi.luddy.indiana.edu/~team49/team-49/discussion/discussion.php',
				method: 'POST',
				dataType: 'text',
				data: {
					getAllComments: 1,
					start: start
				}, success: function (response) {
					$(".userComments").append(response);
					getAllComments((start+20), max);

				}
			});
		}



	</script>
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