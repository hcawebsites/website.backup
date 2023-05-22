<?php  
include_once '../database/connection.php';

if ($_POST) {
	$std_id = mysqli_real_escape_string($con, $_POST['std_id']);
	$output = "";
	$count = 1;

	$get = mysqli_query($con, "SELECT Department from grade inner join student_grade on grade.ID = student_grade.Class_ID Where student_grade.Student_ID = '$std_id'");
	$row = mysqli_fetch_assoc($get);
	$dept = $row['Department'];

	if ($dept == "SHSDEPT") {
		$output .="
			<thead>
				<tr>
					<th scope='col'>#</th>
					<th scope='col'>Subject Code</th>
					<th scope='col'>Description</th>
					<th scope='col'>Prelim</th>
					<th scope='col'>Midterm</th>
					<th scope='col'>Finals</th>
					<th scope='col'>Overall</th>
					<th scope='col'>Semester</th>
					<th scope='col'>Academic Year</th>
				</tr>
			</thead>
		";
		$get_grade = mysqli_query($con, "SELECT * FROM shs_grade inner join subjects on shs_grade.Subject = subjects.Subject_Code Where Student_ID = '$std_id' ORDER by Date ASC");
		while ($row_grade = mysqli_fetch_assoc($get_grade)) {
			$output .="
				<tbody>
					<tr>
						<td>".$count++."</td>
						<td>".$row_grade['Subject']."</td>
						<td>".$row_grade['Description']."</td>
						<td>".$row_grade['Prelim']."</td>
						<td>".$row_grade['Midterm']."</td>
						<td>".$row_grade['Final']."</td>
						<td>".$row_grade['Overall']."</td>
						<td>".$row_grade['Semester']."</td>
						<td>".$row_grade['AY']."</td>
					</tr>
				</tbody>
			";
		}
	}else{
		$output .="
			<thead>
				<tr>
					<th scope='col'>#</th>
					<th scope='col'>Subject Code</th>
					<th scope='col'>Description</th>
					<th scope='col'>1st Grading</th>
					<th scope='col'>2nd Grading</th>
					<th scope='col'>3rd Grading</th>
					<th scope='col'>4th Grading</th>
					<th scope='col'>Finals</th>
					<th scope='col'>School Year</th>
				</tr>
			</thead>
		";
		$get_grade = mysqli_query($con, "SELECT * FROM std_grade inner join subjects on std_grade.Subject = subjects.Subject_Code Where Student_ID = '$std_id' ORDER by Date ASC");
		while ($row_grade = mysqli_fetch_assoc($get_grade)) {
			$output .="
				<tbody>
					<tr>
						<td>".$count++."</td>
						<td>".$row_grade['Subject']."</td>
						<td>".$row_grade['Description']."</td>
						<td>".$row_grade['First']."</td>
						<td>".$row_grade['Second']."</td>
						<td>".$row_grade['Third']."</td>
						<td>".$row_grade['Fourth']."</td>
						<td>".$row_grade['Final']."</td>
						<td>".$row_grade['SY']."</td>
					</tr>
				</tbody>
			";
		}
	}

	echo $output;
}
?>