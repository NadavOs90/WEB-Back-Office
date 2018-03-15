<?php
   
if(session_id() == '') {
    session_start();
}

if(!isset($_SESSION["login_user"]) && !isset($_COOKIE["username"])){
    header("location: login.php");
}
else{
    if(!isset($_SESSION["login_user"])){
        $_SESSION["login_user"] = $_COOKIE["username"];
        $_SESSION["userid"] = $_COOKIE["userid"];
        $_SESSION["fname"] = $_COOKIE["fname"];
        $_SESSION["lname"] = $_COOKIE["lname"];
    }
    $userID = $_SESSION["userid"];
    $username = $_SESSION["fname"]." ".$_SESSION["lname"];
}

