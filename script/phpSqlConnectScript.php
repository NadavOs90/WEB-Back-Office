 <?php
function connect($username,$password,$database,$dbHost){
    
    $db = mysqli_connect($dbHost,$username,$password,$database);
   
if(mysqli_connect_errno()){
  
    die("databse connection failed: "
            . mysqli_connect_error() 
            ." ("
            . mysqli_connect_errno()
            .") "
         );
}
return $db;
}

function connectToDB(){
$db=    connect("web","bvGHdkSh8sDCZKZg","backOfficeWebSiteDatabase","bo.tidhar.org.il");
    return $db;
    
    
}

function closeDB($db){
    
  //  mysqli_close($db);
}
    

