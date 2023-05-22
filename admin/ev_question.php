<?php  
include_once '../database/connection.php';

if ($_POST) {
	$id = $_POST['id'];

	$getevQ = mysqli_query($con, "SELECT *, criteria.ID as id FROM ev_questionnaire inner join criteria on ev_questionnaire.Criteria_ID = criteria_ID WHERE ev_questionnaire.ID = '$id'");
	while ($row = mysqli_fetch_assoc($getevQ)) {
		$data['criteria'] = "<option value=".$row['ID'].">".$row['Criteria']."</option>";
		$data['question'] = $row['Question'];
	}

	echo json_encode($data);
}

?>