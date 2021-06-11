<?php
include('includes/loader.php');
$_SESSION['token'] = time();

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
<html lang="en">
<head>

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Basketball</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link href="https://fonts.iu.edu/style.css?family=BentonSans:regular,bold
	|BentonSansCond:regular|GeorgiaPro:regular" media="screen" rel="stylesheet" type="text/css"/>





    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- styles -->

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/smoothness/jquery-ui.css" rel="stylesheet">
    <link href="css/fullcalendar.print.css" media="print" rel="stylesheet">
    <link href="css/fullcalendar.css" rel="stylesheet">
    <link href="lib/spectrum/spectrum.css" rel="stylesheet">
    <link href="lib/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet">


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <title>Hoosier Helper</title>
    <style type="text/css">
				.rvt-menu--horizontal .rvt-menu__item a,
.rvt-menu--horizontal .rvt-menu__item button {
    padding: 1rem 1.25rem;
}
	
	.rvt-menu--horizontal .rvt-menu__item a[aria-current]::after,
.rvt-menu--horizontal .rvt-menu__item a:hover::after,
.rvt-menu--horizontal .rvt-menu__item button:hover::after {
    width: 100%;
    height: 0.25rem;
    bottom: 0;
    top: auto;
}
.rvt-menu__item a[aria-current]::after,
.rvt-menu__item a:hover::after,
.rvt-menu__item button:hover::after {
    content: "";
    display: block;
    width: 0.25rem;
    height: 100%;
    background-color: #006298;
    position: absolute;
    left: 0;
    top: 0;
}

.rvt-menu__list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.rvt-menu__item {
    margin: 0;
}

.rvt-menu__item a,
.rvt-menu__item button {
    text-decoration: none;
    padding: 0.25rem 1rem;
    position: relative;
    color: #333333;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-appearance: none;
    border: none;
}
	.rvt-drawer__nav--accent {
    border-top: 1px solid #dddddd;
}
            .rvt-header {
                display: -webkit-box !important;
                display: -ms-flexbox !important;
                display: flex !important;
                -webkit-box-align: center !important;
                -ms-flex-align: center !important;
                align-items: center !important;
                border-bottom: 1px solid #eaeaea !important;
                background-color: #fafafa !important;
                width: 100% !important;
            }

            .rvt-header__trident {
                min-width: 41px !important;
                -ms-flex-preferred-size: 41px !important;
                flex-basis: 41px !important;
                height: 200x !important;
                margin-right: 0.5rem !important;
                background-color: inherit !important;
                color: inherit !important;
            }


            .rvt-header__title {
                font-size: 2rem !important;
                line-height: 1 !important;
				
            }

            .rvt-header__title a {
                color: #333333 !important;
                text-decoration: none !important;
				padding-left: 12px;
            }

            .rvt-header__title a:hover {
                text-decoration: underline !important;
            }


            .rvt-menu__list {
                list-style: none !important;
                margin: 0 !important;
                padding: 5 !important;
            }

            .rvt-menu__item {
                margin: 0 !important;
				font-size: 1.5rem !important;
				
				
            }

            .rvt-menu__item a,
            .rvt-menu__item button {
                text-decoration: none !important;
                padding: 1.25rem 1rem !important;
                position: relative !important;
                color: #333333;
                display: -webkit-box !important;
                display: -ms-flexbox !important;
                display: flex !important;
                -webkit-box-align: center !important;
                -ms-flex-align: center !important;
                align-items: center !important;
                -webkit-appearance: none !important;
                border: none !important;
            }

            .rvt-menu__item a[aria-current] {
                background-color: #eeeeee !important;
            }

            .rvt-menu__item a[aria-current]::after,
            .rvt-menu__item a:hover::after,
            .rvt-menu__item button:hover::after {
                content: "" !important;
                display: block !important;
                width: 1.25rem !important;
                height: 100% !important;
                background-color: #006298 !important;
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
            }

            .rvt-menu--horizontal {
                border-bottom: 1px solid #dddddd !important;
            }

            .rvt-menu--horizontal .rvt-menu__list {
                display: -webkit-box !important;
                display: -ms-flexbox !important;
                display: flex !important;
            }

            .rvt-menu--horizontal .rvt-menu__item {
                -ms-flex-negative: 0 !important;
                flex-shrink: 0 !important;
            }

            .rvt-menu--horizontal .rvt-menu__item a,
            .rvt-menu--horizontal .rvt-menu__item button {
                padding: 1rem 1.25rem !important;
            }

            .rvt-menu--horizontal .rvt-menu__item a[aria-current] {
                background-color: transparent !important;
            }

            .rvt-menu--horizontal .rvt-menu__item a[aria-current]::after,
            .rvt-menu--horizontal .rvt-menu__item a:hover::after,
            .rvt-menu--horizontal .rvt-menu__item button:hover::after {
                width: 100% !important;
                height: 0.25rem !important;
                bottom: 0 !important;
                top: auto !important;
            }

            .rvt-menu--horizontal .rvt-menu__item a:hover::after,
            .rvt-menu--horizontal .rvt-menu__item button:hover::after {
                background-color: #dddddd !important;
            }
            @media screen and (min-width: 67.5em) {
                .rvt-header__trident {
                    min-width: 60px !important;
                    -ms-flex-preferred-size: 60px !important;
                    flex-basis: 60px !important;
                    height: 90px !important;
                    margin-right: 1rem !important;
					
                }
                .rvt-header__trident-large {
                    display: block !important;
                }
                .rvt-header__trident-small {
                    display: none !important;
                }
                .rvt-header__trident-logo {
                    width: 90px !important;
                    height: 110px !important;
                }
				.rvt-header__main-nav {
        display: block;
		}
            }



            @media screen and (min-width: 46.25em) {
                .rvt-menu:not(.rvt-menu--vertical) {
                    border-bottom: 1px solid #dddddd !important;
                }
                .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__list {
                    display: -webkit-box !important;
                    display: -ms-flexbox !important;
                    display: flex !important;
                }
                .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item {
                    -ms-flex-negative: 0 !important;
                    flex-shrink: 0 !important;
                }
                .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item a,
                .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item button {
                    padding: 1rem 1.25rem !important;
                }
                .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item a[aria-current] {
                    background-color: transparent !important;
                }
                .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item a[aria-current]::after,
                .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item a:hover::after,
                .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item button:hover::after {
                    width: 100% !important;
                    height: 0.25rem !important;
                    bottom: 0 !important;
                    top: auto !important;
                }
                .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item a:hover::after,
                .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item button:hover::after {
                    background-color: #dddddd;
                }
            }
			
			@media screen and (min-width: 46.25em) {
    .rvt-menu:not(.rvt-menu--vertical) {
        border-bottom: 1px solid #dddddd;
    }
    .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__list {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }
    .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item {
        -ms-flex-negative: 0;
        flex-shrink: 0;
    }
    .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item a,
    .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item button {
        padding: 2rem 2.25rem;
    }
    .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item a[aria-current] {
        background-color: transparent;
    }
    .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item a[aria-current]::after,
    .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item a:hover::after,
    .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item button:hover::after {
        width: 100%;
        height: 1.25rem;
        bottom: 0;
        top: auto;
    }
    .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item a:hover::after,
    .rvt-menu:not(.rvt-menu--vertical) .rvt-menu__item button:hover::after {
        background-color: #dddddd;
    }
}


