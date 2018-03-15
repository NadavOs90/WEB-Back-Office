<?php 
include 'script/phpSqlConnectScript.php'; 
include 'script/phpFunctions.php';
include 'script/loginCheck.php';
$result = getFullTableFromPrecedure("getPosesForUserID",$userID,true);
  $json_array = json_encode($result);
?>
<script>
    var posArray = <?php echo $json_array; ?>;
</script>
<html>
   
    <head>
        <title>PoS Update / Create</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/formDesign.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="script/formValidation.js"></script>
        <script src="script/FormAutoComletion.js"></script>


    </head>
    <body>
        <div>
            
            <h2>Choose PoS to Update or "New PoS" to create a new one </h2>

            <form id = "Form" name="Form" class="forms">
                Choose PoS:<br>
                <select id="pos" name="choosePos"  onchange="updatePosAccordingToChoice(posArray)" required>
                    <option value="default" selected>Select PoS</option>   

                    <?php  echoPartialOptionsUsingProcedureWithActiveColouring("getPosesForUserID",$userID,0,1,true,7); ?>
                    <option value="new" >Add New PoS</option>   

                </select> <br> 
                PoS Name: <br>
                <input id="posName" type="Text" name="posName"  disabled><br>
                <br>
                
                  Choose Currency:<br>
                 <select id="cur" required disabled>
                 <option value="default" selected>choose Currency</option>   
                 <option value="EUR">EUR</option>
                 <option value="SEK">SEK</option>
                 <option value="GBP">GBP</option>
 				  </select> <br> <br>
    			
                 PoS Active:<br>
                 <select id="active" name="Active" required disabled>
                 <option value="default" selected>Yes/No</option>   
                 <option value="1">Yes</option>
                 <option value="0">No</option>

                </select> <br> <br>
              
                 
                Choose country:<BR>
                <select id="country" name="country" required disabled>
                 <option value="default" selected>Choose Country</option>   
                 <?php  echoOptionsFromFullTableQuery('Countries',2,0); ?> 
 				  </select> <br> <br>
               
                Choose Office:<BR>
                <select id="office" name="office" required disabled>
                 <option value="default" selected>Choose Office</option>   
                 <?php  echoOptionsFromFullTableQuery('Offices',0,1);?>
                 
 				  </select> <br> <br>
               
               
                Vat(%) <br>
                <input type="number" id ="vat" name="vat" min =0 required disabled><br>
               
               
                 <input id ="submit" type="submit" value="Submit" formaction="posUpdate.php" disabled>
                <input type="reset">
            </form>

        </div>
    </body>
</html>