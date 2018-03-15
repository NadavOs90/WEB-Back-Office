<?php
//echo "loaded";

function proccessEmployeesPostDATA(){
    $arr = array();
    $i=0;
    foreach ($_POST as $key => $value){
        if(is_array($value)){
            foreach($value as $v ){
            $arr[$i][$key]=$v;
             $i++;
            }
        }
        $i=0;

        
    }
    foreach($arr as $record){
       // print_r($record);
       $query = insertRecord($record,"EmployeeDailySummeries");
      // echo $query."<BR>";
       $db = connectToDB();
       runquery($query, $db);
    }
    
}
        
function insertRecord($copyArr,$tableName){
       return upsertDatabaseWithPos($copyArr,$tableName);

}
        


function manageDailyReportPostProccesingFunction(){
    echo " im here"; 
    $unneededFieldsArr = array('empNum');
      HandleSqlFromPost("userID",'users',$unneededFieldsArr);
    insertOnlyFromGet("entryDate","DailySummeryReport",$unneededFieldsArr);
}



function ManagePhpPostProccecingFunction(){
      $unneededFieldsArr = array('availblePoses','menuCheckboxes','submit');
      HandleSqlFromPost("userID",'users',$unneededFieldsArr);
   
}
function manage2phpPostProccecingFunction(){
      handleSqlFromPostmultiToMulti("userID",'MenuPremissionsTable','menuCheckboxes'); //update/insert to MenuPremmisions Table

handleSqlFromPostmultiToMulti("userID",'Controls','officeCheckBoxes'); //
echo "<H2> databse Updated Seccesfully</H2>";

      
}

function employeePostProccecing(){
      $unneededFieldsArr = array('availblePoses','updateOrNew');
      HandleSqlFromPost("employeeID",'Employees',$unneededFieldsArr);
      handleSqlFromPostmultiToMulti("employeeID",'WorksIn','availblePoses');
}
function handleSqlFromPostmultiToMulti($keyName,$tableName,$arrForMulti){
    if(isset($_POST[$keyName])){  

    $arr=$_POST[$arrForMulti];
   // echo "multiToMulti Arr Name $arrForMulti : <BR>";
    //var_dump($arr);
    //echo "<BR><BR>";
 deleteAndInsertToTable($arr,$tableName,$_POST[$keyName],$keyName);
    }
}


function  deleteAndInsertToTable($arr,$tableName,$keyVal,$keyName){
    $db= connectToDB();
    if($keyVal!=-1){
    $deleteQuery = "DELETE FROM $tableName Where $keyName='$keyVal'";
    //echo "delete Query is: ".$deleteQuery."<BR>";
    runquery($deleteQuery, $db);
    
    foreach ($arr as $kioskID) {
    $insertQuery = "INSERT INTO $tableName VALUES('$keyVal','$kioskID');";
   // echo "Insert Query is:   $insertQuery<BR>";
    runquery($insertQuery, $db);
    
    //$result = $db->rawQuery($insertQuery);
    //echo $result;
    //echo $query;
    //echo "<BR><BR>";
    }
    }
}

function creatAscArray($flatArr,$k){
    $arr=array();
    foreach ($flatArr as $v) {
        $arr= array($k=>$v);
        
        
    }
    
}


function posPostProccecing(){
    $unneededFieldsArr = array('submit','reset');
 HandleSqlFromPost("posID",'Poses',$unneededFieldsArr);
    
}   


function HandleSqlFromPost($keyName,$tableName,$unneededValuesArr){
    $query="";
if(isset($_POST[$keyName])){
    $keyname =  $_POST[$keyName];
    if($keyname==-1){
        array_push($unneededValuesArr, $keyName);
        $query=insertToTable ($tableName, $unneededValuesArr, $keyName);
    }
    else{
        array_push($unneededValuesArr, $keyName);

        $query=updateTable($tableName,$unneededValuesArr,$keyName,$_POST[$keyName]);
       }

       // echo "<BR> final Query $query <BR>";
         //           echo "IMHERE323";

        $db = connectToDB();
        runquery($query, $db);
    }
    
}

