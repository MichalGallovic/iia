<?php
session_start();
require_once("Auth.php");
require_once("redirect.php");

use IIA\Auth as Auth;
if(!Auth::isLoggedIn()) {
    \IIA\movePage(401,"/z3");
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
            <li><a href="/z3/dashboard.php"><?php echo $_SESSION["username"] ?></a></li>
            <li><a href="logout.php?logout">Logout</a></li>
        </ul>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<div class="container">
    <h1 class="text-center">Hello <?php echo $_SESSION["fullname"];?>! This is super secret dashboard!</h1>
    <div class="row">
        <div class="auth-group" class="col-sm-12 text-center">
            <a class='btn btn-success btn-lg' href="history.php">History</a>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>