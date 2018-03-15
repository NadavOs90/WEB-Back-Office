<?php header("Content-type: text/css; charset: UTF-8");
include 'script/loginCheck.php';
include 'script/phpFunctions.php';
$result = getFullTableFromPrecedure("getPosesForUserID",$userID,true);
$result = getPOSAvailability($result);
?>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 
select <?php 
        
        echo " ";
        $i=0;
        foreach ($result as $key => $value){
           if($result[$key] == 0){
               $ans = '[value='.$key.']';
               if($i>0){
                   $ans = ','.$ans;
               }
               echo $ans;
               $i++;
           }
        }?>
        {
        color: red;
}