@media screen and (min-width: 46.25em) {
    .rvt-footer {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }
    .rvt-footer__aux-links {
        margin-left: auto;
        margin-top: 0;
    }
}

.rvt-footer {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    font-size: 1.5rem;
    padding: 1.25rem 1.25rem;
    background-color: #fafafa;
    border-top: 10px solid #eaeaea;
    width: 100%;
    /**
   * DEPRECATED
   *
   * With the updates to the footer lockup, the div that the
   * `.rvt-footer__copyright-lockup` class is unncessary. We are deprecating
   * the class and removing the div from the code snippet.
   *
   * See the following for more info:
   *
   * - /src/components/14-footer/footer.hbs
   *
   */
    /**
   * End deprecated input validation
   */
}

.rvt-footer__copyright-lockup {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}
.rvt-panel {
    -webkit-box-shadow: 0 0.125rem 0 #dddddd;
    box-shadow: 0 0.125rem 0 #dddddd;
    border-radius: 0.25rem;
    padding: 1.5rem;
    background-color: #fafafa;
	font-size: 2rem;
	text-align: center;
}
        </style>
</head>
<body>


<header class="rvt-header" role="banner">
    <div class="rvt-header__trident">
        <svg role="img" xmlns="http://www.w3.org/2000/svg" width="75" height="85" viewBox="0 0 60 70" aria-labelledby="iu-logo">
            <title id="iu-logo">Indiana University</title>
            <rect width="60" height="70" fill="#900" />
            <polygon points="35.96 18.44 35.96 21.84 38.52 21.84 38.52 40.51 33.41 40.51 33.41 15.9 35.96 15.9 35.96 12.5 24.04 12.5 24.04 15.9 26.58 15.9 26.58 40.51 21.48 40.51 21.48 21.84 24.04 21.84 24.04 18.44 12.09 18.44 12.09 21.84 14.65 21.84 14.65 43.79 18.72 48.15 26.58 48.15 26.58 53.26 24.04 53.26 24.04 57.5 35.96 57.5 35.96 53.26 33.41 53.26 33.41 48.15 40.93 48.15 45.33 43.79 45.33 21.84 47.91 21.84 47.91 18.44 35.96 18.44" fill="#fff" />
        </svg>
    </div>
    <span class="rvt-header__title">
                <a href="#0">Hoosier Helper</a>
            </span>
