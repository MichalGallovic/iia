<?php
session_start();
require_once("redirect.php");
require_once("Auth.php");
require_once("google/autoload.php");
use IIA\Auth as Auth;

if(Auth::isLoggedIn()) {
    \IIA\movePage(200,"/z3/dashboard.php");
}

// Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
$application_name = 'IIAOauth2';
$client_id = '110220210617-8q8las984mu3nejosch94c277t7let57.apps.googleusercontent.com';
$client_secret = 'mfJ-o8DcfeC6XGsOHqBIMUBx';
$redirect_uri = 'http://vmxgallovicm.fei.stuba.sk/z3/googleoauth2callback.php';


//Create Client Request to access Google API
$client = new Google_Client();
$client->setApplicationName($application_name);
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes(array(
    'https://www.googleapis.com/auth/userinfo.email',
    'https://www.googleapis.com/auth/userinfo.profile',
));

//Send Client Request
$objOAuthService = new Google_Service_Oauth2($client);

//Logout
if (isset($_REQUEST['logout'])) {
    unset($_SESSION['access_token']);
    $client->revokeToken();
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)); //redirect user back to page
}

//Authenticate code from Google OAuth Flow
//Add Access Token to Session
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

//Set Access Token to make Request
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
}

//Get User Data from Google Plus
if ($client->getAccessToken()) {
    $userData = $objOAuthService->userinfo->get();
    if(!empty($userData)) {
        //print_r($userData);
//        echo "Meno:  ".$userData["name"]."<br>";
//        echo "Email: ".$userData["email"]."<br>";
//        echo "ID:  ".$userData["id"]."<br>";
//        print "<a class='login' href='?logout'>Log out!</a>";
        $_SESSION["username"] = $userData["email"];
        $_SESSION["fullname"] = $userData["name"];

    }
    $_SESSION['access_token'] = $client->getAccessToken();
    Auth::logIn();
} else {
    $authUrl = $client->createAuthUrl();
}
?>

<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>IIA Zadanie 2</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
    <style>
        .auth-group {
            margin-top: 40px;
            text-align:center;
        }
        .auth-group a {
            margin-right: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/z3">IIA Zadanie 3</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="register.php">Sign up</a></li>
        </ul>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<div class="container">
    <h1 class="text-center">Login with LDAP, Google OAuth2 or your Account</h1>
    <div class="row">
            <div class="auth-group" class="col-sm-12 text-center">
                <a class="btn btn-info btn-lg" href="ldap.php">STUBA LDAP</a>
                <?php print "<a class='btn btn-success btn-lg' href='$authUrl'>Google OAuth2</a>"; ?>
                <a class="btn btn-warning btn-lg" href="login.php">Normal Login</a>
            </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>