<?php
session_start();
require_once('MysqlMachine.php');
require_once("Auth.php");
require_once("redirect.php");

use IIA\Auth as Auth;

if(!Auth::isLoggedIn()) {
    \IIA\movePage(401,"/z3");
}


date_default_timezone_set('Europe/Bratislava');

$database = include "config.php";
$mysql = new \IIA\MysqlMachine($database["db_name"],
    $database["host"],$database["username"],$database["password"]);
$query = "SELECT * FROM login_times;";
$login_times = $mysql->select($query);
$ldap = 0;
$google = 0;
$registration = 0;
foreach($login_times as $login_time) {
    switch($login_time->type) {
        case "ldap":
            $ldap++;
            break;
        case "googleoauth2":
            $google++;
            break;
        case "registracia":
            $registration++;
            break;
    }
}
$total = count($login_times);
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
            <li><a href="/z3/dashboard.php"><?php echo $_SESSION["username"] ?></a></li>
            <li><a href="logout.php?logout">Logout</a></li>
        </ul>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<div class="container">
    <h1>Total: <?php echo count($login_times)?></h1>
    <div class="row">
        <table class="table striped">
            <thead>
            <tr>
                <th>Username</th>
                <th>Login Time</th>
                <th>Type</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($login_times as $login_time): ?>
                <tr>
                    <td><?php echo $login_time->username?></td>
                    <td><?php echo $login_time->login_time?></td>
                    <td><?php echo $login_time->type?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <h1>Statistics</h1>
    <div class="row">
        <table class="table striped">
            <thead>
            <tr>
                <th>LDAP</th>
                <th>Google Oauth2</th>
                <th>Registration</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo round(($ldap/$total)*100,2); ?></td>
                <td><?php echo round(($google/$total)*100,2); ?></td>
                <td><?php echo round(($registration/$total)*100,2); ?></td>
            </tr>
            </tbody>
        </table>
    </div>


</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>