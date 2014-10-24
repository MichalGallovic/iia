<?php
session_start();
require_once("Auth.php");
require_once("redirect.php");
if(\IIA\Auth::isLoggedIn()) {
    \IIA\movePage(200, "/z3/dashboard.php");
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
        .well {
            margin-top: 40px;
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
    <h1 class="text-center">STUBA LDAP</h1>
    <div class="col-sm-6 col-sm-offset-3">
        <div class="well">
            <h4>Log in</h4>
            <form class="form-horizontal" role="form" method="post" action="authldap.php">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input name="username" type="text" class="form-control"

                            >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input name="password" type="password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success pull-right">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>