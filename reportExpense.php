<?php include("script/loginCheck.php"); ?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/formDesign.css">
        <script src="script/formValidation.js"></script>
    </head>
    <body>
        <div>Report Expense</div>
        <form>
   		invoice number <br>  <input type="text" name="inNum" ><br>

       Shop Name:<br><select name="vendor" required>
                 <option value="default" selected></option>   
                 <option value="cd">BR</option>
                 <option value="exp">HR</option>
                 <option value="sal">starbacks</option>
                
                 </select>
                <br>
                <br>
        what was purchased:
        		<input type="checkbox" name="p1" value="paper Tower"> paper Tower<br>
			  	<input type="checkbox" name="p2" value="cleaning products"> cleaning products <br> 
			  	<input type="checkbox" name="p3" value="employee Motivation products"> employee Motivation products<br>
			 
        Credit Card Payment amount <br>  <input type="number" name="inNum" required ><br>
		Bank transfer amount: <br>  <input type="number" name="inNum" required ><br>
                 
                <input type="submit" value="Submit" formaction="index.html">
                <input type="reset">
            </form>    
                

    </body>
</html>
