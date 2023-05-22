<?php
include_once '../../database/connection.php';

if (isset($_POST['std_id'])) {
	$sql = "SELECT * FROM borrow_books WHERE Borrowers_ID = '".$_POST['std_id']."' AND Status = '1'";
	$result = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
		$date = $row['Date_Borrow'];
		$newdate = date('M d Y', strtotime($date));
		
		$data['id'] = $row['ISBN'];
		$data['title'] = $row['Title'];
		$data['author'] = $row['Author'];
		$data['borrow'] = $newdate;

		$data['borrowersID'] = $row['Borrowers_ID'];
		$data['fullname'] = $row['Fullname'];
		$data['contact'] = $row['Contact'];


		echo json_encode($data);
	}
}

 ?>