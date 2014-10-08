<?php
use IIA\DbConnect as DBConnect;

include('config.php');
include('DbConnect.php');

$db = new DbConnect($db_settings['type'],
					$db_settings['host'],
					$db_settings['username'],
					$db_settings['password'],
					$db_settings['db_name']);

$mysql = $db->getDbInstance();

var_dump($mysql->findAll("osoby"));