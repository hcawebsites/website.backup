<?php
session_start();
include_once '../database/connection.php';

if ($_POST) {
	$subjectCode = mysqli_real_escape_string($con, $_POST['scode']);
	$myID = $_SESSION['student_id'];

	$selectTeacher = mysqli_query($con, "SELECT *, grade.ID as id FROM schedule inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID WHERE schedule.Code = '$subjectCode' GROUP BY schedule.Teacher_ID");

	while ($row_teacher = mysqli_fetch_assoc($selectTeacher)) {
		$data['info'] = $row_teacher['Salutation']. ". ".$row_teacher['Lastname']. ", " . $row_teacher['Firstname']. " -> " .$subjectCode ." | ". $row_teacher['Description'];
		$data['tid'] = $row_teacher['Teacher_ID'];
		$data['std_id'] = $myID;
		$data['class'] = $row_teacher['id'];
	}
	echo json_encode($data);
}
?>