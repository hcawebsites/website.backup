<?php  
include_once '../../database/connection.php';

if ($_POST) {
	$std_id = mysqli_real_escape_string($con, $_POST['id']);
	$get = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Middlename, ' ', Lastname) as name FROM appointments inner join student on appointments.Student_ID = student.Student_ID Where student.Student_ID = '$std_id'");
	while ($row = mysqli_fetch_assoc($get)) {
		$date = date('F j, Y h:i', strtotime($row['Date_Time']));
		$data['name'] = $row['name'];
		$data['firstname'] = $row['Firstname'];
		$data['email'] = $row['Email'];
		$data['reason'] = $row['Reasons'];
		$data['b_name'] = $row['Bully_Name'];
		$data['concern'] = $row['Concerns'];
		$data['schedule'] = $date;
		$data['date_created'] = date('F j, Y', strtotime($row['Date_Created']));
	}

	echo json_encode($data);
}
?>