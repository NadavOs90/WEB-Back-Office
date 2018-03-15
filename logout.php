<!DOCTYPE html>

<html >
<?php 
    include("script/phpSqlConnectScript.php"); 
    include("script/phpFunctions.php");
    session_start();
?>
<head>
  <meta charset="UTF-8">
  <title>Logging out</title>
  <link rel="stylesheet" type="text/css" href="css/formDesign.css">
</head>

<body>

    <?php
        // remove all session variables
        session_unset(); 
        // destroy the session 
        session_destroy();
        
        $past =  time() - 3600;
        setcookie("username", "", $past);
        setcookie("logged_in", "", $past);
        setcookie("PHPSESSID", "", $past);
        setcookie("userid" ,"", $past);
        setcookie('fname' ,"", $past);
        setcookie('lname' ,"", $past);
        
        echo "Logged out"; 
        header("location: index.php");
    ?>
  
  
</body>
</html>
