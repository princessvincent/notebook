<?php
session_start();
include_once "connection.php";
include_once "header.php";

if(!isset($_SESSION["logged"])){
    header("location: login.php");
}

$_SESSION["update"] = "Your Note has been Updated Successfully!";

// storing id inside session
if(isset($_GET["id"])){
    $id = $_GET["id"];

//     $_SESSION["id"] = $id; 
// }elseif(isset($_SESSION["id"])){
//     $id = $_SESSION["id"];
// }
}
if(isset($_POST["update"])){
    if(isset($_POST["subj"]) && isset($_POST["notes"]) && isset($_POST["id"])){
        $ID = $_POST["id"];
        $sub = $_POST["subj"];
        $note = $_POST["notes"];
    }

    $sql = "UPDATE note SET title = '$sub', notes= '$note' WHERE note_id = '$ID'";
    $res = mysqli_query($conn,$sql);
    if($res){
        ?>
 <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Dear</strong> <?php   echo $_SESSION["update"]; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        <?php
        if(isset($_SESSION["update"])){
            unset ($_SESSION["update"]);
        }else{
            echo "session not set";
        }
    }else{
        echo "Unable to update note";
    }
}

// fetching data from database

$sql2 = "SELECT * FROM note WHERE note_id = '$id'";
$rest = $conn->query($sql2);
if($rest->num_rows !=1){
    die("id not available");
}

$data = mysqli_fetch_array($rest);

$id_o  = $data["note_id"];
$sub = $data["title"];
$note = $data["notes"];
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
<div class="row">
<div class="card mt-5">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id?>" method="POST">
<div class="m-5" style="padding-left: 0px;">
<input type="hidden" name="id" value="<?php echo $id_o?>">    

<div class="mb-3">
  <label for="subject " class="form-label">TOPIC</label>
  <input type="text" class="form-control "  id="sub" name="subj" value="<?php echo $sub?>">
</div>
<div class="mb-3">
  <label for="text" class="form-label "> NOTES</label>
  <textarea  class="form-control" id="note" rows="3" name="notes"  ><?php echo $note?></textarea>
</div>
<div class="col-12 justify-content-center" style="padding-left: 150px;">
<button type="submit" name="update" class="but">Update Note</button>
</div>
</div>
    </form>   
</div>
</div>
</div>
</body>
</html>