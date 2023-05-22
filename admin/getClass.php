<?php  
include_once '../database/connection.php';

if ($_POST) {
	$data = array();
	$teacher_id = mysqli_real_escape_string($con, $_POST['teacher_id']);

	$get = mysqli_query($con, "SELECT * from teacher_tb inner join schedule on teacher_tb.Emp_ID = schedule.Teacher_ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID WHERE Teacher_ID = '$teacher_id' Group by CODE;");
	while ($row = mysqli_fetch_assoc($get)) {
		$data[] = $row;
	}
	echo json_encode($data);

}
?>