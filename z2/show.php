<?php

require_once("redirect.php");
require_once('MysqlMachine.php');
$database = include "config.php";
$mysql = new \IIA\MysqlMachine($database["db_name"],
    $database["host"],$database["username"],$database["password"]);

$id = $_GET["id"];
$query = "SELECT u.`id`, u.`id_person`, u.`id_oh`, u.`place`, u.`discipline`,
		os.`name`, os.`surname`, os.`birthDay`, os.`birthPlace`, os.`birthCountry`, os.`deathDay`, os.`deathPlace`, os.`deathCountry`,
		oh.`type`, oh.`year`,oh.`city`, oh.`country`
          FROM umiestnenia as u
          INNER JOIN osoby as os
          ON u.`id_person` = os.`id`
          INNER JOIN oh as oh
          ON u.`id_oh` = oh.`id`
          WHERE `id_person`=$id";

$result = $mysql->select($query);

$person = $result[0];

?>
<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>IIA Zadanie 2</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-select.min.css"/>
    <style>
        .erase {
            color :red;
            margin-right: 10px;
        }
        .edit {
            color: black;
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
            <a class="navbar-brand" href="/z2">IIA Zadanie 2</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Michal Gallovič</a></li>
        </ul>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        </div><!-- /.navbar-collapse -->
    </div>
</nav>