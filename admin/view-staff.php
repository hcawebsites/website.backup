<?php  
include_once '../database/connection.php';

if ($_POST) {
	$id = mysqli_real_escape_string($con, $_POST['id']);

	$get = mysqli_query($con, "SELECT * from staff_tb inner join user on staff_tb.Emp_ID = user.Username Where Emp_ID = '$id' Order by staff_tb.ID asc");

	while ($row = mysqli_fetch_assoc($get)) {
		$dob = date('F j, Y', strtotime($row['DOB']));
		$date = date('F j, Y', strtotime($row['Date']));
		$data['staff_id'] = $row['Emp_ID'];
		$data['salutation'] = $row['Salutation'];
		$data['lastname'] = $row['Lastname'];
		$data['firstname'] = $row['Firstname'];
		$data['middlename'] = $row['Middlename'];
		$data['suffix'] = $row['Suffix'];
		$data['dob'] = $dob;
		$data['age'] = $row['Age'];
		$data['gender'] = $row['Gender'];
		$data['status'] = $row['Status'];
		$data['address'] = $row['Address'];
		$data['nationality'] = $row['Nationality'];
		$data['Contact'] = $row['Contact'];
		$data['email'] = $row['Email'];
		$data['access'] = $row['Access'];
		$data['picture'] = $row['Picture'];
		$data['qrcode'] = $row['QR_Code'];
		$data['date'] = $date;
	}
	echo json_encode($data);
}

?>