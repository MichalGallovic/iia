<?php
require_once("Auth.php");
require_once("redirect.php");
set_include_path( get_include_path() . PATH_SEPARATOR . 'google/src' );

require_once("Google/Client.php");
require_once("Auth.php");

use IIA\Auth as Auth;
session_start();
unset($_SESSION["username"]);
unset($_SESSION["fullname"]);

// Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
$application_name = 'IIAOauth2';
$client_id = '110220210617-8q8las984mu3nejosch94c277t7let57.apps.googleusercontent.com';
$client_secret = 'mfJ-o8DcfeC6XGsOHqBIMUBx';
$redirect_uri = 'http://vmxgallovicm.fei.stuba.sk/z3/dashboard.php';


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
    Auth::logout();
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)); //redirect user back to page
}


\IIA\movePage(200,"/z3");
?>