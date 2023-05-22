<?php  
include_once '../database/connection.php';
date_default_timezone_set('Singapore');
$id = mysqli_real_escape_string($con, $_POST['id']);
$time = date('H:i:s');
$get = mysqli_query($con, "SELECT * FROM str_staff_attendance WHERE ID = '$id' AND Status = '1'");
if (mysqli_num_rows($get) > 0) {
	echo "Attendance Already Started!";
}else{
	mysqli_query($con, "UPDATE str_staff_attendance Set Status = '1', Start_Time = '$time' WHERE ID = '$id'");
	echo "success";
}

?>