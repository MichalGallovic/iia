<?php
require_once('MysqlMachine.php');
require_once("Auth.php");
session_start();

\IIA\Auth::isLoggedIn();

$request_success = null;
$message = "";

if(isset($_SESSION["success"])) {
    $request_success = $_SESSION["success"];
}

if(isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
}



$database = include "config.php";
$mysql = new \IIA\MysqlMachine($database["db_name"],
        $database["host"],$database["username"],$database["password"]);

$query = "SELECT osoby.`id`,osoby.`name`, osoby.`surname`, oh.`year`, oh.`city`, oh.`country`,
          oh.`type`, umiestnenia.`discipline`
          FROM umiestnenia
          INNER JOIN oh
          ON umiestnenia.`id_oh`=oh.`id`
          INNER JOIN osoby
          ON umiestnenia.`id_person`=osoby.`id`
          WHERE place = 1 ";

$orderBy ="";
$order ="";
if(isset($_GET["order"])) {
    $order = $_GET["order"];
} else {
    $order = "asc";
}
if(isset($_GET["sort"])) {
    if($_GET["sort"] == "type") {
        $orderBy = "ORDER BY type ".$order.", year";
    } else {
        $orderBy = "ORDER BY ".$_GET["sort"]." ".$order;
    }
}

$query = $query.$orderBy;


$result = $mysql->select($query);

if($order == "asc") {
    $order = "desc";
} else {
    $order = "asc";
}

$mysql->close();

?>

<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>IIA Zadanie 2</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
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
            <li><a href="#">Admin</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        </div><!-- /.navbar-collapse -->
    </div>
</nav>

<div class="container">
    <h1 style="display:inline-block;">Olympijskí víťazi</h1> <a style="margin-bottom: 15px; margin-left: 25px; "class="btn btn-success" href="new.php">Nový olympionik</a>

<!--    FLASH MESSAGES-->
    <?php if(isset($request_success)) : ?>
        <?php if($request_success) : ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Success!</strong> <?php echo $message ?>
        </div>

        <?php else : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Error!</strong> <?php echo $message ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<!--    FLASH MESSAGES-->

    <table class="table striped">
        <thead>
            <tr>
                <th>Meno</th>
                <th><a href="?sort=surname&order=<?php echo $order ?>">Priezvisko</a></th>
                <th><a href="?sort=year&order=<?php echo $order ?>">Rok</a></th>
                <th>Mesto</th>
                <th>Krajina</th>
                <th><a href="?sort=type&order=<?php echo $order ?>">Typ</a></th>
                <th>Disciplína</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($result as $osoba) {
                echo "<tr>";
                    foreach($osoba as $name => $column) {

                        switch($name) {
                            case "id":
                                break;
                            case "name":
                                echo "<td><a href='show.php?id=$osoba->id'>$column</td></a>";
                                break;
                            default:
                                echo "<td>" . $column . "</td>";
                                break;
                        }

                    }
                echo "<td>";
                echo "<a class='erase' href='delete.php?id=$osoba->id'><i class='fa fa-close fa-2x'></i></a>";
                echo "<a  class='edit' href='edit.php?&id=$osoba->id'><i class='fa fa-edit fa-2x'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>


<?php
unset($_SESSION["message"]);
unset($_SESSION["success"]);
?>







