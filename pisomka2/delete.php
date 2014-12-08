<?php
session_start();
require_once("MysqlDB.php");
require_once("redirect.php");
$mysql = new MysqlDB('iiadb','localhost','root','lostebif');

$todelete = $_GET["id"];

$mysql->deleteById('todos',$todelete);
$_SESSION["message"] = "TODO deleted !";
movePage(200,'index.php');