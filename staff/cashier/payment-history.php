<?php
include_once '../../database/connection.php'; 

if ($_POST) {
	$std_id = mysqli_real_escape_string($con, $_POST['std_id']);
	$output = "";
	$count = 1;
	$get = mysqli_query($con, "SELECT *, payment_history.Date as date from payment_history inner join student on payment_history.Student_ID = student.Student_ID inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID WHERE payment_history.Student_ID = '$std_id'");
	while ($row = mysqli_fetch_assoc($get)) {
		$name = $row['Firstname']. " " .$row['Lastname'];
		$class = $row['Name']. " " .$row['Strand']. " - " .$row['Section'];
		$date = date('F j, Y', strtotime($row['date']));
		$output .=
		'
		<tr>
			<td>'.$count++.'</td>
			<td>'.$row['OR_Number'].'</td>
			<td>'.$row['Paid_Amount'].'</td>
			<td>'.$row['Balance'].'</td>
			<td>'.$date.'</td>
		</tr>
		';
		
	}

	echo $output;
}
?>