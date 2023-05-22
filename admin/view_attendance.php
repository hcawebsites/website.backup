<?php
include_once '../database/connection.php';

$emp_id = mysqli_real_escape_string($con, $_POST['id']);
$get = mysqli_query($con, "SELECT Access FROM user Where Username = '$emp_id'");
$row = mysqli_fetch_assoc($get);
$access = $row['Access'];

if ($access == "Admin") {
	$get_info = mysqli_query($con, "SELECT *, emp_attendance.Date as date, emp_attendance.Status as status FROM admin inner join emp_attendance on admin.Admin_ID = emp_attendance.Emp_ID where Admin_ID = '$emp_id'");
	while ($info = mysqli_fetch_assoc($get_info)) {
			$data['image'] = $info['Picture'];
			$data['salutation'] = $info['Salutation'];
			$data['firstname'] = $info['Firstname'];
			$data['middlename'] = $info['Middlename'];
			$data['lastname'] = $info['Lastname'];
			$data['time_in'] = $info['Time_In'];
			$data['time_out'] = $info['Time_Out'];
			$data['date'] = date('F j, Y', strtotime($info['date']));
			$data['status'] = $info['status'];
			$data['access'] = $access;
		}

}elseif ($access == "Teacher") {
	$get_info = mysqli_query($con, "SELECT *, emp_attendance.Date as date, emp_attendance.Status as status FROM teacher_tb inner join emp_attendance on teacher_tb.Emp_ID = emp_attendance.Emp_ID where teacher_tb.Emp_ID = '$emp_id'");
	while ($info = mysqli_fetch_assoc($get_info)) {
			$data['image'] = $info['Picture'];
			$data['salutation'] = $info['Salutation'];
			$data['firstname'] = $info['Firstname'];
			$data['middlename'] = $info['Middlename'];
			$data['lastname'] = $info['Lastname'];
			$data['time_in'] = $info['Time_In'];
			$data['time_out'] = $info['Time_Out'];
			$data['date'] = date('F j, Y', strtotime($info['date']));
			$data['status'] = $info['status'];
			$data['access'] = $access;
		
	}
}else{
	$get_info = mysqli_query($con, "SELECT *, emp_attendance.Date as date, emp_attendance.Status as status FROM staff_tb inner join emp_attendance on staff_tb.Emp_ID = emp_attendance.Emp_ID where staff_tb.Emp_ID = '$emp_id'");
	while ($info = mysqli_fetch_assoc($get_info)) {
			$data['image'] = $info['Picture'];
			$data['salutation'] = $info['Salutation'];
			$data['firstname'] = $info['Firstname'];
			$data['middlename'] = $info['Middlename'];
			$data['lastname'] = $info['Lastname'];
			$data['time_in'] = $info['Time_In'];
			$data['time_out'] = $info['Time_Out'];
			$data['date'] = date('F j, Y', strtotime($info['date']));
			$data['status'] = $info['status'];
			$data['access'] = $access;
	}
}
echo json_encode($data);
?>