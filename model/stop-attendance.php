<?php  
include_once '../database/connection.php';
date_default_timezone_set('Singapore');
$id = mysqli_real_escape_string($con, $_POST['id']);
$date = date('Y-m-d');
$get = mysqli_query($con, "SELECT * FROM str_staff_attendance WHERE ID = '$id' AND Status = '0'");
$json_array = array();
if (mysqli_num_rows($get) > 0) {
	echo "Attendance Already Stoped!";
}else{
	$get = mysqli_query($con, "SELECT GROUP_CONCAT(Emp_ID SEPARATOR ',') as emp_id  FROM emp_attendance WHERE Date = '$date'");
	$row = mysqli_fetch_assoc($get);
	$id = "'" . implode ( "', '", explode(',', $row['emp_id']) ) . "'";
	
	$res = mysqli_query($con, "SELECT * FROM user WHERE Username not in ($id)");
	while ($row_abs = mysqli_fetch_assoc($res)) {
		$absent_id = $row_abs['Username'];
		$name = $row_abs['Firstname']. " " .$row_abs['Middlename']. " " .$row_abs['Lastname'];
		$access = $row_abs['Access'];
		mysqli_query($con, "INSERT INTO emp_attendance (Emp_ID, Name, Access) VALUES ('$absent_id', '$name', '$access')");
	}
	mysqli_query($con, "UPDATE str_staff_attendance Set Status = 0, Start_Time = '00:00:00'");
	echo "success";
	
	
}

?>