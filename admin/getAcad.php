<?php
include_once '../database/connection.php';

if ($_POST) {
	$acadID = mysqli_real_escape_string($con, $_POST['aid']);

	$getAcad = mysqli_query($con, "SELECT * FROM academic_list WHERE ID = '$acadID'");
	while ($rowAcad = mysqli_fetch_assoc($getAcad)) {
		$data['sy'] = $rowAcad['School_Year'];
		$data['sem'] = $rowAcad['Semester'];
	}

	echo json_encode($data);
}
?>