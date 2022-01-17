<?php
session_start();
include_once "connection.php";
if(!isset($_SESSION["logged"])){
    header("location: login.php");
}

if(isset($_GET["id"])){
    $id = $_GET["id"];
}


$sql = "DELETE FROM note WHERE note_id = '$id'";
$res = mysqli_query($conn, $sql);
if($res){
    header("location:landing.php");
}else{
    echo "Unable to delete Note!";
}

?>