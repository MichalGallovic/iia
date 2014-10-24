<?php
session_start();
set_include_path( get_include_path() . PATH_SEPARATOR . 'google/src' );
require_once("Google/Client.php");



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

//$client->addScope("https://www.googleapis.com/auth/userinfo.email");
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
        echo "Meno:  ".$userData["name"]."<br>";
        echo "Email: ".$userData["email"]."<br>";
        echo "ID:  ".$userData["id"]."<br>";
        print "<a class='login' href='?logout'>Log out!</a>";
    }
    $_SESSION['access_token'] = $client->getAccessToken();
} else {
    $authUrl = $client->createAuthUrl();
    print "<a class='login' href='$authUrl'>Connect Me!</a>";
}
?>