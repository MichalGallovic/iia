<?php

session_start();
require_once("redirect.php");
require_once('MysqlMachine.php');
$database = include "config.php";
$mysql = new \IIA\MysqlMachine($database["db_name"],
    $database["host"],$database["username"],$database["password"]);


$post = $_POST;
$personData = [];
$gameData = [];
$umiestnenieID = "";
$personID = "";
//parsing
foreach($post as $key => $value) {
    //person info
    if(substr($key,0,6) == "person") {
        $columnName = substr($key,7);
        if($columnName == "id") {
            $personID = $value;
            continue;
        }
        $tmpArray = [substr($key,7)=>$value];
        $personData += $tmpArray;
    }
    //game info
    if(substr($key,0,11) == "umiestnenie") {
        $keyData = explode("-",$key);
        if(isset($gameData[$keyData[1]])) {
            $gameData[$keyData[1]] += [$keyData[2] => $value];
        } else {
            $gameData += [$keyData[1] => [$keyData[2] => $value]];
        }

    }
}

$mysql->close();

$personUpdate = $mysql->updateById("osoby",$personID,$personData);
$gameUpdate = true;
//updating games info
foreach($gameData as $key => $gameSpecific) {
    $gameUpdate = $mysql->updateById("umiestnenia",$key,$gameSpecific);

}

if($personUpdate && $gameUpdate) {
    $_SESSION["success"] = true;
    $_SESSION["message"] = "Person data were updated successfully!";
    movePage(200,"/z2");
} else {
    $_SESSION["success"] = false;
    $_SESSION["message"] = "Person data were not updated!";
    movePage(400,"/z2");
}

