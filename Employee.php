<?php 
include 'script/phpSqlConnectScript.php';
include 'script/loginCheck.php';
include 'script/postFormProccesingAndDatabseUpdating.php';

include 'script/phpFunctions.php';
employeePostProccecing(); 


$result = getFullTableFromPrecedure("allEmployees",$userID,false);
$result2 = getFullTableFromPrecedure("empIdposIdAndPosNameForAllEmployees",$userID,false);

  $json_array = json_encode($result);
    $json_array2 = json_encode($result2);

?>

<html>
    
    <script>
    var rawArr = <?php echo $json_array; ?>;
    var checkBoxArr = <?php echo $json_array2; ?>;
   


</script>

    
    <head>
        <title>Employee Update / Create</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/formDesign.css">
        <script src="script/formValidation.js"></script>
        <script src="script/FormAutoComletion.js"></script>


    </head>
    <body>
        <div>
            <h2>Please fill in the form all parts are required</h2>
            <form class="forms" name="Form"  onsubmit="return validateEmployee()" action = "Employee.php"  method="post">
                <H3>Action Required:</h3>
                <input type="radio" name="updateOrNew" value="update" onchange="prepareFormAndUpdateUser()"  />
                Update Existing Employee 
                <input type="radio" name="updateOrNew" onchange="prepareFormToInsertNewUser()" value="new" />
                Create New User <br>
                 <div id="chooseEmployeeDiv"> 
                Choose Employee:                <br>
               ID
                <input type="number" id="eId" name =employeeID onchange="populateFromID(rawArr,checkBoxArr)" required>
                <select id ="empName"   onchange="populateEmployeeDetails(rawArr,checkBoxArr)" required>
                 <option value="default" selected>Select Employee</option>  

              <?php  echoPartialOptionsUsingProcedure("allEmployeesForLabel",$userID,0,1,false)?>
                 <option value="-1" >new Employee</option>  

                </select> </div>
                <div id="formBody">
                <br> <br>
                First Name <br>  <input type="Text" id="fName" pattern="[A-Za-z]{15}" name="firstName"><br>
                Last Name <br> <input type="Text" id="lName" name = "lastName" pattern="[A-Za-z]{15}" required><br>

		Employee Status:<br><select id="active" name ="active" required>
                 <option value="default" selected>is PoS Active?</option>   
                 <option value="1">Yes</option>
                 <option value="0">No</option>

                </select> <br> <br>
                
                start Date <br>
                <input type="date" id="sDate" name="startDate" ><BR>
               <div id=eDateDiv>end Date <br>
                <input type="date" id="eDate" name="endDate" ><BR>
               </div>
                Street Address <br>
                <input type="text" id="street" name="address" placeholder="Put Street Address Here" required><BR>
                IBAN <br>
                <input type="number" id="iban" name="iban" required><br>
                   
                Choose country:<BR>
                <select id="country" name="nationality" required disabled>
                 <option value="default" selected>Choose Country</option>   
                 <?php  echoOptionsFromFullTableQuery('Countries',2,0); ?> 
 				  </select> <br> <br>
                <div id="checkBoxes">
                <h3> Active For the following kiosks</h3> <br>

                <?php  echoPartialCheckBocesUsingProcedure("allPoses",$userID,0,1,false,"availblePoses[]")?>
                </div>
 				
                <input type="submit" id="submit" value="Submit"  required>
                <input type="reset">
                </div>
            </form>

        </div>
    </body>
    <script>
        disableProperties();
        document.getElementsByName("updateOrNew")[0].disabled=false;
                document.getElementsByName("updateOrNew")[1].disabled=false;

        defineMaxMinToInputObjectsByOffsetFromToday("sDate",14,"max");
        //defineMaxMinToInputObjectsByOffsetFromToday("eDate",false,10);
        </script>
</html>