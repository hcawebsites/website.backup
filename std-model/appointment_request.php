<?php  include_once '../database/connection.php';

extract($_POST);
if ($_POST) {
    $std_id = mysqli_real_escape_string($con, $_POST['std-id']);
    $reason = mysqli_real_escape_string($con, $_POST['reason']);
    $bully_name = mysqli_real_escape_string($con, $_POST['bully_name']);
    $concern = mysqli_real_escape_string($con, $_POST['concern']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $time = mysqli_real_escape_string($con, $_POST['time']);
    $date1 = date('F j, Y', strtotime($date));
    $time1 = date('h:i A', strtotime($time));
    $newdate = $date1. " " .$time1;

    mysqli_query($con, "INSERT into appointments (Student_ID, Reasons, Bully_Name, Concerns, Status, Date_Time) VALUES ('$std_id', '$reason', '$bully_name', '$concern', '2', '$newdate')");

}


?>
