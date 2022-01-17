<?php
 session_start();
// var_dump($_SESSION["logged"]);
include_once "connection.php";
include_once "header.php";

if(!isset($_SESSION["logged"])){
    header("location: login.php");
}

$_SESSION["change"] = "Your Password has been changed Successfully!";
$res = NULL;    

if(isset($_POST["change"])){
    
        $old_p = md5( $_POST["old_password"]);
        $new_p = md5( $_POST["new_password"]);

    
        $old = $_SESSION["logged"]["password"];
        $emai = $_SESSION["logged"]["email"];
        //  var_dump($old);
        //  var_dump($old_p);
        // var_dump($emai);  
        if($old == $old_p){

        $sql = "UPDATE users SET password = '$new_p' WHERE email = '$emai'";
        $res = mysqli_query($conn, $sql);
        //  var_dump($res);
        if($res){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Dear</strong> <?php   echo $_SESSION["change"]; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
      <?php
if(isset($_SESSION["change"])){
    unset ($_SESSION["change"]);
}else{
    echo "Unable to change password";
}
        }
    }
    // echo  $res? "password changed" : "unable to change password";
}

?>

<html lang="en">
<head>

    <title>Change password</title>
    <link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body style="background-color:#184A45FF;">
   <div class="justify-content-center" style="margin-left: 500px;">
   <div class="card m-5 w-50 ">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
<div class="m-5 ">
    <h1 class="fs-4 pb-md-4">Change Password</h1>
         <input type="password" name="old_password" class="form-control w-75 mb-3"  placeholder="Old password" required>
         <input type="password" name="new_password" class="form-control w-75 mb-3" placeholder="New password" required>
         <button type="submit" name="change" class="btn btn-primary w-75">Change Password</button>
</div>
        </form>
    </div>
   </div>
</body>
</html>