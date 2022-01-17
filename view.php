<?php
include_once "connection.php";
include_once "header.php";

if(!isset($_SESSION["logged"])){
    header("location: login.php");
}
if(isset($_GET["id"])){
    $ID = $_GET["id"];
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
<body style="background-color:#184A45FF;">
<div class="container">
<div class="row" style="padding-left:350px;">
<div class="card w-50" style="margin-top: 200px;">
<?php
$sqeal = "SELECT * FROM note WHERE note_id = '$ID'";
$re = mysqli_query($conn, $sqeal);
while($rows1 = mysqli_fetch_array($re)){

?>
<table>
    
<h1 class="text-center pb-md-3"><?php echo $rows1["title"]?></h1>
<p class="text-center pt-md-3" style="border-top: 2px solid black;"><?php echo $rows1["notes"]?></p>
<?php
}
?>
</table>
</div>
</div>
</div>
</body>
</html>