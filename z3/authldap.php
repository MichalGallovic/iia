<?php
require_once("redirect.php");
require_once("Auth.php");
require_once('MysqlMachine.php');
session_start();
use IIA\Auth as Auth;
date_default_timezone_set('Europe/Bratislava');

$database = include "config.php";
$mysql = new \IIA\MysqlMachine($database["db_name"],
    $database["host"],$database["username"],$database["password"]);

$username = 'uid='.$_POST["username"].', ou=People, DC=stuba, DC=sk';
$password = $_POST["password"];
$ldapconn = ldap_connect("ldap.stuba.sk") or die("Could not connect to LDAP server.");

if($ldapconn) {
    $ldapbind = ldap_bind($ldapconn, $username, $password);
    if($ldapbind) {
        $result=ldap_search($ldapconn, "ou=People, DC=stuba, DC=sk","uid="."xgallovicm");
        $entries = ldap_get_entries($ldapconn, $result);
        $fullname = $entries[0]['cn'][0];
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["fullname"] = $fullname;
        Auth::logIn();
        $userID = ["username"=>$_POST["username"]];
        $when = ["login_time"=>date('Y-m-d H:i:s', time())];
        $type = ["type"=>"ldap"];
        $loginData = [];
        $loginData += $userID += $when += $type;
        $mysql->insertInto("login_times",$loginData);
        \IIA\movePage(200,"/z3/dashboard.php");
    } else {
        \IIA\movePage(200,"/z3/ldap.php");
    }
}

?>