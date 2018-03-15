
<?php 
//echo "POST: ";
//print_r($_POST);
//echo "<BR>GET: ";
//print_r($_GET);
//echo "<BR>";
include 'script/loginCheck.php'; 
include 'script/phpSqlConnectScript.php'; 
include 'script/phpFunctions.php';
include 'script/loginCheck.php';
include 'script/postFormProccesingAndDatabseUpdating.php';
proccessEmployeesPostDATA();



?>
<html>
    <head>
        <title>Daily Report</title>
        <link rel="stylesheet" type="text/css" href="css/formDesign.css">
        <script src="script/formValidation.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <h2>Please fill in the form all parts are required</h2>
            <form class ="forms"  action="DailyReport2.php" onsubmit="return validateDaily1()" method="get">
                <fieldset>   
                 Date:<br> <input type="Date" id="date" name="entryDate"><br>
                 Location:<br><select id="location" name="posID">
                      <option value="default" selected>Select PoS</option>   

                    <?php  echoPartialOptionsUsingProcedure("getPosesForUserID",$userID,0,1,true); ?>
              
                 </select> <br>
                </fieldset>
                <input id="submit" type="submit" value="Submit">
            </form>

        </div>
        <script>
            defineMaxMinToInputObjectsByOffsetFromToday("date",0,"max");
            defineMaxMinToInputObjectsByOffsetFromToday("date",-30,"min");

            </script>
    </body>
</html>
