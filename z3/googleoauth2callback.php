<?php
session_start();
set_include_path( get_include_path() . PATH_SEPARATOR . 'google/src' );
require_once("Google/Client.php");
require_once('MysqlMachine.php');
require_once("Auth.php");
require_once("redirect.php");

use IIA\Auth as Auth;

date_default_timezone_set('Europe/Bratislava');

$database = include "config.php";
$mysql = new \IIA\MysqlMachine($database["db_name"],
    $database["host"],$database["username"],$database["password"]);



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
        $userID = ["username"=>$userData["email"]];
        $when = ["login_time"=>date('Y-m-d H:i:s', time())];
        $type = ["type"=>"googleoauth2"];
        $loginData = [];
        $loginData += $userID += $when += $type;
        $mysql->insertInto("login_times",$loginData);
    }
    $_SESSION['access_token'] = $client->getAccessToken();
    Auth::logIn();
    \IIA\movePage(200,"/z3/dashboard.php");
} else {
//    $authUrl = $client->createAuthUrl();
    \IIA\movePage(401,"/z3");
}
