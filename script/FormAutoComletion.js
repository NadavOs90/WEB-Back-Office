/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function updatePosAccordingToChoice(fullPosArr){
    var posID = pos.value;
    var valueArr = getSpecificPosDetails(fullPosArr,posID);
    
    
    
    
}

function updateCheckBoxes(uID){
    updateManagmentPHPCheckboxes(uID);
}
function updateAllFieldsUsingSelectField(ascArr,idFieldName,selectFieldID){
   var uID = document.getElementById(selectFieldID).value;
   
    updateAllFieldsUsingAscArr(ascArr,idFieldName,uID);
     var checkBoxIDIndex = 2;
    
    
    

}
  function  updateManagmentPHPCheckboxes(uID){
      updateCheckboxes("officeCheckBoxes[]",uID,officesForEmployeesCheckBoxArr,2);
     updateCheckboxes("menuCheckboxes[]",uID,menuPremissionsForUsers,1);
  }

function updateFieldsFromIDField(arr,uIDfield,selectID){
    var uID = document.getElementById(uIDfield).value;
    document.getElementById(selectID).value =  uID;
    updateAllFieldsUsingAscArr(arr,uIDfield,uID);
    updateManagmentPHPCheckboxes("officeCheckBoxes[]",uID);
    
    
}

function updateCheckboxes(checkBoxesID,uID,arr,checkBoxIDIndex){
    uncheckAllBoxes(checkBoxesID);
   return checkTheBoxesForUID(arr,uID,checkBoxesID,checkBoxIDIndex);
}

function     checkTheBoxesForUID(arr,uID,checkBoxesID,checkBoxIDIndex){
    for(i in arr){
        var sArr = arr[i];///Single Record
        var userIDFromArr = sArr[0];
        if(userIDFromArr == uID){
            var elementArr = document.getElementsByName(checkBoxesID);
            for(j in elementArr){
                var element = elementArr[j];
                var singleCheckBoxID =sArr[checkBoxIDIndex];
                if(element.id==singleCheckBoxID){
                    element.checked=true;
                    break;
                }
                
            }
            
            
        }
        
    }
}

function updateAllFieldsUsingAscArr(ascArr,idFieldName,uID){
          enableProperties();
          if(uID!=-1 && uID!=''){
    var assignmentArr  = getSingleDimArrFromArrAndID(uID,ascArr,idFieldName);// return assignmentArr;
            updateAllFieldsInDocWIthAscKeys(assignmentArr);
     
    }
    else{
        document.getElementById("userID").readOnly=true;
 //document.getElementById("userID").style.display="none";
        emptyAllFields();
       document.getElementById("selectID").value="-1";
       document.getElementById("userID").value="-1";

       document.getElementById("submit").value="Premmisions";
    var r= document.getElementById("userID").value;
       

    }
}

function emptyAllFields(){
    var arr= document.getElementsByName("Form")[0];
    for(var i=0 ;i<7 ;i++){
        arr[i].value="";
    }
    //document.getElementsByName("Form")[0][0].value="";
    }
    
    
    
    




function updateAllFieldsInDocWIthAscKeys(arr){
    for(key in arr){
        var item = document.getElementById(key);
        if(item!==null){
            item.value=arr[key];
            item.disabled=false;
            
        }
    }
    
}

