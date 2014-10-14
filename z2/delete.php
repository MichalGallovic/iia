<?php
session_start();
require_once("redirect.php");
require_once('MysqlMachine.php');
$database = include "config.php";
$mysql = new \IIA\MysqlMachine($database["db_name"],
    $database["host"],$database["username"],$database["password"]);

$id = $_GET["id"];

if($mysql->deleteById("osoby",$id)) {
    $_SESSION["success"] = true;
    $_SESSION["message"] = "Person deleted successfully!";
    movePage(200,"/z2");
} else {
    $_SESSION["success"] = false;
    $_SESSION["message"] = "Person was not deleted! - probably bad ID";
    movePage(400,"/z2");
}


$mysql->close();