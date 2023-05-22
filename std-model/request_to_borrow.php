<?php 
include_once '../database/connection.php';

if (isset($_POST['bookID'])) {

	$sql = "SELECT * FROM books WHERE ISBN = '".$_POST["bookID"]."'";
	$result = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		$data['code'] = $row['QR_Code'];

		echo json_encode($data);
	}
	
}

 

?>



