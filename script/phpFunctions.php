<?php

function echoMenuAccordingToPremmisions($userID){
     $db = connectToDB();
   $query = buildMenuQuery($userID);
    $menuItems = getQueryAsArray($query,$db);
    //print_r($menuItems);
    //print_r($menuItems);
   // echo "<br> whazzap";
    foreach($menuItems as $item){
        if($item[2]==1){
    echo "<a href='$item[1]' target=\"iframe_content\">$item[0]</a><br><br>";  
        }
    
        }
    
closeDB($db);
    
    
    
}
 
function buildMenuQuery($userID){
    return "call getMenuItemsForUser($userID) ";
    
}
function getQueryAsArray($query,$db){
   $rArr =array() ;

   $result = runquery($query,$db);
   while($row = mysqli_fetch_array($result)){
       array_push($rArr, $row);  
   }
   mysqli_close($db);    

   return $rArr;
    
}

function runquery($query,$db){
   $result =  mysqli_query($db, $query);
    if(!$result){
        die("database query failed: ".mysqli_error($db). mysqli_errno($db));
        
        
        
    }
    
    return $result;
}


function getFullTableFromPrecedure($pracedureName,$userID,$needsVariable){
     $db = connectToDB();
    $query = buildProcedureQuery($pracedureName,$userID,$needsVariable);
    //echo $query;
    return getQueryAsArray($query,$db);
}

function buildFullSelectQueryForTable($tableName){
   return "SELECT * FROM $tableName";
    
}
function echoOptionsFromFullTableQuery($tableName,$valueIndex,$nameIndex){
     $db = connectToDB();
         echo "connected";
         $query = buildFullSelectQueryForTable($tableName);
         $GLOBALS['activePos'] = $resultArr[3];
         $resultArr = getQueryAsArray($query,$db);
        foreach($resultArr as $lineArr){
        echo" <option value=\"$lineArr[$valueIndex]\">$lineArr[$nameIndex]</option>";
        closeDB($db);
}
}

function echoPartialOptionsUsingProcedureWithActiveColouring($pracedureName,$userID,$valueIndex,$nameIndex,$needsVariable,$ActiveColIndex){
         $db = connectToDB();
         $query = buildProcedureQuery($pracedureName,$userID,$needsVariable);
         echo $query;
         $resultArr = getQueryAsArray($query,$db);
        foreach($resultArr as $lineArr){
            $str = " <option value=\"$lineArr[$valueIndex]\" ";
            if($lineArr[$ActiveColIndex]==1){
                $str.="class=\"Active\" ";
            }
            $str.=">$lineArr[$nameIndex]</option>";
            echo $str;
        }
         closeDB($db);
}

function echoPartialOptionsUsingProcedure($pracedureName,$userID,$valueIndex,$nameIndex,$needsVariable){
         $db = connectToDB();
         $query = buildProcedureQuery($pracedureName,$userID,$needsVariable);
        // echo $query;
         $resultArr = getQueryAsArray($query,$db);
        foreach($resultArr as $lineArr){
            echo" <option value=\"$lineArr[$valueIndex]\">$lineArr[$nameIndex]</option> \n";
        }
         closeDB($db);
}

function buldPartialQueryAccordingToTableNameAndUser($tableName,$userID){
  switch($tableName){
     case 'poses': {
         
     }  
  }
    
    
    return "SELECT * FROM $tableName";
    
}

function buildProcedureQuery($procedureName,$var,$needsVariable){
    if($needsVariable==TRUE){
            return "call $procedureName($var)";

    }
    else {
                    return "call $procedureName()";

    }
}

function  echoPartialCheckBocesUsingProcedure($pracedureName,$userID,$valueIndex,$nameIndex,$needsVariable,$checkBoxesID){
     $db = connectToDB();
         $query = buildProcedureQuery($pracedureName,$userID,$needsVariable);
         $resultArr = getQueryAsArray($query,$db);
        foreach($resultArr as $lineArr){
 	echo "<input type=\"checkbox\" name=\"$checkBoxesID\" id=\"$lineArr[$valueIndex]\" value=\"$lineArr[$valueIndex]\" disabled> $lineArr[$nameIndex]<br>\n";

            closeDB($db);
        }
}
function getPOSAvailability($allPoses){
    for($i=0; $i<count($allPoses); $i++){
        $active = $allPoses[$i][7];
        $ans[$allPoses[$i][0]] = $active;
    }
    return $ans;
}

function getunuiqeSingleValueFromTable($tableName,$selectField,$whereField,$valueNeeded){
    $db= connectToDB();
    $query = "select $selectField from $tableName where $whereField = \"$valueNeeded\"";
   //echo $query;
    $arr=getQueryAsArray($query, $db);
    
    return $arr[0][0];
    
}

function getReadaleArray($arr){
    if(count($arr) == 0){
        return "";
    }
    for($i=0; $i<count($arr); $i++){
        $result[$i]['date'] = $arr[$i]['date(entryDate)'];
        $result[$i]['firstName'] = $arr[$i]['firstName'];
        $result[$i]['lastName'] = $arr[$i]['lastName'];
        $result[$i]['amount'] = $arr[$i]['salesAmount'];
    }
    return $result;
}

function nextDataStat(){
    global $ans, $result;
    $out = "";
    for($i=$ans['index']; $i<3 && $ans['count']; $i++){
        foreach ($result[$i] as $value) {
             $out .= $value." "; 
        }
        $out .= "\n";           
    }
    $ans['index'] += 3;
    $ans['output'] = $out;
    return ans;
    /*if(isset($_SESSION['index'])){
            $_SESSION['index'] += 3; 
        }
        else{
            $_SESSION['index'] = 0;
        }*/
}

function lastDataStat(){
    global $ans, $result,$count;
    $ans = "";
    end($result);
    for($i=0; $i<$count%3; $i++){
        $arr = (next($result));
        foreach ($arr as $value) {
             $ans .= $value." "; 
        }
        $ans .= "\n";           
    }

    /*print_r($count);
    if(isset($_SESSION['index'])){
            $_SESSION['index'] = $count - $count%3; 
    }*/
}

function prevDataStat(){
   global $ans, $result;
    $ans = "";
    for($i=0; $i<3; $i++){
        $arr = (prev($result));
        foreach ($arr as $value) {
             $ans .= $value." "; 
        }
        $ans .= "\n";           
    }
    
    
    /*if(isset($_SESSION['index'])){
            $_SESSION['index'] -= 3;
            if($_SESSION['index'] < 0){
                $_SESSION['index'] = 0;
            }
        }
    else{
            $_SESSION['index'] = 0;
        }*/
}

function firstDataStat(){
    global $ans, $result;
    $ans = "";
    reset($result);
    nextDataStat();
    
    /*if(isset($_SESSION['index'])){
            $_SESSION['index'] = 0; 
        }*/
}