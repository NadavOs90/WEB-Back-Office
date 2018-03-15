<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
include 'script/loginCheck.php';
include 'script/postFormProccesingAndDatabseUpdating.php';
include 'script/phpSqlConnectScript.php'; 
include 'script/phpFunctions.php';
manage2phpPostProccecingFunction();

$allUsers = getFullTableFromPrecedure("allUsersWithAllDetails",$userID,false);
$officesForUsers = getFullTableFromPrecedure("officesForUsers",$userID,false);
$menuItemsUsers = getFullTableFromPrecedure("menuItemsForUsers",$userID,false);

    $officesForUsersJson = json_encode($officesForUsers);
    $menuItemsUsersJson = json_encode($menuItemsUsers);
    $allUsersJason = json_encode($allUsers);
?>
<html>
    <script>
        
    var officesForEmployeesCheckBoxArr = <?php echo $officesForUsersJson; ?>;
    var menuPremissionsForUsers = <?php echo $menuItemsUsersJson; ?>;
    var allUsers = <?php echo $allUsersJason; ?>;

    </script>
    <head>
        <title>Premmision Managment2</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/formDesign.css">

        <script src="script/formValidation.js"></script>
        <script src="script/FormAutoComletion.js"></script>    </head>
    <body>
        <form  name="Form" class="forms" action="manage2.php" method="post">
            <h3> Add Users / Update User Information  </h3>
            <h4> Choose User </h4>
            <input type="text" id="userID" name="userID" value="" onchange="updateFieldsFromIDField(allUsers,'userID','selectID')"  size="5" />
            
            <select id="selectID"  onchange="updateAllFieldsUsingSelectField(allUsers,'userID','selectID')" >
                               <option value="" > Choose User </option>

 <?php  echoPartialOptionsUsingProcedure("AllUsers",$userID,0,1,false) ?>
                <option value="-1" > New User </option>
            </select>
            <br>
            Username:<BR> <input type="text" id="userName" name="userName" placeholder="Add Username here" /><br>
                       Password:<BR>  <input type="text" id="password" name="password" placeholder="Password Here" /><br>
                       First Name:<BR><input type="text" id="firstName" name="firstName" placeholder="Add First Name here" /><br>
                       Last Name<BR>:<input type="text" id="lastName" name="lastName" placeholder="Add Last Name Here" /><br>
                       Email:<BR><input type="text" id="email" name="email" placeholder="Add Email Here" /><br>
            
           
            <input type="submit" id="submit" value="continue" name="submit" />
            <input type="reset" value="Reset" name="reset" />
            
            
            
            
            
            
            
            
            
            
            
        </form>
        
       
    </body>
</html>
