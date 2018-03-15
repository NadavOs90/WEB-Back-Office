<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 

include("script/loginCheck.php"); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daily Report2</title>
        <link rel="stylesheet" type="text/css" href="css/formDesign.css">
        <script src="script/formValidation.js"></script>
    </head>
    <body>
        <?php print_r($_GET);
        
        if(isset($_GET['entryDate'])){
            $eDate = $_GET['entryDate'];
            $posID=$_GET['posID'];
            

            
            
            
        }
            
?>
        <form  class="forms" action="DailyReport3.php" onsubmit="return validateDaily2()" method="get">
                <fieldset>
                    <input type="date" id="eDate" name="entryDate" style="display:none" value="<?php echo $eDate ?>"  ><br>
                    <input type="number" id="eDate" name="posID" style="display:none" value="<?php echo $posID ?>" ><br>

                    Cash Counted - In Envelope <br>
                    <input type="number" id="cash" name ='cash' required><br>
                    Credit Income <br>
                    <input type="number" id="credit" name ='credit' required><br>
                    <div style="display: none">
                    Were there Expenses? <br>
                    <input type="radio" name="expense" value="1" disabled="true" >Yes<br>
                    <input type="radio" name="expense" value="0"  disabled="true">No<br>
                    </div>
                </fieldset>
             <input type="submit" value="Submit">
             <input type="reset">
        </form>
    </body>
</html>
