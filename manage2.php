<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
//print_r($_POST);
if(isset($_POST['userID'])){
    
    $UID=$_POST['userID'];
    $UNAME = $_POST['userName'];
    $NAME = $_POST['firstName']." ".$_POST['lastName'];
   // print_r($NAME);
    echo "<script> var userID = $UID; var userName=\"$UNAME\" </script>";
}
include 'script/loginCheck.php';
include 'script/postFormProccesingAndDatabseUpdating.php';
include 'script/phpSqlConnectScript.php'; 
include 'script/phpFunctions.php';
ManagePhpPostProccecingFunction();

if($UID==-1){
    
    $UID = getunuiqeSingleValueFromTable('users','userID','userName',$UNAME);
}
$officesForUsers = getFullTableFromPrecedure("officesForUsers",$userID,false);
$menuItemsUsers = getFullTableFromPrecedure("menuItemsForUsers",$userID,false);

    $officesForUsersJson = json_encode($officesForUsers);
    $menuItemsUsersJson = json_encode($menuItemsUsers);
?>
<html>
    <script>
        
    var officesForEmployeesCheckBoxArr = <?php echo $officesForUsersJson; ?>;
    var menuPremissionsForUsers = <?php echo $menuItemsUsersJson; ?>;
    
    </script>
    <head>
        <title>Premmision Managment</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/formDesign.css">

        <script src="script/formValidation.js"></script>
        <script src="script/FormAutoComletion.js"></script>    </head>
    <body>
      
        <form  name="Form" class="forms" action="manage.php" method="post">
            <H3> Please choose relevant offices and permissions for the user:<BR><BR> <?php echo $NAME ?> </h3> 
            <input type="hidden" name="userID" value="<?php echo $UID ?>" />
            <h3> Choose Relevant Offices </h3>
            <?php echoPartialCheckBocesUsingProcedure("allOffices",$userID,0,1,false,"officeCheckBoxes[]") ?>
            <h3> Choose Accessible Menu Items </h3>
            <?php echoPartialCheckBocesUsingProcedure("allMenuItems",$userID,0,1,false,"menuCheckboxes[]") ?>

            <input type="submit" id="submit" value="Submit" name="submit" />
            <input type="reset" value="Reset" name="reset" />
          
            
            
            
            
            
            
            
            
            
            
        </form>
                    <script> 
            updateCheckBoxes(userID);
            enableProperties();
            
            </script>

       
    </body>
</html>