</header>

<nav class="rvt-menu" aria-label="Section navigation">
    <ul class="rvt-menu__list">
        <li class="rvt-menu__item">
            <a href="../../../website.php">Home</a>
        </li>
        <li class="rvt-menu__item">
		  	<a href="../../../busRoutes/busRoutes.php">Bus Routes</a>
		</li>
        <li class="rvt-menu__item">
            <a href="index.php" aria-current="page">Sports</a>
        </li>
        <li class="rvt-menu__item">
            <a href="../../../food-feature/food.php">Food</a>
        </li>
        <li class="rvt-menu__item">
            <a href="../../../deals-feature/deals-feature.php">Specials</a>
        </li>
        <li class="rvt-menu__item">
            <a href="../../../experience/experience.php">Gallery</a>
        </li>
        <li class="rvt-menu__item">
            <a href="../../../study-feature/study.php">Study Groups</a>
        </li>
        <li class="rvt-menu__item">
            <a href="../../../locations-feature/Scenic-Locations.php">Locations</a>
        </li>
        <li class="rvt-menu__item">
            <a href="../../../calendar-feature/calendar.php">Calendar</a>
        </li>
        <li class="rvt-menu__item">
            <a href="../../../discussion/discussion.php">Discussion</a>
        </li>
        <li class="rvt-menu__item">
            <a href="../../../profile-feature/profile.php">Profile</a>
        </li>
    </ul>
</nav>

<br>
<br>

<nav class="rvt-menu" aria-label="Section navigation">
    <ul class="rvt-menu__list">
        <li class="rvt-menu__item">
            <a href="index.php">Basketball</a>
        </li>
        <li class="rvt-menu__item">
            <a href="tennis.php">Tennis</a>
        </li>
        <li class="rvt-menu__item">
            <a href="baseball.php">Baseball</a>
        </li>
        <li class="rvt-menu__item">
            <a href="soccer.php" aria-current="page">Soccer</a>
        </li>
        <li class="rvt-menu__item">
            <a href="volleyball.php">Volleyball</a>
        </li>
    </ul>
</nav>


<div style="width: 100%; float: left; background-color: white;">
    <div style="text-align: center;">
    </div>
    <div class="map">
        <p style="text-align: center;"><iframe width="800" height="500" style="border:0" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/search?q=soccer%20fields%20near%20Bloomington%2C%20IN&key=AIzaSyCfv81kUYzwrWDdaF-S8zvC_Yd58bl7utU"></iframe><div class="row reserveRow">
        </div>
</div>


<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



<div class="rvt-panel">
		<p>Click on the calendar to reserve a court or location. This calendar is public to everyone and can be viewed by any user. </p>
	</div>



<!---------------------------------------------- CALENDAR MODALs ---------------------------------------------->

