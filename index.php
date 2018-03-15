<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    include("script/phpSqlConnectScript.php"); 
    include("script/phpFunctions.php");
    include("script/loginCheck.php");
?>


<html>
    <head>
       
        <link rel="stylesheet" type="text/css" href="css/design.css">
        <title>Jebo GMBH BackOffice Website</title>
        <meta charset="UTF-8">
        <script src="script/navFunctions.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
   
    <body>
        
        <div id="debug" > 
        </div>
        
        <div id="container">
            <div id="title"><h1><b>Jebo GMBH office management</b></h1></div>
            
            <div id="menu" class="sidenav">
                <a href="javascript:void(0)" id="menuIcon" class="closebtn" onclick="closeNav()">&times;</a>
                
                <?php echoMenuAccordingToPremmisions($userID); ?>
                
                           </div>
          
            <div id ="openNav">
            <span id ="menuOpenIcon" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            </div>
             
            <div id="content">
                <iframe src="Home.php" name="iframe_content" seamless>
                </iframe>		
            </div>
            <footer id="bottombar">
                <a href="Home.php" target="iframe_content">Home</a>
                <a class="link" href="logout.php" style="text-decoration:none"><?php echo " ".$username. " (logout) "?></a>
            </footer>
           
        </div>

    </body>
</html>
