<?php  
include_once '../../database/connection.php';

if ($_POST) {
	$std_id = $_POST['std_id'];
	$code = $_GET['code'];
	$get_name = mysqli_query($con, "SELECT * FROM student Where Student_ID = '$std_id'");
	$get_grade = mysqli_query($con, "SELECT * FROM std_grade WHERE Student_ID = '$std_id' AND Subject = '$code'");
		if (mysqli_num_rows($get_grade) > 0) {
			while ($row = mysqli_fetch_assoc($get_name)) {
			$row_grade = mysqli_fetch_assoc($get_grade);
			$data['first'] = $row_grade['First'];
			$data['second'] = $row_grade['Second'];
			$data['third'] = $row_grade['Third'];
			$data['fourth'] = $row_grade['Fourth'];
			$data['final'] = $row_grade['Final'];
			$data['name'] = $row['Firstname']. " " .$row['Middlename']. " " .$row['Lastname'];
			}
		}else{
		while ($row = mysqli_fetch_assoc($get_name)) {
		$data['name'] = $row['Firstname']. " " .$row['Middlename']. " " .$row['Lastname'];
		}
	
	}
	echo json_encode($data);
}
?>