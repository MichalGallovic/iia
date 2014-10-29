<?php
session_start();
require_once("redirect.php");
$validateArray = explode("-",$_POST["date"]);
if(count($validateArray) != 3) {
    $_SESSION["message"] = "Zadajte spravny datum alebo vo formate den-mesiac-rok";
    \IIA\movePage(200,"/pisomka1");
}
$validDay = $validateArray[0];
$validMonth = $validateArray[1];
$validYear = $validateArray[2];
if(!checkdate($validMonth, $validDay, $validYear)) {
    $_SESSION["message"] = "Zadajte spravny datum alebo vo formate den-mesiac-rok";
    \IIA\movePage(200,"/pisomka1");
}

$whichDay =[0=>"Nedela", 1=>"Pondelok", 2=>"Utorok", 3=>"Streda",4=>"Stvrtok",5=>"Piatok",6=>"Sobota"];

$date = strtotime($_POST["date"]);
$newformat = date("d-m-Y",$date);
$dateArray = explode("-",$newformat);
$day = (int)$dateArray[0];
$month = (int)$dateArray[1];
$year = (int)$dateArray[2];

$dayCipher = $day % 7;
$monthCipher = 0;
switch($month) {
    case 1:
        $monthCipher = 0;
        break;
    case 2:
        $monthCipher = 3;
        break;
    case 3:
        $monthCipher = 3;
        break;
    case 4:
        $monthCipher = 6;
        break;
    case 5:
        $monthCipher = 1;
        break;
    case 6:
        $monthCipher = 4;
        break;
    case 7:
        $monthCipher = 6;
        break;
    case 8:
        $monthCipher = 2;
        break;
    case 9:
        $monthCipher = 5;
        break;
    case 10:
        $monthCipher = 0;
        break;
    case 11:
        $monthCipher = 3;
        break;
    case 12:
        $monthCipher = 5;
        break;
}

$last2ciphers = $year % 100;
$yearCipher = ($last2ciphers + ($last2ciphers/4)) % 7;
$first2ciphers = $year / 100;
$centuryCipher = (($first2ciphers % 4) - 3) * (-2);

$finalNumber = ($dayCipher + $monthCipher + $yearCipher + $centuryCipher)%7;
if($month < 3) {
    $finalNumber--;
    $finalNumber = $finalNumber % 7;
}
//var_dump($dateArray,$dayCipher,$monthCipher,$yearCipher,$centuryCipher,$finalNumber);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IIA Pisomka1</title>
</head>
<body>
    <span>Zadany den je <?php echo $whichDay[$finalNumber] ?></span>
</body>
</html>