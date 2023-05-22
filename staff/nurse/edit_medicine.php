<?php  
include_once '../../database/connection.php';

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['id']);

	$get = mysqli_query($con, "SELECT * from medicine Where ID = '$id'");

	while ($row = mysqli_fetch_assoc($get)) {
		$data['name'] = $row['Name'];
		$data['mg'] = $row['Mg'];
		$data['type'] = $row['Type'];
		$data['total'] = $row['Total'];
		$data['expire'] = date('F j, Y', strtotime($row['Date_Expiration']));
		$data['date'] = date('F j, Y', strtotime($row['Date_Created']));
	}

	echo json_encode($data);
}


?>