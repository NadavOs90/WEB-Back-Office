/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function defineMaxMinToInputObjectsByOffsetFromToday(objectId,offset,attr){ //Max=true

 var today = new Date();
 today.setDate(today.getDate()+offset);
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd;
    } 
 if(mm<10){
        mm='0'+mm;
    } 
 
today = yyyy+'-'+mm+'-'+dd;
var item = document.getElementById(objectId);
    item.setAttribute(attr, today);
}



function setDateValue(objectId,offset){ //Max=true

 var today = new Date();
 today.setDate(today.getDate()+offset);
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd;
    } 
 if(mm<10){
        mm='0'+mm;
    } 
 
today = yyyy+'-'+mm+'-'+dd;
var item = document.getElementById(objectId);
item.value=today;
}

function daysBetween( date1, date2 ) {
  // Convert both dates to milliseconds
  var date1_ms = date1.getTime();
  var date2_ms = date2.getTime();

  // Calculate the difference in milliseconds
  var difference_ms = date2_ms - date1_ms;
  //take out milliseconds
  difference_ms = difference_ms/1000;
  difference_ms = difference_ms/60; 
  difference_ms = difference_ms/60;  
  var days = Math.floor(difference_ms/24);
  
  return days;
}

function checkDate(){
    var date = document.getElementById("date").value;
    date = new Date(date);
    var today = new Date();
    if(daysBetween(date,today) < 0){
        alert("You can`t predict the future!");
        return false;
    }
    if(daysBetween(date,today) > 31){
        alert("You can only report up to 30 days earlier");
        return false;
    }
    
    return true;
};

function validateEmployee(){
    var patt = /[A-Za-z][A-Za-z][A-Za-z]+$/;
    var name = document.getElementById("fName").value;
    var last = document.getElementById("lName").value;
    if(!name.match(patt)){
        alert("Invalid First Name");
        return false;
    }
    if(!last.match(patt)){
        alert("Invalid Last Name");
        return false;
    }
    var start = document.getElementById("sDate").value;
    start = new Date(start);
    var today = new Date();
    if(daysBetween(start,today) < -7){
        alert("You can`t update so far ahead");
        return false;
    }
    var end = document.getElementById("eDate").value;
    if(end != null){
        end = new Date(end);
        if(daysBetween(start,end) < 0){
            alert("invalid end date");
            return false;
        }
    }
    return true;
}

function validateDaily1() {
    if(document.getElementById("location").value === "default"){
        alert("Select location");
        return false;
    }
    return checkDate();
};

function validateExpense(){
    if(document.getElementById("source").value === "default"){
        alert("Select income source");
        return false;
    }
    if(document.getElementById("expType").value === "default"){
        alert("Select expense type");
        return false;
    }
    if(document.getElementById("expAmount").value < 0){
        alert("Invalid expense");
        return false;
    }
    return validateDaily1();
}

function validateCash(){
    if(document.getElementById("posName").value === "default"){
        alert("Select POS");
        return false;
    }
    if(document.getElementById("curCashCount").value < 0){
        alert("Invalid cash count");
        return false;
    }
    return true;
}
    
function validateDaily2() {
    var cash = +document.getElementById("cash").value;
    var credit = +document.getElementById("credit").value;
    if(cash < 0){
        alert("Negative cash");
        return false;
    }
    if(credit < 0){
        alert("Negative credit");
        return false;
    }
    return true;
};

function validateDaily3() {
    var cash = +document.getElementById("cash").value;
    var credit = +document.getElementById("credit").value;
    var total = +document.getElementById("total").value;
    var missing = +document.getElementById("missingCash").value;
var thisTotal = cash + credit+missing;
    if((thisTotal) != total){
        alert("Wrong total");
        return false;
    }
    if((thisTotal) != aTotal){
        alert("Total Doesn't match actual Counted Cash And Credit, Expected sum:"+aTotal);
        return false;
    }
 
    return true;
};

function checkEmail(){
    var patt = /[a-zA-Z0-9_.]+@[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)+/;
    var email = document.getElementById("username").value;
    if(!patt.test(email)){
        alert("Invalid Email");
        return false;
    }
    return true;
}

function checkStatDates(){
    alert("");
    var sDate = Document.getElementById("startDate").value;
    var eDate = document.getElementById("endDate").value;
    var startDate = new Date(sDate);
    var endDate = new Date(eDate);
    if (daysBetween( startDate, endDate ) > 0){
        alert("good");
    }
    else{
        alert ("Start date comes after end Date");
    }
}

function updateEmployeeLists(triggerElement){
    var cID = triggerElement.value;
    var name = triggerElement.getAttribute("name");
    var elementsToChange = document.getElementsByName(name);
    for (i in elementsToChange){
        var j = i;
        var curElement= elementsToChange[i];
        if(curElement!=triggerElement &&!isNaN(i)){
            var index = getIndex(curElement,cID);
            curElement.remove(index);
        }
    }
}
function getIndex(triggerElement,cID){
    var oArr = triggerElement.options;
    for (i in oArr){
        if(oArr[i].value== cID){
            return i;
        }
    }
}

function updateAmount(){
 var sum =0;
 var elements = document.getElementsByName("salesAmount[]");
 for (i in elements){
     if(!isNaN(i)){
         var j = i;
         var element =elements[i]; 
         
         var localSum = parseInt(element.value);
         if(!isNaN(localSum)){
         sum +=localSum ;
     }
     }
 }
  var sumDiv=document.getElementById("floatingSummery");

 var sumSpan=document.getElementById("currentMoney");
 sumSpan.innerHTML=sum;
 var tn = totalNeeded;
 if(sum>totalNeeded) 
     sumDiv.style.backgroundColor = "#ff0224";
else  if(sum<totalNeeded) 
    sumDiv.style.backgroundColor = "#ffb200";
else sumDiv.style.backgroundColor = "#00b740";
    
    totalInputted = sum;
}


function toggleHours(){
    var choice = document.getElementById("whSelect").value;
    
        var eElements = document.getElementsByName("entryTime[]");
        var exElements = document.getElementsByName("endTime[]");
        
        for(i in eElements ){
            if(!isNaN(i)){
                if(choice==0){
                         document.getElementsByName("wh")[i].style.display="none";
                        eElements[i].disable = true;
                        exElements[i].disable = true;
                        }
                        else {
                       document.getElementsByName("wh")[i].style.display="inline";
                       
                        eElements[i].disable = false;
                        exElements[i].disable = false;
                        }
        }

    }
     
}
function validateDailyEmpForm(){
    var tn =totalNeeded;
    var ti = totalInputted;
    if(totalNeeded==totalInputted) return true;
    else {
       var div= document.getElementById("errorDIV");
        div.innerHTML="Total Income Counted Does Not Match Total Income From Employees, make Sure 'Live Summery' is green before submit";
        div.style.display="inline";
        return false;
    }
}