<?php  
include_once('../database/connection.php');

extract($_POST);

if ($_POST) {
     $description = mysqli_real_escape_string($con, $_POST['description']);
     $amount = mysqli_real_escape_string($con, $_POST['amount']);
     $grade = mysqli_real_escape_string($con, $_POST['grade']);

     mysqli_query($con, "INSERT INTO fees (Description, Amount, Grade_ID) VALUES ('$description', '$amount', '$grade')");
}


?> 