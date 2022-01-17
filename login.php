<?php
session_start();

include_once "connection.php";
if(isset($_POST["login"])){
    if(isset($_POST['email']) && isset($_POST['pass'])){
        $email = $_POST['email'];
        $pass = md5($_POST['pass']);

        $sql = "SELECT * FROM users WHERE email = '$email' and password =  '$pass'";
        
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)==1){
            $_SESSION["logged"] = mysqli_fetch_assoc($res);

            header("location:landing.php");
        }else{
            echo "Unable to Login";
        }
    }

}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notebook</title>
    <link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="card">
  <div class="regis">
  <h1 class="text-center text-white w-25" id="reg">Login</h1>
  </div>
   <div class="container">
      <div class="row">
        <div class="d-flex flex-md-row justify-content-md-evenly">
          <div>
          <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="Post" class="m-5 form-control" style="border-color: blue;">
     <div class="inp">
       <div class="mb-3">
  <label for="email" class="form-label">Email</label>
  <input type="email" class="form-control w-75" name="email" placeholder="name@example.com" required>
</div>
<div class="mb-3">
  <label for="password" class="form-label">Password</label>
  <input type="password" class="form-control w-75" name="pass" placeholder="Password" required>
</div>
<div class="col-12 justify-content-between" style="padding-left: 30px;">
<button type="submit" name="login" class="but mb-5">Login</button> 
 <a href="index.php" class="text-decoration-none" id="log" style="padding-left: 50px;">Sign Up</a> <br>
 
</div>
<p><a href="forgotpass.php" class="text-decoration-none pt-5" id="forg">Forgotten Password</a></p>
     </div>
       </form>
          </div>
      
          <div class="lap">
            
           <img src="img/laptop-1205256_1920.jpg" alt="" id="lap">  
          </div>
      </div>
      
   </div>
</div> 
</div>
</body>
</html>