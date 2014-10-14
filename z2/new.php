<?php
require_once("redirect.php");
require_once('MysqlMachine.php');
require_once('helpers.php');
require_once("Auth.php");
session_start();
\IIA\Auth::isLoggedIn();


$database = include "config.php";
$mysql = new \IIA\MysqlMachine($database["db_name"],
    $database["host"],$database["username"],$database["password"]);

$query = "SELECT * FROM oh";
$olympicgames = $mysql->select($query);
$olympicgames = object_to_array($olympicgames);
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
            <li><a href="#">Admin</a></li>
        </ul>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        </div><!-- /.navbar-collapse -->
    </div>
</nav>

<div class="container">
    <h1>Nový olympionik</h1>
    <hr/>
    <form class="form-horizontal" role="form" method="post" action="create.php">
        <input type="hidden" />
        <div class="form-group">
            <label class="col-sm-2 control-label">Meno</label>
            <div class="col-sm-10">
                <input name="person-name" type="text" class="form-control"
                       
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Priezvisko</label>
            <div class="col-sm-10">
                <input name="person-surname" type="text" class="form-control"
                       
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Dátum narodenia</label>
            <div class="col-sm-10">
                <input name="person-birthDay" type="text" class="form-control"
                       
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Miesto narodenia</label>
            <div class="col-sm-10">
                <input name="person-birthPlace" type="text" class="form-control"
                       
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Krajina narodenia</label>
            <div class="col-sm-10">
                <input name="person-birthCountry" type="text" class="form-control"
                       
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Dátum úmrtia</label>
            <div class="col-sm-10">
                <input name="person-deathDay" type="text" class="form-control"
                       
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Miesto úmrtia</label>
            <div class="col-sm-10">
                <input name="person-deathPlace" type="text" class="form-control"
                       
                    >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Krajina úmrtia</label>
            <div class="col-sm-10">
                <input name="person-deathCountry" type="text" class="form-control"
                       
                    >
            </div>
        </div>

        <h1 style="display: inline-block;">Olympijské výsledky</h1><button type="button" id="add-result" style="margin-bottom: 15px; margin-left: 25px; " class="btn btn-success">Pridať výsledok</button>
        <hr/>
        <div id="olympic-container">

        </div>
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

    var olympicgames = <?php echo json_encode($olympicgames) ?>;
    var optionsHTML = "";
    var newGameCounter = 0;
    $(document).ready(function() {
        $(".selectpicker").selectpicker();

        olympicgames.forEach(function(value) {
            optionsHTML += "<option value="+value.id+">"+value.type+", "+value.year+", "+value.city+", "+value.country+"</option>";
        });

        $("#add-result").click(function(){
            newGameCounter++;
            var selectHTML = "<select name='umiestnenie-"+newGameCounter+"-id_oh' class='selectpicker' data-live-search='true'>"+optionsHTML+"</select>";
            var html = "<div class='form-group'> <label class='col-sm-2 control-label'>Olympijské hry</label> <div class='col-sm-10'> "+selectHTML+" </div> </div> <div class='form-group'> <label class='col-sm-2 control-label'>Miesto</label> <div class='col-sm-10'> <input name='umiestnenie-"+newGameCounter+"-place' class='form-control' type='text'/> </div> </div> <div class='form-group'> <label class='col-sm-2 control-label'>Disciplína</label> <div class='col-sm-10'> <input name='umiestnenie-"+newGameCounter+"-discipline' class='form-control' type='text'/> </div> </div><hr>";
            $('#olympic-container').append(html);
            $(".selectpicker").selectpicker();

        });
    });
</script>
</body>
</html>