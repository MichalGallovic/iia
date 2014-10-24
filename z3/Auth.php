<?php namespace IIA;


class Auth {

    public static function isLoggedIn() {
        if(isset($_SESSION["isLoggedIn"])) {
            if($_SESSION["isLoggedIn"]) {
                return true;
            }
        }

        return false;
    }

    public static function logIn() {
        $_SESSION["isLoggedIn"] = true;
    }

    public static function logout() {
        unset($_SESSION["isLoggedIn"]);
    }

}