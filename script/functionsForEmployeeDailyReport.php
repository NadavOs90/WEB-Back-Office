<?php

function echoEmployeeSelectionBox($i,$posID,$eDate){
    echo $eDate;
    echo "<div id=\"employeeDiv{$i}\" class='employeeDivs' >" ;
    echo "<input type=\"date\" name=\"entryDate[]\" min=0 value=\"$eDate\" style=\"display:none\" /> \n";

    echo "<input type=\"number\" name=\"posID[]\" min=0 value=\"$posID\" style=\"display:none\" /> \n";
    echo "<BR>";
    echo "Choose Employee:";

    echo "<select name=\"empID[]\" onChange=\"updateEmployeeLists(this)\"> \n";
    echo"<option value=-1 > Choose Employee </option>";
    echoPartialOptionsUsingProcedure("getActiveEmployeesForPosPartialDetailsMergedName",$posID,0,1,true);
    echo "</select ><BR>\n";
    echo "Amount Sold:<input type=\"number\" name=\"salesAmount[]\" min=0 onfocusout=\"updateAmount()\" />\n ";
        echo "<BR>";
        echo "<div name=\"wh\">";
        echo "Shift Start Time:<input type=\"time\" name=\"entryTime[]\" value=\"10:00\" max=\"19:00\" min=\"07:00\" />\n ";
        echo "<BR>";
        echo "Shift End Time:<input type=\"time\" name=\"endTime[]\" value=\"17:00\" max=\"23:59\" min=\"12:00\"  />\n ";
    echo "</div></div  >\n\n\n\n" ;

    
    
    
    
    
    
}
function getPosNameFromID($posID){
   $value= getunuiqeSingleValueFromTable("Poses","posName","posID",$posID);
   return $value;
}

