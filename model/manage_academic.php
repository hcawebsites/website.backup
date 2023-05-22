<?php  
include_once '../database/connection.php';
extract($_POST);
if ($_POST) {
	$year = mysqli_real_escape_string($con, $_POST['year']);
	$semester = mysqli_real_escape_string($con, $_POST['semester']);
	$id = mysqli_real_escape_string($con, $_POST['id']);
	$status = mysqli_real_escape_string($con, $_POST['status']);

	mysqli_query($con, "UPDATE academic_list Set School_Year = '$year', Semester = '$semester', Evaluation = '$status' WHERE ID = '$id'");
}

?>