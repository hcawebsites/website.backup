<?php
include_once("../database/connection.php");
extract($_POST);
$id = mysqli_real_escape_string($con, $_POST['id']);
$in = mysqli_real_escape_string($con, $_POST['in']);
$out = mysqli_real_escape_string($con, $_POST['out']);
$status = mysqli_real_escape_string($con, $_POST['status']);

$sql = mysqli_query($con, "UPDATE emp_attendance Set Time_In = '$in', Time_Out = '$out', Status = '$status' WHERE Emp_ID = '$id'");
if ($sql) {
    echo 'success';
}

?>