function getSingleDimArrFromArrAndID(uID,ascArr,idFieldName){
    for(i in ascArr){
       if(ascArr[i][idFieldName] == uID){
           return ascArr[i];
       } 
    }
    
    
    
    
    
}
function getSpecificPosDetails(arr,posID){
    if(pos.value ==="-1"){
        submit.value = "Create New Pos";
        enableProperties();
        posName.value =""; 
    country.value ="default";
    cur.value="default";
    office.value ="default";
    vat.value= "";
    active.value = "default";
    expID.value=posID*10;
    }
    for(i in arr){
        if(arr[i][0] == pos.value){
    posName.value =arr[i][1]; 
    country.value = arr[i][2];
    cur.value=arr[i][3];
    office.value = arr[i][5];
    
    vat.value= arr[i][6];
    active.value = arr[i][7];
    submit.value= "Update Pos";
    expID.value=posID*10;
                enableProperties();

        }
        
    
    }
    
    


}
function enableProperties(){
   var elements =  document.getElementsByName("Form")[0];
   for(l in elements){
       var element= elements[l];
       if(element!=null){
       elements[l].disabled=false;
   }
   }
   
  
}
function disableProperties(){
   var elements =  document.getElementsByName("Form")[0];
   for(l in elements){
       var element= elements[l];
       if(element!=null){
       elements[l].disabled=true;
   }
   }
   
  
}
function populateFromID(rawArr,posEmpIdArr){
    empName.value=eId.value;
    populateEmployeeDetails(rawArr,posEmpIdArr);
    
}
function populateEmployeeDetails(rawArr,posEmpIdArr){
   var chosenEmpID = document.getElementById("empName").value;
    populateEmployeeCheckBoxes(rawArr,posEmpIdArr,chosenEmpID);
     pupulateRegEmployeeFields(rawArr,chosenEmpID);
    
      
  }
  
  function      pupulateRegEmployeeFields(rawArr,chosenEmpID){
      var chosenArr = getChosenArr(rawArr,chosenEmpID);
      setValuesEmpForm(chosenArr);
      
  }
  function  setValuesEmpForm(arr){
     fName.value=arr[1]; 
     lName.value=arr[2]; 
     active.value=arr[5];
     iban.value=arr[6];
     street.value=arr[7];
     sDate.value=arr[3];
     eDate.value=arr[4];
     eId.value = parseInt(arr[0]);
     country.value=arr[8];

     

  }
 function  convertSqlDateToJavascript(sqlDate){
     // Split timestamp into [ Y, M, D, h, m, s ]
var t = sqlDate.split(/[- :]/);

// Apply each element to the Date function
var d = new Date(Date.UTC(t[0], t[1]-1, t[2]));
return d;
console.log(d);
 }

  function getChosenArr(rawArr,chosenEmpID){
      for (var i in rawArr){
          if(rawArr[i][0] ===chosenEmpID) return rawArr[i];
      }
      return null;
  }
  function populateEmployeeCheckBoxes(rawArr,posEmpIdArr,chosenEmpID){
         uncheckAllBoxes("availblePoses[]");
      var checkBoxArray = getCurrentEmployeePosArr(chosenEmpID,posEmpIdArr);
      checkTheBoxes(checkBoxArray,true);
      
      enableProperties();
      
  }
  function uncheckAllBoxes(checkBoxID){
     var elements= document.getElementsByName(checkBoxID);
     for(var i in elements){
         elements[i].checked=false;
     }
  }
  
  function checkTheBoxes(arr,toCheck){
      for(i in arr){
          var id = arr[i][0];
          document.getElementById(id).checked=toCheck;
          
      }
      
  }

function getCurrentEmployeePosArr(id,arr){
    //window.alert("in the function");

    var returnArr = [];
    for(i in arr){
        if(arr[i][0] ===id ){
          //  window.alert("in the if with " + i);

          returnArr.push([arr[i][1],arr[i][2]]);  
        }
        
    }
    return returnArr;
    
    
    
    
    
}

function prepareFormAndUpdateUser(){
            enableProperties();
    eId.value="";        
   chooseEmployeeDiv.style.transition="0.5s";
    document.getElementById('chooseEmployeeDiv').style.height = "30px";
  chooseEmployeeDiv.style.display ='inline' ;
  checkBoxes.style.display='inline';

            

}

function prepareFormToInsertNewUser(){
                chooseEmployeeDiv.style.display ='none'  ;  
                checkBoxes.style.display='none';
                
        
    enableProperties();
            //resetForm();
            eId.value=-1;
            chooseEmployeeDiv.style.transition="0.5s";
            document.getElementById('chooseEmployeeDiv').style.height = "0px" ;


}
function problems(exist){
    if(!exist) document.getElementById('problemDiv').style.display='none';
    else document.getElementById('problemDiv').style.display='inline';
}
