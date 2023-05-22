<?php

include_once '../../database/connection.php';

if (isset($_POST['isbn'])) {

	$sql = "SELECT * FROM books WHERE ISBN = '".$_POST['isbn']."'";
	$result = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
		$date = $row['Date_Publish'];
		$newdate = date("F j, Y", strtotime($date));
		$data['id1'] = $row['ID'];
		$data['id'] = $row['ISBN'];
		$data['title'] = $row['Title'];
		$data['author'] = $row['Author'];
		$data['date'] = $newdate;
	}

	echo json_encode($data);

	
}


?>