<?php  
include_once '../database/connection.php';

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['id']);
	$get = mysqli_query($con, "SELECT * from health_record WHERE Student_ID = '$id'");

	while ($row = mysqli_fetch_assoc($get)) {
		$data['illness'] = $row['Illness'];
		$data['med_taken'] = $row['Medication_Taken'];
		$data['operation'] = $row['Operations'];
		$data['height'] = $row['Height'];
		$data['weight'] = $row['Weight'];
		$data['bmi'] = $row['BMI'];
		$data['classification'] = $row['Classification'];
		$data['smoking'] = $row['Smoking'];
		$data['drinking'] = $row['Drinking'];
	}
	echo json_encode($data);
}
?>