<!DOCTYPE html>
<?php
    include 'script/loginCheck.php';
    include 'script/phpSqlConnectScript.php'; 
    include 'script/phpFunctions.php';
    $ans['output'] = "";
    $startDate = 0;
    $endDate = 0;
    $lowIndex = -3;

    if (isset($_GET['startDate'])) { 
        $_SESSION['statFlag'] = 1;
        $db = connectToDB();
        $lowIndex = $_GET['lowIndex'];
        $startDate = mysqli_real_escape_string($db,$_GET['startDate']);
        $endDate = mysqli_real_escape_string($db,$_GET['endDate']);
        
        $query = "select date(entryDate),firstName,lastName,salesAmount
                from Employees join EmployeeDailySummeries on Employees.employeeID = EmployeeDailySummeries.empID
                where EmployeeDailySummeries.entryDate >= '$startDate' && EmployeeDailySummeries.entryDate <= '$endDate'
                order by EmployeeDailySummeries.entryDate
                limit $lowIndex,3";
        $countQuery = "select count(*) from Employees join EmployeeDailySummeries on Employees.employeeID = EmployeeDailySummeries.empID
                where EmployeeDailySummeries.entryDate >= '$startDate' && EmployeeDailySummeries.entryDate <= '$endDate'
                order by EmployeeDailySummeries.entryDate";

       $arr =  getQueryAsArray($countQuery,$db);
       closeDB($db);
        $db = connectToDB();

       $totalRows = $arr[0][0];
        echo "<BR><BR>";

       $result = getQueryAsArray($query,$db);
       $ans['count'] = count($result);
       $result = getReadaleArray($result);
        $ans['output'] =$result;
    }
    else{ $_SESSION['statFlag'] = 0;}

?>
<script> 
var sDate = <?php echo $startDate;?>;
var eDate = <?php echo $endDate;?>;
var lI = <?php echo $lowIndex;?>;
var maxSize = <?php echo $totalRows;?>

</script>

<html>
    <head>
        <title>Employee Statistics</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="dynamicCss/css/dynamicDesign.css">
         <script src="script/statisticsFunctions.js"></script>
         <script src="script/formValidation.js"></script>

    </head>
    <body>
        <form class ="forms" action="getDataStatistics.php" method="get">
            <input type="number" id="lI" style='display: none' value='<?php echo $lowIndex?>' name="lowIndex">
            <input type="number" id="max" style='display: none' value='<?php echo $totalRows?>' name="highIndex">
            
            <label for="startDate">Select Start Date</label>
            <input type="date" id="startDate" name="startDate" value="<?php echo $startDate; ?>"  >
            
            <label for="endDate">Select end Date</label>
            <input type="date" id="endDate" name="endDate" value="<?php echo $endDate; ?>" >
            <br>
            <input type="submit"  value="Select" onclick="goToStart()" >
            <br>
            <?php if (isset($_GET['endDate'])){
                     echo '<input type="submit" value="First" onclick="goToStart()" >';
                     echo '<input type="submit" value="Prev" onclick="updateOffset(-3)" >';
                     echo '<input type="submit"  value="Next" onclick="updateOffset(3)" >';
                     echo '<input type="submit" value="Last" onclick="goToEnd()" >';
                 }
            ?>

             <?php
             echo "<BR>";
             $toPrint = "";
             if(is_array($ans['output'])){
             foreach ($ans['output'] as $arr) {
                 foreach ($arr as $value) {
                     $toPrint .= $value;
                     $toPrint .= " ";
                 }
                 $toPrint .= "\n";
             }}
                echo nl2br($toPrint);
             ?>
        </form>
        
        <script>
             defineMaxMinToInputObjectsByOffsetFromToday("startDate",0,"max");
             defineMaxMinToInputObjectsByOffsetFromToday("endDate",0,"max");
        </script>
    </body>
</html>
