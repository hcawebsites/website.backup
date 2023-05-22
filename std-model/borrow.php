<?php 
include_once '../database/connection.php';

if (isset($_POST['std_id'])) {

	$sql = "SELECT student.QR_Code as qrcode FROM borrow_books inner join student on borrow_books.Borrowers_ID = student.Student_ID WHERE Borrowers_ID = '".$_POST["std_id"]."'";
	$result = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		$data['code'] = $row['qrcode'];

		echo json_encode($data);
	}
	
}

 

?>



