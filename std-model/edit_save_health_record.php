<?php include_once '../database/connection.php';
error_reporting(0);
extract($_POST);

if ($_POST) {
	$std_id = mysqli_real_escape_string($con, $_POST['std_id']);
	$illness = mysqli_real_escape_string($con, $_POST['illness']);
	$medication = mysqli_real_escape_string($con, $_POST['medication']);
	$operation = mysqli_real_escape_string($con, $_POST['operation']);
	$height = mysqli_real_escape_string($con, $_POST['height']);
	$weight = mysqli_real_escape_string($con, $_POST['weight']);
	$bmi = mysqli_real_escape_string($con, $_POST['bmi']);
	$classification = mysqli_real_escape_string($con, $_POST['classification']);
	$smoking = mysqli_real_escape_string($con, $_POST['smoking']);
	$drinking = mysqli_real_escape_string($con, $_POST['drinking']);
	$med_history = $_POST['med_history'];
	$fam_history = $_POST['f_history'];

	$insert = mysqli_query($con, "UPDATE health_record Set Illness = '$illness', Medication_Taken = '$medication', Operations = '$operation', Height = '$height', Weight = '$weight', BMI = '$bmi', Classification = '$classification', Smoking = '$smoking', Drinking = '$drinking' WHERE Student_ID = '$std_id'");

	if ($insert) {
		foreach ($med_history as $m_history) {
			mysqli_query($con, "UPDATE health_record Set Medical_History = concat(Medical_History, '$m_history,') WHERE Student_ID = '$std_id'");
		}

		foreach ($fam_history as $f_history) {
			mysqli_query($con, "UPDATE health_record Set Family_History = concat(Family_History, '$f_history,') WHERE Student_ID = '$std_id'");
		}
	}
}

?>