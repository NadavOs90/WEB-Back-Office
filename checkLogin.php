<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
        include("script/phpFunctions.php");
        
        $email;
        if(isset($_POST['email']) && isset($_POST['password'])){
            
            $email = $_POST['uName'];
            $password = $_POST['password'];
            $userID = validateLoginDetails($email,$password);
        }else {
            $email="";
            $password ="";
        }
        
        if(!$userID) header("Location: login.php ? email=$email");
        
        ?>
<html>
    <head>
        
        <meta charset="UTF-8">
        <title>Login Check</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
