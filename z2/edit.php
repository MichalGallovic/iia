<?php

session_start();
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

$query = "SELECT * FROM oh";
$olympicgames = $mysql->select($query);

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
    <h1>Edit Person</h1>
    <hr/>
    <h4>Person info</h4>
    <form class="form-horizontal" role="form" method="post" action="update.php">
        <input type="hidden" value="<?php echo $person->id_person?>" name="person_id"/>
        <div class="form-group">
            <label class="col-sm-2 control-label">Meno</label>
            <div class="col-sm-10">
                <input name="person-name" type="text" class="form-control"
                       value="<?php echo $person->name?>"
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Priezvisko</label>
            <div class="col-sm-10">
                <input name="person-surname" type="text" class="form-control"
                       value="<?php echo $person->surname?>"
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Dátum narodenia</label>
            <div class="col-sm-10">
                <input name="person-birthDay" type="text" class="form-control"
                       value="<?php echo $person->birthDay?>"
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Miesto narodenia</label>
            <div class="col-sm-10">
                <input name="person-birthPlace" type="text" class="form-control"
                       value="<?php echo $person->birthPlace?>"
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Krajina narodenia</label>
            <div class="col-sm-10">
                <input name="person-birthCountry" type="text" class="form-control"
                       value="<?php echo $person->birthCountry?>"
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Dátum úmrtia</label>
            <div class="col-sm-10">
                <input name="person-deathDay" type="text" class="form-control"
                       value="<?php echo $person->deathDay?>"
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Miesto úmrtia</label>
            <div class="col-sm-10">
                <input name="person-deathPlace" type="text" class="form-control"
                       value="<?php echo $person->deathPlace?>"
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Krajina úmrtia</label>
            <div class="col-sm-10">
                <input name="person-deathCountry" type="text" class="form-control"
                       value="<?php echo $person->deathCountry?>"
                    >
            </div>
        </div>

        <hr/>
        <h4>Olympics info</h4>
        <?php foreach($result as $item) :?>
            <?php $gameLabel = "umiestnenie-".$item->id."-"; ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Miesto</label>
            <div class="col-sm-10">
                <input name="<?php echo $gameLabel."place"?>" type="text" class="form-control"
                       value="<?php echo $item->place?>"
                    >

            </div>
        </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Disciplína</label>
                <div class="col-sm-10">
                    <input name="<?php echo $gameLabel."discipline"?>" type="text" class="form-control"
                           value="<?php echo $item->discipline?>"
                        >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Olympijské hry</label>
                <div class="col-sm-10">
                    <select name="<?php echo $gameLabel."id_oh"?>" class="selectpicker" data-live-search="true">

                        <?php foreach($olympicgames as $game) :?>
                            <?php if($game->id == $item->id_oh) :?>
                            <option value="<?php echo $game->id ?>" selected><?php echo $game->type.", ".$game->year.", ".$game->city.", ".$game->country; ?></option>
                            <?php else : ?>
                            <option value="<?php echo $game->id ?>"><?php echo $game->type.", ".$game->year.", ".$game->city.", ".$game->country; ?></option>
                            <?php endif; ?>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
        <div class="form-group pull-right">
            <div class="col-sm-offset-2 col-sm-10">
                    <div class="col-sm-6"><button type="submit" class="btn btn-success">Save</button></div>
                    <div class="col-sm-6"><a class="btn btn-default" href="/z2">Cancel</a></div>
            </div>
        </div>
    </form>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script>
    $(".selectpicker").selectpicker();
</script>
</body>
</html>