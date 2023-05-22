<?php  
include_once '../../database/connection.php';

if ($_POST) {
	$std_id = mysqli_real_escape_string($con, $_POST['std_id']);

	$get_student = mysqli_query($con, "SELECT * from student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join payments on student.Student_ID = payments.Student_ID inner join grade on student_grade.Class_ID = grade.ID WHERE student.Student_ID = '$std_id'");
	while ($row = mysqli_fetch_assoc($get_student)) {
		$class = $row['Name']. " " .$row['Strand']. " " .$row['Section'];
		$name = $row['Lastname']. ", " .$row['Firstname']. " " .$row['Middlename'];
		$total = $row['Total'];
		$balance = $row['Balance'];

		$data['name'] = $name;
		$data['class'] = $class;
		$data['total'] = $total;
		$data['balance'] = $balance;
	}

	echo json_encode($data);
}
?>