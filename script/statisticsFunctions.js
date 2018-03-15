
function goToNext(sDate,lDate,lI,hI){
    var address =buildGetString(sDate,lDate,lI,hI);
        window.open(address);

}
function buildGetString(sDate,lDate,lI,hI){
    var str ="http://bo.tidhar.org.il/getDataStatistics.php?";
    str+="startDate=";
    str+=sDate;
    str+="&";
    str+="endDate=";
    str+=lDate;
    str+="&";
    str+="lowIndex=";
    str+=lI;
    str+="&";
    str+="$highIndex=";
    str+=hI;
    return str;
}

function updateOffset(offset){
   var lV= document.getElementById('lI').value;
   var max = document.getElementById('max').value;
   max = parseInt(max);
   lV = parseInt(lV)+offset;
   if(lV < 0){
       lV = 0;
   }
   if(lV > max){
        goToEnd();
   }
   else{
        document.getElementById('lI').value =lV;
   }
}

function goToStart(){
   var lV= document.getElementById('lI').value;
   document.getElementById('lI').value =0;
}
function goToEnd (){
   var max = document.getElementById('max').value;
   max = parseInt(max);
   max = max - max%3;
   document.getElementById('lI').value =max;
}