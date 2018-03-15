<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include("script/loginCheck.php"); ?>
<html>
      <?php //print_r($_GET);
        
        if(isset($_GET['entryDate'])){
              $jsonGet = json_encode($_GET);
              

            $eDate = $_GET['entryDate'];
            $posID=$_GET['posID'];
            $cash =  $_GET['cash'];
            $credit = $_GET['credit'];
            $actualTotal = floatval($cash)+ floatval($credit);
            
            
            
        }
        ?>
    <script>
    var posArray = <?php echo $jsonGet; ?>;
    var aTotal = <?php echo $actualTotal;?>;
</script>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daily Report3</title>
        <link rel="stylesheet" type="text/css" href="css/formDesign.css">
      <script src="script/formValidation.js"></script>
        <script src="script/FormAutoComletion.js"></script>

    </head>
    <body>
        
        <form class="forms" id = "form" onsubmit="return validateDaily3()" action="employeeDailySales.php" method="get">
            <H3> Actual Money Intake </h3>
            <fieldset>
                 
                <input type="text" id="userInputting" name="userInputting" style="display:none" value="<?php echo $userID ?>"  ><br>
                <input type="date" id="eDate" name="entryDate" style="display:none" value="<?php echo $eDate ?>"  ><br>
                <input type="number" id="eDate" name="posID" style="display:none" value="<?php echo $posID ?>" ><br>

                Cash - Nova <br>
                <input type="number" id="cash" name="cash" required><br>
                Credit - Nova <br>
                <input type="number" id="credit" name="credit" required><br>
                Total - Nova <br>
                <input type="number" id="total" name="total" required><br>
                Were there any problems?<br>
                <input type="radio"  value="1" onclick="problems(1)"  required>Yes<br>
                <input type="radio"  value="0" onclick="problems(0)" required>No<br>
                <div id ="problemDiv" style="display: none"> 
                    <textarea name="Comments" form="form">describe the Problems here</textarea> <BR>            
                    missingCash: <input type="number" id="missingCash" name="missingCash" ><br>
                    

            
                </div>
                <H3> How many Employees Worked At This Date?</h3>
                <select name="empNum" size="7" required>
                 <option value="1">1 Employee</option>
                 <option value="2">2 Employee</option>
                 <option value="3">3 Employee</option>
                 <option value="4">4 Employee</option>
                 <option value="5">5 Employee</option>
                 <option value="6">6 Employee</option>

                </select>
            
            </fieldset>
             <input type="submit" id ="submit" value="Employees">
             <input type="reset">
        </form>
    </body>
</html>