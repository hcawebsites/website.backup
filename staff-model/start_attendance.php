<?php 
include_once '../database/connection.php';  
date_default_timezone_set('Singapore');
$sched_id = $_POST['sched_id'];
$time = date('H:i:s');

$check = mysqli_query($con, "SELECT * FROM class_attendance WHERE Sched_ID = '$sched_id' AND Status = 1");
if (mysqli_num_rows($check) > 0) {
	echo "Attendance Already Started!";
}else{
	mysqli_query($con, "UPDATE class_attendance Set Status = 1, Start_Time = '$time' WHERE Sched_ID = '$sched_id'");
	echo "success";
}


?>