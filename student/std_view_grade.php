<?php  
include_once '../database/connection.php';

$data_ = explode(',', $_POST['sched_id']);
$sched_id = $data_[0];
$std_id = $data_[1];

$_get_grade = mysqli_query($con, "SELECT * FROM std_grade inner join schedule on std_grade.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code WHERE Student_ID = '$std_id' AND Sched_ID = '$sched_id'");
if (mysqli_num_rows($_get_grade) > 0) {
		while ($_row_grade = mysqli_fetch_assoc($_get_grade)) {
		$data['first'] = $_row_grade['First'];
		$data['second'] = $_row_grade['Second'];
		$data['third'] = $_row_grade['Third'];
		$data['fourth'] = $_row_grade['Fourth'];
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