<?php
include_once '../database/connection.php';

if (isset($_POST['studentID'])) {

	$sql = "SELECT * FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID WHERE 
	student.Student_ID = '".$_POST['studentID']."'";
	$result = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
		
		$data['id'] = $row['Student_ID'];
		$data['name'] = $row['Firstname']. " " . $row['Middlename']. " " . $row['Lastname'];
		$data['grade'] = $row['Grade'];
		$data['section'] = $row['Section'];
		$data['strand'] = $row['Strand'];
		$data['image'] = $row['QR_Code'];

		echo json_encode($data);
	}
	

	
}


?>