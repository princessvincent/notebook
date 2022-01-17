<?php
session_start();
include_once "connection.php";
include_once "header.php";

if(!isset($_SESSION["logged"])){
    header("location: login.php");
}
$_SESSION["message"] = "Your Note has been created Successfully!";

if(isset($_POST["create"])){
    if(isset($_POST["subj"]) && isset($_POST["notes"])){
        $sub = mysqli_real_escape_string($conn,$_POST["subj"]);
        $note = mysqli_real_escape_string($conn,$_POST["notes"]);
    }

    $sql = "INSERT INTO note (title,notes) VALUES ('$sub', '$note')";
    $res = mysqli_query($conn, $sql);
    if($res){

        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Dear</strong> <?php   echo $_SESSION["message"]; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        <?php
        if(isset($_SESSION["message"])){
            unset ($_SESSION["message"]);
        }else{
            echo "session not set";
        }
    }else{
        echo "Unable to create note!";
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
 <div class="container">
<div class="row">
    
<div class="card mt-5">
    <div class="regis">
    <h1 class="text-center text-white w-50" id="reg">Create your Note here</h1>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
    <div class="mb-3">
  <label for="subject" class="form-label">Subject</label>
  <input type="text" class="form-control" id="sub" name="subj">
</div>
<div class="mb-3">
  <label for="text" class="form-label">Notes</label>
  <textarea class="form-control" id="note" rows="3" name="notes"></textarea>
</div>
<div class="col-12 justify-content-center" id="regis" style="padding-left: 30px;">
<button type="submit" name="create"   class="text-center text-white w-25" id="reg">Create Note</button>
</div>
    </form>
</div>
<!-- <div class="alert alert-success">My Alert </div> -->
<div class="card mt-5">
<table border="3px" class="table table-hover table table-stripe table table-bordered table table-bordered border-dark">
<thead>
    <tr>
        <th>S/N</th>
        <th>Subject</th>
        <th>Notes</th>
        <th colspan="3">Action</th>
    </tr>
</thead>
<tbody>
    <?php
    
    $sql1 = "SELECT * from note";
    $rest = mysqli_query($conn, $sql1);

    while($rows = mysqli_fetch_assoc($rest)){
        $id = $rows["note_id"]
    ?>

    <tr>
        <td><?php echo $rows["note_id"]?></td>
        <td><?php echo $rows["title"]?></td>
        <td><?php echo $rows["notes"]?></td>
        <td><a href="edit.php?id=<?php echo $id ?>" class="text-decoration-none btn btn-primary btn-sm">Edit</a></td>
        <td><a href="view.php?id=<?php echo $id ?>" class="text-decoration-none btn btn-success btn-sm">View</a></td>
        <td><a href="delete.php?id=<?php echo $id ?>" class="text-decoration-none btn btn-danger btn-sm">Delete</a></td>
    </tr>
    <?php 
    }
    
    ?>
</tbody>
</table>

</div>


</div>
 </div>   
</body>
</html>