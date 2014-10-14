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
$mysql->close();
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
        .panel-body .row {
            margin-top: 15px;
        }
        .panel-body .row:first-child {
            margin-top: 0;
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

<div class="container">
    <h1>Detail športovca:</h1>
    <div style="margin-top: 40px;" class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Person info: <?php echo $person->name." ".$person->surname ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4"><strong>Dátum narodenia</strong></div>
                    <div class="col-sm-8"><span><?php echo $person->birthDay ?></span></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><strong>Mesto narodenia</strong></div>
                    <div class="col-sm-8"><span><?php echo $person->birthPlace ?></span></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><strong>Krajina narodenia</strong></div>
                    <div class="col-sm-8"><span><?php echo $person->birthCountry ?></span></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><strong>Dátum úmrtia</strong></div>
                    <div class="col-sm-8"><span><?php echo $person->deathDay ?></span></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><strong>Mesto úmrtia</strong></div>
                    <div class="col-sm-8"><span><?php echo $person->deathPlace ?></span></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><strong>Krajina úmrtia</strong></div>
                    <div class="col-sm-8"><span><?php echo $person->deathCountry ?></span></div>
                </div>
            </div>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Olympic games: <?php echo $person->name." ".$person->surname ?></h3>
            </div>
            <div class="panel-body">
                <?php foreach($result as $game) :?>
                <div class="row">
                    <div class="col-sm-12"><strong><?php echo $game->place ?> place</strong>, at <?php echo $game->type." ".$game->year.", ".$game->city." ".$game->country." - ".$game->discipline; ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>