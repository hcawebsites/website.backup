<?php
include_once ('../database/connection.php');

extract($_POST);

$sched_id = mysqli_real_escape_string($con, $_POST['subject']);
$name = mysqli_real_escape_string($con, $_POST['className']);
$code = mysqli_real_escape_string($con, $_POST['classCode']);

$check = mysqli_query($con, "SELECT * FROM classroom WHERE Sched_ID = '$sched_id'");
if (mysqli_num_rows($check) > 0) {
    echo "Classroom Already Created!";
}else{
    mysqli_query($con, "INSERT INTO classroom (Sched_ID, Classname, Code) Values ('$sched_id', '$name', '$code')");
    echo "success";
}
?>