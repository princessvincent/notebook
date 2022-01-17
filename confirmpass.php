<?php
include_once "connection.php";
//validating user
// $selector = $_GET["selector"];
// $validator = $_GET["validator"];

// if(empty($selector) || empty($validator)){
//     echo "could not validate your request";
// }else{
//     if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){

  ?>
  <?php
//resetting user password
if(isset($_POST["reset"])){
    // $selec = $_POST["selector"];
    // $vali = $_POST["validator"];
    $pass = md5($_POST["pwd"]);
    $confpass = md5($_POST["repeat_pwd"]);

    // $passhash = password_hash($pass, PASSWORD_DEFAULT);
    // $pashash1 = password_hash($confpass, PASSWORD_DEFAULT);

    if(empty($pass) || empty($confpass)){
        echo "Input field required....";
    }elseif($pass != $confpass){
        echo "password does not match! try again";
    }

    $currentdate = date("U");
    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector = '$selec' AND pwdResetExpire >= '   $currentdate'";
$res = mysqli_query($conn, $sql);
if(!$row = mysqli_fetch_assoc($res)){
    echo "you need to re-submit your reset request";
    exit();
}else{
    $token = bin2hex($vali);
    $tokencheck = password_verify($tokin, $row["pwdResetToken"]);

    if($tokencheck == false){
        echo "you need to re-submit your reset request";
        exit();
    }elseif ($tokencheck == true) {
$tokenEmail = $row["pwdResetEmail"];

$sql1 = "SELECT * FROM users WHERE email = '$tokenEmail'";
$rest = mysqli_query($conn, $sql1);
if(!$rows = mysqli_fetch_assoc($rest)){
    echo "you need to re-submit your reset request";
    exit();
}else{
    $sql2 = "UPDATE users SET password = '$pass' WHERE email='$tokenEmail'";
    $res1 = mysqli_query($conn,$sql2);
    
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
    <title>Reset password</title>
    <link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body style="background-color:#184A45FF;">
   <div class="justify-content-center" style="margin-left: 500px;">
   <div class="card m-5 w-50 ">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
<div class="m-5 ">
    <h1 class="fs-4 pb-md-4">Change Password</h1>
    <input type="password" name="pwd" placeholder="Enter a new password" class="mb-3" required>
<input type="password" name="repeat_pwd" placeholder="Comfirm password" class="mb-3" required>
<button type="submit" name="reset" class="btn btn-primary">Reset Password</button>
</div>
        </form>
    </div>
   </div>
</body>
</html>
