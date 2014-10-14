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

}

$personID = null;
$personID = $mysql->insertInto("osoby", $personData);

foreach($post as $key => $value) {
    //game info
    if(substr($key,0,11) == "umiestnenie") {
        $keyData = explode("-",$key);
        if(isset($gameData[$keyData[1]])) {
            $gameData[$keyData[1]] += [$keyData[2] => $value];
        } else {
            $gameData += [$keyData[1] => [$keyData[2] => $value]];
            $gameData[$keyData[1]] += ["id_person"=> $personID];
        }

    }

}




$gameCreated = true;
//creating games info
foreach($gameData as $key => $gameSpecific) {
    $gameUpdate = $mysql->insertInto("umiestnenia",$gameSpecific);

}

if($gameCreated && isset($personID)) {
    $_SESSION["success"] = true;
    $_SESSION["message"] = "Data were created successfully!";
    movePage(200,"/z2");
} else {
    $_SESSION["success"] = false;
    $_SESSION["message"] = "Data were not created!";
    movePage(400,"/z2");
}
