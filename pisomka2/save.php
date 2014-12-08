<?php
require_once("MysqlDB.php");
require_once("redirect.php");
$mysql = new MysqlDB('iiadb','localhost','root','lostebif');

$nazov = $_POST["nazov"];
$datum = $_POST["datum"];

$mysql->insertInto('todos',['nazov'=>$nazov, 'datum'=>$datum]);

movePage(200,'index.php');