<!-- Calendar Modal -->
<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="details-body-title"></h4>
            </div>
            <div class="modal-body">

                <div class="loadingDiv"></div>

                <!-- QuickSave/Edit FORM -->
                <form id="modal-form-body">
                    <p>
                        <label>Title: </label>
                        <input class="form-control" name="title" value="" type="text">
                    </p>
                    <p>
                        <label>Description: </label>
                        <textarea class="form-control" name="description"></textarea>
                    </p>
                    <p>
                        <label>Category: </label>
                        <select name="categorie" class="form-control">
                            <?php
                            foreach($calendar->getCategories() as $categorie)
                            {
                                $_SESSION['filter'] = str_replace('&amp;', '&', $_SESSION['filter']);
                                echo '<option value="'.$categorie.'">'.$categorie.'</option>';
                            }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label>Event Color:</label>
                        <input type="text" class="form-control input-sm" value="#587ca3" name="color" id="colorp">
                    </p>
                    <div class="pull-left mr-10">
                        <p id="repeat-type-select">
                            <label>Repeat:</label>
                            <select id="repeat_select" name="repeat_method" class="form-control">
                                <option value="no" selected>No</option>
                                <option value="every_day">Every Day</option>
                                <option value="every_week">Every Week</option>
                                <option value="every_month">Every Month</option>
                            </select>
                        </p>
                    </div>
                    <div class="pull-left">
                        <p id="repeat-type-selected">
                            <label>Times:</label>
                            <select id="repeat_times" name="repeat_times" class="form-control">
                                <option value="1" selected>1</option>
                                <?php
                                for($i = 2; $i <= 30; $i++) {
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                                ?>
                            </select>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                    <p id="event-type-select">
                        <label>Type: </label>
                        <select id="event-type" name="all-day" class="form-control">
                            <option value="true">Make event 24H (all day)</option>
                            <option value="false">Make event as I wish</option>
                        </select>
                    </p>
                    <div id="event-type-selected">
                        <div class="pull-left mr-10">
                            <p>
                                <label>Start Date:</label>
                                <input type="text" name="start_date" class="form-control input-sm" placeholder="Y-M-D" id="startDate">
                            </p>
                        </div>
                        <div class="pull-left">
                            <p>
                                <label>Start Time:</label>
                                <input type="text" class="form-control input-sm" name="start_time" placeholder="HH:MM" id="startTime">
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-left mr-10">
                            <p>
                                <label>End Date:</label>
                                <input type="text" class="form-control input-sm" name="end_date" placeholder="Y-M-D" id="endDate">
                            </p>
                        </div>
                        <div class="pull-left">
                            <p>
                                <label>End Time:</label>
                                <input type="text" class="form-control input-sm" name="end_time" placeholder="HH:MM" id="endTime">
                            </p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="custom-fields">
                        <?php
                        $form->generate();
                        ?>
                    </div>
                </form>

                <!-- Modal Details -->
                <div id="details-body">
                    <div id="details-body-content"></div>
                </div>

            </div>
            <div class="modal-footer">
                
                <button type="button" id="add-event" class="btn btn-primary">Add</button>
                <button type="button" id="save-changes" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Prompt -->
<div id="cal_prompt" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger" data-option="remove-this">Delete this</a>
                <a href="#" class="btn btn-danger" data-option="remove-repetitives">Delete all</a>
                <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Prompt -->
<div id="cal_edit_prompt_save" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body-custom"></div>
            <div class="modal-footer">
                <a href="#" class="btn btn-info" data-option="save-this">Save this</a>
                <a href="#" class="btn btn-info" data-option="save-repetitives">Save all</a>
                <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div id="cal_import" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body-import" style="white-space: normal;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Import Event</h4>

                <p class="help-block">Copy & Paste the event code from your .ics file, open it using an text editor</p>
                <textarea class="form-control" rows="10" id="import_content" style="margin-bottom: 10px;"></textarea>
                <input type="button" class="pull-right btn btn-info" onClick="calendar.calendarImport()" value="Import" />
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="cal_token" id="cal_token" value="<?php echo $_SESSION['token']; ?>" />

<!---------------------------------------------- THEME ---------------------------------------------->



<div class="container" style="margin-top: 80px;">


    <div class="clearfix"></div>

    <!-- Filter by Category (required if you want to have categories filtering) -->
    <?php if($calendar->getCategories() !== false) { ?>
        <div id="cat-holder">
            <form id="filter-category">
                <select class="form-control input-sm" style="width: auto;">
                    <?php
                    $selected = (isset($_SESSION['filter']) && $_SESSION['filter'] == 'all-fields' ? 'selected' : '');
                    echo '<option '.$selected.' value="all-fields">All</option>';
                    foreach($calendar->getCategories() as $categorie)
                    {
                        $selectedLoop = (isset($_SESSION['filter']) && $_SESSION['filter'] == $categorie ? 'selected' : '');
                        echo '<option '.$selectedLoop.' value="'.$categorie.'">'.$categorie.'</option>';
                    }
                    ?>
                </select>
            </form>
        </div>
    <?php } ?>

    <div class="box">
        <div class="header"><h4>Calendar</h4></div>
        <div class="content">
            <div id="calendar"></div>
            <div id="loading" class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    </div>

</div> <!-- /container -->

<script src="lib/moment.js"></script>
<script src="lib/jquery.js"></script>
<script src="lib/jquery-ui.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/fullcalendar.js"></script>
<script src="js/lang-all.js"></script>
<script src="js/jquery.calendar.js"></script>
<script src="lib/spectrum/spectrum.js"></script>

<script src="lib/timepicker/jquery-ui-sliderAccess.js"></script>
<script src="lib/timepicker/jquery-ui-timepicker-addon.min.js"></script>

<script src="js/custom.js"></script>

<script src="js/g.map.js"></script>
<script src="js/gcal.js"></script>
<script src="http://maps.google.com/maps/api/js" defer></script>

<!-- call calendar plugin -->
<script type="text/javascript">
    $().FullCalendarExt({
        calendarSelector: '#calendar',
        lang: 'en',
        fc_extend: {
            nowIndicator: true
        }
    });
</script>

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

