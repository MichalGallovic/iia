<?php

namespace IIA;

require_once("redirect.php");

class Auth {

    private static $username = "admin";
    private static $password = "tajneheslo";

    public static function isLoggedIn() {
        if(isset($_SESSION["isLoggedIn"])) {
            return true;
        } else {
            movePage(401,"/z2/login.php");
        }
    }

    public static function logIn($username, $password) {
        if($username == self::$username && $password == self::$password) {
            $_SESSION["isLoggedIn"] = true;
            movePage(200, "/z2");
        } else {
            $_SESSION["success"] = false;
            $_SESSION["message"] = "Bad username or password";
            movePage(200,"/z2/login.php");
        }
    }

    public static function logout() {
        unset($_SESSION["isLoggedIn"]);
        movePage(200,"/z2/login.php");
    }

} 