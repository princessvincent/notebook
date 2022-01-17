
<?php
include_once "connection.php";
// include_once "header.php";
$_SESSION["unregis"] = "We are unable to register you!";
$_SESSION["email"] = "Sorry.....Email already exist!";

if(isset($_POST['reg'])){
  if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST["pass"])){
    $full = mysqli_real_escape_string( $conn, $_POST['fullname']);
    $email = mysqli_real_escape_string( $conn, $_POST['email']);
    $pass = mysqli_real_escape_string( $conn, md5($_POST['pass']));
  }
//validating email
  if(filter_var("$email, FILTER_VALIDATE_EMAIL")){
    $emailerror = "Invalid email";
  }
// making sure user doesn't register with two emails.
$sql = "SELECT * from users WHERE email = '$email'";
$sql1 = mysqli_query($conn,$sql);

if(mysqli_num_rows($sql1) == 1){
  ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong></strong> <?php   echo $_SESSION["email"]; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        <?php
        if(isset($_SESSION["email"])){
            unset ($_SESSION["email"]);
        }else{
            echo "session not set";
        }
}else{
  $sqeal = "INSERT  INTO users (fullname,email,password) VALUES ('$full', '$email', '$pass')";
  $res = mysqli_query($conn, $sqeal);
  
  if($res){
    echo "success!";
    header("location:login.php");
  }else{
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
     <strong>Dear</strong> <?php   echo $_SESSION["unregis"]; ?>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
           <?php
           if(isset($_SESSION["unregis"])){
               unset ($_SESSION["unregis"]);
           }else{
               echo "session not set";
           }
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
  <h1 class="text-center text-white w-25" id="reg">Register with Us</h1>
  </div>
   <div class="container">
      <div class="row">
        <div class="d-flex flex-md-row justify-content-md-evenly">
          <div>
          <form action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="Post" class="m-5 form-control" style="border-color: blue;">
     <div class="inp">
     <div class="mb-3">
  <label for="fullname" class="form-label">Fullname</label>
  <input type="text" class="form-control w-75" name="fullname" placeholder="Fullname" required>
</div>
       <div class="mb-3">
  <label for="email" class="form-label">Email</label>
  <input type="email" class="form-control w-75" name="email" placeholder="name@example.com" required>
</div>
<div class="mb-3">
  <label for="password" class="form-label">Password</label>
  <input type="password" class="form-control w-75" name="pass" placeholder="Password" required>
</div>
<div class="col-12 justify-content-center" style="padding-left: 30px;">
<button type="submit" name="reg" class="but">Sign Up</button> 
 <p><a href="login.php" class="text-decoration-none" id="log">Login</a></p>


</div>

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