function insertOnlyFromGet($keyName,$tableName,$unneededValuesArr){
    $query="";
if(isset($_GET[$keyName])){

    $keyname =  $_GET[$keyName];
       // array_push($unneededValuesArr, $keyName);
        $query=insertToTableGet ($tableName, $unneededValuesArr, $keyName);

 // print_r($query);        
          //      echo "i'm here as well!!!  $keyName";

        $db = connectToDB();
runquery($query, $db);
    }
    
}
    

      function updateTable($tableName,$unneededValuesArr,$keyName,$keyValue){
                $copyArr = removeUnneededValuesFromPost($_POST,$unneededValuesArr);
               // print_r($copyArr);
                $query = createUpdateQueryFromAscArrayOfValuesAndKey($tableName,$copyArr,$keyName,$keyValue);
               return $query;
          //     echo "<BR> <BR>automated Update Query: <BR>";
            //    print_r($query);
            
            
            
        }
        function createUpdateQueryFromAscArrayOfValuesAndKey($tableName,$ascArr,$keyName,$keyValue){
            $part1 = "UPDATE $tableName SET ";

            $part3 = " WHERE $keyName = '$keyValue'";
            
            $part2 = createFieldAssignmentQueryFromascArr($ascArr,$keyName);
            
            $query =  $part1.$part2.$part3;
            return $query;
                
        }
        
        function createFieldAssignmentQueryFromascArr($ascArr,$keyName){
            $str="";
            foreach ($ascArr as $key => $value) {
                $str.=" $key = '$value' ,";
                
            }
            //print_r($str);
            $newStr=rtrim($str, ",");
            //print_r($newStr);
            return $newStr;
            
        }


function insertToTableGet($tableName,$unneededValuesArr,$checkPostKey){
    //echo "<BR> i'm here"; 
    if(isset($_GET[$checkPostKey])){
    $copyArr = removeUnneededValuesFromPost($_GET,$unneededValuesArr);
  // print_r($copyArr);
   return upsertDatabaseWithPos($copyArr,$tableName);
        
    }
     
    
}
function insertToTable($tableName,$unneededValuesArr,$checkPostKey){
    //echo "<BR> i'm here"; 
    if(isset($_POST[$checkPostKey])){
    $copyArr = removeUnneededValuesFromPost($_POST,$unneededValuesArr);
  // print_r($copyArr);
   return upsertDatabaseWithPos($copyArr,$tableName);
        
    }
     
    
}
function removeUnneededValuesFromPost($arr,$unneededValuesArr){
    $ar = array();
    foreach($arr as $key => $value){
        if(keyOK($key,$unneededValuesArr)){
            $ar[$key] = $value;
        }
        
       
    }
    return $ar;
    
    
    
}

function keyOK($key,$arr){
    foreach($arr as $a){
        if($a==$key) return false;
    }
    return true;
}
function         upsertDatabaseWithPos($ascArr,$tableName){
    //$db = connectToDB();
    $query = buildInsertQueryFromValueAssArryAndTableName($ascArr,$tableName);
  //  print_r($query);
    // echo $query;
    return $query;
}



function buildInsertQueryFromValueAssArryAndTableName($ascArr,$tableName){
    $startStr = "INSERT IGNORE INTO ";
    $columnNames = getcolumnsStr($ascArr);
    $columnValues = getValuestr($ascArr);
    $values = " VALUES";
    
    $q = $startStr.$tableName.$columnNames.$values.$columnValues.";";
  //  echo "<BR><BR><BR>thats the string: " .$q;
    return $q;
}

function getcolumnsStr($arr){
    return getStringBetweenBrakcetsWithOrWithoutMerchaot($arr,0);
}

function getValuestr($arr){
    return getStringBetweenBrakcetsWithOrWithoutMerchaot($arr,1);
}
function getStringBetweenBrakcetsWithOrWithoutMerchaot($array,$keyFlag){
   // echo "i'm in get string<BR>";
   // echo "flag is ". $keyFlag;
    $str = '(';
foreach ($array as $key => $value) {
    switch ($keyFlag){
        case 1:{
           // echo " Value: ".$value . "<BR>";
           $str.="'" ;
          $str.=$value;
           $str.="'" ;
           $str.=",";
        break;
        }
        case 0:{
          $str.=$key;
           $str.=",";
        }   
    }
}
//echo "<BR> thats my str: ".$str;
    $str=rtrim($str,",");
   
    $str.=')';
    // echo "<BR> thats my trimmed str: ".$str;
return $str;

}

function removeCommaAtEndIfExist($s){
    if(substr($s,-1)==","){
        
    }
    
    
}
