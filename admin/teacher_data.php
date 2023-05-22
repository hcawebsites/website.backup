<?php
include_once '../database/connection.php';

if (isset($_POST['teacher_id'])) {

	$sql = "SELECT * FROM teacher_tb WHERE Emp_ID = '".$_POST['teacher_id']."'";
	$result = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
		$data['id'] = $row['Emp_ID'];
		$data['dept'] = $row['Department'];
		$data['name'] = $row['Salutation']. ". " .$row['Firstname']. " " . $row['Middlename'] . " " .$row['Lastname'];
        $data['picture'] = $row['Picture'];

		echo json_encode($data);
	}

}



?>