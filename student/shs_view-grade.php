<?php  
include_once '../database/connection.php';

$data_ = explode(',', $_POST['sched_id']);
$sched_id = $data_[0];
$std_id = $data_[1];

$_get_grade = mysqli_query($con, "SELECT * FROM shs_grade inner join schedule on shs_grade.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code WHERE Student_ID = '$std_id' AND Sched_ID = '$sched_id'");
if (mysqli_num_rows($_get_grade) > 0) {
		while ($_row_grade = mysqli_fetch_assoc($_get_grade)) {
		$data['prelim'] = $_row_grade['Prelim'];
		$data['midterm'] = $_row_grade['Midterm'];
		$data['final'] = $_row_grade['Final'];
		$data['description'] = "Grade | ". $_row_grade['Description'];
	}
}else{
	$_get_grade = mysqli_query($con, "SELECT * FROM  schedule inner join subjects on schedule.Code = subjects.Subject_Code WHERE schedule.ID = '$sched_id'");
		while ($_row_grade = mysqli_fetch_assoc($_get_grade)) {
		$data['description'] = "Grade | ". $_row_grade['Description'];

	}
}


echo json_encode($data);


?>