<?php
session_start();
require_once("redirect.php");
require_once('MysqlMachine.php');
require_once("Auth.php");
date_default_timezone_set('Europe/Bratislava');

$firstname = ["firstname" => $_POST["firstname"]];
$lastname = ["lastname" => $_POST["lastname"]];
$username = ["username" => $_POST["username"]];
$password = ["password" => base64_encode($_POST["password"])];


$database = include "config.php";
$mysql = new \IIA\MysqlMachine($database["db_name"],
    $database["host"],$database["username"],$database["password"]);

$personData = [];
$personData += $firstname += $lastname += $username += $password;

$userID = $mysql->insertInto("users", $personData);

if(isset($userID)) {
    $_SESSION["success"] = true;
    $_SESSION["message"] = "Your account was created successfully!";
    $_SESSION["username"] = $username["username"];
    $_SESSION["fullname"] = $firstname["firstname"] . " " . $lastname["lastname"];
    \IIA\Auth::logIn();
    $userID = ["username"=>$username["username"]];
    $when = ["login_time"=>date('Y-m-d H:i:s', time())];
    $type = ["type"=>"registracia"];
    $loginData = [];
    $loginData += $userID += $when += $type;
    $mysql->insertInto("login_times",$loginData);
    \IIA\movePage(200,"/z3/dashboard.php");
} else {
    $_SESSION["success"] = false;
    $_SESSION["message"] = "There was a server error. Please Try again in a minute!";
    \IIA\movePage(500,"/z3/register.php");
}

