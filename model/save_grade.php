<?php include_once '../database/connection.php';

extract($_POST);
if ($_POST) {
	$std_id = mysqli_real_escape_string($con, $_POST['std_id']);
	$ay = mysqli_real_escape_string($con, $_POST['ay']);
	$semester = mysqli_real_escape_string($con, $_POST['semester']);
	$prelim = mysqli_real_escape_string($con, $_POST['prelim']);
	$midterm = mysqli_real_escape_string($con, $_POST['midterm']);
	$final = mysqli_real_escape_string($con, $_POST['final']);
	$overall = mysqli_real_escape_string($con, $_POST['overall']);
	$subject = mysqli_real_escape_string($con, $_POST['subject']);

	$first = mysqli_real_escape_string($con, $_POST['first']);
	$second = mysqli_real_escape_string($con, $_POST['second']);
	$third = mysqli_real_escape_string($con, $_POST['third']);
	$fourth = mysqli_real_escape_string($con, $_POST['fourth']);
	$final = mysqli_real_escape_string($con, $_POST['final']);


	$get = mysqli_query($con, "SELECT Department from grade inner join student_grade on grade.ID = student_grade.Class_ID Where student_grade.Student_ID = '$std_id'");
	$row = mysqli_fetch_assoc($get);
	$dept = $row['Department'];

	if ($dept == "SHSDEPT") {
		mysqli_query($con, "UPDATE shs_grade Set Prelim = '$prelim', Midterm = '$midterm', Final = '$final', Overall = '$overall' WHERE Student_ID = '$std_id' AND Subject = '$subject' And AY = '$ay' And Semester = '$semester'");
	}else{
		mysqli_query($con, "UPDATE std_grade Set First = '$first', Second = '$second', Third = '$third', Fourth = '$fourth', Final = '$final' WHERE Student_ID = '$std_id' AND Subject = '$subject' And SY = '$ay'");
	}
}

?>