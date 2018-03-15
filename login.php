<!DOCTYPE html>
<?php
 include("script/phpSqlConnectScript.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST"&&filter_var($_POST['username'],FILTER_VALIDATE_EMAIL)) {     
        $db = connectToDB();
        $myusername = mysqli_real_escape_string($db,$_POST['username']);
        $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

        $sql = "SELECT * FROM users WHERE email = '$myusername' and password = '$mypassword'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        // If result matched $myusername and $mypassword, table row must be 1 row
        mysqli_close($db);
      
        if($count == 1) {
           $_SESSION['login_user'] = $myusername;
           $_SESSION['userid'] = $row["userID"];
           $_SESSION['fname'] = $row["firstName"];
           $_SESSION['lname'] = $row["lastName"];
           
           if(isset($_POST['rememberMe'])) {
              $time = time()+ (60*60*24);
              setcookie('username', $myusername, $time);
              setcookie('logged_in', true, $time);
              setcookie('userid' ,$_SESSION['userid'], $time);
              setcookie('fname' ,$_SESSION['fname'], $time);
              setcookie('lname' ,$_SESSION['lname'], $time);
           }
           
          header("location: index.php");
          
        }else {
           header("location: login.php");
        }
      }
?>
<html>
 <?php
    if(isset($_GET['email'])){
        $email = $_GET['email'];     
    }
    else{
        $email = "";
    }
 ?>
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="css/formDesign.css">
  <script src="script/formValidation.js"></script>
</head>

<body>

    <div class="wrapper" > 
        <form class="form-signin" onsubmit="return checkEmail()" method="post" > 
      <h2 class="form-signin-heading">Please login</h2>
      <input type="email" class="form-control" id="username" name="username" value ="<?php echo $email ?>" placeholder="Email Address"   required  />
      <br>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required/>      
      <label class="checkbox"><br>>
          <input type="checkbox" value="<?php echo $_COOKIE['rememberMe']; ?>" id="rememberMe" name="rememberMe"> Remember me
      </label><br>
      <input id="submit" type="submit" value="Login">  
    </form>
  </div>
</body>
</html>
