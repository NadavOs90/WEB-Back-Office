<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
--> <?php
       // print_r($_GET);
        include 'script/phpSqlConnectScript.php'; 
        include 'script/phpFunctions.php';
        include 'script/loginCheck.php';
        include 'script/functionsForEmployeeDailyReport.php';
        include 'script/postFormProccesingAndDatabseUpdating.php';
        manageDailyReportPostProccesingFunction();
        $totalNeeded = $_GET['total'];
        $neededEmployees = $_GET['empNum'];
        $posID = $_GET['posID'];
        $posName = getPosNameFromID($posID);
        $eDate = $_GET['entryDate'];
        ?>
    <script>
    var totalNeeded = parseInt(<?php echo $totalNeeded ?>);
    var totalInputted =0;
    </script>
    
<html>
    <head>
        <meta charset="UTF-8">
        <title>Employee Daily Sales</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/formDesign.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="script/formValidation.js"></script>
        <script src="script/FormAutoComletion.js"></script>
    </head>
    <body>
        <div id ="floatingSummery">
            <h3>Live Summery</h3> 
        <h4> Actual Income: <?php echo $totalNeeded?> </h4>
        <h4> Employee Sales: <span id="currentMoney"> 0 </span> </h4>
       </div>
           
        
        <form name="Form" action="DailyReport.php" onsubmit="return validateDailyEmpForm()" method="POST">
           
            do you Want To Input working hours information: <select id="whSelect" onchange="toggleHours()">
                <option value ="1" defult> Yes</option>
                <option value = "0">No </option>
            </select>
          <p > please input the personal information for the <?php echo $neededEmployees ?> employees that worked at <?php echo $posName;?> on the <?php echo $eDate ;?> </p>

 <?php
       for($i=0 ;$i<$neededEmployees;$i++){
           echoEmployeeSelectionBox($i,$posID,$eDate);
       }
        ?>
          <div id ="errorDIV"> </div><BR>
            <input type="reset" value="Reset input" />
            <input type="button" value="return" />
            <input type="submit" value="Check And Submit" name="Submit" /> 
            </form>
    </body>
</html>
