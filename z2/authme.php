<?php

require_once("Auth.php");
session_start();
\IIA\Auth::logIn($_POST["username"],$_POST["password"]);