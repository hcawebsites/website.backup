<?php
error_reporting(0);
include_once '../database/connection.php';
date_default_timezone_set('Singapore');
$sched_id = $_POST['sched_id'];
$date = date('Y-m-d');
$default = date('H:i:s');

$_chk_class_attendance = mysqli_query($con, "SELECT * FROM class_attendance WHERE Sched_ID = '$sched_id' AND Status = 0");
if (mysqli_num_rows($_chk_class_attendance) > 0) {
	echo "Attendance Already Stoped!";
}else{
	$_get_present = mysqli_query($con, "SELECT GROUP_CONCAT(Student_ID SEPARATOR ',') as std_present FROM std_attendance WHERE Sched_ID = '$sched_id' AND Date = '$date'");
	$_row_present = mysqli_fetch_assoc($_get_present);
	$std_present = "'" . implode ( "', '", explode(',', $_row_present['std_present']) ) . "'";
	$_get_absent = mysqli_query($con, "SELECT * FROM handle_student WHERE Sched_ID = '$sched_id' AND Student_ID NOT IN ($std_present)");
	while ($_row_absent = mysqli_fetch_assoc($_get_absent)) {
		$_absent_id = $_row_absent['Student_ID'];
		mysqli_query($con, "INSERT INTO std_attendance (Student_ID, Sched_ID, Status) VALUES ('$_absent_id', '$sched_id', 'Absent')");
		mysqli_query($con, "UPDATE std_attendance SET Time_Out = '$default' WHERE Sched_ID = '$sched_id' AND Date = '$date' AND Student_ID IN ($std_present)");
	}
	mysqli_query($con, "UPDATE class_attendance Set Status = 0, Start_Time = '00:00:00' Where Sched_ID = '$sched_id'");

	echo "success";
}
?>