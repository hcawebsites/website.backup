<?php
include_once '../../database/connection.php';

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['id']);

	$getBook = mysqli_query($con, "SELECT * FROM books where ID = '$id'");
	while ($row = mysqli_fetch_assoc($getBook)) {
		$data['isbn'] = $row['ISBN'];
		$data['title'] = $row['Title'];
		$data['subtitle'] = $row['Subtitle'];
		$data['author'] = $row['Author'];
		$data['sub_author'] = $row['Sub_Author'];
		$data['category'] = $row['Category'];
		$data['total'] = $row['Total'];
		$data['date'] = date("F j, Y", strtotime($row['Date_Publish']));
		$data['call'] = $row['Call_Number'];
		$data['qrcode'] = $row['QR_Code'];
	}
	echo json_encode($data);
}
?>