<?php
include_once "connection.php";

$_SESSION["mail"] = "An E-mail has been Successfully sent to you!";

if(isset($_POST["sub"])){
$useremail = $_POST["email"];

$selector = bin2hex(random_bytes(8));
$token = random_bytes(32);

$url = "www.priscaebuka/forgotpwd/confirmpass.php?selector=" . $selector . "&validator=" . 
bin2hex($token);

$expires = date("U") + 1800;

$del = "DELETE FROM pwdreset WHERE pwdResetEmail =?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $del)){
    echo "There was an error!";
    exit();
}else{
    mysqli_stmt_bind_param($stmt, "s", $useremail);
    mysqli_stmt_execute($stmt);
}
$hashedToken = password_hash($token, PASSWORD_DEFAULT);
$sql = "INSERT INTO (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpire) VALUES (' $useremail','$selector','$hashedToken','$expires') ";

$res1 = mysqli_query($conn,$sql);


$to = $useremail;
$subject = "Reset your password for NOTEBOOK";
$message = '<p>We received a password reset request. The link to reset your password is below
, if you did not make this request, you can ingnore this message.

Here is your password Reset Link <br />
<a href="'. $url . ' "> '. $url . '</a>
</p>';

$header = "From: NOTEBOOK  <notebook@gmail.com>\r\n";
$header .= "Reply-To: priscavincent2018@gmail.com\r\n";
$header .= "content-type: text/html\r\n";

if(mail($to, $subject, $message, $header)){
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Dear</strong> <?php   echo $_SESSION["mail"]; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
  if(isset($_SESSION["mail"])){
      unset($_SESSION["mail"]);
  }else {
    // header("location:forgotpass.php");
    echo "Unable to send mail";
    }
// header("location:forgotpass.php?reset=success"

}
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
    <link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body style="background-color:#184A45FF;">
   <div style="margin-left: 400px;">
   <div class="card m-5 w-50 ">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
<div class="m-5 ">
    <h1 class="fs-4 pb-md-4">Enter your E-mail</h1>
    <input type="email" name="email" class="form-control w-75 mb-md-4" placeholder="Input your email address" required>
    <button type="submit" name="sub" class="btn btn-primary form-control w-50">Submit</button>
</div>
        </form>
    </div>
   </div>
</body>
</html>