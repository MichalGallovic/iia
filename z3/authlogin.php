<?php

session_start();
require_once("redirect.php");
require_once('MysqlMachine.php');
require_once("Auth.php");
date_default_timezone_set('Europe/Bratislava');

$_SESSION["temporar_username"] = $_POST["username"];

$database = include "config.php";
$mysql = new \IIA\MysqlMachine($database["db_name"],
    $database["host"],$database["username"],$database["password"]);

$result = $mysql->findByColumn("users","username",$_POST["username"]);

if($result) {
    $correctPassword = base64_decode($result->password) ==  $_POST["password"];

    if($correctPassword) {
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["fullname"] = $result->firstname . " " .$result->lastname;
        \IIA\Auth::logIn();
        $userID = ["username"=>$result->username];
        $when = ["login_time"=>date('Y-m-d H:i:s', time())];
        $type = ["type"=>"registracia"];
        $loginData = [];
        $loginData += $userID += $when += $type;
        $mysql->insertInto("login_times",$loginData);
        \IIA\movePage(200,"/z3/dashboard.php");
    } else {
        $_SESSION["success"] = false;
        $_SESSION["message"] = "Bad username or password";
        \IIA\movePage(200,"/z3/login.php");
    }

} else {
    $_SESSION["success"] = false;
    $_SESSION["message"] = "Bad username or password";
    \IIA\movePage(200,"/z3/login.php");
}

